<?php

$museum_exhibition_custom_css = "";


$museum_exhibition_primary_color = get_theme_mod('museum_exhibition_primary_color');

/*------------------ Primary Global Color -----------*/

if ($museum_exhibition_primary_color) {
  $museum_exhibition_custom_css .= ':root {';
  $museum_exhibition_custom_css .= '--primary-color: ' . esc_attr($museum_exhibition_primary_color) . ' !important;';
  $museum_exhibition_custom_css .= '} ';
}

	// Scroll to top button shape 

	$museum_exhibition_scroll_border_radius = get_theme_mod( 'museum_exhibition_scroll_to_top_radius','curved-box');
    if($museum_exhibition_scroll_border_radius == 'box'){
		$museum_exhibition_custom_css .='#button{';
			$museum_exhibition_custom_css .='border-radius: 0px;';
		$museum_exhibition_custom_css .='}';
	}else if($museum_exhibition_scroll_border_radius == 'curved-box'){
		$museum_exhibition_custom_css .='#button{';
			$museum_exhibition_custom_css .='border-radius: 4px;';
		$museum_exhibition_custom_css .='}';
	}
	else if($museum_exhibition_scroll_border_radius == 'circle'){
		$museum_exhibition_custom_css .='#button{';
			$museum_exhibition_custom_css .='border-radius: 50%;';
		$museum_exhibition_custom_css .='}';
	}

  // Footer Background Image Attatchment 

	$museum_exhibition_footer_attatchment = get_theme_mod( 'museum_exhibition_background_attatchment','scroll');
	if($museum_exhibition_footer_attatchment == 'fixed'){
		$museum_exhibition_custom_css .='.site-footer{';
			$museum_exhibition_custom_css .='background-attachment: fixed;';
		$museum_exhibition_custom_css .='}';
	}elseif ($museum_exhibition_footer_attatchment == 'scroll'){
		$museum_exhibition_custom_css .='.site-footer{';
			$museum_exhibition_custom_css .='background-attachment: scroll;';
		$museum_exhibition_custom_css .='}';
	}

  // Menu Hover Style	

	$museum_exhibition_menus_item = get_theme_mod( 'museum_exhibition_menus_style','None');
    if($museum_exhibition_menus_item == 'None'){
		$museum_exhibition_custom_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu li a:hover{';
			$museum_exhibition_custom_css .='';
		$museum_exhibition_custom_css .='}';
	}else if($museum_exhibition_menus_item == 'Zoom In'){
		$museum_exhibition_custom_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu li a:hover{';
		$museum_exhibition_custom_css .= 'transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important;';
		$museum_exhibition_custom_css .= '}';
		
		$museum_exhibition_custom_css .= '.main-navigation ul ul li a:hover {';
		$museum_exhibition_custom_css .= 'margin-left: 20px;';
		$museum_exhibition_custom_css .= '}';
	}	
