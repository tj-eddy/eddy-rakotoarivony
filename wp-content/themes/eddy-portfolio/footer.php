<?php
/**
 * footer.php — Pied de page commun du thème Eddy Portfolio
 *
 * Contient :
 *  - Footer 4 colonnes : logo + réseaux sociaux, menu footer,
 *    liste services CPT, coordonnées Customizer
 *  - Barre de copyright avec année dynamique
 *  - wp_footer() requis pour les scripts WordPress
 *
 * Appelé par get_footer() dans chaque template.
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */
?>

<!-- ===== FOOTER ===== -->
<footer class="bg-teal-50 border-t border-teal-100" role="contentinfo">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Colonne 1 : Logo + description + réseaux sociaux -->
            <div>
                <?php if ( has_custom_logo() ) : ?>
                    <div class="mb-2"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       class="text-teal-700 font-bold text-xl" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                <?php endif; ?>

                <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                    <?php esc_html_e( 'Développeur Web Freelance spécialisé PrestaShop, WordPress &amp; Symfony.', 'eddy-portfolio' ); ?>
                </p>

                <!-- Réseaux sociaux -->
                <div class="mt-4 flex space-x-3">
                    <?php eddy_social_icons(); ?>
                </div>
            </div>

            <!-- Colonne 2 : Menu footer -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-4 text-sm uppercase tracking-wide">
                    <?php esc_html_e( 'Navigation', 'eddy-portfolio' ); ?>
                </h3>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'space-y-2 text-sm',
                    'container'      => false,
                    'depth'          => 1,
                    'fallback_cb'    => 'eddy_footer_fallback_menu',
                    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                    'link_class'     => 'text-gray-600 hover:text-teal-600 transition duration-300',
                ) );
                ?>
            </div>

            <!-- Colonne 3 : Services CPT (dynamique) -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-4 text-sm uppercase tracking-wide">
                    <?php esc_html_e( 'Services', 'eddy-portfolio' ); ?>
                </h3>
                <ul class="space-y-2 text-sm">
                    <?php
                    $services = new WP_Query( array(
                        'post_type'      => 'services',
                        'posts_per_page' => 6,
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    ) );
                    if ( $services->have_posts() ) :
                        while ( $services->have_posts() ) :
                            $services->the_post();
                            $icon = get_post_meta( get_the_ID(), '_service_icon', true );
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="text-gray-600 hover:text-teal-600 transition duration-300">
                                    <?php if ( $icon ) echo esc_html( $icon ) . ' '; ?>
                                    <?php the_title(); ?>
                                </a>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback statique si aucun CPT n'est encore créé
                        $static_services = array(
                            array( 'icon' => '🛒', 'label' => 'PrestaShop',  'slug' => 'prestashop' ),
                            array( 'icon' => '🌐', 'label' => 'WordPress',   'slug' => 'wordpress' ),
                            array( 'icon' => '⚡', 'label' => 'Symfony',     'slug' => 'symfony' ),
                            array( 'icon' => '🔧', 'label' => 'Maintenance', 'slug' => 'maintenance' ),
                        );
                        foreach ( $static_services as $s ) :
                            ?>
                            <li>
                                <a href="<?php echo esc_url( home_url( '/services/' . $s['slug'] ) ); ?>"
                                   class="text-gray-600 hover:text-teal-600 transition duration-300">
                                    <?php echo esc_html( $s['icon'] . ' ' . $s['label'] ); ?>
                                </a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>

            <!-- Colonne 4 : Coordonnées (Customizer) -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-4 text-sm uppercase tracking-wide">
                    <?php esc_html_e( 'Contact rapide', 'eddy-portfolio' ); ?>
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <?php
                    $email    = get_theme_mod( 'eddy_contact_email',    'contact@eddy-dev.fr' );
                    $location = get_theme_mod( 'eddy_contact_location', 'Madagascar / Remote' );
                    ?>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"
                           class="hover:text-teal-600 transition duration-300">
                            <?php echo esc_html( $email ); ?>
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span><?php echo esc_html( $location ); ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-teal-600 font-medium">
                            <?php esc_html_e( 'Disponible pour missions', 'eddy-portfolio' ); ?>
                        </span>
                    </li>
                </ul>
            </div>

        </div><!-- /.grid -->
    </div><!-- /.max-w-7xl -->

    <!-- Barre copyright -->
    <div class="border-t border-teal-200 py-4">
        <p class="text-center text-gray-600 text-sm">
            &copy; <?php echo esc_html( date( 'Y' ) ); ?>
            <?php bloginfo( 'name' ); ?> &mdash;
            <?php esc_html_e( 'Développeur Web Freelance. Tous droits réservés.', 'eddy-portfolio' ); ?>
        </p>
    </div>
</footer>
<!-- ===== / FOOTER ===== -->

<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Menu de repli pour le footer si aucun menu n'est assigné.
 * Affiche les principales pages du site.
 */
function eddy_footer_fallback_menu() {
    $links = array(
        home_url( '/' )           => __( 'Accueil',  'eddy-portfolio' ),
        home_url( '/a-propos' )   => __( 'À propos', 'eddy-portfolio' ),
        home_url( '/services' )   => __( 'Services', 'eddy-portfolio' ),
        home_url( '/blog' )       => __( 'Blog',     'eddy-portfolio' ),
        home_url( '/contact' )    => __( 'Contact',  'eddy-portfolio' ),
    );

    echo '<ul class="space-y-2 text-sm">';
    foreach ( $links as $url => $label ) {
        echo '<li><a href="' . esc_url( $url ) . '" class="text-gray-600 hover:text-teal-600 transition duration-300">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}
