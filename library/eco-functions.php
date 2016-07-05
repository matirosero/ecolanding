<?php
function new_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'foundationpress') . ' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );



/**
 * These functions will add WooCmmerce or Easy Digital Downloads cart icons/menu items to the "top_nav" WordPress menu area (if it exists).
 * Please customize the following code to fit your needs.
 */

/**
 * This function adds the WooCommerce or Easy Digital Downloads cart icons/items to the top_nav menu area as the last item.
 */
add_filter( 'wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2 );

function my_wp_nav_menu_items( $items, $args, $ajax = false ) {
	// Top Navigation Area Only
	if ( ( isset( $ajax ) && $ajax ) || ( property_exists( $args, 'theme_location' ) && ( $args->theme_location === 'top-bar-r' || $args->theme_location === 'mobile-nav' ) ) ) {

		// Easy Digital Downloads
		if ( class_exists( 'Easy_Digital_Downloads' ) && edd_get_cart_quantity() != 0 ) {

			$css_class = 'menu-item menu-item-type-cart menu-item-type-edd-cart';

			// Is this the cart page?
			if ( edd_is_checkout() )
				$css_class .= ' current-menu-item';

			$items .= '<li class="' . esc_attr( $css_class ) . '">';
				$items .= '<a class="cart-contents" href="' . esc_url( edd_get_checkout_uri() ) . '">';
					$items .= wp_kses_data( edd_cart_subtotal() ) . ' - <span class="count">' .  wp_kses_data( sprintf( _n( '%d item', '%d items', edd_get_cart_quantity(), 'foundationpress' ), edd_get_cart_quantity() ) ) . '</span>';
				$items .= '</a>';
			$items .= '</li>';

		}

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
		        $class = 'menu-item ' . $active_site . '-link';

	            if ( $active_site == 'email' ) {
	                $items .= '<li class="'.esc_attr( $class ).'">
	                    <a target="_blank" href="mailto:' . antispambot( is_email( get_theme_mod( $active_site ) ) ) . '">
	                        <span>'.ucfirst($active_site).'</span></a>
	                </li>';
	            } else {
	                $items .= '<li class="'.esc_attr( $class ).'">
	                    <a class="'.$active_site.'" target="_blank" href="'.esc_url( get_theme_mod( $active_site) ).'">
	                        <span>'.ucfirst($active_site).'</span></a>
	                </li>';
	            }
	        }
	        // echo "</ul>";
	    }
	}

	return $items;
}

