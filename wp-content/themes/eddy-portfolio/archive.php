<?php
/**
 * Template archive articles (catégories, tags, technologies, dates).
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content" class="pt-24 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Titre de l'archive -->
        <div class="text-center mb-14">
            <h1 class="text-3xl sm:text-4xl font-extrabold" style="color:var(--color-text)">
                <?php
                if ( is_category() ) {
                    single_cat_title();
                } elseif ( is_tag() ) {
                    single_tag_title( '#' );
                } elseif ( is_tax( 'post_tech' ) ) {
                    echo esc_html__( 'Technologie : ', 'eddy-portfolio' ) . single_term_title( '', false );
                } elseif ( is_author() ) {
                    echo esc_html__( 'Articles de ', 'eddy-portfolio' ) . get_the_author();
                } elseif ( is_year() ) {
                    the_date( 'Y' );
                } elseif ( is_month() ) {
                    the_date( 'F Y' );
                } else {
                    esc_html_e( 'Archives', 'eddy-portfolio' );
                }
                ?>
            </h1>
            <?php
            $description = get_the_archive_description();
            if ( $description ) :
            ?>
            <p class="mt-4 max-w-2xl mx-auto" style="color:var(--color-text-muted)">
                <?php echo wp_kses_post( $description ); ?>
            </p>
            <?php endif; ?>
        </div>

        <?php if ( have_posts() ) : ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/post/post', 'card' ); ?>
                <?php endwhile; ?>
            </div>

            <div class="mt-12">
                <?php the_posts_pagination( [
                    'prev_text' => '← ' . __( 'Précédent', 'eddy-portfolio' ),
                    'next_text' => __( 'Suivant', 'eddy-portfolio' ) . ' →',
                ] ); ?>
            </div>

        <?php else : ?>

            <div class="text-center py-20">
                <p class="text-lg" style="color:var(--color-text-muted)">
                    <?php esc_html_e( 'Aucun article trouvé dans cette catégorie.', 'eddy-portfolio' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary mt-6 inline-flex">
                    <?php esc_html_e( 'Retour à l\'accueil', 'eddy-portfolio' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
