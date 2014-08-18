<?php
/**
 * @payment-module	ARS_Payment
 */
?>
<form action="<?php echo $action; ?>" method="POST">
<?php 
if($installments!=null)
{
?>	
	<div class="checkout-product" id="payment">
	  <table>
    <thead>
      <tr>
        <td id='text_installments_number'><?php echo $text_installments_number; ?></td>
        <td id='text_installment_amount'><?php echo $text_installment_amount; ?></td>
      </tr>
	   </thead>
	   <tbody>
		<tr>	
			<td id='installments'>
				<input type="radio" name="installment" value="<?php echo $installments[0]; ?>" checked="yes"><?php echo $installments[0]; ?>
				<?php
				for($i=1;$i<count($installments);$i++)
				{
				?>
				<br>
				<input type="radio" name="installment" value="<?php echo $installments[$i]; ?>"><?php echo $installments[$i]; ?>
				<?php
				}
				?>	
			</td>
			<td id='installment_amount'>
				
			</td>
		</tr>

	</tbody>		
		</table>
	</div>
<?php
}
?>	
	<div class="buttons">
		<div class="right">
			<input type="submit" value="<?php echo $button_confirm; ?>" class="button" />
		</div>
	</div>
</form>

<script>

	var rad = document.getElementsByName('installment');
    var prev = null;
    for(var i = 0; i < rad.length; i++)
	{
		if(rad[i].checked)
		{
			calcInstallment(rad[i]);
		}
        rad[i].onclick =function (){calcInstallment(this)};
	}
	
	function calcInstallment(radio)
	{
		var total=<?php echo $total; ?>;
		var installment=total;
		if(radio.value!=0 && radio.value!=1)
		{
			installment=total/radio.value;
		}
		document.getElementById('installment_amount').innerHTML=installment;
	};
	
</script>