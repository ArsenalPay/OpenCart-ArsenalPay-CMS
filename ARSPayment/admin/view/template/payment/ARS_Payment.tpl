<?php
/**
 * @payment-module	ARS_Payment
 */
?>
<?php echo $header; ?>
<div id="content">
	<div class="breadcrumb">
	<?php 
	foreach ($breadcrumbs as $breadcrumb)
	{
	?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php
	}
	?>
	</div>
	<?php
	if ($error_warning)
	{
	?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php
	}?>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
			<div class="buttons">
				<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
				<table class="form">
					<tr>
						<td><span class="required">*</span> <?php echo $entry_token; ?></td>
						<td><input type="text" name="ARS_Payment_token" value="<?php echo $ARS_Payment_token; ?>" />
						<?php
						if ($error_token)
						{
						?>
						<span class="error"><?php echo $error_token; ?></span>
						<?php
						}
						?>
						</td>
					</tr>
					<tr>
						<td><span class="required">*</span> <?php echo $entry_src; ?></td>
						<td><input type="text" name="ARS_Payment_src" value="<?php echo $ARS_Payment_src; ?>" />
						<?php
						if ($error_src)
						{
						?>
						<span class="error"><?php echo $error_src; ?></span>
						<?php
						}
						?>
						</td>
					</tr>
					<tr>
						<td><?php echo $entry_status; ?></td>
						<td>
							<select name="ARS_Payment_status">
								<?php
								if ($ARS_Payment_status)
								{
								?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php
								}
								else
								{
								?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php echo $footer; ?>