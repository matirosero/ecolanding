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

	//If user has purchased this, find payment ID
	if( edd_has_user_purchased($user_ID, $download_id) ) {

		//Use Log IDs to get Payments IDs

		// Instantiate a new instance of the class
		$edd_logging = new EDD_Logging;

		// get logs for this download with type of 'sale'
		$logs = $edd_logging->get_logs( $download_id, 'sale' );

		// if logs exist
		if ( $logs ) {
			// create array to store our log IDs into
			$log_ids = array();
			// add each log ID to the array
			foreach ( $logs as $log ) {
				$log_ids[] = $log->ID;
			}
			// return our array

			$payment_ids = array();

			foreach ( $log_ids as $log_id ) {
				// get the payment ID for each corresponding log ID
				// $payment_ids[] = get_post_meta( $log_id, '_edd_log_payment_id', true );
				$payment_id = get_post_meta( $log_id, '_edd_log_payment_id', true );

				$payment = new EDD_Payment($payment_id);

				//http://stackoverflow.com/questions/8102221/php-multidimensional-array-searching-find-key-by-specific-value
				if ( $payment->user_id == $user_ID) {
					// echo 'PAYMENT USER ID <strong>'.$payment->user_id.'</strong> matches USER ID <strong>'.$user_ID.'</strong><br /> Return PAYMENT ID <strong>'.$payment_id.'</strong><br />';
					$the_payment_ID = $payment_id;
				}
			}
		}
	}






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

			<?php if( edd_has_user_purchased($user_ID, $download_id) ): ?>
				<div class="section-divider">
					<hr />
				</div>
				<?php the_content();
			endif; ?>
		</div>

		<aside class="entry-sidebar" data-sticky-container>
			<div class="sticky" data-sticky data-anchor="course-content">
				<div class="download-details">

					<?php

					if( edd_has_user_purchased($user_ID, $download_id) ) {

						//Show download files
						$purchase_data  = edd_get_payment_meta( $the_payment_ID );
						// var_dump(get_payment_ids());
						$download_files = edd_get_download_files( get_the_ID(), $price_id );

						if( $download_files ) { ?>
							<h4>Descargas</h4>
							<ul class="download-list-files">
							<?php
							foreach( $download_files as $filekey => $file ) {

								//HOW TO GET PURCHASE_DATA AND PAYMENT ID???
								$download_url = edd_get_download_file_url( $purchase_data['key'], $email, $filekey, get_the_ID(), $price_id );
								?>

								<li class="download-file">
									<a href="<?php echo esc_url( $download_url ); ?>">
										<?php echo $file['name']; ?>
									</a>

								</li>
							<?php } ?>
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
