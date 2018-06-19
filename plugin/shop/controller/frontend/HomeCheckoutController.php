<?php
class HomeCheckoutController extends Controller{
	public $ordersModel;
	private $ordersDao;
	private $pluginCode;
	
	public function __construct(){
        $this->ordersModel = new OrdersModel();
        $this->ordersDao = new OrdersDao();
        
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
	}
	
	/**
	 * ***
	 * OK
	 */
	public function checkout(){
		//get customerInfo and customerAddress (shipping address detail)
		$customerInfo = null;
        $customerAddressList = null;
		if(Session::isCustomerLogin()){
			$customerId = Session::getCustomerId();
			$customerInfo = CustomerExt::getCustomerInfo($customerId);
            $customerAddressList = CustomerExt::getCustomerAddressList($customerId);
			
			//set checkout_by_guest session
			CheckoutExt::setSession('checkout_by_guest', 0);
		}
		else{
			//set checkout_by_guest session
			CheckoutExt::setSession('checkout_by_guest', 1);
		}

        $cartInfo = ProductExt::getCartInfo();
		
		//send data
		$this->setAttributes(array(
			'customerInfo' => $customerInfo,
			'customerAddressList' => $customerAddressList,
			'cityList' => AddressHelper::getAllCity(242),
            'cartInfo' => $cartInfo,
		));
		
		//submit
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
            CheckoutExt::checkoutSubmit();
			return $this->setRender('done');
		}
		
		// set view
		return $this->setRender('success');
	}
	
	public function checkoutDone(){
		// set view
		return $this->setRender('success');
	}
	
	/**
	 * OK
	 * insertOrders (if cancel payment when delete orders this)
	 * 1.	new orders
	 * 2.	new OrderProduct
	 * 3.	new OrderShipping
	 * 4.	new OrderPayment
	 * 5.	new OrderSurcharge
	 * 6.	update amount's products
	 * 7.	new omment's order_history if orders Failed(4)
	 */
	private function insertOrder($cartInfo, $shippingPrice, $surcharge, $total){
		$orderProductDao = new OrderProductDao();
		$orderShippingDao = new OrderShippingDao();
		$orderPaymentDao = new OrderPaymentDao();
		$orderSurchargeDao = new OrderSurchargeDao();
		$orderHistoryDao = new OrderHistoryDao();
		$customerAddressDao = new CustomerAddressDao();
		
		//check $cartInfo
		$subTotal = $cartInfo['subTotal'];
		if($subTotal == 0){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Orders is empty');
			return $this->setRender('home');
		}
		
		//1.	new CustomerAddress for orders (customerId 0)
		//1.1	get address data from session
		$sCountryId = CheckoutExt::getSession('sCountryId');
		$sStateId = CheckoutExt::getSession('sStateId');
		$sCityId = CheckoutExt::getSession('sCityId');
		$sDistrictId = CheckoutExt::getSession('sDistrictId');
		$sPostCode = CheckoutExt::getSession('sPostCode');
		$sAddress = CheckoutExt::getSession('sAddress');
		//1.2	insert new CustomerAddress for shippingAddress
		$customerAddressVo = new CustomerAddressVo();
		$customerAddressVo->customerId = 0;
		$customerAddressVo->title = $sAddress;
		$customerAddressVo->countryId = $sCountryId;
		$customerAddressVo->stateId = $sStateId;
		$customerAddressVo->cityId = $sCityId;
		$customerAddressVo->districtId = $sDistrictId;
		$customerAddressVo->postCode = $sPostCode;
		$customerAddressVo->address = $sAddress;
		$customerAddressVo->defaultShipping = 0;
		$customerAddressVo->defaultBilling = 0;
		$addressShippingId = $customerAddressDao->insert($customerAddressVo);
		//1.3 check $sameAddress (new $addressBillingId)
		$sameAddress = CheckoutExt::getSession('sameAddress');
		if(!$sameAddress){
			$rCountryId = CheckoutExt::getSession('rCountryId');
			$rStateId = CheckoutExt::getSession('rStateId');
			$rCityId = CheckoutExt::getSession('rCityId');
			$rDistrictId = CheckoutExt::getSession('rDistrictId');
			$rPostCode = CheckoutExt::getSession('rPostCode');
			$rAddress = CheckoutExt::getSession('rAddress');
			
			$customerAddressVo = new CustomerAddressVo();
			$customerAddressVo->customerId = 0;
			$customerAddressVo->title = $rAddress;
			$customerAddressVo->countryId = $rCountryId;
			$customerAddressVo->stateId = $rStateId;
			$customerAddressVo->cityId = $rCityId;
			$customerAddressVo->districtId = $rDistrictId;
			$customerAddressVo->postCode = $rPostCode;
			$customerAddressVo->address = $rAddress;
			$customerAddressVo->defaultShipping = 0;
			$customerAddressVo->defaultBilling = 0;
			$addressBillingId = $customerAddressDao->insert($customerAddressVo);
		}
		
		//2. 	if $checkout_by_guest add a customer with roleId = 1
		$checkout_by_guest = CheckoutExt::getSession('checkout_by_guest');
		if($checkout_by_guest){
			$customerDao = new CustomerDao();
			$customerDetailDao = new CustomerDetailDao();
			$customerVo = new CustomerVo();
			$customerVo->roleId = 1;
			$customerVo->email = CheckoutExt::getSession('guest_email');
			$guestId = $customerDao->insert($customerVo);
			
			$customerDetailVo = new CustomerDetailVo();
			$customerDetailVo->customerId = $guestId;
			$customerDetailVo->firstName 	= CheckoutExt::getSession('guest_name');
			$customerDetailVo->lastName 	= '';
			$customerDetailVo->phone 		= CheckoutExt::getSession('guest_phone');
			$customerDetailVo->phone 		= CheckoutExt::getSession('guest_phone');
			$customerDetailDao->insert($customerDetailVo);
			
			CheckoutExt::setSession('guestId', $guestId);
		}
		
		//create order before, update paymentId and shippingId after ()
		$ordersVo = new OrdersVo();
		CTTHelper::copyProperties($this->ordersModel, $ordersVo);
		if($checkout_by_guest){
			$ordersVo->customerId = 0;
			$ordersVo->guestId = CheckoutExt::getSession('guestId');
		}
		else{
			$ordersVo->customerId = Session::isCustomerLogin();
			$ordersVo->guestId = 0;
		}
		$ordersVo->subtotal = $subTotal;
		$ordersVo->total = $total;
		$ordersVo->shippingAddressId = $addressShippingId;
		$ordersVo->sameAddress = $sameAddress;
		if($sameAddress){
			$ordersVo->billingAddressId = $addressShippingId;
		}
		else{
			$ordersVo->billingAddressId = $addressBillingId;
		}
		$ordersVo->orderStatusId = 1;
		$ordersVo->isDel = 0;
		$ordersVo->crtBy = (Session::isCustomerLogin())? Session::getCustomerId(): 0;
		$ordersVo->crtDate = DateHelper::getDateTime();
		if(Session::isCustomerLogin()){
			$customerId = Session::getCustomerId();
			$ordersCount = CustomerExt::getOrderCount($customerId);
			$ordersVo->no = $ordersCount++;
		}
		else{
			$ordersVo->no = 0;
		}
		$ordersVo->note = $_REQUEST['note'];
		$orderId = $this->ordersDao->insert($ordersVo);
		
		//orderProduct
		$orderProductVo = new OrderProductVo();
		$productCart = $cartInfo['productCart'];
		foreach($productCart as $productCartAttribute){
			foreach ($productCartAttribute as $v){
				$orderProductVo->orderId = $orderId;
				$orderProductVo->productId = $v['productId'];
				$orderProductVo->attributeValueId = $v['attributeValueId'];
				$orderProductVo->price = $v['price'];
				$orderProductVo->quantity = $v['quantity'];
				$orderProductDao->insert($orderProductVo);
			}
		}
			
		//orderShipping
		$orderShippingVo = new OrderShippingVo();
		$orderShippingVo->orderId = $orderId;
		$orderShippingVo->code = CheckoutExt::getSession('shipping_mothod_code');
		$orderShippingVo->name = CheckoutExt::getShippingName($orderShippingVo->code);
		$orderShippingVo->data = json_encode(array());
		$orderShippingVo->value = $shippingPrice;
		$orderShippingVo->status = 'Pending';
		$orderShippingDao->insert($orderShippingVo);
		
		//orderPayment
		$orderPaymentVo = new OrderPaymentVo();
		$orderPaymentVo->orderId = $orderId;
		$orderPaymentVo->code = CheckoutExt::getSession('payment_mothod_code');
		$orderPaymentVo->name = CheckoutExt::getPaymentName($orderPaymentVo->code);
		$orderPaymentVo->data = json_encode(array());
		$orderPaymentVo->status = 'Pending';
		$orderPaymentDao->insert($orderPaymentVo);
		
		//orderSurcharge
		foreach($surcharge as $v){
			$orderSurchargeVo = new OrderSurchargeVo();
			$orderSurchargeVo->orderId = $orderId;
			$orderSurchargeVo->code = $v['code'];
			$orderSurchargeVo->name = CheckoutExt::getSurchargeName($orderSurchargeVo->code);
			$orderSurchargeVo->value = $v['value'];
			$orderSurchargeDao->insert($orderSurchargeVo);
		}
		
		//update amount's product and status of orders if quantity's product < 0
		$isError = false;
		$comment = array();
		$productDao = new ProductDao();
		foreach($productCart as $productCartAttribute){
			foreach ($productCartAttribute as $v){
				$productId = $v['productId'];
				$productInfo = $productDao->selectByPrimaryKey($productId);
				$amount = $productInfo->amount - $v['quantity'];
				//set orders is Failed(4)
				if($amount < 0){
					//update order_status
					if(!$isError){
						$ordersVo = new OrdersVo();
						$ordersVo->orderStatusId = 4;	//hardcode
						$this->ordersDao->updateByPrimaryKey($ordersVo, $orderId);
					}
					
					//update order_history
					$comment[$productId] = "Product <a href='index.php?r=admin/product/edit&productId=$productId' title='View detail' target='blank'><b>{$productInfo->name}</b></a> have amount = <b class='red'>$amount</b>";
					$isError = true;
				}
				
				//update product
				$productVo = new ProductVo();
				$productVo->amount = $amount;
				$productDao->updateByPrimaryKey($productVo, $productId);
			}
		}
		
		if($isError){
			$orderHistoryVo = new OrderHistoryVo();
			$orderHistoryVo->orderId = $orderId;
			$orderHistoryVo->comment = join('<br>', $comment);
			$orderHistoryVo->crtDate = DateHelper::getDateTime();
			$orderHistoryDao->insert($orderHistoryVo);
		}
		
		//set session
		CheckoutExt::setSession('orderId', $orderId);
	}
	
	/**
	 * OK
	 * checkout_ajax
	 * case	select_shipping_address
	 * case	select_billing_address
	 * case	select_shipping_method
	 * case select_payment_method
	 */
	public function checkoutAjax(){
		$action = $_REQUEST['action'];
		switch($action){
			case 'checkout_by_guest':
				//set checkout_by_guest session
				CheckoutExt::setSession('checkout_by_guest', 1);
				
				//next step
				CheckoutExt::setCheckoutStep(2);
				CheckoutExt::setSession('checkout_done', 0);
				break;
			case 'select_shipping_address':
				//get data
				$customerAddressId = $_REQUEST['customerAddressId'];
				$customerAddressInfo = CustomerExt::getCustomerAddressInfo($customerAddressId);
				
				//set session
				CheckoutExt::setSession('shipping_address_id', $customerAddressId);
				
				//view
				$input = array(
					'country' => array('id' => 'sCountry', 'name' => 'sCountryId',
							'value' => $customerAddressInfo->countryId, 
							'attr' => array(), 'class' => ''),
					'state' => array('id' => 'sState', 'name' => 'sStateId',
							'value' => $customerAddressInfo->stateId, 
							'attr' => array(), 'class' => ''),
					'city' => array('id' => 'sCity', 'name' => 'sCityId',
							'value' => $customerAddressInfo->cityId, 
							'attr' => array(), 'class' => ''),
					'district' => array('id' => 'sDistrict', 'name' => 'sDistrictId',
							'value' => $customerAddressInfo->districtId, 
							'attr' => array(), 'class' => ''),
				);
				TemplateHelper::getTemplate('common/address_ajax/list.php', $input);
				TemplateHelper::getTemplate('common/input/text_row.php', array(
					'value' => $customerAddressInfo->postCode,
					'rows' => '2',
					'label' => e('Post code'),
					'name' => 'sPostCode',
					'attr' => array(), 'class' => ''
				));
				TemplateHelper::getTemplate('common/input/text_row.php', array(
					'value' => $customerAddressInfo->address,
					'required' => true, 
					'rows' => '2',
					'label' => e('Address'),
					'name' => 'sAddress',
					'attr' => array(), 'class' => ''
				));
				break;
			case 'select_billing_address':
				//get data
				$customerAddressId = $_REQUEST['customerAddressId'];
				$customerAddressInfo = CustomerExt::getCustomerAddressInfo($customerAddressId);
			
				//set session
				CheckoutExt::setSession('billing_address_id', $customerAddressId);
				
				//view
				$input = array(
					'country' => array('id' => 'rCountry', 'name' => 'rCountryId',
							'value' => $customerAddressInfo->countryId,
							'attr' => array(), 'class' => ''),
					'state' => array('id' => 'rState', 'name' => 'rStateId',
							'value' => $customerAddressInfo->stateId,
							'attr' => array(), 'class' => ''),
					'city' => array('id' => 'rCity', 'name' => 'rCityId',
							'value' => $customerAddressInfo->cityId,
							'attr' => array(), 'class' => ''),
					'district' => array('id' => 'rDistrict', 'name' => 'rDistrictId',
							'value' => $customerAddressInfo->districtId,
							'attr' => array(), 'class' => ''),
				);
				TemplateHelper::getTemplate('common/address_ajax/list.php', $input);
				TemplateHelper::getTemplate('common/input/text_row.php', array(
					'value' => $customerAddressInfo->postCode,
					'rows' => '2',
					'label' => e('Post code'),
					'name' => 'rPostCode',
					'attr' => array(), 'class' => ''
				));
				TemplateHelper::getTemplate('common/input/text_row.php', array(
					'value' => $customerAddressInfo->address,
					'required' => true, 
					'rows' => '2',
					'label' => e('Address'),
					'name' => 'rAddress',
					'attr' => array(), 'class' => ''
				));
				break;
			case 'select_shipping_method':
				//get data
				$shippingMethodCode = $_REQUEST['shippingMethodCode'];
				
				//getForm callback
				CheckoutExt::callback('shipping', $shippingMethodCode, 'getView');
					
				//set session
				CheckoutExt::setSession('shipping_mothod_code', $shippingMethodCode);
				break;
				
			case 'select_payment_method':
				//get data
				$paymentMethodCode = $_REQUEST['paymentMethodCode'];
			
				//getForm callback
				CheckoutExt::callback('payment', $paymentMethodCode, 'getView');
					
				//set session
				CheckoutExt::setSession('payment_mothod_code', $paymentMethodCode);
				break;
			case 'select_credit_card':
				//get data
				$currentYear = DateHelper::getCurentYear();
				
				//view
				$settingForm = array(
					'number'	=> array('label' => 'Card number', 'attr' => array('maxlength' => 16),
						'addElement' => '<ul class="payment-cc-icons">
						<li class="payment-card-visa"></li>
						<li class="payment-card-discover"></li>
						<li class="payment-card-master"></li>
						<li class="payment-card-amex"></li>
					</ul>'),
					'expiration_month'		=> array('type' => 'select', 'row_class' => 'col-md-6 no_padding',
							'options' => ArrayHelper::getKeyValue(1, 12), 'value' => $_REQUEST['expiration_month']),
					'expiration_year'		=> array('type' => 'select', 'row_class' => 'col-md-6 no_padding',
							'options' => ArrayHelper::getKeyValue($currentYear, $currentYear+10), 'value' => $_REQUEST['expiration_year']),
					'code'	=> array('label' => 'Security Code'),
				);
				$settingAll = array(
					'required' => true,
					'rows' => 2,
				);
				
				//render setting from
				TemplateHelper::renderForm($settingForm, array(), $settingAll);
				break;
		}
		
		//view
		return $this->setRender('success');
	}
	
	/**
	 * OK
	 * checkoutStep2
	 * 1. 	update customer detail
	 * 2. 	add address if customer select new address checkbox
	 * 3. 	next step
	 */
	private function checkoutStep2(){
		$customerDetailDao = new CustomerDetailDao();
		$customerAddressDao = new CustomerAddressDao();
		
		$newShippingAddress = $_REQUEST['newShippingAddress'];
		$addressShippingId = $_REQUEST['addressShippingId'];
		$sCountryId = ($_REQUEST['sCountryId']) ? $_REQUEST['sCountryId'] : 0;
		$sStateId = ($_REQUEST['sStateId']) ? $_REQUEST['sStateId'] : 0;
		$sCityId = ($_REQUEST['sCityId']) ? $_REQUEST['sCityId'] : 0;
		$sDistrictId = ($_REQUEST['sDistrictId']) ? $_REQUEST['sDistrictId'] : 0;
		$sPostCode = $_REQUEST['sPostCode'];
		$sAddress = $_REQUEST['sAddress'];
		//update address session
		CheckoutExt::setSession('sCountryId', $sCountryId);
		CheckoutExt::setSession('sStateId', $sStateId);
		CheckoutExt::setSession('sCityId', $sCityId);
		CheckoutExt::setSession('sDistrictId', $sDistrictId);
		CheckoutExt::setSession('sPostCode', $sPostCode);
		CheckoutExt::setSession('sAddress', $sAddress);
		
		$sameAddress = ($_REQUEST['sameAddress']) ? 1 : 0;
		$newBillingAddress = $_REQUEST['newBillingAddress'];
		$addressBillingId = $_REQUEST['addressBillingId'];
		$rCountryId = ($_REQUEST['rCountryId']) ? $_REQUEST['rCountryId'] : 0;
		$rStateId = ($_REQUEST['rStateId']) ? $_REQUEST['rStateId'] : 0;
		$rCityId = ($_REQUEST['rCityId']) ? $_REQUEST['rCityId'] : 0;
		$rDistrictId = ($_REQUEST['rDistrictId']) ? $_REQUEST['rDistrictId'] : 0;
		$rPostCode = $_REQUEST['rPostCode'];
		$rAddress = $_REQUEST['rAddress'];
		//update address session
		CheckoutExt::setSession('rCountryId', $rCountryId);
		CheckoutExt::setSession('rStateId', $rStateId);
		CheckoutExt::setSession('rCityId', $rCityId);
		CheckoutExt::setSession('rDistrictId', $rDistrictId);
		CheckoutExt::setSession('rPostCode', $rPostCode);
		CheckoutExt::setSession('rAddress', $rAddress);
		
		if(Session::isCustomerLogin()){
			//get data
			$customerId = Session::getCustomerId();
			
			//1. update customer detail
			$customerDetailId = CustomerExt::getCustomDetailId($customerId);
			$customerDetailVo = new CustomerDetailVo(); 
			$customerDetailVo->firstName 	= $_REQUEST['name'];
			$customerDetailVo->lastName 	= '';
			$customerDetailVo->phone 		= $_REQUEST['phone'];
			$customerDetailDao->updateByPrimaryKey($customerDetailVo, $customerDetailId);
			
			//2. 	add (edit) shipping address
			if(!$addressShippingId){
				$customerAddressVo = new CustomerAddressVo();
				$customerAddressVo->customerId = $customerId;
				$customerAddressVo->title = $sAddress;
				$customerAddressVo->countryId = $sCountryId;
				$customerAddressVo->stateId = $sStateId;
				$customerAddressVo->cityId = $sCityId;
				$customerAddressVo->districtId = $sDistrictId;
				$customerAddressVo->postCode = $sPostCode;
				$customerAddressVo->address = $sAddress;
				$customerAddressVo->defaultShipping = 1;
				$customerAddressVo->defaultBilling = 1;
				$addressShippingId = $customerAddressDao->insert($customerAddressVo);
				
				CheckoutExt::setSession('shipping_address_id', $addressShippingId);
				CheckoutExt::setSession('billing_address_id', $addressShippingId);
			}
			else if($newShippingAddress){
				//check new address for address shipping old
				$customerAddressInfo = CustomerExt::getCustomerAddressInfo($addressShippingId);
				if(($customerAddressInfo->countryId == $sCountryId) &
					($customerAddressInfo->stateId == $sStateId) &
					($customerAddressInfo->cityId == $sCityId) &
					($customerAddressInfo->districtId == $sDistrictId) &
					($customerAddressInfo->postCode == $sPostCode) &
					($customerAddressInfo->address == $sAddress)){
					//skip
				}
				else{//insert customer address
					$customerAddressVo = new CustomerAddressVo();
					$customerAddressVo->customerId = $customerId;
					$customerAddressVo->title = $sAddress;
					$customerAddressVo->countryId = $sCountryId;
					$customerAddressVo->stateId = $sStateId;
					$customerAddressVo->cityId = $sCityId;
					$customerAddressVo->districtId = $sDistrictId;
					$customerAddressVo->postCode = $sPostCode;
					$customerAddressVo->address = $sAddress;
					$customerAddressVo->defaultShipping = 0;
					$customerAddressVo->defaultBilling = 0;
					$addressShippingId = $customerAddressDao->insert($customerAddressVo);
					
					CheckoutExt::setSession('shipping_address_id', $addressShippingId);
				}
			}
			
			//3. 	add (edit) billing address
			if(!$sameAddress){
				if($newBillingAddress){
					//check new address for address billing old
					$customerAddressInfo = CustomerExt::getCustomerAddressInfo($addressBillingId);
					if(($customerAddressInfo->countryId == $rCountryId) &
							($customerAddressInfo->stateId == $rStateId) &
							($customerAddressInfo->cityId == $rCityId) &
							($customerAddressInfo->districtId == $rDistrictId) &
							($customerAddressInfo->postCode == $rPostCode) &
							($customerAddressInfo->address == $rAddress)){
						//skip
					}
					else{	//insert customer address
						$customerAddressVo = new CustomerAddressVo();
						$customerAddressVo->customerId = $customerId;
						$customerAddressVo->title = $rAddress;
						$customerAddressVo->countryId = $rCountryId;
						$customerAddressVo->stateId = $rStateId;
						$customerAddressVo->cityId = $rCityId;
						$customerAddressVo->districtId = $rDistrictId;
						$customerAddressVo->postCode = $rPostCode;
						$customerAddressVo->address = $rAddress;
						$customerAddressVo->defaultShipping = 0;
						$customerAddressVo->defaultBilling = 0;
						$customerAddressDao->insert($customerAddressVo);
					}
				}
			}
		}
		else{	//guest
			CheckoutExt::setSession('guest_email', $_REQUEST['email']);
			CheckoutExt::setSession('guest_name', $_REQUEST['name']);
			CheckoutExt::setSession('guest_lastName', $_REQUEST['lastName']);
			CheckoutExt::setSession('guest_phone', $_REQUEST['phone']);
		}
		
		//next step
		CheckoutExt::setCheckoutStep(3);
		CheckoutExt::setSession('checkout_done', 0);
		
		//set sameAddress
		$sameAddress = ($_REQUEST['sameAddress']) ? 1 : 0;
		CheckoutExt::setSession('sameAddress', $sameAddress);
	}
	
	/**
	 * OK
	 * checkoutStep3
	 * 1. 	next step
	 */
	private function checkoutStep3(){
		//next step
		CheckoutExt::setCheckoutStep(4);
		CheckoutExt::setSession('checkout_done', 0);
	}
	
	/**
	 * OK
	 * checkoutStep4
	 * 1.	insertOrder (temp)
	 * 2.	callback paymentRequest function
	 * 3.	callback shippingRequest function (skip)
	 * 4.	send email
	 */
	private function checkoutStep4($cartInfo, $shippingPrice, $surcharge, $total){
		//1.	insertOrder
		$this->insertOrder($cartInfo, $shippingPrice, $surcharge, $total);
	
		//2.	callback paymentRequest function
		$payment_mothod_code = CheckoutExt::getSession('payment_mothod_code');
		CheckoutExt::callback('payment', $payment_mothod_code, 'paymentRequest');
		
		//3.	callback shippingRequest function
		//skip
		
		//4.	send email
		$checkout_done = CheckoutExt::getSession('checkout_done');
		if($checkout_done){
			$orderId = CheckoutExt::getSession('orderId');
			$ordersInfo = OrdersExt::getOrdersInfo($orderId);
			
			$to = $ordersInfo->email;
			$name = CustomerExt::getFullName($ordersInfo);
			$link = ($ordersInfo->customerId) ? URLHelper::getUrl('home/account/orders', array('orderId' => $orderId)): '';
			$link = str_replace(Registry::getSetting('base_url').'/', '', $link);
			$emailData = array(
				'name' => $name,
				'orderId' => $orderId,
				'time' => DateHelper::getDateTime(),
				'link' => $link,
				'ordersContent' => OrdersExt::getEmailContent($ordersInfo, $cartInfo),
			);
			EmailHelper::sendMail($to, 'checkout', $emailData);
		}
	}
	
	/**
	 * OK
	 * checkout login
	 */
	public function login(){
        if(Session::isCustomerLogin()){
        	return $this->setRender('account');
       }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        	$customerDao = new CustomerDao();
            $customerVo = new CustomerVo();
            
            //get data
            $username = trim($_REQUEST['username']);
            $password = trim($_REQUEST['password']);
            $pos = strpos($username, '@');
            if($pos === false){	//login by username
            	$usernameData = $username;
            	$emailData = null;
            }
            else{	//login by email
            	$usernameData = null;
            	$emailData = $username;
            }
            $data = CustomerExt::getCustomerInfoLogin($usernameData, $emailData, $password);
            
        	if($data){
	    		//check disable status
    			if($data->status == 'D'){
    				SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Login false. Account is disable'));
    				return $this->setRender('home');
    			}
	    			 
    			//setLogin
    			$sessionType = 'customer';
    			Session::setLogin($data, $sessionType);
    			
    			//remove checkout_by_guest session 
    			CheckoutExt::setSession('checkout_by_guest', 0);
    			 
    			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Login is successful!'));
    			return $this->setRender('success');
	    	}
            else{
                SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Login Failed! Wrong username or password!'));
           }
        }
        
        //view
        return $this->setRender('success');
	}
	
	/**
	 * OK (copy from HomeCustomerController change return $this->setRender function )
	 * customerRegister
	 * 1.	add customer
	 * 2.	setLogin
	 * 3.	send email register
	 * 4.	next step
	 */
	public function register(){
		$customerDao = new CustomerDao();
		$customerDetailDao = new CustomerDetailDao();
		
		if(Session::isCustomerLogin()){
			return $this->setRender('checkout');
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST'){ //registerCustomer
			//1.	add customer
			$customerVo = new CustomerVo();
			$customerVo->roleId = 2;	//hardcode
			$customerVo->email = $_REQUEST['email'];
			$customerVo->password = md5($_REQUEST['password']);
			$customerVo->languageCode = DEFAULT_LANGUAGE;
			$customerVo->status = 'A';
			$customerVo->activeCode = '';
			$customerVo->resetPasswordCode = '';
			$customerVo->crtBy = 0;
			$customerVo->crtDate = DateHelper::getDateTime();
			$customerId = $customerDao->insert($customerVo);
			 
			//add customer_detail
			$customerDetailVo = new CustomerDetailVo();
			$customerDetailVo->customerId = $customerId;
			$customerDetailVo->addressId = 0;
			$customerDetailVo->firstName = $_REQUEST['name'];
			$customerDetailVo->lastName = '';
			$customerDetailVo->phone = $_REQUEST['phone'];
			$customerDetailVo->birthday = DateHelper::getDateFromDatePicker($_REQUEST['birthday']);
			$customerDetailVo->receiveEmail = ($_REQUEST['receive_email']) ? $_REQUEST['receive_email'] : 0;
			$customerDetailVo->image = Registry::getSetting('no_image');
			$customerDetailDao->insert($customerDetailVo);
				
			//2.	setLogin
			$customerInfo = CustomerExt::getCustomerInfo($customerId);
			$sessionType = 'customer';
			Session::setLogin($customerInfo, $sessionType);
			
			//3.	send email register
			$emailData = array(
				'name' => CustomerExt::getFullName($customerInfo),
				'email' => $_REQUEST['email'],
				'password' => $_REQUEST['password'],
				'crtDate' => $customerInfo->crtDate,
				'url' => "index.php?r=home/account",
			);
			EmailHelper::sendMail($customerInfo->email, 'customer_register', $emailData);
			
			//4. next step
			$checkoutStep = 2;
			CheckoutExt::setCheckoutStep($checkoutStep);
			
			//remove checkout_by_guest session
			CheckoutExt::setSession('checkout_by_guest', 0);
			
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Register is successful!'));
			return $this->setRender('checkout');
		}
		 
		return $this->setRender('success');
	}
	
	/*************************************
	 * CALL BACK
	 ************************************/
	/**
	 * OK
	 * run if checkout payment sucessfull
	 */
	public function return_url(){
		//callback paymentReturn function
		$payment_mothod_code = CheckoutExt::getSession('payment_mothod_code');
		$params = array();
		CheckoutExt::callback('payment', $payment_mothod_code, 'paymentReturn', $params);
		
		//view
		return $this->setRender('success');
	}
	
	/**
	 * OK
	 * run if checkout payment cancel
	 */
	public function cancel_url(){
		//callback paymentCancel function
		$payment_mothod_code = CheckoutExt::getSession('payment_mothod_code');
		$params = array();
		CheckoutExt::callback('payment', $payment_mothod_code, 'paymentCancel', $params);
		
		//view
		return $this->setRender('success');
	}
}