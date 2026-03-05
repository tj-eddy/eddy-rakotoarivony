<?php
/**
 * Template résultats de recherche.
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content" class="pt-24 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <h1 class="text-3xl font-extrabold" style="color:var(--color-text)">
                <?php
                printf(
                    /* translators: %s : terme recherché */
                    esc_html__( 'Résultats pour « %s »', 'eddy-portfolio' ),
                    '<span class="text-teal-600">' . esc_html( get_search_query() ) . '</span>'
                );
                ?>
            </h1>
            <?php if ( have_posts() ) : ?>
            <p class="mt-2" style="color:var(--color-text-muted)">
                <?php
                printf(
                    /* translators: %d : nombre de résultats */
                    esc_html( _n( '%d résultat trouvé', '%d résultats trouvés', (int) $wp_query->found_posts, 'eddy-portfolio' ) ),
                    (int) $wp_query->found_posts
                );
                ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- Barre de recherche -->
        <div class="max-w-xl mx-auto mb-12">
            <?php get_search_form(); ?>
        </div>

        <?php if ( have_posts() ) : ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/post/post', 'card' ); ?>
                <?php endwhile; ?>
            </div>

            <div class="mt-12">
                <?php the_posts_pagination(); ?>
            </div>

        <?php else : ?>

            <div class="text-center py-10">
                <p style="color:var(--color-text-muted)">
                    <?php esc_html_e( 'Aucun article ne correspond à votre recherche.', 'eddy-portfolio' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary mt-6 inline-flex">
                    <?php esc_html_e( 'Retour à l\'accueil', 'eddy-portfolio' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
