<?php get_header(); ?>

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
