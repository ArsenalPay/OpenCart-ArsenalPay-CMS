<?php
// Heading
$_['heading_title']      = 'Arsenal Pay';

// Text 
$_['text_payment']       = 'Payment';
$_['text_success']       = 'Settings of ArsenalPay have been successfully updated!';
$_['text_mk']            = 'mk';
$_['text_card']          = 'card';

// Entry
$_['entry_ap_token'] = 'Unique token';
//$_['entry_other_code'] = 'Other code';
$_['entry_key'] = 'Key';
$_['entry_ip'] = 'Allowed IP-address';
$_['entry_callback_url'] = 'Callback URL';
$_['entry_check_url'] = 'Check URL';
$_['entry_frame_url'] = 'Frame address';
$_['entry_frame_mode'] = 'Frame mode';
$_['entry_src'] = 'Payment type';
$_['entry_css'] = 'css parameter';
$_['entry_frame_params'] = 'Frame display parameters';
$_['entry_debug'] = 'Logs';
$_['entry_geo_zone'] = 'Geo Zone';
$_['entry_status'] = 'Status';
$_['entry_sort_order'] = 'Sort Order';

$_['entry_completed_status'] = 'Order Status for Confirmed transactions';
$_['entry_canceled_status'] = 'Order Status for Canceled transactions';
$_['entry_failed_status'] = 'Order Status for Failed transactions';
$_['entry_waiting_status']='Order Status for Pending transactions';

// Help
$_['help_ap_token'] = 'Assigned to merchant for access to ArsenalPay payment frame.';
//$_['help_other_code'] = 'Other number or code required for making payments. Not accessible for editing to the user and not displayed if it is set.';
$_['help_key'] = 'With this key you check a validity of sign that comes with callback payment data.';
$_['help_ip'] = 'It will be allowed to receive ArsenalPay payment confirmation callback requests only from the IP address pointed out here.';
$_['help_callback_url'] = 'For payment confirmation.';
$_['help_check_url'] = 'To check an order number before payment processing.';
$_['help_frame_url'] = 'URL-address of ArsenalPay payment frame.';
$_['help_src'] = '<b>mk</b> - payment from mobile phone account (mobile-commerce),</br><b>card</b> - card - payment from plastic card (internet acquiring).';
$_['help_frame_mode'] = '<b>1</b> will mean that payment page will be displayed in a frame inside your site,</br><b>0</b> - payer will be redirected to payment page.';
$_['help_css'] = 'URL of CSS file if exists.';
$_['help_frame_params'] = '';
$_['help_debug'] = '';

// Error
$_['error_permission'] = 'Error! You have no rightts to edit these settings.';
$_['error_ap_token'] = 'Field <b>Unique token</b> required to be filled out.';
$_['error_key'] = 'Field <b>Key</b> required to be filled out.';
$_['error_frame_url'] = 'Field <b>Frame address</b> can\'t be empty.';
