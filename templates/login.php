<?php 
/**
 * Login
 */

?>
<div class="a1am-login-container">

  <div class="heading-login-type">
    <div class="a1am-button-group a1a1-switch-user-login-form">
      <button type="button" data-active-form=".wp_login_form" class="button __active"><?php _e('Login', 'a1a-wp-membership'); ?></button>
      <button type="button" data-active-form=".a1am_register_form_template" class="button"><?php _e('Register', 'a1a-wp-membership'); ?></button>
    </div>
  </div>

  <div class="a1am-login-message"></div>

  <div class="a1am-login-forms">
    <div class="a1am-form-container wp_login_form __active">
      <?php wp_login_form(); ?>
    </div>
    <div class="a1am-form-container a1am_register_form_template">
      <?php a1am_register_form_template() ?>
    </div>
  </div>
</div> <!-- .a1awh-login-container -->

<script>
  (() => {
    'use strict';

  })
</script>