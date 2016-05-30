<?php
/**
 * The template for displaying all single downloads
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<article id="single-download" <?php post_class('expanded') ?> id="post-<?php the_ID(); ?>" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php

	global $user_ID; // the ID of the currently logged-in user
	$download_id = get_the_ID(); // download ID

	if ( has_post_thumbnail() ) : ?>

		<header id="single-hero" role="banner" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
			<div class="hero-header-container">
				<div class="header-content">
					<h1 class="entry-title"><?php the_title(); ?><small><?php the_field('downloads_subtitle'); ?></small></h1>

					<?php if(function_exists('edd_price')) { ?>
						<div class="product-buttons">
							<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
								<?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
							<?php } ?>

						</div><!--end .product-buttons-->
					<?php } ?>
				</div>


			</div>

		</header>
	<?php endif; ?>

	<div class="intro" role="main">
		<div class="intro-container">
			<p class="course-intro"><?php the_field('downloads_intro'); ?></p>
		</div>
	</div>

	<div class="main-content" >

		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div id="course-content" class="entry-content">
			<?php the_field('downloads_will_learn'); ?>
			<div class="section-divider">
				<hr />
			</div>
			<?php if( edd_has_user_purchased($user_ID, $download_id) ):
				the_content();
			endif; ?>
		</div>

		<aside class="entry-sidebar" data-sticky-container>
			<div class="sticky" data-sticky data-anchor="course-content">
				<div class="download-details">

					<?php

					if( edd_has_user_purchased($user_ID, $download_id) ) {

						//Show download files
						$files = edd_get_download_files( get_the_ID() );
						if( $files ) { ?>
							<h4>Archivos disponibles</h4>
							<ul class="download-list-files">
							<?php
							foreach( $files as $filekey => $file ) { ?>
								<li class="download-file">
									<a href="<?php echo $file['file']; ?>">
										<i class="fa-cloud-download"></i> <?php echo $file['name']; ?>
									</a>
								</li>
								<?php
								// Name: $file['name']
								// URL or path: $file['file']
							} ?>
							</ul>
						<?php }

					} else {
						// Show pay link
						if(function_exists('edd_price')) { ?>
							<div class="product-buttons">
								<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
									<?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
								<?php } ?>

							</div><!--end .product-buttons-->
						<?php }
					}

					?>


				</div>
			</div>
		</aside>





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
