<?php
/**
 * Contenu principal de l'article.
 *
 * @package Eddy_Portfolio
 */
?>
<div class="article-content">
    <?php the_content(); ?>
    <?php
    wp_link_pages( [
        'before' => '<div class="page-links">' . esc_html__( 'Pages :', 'eddy-portfolio' ),
        'after'  => '</div>',
    ] );
    ?>
</div>
