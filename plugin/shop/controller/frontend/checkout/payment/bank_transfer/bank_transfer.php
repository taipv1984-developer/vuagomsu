<?php
class HomeCheckoutPaymentBankTransferController extends Controller{
	private $pluginCode;
	private $checkoutType;
	private $checkoutCode;
	private $checkoutSettingKey;
	
	function __construct(){
		$this->pluginCode = CheckoutExt::getPluginCode();
		$this->checkoutType = 'payment';
		$this->checkoutCode = 'bank_transfer';
		$this->checkoutSettingKey = "checkout_{$this->checkoutType}_{$this->checkoutCode}_";
	}
	
	public function getPaymentMethod(){
		$checkoutInfo = CheckoutExt::getCheckoutInfo($this->checkoutType, $this->checkoutCode);
		$data = array();
		$method = array(
			'code'      => $this->checkoutCode,
			'name'		=> $checkoutInfo->checkoutName,
			'order'     => $checkoutInfo->order,
			'description'	=> CheckoutExt::getValue($this->checkoutSettingKey."description", false),
			'data'		=> array()
		);
		
		return $method;
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
	 * set checkout_done
	 */
	public function paymentRequest(){
		CheckoutExt::setSession('checkout_done', 1);
	}
	
	/**
	 * do not use
	 */
	public function paymentReturn(){
	}
	
	/**
	 * do not use
	 */
	public function paymentCancel(){
	}
}