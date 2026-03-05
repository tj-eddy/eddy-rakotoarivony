<?php
/**
 * Page d'accueil one-page : Hero + Services + Actualités + Contact.
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content">
    <?php get_template_part( 'template-parts/home/section-hero' ); ?>
    <?php get_template_part( 'template-parts/home/section-services' ); ?>
    <?php get_template_part( 'template-parts/home/section-actualites' ); ?>
    <?php get_template_part( 'template-parts/home/section-contact' ); ?>
</main>

<?php get_footer(); ?>
