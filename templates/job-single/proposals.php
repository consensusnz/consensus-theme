<?php

$denied = array(
    ''
);

consensusDenyAccess($denied);

if ( $job_selected_lawyer ) {
  echo '<div class="uk-alert-primary" uk-alert><p>It looks like you already have a lawyer.</p></div>';
  return;
}

else {

?>

<h2>Proposals</h2>
<?php
// check if the repeater field has rows of data
  if( have_rows('proposals') ): ?>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Row Index</th>
      <th scope="col"></th>
      <th scope="col">Lawyer Name</th>
      <th scope="col">Proposed Fee</th>
      <th scope="col">More Details</th>
      <th scope="col">Accept Proposal</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // loop through the rows of data
    while ( have_rows('proposals') ) : the_row();
    $lawyer = get_sub_field('bidding_lawyer');
    $fee = get_sub_field('proposed_fee');
  ?>
    <tr>
      <td><?php echo get_row_index(); ?></td>
      <td><?php echo $lawyer['user_avatar']; ?></td>
      <td><?php echo $lawyer['user_firstname'];?>  <?php echo $lawyer['user_lastname']; ?> (ID: <?php echo $lawyer['ID']; ?>)</td>
      <td>$<?php echo $fee; ?></td>
      <td><a class="uk-button uk-button-secondary" href="<?php echo the_permalink(); ?>/view_proposal?id=<?php echo get_row_index(); ?>" role="button">Details</a></td>
      <td><button type="button" class="uk-button uk-button-primary">Accept Proposal</button></td>
    </tr>
    <?php
  endwhile; ?>
</tbody>
</table>
<?php
  else : ?>
    <p>Consensus lawyers are reviewing your job. When a lawyer submits a proposal, it will appear here.</p>
<?php
  endif;
?>

<?php
 }
?>
