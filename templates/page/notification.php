<?php 
$heading_text = __('Thông báo', 'a1a');
$description = __('Cập nhật các thông báo từ team A1A về các chính sách và tin tức.', 'a1a');

// Get notifications
$notifications = a1am_get_notifications();

// Group notifications by date
$grouped_notifications = [];
foreach ($notifications as $notification) {
    $date = get_the_date('Y-m-d', $notification);
    if (!isset($grouped_notifications[$date])) {
        $grouped_notifications[$date] = [];
    }
    $grouped_notifications[$date][] = $notification;
}
?>
<div class="dashboard-container">
    <?php a1am_dashboard_page_heading_template($heading_text, $description); ?>
    
    <div class="notifications-list">
        <?php if (empty($notifications)) : ?>
            <div class="notification-empty">
                <?php _e('Không có thông báo nào.', 'a1a'); ?>
            </div>
        <?php else : ?>
            <?php foreach ($grouped_notifications as $date => $items) : ?>
                <div class="notification-group">
                    <div class="notification-date">
                        <?php echo date_i18n('d/m/Y', strtotime($date)); ?>
                    </div>
                    
                    <div class="notification-items">
                        <?php foreach ($items as $notification) : ?>
                            <div class="notification-item">
                                <h3 class="notification-title">
                                    <?php echo get_the_title($notification); ?>
                                </h3>
                                <div class="notification-content">
                                    <?php echo get_field('content', $notification->ID); ?>
                                </div>
                                <div class="notification-meta">
                                    <?php echo get_the_time('H:i', $notification); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>