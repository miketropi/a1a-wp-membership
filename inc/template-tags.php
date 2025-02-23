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

function a1am_box_number_template($number, $label, $icon = '', $description = '') {
  ?>
  <div class="a1a-box-number">
    <div class="a1a-box-number__inner" title="<?php echo $description; ?>">
      <div class="a1a-box-number__number"><?php echo $number; ?></div>
      <div class="a1a-box-number__label"><?php echo $label; ?></div>
    </div>
  </div>
  <?php
}

function a1am_banner_template($args = []) {
  $defaults = [
    'sub_heading' => '',
    'heading' => '',
    'button_text' => '',
    'button_url' => '',
    'background_color' => '#002577', // Using dashboard accent color from variables
    'background_image' => '',
  ];

  $args = wp_parse_args($args, $defaults);
  ?>
  <div class="a1a-banner" style="background-color: <?php echo esc_attr($args['background_color']); ?>">
    <?php if($args['background_image']) : ?>
      <div class="a1a-banner__background-image" style="background-image: url('<?php echo esc_url($args['background_image']); ?>')">
      </div>
    <?php endif; ?>
    <div class="a1a-banner__inner">
      <?php if($args['sub_heading']) : ?>
        <div class="a1a-banner__sub-heading"><?php echo esc_html($args['sub_heading']); ?></div>
      <?php endif; ?>

      <?php if($args['heading']) : ?>
        <h2 class="a1a-banner__heading"><?php echo esc_html($args['heading']); ?></h2>
      <?php endif; ?>

      <?php if($args['button_text'] && $args['button_url']) : ?>
        <div class="a1a-banner__action">
          <?php a1am_button_template([
            'text' => $args['button_text'],
            'url' => $args['button_url'],
            'type' => 'primary',
            'size' => 'medium',
          ]); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php
}

function a1am_button_template($args = []) {
  $defaults = [
    'text' => '',
    'url' => '#',
    'icon' => '', // SVG string
    'icon_position' => 'left', // left or right
    'type' => 'primary', // primary, secondary, outline
    'size' => 'medium', // small, medium, large
    'class' => '', // Additional custom classes
    'attributes' => [], // Additional HTML attributes as key-value pairs
  ];

  $args = wp_parse_args($args, $defaults);

  // Build classes
  $classes = ['a1a-button'];
  $classes[] = 'a1a-button--' . $args['type'];
  $classes[] = 'a1a-button--' . $args['size'];
  if ($args['icon']) {
    $classes[] = 'a1a-button--has-icon';
    $classes[] = 'a1a-button--icon-' . $args['icon_position'];
  }
  if ($args['class']) {
    $classes[] = $args['class'];
  }

  // Build attributes string
  $attributes = '';
  foreach ($args['attributes'] as $key => $value) {
    $attributes .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }
  ?>
  <a href="<?php echo esc_url($args['url']); ?>" 
     class="<?php echo esc_attr(implode(' ', $classes)); ?>"
     <?php echo $attributes; ?>>
    <?php if ($args['icon'] && $args['icon_position'] === 'left') : ?>
      <span class="a1a-button__icon"><?php echo $args['icon']; ?></span>
    <?php endif; ?>
    
    <span class="a1a-button__text"><?php echo esc_html($args['text']); ?></span>
    
    <?php if ($args['icon'] && $args['icon_position'] === 'right') : ?>
      <span class="a1a-button__icon"><?php echo $args['icon']; ?></span>
    <?php endif; ?>
  </a>
  <?php
}

function a1am_spacing_template($size = 'medium') {
  $sizes = [
    'small' => '1rem',
    'medium' => '2rem', 
    'large' => '3rem',
    'xlarge' => '4rem'
  ];

  $spacing_size = isset($sizes[$size]) ? $sizes[$size] : $sizes['medium'];
  ?>
  <div class="a1a-spacing" style="margin-bottom: <?php echo esc_attr($spacing_size); ?>"></div>
  <?php
}
