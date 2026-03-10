<?php
/**
 * EventPrime customization promo page markup.
 *
 * @package Eventprime_Event_Calendar_Management
 */

defined( 'ABSPATH' ) || exit;

$promo_assets_base = plugin_dir_url( EP_PLUGIN_FILE ) . 'admin/partials/images/';
?>
<div class="wrap ep-customization-promo-page">
	<div class="ep-promo-box">
		<div class="ep-promo-content">
			<div class="ep-mundro-root">
				<div class="ep-wp-shell">
					<main class="ep-wp-main">
						<section class="ep-screen-wrap">
							<div class="ep-service-shell">
								<div class="ep-hero-grid">
									<div class="ep-hero-copy">
										<img class="ep-hero-icon" src="<?php echo esc_url( $promo_assets_base . 'icon.svg' ); ?>" alt="<?php esc_attr_e( 'EventPrime icon', 'eventprime-event-calendar-management' ); ?>" />
										<p class="ep-hero-kicker"><?php esc_html_e( 'EventPrime Customization Services', 'eventprime-event-calendar-management' ); ?></p>
										<h1 class="ep-hero-title"><?php esc_html_e( 'Replace Workarounds with a Workflow Built for Your Events.', 'eventprime-event-calendar-management' ); ?></h1>
										<p class="ep-hero-sub"><?php esc_html_e( 'Need a custom feature or workflow in EventPrime? We can build it for you.', 'eventprime-event-calendar-management' ); ?></p>
									</div>
									<div class="ep-hero-art">
										<img src="<?php echo esc_url( $promo_assets_base . 'hero_img_optimized.jpg' ); ?>" alt="<?php esc_attr_e( 'Event planning collaboration', 'eventprime-event-calendar-management' ); ?>" width="980" height="560" loading="lazy" decoding="async" />
									</div>
								</div>

								<div class="ep-toolbar">
									<label class="ep-search-wrap" for="ep-service-search" aria-label="<?php esc_attr_e( 'Search services', 'eventprime-event-calendar-management' ); ?>">
										<input id="ep-service-search" type="text" placeholder="<?php esc_attr_e( 'Search services: payment gateway, mobile app, check-in, integrations...', 'eventprime-event-calendar-management' ); ?>" />
									</label>
								</div>

								<div class="ep-content-grid">
									<div class="ep-cards-area">
										<div id="ep-cards-container" class="ep-cards-masonry"></div>
									</div>

									<aside class="ep-side-panel">
										<section class="ep-panel-block ep-how-card">
											<p class="ep-panel-title"><?php esc_html_e( 'Quick Guidance', 'eventprime-event-calendar-management' ); ?></p>
											<p class="ep-metric"><?php esc_html_e( 'How this works', 'eventprime-event-calendar-management' ); ?></p>
											<p class="ep-metric-sub"><?php esc_html_e( 'Choose a service card, describe your requirement, and our team shares scope and implementation plan.', 'eventprime-event-calendar-management' ); ?></p>
										</section>
										<section class="ep-panel-block ep-expect-card">
											<p class="ep-panel-title"><?php esc_html_e( 'What to expect', 'eventprime-event-calendar-management' ); ?></p>
											<p class="ep-metric"><?php esc_html_e( '1-2 business days', 'eventprime-event-calendar-management' ); ?></p>
											<p class="ep-metric-sub"><?php esc_html_e( 'Typical first response with scope direction after you submit a request.', 'eventprime-event-calendar-management' ); ?></p>
											<div class="ep-expect-flow">
												<div class="ep-expect-step"><span class="ep-expect-dot">1</span><span><?php esc_html_e( 'You submit your requirement', 'eventprime-event-calendar-management' ); ?></span></div>
												<div class="ep-expect-step"><span class="ep-expect-dot">2</span><span><?php esc_html_e( 'We review and map the scope', 'eventprime-event-calendar-management' ); ?></span></div>
												<div class="ep-expect-step"><span class="ep-expect-dot">3</span><span><?php esc_html_e( 'You receive next-step guidance', 'eventprime-event-calendar-management' ); ?></span></div>
											</div>
										</section>
										<section class="ep-panel-block">
											<p class="ep-panel-title"><?php esc_html_e( 'User Feedback', 'eventprime-event-calendar-management' ); ?></p>
											<p class="ep-feedback-quote"><?php esc_html_e( 'We had a very specific use case for our event registrations, and the team was able to add custom features for us on multiple occasions. Each time, the team was very responsive and quick to complete our requests!', 'eventprime-event-calendar-management' ); ?></p>
											<div class="ep-feedback-person">
												<img class="ep-feedback-avatar" src="<?php echo esc_url( $promo_assets_base . 'feedback-user.jpg' ); ?>" alt="<?php esc_attr_e( 'Customization client', 'eventprime-event-calendar-management' ); ?>" />
												<div>
													<p class="ep-feedback-name">Evan Matthews</p>
													<p class="ep-feedback-role"><?php esc_html_e( 'Customization Client', 'eventprime-event-calendar-management' ); ?></p>
												</div>
											</div>
										</section>
									</aside>
								</div>
							</div>

							<section id="ep-request" class="ep-request-anchor">
								<h2 class="ep-request-title"><?php esc_html_e( 'Request Your Custom Requirement', 'eventprime-event-calendar-management' ); ?></h2>
								<p class="ep-request-copy"><?php esc_html_e( 'Share your use case and our team will start scoping and implementation planning.', 'eventprime-event-calendar-management' ); ?></p>
								<a class="button button-primary ep-request-button" href="https://theeventprime.com/customizations/" data-placement-key="request_card_bottom" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Contact EventPrime Team', 'eventprime-event-calendar-management' ); ?></a>
							</section>
						</section>
					</main>
				</div>
			</div>
		</div>
	</div>
</div>
