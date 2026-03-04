/**
 * main.js — Script principal du thème Eddy Portfolio
 *
 * Fonctionnalités :
 *  1. Navbar sticky + burger menu mobile + dropdown Services
 *  2. Animations au scroll (fade-in + slide-up)
 *  3. Barres de compétences animées
 *  4. Formulaire de contact AJAX WordPress
 *  5. Recherche live dans le blog (filtre articles via WordPress REST API)
 *
 * Dépendances : jQuery (chargé via WordPress enqueue)
 * Localisation : eddyAjax.ajaxurl, eddyAjax.nonce, eddyAjax.homeUrl
 *
 * @package eddy-portfolio
 * @version 1.0.0
 */

/* global eddyAjax */

jQuery( document ).ready( function ( $ ) {

    'use strict';


    /* =========================================================================
       1. NAVBAR — Burger menu + Dropdown Services
    ========================================================================= */

    /**
     * Toggle du menu burger mobile.
     * Gère l'attribut aria-expanded pour l'accessibilité.
     */
    $( '#burger-btn' ).on( 'click', function () {
        var $menu    = $( '#mobile-menu' );
        var $burger  = $( '#burger-icon' );
        var $close   = $( '#close-icon' );
        var isOpen   = ! $menu.hasClass( 'hidden' );

        $menu.toggleClass( 'hidden' );
        $burger.toggleClass( 'hidden' );
        $close.toggleClass( 'hidden' );
        $( this ).attr( 'aria-expanded', ! isOpen );
    } );

    /**
     * Dropdown Services au survol (menu desktop).
     * Utilise le sous-menu WordPress natif (.sub-menu) si présent.
     */
    $( '.eddy-nav-list li.menu-item-has-children' ).on( 'mouseenter', function () {
        $( this ).find( '> .sub-menu' ).stop( true, true ).fadeIn( 150 );
    } ).on( 'mouseleave', function () {
        $( this ).find( '> .sub-menu' ).stop( true, true ).fadeOut( 150 );
    } );

    /**
     * Ferme le menu mobile quand on clique en dehors.
     */
    $( document ).on( 'click', function ( e ) {
        if ( ! $( e.target ).closest( '#navbar' ).length ) {
            $( '#mobile-menu' ).addClass( 'hidden' );
            $( '#burger-icon' ).removeClass( 'hidden' );
            $( '#close-icon' ).addClass( 'hidden' );
            $( '#burger-btn' ).attr( 'aria-expanded', 'false' );
        }
    } );

    /**
     * Ombre portée sur la navbar au scroll.
     */
    $( window ).on( 'scroll.navbar', function () {
        if ( $( this ).scrollTop() > 10 ) {
            $( '#navbar' ).addClass( 'shadow-md' );
        } else {
            $( '#navbar' ).removeClass( 'shadow-md' );
        }
    } );


    /* =========================================================================
       2. ANIMATIONS AU SCROLL (Fade-in + Slide-up)
    ========================================================================= */

    /**
     * Ajoute la classe .animated aux éléments .animate-on-scroll
     * lorsqu'ils entrent dans le viewport.
     */
    function animateOnScroll() {
        $( '.animate-on-scroll:not(.animated)' ).each( function () {
            var elementTop     = $( this ).offset().top;
            var viewportBottom = $( window ).scrollTop() + $( window ).height();
            if ( elementTop < viewportBottom - 60 ) {
                $( this ).addClass( 'animated' );
            }
        } );
    }

    $( window ).on( 'scroll.animations', animateOnScroll );
    animateOnScroll(); // Déclenche au chargement pour les éléments déjà visibles


    /* =========================================================================
       3. BARRES DE COMPÉTENCES (skill bars)
    ========================================================================= */

    /**
     * Anime les barres de compétences (.skill-bar) de 0 à data-width.
     * Ne s'anime qu'une seule fois grâce à la classe .animated.
     */
    function animateSkillBars() {
        $( '.skill-bar:not(.animated)' ).each( function () {
            var elementTop     = $( this ).offset().top;
            var viewportBottom = $( window ).scrollTop() + $( window ).height();
            if ( elementTop < viewportBottom - 30 ) {
                var targetWidth = $( this ).data( 'width' );
                $( this ).addClass( 'animated' ).css( 'width', targetWidth + '%' );
            }
        } );
    }

    $( window ).on( 'scroll.skillbars', animateSkillBars );
    animateSkillBars();


    /* =========================================================================
       4. FORMULAIRE DE CONTACT AJAX
    ========================================================================= */

    if ( $( '#contact-form' ).length ) {

        /**
         * Valide le champ email avec une expression régulière RFC 5322 simplifiée.
         *
         * @param  {string} email
         * @return {boolean}
         */
        function isValidEmail( email ) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( email );
        }

        /**
         * Affiche un message d'erreur sur un champ et applique le style rouge.
         *
         * @param {string} fieldId  ID du champ (sans #).
         * @param {string} message  Message d'erreur.
         */
        function showFieldError( fieldId, message ) {
            $( '#' + fieldId + '-error' ).text( message );
            $( '#contact-' + fieldId )
                .removeClass( 'border-teal-300' )
                .addClass( 'border-red-400' );
        }

        /**
         * Réinitialise l'état visuel d'un champ valide.
         *
         * @param {string} fieldId ID du champ (sans #).
         */
        function clearFieldError( fieldId ) {
            $( '#' + fieldId + '-error' ).text( '' );
            $( '#contact-' + fieldId )
                .removeClass( 'border-red-400' )
                .addClass( 'border-teal-300' );
        }

        $( '#contact-form' ).on( 'submit', function ( e ) {
            e.preventDefault();

            var nom     = $( '#contact-nom' ).val().trim();
            var email   = $( '#contact-email' ).val().trim();
            var sujet   = $( '#contact-sujet' ).val();
            var message = $( '#contact-message' ).val().trim();
            var nonce   = $( '#eddy_contact_nonce' ).val();
            var tel     = $( '#contact-tel' ).val().trim();
            var valid   = true;

            // Réinitialise les erreurs
            $( '.field-error' ).text( '' );
            $( '.form-field' ).removeClass( 'border-red-400' ).addClass( 'border-teal-300' );
            $( '#form-error' ).addClass( 'hidden' );

            // Validation côté client
            if ( ! nom ) {
                showFieldError( 'nom', 'Le nom est requis.' );
                valid = false;
            }
            if ( ! email || ! isValidEmail( email ) ) {
                showFieldError( 'email', 'Adresse email invalide.' );
                valid = false;
            }
            if ( ! sujet ) {
                showFieldError( 'sujet', 'Veuillez choisir un sujet.' );
                valid = false;
            }
            if ( ! message || message.length < 10 ) {
                showFieldError( 'message', 'Message trop court (10 caractères minimum).' );
                valid = false;
            }

            if ( ! valid ) {
                // Focus sur le premier champ en erreur
                $( '.border-red-400' ).first().focus();
                return;
            }

            // Affiche l'état de chargement
            $( '#btn-text' ).addClass( 'hidden' );
            $( '#btn-loading' ).removeClass( 'hidden' );
            $( 'button[type="submit"]' ).prop( 'disabled', true );

            // Envoi AJAX vers wp-admin/admin-ajax.php
            $.ajax( {
                url  : ( typeof eddyAjax !== 'undefined' ) ? eddyAjax.ajaxurl : '/wp-admin/admin-ajax.php',
                type : 'POST',
                data : {
                    action  : 'eddy_contact',
                    nonce   : nonce,
                    nom     : nom,
                    email   : email,
                    tel     : tel,
                    sujet   : sujet,
                    message : message
                },
                success: function ( response ) {
                    if ( response.success ) {
                        $( '#contact-form' ).addClass( 'hidden' );
                        $( '#success-message' ).removeClass( 'hidden' ).hide().fadeIn( 600 );
                    } else {
                        // Erreurs renvoyées par le serveur
                        $( '#form-error' ).removeClass( 'hidden' );
                        if ( response.data && response.data.errors ) {
                            var errMsg = response.data.errors.join( ' ' );
                            $( '#form-error p' ).text( errMsg );
                        }
                        resetSubmitButton();
                    }
                },
                error: function () {
                    $( '#form-error' ).removeClass( 'hidden' );
                    resetSubmitButton();
                }
            } );
        } );

        /**
         * Réinitialise l'état du bouton submit.
         */
        function resetSubmitButton() {
            $( '#btn-text' ).removeClass( 'hidden' );
            $( '#btn-loading' ).addClass( 'hidden' );
            $( 'button[type="submit"]' ).prop( 'disabled', false );
        }

        // Nettoyage des erreurs en temps réel
        $( '#contact-nom, #contact-email, #contact-sujet, #contact-message' ).on( 'input change', function () {
            var id = $( this ).attr( 'id' ).replace( 'contact-', '' );
            clearFieldError( id );
        } );
    }


    /* =========================================================================
       5. RECHERCHE LIVE BLOG (REST API WordPress)
    ========================================================================= */

    /**
     * Sur la page archive/blog, le champ #search-input filtre les articles
     * en temps réel via l'API REST WordPress sans rechargement de page.
     *
     * Note : si la REST API est désactivée, la recherche redirige vers la
     * page de résultats WordPress standard.
     */
    if ( $( '#search-input' ).length && $( '#blog-container' ).length ) {

        var searchTimer = null;

        $( '#search-input' ).on( 'input', function () {
            var term = $( this ).val().trim();

            clearTimeout( searchTimer );

            if ( term.length === 0 ) {
                // Recharge la page pour réafficher tous les articles
                window.location.reload();
                return;
            }

            if ( term.length < 2 ) {
                return; // Attend 2 caractères minimum
            }

            // Délai anti-rebond (debounce) de 400ms
            searchTimer = setTimeout( function () {
                $( '#blog-container' ).css( 'opacity', '0.5' );

                var apiBase = ( typeof eddyAjax !== 'undefined' )
                    ? eddyAjax.homeUrl + 'wp-json/wp/v2/posts'
                    : '/wp-json/wp/v2/posts';

                $.ajax( {
                    url     : apiBase,
                    type    : 'GET',
                    data    : {
                        search        : term,
                        per_page      : 6,
                        _embed        : 1,
                        status        : 'publish'
                    },
                    success : function ( posts ) {
                        renderSearchResults( posts, term );
                    },
                    error   : function () {
                        // Fallback : redirige vers la recherche WordPress native
                        var homeUrl = ( typeof eddyAjax !== 'undefined' )
                            ? eddyAjax.homeUrl
                            : '/';
                        window.location.href = homeUrl + '?s=' + encodeURIComponent( term );
                    }
                } );
            }, 400 );
        } );

        /**
         * Génère le HTML des cards d'articles depuis la réponse REST API.
         *
         * @param {Array}  posts Tableau des posts WordPress (REST).
         * @param {string} term  Terme de recherche.
         */
        function renderSearchResults( posts, term ) {
            var html = '';

            if ( ! posts || posts.length === 0 ) {
                html = '<div class="col-span-3 text-center py-16 text-gray-500">' +
                       '<p class="text-lg">Aucun article pour « ' + escapeHtml( term ) + ' »</p>' +
                       '</div>';
            } else {
                $.each( posts, function ( i, post ) {
                    var title   = post.title.rendered || '';
                    var excerpt = $( post.excerpt.rendered ).text().substring( 0, 120 ) + '…';
                    var link    = post.link || '#';
                    var date    = formatDate( post.date );
                    var thumb   = '';
                    var catName = '';
                    var catColor = 'bg-teal-100 text-teal-700';

                    // Image mise en avant
                    if ( post._embedded && post._embedded['wp:featuredmedia'] &&
                         post._embedded['wp:featuredmedia'][0] ) {
                        var media = post._embedded['wp:featuredmedia'][0];
                        var imgSrc = ( media.media_details &&
                                       media.media_details.sizes &&
                                       media.media_details.sizes['eddy-thumbnail'] )
                            ? media.media_details.sizes['eddy-thumbnail'].source_url
                            : media.source_url;
                        thumb = '<img src="' + escapeHtml( imgSrc ) + '" ' +
                                'alt="' + escapeHtml( title ) + '" ' +
                                'class="w-full h-48 object-cover" loading="lazy">';
                    } else {
                        thumb = '<img src="https://placehold.co/400x200/e0f2f1/0d9488?text=' +
                                encodeURIComponent( title.substring( 0, 20 ) ) + '" ' +
                                'alt="" class="w-full h-48 object-cover" loading="lazy">';
                    }

                    // Catégorie
                    if ( post._embedded && post._embedded['wp:term'] &&
                         post._embedded['wp:term'][0] && post._embedded['wp:term'][0][0] ) {
                        catName  = post._embedded['wp:term'][0][0].name;
                        catColor = getCatColor( catName );
                    }

                    html += '<article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col animate-on-scroll">' +
                        '<a href="' + escapeHtml( link ) + '" tabindex="-1" aria-hidden="true">' + thumb + '</a>' +
                        '<div class="p-6 flex flex-col flex-1">';

                    if ( catName ) {
                        html += '<span class="inline-block ' + catColor + ' text-xs font-semibold px-2 py-1 rounded-full mb-3 self-start">' +
                                escapeHtml( catName ) + '</span>';
                    }

                    html += '<h2 class="font-bold text-gray-800 text-lg mb-2 leading-snug">' +
                            '<a href="' + escapeHtml( link ) + '" class="hover:text-teal-600 transition">' +
                            escapeHtml( title ) + '</a></h2>' +
                            '<p class="text-gray-500 text-sm flex-1 mb-4">' + escapeHtml( excerpt ) + '</p>' +
                            '<div class="flex items-center justify-between text-xs text-gray-400 mt-auto">' +
                            '<time>' + date + '</time></div>' +
                            '<a href="' + escapeHtml( link ) + '" class="mt-4 inline-block text-center bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition text-sm font-medium">Lire la suite</a>' +
                            '</div></article>';
                } );
            }

            $( '#blog-container' ).html( html ).css( 'opacity', '1' );
            $( '#pagination' ).html( '' ); // Masque la pagination pendant la recherche

            // Relance les animations
            animateOnScroll();
        }

        /**
         * Retourne les classes Tailwind de couleur selon la catégorie.
         *
         * @param  {string} name Nom de la catégorie.
         * @return {string}
         */
        function getCatColor( name ) {
            var colors = {
                'PrestaShop'  : 'bg-blue-100 text-blue-700',
                'WordPress'   : 'bg-purple-100 text-purple-700',
                'Symfony'     : 'bg-orange-100 text-orange-700',
                'Maintenance' : 'bg-green-100 text-green-700',
                'Conseils'    : 'bg-teal-100 text-teal-700'
            };
            return colors[ name ] || 'bg-teal-100 text-teal-700';
        }

        /**
         * Formate une date ISO en date lisible française.
         *
         * @param  {string} isoDate Date ISO 8601.
         * @return {string}
         */
        function formatDate( isoDate ) {
            var months = [
                'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
                'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
            ];
            var d = new Date( isoDate );
            return d.getDate() + ' ' + months[ d.getMonth() ] + ' ' + d.getFullYear();
        }

        /**
         * Échappe les caractères HTML dangereux.
         *
         * @param  {string} str Chaîne à échapper.
         * @return {string}
         */
        function escapeHtml( str ) {
            return String( str )
                .replace( /&/g, '&amp;' )
                .replace( /</g, '&lt;' )
                .replace( />/g, '&gt;' )
                .replace( /"/g, '&quot;' )
                .replace( /'/g, '&#39;' );
        }
    }

} ); // end jQuery ready
