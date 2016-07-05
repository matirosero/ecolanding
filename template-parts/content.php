<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry'); ?>>
	<header>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail();
			endif;
		?>
		<?php foundationpress_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php 			
			the_excerpt(); ?>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
</div>
