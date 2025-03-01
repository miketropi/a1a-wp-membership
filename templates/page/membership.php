<?php 
/**
 * Membership page
 */
$heading_text = __('Nâng cấp gói thành viên', 'a1a');
$description = __('Cộng đồng và team A1A hoạt động với phương châm chia sẻ kiến thức về tài sản số cũng như ngành tài chính.', 'a1a');
?>
<div class="membership-container">
    <?php a1am_dashboard_page_heading_template($heading_text, $description); ?>
    

  <div class="a1am-pricing-table">
      <div class="pricing-column free">
          <div class="package-header">
              <h3>Free</h3>
              <p class="price">$0<span>/year</span></p>
              <p class="package-type">For Beginners</p>
          </div>
          <div class="package-features">
            <p>
              🎁 Gói Free cung cấp các tính năng cơ bản cho người mới tham gia cộng đồng. 👥 Người dùng có thể theo dõi các danh mục, truy cập các bài viết và bình luận. ✨ Gói này phù hợp cho người mới bắt đầu tham gia cộng đồng.
            </p>
          </div>
          <div class="package-action">
              <button class="button __secondary">Get Started</button>
          </div>
      </div>

      <div class="pricing-column premium">
          <div class="package-header">
              <h3>Premium</h3>
              <p class="price">$800<span>/year</span></p>
              <p class="package-type">For Serious Traders</p>
          </div>
          <div class="package-features">
            <p>
              🌟 Gói Premium cung cấp các tính năng nâng cao hơn so với gói Free. 💎 Người dùng có thể theo dõi nhiều hơn 100 cryptocurrency, truy cập dữ liệu real-time chi tiết hơn, báo cáo chi tiết hơn. 🚀 Gói này phù hợp cho người quan tâm đến thị trường onchain và có khả năng đầu tư. 💪
            </p>
          </div>
          <div class="package-action">
              <button class="button __primary">Upgrade Now</button>
          </div>
      </div>
  </div>
</div>