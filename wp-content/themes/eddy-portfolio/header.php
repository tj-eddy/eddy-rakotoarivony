<?php
/**
 * header.php — En-tête commune du thème Eddy Portfolio
 *
 * Contient :
 *  - Déclaration DOCTYPE, head, balises meta SEO + Open Graph
 *  - Données structurées JSON-LD (Person / LocalBusiness)
 *  - Navbar sticky avec logo WordPress, menu principal,
 *    dropdown Services et menu burger mobile (jQuery)
 *
 * Appelé par get_header() dans chaque template.
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <?php /* JSON-LD Structured Data — Person + LocalBusiness (seulement sur la page d'accueil) */ ?>
    <?php if ( is_front_page() ) : ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": ["Person", "LocalBusiness"],
                "name": "Eddy RAKOTOARIVONY",
                "jobTitle": "<?php echo esc_js( __( 'Développeur Web Freelance', 'eddy-portfolio' ) ); ?>",
                "description": "<?php echo esc_js( __( 'Développeur web freelance spécialisé PrestaShop, WordPress et Symfony', 'eddy-portfolio' ) ); ?>",
                "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
                "email": "<?php echo esc_js( get_theme_mod( 'eddy_contact_email', 'contact@eddy-dev.fr' ) ); ?>",
                "address": {
                    "@type": "PostalAddress",
                    "addressCountry": "MG"
                },
                "sameAs": [
                    "<?php echo esc_url( get_theme_mod( 'eddy_social_linkedin', 'https://linkedin.com/in/eddy-rakotoarivony' ) ); ?>",
                    "<?php echo esc_url( get_theme_mod( 'eddy_social_github',   'https://github.com/eddy-rakotoarivony' ) ); ?>"
                ],
                "knowsAbout": ["PrestaShop", "WordPress", "Symfony", "PHP", "HTML5", "CSS3", "JavaScript", "jQuery", "Tailwind CSS"]
            }
        ]
    }
    </script>
    <?php endif; ?>
</head>
<body <?php body_class( 'bg-white font-sans text-gray-800' ); ?>>
<?php wp_body_open(); ?>

<!-- ===== NAVBAR ===== -->
<nav id="navbar" class="bg-white border-b border-teal-200 shadow-sm sticky top-0 z-50" role="navigation" aria-label="<?php esc_attr_e( 'Navigation principale', 'eddy-portfolio' ); ?>">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       class="text-teal-700 font-bold text-xl tracking-tight"
                       rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Menu desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <?php
                /**
                 * Menu principal via wp_nav_menu().
                 * Le walker WordPress génère un <ul> ; on le wrap avec un div invisible
                 * et on cible les <li> via le CSS Tailwind injecté ci-après.
                 */
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'flex items-center space-x-8',
                    'container'      => false,
                    'fallback_cb'    => 'eddy_fallback_menu',
                    'link_class'     => 'nav-link text-gray-700 hover:text-teal-600 font-medium transition duration-300',
                    'depth'          => 2,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s eddy-nav-list">%3$s</ul>',
                ) );
                ?>
            </div>

            <!-- Bouton burger mobile -->
            <button id="burger-btn"
                    class="md:hidden text-gray-700 hover:text-teal-600 p-2 rounded-md"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'eddy-portfolio' ); ?>">
                <svg id="burger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div><!-- /.flex -->

        <!-- Menu mobile -->
        <div id="mobile-menu"
             class="hidden md:hidden pb-4 border-t border-gray-100 mt-2"
             aria-label="<?php esc_attr_e( 'Menu mobile', 'eddy-portfolio' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'space-y-1',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 2,
                'items_wrap'     => '<ul id="%1$s" class="%2$s eddy-mobile-nav">%3$s</ul>',
            ) );
            ?>
        </div>

    </div><!-- /.max-w-7xl -->
</nav>
<!-- ===== / NAVBAR ===== -->

<?php
/**
 * Menu de repli (fallback) si aucun menu n'est assigné au thème.
 * Affiche les pages publiées de premier niveau.
 */
function eddy_fallback_menu() {
    echo '<ul class="flex items-center space-x-8 eddy-nav-list">';

    $pages = get_pages( array( 'sort_column' => 'menu_order', 'sort_order' => 'ASC' ) );
    foreach ( $pages as $page ) {
        $active = ( get_the_ID() === $page->ID ) ? ' text-teal-600 font-semibold border-b-2 border-teal-600' : '';
        echo '<li class="nav-item">';
        echo '<a href="' . esc_url( get_permalink( $page->ID ) ) . '" class="nav-link text-gray-700 hover:text-teal-600 font-medium transition duration-300' . $active . '">';
        echo esc_html( $page->post_title );
        echo '</a></li>';
    }

    // Lien "Blog"
    $blog_url = get_permalink( get_option( 'page_for_posts' ) );
    if ( $blog_url ) {
        echo '<li><a href="' . esc_url( $blog_url ) . '" class="nav-link text-gray-700 hover:text-teal-600 font-medium transition duration-300">Blog</a></li>';
    }

    echo '</ul>';
}
