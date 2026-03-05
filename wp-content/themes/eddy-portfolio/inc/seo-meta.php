<?php
/**
 * Génération des meta SEO dynamiques (Open Graph, Twitter Card, Schema.org).
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Injecte les balises meta SEO dans le <head>.
 *
 * @return void
 */
function eddy_seo_meta_tags() {

    global $post;

    // Titre et description dynamiques
    if ( is_singular() && $post ) {
        $title       = get_the_title( $post );
        $description = has_excerpt( $post )
            ? wp_strip_all_tags( get_the_excerpt( $post ) )
            : wp_trim_words( get_the_content(), 30, '...' );
        $image       = get_the_post_thumbnail_url( $post, 'eddy-hero' );
        $url         = get_permalink( $post );
    } else {
        $title       = get_bloginfo( 'name' ) . ' | ' . get_theme_mod( 'eddy_job_title', 'Développeur Web Full-Stack' );
        $description = get_theme_mod( 'eddy_meta_description', get_bloginfo( 'description' ) );
        $image       = get_theme_mod( 'eddy_og_image', '' );
        $url         = home_url( '/' );
    }

    // Fallback image OG
    if ( ! $image ) {
        $image = get_theme_mod( 'eddy_og_image', '' );
    }

    $site_name     = get_bloginfo( 'name' );
    $twitter_handle = get_theme_mod( 'eddy_schema_twitter', '' );

    ?>
    <!-- SEO — Eddy Portfolio -->
    <meta name="description" content="<?php echo esc_attr( $description ); ?>">
    <meta name="author" content="<?php echo esc_attr( get_theme_mod( 'eddy_full_name', 'Eddy RAKOTOARIVONY' ) ); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:locale" content="fr_FR">
    <?php if ( $image ) : ?>
    <meta property="og:image" content="<?php echo esc_url( $image ); ?>">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
    <?php if ( $image ) : ?>
    <meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
    <?php endif; ?>
    <?php if ( $twitter_handle ) : ?>
    <meta name="twitter:site" content="<?php echo esc_attr( $twitter_handle ); ?>">
    <?php endif; ?>

    <?php
    // Schema.org Person (page d'accueil uniquement)
    if ( is_front_page() ) :
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Person',
            'name'        => get_theme_mod( 'eddy_full_name', 'Eddy RAKOTOARIVONY' ),
            'jobTitle'    => get_theme_mod( 'eddy_job_title', 'Développeur Web Full-Stack' ),
            'description' => get_theme_mod( 'eddy_bio_short', '' ),
            'url'         => home_url( '/' ),
            'email'       => get_theme_mod( 'eddy_email', '' ),
            'address'     => [
                '@type'          => 'PostalAddress',
                'addressCountry' => 'MG',
                'addressLocality' => 'Madagascar',
            ],
            'knowsAbout'  => [ 'PrestaShop', 'Symfony', 'WordPress', 'PHP', 'MySQL', 'JavaScript', 'TMA' ],
            'sameAs'      => array_filter( [
                get_theme_mod( 'eddy_linkedin_url', '' ),
                get_theme_mod( 'eddy_github_url', '' ),
            ] ),
        ];
        ?>
    <script type="application/ld+json">
    <?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ); ?>
    </script>
    <?php endif; ?>
    <?php
}
add_action( 'wp_head', 'eddy_seo_meta_tags' );
