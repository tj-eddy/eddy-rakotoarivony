<?php
/**
 * Options du thème via le Customizer WordPress.
 * Panel "Eddy Portfolio Options" avec toutes les sections de configuration.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enregistre le panel, les sections, les settings et les contrôles du Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Instance du Customizer.
 * @return void
 */
function eddy_customize_register( WP_Customize_Manager $wp_customize ) {

    // =========================================================
    // PANEL PRINCIPAL
    // =========================================================
    $wp_customize->add_panel( 'eddy_panel', [
        'title'    => __( 'Eddy Portfolio Options', 'eddy-portfolio' ),
        'priority' => 30,
    ] );

    // =========================================================
    // SECTION : Identité & Profil
    // =========================================================
    $wp_customize->add_section( 'eddy_identity', [
        'title'    => __( 'Identité & Profil', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 10,
    ] );

    /** @var array $identity_fields Champs de la section identité */
    $identity_fields = [
        [ 'eddy_full_name',           'text',     'Eddy RAKOTOARIVONY',                     'sanitize_text_field' ],
        [ 'eddy_job_title',           'text',     'Développeur Web Full-Stack',              'sanitize_text_field' ],
        [ 'eddy_tagline',             'text',     'PrestaShop · Symfony · WordPress · TMA',  'sanitize_text_field' ],
        [ 'eddy_bio_short',           'textarea', '',                                         'wp_kses_post' ],
        [ 'eddy_bio_full',            'textarea', '',                                         'wp_kses_post' ],
        [ 'eddy_email',               'text',     'contact@eddy-dev.mg',                    'sanitize_email' ],
        [ 'eddy_linkedin_url',        'url',      '',                                         'esc_url_raw' ],
        [ 'eddy_github_url',          'url',      '',                                         'esc_url_raw' ],
        [ 'eddy_location',            'text',     'Madagascar / Remote',                     'sanitize_text_field' ],
        [ 'eddy_available_freelance', 'checkbox', true,                                       'rest_sanitize_boolean' ],
    ];

    foreach ( $identity_fields as $field ) {
        [ $id, $type, $default, $sanitize ] = $field;
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => $sanitize,
            'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( $id, [
            'label'   => ucwords( str_replace( [ 'eddy_', '_' ], [ '', ' ' ], $id ) ),
            'section' => 'eddy_identity',
            'type'    => $type,
        ] );
    }

    // =========================================================
    // SECTION : Couleurs & Thème
    // =========================================================
    $wp_customize->add_section( 'eddy_colors', [
        'title'    => __( 'Couleurs & Thème', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 20,
    ] );

    /** Couleur primaire principale */
    $wp_customize->add_setting( 'eddy_primary_color', [
        'default'           => '#0F766E',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eddy_primary_color', [
        'label'   => __( 'Couleur primaire', 'eddy-portfolio' ),
        'section' => 'eddy_colors',
    ] ) );

    /** Couleur primaire foncée */
    $wp_customize->add_setting( 'eddy_primary_dark', [
        'default'           => '#0D9488',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eddy_primary_dark', [
        'label'   => __( 'Couleur primaire foncée', 'eddy-portfolio' ),
        'section' => 'eddy_colors',
    ] ) );

    /** Mode sombre / clair par défaut */
    $wp_customize->add_setting( 'eddy_default_theme', [
        'default'           => 'light',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'eddy_default_theme', [
        'label'   => __( 'Thème par défaut', 'eddy-portfolio' ),
        'section' => 'eddy_colors',
        'type'    => 'select',
        'choices' => [
            'light' => __( 'Clair', 'eddy-portfolio' ),
            'dark'  => __( 'Sombre', 'eddy-portfolio' ),
        ],
    ] );

    // =========================================================
    // SECTION : Hero Section
    // =========================================================
    $wp_customize->add_section( 'eddy_hero', [
        'title'    => __( 'Hero Section', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 30,
    ] );

    $hero_fields = [
        [ 'eddy_hero_title',    'text', '' ],
        [ 'eddy_hero_subtitle', 'text', '' ],
        [ 'eddy_hero_cta1_text', 'text', __( 'Voir mes services', 'eddy-portfolio' ) ],
        [ 'eddy_hero_cta2_text', 'text', __( 'Me contacter', 'eddy-portfolio' ) ],
    ];

    foreach ( $hero_fields as $field ) {
        [ $id, $type, $default ] = $field;
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( $id, [
            'label'   => ucwords( str_replace( [ 'eddy_hero_', '_' ], [ '', ' ' ], $id ) ),
            'section' => 'eddy_hero',
            'type'    => $type,
        ] );
    }

    // =========================================================
    // SECTION : Section Services
    // =========================================================
    $wp_customize->add_section( 'eddy_services', [
        'title'    => __( 'Section Services', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 40,
    ] );

    $wp_customize->add_setting( 'eddy_services_title', [
        'default'           => __( 'Mes Services', 'eddy-portfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'eddy_services_title', [
        'label'   => __( 'Titre de la section', 'eddy-portfolio' ),
        'section' => 'eddy_services',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'eddy_services_subtitle', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'eddy_services_subtitle', [
        'label'   => __( 'Sous-titre', 'eddy-portfolio' ),
        'section' => 'eddy_services',
        'type'    => 'textarea',
    ] );

    // =========================================================
    // SECTION : Section Actualités
    // =========================================================
    $wp_customize->add_section( 'eddy_news', [
        'title'    => __( 'Section Actualités', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 50,
    ] );

    $wp_customize->add_setting( 'eddy_news_title', [
        'default'           => __( 'Dernières Actualités', 'eddy-portfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'eddy_news_title', [
        'label'   => __( 'Titre de la section', 'eddy-portfolio' ),
        'section' => 'eddy_news',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'eddy_news_count', [
        'default'           => 5,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'eddy_news_count', [
        'label'       => __( 'Nombre d\'articles dans le carrousel', 'eddy-portfolio' ),
        'section'     => 'eddy_news',
        'type'        => 'number',
        'input_attrs' => [ 'min' => 1, 'max' => 12 ],
    ] );

    // =========================================================
    // SECTION : Contact
    // =========================================================
    $wp_customize->add_section( 'eddy_contact', [
        'title'    => __( 'Contact', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 60,
    ] );

    $wp_customize->add_setting( 'eddy_contact_title', [
        'default'           => __( 'Me contacter', 'eddy-portfolio' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'eddy_contact_title', [
        'label'   => __( 'Titre de la section', 'eddy-portfolio' ),
        'section' => 'eddy_contact',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'eddy_contact_email_dest', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'eddy_contact_email_dest', [
        'label'       => __( 'Email de réception des messages', 'eddy-portfolio' ),
        'description' => __( 'Email vers lequel sont envoyés les messages du formulaire de contact.', 'eddy-portfolio' ),
        'section'     => 'eddy_contact',
        'type'        => 'text',
    ] );

    $wp_customize->add_setting( 'eddy_contact_map_embed', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'eddy_contact_map_embed', [
        'label'       => __( 'iframe Google Maps (optionnel)', 'eddy-portfolio' ),
        'section'     => 'eddy_contact',
        'type'        => 'textarea',
    ] );

    // =========================================================
    // SECTION : SEO
    // =========================================================
    $wp_customize->add_section( 'eddy_seo', [
        'title'    => __( 'SEO', 'eddy-portfolio' ),
        'panel'    => 'eddy_panel',
        'priority' => 70,
    ] );

    $wp_customize->add_setting( 'eddy_meta_description', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'eddy_meta_description', [
        'label'   => __( 'Meta description globale', 'eddy-portfolio' ),
        'section' => 'eddy_seo',
        'type'    => 'textarea',
    ] );

    $wp_customize->add_setting( 'eddy_og_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'eddy_og_image', [
        'label'   => __( 'Image Open Graph (og:image)', 'eddy-portfolio' ),
        'section' => 'eddy_seo',
    ] ) );

    $wp_customize->add_setting( 'eddy_schema_twitter', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'eddy_schema_twitter', [
        'label'       => __( 'Handle Twitter (@)', 'eddy-portfolio' ),
        'description' => __( 'Exemple : @eddydev', 'eddy-portfolio' ),
        'section'     => 'eddy_seo',
        'type'        => 'text',
    ] );
}
add_action( 'customize_register', 'eddy_customize_register' );
