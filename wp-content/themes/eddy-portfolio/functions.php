<?php
/**
 * Eddy Portfolio — functions.php
 *
 * Fichier principal du thème :
 *  - Enqueue scripts & styles
 *  - Supports du thème (logo, thumbnails, HTML5, Gutenberg…)
 *  - Menus de navigation
 *  - Sidebar blog
 *  - Custom Post Types (services, portfolio)
 *  - Custom Taxonomies (service-category)
 *  - Shortcodes ([contact_form], [services_list], [last_posts])
 *  - WordPress Customizer (couleurs, coordonnées, réseaux sociaux, hero)
 *  - AJAX handler pour le formulaire de contact
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* =============================================================================
   1. CONSTANTES DU THÈME
============================================================================= */

define( 'EDDY_VERSION', '1.0.0' );
define( 'EDDY_DIR',     get_template_directory() );
define( 'EDDY_URI',     get_template_directory_uri() );


/* =============================================================================
   2. SUPPORTS DU THÈME
============================================================================= */

/**
 * Déclare les fonctionnalités WordPress supportées par le thème.
 */
function eddy_setup() {

    // Gestion automatique de la balise <title>
    add_theme_support( 'title-tag' );

    // Images mises en avant sur les articles / CPT
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'eddy-thumbnail',  400, 250, true );
    add_image_size( 'eddy-featured',   800, 400, true );
    add_image_size( 'eddy-hero',      1200, 630, true );

    // Logo personnalisé via Customizer
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Balises HTML5 sémantiques
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Compatibilité Gutenberg (styles de blocs)
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    // Couleurs de blocs Gutenberg
    add_theme_support( 'editor-color-palette', array(
        array( 'name' => __( 'Teal primaire', 'eddy-portfolio' ), 'slug' => 'teal-600', 'color' => '#0d9488' ),
        array( 'name' => __( 'Teal clair',    'eddy-portfolio' ), 'slug' => 'teal-50',  'color' => '#f0fdfa' ),
        array( 'name' => __( 'Gris sombre',   'eddy-portfolio' ), 'slug' => 'gray-800', 'color' => '#1f2937' ),
    ) );

    // Menus de navigation
    register_nav_menus( array(
        'primary' => __( 'Menu principal', 'eddy-portfolio' ),
        'footer'  => __( 'Menu footer',    'eddy-portfolio' ),
    ) );

    // Traductions
    load_theme_textdomain( 'eddy-portfolio', EDDY_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'eddy_setup' );


/* =============================================================================
   3. ENQUEUE SCRIPTS & STYLES
============================================================================= */

/**
 * Charge les feuilles de style et scripts du thème.
 */
function eddy_enqueue_assets() {

    // --- Styles ---
    // Tailwind CSS via CDN (pour la production, préférer une compilation locale)
    wp_enqueue_style(
        'tailwindcss',
        'https://cdn.tailwindcss.com',
        array(),
        null
    );

    // Feuille de style personnalisée du thème
    wp_enqueue_style(
        'eddy-custom',
        EDDY_URI . '/assets/css/custom.css',
        array( 'tailwindcss' ),
        EDDY_VERSION
    );

    // --- Scripts ---
    // jQuery (version WordPress incluse)
    wp_enqueue_script( 'jquery' );

    // Script principal du thème
    wp_enqueue_script(
        'eddy-main',
        EDDY_URI . '/assets/js/main.js',
        array( 'jquery' ),
        EDDY_VERSION,
        true // chargé dans le footer
    );

    // Localisation JS : URL AJAX + nonce
    wp_localize_script( 'eddy-main', 'eddyAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'eddy_contact_nonce' ),
        'homeUrl' => esc_url( home_url( '/' ) ),
    ) );

    // Styles des commentaires (uniquement sur les articles)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'eddy_enqueue_assets' );


/* =============================================================================
   4. SIDEBAR BLOG
============================================================================= */

/**
 * Enregistre la sidebar pour le blog.
 */
function eddy_register_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Sidebar Blog', 'eddy-portfolio' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Widgets affichés dans la sidebar des articles.', 'eddy-portfolio' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-6 bg-white rounded-xl shadow-sm p-5 border border-gray-100">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="font-bold text-gray-800 text-base mb-3 pb-2 border-b border-gray-100">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'eddy_register_sidebars' );


/* =============================================================================
   5. CUSTOM POST TYPES
============================================================================= */

// Inclure les fichiers CPT
require_once EDDY_DIR . '/custom-post-types/cpt-services.php';


/* =============================================================================
   6. SHORTCODES
============================================================================= */

/**
 * Shortcode [contact_form] — affiche le formulaire de contact AJAX.
 */
function eddy_shortcode_contact_form() {
    ob_start();
    get_template_part( 'page', 'contact' );
    // On retourne uniquement le formulaire, pas toute la page
    return '<p>' . __( 'Utilisez la page de contact pour accéder au formulaire.', 'eddy-portfolio' ) . '</p>';
}
add_shortcode( 'contact_form', 'eddy_shortcode_contact_form' );

/**
 * Shortcode [services_list] — liste les CPT services.
 *
 * Usage : [services_list count="4"]
 */
function eddy_shortcode_services_list( $atts ) {
    $atts = shortcode_atts( array( 'count' => 4 ), $atts, 'services_list' );

    $query = new WP_Query( array(
        'post_type'      => 'services',
        'posts_per_page' => (int) $atts['count'],
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ) );

    if ( ! $query->have_posts() ) {
        return '';
    }

    ob_start();
    echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">';
    while ( $query->have_posts() ) {
        $query->the_post();
        get_template_part( 'template-parts/services', 'card' );
    }
    wp_reset_postdata();
    echo '</div>';

    return ob_get_clean();
}
add_shortcode( 'services_list', 'eddy_shortcode_services_list' );

/**
 * Shortcode [last_posts count="3"] — derniers articles du blog.
 */
function eddy_shortcode_last_posts( $atts ) {
    $atts = shortcode_atts( array( 'count' => 3 ), $atts, 'last_posts' );

    $query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => (int) $atts['count'],
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    if ( ! $query->have_posts() ) {
        return '';
    }

    ob_start();
    echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">';
    while ( $query->have_posts() ) {
        $query->the_post();
        get_template_part( 'template-parts/blog', 'card' );
    }
    wp_reset_postdata();
    echo '</div>';

    return ob_get_clean();
}
add_shortcode( 'last_posts', 'eddy_shortcode_last_posts' );


/* =============================================================================
   7. AJAX — FORMULAIRE DE CONTACT
============================================================================= */

/**
 * Traitement AJAX du formulaire de contact (connecté + non-connecté).
 */
function eddy_handle_contact_form() {

    // Vérification du nonce
    check_ajax_referer( 'eddy_contact_nonce', 'nonce' );

    // Récupération et sanitisation des données
    $nom     = sanitize_text_field( wp_unslash( $_POST['nom']     ?? '' ) );
    $email   = sanitize_email(      wp_unslash( $_POST['email']   ?? '' ) );
    $tel     = sanitize_text_field( wp_unslash( $_POST['tel']     ?? '' ) );
    $sujet   = sanitize_text_field( wp_unslash( $_POST['sujet']   ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    // Validation serveur
    $errors = array();
    if ( empty( $nom ) )                      { $errors[] = __( 'Le nom est requis.',           'eddy-portfolio' ); }
    if ( ! is_email( $email ) )               { $errors[] = __( 'L\'email est invalide.',       'eddy-portfolio' ); }
    if ( empty( $sujet ) )                    { $errors[] = __( 'Le sujet est requis.',          'eddy-portfolio' ); }
    if ( mb_strlen( $message ) < 10 )         { $errors[] = __( 'Le message est trop court.',   'eddy-portfolio' ); }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 'errors' => $errors ) );
    }

    // Envoi de l'email
    $to      = get_theme_mod( 'eddy_contact_email', get_option( 'admin_email' ) );
    $subject = sprintf( '[Eddy Dev] %s — %s', esc_html( $sujet ), esc_html( $nom ) );
    $body    = sprintf(
        "Nom : %s\nEmail : %s\nTéléphone : %s\nSujet : %s\n\nMessage :\n%s",
        $nom, $email, $tel ?: 'Non renseigné', $sujet, $message
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . sanitize_email( $email ),
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => __( 'Message envoyé avec succès !', 'eddy-portfolio' ) ) );
    } else {
        wp_send_json_error( array( 'errors' => array( __( 'Erreur lors de l\'envoi. Veuillez réessayer.', 'eddy-portfolio' ) ) ) );
    }
}
add_action( 'wp_ajax_eddy_contact',        'eddy_handle_contact_form' );
add_action( 'wp_ajax_nopriv_eddy_contact', 'eddy_handle_contact_form' );


/* =============================================================================
   8. WORDPRESS CUSTOMIZER
============================================================================= */

/**
 * Ajoute les panneaux, sections et contrôles au Customizer WordPress.
 *
 * Sections créées :
 *  - eddy_hero        : Texte de la section Hero
 *  - eddy_contact     : Coordonnées de contact
 *  - eddy_social      : Liens réseaux sociaux
 *  - eddy_colors      : Personnalisation des couleurs
 */
function eddy_customize_register( $wp_customize ) {

    /* ---- PANNEAU GÉNÉRAL ---- */
    $wp_customize->add_panel( 'eddy_panel', array(
        'title'    => __( 'Eddy Portfolio', 'eddy-portfolio' ),
        'priority' => 30,
    ) );

    // ----------------------------------------------------------------
    // Section Hero
    // ----------------------------------------------------------------
    $wp_customize->add_section( 'eddy_hero', array(
        'title' => __( 'Section Hero', 'eddy-portfolio' ),
        'panel' => 'eddy_panel',
    ) );

    $hero_fields = array(
        'eddy_hero_badge'    => array( 'label' => __( 'Badge disponibilité', 'eddy-portfolio' ), 'default' => __( 'Développeur Web Freelance disponible', 'eddy-portfolio' ) ),
        'eddy_hero_title'    => array( 'label' => __( 'Titre principal',     'eddy-portfolio' ), 'default' => __( 'Bonjour, je suis Eddy\nJe crée des sites web qui performent', 'eddy-portfolio' ) ),
        'eddy_hero_subtitle' => array( 'label' => __( 'Sous-titre',          'eddy-portfolio' ), 'default' => __( 'Spécialisé PrestaShop, WordPress & Symfony — je transforme vos idées en expériences digitales professionnelles.', 'eddy-portfolio' ) ),
        'eddy_hero_cta1'     => array( 'label' => __( 'Texte bouton CTA 1', 'eddy-portfolio' ), 'default' => __( 'Démarrer un projet', 'eddy-portfolio' ) ),
        'eddy_hero_cta2'     => array( 'label' => __( 'Texte bouton CTA 2', 'eddy-portfolio' ), 'default' => __( 'Voir mes services', 'eddy-portfolio' ) ),
    );

    foreach ( $hero_fields as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'eddy_hero', 'type' => 'text' ) );
    }

    // ----------------------------------------------------------------
    // Section Contact
    // ----------------------------------------------------------------
    $wp_customize->add_section( 'eddy_contact', array(
        'title' => __( 'Coordonnées', 'eddy-portfolio' ),
        'panel' => 'eddy_panel',
    ) );

    $contact_fields = array(
        'eddy_contact_email'    => array( 'label' => __( 'Email',       'eddy-portfolio' ), 'default' => 'contact@eddy-dev.fr',   'sanitize' => 'sanitize_email' ),
        'eddy_contact_phone'    => array( 'label' => __( 'Téléphone',   'eddy-portfolio' ), 'default' => '',                       'sanitize' => 'sanitize_text_field' ),
        'eddy_contact_location' => array( 'label' => __( 'Localisation','eddy-portfolio' ), 'default' => 'Madagascar / Remote',    'sanitize' => 'sanitize_text_field' ),
    );

    foreach ( $contact_fields as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => $args['sanitize'] ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'eddy_contact', 'type' => 'text' ) );
    }

    // ----------------------------------------------------------------
    // Section Réseaux sociaux
    // ----------------------------------------------------------------
    $wp_customize->add_section( 'eddy_social', array(
        'title' => __( 'Réseaux sociaux', 'eddy-portfolio' ),
        'panel' => 'eddy_panel',
    ) );

    $social_fields = array(
        'eddy_social_linkedin'  => array( 'label' => 'LinkedIn',  'default' => 'https://linkedin.com/in/eddy-rakotoarivony' ),
        'eddy_social_github'    => array( 'label' => 'GitHub',    'default' => 'https://github.com/eddy-rakotoarivony' ),
        'eddy_social_whatsapp'  => array( 'label' => 'WhatsApp',  'default' => '' ),
    );

    foreach ( $social_fields as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'eddy_social', 'type' => 'url' ) );
    }

    // ----------------------------------------------------------------
    // Section Couleurs
    // ----------------------------------------------------------------
    $wp_customize->add_section( 'eddy_colors', array(
        'title' => __( 'Couleurs du thème', 'eddy-portfolio' ),
        'panel' => 'eddy_panel',
    ) );

    $wp_customize->add_setting( 'eddy_color_primary', array(
        'default'           => '#0d9488',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eddy_color_primary', array(
        'label'   => __( 'Couleur primaire (teal)', 'eddy-portfolio' ),
        'section' => 'eddy_colors',
    ) ) );
}
add_action( 'customize_register', 'eddy_customize_register' );


/* =============================================================================
   9. HELPERS RÉUTILISABLES
============================================================================= */

/**
 * Retourne la couleur de catégorie blog sous forme de classes Tailwind.
 *
 * @param  string $category_name Nom de la catégorie.
 * @return string Classes CSS Tailwind.
 */
function eddy_get_category_color( $category_name ) {
    $colors = array(
        'PrestaShop'  => 'bg-blue-100 text-blue-700',
        'WordPress'   => 'bg-purple-100 text-purple-700',
        'Symfony'     => 'bg-orange-100 text-orange-700',
        'Maintenance' => 'bg-green-100 text-green-700',
        'Conseils'    => 'bg-teal-100 text-teal-700',
    );
    return $colors[ $category_name ] ?? 'bg-teal-100 text-teal-700';
}

/**
 * Estime le temps de lecture d'un article.
 *
 * @param  int $post_id ID de l'article.
 * @return string       Ex. : "5 min de lecture".
 */
function eddy_reading_time( $post_id = null ) {
    $content    = get_post_field( 'post_content', $post_id ?? get_the_ID() );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    $minutes    = max( 1, (int) round( $word_count / 200 ) );
    return sprintf(
        /* translators: %d : nombre de minutes */
        _n( '%d min de lecture', '%d min de lecture', $minutes, 'eddy-portfolio' ),
        $minutes
    );
}

/**
 * Affiche les icônes de réseaux sociaux (footer / contact).
 *
 * @param  string $class Classes CSS supplémentaires pour le <a>.
 */
function eddy_social_icons( $class = '' ) {
    $linkedin  = get_theme_mod( 'eddy_social_linkedin',  'https://linkedin.com/in/eddy-rakotoarivony' );
    $github    = get_theme_mod( 'eddy_social_github',    'https://github.com/eddy-rakotoarivony' );
    $whatsapp  = get_theme_mod( 'eddy_social_whatsapp',  '' );
    $link_class = esc_attr( 'text-gray-400 hover:text-teal-600 transition duration-300 ' . $class );
    ?>
    <?php if ( $linkedin ) : ?>
    <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="<?php echo $link_class; ?>">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
    </a>
    <?php endif; ?>
    <?php if ( $github ) : ?>
    <a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="<?php echo $link_class; ?>">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
    </a>
    <?php endif; ?>
    <?php if ( $whatsapp ) : ?>
    <a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="<?php echo $link_class; ?>">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>
    <?php endif; ?>
    <?php
}

/**
 * Injecte les variables de couleur du Customizer dans le <head>.
 */
function eddy_customizer_css() {
    $primary = get_theme_mod( 'eddy_color_primary', '#0d9488' );
    if ( $primary !== '#0d9488' ) {
        echo '<style id="eddy-custom-colors">:root{--color-primary:' . sanitize_hex_color( $primary ) . ';}</style>';
    }
}
add_action( 'wp_head', 'eddy_customizer_css' );


/* =============================================================================
   10. SEO & BALISES META OPEN GRAPH
============================================================================= */

/**
 * Ajoute les balises Open Graph dans le <head> si Yoast/Rank Math n'est pas actif.
 */
function eddy_open_graph_tags() {
    if ( function_exists( 'wpseo_head' ) || function_exists( 'rank_math_head' ) ) {
        return; // Yoast SEO ou Rank Math gère déjà les OG tags
    }

    $og_title  = wp_title( '|', false, 'right' ) . get_bloginfo( 'name' );
    $og_desc   = get_bloginfo( 'description' );
    $og_url    = esc_url( ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
    $og_image  = '';

    if ( is_singular() && has_post_thumbnail() ) {
        $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id(), 'eddy-hero' );
        $og_image  = $thumb ? esc_url( $thumb[0] ) : '';
        $og_desc   = get_the_excerpt();
        $og_title  = get_the_title();
    }

    echo '<meta property="og:type"        content="website" />' . "\n";
    echo '<meta property="og:title"       content="' . esc_attr( $og_title ) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $og_desc ) . '" />' . "\n";
    echo '<meta property="og:url"         content="' . $og_url . '" />' . "\n";
    if ( $og_image ) {
        echo '<meta property="og:image" content="' . $og_image . '" />' . "\n";
    }
}
add_action( 'wp_head', 'eddy_open_graph_tags', 5 );


/* =============================================================================
   11. PAGINATION PERSONNALISÉE (compatibilité Tailwind)
============================================================================= */

/**
 * Filtre les arguments de the_posts_pagination pour appliquer les classes Tailwind.
 *
 * @param  array $args Arguments de paginate_links().
 * @return array
 */
function eddy_pagination_args( $args ) {
    $args['prev_text'] = '&larr; ' . __( 'Précédent', 'eddy-portfolio' );
    $args['next_text'] = __( 'Suivant', 'eddy-portfolio' ) . ' &rarr;';
    return $args;
}
add_filter( 'the_posts_pagination_args', 'eddy_pagination_args' );
