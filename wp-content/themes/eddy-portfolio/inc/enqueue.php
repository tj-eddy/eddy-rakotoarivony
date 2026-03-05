<?php
/**
 * Chargement des styles et scripts frontend et admin.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enregistre et charge les assets frontend.
 *
 * @return void
 */
function eddy_enqueue_assets() {

    // Google Fonts — Plus Jakarta Sans + Inter
    wp_enqueue_style(
        'eddy-google-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap',
        [],
        null
    );

    // Tailwind CSS CDN
    wp_enqueue_script(
        'eddy-tailwind',
        'https://cdn.tailwindcss.com',
        [],
        null,
        false
    );

    // Feuille de styles principale du thème
    wp_enqueue_style(
        'eddy-main',
        EDDY_THEME_URI . '/assets/css/style-main.css',
        [ 'eddy-google-fonts' ],
        EDDY_THEME_VERSION
    );

    // jQuery (inclus WordPress, déclaré comme dépendance)
    wp_enqueue_script( 'jquery' );

    // Script principal frontend
    wp_enqueue_script(
        'eddy-main',
        EDDY_THEME_URI . '/assets/js/main.js',
        [ 'jquery' ],
        EDDY_THEME_VERSION,
        true // in_footer
    );

    // Script page article uniquement
    if ( is_singular( 'post' ) ) {
        wp_enqueue_script(
            'eddy-single-post',
            EDDY_THEME_URI . '/assets/js/single-post.js',
            [ 'jquery', 'eddy-main' ],
            EDDY_THEME_VERSION,
            true
        );
    }

    // Passage de variables PHP → JavaScript
    wp_localize_script( 'eddy-main', 'EDDY_VARS', [
        'ajax_url'          => admin_url( 'admin-ajax.php' ),
        'nonce'             => wp_create_nonce( 'eddy_nonce' ),
        'site_url'          => home_url(),
        'theme_url'         => EDDY_THEME_URI,
        'dark_mode_default' => get_theme_mod( 'eddy_default_theme', 'light' ),
        'i18n'              => [
            'send_success'  => __( 'Message envoyé avec succès !', 'eddy-portfolio' ),
            'send_error'    => __( "Erreur lors de l'envoi.", 'eddy-portfolio' ),
            'required_field' => __( 'Ce champ est requis.', 'eddy-portfolio' ),
        ],
    ] );
}
add_action( 'wp_enqueue_scripts', 'eddy_enqueue_assets' );

/**
 * Styles admin personnalisés (metaboxes, etc.).
 *
 * @return void
 */
function eddy_admin_enqueue_assets() {
    wp_enqueue_style(
        'eddy-admin',
        EDDY_THEME_URI . '/assets/css/admin.css',
        [],
        EDDY_THEME_VERSION
    );
}
add_action( 'admin_enqueue_scripts', 'eddy_admin_enqueue_assets' );
