<!-- query jobs -->
<?php
//initial vars
$user = wp_get_current_user();

$legal_expertise = get_user_meta($user->ID, 'legal_expertise', true);
$legal_expertise_sanitised = '';
$legal_expertise_sanitised .= implode(', ', $legal_expertise).', ';

?>

<?php
  if ( $legal_expertise ):
?>

  <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
      'post_type' => 'job',
      'posts_per_page' => 2,
      'paged' => $paged,
      'orderby' => 'date',
      'tax_query' => array(
        array(
          'taxonomy' => 'job_categories',
          'terms' => $legal_expertise_sanitised,
          'operator'  => 'IN'
        ),
      ),
    );

    $job_query = new WP_Query($args);

    $total_posts = wp_count_posts('job');
    $count_posts = $total_posts->publish;
  ?>

  <?php if ( $job_query->have_posts() ) : ?>

    <div class="uk-grid-divider" uk-grid>
      <div class="uk-width-1-4@m">
        <p>We're showing you jobs based on your legal expertise. You've told us you're an expert in these areas:</p>
        <ul>
          <?php
            foreach ($legal_expertise as $legal_expert) {
              $category_name = get_term_by('id', $legal_expert, 'job_categories');
              echo '<li>';
              echo $category_name->name;
              echo '</li>';
            }
          ?>
        </ul>
        <a class="uk-width-1-1 uk-button uk-button-primary">Update Your Expertise</a>
        <div class="uk-divider"></div>
        <form>
          <fieldset class="uk-fieldset">

              <div class="uk-margin">
                  <label class="uk-form-label">Showing jobs from:</label>
                  <select class="uk-select">
                      <option>Auckland</option>
                      <option>Central North Island</option>
                  </select>
              </div>

          </fieldset>
      </form>
      </div>

      <div class="uk-width-expand@m">
        <p class="uk-text-lead">These jobs are waiting for great proposals from lawyers with your specific expertise.</p>
        <p class="uk-align-right uk-margin-remove-bottom">Showing  <?php echo $job_query->found_posts; ?> of <?php echo $count_posts ?> jobs in the marketplace</p>
        <table class="uk-table uk-table-divider uk-table-justify">
          <thead>
            <tr>
                <th>Job Details</th>
            </tr>
          </thead>
          <tbody>
            <!-- begin loop -->
            <?php while ( $job_query->have_posts() ) : $job_query->the_post(); ?>
              <tr>
                <td>
                  <p class="uk-margin-remove"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></p>
                  <p class="uk-margin-remove-bottom uk-margin-small-top uk-text-small">

                      <?php
                        $terms = get_the_term_list( $post->ID, 'job_categories','',', ' );
                        $terms = strip_tags( $terms );
                        echo $terms;
                      ?>

                  </p>
                  <p class="uk-margin-remove uk-text-meta">
                    [Location] <span class="uk-margin-small-right uk-margin-small-left">&middot;</span> Posted <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                  </p>
                </td>
                <td>
                </td>
                <td>
                  <a href="<?php echo the_permalink(); ?>" class="uk-width-1-1 uk-button uk-button-primary">View Job or Make Proposal</a>
                    <?php
                      if( have_rows('proposals') ):
                        $numproposals = count( get_field( 'proposals' ) );
                        if ($numproposals == 0) {
                          echo '<span class="uk-label uk-margin-small-top uk-align-right uk-label-warning">No proposals yet</span>';
                        } elseif ($numproposals == 1) {
                          echo '<span class="uk-label uk-margin-small-top uk-align-right uk-label-success">'.$numproposals.' proposal</span>';
                        } else {
                          echo '<span class="uk-label uk-margin-small-top uk-align-right uk-label-success">'.$numproposals.' proposals</span>';
                        }
                      else:
                        echo '<span class="uk-label uk-margin-small-top uk-align-right uk-label-warning">No proposals yet</span>';
                      endif;
                    ?>
                </td>
              </tr>
            <?php endwhile; ?>
            <!-- end loop -->
          </tbody>
        </table>

        <ul class="uk-pagination uk-flex-center" uk-margin>
            <?php
                $links = paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $job_query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'array',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => false,
                    'prev_text'    => sprintf( '<span uk-pagination-previous></span>', '' ),
                    'next_text'    => sprintf( '<span uk-pagination-next></span>', '' ),
                    'add_args'     => false,
                    'add_fragment' => ''
                ) );

                foreach ($links as $link) {
                  echo '<li>'.$link.'</li>';
                }
            ?>
        </ul>

    <?php wp_reset_postdata(); ?>

  <?php else : ?>
      <div class="uk-alert-primary" uk-alert><?php _e( 'Sorry, there aren\'t any jobs matching your legal expertise currently waiting for proposals. We\'ll email you when we find a job suited to you.' ); ?></div>
  <?php endif; ?>

<?php else : ?>
    <p><?php _e( 'Sorry, you don\'t have any expertise set.' ); ?></p>
<?php endif; ?>
