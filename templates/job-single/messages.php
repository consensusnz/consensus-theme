<?php
if (post_password_required()) {
  return;
}
$consensus_discussion = new ConsensusDiscussion();
$selected_lawyer = get_field("job_selected_lawyer");
?>

<section id="discussion" class="discussion">
  <h2>Messages</h2>

  <?php if ( $selected_lawyer ) { ?>

    <div class="row">
      <div class="col-sm-4">
          <?php
          $comments_args = array(
              // change the title of send button
              'label_submit'=>'Send',
              // change the title of the reply section
              'title_reply'=>'',
              // remove "Text or HTML to be displayed after the set of comment fields"
              'comment_notes_after' => '',
              // logged in as remove
              'logged_in_as' => '',
              // redefine your own textarea (the comment body)
              'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
            );

            comment_form($comments_args);
          ?>
      </div>
      <div class="col-sm-8">
        <div id="respond"></div>
        <?php if ( have_comments() ) { ?>
          <ol class="comment-list">
            <?php wp_list_comments( ['callback' => array($consensus_discussion, 'job_discussion_view')] ); ?>
          </ol>

          <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav>
              <ul class="pager">
                <?php if (get_previous_comments_link()) : ?>
                  <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
                <?php endif; ?>
                <?php if (get_next_comments_link()) : ?>
                  <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
                <?php endif; ?>
              </ul>
            </nav>
          <?php endif; // have_comments() ?>

        <?php } elseif ( !have_comments() ) { ?>
          <p>No messages.</p>
        <?php } ?>
      </div>
    </div>

  <?php } elseif ( !$selected_lawyer ) { ?>
    <p>Once you've picked a lawyer, you'll be able to chat with them and send documents.<p>
  <?php } ?>
</section>
