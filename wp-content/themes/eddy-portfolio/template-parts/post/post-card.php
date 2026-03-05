<?php
/**
 * Card article réutilisable (grille, carrousel).
 *
 * @package Eddy_Portfolio
 */

$categories = get_the_category();
$category   = ! empty( $categories ) ? $categories[0] : null;
?>
<article class="post-card">
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail( 'eddy-card', [ 'class' => 'post-card-img', 'loading' => 'lazy' ] ); ?>
        </a>
    <?php endif; ?>

    <div class="post-card-body">
        <?php if ( $category ) : ?>
            <a href="<?php echo esc_url( get_category_link( $category ) ); ?>" class="category-badge">
                <?php echo esc_html( $category->name ); ?>
            </a>
        <?php endif; ?>

        <h3 class="post-card-title">
            <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none">
                <?php the_title(); ?>
            </a>
        </h3>

        <p class="post-card-excerpt">
            <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
        </p>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:0.75rem;border-top:1px solid var(--color-border)">
            <span style="font-size:0.78rem;color:var(--color-text-muted)">
                <?php echo esc_html( get_the_date() ); ?>
            </span>
            <a href="<?php the_permalink(); ?>" class="btn-primary" style="padding:0.4rem 0.9rem;font-size:0.8rem">
                <?php esc_html_e( 'Lire la suite →', 'eddy-portfolio' ); ?>
            </a>
        </div>
    </div>
</article>
