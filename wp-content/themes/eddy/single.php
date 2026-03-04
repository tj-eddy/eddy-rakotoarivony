<?php get_header(); ?>

<style>
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

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: var(--font-body);
        background-color: var(--bg-dark);
        color: var(--text-light);
        line-height: 1.8;
    }

    /* Header */
    .single-header {
        padding: 150px 20px 60px;
        text-align: center;
        position: relative;
        background: radial-gradient(circle at center, #1a2322 0%, var(--bg-darker) 100%);
    }

    .single-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: 
            radial-gradient(rgba(127, 255, 212, 0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveBackground 20s linear infinite;
    }

    @keyframes moveBackground {
        from { background-position: 0 0; }
        to { background-position: 100px 100px; }
    }

    .single-category {
        display: inline-block;
        background: var(--primary-color);
        color: var(--bg-dark);
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        position: relative;
    }

    .single-title {
        font-family: var(--font-display);
        font-size: clamp(2rem, 5vw, 3.5rem);
        color: #fff;
        max-width: 900px;
        margin: 0 auto 30px;
        line-height: 1.3;
        position: relative;
    }

    .single-meta {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        color: var(--text-muted);
        font-size: 0.9rem;
        position: relative;
    }

    .single-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .single-meta i {
        color: var(--primary-color);
    }

    /* Featured Image */
    .featured-image-container {
        max-width: 1000px;
        margin: 0 auto 50px;
        padding: 0 20px;
    }

    .featured-image {
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }

    .featured-image img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 15px;
    }

    /* Content */
    .single-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px 100px;
    }

    .entry-content {
        font-size: 1.1rem;
        line-height: 1.9;
    }

    .entry-content p {
        margin-bottom: 1.5em;
    }

    .entry-content h2, 
    .entry-content h3,
    .entry-content h4 {
        font-family: var(--font-display);
        color: #fff;
        margin-top: 2em;
        margin-bottom: 0.8em;
    }

    .entry-content h2 { font-size: 2rem; }
    .entry-content h3 { font-size: 1.5rem; }
    .entry-content h4 { font-size: 1.25rem; }

    .entry-content a {
        color: var(--primary-color);
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: border-color 0.3s;
    }

    .entry-content a:hover {
        border-bottom-color: var(--primary-color);
    }

    .entry-content ul,
    .entry-content ol {
        margin: 1.5em 0;
        padding-left: 1.5em;
    }

    .entry-content li {
        margin-bottom: 0.5em;
    }

    .entry-content blockquote {
        border-left: 4px solid var(--primary-color);
        margin: 2em 0;
        padding: 1em 2em;
        background: rgba(127, 255, 212, 0.05);
        border-radius: 0 10px 10px 0;
        font-style: italic;
    }

    .entry-content img {
        max-width: 100%;
        height: auto;
        margin: 1.5em 0;
        border-radius: 10px;
    }

    .entry-content code {
        background: rgba(127, 255, 212, 0.1);
        padding: 2px 8px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        color: var(--primary-color);
    }

    .entry-content pre {
        background: #1a1d23;
        padding: 20px;
        border-radius: 10px;
        overflow-x: auto;
        margin: 1.5em 0;
    }

    .entry-content pre code {
        background: none;
        padding: 0;
    }

    /* Tags */
    .post-tags {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid rgba(127, 255, 212, 0.2);
    }

    .post-tags-title {
        font-size: 1rem;
        color: var(--text-muted);
        margin-bottom: 15px;
    }

    .post-tag {
        display: inline-block;
        background: rgba(127, 255, 212, 0.1);
        color: var(--primary-color);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.3s;
    }

    .post-tag:hover {
        background: var(--primary-color);
        color: var(--bg-dark);
    }

    /* Navigation */
    .post-navigation {
        max-width: 800px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .nav-links {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .nav-previous,
    .nav-next {
        flex: 1;
        min-width: 250px;
    }

    .nav-previous a,
    .nav-next a {
        display: block;
        padding: 25px;
        background: rgba(255,255,255,0.03);
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid rgba(127, 255, 212, 0.1);
    }

    .nav-previous a:hover,
    .nav-next a:hover {
        background: rgba(127, 255, 212, 0.05);
        border-color: var(--primary-color);
        transform: translateY(-5px);
    }

    .nav-subtitle {
        font-size: 0.8rem;
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .nav-title {
        font-family: var(--font-display);
        font-size: 1.1rem;
        color: #fff;
    }

    /* Comments */
    .comments-section {
        max-width: 800px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .comments-title {
        font-family: var(--font-display);
        font-size: 1.8rem;
        color: #fff;
        margin-bottom: 40px;
        text-align: center;
    }

    .comment-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .comment {
        background: rgba(255,255,255,0.03);
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .comment-author {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .comment-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bg-dark);
        font-weight: bold;
    }

    .comment-meta {
        flex: 1;
    }

    .comment-author-name {
        font-weight: bold;
        color: #fff;
    }

    .comment-date {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .comment-content {
        color: var(--text-light);
    }

    /* Comment Form */
    .comment-respond {
        background: rgba(255,255,255,0.03);
        border-radius: 10px;
        padding: 30px;
        margin-top: 40px;
    }

    .comment-form label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-muted);
    }

    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 15px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
        border-radius: 5px;
        font-family: inherit;
        font-size: 1rem;
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .comment-form input:focus,
    .comment-form textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 10px rgba(127,255,212,0.2);
    }

    .comment-form .submit {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        padding: 15px 30px;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .comment-form .submit:hover {
        background: var(--primary-color);
        color: var(--bg-dark);
    }

    /* Burger Menu */
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
    }

    .sidebar.active {
        transform: translateX(-350px);
    }

    .nav-links-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-item-menu {
        margin: 20px 0;
    }

    .nav-link-menu {
        font-size: 1.5rem;
        font-family: var(--font-display);
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #fff;
        transition: color 0.3s;
    }

    .nav-link-menu:hover,
    .nav-link-menu.active {
        color: var(--primary-color);
    }

    @media screen and (max-width: 768px) {
        .single-header {
            padding: 120px 20px 40px;
        }

        .single-title {
            font-size: 1.8rem;
        }

        .single-meta {
            gap: 15px;
        }

        .sidebar {
            width: 100%;
            right: -100%;
        }

        .sidebar.active {
            transform: translateX(-100%);
        }

        .nav-links {
            flex-direction: column;
        }

        .nav-previous,
        .nav-next {
            min-width: 100%;
        }
    }
</style>

<!-- Burger Menu Button -->
<div class="burger-btn" id="burgerBtn">
    <div class="burger-line line-1"></div>
    <div class="burger-line line-2"></div>
    <div class="burger-line line-3"></div>
</div>

<!-- Overlay & Sidebar -->
<div class="overlay" id="overlay"></div>
<nav class="sidebar" id="sidebar">
    <ul class="nav-links-menu">
        <li class="nav-item-menu"><a href="<?php echo home_url('/'); ?>" class="nav-link-menu">Accueil</a></li>
        <li class="nav-item-menu"><a href="<?php echo home_url('/#services'); ?>" class="nav-link-menu">Services</a></li>
        <li class="nav-item-menu"><a href="<?php echo home_url('/#actualites'); ?>" class="nav-link-menu">Actualités</a></li>
        <li class="nav-item-menu"><a href="<?php echo home_url('/#contact'); ?>" class="nav-link-menu">Contact</a></li>
    </ul>
</nav>

<header class="single-header">
    <?php
    $categories = get_the_category();
    if (!empty($categories)) {
        echo '<span class="single-category">' . esc_html($categories[0]->name) . '</span>';
    }
    ?>
    <h1 class="single-title"><?php the_title(); ?></h1>
    <div class="single-meta">
        <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
        <span><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
        <span><i class="fa-regular fa-comment"></i> <?php comments_number('0 commentaire', '1 commentaire', '% commentaires'); ?></span>
    </div>
</header>

<?php if (has_post_thumbnail()) : ?>
<div class="featured-image-container">
    <div class="featured-image">
        <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
    </div>
</div>
<?php endif; ?>

<article class="single-content">
    <div class="entry-content">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>

    <?php
    $tags = get_the_tags();
    if ($tags) :
    ?>
    <div class="post-tags">
        <div class="post-tags-title">Tags:</div>
        <?php foreach ($tags as $tag) : ?>
            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="post-tag"><?php echo $tag->name; ?></a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</article>

<nav class="post-navigation">
    <?php
    previous_post_link('%link', '<span class="nav-subtitle">← Article précédent</span><span class="nav-title">%title</span>');
    next_post_link('%link', '<span class="nav-subtitle">Article suivant →</span><span class="nav-title">%title</span>');
    ?>
</nav>

<?php
if (comments_open() || get_comments_number()) :
?>
<section class="comments-section">
    <h3 class="comments-title">Commentaires (<?php comments_number('0', '1', '%'); ?>)</h3>
    
    <?php comments_template(); ?>
</section>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        // Burger Menu Toggle
        $('#burgerBtn, #overlay').on('click', function() {
            $('#burgerBtn').toggleClass('active');
            $('#sidebar').toggleClass('active');
            $('#overlay').toggleClass('active');
        });

        // Smooth scroll for nav links
        $('.nav-link-menu').on('click', function(e) {
            var href = $(this).attr('href');
            if (href.indexOf('#') > -1) {
                e.preventDefault();
                var hash = href.split('#')[1];
                $('html, body').animate({
                    scrollTop: $('#' + hash).offset().top
                }, 800);
                
                if ($('#sidebar').hasClass('active')) {
                    $('#burgerBtn').removeClass('active');
                    $('#sidebar').removeClass('active');
                    $('#overlay').removeClass('active');
                }
            }
        });
    });
</script>

<?php get_footer(); ?>
