<?php $current_user = wp_get_current_user(); ?>
<?php function consensusDashboardNavigation() { $current_user = wp_get_current_user(); ?>
  <li><?php echo $current_user->display_name; ?> (<?php echo $current_user->ID; ?>)</li>
  <?php if ( current_user_can('lawyer') ) : ?><li class="uk-text-small uk-margin-small-bottom">Example Firm</li><?php endif; ?>
  <li class="uk-text-small uk-margin-bottom"><?php echo $current_user->user_email; ?></li>
  <li class="uk-active"><a href=""><span class="uk-margin-small-right" uk-icon="icon: home"></span><span class="uk-visible@m">Dashboard</span></a></li>
  <li><a href=""><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span><span class="uk-visible@m">Jobs</span></a></li>
  <li><a href=""><span class="uk-margin-small-right" uk-icon="icon: folder"></span><span class="uk-visible@m">Documents</span></a></li>
  <li><a href=""><span class="uk-margin-small-right" uk-icon="icon: mail"></span><span class="uk-visible@m">Messages</span></a></li>
  <li><a href=""><span class="uk-margin-small-right" uk-icon="icon: user"></span><span class="uk-visible@m">Profile</span></a></li>
<?php } //end consensusDashboardNavigation() ?>

<div class="" uk-grid>
  <div class="uk-width-1-1@m uk-background-primary uk-light">
    <div class="uk-container uk-text-center">
      <h1 class="uk-padding uk-text-bold">Your Dashboard</h1>
    </div>
  </div>
  <div class="uk-width-1-1@m">
    <div class="uk-container uk-offcanvas-content" role="document">

      <div class="uk-child-width-expand@s uk-grid-divider" uk-grid>

        <div class="panel-nav uk-visible@m uk-width-1-5">
          <ul class="uk-nav">
            <?php echo consensusDashboardNavigation(); ?>
          </ul>
        </div>

        <div class="uk-width-expand">
          <?php while (have_posts()) : the_post(); ?>

            <div class="dashboard-cards">
              <div class="uk-child-width-expand@s" uk-grid>

                <div class="uk-width-1-1">
                  <div class="uk-card uk-card-secondary uk-card-body uk-text-center">
                    <div>
                      <h2>Welcome to Consensus</h2>
                      <?php if ( current_user_can('lawyer') ) : ?>
                        <p>Consensus is the easiest way to find legal work across a variety of areas from clients around the country.</p>
                        <a href="/jobs/find-jobs" class="uk-button uk-button-secondary">Search for Jobs</a>
                      <?php else : ?>
                        <p>Consensus is the easiest way to get cost-effective and high quality legal services from lawyers around the country.</p>
                        <a href="/jobs/new-job" class="uk-button uk-button-secondary">Post a Job</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="uk-width-1-1">
                  <div class="uk-card uk-card-default uk-card-body">
                    <h3 class="uk-heading-line"><span>Your active jobs</span></h3>
                    <div>

                      <?php
                      // set up or arguments for our custom query
                      $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                      $query_args = array(
                        'post_type' => 'job',
                        'posts_per_page' => 1,
                        'paged' => $paged,
                        'author' => $current_user->ID,
                      );
                      // create a new instance of WP_Query
                      $the_query = new WP_Query( $query_args );
                      ?>

                      <?php if ( $the_query->have_posts() ) : ?>

                        <table class="uk-table">
                          <thead class="thead-inverse">
                            <tr>
                              <th>Job</th>
                              <th>Latest activity</th>
                              <th>Your lawyer</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                            $status = get_field( "job_status" );
                            $selected_lawyer = get_field( "job_selected_lawyer" );
                            ?>

                            <tr>
                              <td><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></td>
                              <td><?php echo $status ? $status['label'] : 'No status.' ?></td>
                              <td><?php echo $selected_lawyer ? $selected_lawyer['user_nicename'] : 'No lawyer yet.' ?></td>
                            </tr>

                          <?php endwhile; ?>
                        </tbody>
                      </table>
                      <?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                        <nav class="prev-next-posts">
                          <div class="prev-posts-link">
                            <?php echo get_next_posts_link( 'Older Jobs', $the_query->max_num_pages ); // display older posts link ?>
                          </div>
                          <div class="next-posts-link">
                            <?php echo get_previous_posts_link( 'Newer Jobs' ); // display newer posts link ?>
                          </div>
                        </nav>
                      <?php } ?>

                    <?php else: ?>
                      <p><?php _e("You have no open jobs."); ?></p>
                    <?php endif; ?>

                  </div>
                </div>
              </div>

              <div class="uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body">
                  <h3 class="uk-heading-line"><span>Recent messages</span></h3>
                  <div>
                    <p>With supporting text below as a natural lead-in to additional content.</p>
                    <a href="/jobs/new-job" class="btn btn-primary">View all messages</a>
                  </div>
                </div>
              </div>

              <div class="uk-width-1-2">
                <div class="uk-card uk-card-default uk-card-body">
                  <h3 class="uk-heading-line"><span>Recent documents</span></h3>
                  <div>
                    <p>With supporting text below as a natural lead-in to additional content.</p>
                    <a href="/jobs/new-job" class="btn btn-primary">View all messages</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php endwhile; ?>

        </div><!-- /.uk-width-expand -->

      </div><!-- /uk-grid -->
    </div><!-- /.uk-container -->
  </div><!-- /.uk-width-1-1@m -->
</div><!-- /uk-grid -->
