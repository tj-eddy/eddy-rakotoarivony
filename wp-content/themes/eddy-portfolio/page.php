<?php
/**
 * Template page statique.
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content" class="pt-24 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="mb-10">
                    <h1 class="text-3xl sm:text-4xl font-extrabold" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
                        <?php the_title(); ?>
                    </h1>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mt-6">
                        <?php the_post_thumbnail( 'eddy-hero', [ 'class' => 'article-hero' ] ); ?>
                    </div>
                    <?php endif; ?>
                </header>

                <div class="article-content">
                    <?php the_content(); ?>
                </div>

            </article>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
