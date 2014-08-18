<?php 
/**
 * @payment-module	ARS_Payment
 */

class ControllerPaymentARSPayment extends Controller
{
	protected function index()
	{
    	$this->language->load('payment/ARS_Payment');
		$this->load->model('payment/ARS_Payment');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$this->data['text_installments_number'] = $this->language->get('text_installments_number');
		$this->data['text_installment_amount'] = $this->language->get('text_installment_amount');
		$this->data['total'] = $order_info['total'];
		$installments=null;		
		$ARS_Payment_installments=$this->config->get('ARS_Payment_installments');
		if($ARS_Payment_installments!='')
		{
			$i=0;
			foreach (explode(' ', $ARS_Payment_installments) as $value)
			{
				if(is_numeric($value))
				{
					$installments[$i]=$value;
					$i++;
				}
			}
			
		}
		
		 
		$this->data['installments'] =$installments;
		
		$this->data['action'] = 'index.php?route=payment/ARS_Payment/redirection';
		$this->data['button_confirm'] = $this->language->get('button_confirm');

		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ARS_Payment.tpl'))
		{
			$this->template = $this->config->get('config_template') . '/template/payment/ARS_Payment.tpl';
		}
		else
		{
			$this->template = 'default/template/payment/ARS_Payment.tpl';
		}	
		
		$this->render();		
	}

	public function redirection()
	{		
		$this->language->load('payment/ARS_Payment');
		$this->load->model('checkout/order');
		$this->load->model('payment/ARS_Payment');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$this->data['message'] = $this->language->get('text_server_success');
		$this->data['message_info'] = $this->language->get('text_server_success_info');
		
		$this->document->setTitle($this->data['message']); 		
	    $this->data['heading_title'] = $this->data['message'];
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ARS_Payment_message.tpl'))
		{
			$this->template = $this->config->get('config_template') . '/template/payment/ARS_Payment_message.tpl';
		}
		else
		{
			$this->template = 'default/template/payment/ARS_Payment_message.tpl';
		}	
		
		$this->children = array(
								'common/column_left',
								'common/column_right',
								'common/content_top',
								'common/content_bottom',
								'common/footer',
								'common/header'	
							);
		$this->data['arsenal_token'] = $this->config->get('ARS_Payment_token');
		$this->data['arsenal_src'] = $this->config->get('ARS_Payment_src');
		$this->data['order'] = $order_info;
		
		$this->response->setOutput($this->render()); 

	}
	
	public function callback()
	{

	}
}
?>