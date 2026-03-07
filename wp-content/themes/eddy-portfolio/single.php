<?php
/**
 * Template article de blog (single post).
 *
 * @package Eddy_Portfolio
 */

get_header();

// Calcul données meta
$author_id  = get_the_author_meta( 'ID' );
$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
$read_min   = max( 1, (int) ceil( $word_count / 200 ) );
$categories = get_the_category();
$category   = ! empty( $categories ) ? $categories[0] : null;
$techs      = get_the_terms( get_the_ID(), 'post_tech' );
?>

<!-- Barre de progression de lecture -->
<div id="reading-progress" role="progressbar" aria-label="Progression de lecture" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

<main id="main-content" class="pt-16">
<?php while ( have_posts() ) : the_post(); ?>

    <!-- Breadcrumb -->
    <?php get_template_part( 'template-parts/post/post-header' ); ?>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex gap-10 items-start">

            <!-- ===== ARTICLE PRINCIPAL ===== -->
            <article class="min-w-0 flex-1" aria-label="Article de blog">

                <!-- Image hero -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'eddy-hero', [ 'class' => 'article-hero mb-6', 'loading' => 'eager' ] ); ?>
                <?php endif; ?>

                <!-- Catégorie -->
                <?php if ( $category ) : ?>
                <div class="mb-4">
                    <a href="<?php echo esc_url( get_category_link( $category ) ); ?>" class="category-badge">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Titre H1 -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold mb-5 leading-tight" style="color:var(--color-text);font-family:'Plus Jakarta Sans',sans-serif">
                    <?php the_title(); ?>
                </h1>

                <!-- Meta bar : auteur / date / temps de lecture -->
                <div class="flex flex-wrap items-center gap-4 mb-8 pb-6" style="border-bottom:1px solid var(--color-border)">

                    <!-- Auteur -->
                    <div class="flex items-center gap-2">
                        <?php echo get_avatar( $author_id, 32, '', get_the_author(), [ 'class' => 'w-8 h-8 rounded-full' ] ); ?>
                        <span class="text-sm font-medium" style="color:var(--color-text)"><?php the_author(); ?></span>
                    </div>

                    <!-- Date -->
                    <div class="flex items-center gap-1 text-sm" style="color:var(--color-text-muted)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date() ); ?>
                        </time>
                    </div>

                    <!-- Temps de lecture -->
                    <div class="flex items-center gap-1 text-sm" style="color:var(--color-text-muted)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span>
                            <?php
                            printf(
                                /* translators: %d : minutes */
                                esc_html( _n( '%d min de lecture', '%d min de lecture', $read_min, 'eddy-portfolio' ) ),
                                $read_min
                            );
                            ?>
                        </span>
                    </div>

                </div>

                <!-- Contenu de l'article -->
                <?php get_template_part( 'template-parts/post/post-content' ); ?>

                <!-- Tags / Technologies -->
                <?php if ( $techs && ! is_wp_error( $techs ) ) : ?>
                <div class="mt-8 pt-6" style="border-top:1px solid var(--color-border)">
                    <h3 class="text-sm font-semibold mb-3" style="color:var(--color-text)">
                        <?php esc_html_e( 'Tags', 'eddy-portfolio' ); ?>
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ( $techs as $tech ) : ?>
                            <a href="<?php echo esc_url( get_term_link( $tech ) ); ?>" class="tag-badge">
                                <?php echo esc_html( $tech->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Boutons de partage -->
                <div class="mt-6 pt-6" style="border-top:1px solid var(--color-border)">
                    <h3 class="text-sm font-semibold mb-3" style="color:var(--color-text)">
                        <?php esc_html_e( 'Partager cet article', 'eddy-portfolio' ); ?>
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>"
                           target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Partager sur LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            LinkedIn
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
                           target="_blank" rel="noopener noreferrer" class="share-btn" aria-label="Partager sur X (Twitter)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            X / Twitter
                        </a>
                        <!-- <button class="share-btn" id="copy-link-btn" type="button"
                                data-url="<?php echo esc_attr( get_permalink() ); ?>"
                                aria-label="<?php esc_attr_e( 'Copier le lien', 'eddy-portfolio' ); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                            <?php esc_html_e( 'Copier le lien', 'eddy-portfolio' ); ?>
                        </button> -->
                    </div>
                </div>

                <!-- Navigation prev/next -->
                <?php get_template_part( 'template-parts/post/post-navigation' ); ?>

                <!-- Commentaires -->
                <?php get_template_part( 'template-parts/post/post-comments' ); ?>

            </article>

            <!-- ===== SIDEBAR ===== -->
            <aside class="hidden lg:block w-72 flex-shrink-0" aria-label="Barre latérale">
                <?php get_template_part( 'template-parts/post/post-sidebar' ); ?>
            </aside>

        </div>
    </div>

    <!-- ===== ARTICLES SIMILAIRES (full-width, hors flex) ===== -->
    <?php get_template_part( 'template-parts/post/post-related' ); ?>

<?php endwhile; ?>
</main>

<script>
(function () {
    var bar = document.getElementById('reading-progress');
    if (!bar) return;
    function updateProgress() {
        var scrollTop  = window.scrollY || document.documentElement.scrollTop;
        var docHeight  = document.documentElement.scrollHeight - window.innerHeight;
        var pct = docHeight > 0 ? Math.min(100, (scrollTop / docHeight) * 100) : 0;
        bar.style.width = pct + '%';
        bar.setAttribute('aria-valuenow', Math.round(pct));
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
})();
</script>

<?php get_footer(); ?>
