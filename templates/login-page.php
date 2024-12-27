<!DOCTYPE html>
<html lang="en">
  <head>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class( 'a1a-dashboard' ); ?>>
    <div id="PAGE">
      <div class="a1a-login-screen">
        <div class="__login-form">
          <div class="__heading">
            <h2 class="heading-text">A1Academy</h2>
            <p>Đăng nhập tài khoản và bắt đầu khoá học miễn phí ngay hôm nay.</p>
          </div>
          <?php load_template( A1AM_DIR . 'templates/login.php', __return_false() ); ?>
        </div>
        <div class="__image-preview">
          <div class="__image-layer" style="background: url('<?php echo get_field('a1a_login_preview_image', 'option') ?>') no-repeat center center / cover, #333;"></div>
        </div>
      </div>
    </div>
    <?php wp_footer() ?>
  </body>
</html>