<?php
/**
 * En-tête d'article : image hero, meta, titre.
 *
 * @package Eddy_Portfolio
 */

$categories  = get_the_category();
$category    = ! empty( $categories ) ? $categories[0] : null;
$techs       = get_the_terms( get_the_ID(), 'post_tech' );
$author_id   = get_the_author_meta( 'ID' );
$word_count  = str_word_count( wp_strip_all_tags( get_the_content() ) );
$read_min    = max( 1, (int) ceil( $word_count / 200 ) );
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
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <?php the_post_thumbnail( 'eddy-hero', [ 'class' => 'article-hero', 'loading' => 'eager' ] ); ?>
</div>
<?php endif; ?>

<!-- Meta + titre -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

    <!-- Badges catégorie + tags -->
    <div class="flex flex-wrap items-center gap-3 mb-5">
        <?php if ( $category ) : ?>
            <a href="<?php echo esc_url( get_category_link( $category ) ); ?>" class="category-badge">
                <?php echo esc_html( $category->name ); ?>
            </a>
        <?php endif; ?>
        <?php if ( $techs && ! is_wp_error( $techs ) ) : ?>
            <?php foreach ( $techs as $tech ) : ?>
                <a href="<?php echo esc_url( get_term_link( $tech ) ); ?>" class="tag-badge">
                    <?php echo esc_html( $tech->name ); ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Titre -->
    <h1 class="text-3xl sm:text-4xl font-extrabold mb-6 leading-tight" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
        <?php the_title(); ?>
    </h1>

    <!-- Meta auteur / date / temps de lecture -->
    <div class="flex flex-wrap items-center gap-4 pb-6 border-b" style="border-color:var(--color-border)">

        <!-- Avatar + auteur -->
        <div class="flex items-center gap-2">
            <div class="flex-shrink-0 w-9 h-9 rounded-full overflow-hidden ring-2" style="ring-color:var(--color-primary)">
                <?php echo get_avatar( $author_id, 36, '', get_the_author(), [ 'class' => 'w-full h-full object-cover' ] ); ?>
            </div>
            <span class="text-sm font-semibold" style="color:var(--color-text)">
                <?php the_author(); ?>
            </span>
        </div>

        <!-- Séparateur -->
        <span aria-hidden="true" style="color:var(--color-border)">·</span>

        <!-- Date -->
        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="text-sm" style="color:var(--color-text-muted)">
            <?php echo esc_html( get_the_date() ); ?>
        </time>

        <!-- Séparateur -->
        <span aria-hidden="true" style="color:var(--color-border)">·</span>

        <!-- Temps de lecture -->
        <span class="flex items-center gap-1 text-sm" style="color:var(--color-text-muted)" title="<?php esc_attr_e( 'Temps de lecture estimé', 'eddy-portfolio' ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <?php
            printf(
                /* translators: %d : nombre de minutes */
                esc_html( _n( '%d min de lecture', '%d min de lecture', $read_min, 'eddy-portfolio' ) ),
                $read_min
            );
            ?>
        </span>

    </div>
</div>
