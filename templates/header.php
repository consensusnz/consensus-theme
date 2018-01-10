<?php function consensusAccountNavigation() { $current_user = wp_get_current_user(); ?>
  <li class="uk-nav-header">Kia ora, <?php echo $current_user->user_firstname; ?></li>
  <li><a href="/dashboard">Dashboard</a></li>
  <li class="uk-margin-left"><a href="/dashboard/jobs">Jobs</a></li>
  <li class="uk-margin-left"><a href="/dashboard/documents">Documents</a></li>
  <li class="uk-margin-left"><a href="/dashboard/documents">Messages</a></li>
  <li class="uk-nav-divider"></li>
  <li><a href="#">Edit Profile</a></li>
  <li><a href="#">Manage Account</a></li>
  <li class="uk-nav-divider"></li>
  <li><a href="<?php echo wp_logout_url('/account/login?logged_out=1'); ?>">Logout</a></li>
<?php } ?>

<?php function consensusMainNavigation () { $current_user = wp_get_current_user(); ?>

  <li class="<?php echo (is_front_page()) ? 'uk-active ' : ''; ?>"><a href="<?php echo home_url(); ?>">Home</a></li>
  <?php if ( current_user_can('lawyer') ) : ?>
    <li class="<?php echo (is_page( 'jobs/new-job' )) ? 'uk-active ' : ''; ?>"><a href="/jobs/find-jobs">Search For Jobs</a></li>
  <?php else : ?>
    <li class="<?php echo (is_page( 'jobs/new-job' )) ? 'uk-active ' : ''; ?>"><a href="/jobs/new-job">Post a Job</a></li>
  <?php endif; if ( is_user_logged_in() ) { ?>
    <li class="<?php echo (is_page( 'help' )) ? 'uk-active ' : ''; ?>"><a href="/help" title="Help">Help</a></li>
    <li class="uk-visible@m no-indicator"><a href="#"><img class="uk-border-circle" width="52" src="<?php echo esc_url( get_avatar_url( $current_user->ID ) ); ?>" /></a></li>
    <div class="uk-dark" uk-dropdown="mode: click; animation: uk-animation-slide-top-small;">
      <ul class="uk-nav uk-dropdown-nav uk-nav-default">
        <?php echo consensusAccountNavigation(); ?>
      </ul>
    </div>

  <?php } else { ?>
    <li class="<?php echo (is_page( 'how-it-works' )) ? 'uk-active ' : ''; ?>"><a href="/how-it-works">How It Works</a></li>
    <li class="<?php echo (is_page( 'lawyers' )) ? 'uk-active ' : ''; ?>"><a href="/lawyers">I'm a Lawyer</a></li>
    <li class="uk-visible@m uk-hidden@l"><a href="/login" title="Sign In" rel="home">Sign In</a></li>
  <?php } ?>

<?php } //end consensusMainNavigation()?>

<header>
  <?php if ( current_user_can('manage_options') ) : ?>
    <div class="uk-alert-primary uk-margin-remove-bottom uk-text-center" uk-alert>
      <p>You are logged in as an <strong><a href="/wp/wp-admin">administrator</a></strong>. Please be careful!</p>
    </div>
  <?php endif; ?>
  <nav id="#mainNav" class="navbar-global uk-navbar-container uk-light <?php echo (!is_front_page()) ? 'uk-box-shadow-large ' : ''; echo (is_front_page()) ? 'uk-navbar-transparent' : ''; ?>" uk-navbar>
    <div class="uk-navbar-left uk-margin-large-left">
      <a href="<?= esc_url(home_url('/')); ?>" class="uk-navbar-item uk-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" width="250" height="100" alt="">
      </a>
    </div>
    <div class="uk-navbar-right uk-margin-large-right">
      <ul class="uk-navbar-nav uk-visible@m <?php echo (is_front_page()) ? '' : ''; ?>">
        <?php echo consensusMainNavigation(); ?>
      </ul>
      <?php if ( !is_user_logged_in() ) : ?>
      <div class="uk-navbar-item uk-visible@l">
        <a class="uk-button uk-button-secondary" href="/login" title="Sign In" rel="home">Sign In</a>
      </div>
      <?php endif;?>
      <!-- This is a button toggling the off-canvas -->
      <span class="uk-hidden@m" uk-navbar-toggle-icon uk-toggle="target: #mainNavOffCanvas"></span>


      <!-- This is an anchor toggling the off-canvas -->
      <a href="#mainNavOffCanvas" uk-toggle></a>

    <!-- Main navigation offcanvas -->
    <div id="mainNavOffCanvas" uk-offcanvas>
      <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default">
          <?php echo consensusMainNavigation(); ?>
          <?php
            if ( is_user_logged_in() ) {
              echo consensusAccountNavigation();
            } else {
              echo '<li class="uk-nav-divider"></li>';
              echo '<li><a href="/login" title="Sign In" rel="home">Sign In</a></li>';
            }
          ?>
        </ul>
        <button class="uk-offcanvas-close" type="button" uk-close></button>

      </div>
    </div>
    </div>
  </nav>
</header>
