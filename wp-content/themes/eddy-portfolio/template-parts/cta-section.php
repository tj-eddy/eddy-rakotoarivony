<?php
/**
 * template-parts/cta-section.php — Bloc CTA réutilisable
 *
 * Affiche une section "Call To Action" pleine largeur en fond teal-600.
 *
 * Paramètres contextuels passés via get_template_part + set_query_var
 * OU via la variable globale $eddy_cta_args :
 *
 * @var array $eddy_cta_args {
 *     @type string $title  Titre du CTA.             Défaut : "Travaillons ensemble !"
 *     @type string $text   Texte descriptif.         Défaut : phrase générique
 *     @type string $label  Libellé du bouton.        Défaut : "Contactez-moi maintenant →"
 *     @type string $url    URL du bouton.            Défaut : page de contact
 * }
 *
 * Utilisation simple (valeurs par défaut) :
 *   get_template_part( 'template-parts/cta', 'section' );
 *
 * Utilisation avec contexte (WP 5.5+) :
 *   get_template_part( 'template-parts/cta', 'section', array(
 *       'title' => 'Votre titre',
 *       'text'  => 'Votre texte',
 *       'label' => 'Votre bouton',
 *       'url'   => home_url('/contact'),
 *   ) );
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

// WordPress 5.5+ : paramètres via le 3e argument de get_template_part
$args = ( isset( $args ) && is_array( $args ) ) ? $args : array();

$title = $args['title'] ?? __( 'Travaillons ensemble !', 'eddy-portfolio' );
$text  = $args['text']  ?? __( 'Vous avez un projet web en tête ? Je suis disponible et prêt à vous accompagner de l\'idée au lancement.', 'eddy-portfolio' );
$label = $args['label'] ?? __( 'Contactez-moi maintenant →', 'eddy-portfolio' );
$url   = $args['url']   ?? home_url( '/contact/' );
?>
<section class="py-20 px-4 bg-teal-600">
    <div class="max-w-3xl mx-auto text-center animate-on-scroll">

        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            <?php echo esc_html( $title ); ?>
        </h2>

        <p class="text-teal-100 text-lg mb-8 leading-relaxed">
            <?php echo esc_html( $text ); ?>
        </p>

        <a href="<?php echo esc_url( $url ); ?>"
           class="inline-block bg-white text-teal-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-teal-50 transition duration-300 shadow-lg">
            <?php echo esc_html( $label ); ?>
        </a>

    </div>
</section>
