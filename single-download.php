<?php
/**
 * The template for displaying all single downloads
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<article id="single-download" class="expanded" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php
		if ( has_post_thumbnail() ) : ?>
			
			<header id="single-hero" role="banner" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
				<div class="marketing">
					<div class="tagline">
						<h1 class="entry-title"><?php the_title(); ?></h1>


					</div>
				</div>

			</header>			
		<?php endif;
	?>



	<div <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php //foundationpress_entry_meta(); ?>
		</header>
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">

		<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail();
			endif;
		?>

		<?php the_content(); ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</div>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</article>
<?php get_footer();
