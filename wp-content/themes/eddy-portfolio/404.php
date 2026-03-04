<?php
/**
 * 404.php — Page d'erreur 404 personnalisée
 *
 * Affiche un message 404 avec :
 *  - Animation et design teal
 *  - Liens de navigation rapide
 *  - Formulaire de recherche
 *  - Liste des derniers articles
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
?>

<main id="main" class="py-20 px-4 bg-gray-50 min-h-screen flex items-center" role="main">
    <div class="max-w-3xl mx-auto text-center w-full">

        <!-- Code 404 visuel -->
        <div class="mb-8">
            <p class="text-9xl font-black text-teal-600 opacity-20 select-none leading-none" aria-hidden="true">
                404
            </p>
            <div class="w-24 h-24 bg-teal-50 rounded-full flex items-center justify-center mx-auto -mt-12 border-4 border-white shadow-lg">
                <svg class="w-10 h-10 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <?php esc_html_e( 'Page introuvable', 'eddy-portfolio' ); ?>
        </h1>
        <p class="text-lg text-gray-500 mb-10 max-w-md mx-auto">
            <?php esc_html_e( 'Oops ! La page que vous cherchez a été déplacée, supprimée ou n\'a jamais existé.', 'eddy-portfolio' ); ?>
        </p>

        <!-- Formulaire de recherche -->
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"
              class="flex items-center max-w-md mx-auto mb-10">
            <label for="search-404" class="sr-only"><?php esc_html_e( 'Rechercher', 'eddy-portfolio' ); ?></label>
            <input id="search-404" type="search" name="s"
                   placeholder="<?php esc_attr_e( 'Rechercher sur le site…', 'eddy-portfolio' ); ?>"
                   class="flex-1 border border-gray-300 rounded-l-xl px-4 py-3 text-gray-700 focus:border-teal-400 outline-none transition">
            <button type="submit"
                    class="bg-teal-600 text-white px-5 py-3 rounded-r-xl hover:bg-teal-700 transition"
                    aria-label="<?php esc_attr_e( 'Rechercher', 'eddy-portfolio' ); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>

        <!-- Liens rapides -->
        <div class="flex flex-wrap gap-4 justify-center mb-12">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="inline-block bg-teal-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-teal-700 transition duration-300">
                <?php esc_html_e( '← Retour à l\'accueil', 'eddy-portfolio' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"
               class="inline-block border-2 border-teal-600 text-teal-600 px-6 py-3 rounded-xl font-semibold hover:bg-teal-50 transition duration-300">
                <?php esc_html_e( 'Mes services', 'eddy-portfolio' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
               class="inline-block border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:border-teal-300 hover:text-teal-600 transition duration-300">
                <?php esc_html_e( 'Contact', 'eddy-portfolio' ); ?>
            </a>
        </div>

        <!-- Articles récents comme suggestion -->
        <?php
        $recent = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( $recent->have_posts() ) :
        ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-left">
            <h2 class="font-bold text-gray-800 mb-4 text-center">
                <?php esc_html_e( 'Vous pourriez être intéressé par…', 'eddy-portfolio' ); ?>
            </h2>
            <ul class="space-y-3">
                <?php
                while ( $recent->have_posts() ) :
                    $recent->the_post();
                    ?>
                    <li class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition duration-200">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail( 'thumbnail', array(
                                    'class'   => 'w-16 h-16 object-cover rounded-lg flex-shrink-0',
                                    'loading' => 'lazy',
                                    'alt'     => '',
                                ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div>
                            <a href="<?php the_permalink(); ?>"
                               class="font-medium text-gray-800 hover:text-teal-600 transition leading-snug block">
                                <?php the_title(); ?>
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">
                                <?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
                                &middot; <?php echo esc_html( eddy_reading_time() ); ?>
                            </p>
                        </div>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </ul>
        </div>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
