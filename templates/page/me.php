<?php 
$current_user = wp_get_current_user();
// print_r($current_user);
// a1am_update_user_information

if(isset($_POST['a1am_form_action']) && $_POST['a1am_form_action'] == 'update_user_information') {
  $user_data = $_POST;
  $result = a1am_update_user_information($user_data); 

  ob_start();
  if($result == true) {
    a1am_message_template(__('Cập nhật thông tin thành công', 'a1am'), 'success');
  } else {
    a1am_message_template(__('Cập nhật thông tin không thành công', 'a1am'),'error'); 
  }
  $messages = ob_get_clean();
} 

if(isset($_POST['a1am_form_action']) && $_POST['a1am_form_action'] == 'change_password') {
  $new_password = $_POST['password'];
  $re_password = $_POST['re-password'];
  $result = a1am_change_password($new_password, $re_password);
  ob_start();
  if($result == true) {
    a1am_message_template(__('Cập nhật mật khẩu thành công', 'a1am'),'success');
  } else {
    a1am_message_template(__('Cập nhật mật khẩu không thành công', 'a1am'),'error');
  }
  $messages = ob_get_clean();
}
?>
<div class="a1am-container-box a1am-spacing2">
  <?php if(isset($messages)) echo $messages;?>
  <h2><?php _e('Tài khoản của bạn', 'a1am') ?></h2>
  <form class="a1am-form" method="POST" action="">
    <!-- <div class="avatar-edit">Avatar</div> -->
    <div class="a1am-field-2cols">
      <label>
        <span><?php _e('First Name*', 'a1am') ?></span>
        <input type="text" name="first_name" required value="<?php echo $current_user->user_firstname; ?>" />
      </label>
      <label>
        <span><?php _e('Last Name*', 'a1am') ?></span>
        <input type="text" name="last_name" required value="<?php echo $current_user->user_lastname; ?>" />
      </label>  
    </div>
    <label>
      <span><?php _e('Biographical Info', 'a1am') ?></span>
      <textarea name="description"><?php echo get_the_author_meta( 'description', $current_user->ID ); ?></textarea>
      <small><?php _e('Chia sẻ một chút thông tin tiểu sử để điền vào hồ sơ của bạn. Điều này có thể được hiển thị công khai.', 'a1am') ?></small>
    </label>
    <label>
      <span><?php _e('Email*', 'a1am') ?></span>
      <input type="email" required name="email" readonly value="<?php echo $current_user->user_email ?>" />
    </label>
    <label>
      <span><?php _e('Phone Number*', 'a1am') ?></span>
      <input type="tel" required name="phone_number" value="<?php echo get_user_meta($current_user->ID, 'phone_number', true); ?>" />
    </label>
    <label>
      <span><?php _e('Telegram', 'a1am') ?></span>
      <input type="text" name="telegram" value="<?php echo get_user_meta($current_user->ID, 'telegram', true); ?>" />
    </label>
    <label>
      <span><?php _e('Discord ID', 'a1am') ?></span>
      <input type="text" name="discord_id" value="<?php echo get_user_meta($current_user->ID, 'discord_id', true); ?>" />
    </label>
    <label>
      <span><?php _e('Website', 'a1am') ?></span>
      <input type="text" name="user_url" value="<?php echo $current_user->user_url; ?>" />
    </label>
    <div class="action-buttons">
      <input type="hidden" name="a1am_form_action" value="update_user_information">
      <button class="button" type="submit">Update</button>
    </div>
  </form>

  <div class="a1am-spacing2">
    <h2><?php _e('Đổi mật khẩu', 'a1am') ?></h2>
    <?php a1am_change_password_template() ?>
  </div>
</div>

