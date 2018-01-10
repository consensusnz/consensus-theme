<?php
$denied = array(
    ''
);

consensusDenyAccess ($denied);

if ( $job_selected_lawyer ) {
  echo 'It looks to us like you already have a lawyer.';
  return;
}

if ( isset($_GET['id']) && is_numeric($_GET['id']) ) { // is there a URL parameter called ID and is it a number?
  $proposal_id = $_GET['id'];
  $proposal_id = $proposal_id - 1;
}

if ( !isset($proposal_id) ) {
  echo 'Sorry, it doesn\'t look like you\'ve provided us with a valid proposal ID.';
  return;
}

else {
  // check if the repeater field has rows of data
  $proposals = get_field('proposals'); // get all the rows

  if (! isset($proposals[$proposal_id]) ) { //does the row not exist
    echo '<p>Sorry, we couldn\'t find that proposal.</p>';
  }

  else {
    $proposal = $proposals[$proposal_id]; // get the row by index passed in the url
    $lawyer = $proposal['bidding_lawyer']; // get the sub field value
    $details = $proposal['proposal_details']; // get the sub field value
    $fee = $proposal['proposed_fee']; // get the sub field value
?>

  <a class="uk-button uk-button-secondary" href="<?php echo the_permalink(); ?>/proposals" role="button">Back to Proposals</a>

  <h2>Proposal from <?php echo $lawyer['user_firstname']; ?> <?php echo $lawyer['user_lastname']; ?></h2>
  <hr>
  <div class="content row">

    <div class="col-sm-3">
      <h5>About <?php echo $lawyer['user_firstname']; ?></h5>
      <ul>
        <li>
          <span><?php echo $lawyer['user_avatar']; ?></span>
        </li>
        <li>
          <span>Location: </span><span>XXXX</span>
        </li>
        <li>
          <span>Legal Expertise: </span><span>XXXX</span>
        </li>
        <li>
          <span>Rating: </span><span>XXXX</span>
        </li>
      </ul>
    </div>

    <div class="col-sm-9">
      <h5>They said</h5>
      <p><?php echo $details; ?></p>

      <h5>They're offering</h5>
      <p>$<?php echo $fee; ?></p>

      <button type="button" class="uk-button uk-button-primary" uk-toggle="target: #acceptCurrentProposal">
        Accept
      </button>

      <div id="acceptCurrentProposal" uk-modal>
        <div class="uk-modal-dialog" role="document">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="">
            <div class="uk-modal-header">
              <h5 class="uk-modal-title" id="acceptCurrentProposalLabel">Confirm proposal acceptance</h5>
            </div>
            <div class="uk-modal-body">
              Do you want to accept <?php echo $lawyer['user_firstname']; ?>'s proposal? By clicking accept, you are entering into a legal relationship with <?php echo $lawyer['user_firstname']; ?>.
            </div>
            <div class="uk-modal-footer">
              <button type="button" class="uk-button uk-button-secondary" data-dismiss="modal">Go back</button>
              <input type="hidden" id="postID" value="<?php echo the_ID(); ?>"/>
              <input type="hidden" id="postPermalink" value="<?php echo the_permalink(); ?>"/>
              <input type="hidden" id="lawyerUserID" value="<?php echo $lawyer['ID']; ?>"/>
              <input type="hidden" id="proposalIndexNumber" value="<?php echo get_row_index(); ?>"/>
              <a class="uk-button uk-button-primary" href="#" onclick="acceptProposal(this)" id="accept" role="button">Confirm acceptance</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<?php
  } //if row does exist
} //if allowed to view the page
?>
