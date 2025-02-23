<?php 

$heading_text = __('Dashboard', 'a1a');
$description = __('Cộng đồng và team A1A hoạt động với phương châm chia sẻ kiến thức về tài sản số cũng như ngành tài chính.', 'a1a');
?>
<div class="dashboard-container">
  <?php a1am_dashboard_page_heading_template($heading_text, $description); ?>
  <div class="dashboard-container__inner">

    <?php a1am_banner_template([
        'sub_heading' => 'A1Academy Course',
        'heading' => __('Nơi bạn có thể học tập và phát triển bản thân trong lĩnh vực đầu tư tài chính, Crypto và Blockchain.', 'a1am'),
        'button_text' => __('Xem thêm', 'a1a'),
        'button_url' => '#',
        'background_color' => '#002577',
        'background_image' => 'https://i.pinimg.com/736x/06/f2/0c/06f20c7941a360ddf466581e0916186b.jpg',
      ]); ?>
    </div>

    <?php a1am_spacing_template('large'); ?>

    <div class="a1am-grid a1am-grid-3">
      <div class="a1am-grid__item">
        <?php a1am_box_number_template(15, 'Chủ đề'); ?>
      </div>
      <div class="a1am-grid__item">
        <?php a1am_box_number_template(100, 'Bài học'); ?>
      </div>
      <div class="a1am-grid__item">
        <?php a1am_box_number_template(45, 'Ngày tham gia'); ?>
      </div>
    </div>

    <?php a1am_spacing_template('large'); ?>

    
</div>