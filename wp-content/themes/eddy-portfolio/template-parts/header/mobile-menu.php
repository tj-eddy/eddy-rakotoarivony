<?php
/**
 * Menu hamburger mobile.
 *
 * @package Eddy_Portfolio
 */
?>
<nav id="mobile-menu" role="navigation" aria-label="<?php esc_attr_e( 'Menu mobile', 'eddy-portfolio' ); ?>">
    <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-1">
        <?php if ( is_front_page() ) : ?>
            <a href="#services" class="nav-link block"><?php esc_html_e( 'Services', 'eddy-portfolio' ); ?></a>
            <a href="#actualites" class="nav-link block"><?php esc_html_e( 'Actualités', 'eddy-portfolio' ); ?></a>
            <a href="#contact" class="nav-link block"><?php esc_html_e( 'Contact', 'eddy-portfolio' ); ?></a>
        <?php else : ?>
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_class'     => 'flex flex-col gap-1',
                'container'      => false,
                'link_before'    => '<span class="nav-link block">',
                'link_after'     => '</span>',
                'fallback_cb'    => false,
            ] );
            ?>
        <?php endif; ?>
    </div>
</nav>
