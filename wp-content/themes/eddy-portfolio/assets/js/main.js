/* =====================================================
   EDDY PORTFOLIO — main.js (WordPress)
   Logique frontend : dark mode, carrousel, contact AJAX
   ===================================================== */

/* global EDDY_VARS, POSTS_DATA */

// Active les animations reveal uniquement quand JS est disponible
// (doit être HORS du document.ready pour s'exécuter immédiatement)
document.documentElement.classList.add('js-ready');

(function ($) {
$(function () {

  // ── 1. Dark / Light Mode ──
  function initTheme() {
    var defaultTheme = (typeof EDDY_VARS !== 'undefined') ? EDDY_VARS.dark_mode_default : 'light';
    var saved = localStorage.getItem('eddy-theme');
    var useDark = saved === 'dark' ||
      (!saved && (defaultTheme === 'dark' || window.matchMedia('(prefers-color-scheme: dark)').matches));

    if (useDark) {
      $('html').addClass('dark');
      $('#theme-toggle').addClass('dark-active');
    }
  }

  function toggleTheme() {
    var isDark = $('html').hasClass('dark');
    $('html').toggleClass('dark');
    $('#theme-toggle').toggleClass('dark-active');
    localStorage.setItem('eddy-theme', isDark ? 'light' : 'dark');
  }

  initTheme();
  $('#theme-toggle').on('click', toggleTheme);

  // ── 3. Menu hamburger mobile ──
  $('#hamburger-btn').on('click', function () {
    $('#mobile-menu').toggleClass('open');
    var isOpen = $('#mobile-menu').hasClass('open');
    $(this).attr('aria-expanded', isOpen);
    $(this).find('svg').toggleClass('hidden');
  });

  $('#mobile-menu a').on('click', function () {
    $('#mobile-menu').removeClass('open');
    $('#hamburger-btn').attr('aria-expanded', false);
    $('#hamburger-btn').find('svg').each(function (i) {
      $(this).toggleClass('hidden', i === 1);
    });
  });

  // ── 4. Sticky header ──
  $(window).on('scroll.header', function () {
    if ($(window).scrollTop() > 10) {
      $('#main-header').addClass('scrolled');
    } else {
      $('#main-header').removeClass('scrolled');
    }
  });

  // ── 5. Smooth scroll (ancres internes) ──
  $('a[href^="#"]').on('click', function (e) {
    var href = $(this).attr('href');
    if (href === '#') return;
    var target = $(href);
    if (target.length) {
      e.preventDefault();
      var offset = $('#main-header').outerHeight() + 16;
      $('html, body').animate({ scrollTop: target.offset().top - offset }, 600, 'swing');
    }
  });

  // ── 6. Scrollspy navigation active (front-page uniquement) ──
  var sections = ['#services', '#actualites', '#contact'];

  if ($('#hero').length) {
    $(window).on('scroll.spy', function () {
      var scrollPos = $(window).scrollTop() + $('#main-header').outerHeight() + 20;
      sections.forEach(function (id) {
        var section = $(id);
        if (section.length) {
          var top    = section.offset().top;
          var bottom = top + section.outerHeight();
          if (scrollPos >= top && scrollPos < bottom) {
            $('.nav-link').removeClass('active');
            $('[href="' + id + '"]').addClass('active');
          }
        }
      });
    });
  }

  // ── 7. Scroll reveal ──
  if ('IntersectionObserver' in window) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          $(entry.target).addClass('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(function (el) {
      revealObserver.observe(el);
    });
  } else {
    // Fallback navigateurs anciens
    $('.reveal').addClass('visible');
  }

  // ── 8. Modal À propos ──
  function openModal() {
    $('#modal-about').addClass('open');
    $('body').css('overflow', 'hidden');
    setTimeout(function () { $('#modal-close').trigger('focus'); }, 50);
  }

  function closeModal() {
    $('#modal-about').removeClass('open');
    $('body').css('overflow', '');
  }

  $('#logo-btn, #hero-about-btn').on('click', openModal);
  $('#modal-close').on('click', closeModal);
  $('.modal-overlay').on('click', closeModal);

  $(document).on('keydown', function (e) {
    if (e.key === 'Escape' && $('#modal-about').hasClass('open')) closeModal();
  });

  // Focus trap dans la modal
  $('#modal-about').on('keydown', function (e) {
    if (e.key !== 'Tab') return;
    var focusable = $(this).find('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])').filter(':visible');
    if (focusable.length === 0) return;
    var first = focusable.first();
    var last  = focusable.last();
    if (e.shiftKey) {
      if (document.activeElement === first[0]) {
        e.preventDefault();
        last.trigger('focus');
      }
    } else {
      if (document.activeElement === last[0]) {
        e.preventDefault();
        first.trigger('focus');
      }
    }
  });

  // ── 9. Carrousel Actualités ──
  if ($('#carousel-track').length && typeof POSTS_DATA !== 'undefined' && POSTS_DATA.length > 0) {
    initCarousel();
  }

  function initCarousel() {
    var $track         = $('#carousel-track');
    var $dotsContainer = $('#carousel-dots');
    var currentIndex   = 0;
    var autoPlayTimer;
    var slidesPerView  = getSlidesPerView();
    var totalSlides    = POSTS_DATA.length;
    var maxIndex       = Math.max(0, totalSlides - slidesPerView);

    // Générer les slides depuis les données WP
    POSTS_DATA.forEach(function (post) {
      $track.append(buildPostCard(post));
    });

    // Générer les dots
    for (var i = 0; i <= maxIndex; i++) {
      $dotsContainer.append(
        $('<button>')
          .addClass('carousel-dot' + (i === 0 ? ' active' : ''))
          .attr({ 'aria-label': 'Slide ' + (i + 1), role: 'tab' })
          .data('index', i)
      );
    }

    function getSlidesPerView() {
      var w = $(window).width();
      if (w >= 1024) return 3;
      if (w >= 640) return 2;
      return 1;
    }

    function getSlideWidth() {
      return $track.parent().width() / slidesPerView;
    }

    function updateSlideWidths() {
      $track.children().css('width', getSlideWidth() + 'px');
    }

    function goTo(index) {
      index = Math.max(0, Math.min(index, maxIndex));
      currentIndex = index;
      $track.css('transform', 'translateX(-' + (currentIndex * getSlideWidth()) + 'px)');
      $('#carousel-dots .carousel-dot').removeClass('active').attr('aria-selected', false);
      $('#carousel-dots .carousel-dot').eq(currentIndex).addClass('active').attr('aria-selected', true);
    }

    function startAutoPlay() {
      autoPlayTimer = setInterval(function () {
        goTo(currentIndex >= maxIndex ? 0 : currentIndex + 1);
      }, 4000);
    }

    function stopAutoPlay() {
      clearInterval(autoPlayTimer);
    }

    updateSlideWidths();
    goTo(0);
    startAutoPlay();

    $track.parent().on('mouseenter', stopAutoPlay).on('mouseleave', startAutoPlay);
    $('#carousel-prev').on('click', function () { stopAutoPlay(); goTo(currentIndex - 1); startAutoPlay(); });
    $('#carousel-next').on('click', function () { stopAutoPlay(); goTo(currentIndex + 1); startAutoPlay(); });

    $dotsContainer.on('click', '.carousel-dot', function () {
      stopAutoPlay();
      goTo($(this).data('index'));
      startAutoPlay();
    });

    // Responsive resize
    var resizeTimer;
    $(window).on('resize.carousel', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        var newSPV = getSlidesPerView();
        if (newSPV !== slidesPerView) {
          slidesPerView = newSPV;
          maxIndex = Math.max(0, totalSlides - slidesPerView);
          updateSlideWidths();
          goTo(Math.min(currentIndex, maxIndex));
        } else {
          updateSlideWidths();
          goTo(currentIndex);
        }
      }, 150);
    });

    // Touch / Swipe
    var touchStartX = 0;
    $track[0].addEventListener('touchstart', function (e) {
      touchStartX = e.touches[0].clientX;
    }, { passive: true });
    $track[0].addEventListener('touchend', function (e) {
      var diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) {
        stopAutoPlay();
        goTo(diff > 0 ? currentIndex + 1 : currentIndex - 1);
        startAutoPlay();
      }
    }, { passive: true });
  }

  /**
   * Construit une card article pour le carrousel.
   * Utilise les données issues de WordPress (POSTS_DATA injecté via wp_add_inline_script).
   */
  function buildPostCard(post) {
    var $slide = $('<div>').addClass('carousel-slide px-3');
    var $card  = $('<article>').addClass('post-card');
    var siteUrl = (typeof EDDY_VARS !== 'undefined') ? EDDY_VARS.site_url : '';

    $card.html(
      '<img src="' + $('<div>').text(post.image).html() + '" ' +
           'alt="' + $('<div>').text(post.title).html() + '" ' +
           'class="post-card-img" loading="lazy">' +
      '<div class="post-card-body">' +
        (post.category ? '<span class="category-badge">' + $('<div>').text(post.category).html() + '</span>' : '') +
        '<h3 class="post-card-title">' + $('<div>').text(post.title).html() + '</h3>' +
        '<p class="post-card-excerpt">' + $('<div>').text(post.excerpt).html() + '</p>' +
        '<div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:0.75rem;border-top:1px solid var(--color-border)">' +
          '<span style="font-size:0.78rem;color:var(--color-text-muted)">' + $('<div>').text(post.date).html() + ' · ' + $('<div>').text(post.readTime).html() + '</span>' +
          '<a href="' + $('<div>').text(post.url).html() + '" class="btn-primary" style="padding:0.4rem 0.9rem;font-size:0.8rem">Lire la suite →</a>' +
        '</div>' +
      '</div>'
    );

    $slide.append($card);
    return $slide;
  }

  // ── 10. Copier le lien (page article) ──
  $('#copy-link-btn').on('click', function () {
    var url = $(this).data('url');
    if (navigator.clipboard) {
      navigator.clipboard.writeText(url).then(function () {
        $('#copy-link-btn').text('✓ Lien copié !');
        setTimeout(function () { $('#copy-link-btn').text('Copier le lien'); }, 2000);
      });
    }
  });

}); // end $(function)
}(jQuery)); // end no-conflict wrapper
