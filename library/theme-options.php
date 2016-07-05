<?php

//https://www.competethemes.com/blog/social-icons-wordpress-menu-theme-customizer/

function my_customizer_social_media_array() {

	/* store social site names in array */
	$social_sites = array('facebook', 'linkedin', 'youtube', 'twitter', 'google-plus', 'flickr', 'pinterest', 'rss', 'instagram', 'email');

	return $social_sites;
}


/* add settings to create various social media text areas. */
add_action('customize_register', 'my_add_social_sites_customizer');

function my_add_social_sites_customizer($wp_customize) {

	$wp_customize->add_section( 'my_social_settings', array(
			'title'    => __('Social Media Icons', 'foundationpress'),
			'priority' => 35,
	) );

	$social_sites = my_customizer_social_media_array();
	$priority = 5;

	foreach($social_sites as $social_site) {

		$social_site_name = ucfirst($social_site);
		
		$wp_customize->add_setting( "$social_site", array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
		) );

		$wp_customize->add_control( $social_site, array(
				'label'    => __( "$social_site_name url:", 'foundationpress' ),
				'section'  => 'my_social_settings',
				'type'     => 'text',
				'priority' => $priority,
		) );

		$priority = $priority + 5;
	}
}

/* takes user input from the customizer and outputs linked social media icons */
function my_social_media_icons() {

    $social_sites = my_customizer_social_media_array();

    /* any inputs that aren't empty are stored in $active_sites array */
    foreach($social_sites as $social_site) {
        if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
            $active_sites[] = $social_site;
        }
    }

    /* for each active social site, add it as a list item */
    if ( ! empty( $active_sites ) ) {

        // echo "<ul class='social-media-icons'>";

        foreach ( $active_sites as $active_site ) {

            /* setup the class */
	        $class = 'fa fa-' . $active_site;

            if ( $active_site == 'email' ) {
                ?>
                <li>
                    <a class="email" target="_blank" href="mailto:<?php echo antispambot( is_email( get_theme_mod( $active_site ) ) ); ?>">
                        <i class="fa fa-envelope" title="<?php _e('email icon', 'text-domain'); ?>"></i>
                    </a>
                </li>
            <?php } else { ?>
                <li>
                    <a class="<?php echo $active_site; ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $active_site) ); ?>">
                        <i class="<?php echo esc_attr( $class ); ?>" title="<?php printf( __('%s icon', 'text-domain'), $active_site ); ?>"></i>
                    </a>
                </li>
            <?php
            }
        }
        // echo "</ul>";
    }
}