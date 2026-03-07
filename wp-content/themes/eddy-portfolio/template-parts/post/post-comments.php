<?php
/**
 * Section commentaires de l'article.
 *
 * @package Eddy_Portfolio
 */

if ( post_password_required() ) return;
if ( ! comments_open() && ! have_comments() ) return;
?>
<div id="comments" class="mt-12">

    <?php if ( have_comments() ) : ?>

    <h3 class="text-xl font-bold mb-6" style="color:var(--color-text)">
        <?php
        printf(
            /* translators: %s : nombre de commentaires */
            esc_html( _n( '%s commentaire', '%s commentaires', get_comments_number(), 'eddy-portfolio' ) ),
            esc_html( number_format_i18n( get_comments_number() ) )
        );
        ?>
    </h3>

    <ol class="comment-list list-none m-0 p-0">
        <?php
        wp_list_comments( [
            'style'      => 'ol',
            'short_ping' => true,
            'callback'   => 'eddy_comment_template',
        ] );
        ?>
    </ol>

    <?php the_comments_pagination(); ?>

    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    comment_form( [
        'title_reply'          => __( 'Laisser un commentaire', 'eddy-portfolio' ),
        'title_reply_to'       => __( 'Répondre à %s', 'eddy-portfolio' ),
        'cancel_reply_link'    => __( 'Annuler', 'eddy-portfolio' ),
        'label_submit'         => __( 'Publier le commentaire', 'eddy-portfolio' ),
        'class_submit'         => 'btn-primary mt-2',
        'class_form'           => 'space-y-4',
        'comment_notes_before' => '',
        'fields'               => [
            'author' => '<div class="form-group"><label for="author" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">' . esc_html__( 'Nom', 'eddy-portfolio' ) . ' <span aria-hidden="true" class="text-red-500">*</span></label><input id="author" name="author" type="text" class="contact-input" value="' . esc_attr( $commenter['comment_author'] ) . '" maxlength="245" autocomplete="name" required /></div>',
            'email'  => '<div class="form-group"><label for="email" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">' . esc_html__( 'E-mail', 'eddy-portfolio' ) . ' <span aria-hidden="true" class="text-red-500">*</span></label><input id="email" name="email" type="email" class="contact-input" value="' . esc_attr( $commenter['comment_author_email'] ) . '" maxlength="100" autocomplete="email" required /></div>',
            'url'    => '<div class="form-group"><label for="url" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">' . esc_html__( 'Site web', 'eddy-portfolio' ) . '</label><input id="url" name="url" type="url" class="contact-input" value="' . esc_attr( $commenter['comment_author_url'] ) . '" maxlength="200" autocomplete="url" /></div>',
            'cookies' => '<div class="form-group flex items-start gap-2 mt-1"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" class="mt-1" ' . ( isset( $_COOKIE['comment_author_' . COOKIEHASH] ) ? 'checked' : '' ) . ' /><label for="wp-comment-cookies-consent" class="text-sm" style="color:var(--color-text-muted)">' . esc_html__( 'Enregistrer mon nom et mon e-mail pour mon prochain commentaire.', 'eddy-portfolio' ) . '</label></div>',
        ],
        'comment_field'        => '<div class="form-group"><label for="comment" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">' . esc_html__( 'Commentaire', 'eddy-portfolio' ) . ' <span aria-hidden="true" class="text-red-500">*</span></label><textarea id="comment" name="comment" class="contact-input" rows="5" required aria-required="true"></textarea></div>',
    ] );
    ?>

</div>
<?php

/**
 * Template de commentaire personnalisé.
 *
 * @param WP_Comment $comment Objet commentaire.
 * @param array      $args    Arguments.
 * @param int        $depth   Profondeur d'imbrication.
 */
if ( ! function_exists( 'eddy_comment_template' ) ) :
function eddy_comment_template( WP_Comment $comment, array $args, int $depth ): void {
    $reply_link = get_comment_reply_link( [ ...$args, 'depth' => $depth, 'max_depth' => $args['max_depth'] ] );
    ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-card' ); ?>>
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <?php echo get_avatar( $comment, 40, '', '', [ 'class' => 'rounded-full' ] ); ?>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-semibold text-sm" style="color:var(--color-text)">
                        <?php comment_author(); ?>
                    </span>
                    <time class="text-xs" datetime="<?php comment_date( 'c' ); ?>" style="color:var(--color-text-muted)">
                        <?php comment_date( 'd/m/Y' ); ?>
                    </time>
                </div>
                <div class="text-sm" style="color:var(--color-text)">
                    <?php comment_text(); ?>
                </div>
                <?php if ( $reply_link ) : ?>
                <div class="mt-2 text-xs">
                    <?php echo wp_kses_post( $reply_link ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php
}
endif;
