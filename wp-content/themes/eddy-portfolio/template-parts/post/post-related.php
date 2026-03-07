<?php
/**
 * Articles similaires — section full-width hors du flex principal.
 *
 * @package Eddy_Portfolio
 */

$categories = get_the_category();
if ( empty( $categories ) ) return;

$related = new WP_Query( [
    'posts_per_page'      => 3,
    'post__not_in'        => [ get_the_ID() ],
    'category__in'        => [ $categories[0]->term_id ],
    'orderby'             => 'rand',
    'ignore_sticky_posts' => true,
] );

if ( ! $related->have_posts() ) return;
?>
<section class="py-14" style="background:var(--color-bg-card);border-top:1px solid var(--color-border)" aria-labelledby="similar-title">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 id="similar-title" class="text-2xl font-extrabold mb-8" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
            <?php esc_html_e( 'Articles similaires', 'eddy-portfolio' ); ?>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                <?php get_template_part( 'template-parts/post/post', 'card' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
