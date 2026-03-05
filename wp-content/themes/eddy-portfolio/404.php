<?php
/**
 * Template page 404 — Page non trouvée.
 *
 * @package Eddy_Portfolio
 */

get_header();
?>

<main id="main-content" class="pt-16 min-h-screen flex items-center justify-center">
    <div class="text-center px-4 py-20">
        <div class="text-8xl font-extrabold text-teal-600 mb-4">404</div>
        <h1 class="text-3xl font-bold mb-4" style="color:var(--color-text)">
            <?php esc_html_e( 'Page introuvable', 'eddy-portfolio' ); ?>
        </h1>
        <p class="mb-8 max-w-md mx-auto" style="color:var(--color-text-muted)">
            <?php esc_html_e( "La page que vous cherchez n'existe pas ou a été déplacée.", 'eddy-portfolio' ); ?>
        </p>

        <!-- Recherche -->
        <div class="mb-8 max-w-md mx-auto">
            <?php get_search_form(); ?>
        </div>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
            <?php esc_html_e( '← Retour à l\'accueil', 'eddy-portfolio' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
