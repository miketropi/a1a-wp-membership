<?php 

$heading_text = __('Hỗ trợ', 'a1a');
$description = __('Hãy liên hệ với chúng tôi ngay nếu bạn cần giúp đỡ, đôi lúc hệ thống sẽ quá tải không tránh khỏi sự chậm trể. Hãy để lại tin nhắn, chúng tôi sẽ xem chúng ngay khi có thể. Xin cảm ơn!', 'a1a');
?>
<div class="support-container">
  <?php a1am_dashboard_page_heading_template($heading_text, $description); ?>

  <?php a1am_contact_channel_template([
    'telegram' => get_field('a1am_telegram', 'option'),
    'discord' => get_field('a1am_discord', 'option'),
    'email' => get_field('a1am_email', 'option'),
    'phone' => get_field('a1am_phone', 'option'),
    'heading' => 'Liên hệ với chúng tôi',
    'description' => 'Chúng tôi luôn sẵn lòng hỗ trợ bạn.',
  ]) ?>
</div>