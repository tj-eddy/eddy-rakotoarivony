<?php
/**
 * Section Services — affiche les 4 expertises depuis le CPT eddy_service.
 *
 * @package Eddy_Portfolio
 */

$section_title    = get_theme_mod( 'eddy_services_title', __( 'Mes Expertises', 'eddy-portfolio' ) );
$section_subtitle = get_theme_mod( 'eddy_services_subtitle', __( 'Solutions sur-mesure en développement web, e-commerce et maintenance applicative.', 'eddy-portfolio' ) );

// Icônes SVG de fallback indexées par ordre de menu (0-based)
$fallback_icons = [
    // PrestaShop — shopping-bag
    'M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z M3 6h18 M16 10a4 4 0 01-8 0',
    // WordPress — globe
    'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20 M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z',
    // Symfony — code-2
    'M4 17l6-6-6-6 M12 19h8',
    // TMA — wrench
    'M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z',
];

// Tags de fallback par index
$fallback_tags = [
    [ 'PrestaShop 8', 'Modules', 'E-commerce', 'PHP 8' ],
    [ 'WordPress 6', 'Headless', 'WooCommerce', 'SEO' ],
    [ 'Symfony 7', 'API Platform', 'PHP 8', 'Docker' ],
    [ 'TMA', 'SLA garanti', 'Monitoring', 'ITIL' ],
];

// Tags safe pour wp_kses (path, line, polyline, circle, rect, ellipse)
$svg_allowed = [
    'circle'   => [ 'cx' => true, 'cy' => true, 'r' => true ],
    'ellipse'  => [ 'cx' => true, 'cy' => true, 'rx' => true, 'ry' => true ],
    'line'     => [ 'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true ],
    'path'     => [ 'd' => true ],
    'polyline' => [ 'points' => true ],
    'rect'     => [ 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true ],
];

/**
 * Convertit une chaîne de paths SVG séparés par des espaces en balises <path>.
 * Les chemins sont séparés par la lettre 'M' (chaque nouveau sous-chemin).
 */
function eddy_render_svg_paths( string $paths, array $allowed ): string {
    // Chaque chemin commence par M — on split sur les espaces avant M
    $parts = preg_split( '/(?=\bM(?!\d))/', $paths, -1, PREG_SPLIT_NO_EMPTY );
    $output = '';
    foreach ( $parts as $part ) {
        $part = trim( $part );
        if ( $part ) {
            $output .= '<path d="' . esc_attr( $part ) . '"/>';
        }
    }
    return wp_kses( $output, $allowed );
}

$services_query = new WP_Query( [
    'post_type'      => 'eddy_service',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>
<section id="services" aria-labelledby="services-title" class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- En-tête de section -->
        <div class="text-center mb-14 reveal">
            <span class="inline-block text-xs font-semibold uppercase tracking-widest px-3 py-1 rounded-full mb-3"
                  style="background:rgba(15,118,110,0.1);color:var(--color-primary)">
                <?php esc_html_e( 'Ce que je fais', 'eddy-portfolio' ); ?>
            </span>
            <h2 id="services-title" class="text-3xl sm:text-4xl font-extrabold mt-1 mb-4" style="color:var(--color-text)">
                <?php echo esc_html( $section_title ); ?>
            </h2>
            <?php if ( $section_subtitle ) : ?>
            <p class="max-w-2xl mx-auto text-base" style="color:var(--color-text-muted)">
                <?php echo wp_kses_post( $section_subtitle ); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- Grille 4 services -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

            <?php if ( $services_query->have_posts() ) : ?>

                <?php $i = 0; while ( $services_query->have_posts() ) : $services_query->the_post(); ?>

                    <?php
                    $icon = get_post_meta( get_the_ID(), '_service_icon', true );
                    if ( ! $icon ) {
                        $icon = $fallback_icons[ $i % count( $fallback_icons ) ];
                    }
                    $tags = get_post_meta( get_the_ID(), '_service_tags', true );
                    if ( empty( $tags ) || ! is_array( $tags ) ) {
                        $tags = $fallback_tags[ $i % count( $fallback_tags ) ];
                    }
                    ?>

                    <article class="service-card reveal service-card-stacked" style="--card-delay:<?php echo $i; ?>">

                        <!-- Numéro décoratif -->
                        <span class="service-number" aria-hidden="true"><?php echo sprintf( '%02d', $i + 1 ); ?></span>

                        <!-- Icône -->
                        <div class="service-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <?php echo eddy_render_svg_paths( $icon, $svg_allowed ); ?>
                            </svg>
                        </div>

                        <!-- Titre -->
                        <h3 class="text-base font-bold mb-2" style="color:var(--color-text)">
                            <?php the_title(); ?>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-sm leading-relaxed" style="color:var(--color-text-muted)">
                            <?php the_excerpt(); ?>
                        </p>

                        <!-- Lien "En savoir plus" -->
                        <span class="service-more" aria-hidden="true">
                            <?php esc_html_e( 'En savoir plus', 'eddy-portfolio' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </span>

                        <!-- Tags tech -->
                        <div class="service-tags mt-auto flex flex-wrap gap-1.5">
                            <?php foreach ( array_slice( $tags, 0, 4 ) as $tag ) : ?>
                                <span class="service-tag"><?php echo esc_html( $tag ); ?></span>
                            <?php endforeach; ?>
                        </div>

                    </article>

                <?php $i++; endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <!-- Fallback statique si aucun service en BDD -->
                <?php
                $static_services = [
                    [
                        'title'   => __( 'Développement PrestaShop', 'eddy-portfolio' ),
                        'excerpt' => __( 'Boutiques e-commerce sur-mesure, modules métier, migrations et intégrations ERP/CRM. Versions 1.7 à 8.x, performances optimisées (Redis, WebP, CDN).', 'eddy-portfolio' ),
                        'icon'    => 0,
                        'tags'    => [ 'PrestaShop 8', 'Modules', 'E-commerce', 'PHP 8' ],
                    ],
                    [
                        'title'   => __( 'Développement WordPress', 'eddy-portfolio' ),
                        'excerpt' => __( 'Sites et applications WordPress sur-mesure, thèmes et plugins, architecture headless, optimisation SEO et Core Web Vitals 95+.', 'eddy-portfolio' ),
                        'icon'    => 1,
                        'tags'    => [ 'WordPress 6', 'Headless', 'WooCommerce', 'SEO' ],
                    ],
                    [
                        'title'   => __( 'Développement Symfony', 'eddy-portfolio' ),
                        'excerpt' => __( 'Applications web et APIs REST avec Symfony 6/7 et API Platform. Architecture DDD, auth JWT, documentation OpenAPI et CI/CD Docker.', 'eddy-portfolio' ),
                        'icon'    => 2,
                        'tags'    => [ 'Symfony 7', 'API Platform', 'PHP 8', 'Docker' ],
                    ],
                    [
                        'title'   => __( 'TMA — Tierce Maintenance', 'eddy-portfolio' ),
                        'excerpt' => __( 'Maintenance corrective, évolutive et préventive avec SLA garantis, monitoring 24/7 et cadre ITIL léger pour tout projet PHP.', 'eddy-portfolio' ),
                        'icon'    => 3,
                        'tags'    => [ 'TMA', 'SLA garanti', 'Monitoring', 'ITIL' ],
                    ],
                ];
                foreach ( $static_services as $j => $service ) : ?>

                <article class="service-card reveal service-card-stacked" style="--card-delay:<?php echo $j; ?>">
                    <span class="service-number" aria-hidden="true"><?php echo sprintf( '%02d', $j + 1 ); ?></span>
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <?php echo eddy_render_svg_paths( $fallback_icons[ $service['icon'] ], $svg_allowed ); ?>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold mb-2" style="color:var(--color-text)">
                        <?php echo esc_html( $service['title'] ); ?>
                    </h3>
                    <p class="text-sm leading-relaxed" style="color:var(--color-text-muted)">
                        <?php echo esc_html( $service['excerpt'] ); ?>
                    </p>
                    <span class="service-more" aria-hidden="true">
                        <?php esc_html_e( 'En savoir plus', 'eddy-portfolio' ); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </span>
                    <div class="service-tags mt-auto flex flex-wrap gap-1.5">
                        <?php foreach ( $service['tags'] as $tag ) : ?>
                            <span class="service-tag"><?php echo esc_html( $tag ); ?></span>
                        <?php endforeach; ?>
                    </div>
                </article>

                <?php endforeach; ?>

            <?php endif; ?>

        </div><!-- /.grid -->

    </div>
</section>
