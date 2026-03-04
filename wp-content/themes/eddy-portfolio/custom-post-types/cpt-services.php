<?php
/**
 * Custom Post Type : Services
 * Custom Post Type : Portfolio (réalisations)
 * Custom Taxonomy  : Service Category
 *
 * Enregistrés via l'action 'init' pour être disponibles partout.
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;


/* =============================================================================
   CPT : SERVICES
============================================================================= */

/**
 * Enregistre le CPT "services" avec les 4 services principaux du portfolio.
 *
 * Champs natifs utilisés :
 *  - Titre (nom du service)
 *  - Contenu (description longue)
 *  - Extrait (description courte pour les cards)
 *  - Image mise en avant (icône ou illustration)
 *  - Menu order (pour trier l'affichage)
 *
 * Meta custom (sans ACF) :
 *  - _service_icon   : emoji ou classe d'icône (ex. "🛒")
 *  - _service_color  : couleur Tailwind de la card (ex. "bg-teal-50")
 */
function eddy_register_cpt_services() {

    $labels = array(
        'name'                  => _x( 'Services',              'Post type general name', 'eddy-portfolio' ),
        'singular_name'         => _x( 'Service',               'Post type singular name', 'eddy-portfolio' ),
        'menu_name'             => _x( 'Services',              'Admin Menu text', 'eddy-portfolio' ),
        'name_admin_bar'        => _x( 'Service',               'Add New on Toolbar', 'eddy-portfolio' ),
        'add_new'               => __( 'Ajouter',               'eddy-portfolio' ),
        'add_new_item'          => __( 'Ajouter un service',    'eddy-portfolio' ),
        'new_item'              => __( 'Nouveau service',        'eddy-portfolio' ),
        'edit_item'             => __( 'Modifier le service',   'eddy-portfolio' ),
        'view_item'             => __( 'Voir le service',       'eddy-portfolio' ),
        'all_items'             => __( 'Tous les services',     'eddy-portfolio' ),
        'search_items'          => __( 'Rechercher',            'eddy-portfolio' ),
        'not_found'             => __( 'Aucun service trouvé.', 'eddy-portfolio' ),
        'not_found_in_trash'    => __( 'Corbeille vide.',       'eddy-portfolio' ),
        'featured_image'        => __( 'Illustration',          'eddy-portfolio' ),
        'set_featured_image'    => __( 'Définir l\'illustration','eddy-portfolio' ),
        'archives'              => __( 'Archive des services',  'eddy-portfolio' ),
    );

    $args = array(
        'labels'              => $labels,
        'description'         => __( 'Services proposés par Eddy RAKOTOARIVONY.', 'eddy-portfolio' ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'services' ),
        'capability_type'     => 'post',
        'has_archive'         => false, // La page /services est une page statique
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-cart',
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'show_in_rest'        => true, // Compatible Gutenberg
        'taxonomies'          => array( 'service-category' ),
    );

    register_post_type( 'services', $args );
}
add_action( 'init', 'eddy_register_cpt_services', 0 );


/* =============================================================================
   CPT : PORTFOLIO (RÉALISATIONS)
============================================================================= */

/**
 * Enregistre le CPT "portfolio" pour les réalisations / projets.
 *
 * Meta custom :
 *  - _portfolio_technologies : liste des techs (ex. "PrestaShop, PHP 8")
 *  - _portfolio_url          : URL du projet en ligne
 *  - _portfolio_github       : URL du dépôt GitHub
 *  - _portfolio_year         : Année de réalisation
 */
function eddy_register_cpt_portfolio() {

    $labels = array(
        'name'                  => _x( 'Réalisations',              'Post type general name', 'eddy-portfolio' ),
        'singular_name'         => _x( 'Réalisation',               'Post type singular name', 'eddy-portfolio' ),
        'menu_name'             => _x( 'Portfolio',                  'Admin Menu text', 'eddy-portfolio' ),
        'add_new'               => __( 'Ajouter',                    'eddy-portfolio' ),
        'add_new_item'          => __( 'Ajouter une réalisation',    'eddy-portfolio' ),
        'edit_item'             => __( 'Modifier la réalisation',    'eddy-portfolio' ),
        'view_item'             => __( 'Voir la réalisation',        'eddy-portfolio' ),
        'all_items'             => __( 'Toutes les réalisations',    'eddy-portfolio' ),
        'not_found'             => __( 'Aucune réalisation trouvée.','eddy-portfolio' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'eddy_register_cpt_portfolio', 0 );


/* =============================================================================
   CUSTOM TAXONOMY : SERVICE CATEGORY
============================================================================= */

/**
 * Enregistre la taxonomie "service-category" liée au CPT "services".
 */
function eddy_register_taxonomy_service_category() {

    $labels = array(
        'name'          => _x( 'Catégories de service', 'taxonomy general name', 'eddy-portfolio' ),
        'singular_name' => _x( 'Catégorie',              'taxonomy singular name', 'eddy-portfolio' ),
        'menu_name'     => __( 'Catégories',             'eddy-portfolio' ),
        'all_items'     => __( 'Toutes les catégories',  'eddy-portfolio' ),
        'edit_item'     => __( 'Modifier la catégorie',  'eddy-portfolio' ),
        'add_new_item'  => __( 'Nouvelle catégorie',     'eddy-portfolio' ),
        'not_found'     => __( 'Aucune catégorie.',      'eddy-portfolio' ),
    );

    register_taxonomy( 'service-category', array( 'services' ), array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'service-categorie' ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'eddy_register_taxonomy_service_category', 0 );


/* =============================================================================
   META BOX : CHAMPS SERVICE
============================================================================= */

/**
 * Ajoute une meta box "Détails du service" dans l'éditeur des services.
 */
function eddy_add_service_meta_box() {
    add_meta_box(
        'eddy_service_details',
        __( 'Détails du service', 'eddy-portfolio' ),
        'eddy_render_service_meta_box',
        'services',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'eddy_add_service_meta_box' );

/**
 * Affiche la meta box des services.
 *
 * @param WP_Post $post L'objet article courant.
 */
function eddy_render_service_meta_box( $post ) {
    wp_nonce_field( 'eddy_save_service_meta', 'eddy_service_nonce' );

    $icon        = get_post_meta( $post->ID, '_service_icon',         true );
    $color       = get_post_meta( $post->ID, '_service_color',        true );
    $badge_color = get_post_meta( $post->ID, '_service_badge_color',  true );
    $techs       = get_post_meta( $post->ID, '_service_technologies', true );
    $features    = get_post_meta( $post->ID, '_service_features',     true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="service_icon"><?php esc_html_e( 'Icône (emoji)', 'eddy-portfolio' ); ?></label></th>
            <td>
                <input type="text" id="service_icon" name="service_icon"
                       value="<?php echo esc_attr( $icon ); ?>" class="regular-text" placeholder="🛒">
                <p class="description"><?php esc_html_e( 'Emoji affiché dans la card et la page détail.', 'eddy-portfolio' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="service_color"><?php esc_html_e( 'Couleur fond card', 'eddy-portfolio' ); ?></label></th>
            <td>
                <select id="service_color" name="service_color">
                    <?php
                    $colors = array(
                        'bg-teal-50'   => 'Teal clair (défaut)',
                        'bg-blue-50'   => 'Bleu clair (PrestaShop)',
                        'bg-purple-50' => 'Violet clair (WordPress)',
                        'bg-orange-50' => 'Orange clair (Symfony)',
                        'bg-green-50'  => 'Vert clair (Maintenance)',
                    );
                    foreach ( $colors as $val => $lbl ) {
                        printf( '<option value="%s"%s>%s</option>',
                            esc_attr( $val ), selected( $color, $val, false ), esc_html( $lbl ) );
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="service_badge_color"><?php esc_html_e( 'Couleur badge (page détail)', 'eddy-portfolio' ); ?></label></th>
            <td>
                <select id="service_badge_color" name="service_badge_color">
                    <?php
                    $badge_colors = array(
                        'bg-teal-100 text-teal-700'     => 'Teal (défaut)',
                        'bg-blue-100 text-blue-700'     => 'Bleu (PrestaShop)',
                        'bg-purple-100 text-purple-700' => 'Violet (WordPress)',
                        'bg-orange-100 text-orange-700' => 'Orange (Symfony)',
                        'bg-green-100 text-green-700'   => 'Vert (Maintenance)',
                    );
                    foreach ( $badge_colors as $val => $lbl ) {
                        printf( '<option value="%s"%s>%s</option>',
                            esc_attr( $val ), selected( $badge_color, $val, false ), esc_html( $lbl ) );
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="service_technologies"><?php esc_html_e( 'Technologies', 'eddy-portfolio' ); ?></label></th>
            <td>
                <input type="text" id="service_technologies" name="service_technologies"
                       value="<?php echo esc_attr( $techs ); ?>" class="large-text"
                       placeholder="PrestaShop 8, PHP 8.x, MySQL, Git">
                <p class="description"><?php esc_html_e( 'Séparées par des virgules. Affiché en badges sur la page détail.', 'eddy-portfolio' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="service_features"><?php esc_html_e( 'Prestations (une par ligne)', 'eddy-portfolio' ); ?></label></th>
            <td>
                <textarea id="service_features" name="service_features" rows="6" class="large-text"
                          placeholder="🏗️ Création de boutique complète&#10;🧩 Modules sur mesure&#10;🚀 Migration & mise à jour"><?php echo esc_textarea( $features ); ?></textarea>
                <p class="description"><?php esc_html_e( 'Format : "emoji Titre" — une prestation par ligne. Affiché en grille sur la page détail.', 'eddy-portfolio' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Sauvegarde les meta du service lors de l'enregistrement de l'article.
 *
 * @param int $post_id ID de l'article.
 */
function eddy_save_service_meta( $post_id ) {
    // Vérifications de sécurité
    if ( ! isset( $_POST['eddy_service_nonce'] ) ) return;
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['eddy_service_nonce'] ) ), 'eddy_save_service_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Sauvegarde
    $fields = array(
        'service_icon'         => '_service_icon',
        'service_color'        => '_service_color',
        'service_badge_color'  => '_service_badge_color',
        'service_technologies' => '_service_technologies',
    );
    foreach ( $fields as $post_key => $meta_key ) {
        if ( isset( $_POST[ $post_key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) ) );
        }
    }
    if ( isset( $_POST['service_features'] ) ) {
        update_post_meta( $post_id, '_service_features', sanitize_textarea_field( wp_unslash( $_POST['service_features'] ) ) );
    }
}
add_action( 'save_post_services', 'eddy_save_service_meta' );
