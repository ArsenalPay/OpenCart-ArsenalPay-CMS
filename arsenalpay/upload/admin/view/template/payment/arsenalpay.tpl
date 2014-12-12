<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_ap_token; ?><br /><span class="help"><?php echo $help_ap_token ?></span></td>
            <td><input type="text" name="arsenalpay_ap_token" value="<?php echo $arsenalpay_ap_token; ?>" />
              <?php if ($error_ap_token) { ?>
              <span class="error"><?php echo $error_ap_token; ?></span>
              <?php } ?></td>
          </tr>
		  
          <!--<tr>
            <td><?php echo $entry_other_code; ?><br /><span class="help"><?php echo $help_other_code ?></span></td>
            <td><input type="text" name="arsenalpay_other_code" value="<?php echo $arsenalpay_other_code; ?>" /></td>
          </tr>-->
		  
          <tr>
            <td><span class="required">*</span> <?php echo $entry_key; ?><br /><span class="help"><?php echo $help_key ?></span></td>
            <td><input type="text" name="arsenalpay_key" value="<?php echo $arsenalpay_key; ?>" />
              <?php if ($error_key) { ?>
              <span class="error"><?php echo $error_key; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_ip; ?><br /><span class="help"><?php echo $help_ip ?></span></td>
            <td><input type="text" name="arsenalpay_ip" value="<?php echo $arsenalpay_ip; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_callback_url; ?><br /><span class="help"><?php echo $help_callback_url ?></span></td>
            <td><?php echo $callback_url ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_check_url; ?><br /><span class="help"><?php echo $help_check_url ?></span></td>
            <td><input type="text" name="arsenalpay_check_url" value="<?php echo $arsenalpay_check_url; ?>" /></td>
          </tr>
        <tr>
            <td><span class="required">*</span> <label for="arsenalpay_frame_url"><?php echo $entry_frame_url ?></label><br /><span class="help"><?php echo $help_frame_url ?></span></td>
            <td><input name="arsenalpay_frame_url" value="<?php echo $arsenalpay_frame_url ?>" id="arsenalpay_frame_url" />
            <?php if ($error_frame_url) { ?>
            <span class="error"><?php echo $error_frame_url; ?></span>
            <?php } ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $entry_src; ?><br /><span class="help"><?php echo $help_src ?></span></td>
            <td>
                <select name="arsenalpay_src">
                    <?php if ($arsenalpay_src == 'card') { ?>
                        <option value="mk" selected><?php echo $text_mk; ?></option>
                        <option value="card" selected="selected"><?php echo $text_card; ?></option>
                    <?php } else { ?>
						<option value="mk" selected="selected"><?php echo $text_mk; ?></option>
                        <option value="card"><?php echo $text_card; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="arsenalpay_frame_mode"><?php echo $entry_frame_mode ?></label><br /><span class="help"><?php echo $help_frame_mode ?></span></td>
			<td>
			<select name="arsenalpay_frame_mode">
                    <?php if ($arsenalpay_frame_mode == '1') { ?>
						<option value='0' selected><?php echo '0'; ?></option>
                        <option value='1' selected="selected"><?php echo '1'; ?></option>
                    <?php } else { ?>
                        <option value='0' selected="selected"><?php echo '0'; ?></option>
						<option value='1'><?php echo '1'; ?></option>
                    <?php } ?>
            </select>
			</td>
        </tr>
        <tr>
            <td><label for="arsenalpay_frame_params"><?php echo $entry_frame_params ?></label><br /><span class="help"><?php echo $help_frame_params ?></span></td>
            <td><input name="arsenalpay_frame_params" value="<?php echo $arsenalpay_frame_params ?>" id="arsenalpay_frame_params" /></td>
        </tr>
        <tr>
            <td><?php echo $entry_css; ?><br /><span class="help"><?php echo $help_css ?></span></td>
            <td><input type="text" name="arsenalpay_css" value="<?php echo $arsenalpay_css; ?>" /></td>
        </tr>
        <tr>
            <td><?php echo $entry_completed_status; ?></td>
            <td>
                <select name="arsenalpay_completed_status_id">
                    <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $arsenalpay_completed_status_id) { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </td>
        </tr>
          <tr>
                <td><?php echo $entry_canceled_status; ?></td>
                <td>
                    <select name="arsenalpay_canceled_status_id">
                        <?php foreach ($order_statuses as $order_status) { ?>
                            <?php if ($order_status['order_status_id'] == $arsenalpay_canceled_status_id) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_failed_status; ?></td>
                <td>
                    <select name="arsenalpay_failed_status_id">
                        <?php foreach ($order_statuses as $order_status) { ?>
                            <?php if ($order_status['order_status_id'] == $arsenalpay_failed_status_id) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_waiting_status; ?></td>
                <td>
                    <select name="arsenalpay_waiting_status_id">
                        <?php foreach ($order_statuses as $order_status) { ?>
                            <?php if ($order_status['order_status_id'] == $arsenalpay_waiting_status_id) { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </td>
            </tr>
          <tr>
            <td><?php echo $entry_debug; ?><br /><span class="help"><?php echo $help_debug ?></span></td>
            <td>
                <select name="arsenalpay_debug">
                    <?php if ($arsenalpay_debug) { ?>
                        <option value="1" selected="selected"><?php echo $text_yes ?></option>
                        <option value="0"><?php echo $text_no ?></option>
                    <?php } else { ?>
                        <option value="1"><?php echo $text_yes ?></option>
                        <option value="0" selected="selected"><?php echo $text_no ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="arsenalpay_status">
                <?php if ($arsenalpay_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="arsenalpay_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $arsenalpay_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><label for="arsenalpay_sort_order"><?php echo $entry_sort_order ?></label></td>
            <td><input type="text" name="arsenalpay_sort_order" value="<?php echo $arsenalpay_sort_order ?>" id="arsenalpay_sort_order"  size="1"/></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>