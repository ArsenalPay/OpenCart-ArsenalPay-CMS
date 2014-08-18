<?php
/**
 * @payment-module	ARS_Payment
 */
  
class ControllerPaymentARSPayment extends Controller
{
	private $error = array(); 

	public function index()
	{
	
		$this->load->language('payment/ARS_Payment');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
		{
			$this->model_setting_setting->editSetting('ARS_Payment', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['entry_token'] = $this->language->get('entry_token');
		$this->data['entry_src'] = $this->language->get('entry_src');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning']))
		{
			$this->data['error_warning'] = $this->error['warning'];
		}
		else
		{
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['token']))
		{
			$this->data['error_token'] = $this->error['token'];
		} else {
			$this->data['error_token'] = '';
		}
 		if (isset($this->error['src']))
		{
			$this->data['error_src'] = $this->error['src'];
		} else {
			$this->data['error_src'] = '';
		}
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		if (isset($this->request->post['ARS_Payment_status']))
		{
			$this->data['ARS_Payment_status'] = $this->request->post['ARS_Payment_status'];
		}
		else
		{
			$this->data['ARS_Payment_status'] = $this->config->get('ARS_Payment_status');
		}

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/ARS_Payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('payment/ARS_Payment', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ARS_Payment_token']))
		{
			$this->data['ARS_Payment_token'] = $this->request->post['ARS_Payment_token'];
		}
		else
		{
			$this->data['ARS_Payment_token'] = $this->config->get('ARS_Payment_token');
		}
		if (isset($this->request->post['ARS_Payment_src']))
		{
			$this->data['ARS_Payment_src'] = $this->request->post['ARS_Payment_src'];
		}
		else
		{
			$this->data['ARS_Payment_src'] = $this->config->get('ARS_Payment_src');
		}

		$this->template = 'payment/ARS_Payment.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
	}

	private function validate()
	{
		if (!$this->user->hasPermission('modify', 'payment/ARS_Payment'))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['ARS_Payment_token'])
		{
			$this->error['merchantcode'] = $this->language->get('error_merchantcode');
		}
		
		if (!$this->error)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	
	public function install()
	{
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "ARS_Payment (id INT(11) AUTO_INCREMENT, timestamp DATETIME, order_id INT(11), guid1 TEXT, guid2 TEXT, deltapayid TEXT, result TINYINT, message TEXT, charge DECIMAL(15,4), installments INT(11), currency_code INT(11), currency TEXT, PRIMARY KEY (id))");
	}
	
	public function uninstall()
	{
		$query = $this->db->query("DROP TABLE " . DB_PREFIX . "ARS_Payment");
	}
}
?>