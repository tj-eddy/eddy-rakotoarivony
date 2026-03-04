<?php
/**
 * search.php — Résultats de recherche
 *
 * Affiche les résultats de la recherche WordPress avec :
 *  - En-tête indiquant le terme recherché et le nombre de résultats
 *  - Grille des articles trouvés (template-parts/blog-card)
 *  - Pagination
 *  - Message si aucun résultat avec suggestions
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<!-- ===== EN-TÊTE RECHERCHE ===== -->
<section class="hero-gradient py-14 px-4" aria-labelledby="search-title">
    <div class="max-w-3xl mx-auto text-center animate-on-scroll">
        <h1 id="search-title" class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
            <?php
            if ( have_posts() ) {
                printf(
                    /* translators: %s : terme recherché */
                    esc_html__( 'Résultats pour : "%s"', 'eddy-portfolio' ),
                    '<span class="text-teal-600">' . esc_html( get_search_query() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: %s : terme recherché */
                    esc_html__( 'Aucun résultat pour : "%s"', 'eddy-portfolio' ),
                    '<span class="text-teal-600">' . esc_html( get_search_query() ) . '</span>'
                );
            }
            ?>
        </h1>
        <?php if ( have_posts() ) : ?>
        <p class="text-gray-600">
            <?php printf(
                /* translators: %d : nombre de résultats */
                esc_html( _n( '%d résultat trouvé', '%d résultats trouvés', $wp_query->found_posts, 'eddy-portfolio' ) ),
                esc_html( $wp_query->found_posts )
            ); ?>
        </p>
        <?php endif; ?>
    </div>
</section>


<!-- ===== RÉSULTATS ===== -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-6xl mx-auto">

        <?php if ( have_posts() ) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/blog', 'card' );
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <nav class="flex flex-wrap justify-center gap-2"
                 aria-label="<?php esc_attr_e( 'Pagination des résultats', 'eddy-portfolio' ); ?>">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&larr; ' . __( 'Précédent', 'eddy-portfolio' ),
                    'next_text' => __( 'Suivant', 'eddy-portfolio' ) . ' &rarr;',
                ) );
                ?>
            </nav>

        <?php else : ?>

            <!-- Aucun résultat -->
            <div class="max-w-2xl mx-auto text-center py-16">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    <?php esc_html_e( 'Aucun article trouvé', 'eddy-portfolio' ); ?>
                </h2>
                <p class="text-gray-500 mb-8">
                    <?php esc_html_e( 'Votre recherche ne correspond à aucun article. Essayez avec d\'autres mots-clés ou parcourez les catégories.', 'eddy-portfolio' ); ?>
                </p>

                <!-- Nouveau formulaire de recherche -->
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"
                      class="flex items-center max-w-md mx-auto mb-8">
                    <label for="search-again" class="sr-only"><?php esc_html_e( 'Rechercher', 'eddy-portfolio' ); ?></label>
                    <input id="search-again" type="search" name="s"
                           value="<?php echo esc_attr( get_search_query() ); ?>"
                           placeholder="<?php esc_attr_e( 'Nouvelle recherche…', 'eddy-portfolio' ); ?>"
                           class="flex-1 border border-gray-300 rounded-l-xl px-4 py-3 text-gray-700 focus:border-teal-400 outline-none transition">
                    <button type="submit"
                            class="bg-teal-600 text-white px-5 py-3 rounded-r-xl hover:bg-teal-700 transition font-medium"
                            aria-label="<?php esc_attr_e( 'Lancer la recherche', 'eddy-portfolio' ); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>

                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       class="inline-block bg-teal-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-teal-700 transition">
                        <?php esc_html_e( '← Accueil', 'eddy-portfolio' ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"
                       class="inline-block border-2 border-teal-600 text-teal-600 px-6 py-3 rounded-xl font-semibold hover:bg-teal-50 transition">
                        <?php esc_html_e( 'Tous les articles', 'eddy-portfolio' ); ?>
                    </a>
                </div>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
