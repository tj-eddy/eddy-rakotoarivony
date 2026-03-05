<?php
/**
 * Footer complet du site.
 *
 * @package Eddy_Portfolio
 */

$full_name = get_theme_mod( 'eddy_full_name', 'Eddy RAKOTOARIVONY' );
$tagline   = get_theme_mod( 'eddy_tagline', 'PrestaShop · Symfony · WordPress · TMA' );
$email     = get_theme_mod( 'eddy_email', '' );
$location  = get_theme_mod( 'eddy_location', 'Madagascar / Remote' );
$available = get_theme_mod( 'eddy_available_freelance', true );
?>
<footer role="contentinfo" class="py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-8">

            <!-- Identité -->
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <div class="w-8 h-8 rounded-full bg-teal-700 flex items-center justify-center text-white font-bold text-xs">ER</div>
                    <?php endif; ?>
                    <span class="font-bold" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
                        <?php echo esc_html( $full_name ); ?>
                    </span>
                </div>
                <p class="text-sm" style="color:var(--color-text-muted)">
                    <?php echo esc_html( 'Développeur Web Full-Stack freelance. ' . $tagline . '.' ); ?>
                </p>
            </div>

            <!-- Liens rapides -->
            <div>
                <h4 class="font-semibold text-sm mb-3" style="color:var(--color-text)">
                    <?php esc_html_e( 'Liens rapides', 'eddy-portfolio' ); ?>
                </h4>
                <?php if ( is_front_page() ) : ?>
                    <ul class="space-y-2">
                        <li><a href="#services" class="text-sm hover:text-teal-600 transition-colors" style="color:var(--color-text-muted)"><?php esc_html_e( 'Services', 'eddy-portfolio' ); ?></a></li>
                        <li><a href="#actualites" class="text-sm hover:text-teal-600 transition-colors" style="color:var(--color-text-muted)"><?php esc_html_e( 'Actualités', 'eddy-portfolio' ); ?></a></li>
                        <li><a href="#contact" class="text-sm hover:text-teal-600 transition-colors" style="color:var(--color-text-muted)"><?php esc_html_e( 'Contact', 'eddy-portfolio' ); ?></a></li>
                    </ul>
                <?php else : ?>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'footer',
                        'menu_class'     => 'space-y-2',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ] );
                    ?>
                <?php endif; ?>
            </div>

            <!-- Disponibilité -->
            <div>
                <h4 class="font-semibold text-sm mb-3" style="color:var(--color-text)">
                    <?php esc_html_e( 'Disponibilité', 'eddy-portfolio' ); ?>
                </h4>
                <?php if ( $available ) : ?>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-sm text-green-600 font-medium"><?php esc_html_e( 'Freelance disponible', 'eddy-portfolio' ); ?></span>
                    </div>
                <?php endif; ?>
                <p class="text-sm" style="color:var(--color-text-muted)">
                    <?php echo esc_html( $location ); ?> · UTC+3
                </p>
                <?php if ( $email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-sm text-teal-600 hover:underline mt-1 block">
                        <?php echo esc_html( $email ); ?>
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <div class="border-t pt-6 flex flex-col sm:flex-row justify-between items-center gap-3" style="border-color:var(--color-border)">
            <p class="text-sm" style="color:var(--color-text-muted)">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $full_name ); ?> &middot;
                <?php esc_html_e( 'Tous droits réservés', 'eddy-portfolio' ); ?>
            </p>
            <p class="text-sm" style="color:var(--color-text-muted)">
                <?php esc_html_e( 'Développé avec WordPress · Tailwind CSS · jQuery', 'eddy-portfolio' ); ?>
            </p>
        </div>
    </div>
</footer>
