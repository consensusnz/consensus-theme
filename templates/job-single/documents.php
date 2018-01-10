<?php
if (post_password_required()) {
  return;
}
?>

<h2>Documents</h2>

<p>All documents shared between you and your lawyer are stored here. You can share documents here, or attach them to a message.</p>

<?php

$args = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => 'any',
    'post_parent' => $post->ID
    );
$attachments = get_posts($args);
//var_dump ($attachments);
if ($attachments) {
    echo '<ul class="document-list">';
    foreach ($attachments as $attachment) {
      setup_postdata($attachment); ?>
      <li class="document-item"><a href="<?php echo wp_get_attachment_url($attachment->ID); ?>"><p><?php the_title(); ?></p></a>
    <?php
    }
    echo '</ul>';
} else {
  echo '<div class="uk-alert-primary" uk-alert><p>No documents have been shared yet.</p></div>';
}

?>
