<?php
/**
 * Section Actualités — Carrousel d'articles dynamique.
 * Les données sont passées en JSON au script JS via wp_localize_script.
 *
 * @package Eddy_Portfolio
 */

if ( ! function_exists( 'eddy_estimated_read_time' ) ) {
    function eddy_estimated_read_time( string $content ): string {
        $words_per_minute = 200;
        $word_count       = str_word_count( wp_strip_all_tags( $content ) );
        $minutes          = max( 1, (int) ceil( $word_count / $words_per_minute ) );
        /* translators: %d : nombre de minutes */
        return sprintf( _n( '%d min', '%d min', $minutes, 'eddy-portfolio' ), $minutes );
    }
}

$section_title = get_theme_mod( 'eddy_news_title', __( 'Dernières Actualités', 'eddy-portfolio' ) );
$news_count    = (int) get_theme_mod( 'eddy_news_count', 5 );

// Requête articles pour le carrousel
$posts_query = new WP_Query( [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $news_count,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

// Construire le tableau de données pour JS
$posts_data = [];
if ( $posts_query->have_posts() ) {
    while ( $posts_query->have_posts() ) {
        $posts_query->the_post();
        $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'eddy-card' );
        $category  = '';
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $category = $categories[0]->name;
        }
        $posts_data[] = [
            'id'       => get_the_ID(),
            'title'    => get_the_title(),
            'category' => $category,
            'date'     => get_the_date( 'd F Y' ),
            'dateISO'  => get_the_date( 'Y-m-d' ),
            'readTime' => eddy_estimated_read_time( get_the_content() ),
            'excerpt'  => wp_trim_words( get_the_excerpt(), 20, '...' ),
            'image'    => $thumbnail ?: 'https://placehold.co/800x400/0F766E/white?text=' . urlencode( get_the_title() ),
            'url'      => get_permalink(),
        ];
    }
    wp_reset_postdata();
}

// Passer les données au JS via un script inline
wp_add_inline_script(
    'eddy-main',
    'var POSTS_DATA = ' . wp_json_encode( $posts_data ) . ';',
    'before'
);
?>
<section id="actualites" aria-labelledby="actualites-title" class="py-20" style="background:var(--color-bg-card);border-top:1px solid var(--color-border);border-bottom:1px solid var(--color-border)">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 reveal">
            <span class="text-sm font-semibold text-teal-600 uppercase tracking-widest">
                <?php esc_html_e( 'Blog technique', 'eddy-portfolio' ); ?>
            </span>
            <h2 id="actualites-title" class="text-3xl sm:text-4xl font-extrabold mt-2 mb-4" style="color:var(--color-text)">
                <?php echo esc_html( $section_title ); ?>
            </h2>
            <p style="color:var(--color-text-muted)">
                <?php esc_html_e( 'Articles techniques sur PrestaShop, Symfony, WordPress et les bonnes pratiques du web.', 'eddy-portfolio' ); ?>
            </p>
        </div>

        <div class="relative px-6 reveal">
            <!-- Carrousel -->
            <div class="carousel-wrapper">
                <div id="carousel-track" class="carousel-track"></div>
            </div>

            <!-- Boutons navigation -->
            <button id="carousel-prev" class="carousel-btn carousel-btn-prev" aria-label="<?php esc_attr_e( 'Article précédent', 'eddy-portfolio' ); ?>" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button id="carousel-next" class="carousel-btn carousel-btn-next" aria-label="<?php esc_attr_e( 'Article suivant', 'eddy-portfolio' ); ?>" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

        <!-- Dots -->
        <div id="carousel-dots" class="carousel-dots" role="tablist" aria-label="<?php esc_attr_e( 'Navigation du carrousel', 'eddy-portfolio' ); ?>"></div>

    </div>
</section>

