<?php
/**
 * Eddy Theme Header
 * 
 * @package Eddy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<style>
    :root {
        --primary-color: #7FFFD4;
        --primary-dark: #45b894;
        --bg-dark: #0f1115;
        --text-light: #e0e0e0;
        --text-muted: #8892b0;
    }
    
    #header {
        padding: 32px 24px;
        text-align: center;
        background: linear-gradient(180deg, rgba(127, 255, 212, 0.04) 0%, transparent 100%);
        border-bottom: 1px solid rgba(127, 255, 212, 0.12);
    }

    #headerimg {
        max-width: 720px;
        margin: 0 auto;
    }

    #header h1 {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        font-size: 1.6rem;
        font-weight: 600;
        margin: 0 0 10px;
        letter-spacing: -0.02em;
    }

    #header h1 a {
        color: #fff;
        text-decoration: none;
        transition: color 0.2s;
    }

    #header h1 a:hover {
        color: var(--primary-color);
        text-shadow: 0 0 20px rgba(127, 255, 212, 0.4);
    }

    #header .description {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin: 0;
        font-weight: 400;
    }
</style>

<div id="header" role="banner">
    <div id="headerimg">
        <h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
        <div class="description"><?php bloginfo('description'); ?></div>
    </div>
</div>
