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
	if ( ( isset( $ajax ) && $ajax ) || ( property_exists( $args, 'theme_location' ) && $args->theme_location === 'top-bar-r' ) ) {
		// WooCommerce
		if ( class_exists( 'woocommerce' ) ) {
			$css_class = 'menu-item menu-item-type-cart menu-item-type-woocommerce-cart';

			// Is this the cart page?
			if ( is_cart() )
				$css_class .= ' current-menu-item';

			$items .= '<li class="' . esc_attr( $css_class ) . '">';
				$items .= '<a class="cart-contents" href="' . esc_url( WC()->cart->get_cart_url() ) . '">';
					$items .= wp_kses_data( WC()->cart->get_cart_total() ) . ' - <span class="count">' .  wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'simple-shop' ), WC()->cart->get_cart_contents_count() ) ) . '</span>';
				$items .= '</a>';
			$items .= '</li>';
		}
		// Easy Digital Downloads
		else if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			$css_class = 'menu-item menu-item-type-cart menu-item-type-edd-cart';

			// Is this the cart page?
			if ( edd_is_checkout() )
				$css_class .= ' current-menu-item';

			$items .= '<li class="' . esc_attr( $css_class ) . '">';
				$items .= '<a class="cart-contents" href="' . esc_url( edd_get_checkout_uri() ) . '">';
					$items .= wp_kses_data( edd_cart_subtotal() ) . ' - <span class="count">' .  wp_kses_data( sprintf( _n( '%d item', '%d items', edd_get_cart_quantity(), 'simple-shop' ), edd_get_cart_quantity() ) ) . '</span>';
				$items .= '</a>';
			$items .= '</li>';
		}
	}

	return $items;
}

