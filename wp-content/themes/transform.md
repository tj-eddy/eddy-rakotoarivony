Tu es un développeur WordPress senior expert en développement de thèmes custom,
architecture WordPress, performance et bonnes pratiques WP Codex / Theme Review.

Je t'ai fourni un template HTML/CSS/jQuery (portfolio one-page + page détail article)
composé de ces fichiers :
- index.html
- single-post.html
- assets/css/style.css
- assets/js/main.js
- assets/js/single-post.js

Ta mission : transformer ce template en un thème WordPress complet, professionnel,
100% dynamique, correctement structuré, documenté aux standards WordPress officiels,
avec toutes les données réelles insérées en base de données WordPress.

---

👤 CONTEXTE DU SITE
- Propriétaire : Eddy RAKOTOARIVONY
- Métier : Développeur Web PrestaShop | Symfony | WordPress | TMA
- Thème : "eddy-portfolio" (slug officiel du thème)
- Text domain : "eddy-portfolio"
- Version : 1.0.0

---

📁 STRUCTURE COMPLÈTE DU THÈME À GÉNÉRER

eddy-portfolio/
├── style.css                        (en-tête thème officiel WordPress)
├── functions.php                    (cerveau du thème)
├── index.php                        (fallback obligatoire)
├── front-page.php                   (page d'accueil one-page)
├── single.php                       (article standard)
├── single-post.php                  (détail article blog)
├── page.php                         (page statique)
├── archive.php                      (archive articles)
├── 404.php                          (page erreur)
├── search.php                       (résultats recherche)
│
├── template-parts/
│   ├── header/
│   │   ├── site-header.php          (header complet avec nav)
│   │   └── mobile-menu.php          (menu hamburger mobile)
│   ├── footer/
│   │   └── site-footer.php          (footer complet)
│   ├── home/
│   │   ├── section-hero.php         (section hero)
│   │   ├── section-services.php     (section services)
│   │   ├── section-actualites.php   (carrousel articles)
│   │   └── section-contact.php      (formulaire contact)
│   ├── post/
│   │   ├── post-card.php            (card article réutilisable)
│   │   ├── post-header.php          (image + meta + titre)
│   │   ├── post-content.php         (contenu article)
│   │   ├── post-sidebar.php         (sidebar article)
│   │   ├── post-navigation.php      (prev/next article)
│   │   ├── post-related.php         (articles similaires)
│   │   └── post-comments.php        (section commentaires)
│   └── modal/
│       └── modal-apropos.php        (modal à propos)
│
├── inc/
│   ├── theme-setup.php              (add_theme_support, menus, etc.)
│   ├── enqueue.php                  (styles et scripts)
│   ├── widgets.php                  (zones de widgets)
│   ├── custom-post-types.php        (CPT Services)
│   ├── taxonomies.php               (taxonomies custom)
│   ├── customizer.php               (options thème via Customizer)
│   ├── acf-fields.php               (champs ACF si ACF actif)
│   ├── ajax-handlers.php            (AJAX formulaire contact)
│   ├── seo-meta.php                 (meta SEO dynamiques)
│   └── data/
│       ├── insert-demo-data.php     (insertion données démo en BDD)
│       └── demo-content.php         (tableau de données démo)
│
├── assets/
│   ├── css/
│   │   ├── style-main.css           (styles principaux)
│   │   └── editor-style.css         (styles éditeur Gutenberg)
│   ├── js/
│   │   ├── main.js                  (scripts frontend)
│   │   ├── single-post.js           (scripts page article)
│   │   └── customizer-preview.js    (preview live customizer)
│   └── images/
│       └── screenshot.png           (capture thème 1200x900)
│
└── languages/
    └── eddy-portfolio.pot           (fichier traduction)

---

📄 DÉTAIL DE CHAQUE FICHIER À GÉNÉRER

════════════════════════════════════════
① style.css — EN-TÊTE THÈME OFFICIEL
════════════════════════════════════════
/*
 * Theme Name: Eddy Portfolio
 * Theme URI: https://eddyrakotoarivony.dev
 * Author: Eddy RAKOTOARIVONY
 * Author URI: https://eddyrakotoarivony.dev
 * Description: Thème portfolio professionnel pour développeur web PrestaShop, Symfony, WordPress et TMA. One-page moderne avec mode sombre/clair, carrousel actualités et gestion des services.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Tested up to: 6.7
 * Requires PHP: 8.0
 * License: GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: eddy-portfolio
 * Tags: portfolio, one-page, custom-colors, dark-mode, responsive-layout, blog, custom-menu
 */
Puis importer : @import url('assets/css/style-main.css');

════════════════════════════════════════
② functions.php — STRUCTURE PRINCIPALE
════════════════════════════════════════
Ne pas mettre toute la logique ici. Uniquement les require_once vers inc/ :

<?php
/**
 * Eddy Portfolio — functions.php
 * Point d'entrée principal du thème. Charge tous les modules via require_once.
 *
 * @package Eddy_Portfolio
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Constantes du thème
define( 'EDDY_THEME_VERSION', '1.0.0' );
define( 'EDDY_THEME_DIR', get_template_directory() );
define( 'EDDY_THEME_URI', get_template_directory_uri() );

// Chargement des modules
require_once EDDY_THEME_DIR . '/inc/theme-setup.php';
require_once EDDY_THEME_DIR . '/inc/enqueue.php';
require_once EDDY_THEME_DIR . '/inc/widgets.php';
require_once EDDY_THEME_DIR . '/inc/custom-post-types.php';
require_once EDDY_THEME_DIR . '/inc/taxonomies.php';
require_once EDDY_THEME_DIR . '/inc/customizer.php';
require_once EDDY_THEME_DIR . '/inc/ajax-handlers.php';
require_once EDDY_THEME_DIR . '/inc/seo-meta.php';
if ( function_exists('acf_add_local_field_group') ) {
    require_once EDDY_THEME_DIR . '/inc/acf-fields.php';
}

════════════════════════════════════════
③ inc/theme-setup.php
════════════════════════════════════════
Implémenter avec les hooks corrects et commentaires PHPDoc complets :

- after_setup_theme :
  → load_theme_textdomain( 'eddy-portfolio', EDDY_THEME_DIR . '/languages' )
  → add_theme_support( 'title-tag' )
  → add_theme_support( 'post-thumbnails' )
  → add_image_size( 'eddy-card', 800, 450, true )        // cards carrousel
  → add_image_size( 'eddy-hero', 1200, 600, true )        // hero article
  → add_image_size( 'eddy-thumb', 400, 300, true )        // miniatures
  → add_theme_support( 'html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'] )
  → add_theme_support( 'custom-logo', ['width'=>60,'height'=>60,'flex-width'=>true,'flex-height'=>true] )
  → add_theme_support( 'editor-styles' )
  → add_editor_style( 'assets/css/editor-style.css' )
  → add_theme_support( 'align-wide' )
  → add_theme_support( 'responsive-embeds' )
  → add_theme_support( 'wp-block-styles' )
  → register_nav_menus([
       'primary'  => __('Menu Principal', 'eddy-portfolio'),
       'footer'   => __('Menu Footer', 'eddy-portfolio'),
       'social'   => __('Liens Sociaux', 'eddy-portfolio')
    ])

════════════════════════════════════════
④ inc/enqueue.php
════════════════════════════════════════
Documenter chaque wp_enqueue_* avec commentaire :

- wp_enqueue_style 'eddy-google-fonts' → Google Fonts Plus Jakarta Sans + Inter
- wp_enqueue_style 'eddy-tailwind' → CDN Tailwind CSS
- wp_enqueue_style 'eddy-main' → assets/css/style-main.css (version EDDY_THEME_VERSION)
- wp_enqueue_script 'jquery' → déjà inclus WP, juste s'assurer de la dépendance
- wp_enqueue_script 'eddy-main' → assets/js/main.js (dépend: jquery, in_footer: true)
- Conditionnel is_singular('post') :
  → wp_enqueue_script 'eddy-single-post' → assets/js/single-post.js

- wp_localize_script 'eddy-main' → 'EDDY_VARS' :
  {
    ajax_url: admin_url('admin-ajax.php'),
    nonce: wp_create_nonce('eddy_nonce'),
    site_url: home_url(),
    theme_url: EDDY_THEME_URI,
    dark_mode_default: get_theme_mod('eddy_default_theme', 'light'),
    i18n: {
      send_success: __('Message envoyé avec succès !', 'eddy-portfolio'),
      send_error: __('Erreur lors de l\'envoi.', 'eddy-portfolio'),
      required_field: __('Ce champ est requis.', 'eddy-portfolio')
    }
  }

- admin_enqueue_scripts :
  → wp_enqueue_style 'eddy-admin' → CSS admin custom (styles metaboxes)

════════════════════════════════════════
⑤ inc/custom-post-types.php
════════════════════════════════════════
Créer le CPT "eddy_service" :

/**
 * Custom Post Type : Services
 * Slug : eddy_service
 * Utilisé pour la section Services du portfolio
 */
register_post_type( 'eddy_service', [
    'labels' => [
        'name'               => __('Services', 'eddy-portfolio'),
        'singular_name'      => __('Service', 'eddy-portfolio'),
        'add_new'            => __('Ajouter un service', 'eddy-portfolio'),
        'add_new_item'       => __('Ajouter un nouveau service', 'eddy-portfolio'),
        'edit_item'          => __('Modifier le service', 'eddy-portfolio'),
        'all_items'          => __('Tous les services', 'eddy-portfolio'),
        'search_items'       => __('Rechercher un service', 'eddy-portfolio'),
        'menu_name'          => __('Services', 'eddy-portfolio'),
    ],
    'public'              => true,
    'show_in_rest'        => true,       // Gutenberg + REST API
    'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
    'menu_icon'           => 'dashicons-hammer',
    'menu_position'       => 5,
    'has_archive'         => false,
    'rewrite'             => ['slug' => 'services'],
    'capability_type'     => 'post',
]);

════════════════════════════════════════
⑥ inc/taxonomies.php
════════════════════════════════════════
Créer 2 taxonomies :

1. "service_category" liée à "eddy_service" :
   - Hiérarchique (comme category)
   - Labels FR complets
   - show_in_rest: true

2. "post_tech" liée à "post" (remplace les tags pour les technos) :
   - Non hiérarchique (comme tag)
   - Labels : "Technologies", "Technologie"
   - show_in_rest: true
   - Termes prévus : PrestaShop, Symfony, WordPress, PHP, TMA, Performance

════════════════════════════════════════
⑦ inc/customizer.php
════════════════════════════════════════
Ajouter un Panel "Eddy Portfolio Options" avec ces sections/settings :

SECTION "Identité & Profil" :
- eddy_full_name           → text    → "Eddy RAKOTOARIVONY"
- eddy_job_title           → text    → "Développeur Web Full-Stack"
- eddy_tagline             → text    → "PrestaShop · Symfony · WordPress · TMA"
- eddy_bio_short           → textarea
- eddy_bio_full            → textarea
- eddy_email               → text
- eddy_linkedin_url        → url
- eddy_github_url          → url
- eddy_location            → text    → "Madagascar / Remote"
- eddy_available_freelance → checkbox → true

SECTION "Couleurs & Thème" :
- eddy_primary_color       → color   → #0F766E
- eddy_primary_dark        → color   → #0D9488
- eddy_default_theme       → select  → ['light','dark']

SECTION "Hero Section" :
- eddy_hero_title          → text
- eddy_hero_subtitle       → text
- eddy_hero_cta1_text      → text    → "Voir mes services"
- eddy_hero_cta2_text      → text    → "Me contacter"

SECTION "Section Services" :
- eddy_services_title      → text    → "Mes Services"
- eddy_services_subtitle   → textarea

SECTION "Section Actualités" :
- eddy_news_title          → text    → "Dernières Actualités"
- eddy_news_count          → number  → 5 (nb articles carrousel)

SECTION "Contact" :
- eddy_contact_title       → text
- eddy_contact_email_dest  → text    (email de réception)
- eddy_contact_map_embed   → textarea (iframe Google Maps optionnel)

SECTION "SEO" :
- eddy_meta_description    → textarea
- eddy_og_image            → image upload
- eddy_schema_twitter      → text    (@handle Twitter)

Chaque setting doit avoir :
→ sanitize_callback approprié (sanitize_text_field, sanitize_email, esc_url_raw, wp_kses_post)
→ transport: 'postMessage' pour les settings prévisualisables live
→ Commentaire PHPDoc complet

════════════════════════════════════════
⑧ inc/ajax-handlers.php
═════════════════════════