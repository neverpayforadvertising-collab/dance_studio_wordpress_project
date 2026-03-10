<?php
/**
 * Museum Exhibition Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package museum_exhibition
 */

if( ! function_exists( 'museum_exhibition_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function museum_exhibition_customize_register( $wp_customize ) {
    require get_parent_theme_file_path('/inc/controls/changeable-icon.php');
    
    require get_parent_theme_file_path('/inc/controls/sortable-control.php');
    
    //Register the sortable control type.
    $wp_customize->register_control_type( 'Museum_Exhibition_Control_Sortable' ); 

    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'museum-exhibition' );
    }
	
    /* Option list of all post */	
    $museum_exhibition_options_posts = array();
    $museum_exhibition_options_posts_obj = get_posts('posts_per_page=-1');
    $museum_exhibition_options_posts[''] = esc_html__( 'Choose Post', 'museum-exhibition' );
    foreach ( $museum_exhibition_options_posts_obj as $museum_exhibition_posts ) {
    	$museum_exhibition_options_posts[$museum_exhibition_posts->ID] = $museum_exhibition_posts->post_title;
    }
    
    /* Option list of all categories */
    $museum_exhibition_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $museum_exhibition_option_categories = array();
    $museum_exhibition_category_lists = get_categories( $museum_exhibition_args );
    $museum_exhibition_option_categories[''] = esc_html__( 'Choose Category', 'museum-exhibition' );
    foreach( $museum_exhibition_category_lists as $museum_exhibition_category ){
        $museum_exhibition_option_categories[$museum_exhibition_category->term_id] = $museum_exhibition_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'museum-exhibition' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'museum-exhibition' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */
    
    /** Site Title control */
    $wp_customize->add_setting( 
        'header_site_title', 
        array(
            'default'           => false,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_site_title',
        array(
            'label'       => __( 'Show / Hide Site Title', 'museum-exhibition' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    /** Tagline control */
    $wp_customize->add_setting( 
        'header_tagline', 
        array(
            'default'           => false,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_tagline',
        array(
            'label'       => __( 'Show / Hide Tagline', 'museum-exhibition' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('logo_width', array(
        'sanitize_callback' => 'absint', 
    ));

    // Add a control for logo width
    $wp_customize->add_control('logo_width', array(
        'label' => __('Logo Width', 'museum-exhibition'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'min' => '50', 
            'max' => '500', 
            'step' => '5', 
    ),
        'default' => '100', 
    ));

    $wp_customize->add_setting( 'museum_exhibition_site_title_size', array(
        'default'           => 30, // Default font size in pixels
        'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
    ) );

    // Add control for site title size
    $wp_customize->add_control( 'museum_exhibition_site_title_size', array(
        'type'        => 'number',
        'section'     => 'title_tagline', // You can change this section to your preferred section
        'label'       => __( 'Site Title Font Size (px)', 'museum-exhibition' ),
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 1,
        ),
    ) );

    //Global Color
    $wp_customize->add_section(
        'museum_exhibition_global_color',
        array(
            'title' => esc_html__( 'Global Color Settings', 'museum-exhibition' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_general_settings',
        )
    );

    $wp_customize->add_setting('museum_exhibition_primary_color', array(
        'default'           => '#A4893B',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'museum_exhibition_primary_color', array(
        'label'    => __('Theme Primary Color', 'museum-exhibition'),
        'section'  => 'museum_exhibition_global_color',
        'settings' => 'museum_exhibition_primary_color',
    )));    


    /** Home Page Settings */
    $wp_customize->add_panel( 
        'museum_exhibition_post_settings',
         array(
            'priority' => 11,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Post & Pages Settings', 'museum-exhibition' ),
            'description' => esc_html__( 'Customize Post & Pages Settings', 'museum-exhibition' ),
        ) 
    );

        /** Post Layouts */
    
    $wp_customize->add_section(
        'museum_exhibition_post_layout_section',
        array(
            'title' => esc_html__( 'Post Layout Settings', 'museum-exhibition' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_post_settings',
        )
    );

    $wp_customize->add_setting('museum_exhibition_post_layout_setting', array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'museum_exhibition_sanitize_post_layout',
    ));

    $wp_customize->add_control('museum_exhibition_post_layout_setting', array(
        'label'    => __('Post Column Settings', 'museum-exhibition'),
        'section'  => 'museum_exhibition_post_layout_section',
        'settings' => 'museum_exhibition_post_layout_setting',
        'type'     => 'select',
        'choices'  => array(        
            'right-sidebar'   => __('Right Sidebar', 'museum-exhibition'),
            'left-sidebar'   => __('Left Sidebar', 'museum-exhibition'),
            'one-column'   => __('One Column', 'museum-exhibition'),
            'three-column'   => __('Three Columns', 'museum-exhibition'),
            'four-column'   => __('Four Columns', 'museum-exhibition'),
            'grid-layout'   => __('Grid Layout', 'museum-exhibition')
        ),
    ));

     /** Post Layouts Ends */
     
    /** Post Settings */
    $wp_customize->add_section(
        'museum_exhibition_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'museum-exhibition' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_post_settings',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'museum_exhibition_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'museum_exhibition_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'museum_exhibition_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'museum_exhibition_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_post_settings',
            'type'        => 'checkbox',
        )
    );
    /** Post ReadMore control */
     $wp_customize->add_setting( 'museum_exhibition_read_more_setting', array(
        'default'           => true,
        'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'museum_exhibition_read_more_setting', array(
        'type'        => 'checkbox',
        'section'     => 'museum_exhibition_post_settings', 
        'label'       => __( 'Display Read More Button', 'museum-exhibition' ),
    ) );

    /** Post Settings Ends */

     /** Single Post Settings */
    $wp_customize->add_section(
        'museum_exhibition_single_post_settings',
        array(
            'title' => esc_html__( 'Single Post Settings', 'museum-exhibition' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_post_settings',
        )
    );

    /** Single Post Meta control */
    $wp_customize->add_setting( 
        'museum_exhibition_single_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_single_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Meta', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Content control */
    $wp_customize->add_setting( 
        'museum_exhibition_single_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_single_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Content', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Settings Ends */

         // Typography Settings Section
    $wp_customize->add_section('museum_exhibition_typography_settings', array(
        'title'      => esc_html__('Typography Settings', 'museum-exhibition'),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel' => 'museum_exhibition_general_settings',
    ));

    // Array of fonts to choose from
    $font_choices = array(
        ''               => __('Select', 'museum-exhibition'),
        'Arial'          => 'Arial, sans-serif',
        'Verdana'        => 'Verdana, sans-serif',
        'Helvetica'      => 'Helvetica, sans-serif',
        'Times New Roman'=> '"Times New Roman", serif',
        'Georgia'        => 'Georgia, serif',
        'Courier New'    => '"Courier New", monospace',
        'Trebuchet MS'   => '"Trebuchet MS", sans-serif',
        'Tahoma'         => 'Tahoma, sans-serif',
        'Palatino'       => '"Palatino Linotype", serif',
        'Garamond'       => 'Garamond, serif',
        'Impact'         => 'Impact, sans-serif',
        'Comic Sans MS'  => '"Comic Sans MS", cursive, sans-serif',
        'Lucida Sans'    => '"Lucida Sans Unicode", sans-serif',
        'Arial Black'    => '"Arial Black", sans-serif',
        'Gill Sans'      => '"Gill Sans", sans-serif',
        'Segoe UI'       => '"Segoe UI", sans-serif',
        'Open Sans'      => '"Open Sans", sans-serif',
        'Roboto'         => 'Roboto, sans-serif',
        'Lato'           => 'Lato, sans-serif',
        'Montserrat'     => 'Montserrat, sans-serif',
        'Libre Baskerville' => 'Libre Baskerville',
    );

    // Heading Font Setting
    $wp_customize->add_setting('museum_exhibition_heading_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'museum_exhibition_sanitize_choicess',
    ));
    $wp_customize->add_control('museum_exhibition_heading_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Heading', 'museum-exhibition'),
        'section' => 'museum_exhibition_typography_settings',
    ));

    // Body Font Setting
    $wp_customize->add_setting('museum_exhibition_body_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'museum_exhibition_sanitize_choicess',
    ));
    $wp_customize->add_control('museum_exhibition_body_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Body', 'museum-exhibition'),
        'section' => 'museum_exhibition_typography_settings',
    ));

    /** Typography Settings Section End */

        /** Home Page Settings */
    $wp_customize->add_panel( 
        'museum_exhibition_general_settings',
         array(
            'priority' => 9,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'General Settings', 'museum-exhibition' ),
            'description' => esc_html__( 'Customize General Settings', 'museum-exhibition' ),
        ) 
    );

    /** General Settings */
    $wp_customize->add_section(
        'museum_exhibition_general_settings',
        array(
            'title' => esc_html__( 'Loader Settings', 'museum-exhibition' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_general_settings',
        )
    );

    /** Preloader control */
    $wp_customize->add_setting( 
        'museum_exhibition_header_preloader', 
        array(
            'default' => false,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_header_preloader',
        array(
            'label'       => __( 'Show Preloader', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_general_settings',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('museum_exhibition_loader_layout_setting', array(
        'default' => 'load',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for loader layout
    $wp_customize->add_control('museum_exhibition_loader_layout_control', array(
        'label' => __('Preloader Layout', 'museum-exhibition'),
        'section' => 'museum_exhibition_general_settings',
        'settings' => 'museum_exhibition_loader_layout_setting',
        'type' => 'select',
        'choices' => array(
            'load' => __('Preloader 1', 'museum-exhibition'),
            'load-one' => __('Preloader 2', 'museum-exhibition'),
            'ctn-preloader' => __('Preloader 3', 'museum-exhibition'),
        ),
    ));

    /** Topbar Section Settings */
    $wp_customize->add_section(
        'museum_exhibition_topbar_section_settings',
        array(
            'title' => esc_html__( 'Topbar Settings', 'museum-exhibition' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_home_page_settings',
        )
    );

    $wp_customize->add_setting( 
        'museum_exhibition_topbar_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_topbar_setting',
        array(
            'label'       => __( 'Show Topbar', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_topbar_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Topbar Section - Opening Timing.
    $wp_customize->add_setting(
        'museum_exhibition_opening_timing',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'museum_exhibition_opening_timing',
        array(
            'label'           => esc_html__( 'Opening Timing', 'museum-exhibition' ),
            'section'         => 'museum_exhibition_topbar_section_settings',
            'type'            => 'text',
        )
    );

    /** Timing icon */
    $wp_customize->add_setting(
        'museum_exhibition_timing_icon',
        array(
            'default'           => 'fas fa-clock',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Museum_Exhibition_Changeable_Icon(
            $wp_customize,
            'museum_exhibition_timing_icon',
            array(
                'label'     => esc_html__( 'Timing Icon', 'museum-exhibition' ),
                'transport' => 'refresh',
                'section'   => 'museum_exhibition_topbar_section_settings',
                'type'      => 'icon',
            )
        )
    );

    /** Location (text) */
    $wp_customize->add_setting(
        'museum_exhibition_header_location',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_header_location',
        array(
            'label'   => esc_html__( 'Add Location', 'museum-exhibition' ),
            'section' => 'museum_exhibition_topbar_section_settings',
            'type'    => 'text',
        )
    );

    /** Location icon */
    $wp_customize->add_setting(
        'museum_exhibition_marker_icon',
        array(
            'default'           => 'fas fa-map-marker-alt',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Museum_Exhibition_Changeable_Icon(
            $wp_customize,
            'museum_exhibition_marker_icon',
            array(
                'label'     => esc_html__( 'Location Icon', 'museum-exhibition' ),
                'transport' => 'refresh',
                'section'   => 'museum_exhibition_topbar_section_settings',
                'type'      => 'icon',
            )
        )
    );

        /** Phone */
    $wp_customize->add_setting(
        'museum_exhibition_header_phone',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_header_phone',
        array(
            'label'   => esc_html__( 'Add Phone', 'museum-exhibition' ),
            'section' => 'museum_exhibition_topbar_section_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'museum_exhibition_phone_icon',
        array(
            'default'           => 'fas fa-phone',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Museum_Exhibition_Changeable_Icon(
            $wp_customize,
            'museum_exhibition_phone_icon',
            array(
                'label'     => esc_html__( 'Phone Icon', 'museum-exhibition' ),
                'transport' => 'refresh',
                'section'   => 'museum_exhibition_topbar_section_settings',
                'type'      => 'icon',
            )
        )
    );

    $wp_customize->add_setting( 
        'museum_exhibition_topbar_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_topbar_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(MUSEUM_EXHIBITION_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'museum_exhibition_topbar_section_settings'
        )
    );

    /** Header Section Settings */
    $wp_customize->add_section(
        'museum_exhibition_header_section_settings',
        array(
            'title' => esc_html__( 'Header Settings', 'museum-exhibition' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_home_page_settings',
        )
    );

    $wp_customize->add_setting( 
        'museum_exhibition_show_hide_search', 
        array(
            'default' => false ,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_show_hide_search',
        array(
            'label'       => __( 'Show Search Field', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_header_section_settings',
            'type'        => 'checkbox',
        )
    );

    /** Button text & url */
    $wp_customize->add_setting(
        'museum_exhibition_header_btn_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_header_btn_text',
        array(
            'label'   => esc_html__( 'Add Button Text', 'museum-exhibition' ),
            'section' => 'museum_exhibition_header_section_settings',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'museum_exhibition_header_btn_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_header_btn_url',
        array(
            'label'   => esc_html__( 'Add Button URL', 'museum-exhibition' ),
            'section' => 'museum_exhibition_header_section_settings',
            'type'    => 'url',
        )
    );

    /** Sticky Header control */
    $wp_customize->add_setting( 
        'museum_exhibition_sticky_header', 
        array(
            'default' => false,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_sticky_header',
        array(
            'label'       => __( 'Show Sticky Header', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_header_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Add Setting for Menu Font Weight
    $wp_customize->add_setting( 'museum_exhibition_menu_font_weight', array(
        'default'           => '400',
        'sanitize_callback' => 'museum_exhibition_sanitize_font_weight',
    ) );

    // Add Control for Menu Font Weight
    $wp_customize->add_control( 'museum_exhibition_menu_font_weight', array(
        'label'    => __( 'Menu Font Weight', 'museum-exhibition' ),
        'section'  => 'museum_exhibition_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            '100' => __( '100 - Thin', 'museum-exhibition' ),
            '200' => __( '200 - Extra Light', 'museum-exhibition' ),
            '300' => __( '300 - Light', 'museum-exhibition' ),
            '400' => __( '400 - Normal', 'museum-exhibition' ),
            '500' => __( '500 - Medium', 'museum-exhibition' ),
            '600' => __( '600 - Semi Bold', 'museum-exhibition' ),
            '700' => __( '700 - Bold', 'museum-exhibition' ),
            '800' => __( '800 - Extra Bold', 'museum-exhibition' ),
            '900' => __( '900 - Black', 'museum-exhibition' ),
        ),
    ) );

    // Add Setting for Menu Text Transform
    $wp_customize->add_setting( 'museum_exhibition_menu_text_transform', array(
        'default'           => 'Capitalize',
        'sanitize_callback' => 'museum_exhibition_sanitize_text_transform',
    ) );

    // Add Control for Menu Text Transform
    $wp_customize->add_control( 'museum_exhibition_menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'museum-exhibition' ),
        'section'  => 'museum_exhibition_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __( 'None', 'museum-exhibition' ),
            'capitalize' => __( 'Capitalize', 'museum-exhibition' ),
            'uppercase'  => __( 'Uppercase', 'museum-exhibition' ),
            'lowercase'  => __( 'Lowercase', 'museum-exhibition' ),
        ),
    ) );

    $wp_customize->add_setting('museum_exhibition_menus_style',array(
        'default' => '',
        'sanitize_callback' => 'museum_exhibition_sanitize_choices'
	));
	$wp_customize->add_control('museum_exhibition_menus_style',array(
        'type' => 'select',
		'label' => __('Menu Hover Style','museum-exhibition'),
		'section' => 'museum_exhibition_header_section_settings',
		'choices' => array(
         'None' => __('None','museum-exhibition'),
         'Zoom In' => __('Zoom In','museum-exhibition'),
      ),
	));

    $wp_customize->add_setting( 
        'museum_exhibition_header_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_header_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(MUSEUM_EXHIBITION_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'museum_exhibition_header_section_settings'
        )
    );

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'museum_exhibition_home_page_settings',
         array(
            'priority' => 9,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'museum-exhibition' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'museum-exhibition' ),
        ) 
    );

 /** Slider Section Settings */
    $wp_customize->add_section(
        'museum_exhibition_slider_section_settings',
        array(
            'title' => esc_html__( 'Slider Section Settings', 'museum-exhibition' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'museum_exhibition_home_page_settings',
        )
    );

    /** Slider Section control */
    $wp_customize->add_setting( 
        'museum_exhibition_slider_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_slider_setting',
        array(
            'label'       => __( 'Show Slider', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_slider_section_settings',
            'type'        => 'checkbox',
        )
    );

    $museum_exhibition_categories = get_categories();
        $museum_exhibition_cat_posts = array();
            $museum_exhibition_i = 0;
            $museum_exhibition_cat_posts[]='Select';
        foreach($museum_exhibition_categories as $museum_exhibition_category){
            if($museum_exhibition_i==0){
            $museum_exhibition_default = $museum_exhibition_category->slug;
            $museum_exhibition_i++;
        }
        $museum_exhibition_cat_posts[$museum_exhibition_category->slug] = $museum_exhibition_category->name;
    }

    $wp_customize->add_setting(
        'museum_exhibition_blog_slide_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'museum_exhibition_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_blog_slide_category',
        array(
            'type'    => 'select',
            'choices' => $museum_exhibition_cat_posts,
            'label' => __('Select Category to display Latest Post','museum-exhibition'),
            'section' => 'museum_exhibition_slider_section_settings',
        )
    );

    // slider button Text
    $wp_customize->add_setting('museum_exhibition_slider_btn_text', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('museum_exhibition_slider_btn_text', 
        array(
        'label'       => __('Slider Button Text', 'museum-exhibition'),
        'section'     => 'museum_exhibition_slider_section_settings',   
        'settings'    => 'museum_exhibition_slider_btn_text',
        'type'        => 'text'
        )
    );

    // slider button Url
    $wp_customize->add_setting('museum_exhibition_slider_btn_url', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('museum_exhibition_slider_btn_url', 
        array(
        'label'       => __('Slider Button URL', 'museum-exhibition'),
        'section'     => 'museum_exhibition_slider_section_settings',   
        'settings'    => 'museum_exhibition_slider_btn_url',
        'type'        => 'url'
        )
    );

    // Section Text
    $wp_customize->add_setting('museum_exhibition_slider_short_title', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('museum_exhibition_slider_short_title', 
        array(
        'label'       => __('Short Title', 'museum-exhibition'),
        'section'     => 'museum_exhibition_slider_section_settings',   
        'settings'    => 'museum_exhibition_slider_short_title',
        'type'        => 'text'
        )
    );
  
    // Section Text
    $wp_customize->add_setting('museum_exhibition_slider_text_extra', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('museum_exhibition_slider_text_extra', 
        array(
        'label'       => __('Slider Extra Content', 'museum-exhibition'),
        'section'     => 'museum_exhibition_slider_section_settings',   
        'settings'    => 'museum_exhibition_slider_text_extra',
        'type'        => 'text'
        )
    );

    $wp_customize->add_setting( 
        'museum_exhibition_slider_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_slider_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(MUSEUM_EXHIBITION_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'museum_exhibition_slider_section_settings'
        )
    );

    /** Exhibitions Settings */
    
    $wp_customize->add_section( 'museum_exhibition_section_featured_about',
        array(
        'title'      => __( 'Exhibitions Section', 'museum-exhibition' ),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel'      => 'museum_exhibition_home_page_settings',
        )
    );

    /** Exhibitions Section control */
    $wp_customize->add_setting( 
        'museum_exhibition_about_setting', 
        array(
            'default' => false ,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_about_setting',
        array(
            'label'       => __( 'Show Exhibitions Section', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_section_featured_about',
            'type'        => 'checkbox',
        )
    );

    // Section Title
    $wp_customize->add_setting('museum_exhibition_featured_mission_section_title', 
        array(
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('museum_exhibition_featured_mission_section_title', 
        array(
        'label'       => __('Section Title', 'museum-exhibition'),
        'section'     => 'museum_exhibition_section_featured_about',   
        'settings'    => 'museum_exhibition_featured_mission_section_title',
        'type'        => 'text'
        )
    );

    // Section Text
    $wp_customize->add_setting('museum_exhibition_featured_mission_section_text', 
        array(
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('museum_exhibition_featured_mission_section_text', 
        array(
        'label'       => __('Section Text', 'museum-exhibition'),
        'section'     => 'museum_exhibition_section_featured_about',   
        'settings'    => 'museum_exhibition_featured_mission_section_text',
        'type'        => 'text'
        )
    );

    // Items
    $wp_customize->add_setting('museum_exhibition_number_of_featured_mission_items', 
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'museum_exhibition_sanitize_number_range'
        )
    );

    $wp_customize->add_control('museum_exhibition_number_of_featured_mission_items', 
        array(
        'label'       => __('Items (Max: 6)', 'museum-exhibition'),
        'description' => __('Add Count and Refresh Page','museum-exhibition'),
        'section'     => 'museum_exhibition_section_featured_about',   
        'settings'    => 'museum_exhibition_number_of_featured_mission_items',
        'type'        => 'number',
        'input_attrs' => array(
                'min'   => 1,
                'max'   => 6,
                'step'  => 1,
            ),
        )
    );

    $museum_exhibition_number_of_featured_mission_items = get_theme_mod( 'museum_exhibition_number_of_featured_mission_items' );

    for ($museum_exhibition_item_index = 1; $museum_exhibition_item_index <= $museum_exhibition_number_of_featured_mission_items; $museum_exhibition_item_index++) {

        // Section Tab
        $wp_customize->add_setting('museum_exhibition_featured_mission_section_tab_' . $museum_exhibition_item_index, 
            array(  
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control('museum_exhibition_featured_mission_section_tab_' . $museum_exhibition_item_index, 
            array(
                'label'       => __('Tab ', 'museum-exhibition') . $museum_exhibition_item_index,
                'section'     => 'museum_exhibition_section_featured_about',
                'settings'    => 'museum_exhibition_featured_mission_section_tab_' . $museum_exhibition_item_index,
                'type'        => 'text'
            )
        );

        // Post Categories
        $museum_exhibition_categories = get_categories();
        $museum_exhibition_cat_posts = array();
        $museum_exhibition_default = '';
        $museum_exhibition_cat_posts[] = 'Select';
        foreach ($museum_exhibition_categories as $museum_exhibition_category) {
            $museum_exhibition_cat_posts[$museum_exhibition_category->slug] = $museum_exhibition_category->name;
        }

        $wp_customize->add_setting(
            'museum_exhibition_trending_post_slider_args_' . $museum_exhibition_item_index,
            array(
                'default'            => 'select',
                'sanitize_callback'  => 'museum_exhibition_sanitize_choices',
            )
        );
        $wp_customize->add_control(
            'museum_exhibition_trending_post_slider_args_' . $museum_exhibition_item_index,
            array(
                'type'     => 'select',
                'choices'  => $museum_exhibition_cat_posts,
                'label'    => __('Select Category to display Tab Details', 'museum-exhibition'),
                'section'  => 'museum_exhibition_section_featured_about',
            )
        );
    }

    $wp_customize->add_setting( 
        'museum_exhibition_exhibition_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_exhibition_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(MUSEUM_EXHIBITION_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'museum_exhibition_section_featured_about'
        )
    );
    
    /** Footer Section */
    $wp_customize->add_section(
        'museum_exhibition_footer_section',
        array(
            'title' => __( 'Footer Settings', 'museum-exhibition' ),
            'priority' => 70,
            'panel' => 'museum_exhibition_home_page_settings',
        )
    );

    /** Footer Widget Columns */
    $wp_customize->add_setting('museum_exhibition_footer_widget_areas', array(
        'default'           => 4,
        'sanitize_callback' => 'museum_exhibition_sanitize_choices',
    ));

    $wp_customize->add_control('museum_exhibition_footer_widget_areas', array(
        'label'    => __('Footer Widget Columns', 'museum-exhibition'),
        'section'  => 'museum_exhibition_footer_section',
        'settings' => 'museum_exhibition_footer_widget_areas',
        'type'     => 'select',
        'choices'  => array(
		   '1'     => __('One', 'museum-exhibition'),
		   '2'     => __('Two', 'museum-exhibition'),
		   '3'     => __('Three', 'museum-exhibition'),
		   '4'     => __('Four', 'museum-exhibition')
        ),
    ));

    /** Footer Copyright control */
    $wp_customize->add_setting( 
        'museum_exhibition_footer_setting', 
        array(
            'default' => true,
            'sanitize_callback' => 'museum_exhibition_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'museum_exhibition_footer_setting',
        array(
            'label'       => __( 'Show Footer Copyright', 'museum-exhibition' ),
            'section'     => 'museum_exhibition_footer_section',
            'type'        => 'checkbox',
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'museum_exhibition_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'museum_exhibition_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'museum-exhibition' ),
            'section' => 'museum_exhibition_footer_section',
            'type' => 'text',
        )
    );  
$wp_customize->add_setting('museum_exhibition_footer_background_image',
        array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_control(
         new WP_Customize_Cropped_Image_Control($wp_customize, 'museum_exhibition_footer_background_image',
            array(
                'label' => esc_html__('Footer Background Image', 'museum-exhibition'),
                /* translators: 1: image width in pixels, 2: image height in pixels */
                'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'museum-exhibition'), 1024, 800),
                'section' => 'museum_exhibition_footer_section',
                'width' => 1024,
                'height' => 800,
                'flex_width' => true,
                'flex_height' => true,
            )
        )
    );

    /** Footer Background Image Attachment */
    $wp_customize->add_setting('museum_exhibition_background_attatchment', array(
        'default'           => 'scroll',
        'sanitize_callback' => 'museum_exhibition_sanitize_choices',
    ));

    $wp_customize->add_control('museum_exhibition_background_attatchment', array(
        'label'    => __('Footer Background Attachment', 'museum-exhibition'),
        'section'  => 'museum_exhibition_footer_section',
        'settings' => 'museum_exhibition_background_attatchment',
        'type'     => 'select',
        'choices'  => array(
            'fixed' => __('fixed','museum-exhibition'),
            'scroll' => __('scroll','museum-exhibition'),
        ),
    ));

    /* Footer Background Color*/
    $wp_customize->add_setting(
        'museum_exhibition_footer_background_color',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'museum_exhibition_footer_background_color',
            array(
                'label' => __('Footer Widget Area Background Color', 'museum-exhibition'),
                'section' => 'museum_exhibition_footer_section',
                'type' => 'color',
            )
        )
    );

     $wp_customize->add_setting('museum_exhibition_scroll_icon',array(
        'default'   => 'fas fa-arrow-up',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Museum_Exhibition_Changeable_Icon(
        $wp_customize,'museum_exhibition_scroll_icon',array(
        'label' => __('Scroll Top Icon','museum-exhibition'),
        'transport' => 'refresh',
        'section'   => 'museum_exhibition_footer_section',
        'type'      => 'icon'
    )));

        /** Scroll to top button shape */
    $wp_customize->add_setting('museum_exhibition_scroll_to_top_radius', array(
        'default'           => 'curved-box',
        'sanitize_callback' => 'museum_exhibition_sanitize_choices',
    ));

    $wp_customize->add_control('museum_exhibition_scroll_to_top_radius', array(
        'label'    => __('Scroll Top Button Shape', 'museum-exhibition'),
        'section'  => 'museum_exhibition_footer_section',
        'settings' => 'museum_exhibition_scroll_to_top_radius',
        'type'     => 'select',
        'choices'  => array(
            'box'        => __( 'Box', 'museum-exhibition' ),
            'curved-box' => __( 'Curved Box', 'museum-exhibition' ),
            'circle'     => __( 'Circle', 'museum-exhibition' ),
        ),
    ));

    $wp_customize->add_setting( 
        'museum_exhibition_footer_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'museum_exhibition_footer_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(MUSEUM_EXHIBITION_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'museum_exhibition_footer_section'
        )
    );

    // 404 PAGE SETTINGS
    $wp_customize->add_section(
        'museum_exhibition_404_section',
        array(
            'title' => __( '404 Page Settings', 'museum-exhibition' ),
            'priority' => 70,
            'panel' => 'museum_exhibition_general_settings',
        )
    );
   
    $wp_customize->add_setting('museum_exhibition_404_page_image', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw', // Sanitize as URL
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'museum_exhibition_404_page_image', array(
        'label' => __('404 Page Image', 'museum-exhibition'),
        'section' => 'museum_exhibition_404_section',
        'settings' => 'museum_exhibition_404_page_image',
    )));

    $wp_customize->add_setting('museum_exhibition_404_pagefirst_header', array(
        'default' => __('404', 'museum-exhibition'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('museum_exhibition_404_pagefirst_header', array(
        'type' => 'text',
        'label' => __('404 Page Heading', 'museum-exhibition'),
        'section' => 'museum_exhibition_404_section',
    ));

    // Setting for 404 page header
    $wp_customize->add_setting('museum_exhibition_404_page_header', array(
        'default' => __('Sorry, that page can\'t be found!', 'museum-exhibition'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('museum_exhibition_404_page_header', array(
        'type' => 'text',
        'label' => __('404 Page Content', 'museum-exhibition'),
        'section' => 'museum_exhibition_404_section',
    ));

}
add_action( 'customize_register', 'museum_exhibition_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function museum_exhibition_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $museum_exhibition_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $museum_exhibition_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'museum_exhibition_customizer', get_template_directory_uri() . '/js' . $museum_exhibition_build . '/customizer' . $museum_exhibition_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'museum_exhibition_customize_preview_js' );