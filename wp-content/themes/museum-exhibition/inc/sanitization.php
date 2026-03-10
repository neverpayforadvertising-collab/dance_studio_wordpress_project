<?php

function museum_exhibition_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

//------------------------------------------------------------------------------//
// Sanitize Font Weight
function museum_exhibition_sanitize_font_weight( $value ) {
    $valid = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
    return in_array( $value, $valid ) ? $value : '400';
}

/*------------------------------------------------------------------------*/

// Sanitize Text Transform
function museum_exhibition_sanitize_text_transform( $value ) {
    $valid = array( 'none', 'capitalize', 'uppercase', 'lowercase' );
    return in_array( $value, $valid ) ? $value : 'none';
}

/*------------------------------------------------------------------------*/

 function museum_exhibition_sanitize_choices( $input, $setting ) {
        global $wp_customize; 
        $control = $wp_customize->get_control( $setting->id ); 
        if ( array_key_exists( $input, $control->choices ) ) {
            return $input;
        } else {
            return $setting->default;
        }
    }

/*------------------------------------------------------------------------*/

    function museum_exhibition_sanitize_choicess($input) {
    $valid = array(
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
    );

    return (array_key_exists($input, $valid)) ? $input : '';
}

/*------------------------------------------------------------------------*/

// Sanitize callback function
function museum_exhibition_sanitize_post_layout($input) {
    $valid = array('one-column', 'right-sidebar', 'left-sidebar', 'three-column', 'four-column', 'grid-layout');

    if (in_array($input, $valid, true)) {
        return $input;
    }

    return 'right-sidebar'; // Default value if the input is invalid
}

/*------------------------------------------------------------------------*/

/**
 * Sanitize number range.
 *  
 */
function museum_exhibition_sanitize_number_range( $input, $setting ) {

    // Ensure input is an absolute integer.
    $input = absint( $input );

    // Get the input attributes associated with the setting.
    $atts = $setting->manager->get_control( $setting->id )->input_attrs;

    // Get min.
    $min = ( isset( $atts['min'] ) ? $atts['min'] : $input );

    // Get max.
    $max = ( isset( $atts['max'] ) ? $atts['max'] : $input );

    // Get Step.
    $step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

    // If the input is within the valid range, return it; otherwise, return the default.
    return ( $min <= $input && $input <= $max && is_int( $input / $step ) ? $input : $setting->default );

}
