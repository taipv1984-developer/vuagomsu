<?php
class HomeCheckoutShippingSurfaceController extends Controller{
	private $pluginCode;
	private $checkoutType;
	private $checkoutCode;
	private $checkoutSettingKey;
	
	function __construct(){
		$this->pluginCode = CheckoutExt::getPluginCode();
		$this->checkoutType = 'shipping';
		$this->checkoutCode = 'surface';
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
	
	/**
	 * shippingCheck
	 * if $totalWeight <= $weight_max return false
	 * 
	 * @return boolean
	 */
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
		
		//check $totalWeight
		$totalWeight = $cartInfo['totalWeight'];
		$weight_max = CheckoutExt::getValue($this->checkoutSettingKey."weight_max", false);
		//convert kg -> g
		$weight_max = 1000*$weight_max;
		if($totalWeight > $weight_max){
			$error_message = CheckoutExt::getSession('error_message', array());
			$error_message[] = "Order volume must be less than {$weight_max}g";
			CheckoutExt::setSession('error_message', $error_message);
			
			$check = false;
		}
		
		return $check;
	}
	
	/**
	 * getShippingPrice
	 * 		Up to 2kg($weight_up_to) then price = 7$($price_up_to)
			Every 1kg thereafter up to 30kg($weight_max) then rate after = 1.5$($rate_after)
	 * @return price
	 */
	public function getShippingPrice(){
		//get data
		$weight_up_to = CheckoutExt::getValue($this->checkoutSettingKey."weight_up_to", false);
		$price_up_to = CheckoutExt::getValue($this->checkoutSettingKey."price_up_to", false);
		$rate_after = CheckoutExt::getValue($this->checkoutSettingKey."rate_after", false);
		$weight_max = CheckoutExt::getValue($this->checkoutSettingKey."weight_max", false);
		//convert kg -> g
		$weight_up_to = 1000*$weight_up_to;
		$weight_max = 1000*$weight_max;
		
		//get $cartInfo
		$cartInfo = ProductExt::getCartInfo();
		$totalWeight = $cartInfo['totalWeight'];
		if($totalWeight <= $weight_up_to){
			return $price_up_to;
		}
		else{
			if($totalWeight <= $weight_max){
				//get overweight
				$overweight = ceil(($totalWeight - $weight_up_to)/1000);
				return $price_up_to + ($overweight*$rate_after);
			}
			else{
				return false;
			}
				
		}
	}
}