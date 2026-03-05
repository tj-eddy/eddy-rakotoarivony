<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <!-- Tailwind config inline (doit être avant le CDN) -->
    <script>
        window.tailwindConfig = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#F0FDFA', 100: '#CCFBF1', 200: '#99F6E4',
                            300: '#5EEAD4', 400: '#2DD4BF', 500: '#14B8A6',
                            600: '#0D9488', 700: '#0F766E', 800: '#115E59', 900: '#134E4A'
                        }
                    }
                }
            }
        };
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'antialiased' ); ?>>
<?php wp_body_open(); ?>

<!-- Barre de progression lecture (articles uniquement) -->
<?php if ( is_singular( 'post' ) ) : ?>
<div id="reading-progress" role="progressbar" aria-label="<?php esc_attr_e( 'Progression de lecture', 'eddy-portfolio' ); ?>"></div>
<?php endif; ?>

<?php get_template_part( 'template-parts/header/site-header' ); ?>
