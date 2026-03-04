<?php
/**
 * single-services.php — Détail d'un service (CPT "services")
 *
 * Template chargé par WordPress pour post_type=services.
 * Reproduit le design des pages service-*.html du portfolio HTML.
 *
 * Données utilisées :
 *  - Titre, extrait, contenu (Gutenberg)
 *  - _service_icon          : emoji icône
 *  - _service_color         : classe bg Tailwind (bg-teal-50, bg-blue-50…)
 *  - _service_badge_color   : classes badge (bg-blue-100 text-blue-700…)
 *  - _service_technologies  : liste techs séparées par virgule
 *  - _service_features      : prestations, une par ligne
 *
 * Fallbacks par slug pour un rendu immédiat sans configuration.
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );

if ( ! have_posts() ) {
    get_footer();
    return;
}
the_post();

/* --- Récupération des meta --- */
$icon        = get_post_meta( get_the_ID(), '_service_icon',         true );
$bg_color    = get_post_meta( get_the_ID(), '_service_color',        true );
$badge_color = get_post_meta( get_the_ID(), '_service_badge_color',  true );
$techs_raw   = get_post_meta( get_the_ID(), '_service_technologies', true );
$features_raw= get_post_meta( get_the_ID(), '_service_features',     true );

/* --- Fallbacks par slug --- */
$slug = get_post()->post_name;

$slug_defaults = array(
    'prestashop' => array(
        'icon'        => '🛒',
        'bg_color'    => 'bg-blue-50',
        'badge_color' => 'bg-blue-100 text-blue-700',
        'badge_label' => __( 'Service E-commerce', 'eddy-portfolio' ),
        'hero_bg'     => 'bg-blue-50',
        'technologies'=> 'PrestaShop 1.7 / 8, PHP 7.4 / 8.x, Smarty / Twig, MySQL, HTML5 / CSS3, JavaScript / jQuery, Stripe / PayPal, Git',
        'features'    => "🏗️ Création de boutique complète\n🧩 Modules sur mesure\n🎨 Personnalisation de thème\n🚀 Migration & mise à jour vers PS8\n🔍 Optimisation SEO e-commerce\n🛡️ Sécurisation & dépannage",
    ),
    'wordpress'  => array(
        'icon'        => '🌐',
        'bg_color'    => 'bg-purple-50',
        'badge_color' => 'bg-purple-100 text-purple-700',
        'badge_label' => __( 'Site Vitrine / Blog / E-commerce', 'eddy-portfolio' ),
        'hero_bg'     => 'bg-purple-50',
        'technologies'=> 'WordPress 6.x, PHP 8+, WooCommerce, Elementor / Gutenberg, Yoast SEO / Rank Math, HTML5 / CSS3, jQuery, MySQL',
        'features'    => "🏗️ Création de site vitrine & landing page\n🛍️ Boutiques WooCommerce\n🎨 Thèmes enfants personnalisés\n🧩 Plugins sur mesure\n🔍 Optimisation SEO avancée\n🛡️ Sécurisation & hardening",
    ),
    'symfony'    => array(
        'icon'        => '⚡',
        'bg_color'    => 'bg-orange-50',
        'badge_color' => 'bg-orange-100 text-orange-700',
        'badge_label' => __( 'Application Web sur mesure', 'eddy-portfolio' ),
        'hero_bg'     => 'bg-orange-50',
        'technologies'=> 'Symfony 6 / 7, PHP 8+, Doctrine ORM, API Platform, Twig, MySQL / PostgreSQL, REST API, PHPUnit',
        'features'    => "⚙️ Applications web sur mesure\n🔌 API REST / RESTful\n🗃️ Intégration Doctrine ORM\n🔗 Microservices & intégrations\n✅ Tests unitaires & fonctionnels\n📦 Déploiement & CI/CD",
    ),
    'maintenance'=> array(
        'icon'        => '🔧',
        'bg_color'    => 'bg-green-50',
        'badge_color' => 'bg-green-100 text-green-700',
        'badge_label' => __( 'Maintenance & Support', 'eddy-portfolio' ),
        'hero_bg'     => 'bg-green-50',
        'technologies'=> 'WordPress, PrestaShop, Symfony, cPanel / Plesk, SSH / FTP, Git, UptimeRobot, Google Search Console',
        'features'    => "🔄 Mises à jour CMS, thèmes & plugins\n💾 Sauvegardes automatiques\n📊 Monitoring & alertes\n🐛 Correction de bugs\n⚡ Optimisation performances\n🛡️ Audit sécurité mensuel",
    ),
);

$defaults     = $slug_defaults[ $slug ] ?? array(
    'icon'        => '⚙️',
    'bg_color'    => 'bg-teal-50',
    'badge_color' => 'bg-teal-100 text-teal-700',
    'badge_label' => __( 'Service Web', 'eddy-portfolio' ),
    'hero_bg'     => 'bg-teal-50',
    'technologies'=> 'PHP, MySQL, HTML5, CSS3, JavaScript',
    'features'    => '',
);

$icon        = $icon        ?: $defaults['icon'];
$bg_color    = $bg_color    ?: $defaults['bg_color'];
$badge_color = $badge_color ?: $defaults['badge_color'];
$hero_bg     = $defaults['hero_bg'];
$badge_label = $defaults['badge_label'];

$technologies = $techs_raw    ?: $defaults['technologies'];
$features_str = $features_raw ?: $defaults['features'];

$techs    = array_filter( array_map( 'trim', explode( ',', $technologies ) ) );
$features = array_filter( array_map( 'trim', explode( "\n", $features_str ) ) );

$excerpt = get_the_excerpt();
if ( ! $excerpt ) {
    $excerpt = wp_trim_words( get_the_content(), 30, '…' );
}
?>

<!-- ===== HERO SERVICE ===== -->
<section class="<?php echo esc_attr( $hero_bg ); ?> py-16 px-4" aria-labelledby="service-h1">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- Texte hero -->
            <div class="animate-on-scroll">
                <span class="inline-block <?php echo esc_attr( $badge_color ); ?> text-sm font-semibold px-3 py-1 rounded-full mb-4">
                    <?php echo esc_html( $badge_label ); ?>
                </span>
                <h1 id="service-h1" class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                    <?php the_title(); ?>
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    <?php echo esc_html( $excerpt ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                   class="inline-block bg-teal-600 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-teal-700 transition duration-300">
                    <?php esc_html_e( 'Demander un devis gratuit →', 'eddy-portfolio' ); ?>
                </a>
            </div>

            <!-- Illustration / Image -->
            <div class="animate-on-scroll text-center">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', array(
                        'class'   => 'rounded-2xl shadow-lg w-full max-w-sm mx-auto',
                        'alt'     => esc_attr( get_the_title() ),
                        'loading' => 'eager',
                    ) ); ?>
                <?php else : ?>
                    <div class="w-full max-w-sm mx-auto rounded-2xl shadow-lg <?php echo esc_attr( $bg_color ); ?> border border-white flex items-center justify-center"
                         style="height:280px; font-size:8rem;">
                        <?php echo esc_html( $icon ); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>


<!-- ===== CE QUE JE PROPOSE ===== -->
<?php if ( ! empty( $features ) || get_the_content() ) : ?>
<section class="py-20 px-4 bg-white" aria-labelledby="features-title">
    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-12 animate-on-scroll">
            <h2 id="features-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Ce que je propose', 'eddy-portfolio' ); ?>
            </h2>
            <p class="text-gray-500">
                <?php printf(
                    /* translators: %s : nom du service */
                    esc_html__( 'Une gamme complète de services %s pour votre projet.', 'eddy-portfolio' ),
                    esc_html( get_the_title() )
                ); ?>
            </p>
        </div>

        <?php if ( ! empty( $features ) ) : ?>
        <!-- Grille des prestations (depuis meta _service_features) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <?php foreach ( $features as $feature ) :
                // Format: "emoji Titre\nDescription" OU "emoji Titre" seul
                $parts = explode( "\n", $feature, 2 );
                $title_raw = trim( $parts[0] );
                $desc      = isset( $parts[1] ) ? trim( $parts[1] ) : '';

                // Extrait l'emoji (premier caractère si c'est un emoji UTF-8)
                preg_match( '/^(\X{1,2})\s+(.+)/u', $title_raw, $m );
                $feat_icon  = $m[1] ?? '✅';
                $feat_title = $m[2] ?? $title_raw;
            ?>
            <div class="bg-gray-50 rounded-xl p-6 animate-on-scroll flex items-start gap-4">
                <div class="text-3xl flex-shrink-0" aria-hidden="true"><?php echo esc_html( $feat_icon ); ?></div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-1"><?php echo esc_html( $feat_title ); ?></h3>
                    <?php if ( $desc ) : ?>
                    <p class="text-gray-600 text-sm leading-relaxed"><?php echo esc_html( $desc ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( get_the_content() ) : ?>
        <!-- Contenu Gutenberg (description longue, FAQ, etc.) -->
        <div class="article-body prose max-w-none animate-on-scroll">
            <?php the_content(); ?>
        </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>


<!-- ===== TECHNOLOGIES ===== -->
<?php if ( ! empty( $techs ) ) : ?>
<section class="py-16 px-4 bg-teal-50" aria-labelledby="techs-title">
    <div class="max-w-4xl mx-auto text-center">
        <h2 id="techs-title" class="text-2xl font-bold text-gray-800 mb-8 animate-on-scroll">
            <?php esc_html_e( 'Technologies utilisées', 'eddy-portfolio' ); ?>
        </h2>
        <div class="flex flex-wrap justify-center gap-3 animate-on-scroll">
            <?php foreach ( $techs as $tech ) : ?>
                <span class="tech-badge"><?php echo esc_html( $tech ); ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ===== RÉALISATIONS (CPT Portfolio) ===== -->
<?php
$portfolio_query = new WP_Query( array(
    'post_type'      => 'portfolio',
    'posts_per_page' => 3,
    'orderby'        => 'rand',
    'meta_query'     => array(
        'relation' => 'OR',
        array( 'key' => '_portfolio_technologies', 'value' => ucfirst( $slug ), 'compare' => 'LIKE' ),
        array( 'key' => '_portfolio_technologies', 'value' => get_the_title(), 'compare' => 'LIKE' ),
    ),
) );

if ( $portfolio_query->have_posts() ) :
?>
<section class="py-20 px-4 bg-white" aria-labelledby="realisations-title">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 id="realisations-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Exemples de réalisations', 'eddy-portfolio' ); ?>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
            <div class="bg-gray-50 rounded-xl overflow-hidden shadow-sm animate-on-scroll hover:shadow-md transition duration-300">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'eddy-thumbnail', array(
                        'class'   => 'w-full h-48 object-cover',
                        'loading' => 'lazy',
                        'alt'     => esc_attr( get_the_title() ),
                    ) ); ?>
                <?php endif; ?>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 mb-1"><?php the_title(); ?></h3>
                    <p class="text-gray-500 text-sm"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <?php $proj_url = get_post_meta( get_the_ID(), '_portfolio_url', true ); ?>
                    <?php if ( $proj_url ) : ?>
                        <a href="<?php echo esc_url( $proj_url ); ?>" target="_blank" rel="noopener noreferrer"
                           class="mt-3 inline-block text-teal-600 text-sm font-medium hover:underline">
                            <?php esc_html_e( 'Voir le projet →', 'eddy-portfolio' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ===== AUTRES SERVICES ===== -->
<?php
$other_services = new WP_Query( array(
    'post_type'      => 'services',
    'posts_per_page' => 3,
    'post__not_in'   => array( get_the_ID() ),
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( $other_services->have_posts() ) :
?>
<section class="py-16 px-4 bg-gray-50" aria-labelledby="other-services-title">
    <div class="max-w-5xl mx-auto">
        <h2 id="other-services-title" class="text-2xl font-bold text-gray-800 mb-8 text-center animate-on-scroll">
            <?php esc_html_e( 'Mes autres services', 'eddy-portfolio' ); ?>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php while ( $other_services->have_posts() ) :
                $other_services->the_post();
                get_template_part( 'template-parts/services', 'card' );
            endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ===== CTA ===== -->
<?php
get_template_part( 'template-parts/cta', 'section', array(
    'title' => sprintf(
        /* translators: %s : nom du service */
        __( 'Prêt pour votre projet %s ?', 'eddy-portfolio' ),
        get_the_title()
    ),
    'text'  => __( 'Contactez-moi pour un devis gratuit et sans engagement.', 'eddy-portfolio' ),
    'label' => __( 'Demander un devis gratuit →', 'eddy-portfolio' ),
    'url'   => home_url( '/contact/' ),
) );
?>

<?php get_footer(); ?>
