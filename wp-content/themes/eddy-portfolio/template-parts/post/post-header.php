<?php
/**
 * En-tête d'article : image hero, meta, titre.
 *
 * @package Eddy_Portfolio
 */

$categories = get_the_category();
$category   = ! empty( $categories ) ? $categories[0] : null;
$techs      = get_the_terms( get_the_ID(), 'post_tech' );
?>
<!-- Fil d'Ariane -->
<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Fil d\'Ariane', 'eddy-portfolio' ); ?>">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'eddy-portfolio' ); ?></a>
        <span aria-hidden="true"> / </span>
        <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'eddy-portfolio' ); ?></a>
        <span aria-hidden="true"> / </span>
        <span aria-current="page"><?php the_title(); ?></span>
    </div>
</nav>

<!-- Image hero -->
<?php if ( has_post_thumbnail() ) : ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <?php the_post_thumbnail( 'eddy-hero', [ 'class' => 'article-hero', 'loading' => 'eager' ] ); ?>
</div>
<?php endif; ?>

<!-- Meta + titre -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="flex flex-wrap items-center gap-3 mb-4">
        <?php if ( $category ) : ?>
            <a href="<?php echo esc_url( get_category_link( $category ) ); ?>" class="category-badge">
                <?php echo esc_html( $category->name ); ?>
            </a>
        <?php endif; ?>
        <span class="text-sm" style="color:var(--color-text-muted)">
            <?php echo esc_html( get_the_date() ); ?>
        </span>
        <span class="text-sm" style="color:var(--color-text-muted)">
            · <?php echo esc_html( get_the_author() ); ?>
        </span>
    </div>

    <h1 class="text-3xl sm:text-4xl font-extrabold mb-6 leading-tight" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
        <?php the_title(); ?>
    </h1>

    <?php if ( $techs && ! is_wp_error( $techs ) ) : ?>
    <div class="flex flex-wrap gap-2 mb-6">
        <?php foreach ( $techs as $tech ) : ?>
            <a href="<?php echo esc_url( get_term_link( $tech ) ); ?>" class="tag-badge">
                <?php echo esc_html( $tech->name ); ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
