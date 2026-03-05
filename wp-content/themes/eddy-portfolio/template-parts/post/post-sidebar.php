<?php
/**
 * Sidebar de l'article : table des matières, articles récents, tags.
 *
 * @package Eddy_Portfolio
 */

// Articles récents (même catégorie si possible)
$recent_args = [
    'posts_per_page'      => 4,
    'post__not_in'        => [ get_the_ID() ],
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
];

$categories = get_the_category();
if ( ! empty( $categories ) ) {
    $recent_args['category__in'] = [ $categories[0]->term_id ];
}

$recent_posts = new WP_Query( $recent_args );
?>
<aside class="sidebar-sticky">

    <!-- Articles récents -->
    <?php if ( $recent_posts->have_posts() ) : ?>
    <div class="sidebar-card">
        <h4 class="text-sm font-bold mb-4" style="color:var(--color-text)">
            <?php esc_html_e( 'Articles récents', 'eddy-portfolio' ); ?>
        </h4>
        <div class="space-y-3">
            <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="block group">
                <div class="flex gap-3">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="flex-shrink-0 w-16 h-12 rounded overflow-hidden">
                        <?php the_post_thumbnail( 'eddy-thumb', [ 'class' => 'w-full h-full object-cover', 'loading' => 'lazy' ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div>
                        <p class="text-sm font-medium leading-snug group-hover:text-teal-600 transition-colors" style="color:var(--color-text)">
                            <?php echo wp_trim_words( get_the_title(), 8, '...' ); ?>
                        </p>
                        <p class="text-xs mt-1" style="color:var(--color-text-muted)"><?php echo esc_html( get_the_date() ); ?></p>
                    </div>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Tags / Technologies -->
    <?php
    $techs = get_the_terms( get_queried_object_id(), 'post_tech' );
    if ( $techs && ! is_wp_error( $techs ) ) :
    ?>
    <div class="sidebar-card">
        <h4 class="text-sm font-bold mb-4" style="color:var(--color-text)">
            <?php esc_html_e( 'Technologies', 'eddy-portfolio' ); ?>
        </h4>
        <div class="flex flex-wrap gap-2">
            <?php foreach ( $techs as $tech ) : ?>
                <a href="<?php echo esc_url( get_term_link( $tech ) ); ?>" class="tag-badge">
                    <?php echo esc_html( $tech->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Widgets sidebar -->
    <?php if ( is_active_sidebar( 'sidebar-post' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-post' ); ?>
    <?php endif; ?>

    <!-- CTA Contact -->
    <div class="sidebar-card text-center">
        <div class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center mx-auto mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-teal-700" aria-hidden="true">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,12 2,6"></polyline>
            </svg>
        </div>
        <p class="text-sm font-semibold mb-2" style="color:var(--color-text)">
            <?php esc_html_e( 'Un projet ? Parlons-en !', 'eddy-portfolio' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn-primary text-sm" style="width:100%;justify-content:center">
            <?php esc_html_e( 'Me contacter', 'eddy-portfolio' ); ?>
        </a>
    </div>

</aside>
