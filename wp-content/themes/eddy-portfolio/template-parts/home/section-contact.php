<?php
/**
 * Section Contact — Formulaire de contact avec validation AJAX.
 *
 * @package Eddy_Portfolio
 */

$section_title = get_theme_mod( 'eddy_contact_title', __( 'Me contacter', 'eddy-portfolio' ) );
$email         = get_theme_mod( 'eddy_email', '' );
$linkedin_url  = get_theme_mod( 'eddy_linkedin_url', '' );
$location      = get_theme_mod( 'eddy_location', 'Madagascar / Remote' );
$available     = get_theme_mod( 'eddy_available_freelance', true );
$map_embed     = get_theme_mod( 'eddy_contact_map_embed', '' );
?>
<section id="contact" aria-labelledby="contact-title" class="py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 reveal">
            <span class="text-sm font-semibold text-teal-600 uppercase tracking-widest">
                <?php esc_html_e( 'Travaillons ensemble', 'eddy-portfolio' ); ?>
            </span>
            <h2 id="contact-title" class="text-3xl sm:text-4xl font-extrabold mt-2 mb-4" style="color:var(--color-text)">
                <?php echo esc_html( $section_title ); ?>
            </h2>
            <p style="color:var(--color-text-muted)">
                <?php esc_html_e( 'Un projet, une question, une mission TMA ? Je réponds sous 24h.', 'eddy-portfolio' ); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 reveal">

            <!-- Informations de contact -->
            <div>
                <h3 class="text-xl font-bold mb-6" style="color:var(--color-text)">
                    <?php esc_html_e( 'Informations', 'eddy-portfolio' ); ?>
                </h3>

                <div class="space-y-5">

                    <?php if ( $email ) : ?>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(15,118,110,0.1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,12 2,6"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-sm" style="color:var(--color-text)"><?php esc_html_e( 'Email', 'eddy-portfolio' ); ?></div>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-teal-600 hover:underline text-sm">
                                <?php echo esc_html( $email ); ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( $linkedin_url ) : ?>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(15,118,110,0.1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-sm" style="color:var(--color-text)">LinkedIn</div>
                            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-teal-600 hover:underline text-sm">
                                <?php echo esc_html( str_replace( 'https://', '', $linkedin_url ) ); ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(15,118,110,0.1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-sm" style="color:var(--color-text)"><?php esc_html_e( 'Localisation', 'eddy-portfolio' ); ?></div>
                            <div class="text-sm" style="color:var(--color-text-muted)"><?php echo esc_html( $location ); ?></div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(15,118,110,0.1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-sm" style="color:var(--color-text)"><?php esc_html_e( 'Disponibilité', 'eddy-portfolio' ); ?></div>
                            <div class="text-sm" style="color:var(--color-text-muted)">
                                <?php if ( $available ) : ?>
                                    <?php esc_html_e( 'Freelance disponible · Réponse sous 24h', 'eddy-portfolio' ); ?>
                                <?php else : ?>
                                    <?php esc_html_e( 'Actuellement en mission · Me contacter pour futures missions', 'eddy-portfolio' ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Badge disponibilité -->
                <?php if ( $available ) : ?>
                <div class="mt-8 p-4 rounded-xl border" style="background:rgba(15,118,110,0.05);border-color:rgba(15,118,110,0.2)">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="font-semibold text-sm text-teal-700"><?php esc_html_e( 'Disponible pour de nouveaux projets', 'eddy-portfolio' ); ?></span>
                    </div>
                    <p class="text-xs" style="color:var(--color-text-muted)">
                        <?php esc_html_e( 'Missions freelance, TMA longue durée, projets e-commerce et applications web. Fuseau horaire UTC+3.', 'eddy-portfolio' ); ?>
                    </p>
                </div>
                <?php endif; ?>

                <!-- Carte Google Maps optionnelle -->
                <?php if ( $map_embed ) : ?>
                <div class="mt-6 rounded-xl overflow-hidden" style="border:1px solid var(--color-border)">
                    <?php echo wp_kses( $map_embed, [ 'iframe' => [ 'src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true, 'title' => true ] ] ); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Formulaire de contact -->
            <div>
                <h3 class="text-xl font-bold mb-6" style="color:var(--color-text)">
                    <?php esc_html_e( 'Envoyer un message', 'eddy-portfolio' ); ?>
                </h3>

                <form id="contact-form" novalidate>
                    <?php wp_nonce_field( 'eddy_nonce', 'eddy_contact_nonce' ); ?>
                    <div class="space-y-4">

                        <div>
                            <label for="contact-name" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">
                                <?php esc_html_e( 'Nom complet', 'eddy-portfolio' ); ?>
                                <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <input type="text" id="contact-name" name="name" class="contact-input"
                                   placeholder="<?php esc_attr_e( 'Jean Dupont', 'eddy-portfolio' ); ?>"
                                   autocomplete="name" required aria-required="true">
                            <p id="name-error" class="field-error" role="alert">
                                <?php esc_html_e( 'Veuillez entrer votre nom.', 'eddy-portfolio' ); ?>
                            </p>
                        </div>

                        <div>
                            <label for="contact-email" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">
                                <?php esc_html_e( 'Email', 'eddy-portfolio' ); ?>
                                <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <input type="email" id="contact-email" name="email" class="contact-input"
                                   placeholder="jean@exemple.com" autocomplete="email" required aria-required="true">
                            <p id="email-error" class="field-error" role="alert">
                                <?php esc_html_e( 'Veuillez entrer un email valide.', 'eddy-portfolio' ); ?>
                            </p>
                        </div>

                        <div>
                            <label for="contact-subject" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">
                                <?php esc_html_e( 'Sujet', 'eddy-portfolio' ); ?>
                                <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <select id="contact-subject" name="subject" class="contact-input" required aria-required="true">
                                <option value=""><?php esc_html_e( 'Sélectionner un sujet', 'eddy-portfolio' ); ?></option>
                                <option value="prestashop"><?php esc_html_e( 'Projet PrestaShop', 'eddy-portfolio' ); ?></option>
                                <option value="symfony"><?php esc_html_e( 'Projet Symfony', 'eddy-portfolio' ); ?></option>
                                <option value="wordpress"><?php esc_html_e( 'Projet WordPress', 'eddy-portfolio' ); ?></option>
                                <option value="tma"><?php esc_html_e( 'Contrat TMA', 'eddy-portfolio' ); ?></option>
                                <option value="audit"><?php esc_html_e( 'Audit technique', 'eddy-portfolio' ); ?></option>
                                <option value="autre"><?php esc_html_e( 'Autre demande', 'eddy-portfolio' ); ?></option>
                            </select>
                            <p id="subject-error" class="field-error" role="alert">
                                <?php esc_html_e( 'Veuillez choisir un sujet.', 'eddy-portfolio' ); ?>
                            </p>
                        </div>

                        <div>
                            <label for="contact-message" class="block text-sm font-medium mb-1.5" style="color:var(--color-text)">
                                <?php esc_html_e( 'Message', 'eddy-portfolio' ); ?>
                                <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <textarea id="contact-message" name="message" class="contact-input" rows="5"
                                      placeholder="<?php esc_attr_e( 'Décrivez votre projet ou votre besoin...', 'eddy-portfolio' ); ?>"
                                      required aria-required="true"></textarea>
                            <p id="message-error" class="field-error" role="alert">
                                <?php esc_html_e( 'Le message doit contenir au moins 10 caractères.', 'eddy-portfolio' ); ?>
                            </p>
                        </div>

                        <button type="submit" id="contact-submit" class="btn-primary w-full justify-center py-3">
                            <?php esc_html_e( 'Envoyer le message', 'eddy-portfolio' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>

                        <div id="form-success" class="success-message" role="status">
                            <strong><?php esc_html_e( 'Message envoyé !', 'eddy-portfolio' ); ?></strong>
                            <?php esc_html_e( 'Je vous répondrai dans les 24h. Merci !', 'eddy-portfolio' ); ?>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
