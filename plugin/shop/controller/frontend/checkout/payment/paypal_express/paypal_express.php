<?php
class HomeCheckoutPaymentPaypalExpressController extends Controller{
	private $pluginCode;
	private $checkoutType;
	private $checkoutCode;
	private $checkoutSettingKey;
	
	function __construct(){
		include_once LIBRARY_PATH.'paypal_express/paypal.class.php';
		
		$this->pluginCode = CheckoutExt::getPluginCode();
		$this->checkoutType = 'payment';
		$this->checkoutCode = 'paypal_express';
		$this->checkoutSettingKey = "checkout_{$this->checkoutType}_{$this->checkoutCode}_";
	}
	
	public function getPaymentMethod(){
		$data = array(
			'mode'		=> CheckoutExt::getValue($this->checkoutSettingKey."mode", false),
			'api_username'		=> CheckoutExt::getValue($this->checkoutSettingKey."api_username", false),
			'api_password'		=> CheckoutExt::getValue($this->checkoutSettingKey."api_password", false),
			'api_signature'		=> CheckoutExt::getValue($this->checkoutSettingKey."api_signature", false),
			'currency_code'		=> CheckoutExt::getValue($this->checkoutSettingKey."currency_code", false),
		);
		$checkoutInfo = CheckoutExt::getCheckoutInfo($this->checkoutType, $this->checkoutCode);
		$method = array(
			'code'      => $this->checkoutCode,
			'name'		=> $checkoutInfo->checkoutName,
			'order'     => $checkoutInfo->order,
			'description'	=> CheckoutExt::getValue($this->checkoutSettingKey."description", false),
			'data'		=> $data
		);
		return $method;
	}
	
	private function getPaymentSetting(){
		$paymentSetting['mode'] = CheckoutExt::getValue($this->checkoutSettingKey."mode", false);
		$paymentSetting['api_username'] = CheckoutExt::getValue($this->checkoutSettingKey."api_username", false);
		$paymentSetting['api_password'] = CheckoutExt::getValue($this->checkoutSettingKey."api_password", false);
		$paymentSetting['api_signature'] = CheckoutExt::getValue($this->checkoutSettingKey."api_signature", false);
		$paymentSetting['currency_code'] = CheckoutExt::getValue($this->checkoutSettingKey."currency_code", false);
		$paymentSetting['return_url'] = URLHelper::getUrl('home/checkout/return_url');
		$paymentSetting['cancel_url'] = URLHelper::getUrl('home/checkout/cancel_url');
	
		return $paymentSetting;
	}
	
	/**
	 * get confirm orders form in last step (4)
	 */
	public function getConfirmOrders(){
		$confirmOrdersFile = PLUGIN_PATH."$this->pluginCode/view/frontend/checkout/$this->checkoutType/$this->checkoutCode/confirm_orders.php";
		FileHelper::loadFile($confirmOrdersFile);
	}
	
	/**
	 * check payment method before submit
	 */
	public function paymentCheck(){
		return true;
	}
	
	/**
	 * redirect to paypal url 
	 * get info of cart send to paypal
	 */
	public function paymentRequest(){
		//get $paymentSetting
		$paymentSetting = $this->getPaymentSetting();
		
		//getCartData from Session
		$cartInfo = ProductExt::getCartInfo();
		$subTotal = $cartInfo['subTotal'];
		
		//get $shippingPrice
		$shipping_mothod_code = CheckoutExt::getSession('shipping_mothod_code');
		$shippingPrice = CheckoutExt::callback('shipping', $shipping_mothod_code, 'getShippingPrice');
		
		//get $surcharge
		$params = array(
			'subTotal' => $subTotal,
			'shippingPrice' => $shippingPrice
		);
		$surcharge = CheckoutExt::getSurcharge($params);
		
		//get $total
		$total = $subTotal + $shippingPrice;
		foreach ($surcharge as $v){
			$total += $v['value'];
		}
		
		//Other important variables like tax, shipping cost
		//get $total_tax_amount			//Sum of tax for all items in this order.
		$total_tax_amount = 0;
		foreach($surcharge as $k => $v){
			if($v['code'] == 'tax'){
				$total_tax_amount = $v['value'];
			}
		}
		$handaling_cost 	= 0;  		//(skip)Handling cost for this order.
		$insurance_cost 	= 0;  		//(skip)shipping insurance cost for this order.
		$shipping_discount 	= 0;  		//(skip)Shipping discount for this order. Specify this as negative number.
		//get $shipping_cost 		  	//Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
		$shipping_cost 	= $shippingPrice;
		$paypal_data ='';
		
		$item = 0;
		foreach($cartInfo['productCart'] as $productId => $productCartAttribute){
			foreach ($productCartAttribute as $attributeValueId => $v){
				$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$item.'='.urlencode($v['productName']);
				//$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$item.'='.urlencode($v['productCode']);
				$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$item.'='.urlencode($v['productId']);
				$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$item.'='.urlencode($v['price']);
				$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$item.'='. urlencode($v['quantity']);
			
				//create items for session
				$paypal_product['items'][] = array(
					'itm_name' => $v['productName'],
					//'itm_code' => $v['productCode'],
					'itm_code' => $v['productId'],
					'itm_price' => $v['price'],
					'itm_qty' => $v['quantity']
				);
				
				$item++;
			}
		}
		
		$item_total_price = $cartInfo['subTotal'];
		
		//Grand total including all tax, insurance, shipping cost and discount
		$grand_total =($item_total_price + $total_tax_amount + $handaling_cost + $insurance_cost + $shipping_cost + $shipping_discount);
		
		$paypal_product['assets'] = array(
			'tax_total' => $total_tax_amount,
			'handaling_cost' => $handaling_cost,
			'insurance_cost' => $insurance_cost,
			'shipping_discount' => $shipping_discount,
			'shipping_cost' => $shipping_cost,
			'grand_total' => $grand_total
		);
			
		//create session array for later use
		CheckoutExt::setSession('paypal_product', $paypal_product);
// 		$_SESSION["paypal_product"] = $paypal_product;
		
		//Parameters for SetExpressCheckout, which will be sent to PayPal
		$padata = '&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($paymentSetting['return_url']).
				'&CANCELURL='.urlencode($paymentSetting['cancel_url']).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				$paypal_data.
				'&NOSHIPPING=0'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($item_total_price).
				'&PAYMENTREQUEST_0_TAXAMT='.urlencode($total_tax_amount).
				'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($shipping_cost).
				'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($handaling_cost).
				'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($shipping_discount).
				'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($insurance_cost).
				'&PAYMENTREQUEST_0_AMT='.urlencode($grand_total).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($paymentSetting['currency_code']).
				'&LOCALECODE=GB'. //PayPal pages to match the language on your website.
				'&LOGOIMG=http://www.sanwebe.com/wp-content/themes/sanwebe/img/logo.png'. //site logo
				'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
				'&ALLOWNOTE=1';
			
		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
		$paypal= new MyPayPal();
		$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata,
				$paymentSetting['api_username'], $paymentSetting['api_password'], $paymentSetting['api_signature'], $paymentSetting['mode']);
		
		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"])|| "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
			//Redirect user to PayPal store with Token received.
			$paypalMode =($paymentSetting['mode'] =='sandbox')? '.sandbox' : '';
			$paypalurl ='https://www'.$paypalMode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
			
			//set flag is redirect
			CheckoutExt::setSession('is_redirect', 1);
			
			header("location: $paypalurl");
		}
		else{
			//Show error message
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
		}
	}
	
	/**
	 * payment width paypal finish
	 * back to check out page update orders
	 * write info return to order_payment table
	 */
	public function paymentReturn(){
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
		if(isset($_GET["token"])&& isset($_GET["PayerID"])){
			//we will be using these two variables to execute the "DoExpressCheckoutPayment"
			//Note: we haven't received any payment yet.
			$token = $_GET["token"];
			$payer_id = $_GET["PayerID"];
			$paymentSetting = $this->getPaymentSetting();
				
			//get session variables
			$paypal_product = CheckoutExt::getSession('paypal_product');// $_SESSION["paypal_product"];
			$paypal_data = '';
			$item_total_price = 0;
				
			foreach($paypal_product['items'] as $key => $v){
				$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($v['itm_qty']);
				$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($v['itm_price']);
				$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($v['itm_name']);
				$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($v['itm_code']);
					
				// item price X quantity
				$subtotal = ($v['itm_price']*$v['itm_qty']);
					
				//total price
				$item_total_price = ($item_total_price + $subtotal);
			}
				
			$padata  = 	'&TOKEN='.urlencode($token).
			'&PAYERID='.urlencode($payer_id).
			'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
			$paypal_data.
			'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($item_total_price).
			'&PAYMENTREQUEST_0_TAXAMT='.urlencode($paypal_product['assets']['tax_total']).
			'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($paypal_product['assets']['shipping_cost']).
			'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($paypal_product['assets']['handaling_cost']).
			'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($paypal_product['assets']['shipping_discount']).
			'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($paypal_product['assets']['insurance_cost']).
			'&PAYMENTREQUEST_0_AMT='.urlencode($paypal_product['assets']['grand_total']).
			'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($paymentSetting['currency_code']);
				
			//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
			$paypal= new MyPayPal();
			$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata,
					$paymentSetting['api_username'], $paymentSetting['api_password'], $paymentSetting['api_signature'], $paymentSetting['mode']);
				
			//Check if everything went ok
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"])|| "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
				//1.	update to order_payment table
				$orderPaymentDao = new OrderPaymentDao();
				
				//get $orderId
				$orderId = CheckoutExt::getSession('orderId');
				
				//get $orderPaymentId
				$orderPaymentId = OrdersExt::getOrderPaymentId($orderId);
				
				//get $paymentData
				$paymentData = array();
				$paymentData['transactionId'] = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
				$paymentData['token'] = $_GET["token"];
				$paymentData['payerId'] = $_GET["PayerID"];
				
				//update order_payment
				$orderPaymentVo = new OrderPaymentVo();
				$orderPaymentVo->data = json_encode($paymentData); 
				$orderPaymentVo->status = $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"];	
				$orderPaymentDao->updateByPrimaryKey($orderPaymentVo, $orderPaymentId);
				
				//2. update checkout_done
				CheckoutExt::setSession('checkout_done', 1);
			}
			else{		//DoExpressCheckoutPayment false
				echo '<div style="color:red"><b>DoExpressCheckoutPayment Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
				echo '<pre>';
				print_r($httpParsedResponseAr);
				echo '</pre>';
			}
		}
	}
	
	/**
	 * paymentCancel not payment with paypal back to checkout page
	 * delete orders temp
	 */
	public function paymentCancel(){
		//1.	delete orders (temp)
		$orderId = CheckoutExt::getSession('orderId');
		OrdersExt::deleteOrders($orderId);
		
		//2.	update checkout_done
		CheckoutExt::setSession('checkout_done', 0);
	}
}