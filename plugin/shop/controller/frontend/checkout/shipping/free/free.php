<?php
class HomeCheckoutShippingFreeController extends Controller{
	private $pluginCode;
	private $checkoutType;
	private $checkoutCode;
	private $checkoutSettingKey;
	
	function __construct(){
		$this->pluginCode = CheckoutExt::getPluginCode();
		$this->checkoutType = 'shipping';
		$this->checkoutCode = 'free';
		$this->checkoutSettingKey = "checkout_{$this->checkoutType}_{$this->checkoutCode}_";
	}
	
	public function getShippingMethod(){
		$checkoutInfo = CheckoutExt::getCheckoutInfo($this->checkoutType, $this->checkoutCode);
		$method = array(
			'code'      => $this->checkoutCode,
			'name'		=> $checkoutInfo->checkoutName,
			'order'     => $checkoutInfo->order,
			'description'	=> CheckoutExt::getValue($this->checkoutSettingKey."description", false),
		);
		
		return $method;
	}
	
	public function getView(){
		$controllerFile = PLUGIN_PATH."$this->pluginCode/view/frontend/checkout/$this->checkoutType/$this->checkoutCode/$this->checkoutCode.php";
		FileHelper::loadFile($controllerFile);
	}
	
	public function shippingCheck(){
		$check = true;
		
		//get $cartInfo
		$cartInfo = ProductExt::getCartInfo();
		
		//check $subTotal
		$subTotal = $cartInfo['subTotal'];
		if($subTotal === 0){
			$error_message = CheckoutExt::getSession('error_message', array());
			$error_message[] = "Cart is empty";
			CheckoutExt::setSession('error_message', $error_message);
			
			$check = false;
		}
		
		return $check;
	}
	
	public function getShippingPrice(){
		//set cost
		$cost = (float)CheckoutExt::getValue($this->checkoutSettingKey."cost", false);
		$total = (float)CheckoutExt::getValue($this->checkoutSettingKey."total", false);
		
		//get $cartInfo
		$cartInfo = ProductExt::getCartInfo();
		$cost = ($cartInfo['subTotal'] >= $total)? 0 : $cost;
		
		return $cost;
	}
}