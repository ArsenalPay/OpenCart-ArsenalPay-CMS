<?php 
/**
 * @payment-module	ARS_Payment
 */
 
class ModelPaymentArsPayment extends Model
{
  	public function getMethod($address, $total)
	{ 
		$this->load->language('payment/ARS_Payment');
		$method_data = array( 
								'code'       => 'ARS_Payment',
								'title'      => $this->language->get('text_title'),
								'sort_order' => $this->config->get('ARS_Payment_sort_order')
							);
   
    	return $method_data;
  	}
	function addTransaction($timestamp, $order_id, $guid1, $guid2, $charge, $installments, $currency_code, $currency)
	{
		return $this->db->query("INSERT INTO " . DB_PREFIX . "ARS_Payment (timestamp, order_id, guid1, guid2, deltapayid, result, message, charge, installments, currency_code, currency) VALUES (FROM_UNIXTIME(".$timestamp."), '".$order_id."', '".$guid1."', '".$guid2."', null, null, null, '".$charge."', '".$installments."', '".$currency_code."', '".$currency."')"); 
	}
	
	function updateTransactionStatus($order_id, $guid2, $deltapayid, $result, $message)
	{
		$query=$this->db->query("SELECT * FROM " . DB_PREFIX . "ARS_Payment WHERE (order_id='".$order_id."' AND guid2='".$guid2."')")->row;
		if(!empty($query))
		{
			$this->db->query("UPDATE " . DB_PREFIX . "ARS_Payment SET deltapayid='".$deltapayid."', result='".$result."', message='".$message."' WHERE (order_id='".$order_id."' AND guid2='".$guid2."')"); 
			return true;
		}
		else
		{
			return false;
		}

	}	
	
}
?>