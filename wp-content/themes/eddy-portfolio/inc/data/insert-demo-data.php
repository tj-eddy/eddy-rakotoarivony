<?php
/**
 * Insertion des données de démonstration en base de données WordPress.
 *
 * USAGE : Ajouter ?eddy_insert_demo=1 à l'URL (admin uniquement)
 * ou appeler eddy_insert_demo_data() depuis un hook after_switch_theme.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once EDDY_THEME_DIR . '/inc/data/demo-content.php';

/**
 * Déclenche l'insertion des données démo lors de l'activation du thème.
 *
 * @return void
 */
function eddy_on_theme_activation(): void {
    if ( get_option( 'eddy_demo_data_inserted' ) ) return;
    eddy_insert_demo_data();
}
add_action( 'after_switch_theme', 'eddy_on_theme_activation' );

/**
 * Permet l'insertion via URL ?eddy_insert_demo=1 (admin uniquement).
 *
 * @return void
 */
function eddy_demo_data_request_handler(): void {
    if ( ! is_admin() && isset( $_GET['eddy_insert_demo'] ) && current_user_can( 'manage_options' ) ) {
        check_admin_referer( 'eddy_insert_demo' );
        eddy_insert_demo_data();
        wp_redirect( admin_url( '?eddy_demo=done' ) );
        exit;
    }
}
add_action( 'init', 'eddy_demo_data_request_handler' );

/**
 * Insère toutes les données de démonstration en BDD.
 * Vérifie l'existence avant insertion pour éviter les doublons.
 *
 * @return void
 */
function eddy_insert_demo_data(): void {
    $content = eddy_get_demo_content();

    // Flush rewrite rules pour les CPT
    flush_rewrite_rules();

    // 1. Catégories d'articles
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

    // 2. Termes taxonomie post_tech
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

    // 3. Articles de blog
    foreach ( $content['posts'] as $post_data ) {
        // Vérifier si un article avec ce titre existe déjà
        $existing = get_page_by_title( $post_data['post_title'], OBJECT, 'post' );
        if ( $existing ) continue;

        // Résoudre les IDs de catégories
        $cat_ids = [];
        foreach ( $post_data['post_category'] as $cat_name ) {
            if ( isset( $category_ids[ $cat_name ] ) ) {
                $cat_ids[] = $category_ids[ $cat_name ];
            }
        }

        $insert_data = [
            'post_title'   => $post_data['post_title'],
            'post_content' => $post_data['post_content'],
            'post_excerpt' => $post_data['post_excerpt'],
            'post_status'  => $post_data['post_status'],
            'post_date'    => $post_data['post_date'],
            'post_author'  => get_current_user_id() ?: 1,
            'post_category' => $cat_ids,
        ];

        $post_id = wp_insert_post( $insert_data );

        if ( ! is_wp_error( $post_id ) && $post_id > 0 ) {
            // Assigner les technologies
            if ( ! empty( $post_data['post_tech'] ) ) {
                $tech_term_ids = [];
                foreach ( $post_data['post_tech'] as $tech_name ) {
                    if ( isset( $tech_ids[ $tech_name ] ) ) {
                        $tech_term_ids[] = $tech_ids[ $tech_name ];
                    }
                }
                if ( $tech_term_ids ) {
                    wp_set_object_terms( $post_id, $tech_term_ids, 'post_tech' );
                }
            }
        }
    }

    // 4. Services (CPT eddy_service)
    foreach ( $content['services'] as $service_data ) {
        $existing = get_page_by_title( $service_data['post_title'], OBJECT, 'eddy_service' );
        if ( $existing ) continue;

        wp_insert_post( [
            'post_title'   => $service_data['post_title'],
            'post_content' => $service_data['post_content'],
            'post_excerpt' => $service_data['post_excerpt'],
            'post_status'  => $service_data['post_status'],
            'post_type'    => 'eddy_service',
            'menu_order'   => $service_data['menu_order'],
            'post_author'  => get_current_user_id() ?: 1,
        ] );
    }

    // 5. Configurer les options du Customizer avec les valeurs par défaut
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
        'eddy_services_title'      => 'Mes Services',
        'eddy_news_title'          => 'Dernières Actualités',
        'eddy_news_count'          => 5,
        'eddy_contact_title'       => 'Me contacter',
        'eddy_hero_cta1_text'      => 'Voir mes services',
        'eddy_hero_cta2_text'      => 'Me contacter',
    ];

    foreach ( $customizer_defaults as $key => $value ) {
        if ( get_theme_mod( $key ) === '' || get_theme_mod( $key ) === false ) {
            set_theme_mod( $key, $value );
        }
    }

    // Marquer comme inséré pour éviter les doublons
    update_option( 'eddy_demo_data_inserted', true );
}
