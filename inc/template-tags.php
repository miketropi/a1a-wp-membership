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
    'type' => 'primary', // primary, secondary, outline, dagerous
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

function a1am_message_template($message, $type = 'info') {
  // Validate message type
  $valid_types = ['success', 'info', 'danger'];
  $type = in_array($type, $valid_types) ? $type : 'info';

  // Define type-specific classes and icons
  $type_classes = [
    'success' => '__type-success',
    'info' => '__type-info', 
    'danger' => '__type-danger'
  ];

  ?>
  <div class="a1am-message <?php echo $type_classes[$type]; ?>">
    <div class="message-inner"><?php echo esc_html($message); ?></div>
    <span class="__close" onClick="javascript: this.parentElement.remove()" title="remove">✕</span>
  </div>
  <?php
}
function a1am_change_password_template() {
  ?>
  <form class="a1am-form" method="post" id="a1am-change-password-form">
    <label>
      <span><?php _e('New Password*', 'a1a') ?></span>
      <input type="password" name="password" id="password" required />
    </label>
    <label>
      <span><?php _e('Confirm New Password*', 'a1a')?></span>
      <input type="password" name="re-password" id="re-password" required />
    </label>
    <div class="action-buttons">
      <input type="hidden" name="a1am_form_action" value="change_password">
      <button class="button" type="submit">Update</button>
    </div>
  </form>
  <?php
}

function a1am_contact_channel_template($args = []) {
  $defaults = [
    'telegram' => '',
    'discord' => '',
    'email' => '',
    'phone' => '',
    'heading' => __('Contact Us', 'a1a'),
    'description' => __('Get in touch with us through any of these channels:', 'a1a')
  ];

  $args = wp_parse_args($args, $defaults);
  ?>
  <div class="a1am-contact-channels">
    <h3 class="a1am-contact-channels__heading"><?php echo esc_html($args['heading']); ?></h3>
    <?php if ($args['description']) : ?>
      <p class="a1am-contact-channels__description"><?php echo esc_html($args['description']); ?></p>
    <?php endif; ?>

    <div class="a1am-contact-channels__grid">
      <?php if ($args['telegram']) : ?>
        <a href="<?php echo esc_attr($args['telegram']); ?>" class="a1am-contact-channel" target="_blank">
          <span class="channel-icon">
            <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.43 7.13l-1.82 8.6c-.14.63-.5.79-1.02.49l-2.82-2.08-1.36 1.31c-.15.15-.28.28-.57.28l.2-2.85 5.18-4.67c.23-.2-.05-.31-.35-.12L7.87 12.3l-2.76-.86c-.6-.19-.61-.6.13-.89l10.77-4.15c.5-.18.94.11.42.73z"/></svg>
          </span>
          <span class="channel-label"><?php _e('Telegram', 'a1a'); ?></span>
        </a>
      <?php endif; ?>

      <?php if ($args['discord']) : ?>
        <a href="<?php echo esc_url($args['discord']); ?>" class="a1am-contact-channel" target="_blank">
          <span class="channel-icon">
            <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/></svg>
          </span>
          <span class="channel-label"><?php _e('Discord', 'a1a'); ?></span>
        </a>
      <?php endif; ?>

      <?php if ($args['email']) : ?>
        <a href="mailto:<?php echo esc_attr($args['email']); ?>" class="a1am-contact-channel">
          <span class="channel-icon">
            <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
          </span>
          <span class="channel-label"><?php _e('Email', 'a1a'); ?></span>
        </a>
      <?php endif; ?>

      <?php if ($args['phone']) : ?>
        <a href="tel:<?php echo esc_attr($args['phone']); ?>" class="a1am-contact-channel">
          <span class="channel-icon">
            <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
          </span>
          <span class="channel-label"><?php _e('Phone', 'a1a'); ?></span>
        </a>
      <?php endif; ?>
    </div>
  </div>
  <?php
}

function a1am_course_categories_grid_template() {
  $categories = a1am_get_course_tax();
  if (empty($categories)) return;
  ?>
  <div class="a1am-course-categories">
    <div class="a1am-course-categories__grid">
      <?php foreach ($categories as $category) : ?>
        <div class="a1am-course-category">
          <a href="<?php echo esc_url($category->custom_url); ?>" class="a1am-course-category__inner">
            <?php if ($category->banner) : ?>
              <div class="a1am-course-category__image">
                <img src="<?php echo esc_url($category->banner); ?>" alt="<?php echo esc_attr($category->name); ?>">
              </div>
            <?php endif; ?>
            
            <div class="a1am-course-category__content">
              <h3 class="a1am-course-category__title"><?php echo esc_html($category->name); ?></h3>
              
              <!-- <?php if ($category->meta_content) : ?>
                <div class="a1am-course-category__meta">
                  <?php // echo wp_kses_post($category->meta_content); ?>
                </div>
              <?php endif; ?> -->
              
              <div class="a1am-course-category__count">
                <?php printf(
                  _n('%s Bài viết', '%s Bài viết', $category->count, 'a1a'),
                  number_format_i18n($category->count)
                ); ?>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
}

function a1am_premium_tag_template($type = 'default', $label = 'Premium') {
  ?>
  <span class="a1am-premium-tag" data-type="<?php echo $type; ?>">
    <?php echo esc_html($label); ?>
  </span>
  <?php
}


function a1am_courses_list_template($tax_id) {
  $courses = a1am_get_courses_by_tax_id($tax_id);
  if (empty($courses)) return;
  ?>
  <div class="a1am-courses-list">
    <div class="a1am-courses-list__inner">
      <?php foreach ($courses as $index => $course) : ?>
        <div class="a1am-course-item">
          <a href="<?php echo esc_url($course->custom_url); ?>" class="a1am-course-item__inner">
            <span class="a1am-course-item__number"><?php echo esc_html($index + 1); ?></span>
            <h3 class="a1am-course-item__title"><?php echo esc_html($course->post_title); ?></h3>
            <?php ($course->require_premium_role ? a1am_premium_tag_template() : ''); ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
}

/**
 * Check if current user has specific role(s)
 *
 * @param string|array $roles Single role or array of roles to check
 * @return boolean True if user has any of the specified roles, false otherwise
 */
function a1am_user_has_role($roles) {
    // Get current user
    $user = wp_get_current_user();
    
    if (!$user->exists()) {
        return false;
    }

    // Convert single role to array for consistent handling
    if (!is_array($roles)) {
        $roles = array($roles);
    }

    // Check if user has any of the specified roles
    foreach ($roles as $role) {
        if (in_array($role, (array) $user->roles)) {
            return true;
        }
    }

    return false;
}

function a1am_upgrade_user_package_template($msg = '') {
  $link_upgrade = a1am_root_uri() . '/membership/';
  ?>
  <div class="a1am-upgrade-user-package">
    <p><?php echo $msg ?> <a href="<?php echo $link_upgrade; ?>"><?php _e('Vui lòng nâng cấp gói thành viên') ?></a></p>
  </div>
  <?php
}

function a1am_search_icon_template() {
  ?>
  <div class="a1am-search-handle" onclick="document.querySelector('.a1am-search-lightbox').classList.toggle('is-active')">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="11" cy="11" r="8"></circle>
      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
    </svg>
  </div>
  <?php
}

function a1am_home_icon_template() {
  ?>
  <a href="<?php echo a1am_root_uri(); ?>" class="a1am-home-handle" aria-label="home">
    <?php echo a1am_icon('home'); ?>
  </a>
  <?php
}

function a1am_toggle_menu_icon_template() {
  ?>
  <div class="a1am-toggle-menu-handle" onClick="document.body.classList.toggle('__menu-mobi-active')">
    <span>M</span>
    <span>E</span>
    <span>N</span>
    <span>U</span>
  </div>
  <?php
}

function a1am_tools_template() {
  ?>
  <div class="a1am-tools">
    <?php a1am_home_icon_template();?>
    <?php a1am_search_icon_template();?>
    <?php a1am_toggle_menu_icon_template() ?>
  </div>
  <?php
}

function a1am_search_lightbox_template() {
  ?>
  <div class="a1am-search-lightbox">
    <div class="a1am-search-lightbox__overlay"></div>
    <div class="a1am-search-lightbox__container">
      <div class="a1am-search-lightbox__header">
        <form class="a1am-search-form" action="<?php echo a1am_root_uri(); ?>/search" method="GET">
          <input type="text" 
                 name="q" 
                 placeholder="<?php esc_attr_e('Search courses...', 'a1a'); ?>"
                 autocomplete="off"
                 required>
          <button type="submit" aria-label="<?php esc_attr_e('Search', 'a1a'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>
        </form>
        <button class="a1am-search-lightbox__close" aria-label="<?php esc_attr_e('Close search', 'a1a'); ?>" onclick="document.querySelector('.a1am-search-lightbox').classList.remove('is-active')">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
      <div class="a1am-search-lightbox__results">
        <!-- Results will be loaded here dynamically -->
      </div>
    </div>
  </div>
  <?php
}

function a1am_search_posts_template($posts) {
  if (empty($posts)) {
    ?>
    <div class="a1am-search-empty">
      <p><?php _e('No results found', 'a1a'); ?></p>
    </div>
    <?php
    return;
  }

  ?>
  <div class="a1am-search-results">
    <?php foreach ($posts as $index => $post) : ?>
      <div class="a1am-search-result-item">
        <a href="<?php echo $post->custom_url; ?>" class="a1am-search-result-item__inner">
          <div class="a1am-search-result-item__content">
            <h3 class="a1am-search-result-item__title">
              <span class="__number"><?php echo $index + 1; ?>. </span>
              <?php echo esc_html($post->post_title); ?>
              <?php ($post->require_premium_role ? a1am_premium_tag_template() : ''); ?>
            </h3>
          </div>
        </a>
        <div class="a1am-search-result-item__terms">
          <?php if (!empty($post->terms)) : ?>
            <?php foreach ($post->terms as $term) : ?>
              <span class="term-item"><?php echo esc_html($term->name); ?></span>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php
}
