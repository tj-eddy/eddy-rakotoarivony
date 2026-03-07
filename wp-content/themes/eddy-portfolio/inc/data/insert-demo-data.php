<?php
/**
 * Insertion des données de démonstration en base de données WordPress.
 *
 * USAGE :
 *  - Automatique à l'activation du thème (first-time).
 *  - Force la réinsertion : ajouter ?eddy_force_demo=1 à l'URL (admin connecté).
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once EDDY_THEME_DIR . '/inc/data/demo-content.php';

/**
 * Déclenche l'insertion des données démo lors de l'activation du thème.
 */
function eddy_on_theme_activation(): void {
    if ( get_option( 'eddy_demo_data_inserted' ) ) return;
    eddy_insert_demo_data();
}
add_action( 'after_switch_theme', 'eddy_on_theme_activation' );

/**
 * Insertion forcée via ?eddy_force_demo=1 (admin uniquement, sans nonce pour facilité).
 */
function eddy_demo_data_request_handler(): void {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( ! isset( $_GET['eddy_force_demo'] ) ) return;

    // Supprime l'option pour autoriser la réinsertion
    delete_option( 'eddy_demo_data_inserted' );
    eddy_insert_demo_data();
    wp_safe_redirect( add_query_arg( 'eddy_demo', 'done', admin_url() ) );
    exit;
}
add_action( 'init', 'eddy_demo_data_request_handler' );

// ──────────────────────────────────────────────────────
// Insertion principale
// ──────────────────────────────────────────────────────

/**
 * Insère toutes les données de démonstration en BDD.
 * Protégé contre les doublons par titre.
 */
function eddy_insert_demo_data(): void {
    $content = eddy_get_demo_content();

    // S'assurer que les helpers media WP sont disponibles
    if ( ! function_exists( 'media_sideload_image' ) ) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
    }

    flush_rewrite_rules();

    // ── 1. Catégories d'articles ─────────────────
    $category_ids = [];
    foreach ( $content['categories'] as $cat_name ) {
        $term = get_term_by( 'name', $cat_name, 'category' );
        if ( ! $term ) {
            $result = wp_insert_term( $cat_name, 'category' );
            if ( ! is_wp_error( $result ) ) {
                $category_ids[ $cat_name ] = $result['term_id'];
            }
        } else {
            $category_ids[ $cat_name ] = $term->term_id;
        }
    }

    // ── 2. Termes taxonomie post_tech ────────────
    $tech_ids = [];
    foreach ( $content['post_tech_terms'] as $tech_name ) {
        $term = get_term_by( 'name', $tech_name, 'post_tech' );
        if ( ! $term ) {
            $result = wp_insert_term( $tech_name, 'post_tech' );
            if ( ! is_wp_error( $result ) ) {
                $tech_ids[ $tech_name ] = $result['term_id'];
            }
        } else {
            $tech_ids[ $tech_name ] = $term->term_id;
        }
    }

    // ── 3. Articles de blog ──────────────────────
    foreach ( $content['posts'] as $post_data ) {

        // Éviter les doublons (WP_Query, get_page_by_title est déprécié en WP 6.2)
        $dup = new WP_Query( [
            'post_type'              => 'post',
            'post_status'            => 'publish',
            'title'                  => $post_data['post_title'],
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ] );
        $existing = $dup->have_posts() ? $dup->next_post() : null;
        if ( $existing ) {
            // Mettre à jour l'image à la une si elle manque
            if ( ! has_post_thumbnail( $existing->ID ) && ! empty( $post_data['featured_image_url'] ) ) {
                eddy_sideload_featured_image(
                    $post_data['featured_image_url'],
                    $existing->ID,
                    $post_data['featured_image_alt'] ?? $post_data['post_title']
                );
            }
            continue;
        }

        // Résoudre les IDs de catégories
        $cat_ids = [];
        foreach ( $post_data['post_category'] as $cat_name ) {
            if ( isset( $category_ids[ $cat_name ] ) ) {
                $cat_ids[] = $category_ids[ $cat_name ];
            }
        }

        $post_id = wp_insert_post( [
            'post_title'    => $post_data['post_title'],
            'post_content'  => $post_data['post_content'],
            'post_excerpt'  => $post_data['post_excerpt'],
            'post_status'   => $post_data['post_status'],
            'post_date'     => $post_data['post_date'],
            'post_author'   => get_current_user_id() ?: 1,
            'post_category' => $cat_ids,
        ] );

        if ( is_wp_error( $post_id ) || $post_id <= 0 ) continue;

        // Taxonomie post_tech
        if ( ! empty( $post_data['post_tech'] ) ) {
            $tech_term_ids = array_filter( array_map(
                fn( $t ) => $tech_ids[ $t ] ?? null,
                $post_data['post_tech']
            ) );
            if ( $tech_term_ids ) {
                wp_set_object_terms( $post_id, array_values( $tech_term_ids ), 'post_tech' );
            }
        }

        // Image à la une (sideload depuis URL externe)
        if ( ! empty( $post_data['featured_image_url'] ) ) {
            eddy_sideload_featured_image(
                $post_data['featured_image_url'],
                $post_id,
                $post_data['featured_image_alt'] ?? $post_data['post_title']
            );
        }
    }

    // ── 4. Services (CPT eddy_service) ──────────
    foreach ( $content['services'] as $service_data ) {
        $dup2     = new WP_Query( [
            'post_type'              => 'eddy_service',
            'post_status'            => 'publish',
            'title'                  => $service_data['post_title'],
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ] );
        $existing = $dup2->have_posts() ? $dup2->next_post() : null;

        if ( $existing ) {
            // Mettre à jour les meta si absentes
            eddy_upsert_service_meta( $existing->ID, $service_data );
            continue;
        }

        $service_id = wp_insert_post( [
            'post_title'   => $service_data['post_title'],
            'post_content' => $service_data['post_content'],
            'post_excerpt' => $service_data['post_excerpt'],
            'post_status'  => $service_data['post_status'],
            'post_type'    => 'eddy_service',
            'menu_order'   => $service_data['menu_order'],
            'post_author'  => get_current_user_id() ?: 1,
        ] );

        if ( ! is_wp_error( $service_id ) && $service_id > 0 ) {
            eddy_upsert_service_meta( $service_id, $service_data );
        }
    }

    // ── 5. Options du Customizer ─────────────────
    $customizer_defaults = [
        'eddy_full_name'           => 'Eddy RAKOTOARIVONY',
        'eddy_job_title'           => 'Développeur Web Full-Stack',
        'eddy_tagline'             => 'PrestaShop · Symfony · WordPress · TMA',
        'eddy_email'               => 'contact@eddy-dev.mg',
        'eddy_location'            => 'Madagascar / Remote',
        'eddy_available_freelance' => true,
        'eddy_primary_color'       => '#0F766E',
        'eddy_primary_dark'        => '#0D9488',
        'eddy_default_theme'       => 'light',
        'eddy_services_title'      => 'Mes Expertises',
        'eddy_services_subtitle'   => 'Solutions sur-mesure en développement web, e-commerce et maintenance applicative.',
        'eddy_news_title'          => 'Blog Technique',
        'eddy_news_count'          => 3,
        'eddy_contact_title'       => 'Me contacter',
        'eddy_hero_cta1_text'      => 'Voir mes expertises',
        'eddy_hero_cta2_text'      => 'Me contacter',
    ];

    foreach ( $customizer_defaults as $key => $value ) {
        // Forcer la mise à jour lors d'un reset, sinon ne pas écraser
        if ( get_option( 'eddy_demo_data_inserted' ) === false ) {
            set_theme_mod( $key, $value );
        } elseif ( get_theme_mod( $key ) === '' || get_theme_mod( $key ) === false ) {
            set_theme_mod( $key, $value );
        }
    }

    update_option( 'eddy_demo_data_inserted', true );
}

// ──────────────────────────────────────────────────────
// Helpers
// ──────────────────────────────────────────────────────

/**
 * Télécharge et attache une image à la une à un post.
 *
 * @param string $url     URL distante de l'image.
 * @param int    $post_id ID du post cible.
 * @param string $alt     Texte alternatif de l'image.
 * @return int|false Attachment ID ou false.
 */
function eddy_sideload_featured_image( string $url, int $post_id, string $alt = '' ) {
    if ( ! function_exists( 'media_sideload_image' ) ) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
    }

    // Télécharge l'image dans un fichier temporaire
    $tmp = download_url( $url, 15 );
    if ( is_wp_error( $tmp ) ) {
        return false;
    }

    // Détermine un nom de fichier propre avec extension
    $filename = 'featured-' . sanitize_title( $alt ?: basename( $url ) ) . '.jpg';

    $file_array = [
        'name'     => $filename,
        'tmp_name' => $tmp,
    ];

    $attachment_id = media_handle_sideload( $file_array, $post_id, $alt );

    if ( is_wp_error( $attachment_id ) ) {
        @unlink( $tmp );
        return false;
    }

    set_post_thumbnail( $post_id, $attachment_id );

    if ( $alt ) {
        update_post_meta( $attachment_id, '_wp_attachment_image_alt', sanitize_text_field( $alt ) );
    }

    return $attachment_id;
}

/**
 * Enregistre les meta spécifiques d'un service (icône, tags).
 *
 * @param int   $service_id ID du service.
 * @param array $data       Données du service.
 */
function eddy_upsert_service_meta( int $service_id, array $data ): void {
    if ( ! empty( $data['service_icon'] ) ) {
        update_post_meta( $service_id, '_service_icon', sanitize_textarea_field( $data['service_icon'] ) );
    }
    if ( ! empty( $data['service_tags'] ) ) {
        update_post_meta( $service_id, '_service_tags', array_map( 'sanitize_text_field', $data['service_tags'] ) );
    }
}
