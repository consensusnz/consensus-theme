<?php
$user = wp_get_current_user();
$current_user_role = $user->roles ? $user->roles[0] : false;
$current_user_id = $user->ID;
$denied = array(
    'client'
);

if (in_array ($current_user_role, $denied) ) {
  return;
}

else {

  ?>

  <header class="uk-width-1-1">
    <h2 class="uk-heading-line uk-text-bold"><span>Make a proposal</span></h2>
  </header>
  
  <?php
  // check if the repeater field has rows of data
    if( have_rows('proposals') ):
      // loop through the rows of data
      while ( have_rows('proposals') ) : the_row();

      $currentUserID = get_current_user_id();
      $allowedUser = get_sub_field('bidding_lawyer');

      if($current_user_id == $allowedUser['ID']){ ?>
        <p>You have submitted the following proposal:</p>
        <p>Details: <?php echo the_sub_field('proposal_details'); ?></p>
      <?php
      }

    endwhile;

    else : ?>
      <p>It doesn't look like you've submitted a proposal yet.</p>
      <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 10, 'title' => false, 'description' => false ) ); ?>
  <?php
    endif;
  ?>


<?php
  }
?>
