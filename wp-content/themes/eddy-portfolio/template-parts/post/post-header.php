<?php
/**
 * Breadcrumb de l'article.
 *
 * @package Eddy_Portfolio
 */
?>
<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Fil d\'Ariane', 'eddy-portfolio' ); ?>">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2 text-sm" style="color:var(--color-text-muted)">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'eddy-portfolio' ); ?></a>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
        <a href="<?php echo esc_url( home_url( '/#actualites' ) ); ?>"><?php esc_html_e( 'Actualités', 'eddy-portfolio' ); ?></a>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
        <span class="truncate max-w-xs" style="color:var(--color-text)" aria-current="page"><?php the_title(); ?></span>
    </div>
</nav>
