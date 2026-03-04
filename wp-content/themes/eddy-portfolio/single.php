<?php
/**
 * single.php — Template détail d'un article de blog
 *
 * Affiche :
 *  - Breadcrumb (avec Schema BreadcrumbList)
 *  - Image mise en avant
 *  - Titre H1, auteur, date, catégorie, temps de lecture
 *  - Corps de l'article (classes Tailwind via .article-body)
 *  - Sidebar (articles récents, catégories, tags)
 *  - Section articles similaires
 *  - Boutons partage réseaux sociaux
 *  - CTA vers Contact
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

<main class="py-16 px-4 bg-gray-50" id="main" role="main">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- ===== ARTICLE PRINCIPAL (2/3) ===== -->
            <article class="lg:col-span-2" itemscope itemtype="https://schema.org/BlogPosting">

                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                ?>

                <!-- Image mise en avant -->
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-8 rounded-2xl overflow-hidden shadow-md">
                    <?php the_post_thumbnail( 'eddy-featured', array(
                        'class'    => 'w-full h-64 md:h-80 object-cover',
                        'itemprop' => 'image',
                        'loading'  => 'eager',
                        'alt'      => esc_attr( get_the_title() ),
                    ) ); ?>
                </div>
                <?php endif; ?>

                <!-- Méta article -->
                <header class="mb-6">

                    <!-- Catégorie badge -->
                    <?php
                    $categories = get_the_category();
                    if ( $categories ) :
                        $cat       = $categories[0];
                        $cat_color = eddy_get_category_color( $cat->name );
                        ?>
                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                           class="inline-block <?php echo esc_attr( $cat_color ); ?> text-xs font-semibold px-3 py-1 rounded-full mb-3 hover:opacity-80 transition"
                           rel="category tag">
                            <?php echo esc_html( $cat->name ); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Titre H1 -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight" itemprop="headline">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Infos auteur / date / temps de lecture -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 pb-4 border-b border-gray-200">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <span itemprop="name"><?php the_author(); ?></span>
                            </span>
                        </span>
                        <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"
                              itemprop="datePublished"
                              class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
                        </time>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <?php echo esc_html( eddy_reading_time() ); ?>
                        </span>
                    </div>
                </header>

                <!-- Corps de l'article -->
                <div class="article-body prose max-w-none" itemprop="articleBody">
                    <?php the_content(); ?>
                </div>

                <!-- Pagination de l'article (articles avec <!--nextpage-->) -->
                <?php wp_link_pages( array(
                    'before'         => '<nav class="mt-8 flex items-center gap-3 text-sm" aria-label="' . esc_attr__( 'Pages de l\'article', 'eddy-portfolio' ) . '">',
                    'after'          => '</nav>',
                    'link_before'    => '<span class="px-3 py-1 rounded-lg border border-teal-300 text-teal-600 hover:bg-teal-50">',
                    'link_after'     => '</span>',
                ) ); ?>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ( $tags ) :
                ?>
                <div class="mt-8 flex flex-wrap gap-2">
                    <span class="text-sm font-medium text-gray-600"><?php esc_html_e( 'Tags :', 'eddy-portfolio' ); ?></span>
                    <?php foreach ( $tags as $tag ) : ?>
                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                           class="text-xs bg-teal-50 text-teal-700 border border-teal-200 px-3 py-1 rounded-full hover:bg-teal-100 transition"
                           rel="tag">
                            #<?php echo esc_html( $tag->name ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Partage réseaux sociaux -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm font-medium text-gray-600 mb-3">
                        <?php esc_html_e( 'Partager cet article :', 'eddy-portfolio' ); ?>
                    </p>
                    <div class="flex gap-3">
                        <?php
                        $share_url   = esc_url( get_permalink() );
                        $share_title = esc_attr( get_the_title() );
                        ?>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( $share_url ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition"
                           aria-label="<?php esc_attr_e( 'Partager sur LinkedIn', 'eddy-portfolio' ); ?>">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( $share_url ); ?>&text=<?php echo rawurlencode( $share_title ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition"
                           aria-label="<?php esc_attr_e( 'Partager sur X / Twitter', 'eddy-portfolio' ); ?>">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            Twitter / X
                        </a>
                    </div>
                </div>

                <!-- Articles similaires -->
                <?php
                $current_cat_id = $categories ? $categories[0]->term_id : 0;
                if ( $current_cat_id ) :
                    $related = new WP_Query( array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post__not_in'   => array( get_the_ID() ),
                        'category__in'   => array( $current_cat_id ),
                        'orderby'        => 'rand',
                    ) );

                    if ( $related->have_posts() ) :
                ?>
                <section class="mt-12" aria-labelledby="related-title">
                    <h2 id="related-title" class="text-2xl font-bold text-gray-800 mb-6">
                        <?php esc_html_e( 'Articles similaires', 'eddy-portfolio' ); ?>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php
                        while ( $related->have_posts() ) :
                            $related->the_post();
                            get_template_part( 'template-parts/blog', 'card' );
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php
                    endif;
                endif;
                ?>

                <?php
                    endwhile;
                endif;
                ?>

            </article>
            <!-- ===== / ARTICLE PRINCIPAL ===== -->


            <!-- ===== SIDEBAR (1/3) ===== -->
            <aside class="lg:col-span-1" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar blog', 'eddy-portfolio' ); ?>">
                <?php get_sidebar(); ?>

                <!-- CTA sidebar -->
                <div class="mt-6 bg-teal-600 rounded-2xl p-6 text-center">
                    <h3 class="font-bold text-white mb-2">
                        <?php esc_html_e( 'Un projet ?', 'eddy-portfolio' ); ?>
                    </h3>
                    <p class="text-teal-100 text-sm mb-4">
                        <?php esc_html_e( 'Parlons de votre projet web !', 'eddy-portfolio' ); ?>
                    </p>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                       class="inline-block bg-white text-teal-600 px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-teal-50 transition duration-300">
                        <?php esc_html_e( 'Contactez-moi →', 'eddy-portfolio' ); ?>
                    </a>
                </div>
            </aside>
            <!-- ===== / SIDEBAR ===== -->

        </div>
    </div>
</main>

<?php get_footer(); ?>
