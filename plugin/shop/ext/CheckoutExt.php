<?php 
class CheckoutExt{
	/*****************************************************
	 * COMMON FUNCTION
	 * **************************************************/
	/**
	 * getPluginCode
	 * 
	 * @return 'shop' //hardcode
	 */
	public static function getPluginCode(){
		return 'shop';
	}
	
	/**
	 * getCheckoutId from $checkoutType and $checkoutCode
	 *
	 * @param string $checkoutType
	 * @param string $checkoutCode
	 * @return boolean|int
	 */
	public static function getCheckoutId($checkoutType, $checkoutCode){
		$sql = "select * from checkout where checkout_type='$checkoutType' and checkout_code='$checkoutCode'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->checkoutId : false;
	}
	
	/**
	 * getCheckoutInfo from $checkoutType and $checkoutCode
	 *
	 * @param string $checkoutType
	 * @param string $checkoutCode
	 * @return boolean|object
	 */
	public static function getCheckoutInfo($checkoutType, $checkoutCode){
		$sql = "select * from checkout where checkout_type='$checkoutType' and checkout_code='$checkoutCode'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getShippingName($checkoutCode){
		$sql = "select * from checkout where checkout_type='shipping' and checkout_code='$checkoutCode'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->checkoutName : false;
	}
	
	/**
	 * Get all checkout have type = $checkoutType
	 * 
	 * @param string $checkoutType
	 * @return array (object)
	 */
	public static function getCheckoutList($checkoutType){
		$sql = "select * from checkout where checkout_type='$checkoutType' and is_del=0 order by `order` ASC";
		return DataBaseHelper::query($sql);
	}
	/**
	 * getCheckoutType
	 *
	 * @return array('payment', 'shipping', 'surcharge')
	 */
	public static function getCheckoutType(){
		return array('payment', 'shipping', 'surcharge');
	}
	public static function getCheckoutTypeIcon(){
		return array(
			'payment' => 'fa fa-dollar',
			'shipping' => 'fa fa-truck',
			'surcharge' => 'fa fa-percent'
		);
	}
	
	/**
	 * getShippingMethodList
	 *
	 * @return list 
	 */
	public static function getShippingMethodList(){
		$sql = "select * from checkout where checkout_type='shipping' and is_del=0 order by `order`ASC";
		return DataBaseHelper::query($sql);
	}
	
	public static function getPaymentName($checkoutCode){
		$sql = "select * from checkout where checkout_type='payment' and checkout_code='$checkoutCode'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->checkoutName : false;
	}
	
	/**
	 * getShippingMethodArray
	 * 
	 * @return array(checkout_code => checkout_name)
	 */
	public static function getShippingMethodArray(){
		$sql = "select * from checkout where checkout_type='shipping' and is_del=0 order by `order`ASC";
		$output = array(
			'type' => 'array',
			'key' => 'checkout_code',
			'value' => 'checkout_name'
		);
		return DataBaseHelper::query($sql, array(), $output);
	}
	
	/**
	 * getPaymentMethodList
	 *
	 * @return list
	 */
	public static function getPaymentMethodList(){
		$sql = "select * from checkout where checkout_type='payment' and is_del=0 order by `order`ASC";
		return DataBaseHelper::query($sql);
	}
	
	/**
	 * getPaymentMethodArray
	 *
	 * @return array(checkout_code => checkout_name)
	 */
	public static function getPaymentMethodArray(){
		$sql = "select * from checkout where checkout_type='payment' and is_del=0 order by `order`ASC";
		$output = array(
			'type' => 'array',
			'key' => 'checkout_code',
			'value' => 'checkout_name'
		);
		return DataBaseHelper::query($sql, array(), $output);
	}
	
	public static function getSurchargeName($checkoutCode){
		$sql = "select * from checkout where checkout_type='surcharge' and checkout_code='$checkoutCode'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->checkoutName : false;
	}
	public static function getShippingDefault(){
		$sql = "select * from checkout 
where checkout_type='shipping' and `default`=1 and `status`='A' and is_del=0
limit 1";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
		
	public static function getPaymentDefault(){
		$sql = "select * from checkout
where checkout_type='payment' and `default`=1 and `status`='A' and is_del=0
limit 1";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	public static function getSurchargeDefault(){
		$sql = "select * from checkout
where checkout_type='surcharge' and `default`=1 and `status`='A' and is_del=0
limit 1";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	/**
	 * delete checkout and checkout_setting table
	 * 
	 * @param int $checkoutId
	 */
	public static function delete($checkoutId){
		//1. delete checkout_setting
		$sql = "delete from checkout_setting where checkout_id=$checkoutId";
		DataBaseHelper::query($sql, null, null);
		
		//2. delete in data base
		$sql = "delete from checkout where checkout_id=$checkoutId";
		DataBaseHelper::query($sql, null, null);
	}
	
	/*****************************************************
	 * checkout_setting
	 * **************************************************/
	/**
	 * getValue of checkout_setting table
	 *
	 * @param strings $name
	 * @return string
	 */
	public static function getValue($setting, $checkoutInfo=null){
		if($checkoutInfo){
			$setting = "checkout_{$checkoutInfo->checkoutType}_{$checkoutInfo->checkoutCode}_$setting";
		}
		$sql = "select * from checkout_setting where setting='$setting'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->value : false;
	}
	
	/**
	 * get setting list of a $checkoutId
	 *
	 * @param int $checkoutId
	 * @return array
	 */
	public static function getSetting($checkoutId){
		$sql = "select * from checkout_setting where checkout_id=$checkoutId";
		$query = DataBaseHelper::query($sql);
		
		$setting = array();
		foreach($query as $v){
			if($v->serialized == 0){
				$setting[$v->setting] = $v->value;
			}else{
				$setting[$v->setting] = unserialize($v->value);
			}
		}
	
		return $setting;
	}
	
	/**
	 * updateSetting(1. delete old value, 2. insert new value)
	 *
	 * @param int $checkoutId
	 * @param string filter(only get key start width filter)
	 * @param array $data(get from request form)
	 */
	public static function updateSetting($checkoutInfo){
		$checkoutSettingDao = new CheckoutSettingDao();
	
		//get data
		$checkoutId = $checkoutInfo->checkoutId;
		$checkoutType = $checkoutInfo->checkoutType;
		
		//Step1: delete all setting old
		self::deleteSetting($checkoutId);
	
		//Step2: Add new value from data
		$filter = 'checkout_'.$checkoutType.'_';
		foreach($_REQUEST as $k => $v){
			if(substr($k, 0, strlen($filter)) == $filter){
				$checkoutSettingVo = new CheckoutSettingVo();
				$checkoutSettingVo->checkoutId = $checkoutId;
				$checkoutSettingVo->setting = $k;
				if(is_array($v)){
					$checkoutSettingVo->value = serialize($v);
					$checkoutSettingVo->serialized = 1;
				}
				else{
					$checkoutSettingVo->value = $v;
					$checkoutSettingVo->serialized = 0;
				}
				$checkoutSettingDao->insert($checkoutSettingVo);
			}
		}
	}
	
	/**
	 * deleteSetting of $checkoutId
	 *
	 * @param int $checkoutId
	 */
	public static function deleteSetting($checkoutId){
		$sql = "delete from checkout_setting where checkout_id=$checkoutId";
		DataBaseHelper::query($sql, null, null);
	}
	
	/****************************************************
	 * SESSION
	 * *************************************************/
	/**
	 * setSession apply for case checkout only
	 * clear all session when checkout finish
	 * 
	 * @param string $session
	 * @param string|int|boolean $sessionValue
	 */
	public static function setSession($session, $sessionValue){
		$_SESSION[SESSION_GROUP]['checkout'][$session] = $sessionValue;
	}
	
	/**
	 * getSession apply for case checkout only
	 * clear all session when checkout finish
	 *
	 * @param string $session
	 * @param null $default
	 */
	public static function getSession($name, $default = null){
		if(!isset($_SESSION[SESSION_GROUP]['checkout'][$name]))
			return $default;
		else
			return $_SESSION[SESSION_GROUP]['checkout'][$name];
	}
	
	public static function deleteSession($name){
		unset($_SESSION[SESSION_GROUP]['checkout'][$name]);
	}
	public static function setCheckoutStep($step){
		self::setSession('checkout_step', $step);
    }
    
    /**
     * getCheckoutStep
     *
     * @return current step of checkout
     */
    public static function getCheckoutStep(){
    	$step = self::getSession('checkout_step');
    	return ($step) ? $step : 0;
    }
	
    public static function clearSession(){
    	unset($_SESSION[SESSION_GROUP]['checkout']);
    }
    
	/**
	 * ........tam thoi de lai chua test
	 * isCheckoutByGuest
	 *
	 * @return boolean
	 */
	public static function isCheckoutByGuest(){
		return isset($_SESSION[SESSION_GROUP]['checkout_by_guest'])? true : false;
	}
	
	/*****************************************************
	 * RUN FUNCTION FROM FILE
	 * **************************************************/
	/**
	 * OK
	 * callback $functionName function of $checkoutType and $checkoutCode
	 * 
	 * @param string $checkoutType
	 * @param string $checkoutCode
	 * @param string $functionName
	 * @param array $params
	 * @return boolean|array
	 */
	public static function callback($checkoutType, $checkoutCode, $functionName, $params){
		//set default
		$pluginCode = self::getPluginCode();
		
		//load file
		$controllerFile = PLUGIN_PATH."$pluginCode/controller/frontend/checkout/$checkoutType/$checkoutCode/$checkoutCode.php";
		FileHelper::loadFile($controllerFile);
			
		$checkoutType = StringHelper::toCamelCase($checkoutType, true);
		$checkoutCode = StringHelper::toCamelCase($checkoutCode, true);
		$controllerName = "HomeCheckout{$checkoutType}{$checkoutCode}Controller";
		$controller = new $controllerName();
		$methods = get_class_methods($controller);
		if(in_array($functionName, $methods)){
			return $controller->$functionName($params);
		}
		else{
			LogUtil::error("[CheckoutExt::callback] checkoutType = $checkoutType ... checkoutCode = $checkoutCode ... functionName = $functionName");
			return false;
		}
	}
	
	/**
	 * OK
	 * getShippingMethod list
	 * callback getShippingMethod function for all shipping active
	 * 
	 * @return array
	 */
	public static function getShippingMethod(){
		//set data
		$checkoutType = 'shipping';
		$functionName = 'getShippingMethod';
			
		//get $checkoutList
		$checkoutList = CheckoutExt::getCheckoutList($checkoutType);
			
		//run getSurcharge funtion after add to $surcharge array
		$shippingMethod = array();
		foreach($checkoutList as $k => $v){
			$checkoutCode = $v->checkoutCode;
			$status = $v->status;
			if($status == 'A'){
				 $shippingMethod[$checkoutCode] = self::callback($checkoutType, $checkoutCode, $functionName);
			}
		}
		return $shippingMethod;
	}
	
	/**
	 * OK
	 * getPaymentMethod list
	 * callback getPaymentMethod function for all payment active
	 * 
	 * @return array
	 */
	public static function getPaymentMethod(){
		//set data
		$checkoutType = 'payment';
		$functionName = 'getPaymentMethod';
			
		//get $checkoutList
		$checkoutList = CheckoutExt::getCheckoutList($checkoutType);
			
		//run getSurcharge funtion after add to $surcharge array
		$shippingMethod = array();
		foreach($checkoutList as $k => $v){
			$checkoutCode = $v->checkoutCode;
			$status = $v->status;
			if($status == 'A'){
				$shippingMethod[$checkoutCode] = self::callback($checkoutType, $checkoutCode, $functionName);
			}
		}
		return $shippingMethod;
	}
	
	/**
	 * OK
	 * callback getSurcharge function for all surcharge active
	 *
	 * @param array $params('subTotal' => , 'shippingPrice' => )
	 * @return array(array('code'=>, 'name'=>, 'order'=>, 'value'=>))
	 */
	public static function getSurcharge($params){
		//set data
		$checkoutType = 'surcharge';
		$functionName = 'getSurcharge';
			
		//get $checkoutList
		$checkoutList = CheckoutExt::getCheckoutList($checkoutType);
			
		//run getSurcharge funtion after add to $surcharge array
		$surcharge = array();
		foreach($checkoutList as $k => $v){
			$checkoutCode = $v->checkoutCode;
			$status = $v->status;
			if($status == 'A'){
				$surcharge[$checkoutCode] = self::callback($checkoutType, $checkoutCode, $functionName, $params);
			}
		}
		return $surcharge;
	}


    /*************************
     *advance function
     ************************/
	//do trang cart (mobile) lai su ly gui don hang len phai viet ra ham dung chung cho 2 trang cart (mobile) va checkout (desktop)
	public static function checkoutSubmit(){
        $ordersDao = new OrdersDao();
        $orderProductDao = new OrderProductDao();
        $customerAddressDao = new CustomerAddressDao();
        $orderShippingDao = new OrderShippingDao();
        $orderDataDao = new OrderDataDao();
        $customerDao = new CustomerDao();
        $customerDetailDao = new CustomerDetailDao();

        //getCartData from Session
        $cartInfo = ProductExt::getCartInfo();
        $subTotal = $cartInfo['subTotal'];

        //simple
        $total = $subTotal; //$total = $subTotal + $shippingPrice + $subTotal

        $customerAddressId = $_REQUEST['customerAddressId'];
        if($customerAddressId){
            $customerAddressInfo = $customerAddressDao->selectByPrimaryKey($customerAddressId);
            $address = $customerAddressInfo->address;
        }
        else {
            $address = trim($_REQUEST['address']);
        }
        //1 add (shipping address default) if customer not address
        if(Session::isCustomerLogin()){
            $customerId = Session::getCustomerId();
            $customerAddress = CustomerExt::getAddressShippingDefault($customerId);
            if(!$customerAddress) {
                $customerAddressVo = new CustomerAddressVo();
                $customerAddressVo->customerId = $customerId;
                $customerAddressVo->address = $address;
                $customerAddressVo->defaultShipping = 1;
                $customerAddressVo->defaultBilling = 0;
                $customerAddressDao->insert($customerAddressVo);
            }

            //update email, phone for customer if not data (case login by facebook, g+)
            $customerInfo = CustomerExt::getCustomerInfo($customerId);
            if(!$customerInfo->email){
                $customerVo = new CustomerVo();
                $customerVo->email = trim($_REQUEST['email']);
                $customerDao->updateByPrimaryKey($customerVo, $customerId);
            }

            if(!$customerInfo->phone){
                $customerDetailVo = new CustomerDetailVo();
                $customerDetailVo->phone = trim($_REQUEST['phone']);
                $customerDetailDao->updateByPrimaryKey($customerDetailVo, $customerInfo->customerDetailId);
            }
        }

        //2	new CustomerAddress for orders (customerId 0)
        $customerAddressVo = new CustomerAddressVo();
        $customerAddressVo->customerId = 0;
        $customerAddressVo->title = '';
        $customerAddressVo->countryId = 242;
        $customerAddressVo->stateId = 0;
        $customerAddressVo->cityId = $_REQUEST['cityId'];
        $customerAddressVo->districtId = 0;
        $customerAddressVo->postCode = '';
        $customerAddressVo->address = $address;
        $customerAddressVo->defaultShipping = 0;
        $customerAddressVo->defaultBilling = 0;
        $addressShippingId = $customerAddressDao->insert($customerAddressVo);

        //3 if $checkout_by_guest add a customer with roleId = 1
        $checkout_by_guest = CheckoutExt::getSession('checkout_by_guest');
        if($checkout_by_guest){
            $customerVo = new CustomerVo();
            $customerVo->roleId = 1;
            $customerVo->email = trim($_REQUEST['email']);
            $guestId = $customerDao->insert($customerVo);

            $customerDetailVo = new CustomerDetailVo();
            $customerDetailVo->customerId = $guestId;
            $customerDetailVo->firstName 	= trim($_REQUEST['fisrtName']);
            $customerDetailVo->lastName 	= '';
            $customerDetailVo->phone 		= trim($_REQUEST['phone']);
            $customerDetailDao->insert($customerDetailVo);
        }

        //4	create orders
        $ordersVo = new OrdersVo();
        if($checkout_by_guest){
            $ordersVo->customerId = 0;
            $ordersVo->guestId = $guestId;
        }
        else{
            $ordersVo->customerId = $customerId;
            $ordersVo->guestId = 0;
        }
        $ordersVo->subtotal = $subTotal;
        $ordersVo->total = $total;
        $ordersVo->totalWeight = 0;
        $ordersVo->shippingAddressId = $addressShippingId;
        $ordersVo->sameAddress = 1;
        $ordersVo->billingAddressId = $addressShippingId;
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
        $ordersVo->note = trim($_REQUEST['note']);
        $orderId = $ordersDao->insert($ordersVo);

        //4+ orderData (include customerInfo and cartInfo)
        if($checkout_by_guest){
            $customerInfo = CustomerExt::getCustomerInfo($ordersVo->guestId);
        }
        else{
            $customerInfo = CustomerExt::getCustomerInfo($ordersVo->customerId);
        }
        $orderData = array(
            'customerInfo' => $customerInfo,
            'cartInfo' => $cartInfo
        );
        $orderDataVo = new OrderDataVo();
        $orderDataVo->orderId = $orderId;
        $orderDataVo->data = json_encode($orderData);
        $orderDataDao->insert($orderDataVo);

        //get $ordersInfo
        $ordersInfo = $ordersVo;
        $ordersInfo->orderId = $orderId;

        //5 orderProduct
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

        //5+ orderShipping (defalt shippingCode = 0 after admin change in order edit)
        $orderShippingVo = new OrderShippingVo();
        $orderShippingVo->orderId = $orderId;
        $orderShippingVo->code = 'flat';
        $orderShippingVo->name = 'Flat shipping';
        $orderShippingVo->data = json_encode(array());
        $orderShippingVo->value = 0;
        $orderShippingVo->status = 'Pending';
        $orderShippingDao->insert($orderShippingVo);

        //6 send email (to admin and customer)
        $tos = array();
        //get email admin
        $sql = "select email from admin where role_id = 4";
        $query = DataBaseHelper::query($sql);
        $tos = array();
        foreach ($query as $v){
            $tos[] = $v->email;
        }
        //add email of customer
        $tos[] = trim($_REQUEST['email']);
        $name = trim($_REQUEST['fisrtName']);
        $emailData = array(
            'ordersId' => "#$orderId",
            'name' => $name,
            'address' => $address .' (' .AddressHelper::getCityName($_REQUEST['cityId']). ')',
            'phone' => trim($_REQUEST['phone']),
            'crtDate' => date('d/m/Y'),
            'ordersInfo' => OrdersExt::getEmailContent($ordersInfo, $cartInfo),
        );
        EmailHelper::sendMail($tos, 'checkout', $emailData);

        //7 clearSession
        CheckoutExt::clearSession();
        ProductExt::deleteSessionCart();

        //message
        SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Orders is success. Check your email to view detail');

        return $orderId;
    }
}
?>