<?php
/**
 * Modal À propos — affiche le profil complet d'Eddy.
 *
 * @package Eddy_Portfolio
 */

$full_name    = get_theme_mod( 'eddy_full_name', 'Eddy RAKOTOARIVONY' );
$job_title    = get_theme_mod( 'eddy_job_title', 'Développeur Web Full-Stack' );
$location     = get_theme_mod( 'eddy_location', 'Madagascar / Remote' );
$bio_full     = get_theme_mod( 'eddy_bio_full', '' );
$linkedin_url = get_theme_mod( 'eddy_linkedin_url', '' );
$github_url   = get_theme_mod( 'eddy_github_url', '' );

// Avatar : photo personnalisée ou initiales
$avatar_url = '';
if ( function_exists( 'get_field' ) ) {
    $avatar_url = get_field( 'eddy_avatar', 'option' );
}
if ( ! $avatar_url && has_custom_logo() ) {
    $logo_id    = get_theme_mod( 'custom_logo' );
    $avatar_url = wp_get_attachment_image_url( $logo_id, 'thumbnail' );
}

$skills = [ 'PrestaShop', 'Symfony', 'WordPress', 'PHP', 'MySQL', 'JavaScript', 'jQuery', 'Git', 'TMA', 'API REST', 'Tailwind CSS', 'Docker' ];

$bio_paragraphs = $bio_full ? [ $bio_full ] : [
    __( "Développeur web passionné avec plus de 7 ans d'expérience dans la création et la maintenance d'applications web sur-mesure. Je me spécialise dans les écosystèmes PrestaShop, Symfony et WordPress, avec une expertise particulière en TMA.", 'eddy-portfolio' ),
    __( 'Basé à Madagascar et disponible en remote, j\'accompagne des clients en France, Europe et dans le monde entier dans leurs projets digitaux. Mon approche combine rigueur technique, respect des délais et communication transparente.', 'eddy-portfolio' ),
    __( 'Toujours en veille technologique, je m\'assure que mes projets respectent les meilleures pratiques du moment : performances, sécurité, accessibilité et SEO. Chaque ligne de code est pensée pour durer.', 'eddy-portfolio' ),
];
?>
<div id="modal-about" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-overlay" aria-hidden="true"></div>
    <div class="modal-content">

        <button id="modal-close" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                aria-label="<?php esc_attr_e( 'Fermer', 'eddy-portfolio' ); ?>" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- Photo + titre -->
        <div class="flex items-center gap-5 mb-6">
            <?php if ( $avatar_url ) : ?>
                <img src="<?php echo esc_url( $avatar_url ); ?>"
                     alt="<?php printf( esc_attr__( 'Photo de %s', 'eddy-portfolio' ), $full_name ); ?>"
                     class="w-20 h-20 rounded-full object-cover border-4 border-teal-600/20"
                     width="80" height="80">
            <?php else : ?>
                <div class="w-20 h-20 rounded-full bg-teal-700 flex items-center justify-center text-white font-bold text-2xl border-4 border-teal-600/20">
                    <?php echo esc_html( strtoupper( substr( $full_name, 0, 1 ) ) ); ?>
                </div>
            <?php endif; ?>
            <div>
                <h2 id="modal-title" class="text-xl font-extrabold" style="color:var(--color-text)">
                    <?php echo esc_html( $full_name ); ?>
                </h2>
                <p class="text-sm text-teal-600 font-medium">
                    <?php echo esc_html( $job_title ); ?> · <?php esc_html_e( 'Freelance', 'eddy-portfolio' ); ?>
                </p>
                <p class="text-xs mt-0.5" style="color:var(--color-text-muted)">
                    🇲🇬 <?php echo esc_html( $location ); ?>
                </p>
            </div>
        </div>

        <!-- Bio -->
        <div class="space-y-3 mb-6 text-sm leading-relaxed" style="color:var(--color-text)">
            <?php foreach ( $bio_paragraphs as $paragraph ) : ?>
                <p><?php echo wp_kses_post( $paragraph ); ?></p>
            <?php endforeach; ?>
        </div>

        <!-- Compétences -->
        <div>
            <h3 class="text-sm font-bold mb-3" style="color:var(--color-text)">
                <?php esc_html_e( 'Compétences', 'eddy-portfolio' ); ?>
            </h3>
            <div class="flex flex-wrap">
                <?php foreach ( $skills as $skill ) : ?>
                    <span class="skill-badge"><?php echo esc_html( $skill ); ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t flex gap-3" style="border-color:var(--color-border)">
            <a href="#contact" class="btn-primary" style="flex:1;justify-content:center"
               onclick="document.getElementById('modal-about').classList.remove('open');document.body.style.overflow=''">
                <?php esc_html_e( 'Me contacter', 'eddy-portfolio' ); ?>
            </a>
            <?php if ( $linkedin_url ) : ?>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer"
               class="btn-outline" style="color:var(--color-primary);border-color:var(--color-primary)">
                LinkedIn
            </a>
            <?php endif; ?>
        </div>

    </div>
</div>
