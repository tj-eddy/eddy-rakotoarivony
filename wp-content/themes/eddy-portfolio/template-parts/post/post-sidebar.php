<?php
/**
 * Sidebar de l'article : auteur, articles récents, catégories, newsletter.
 *
 * @package Eddy_Portfolio
 */

$author_id   = get_the_author_meta( 'ID' );
$author_desc = get_the_author_meta( 'description' );

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

// Toutes les catégories avec leurs counts
$all_cats = get_categories( [
    'hide_empty' => true,
    'orderby'    => 'count',
    'order'      => 'DESC',
    'number'     => 6,
] );
?>

<!-- ===== Carte auteur ===== -->
<div class="sidebar-card text-center">
    <div class="flex justify-center mb-3">
        <?php echo get_avatar( $author_id, 80, '', get_the_author(), [ 'class' => 'w-20 h-20 rounded-full object-cover' ] ); ?>
    </div>
    <h3 class="font-bold text-sm mb-1" style="color:var(--color-text)">
        <?php the_author(); ?>
    </h3>
    <p class="text-xs font-medium mb-3" style="color:var(--color-primary)">
        <?php esc_html_e( 'Développeur Web Full-Stack', 'eddy-portfolio' ); ?>
    </p>
    <?php if ( $author_desc ) : ?>
    <p class="text-xs leading-relaxed mb-4" style="color:var(--color-text-muted)">
        <?php echo esc_html( wp_trim_words( $author_desc, 20, '...' ) ); ?>
    </p>
    <?php else : ?>
    <p class="text-xs leading-relaxed mb-4" style="color:var(--color-text-muted)">
        <?php esc_html_e( 'Développeur web freelance spécialisé PrestaShop, Symfony et WordPress. Basé à Madagascar, disponible en remote.', 'eddy-portfolio' ); ?>
    </p>
    <?php endif; ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary w-full justify-center" style="font-size:0.8rem;padding:0.5rem 1rem">
        <?php esc_html_e( 'Voir le portfolio', 'eddy-portfolio' ); ?>
    </a>
</div>

<!-- ===== Articles récents ===== -->
<?php if ( $recent_posts->have_posts() ) : ?>
<div class="sidebar-card">
    <h3 class="font-bold text-sm mb-4" style="color:var(--color-text)">
        <?php esc_html_e( 'Articles récents', 'eddy-portfolio' ); ?>
    </h3>
    <ul class="space-y-3">
        <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>" class="flex gap-3 group">
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
            </a>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
    </ul>
</div>
<?php endif; ?>

<!-- ===== Catégories ===== -->
<?php if ( ! empty( $all_cats ) ) : ?>
<div class="sidebar-card">
    <h3 class="font-bold text-sm mb-4" style="color:var(--color-text)">
        <?php esc_html_e( 'Catégories', 'eddy-portfolio' ); ?>
    </h3>
    <ul class="space-y-2">
        <?php foreach ( $all_cats as $cat ) : ?>
        <li class="flex justify-between items-center">
            <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>"
               class="text-sm hover:text-teal-600 transition-colors"
               style="color:var(--color-text-muted)">
                <?php echo esc_html( $cat->name ); ?>
            </a>
            <span class="text-xs px-2 py-0.5 rounded-full" style="background:var(--color-bg);color:var(--color-text-muted)">
                <?php echo (int) $cat->count; ?>
            </span>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<!-- ===== Newsletter ===== -->
<!-- <div class="sidebar-card" style="background:rgba(15,118,110,0.05);border-color:rgba(15,118,110,0.2)">
    <h3 class="font-bold text-sm mb-2" style="color:var(--color-text)">
        <?php esc_html_e( 'Newsletter', 'eddy-portfolio' ); ?>
    </h3>
    <p class="text-xs mb-3" style="color:var(--color-text-muted)">
        <?php esc_html_e( 'Recevez les derniers articles techniques directement dans votre boîte mail.', 'eddy-portfolio' ); ?>
    </p>
    <div class="flex flex-col gap-2">
        <input type="email" class="contact-input" placeholder="votre@email.com"
               aria-label="<?php esc_attr_e( 'Email newsletter', 'eddy-portfolio' ); ?>"
               style="font-size:0.8rem;padding:0.5rem 0.75rem">
        <button class="btn-primary justify-center" style="font-size:0.8rem;padding:0.5rem" type="button">
            <?php esc_html_e( 'S\'abonner', 'eddy-portfolio' ); ?>
        </button>
    </div>
</div> -->

<!-- Widgets sidebar WordPress (optionnel) -->
<?php if ( is_active_sidebar( 'sidebar-post' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-post' ); ?>
<?php endif; ?>
