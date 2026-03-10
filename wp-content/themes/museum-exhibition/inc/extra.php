<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package museum_exhibition
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function museum_exhibition_body_classes( $classes ) {
  global $museum_exhibition_post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog ';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( museum_exhibition_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
        $classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }

    return $classes;
}
add_filter( 'body_class', 'museum_exhibition_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function museum_exhibition_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if ( ! function_exists( 'museum_exhibition_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function museum_exhibition_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'museum_exhibition_excerpt_more' );

if( ! function_exists( 'museum_exhibition_footer_credit' ) ):
/**
 * Footer Credits
*/
function museum_exhibition_footer_credit() {

    // Check if footer copyright is enabled
    $museum_exhibition_show_footer_copyright = get_theme_mod( 'museum_exhibition_footer_setting', true );

    if ( ! $museum_exhibition_show_footer_copyright ) {
        return; 
    }

    $museum_exhibition_copyright_text = get_theme_mod('museum_exhibition_footer_copyright_text');

    $museum_exhibition_text = '<div class="site-info"><div class="container"><span class="copyright">';
    if ($museum_exhibition_copyright_text) {
        $museum_exhibition_text .= wp_kses_post($museum_exhibition_copyright_text); 
    } else {
        $museum_exhibition_text .= esc_html__('&copy; ', 'museum-exhibition') . date_i18n(esc_html__('Y', 'museum-exhibition')); 
        $museum_exhibition_text .= ' <a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>' . esc_html__('. All Rights Reserved.', 'museum-exhibition');
    }
    $museum_exhibition_text .= '</span>';
    // $museum_exhibition_text .= '<span class="by"> <a href="' . esc_url('https://www.themeignite.com/products/museum-exhibition') . '" rel="nofollow" target="_blank">' . MUSEUM_EXHIBITION_THEME_NAME . '</a>' . esc_html__(' By ', 'museum-exhibition') . '<a href="' . esc_url('https://themeignite.com/') . '" rel="nofollow" target="_blank">' . esc_html__('Themeignite', 'museum-exhibition') . '</a>.';
    /* translators: %s: link to WordPress.org */
    // $museum_exhibition_text .= sprintf(esc_html__(' Powered By %s', 'museum-exhibition'), '<a href="' . esc_url(__('https://wordpress.org/', 'museum-exhibition')) . '" target="_blank">WordPress</a>.');
    if (function_exists('the_privacy_policy_link')) {
        $museum_exhibition_text .= get_the_privacy_policy_link();
    }
    $museum_exhibition_text .= '</span></div></div>';
    echo apply_filters('museum_exhibition_footer_text', $museum_exhibition_text);
}
add_action('museum_exhibition_footer', 'museum_exhibition_footer_credit');
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'museum_exhibition_woocommerce_activated' ) ) {
  function museum_exhibition_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'museum_exhibition_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function museum_exhibition_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $museum_exhibition_commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $museum_exhibition_aria_req = ( $req ? " aria-required='true'" : '' );
    $museum_exhibition_required = ( $req ? " required" : '' );
    $museum_exhibition_author   = ( $req ? __( 'Name*', 'museum-exhibition' ) : __( 'Name', 'museum-exhibition' ) );
    $museum_exhibition_email    = ( $req ? __( 'Email*', 'museum-exhibition' ) : __( 'Email', 'museum-exhibition' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'museum-exhibition' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $museum_exhibition_author ) . '" type="text" value="' . esc_attr( $museum_exhibition_commenter['comment_author'] ) . '" size="30"' . $museum_exhibition_aria_req . $museum_exhibition_required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'museum-exhibition' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $museum_exhibition_email ) . '" type="text" value="' . esc_attr(  $museum_exhibition_commenter['comment_author_email'] ) . '" size="30"' . $museum_exhibition_aria_req . $museum_exhibition_required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'museum-exhibition' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'museum-exhibition' ) . '" type="text" value="' . esc_attr( $museum_exhibition_commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'museum_exhibition_change_comment_form_default_fields' );

if( ! function_exists( 'museum_exhibition_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function museum_exhibition_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'museum-exhibition' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'museum-exhibition' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'museum_exhibition_change_comment_form_defaults' );

if( ! function_exists( 'museum_exhibition_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function museum_exhibition_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
    /**
     * Triggered after the opening <body> tag.
    */
    do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'museum_exhibition_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function museum_exhibition_get_fallback_svg( $museum_exhibition_post_thumbnail ) {
    if( ! $museum_exhibition_post_thumbnail ){
        return;
    }
    
    $museum_exhibition_image_size = museum_exhibition_get_image_sizes( $museum_exhibition_post_thumbnail );
     
    if( $museum_exhibition_image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $museum_exhibition_image_size['width'] ); ?> <?php echo esc_attr( $museum_exhibition_image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $museum_exhibition_image_size['width'] ); ?>" height="<?php echo esc_attr( $museum_exhibition_image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

function museum_exhibition_enqueue_google_fonts() {

    require get_template_directory() . '/inc/wptt-webfont-loader.php';

    wp_enqueue_style(
        'google-fonts-mulish',
        museum_exhibition_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap' ),
        array(),
        '1.0'
    );

    wp_enqueue_style(
        'google-fonts-dm-serif-display',
        museum_exhibition_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap' ),
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'museum_exhibition_enqueue_google_fonts' );


if( ! function_exists( 'museum_exhibition_site_branding' ) ) :
/**
 * Site Branding
*/
function museum_exhibition_site_branding(){
    $museum_exhibition_logo_site_title = get_theme_mod( 'header_site_title', 0 );
    $museum_exhibition_tagline = get_theme_mod( 'header_tagline', false );
    $museum_exhibition_logo_width = get_theme_mod('logo_width', 100); // Retrieve the logo width setting

    ?>
    <div class="site-branding" style="max-width: <?php echo esc_attr(get_theme_mod('logo_width', '-1'))?>px;">
        <?php 
        // Check if custom logo is set and display it
        if (function_exists('has_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        }
        if ($museum_exhibition_logo_site_title):
             if (is_front_page()): ?>
            <h1 class="site-title" style="font-size: <?php echo esc_attr(get_theme_mod('museum_exhibition_site_title_size', '30')); ?>px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
            <?php else: ?>
                <p class="site-title" itemprop="name">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>
        <?php endif; 
    
        if ($museum_exhibition_tagline) :
            $museum_exhibition_description = get_bloginfo('description', 'display');
            if ($museum_exhibition_description || is_customize_preview()) :
        ?>
                <p class="site-description" itemprop="description"><?php echo $museum_exhibition_description; ?></p>
            <?php endif;
        endif;
        ?>
    </div>
    <?php
}
endif;
if( ! function_exists( 'museum_exhibition_navigation' ) ) :
    /**
     * Site Navigation
    */
    function museum_exhibition_navigation(){
        ?>
        <nav class="main-navigation" id="site-navigation" role="navigation">
            <?php 
            wp_nav_menu( array( 
                'theme_location' => 'primary', 
                'menu_id' => 'primary-menu' 
            ) ); 
            ?>
        </nav>
        <?php
    }
endif;

if( ! function_exists( 'museum_exhibition_header' ) ) :
    /**
     * Header Start
    */
    function museum_exhibition_header(){
        $museum_exhibition_header_image = get_header_image();
        $museum_exhibition_sticky_header = get_theme_mod('museum_exhibition_sticky_header');
        $museum_exhibition_location     = get_theme_mod( 'museum_exhibition_header_location');
        $museum_exhibition_phone        = get_theme_mod( 'museum_exhibition_header_phone');
        $museum_exhibition_opening_timing = get_theme_mod( 'museum_exhibition_opening_timing');
        $museum_exhibition_header_btn_text     = get_theme_mod( 'museum_exhibition_header_btn_text' );
        $museum_exhibition_header_btn_url     = get_theme_mod( 'museum_exhibition_header_btn_url' );
        $museum_exhibition_topbar_setting = get_theme_mod('museum_exhibition_topbar_setting', false);
        ?>
            <div id="page-site-header" class="main-header">
                <header id="masthead" class="site-header header-inner" role="banner">
                    <div class="theme-menu head_bg" <?php echo $museum_exhibition_header_image != '' ? 'style="background-image: url(' . esc_url( $museum_exhibition_header_image ) . '); background-repeat: no-repeat; background-size: 100% 100%"': ""; ?> data-sticky="<?php echo esc_attr( $museum_exhibition_sticky_header ); ?>">
                        <?php if ($museum_exhibition_topbar_setting): ?>
                            <div class="topbar">
                                <div class="row container m-auto">
                                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 align-self-center">
                                        <div class="opening-time">
                                            <?php if ( ! empty( $museum_exhibition_opening_timing ) ) { ?>
                                            <i class="<?php echo esc_attr( get_theme_mod( 'museum_exhibition_timing_icon', 'fas fa-clock' ) ); ?>"></i>
                                                <?php echo esc_html( $museum_exhibition_opening_timing ); ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 align-self-center">
                                        <div class="d-flex flex-wrap justify-content-end align-items-center gap-4 topbar-info">
                                            <?php if ( ! empty( $museum_exhibition_location ) ) { ?>
                                                <span class="location"><a href="https://www.google.com/maps/search/<?php echo urlencode( $museum_exhibition_location ); ?>" target="_blank" rel="noopener">
                                                    <i class="<?php echo esc_attr( get_theme_mod( 'museum_exhibition_marker_icon', 'fas fa-map-marker-alt' ) ); ?>"></i>
                                                    <?php echo esc_html( $museum_exhibition_location ); ?>
                                                </a></span>
                                                <?php if ( $museum_exhibition_phone ){?>
                                                    <span><a href="tel:<?php echo esc_attr($museum_exhibition_phone);?>"><i class="<?php echo esc_attr(get_theme_mod('museum_exhibition_phone_icon','fas fa-phone')); ?>"></i>
                                                <?php echo esc_html( $museum_exhibition_phone);?></span></a></span><?php } ?>  
                                                <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        <?php endif; ?>
                        <div class="container">
                            <div class="row header_bg">
                                <div class="col-xl-2 col-lg-2 col-md-4 align-self-center">
                                    <?php museum_exhibition_site_branding(); ?>
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-2 align-self-center text-center">
                                    <?php museum_exhibition_navigation(); ?> 
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 align-self-center text-md-end text-center headertext">
                                    <span class="header-info py-1">
                                        <?php if ( get_theme_mod( 'museum_exhibition_show_hide_search', false ) ) : ?>
                                            <div class="search-info">
                                                <div class="search-body">
                                                    <button type="button" class="search-show">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                                <div class="searchform-inner">
                                                    <?php get_search_form(); ?>
                                                    <button type="button" class="close" aria-label="<?php esc_attr_e( 'Close', 'museum-exhibition' ); ?>">
                                                        <span aria-hidden="true">X</span>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </span>
                                    <span class="py-1">
                                        <?php 
                                        if (defined('YITH_WCWL') && class_exists('YITH_WCWL_Wishlists')) {?>
                                        <a class="wishlist-btn" href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
                                            <i class="fa-solid fa-heart"></i>
                                        </a>
                                        <?php }?>
                                    </span>
                                    <div class="py-1">
                                        <?php if (class_exists('woocommerce')) { ?>
                                            <span class="cart-count">
                                                <a class="cart-customlocation" href="<?php if (function_exists('wc_get_cart_url')) { echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e('View Shopping Cart', 'museum-exhibition'); ?>">
                                                    <i class="fa-solid fa-bag-shopping"></i>
                                                </a>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <?php if ( $museum_exhibition_header_btn_text ){?>
                                        <div class="menudiv-button">
                                            <a href="<?php echo esc_url($museum_exhibition_header_btn_url);?>"> <?php echo esc_html($museum_exhibition_header_btn_text);?></a>
                                        </div>
                                    <?php } ?>   
                                </div>
                            </div>
                        </div> 
                        </div>              
                </header>
            </div>
        <?php
    }
endif;
add_action( 'museum_exhibition_header', 'museum_exhibition_header', 20 );