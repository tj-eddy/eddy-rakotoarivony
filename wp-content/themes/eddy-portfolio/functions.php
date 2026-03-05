<?php
/**
 * Eddy Portfolio — functions.php
 * Point d'entrée principal du thème. Charge tous les modules via require_once.
 *
 * @package Eddy_Portfolio
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Constantes du thème
define( 'EDDY_THEME_VERSION', '1.0.0' );
define( 'EDDY_THEME_DIR', get_template_directory() );
define( 'EDDY_THEME_URI', get_template_directory_uri() );

// Chargement des modules
require_once EDDY_THEME_DIR . '/inc/theme-setup.php';
require_once EDDY_THEME_DIR . '/inc/enqueue.php';
require_once EDDY_THEME_DIR . '/inc/widgets.php';
require_once EDDY_THEME_DIR . '/inc/custom-post-types.php';
require_once EDDY_THEME_DIR . '/inc/taxonomies.php';
require_once EDDY_THEME_DIR . '/inc/customizer.php';
require_once EDDY_THEME_DIR . '/inc/ajax-handlers.php';
require_once EDDY_THEME_DIR . '/inc/seo-meta.php';
if ( function_exists( 'acf_add_local_field_group' ) ) {
    require_once EDDY_THEME_DIR . '/inc/acf-fields.php';
}
