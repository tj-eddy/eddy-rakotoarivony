<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - Portfolio Développeur Web</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* CSS Styling */
        :root {
            --primary-color: #7FFFD4;
            --primary-dark: #45b894;
            --bg-dark: #0f1115;
            --bg-darker: #07080a;
            --text-light: #e0e0e0;
            --text-muted: #8892b0;
            --font-display: 'Playfair Display', serif;
            --font-body: 'Outfit', sans-serif;
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: var(--font-body);
            background-color: var(--bg-dark);
            color: var(--text-light);
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .font-display {
            font-family: var(--font-display);
            margin: 0;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .highlight {
            color: var(--primary-color);
        }

        /* Hero Section */
        #hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            background: radial-gradient(circle at center, #1a2322 0%, var(--bg-darker) 100%);
            overflow: hidden;
        }

        /* Animated gradient background */
        .hero-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(127,255,212,0.05) 0%, transparent 50%, rgba(127,255,212,0.08) 100%);
            animation: gradientShift 8s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(5deg); }
        }

        /* Floating shapes */
        .floating-shape {
            position: absolute;
            border: 1px solid rgba(127,255,212,0.2);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 100px; height: 100px;
            top: 20%; left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px; height: 150px;
            top: 60%; right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 80px; height: 80px;
            bottom: 20%; left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-30px) rotate(180deg); opacity: 0.6; }
        }

        /* Background animated particles for Hero */
        .particles {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            background-image: 
                radial-gradient(rgba(127, 255, 212, 0.15) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            from { background-position: 0 0; }
            to { background-position: 100px 100px; }
        }

        .hero-title {
            font-size: 4rem;
            margin-bottom: 20px;
            z-index: 1;
            position: relative;
        }

        .hero-title span {
            display: inline-block;
            animation: titleReveal 1s forwards ease-out;
            opacity: 0;
        }

        .hero-title .word-1 { animation-delay: 0.3s; }
        .hero-title .word-2 { animation-delay: 0.6s; color: var(--primary-color); }
        .hero-title .word-3 { animation-delay: 0.9s; }

        @keyframes titleReveal {
            0% { transform: translateY(50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-muted);
            margin-bottom: 40px;
            z-index: 1;
            opacity: 0;
            animation: fadeSlideUp 1s 1.2s forwards ease-out;
        }

        .hero-subtitle .typing-text {
            border-right: 2px solid var(--primary-color);
            padding-right: 5px;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 50% { border-color: var(--primary-color); }
            51%, 100% { border-color: transparent; }
        }

        @keyframes fadeSlideUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .btn {
            background-color: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 15px 30px;
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            opacity: 0;
            animation: fadeSlideUp 1s 1.5s forwards ease-out;
            display: inline-block;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(127,255,212,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            background-color: var(--primary-color);
            color: var(--bg-dark);
            box-shadow: 0 0 25px var(--primary-color);
            transform: scale(1.05);
        }

        /* Section Global */
        section {
            padding: 100px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            margin: 15px auto 0;
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .service-card {
            background-color: rgba(255,255,255,0.03);
            border: 1px solid rgba(127,255,212,0.1);
            padding: 40px 20px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-color);
            box-shadow: 0 10px 30px rgba(127,255,212,0.1);
        }

        .service-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        
        .service-card:hover .service-icon {
            transform: scale(1.1);
        }

        .service-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .service-desc {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Actualités Section */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .news-card {
            background-color: rgba(255,255,255,0.03);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .news-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }

        .news-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .news-card:hover::before {
            transform: scaleX(1);
        }

        .news-image {
            height: 180px;
            background: linear-gradient(135deg, rgba(127,255,212,0.1), rgba(127,255,212,0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .news-image i {
            font-size: 3rem;
            color: var(--primary-color);
            opacity: 0.5;
            transition: all 0.4s;
        }

        .news-image .news-thumbnail {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-card:hover .news-image i {
            opacity: 1;
            transform: scale(1.2) rotate(5deg);
        }

        .news-category {
            position: absolute;
            top: 15px; left: 15px;
            background: var(--primary-color);
            color: var(--bg-dark);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .news-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .news-date {
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .news-views {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .news-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            line-height: 1.4;
            transition: color 0.3s;
        }

        .news-card:hover .news-title {
            color: var(--primary-color);
        }

        .news-excerpt {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 20px;
            flex-grow: 1;
            line-height: 1.7;
        }

        .news-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .news-tag {
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 15px;
            background: rgba(127,255,212,0.1);
            color: var(--primary-color);
            border: 1px solid rgba(127,255,212,0.2);
        }

        .read-more {
            color: var(--primary-color);
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .read-more:hover {
            gap: 15px;
            text-shadow: 0 0 10px var(--primary-color);
        }

        /* Contact Section */
        #contact {
            text-align: center;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            border-radius: 5px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(127,255,212,0.2);
            background: rgba(255,255,255,0.08);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .contact-socials {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            color: var(--text-light);
            font-size: 1.5rem;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--primary-color);
            color: var(--bg-dark);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(127,255,212,0.3);
        }

        /* Burger Menu & Sidebar */
        .burger-btn {
            position: fixed;
            top: 30px;
            right: 30px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgba(15, 17, 21, 0.8);
            border-radius: 50%;
            backdrop-filter: blur(5px);
        }

        .burger-line {
            width: 20px;
            height: 2px;
            background-color: var(--primary-color);
            margin: 3px 0;
            transition: all 0.4s ease;
        }

        /* Croissant animation state */
        .burger-btn.active .line-1 { transform: translateY(8px) rotate(45deg); }
        .burger-btn.active .line-2 { opacity: 0; }
        .burger-btn.active .line-3 { transform: translateY(-8px) rotate(-45deg); }

        .overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 900;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .sidebar {
            position: fixed;
            top: 0; right: -350px;
            width: 300px;
            height: 100vh;
            background: rgba(15, 17, 21, 0.95);
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(127, 255, 212, 0.1);
            z-index: 950;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            transition: transform 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            box-sizing: border-box;
        }

        .sidebar.active {
            transform: translateX(-350px);
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 20px 0;
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.4s ease;
            transition-property: opacity, transform;
        }

        .sidebar.active .nav-item {
            opacity: 1;
            transform: translateX(0);
        }

        /* Stagger animation for links */
        .sidebar.active .nav-item:nth-child(1) { transition-delay: 0.1s; }
        .sidebar.active .nav-item:nth-child(2) { transition-delay: 0.2s; }
        .sidebar.active .nav-item:nth-child(3) { transition-delay: 0.3s; }
        .sidebar.active .nav-item:nth-child(4) { transition-delay: 0.4s; }

        .nav-link {
            font-size: 2rem;
            font-family: var(--font-display);
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            display: inline-block;
            transition: color 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0; bottom: -5px;
            width: 0; height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        /* Scroll Reveal Utility Classes */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media screen and (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .sidebar { width: 100%; right: -100%; border-left: none; align-items: center; }
            .sidebar.active { transform: translateX(-100%); }
            .nav-link { font-size: 1.5rem; }
            section { padding: 60px 20px; }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Burger Menu Button -->
    <div class="burger-btn" id="burgerBtn">
        <div class="burger-line line-1"></div>
        <div class="burger-line line-2"></div>
        <div class="burger-line line-3"></div>
    </div>

    <!-- Overlay & Sidebar -->
    <div class="overlay" id="overlay"></div>
    <nav class="sidebar" id="sidebar">
        <ul class="nav-links">
            <li class="nav-item"><a href="#hero" class="nav-link active">Accueil</a></li>
            <li class="nav-item"><a href="#services" class="nav-link">Services</a></li>
            <li class="nav-item"><a href="#actualites" class="nav-link">Actualités</a></li>
            <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="particles"></div>
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <h1 class="hero-title">
            <span class="word-1">Développeur</span>
            <span class="word-2">Freelance</span>
        </h1>
        <p class="hero-subtitle">
            <span class="typing-text">Expert PrestaShop · WordPress · Symfony</span>
        </p>
        <a href="#services" class="btn">Voir mes services</a>
    </section>

    <!-- Services Section -->
    <section id="services">
        <h2 class="section-title reveal">Mes Compétences</h2>
        <div class="services-grid">
            <div class="service-card reveal">
                <i class="fa-brands fa-wordpress service-icon"></i>
                <h3 class="service-title">WordPress</h3>
                <p class="service-desc">Création de thèmes sur mesure, développement de plugins, et optimisation de sites vitrines et E-commerce sous WooCommerce.</p>
            </div>
            <div class="service-card reveal">
                <i class="fa-brands fa-php service-icon"></i>
                <h3 class="service-title">PrestaShop</h3>
                <p class="service-desc">Spécialiste de la création de boutiques en ligne performantes, développement de modules et refonte d'interfaces PrestaShop.</p>
            </div>
            <div class="service-card reveal">
                <i class="fa-brands fa-symfony service-icon"></i>
                <h3 class="service-title">Symfony</h3>
                <p class="service-desc">Développement d'applications web complexes et sur mesure en utilisant la robustesse du framework Symfony et PHP.</p>
            </div>
            <div class="service-card reveal">
                <i class="fa-solid fa-code-pull-request service-icon"></i>
                <h3 class="service-title">Maintenance</h3>
                <p class="service-desc">Mises à jour sécuritaires, correction de bugs, optimisation des performances (SEO & vitesse) pour garantir la pérennité.</p>
            </div>
        </div>
    </section>

    <!-- Actualités Section -->
    <section id="actualites">
        <h2 class="section-title reveal">Dernières Actualités</h2>
        <div class="news-grid">
            <?php
            // Fetch WordPress posts
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $news_query = new WP_Query($args);
            
            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
                    $categories = get_the_category();
                    $category_name = !empty($categories) ? $categories[0]->name : 'Article';
            ?>
            <article class="news-card reveal">
                <div class="news-image">
                    <span class="news-category"><?php echo esc_html($category_name); ?></span>
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium', array('class' => 'news-thumbnail')); ?>
                    <?php else : ?>
                        <i class="fa-solid fa-newspaper"></i>
                    <?php endif; ?>
                </div>
                <div class="news-content">
                    <div class="news-meta">
                        <span class="news-date"><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
                        <span class="news-views"><i class="fa-regular fa-eye"></i> <?php echo get_views(); ?></span>
                    </div>
                    <h3 class="news-title font-display"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                    <div class="news-tags">
                        <?php
                        $post_tags = get_the_tags();
                        if ($post_tags) :
                            foreach ($post_tags as $tag) :
                                echo '<span class="news-tag">' . esc_html($tag->name) . '</span>';
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="read-more">Lire plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            <?php 
                endwhile;
                wp_reset_postdata();
            else :
            // Fallback if no posts exist
            ?>
            <article class="news-card reveal">
                <div class="news-image">
                    <span class="news-category">E-commerce</span>
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="news-content">
                    <div class="news-meta">
                        <span class="news-date"><i class="fa-regular fa-calendar"></i> 15 Mars 2026</span>
                        <span class="news-views"><i class="fa-regular fa-eye"></i> 1.2k</span>
                    </div>
                    <h3 class="news-title font-display">Les tendances E-commerce PrestaShop pour 2026</h3>
                    <p class="news-excerpt">Découvrez les nouvelles fonctionnalités incontournables pour maximiser les ventes de votre boutique en ligne cette année.</p>
                    <div class="news-tags">
                        <span class="news-tag">PrestaShop</span>
                        <span class="news-tag">E-commerce</span>
                    </div>
                    <a href="#" class="read-more">Lire plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            <article class="news-card reveal">
                <div class="news-image">
                    <span class="news-category">Technique</span>
                    <i class="fa-brands fa-wordpress"></i>
                </div>
                <div class="news-content">
                    <div class="news-meta">
                        <span class="news-date"><i class="fa-regular fa-calendar"></i> 02 Février 2026</span>
                        <span class="news-views"><i class="fa-regular fa-eye"></i> 890</span>
                    </div>
                    <h3 class="news-title font-display">Pourquoi passer son site WordPress en Headless ?</h3>
                    <p class="news-excerpt">Analyse des avantages en matière de performance et de sécurité avec une architecture découplée (Next.js & WP API).</p>
                    <div class="news-tags">
                        <span class="news-tag">WordPress</span>
                        <span class="news-tag">Headless</span>
                    </div>
                    <a href="#" class="read-more">Lire plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            <article class="news-card reveal">
                <div class="news-image">
                    <span class="news-category">SEO</span>
                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                </div>
                <div class="news-content">
                    <div class="news-meta">
                        <span class="news-date"><i class="fa-regular fa-calendar"></i> 20 Janvier 2026</span>
                        <span class="news-views"><i class="fa-regular fa-eye"></i> 2.1k</span>
                    </div>
                    <h3 class="news-title font-display">Optimisation SEO et Core Web Vitals : le guide complet</h3>
                    <p class="news-excerpt">Comment améliorer les signaux web essentiels pour garantir une meilleure expérience utilisateur et grimper sur Google.</p>
                    <div class="news-tags">
                        <span class="news-tag">SEO</span>
                        <span class="news-tag">Performance</span>
                    </div>
                    <a href="#" class="read-more">Lire plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </article>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h2 class="section-title reveal">Me Contacter</h2>
        <form class="contact-form reveal" onsubmit="event.preventDefault(); alert('Message envoyé !');">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Votre Nom" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Votre Email" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Votre Message" required></textarea>
            </div>
            <button type="submit" class="btn">Envoyer le message</button>
        </form>
        
        <div class="contact-socials reveal">
            <a href="#" class="social-link" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" class="social-link" title="GitHub"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="social-link" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </section>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Typing effect for hero subtitle
            const subtitleText = "Expert PrestaShop · WordPress · Symfony";
            const $subtitle = $('.typing-text');
            let charIndex = 0;
            
            function typeSubtitle() {
                if (charIndex < subtitleText.length) {
                    $subtitle.text(subtitleText.substring(0, charIndex + 1));
                    charIndex++;
                    setTimeout(typeSubtitle, 50);
                }
            }
            
            // Start typing after animation
            setTimeout(typeSubtitle, 1800);

            // Hero mouse parallax effect
            $('#hero').on('mousemove', function(e) {
                const x = (e.pageX - $(window).width() / 2) / 50;
                const y = (e.pageY - $(window).height() / 2) / 50;
                
                $('.floating-shape').each(function(index) {
                    const speed = (index + 1) * 0.5;
                    $(this).css('transform', `translate(${x * speed}px, ${y * speed}px)`);
                });
            });

            // Burger Menu Toggle
            const toggleMenu = () => {
                $('#burgerBtn').toggleClass('active');
                $('#sidebar').toggleClass('active');
                $('#overlay').toggleClass('active');
            };

            $('#burgerBtn, #overlay').on('click', toggleMenu);

            // Smooth Scroll & Auto-close sidebar
            $('.nav-link').on('click', function(e) {
                // Remove active class from all
                $('.nav-link').removeClass('active');
                // Add to clicked
                $(this).addClass('active');

                if (this.hash !== "") {
                    e.preventDefault();
                    const hash = this.hash;
                    
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){
                        window.location.hash = hash;
                    });
                    
                    // Close menu if open
                    if ($('#sidebar').hasClass('active')) {
                        toggleMenu();
                    }
                }
            });

            // Scroll Reveal Animation
            const revealElements = $('.reveal');
            const checkReveal = () => {
                const windowHeight = $(window).height();
                const scrollTop = $(window).scrollTop();
                
                revealElements.each(function() {
                    const elementTop = $(this).offset().top;
                    // Trigger when element is 150px into viewport
                    if (elementTop < scrollTop + windowHeight - 100) {
                        $(this).addClass('visible');
                    }
                });

                // Update active nav link based on scroll position
                $('section').each(function() {
                    const top = $(window).scrollTop();
                    const offset = $(this).offset().top - 100;
                    const id = $(this).attr('id');
                    
                    if (top >= offset) {
                        $('.nav-link').removeClass('active');
                        $('.sidebar').find('a[href="#' + id + '"]').addClass('active');
                    }
                });
            };

            // Trigger on scroll and on load
            $(window).on('scroll', checkReveal);
            checkReveal(); // Initial check

            // News card hover animation
            $('.news-card').hover(
                function() {
                    $(this).find('.news-image i').addClass('fa-bounce');
                },
                function() {
                    $(this).find('.news-image i').removeClass('fa-bounce');
                }
            );
        });
    </script>
    <?php wp_footer(); ?>
</body>
</html>
