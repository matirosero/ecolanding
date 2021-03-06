<?php
/**
 * Entry meta information for posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		echo '<div class="entry-meta">';
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . the_time('j \d\e\ F \d\e\ Y \|\ g:i a ') . '</time>';
		echo '<p class="byline author">' . __( 'Written by', 'foundationpress' ) . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author" class="fn">' . get_the_author() . '</a></p>';
		echo '</div>';
	}
endif;
