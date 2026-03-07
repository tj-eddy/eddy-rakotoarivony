<?php
/**
 * Template article de blog (single post).
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<!-- Barre de progression de lecture -->
<div class="reading-progress" id="reading-progress" aria-hidden="true"></div>

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
                            <!-- Twitter / X -->
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
                               target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Partager sur Twitter / X">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                Twitter / X
                            </a>
                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>"
                               target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Partager sur LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                LinkedIn
                            </a>
                            <!-- Copier le lien -->
                            <button class="share-btn" id="copy-link-btn"
                                    data-url="<?php echo esc_attr( get_permalink() ); ?>"
                                    aria-label="<?php esc_attr_e( 'Copier le lien', 'eddy-portfolio' ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
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

<script>
(function () {
    var bar = document.getElementById('reading-progress');
    if (!bar) return;
    function updateProgress() {
        var scrollTop = window.scrollY || document.documentElement.scrollTop;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var pct = docHeight > 0 ? Math.min(100, (scrollTop / docHeight) * 100) : 0;
        bar.style.width = pct + '%';
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
})();
</script>

<?php get_footer(); ?>
