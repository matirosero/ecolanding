<?php
/*
Template Name: Front
*/
get_header(); ?>

	<header id="front-hero" role="banner">
		<div class="marketing">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-eco-home.svg" alt="ECO Acompañamiento Empresarial" />
				</a>
			</div>
			<div class="tagline">
				<h1><span class="small-break">Tu vida. </span><span class="small-break">Tu negocio. </span><span class="small-break">Tu éxito.</span></h1>
				<p class="subheader">Recibe de forma gratuita información valiosa sobre productividad, mercadeo, estrategia, emprendedurismo, vida integral, y más.</p>
				<?php
					if( function_exists( 'mc4wp_show_form' ) ) {
					    mc4wp_show_form();
					}
				?>
			</div>
		</div>

	</header><!-- .front-hero -->

	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<section class="intro" role="main">
			<div class="intro-container">
				<div class="fp-intro">

					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<footer>
							<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
							<p><?php the_tags(); ?></p>
						</footer>
						<?php do_action( 'foundationpress_page_before_comments' ); ?>
						<?php comments_template(); ?>
						<?php do_action( 'foundationpress_page_after_comments' ); ?>

					</div>

				</div>
			</div>

		</section><!-- .intro -->

	<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>

<!-- <div class="section-divider">
	<hr />
</div> -->


	<section class="fp-courses">
		<header>
			<h2>Cursos &amp; Ebooks</h2>
			<p>En ECO queremos ayudarte a alcanzar todas tus metas a través de nuestros cursos, artículos y nuestros servicios personalizados uno a uno, presenciales o en línea. </p>
		</header>


		<?php
		$current_page = get_query_var('page');
		$per_page = get_option('posts_per_page');
		$offset = $current_page > 0 ? $per_page * ($current_page-1) : 0;
		$product_args = array(
			'post_type' => 'download',
			'posts_per_page' => 1,//$per_page,
			'offset' => $offset,
			'order' => ASC
		);
		$products = new WP_Query($product_args);
		?>

		<?php if ($products->have_posts()) : $i = 1; ?>

			<div class="row">
				<div class="small-11 small-centered medium-9 medium-centered large-7 columns">

			<!-- <ul class="course-grid row small-up-1 large-up-2"> -->
			<ul class="course-grid row small-up-1">

				<?php while ($products->have_posts()) : $products->the_post(); ?>
					<li class="course column">
						<div class="course-container">

							<header class="course-header" style="background-image: url(<?php the_post_thumbnail_url( 'product-image' ); ?>);">
								<div class="hero-header-container">
									<?php //the_post_thumbnail('product-image'); ?>
									<h3 class="course-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?>
										<small><?php the_field('downloads_subtitle'); ?></small></a>
									</h3>

									<div class="product-price-buttons">
										<?php if(function_exists('edd_price')) { ?>
											<div class="product-price">
												<?php
													if(edd_has_variable_prices(get_the_ID())) {
														// if the download has variable prices, show the first one as a starting price
														echo 'Starting at: '; edd_price(get_the_ID());
													} else {
														echo 'Inversión: '; edd_price(get_the_ID());
													}
												?>
											</div><!--end .product-price-->
										<?php } ?>

										<?php if(function_exists('edd_price')) { ?>
											<div class="product-buttons">
												<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
													<?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
												<?php } ?>

											</div><!--end .product-buttons-->
										<?php } ?>
									</div><!--end .product-price-buttons-->
								</div>
							</header>

							<p class="course-intro"><?php the_field('downloads_intro'); ?></p>

							<div class="course-public-info">
								<?php the_field('downloads_public'); ?>
							</div>

							<footer class="course-footer">
								<?php if(function_exists('edd_price')) { ?>
									<div class="product-price">
										<?php
											if(edd_has_variable_prices(get_the_ID())) {
												// if the download has variable prices, show the first one as a starting price
												echo 'Starting at: '; edd_price(get_the_ID());
											} else {
												echo 'Inversión: '; edd_price(get_the_ID());
											}
										?>
									</div><!--end .product-price-->
								<?php } ?>

								<?php if(function_exists('edd_price')) { ?>
									<div class="product-buttons">
										<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
											<?php echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
										<?php } ?>

									</div><!--end .product-buttons-->
								<?php } ?>
							</footer>
						</div><!-- .course-container -->
					</li><!--end .course-->
					<?php $i+=1; ?>
				<?php endwhile; ?>

			</ul>

		</div></div>

		<?php else : ?>

			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</section><!-- .fp-courses -->

	<div class="section-divider">
		<hr />
	</div>

	<section class="contact" role="secondary">
		<div class="contact-container">
			<div class="contact-form">
				<header>
					<h2>Contáctanos</h2>
					<p>Escríbenos a <a ref="mailto:"></a> o llena este formulario y nos pondremos en contacto en cuanto sea posible. </p>
				</header>
				<?php echo do_shortcode( '[contact-form-7 id="89" title="Contáctanos"]' ); ?>
			</div>

		</div>
	</section><!-- .contact -->

<?php get_footer();
