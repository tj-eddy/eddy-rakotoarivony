/**
 * Eddy Theme - Main JavaScript
 * Simplified JavaScript for better performance
 */

(function ($) {
    'use strict';

    $(document).ready(function () {
        // Burger Menu Toggle
        $('#burgerBtn, #overlay').on('click', function () {
            $('#burgerBtn').toggleClass('active');
            $('#sidebar').toggleClass('active');
            $('#overlay').toggleClass('active');
        });

        // Smooth Scroll for navigation links
        $('.nav-link').on('click', function (e) {
            if (this.hash !== "") {
                e.preventDefault();
                var hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 600, function () {
                    window.location.hash = hash;
                });

                // Close menu if open
                if ($('#sidebar').hasClass('active')) {
                    $('#burgerBtn').removeClass('active');
                    $('#sidebar').removeClass('active');
                    $('#overlay').removeClass('active');
                }
            }
        });

        // Active nav link on scroll (simple version)
        $(window).on('scroll', function () {
            var scrollPos = $(window).scrollTop() + 100;

            $('section').each(function () {
                var top = $(this).offset().top;
                var bottom = top + $(this).outerHeight();
                var id = $(this).attr('id');

                if (scrollPos >= top && scrollPos < bottom) {
                    $('.nav-link').removeClass('active');
                    $('.sidebar .nav-links a[href="#' + id + '"]').addClass('active');
                }
            });
        });
    });

})(jQuery);
