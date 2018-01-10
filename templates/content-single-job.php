<?php
while (have_posts()) : the_post();

  $current_user = wp_get_current_user();
  $current_user_id = $current_user->ID;
  $current_user_role = $current_user->roles ? $current_user->roles[0] : false;

  $job_status = get_field( "job_status" );
  $job_selected_lawyer = get_field('job_selected_lawyer');

  $job_lawyers_completed_conflict_checks = get_field('lawyers_completed_conflict_checks');

  $current_user_completed_conflict_checks = FALSE;

  if ( in_array($current_user_id, array_column($job_lawyers_completed_conflict_checks, 'ID')) ) {
    $current_user_completed_conflict_checks = TRUE;
  } elseif ( !in_array($current_user_id, array_column($job_lawyers_completed_conflict_checks, 'ID')) ) {
    $current_user_completed_conflict_checks = FALSE;
  }

  $job_selected_lawyer ? $job_selected_lawyer_id = $job_selected_lawyer['ID'] : $job_selected_lawyer_id = NULL; //if the job has a selected lawyer, add their ID to a variable

  $current_page = @$wp_query->query_vars['custom_post_type_sub_page']; //we are suppressing error messages here with @

  $denied = array( //Not permitted to view the content when consensusDenyAccess is called.
    '',
  );

  $accepted = array( //Permitted to view the content when consensusDenyAccess is called.
    $post->post_author, //the author of the post is permitted
    $job_selected_lawyer_id //the ID of the selected lawyer is permitted
  );

  if ( $job_status['value'] == 'proposals' && $current_user_role == 'lawyer' ) { //
    $accepted[] = $current_user->ID; //They aren't so add the current user ID to the denied ID.
  } elseif ( !in_array($current_user->ID, $accepted) ) {
    $denied[] = $current_user->ID;
  }

  consensusDenyAccess ($denied);
?>

<?php function consensusJobNavigation($post, $current_page, $current_user_role, $job_selected_lawyer) { //we are suppressing error messages here with @ //we are suppressing error messages here with @ ?>
  <li class="<?php echo $current_page == '' ? 'uk-active' : ''?>">
    <a class="" href="<?php echo get_permalink( $post->ID); ?>"><i class="glyphicon glyphicon-th-large"></i>Overview</a>
  </li>
  <?php if ($current_user_role == 'lawyer' or $current_user_role == 'administrator') : ?>
    <?php if ($job_selected_lawyer) : //is there a selected lawyer ?>
      <li class="<?php echo ($current_page == 'proposals') || $current_page == 'view_proposal' ? 'uk-active' : ''?>">
        <a href="<?php echo get_permalink( $post->ID); ?>/proposals" role="tab">Proposals</a>
      </li>
      <li class="<?php echo $current_page == 'messages' ? 'uk-active' : ''?>">
        <a href="<?php echo get_permalink( $post->ID); ?>/messages" role="tab">Messages</a>
      </li>
      <li class="<?php echo $current_page == 'documents' ? 'uk-active' : ''?>">
        <a href="<?php echo get_permalink( $post->ID); ?>/documents" role="tab">Documents</a>
      </li>
    <?php else : ?>
      <li class="<?php echo $current_page == 'bid' ? 'uk-active' : ''?>">
        <a class="" href="<?php echo get_permalink( $post->ID); ?>/bid" role="tab">Make A Proposal</a>
      </li>
    <?php endif; ?>
  <?php endif; ?>
  <?php if ($current_user_role == 'client' or $current_user_role == 'administrator') : ?>
    <?php if (!$job_selected_lawyer) : //is there a selected lawyer ?>
      <li class="<?php echo ($current_page == 'proposals') || $current_page == 'view_proposal' ? 'uk-active' : ''?>">
        <a href="<?php echo get_permalink( $post->ID); ?>/proposals" role="tab">Proposals</a>
      </li>
    <?php endif; ?>
    <li class="<?php echo $current_page == 'messages' ? 'uk-active' : ''?>">
      <a href="<?php echo get_permalink( $post->ID); ?>/messages" role="tab">Messages</a>
    </li>
    <li class="<?php echo $current_page == 'documents' ? 'uk-active' : ''?>">
      <a href="<?php echo get_permalink( $post->ID); ?>/documents" role="tab">Documents</a>
    </li>
  <?php endif; ?>
  <?php if ($current_user_role == 'administrator') : ?>
    <li class="">
      <a href="<?php echo get_edit_post_link(); ?>/documents" role="tab">Edit this job in admin panel</a>
    </li>
  <?php endif; ?>
<?php } //end consensusJobNavigation() ?>
<article id="job">

  <div class="uk-width-1-1@m uk-background-primary">
    <div class="uk-container uk-padding uk-light uk-text-center">
      <div class="uk-flex-middle" style="" uk-grid>
        <div class="uk-width-1-2@s uk-text-left@s">
          <h1 class="uk-text-bold uk-margin-remove"><?php the_title(); ?></h1>
          <p class="uk-margin-small-top"><?php echo $job_status ? $job_status['label'] : 'No status.' ?></p>
        </div>
        <div class="uk-width-1-2@s uk-text-right uk-visible@s">
          <a href="#" class="uk-button uk-button-default">Manage job</a>
        </div>
        <div class="uk-width-1-1 uk-hidden@s">
          <a href="#" class="uk-button uk-button-small uk-width-1-1 uk-button-default">Manage job</a>
        </div>
      </div>
    </div>
  </div>

  <div class="uk-width-1-1@m">
    <div class="uk-section uk-box-shadow-medium uk-section-xsmall uk-section-default uk-margin-medium-bottom">
      <div class="uk-container">
        <ul class="uk-subnav" uk-margin>
          <?php echo consensusJobNavigation($post, $current_page, $current_user_role, $job_selected_lawyer); ?>
        </ul>
      </div>
    </div>
  </div>

  <?php if ($current_user_role == 'client' or $current_user_role == 'administrator') : ?>
  <div class="uk-container uk-border-rounded uk-box-shadow-large uk-margin-medium-bottom uk-background-default client">
    <section class="uk-section uk-padding uk-padding-remove-left uk-padding-remove-left" id="content">
      <?php
        if ($current_user_role == 'administrator') { echo '<div class="uk-alert-warning" uk-alert><p><b>[Admin]</b> Client View</p></div>'; }
        switch ($current_page) :
          case 'bid':
            include(locate_template('templates/job-single/bid.php'));
          break;
          case 'view_proposal':
            include(locate_template('templates/job-single/view-proposal.php'));
          break;
          case 'proposals':
            include(locate_template('templates/job-single/proposals.php'));
          break;
          case 'messages':
            comments_template('/templates/job-single/messages.php');
          break;
          case 'documents':
            include(locate_template('templates/job-single/documents.php'));
          break;
          default:
            include(locate_template('templates/job-single/client/overview.php'));
        endswitch;
      ?>
    </section>
  </div>
  <?php endif; ?>

  <?php if ($current_user_role == 'lawyer' && $current_user_completed_conflict_checks or $current_user_role == 'administrator') : ?>
    <div class="uk-container uk-border-rounded uk-box-shadow-large uk-margin-medium-bottom uk-background-default">
      <section class="uk-section uk-padding uk-padding-remove-left uk-padding-remove-left" id="content">
        <?php
          if ($current_user_role == 'administrator') { echo '<div class="uk-alert-warning" uk-alert><p><b>[Admin]</b> Conflict-Free Lawyer View</p></div>'; }
          switch ($current_page) {
            case 'bid':
              include(locate_template('templates/job-single/bid.php'));
            break;
            case 'view_proposal':
              include(locate_template('templates/job-single/view-proposal.php'));
            break;
            case 'proposals':
              include(locate_template('templates/job-single/proposals.php'));
            break;
            case 'messages':
              comments_template('/templates/job-single/messages.php');
            break;
            case 'documents':
              include(locate_template('templates/job-single/documents.php'));
            break;
            default:
              include(locate_template('templates/job-single/lawyer/overview.php'));
          }
        ?>
      </section>
    </div>
  <?php endif; ?>

  <?php if ($current_user_role == 'lawyer' && !$current_user_completed_conflict_checks or $current_user_role == 'administrator') : ?>
    <div class="uk-container uk-border-rounded uk-box-shadow-large uk-margin-medium-bottom uk-background-default">
      <section class="uk-section uk-padding uk-padding-remove-left uk-padding-remove-left" id="content">
        <?php
          if ($current_user_role == 'administrator') { echo '<div class="uk-alert-warning" uk-alert><p><b>[Admin]</b> Not Yet Conflict-Checked Lawyer View</p></div>'; }
        ?>
        <h2 class="uk-text-bold">Please perform a conflict check</h2>
        <p>As per our terms and conditions, we require all lawyers to complete a conflict of interest check before details of Marketplace jobs are released and before you can submit a proposal for a job. Checking conflicts is an ongoing duty and conflicts may arise at any time during the course of a Marketplace transaction.</p>
        <?php
          include(locate_template('templates/job-single/lawyer/conflict-checker.php'));
        ?>
      </section>
    </div>
  <?php endif; ?>

  <footer>
  </footer>
</article>

<?php endwhile; ?>
