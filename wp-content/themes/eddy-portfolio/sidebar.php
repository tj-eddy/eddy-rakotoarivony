<?php
/**
 * sidebar.php — Sidebar du blog
 *
 * Affiche la sidebar avec :
 *  - Widgets WordPress (si configurés depuis l'admin)
 *  - Fallback : articles récents, catégories, tags cloud
 *
 * Appelé par get_sidebar() dans single.php, archive.php, search.php.
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-blog' ); ?>

<?php else : ?>
    <!-- Sidebar fallback si aucun widget n'est configuré -->

    <!-- Articles récents -->
    <div class="widget mb-6 bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <h3 class="font-bold text-gray-800 text-base mb-3 pb-2 border-b border-gray-100">
            <?php esc_html_e( 'Articles récents', 'eddy-portfolio' ); ?>
        </h3>
        <ul class="space-y-3">
            <?php
            $recent = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 5,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post__not_in'   => array( get_the_ID() ),
            ) );
            if ( $recent->have_posts() ) :
                while ( $recent->have_posts() ) :
                    $recent->the_post();
                    ?>
                    <li class="flex items-start gap-3">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail( 'thumbnail', array(
                                    'class'   => 'w-14 h-14 object-cover rounded-lg flex-shrink-0',
                                    'loading' => 'lazy',
                                    'alt'     => '',
                                ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div>
                            <a href="<?php the_permalink(); ?>"
                               class="text-sm font-medium text-gray-800 hover:text-teal-600 transition leading-snug">
                                <?php the_title(); ?>
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">
                                <?php echo esc_html( get_the_date( 'j M Y' ) ); ?>
                            </p>
                        </div>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<li class="text-gray-500 text-sm">' . esc_html__( 'Aucun article.', 'eddy-portfolio' ) . '</li>';
            endif;
            ?>
        </ul>
    </div>

    <!-- Catégories -->
    <div class="widget mb-6 bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <h3 class="font-bold text-gray-800 text-base mb-3 pb-2 border-b border-gray-100">
            <?php esc_html_e( 'Catégories', 'eddy-portfolio' ); ?>
        </h3>
        <ul class="space-y-2">
            <?php
            $cats = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true ) );
            foreach ( $cats as $cat ) :
                $is_active = is_category( $cat->term_id );
                ?>
                <li>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                       class="flex items-center justify-between text-sm <?php echo $is_active ? 'text-teal-600 font-semibold' : 'text-gray-600 hover:text-teal-600'; ?> transition duration-200"
                       rel="category tag">
                        <span><?php echo esc_html( $cat->name ); ?></span>
                        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded-full">
                            <?php echo esc_html( $cat->count ); ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Nuage de tags -->
    <?php
    $tags = get_tags( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 15 ) );
    if ( $tags ) :
    ?>
    <div class="widget mb-6 bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <h3 class="font-bold text-gray-800 text-base mb-3 pb-2 border-b border-gray-100">
            <?php esc_html_e( 'Tags', 'eddy-portfolio' ); ?>
        </h3>
        <div class="flex flex-wrap gap-2">
            <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                   class="text-xs bg-teal-50 text-teal-700 border border-teal-200 px-3 py-1 rounded-full hover:bg-teal-100 transition"
                   rel="tag">
                    #<?php echo esc_html( $tag->name ); ?>
                    <span class="opacity-60">(<?php echo esc_html( $tag->count ); ?>)</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- À propos bloc sidebar -->
    <div class="widget mb-6 bg-teal-50 rounded-xl p-5 border border-teal-100">
        <h3 class="font-bold text-gray-800 text-base mb-3">
            <?php esc_html_e( 'À propos', 'eddy-portfolio' ); ?>
        </h3>
        <p class="text-gray-600 text-sm leading-relaxed mb-3">
            <?php printf(
                /* translators: %s : nom du site */
                esc_html__( '%s, développeur web freelance spécialisé PrestaShop, WordPress & Symfony.', 'eddy-portfolio' ),
                esc_html( get_bloginfo( 'name' ) )
            ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/a-propos/' ) ); ?>"
           class="inline-block text-teal-600 text-sm font-medium hover:underline">
            <?php esc_html_e( 'En savoir plus →', 'eddy-portfolio' ); ?>
        </a>
    </div>

<?php endif; ?>
