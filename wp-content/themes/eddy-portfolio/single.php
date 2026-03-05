<?php
/**
 * Template article de blog (single post).
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content" class="pt-16">
    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/post/post-header' ); ?>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <!-- Contenu principal -->
                <div class="lg:col-span-2">
                    <?php get_template_part( 'template-parts/post/post-content' ); ?>

                    <!-- Boutons de partage -->
                    <div class="mt-8 pt-6 border-t" style="border-color:var(--color-border)">
                        <p class="text-sm font-semibold mb-3" style="color:var(--color-text)">
                            <?php esc_html_e( 'Partager cet article :', 'eddy-portfolio' ); ?>
                        </p>
                        <div class="flex gap-3 flex-wrap">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
                               target="_blank" rel="noopener noreferrer" class="share-btn">
                                Twitter / X
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>"
                               target="_blank" rel="noopener noreferrer" class="share-btn">
                                LinkedIn
                            </a>
                            <button class="share-btn" id="copy-link-btn"
                                    data-url="<?php echo esc_attr( get_permalink() ); ?>"
                                    aria-label="<?php esc_attr_e( 'Copier le lien', 'eddy-portfolio' ); ?>">
                                <?php esc_html_e( 'Copier le lien', 'eddy-portfolio' ); ?>
                            </button>
                        </div>
                    </div>

                    <?php get_template_part( 'template-parts/post/post-navigation' ); ?>
                    <?php get_template_part( 'template-parts/post/post-related' ); ?>
                    <?php get_template_part( 'template-parts/post/post-comments' ); ?>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <?php get_template_part( 'template-parts/post/post-sidebar' ); ?>
                </div>

            </div>
        </div>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
