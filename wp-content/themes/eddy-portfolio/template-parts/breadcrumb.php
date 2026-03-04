<?php
/**
 * template-parts/breadcrumb.php — Fil d'Ariane réutilisable
 *
 * Affiche un breadcrumb accessible avec :
 *  - Schema.org BreadcrumbList (JSON-LD)
 *  - Compatibilité Yoast SEO (breadcrumb Yoast si disponible)
 *  - Fallback natif WordPress
 *
 * Utilisation dans les templates :
 *   get_template_part( 'template-parts/breadcrumb' );
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

// Si Yoast SEO gère le breadcrumb, on lui délègue
if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb(
        '<nav class="bg-gray-50 border-b border-gray-100 py-3 px-4" aria-label="' . esc_attr__( 'Fil d\'Ariane', 'eddy-portfolio' ) . '">
            <div class="max-w-6xl mx-auto breadcrumb flex items-center gap-2 flex-wrap">',
        '</div></nav>'
    );
    return;
}

// Fil d'Ariane natif
$items = array();

// Accueil
$items[] = array(
    'name' => __( 'Accueil', 'eddy-portfolio' ),
    'url'  => home_url( '/' ),
);

if ( is_singular() ) {
    // Archives de la catégorie parente (articles)
    if ( is_singular( 'post' ) ) {
        $categories = get_the_category();
        if ( $categories ) {
            $cat = $categories[0];
            $items[] = array(
                'name' => __( 'Blog', 'eddy-portfolio' ),
                'url'  => get_permalink( get_option( 'page_for_posts' ) ),
            );
            if ( $cat->parent ) {
                $items[] = array(
                    'name' => esc_html( get_term( $cat->parent, 'category' )->name ),
                    'url'  => esc_url( get_category_link( $cat->parent ) ),
                );
            }
            $items[] = array(
                'name' => esc_html( $cat->name ),
                'url'  => esc_url( get_category_link( $cat->term_id ) ),
            );
        }
    }
    // Service page
    if ( is_singular( 'services' ) ) {
        $items[] = array(
            'name' => __( 'Services', 'eddy-portfolio' ),
            'url'  => home_url( '/services/' ),
        );
    }
    // Titre de l'article courant (dernier élément, sans lien)
    $items[] = array( 'name' => get_the_title(), 'url' => '' );

} elseif ( is_category() ) {
    $items[] = array(
        'name' => __( 'Blog', 'eddy-portfolio' ),
        'url'  => get_permalink( get_option( 'page_for_posts' ) ),
    );
    $items[] = array( 'name' => single_cat_title( '', false ), 'url' => '' );

} elseif ( is_tag() ) {
    $items[] = array(
        'name' => __( 'Blog', 'eddy-portfolio' ),
        'url'  => get_permalink( get_option( 'page_for_posts' ) ),
    );
    $items[] = array( 'name' => single_tag_title( '', false ), 'url' => '' );

} elseif ( is_archive() ) {
    $items[] = array( 'name' => get_the_archive_title(), 'url' => '' );

} elseif ( is_search() ) {
    $items[] = array(
        /* translators: %s : terme recherché */
        'name' => sprintf( __( 'Recherche : %s', 'eddy-portfolio' ), get_search_query() ),
        'url'  => '',
    );

} elseif ( is_404() ) {
    $items[] = array( 'name' => __( 'Page introuvable', 'eddy-portfolio' ), 'url' => '' );

} elseif ( is_page() ) {
    // Pages parentes
    $ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
    foreach ( $ancestors as $ancestor ) {
        $items[] = array(
            'name' => get_the_title( $ancestor ),
            'url'  => get_permalink( $ancestor ),
        );
    }
    $items[] = array( 'name' => get_the_title(), 'url' => '' );
}

// JSON-LD BreadcrumbList
$ld_items = array();
foreach ( $items as $i => $item ) {
    $ld_items[] = array(
        '@type'    => 'ListItem',
        'position' => $i + 1,
        'name'     => $item['name'],
        'item'     => $item['url'] ?: ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
    );
}
?>

<!-- Breadcrumb JSON-LD -->
<script type="application/ld+json">
<?php echo wp_json_encode( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => $ld_items,
), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
</script>

<!-- Breadcrumb HTML -->
<nav class="bg-gray-50 border-b border-gray-100 py-3 px-4"
     aria-label="<?php esc_attr_e( 'Fil d\'Ariane', 'eddy-portfolio' ); ?>">
    <div class="max-w-6xl mx-auto breadcrumb flex items-center gap-2 flex-wrap">
        <?php foreach ( $items as $index => $item ) : ?>
            <?php if ( $index < count( $items ) - 1 ) : ?>
                <a href="<?php echo esc_url( $item['url'] ); ?>">
                    <?php echo esc_html( $item['name'] ); ?>
                </a>
                <span aria-hidden="true">›</span>
            <?php else : ?>
                <span class="text-gray-800 font-medium text-sm" aria-current="page">
                    <?php echo esc_html( $item['name'] ); ?>
                </span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</nav>
