<?php 
/**
 * Helper functions 
 */

function a1am_icon($name) {
  $icons = require( __DIR__ . '/icons.php' );
  return $icons[$name];
}

function a1am_membership_dashboard() {
  (is_user_logged_in() 
    ? a1am_membership_dashboard_template() 
    : a1am_login_form_template());
}

function a1am_user_register_send_verification_email($user_id) {
  $verify_code = get_field('a1a_user_verify_code', 'user_' . $user_id);
  $verify_url = get_site_url() . '?__userverifycode=' . $user_id . '-' . $verify_code;
  $wp_user_object = new WP_User($user_id);
  $user_email = $wp_user_object->user_email;
  $fullname = $wp_user_object->first_name . ' ' . $wp_user_object->last_name;
  $headers = ['Content-Type: text/html; charset=UTF-8'];
  $email_user_verify_temp = get_field('a1a_user_verify_email_content', 'option');

  $replace_map = [
    '{user_fullname}' => $fullname,
    '{user_verify_link}' => '<a href="'. $verify_url .'">'. $verify_url .'</a>',
  ];

  $body = str_replace(
    array_keys($replace_map), 
    array_values($replace_map), 
    $email_user_verify_temp
  ); 

  wp_mail( 
    $user_email, 
    __('Verify Account - ' . get_bloginfo( 'name' ), 'a1a'), 
    $body, 
    $headers );
}

function a1am_verify_account($user_id, $verify_code) {
  $code = get_field( 'a1a_user_verify_code', 'user_' . $user_id );
  $status = get_field( 'verify_status', 'user_' . $user_id );

  if($status == true) {
    return true;
  }

  if($code != $verify_code) {
    return false;
  } else {
    update_field( 'verify_status', true, 'user_' . $user_id );
    return true;
  }
}

function a1am_root_uri() {
  $dashboard_page = get_field('a1a_dashboard_page', 'option');
  $dashboard_root = '/' . $dashboard_page->post_name;
  return $dashboard_root;
}

function a1am_nav_main_menu() {
  $dashboard_root = a1am_root_uri();

  return apply_filters( 'a1am:main_menu_hook', [
    'dashboard' => [
      'name' => 'Dashboard',
      'url' => $dashboard_root,
      'icon' => a1am_icon('home'),
    ],
    'membership' => [
      'name' => 'Gói thành viên',
      'url' => $dashboard_root . '/membership/',
      'icon' => a1am_icon('member_packages'),
    ],
    'notification' => [
      'name' => 'Thông báo',
      'url' => $dashboard_root . '/notification/',
      'icon' => a1am_icon('noti'),
    ],
    'support' =>[
      'name' => 'Hỗ trợ', 
      'url' => $dashboard_root . '/support/',
      'icon' => a1am_icon('help'),
    ],
    'me' =>[
      'name' => 'me',
      'url' => $dashboard_root . '/me/',
      'icon' => a1am_icon('help'),
      'nav_item_display' => false, 
    ],
  ] );
}

function a1am_nav_courses_menu() {
  $dashboard_page = get_field('a1a_dashboard_page', 'option');
  $dashboard_root = '/' . $dashboard_page->post_name;

  $terms = get_terms( array(
    'taxonomy'   => 'course-tax',
    'hide_empty' => false,
  ) );

  return array_map(function($t) use ($dashboard_root) {
    $courses = get_posts([
      'numberposts' => -1,
      'post_type' => 'a1a-course',
      'tax_query' => [
        [
          'taxonomy' => 'course-tax',
          'field'    => 'slug',
          'terms'    => [$t->slug],
        ]
      ]
    ]);

    $t->custom_url = $dashboard_root . '/section/' . $t->slug;
    $t->__courses = array_map(function($c) use ($dashboard_root) {
      $c->custom_url = $dashboard_root . '/course/' . $c->post_name;
      $c->require_premium_role = get_field('require_premium_role', $c->ID);
      return $c;
    }, $courses);
    return $t;
  }, $terms);
}

function a1am_routes_validate($routes_base) {
  list($page) = $routes_base;
  $register_pages = a1am_nav_main_menu();
  $pages_validate = array_merge(array_keys($register_pages), ['section', 'course']);
  
  if(in_array($page, $pages_validate)) {
    return true;
  } else {
    return false;
  }
}

function a1am_role_labels($role) {
  $labels = [
    'a1a_membership' => [
      'label' => __('Premium Pack ★', 'a1a'),
      'background' => 'none',
      'color' => '#00ff8b',
    ],
    'subscriber' => [
      'label' => __('Free Pack', 'a1a'),
      'background' => 'none',
      'color' => '#d675b7',
    ],
  ];

  return (isset($labels[$role]) ? $labels[$role] : null);
}

function a1am_get_total_courses_tax() {
  $terms = get_terms( array(
    'taxonomy' => 'course-tax',
    'hide_empty' => false,
  ));

  return count($terms);
}

function a1am_get_total_courses() {
  $courses = get_posts([
    'post_type' => 'a1a-course',
    'numberposts' => -1,
    'post_status' => 'publish'
  ]);

  return count($courses);
}

function a1am_get_user_days_since_register($user_id = null) {
  if (!$user_id) {
    $user_id = get_current_user_id();
  }
  
  $user = get_userdata($user_id);
  if (!$user) {
    return 0;
  }

  $register_date = strtotime($user->user_registered); 
  // echo gmdate( 'Y-m-d H:i:s', strtotime( get_option( 'gmt_offset' ) . ' hours', strtotime( $user->user_registered ) ) );
  $current_date = current_time('timestamp');
  
  $days_diff = floor(($current_date - $register_date) / (60 * 60 * 24));
  
  return $days_diff;
}

function a1am_get_notifications() {
  $notifications = get_posts([
    'post_type' => 'notification',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
  ]);

  return $notifications;
}

function a1am_update_user_information($user_data) {
  $current_user_id = get_current_user_id();
  
  if (!$current_user_id) {
    return false;
  }

  $update_data = array(
    'ID' => $current_user_id
  );

  // Update first name if provided
  if (isset($user_data['first_name'])) {
    $update_data['first_name'] = sanitize_text_field($user_data['first_name']);
  }

  // Update last name if provided
  if (isset($user_data['last_name'])) {
    $update_data['last_name'] = sanitize_text_field($user_data['last_name']);
  }

  // Update description (biographical info) if provided
  if (isset($user_data['description'])) {
    $update_data['description'] = sanitize_textarea_field($user_data['description']);
  }

  // Update website if provided
  if (isset($user_data['user_url'])) {
    $update_data['user_url'] = esc_url_raw($user_data['user_url']);
  }

  // Update phone number if provided
  if (isset($user_data['phone_number'])) {
    update_user_meta($current_user_id, 'phone_number', sanitize_text_field($user_data['phone_number']));
  }

  // Update telegram if provided
  if (isset($user_data['telegram'])) {
    update_user_meta($current_user_id, 'telegram', sanitize_text_field($user_data['telegram']));
  }

  // Update discord ID if provided
  if (isset($user_data['discord_id'])) {
    update_user_meta($current_user_id, 'discord_id', sanitize_text_field($user_data['discord_id']));
  }

  // Update the user data
  $result = wp_update_user($update_data);

  // Return true if update successful, false if there was an error
  return !is_wp_error($result);
}

function a1am_change_password($password, $re_password) {
  // Verify passwords match
  if ($password !== $re_password) {
    return false;
  }

  // Get current user
  $current_user = wp_get_current_user();
  if (!$current_user) {
    return false;
  }

  // Update password
  $user_id = $current_user->ID;
  wp_set_password($password, $user_id);

  // Send confirmation email
  $user_email = $current_user->user_email;
  $fullname = $current_user->first_name . ' ' . $current_user->last_name;
  
  $headers = ['Content-Type: text/html; charset=UTF-8'];
  $subject = __('Password Updated Successfully - ' . get_bloginfo('name'), 'a1a');
  
  $body = sprintf(
    __('Hi %s,<br><br>Your password has been successfully updated on %s.<br><br>If you did not make this change, please contact support immediately.', 'a1a'),
    $fullname,
    get_bloginfo('name')
  );

  wp_mail($user_email, $subject, $body, $headers);

  return true;
}

function a1am_get_course_tax() {
  $dashboard_root = a1am_root_uri();
  $terms = get_terms(array(
    'taxonomy' => 'course-tax',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
  ));

  if (is_wp_error($terms)) {
    return array();
  }

  return array_map(function($t) use ($dashboard_root) {
    $t->custom_url = $dashboard_root . '/section/' . $t->slug;
    $t->banner = get_field('banner', 'course-tax_' . $t->term_id);
    $t->meta_content = get_field('meta_content', 'course-tax_' . $t->term_id);
    return $t;
  }, $terms); 
}

function a1am_get_courses_by_tax_id($tax_id) {
  $dashboard_root = a1am_root_uri();
  
  // Get posts with the specified taxonomy ID
  $courses = get_posts([
    'numberposts' => -1,
    'post_type' => 'a1a-course',
    'tax_query' => [
      [
        'taxonomy' => 'course-tax',
        'field'    => 'term_id',
        'terms'    => $tax_id,
      ]
    ],
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
  ]);

  // Add custom URL to each course
  return array_map(function($course) use ($dashboard_root) {
    $course->custom_url = $dashboard_root . '/course/' . $course->post_name;
    $course->require_premium_role = get_field('require_premium_role', $course->ID);
    return $course;
  }, $courses);
}

function a1am_check_post_in_term($post_slug, $term_id) {
  // Get post ID from slug
  $post = get_page_by_path($post_slug, OBJECT, 'a1a-course');
  
  if (!$post) {
    return false;
  }

  // Get the terms associated with the post
  $post_terms = wp_get_post_terms($post->ID, 'course-tax', array('fields' => 'ids'));

  // Check if there was an error getting terms
  if (is_wp_error($post_terms)) {
    return false;
  }

  // Check if the term_id exists in post terms
  return in_array($term_id, $post_terms);
}
