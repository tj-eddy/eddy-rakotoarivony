<?php
/**
 * Section Services — affiche les services depuis le CPT eddy_service.
 *
 * @package Eddy_Portfolio
 */

$section_title    = get_theme_mod( 'eddy_services_title', __( 'Mes Services', 'eddy-portfolio' ) );
$section_subtitle = get_theme_mod( 'eddy_services_subtitle', __( 'Développement sur-mesure, maintenance applicative et conseil technique pour vos projets web.', 'eddy-portfolio' ) );

// Requête CPT Services
$services_query = new WP_Query( [
    'post_type'      => 'eddy_service',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

// Icônes SVG par défaut par index (fallback si pas d'ACF)
$default_icons = [
    '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>',
    '<polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline>',
    '<circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>',
    '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>',
    '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>',
    '<circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line>',
];
?>
<section id="services" aria-labelledby="services-title" class="py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 reveal">
            <span class="text-sm font-semibold text-teal-600 uppercase tracking-widest">
                <?php esc_html_e( 'Ce que je fais', 'eddy-portfolio' ); ?>
            </span>
            <h2 id="services-title" class="text-3xl sm:text-4xl font-extrabold mt-2 mb-4" style="color:var(--color-text)">
                <?php echo esc_html( $section_title ); ?>
            </h2>
            <?php if ( $section_subtitle ) : ?>
            <p class="max-w-2xl mx-auto" style="color:var(--color-text-muted)">
                <?php echo wp_kses_post( $section_subtitle ); ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php if ( $services_query->have_posts() ) : ?>

                <?php $i = 0; while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                    <article class="service-card reveal">
                        <div class="service-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <?php echo wp_kses( $default_icons[ $i % count( $default_icons ) ], [ 'circle' => [ 'cx' => true, 'cy' => true, 'r' => true ], 'path' => [ 'd' => true ], 'line' => [ 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true ], 'polyline' => [ 'points' => true ], 'rect' => [ 'x' => true, 'y' => true, 'width' => true, 'height' => true ] ] ); ?>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2" style="color:var(--color-text)">
                            <?php the_title(); ?>
                        </h3>
                        <p class="text-sm leading-relaxed" style="color:var(--color-text-muted)">
                            <?php the_excerpt(); ?>
                        </p>
                    </article>
                <?php $i++; endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <!-- Fallback statique si aucun service en BDD -->
                <?php
                $static_services = [
                    [
                        'title'   => __( 'Développement PrestaShop', 'eddy-portfolio' ),
                        'excerpt' => __( 'Création de boutiques e-commerce PrestaShop sur-mesure, développement de modules, personnalisation de thèmes et optimisation des performances. Maîtrise des versions 1.7 à 8.x.', 'eddy-portfolio' ),
                        'icon'    => 0,
                    ],
                    [
                        'title'   => __( 'Développement Symfony', 'eddy-portfolio' ),
                        'excerpt' => __( "Développement d'applications web et d'APIs REST robustes avec Symfony 6/7. Architecture DDD, API Platform, tests automatisés et documentation OpenAPI intégrée.", 'eddy-portfolio' ),
                        'icon'    => 1,
                    ],
                    [
                        'title'   => __( 'Développement WordPress', 'eddy-portfolio' ),
                        'excerpt' => __( 'Création de sites WordPress sur-mesure, développement de thèmes et plugins, architecture headless avec l\'API REST, optimisation SEO et Core Web Vitals.', 'eddy-portfolio' ),
                        'icon'    => 2,
                    ],
                    [
                        'title'   => __( 'TMA – Tierce Maintenance Applicative', 'eddy-portfolio' ),
                        'excerpt' => __( 'Prise en charge complète de la maintenance corrective, évolutive et préventive de vos applications. SLA garantis, monitoring proactif et rapports mensuels détaillés.', 'eddy-portfolio' ),
                        'icon'    => 3,
                    ],
                    [
                        'title'   => __( 'Intégration & Performance Web', 'eddy-portfolio' ),
                        'excerpt' => __( 'Intégration pixel-perfect HTML5/CSS3, optimisation Core Web Vitals, audit de performance et mise en conformité RGPD. Scores Lighthouse 90+ garantis.', 'eddy-portfolio' ),
                        'icon'    => 4,
                    ],
                    [
                        'title'   => __( 'Conseil & Audit Technique', 'eddy-portfolio' ),
                        'excerpt' => __( "Audit de code, revue d'architecture, choix technologiques et accompagnement dans la transformation digitale. Rapports détaillés avec recommandations priorisées.", 'eddy-portfolio' ),
                        'icon'    => 5,
                    ],
                ];
                foreach ( $static_services as $service ) :
                ?>
                <article class="service-card reveal">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <?php echo wp_kses( $default_icons[ $service['icon'] ], [ 'circle' => [ 'cx' => true, 'cy' => true, 'r' => true ], 'path' => [ 'd' => true ], 'line' => [ 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true ], 'polyline' => [ 'points' => true ], 'rect' => [ 'x' => true, 'y' => true, 'width' => true, 'height' => true ] ] ); ?>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color:var(--color-text)">
                        <?php echo esc_html( $service['title'] ); ?>
                    </h3>
                    <p class="text-sm leading-relaxed" style="color:var(--color-text-muted)">
                        <?php echo esc_html( $service['excerpt'] ); ?>
                    </p>
                </article>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
</section>
