<div class="" uk-grid>
  <div class="uk-width-1-1@m uk-background-primary uk-light">
    <div class="uk-container uk-text-center">
      <h1 class="uk-padding uk-text-bold">Let's post a job.</h1>
    </div>
  </div>
  <div class="uk-width-1-1@m">
    <div class="uk-container">
      <section id="new-job">
        <div class="uk-grid-divider" uk-grid>
          <?php if ( is_user_logged_in() ) : ?>
            <div class="uk-width-1-4@m">
              <h3 class="uk-text-bold">What do you need help with?</h3>
              <p>Tell us about your problem or issue.</p>
              <p>We'll guide you through setting up your job to ensure that lawyers have everything they need to give you a great fixed-fee proposal as quickly as possible.</p>
            </div>
            <div class="uk-width-3-4@m">
              <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 6, 'title' => false, 'description' => false ) ); ?>
            </div>
          <?php else:  // Display the shortform registration page that segues into the create job form. ?>
            <div class="uk-width-1-4@m">
              <h3 class="uk-text-bold">First, tell us about yourself.</h3>
              <p>Lawyers will get in touch with you via Consensus.</p>
              <p>We'll create an account for you, so you can easily manage your job and connect with your chosen lawyer.</p>
            </div>
            <div class="uk-width-3-4@m">
              <div class="uk-alert-primary" uk-alert>Already have an account? <a href="/account/login?action=new_job" alt="#">Login here.</a></div>
              <form>
                <pre>This form is a dummy only.</pre>
                <fieldset class="uk-fieldset">

                    <div class="uk-grid-small" uk-grid>

                      <div class="uk-width-1-2">
                        <label class="uk-form-label" for="first_name">First Name*</label>
                        <input class="uk-input" id="first-name" type="text" placeholder="">
                      </div>

                      <div class="uk-width-1-2">
                        <label class="uk-form-label" for="last-name">Last Name</label>
                        <input class="uk-input" id="last-name" type="text" placeholder="">
                      </div>

                      <div class="uk-width-1-1">
                        <label class="uk-form-label" for="email">Email Address</label>
                        <input class="uk-input" id="email" type="text" placeholder="">
                        <p class="uk-text-meta uk-margin-small-top">Choose an email address you check often or receive important emails at, like a work address.</p>
                      </div>

                      <div class="uk-width-1-2">
                        <label class="uk-form-label" for="password">Pick a password.</label>
                        <input class="uk-input" id="password" type="text" placeholder="">
                      </div>

                      <div class="uk-width-1-2">
                        <label class="uk-form-label" for="password-confirm">Type your password again.</label>
                        <input class="uk-input" id="password-confirm" type="text" placeholder="">
                      </div>

                      <div class="uk-width-1-1 uk-margin-remove-top">
                        <p class="uk-text-meta uk-margin-small-top">The best passwords are random phrases that are easy to remember. A good password is one like <i>stagegrassfrockshadowsecond</i>.</p>
                      </div>

                      <div class="uk-width-1-1">
                        <label class="uk-form-label" for="password-confirm">Where in New Zealand do you normally reside?</label>
                        <select class="uk-select">
                            <option>–</option>
                            <option>Northland</option>
                            <option>Auckland</option>
                            <option>Waikato</option>
                            <option>Bay of Plenty</option>
                            <option>Gisborne</option>
                            <option>Hawke's Bay</option>
                            <option>Taranaki</option>
                            <option>Manawatu-Wanganui</option>
                            <option>Wellington</option>
                            <option>Tasman</option>
                            <option>Nelson</option>
                            <option>Marlborough</option>
                            <option>West Coast</option>
                            <option>Canterbury</option>
                            <option>Otago</option>
                            <option>Southland</option>
                        </select>
                      </div>

                      <div class="uk-width-1-1">
                        <div class="uk-button uk-button-primary uk-margin-small-top uk-align-right">Next</div>
                      </div>
                </fieldset>
              </form>
              <hr>
              <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 7, 'title' => false, 'description' => false ) ); ?>
            </div>
          <?php endif; ?>
        </div>
      </section>
    </div>
  </div>
</div>
