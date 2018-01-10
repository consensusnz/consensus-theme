<?php
  if(isset($_GET['action']) && ( $_GET['action'] == 'new_job') ) {
    $redirect = home_url() . '/jobs/new-job?logged_in=1';
  } else {
    $redirect = home_url() . '/dashboard?logged_in=1';
  }
?>
<section id="login" class="uk-animation-fade">
  <div class="uk-container">
    <div>
      <div class="logo">
        <a href="<?= esc_url(home_url('/')); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" width="250" height="50" alt="">
        </a>
      </div>
      <div class="uk-text-center uk-child-width-1-2@m uk-flex-center" uk-grid>
        <div class="">
          <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">

          <?php if(isset($_GET['logged_out'])) : ?>
            <div class="uk-alert-primary" uk-alert>
              <p>You've been logged out.</p>
            </div>
            <h2 class="uk-card-title">Log back in.</h2>
            <?php echo do_shortcode('[frm-login show_lost_password="1" redirect="'.$redirect.'"]'); ?>
            <h6 class="uk-heading-line uk-text-center uk-margin-remove-top uk-margin-medium-bottom"><span>or</span></h6>
            <?php do_action('facebook_login_button');?>

          <?php elseif ( is_user_logged_in() ) : ?>
            <p>Looks like you're already logged in.</p>
            <p>Do you want to <?php echo do_shortcode('[frm-login show_lost_password="1" redirect="'.$redirect.'"]'); ?>?</p>

          <?php else : ?>
            <h2 class="uk-card-title">Welcome back.</h2>
            <?php echo do_shortcode('[frm-login show_lost_password="1" redirect="'.$redirect.'"]'); ?>
            <h6 class="uk-heading-line uk-text-center uk-margin-remove-top uk-margin-medium-bottom"><span>or</span></h6>
            <?php do_action('facebook_login_button');?>
          <?php endif; ?>

          </div>
          <div class="uk-card uk-card-primary uk-card-body">
            <a class="text-center" href="/register">Don't have an account? <u>Sign up</u></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
