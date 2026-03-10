<?php
/**
 * Help Panel.
 *
 * @package museum_exhibition
 */

$museum_exhibition_import_done = get_option( 'museum_exhibition_demo_import_done' );
$museum_exhibition_button_text = $museum_exhibition_import_done
	? __( 'View Site', 'museum-exhibition' )
	: __( 'Start Demo Import', 'museum-exhibition' );
$museum_exhibition_button_link = $museum_exhibition_import_done
	? home_url( '/' )
	: admin_url( 'themes.php?page=museumexhibition-wizard' );
?>
<div id="help-panel" class="panel-left visible">
    <div class="panel-aside active">
        <div class="demo-content">
            <div class="demo-info">
                <h4><?php esc_html_e( 'DEMO CONTENT IMPORTER', 'museum-exhibition' ); ?></h4>
                <p><?php esc_html_e('The Demo Content Importer helps you quickly set up your website to look exactly like the theme demo. Instead of building pages from scratch, you can import pre-designed layouts, pages, menus, images, and basic settings in just a few clicks.','museum-exhibition'); ?></p>
                <a class="button button-primary first-color" style="text-transform: capitalize" href="<?php echo esc_url( $museum_exhibition_button_link ); ?>" title="<?php echo esc_attr( $museum_exhibition_button_text ); ?>"
                    <?php echo $museum_exhibition_import_done ? 'target="_blank"' : ''; ?>>
                    <?php echo esc_html( $museum_exhibition_button_text ); ?>
                </a>
            </div>
            <div class="demo-img">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" alt="<?php echo esc_attr( 'screenshot', 'museum-exhibition'); ?>"/>
            </div>
        </div>
    </div>

    <div class="panel-aside" >
        <h4><?php esc_html_e( 'USEFUL LINKS', 'museum-exhibition' ); ?></h4>
        <p><?php esc_html_e( 'Find everything you need to set up, customize, and manage your website with ease. These helpful resources are designed to guide you at every step, from installation to advanced customization.', 'museum-exhibition' ); ?></p>
        <div class="useful-links">
            <a class="button button-primary second-color" href="<?php echo esc_url( MUSEUM_EXHIBITION_DEMO_URL ); ?>" title="<?php esc_attr_e( 'Live Demo', 'museum-exhibition' ); ?>" target="_blank">
                <?php esc_html_e( 'Live Demo', 'museum-exhibition' ); ?>
            </a>
            <a class="button button-primary first-color" href="<?php echo esc_url( MUSEUM_EXHIBITION_FREE_DOC_URL ); ?>" title="<?php esc_attr_e( 'Documentation', 'museum-exhibition' ); ?>" target="_blank">
                <?php esc_html_e( 'Documentation', 'museum-exhibition' ); ?>
            </a>
            <a class="button button-primary second-color" href="<?php echo esc_url( MUSEUM_EXHIBITION_URL ); ?>" title="<?php esc_attr_e( 'Get Premium', 'museum-exhibition' ); ?>" target="_blank">
                <?php esc_html_e( 'Get Premium', 'museum-exhibition' ); ?>
            </a>
            <a class="button button-primary first-color" href="<?php echo esc_url( MUSEUM_EXHIBITION_BUNDLE_URL ); ?>" title="<?php esc_attr_e( 'Get Bundle - 60+ Themes', 'museum-exhibition' ); ?>" target="_blank">
                <?php esc_html_e( 'Get Bundle - 60+ Themes', 'museum-exhibition' ); ?>
            </a>
        </div>
    </div>

    <div class="panel-aside" >
        <h4><?php esc_html_e( 'REVIEW', 'museum-exhibition' ); ?></h4>
        <p><?php esc_html_e( 'If you have a moment, please consider leaving a rating and short review. It only takes a minute, and your support means a lot to us.', 'museum-exhibition' ); ?></p>
        <a class="button button-primary first-color" href="<?php echo esc_url( MUSEUM_EXHIBITION_REVIEW_URL ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'museum-exhibition' ); ?>" target="_blank">
            <?php esc_html_e( 'Leave a Review', 'museum-exhibition' ); ?>
        </a>
    </div>
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'CONTACT SUPPORT', 'museum-exhibition' ); ?></h4>
        <p>
            <?php esc_html_e( 'Thank you for choosing Museum Exhibition! We appreciate your interest in our theme and are here to assist you with any support you may need.', 'museum-exhibition' ); ?></p>
        <a class="button button-primary first-color" href="<?php echo esc_url( MUSEUM_EXHIBITION_SUPPORT_URL ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'museum-exhibition' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'museum-exhibition' ); ?>
        </a>
    </div>
</div>