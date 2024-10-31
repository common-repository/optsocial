<?php
global $qt_popup_x1x_data;
?>

  <div class="wrap">
    <h2><?php echo $qt_popup_x1x_data['admin_submenu']['page_title'] ?></h2>

    <form action="<?php echo admin_url( 'admin.php?page='.$qt_popup_x1x_data['url_prefix'].'-reset-options' ); ?>" method="post">
      <input type="submit" value="Click to reset <?php echo $qt_popup_x1x_data['full_name'] ?> options" style="float:left;" />
      <input type="hidden" name="<?php echo $qt_popup_x1x_data['prefix'] ?>_reset_options" value="true" />
    </form>

  </div>
