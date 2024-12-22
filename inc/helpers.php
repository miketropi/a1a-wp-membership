<?php 
/**
 * Helper functions 
 */


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

  ob_start();
  ?>
  <div class="email-content" style="font-family: Arial;">
    <p>Chào <?php echo $fullname; ?>,</p>
    <p>Để hoàn tất quá trình đăng ký, vui lòng nhấp vào liên kết bên dưới để xác nhận địa chỉ email của bạn:</p>
    <p><a href="<?php echo $verify_url; ?>"><?php echo $verify_url; ?></a></p>
    <p>Nếu bạn không thể nhấp vào liên kết, hãy sao chép và dán nó vào trình duyệt của mình.</p>
    <p>Trân trọng,</p>
    <strong><?php echo get_bloginfo( 'name' ); ?></strong>
  </div>
  <?php
  $message = ob_get_clean();

  wp_mail( 
    $user_email, 
    __('Verify Account - ' . get_bloginfo( 'name' ), 'a1a'), 
    $message, 
    $headers );
}