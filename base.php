<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
if ( is_page( array('dashboard','find-jobs') ) && !is_user_logged_in() ) {
  auth_redirect();
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?> >

    <div class="uk-offcanvas-content uk-background-muted" uk-height-viewport="expand: true">
      <!--[if IE]>
        <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
          <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
        </div>
      <![endif]-->
      <?php
        do_action('get_header');
        if (!is_page('login')) {
          get_template_part('templates/header');
        }
      ?>

      <?php include Wrapper\template_path(); ?>

      <?php
        do_action('get_footer');
        if (!is_page('login')) {
          get_template_part('templates/footer');
        }
        wp_footer();
      ?>
    </div>
  </body>
  <?php if(isset($_GET['logged_in']) && is_user_logged_in() ) : ?>
    <script> UIkit.notification('Welcome back, <?php echo wp_get_current_user()->user_firstname; ?>. It\'s good to see you.', { status: 'primary' }); </script>
  <?php endif; ?>
</html>
