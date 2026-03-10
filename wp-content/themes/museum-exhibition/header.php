<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package museum_exhibition
 */
$museum_exhibition_prelaoder = get_theme_mod( 'museum_exhibition_header_preloader', false  );
$museum_exhibition_loader_layout = get_theme_mod('museum_exhibition_loader_layout_setting', 'load');

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

    <?php 
		if ($museum_exhibition_prelaoder && $museum_exhibition_loader_layout !== 'none') { ?>
	<div class="preloader">
		<?php if ($museum_exhibition_loader_layout === 'both' || $museum_exhibition_loader_layout === 'load') { ?>
        <div class="load">
            <div class="loader"></div>
        </div>
    <?php } ?>
	<?php if ($museum_exhibition_loader_layout === 'both' || $museum_exhibition_loader_layout === 'load-one') { ?>
			<div class="load-one">
                <hr/><hr/><hr/><hr/>
            </div>
    <?php } ?>
 	<?php if ($museum_exhibition_loader_layout === 'both' || $museum_exhibition_loader_layout === 'ctn-preloader') { ?>
	    <div id="preloader">
	            <div id="ctn-preloader" class="ctn-preloader">
	                <div class="animation-preloader">
	                    <div class="spinner"></div>
	                </div>

	                <!-- Start: Preloader sides - Model 1 -->
	                <div class="loader-section section-left"></div>
	                <div class="loader-section section-right"></div>
	                <!-- End: Preloader sides - Model 1 -->

	            </div>
	        </div>
	        <?php } ?>
	    </div>
	<?php } ?>
	<a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'museum-exhibition' ); ?></a>
    <div class="mobile-nav">
		<button class="toggle-button" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
			<span class="toggle-bar"></span>
			<span class="toggle-bar"></span>
			<span class="toggle-bar"></span>
		</button>
		<div class="mobile-nav-wrap">
			<nav class="main-navigation" id="mobile-navigation"  role="navigation">
				<div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
		            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
		            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'museum-exhibition' ); ?>">
		                <?php
		                    wp_nav_menu( array(
		                        'theme_location' => 'primary',
		                        'menu_id'        => 'mobile-primary-menu',
		                        'menu_class'     => 'nav-menu main-menu-modal',
		                    ) );
		                ?>
		            </div>
		        </div>
			</nav>
		</div>
	</div>
	<div id="page" class="site">
		
		<?php
		/**
		 * museum_exhibition_top_header
		 * 
		 * @hooked museum_exhibition_top_header - 20
		*/
		do_action( 'museum_exhibition_top_header' );

		/**
		 * museum_exhibition Header
		 * 
		 * @hooked museum_exhibition_header - 20
		*/
		do_action( 'museum_exhibition_header' );
		
		echo '<div><!-- done for accessiblity purpose -->';

		echo '<div class="single-header-img">';

		if (!is_front_page() || is_home()) {
			if (is_single() || is_page() || (function_exists('is_shop') && is_shop()) || is_archive() || is_search() || is_404() || is_home()) {
				if (!is_page_template('template-homepage.php')) {
					echo '<div class="post-thumbnail">';
					if (function_exists('is_shop') && (is_shop() || function_exists('is_product') && is_product())) {
						$museum_exhibition_default_image_url = get_template_directory_uri() . '/images/breadcrumb.png'; 
						echo '<img src="' . esc_url($museum_exhibition_default_image_url) . '" itemprop="image">';
					} else {
						if (has_post_thumbnail()) {
							(is_active_sidebar('right-sidebar')) ? the_post_thumbnail('museum-exhibition-with-sidebar', array('itemprop' => 'image')) : the_post_thumbnail('museum-exhibition-without-sidebar', array('itemprop' => 'image'));
						} else {
							$museum_exhibition_default_image_url = get_template_directory_uri() . '/images/breadcrumb.png'; 
							echo '<img src="' . esc_url($museum_exhibition_default_image_url) . '" itemprop="image">';
						}
					}
					echo '</div>';
					echo '<div class="single-header-heading">';
					museum_exhibition_custom_blog_banner_title();
					echo '</div>';
				}
			}
		}
	
		echo '</div>';
        echo '<div id="acc-content" class="wrapper">';
        echo '<div class="container home-container">';
        echo '<div id="content" class="site-content">';
        ?>