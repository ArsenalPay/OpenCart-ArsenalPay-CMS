<?php
$summ = 0;
if($order['currency_code']=='RUB')
{
	$summ = ceil($order['total']);
}
?>
<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
<div class="breadcrumb"></div>
<iframe src="https://arsenalpay.ru/payframe/pay.php?src=<?=$arsenal_src?>&t=<?=$arsenal_token?>&n=<?=$order['order_id']?>&а=<?=$summ?>&msisdn=<?=$order['telephone']?>" width="500" height="500"></iframe>
<?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>
