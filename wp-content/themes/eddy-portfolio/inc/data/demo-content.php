<?php
/**
 * Données de démonstration du thème Eddy Portfolio.
 * Contient les articles, services et termes de taxonomie à insérer en BDD.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Retourne le tableau de données démo.
 *
 * @return array{posts: array, services: array, post_tech_terms: array, categories: array}
 */
function eddy_get_demo_content(): array {

    return [

        // ============================================
        // ARTICLES DE BLOG (3 actus professionnelles)
        // ============================================
        'posts' => [

            // ── Article 1 : PrestaShop ──────────────
            [
                'post_title'         => 'Optimiser les performances d\'une boutique PrestaShop 8 : guide complet',
                'post_content'       => '<p>La performance d\'une boutique en ligne est aujourd\'hui un facteur critique, aussi bien pour l\'expérience utilisateur que pour le référencement naturel. Dans cet article, nous explorons les techniques avancées pour atteindre des scores PageSpeed supérieurs à 90 sur une boutique PrestaShop 8.</p>

<h2>Contexte et enjeux</h2>
<p>Google considère les Core Web Vitals comme signal de classement depuis 2021. Une boutique mal optimisée peut perdre jusqu\'à 30 % de son trafic organique. Les trois métriques à surveiller : LCP (Largest Contentful Paint), INP (Interaction to Next Paint) et CLS (Cumulative Layout Shift).</p>

<h2>Optimisations serveur</h2>
<ul>
<li><strong>Cache CCC</strong> — activation du Combine, Compress, Cache natif PrestaShop pour CSS et JS.</li>
<li><strong>Redis / Varnish</strong> — mise en place d\'un cache objet pour réduire les requêtes MySQL.</li>
<li><strong>PHP 8.2 + OPcache</strong> — passage à la dernière version stable de PHP avec OPcache configuré.</li>
<li><strong>CDN Cloudflare</strong> — distribution des assets statiques au plus proche de l\'utilisateur.</li>
</ul>

<h2>Optimisations front-end</h2>
<ul>
<li>Conversion des images en WebP avec le module <em>PrestaShop WebP Converter</em>.</li>
<li>Attribut <code>loading="lazy"</code> sur toutes les images hors-viewport.</li>
<li>Suppression des modules inutilisés (réduction du DOM et des requêtes SQL).</li>
<li>Critical CSS inline pour éliminer le render-blocking.</li>
</ul>

<h2>Résultats mesurés</h2>
<p>Sur une boutique de 5 000 références : <strong>+67 % de score PageSpeed Mobile</strong>, LCP réduit de 4,2 s à 1,8 s, et <strong>+23 % de taux de conversion</strong> sur mobile.</p>

<h2>Conclusion</h2>
<p>L\'optimisation PrestaShop est un travail méthodique qui combine réglages serveur, bonnes pratiques front-end et monitoring continu. Un audit régulier avec Lighthouse et GTmetrix permet de maintenir les acquis dans la durée.</p>',
                'post_excerpt'       => 'Découvrez les techniques avancées pour booster la vitesse de chargement d\'une boutique PrestaShop 8 et améliorer votre score PageSpeed Mobile au-delà de 90.',
                'post_status'        => 'publish',
                'post_date'          => '2025-03-10 09:00:00',
                'post_category'      => [ 'PrestaShop' ],
                'post_tech'          => [ 'PrestaShop', 'Performance', 'PHP' ],
                'featured_image_url' => 'https://picsum.photos/seed/prestashop-perf/800/420',
                'featured_image_alt' => 'Tableau de bord performance boutique e-commerce PrestaShop',
            ],

            // ── Article 2 : WordPress ───────────────
            [
                'post_title'         => 'Développer un thème WordPress sur-mesure avec Tailwind CSS et ACF',
                'post_content'       => '<p>WordPress propulse encore plus de 43 % du web en 2025. Développer un thème entièrement sur-mesure — en sortant du cadre des thèmes parent — offre une maîtrise totale des performances, de l\'accessibilité et du design. Voici notre approche avec Tailwind CSS et Advanced Custom Fields.</p>

<h2>Architecture du thème</h2>
<p>Un thème WordPress professionnel repose sur une hiérarchie de fichiers bien définie. Notre structure favorise la maintenabilité et la séparation des responsabilités :</p>
<ul>
<li><strong>functions.php</strong> — point d\'entrée unique, charge les modules via <code>require_once</code>.</li>
<li><strong>inc/</strong> — modules PHP isolés : setup, enqueue, CPT, taxonomies, customizer, AJAX.</li>
<li><strong>template-parts/</strong> — composants réutilisables (header, hero, cards, footer).</li>
<li><strong>assets/</strong> — CSS compilé Tailwind + JavaScript vanilla/jQuery.</li>
</ul>

<h2>Tailwind CSS via CDN Play</h2>
<p>Pour un thème portfolio sans build pipeline, Tailwind CSS Play CDN permet une intégration immédiate avec configuration inline dans <code>header.php</code>. La configuration personnalisée définit les couleurs primaires, les polices et les breakpoints spécifiques au projet.</p>

<h2>Advanced Custom Fields</h2>
<p>ACF Pro permet de créer des champs métier riches (répéteurs, galeries, relations) sans alourdir le code. Les champs sont définis programmatiquement via <code>acf_add_local_field_group()</code> pour versionner la configuration avec le thème.</p>

<h2>Performance et SEO</h2>
<p>Score Lighthouse 95+ obtenu grâce à : images WebP avec <code>srcset</code>, polices chargées avec <code>font-display: swap</code>, scripts différés via <code>defer</code> et balises meta Open Graph dynamiques.</p>

<h2>Conclusion</h2>
<p>Un thème WordPress sur-mesure bien architecturé est un investissement durable. Il offre des performances supérieures aux thèmes génériques et une flexibilité totale pour évoluer avec les besoins du projet.</p>',
                'post_excerpt'       => 'Comment concevoir un thème WordPress professionnel from scratch avec Tailwind CSS et ACF, en garantissant performances, maintenabilité et score Lighthouse 95+.',
                'post_status'        => 'publish',
                'post_date'          => '2025-02-18 09:00:00',
                'post_category'      => [ 'WordPress' ],
                'post_tech'          => [ 'WordPress', 'PHP', 'Performance' ],
                'featured_image_url' => 'https://picsum.photos/seed/wordpress-theme/800/420',
                'featured_image_alt' => 'Développement thème WordPress sur-mesure avec Tailwind CSS',
            ],

            // ── Article 3 : TMA ─────────────────────
            [
                'post_title'         => 'TMA efficace : structurer la maintenance applicative avec un cadre ITIL léger',
                'post_content'       => '<p>La Tierce Maintenance Applicative (TMA) est souvent perçue comme une prestation réactive et subie. Pourtant, une TMA structurée avec un cadre ITIL simplifié devient un véritable levier stratégique pour la pérennité d\'un système d\'information.</p>

<h2>Les trois types de maintenance</h2>
<ul>
<li><strong>Maintenance corrective</strong> — correction des anomalies et bugs signalés en production.</li>
<li><strong>Maintenance évolutive</strong> — développement de nouvelles fonctionnalités à périmètre contractuel.</li>
<li><strong>Maintenance préventive</strong> — mises à jour de sécurité, dépendances et nettoyage de dette technique.</li>
</ul>

<h2>Cadre ITIL léger : les 4 piliers</h2>
<p>Pour des projets de taille moyenne, un ITIL complet serait contre-productif. Notre framework réduit retient l\'essentiel :</p>
<ul>
<li><strong>Gestion des incidents</strong> — qualification sur 4 niveaux de priorité : P1 (bloquant, SLA 4 h) → P4 (mineur, SLA 5 j).</li>
<li><strong>Gestion des changements</strong> — toute évolution passe par une revue, un test en staging et une validation client.</li>
<li><strong>Gestion des problèmes</strong> — analyse post-incident pour identifier et éliminer les causes racines.</li>
<li><strong>Reporting</strong> — rapport mensuel automatisé : temps passé, incidents traités, disponibilité mesurée.</li>
</ul>

<h2>Stack technique retenu</h2>
<ul>
<li><strong>Ticketing</strong> — Jira Service Management ou Linear selon la taille de l\'équipe.</li>
<li><strong>Monitoring</strong> — UptimeRobot (disponibilité) + Sentry (erreurs applicatives) + alertes Slack.</li>
<li><strong>CI/CD</strong> — déploiements automatisés via GitHub Actions pour réduire le risque humain.</li>
</ul>

<h2>Résultats concrets</h2>
<p>Sur un contrat TMA e-commerce de 18 mois : <strong>99,7 % de disponibilité</strong>, temps de résolution P1 moyen 2,4 h (SLA 4 h), et satisfaction client 9,2/10 en fin de contrat.</p>

<h2>Conclusion</h2>
<p>Structurer une TMA avec un cadre ITIL allégé, des SLA clairs et des outils adaptés transforme une prestation subie en partenariat de confiance durable.</p>',
                'post_excerpt'       => 'Retour d\'expérience sur la mise en place d\'une TMA efficace : cadre ITIL léger, gestion des priorités, monitoring proactif et reporting mensuel automatisé.',
                'post_status'        => 'publish',
                'post_date'          => '2025-01-22 09:00:00',
                'post_category'      => [ 'TMA' ],
                'post_tech'          => [ 'TMA', 'PHP' ],
                'featured_image_url' => 'https://picsum.photos/seed/tma-support/800/420',
                'featured_image_alt' => 'Dashboard monitoring et maintenance applicative TMA',
            ],
        ],

        // ============================================
        // SERVICES (CPT eddy_service) — 4 expertises
        // ============================================
        'services' => [

            // ── 1. PrestaShop ───────────────────────
            [
                'post_title'   => 'Développement PrestaShop',
                'post_content' => '<p>Création de boutiques e-commerce PrestaShop sur-mesure, développement de modules métier, personnalisation de thèmes et migration de données. Maîtrise des versions 1.7 à 8.x, intégration ERP/CRM (Sage, Odoo), paiement multi-prestataires et optimisation des performances (Redis, WebP, CDN). Accompagnement complet de l\'audit technique au déploiement en production.</p>',
                'post_excerpt' => 'Boutiques e-commerce sur-mesure, modules métier, migrations et intégrations ERP/CRM. De la version 1.7 à la 8.x, avec performances optimisées (Redis, WebP, CDN).',
                'post_status'  => 'publish',
                'menu_order'   => 1,
                // SVG icon path (shopping-bag Lucide)
                'service_icon' => 'M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z M3 6h18 M16 10a4 4 0 01-8 0',
                'service_tags' => [ 'PrestaShop 8', 'Modules', 'E-commerce', 'PHP 8' ],
            ],

            // ── 2. WordPress ────────────────────────
            [
                'post_title'   => 'Développement WordPress',
                'post_content' => '<p>Conception de sites WordPress sur-mesure — thèmes, plugins et extensions métier. Architecture headless avec l\'API REST ou WPGraphQL alimentant des frontends Next.js. Intégration Gutenberg et Full-Site Editing, optimisation SEO technique, Core Web Vitals 95+ et sécurité renforcée (Wordfence, backups automatisés). Développement de solutions multisite et WooCommerce.</p>',
                'post_excerpt' => 'Sites et applications WordPress sur-mesure, thèmes et plugins, architecture headless, optimisation SEO et Core Web Vitals 95+. WooCommerce et multisite.',
                'post_status'  => 'publish',
                'menu_order'   => 2,
                // SVG icon path (globe Lucide)
                'service_icon' => 'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20 M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z',
                'service_tags' => [ 'WordPress 6', 'Headless', 'WooCommerce', 'SEO' ],
            ],

            // ── 3. Symfony ──────────────────────────
            [
                'post_title'   => 'Développement Symfony',
                'post_content' => '<p>Développement d\'applications web et d\'APIs REST robustes avec Symfony 6/7 et API Platform. Architecture hexagonale ou DDD selon la complexité du projet, authentification JWT (LexikJWTBundle), documentation OpenAPI automatique et tests d\'intégration complets avec PHPUnit et Behat. Expertise en Doctrine ORM, Messenger, Scheduler et déploiement Docker/CI-CD.</p>',
                'post_excerpt' => 'Applications web et APIs REST avec Symfony 6/7 et API Platform. Architecture DDD, auth JWT, documentation OpenAPI et pipeline CI/CD Docker.',
                'post_status'  => 'publish',
                'menu_order'   => 3,
                // SVG icon path (code-2 Lucide)
                'service_icon' => 'M4 17l6-6-6-6 M12 19h8',
                'service_tags' => [ 'Symfony 7', 'API Platform', 'PHP 8', 'Docker' ],
            ],

            // ── 4. TMA ──────────────────────────────
            [
                'post_title'   => 'TMA — Tierce Maintenance Applicative',
                'post_content' => '<p>Prise en charge complète de la maintenance corrective, évolutive et préventive de vos applications web. SLA garantis contractuellement (P1 en 4 h), monitoring proactif 24/7 (Sentry, UptimeRobot), rapport mensuel détaillé et gestion des incidents via cadre ITIL léger. Intervention sur tout stack PHP : PrestaShop, Symfony, WordPress, Laravel. Idéal pour PME sans équipe tech interne.</p>',
                'post_excerpt' => 'Maintenance corrective, évolutive et préventive avec SLA garantis. Monitoring 24/7, rapport mensuel et cadre ITIL léger pour tout projet PHP.',
                'post_status'  => 'publish',
                'menu_order'   => 4,
                // SVG icon path (wrench Lucide)
                'service_icon' => 'M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z',
                'service_tags' => [ 'TMA', 'SLA garanti', 'Monitoring', 'ITIL' ],
            ],
        ],

        // ============================================
        // TERMES TAXONOMIE post_tech
        // ============================================
        'post_tech_terms' => [
            'PrestaShop',
            'WordPress',
            'Symfony',
            'PHP',
            'TMA',
            'Performance',
        ],

        // ============================================
        // CATÉGORIES D'ARTICLES
        // ============================================
        'categories' => [
            'PrestaShop',
            'WordPress',
            'Symfony',
            'TMA',
            'Performance',
        ],
    ];
}
