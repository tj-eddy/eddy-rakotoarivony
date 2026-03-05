<?php
/**
 * Déclaration des zones de widgets du thème.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enregistre les sidebars (zones de widgets).
 *
 * @return void
 */
function eddy_register_widgets() {

    // Sidebar article (colonne latérale)
    register_sidebar( [
        'name'          => __( 'Sidebar Article', 'eddy-portfolio' ),
        'id'            => 'sidebar-post',
        'description'   => __( 'Widgets affichés dans la colonne latérale des articles.', 'eddy-portfolio' ),
        'before_widget' => '<div id="%1$s" class="sidebar-card %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-sm font-bold mb-4" style="color:var(--color-text)">',
        'after_title'   => '</h4>',
    ] );

    // Footer colonne 1
    register_sidebar( [
        'name'          => __( 'Footer — Colonne 1', 'eddy-portfolio' ),
        'id'            => 'footer-1',
        'description'   => __( 'Zone de widgets dans le footer, première colonne.', 'eddy-portfolio' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-semibold text-sm mb-3" style="color:var(--color-text)">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'eddy_register_widgets' );
