<!DOCTYPE html>
<html lang="en" style="margin-top: 0 !important;">
  <head>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class( 'a1a-dashboard' ); ?>>
    <div id="PAGE">
      <?php do_action('a1am:dashboard__start')?>
      <div class="a1am-course-dashboard">
        <div class="a1am-course-dashboard__nav">
          <?php do_action('a1am:dashboard__nav') ?>
        </div>
        <div class="a1am-course-dashboard__entry">
          <?php do_action('a1am:dashboard__entry') ?>
        </div>
      </div>
      <?php do_action('a1am:dashboard__end')?>
    </div>
    <?php wp_footer() ?>
  </body>
</html>