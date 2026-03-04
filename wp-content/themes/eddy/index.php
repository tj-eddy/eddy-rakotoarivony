<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero">
    <div class="hero-bg"></div>
    <div class="hero-blur-overlay"></div>
    <div class="particles"></div>
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    <div class="floating-shape shape-4"></div>
    
    <div class="hero-content">
        <div class="hero-profile">
            <img src="https://eddy-rakotoarivony.com/wp-content/uploads/2026/03/eddy-photo.jpg" alt="Eddy Rakotoarivony" onerror="this.src='https://via.placeholder.com/180x180/7FFFD4/0f1115?text=E';">
        </div>
        <h1 class="hero-title">
            <span class="word-1">Eddy</span>
            <span class="word-2">Rakotoarivony</span>
        </h1>
        <p class="hero-subtitle">
            <span class="typing-text">Expert PrestaShop · WordPress · Symfony</span>
        </p>
        <div class="hero-cta">
            <a href="#services" class="btn btn-primary">Voir mes services</a>
            <a href="#contact" class="btn">Me contacter</a>
        </div>
        <div class="hero-socials">
            <a href="https://linkedin.com/in/eddy-rakotoarivony" class="social-link" target="_blank" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="https://github.com/eddy-rakotoarivony" class="social-link" target="_blank" title="GitHub"><i class="fa-brands fa-github"></i></a>
        </div>
    </div>
    
    <div class="scroll-indicator">
        <span></span>
        <span></span>
        <span></span>
    </div>
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

<?php get_footer(); ?>
