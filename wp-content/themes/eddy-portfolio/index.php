<?php
/**
 * index.php — Template de fallback universel
 *
 * Ce fichier est le dernier recours de la hiérarchie de templates WordPress.
 * Il s'affiche lorsqu'aucun autre template plus spécifique ne correspond.
 *
 * Hiérarchie WordPress (du plus spécifique au plus générique) :
 *  front-page.php → home.php → archive.php → singular.php → single.php
 *  → page.php → 404.php → search.php → index.php
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<main id="main" class="py-16 px-4 bg-gray-50" role="main">
    <div class="max-w-6xl mx-auto">

        <?php if ( is_home() && ! is_front_page() ) : ?>
            <!-- Page de blog -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    <?php esc_html_e( 'Blog', 'eddy-portfolio' ); ?>
                </h1>
                <p class="text-gray-500">
                    <?php esc_html_e( 'Conseils, tutoriels et actualités du développement web.', 'eddy-portfolio' ); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Contenu principal -->
            <div class="lg:col-span-2">

                <?php if ( have_posts() ) : ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            if ( is_singular() ) :
                                ?>
                                <article class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                                    <h1 class="text-2xl font-bold text-gray-800 mb-4"><?php the_title(); ?></h1>
                                    <div class="article-body text-gray-600"><?php the_content(); ?></div>
                                </article>
                                <?php
                            else :
                                get_template_part( 'template-parts/blog', 'card' );
                            endif;
                        endwhile;
                        ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="<?php esc_attr_e( 'Navigation', 'eddy-portfolio' ); ?>">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '&larr; ' . __( 'Précédent', 'eddy-portfolio' ),
                            'next_text' => __( 'Suivant', 'eddy-portfolio' ) . ' &rarr;',
                        ) );
                        ?>
                    </nav>

                <?php else : ?>

                    <div class="text-center py-16">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-lg font-medium text-gray-600 mb-4">
                            <?php esc_html_e( 'Aucun contenu disponible.', 'eddy-portfolio' ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                           class="inline-block bg-teal-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-teal-700 transition">
                            <?php esc_html_e( '← Retour à l\'accueil', 'eddy-portfolio' ); ?>
                        </a>
                    </div>

                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1" role="complementary">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </div>
</main>

<?php get_footer(); ?>
