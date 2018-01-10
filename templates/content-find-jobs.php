<?php while (have_posts()) : the_post(); ?>
  <div class="" uk-grid>
    <div class="uk-width-1-1@m uk-background-primary uk-light">
      <div class="uk-container uk-text-center">
        <h1 class="uk-padding uk-text-bold">Job Marketplace</h1>
      </div>
    </div>
    <div class="uk-width-1-1@m">
      <div class="uk-container">
        <?php
          //Check the user meta
          $user = wp_get_current_user();
    	    $user_role = $user->roles ? $user->roles[0] : false;

          if ($user_role == 'lawyer') {
            get_template_part('templates/find-jobs/job-list');
          }

          elseif ($user_role == 'administrator') {
            get_template_part('templates/find-jobs/job-list');
          }

          else {
            echo '<div class="uk-alert-danger" uk-alert><h4 class="uk-margin-bottom">We\'re sorry, but only registered lawyers can access the Job Marketplace.</h4> If you are a lawyer, please <a href="'.wp_logout_url('/account/login?logged_out=1').'">logout</a> and log back in with your lawyer account.</div>';
          }
        ?>

      </div>
    </div>
  </div>
 <?php endwhile; ?>
