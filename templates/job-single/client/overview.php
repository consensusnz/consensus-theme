<?php
if (post_password_required()) {
  return;
}

$selected_lawyer = get_field('job_selected_lawyer');
$job_status = get_field( "job_status" );

if ( isset($_GET['new_relationship']) && ($_GET['new_relationship'] == 1) ) {
  echo '<div class="uk-alert-primary" uk-alert>Great job, that proposal was accepted. Your lawyer, '. $selected_lawyer['user_firstname']  .', has been notified and will get to work right away.</div>';
}
?>

<header class="uk-width-1-1">

</header>

<div class="overview uk-child-width-expand@s uk-grid-divider" uk-grid>

  <aside class="uk-width-1-4@m">
    <h2 class="uk-text-bold">Overview</h2>

    <?php if ($job_status['value'] == 'proposals') : ?>
      <span class="uk-label">Awaiting proposals</span>
      <p class="uk-text-small uk-margin-small-top">Your job is currently awaiting proposals from Consensus marketplace lawyers.</p>
    <?php endif; ?>

    <?php if ($job_status['value'] == 'progress') : ?>
      <span class="uk-label uk-label-success">In progress</span>
      <p class="uk-text-small uk-margin-small-top">Your job is in progress with your lawyer, Lawyer.</p>
    <?php endif; ?>

    <?php if ($job_status['value'] == 'check') : ?>
      <span class="uk-label uk-label-warning">Client check</span>
      <p class="uk-text-small uk-margin-small-top">Your lawyer, Lawyer, has provided the agreed legal services. Please review and mark the job as completed to receive payment instructions from Lawyer.</p>
    <?php endif; ?>

    <?php if ($job_status['value'] == 'pendingpayment') : ?>
      <span class="uk-label uk-label-warning">Payment pending</span>
      <p class="uk-text-small uk-margin-small-top">Your lawyer, Lawyer, has not yet confirmed reciept of payment.</p>
    <?php endif; ?>

    <?php if ($job_status['value'] == 'completed') : ?>
      <span class="uk-label">Completed</span>
      <p class="uk-text-small uk-margin-small-top">This job is completed and paid.</p>
    <?php endif; ?>

    <?php if ($job_status['value'] == 'removed') : ?>
      <span class="uk-label uk-label-danger">Removed</span>
      <p class="uk-text-small uk-margin-small-top">This job has been removed from the Marketplace.</p>
    <?php endif; ?>

    <hr>

    <h4 class="uk-text-bold uk-margin-small-top">Job Details</h4>
    <dl class="uk-description-list uk-description-list-divider">
      <dt>Location</dt>
      <dd>Lorem</dd>

      <dt>Legal Need</dt>
      <dd>
        <?php
          $terms = get_the_term_list( $post->ID, 'job_categories','',', ' );
          $terms = strip_tags( $terms );
          echo $terms;
        ?>
      </dd>

      <dt>Job Created</dt>
      <dd><?php the_date(); ?></dd>
    </dl>
    <hr>

    <div class="overview-lawyer">
      <h4 class="uk-text-bold">Your Lawyer</h5>
        <?php if ($selected_lawyer) : ?>
        <div class="uk-grid-medium uk-flex-middle" uk-grid>
          <div class="uk-width-auto">
            <img class="uk-border-circle uk-box-shadow-small" src="<?php echo esc_url( get_avatar_url( $selected_lawyer['ID'] ) ); ?>" width="80" height="80" alt="">
          </div>
          <div class="uk-width-expand">
            <p><?php echo $selected_lawyer['display_name'] ?></p>
          </div>
        </div>
        <?php else : ?>
          <p>Once you've picked a lawyer, their details will be available here.</p>
        <?php endif; ?>
    </div>

  </aside>

  <div class="uk-width-expand">
    <h4 class="uk-text-bold">Description</h4>
    <?php the_content(); ?>

    <h4 class="uk-text-bold">Completed Questionnaire</h4>
    <?php echo FrmProDisplaysController::get_shortcode( array( 'id' => 75) ) ?>
  </div>

</div>
