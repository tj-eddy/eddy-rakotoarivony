<?php
/**
 * template-parts/services-card.php — Card de service réutilisable
 *
 * Affiche une card pour un service (CPT "services").
 * Doit être appelé dans la boucle WordPress (have_posts / the_post).
 *
 * Données utilisées :
 *  - Titre du post  : nom du service
 *  - Extrait        : description courte
 *  - _service_icon  : emoji ou texte icône (custom field)
 *  - _service_color : classe Tailwind de fond (custom field)
 *  - Permalink      : lien vers la page détail du service
 *
 * Utilisation :
 *   get_template_part( 'template-parts/services', 'card' );
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

$icon  = get_post_meta( get_the_ID(), '_service_icon',  true ) ?: '⚙️';
$color = get_post_meta( get_the_ID(), '_service_color', true ) ?: 'bg-teal-50';
$excerpt = get_the_excerpt();
if ( ! $excerpt ) {
    $excerpt = wp_trim_words( get_the_content(), 20, '…' );
}
?>
<a href="<?php the_permalink(); ?>"
   class="service-card bg-white rounded-xl shadow-md p-6 hover:shadow-lg border border-gray-100 animate-on-scroll block transition duration-300 group"
   title="<?php echo esc_attr( get_the_title() ); ?>">

    <!-- Icône -->
    <div class="w-14 h-14 <?php echo esc_attr( $color ); ?> rounded-xl flex items-center justify-center mb-4 text-3xl group-hover:scale-110 transition-transform duration-300"
         aria-hidden="true">
        <?php echo esc_html( $icon ); ?>
    </div>

    <!-- Titre -->
    <h3 class="font-bold text-gray-800 text-lg mb-2">
        <?php the_title(); ?>
    </h3>

    <!-- Description courte -->
    <p class="text-gray-500 text-sm leading-relaxed">
        <?php echo esc_html( $excerpt ); ?>
    </p>

    <!-- CTA inline -->
    <span class="mt-4 inline-block text-teal-600 font-medium text-sm group-hover:underline">
        <?php esc_html_e( 'En savoir plus →', 'eddy-portfolio' ); ?>
    </span>

</a>
