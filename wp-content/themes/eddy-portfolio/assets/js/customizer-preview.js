/* =====================================================
   EDDY PORTFOLIO — customizer-preview.js
   Preview live des options du Customizer
   ===================================================== */

/* global wp */

( function ( $ ) {

  // Nom complet
  wp.customize( 'eddy_full_name', function ( value ) {
    value.bind( function ( newVal ) {
      $( '.eddy-full-name' ).text( newVal );
    } );
  } );

  // Titre du poste
  wp.customize( 'eddy_job_title', function ( value ) {
    value.bind( function ( newVal ) {
      $( '.eddy-job-title' ).text( newVal );
    } );
  } );

  // Couleur primaire
  wp.customize( 'eddy_primary_color', function ( value ) {
    value.bind( function ( newVal ) {
      document.documentElement.style.setProperty( '--color-primary', newVal );
    } );
  } );

  // Mode sombre/clair par défaut
  wp.customize( 'eddy_default_theme', function ( value ) {
    value.bind( function ( newVal ) {
      if ( newVal === 'dark' ) {
        $( 'html' ).addClass( 'dark' );
      } else {
        $( 'html' ).removeClass( 'dark' );
      }
    } );
  } );

  // Titre hero
  wp.customize( 'eddy_hero_title', function ( value ) {
    value.bind( function ( newVal ) {
      $( '#hero-title' ).text( newVal );
    } );
  } );

  // Titre section services
  wp.customize( 'eddy_services_title', function ( value ) {
    value.bind( function ( newVal ) {
      $( '#services-title' ).text( newVal );
    } );
  } );

  // Titre section actualités
  wp.customize( 'eddy_news_title', function ( value ) {
    value.bind( function ( newVal ) {
      $( '#actualites-title' ).text( newVal );
    } );
  } );

  // Titre section contact
  wp.customize( 'eddy_contact_title', function ( value ) {
    value.bind( function ( newVal ) {
      $( '#contact-title' ).text( newVal );
    } );
  } );

} )( jQuery );
