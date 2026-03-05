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
 * @return array{posts: array, services: array, post_tech_terms: array}
 */
function eddy_get_demo_content(): array {

    return [

        // ============================================
        // ARTICLES DE BLOG
        // ============================================
        'posts' => [
            [
                'post_title'   => "Optimiser les performances d'une boutique PrestaShop : guide complet",
                'post_content' => '<p>La performance d\'une boutique en ligne est aujourd\'hui un facteur critique, aussi bien pour l\'expérience utilisateur que pour le référencement naturel. Dans cet article, nous allons explorer les techniques avancées pour booster votre boutique PrestaShop et atteindre des scores PageSpeed supérieurs à 90.</p>

<h2>Contexte et enjeux</h2>
<p>Google considère le Core Web Vitals comme un signal de classement depuis 2021. Une boutique PrestaShop mal optimisée peut perdre jusqu\'à 30% de son trafic organique face à des concurrents mieux optimisés. Les métriques clés à surveiller sont le LCP (Largest Contentful Paint), le FID (First Input Delay) et le CLS (Cumulative Layout Shift).</p>

<h2>Solutions mises en œuvre</h2>
<ul>
<li>Activation du cache CCC (Combine, Compress, Cache) natif PrestaShop</li>
<li>Configuration de Varnish ou Redis comme cache objet</li>
<li>Optimisation des images avec le module WebP Converter</li>
<li>Lazy loading natif pour les images hors viewport</li>
<li>Minification CSS/JS et suppression des modules inutilisés</li>
</ul>

<h2>Résultats obtenus</h2>
<p>Après application de ces optimisations sur une boutique de taille moyenne (5000 produits), les gains mesurés sont significatifs : +67% de score PageSpeed Mobile, -2.4s de temps de chargement LCP, et +23% de taux de conversion.</p>

<h2>Conclusion</h2>
<p>L\'optimisation des performances PrestaShop est un travail continu qui nécessite une approche méthodique. En combinant les optimisations serveur, les bonnes pratiques de développement et un monitoring régulier, vous pouvez maintenir votre boutique en excellente santé technique.</p>',
                'post_excerpt' => "Découvrez les techniques avancées pour booster la vitesse de chargement de votre boutique PrestaShop et améliorer votre score PageSpeed.",
                'post_status'  => 'publish',
                'post_date'    => '2025-02-28 09:00:00',
                'post_category' => [ 'PrestaShop' ],
                'tags_input'    => [],
                'post_tech'    => [ 'PrestaShop', 'Performance', 'PHP' ],
            ],
            [
                'post_title'   => "WordPress Headless avec l'API REST : architecture moderne pour 2025",
                'post_content' => '<p>Le WordPress headless représente une évolution majeure dans la façon de concevoir des sites web. En séparant le backend (WordPress) du frontend (React, Vue, Next.js), on obtient le meilleur des deux mondes : la puissance de l\'administration WordPress et la flexibilité d\'un framework JavaScript moderne.</p>

<h2>Contexte et enjeux</h2>
<p>Le modèle traditionnel WordPress monolithique présente des limites : couplage fort entre le back et le front, performances limitées par le rendu côté serveur PHP, et difficultés à maintenir une expérience omnicanale (web, mobile, IoT). Le headless répond à ces défis en décorrélant les responsabilités.</p>

<h2>Stack recommandé</h2>
<ul>
<li>Backend : WordPress 6.x + plugin ACF Pro pour les champs personnalisés</li>
<li>API : WP REST API native + WPGraphQL pour les requêtes complexes</li>
<li>Frontend : Next.js 14 avec App Router et Server Components</li>
<li>Cache : ISR avec revalidation webhook déclenché par WordPress</li>
</ul>

<h2>Conclusion</h2>
<p>L\'architecture WordPress headless est désormais mature et représente un excellent choix pour des projets ambitieux nécessitant performances et flexibilité.</p>',
                'post_excerpt' => "Comment utiliser WordPress comme CMS headless avec son API REST pour alimenter des frontends React ou Vue.js en maintenant la puissance de l'administration WP.",
                'post_status'  => 'publish',
                'post_date'    => '2025-02-15 09:00:00',
                'post_category' => [ 'WordPress' ],
                'post_tech'    => [ 'WordPress', 'PHP', 'Performance' ],
            ],
            [
                'post_title'   => "Symfony 7 et API Platform : créer une API REST robuste en 2025",
                'post_content' => '<p>Symfony 7, sorti fin 2023, apporte des améliorations significatives en termes de performance et d\'ergonomie. Combiné avec API Platform 3, il offre un environnement idéal pour développer des APIs robustes et bien documentées.</p>

<h2>Contexte et enjeux</h2>
<p>Le développement d\'APIs en PHP a considérablement évolué ces dernières années. Là où il fallait auparavant écrire des dizaines de controllers et serializers manuellement, API Platform automatise une grande partie de ce travail grâce aux annotations et aux ressources API.</p>

<h2>Architecture recommandée</h2>
<ul>
<li>Installation via Symfony CLI et Composer</li>
<li>Configuration de LexikJWTAuthenticationBundle pour l\'authentification</li>
<li>Définition des ressources API avec les attributs PHP 8</li>
<li>State Processors pour la logique métier complexe</li>
<li>Tests fonctionnels avec ApiTestCase de API Platform</li>
</ul>

<h2>Conclusion</h2>
<p>Symfony 7 avec API Platform constitue l\'une des solutions les plus complètes et productives pour développer des APIs PHP en 2025.</p>',
                'post_excerpt' => "Guide pratique pour construire une API REST production-ready avec Symfony 7 et API Platform, incluant authentification JWT, documentation OpenAPI et tests automatisés.",
                'post_status'  => 'publish',
                'post_date'    => '2025-02-03 09:00:00',
                'post_category' => [ 'Symfony' ],
                'post_tech'    => [ 'Symfony', 'PHP' ],
            ],
            [
                'post_title'   => "TMA : comment structurer le maintien en condition opérationnelle d'une application",
                'post_content' => '<p>La Tierce Maintenance Applicative (TMA) est souvent perçue comme une prestation "subie", réactive aux incidents. Pourtant, une TMA bien structurée est un levier stratégique pour la pérennité et l\'évolution d\'un système d\'information.</p>

<h2>Contexte et enjeux</h2>
<p>Un contrat TMA typique couvre la correction des anomalies, les petites évolutions, et le maintien en condition de sécurité (MCS). Sans processus clairement définis, la TMA devient rapidement ingérable : tickets mal qualifiés, priorités floues, délais non respectés, et client insatisfait.</p>

<h2>Framework TMA</h2>
<ul>
<li>Qualification des tickets sur 4 niveaux de priorité (P1 bloquant → P4 mineur)</li>
<li>SLA définis contractuellement : P1 = 4h, P2 = 24h, P3 = 72h, P4 = 5 jours</li>
<li>Monitoring proactif avec UptimeRobot + alertes Slack</li>
<li>Rapport mensuel automatisé : incidents, résolutions, temps passé</li>
</ul>

<h2>Conclusion</h2>
<p>Structurer une TMA avec des processus clairs et des outils adaptés transforme une prestation subie en véritable valeur ajoutée.</p>',
                'post_excerpt' => "Retour d'expérience sur la mise en place d'un contrat TMA efficace : processus ITIL, gestion des tickets, SLA, monitoring proactif et communication client.",
                'post_status'  => 'publish',
                'post_date'    => '2025-01-20 09:00:00',
                'post_category' => [ 'TMA' ],
                'post_tech'    => [ 'TMA' ],
            ],
            [
                'post_title'   => "Core Web Vitals 2025 : optimiser LCP, FID et CLS sur un site WordPress",
                'post_content' => '<p>Les Core Web Vitals sont devenus incontournables pour tout professionnel du web. En 2025, Google utilise ces métriques comme signal de classement direct.</p>

<h2>Les trois métriques clés</h2>
<p>LCP (Largest Contentful Paint) — doit être inférieur à 2.5s, FID/INP (Interaction to Next Paint) — doit être inférieur à 200ms, et CLS (Cumulative Layout Shift) — doit être inférieur à 0.1.</p>

<h2>Méthodologie d\'optimisation</h2>
<ul>
<li>Audit initial avec PageSpeed Insights + Chrome DevTools Performance tab</li>
<li>LCP : optimisation de l\'image hero (WebP, fetchpriority="high", preload)</li>
<li>LCP : déchargement des fonts avec font-display: swap + preconnect</li>
<li>INP : audit et remplacement des plugins JS lourds</li>
<li>CLS : réservation explicite de l\'espace pour images et iframes (aspect-ratio)</li>
</ul>

<h2>Résultats</h2>
<p>LCP final : 1.8s (vs 4.2s), CLS final : 0.04 (vs 0.28), Trafic organique : +35% en 3 mois.</p>',
                'post_excerpt' => "Guide technique pour améliorer les Core Web Vitals de votre site WordPress : outils de diagnostic, techniques d'optimisation et résultats mesurables sur des projets réels.",
                'post_status'  => 'publish',
                'post_date'    => '2025-01-08 09:00:00',
                'post_category' => [ 'Performance' ],
                'post_tech'    => [ 'WordPress', 'Performance' ],
            ],
        ],

        // ============================================
        // SERVICES (CPT eddy_service)
        // ============================================
        'services' => [
            [
                'post_title'   => 'Développement PrestaShop',
                'post_content' => 'Création de boutiques e-commerce PrestaShop sur-mesure, développement de modules, personnalisation de thèmes et optimisation des performances. Maîtrise des versions 1.7 à 8.x. Migration de données, intégration ERP/CRM et accompagnement post-déploiement.',
                'post_excerpt' => 'Création de boutiques e-commerce PrestaShop sur-mesure, développement de modules, personnalisation de thèmes et optimisation des performances.',
                'post_status'  => 'publish',
                'menu_order'   => 1,
            ],
            [
                'post_title'   => 'Développement Symfony',
                'post_content' => "Développement d'applications web et d'APIs REST robustes avec Symfony 6/7. Architecture DDD, API Platform, tests automatisés et documentation OpenAPI intégrée. Expertise en Doctrine ORM, Messenger et Scheduler.",
                'post_excerpt' => "Développement d'applications web et d'APIs REST robustes avec Symfony 6/7. Architecture DDD, API Platform, tests automatisés et documentation OpenAPI intégrée.",
                'post_status'  => 'publish',
                'menu_order'   => 2,
            ],
            [
                'post_title'   => 'Développement WordPress',
                'post_content' => "Création de sites WordPress sur-mesure, développement de thèmes et plugins, architecture headless avec l'API REST, optimisation SEO et Core Web Vitals. Support Gutenberg et Full-Site Editing.",
                'post_excerpt' => "Création de sites WordPress sur-mesure, développement de thèmes et plugins, architecture headless avec l'API REST, optimisation SEO et Core Web Vitals.",
                'post_status'  => 'publish',
                'menu_order'   => 3,
            ],
            [
                'post_title'   => 'TMA – Tierce Maintenance Applicative',
                'post_content' => 'Prise en charge complète de la maintenance corrective, évolutive et préventive de vos applications. SLA garantis, monitoring proactif et rapports mensuels détaillés. Cadre ITIL léger, ticketing structuré.',
                'post_excerpt' => 'Prise en charge complète de la maintenance corrective, évolutive et préventive de vos applications. SLA garantis, monitoring proactif et rapports mensuels détaillés.',
                'post_status'  => 'publish',
                'menu_order'   => 4,
            ],
            [
                'post_title'   => 'Intégration & Performance Web',
                'post_content' => 'Intégration pixel-perfect HTML5/CSS3, optimisation Core Web Vitals, audit de performance et mise en conformité RGPD. Scores Lighthouse 90+ garantis. Tailwind CSS, animations accessibles.',
                'post_excerpt' => 'Intégration pixel-perfect HTML5/CSS3, optimisation Core Web Vitals, audit de performance et mise en conformité RGPD. Scores Lighthouse 90+ garantis.',
                'post_status'  => 'publish',
                'menu_order'   => 5,
            ],
            [
                'post_title'   => 'Conseil & Audit Technique',
                'post_content' => "Audit de code, revue d'architecture, choix technologiques et accompagnement dans la transformation digitale. Rapports détaillés avec recommandations priorisées. Analyse de dette technique et roadmap d'amélioration.",
                'post_excerpt' => "Audit de code, revue d'architecture, choix technologiques et accompagnement dans la transformation digitale. Rapports détaillés avec recommandations priorisées.",
                'post_status'  => 'publish',
                'menu_order'   => 6,
            ],
        ],

        // ============================================
        // TERMES TAXONOMIE post_tech
        // ============================================
        'post_tech_terms' => [
            'PrestaShop',
            'Symfony',
            'WordPress',
            'PHP',
            'TMA',
            'Performance',
        ],

        // ============================================
        // CATÉGORIES D'ARTICLES
        // ============================================
        'categories' => [
            'PrestaShop',
            'Symfony',
            'WordPress',
            'TMA',
            'Performance',
        ],
    ];
}
