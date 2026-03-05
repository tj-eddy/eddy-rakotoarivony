<?php
/**
 * Gestionnaires AJAX : formulaire de contact.
 *
 * @package Eddy_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Traitement du formulaire de contact via AJAX.
 * Action : eddy_contact (users connectés et non connectés).
 *
 * @return void
 */
function eddy_ajax_contact() {

    // Vérification du nonce de sécurité
    check_ajax_referer( 'eddy_nonce', 'nonce' );

    // Récupération et assainissement des données
    $name    = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
    $email   = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )        : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    // Validation
    $errors = [];

    if ( empty( $name ) ) {
        $errors[] = __( 'Le nom est requis.', 'eddy-portfolio' );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        $errors[] = __( 'Un email valide est requis.', 'eddy-portfolio' );
    }

    if ( empty( $subject ) ) {
        $errors[] = __( 'Le sujet est requis.', 'eddy-portfolio' );
    }

    if ( strlen( $message ) < 10 ) {
        $errors[] = __( 'Le message doit contenir au moins 10 caractères.', 'eddy-portfolio' );
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( [ 'errors' => $errors ], 422 );
    }

    // Email de destination (Customizer ou admin par défaut)
    $to = get_theme_mod( 'eddy_contact_email_dest', get_option( 'admin_email' ) );

    // Sujet de l'email
    $mail_subject = sprintf(
        /* translators: %1$s: sujet du formulaire, %2$s: nom de l'expéditeur */
        __( '[Contact Portfolio] %1$s — de %2$s', 'eddy-portfolio' ),
        $subject,
        $name
    );

    // Corps du message
    $mail_body = sprintf(
        "Nouveau message via le formulaire de contact du portfolio.\n\n" .
        "Nom : %s\n" .
        "Email : %s\n" .
        "Sujet : %s\n\n" .
        "Message :\n%s\n\n" .
        "---\nEnvoyé depuis %s",
        $name,
        $email,
        $subject,
        $message,
        home_url()
    );

    // En-têtes email
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    // Envoi
    $sent = wp_mail( $to, $mail_subject, $mail_body, $headers );

    if ( $sent ) {
        wp_send_json_success( [
            'message' => __( 'Message envoyé avec succès ! Je vous répondrai sous 24h.', 'eddy-portfolio' ),
        ] );
    } else {
        wp_send_json_error( [
            'message' => __( "Une erreur s'est produite lors de l'envoi. Veuillez réessayer.", 'eddy-portfolio' ),
        ], 500 );
    }
}
add_action( 'wp_ajax_eddy_contact', 'eddy_ajax_contact' );
add_action( 'wp_ajax_nopriv_eddy_contact', 'eddy_ajax_contact' );
