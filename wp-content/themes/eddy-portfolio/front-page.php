<?php
/**
 * front-page.php — Page d'accueil du thème Eddy Portfolio
 *
 * Template activé automatiquement lorsque :
 *  - "Page d'accueil statique" est configurée dans Réglages > Lecture, OU
 *  - le blog affiche les derniers articles (WordPress utilise front-page.php en priorité)
 *
 * Sections :
 *  1. Hero            — Titre, sous-titre, CTA (Customizer)
 *  2. Services        — CPT "services" (4 cards)
 *  3. À propos        — Texte + stats + photo
 *  4. Technologies    — Badges tech
 *  5. Blog            — 3 derniers articles
 *  6. CTA             — Lien vers la page Contact
 *
 * SEO :
 *  - Données structurées JSON-LD Person + LocalBusiness (dans header.php)
 *  - Titre H1 unique dans la section Hero
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
?>

<!-- ===== 1. HERO ===== -->
<section class="hero-gradient py-24 px-4" aria-labelledby="hero-title">
    <div class="max-w-5xl mx-auto text-center">

        <!-- Badge disponibilité -->
        <span class="inline-block bg-teal-100 text-teal-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-6">
            <?php echo esc_html( get_theme_mod( 'eddy_hero_badge', __( 'Développeur Web Freelance disponible', 'eddy-portfolio' ) ) ); ?>
        </span>

        <!-- Titre H1 -->
        <h1 id="hero-title" class="text-4xl md:text-6xl font-bold text-gray-800 mb-6 leading-tight">
            <?php esc_html_e( 'Bonjour, je suis', 'eddy-portfolio' ); ?>
            <span class="text-teal-600"><?php bloginfo( 'name' ); ?></span><br>
            <?php esc_html_e( 'Je crée des sites web', 'eddy-portfolio' ); ?>
            <span class="text-teal-600"><?php esc_html_e( 'qui performent', 'eddy-portfolio' ); ?></span>
        </h1>

        <!-- Sous-titre -->
        <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
            <?php echo esc_html( get_theme_mod( 'eddy_hero_subtitle',
                __( 'Spécialisé PrestaShop, WordPress & Symfony — je transforme vos idées en expériences digitales professionnelles, optimisées SEO et prêtes à convertir.', 'eddy-portfolio' )
            ) ); ?>
        </p>

        <!-- Boutons CTA -->
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
               class="bg-teal-600 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-teal-700 transition duration-300 shadow-md">
                <?php echo esc_html( get_theme_mod( 'eddy_hero_cta1', __( 'Démarrer un projet', 'eddy-portfolio' ) ) ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"
               class="border-2 border-teal-600 text-teal-600 px-8 py-3.5 rounded-xl font-semibold hover:bg-teal-50 transition duration-300">
                <?php echo esc_html( get_theme_mod( 'eddy_hero_cta2', __( 'Voir mes services', 'eddy-portfolio' ) ) ); ?>
            </a>
        </div>

    </div>
</section>
<!-- ===== / HERO ===== -->


<!-- ===== 2. SERVICES ===== -->
<section class="py-20 px-4 bg-white" aria-labelledby="services-title">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-14 animate-on-scroll">
            <h2 id="services-title" class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Mes Services', 'eddy-portfolio' ); ?>
            </h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto">
                <?php esc_html_e( 'Des solutions web sur mesure pour tous vos besoins digitaux.', 'eddy-portfolio' ); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $services_query = new WP_Query( array(
                'post_type'      => 'services',
                'posts_per_page' => 4,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );

            if ( $services_query->have_posts() ) :
                while ( $services_query->have_posts() ) :
                    $services_query->the_post();
                    get_template_part( 'template-parts/services', 'card' );
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback statique (avant création des CPT)
                $fallback_services = array(
                    array( 'icon' => '🛒', 'title' => 'PrestaShop',  'desc' => __( 'Création et personnalisation de boutiques e-commerce PrestaShop performantes.', 'eddy-portfolio' ),   'slug' => 'prestashop' ),
                    array( 'icon' => '🌐', 'title' => 'WordPress',   'desc' => __( 'Sites vitrine, blogs et WooCommerce élégants et optimisés pour le SEO.', 'eddy-portfolio' ),         'slug' => 'wordpress' ),
                    array( 'icon' => '⚡', 'title' => 'Symfony',     'desc' => __( 'Applications web sur mesure robustes et scalables avec le framework PHP Symfony.', 'eddy-portfolio' ), 'slug' => 'symfony' ),
                    array( 'icon' => '🔧', 'title' => 'Maintenance', 'desc' => __( 'Suivi, mises à jour et optimisation continue de votre site web.', 'eddy-portfolio' ),                 'slug' => 'maintenance' ),
                );
                foreach ( $fallback_services as $svc ) :
                    ?>
                    <a href="<?php echo esc_url( home_url( '/services/' . $svc['slug'] ) ); ?>"
                       class="service-card bg-white rounded-xl shadow-md p-6 hover:shadow-lg border border-gray-100 animate-on-scroll block">
                        <div class="w-14 h-14 bg-teal-50 rounded-xl flex items-center justify-center mb-4 text-3xl" aria-hidden="true">
                            <?php echo esc_html( $svc['icon'] ); ?>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2"><?php echo esc_html( $svc['title'] ); ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html( $svc['desc'] ); ?></p>
                        <span class="mt-4 inline-block text-teal-600 font-medium text-sm hover:underline">
                            <?php esc_html_e( 'En savoir plus →', 'eddy-portfolio' ); ?>
                        </span>
                    </a>
                    <?php
                endforeach;
            endif;
            ?>
        </div>

    </div>
</section>
<!-- ===== / SERVICES ===== -->


<!-- ===== 3. À PROPOS ===== -->
<section class="py-20 px-4 bg-teal-50" aria-labelledby="apropos-title">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Photo -->
            <div class="animate-on-scroll">
                <?php
                // Cherche la page "À propos" pour récupérer l'image mise en avant
                $about_page = get_page_by_path( 'a-propos' );
                if ( $about_page && has_post_thumbnail( $about_page->ID ) ) :
                    echo get_the_post_thumbnail( $about_page->ID, 'large', array(
                        'class' => 'rounded-2xl shadow-lg w-full max-w-md mx-auto',
                        'alt'   => esc_attr( get_bloginfo( 'name' ) . ' — ' . __( 'Développeur Web', 'eddy-portfolio' ) ),
                    ) );
                else :
                    ?>
                    <img src="https://placehold.co/500x500/ccfbf1/0d9488?text=Eddy+R."
                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — <?php esc_attr_e( 'Développeur Web', 'eddy-portfolio' ); ?>"
                         class="rounded-2xl shadow-lg w-full max-w-md mx-auto"
                         loading="lazy">
                <?php endif; ?>
            </div>

            <!-- Texte -->
            <div class="animate-on-scroll">
                <span class="inline-block bg-teal-100 text-teal-700 text-sm font-semibold px-3 py-1 rounded-full mb-4">
                    <?php esc_html_e( 'À propos de moi', 'eddy-portfolio' ); ?>
                </span>
                <h2 id="apropos-title" class="text-3xl font-bold text-gray-800 mb-4">
                    <?php esc_html_e( 'Développeur passionné par le web', 'eddy-portfolio' ); ?>
                </h2>
                <?php if ( $about_page ) : ?>
                    <div class="text-gray-600 leading-relaxed mb-6">
                        <?php echo wp_trim_words( apply_filters( 'the_content', $about_page->post_content ), 60, '…' ); ?>
                    </div>
                <?php else : ?>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        <?php esc_html_e( 'Je suis Eddy RAKOTOARIVONY, développeur web freelance avec plusieurs années d\'expérience dans la création de solutions digitales performantes. Ma spécialité : les CMS e-commerce (PrestaShop, WordPress) et le développement Symfony.', 'eddy-portfolio' ); ?>
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        <?php esc_html_e( 'Je m\'engage à livrer des projets de qualité, dans les délais convenus, avec un suivi rigoureux et une communication transparente.', 'eddy-portfolio' ); ?>
                    </p>
                <?php endif; ?>

                <!-- Statistiques clés -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center bg-white rounded-xl p-4 shadow-sm">
                        <div class="text-2xl font-bold text-teal-600">50+</div>
                        <div class="text-gray-500 text-sm"><?php esc_html_e( 'Projets livrés', 'eddy-portfolio' ); ?></div>
                    </div>
                    <div class="text-center bg-white rounded-xl p-4 shadow-sm">
                        <div class="text-2xl font-bold text-teal-600">5+</div>
                        <div class="text-gray-500 text-sm"><?php esc_html_e( 'Ans d\'expérience', 'eddy-portfolio' ); ?></div>
                    </div>
                    <div class="text-center bg-white rounded-xl p-4 shadow-sm">
                        <div class="text-2xl font-bold text-teal-600">100%</div>
                        <div class="text-gray-500 text-sm"><?php esc_html_e( 'Clients satisfaits', 'eddy-portfolio' ); ?></div>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/a-propos/' ) ); ?>"
                   class="inline-block bg-teal-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-teal-700 transition duration-300">
                    <?php esc_html_e( 'En savoir plus sur moi →', 'eddy-portfolio' ); ?>
                </a>
            </div>

        </div>
    </div>
</section>
<!-- ===== / À PROPOS ===== -->


<!-- ===== 4. TECHNOLOGIES ===== -->
<section class="py-20 px-4 bg-white" aria-labelledby="tech-title">
    <div class="max-w-5xl mx-auto text-center">

        <div class="animate-on-scroll mb-12">
            <h2 id="tech-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Technologies maîtrisées', 'eddy-portfolio' ); ?>
            </h2>
            <p class="text-gray-500">
                <?php esc_html_e( 'Les outils et frameworks que j\'utilise au quotidien pour créer des solutions robustes.', 'eddy-portfolio' ); ?>
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 animate-on-scroll">
            <?php
            $techs = array(
                '🛒 PrestaShop', '🌐 WordPress', '⚡ Symfony', '🐘 PHP 8+',
                '🐬 MySQL', '🎨 HTML5 / CSS3', '✨ JavaScript', '📦 jQuery',
                '💨 Tailwind CSS', '🔀 Git / GitHub', '🐧 Linux', '🐳 Docker',
            );
            foreach ( $techs as $tech ) :
                echo '<span class="tech-badge">' . esc_html( $tech ) . '</span>';
            endforeach;
            ?>
        </div>

    </div>
</section>
<!-- ===== / TECHNOLOGIES ===== -->


<!-- ===== 5. BLOG ===== -->
<section class="py-20 px-4 bg-teal-50" aria-labelledby="blog-title">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-12 animate-on-scroll">
            <h2 id="blog-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Derniers articles du blog', 'eddy-portfolio' ); ?>
            </h2>
            <p class="text-gray-500">
                <?php esc_html_e( 'Conseils, tutoriels et actualités du développement web.', 'eddy-portfolio' ); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $blog_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );

            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) :
                    $blog_query->the_post();
                    get_template_part( 'template-parts/blog', 'card' );
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center col-span-3 text-gray-500 py-8">' . esc_html__( 'Aucun article publié pour le moment.', 'eddy-portfolio' ) . '</p>';
            endif;
            ?>
        </div>

        <div class="text-center mt-10 animate-on-scroll">
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"
               class="inline-block border-2 border-teal-600 text-teal-600 px-8 py-3 rounded-xl font-semibold hover:bg-teal-600 hover:text-white transition duration-300">
                <?php esc_html_e( 'Voir tous les articles', 'eddy-portfolio' ); ?>
            </a>
        </div>

    </div>
</section>
<!-- ===== / BLOG ===== -->


<!-- ===== 6. CTA ===== -->
<?php
get_template_part( 'template-parts/cta', 'section', array(
    'title' => __( 'Travaillons ensemble !', 'eddy-portfolio' ),
    'text'  => __( 'Vous avez un projet web en tête ? Je suis disponible et prêt à vous accompagner de l\'idée au lancement.', 'eddy-portfolio' ),
    'label' => __( 'Contactez-moi maintenant →', 'eddy-portfolio' ),
    'url'   => home_url( '/contact/' ),
) );
?>
<!-- ===== / CTA ===== -->

<?php get_footer(); ?>
