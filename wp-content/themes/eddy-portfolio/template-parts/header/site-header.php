<?php
/**
 * Header complet avec navigation principale.
 *
 * @package Eddy_Portfolio
 */
?>
<header id="main-header" role="banner" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo / Avatar -->
            <button id="logo-btn" class="flex items-center gap-3 hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-teal-600 rounded-lg p-1"
                    aria-label="<?php esc_attr_e( "Ouvrir le profil d'Eddy RAKOTOARIVONY", 'eddy-portfolio' ); ?>"
                    type="button">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="w-9 h-9 rounded-full bg-teal-700 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">ER</div>
                <?php endif; ?>
                <div class="hidden sm:block">
                    <div class="font-bold text-sm" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
                        <?php echo esc_html( get_theme_mod( 'eddy_full_name', 'Eddy RAKOTOARIVONY' ) ); ?>
                    </div>
                    <div class="text-xs" style="color:var(--color-text-muted)">
                        <?php echo esc_html( get_theme_mod( 'eddy_job_title', 'Développeur Web' ) ); ?>
                    </div>
                </div>
            </button>

            <!-- Navigation desktop -->
            <nav class="hidden md:flex items-center gap-1" aria-label="<?php esc_attr_e( 'Navigation principale', 'eddy-portfolio' ); ?>">
                <?php if ( is_front_page() ) : ?>
                    <a href="#services" class="nav-link"><?php esc_html_e( 'Services', 'eddy-portfolio' ); ?></a>
                    <a href="#actualites" class="nav-link"><?php esc_html_e( 'Actualités', 'eddy-portfolio' ); ?></a>
                    <a href="#contact" class="nav-link"><?php esc_html_e( 'Contact', 'eddy-portfolio' ); ?></a>
                <?php else : ?>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'primary',
                        'menu_class'     => 'flex items-center gap-1',
                        'container'      => false,
                        'link_before'    => '<span class="nav-link">',
                        'link_after'     => '</span>',
                        'fallback_cb'    => false,
                    ] );
                    ?>
                <?php endif; ?>
            </nav>

            <!-- Contrôles droite -->
            <div class="flex items-center gap-3">
                <!-- Toggle dark/light -->
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-yellow-500" aria-hidden="true">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <button id="theme-toggle" aria-label="<?php esc_attr_e( 'Basculer le mode sombre/clair', 'eddy-portfolio' ); ?>"></button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-400" aria-hidden="true">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </div>

                <!-- Hamburger mobile -->
                <button id="hamburger-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        aria-label="<?php esc_attr_e( 'Menu', 'eddy-portfolio' ); ?>"
                        aria-expanded="false" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="hidden" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <?php get_template_part( 'template-parts/header/mobile', 'menu' ); ?>
</header>
