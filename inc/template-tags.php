<?php 
/**
 * Template tags
 */

function a1am_login_form_template() {
  load_template( A1AM_DIR . '/templates/login.php', __return_false() );
}

function a1am_membership_dashboard_template() {
  load_template( A1AM_DIR . '/templates/membership-dashboard.php', __return_false() );
}

function a1am_register_form_template() { 
  ?>
  <form method="post" id="a1am-user-register-form">
    <p>
      <label for="firstname"><?php _e('First Name*', 'a1a') ?></label>
      <input type="text" name="firstname" required />
    </p>
    <p>
      <label for="lastname"><?php _e('Last Name*', 'a1a') ?></label>
      <input type="text" name="lastname" required />
    </p>
    <p>
      <label for="lastname"><?php _e('Email*', 'a1a') ?></label>
      <input type="email" name="email" required />
    </p>
    <p>
      <label for="lastname"><?php _e('Password*', 'a1a') ?></label>
      <input type="password" name="password" required />
    </p>
    <p>
      <label for="lastname"><?php _e('re-Password*', 'a1a') ?></label> 
      <input type="password" name="re-password" required />
    </p>
    <p>
      <button type="submit" class="button button-primary"><?php _e('Register', 'a1a') ?></button>
    </p>
  </form>
  <?php
}