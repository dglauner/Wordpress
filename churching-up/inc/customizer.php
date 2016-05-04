<?php
/**
 * churching-up Theme Customizer.
 *
 * @package churching-up
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function churching_up_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        /**
        * Customizer Custom Stuff.
        */
        
        //Create Header Background Color Setting
        $wp_customize->add_setting('header_color', array(
            'default' => '#000000',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
        ));
        
        //Add Control
        $wp_customize->add_control(
            new WP_Customize_Color_Control
            ($wp_customize, 
                'header_color', array(
                    'label' => __('Header Background Color', 'churching-up'),
                    'section' => 'colors',
                )
            )
        ); 
        
        // Add option to select sidebar position
	$wp_customize->add_section( 'churching_up_options',
		array(
			'title' => __( 'Theme Options', 'churching-up' ),
//			'priority' => 95,
			'capability' => 'edit_theme_options',
			'description' => __( 'Change the default display options for the theme.', 'churching-up' )
		)
	);

	// Create settings
	$wp_customize->add_setting('layout_setting',
		array(
			'default' => 'no-sidebar',
			'type' => 'theme_mod',
			'sanitize_callback' => 'churching_up_sanitize_layout', // Sanitization function appears further down
			'transport' => 'postMessage'
		)
	);

	// Add the controls
	$wp_customize->add_control('churching_up_layout_control',
		array(
			'type' => 'radio',
			'label' => __( 'Sidebar position', 'churching-up' ),
			'section' => 'churching_up_options',
			'choices' => array(
				'no-sidebar' => __( 'No sidebar (default)', 'churching-up' ),
				'sidebar-left' => __( 'Left sidebar', 'churching-up' ),
				'sidebar-right' => __( 'Right sidebar', 'churching-up' )
			),
			'settings' => 'layout_setting' // Matches setting ID from above
		)
	);
        
        $wp_customize->add_setting( 'sidebar_frontpage_only', array(
        'default' => true,
        'type' => 'theme_mod',
        'sanitize_callback' => 'churching_up_sanitize_sidebar_frontpage_only',
        'transport'  =>  'postMessage'
         ) );

        $wp_customize->add_control(
        'churching_up_sidebar_frontpage_only',
        array(
            'section'   => 'churching_up_options',
            'label'     => 'Show sidebar on front page only?',
            'type'      => 'checkbox',
            'settings' => 'sidebar_frontpage_only' // Matches setting ID from above
             )
         );
}
add_action( 'customize_register', 'churching_up_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function churching_up_customize_preview_js() {
	wp_enqueue_script( 'churching_up_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'churching_up_customize_preview_js' );

/**
 * Inject Custom CSS.
 */
function churching_up_customizer_css() {
    $header_color = get_theme_mod('header_color');
    ?>
<style type="text/css">
    .site-header {
        background-color: <?php echo $header_color; ?>
    }
</style>
<?php
}
add_action('wp_head','churching_up_customizer_css');

/**
 * Sanitize layout options:
 * If something goes wrong and one of the three specified options are not used,
 * apply the default (no-sidebar).
 */

function churching_up_sanitize_layout( $value ) {
    if ( ! in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) )
        $value = 'no-sidebar';

    return $value;
}

function churching_up_sanitize_sidebar_frontpage_only( $value ) {
    if ( $value === false ){
        $value = false;
    } else {
        $value = true;
    }
    return $value;
}

