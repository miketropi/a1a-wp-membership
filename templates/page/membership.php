<?php 
/**
 * Membership page
 */

$packages = get_field('membership_package_data', 'option');
$hasPackages = (!$packages || count($packages) == 0) ? false : true;

$heading_text = __('Nâng cấp gói thành viên', 'a1a');
$description = __('Cộng đồng và team A1A hoạt động với phương châm chia sẻ kiến thức về tài sản số cũng như ngành tài chính.', 'a1a');
?>
<div class="membership-container">
    <?php a1am_dashboard_page_heading_template($heading_text, $description); ?>
    <?php if($hasPackages == true) : ?>
    <div class="a1a-package-register">
      <?php foreach($packages as $index => $pack) : ?>
      <div class="a1a-package-item">
        <div class="banner">
          <img src="<?php echo $pack['banner']; ?>" alt="<?php echo $pack['name']; ?>" />
        </div>
        <div class="name"><?php echo $pack['name']; ?></div>
        <div class="desc"><?php echo wpautop($pack['description']); ?></div>
        <?php if(!empty($pack['price'])) {
          echo '<div class="__action"><button class="button __primary">'. __('Nâng cấp gói', 'a1a') . ' ' . $pack['name'] .' ($'. $pack['price'] .'/Year)</button></div>';
        } ?>
      </div>
      <?php endforeach ?>
    </div>
    <?php endif; ?>
</div>