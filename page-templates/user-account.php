<?php
/*
Template Name: User Account
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<?php
wp_get_current_user();
if ($current_user->user_firstname) {
  $user_name = $current_user->user_firstname;
  if ($current_user->user_lastname) {
    $user_name .= ' '.$current_user->user_lastname;
  }
} else {
  $user_name = $current_user->display_name;
}
?>

<div id="user-account" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
      <header>
          <h1 class="entry-title"><?php the_title(); ?>
            <?php if ( is_user_logged_in () ) : ?><small>¡Hola, <?php echo $user_name; ?>!</small><?php endif; ?>
          </h1>
      </header>
      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
      <div class="entry-content">
          <?php the_content(); ?>
      </div>
      <footer>

      </footer>

  </article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
