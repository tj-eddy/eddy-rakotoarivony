<?php
/**
 * Configuration principale du thème : supports, menus, tailles d'images.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Initialise les fonctionnalités du thème.
 *
 * @return void
 */
function eddy_theme_setup() {

    // Traductions
    load_theme_textdomain( 'eddy-portfolio', EDDY_THEME_DIR . '/languages' );

    // Balise <title> gérée par WordPress
    add_theme_support( 'title-tag' );

    // Images à la une
    add_theme_support( 'post-thumbnails' );

    // Tailles d'images custom
    add_image_size( 'eddy-card', 800, 450, true );   // Cards carrousel
    add_image_size( 'eddy-hero', 1200, 600, true );  // Hero article
    add_image_size( 'eddy-thumb', 400, 300, true );  // Miniatures

    // Support HTML5
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    // Logo personnalisé
    add_theme_support( 'custom-logo', [
        'width'       => 60,
        'height'      => 60,
        'flex-width'  => true,
        'flex-height' => true,
    ] );

    // Styles éditeur Gutenberg
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    // Alignement large / pleine largeur Gutenberg
    add_theme_support( 'align-wide' );

    // Embeds responsives
    add_theme_support( 'responsive-embeds' );

    // Styles natifs des blocs Gutenberg
    add_theme_support( 'wp-block-styles' );

    // Déclaration des emplacements de menus
    register_nav_menus( [
        'primary' => __( 'Menu Principal', 'eddy-portfolio' ),
        'footer'  => __( 'Menu Footer', 'eddy-portfolio' ),
        'social'  => __( 'Liens Sociaux', 'eddy-portfolio' ),
    ] );
}
add_action( 'after_setup_theme', 'eddy_theme_setup' );
