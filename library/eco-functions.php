<?php
function new_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'foundationpress') . ' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );