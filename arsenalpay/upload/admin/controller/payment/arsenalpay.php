<?php
class ControllerPaymentArsenalpay extends Controller 
{
    private $error = array();
    public function index() 
    {
        $this->load->language('payment/arsenalpay');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
        if( ( $this->request->server['REQUEST_METHOD'] == 'POST' ) && $this->validate() ) {
                $this->model_setting_setting->editSetting( 'arsenalpay', $this->request->post);
                $this->session->data['success'] = $this->language->get('text_success');
                $this->redirect( $this->url->link( 'extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
            }
        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_mk'] = $this->language->get('text_mk');
        $this->data['text_card'] = $this->language->get('text_card');
        $this->data['text_yes'] = $this->language->get('text_yes');
	$this->data['text_no'] = $this->language->get('text_no');
        
        $this->data['entry_ap_token'] = $this->language->get('entry_ap_token');
        $this->data['entry_other_code'] = $this->language->get('entry_other_code');
        $this->data['entry_key'] = $this->language->get('entry_key');
        $this->data['entry_ip'] = $this->language->get('entry_ip');
        $this->data['entry_callback_url'] = $this->language->get('entry_callback_url');
        $this->data['entry_check_url'] = $this->language->get('entry_check_url');
        $this->data['entry_frame_url'] = $this->language->get('entry_frame_url');
        $this->data['entry_src'] = $this->language->get('entry_src');
        $this->data['entry_frame_mode'] = $this->language->get('entry_frame_mode');
        $this->data['entry_frame_params'] = $this->language->get('entry_frame_params');
        $this->data['entry_css'] = $this->language->get('entry_css');
        $this->data['entry_debug'] = $this->language->get('entry_debug');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
	$this->data['entry_status'] = $this->language->get('entry_status');
	$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        
        $this->data['button_save'] = $this->language->get('button_save');
	$this->data['button_cancel'] = $this->language->get('button_cancel');
        
        $this->data['entry_completed_status'] = $this->language->get('entry_completed_status');
        $this->data['entry_canceled_status'] = $this->language->get('entry_canceled_status');
        $this->data['entry_failed_status'] = $this->language->get('entry_failed_status');
        $this->data['entry_waiting_status'] = $this->language->get('entry_waiting_status');
        
        $this->data['help_ap_token'] = $this->language->get('help_ap_token');
        $this->data['help_other_code'] = $this->language->get('help_other_code');
        $this->data['help_key'] = $this->language->get('help_key');
	$this->data['help_ip'] = $this->language->get('help_ip');
        $this->data['help_callback_url'] = $this->language->get('help_callback_url');
        $this->data['help_check_url'] = $this->language->get('help_check_url');
        $this->data['help_frame_url'] = $this->language->get('help_frame_url');
        $this->data['help_src'] = $this->language->get('help_src');
        $this->data['help_frame_mode'] = $this->language->get('help_frame_mode');
        $this->data['help_css'] = $this->language->get('help_css');
        $this->data['help_frame_params'] = $this->language->get('help_frame_params');
        $this->data['help_debug'] = $this->language->get('help_debug');
        
        if (isset($this->error['warning'])) {
                $this->data['error_warning'] = $this->error['warning'];
        } else {
                $this->data['error_warning'] = '';
        }
        
         if (isset($this->error['ap_token'])) {
                $this->data['error_ap_token'] = $this->error['ap_token'];
        } else {
                $this->data['error_ap_token'] = '';
        }
        
         if (isset($this->error['key'])) {
                $this->data['error_key'] = $this->error['key'];
        } else {
                $this->data['error_key'] = '';
        }
        
        if (isset($this->error['frame_url'])) {
                $this->data['error_frame_url'] = $this->error['frame_url'];
        } else {
                $this->data['error_frame_url'] = '';
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
                'href'      => $this->url->link('payment/arsenalpay', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
        );
        
        $this->data['action'] = $this->url->link('payment/arsenalpay', 'token=' . $this->session->data['token'], 'SSL');
	$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
        
        if (isset($this->request->post['arsenalpay_ap_token'])) {
                $this->data['arsenalpay_ap_token'] = $this->request->post['arsenalpay_ap_token'];
        } else {
                $this->data['arsenalpay_ap_token'] = $this->config->get('arsenalpay_ap_token');
        }
        
        if (isset($this->request->post['arsenalpay_other_code'])) {
                $this->data['arsenalpay_other_code'] = $this->request->post['arsenalpay_other_code'];
        } else {
                $this->data['arsenalpay_other_code'] = $this->config->get('arsenalpay_other_code');
        }
        
        if (isset($this->request->post['arsenalpay_key'])) {
                $this->data['arsenalpay_key'] = $this->request->post['arsenalpay_key'];
        } else {
                $this->data['arsenalpay_key'] = $this->config->get('arsenalpay_key');
        }
        
        if (isset($this->request->post['arsenalpay_css'])) {
                $this->data['arsenalpay_css'] = $this->request->post['arsenalpay_css'];
        } else {
                $this->data['arsenalpay_css'] = $this->config->get('arsenalpay_css');
        }
        
        if (isset($this->request->post['arsenalpay_ip'])) {
                $this->data['arsenalpay_ip'] = $this->request->post['arsenalpay_ip'];
        } else {
                $this->data['arsenalpay_ip'] = $this->config->get('arsenalpay_ip');
        }
        
        if (isset($this->request->post['arsenalpay_check_url'])) {
                $this->data['arsenalpay_check_url'] = $this->request->post['arsenalpay_check_url'];
        } else {
                $this->data['arsenalpay_check_url'] = $this->config->get('arsenalpay_check_url');
        }
        
        if (isset($this->request->post['arsenalpay_src'])) {
                $this->data['arsenalpay_src'] = $this->request->post['arsenalpay_src'];
        } else {
                $this->data['arsenalpay_src'] = $this->config->get('arsenalpay_src');
        }
        
        if (isset($this->request->post['arsenalpay_frame_url'])) {
                $this->data['arsenalpay_frame_url'] = $this->request->post['arsenalpay_frame_url'];
        } elseif ($this->config->get('arsenalpay_frame_url')) {
                $this->data['arsenalpay_frame_url'] = $this->config->get('arsenalpay_frame_url');
        } else {
                $this->data['arsenalpay_frame_url'] = 'https://arsenalpay.ru/payframe/pay.php';
        }

        if (isset($this->request->post['arsenalpay_frame_mode'])) {
                $this->data['arsenalpay_frame_mode'] = $this->request->post['arsenalpay_frame_mode'];
        } elseif ($this->config->get('arsenalpay_frame_mode')) {
                $this->data['arsenalpay_frame_mode'] = $this->config->get('arsenalpay_frame_mode');
        } else {
                $this->data['arsenalpay_frame_mode'] = '1';
        }
        
        if (isset($this->request->post['arsenalpay_frame_params'])) {
                $this->data['arsenalpay_frame_params'] = $this->request->post['arsenalpay_frame_params'];
        } elseif ($this->config->get('arsenalpay_frame_params')) {
                $this->data['arsenalpay_frame_params'] = $this->config->get('arsenalpay_frame_params');
        } else {
                $this->data['arsenalpay_frame_params'] = "width='750' height='750' frameborder='0' scrolling='auto'";
        }
        
        if (isset($this->request->post['arsenalpay_geo_zone_id'])) {
                $this->data['arsenalpay_geo_zone_id'] = $this->request->post['arsenalpay_geo_zone_id'];
        } else {
                $this->data['arsenalpay_geo_zone_id'] = $this->config->get('arsenalpay_geo_zone_id'); 
        } 

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['arsenalpay_status'])) {
                $this->data['arsenalpay_status'] = $this->request->post['arsenalpay_status'];
        } else {
                $this->data['arsenalpay_status'] = $this->config->get('arsenalpay_status');
        }

        if (isset($this->request->post['arsenalpay_sort_order'])) {
                $this->data['arsenalpay_sort_order'] = $this->request->post['arsenalpay_sort_order'];
        } elseif ($this->config->get('arsenalpay_sort_order')) {
                $this->data['arsenalpay_sort_order'] = $this->config->get('arsenalpay_sort_order');
        } else {
                $this->data['arsenalpay_sort_order'] = '0';
        }
        
        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['arsenalpay_completed_status_id'])) {
                $this->data['arsenalpay_completed_status_id'] = $this->request->post['arsenalpay_completed_status_id'];
        } else {
                $this->data['arsenalpay_completed_status_id'] = $this->config->get('arsenalpay_completed_status_id');
        }
        
        if (isset($this->request->post['arsenalpay_canceled_status_id'])) {
                $this->data['arsenalpay_canceled_status_id'] = $this->request->post['arsenalpay_canceled_status_id'];
        } else {
                $this->data['arsenalpay_canceled_status_id'] = $this->config->get('arsenalpay_canceled_status_id');
        }
        
        if (isset($this->request->post['arsenalpay_failed_status_id'])) {
                $this->data['arsenalpay_failed_status_id'] = $this->request->post['arsenalpay_failed_status_id'];
        } else {
                $this->data['arsenalpay_failed_status_id'] = $this->config->get('arsenalpay_failed_status_id');
        }
        
        if (isset($this->request->post['arsenalpay_waiting_status_id'])) {
                $this->data['arsenalpay_waiting_status_id'] = $this->request->post['arsenalpay_waiting_status_id'];
        } else {
                $this->data['arsenalpay_waiting_status_id'] = $this->config->get('arsenalpay_waiting_status_id');
        }
        
        if (isset($this->request->post['arsenalpay_debug'])) {
                $this->data['arsenalpay_debug'] = $this->request->post['arsenalpay_debug'];
        } else {
                $this->data['arsenalpay_debug'] = $this->config->get('arsenalpay_debug');
        }
       // $this->data['cancel_url'] = HTTPS_CATALOG . 'index.php?route=payment/arsenalpay/ap_cancel';
       // $this->data['error_url'] = HTTPS_CATALOG . 'index.php?route=payment/arsenalpay/ap_error';
       // $this->data['return_url'] = HTTPS_CATALOG . 'index.php?route=payment/arsenalpay/ap_return';
        $this->data['callback_url'] = HTTPS_CATALOG . 'index.php?route=payment/arsenalpay/ap_callback';
        
        $this->template = 'payment/arsenalpay.tpl';
        $this->children = array(
                'common/header',
                'common/footer'
        );

        $this->response->setOutput($this->render());
        
    }
    
    protected function validate() 
    {
        if (!$this->user->hasPermission('modify', 'payment/arsenalpay')) {
                $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!$this->request->post['arsenalpay_ap_token']) {
                $this->error['ap_token'] = $this->language->get('error_ap_token');
        }
        if (!$this->request->post['arsenalpay_key']) {
                $this->error['key'] = $this->language->get('error_key');
        }
        if (!$this->request->post['arsenalpay_frame_url']) {
                $this->error['frame_url'] = $this->language->get('error_frame_url');
        }
        if (!$this->error) {
                return true;
        } else {
		return false;
        }
        
    }
}



