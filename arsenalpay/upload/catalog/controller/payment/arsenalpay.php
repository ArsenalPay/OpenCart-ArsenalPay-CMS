<?php
class ControllerPaymentArsenalpay extends Controller { 
        protected function index() {
                $this->language->load('payment/arsenalpay');
                $this->load->model('checkout/order');
                $order_id = $this->session->data['order_id'];
                $order_info = $this->model_checkout_order->getOrder($order_id);
                $summ = $this->currency->format($order_info['total'], $order_info['currency_code'], false, false);
                $format_summ = number_format($summ, 2, '.', '');
                
                $url_params = array(
                    'src' => $this->config->get('arsenalpay_src'),
                    't' => $this->config->get('arsenalpay_ap_token'),
                    'n' => $order_id,
                    'a' => $format_summ,
                    'msisdn'=> $order_info['telephone'],
                    'css' => $this->config->get('arsenalpay_css'),
                    'frame' => $this->config->get('arsenalpay_frame_mode'),
                );
                $this->data['iframe_url'] = $this->config->get('arsenalpay_frame_url') . '?' .http_build_query($url_params, '', '&');
		$this->data['button_confirm'] = $this->language->get('button_confirm');
                $this->data['iframe_params'] = $this->config->get('arsenalpay_frame_params');


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/arsenalpay_iframe.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/arsenalpay_iframe.tpl';
                        
		} else {
			$this->template = 'default/template/payment/arsenalpay_iframe.tpl';
		}	

		$this->render(); 
	}
        
        public function ap_callback() {
            $this->load->model('payment/arsenalpay');
            $REMOTE_ADDR = $_SERVER["REMOTE_ADDR"];
            $IP_ALLOW = $this->config->get('arsenalpay_ip');
            if( strlen( $IP_ALLOW ) > 0 && $IP_ALLOW != $REMOTE_ADDR ) 
            {
                $this->exitf( 'ERR_IP' );

            }
            $this->load->model('checkout/order');
            $ap_order_id = $this->request->post['ACCOUNT'];
            if ($order_info = $this->model_checkout_order->getOrder($ap_order_id))
            {
                 $this->model_checkout_order->confirm($ap_order_id, $this->config->get('config_order_status_id'));
            }
            if( !$order_info || empty($order_info) )
            {
                if( $this->request->post['FUNCTION']=="check" )
                {
                    $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_failed_status_id'), 'Payment failed', true);
                    $this->exitf( 'NO' );
                }
                $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_failed_status_id'), 'Payment failed', true);
                $this->exitf( "ERR_ACCOUNT" );
            }
           
            $keyArray = array
            (
                'ID',           /* �?дентификатор ТСП/ merchant identifier */
                'FUNCTION',     /* Тип запроса/ type of request to which the response is received*/
                'RRN',          /* �?дентификатор транзакции/ transaction identifier */
                'PAYER',        /* �?дентификатор плательщика/ payer(customer) identifier */
                'AMOUNT',       /* Сумма платежа/ payment amount */
                'ACCOUNT',      /* Номер получателя платежа (номер заказа, номер ЛС) на стороне ТСП/ order number */
                'STATUS',       /* Статус платежа - check - запрос на проверку номера получателя : payment - запрос на передачу статуса платежа
                /* Payment status. When 'check' - response for the order number checking, when 'payment' - response for status change.*/
                'DATETIME',     /* Дата и время в формате ISO-8601 (YYYY-MM-DDThh:mm:ss±hh:mm), УРЛ-кодированное */
                /* Date and time in ISO-8601 format, urlencoded.*/
                'SIGN',         /* Подпись запроса/ response sign.
                 //* = md5(md5(ID).md(FUNCTION).md5(RRN).md5(PAYER).md5(AMOUNT).md5(ACCOUNT).md(STATUS).md5(PASSWORD)) */       
            ); 
            /**
            * Checking the absence of each parameter in the post request.
            * Проверка на присутствие каждого из параметров и их значений в передаваемом запросе. 
            */ 
            $post_msg = "";
            foreach( $keyArray as $key ) 
            {
                if( empty( $this->request->post[$key] ) || !array_key_exists( $key, $this->request->post ) )
                {
                    $this->exitf( 'ERR_'.$key );
                }
                else 
                {
                    if ($this->config->get('arsenalpay_debug') ) 
                    {
                        $post_msg= $post_msg. "" . $key . "=" . $this->request->post[$key] . "&" ;
                    }   
                }
               
            }
            $this->log($post_msg);


            $KEY = $this->config->get('arsenalpay_key');
            if( $order_info['total']!= $this->request->post['AMOUNT'])
            {
                $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_failed_status_id'), 'Payment failed', true);
                $this->exitf( "ERR_AMOUNT" );
            }
                   
            //======================================
            /**
            * Checking validness of the request sign.
            */
            if( !( $this->_checkSign( $this->request->post, $KEY) ) ) 
            {
                //============== For testing, delete after testing =============================
                  $S=md5(md5($this->request->post['ID']).
                            md5($this->request->post['FUNCTION']).md5($this->request->post['RRN']).
                          md5($this->request->post['PAYER']).md5($this->request->post['AMOUNT']).md5($this->request->post['ACCOUNT']).
                           md5($this->request->post['STATUS']).md5($KEY) );
                  echo $S.'</br>';
                //======================================
                $this->exitf( 'ERR_INVALID_SIGN' );

            }
            
            if( $this->request->post['FUNCTION'] == "check" )
                {
                    // Check account
                    /*
                            Here is account check procedure
                            Result:
                            YES - account exists
                            NO - account not exists
                    */
                    $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_waiting_status_id'), 'Payment waiting', true);
                    
                    $this->exitf( 'YES' );
                } 
                elseif( ( $this->request->post['FUNCTION']=="payment" ) && ( $this->request->post['STATUS'] === "payment" ) )
                {
                    // Payment callback
                    /*
                            Here is callback payment saving procedure
                            Result:
                            OK - success saving
                            ERR - error saving*/
                   
                    $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_completed_status_id'), 'Payment completed', true);
                    $this->exitf('OK');  
                }
                elseif( ( $this->request->post['FUNCTION']=="payment" ) && ( $this->request->post['STATUS'] === "cancelinit" ) ) 
                {
                    $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_canceled_status_id'), 'Payment canceled', true);
                    $this->exitf('ERR');
                    
                }
                else 
                {   
                    $this->model_checkout_order->update($ap_order_id, $this->config->get('arsenalpay_failed_status_id'), 'Payment failed', true);
                    $this->exitf('ERR');
                }
        }

	private function _checkSign( $ars_callback, $pass)
        {
            $validSign = ( $ars_callback['SIGN'] === md5(md5($ars_callback['ID']).
                    md5($ars_callback['FUNCTION']).md5($ars_callback['RRN']).
                    md5($ars_callback['PAYER']).md5($ars_callback['AMOUNT']).md5($ars_callback['ACCOUNT']).
                    md5($ars_callback['STATUS']).md5($pass) ) )? true : false;
            return $validSign; 
        }
        
        public function exitf($msg)
        { 
            $this->log($msg); 
            echo $msg;
            die;
        }
        public function log($message) {
            if ($this->config->get('arsenalpay_debug')) {
                $log = new Log('arsenalpay.log');
                $log->write($message);
            }
        }
}
?>
           

