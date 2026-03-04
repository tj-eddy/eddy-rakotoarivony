<?php
/**
 * page-a-propos.php — Template page "À propos"
 *
 * Template assigné automatiquement à la page avec le slug "a-propos".
 * Peut aussi être sélectionné manuellement dans l'éditeur WordPress
 * sous Attributs de la page > Modèle.
 *
 * Sections :
 *  1. Hero         — Photo de profil + introduction
 *  2. Statistiques — Compteurs clés
 *  3. Parcours     — Timeline emplois / études
 *  4. Compétences  — Barres de progression animées (jQuery)
 *  5. Valeurs      — 4 cartes de valeurs
 *  6. Formations   — Certifications
 *  7. CTA          — Lien vers Services
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

/*
 * Template Name: Page À propos
 * Template Post Type: page
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<!-- ===== HERO ===== -->
<section class="hero-gradient py-20 px-4" aria-labelledby="apropos-h1">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Photo -->
            <div class="animate-on-scroll">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', array(
                        'class' => 'rounded-2xl shadow-lg w-full max-w-md mx-auto',
                        'alt'   => esc_attr( get_bloginfo( 'name' ) . ' — ' . __( 'Développeur Web Freelance', 'eddy-portfolio' ) ),
                    ) ); ?>
                <?php else : ?>
                    <img src="https://placehold.co/400x400/ccfbf1/0d9488?text=Eddy+R."
                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                         class="rounded-full w-64 h-64 md:w-80 md:h-80 object-cover mx-auto shadow-xl border-4 border-white"
                         loading="lazy">
                <?php endif; ?>

                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <span class="bg-white text-teal-700 px-4 py-1.5 rounded-full text-sm font-medium shadow-sm border border-teal-100">🛒 PrestaShop</span>
                    <span class="bg-white text-teal-700 px-4 py-1.5 rounded-full text-sm font-medium shadow-sm border border-teal-100">🌐 WordPress</span>
                    <span class="bg-white text-teal-700 px-4 py-1.5 rounded-full text-sm font-medium shadow-sm border border-teal-100">⚡ Symfony</span>
                </div>
            </div>

            <!-- Texte intro -->
            <div class="animate-on-scroll">
                <span class="inline-block bg-teal-100 text-teal-700 text-sm font-semibold px-3 py-1 rounded-full mb-4">
                    <?php esc_html_e( 'Développeur Web Freelance', 'eddy-portfolio' ); ?>
                </span>
                <h1 id="apropos-h1" class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                    <?php esc_html_e( 'Bonjour, je suis', 'eddy-portfolio' ); ?>
                    <span class="text-teal-600"><?php bloginfo( 'name' ); ?></span>
                </h1>

                <?php
                // Si le contenu de la page est renseigné dans l'éditeur, on l'affiche
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile;
                else :
                    ?>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        <?php esc_html_e( 'Développeur web freelance passionné, je conçois des solutions digitales sur mesure qui allient performance technique, design soigné et expérience utilisateur optimale.', 'eddy-portfolio' ); ?>
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        <?php esc_html_e( 'Avec plusieurs années d\'expérience sur PrestaShop, WordPress et Symfony, j\'accompagne entrepreneurs, PME et agences dans leurs projets web — de la conception au déploiement.', 'eddy-portfolio' ); ?>
                    </p>
                    <?php
                endif;
                ?>
            </div>

        </div>
    </div>
</section>
<!-- ===== / HERO ===== -->


<!-- ===== STATISTIQUES ===== -->
<section class="py-12 bg-white border-b border-gray-100" aria-label="<?php esc_attr_e( 'Statistiques', 'eddy-portfolio' ); ?>">
    <div class="max-w-4xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <?php
            $stats = array(
                array( 'number' => '50+',  'label' => __( 'Projets livrés',    'eddy-portfolio' ) ),
                array( 'number' => '5+',   'label' => __( 'Ans d\'expérience', 'eddy-portfolio' ) ),
                array( 'number' => '30+',  'label' => __( 'Clients satisfaits','eddy-portfolio' ) ),
                array( 'number' => '3',    'label' => __( 'Spécialités CMS',   'eddy-portfolio' ) ),
            );
            foreach ( $stats as $stat ) :
            ?>
            <div class="animate-on-scroll">
                <div class="text-4xl font-bold text-teal-600 mb-1"><?php echo esc_html( $stat['number'] ); ?></div>
                <div class="text-gray-500 text-sm"><?php echo esc_html( $stat['label'] ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ===== PARCOURS ===== -->
<section class="py-20 px-4 bg-white" aria-labelledby="parcours-title">
    <div class="max-w-4xl mx-auto">
        <div class="animate-on-scroll mb-12">
            <h2 id="parcours-title" class="text-3xl font-bold text-gray-800 mb-6">
                <?php esc_html_e( 'Mon parcours', 'eddy-portfolio' ); ?>
            </h2>
            <div class="space-y-8">

                <div class="timeline-item">
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <div class="flex flex-wrap items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-800 text-lg"><?php esc_html_e( 'Développeur Web Freelance', 'eddy-portfolio' ); ?></h3>
                            <span class="text-teal-600 font-semibold text-sm bg-teal-50 px-3 py-1 rounded-full">
                                <?php esc_html_e( '2020 — Aujourd\'hui', 'eddy-portfolio' ); ?>
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm mb-1"><?php esc_html_e( 'Activité indépendante — Remote', 'eddy-portfolio' ); ?></p>
                        <p class="text-gray-600 leading-relaxed">
                            <?php esc_html_e( 'Développement de boutiques PrestaShop, sites WordPress et applications Symfony pour des clients en France, Belgique et à Madagascar. Gestion complète des projets de l\'analyse des besoins au déploiement.', 'eddy-portfolio' ); ?>
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <div class="flex flex-wrap items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-800 text-lg"><?php esc_html_e( 'Développeur PHP Junior', 'eddy-portfolio' ); ?></h3>
                            <span class="text-teal-600 font-semibold text-sm bg-teal-50 px-3 py-1 rounded-full">
                                <?php esc_html_e( '2018 — 2020', 'eddy-portfolio' ); ?>
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm mb-1"><?php esc_html_e( 'Agence Web — Antananarivo, Madagascar', 'eddy-portfolio' ); ?></p>
                        <p class="text-gray-600 leading-relaxed">
                            <?php esc_html_e( 'Développement et maintenance de sites web clients sous WordPress et PrestaShop. Première expérience avec le framework Symfony pour des projets internes.', 'eddy-portfolio' ); ?>
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <div class="flex flex-wrap items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-800 text-lg"><?php esc_html_e( 'Licence Informatique', 'eddy-portfolio' ); ?></h3>
                            <span class="text-teal-600 font-semibold text-sm bg-teal-50 px-3 py-1 rounded-full">
                                <?php esc_html_e( '2015 — 2018', 'eddy-portfolio' ); ?>
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm mb-1"><?php esc_html_e( 'Université d\'Antananarivo — Madagascar', 'eddy-portfolio' ); ?></p>
                        <p class="text-gray-600 leading-relaxed">
                            <?php esc_html_e( 'Formation en développement logiciel, bases de données, algorithmique et réseaux.', 'eddy-portfolio' ); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- ===== COMPÉTENCES ===== -->
<section class="py-20 px-4 bg-teal-50" aria-labelledby="skills-title">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 id="skills-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Mes compétences', 'eddy-portfolio' ); ?>
            </h2>
            <p class="text-gray-500"><?php esc_html_e( 'Niveau de maîtrise de mes technologies principales.', 'eddy-portfolio' ); ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            $skills_left  = array(
                array( 'name' => 'PrestaShop',      'pct' => 95 ),
                array( 'name' => 'WordPress',       'pct' => 90 ),
                array( 'name' => 'Symfony',         'pct' => 80 ),
                array( 'name' => 'PHP 8+',          'pct' => 88 ),
            );
            $skills_right = array(
                array( 'name' => 'HTML5 / CSS3',    'pct' => 92 ),
                array( 'name' => 'JavaScript / jQuery', 'pct' => 75 ),
                array( 'name' => 'MySQL / MariaDB', 'pct' => 82 ),
                array( 'name' => 'Git / GitHub',    'pct' => 78 ),
            );

            foreach ( array( $skills_left, $skills_right ) as $skills_group ) :
            ?>
            <div class="animate-on-scroll space-y-5">
                <?php foreach ( $skills_group as $skill ) : ?>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="font-medium text-gray-700"><?php echo esc_html( $skill['name'] ); ?></span>
                        <span class="text-teal-600 font-semibold"><?php echo esc_html( $skill['pct'] ); ?>%</span>
                    </div>
                    <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                        <div class="skill-bar h-3 bg-teal-500 rounded-full"
                             data-width="<?php echo esc_attr( $skill['pct'] ); ?>"
                             role="progressbar"
                             aria-valuenow="<?php echo esc_attr( $skill['pct'] ); ?>"
                             aria-valuemin="0"
                             aria-valuemax="100"
                             aria-label="<?php echo esc_attr( $skill['name'] ); ?>">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ===== VALEURS ===== -->
<section class="py-20 px-4 bg-white" aria-labelledby="valeurs-title">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 id="valeurs-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Mes valeurs', 'eddy-portfolio' ); ?>
            </h2>
            <p class="text-gray-500"><?php esc_html_e( 'Ce qui guide mon travail au quotidien.', 'eddy-portfolio' ); ?></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $values = array(
                array( 'icon' => '🎯', 'title' => __( 'Sérieux',      'eddy-portfolio' ), 'desc' => __( 'Chaque projet est traité avec rigueur et professionnalisme du début à la fin.', 'eddy-portfolio' ) ),
                array( 'icon' => '⚡', 'title' => __( 'Réactivité',   'eddy-portfolio' ), 'desc' => __( 'Réponse rapide aux demandes et respect des délais convenus avec vous.', 'eddy-portfolio' ) ),
                array( 'icon' => '✨', 'title' => __( 'Qualité',      'eddy-portfolio' ), 'desc' => __( 'Code propre, bien structuré et documenté — jamais de livraison bâclée.', 'eddy-portfolio' ) ),
                array( 'icon' => '🤝', 'title' => __( 'Disponibilité','eddy-portfolio' ), 'desc' => __( 'Suivi régulier, communication transparente et disponible pour vos questions.', 'eddy-portfolio' ) ),
            );
            foreach ( $values as $v ) :
            ?>
            <div class="bg-teal-50 rounded-xl p-6 text-center animate-on-scroll">
                <div class="text-4xl mb-4" aria-hidden="true"><?php echo esc_html( $v['icon'] ); ?></div>
                <h3 class="font-bold text-gray-800 mb-2"><?php echo esc_html( $v['title'] ); ?></h3>
                <p class="text-gray-500 text-sm"><?php echo esc_html( $v['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ===== CERTIFICATIONS ===== -->
<section class="py-20 px-4 bg-gray-50" aria-labelledby="certif-title">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 id="certif-title" class="text-3xl font-bold text-gray-800 mb-4">
                <?php esc_html_e( 'Formations & Certifications', 'eddy-portfolio' ); ?>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $certifs = array(
                array( 'icon' => '🏆', 'title' => __( 'Symfony Certified',   'eddy-portfolio' ), 'org' => 'SensioLabs — 2022' ),
                array( 'icon' => '🏆', 'title' => __( 'PrestaShop Expert',   'eddy-portfolio' ), 'org' => 'PrestaShop Academy — 2021' ),
                array( 'icon' => '🏆', 'title' => __( 'Google Analytics',    'eddy-portfolio' ), 'org' => 'Google — 2023' ),
            );
            foreach ( $certifs as $c ) :
            ?>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 animate-on-scroll text-center">
                <div class="text-3xl mb-3" aria-hidden="true"><?php echo esc_html( $c['icon'] ); ?></div>
                <h3 class="font-bold text-gray-800 mb-1"><?php echo esc_html( $c['title'] ); ?></h3>
                <p class="text-gray-500 text-sm"><?php echo esc_html( $c['org'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ===== CTA ===== -->
<?php
get_template_part( 'template-parts/cta', 'section', array(
    'title' => __( 'Travaillons ensemble !', 'eddy-portfolio' ),
    'text'  => __( 'Prêt à concrétiser votre projet web ? Parlons-en !', 'eddy-portfolio' ),
    'label' => __( 'Voir mes services →', 'eddy-portfolio' ),
    'url'   => home_url( '/services/' ),
) );
?>

<?php get_footer(); ?>
