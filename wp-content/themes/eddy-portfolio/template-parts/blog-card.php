<?php
/**
 * template-parts/blog-card.php — Card d'article de blog réutilisable
 *
 * Affiche une card article avec :
 *  - Image mise en avant
 *  - Badge catégorie avec couleur dynamique
 *  - Titre lié à l'article
 *  - Extrait
 *  - Date de publication + temps de lecture estimé
 *  - Lien "Lire la suite"
 *
 * Doit être appelé dans la boucle WordPress (have_posts / the_post).
 *
 * Utilisation :
 *   get_template_part( 'template-parts/blog', 'card' );
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

$categories = get_the_category();
$cat_name   = $categories ? $categories[0]->name : '';
$cat_link   = $categories ? get_category_link( $categories[0]->term_id ) : '';
$cat_color  = eddy_get_category_color( $cat_name );
$reading    = eddy_reading_time( get_the_ID() );
$excerpt    = get_the_excerpt();
if ( ! $excerpt ) {
    $excerpt = wp_trim_words( get_the_content(), 20, '…' );
}
?>
<article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 animate-on-scroll flex flex-col"
         itemscope itemtype="https://schema.org/BlogPosting">

    <!-- Image mise en avant -->
    <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'eddy-thumbnail', array(
                'class'   => 'w-full h-48 object-cover',
                'loading' => 'lazy',
                'alt'     => esc_attr( get_the_title() ),
                'itemprop'=> 'image',
            ) ); ?>
        <?php else : ?>
            <img src="https://placehold.co/400x200/e0f2f1/0d9488?text=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>"
                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                 class="w-full h-48 object-cover" loading="lazy">
        <?php endif; ?>
    </a>

    <div class="p-6 flex flex-col flex-1">

        <!-- Badge catégorie -->
        <?php if ( $cat_name ) : ?>
            <a href="<?php echo esc_url( $cat_link ); ?>"
               class="inline-block <?php echo esc_attr( $cat_color ); ?> text-xs font-semibold px-2 py-1 rounded-full mb-3 self-start hover:opacity-80 transition duration-200"
               rel="tag">
                <?php echo esc_html( $cat_name ); ?>
            </a>
        <?php endif; ?>

        <!-- Titre -->
        <h2 class="font-bold text-gray-800 text-lg mb-2 leading-snug" itemprop="headline">
            <a href="<?php the_permalink(); ?>"
               class="hover:text-teal-600 transition duration-300"
               itemprop="url">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Extrait -->
        <p class="text-gray-500 text-sm flex-1 mb-4" itemprop="description">
            <?php echo esc_html( $excerpt ); ?>
        </p>

        <!-- Meta : date + temps de lecture -->
        <div class="flex items-center justify-between text-xs text-gray-400 mt-auto">
            <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
                  itemprop="datePublished">
                <?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
            </time>
            <span><?php echo esc_html( $reading ); ?></span>
        </div>

        <!-- Lien Lire la suite -->
        <a href="<?php the_permalink(); ?>"
           class="mt-4 inline-block text-center bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition duration-300 text-sm font-medium">
            <?php esc_html_e( 'Lire la suite', 'eddy-portfolio' ); ?>
        </a>

    </div>
</article>
