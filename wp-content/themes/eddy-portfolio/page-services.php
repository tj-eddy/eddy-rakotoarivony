<?php
/**
 * page-services.php — Template page "Services"
 *
 * Template assigné à la page avec le slug "services".
 * Liste tous les CPT "services" sous forme de cards Tailwind.
 *
 * Sections :
 *  1. Hero / En-tête de page
 *  2. Grille des services (CPT)
 *  3. CTA → Contact
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

/*
 * Template Name: Page Services
 * Template Post Type: page
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<!-- ===== EN-TÊTE ===== -->
<section class="hero-gradient py-16 px-4" aria-labelledby="services-h1">
    <div class="max-w-3xl mx-auto text-center animate-on-scroll">
        <span class="inline-block bg-teal-100 text-teal-700 text-sm font-semibold px-3 py-1 rounded-full mb-4">
            <?php esc_html_e( 'Ce que je propose', 'eddy-portfolio' ); ?>
        </span>
        <h1 id="services-h1" class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <?php esc_html_e( 'Mes Services', 'eddy-portfolio' ); ?>
        </h1>
        <p class="text-lg text-gray-600 leading-relaxed">
            <?php esc_html_e( 'Des solutions web sur mesure adaptées à vos besoins : boutique e-commerce, site vitrine, application web ou maintenance.', 'eddy-portfolio' ); ?>
        </p>
    </div>
</section>


<!-- ===== LISTE DES SERVICES ===== -->
<section class="py-20 px-4 bg-white" aria-label="<?php esc_attr_e( 'Liste des services', 'eddy-portfolio' ); ?>">
    <div class="max-w-6xl mx-auto">

        <?php
        $services_query = new WP_Query( array(
            'post_type'      => 'services',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ) );
        ?>

        <?php if ( $services_query->have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <?php
                while ( $services_query->have_posts() ) :
                    $services_query->the_post();
                    get_template_part( 'template-parts/services', 'card' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

        <?php else : ?>
            <!-- Fallback : services statiques affichés si les CPT ne sont pas encore créés -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">

                <?php
                $static_services = array(
                    array(
                        'icon'     => '🛒',
                        'title'    => 'PrestaShop',
                        'color'    => 'bg-blue-50',
                        'slug'     => 'prestashop',
                        'features' => array(
                            __( 'Création de boutique from scratch', 'eddy-portfolio' ),
                            __( 'Développement de modules custom', 'eddy-portfolio' ),
                            __( 'Migration et mise à jour de version', 'eddy-portfolio' ),
                            __( 'Optimisation performances & SEO', 'eddy-portfolio' ),
                            __( 'Intégration de paiements sécurisés', 'eddy-portfolio' ),
                        ),
                        'desc' => __( 'Boutiques e-commerce PrestaShop performantes, sécurisées et optimisées pour convertir. De la création à la maintenance.', 'eddy-portfolio' ),
                    ),
                    array(
                        'icon'     => '🌐',
                        'title'    => 'WordPress',
                        'color'    => 'bg-purple-50',
                        'slug'     => 'wordpress',
                        'features' => array(
                            __( 'Sites vitrine & landing pages', 'eddy-portfolio' ),
                            __( 'Boutiques WooCommerce', 'eddy-portfolio' ),
                            __( 'Thèmes enfants personnalisés', 'eddy-portfolio' ),
                            __( 'Plugins sur mesure', 'eddy-portfolio' ),
                            __( 'Optimisation SEO (Yoast/Rank Math)', 'eddy-portfolio' ),
                        ),
                        'desc' => __( 'Sites WordPress professionnels, rapides et bien référencés. Du simple blog à la boutique WooCommerce avancée.', 'eddy-portfolio' ),
                    ),
                    array(
                        'icon'     => '⚡',
                        'title'    => 'Symfony',
                        'color'    => 'bg-orange-50',
                        'slug'     => 'symfony',
                        'features' => array(
                            __( 'Applications web sur mesure', 'eddy-portfolio' ),
                            __( 'API REST / RESTful', 'eddy-portfolio' ),
                            __( 'Intégration Doctrine ORM', 'eddy-portfolio' ),
                            __( 'Microservices et intégrations', 'eddy-portfolio' ),
                            __( 'Tests unitaires et fonctionnels', 'eddy-portfolio' ),
                        ),
                        'desc' => __( 'Applications web robustes et scalables avec le framework PHP Symfony. Architecture propre et maintenable.', 'eddy-portfolio' ),
                    ),
                    array(
                        'icon'     => '🔧',
                        'title'    => 'Maintenance',
                        'color'    => 'bg-green-50',
                        'slug'     => 'maintenance',
                        'features' => array(
                            __( 'Mises à jour CMS & plugins', 'eddy-portfolio' ),
                            __( 'Sauvegardes automatiques', 'eddy-portfolio' ),
                            __( 'Monitoring et alertes', 'eddy-portfolio' ),
                            __( 'Correction de bugs', 'eddy-portfolio' ),
                            __( 'Optimisation performances', 'eddy-portfolio' ),
                        ),
                        'desc' => __( 'Contrats de maintenance pour garder votre site sécurisé, performant et à jour. Intervention sous 24h.', 'eddy-portfolio' ),
                    ),
                );

                foreach ( $static_services as $svc ) :
                ?>
                <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 animate-on-scroll hover:shadow-lg transition duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-16 h-16 <?php echo esc_attr( $svc['color'] ); ?> rounded-xl flex items-center justify-center text-4xl flex-shrink-0" aria-hidden="true">
                            <?php echo esc_html( $svc['icon'] ); ?>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-1"><?php echo esc_html( $svc['title'] ); ?></h2>
                            <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( $svc['desc'] ); ?></p>
                        </div>
                    </div>
                    <ul class="space-y-2 mt-4 mb-6">
                        <?php foreach ( $svc['features'] as $feat ) : ?>
                        <li class="flex items-center gap-2 text-gray-600 text-sm">
                            <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <?php echo esc_html( $feat ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                       class="inline-block bg-teal-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-teal-700 transition duration-300 text-sm">
                        <?php esc_html_e( 'Demander un devis →', 'eddy-portfolio' ); ?>
                    </a>
                </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

        <!-- Processus de travail -->
        <div class="bg-teal-50 rounded-2xl p-8 md:p-12 animate-on-scroll">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                <?php esc_html_e( 'Comment ça se passe ?', 'eddy-portfolio' ); ?>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <?php
                $steps = array(
                    array( 'num' => '01', 'title' => __( 'Échange',       'eddy-portfolio' ), 'desc' => __( 'On discute de votre projet, vos besoins et vos objectifs.', 'eddy-portfolio' ) ),
                    array( 'num' => '02', 'title' => __( 'Devis',         'eddy-portfolio' ), 'desc' => __( 'Je vous envoie un devis détaillé et transparent.', 'eddy-portfolio' ) ),
                    array( 'num' => '03', 'title' => __( 'Développement', 'eddy-portfolio' ), 'desc' => __( 'Je développe avec des points d\'étape réguliers.', 'eddy-portfolio' ) ),
                    array( 'num' => '04', 'title' => __( 'Livraison',     'eddy-portfolio' ), 'desc' => __( 'Mise en ligne, formation et support post-lancement.', 'eddy-portfolio' ) ),
                );
                foreach ( $steps as $step ) :
                ?>
                <div class="text-center">
                    <div class="w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center text-lg font-bold mx-auto mb-3">
                        <?php echo esc_html( $step['num'] ); ?>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1"><?php echo esc_html( $step['title'] ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php echo esc_html( $step['desc'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>


<!-- ===== CTA ===== -->
<?php
get_template_part( 'template-parts/cta', 'section', array(
    'title' => __( 'Un projet en tête ?', 'eddy-portfolio' ),
    'text'  => __( 'Décrivez votre projet et obtenez un devis gratuit sous 24h.', 'eddy-portfolio' ),
    'label' => __( 'Demander un devis →', 'eddy-portfolio' ),
    'url'   => home_url( '/contact/' ),
) );
?>

<?php get_footer(); ?>
