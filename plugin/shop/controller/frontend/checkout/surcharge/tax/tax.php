<?php
class HomeCheckoutSurchargeTaxController extends Controller{
	private $pluginCode;
	private $checkoutType;
	private $checkoutCode;
	private $checkoutSettingKey;
	
	function __construct(){
		$this->pluginCode = CheckoutExt::getPluginCode();
		$this->checkoutType = 'surcharge';
		$this->checkoutCode = 'tax';
		$this->checkoutSettingKey = "checkout_{$this->checkoutType}_{$this->checkoutCode}_";
	}
	
	/**
	 * getSurcharge
	 * 
	 * @param float $subTotal of orders
	 * @param float $shippingPrice (apply only checkout surcharge tax)
	 * @return float %$tax*($subTotal+$shippingPrice) || %$tax*($subTotal)
	 */
	public function getSurcharge($params){
		//get data
		$subTotal = $params['subTotal'];
		$shippingPrice = $params['shippingPrice'];
		
		$checkoutInfo = CheckoutExt::getCheckoutInfo($this->checkoutType, $this->checkoutCode);
		$name	= $checkoutInfo->checkoutName;
		$order  = $checkoutInfo->order;
		$apply_for_shipping = CheckoutExt::getValue($this->checkoutSettingKey."apply_for_shipping", false);
		
		//process
		$tax = CheckoutExt::getValue($this->checkoutSettingKey."tax", false);
		if($apply_for_shipping){
			$tax = ($subTotal+$shippingPrice)*($tax/100);
		}
		else{
			$tax = ($subTotal)*($tax/100);
		}
		
		return array(
			'code'       => $this->checkoutCode,
			'name'       => $name,
			'order'      => $order,
			'value'      => $tax,
		);
	}
}