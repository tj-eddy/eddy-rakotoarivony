<?php
/**
 * archive.php — Liste paginée du blog
 *
 * Affiche les articles de blog avec :
 *  - Filtres par catégorie (lien WordPress natif)
 *  - Barre de recherche AJAX jQuery (filtre live via REST API)
 *  - Grille 6 articles par page
 *  - Pagination native WordPress stylisée Tailwind teal
 *
 * Utilisé aussi comme template index quand la page de blog est configurée
 * dans Réglages > Lecture.
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );

$paged = max( 1, get_query_var( 'paged' ) );
?>

<!-- ===== EN-TÊTE ===== -->
<section class="hero-gradient py-14 px-4" aria-labelledby="blog-archive-title">
    <div class="max-w-3xl mx-auto text-center animate-on-scroll">
        <span class="inline-block bg-teal-100 text-teal-700 text-sm font-semibold px-3 py-1 rounded-full mb-4">
            <?php esc_html_e( 'Conseils & Tutoriels', 'eddy-portfolio' ); ?>
        </span>
        <h1 id="blog-archive-title" class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <?php
            if ( is_category() ) {
                single_cat_title( '', true );
            } elseif ( is_tag() ) {
                single_tag_title( '', true );
            } elseif ( is_author() ) {
                esc_html_e( 'Articles de', 'eddy-portfolio' );
                echo ' ' . esc_html( get_the_author() );
            } else {
                esc_html_e( 'Blog', 'eddy-portfolio' );
            }
            ?>
        </h1>
        <p class="text-lg text-gray-600">
            <?php esc_html_e( 'Conseils, tutoriels et actualités du développement web.', 'eddy-portfolio' ); ?>
        </p>
    </div>
</section>


<!-- ===== FILTRES & RECHERCHE ===== -->
<section class="bg-white border-b border-gray-100 py-4 px-4 sticky top-16 z-40">
    <div class="max-w-6xl mx-auto flex flex-wrap items-center gap-3">

        <!-- Filtres catégorie -->
        <div class="flex flex-wrap gap-2" role="navigation" aria-label="<?php esc_attr_e( 'Filtres par catégorie', 'eddy-portfolio' ); ?>">
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"
               class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition duration-200 <?php echo ( ! is_category() && ! is_tag() ) ? 'bg-teal-600 text-white' : 'border border-gray-300 text-gray-700 hover:border-teal-300 hover:text-teal-600'; ?>">
                <?php esc_html_e( 'Tous', 'eddy-portfolio' ); ?>
            </a>
            <?php
            $categories = get_categories( array(
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => true,
            ) );
            foreach ( $categories as $cat ) :
                $is_active = is_category( $cat->term_id );
                ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                   class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition duration-200 <?php echo $is_active ? 'bg-teal-600 text-white' : 'border border-gray-300 text-gray-700 hover:border-teal-300 hover:text-teal-600'; ?>"
                   rel="category tag">
                    <?php echo esc_html( $cat->name ); ?>
                    <span class="ml-1 opacity-60">(<?php echo esc_html( $cat->count ); ?>)</span>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Recherche AJAX live -->
        <div class="ml-auto">
            <input type="search"
                   id="search-input"
                   placeholder="<?php esc_attr_e( 'Rechercher un article…', 'eddy-portfolio' ); ?>"
                   class="border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 focus:border-teal-400 outline-none transition duration-200 w-56"
                   aria-label="<?php esc_attr_e( 'Rechercher dans les articles', 'eddy-portfolio' ); ?>">
        </div>

    </div>
</section>


<!-- ===== ARTICLES ===== -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-6xl mx-auto">

        <!-- Compteur résultats -->
        <p id="blog-count" class="text-sm text-gray-500 mb-6" aria-live="polite">
            <?php
            global $wp_query;
            $total = $wp_query->found_posts;
            printf(
                /* translators: 1: nombre d'articles trouvés */
                esc_html( _n( '%d article trouvé', '%d articles trouvés', $total, 'eddy-portfolio' ) ),
                esc_html( $total )
            );
            ?>
        </p>

        <!-- Grille articles -->
        <div id="blog-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/blog', 'card' );
                endwhile;
            else :
                ?>
                <div class="col-span-3 text-center py-16 text-gray-500">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-lg font-medium text-gray-600">
                        <?php esc_html_e( 'Aucun article trouvé.', 'eddy-portfolio' ); ?>
                    </p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       class="mt-4 inline-block text-teal-600 hover:underline text-sm">
                        <?php esc_html_e( '← Retour à l\'accueil', 'eddy-portfolio' ); ?>
                    </a>
                </div>
                <?php
            endif;
            ?>
        </div>

        <!-- Pagination native WordPress -->
        <nav id="pagination"
             class="flex flex-wrap items-center justify-center gap-2 mt-8"
             aria-label="<?php esc_attr_e( 'Pagination des articles', 'eddy-portfolio' ); ?>">
            <?php
            the_posts_pagination( array(
                'mid_size'           => 2,
                'prev_text'          => '&larr; ' . __( 'Précédent', 'eddy-portfolio' ),
                'next_text'          => __( 'Suivant', 'eddy-portfolio' ) . ' &rarr;',
                'before_page_number' => '',
                'screen_reader_text' => __( 'Navigation des pages', 'eddy-portfolio' ),
                'aria_label'         => __( 'Articles', 'eddy-portfolio' ),
                'class'              => 'eddy-pagination',
            ) );
            ?>
        </nav>

    </div>
</section>

<?php get_footer(); ?>
