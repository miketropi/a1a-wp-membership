<?php 
$current_user = wp_get_current_user();
// print_r($current_user);
?>
<div class="a1am-container-box a1am-spacing2">
  <h2><?php _e('Tài khoản của bạn', 'a1am') ?></h2>
  <form class="a1am-form" method="POST">
    <!-- <div class="avatar-edit">Avatar</div> -->
    <div class="a1am-field-2cols">
      <label>
        <span><?php _e('First Name*', 'a1am') ?></span>
        <input type="text" name="firstname" required value="<?php echo $current_user->user_firstname; ?>" />
      </label>
      <label>
        <span><?php _e('Last Name*', 'a1am') ?></span>
        <input type="text" name="firstname" required value="<?php echo $current_user->user_lastname; ?>" />
      </label>  
    </div>
    <label>
      <span><?php _e('Biographical Info', 'a1am') ?></span>
      <textarea name="bio"><?php echo get_the_author_meta( 'description', $current_user->ID ); ?></textarea>
      <small><?php _e('Chia sẻ một chút thông tin tiểu sử để điền vào hồ sơ của bạn. Điều này có thể được hiển thị công khai.', 'a1am') ?></small>
    </label>
    <label>
      <span><?php _e('Email*', 'a1am') ?></span>
      <input type="email" required name="email" readonly value="<?php echo $current_user->user_email ?>" />
    </label>
    <label>
      <span><?php _e('Phone Number*', 'a1am') ?></span>
      <input type="tel" required name="firstname" />
    </label>
    <label>
      <span><?php _e('Address', 'a1am') ?></span>
      <input type="text" name="address" />
    </label>
    <div class="action-buttons">
      <button class="button" type="submit">Update</button>
    </div>
  </form>
</div>