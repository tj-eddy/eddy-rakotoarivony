$(document).ready(function () {

  /* =============================================
     NAVBAR — Burger menu + Dropdown Services
  ============================================= */
  $('#burger-btn').on('click', function () {
    $('#mobile-menu').toggleClass('hidden');
    $('#burger-icon').toggleClass('hidden');
    $('#close-icon').toggleClass('hidden');
  });

  // Services dropdown (hover + click)
  $('#services-dropdown').on('mouseenter', function () {
    $('#services-menu').removeClass('hidden');
  }).on('mouseleave', function () {
    $('#services-menu').addClass('hidden');
  });

  // Active nav link detection
  var currentPage = window.location.pathname.split('/').pop() || 'index.html';
  $('.nav-link').each(function () {
    var page = $(this).data('page');
    if (
      (page === 'index' && currentPage === 'index.html') ||
      (page !== 'index' && currentPage.indexOf(page) !== -1)
    ) {
      $(this).addClass('text-teal-600 font-semibold border-b-2 border-teal-600');
      $(this).removeClass('text-gray-700');
    }
  });

  /* =============================================
     SCROLL ANIMATIONS — Fade-in + Slide-up
  ============================================= */
  function animateOnScroll() {
    $('.animate-on-scroll').each(function () {
      var elementTop = $(this).offset().top;
      var viewportBottom = $(window).scrollTop() + $(window).height();
      if (elementTop < viewportBottom - 60) {
        $(this).addClass('animated');
      }
    });
  }

  $(window).on('scroll', animateOnScroll);
  animateOnScroll();

  /* =============================================
     SKILL BARS ANIMATION
  ============================================= */
  function animateSkillBars() {
    $('.skill-bar').each(function () {
      var elementTop = $(this).offset().top;
      var viewportBottom = $(window).scrollTop() + $(window).height();
      if (elementTop < viewportBottom - 30 && !$(this).hasClass('animated')) {
        var width = $(this).data('width');
        $(this).addClass('animated').css('width', width + '%');
      }
    });
  }

  $(window).on('scroll', animateSkillBars);
  animateSkillBars();

  /* =============================================
     BLOG DATA — 24 articles simulés
  ============================================= */
  var blogArticles = [
    // PrestaShop (6)
    {
      id: 1, titre: "Comment créer un module PrestaShop personnalisé en 2025",
      categorie: "PrestaShop", extrait: "Découvrez étape par étape comment développer votre propre module PrestaShop pour répondre aux besoins spécifiques de votre boutique en ligne.",
      date: "15 Janvier 2025", lecture: "8 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=PrestaShop"
    },
    {
      id: 2, titre: "Optimiser les performances de votre boutique PrestaShop",
      categorie: "PrestaShop", extrait: "Cache, compression d'images, CDN... Voici toutes les techniques pour booster la vitesse de votre site PrestaShop et améliorer votre SEO.",
      date: "22 Janvier 2025", lecture: "10 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Performance"
    },
    {
      id: 3, titre: "Migration PrestaShop 1.7 vers 8 : guide complet",
      categorie: "PrestaShop", extrait: "La migration majeure qui change tout. Planifiez votre montée de version PrestaShop sans perdre vos données ni votre référencement.",
      date: "5 Février 2025", lecture: "15 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Migration"
    },
    {
      id: 4, titre: "Les meilleurs thèmes PrestaShop gratuits en 2025",
      categorie: "PrestaShop", extrait: "Sélection des thèmes PrestaShop gratuits les plus performants, responsive et optimisés SEO pour lancer votre boutique rapidement.",
      date: "18 Février 2025", lecture: "6 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Thèmes"
    },
    {
      id: 5, titre: "Intégrer un système de paiement sécurisé sur PrestaShop",
      categorie: "PrestaShop", extrait: "Stripe, PayPal, virement bancaire... Comment configurer et sécuriser vos méthodes de paiement sur PrestaShop pour maximiser les conversions.",
      date: "3 Mars 2025", lecture: "9 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Paiement"
    },
    {
      id: 6, titre: "SEO PrestaShop : les réglages indispensables",
      categorie: "PrestaShop", extrait: "URLs, balises meta, sitemap XML, rich snippets... Configurez PrestaShop pour dominer les résultats de recherche Google.",
      date: "20 Mars 2025", lecture: "12 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=SEO"
    },
    // WordPress (6)
    {
      id: 7, titre: "Créer un site WordPress professionnel sans coder",
      categorie: "WordPress", extrait: "Avec les bons outils et plugins, créez un site WordPress élégant et fonctionnel même sans connaissances techniques. Guide complet 2025.",
      date: "10 Janvier 2025", lecture: "7 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=WordPress"
    },
    {
      id: 8, titre: "WooCommerce vs PrestaShop : lequel choisir ?",
      categorie: "WordPress", extrait: "Comparatif détaillé entre WooCommerce et PrestaShop pour votre boutique en ligne. Prix, fonctionnalités, scalabilité — on compare tout.",
      date: "25 Janvier 2025", lecture: "11 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=WooCommerce"
    },
    {
      id: 9, titre: "Les 10 plugins WordPress indispensables en 2025",
      categorie: "WordPress", extrait: "SEO, sécurité, performance, formulaires... Notre sélection des plugins WordPress essentiels pour tout type de site web professionnel.",
      date: "8 Février 2025", lecture: "8 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Plugins"
    },
    {
      id: 10, titre: "Sécuriser votre site WordPress en 2025",
      categorie: "WordPress", extrait: "Mots de passe forts, double authentification, sauvegardes automatiques, pare-feu... Protégez votre WordPress des hackers avec ces 15 bonnes pratiques.",
      date: "14 Février 2025", lecture: "10 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Sécurité"
    },
    {
      id: 11, titre: "Développer un thème WordPress enfant personnalisé",
      categorie: "WordPress", extrait: "Apprenez à créer un theme enfant WordPress proprement, sans risquer de perdre vos modifications lors des mises à jour.",
      date: "28 Février 2025", lecture: "9 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Thème+Enfant"
    },
    {
      id: 12, titre: "WordPress Multisite : gérer plusieurs sites depuis un seul panneau",
      categorie: "WordPress", extrait: "Découvrez comment configurer et administrer un réseau WordPress Multisite pour gérer plusieurs sites web avec une seule installation.",
      date: "15 Mars 2025", lecture: "13 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Multisite"
    },
    // Symfony (4)
    {
      id: 13, titre: "Débuter avec Symfony 7 : installation et premier projet",
      categorie: "Symfony", extrait: "Guide complet pour installer Symfony 7, configurer votre environnement de développement et créer votre première application web PHP.",
      date: "12 Janvier 2025", lecture: "14 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Symfony"
    },
    {
      id: 14, titre: "Doctrine ORM avec Symfony : maîtriser les relations entre entités",
      categorie: "Symfony", extrait: "OneToMany, ManyToMany, ManyToOne... Comprenez et maîtrisez les relations Doctrine pour concevoir des bases de données robustes avec Symfony.",
      date: "2 Février 2025", lecture: "16 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Doctrine"
    },
    {
      id: 15, titre: "API REST avec Symfony et API Platform",
      categorie: "Symfony", extrait: "Construisez une API RESTful professionnelle avec Symfony et API Platform en quelques heures. Documentation automatique, validation, sécurité incluses.",
      date: "22 Février 2025", lecture: "18 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=API+REST"
    },
    {
      id: 16, titre: "Twig pour les débutants : templates Symfony expliqués",
      categorie: "Symfony", extrait: "Découvrez Twig, le moteur de template de Symfony. Syntaxe, filtres, macros, héritage de templates — tout ce qu'il faut savoir pour démarrer.",
      date: "10 Mars 2025", lecture: "10 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Twig"
    },
    // Maintenance (4)
    {
      id: 17, titre: "Pourquoi la maintenance web est indispensable ?",
      categorie: "Maintenance", extrait: "Sécurité, performance, compatibilité... Découvrez pourquoi négliger la maintenance de votre site web peut coûter très cher à terme.",
      date: "8 Janvier 2025", lecture: "5 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Maintenance"
    },
    {
      id: 18, titre: "Checklist de maintenance mensuelle pour votre site web",
      categorie: "Maintenance", extrait: "Mises à jour, sauvegardes, monitoring, tests de performance... Notre checklist complète pour maintenir votre site en parfaite santé chaque mois.",
      date: "20 Janvier 2025", lecture: "7 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Checklist"
    },
    {
      id: 19, titre: "Comment sauvegarder automatiquement votre site web",
      categorie: "Maintenance", extrait: "Backups automatiques, stockage cloud, restauration en cas de crash... Mettez en place une stratégie de sauvegarde bulletproof pour votre site.",
      date: "5 Mars 2025", lecture: "9 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Sauvegarde"
    },
    {
      id: 20, titre: "Monitoring de site web : les outils gratuits à connaître",
      categorie: "Maintenance", extrait: "UptimeRobot, Google Search Console, GTmetrix... Tour d'horizon des meilleurs outils gratuits pour surveiller la santé de votre site web 24h/24.",
      date: "22 Mars 2025", lecture: "8 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Monitoring"
    },
    // Conseils (4)
    {
      id: 21, titre: "Comment choisir son développeur web freelance ?",
      categorie: "Conseils", extrait: "Portfolio, tarifs, communication, délais... Les critères essentiels pour sélectionner le bon développeur web freelance pour votre projet.",
      date: "3 Janvier 2025", lecture: "6 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Conseils"
    },
    {
      id: 22, titre: "Rédiger un cahier des charges web efficace",
      categorie: "Conseils", extrait: "Un bon cahier des charges évite les malentendus et les dépassements de budget. Voici comment rédiger un CDC complet pour votre projet web.",
      date: "17 Janvier 2025", lecture: "11 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=CDC"
    },
    {
      id: 23, titre: "Les tendances web à suivre en 2025",
      categorie: "Conseils", extrait: "IA générative, Web 3.0, accessibilité, Core Web Vitals... Quelles sont les tendances qui vont dominer le développement web en 2025 ?",
      date: "1 Février 2025", lecture: "8 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=Tendances+2025"
    },
    {
      id: 24, titre: "Quel CMS choisir pour votre site web en 2025 ?",
      categorie: "Conseils", extrait: "WordPress, PrestaShop, Shopify, Webflow... Comparatif complet des principaux CMS pour vous aider à faire le meilleur choix selon votre projet.",
      date: "12 Mars 2025", lecture: "13 min", image: "https://placehold.co/400x250/e0f2f1/0d9488?text=CMS"
    }
  ];

  /* =============================================
     BLOG PAGE — Filtres + Recherche + Pagination
  ============================================= */
  if ($('#blog-container').length) {
    var articlesPerPage = 6;
    var currentPage = 1;
    var filteredArticles = blogArticles.slice();
    var activeCategory = 'Tous';
    var searchTerm = '';

    function filterArticles() {
      filteredArticles = blogArticles.filter(function (a) {
        var matchCat = activeCategory === 'Tous' || a.categorie === activeCategory;
        var matchSearch = a.titre.toLowerCase().indexOf(searchTerm) !== -1 ||
          a.extrait.toLowerCase().indexOf(searchTerm) !== -1 ||
          a.categorie.toLowerCase().indexOf(searchTerm) !== -1;
        return matchCat && matchSearch;
      });
      currentPage = 1;
      renderArticles();
      renderPagination();
    }

    function renderArticles() {
      var start = (currentPage - 1) * articlesPerPage;
      var pageArticles = filteredArticles.slice(start, start + articlesPerPage);
      var total = filteredArticles.length;

      $('#blog-count').text('Affichage ' + (start + 1) + '-' + Math.min(start + articlesPerPage, total) + ' sur ' + total + ' articles');

      var html = '';
      if (pageArticles.length === 0) {
        html = '<div class="col-span-3 text-center py-16 text-gray-500"><p class="text-lg">Aucun article trouvé.</p></div>';
      } else {
        pageArticles.forEach(function (a) {
          var catColor = {
            'PrestaShop': 'bg-blue-100 text-blue-700',
            'WordPress': 'bg-purple-100 text-purple-700',
            'Symfony': 'bg-orange-100 text-orange-700',
            'Maintenance': 'bg-green-100 text-green-700',
            'Conseils': 'bg-teal-100 text-teal-700'
          }[a.categorie] || 'bg-teal-100 text-teal-700';

          html += '<article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col animate-on-scroll">' +
            '<img src="' + a.image + '" alt="' + a.titre + '" class="w-full h-48 object-cover">' +
            '<div class="p-6 flex flex-col flex-1">' +
            '<span class="inline-block ' + catColor + ' text-xs font-semibold px-2 py-1 rounded-full mb-3 self-start">' + a.categorie + '</span>' +
            '<h2 class="font-bold text-gray-800 text-lg mb-2 leading-snug"><a href="blog-article.html?id=' + a.id + '" class="hover:text-teal-600 transition duration-300">' + a.titre + '</a></h2>' +
            '<p class="text-gray-500 text-sm flex-1 mb-4">' + a.extrait + '</p>' +
            '<div class="flex items-center justify-between text-xs text-gray-400 mt-auto">' +
            '<span>' + a.date + '</span>' +
            '<span>' + a.lecture + ' de lecture</span>' +
            '</div>' +
            '<a href="blog-article.html?id=' + a.id + '" class="mt-4 inline-block text-center bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition duration-300 text-sm font-medium">Lire la suite</a>' +
            '</div></article>';
        });
      }
      $('#blog-container').html(html);
    }

    function renderPagination() {
      var totalPages = Math.ceil(filteredArticles.length / articlesPerPage);
      var html = '';

      if (totalPages <= 1) { $('#pagination').html(''); return; }

      html += '<button id="prev-page" class="px-4 py-2 rounded-lg border border-teal-300 text-teal-600 hover:bg-teal-50 disabled:opacity-40 disabled:cursor-not-allowed transition duration-300" ' + (currentPage === 1 ? 'disabled' : '') + '>← Précédent</button>';

      for (var i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
          html += '<button class="page-btn px-4 py-2 rounded-lg bg-teal-600 text-white font-semibold" data-page="' + i + '">' + i + '</button>';
        } else {
          html += '<button class="page-btn px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-teal-50 hover:border-teal-300 transition duration-300" data-page="' + i + '">' + i + '</button>';
        }
      }

      html += '<button id="next-page" class="px-4 py-2 rounded-lg border border-teal-300 text-teal-600 hover:bg-teal-50 disabled:opacity-40 disabled:cursor-not-allowed transition duration-300" ' + (currentPage === totalPages ? 'disabled' : '') + '>Suivant →</button>';
      html += '<span class="text-gray-500 text-sm self-center">Page ' + currentPage + ' sur ' + totalPages + '</span>';

      $('#pagination').html(html);

      $('#prev-page').on('click', function () {
        if (currentPage > 1) { currentPage--; renderArticles(); renderPagination(); $('html,body').animate({ scrollTop: $('#blog-container').offset().top - 100 }, 400); }
      });
      $('#next-page').on('click', function () {
        if (currentPage < totalPages) { currentPage++; renderArticles(); renderPagination(); $('html,body').animate({ scrollTop: $('#blog-container').offset().top - 100 }, 400); }
      });
      $('.page-btn').on('click', function () {
        currentPage = parseInt($(this).data('page'));
        renderArticles(); renderPagination();
        $('html,body').animate({ scrollTop: $('#blog-container').offset().top - 100 }, 400);
      });
    }

    // Filtres catégorie
    $('.filter-btn').on('click', function () {
      $('.filter-btn').removeClass('bg-teal-600 text-white').addClass('border border-gray-300 text-gray-700');
      $(this).addClass('bg-teal-600 text-white').removeClass('border border-gray-300 text-gray-700');
      activeCategory = $(this).data('cat');
      filterArticles();
    });

    // Recherche
    $('#search-input').on('input', function () {
      searchTerm = $(this).val().toLowerCase().trim();
      filterArticles();
    });

    // Init
    renderArticles();
    renderPagination();
  }

  /* =============================================
     CONTACT FORM — Validation jQuery
  ============================================= */
  if ($('#contact-form').length) {
    $('#contact-form').on('submit', function (e) {
      e.preventDefault();
      var valid = true;
      var nom = $('#nom').val().trim();
      var email = $('#email').val().trim();
      var sujet = $('#sujet').val();
      var message = $('#message').val().trim();
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      $('.field-error').text('');
      $('.form-field').removeClass('border-red-400').addClass('border-teal-300');

      if (!nom) { $('#nom-error').text('Le nom est requis.'); $('#nom').removeClass('border-teal-300').addClass('border-red-400'); valid = false; }
      if (!email || !emailRegex.test(email)) { $('#email-error').text('Email invalide.'); $('#email').removeClass('border-teal-300').addClass('border-red-400'); valid = false; }
      if (!sujet) { $('#sujet-error').text('Veuillez choisir un sujet.'); $('#sujet').removeClass('border-teal-300').addClass('border-red-400'); valid = false; }
      if (!message || message.length < 10) { $('#message-error').text('Message trop court (10 caractères min).'); $('#message').removeClass('border-teal-300').addClass('border-red-400'); valid = false; }

      if (valid) {
        $('#contact-form').addClass('hidden');
        $('#success-message').removeClass('hidden').hide().fadeIn(600);
      }
    });
  }

  /* =============================================
     STICKY NAVBAR — shadow au scroll
  ============================================= */
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 10) {
      $('#navbar').addClass('shadow-md');
    } else {
      $('#navbar').removeClass('shadow-md');
    }
  });

});
