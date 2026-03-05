<?php
/**
 * Déclaration des Custom Post Types du thème.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Custom Post Type : Services
 * Slug : eddy_service
 * Utilisé pour la section Services du portfolio.
 *
 * @return void
 */
function eddy_register_cpt_service() {

    $labels = [
        'name'               => __( 'Services', 'eddy-portfolio' ),
        'singular_name'      => __( 'Service', 'eddy-portfolio' ),
        'add_new'            => __( 'Ajouter un service', 'eddy-portfolio' ),
        'add_new_item'       => __( 'Ajouter un nouveau service', 'eddy-portfolio' ),
        'edit_item'          => __( 'Modifier le service', 'eddy-portfolio' ),
        'new_item'           => __( 'Nouveau service', 'eddy-portfolio' ),
        'view_item'          => __( 'Voir le service', 'eddy-portfolio' ),
        'all_items'          => __( 'Tous les services', 'eddy-portfolio' ),
        'search_items'       => __( 'Rechercher un service', 'eddy-portfolio' ),
        'not_found'          => __( 'Aucun service trouvé.', 'eddy-portfolio' ),
        'not_found_in_trash' => __( 'Aucun service dans la corbeille.', 'eddy-portfolio' ),
        'menu_name'          => __( 'Services', 'eddy-portfolio' ),
    ];

    register_post_type( 'eddy_service', [
        'labels'          => $labels,
        'public'          => true,
        'show_in_rest'    => true,       // Gutenberg + REST API
        'supports'        => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'menu_icon'       => 'dashicons-hammer',
        'menu_position'   => 5,
        'has_archive'     => false,
        'rewrite'         => [ 'slug' => 'services' ],
        'capability_type' => 'post',
    ] );
}
add_action( 'init', 'eddy_register_cpt_service' );
