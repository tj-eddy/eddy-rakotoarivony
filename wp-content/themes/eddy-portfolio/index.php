<?php
/**
 * Fichier fallback obligatoire WordPress.
 * Redirige vers front-page.php si page d'accueil, sinon affiche les articles.
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content" class="py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ( have_posts() ) : ?>

            <div class="text-center mb-14">
                <h1 class="text-3xl sm:text-4xl font-extrabold" style="color:var(--color-text)">
                    <?php
                    if ( is_home() && ! is_front_page() ) {
                        single_post_title();
                    } else {
                        esc_html_e( 'Articles', 'eddy-portfolio' );
                    }
                    ?>
                </h1>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/post/post', 'card' ); ?>
                <?php endwhile; ?>
            </div>

            <?php the_posts_navigation(); ?>

        <?php else : ?>

            <div class="text-center py-20">
                <h1 class="text-2xl font-bold mb-4" style="color:var(--color-text)">
                    <?php esc_html_e( 'Aucun article trouvé.', 'eddy-portfolio' ); ?>
                </h1>
                <p style="color:var(--color-text-muted)">
                    <?php esc_html_e( 'Revenez bientôt pour découvrir de nouveaux articles.', 'eddy-portfolio' ); ?>
                </p>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
