/* =====================================================
   EDDY PORTFOLIO — single-post.js (WordPress)
   Scripts spécifiques à la page article
   ===================================================== */
(function ($) {
  $(function () {

    // ── 1. Barre de progression de lecture ──
    var $progress = $('#reading-progress');
    if ($progress.length) {
      $(window).on('scroll.reading', function () {
        var scrollTop = $(window).scrollTop();
        var docHeight = $(document).height();
        var windowHeight = $(window).height();
        var progress = (scrollTop / (docHeight - windowHeight)) * 100;
        $progress.css('width', Math.min(progress, 100) + '%').attr('aria-valuenow', Math.round(progress));
      });
    }

    // ── 2. Table des matières dynamique ──
    var $headings = $('.article-content h2, .article-content h3');

    if ($headings.length > 2 && $('#toc-container').length) {
      var $tocList = $('<ul>').addClass('space-y-2');

      $headings.each(function (i) {
        var id = 'heading-' + i;
        $(this).attr('id', id);

        var $li = $('<li>');
        var $a = $('<a>')
          .attr('href', '#' + id)
          .addClass('text-sm hover:text-teal-600 transition-colors')
          .css('color', 'var(--color-text-muted)')
          .text($(this).text());

        if ($(this).is('h3')) {
          $li.addClass('ml-4');
        }

        $li.append($a);
        $tocList.append($li);
      });

      $('#toc-container').append($tocList).show();
    }

    // ── 3. Highlighting du titre actif dans la TOC ──
    if ($headings.length > 0) {
      $(window).on('scroll.toc', function () {
        var scrollPos = $(window).scrollTop() + 100;
        $headings.each(function () {
          var $heading = $(this);
          var id = $heading.attr('id');
          if (!id) return;
          var offset = $heading.offset().top;
          if (scrollPos >= offset) {
            $('#toc-container a').css('color', 'var(--color-text-muted)').css('font-weight', '');
            $('#toc-container a[href="#' + id + '"]').css('color', 'var(--color-primary)').css('font-weight', '600');
          }
        });
      });
    }

  }); // end $(function)
}(jQuery)); 