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

function a1am_user_verify_status_template($status) {
  if($status == 'true') {
    ?>
    <div class="a1a-message __type-success">
      <div class="message-inner"><?php _e('Xác minh Tài khoản thành công.', 'a1a') ?></div>  
      <span class="__close" onClick="javascript: this.parentElement.remove()" title="remove">✕</span>
    </div>
    <?php
  } else {
    ?>
    <div class="a1a-message __type-error">
      <div class="message-inner"><?php _e('Xác minh Tài khoản thất bại.', 'a1a') ?></div>  
      <span class="__close" onClick="javascript: this.parentElement.remove()" title="remove">✕</span>
    </div>
    <?php
  }
}

function a1am_nav_main_menu_template() {
  $menus = a1am_nav_main_menu();
  set_query_var( 'main_menu', $menus );
  load_template( A1AM_DIR . 'templates/main-menu.php', __return_false() );
}

function a1am_nav_courses_menu_template() {
  $courses_menu = a1am_nav_courses_menu();
  if(!$courses_menu) return;

  set_query_var( 'courses_menu', $courses_menu );
  load_template( A1AM_DIR . 'templates/courses-menu.php', __return_false() );
}

function a1am_dashboard_logo_template() {
  ?>
  <div class="a1a-course-dashboard-logo">
    <a href="">
      <span>A1A</span>
      <?php _e('Course', 'a1a') ?>
    </a>
  </div>
  <?php
}

function a1am_dashboard_entry_template() {
  $routes_base = get_query_var( 'routes_base' );
  ?>
  <div class="a1a-content-summary">
    <div class="a1a-content-summary__inner">
      <?php load_template( A1AM_DIR . 'templates/page/'. $routes_base[0] .'.php', __return_false() ); ?>
    </div>
  </div>
  <?php
}

function a1am_dashboard_page_heading_template($heading_text, $description = '', $classes = '') {
  ?>
  <div class="a1a-heading-ss <?php echo $classes; ?>" style="background: url('<?php echo A1AM_URL . '/images/background-heading.jpg' ?>') no-repeat center center / cover, #fafafa">
    <h2 class="a1a-heading-text"><?php echo $heading_text; ?></h2>
    <?php echo wpautop($description); ?>
  </div>
  <?php
}

function a1am_nav_user_template() {
  $current_user = wp_get_current_user();
  $fullname = $current_user->user_firstname . ' ' . $current_user->user_lastname;
  $user_role = $current_user->roles[0];
  $label = a1am_role_labels($user_role);
  ?>
  <div class="a1am-dashboard-block-user-nav">
    <a href="<?php echo a1am_root_uri() . '/me'; ?>">
      <div class="__user-inner">
        <div class="__user-avar">
          <img src="<?php echo get_avatar_url($current_user->ID); ?>" alt="avatar" />
        </div>
        <div class="__user-entry">
        <?php if($label) : ?>
          <div class="__user-current-pack">
            <span style="background: <?php echo $label['background']; ?>; color: <?php echo $label['color']; ?>;"><?php echo $label['label']; ?></span>
          </div>
          <?php endif; ?>
          <div class="__user-name"><?php echo $fullname; ?></div>
        </div>
      </div>
    </a>
  </div>
  <?php
}