<?php
/**
 * Navigation prev/next entre articles.
 *
 * @package Eddy_Portfolio
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( ! $prev_post && ! $next_post ) return;
?>
<nav class="post-nav" aria-label="<?php esc_attr_e( 'Navigation entre articles', 'eddy-portfolio' ); ?>">

    <?php if ( $prev_post ) : ?>
    <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="post-nav-item" rel="prev">
        <div class="text-xs font-semibold text-teal-600 mb-1">
            ← <?php esc_html_e( 'Article précédent', 'eddy-portfolio' ); ?>
        </div>
        <div class="text-sm font-medium" style="color:var(--color-text)">
            <?php echo esc_html( wp_trim_words( $prev_post->post_title, 10, '...' ) ); ?>
        </div>
    </a>
    <?php else : ?>
    <div></div>
    <?php endif; ?>

    <?php if ( $next_post ) : ?>
    <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="post-nav-item text-right" rel="next">
        <div class="text-xs font-semibold text-teal-600 mb-1">
            <?php esc_html_e( 'Article suivant', 'eddy-portfolio' ); ?> →
        </div>
        <div class="text-sm font-medium" style="color:var(--color-text)">
            <?php echo esc_html( wp_trim_words( $next_post->post_title, 10, '...' ) ); ?>
        </div>
    </a>
    <?php else : ?>
    <div></div>
    <?php endif; ?>

</nav>
