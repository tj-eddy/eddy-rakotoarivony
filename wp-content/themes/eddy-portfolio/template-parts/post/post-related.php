<?php
/**
 * Articles similaires (même catégorie).
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
<div class="mt-12">
    <h3 class="text-xl font-bold mb-6" style="color:var(--color-text)">
        <?php esc_html_e( 'Articles similaires', 'eddy-portfolio' ); ?>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
            <?php get_template_part( 'template-parts/post/post', 'card' ); ?>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>
