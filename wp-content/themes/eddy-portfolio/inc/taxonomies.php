<?php
/**
 * Déclaration des taxonomies personnalisées du thème.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Taxonomy : Catégories de services (service_category)
 * Liée au CPT "eddy_service" — Hiérarchique (comme category).
 *
 * @return void
 */
function eddy_register_taxonomy_service_category() {

    $labels = [
        'name'              => __( 'Catégories de services', 'eddy-portfolio' ),
        'singular_name'     => __( 'Catégorie de service', 'eddy-portfolio' ),
        'search_items'      => __( 'Rechercher une catégorie', 'eddy-portfolio' ),
        'all_items'         => __( 'Toutes les catégories', 'eddy-portfolio' ),
        'parent_item'       => __( 'Catégorie parente', 'eddy-portfolio' ),
        'parent_item_colon' => __( 'Catégorie parente :', 'eddy-portfolio' ),
        'edit_item'         => __( 'Modifier la catégorie', 'eddy-portfolio' ),
        'update_item'       => __( 'Mettre à jour', 'eddy-portfolio' ),
        'add_new_item'      => __( 'Ajouter une catégorie', 'eddy-portfolio' ),
        'new_item_name'     => __( 'Nouvelle catégorie', 'eddy-portfolio' ),
        'menu_name'         => __( 'Catégories', 'eddy-portfolio' ),
    ];

    register_taxonomy( 'service_category', 'eddy_service', [
        'labels'            => $labels,
        'hierarchical'      => true,     // Comme category
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'service-category' ],
    ] );
}
add_action( 'init', 'eddy_register_taxonomy_service_category' );

/**
 * Taxonomy : Technologies (post_tech)
 * Liée au post type "post" — Non hiérarchique (comme tag).
 * Termes prévus : PrestaShop, Symfony, WordPress, PHP, TMA, Performance.
 *
 * @return void
 */
function eddy_register_taxonomy_post_tech() {

    $labels = [
        'name'                       => __( 'Technologies', 'eddy-portfolio' ),
        'singular_name'              => __( 'Technologie', 'eddy-portfolio' ),
        'search_items'               => __( 'Rechercher une technologie', 'eddy-portfolio' ),
        'popular_items'              => __( 'Technologies populaires', 'eddy-portfolio' ),
        'all_items'                  => __( 'Toutes les technologies', 'eddy-portfolio' ),
        'edit_item'                  => __( 'Modifier la technologie', 'eddy-portfolio' ),
        'update_item'                => __( 'Mettre à jour', 'eddy-portfolio' ),
        'add_new_item'               => __( 'Ajouter une technologie', 'eddy-portfolio' ),
        'new_item_name'              => __( 'Nouvelle technologie', 'eddy-portfolio' ),
        'separate_items_with_commas' => __( 'Séparer par des virgules', 'eddy-portfolio' ),
        'add_or_remove_items'        => __( 'Ajouter ou supprimer', 'eddy-portfolio' ),
        'menu_name'                  => __( 'Technologies', 'eddy-portfolio' ),
    ];

    register_taxonomy( 'post_tech', 'post', [
        'labels'            => $labels,
        'hierarchical'      => false,    // Comme tag
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'tech' ],
    ] );
}
add_action( 'init', 'eddy_register_taxonomy_post_tech' );
