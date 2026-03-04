# 🎯 Prompt — Conversion du Portfolio HTML en Thème WordPress Professionnel

## Contexte
J'ai déjà un **portfolio HTML/CSS/jQuery complet** (multi-pages, Tailwind CSS,
palette Teal, thème 100% clair) pour **Eddy RAKOTOARIVONY**, développeur web
freelance spécialisé en PrestaShop, WordPress et Symfony.

> 🎯 **Objectif :** Convertir ce template HTML en un **thème WordPress
> professionnel, complet et fonctionnel**, respectant les standards WordPress,
> les bonnes pratiques PHP et les exigences SEO modernes.

---

## 👤 Profil du site
- **Propriétaire :** Eddy RAKOTOARIVONY
- **Type de site :** Portfolio / Site vitrine professionnel
- **Métier :** Développeur Web Freelance
- **Services :** PrestaShop, WordPress, Symfony, Maintenance web

---

## 🛠️ Stack Technique du Thème

| Technologie            | Utilisation                                  |
|------------------------|----------------------------------------------|
| **PHP 8+**             | Logique WordPress, templates, fonctions      |
| **WordPress 6.x**      | CMS cible, Gutenberg compatible              |
| **Tailwind CSS** (CDN) | Framework CSS — palette `teal` claire        |
| **jQuery**             | Interactions, animations, pagination blog    |
| **WordPress REST API** | Pour les fonctionnalités dynamiques          |
| **ACF (optionnel)**    | Champs personnalisés pour les services       |

### 🎨 Charte graphique conservée — Thème CLAIR
| Élément                 | Couleur Tailwind             |
|-------------------------|------------------------------|
| Fond général            | `white` / `gray-50`          |
| Fond sections alternées | `teal-50`                    |
| Couleur primaire        | `teal-600`                   |
| Couleur secondaire      | `teal-400`                   |
| Navbar                  | `white` + bordure `teal-200` |
| Footer                  | `teal-50`                    |
| Texte principal         | `gray-800`                   |
| Boutons CTA             | `bg-teal-600 text-white`     |

---

## 📁 Structure complète du thème WordPress
```
wp-content/themes/eddy-portfolio/
│
├── style.css                  → En-tête du thème (nom, auteur, version)
├── functions.php              → Enqueue scripts, register menus,
│                                custom post types, widgets, hooks
├── index.php                  → Template fallback
├── header.php                 → Navbar commune (Tailwind + jQuery)
├── footer.php                 → Footer commun (4 colonnes)
├── sidebar.php                → Sidebar blog (articles récents,
│                                catégories, tags)
│
├── front-page.php             → Page d'accueil (Hero, Services,
│                                À propos, Blog, CTA)
├── page-a-propos.php          → Template page À propos
├── page-services.php          → Template liste des services
├── page-contact.php           → Template page Contact
│
├── single.php                 → Template article de blog (détail)
├── archive.php                → Liste blog paginée avec filtres
├── search.php                 → Résultats de recherche
├── 404.php                    → Page d'erreur 404 custom
│
├── template-parts/
│   ├── hero.php               → Bloc Hero réutilisable
│   ├── services-card.php      → Card service réutilisable
│   ├── blog-card.php          → Card article réutilisable
│   ├── cta-section.php        → Bloc CTA réutilisable
│   └── breadcrumb.php         → Breadcrumb réutilisable
│
├── custom-post-types/
│   ├── cpt-services.php       → CPT "Services" (PrestaShop,
│   │                            WordPress, Symfony, Maintenance)
│   └── cpt-portfolio.php      → CPT "Réalisations" (optionnel)
│
├── assets/
│   ├── css/
│   │   └── custom.css         → Styles complémentaires Tailwind
│   ├── js/
│   │   └── main.js            → jQuery : navbar, animations,
│   │                            pagination, validation contact
│   └── images/
│       └── placeholder/       → Images par défaut du thème
│
└── languages/
    └── eddy-portfolio.pot     → Fichier de traduction i18n
```

---

## 📄 Détail des fichiers clés

---

### ⚙️ `functions.php`
- `wp_enqueue_scripts()` : Tailwind CDN, jQuery, custom CSS/JS
- `register_nav_menus()` : menu principal + footer
- `add_theme_support()` : title-tag, post-thumbnails,
  custom-logo, html5, Gutenberg
- `register_sidebar()` : sidebar blog
- Déclaration des **Custom Post Types** :
  - `services` (titre, description, icône, page détail)
  - `portfolio` (titre, image, technologies, lien)
- Déclaration des **Custom Taxonomies** :
  - `service-category`
  - `blog-category`
- Shortcodes utiles :
  - `[contact_form]`
  - `[services_list]`
  - `[last_posts count="3"]`
- Intégration **Customizer WordPress** :
  - Couleur primaire modifiable
  - Infos de contact (email, téléphone, localisation)
  - Réseaux sociaux (LinkedIn, GitHub, WhatsApp)
  - Texte Hero (titre, sous-titre, CTA)

---

### 🏠 `front-page.php` — Accueil
- Hero dynamique (texte via Customizer ou ACF)
- Section Services : boucle WP sur CPT `services` (4 cards)
- Section À propos : contenu page "À propos" via `get_page()`
- Section Technologies : champ ACF ou hardcodé (badges)
- Section Blog : `WP_Query` 3 derniers articles
- Section CTA : lien vers page contact

---

### 📰 `archive.php` — Blog paginé
- Barre de recherche AJAX jQuery (filtre live)
- Filtre par catégorie (taxonomie WordPress)
- Grille **6 articles par page** (`posts_per_page = 6`)
- Boucle WordPress standard avec `have_posts()`
- **Pagination native WordPress** + style Tailwind teal :
  - `the_posts_pagination()` personnalisé
  - Boutons Précédent / Suivant stylisés
  - Numéros de pages avec page active `teal-600`
- Card article : thumbnail, catégorie badge, titre,
  extrait, date, temps de lecture estimé

---

### 📝 `single.php` — Détail article
- Breadcrumb : Accueil > Blog > Titre
- Image mise en avant `the_post_thumbnail()`
- Titre H1, auteur `the_author()`, date, catégorie, temps de lecture
- Corps article avec styles typographiques Tailwind
- Sidebar : articles récents, catégories, tags
- Section "Articles similaires" via `WP_Query` même catégorie
- Boutons partage réseaux sociaux
- CTA → page Contact

---

### ⚙️ `page-services.php` — Services
- Boucle sur CPT `services` → cards Tailwind
- Chaque card : icône ACF, titre, description, lien `single-service.php`
- CTA bas de page → Contact

---

### 📬 `page-contact.php` — Contact
- Formulaire HTML avec nonce WordPress (`wp_nonce_field`)
- Traitement AJAX jQuery + `wp_ajax` / `wp_ajax_nopriv`
- Envoi email via `wp_mail()`
- Validation côté client (jQuery) + serveur (PHP)
- Message succès/erreur animé
- Infos contact via Customizer (email, localisation)
- Icônes réseaux sociaux dynamiques via Customizer

---

## 🧭 `header.php` — Navbar
```
[Logo custom WordPress]  Accueil | À propos | Services ▾ | Blog | Contact
                                               └─ PrestaShop
                                               └─ WordPress
                                               └─ Symfony
                                               └─ Maintenance
```
- Logo via `get_custom_logo()`
- Menu via `wp_nav_menu()` (menu "Principal")
- **Dropdown Services** : sous-menu WordPress natif
- Lien actif : classe `current-menu-item` stylisée teal
- Menu burger mobile jQuery
- Sticky au scroll avec jQuery

---

## 🦶 `footer.php` — Footer
- Fond `teal-50`
- **4 colonnes :**
  - Col 1 : Logo + description + réseaux sociaux (Customizer)
  - Col 2 : Menu footer via `wp_nav_menu()` (menu "Footer")
  - Col 3 : CPT Services (liste dynamique)
  - Col 4 : Infos contact (Customizer)
- Copyright dynamique : `<?php echo date('Y'); ?>`
  © Eddy RAKOTOARIVONY

---

## 🔍 SEO intégré
- Compatibilité **Yoast SEO** / **Rank Math** (hooks et filtres)
- `wp_title()` + balises meta via Customizer
- Open Graph tags dans `header.php`
- Données structurées **JSON-LD** dans `front-page.php` :
  - Schema `Person`
  - Schema `LocalBusiness`
  - Schema `Service`
- Breadcrumb Schema `BreadcrumbList` sur pages internes
- Images avec `alt` dynamiques via `get_post_meta()`
- Sitemap compatible (Yoast / Rank Math)
- URLs propres via `get_permalink()`

---

## ✨ Qualité du code WordPress
- Respect des **WordPress Coding Standards**
- Sécurité : `esc_html()`, `esc_url()`, `sanitize_text_field()`,
  nonces sur formulaires
- Internationalisation : toutes les chaînes dans `__()`
  ou `_e()` avec domaine `eddy-portfolio`
- Hooks/Filters : utilisation de `add_action()` et `add_filter()`
- Pas de requêtes SQL directes — utilisation exclusive de `WP_Query`
- Compatibilité **Gutenberg** (pas de blocage de l'éditeur)
- Compatible **WordPress Multisite**

---

## 📦 Ordre de génération recommandé
> Génère les fichiers **un par un** dans cet ordre :

1. `style.css`                    → En-tête thème
2. `functions.php`                → Base complète du thème
3. `header.php`                   → Navbar commune
4. `footer.php`                   → Footer commun
5. `template-parts/breadcrumb.php`
6. `template-parts/services-card.php`
7. `template-parts/blog-card.php`
8. `template-parts/cta-section.php`
9. `front-page.php`               → Accueil
10. `page-a-propos.php`           → À propos
11. `page-services.php`           → Services
12. `archive.php`                 → Blog paginé
13. `single.php`                  → Article détail
14. `page-contact.php`            → Contact
15. `404.php`                     → Page erreur
16. `assets/js/main.js`           → jQuery complet
17. `assets/css/custom.css`       → Styles complémentaires
18. `custom-post-types/cpt-services.php`
19. `sidebar.php`                 → Sidebar blog
20. `search.php`                  → Résultats recherche

> Tous les fichiers doivent être **complets, cohérents, sécurisés**
> et respecter les **WordPress Coding Standards**.
> Le thème doit être **activable directement** depuis
> l'admin WordPress sans erreur.