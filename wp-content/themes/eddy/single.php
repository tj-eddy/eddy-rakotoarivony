<?php get_header(); ?>

<style>
    :root {
        --primary-color: #7FFFD4;
        --primary-dark: #45b894;
        --bg-dark: #0f1115;
        --bg-darker: #07080a;
        --text-light: #e0e0e0;
        --text-muted: #8892b0;
        --font-display: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        --font-body: 'SF Pro Text', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
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
        line-height: 1.7;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Background */
    .site-background {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: -1;
        background: 
            radial-gradient(ellipse at 15% 15%, rgba(127, 255, 212, 0.06) 0%, transparent 50%),
            radial-gradient(ellipse at 85% 85%, rgba(69, 184, 148, 0.04) 0%, transparent 50%),
            var(--bg-dark);
    }

    /* Back Button */
    .back-btn {
        position: fixed;
        top: 24px;
        left: 24px;
        z-index: 1000;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(15, 17, 21, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(127, 255, 212, 0.15);
        padding: 10px 20px;
        border-radius: 24px;
        color: var(--text-light);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.25s ease;
    }

    .back-btn:hover {
        background: var(--primary-color);
        color: var(--bg-dark);
        transform: translateX(-3px);
    }

    .back-btn i {
        font-size: 0.75rem;
    }

    /* Main Container */
    .blog-container {
        max-width: 720px;
        margin: 0 auto;
        padding: 100px 24px 80px;
    }

    /* Article Header */
    .article-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .article-category {
        display: inline-block;
        background: var(--primary-color);
        color: var(--bg-dark);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
    }

    .article-title {
        font-family: var(--font-display);
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 600;
        color: #fff;
        line-height: 1.25;
        margin: 0 0 24px;
        letter-spacing: -0.02em;
    }

    .article-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .article-meta i {
        color: var(--primary-color);
        font-size: 0.8rem;
    }

    .article-author-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary-color);
    }

    /* Featured Image */
    .article-featured-image {
        margin: 0 -24px 48px;
        border-radius: 0;
        overflow: hidden;
    }

    .article-featured-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Article Content */
    .article-content {
        font-size: 1rem;
        line-height: 1.8;
        color: #d8d8d8;
    }

    .article-content p {
        margin: 0 0 1.5em;
    }

    .article-content h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 600;
        color: #fff;
        margin: 2em 0 0.75em;
        letter-spacing: -0.01em;
    }

    .article-content h3 {
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 600;
        color: #fff;
        margin: 1.75em 0 0.6em;
    }

    .article-content a {
        color: var(--primary-color);
        text-decoration: none;
        border-bottom: 1px solid rgba(127, 255, 212, 0.3);
        transition: border-color 0.2s;
    }

    .article-content a:hover {
        border-bottom-color: var(--primary-color);
    }

    .article-content ul,
    .article-content ol {
        margin: 1.25em 0;
        padding-left: 1.5em;
    }

    .article-content li {
        margin-bottom: 0.5em;
    }

    .article-content blockquote {
        border-left: 3px solid var(--primary-color);
        margin: 2em 0;
        padding: 1em 1.5em;
        background: rgba(127, 255, 212, 0.03);
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #c8c8c8;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 1.5em 0;
        border-radius: 8px;
    }

    .article-content code {
        background: rgba(127, 255, 212, 0.08);
        padding: 2px 6px;
        border-radius: 4px;
        font-family: 'SF Mono', Menlo, Monaco, monospace;
        font-size: 0.9em;
        color: var(--primary-color);
    }

    .article-content pre {
        background: #14161a;
        padding: 20px;
        border-radius: 10px;
        overflow-x: auto;
        margin: 1.5em 0;
    }

    .article-content pre code {
        background: none;
        padding: 0;
        font-size: 0.85rem;
        line-height: 1.6;
    }

    /* Article Footer */
    .article-footer {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid rgba(127, 255, 212, 0.1);
    }

    .article-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 24px;
    }

    .article-tag {
        background: rgba(127, 255, 212, 0.06);
        color: var(--primary-color);
        padding: 6px 14px;
        border-radius: 18px;
        font-size: 0.75rem;
        text-decoration: none;
        transition: all 0.2s;
    }

    .article-tag:hover {
        background: var(--primary-color);
        color: var(--bg-dark);
    }

    /* Share Buttons */
    .article-share {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .share-label {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .share-buttons {
        display: flex;
        gap: 10px;
    }

    .share-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.04);
        color: var(--text-light);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .share-btn:hover {
        background: var(--primary-color);
        color: var(--bg-dark);
    }

    /* Author Box */
    .author-box {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(127, 255, 212, 0.08);
        border-radius: 12px;
        padding: 20px;
        margin-top: 40px;
    }

    .author-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bg-dark);
        font-weight: 600;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .author-info {
        flex: 1;
    }

    .author-name {
        font-weight: 600;
        color: #fff;
        margin-bottom: 4px;
    }

    .author-bio {
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.5;
    }

    /* Post Navigation */
    .post-nav {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 48px;
    }

    .post-nav-link {
        display: block;
        padding: 20px;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(127, 255, 212, 0.08);
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.25s;
    }

    .post-nav-link:hover {
        border-color: var(--primary-color);
        background: rgba(127, 255, 212, 0.03);
    }

    .post-nav-label {
        font-size: 0.7rem;
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .post-nav-title {
        font-family: var(--font-display);
        font-size: 0.95rem;
        color: #fff;
        line-height: 1.4;
    }

    /* Comments */
    .comments-section {
        max-width: 720px;
        margin: 60px auto 0;
        padding: 0 24px 80px;
    }

    .comments-title {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 32px;
        text-align: center;
    }

    .comments-title::after {
        content: '';
        display: block;
        width: 40px;
        height: 2px;
        background: var(--primary-color);
        margin: 16px auto 0;
    }

    .comment-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .comment {
        background: rgba(255,255,255,0.015);
        border: 1px solid rgba(127, 255, 212, 0.06);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .comment-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bg-dark);
        font-weight: 600;
        font-size: 0.85rem;
    }

    .comment-meta {
        flex: 1;
    }

    .comment-author {
        font-weight: 600;
        color: #fff;
        font-size: 0.9rem;
    }

    .comment-date {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .comment-body {
        color: #c4c4c4;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Comment Form */
    .comment-form {
        background: rgba(255,255,255,0.015);
        border: 1px solid rgba(127, 255, 212, 0.08);
        border-radius: 12px;
        padding: 24px;
        margin-top: 32px;
    }

    .comment-form-title {
        font-family: var(--font-display);
        font-size: 1.1rem;
        color: #fff;
        margin-bottom: 20px;
    }

    .comment-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 14px 16px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        color: #fff;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .comment-form input:focus,
    .comment-form textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        background: rgba(255,255,255,0.05);
    }

    .comment-form textarea {
        min-height: 120px;
        resize: vertical;
    }

    .comment-form .submit-btn {
        background: transparent;
        color: var(--primary-color);
        border: 1.5px solid var(--primary-color);
        padding: 12px 28px;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 24px;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 8px;
    }

    .comment-form .submit-btn:hover {
        background: var(--primary-color);
        color: var(--bg-dark);
    }

    /* Responsive */
    @media (max-width: 600px) {
        .blog-container {
            padding: 80px 20px 60px;
        }

        .article-meta {
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .post-nav {
            grid-template-columns: 1fr;
        }

        .comment-form-row {
            grid-template-columns: 1fr;
        }

        .back-btn {
            top: 16px;
            left: 16px;
            padding: 8px 14px;
            font-size: 0.8rem;
        }
    }
</style>

<!-- Background -->
<div class="site-background"></div>

<!-- Back Button -->
<a href="<?php echo home_url('/#actualites'); ?>" class="back-btn">
    <i class="fa-solid fa-arrow-left"></i> Retour
</a>

<!-- Article -->
<article class="blog-container">
    <header class="article-header">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<span class="article-category">' . esc_html($categories[0]->name) . '</span>';
        }
        ?>
        <h1 class="article-title"><?php the_title(); ?></h1>
        <div class="article-meta">
            <?php
            $author_id = get_the_author_meta('ID');
            ?>
            <img src="<?php echo get_avatar_url($author_id, array('size' => 64)); ?>" alt="<?php the_author(); ?>" class="article-author-img">
            <span class="article-meta-item"><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
            <span class="article-meta-item"><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
            <span class="article-meta-item"><i class="fa-regular fa-comment"></i> <?php comments_number('0', '1', '%'); ?></span>
        </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
    <div class="article-featured-image">
        <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
    </div>
    <?php endif; ?>

    <div class="article-content">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>

    <footer class="article-footer">
        <?php
        $tags = get_the_tags();
        if ($tags) :
        ?>
        <div class="article-tags">
            <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="article-tag">#<?php echo $tag->name; ?></a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="article-share">
            <span class="share-label">Partager:</span>
            <div class="share-buttons">
                <a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>" class="share-btn" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="share-btn" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
            </div>
        </div>
    </footer>

    <!-- Author Box -->
    <div class="author-box">
        <div class="author-avatar">
            <?php
            $author_name = get_the_author();
            $words = explode(' ', $author_name);
            echo strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
            ?>
        </div>
        <div class="author-info">
            <div class="author-name"><?php the_author(); ?></div>
            <div class="author-bio"><?php the_author_meta('description'); ?></div>
        </div>
    </div>

    <!-- Post Navigation -->
    <nav class="post-nav">
        <?php
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        ?>
        <?php if (!empty($prev_post)) : ?>
        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="post-nav-link">
            <div class="post-nav-label">← Précédent</div>
            <div class="post-nav-title"><?php echo $prev_post->post_title; ?></div>
        </a>
        <?php endif; ?>
        
        <?php if (!empty($next_post)) : ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>" class="post-nav-link">
            <div class="post-nav-label">Suivant →</div>
            <div class="post-nav-title"><?php echo $next_post->post_title; ?></div>
        </a>
        <?php endif; ?>
    </nav>
</article>

<!-- Comments -->
<?php
if (comments_open() || get_comments_number()) :
?>
<section class="comments-section">
    <h3 class="comments-title">Commentaires</h3>
    
    <?php comments_template(); ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>
