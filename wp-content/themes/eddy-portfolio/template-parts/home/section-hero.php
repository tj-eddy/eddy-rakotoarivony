<?php
/**
 * Section Hero — Page d'accueil one-page.
 *
 * @package Eddy_Portfolio
 */

$full_name  = get_theme_mod( 'eddy_full_name', 'Eddy RAKOTOARIVONY' );
$job_title  = get_theme_mod( 'eddy_job_title', 'Développeur Web Full-Stack' );
$tagline    = get_theme_mod( 'eddy_tagline', 'PrestaShop · Symfony · WordPress · TMA' );
$cta1_text  = get_theme_mod( 'eddy_hero_cta1_text', __( 'Voir mes services', 'eddy-portfolio' ) );
$cta2_text  = get_theme_mod( 'eddy_hero_cta2_text', __( 'Me contacter', 'eddy-portfolio' ) );
$available  = get_theme_mod( 'eddy_available_freelance', true );

// Décomposition du tagline en badges
$badges = array_map( 'trim', explode( '·', $tagline ) );
?>
<section id="hero" class="relative min-h-screen flex items-center justify-center text-white pt-16" aria-labelledby="hero-title">
    <div class="hero-pattern" aria-hidden="true"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center py-20">

        <?php if ( $available ) : ?>
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 text-sm font-medium mb-8">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            <?php esc_html_e( 'Disponible pour de nouveaux projets', 'eddy-portfolio' ); ?>
        </div>
        <?php endif; ?>

        <h1 id="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight" style="font-family:'Plus Jakarta Sans',sans-serif">
            <?php
            $name_parts = explode( ' ', $full_name, 2 );
            echo esc_html( $name_parts[0] );
            if ( isset( $name_parts[1] ) ) :
            ?><br><span class="text-teal-200"><?php echo esc_html( $name_parts[1] ); ?></span><?php
            endif;
            ?>
        </h1>

        <p class="text-lg sm:text-xl text-white/80 mb-4 font-medium">
            <?php echo esc_html( $job_title ); ?>
        </p>

        <p class="text-white/60 mb-10 text-base flex flex-wrap justify-center gap-2">
            <?php foreach ( $badges as $badge ) : ?>
                <span class="bg-white/10 px-3 py-1 rounded-full text-sm"><?php echo esc_html( $badge ); ?></span>
            <?php endforeach; ?>
        </p>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="#services" class="btn-primary text-base">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <?php echo esc_html( $cta1_text ); ?>
            </a>
            <a href="#contact" class="btn-outline text-base">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,12 2,6"></polyline>
                </svg>
                <?php echo esc_html( $cta2_text ); ?>
            </a>
            <button id="hero-about-btn" class="btn-outline text-base" type="button">
                <?php esc_html_e( 'À propos →', 'eddy-portfolio' ); ?>
            </button>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-white/50">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </div>
</section>
