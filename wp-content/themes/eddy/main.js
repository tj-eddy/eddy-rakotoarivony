/**
 * Eddy Theme - Main JavaScript
 * Main JavaScript file for the portfolio theme
 */

(function ($) {
    'use strict';

    $(document).ready(function () {
        // Typing effect for hero subtitle
        const subtitleText = "Expert PrestaShop · WordPress · Symfony";
        const $subtitle = $('.typing-text');
        let charIndex = 0;

        function typeSubtitle() {
            if (charIndex < subtitleText.length) {
                $subtitle.text(subtitleText.substring(0, charIndex + 1));
                charIndex++;
                setTimeout(typeSubtitle, 50);
            }
        }

        // Start typing after animation
        setTimeout(typeSubtitle, 1800);

        // Hero mouse parallax effect
        $('#hero').on('mousemove', function (e) {
            const x = (e.pageX - $(window).width() / 2) / 50;
            const y = (e.pageY - $(window).height() / 2) / 50;

            $('.floating-shape').each(function (index) {
                const speed = (index + 1) * 0.5;
                $(this).css('transform', `translate(${x * speed}px, ${y * speed}px)`);
            });
        });

        // Burger Menu Toggle
        const toggleMenu = () => {
            $('#burgerBtn').toggleClass('active');
            $('#sidebar').toggleClass('active');
            $('#overlay').toggleClass('active');
        };

        $('#burgerBtn, #overlay').on('click', toggleMenu);

        // Smooth Scroll & Auto-close sidebar
        $('.nav-link').on('click', function (e) {
            // Remove active class from all
            $('.nav-link').removeClass('active');
            // Add to clicked
            $(this).addClass('active');

            if (this.hash !== "") {
                e.preventDefault();
                const hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {
                    window.location.hash = hash;
                });

                // Close menu if open
                if ($('#sidebar').hasClass('active')) {
                    toggleMenu();
                }
            }
        });

        // Scroll Reveal Animation
        const revealElements = $('.reveal');
        const checkReveal = () => {
            const windowHeight = $(window).height();
            const scrollTop = $(window).scrollTop();

            revealElements.each(function () {
                const elementTop = $(this).offset().top;
                // Trigger when element is 150px into viewport
                if (elementTop < scrollTop + windowHeight - 100) {
                    $(this).addClass('visible');
                }
            });

            // Update active nav link based on scroll position
            $('section').each(function () {
                const top = $(window).scrollTop();
                const offset = $(this).offset().top - 100;
                const id = $(this).attr('id');

                if (top >= offset) {
                    $('.nav-link').removeClass('active');
                    $('.sidebar').find('a[href="#' + id + '"]').addClass('active');
                }
            });
        };

        // Trigger on scroll and on load
        $(window).on('scroll', checkReveal);
        checkReveal(); // Initial check

        // News card hover animation
        $('.news-card').hover(
            function () {
                $(this).find('.news-image i').addClass('fa-bounce');
            },
            function () {
                $(this).find('.news-image i').removeClass('fa-bounce');
            }
        );
    });

})(jQuery);
