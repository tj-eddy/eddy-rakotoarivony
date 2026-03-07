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

// Titres rotatifs pour le typewriter
$name_parts     = explode( ' ', $full_name, 2 );
$typing_titles  = json_encode( [
	$job_title,
	'Expert PrestaShop',
	'Développeur Symfony',
	'Consultant WordPress',
] );
?>
<section id="hero" class="relative min-h-screen flex items-center justify-center text-white pt-16 overflow-hidden" aria-labelledby="hero-title">

    <!-- Grille de fond avec masque radial -->
    <div class="hero-grid" aria-hidden="true"></div>

    <!-- Orbes lumineux flottants -->
    <div class="hero-orb hero-orb-1" aria-hidden="true"></div>
    <div class="hero-orb hero-orb-2" aria-hidden="true"></div>
    <div class="hero-orb hero-orb-3" aria-hidden="true"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 text-center py-24">

        <!-- Badge disponibilité -->
        <?php if ( $available ) : ?>
        <div class="hero-item inline-flex items-center gap-2 hero-badge" style="--delay:0" role="status">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse" aria-hidden="true"></span>
            <?php esc_html_e( 'Disponible pour de nouveaux projets', 'eddy-portfolio' ); ?>
        </div>
        <?php endif; ?>

        <!-- Nom -->
        <h1 id="hero-title" class="hero-item hero-title" style="--delay:1; font-family:'Plus Jakarta Sans',sans-serif">
            <?php echo esc_html( $name_parts[0] ); ?>
            <?php if ( isset( $name_parts[1] ) ) : ?>
            <span class="hero-name-accent"><?php echo esc_html( $name_parts[1] ); ?></span>
            <?php endif; ?>
        </h1>

        <!-- Titre avec typewriter -->
        <div class="hero-item hero-subtitle-wrap" style="--delay:2">
            <p class="hero-subtitle">
                <span
                    id="hero-typing"
                    data-titles="<?php echo esc_attr( $typing_titles ); ?>"
                ><?php echo esc_html( $job_title ); ?></span><span class="hero-cursor" aria-hidden="true">|</span>
            </p>
        </div>

        <!-- Badges technos -->
        <div class="hero-item flex flex-wrap justify-center gap-2 mb-10" style="--delay:3">
            <?php foreach ( $badges as $badge ) : ?>
                <span class="hero-tech-badge"><?php echo esc_html( $badge ); ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Boutons CTA -->
        <div class="hero-item flex flex-wrap justify-center gap-4 mb-14" style="--delay:4">
            <a href="#services" class="btn-primary btn-hero">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <?php echo esc_html( $cta1_text ); ?>
            </a>
            <a href="#contact" class="btn-outline btn-hero">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,12 2,6"></polyline>
                </svg>
                <?php echo esc_html( $cta2_text ); ?>
            </a>
            <button id="hero-about-btn" class="btn-ghost-hero" type="button">
                <?php esc_html_e( 'À propos', 'eddy-portfolio' ); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        <!-- Séparateur -->
        <div class="hero-item" style="--delay:5" aria-hidden="true">
            <div class="hero-divider"></div>
        </div>

        <!-- Stats -->
        <div class="hero-item hero-stats" style="--delay:6" role="list" aria-label="Statistiques">
            <div class="hero-stat" role="listitem">
                <div class="hero-stat-value">
                    <span class="hero-stat-number" data-count="7">0</span><span class="hero-stat-plus">+</span>
                </div>
                <span class="hero-stat-label"><?php esc_html_e( "Années d'expérience", 'eddy-portfolio' ); ?></span>
            </div>
            <div class="hero-stat-sep" aria-hidden="true"></div>
            <div class="hero-stat" role="listitem">
                <div class="hero-stat-value">
                    <span class="hero-stat-number" data-count="10">0</span><span class="hero-stat-plus">+</span>
                </div>
                <span class="hero-stat-label"><?php esc_html_e( 'Projets réalisés', 'eddy-portfolio' ); ?></span>
            </div>
            <div class="hero-stat-sep" aria-hidden="true"></div>
            <div class="hero-stat" role="listitem">
                <div class="hero-stat-value">
                    <span class="hero-stat-number" data-count="6">0</span><span class="hero-stat-plus">+</span>
                </div>
                <span class="hero-stat-label"><?php esc_html_e( 'Clients satisfaits', 'eddy-portfolio' ); ?></span>
            </div>
            <div class="hero-stat-sep" aria-hidden="true"></div>
            <div class="hero-stat" role="listitem">
                <div class="hero-stat-value">
                    <span class="hero-stat-number" data-count="100">0</span><span class="hero-stat-plus">%</span>
                </div>
                <span class="hero-stat-label"><?php esc_html_e( 'Satisfaction client', 'eddy-portfolio' ); ?></span>
            </div>
        </div>

    </div>

    <!-- Indicateur de scroll -->
    <div class="hero-scroll-wrap" aria-hidden="true">
        <span class="hero-scroll-label">Scroll</span>
        <div class="hero-scroll-mouse">
            <div class="hero-scroll-dot"></div>
        </div>
    </div>

</section>
