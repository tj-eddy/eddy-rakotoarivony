<?php
/**
 * page-contact.php — Template page "Contact"
 *
 * Formulaire de contact AJAX avec :
 *  - Validation côté client (jQuery, main.js)
 *  - Validation côté serveur + envoi email (wp_mail via AJAX)
 *  - Nonce WordPress pour la sécurité
 *  - Coordonnées dynamiques via Customizer
 *
 * @package eddy-portfolio
 * @since   1.0.0
 */

/*
 * Template Name: Page Contact
 * Template Post Type: page
 */

get_header();
get_template_part( 'template-parts/breadcrumb' );

$email    = get_theme_mod( 'eddy_contact_email',    'contact@eddy-dev.fr' );
$location = get_theme_mod( 'eddy_contact_location', 'Madagascar / Remote' );
$linkedin = get_theme_mod( 'eddy_social_linkedin',  'https://linkedin.com/in/eddy-rakotoarivony' );
$github   = get_theme_mod( 'eddy_social_github',    'https://github.com/eddy-rakotoarivony' );
$whatsapp = get_theme_mod( 'eddy_social_whatsapp',  '' );
?>

<!-- ===== EN-TÊTE ===== -->
<section class="bg-white py-14 px-4 border-b border-gray-100">
    <div class="max-w-3xl mx-auto text-center animate-on-scroll">
        <span class="inline-block bg-teal-100 text-teal-700 text-sm font-semibold px-3 py-1 rounded-full mb-4">
            <?php esc_html_e( 'Parlons de votre projet', 'eddy-portfolio' ); ?>
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <?php esc_html_e( 'Contactez-moi', 'eddy-portfolio' ); ?>
        </h1>
        <p class="text-lg text-gray-600">
            <?php printf(
                /* translators: %s : délai de réponse en gras */
                esc_html__( 'Décrivez votre projet et je vous réponds sous %s. Devis gratuit, sans engagement.', 'eddy-portfolio' ),
                '<strong class="text-teal-600">' . esc_html__( '24 heures', 'eddy-portfolio' ) . '</strong>'
            ); ?>
        </p>
    </div>
</section>


<!-- ===== CONTENU ===== -->
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- ===== FORMULAIRE (2/3) ===== -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">

                    <!-- Formulaire AJAX -->
                    <form id="contact-form" novalidate aria-label="<?php esc_attr_e( 'Formulaire de contact', 'eddy-portfolio' ); ?>">

                        <?php wp_nonce_field( 'eddy_contact_nonce', 'eddy_contact_nonce' ); ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                            <!-- Nom -->
                            <div>
                                <label for="contact-nom" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    <?php esc_html_e( 'Nom complet', 'eddy-portfolio' ); ?>
                                    <span class="text-red-400" aria-hidden="true">*</span>
                                </label>
                                <input id="contact-nom" name="nom" type="text"
                                       placeholder="<?php esc_attr_e( 'Jean Dupont', 'eddy-portfolio' ); ?>"
                                       autocomplete="name"
                                       class="form-field w-full border border-teal-300 rounded-xl px-4 py-3 text-gray-800 text-sm focus:border-teal-500 outline-none transition duration-200"
                                       required aria-required="true">
                                <p id="nom-error" class="field-error text-red-500 text-xs mt-1" role="alert" aria-live="polite"></p>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="contact-email" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    <?php esc_html_e( 'Adresse email', 'eddy-portfolio' ); ?>
                                    <span class="text-red-400" aria-hidden="true">*</span>
                                </label>
                                <input id="contact-email" name="email" type="email"
                                       placeholder="jean@exemple.fr"
                                       autocomplete="email"
                                       class="form-field w-full border border-teal-300 rounded-xl px-4 py-3 text-gray-800 text-sm focus:border-teal-500 outline-none transition duration-200"
                                       required aria-required="true">
                                <p id="email-error" class="field-error text-red-500 text-xs mt-1" role="alert" aria-live="polite"></p>
                            </div>

                        </div>

                        <!-- Téléphone (optionnel) -->
                        <div class="mb-5">
                            <label for="contact-tel" class="block text-sm font-medium text-gray-700 mb-1.5">
                                <?php esc_html_e( 'Téléphone', 'eddy-portfolio' ); ?>
                                <span class="text-gray-400 font-normal">(<?php esc_html_e( 'optionnel', 'eddy-portfolio' ); ?>)</span>
                            </label>
                            <input id="contact-tel" name="tel" type="tel"
                                   placeholder="+33 6 12 34 56 78"
                                   autocomplete="tel"
                                   class="form-field w-full border border-teal-300 rounded-xl px-4 py-3 text-gray-800 text-sm focus:border-teal-500 outline-none transition duration-200">
                        </div>

                        <!-- Sujet -->
                        <div class="mb-5">
                            <label for="contact-sujet" class="block text-sm font-medium text-gray-700 mb-1.5">
                                <?php esc_html_e( 'Sujet', 'eddy-portfolio' ); ?>
                                <span class="text-red-400" aria-hidden="true">*</span>
                            </label>
                            <select id="contact-sujet" name="sujet"
                                    class="form-field w-full border border-teal-300 rounded-xl px-4 py-3 text-gray-800 text-sm focus:border-teal-500 outline-none bg-white transition duration-200"
                                    required aria-required="true">
                                <option value=""><?php esc_html_e( '— Choisissez un sujet —', 'eddy-portfolio' ); ?></option>
                                <option value="prestashop">🛒 <?php esc_html_e( 'Projet PrestaShop', 'eddy-portfolio' ); ?></option>
                                <option value="wordpress">🌐 <?php esc_html_e( 'Projet WordPress', 'eddy-portfolio' ); ?></option>
                                <option value="symfony">⚡ <?php esc_html_e( 'Projet Symfony', 'eddy-portfolio' ); ?></option>
                                <option value="maintenance">🔧 <?php esc_html_e( 'Maintenance web', 'eddy-portfolio' ); ?></option>
                                <option value="devis">💰 <?php esc_html_e( 'Demande de devis', 'eddy-portfolio' ); ?></option>
                                <option value="autre">💬 <?php esc_html_e( 'Autre demande', 'eddy-portfolio' ); ?></option>
                            </select>
                            <p id="sujet-error" class="field-error text-red-500 text-xs mt-1" role="alert" aria-live="polite"></p>
                        </div>

                        <!-- Message -->
                        <div class="mb-6">
                            <label for="contact-message" class="block text-sm font-medium text-gray-700 mb-1.5">
                                <?php esc_html_e( 'Votre message', 'eddy-portfolio' ); ?>
                                <span class="text-red-400" aria-hidden="true">*</span>
                            </label>
                            <textarea id="contact-message" name="message" rows="6"
                                      placeholder="<?php esc_attr_e( 'Décrivez votre projet : type de site, fonctionnalités souhaitées, délais, budget indicatif...', 'eddy-portfolio' ); ?>"
                                      class="form-field w-full border border-teal-300 rounded-xl px-4 py-3 text-gray-800 text-sm focus:border-teal-500 outline-none resize-vertical transition duration-200"
                                      required aria-required="true" minlength="10"></textarea>
                            <p id="message-error" class="field-error text-red-500 text-xs mt-1" role="alert" aria-live="polite"></p>
                        </div>

                        <!-- Bouton submit -->
                        <button type="submit"
                                class="w-full bg-teal-600 text-white py-3.5 rounded-xl font-semibold hover:bg-teal-700 transition duration-300 text-base flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span id="btn-text"><?php esc_html_e( 'Envoyer mon message', 'eddy-portfolio' ); ?></span>
                            <span id="btn-loading" class="hidden"><?php esc_html_e( 'Envoi en cours…', 'eddy-portfolio' ); ?></span>
                        </button>
                        <p class="text-center text-gray-400 text-xs mt-3">
                            <?php esc_html_e( 'Vos informations restent confidentielles et ne sont jamais partagées.', 'eddy-portfolio' ); ?>
                        </p>

                    </form>

                    <!-- Message de succès (caché par défaut) -->
                    <div id="success-message" class="hidden text-center py-12" role="status" aria-live="polite">
                        <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">
                            <?php esc_html_e( 'Message envoyé !', 'eddy-portfolio' ); ?>
                        </h3>
                        <p class="text-gray-600 mb-6">
                            <?php printf(
                                esc_html__( 'Merci pour votre message. Je vous réponds dans les %s ouvrables.', 'eddy-portfolio' ),
                                '<strong class="text-teal-600">' . esc_html__( '24 heures', 'eddy-portfolio' ) . '</strong>'
                            ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                           class="inline-block bg-teal-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-teal-700 transition duration-300">
                            <?php esc_html_e( 'Retour à l\'accueil', 'eddy-portfolio' ); ?>
                        </a>
                    </div>

                    <!-- Message d'erreur AJAX (caché par défaut) -->
                    <div id="form-error" class="hidden mt-4 bg-red-50 border border-red-200 rounded-xl p-4" role="alert" aria-live="assertive">
                        <p class="text-red-600 text-sm font-medium">
                            <?php esc_html_e( 'Une erreur s\'est produite. Veuillez réessayer.', 'eddy-portfolio' ); ?>
                        </p>
                    </div>

                </div>
            </div>
            <!-- ===== / FORMULAIRE ===== -->


            <!-- ===== COLONNE INFOS (1/3) ===== -->
            <aside class="space-y-6">

                <!-- Coordonnées -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-5 text-lg">
                        <?php esc_html_e( 'Informations de contact', 'eddy-portfolio' ); ?>
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5"><?php esc_html_e( 'Email', 'eddy-portfolio' ); ?></p>
                                <a href="mailto:<?php echo esc_attr( $email ); ?>"
                                   class="text-gray-700 font-medium text-sm hover:text-teal-600 transition">
                                    <?php echo esc_html( $email ); ?>
                                </a>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5"><?php esc_html_e( 'Localisation', 'eddy-portfolio' ); ?></p>
                                <p class="text-gray-700 font-medium text-sm"><?php echo esc_html( $location ); ?></p>
                                <p class="text-gray-500 text-xs"><?php esc_html_e( 'Intervention sur toute la France', 'eddy-portfolio' ); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5"><?php esc_html_e( 'Disponibilité', 'eddy-portfolio' ); ?></p>
                                <p class="text-teal-600 font-semibold text-sm">✅ <?php esc_html_e( 'Disponible pour missions', 'eddy-portfolio' ); ?></p>
                                <p class="text-gray-500 text-xs"><?php esc_html_e( 'Réponse sous 24h ouvrables', 'eddy-portfolio' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg">
                        <?php esc_html_e( 'Réseaux sociaux', 'eddy-portfolio' ); ?>
                    </h3>
                    <div class="space-y-3">
                        <?php if ( $linkedin ) : ?>
                        <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-teal-50 transition duration-200 group">
                            <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 group-hover:text-teal-600">LinkedIn</p>
                                <p class="text-xs text-gray-400"><?php bloginfo( 'name' ); ?></p>
                            </div>
                        </a>
                        <?php endif; ?>
                        <?php if ( $github ) : ?>
                        <a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-teal-50 transition duration-200 group">
                            <div class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 group-hover:text-teal-600">GitHub</p>
                                <p class="text-xs text-gray-400">eddy-rakotoarivony</p>
                            </div>
                        </a>
                        <?php endif; ?>
                        <?php if ( $whatsapp ) : ?>
                        <a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-teal-50 transition duration-200 group">
                            <div class="w-9 h-9 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 group-hover:text-teal-600">WhatsApp</p>
                                <p class="text-xs text-gray-400"><?php esc_html_e( 'Message direct', 'eddy-portfolio' ); ?></p>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- FAQ rapide -->
                <div class="bg-teal-50 rounded-2xl p-6 border border-teal-100">
                    <h3 class="font-bold text-gray-800 mb-4">
                        <?php esc_html_e( 'Questions fréquentes', 'eddy-portfolio' ); ?>
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div>
                            <p class="font-semibold text-gray-700 mb-1">⏱️ <?php esc_html_e( 'Délai de réponse ?', 'eddy-portfolio' ); ?></p>
                            <p><?php esc_html_e( 'Je réponds sous 24h ouvrables, souvent bien plus rapidement.', 'eddy-portfolio' ); ?></p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 mb-1">💰 <?php esc_html_e( 'Devis payant ?', 'eddy-portfolio' ); ?></p>
                            <p><?php esc_html_e( 'Non, le devis est toujours gratuit et sans engagement.', 'eddy-portfolio' ); ?></p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 mb-1">🌍 <?php esc_html_e( 'Projets à distance ?', 'eddy-portfolio' ); ?></p>
                            <p><?php esc_html_e( 'Oui, je travaille à 100% en remote avec des clients du monde entier.', 'eddy-portfolio' ); ?></p>
                        </div>
                    </div>
                </div>

            </aside>
            <!-- ===== / COLONNE INFOS ===== -->

        </div>
    </div>
</section>

<?php get_footer(); ?>
