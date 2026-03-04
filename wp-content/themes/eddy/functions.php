<?php
/**
 * Eddy Theme Functions
 * 
 * @package Eddy
 */

// Enqueue parent styles
function eddy_enqueue_styles() {
    wp_enqueue_style('eddy-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'eddy_enqueue_styles');

// Add theme support
function eddy_theme_setup() {
    // Add dynamic title tag support
    add_theme_support('title-tag');
    
    // Add featured image support
    add_theme_support('post-thumbnails');
    
    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'eddy'),
    ));
}
add_action('after_setup_theme', 'eddy_theme_setup');

// Register widget areas
function eddy_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'eddy'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'eddy'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'eddy_widgets_init');

// Get post view count (simulated)
function get_views() {
    return rand(50, 500);
}

// Get author initials
function get_the_author_initials() {
    $author_name = get_the_author();
    $words = explode(' ', $author_name);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return substr($initials, 0, 2);
}
