<?php
class AdminCheckoutController extends Controller{
	public $checkoutDao;
	public  $checkoutModel;
	private $pluginCode;
    
    function __construct(){
    	$this->checkoutDao = new CheckoutDao();
    	$this->checkoutModel = new CheckoutModel();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
   }
    
	/**
     * manage checkout group by checkout_type 
     * check checkout_type session value => $checkoutType
     */
	public function manage(){
		$checkoutTypes = CheckoutExt::getCheckoutType();
		
		$checkOutData = array();
		foreach ($checkoutTypes as $checkoutType){
			$checkoutList = CheckoutExt::getCheckoutList($checkoutType);

			foreach($checkoutList as $v){
				$checkOutData[$checkoutType][$v->checkoutId] = $v;
			}
		}
		
		//send data
		$this->setAttributes(array(
			'checkOutData' => $checkOutData,
		));
		
        //call view
        return $this->setRender('success');
    }
    
    public function manage_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'change_status_ajax':
    			$checkoutId = $_REQUEST['id'];
    			$status = $_REQUEST['value'];
    			$checkoutVo = new CheckoutVo();
    			$checkoutVo->status = $status;
    			$this->checkoutDao->updateByPrimaryKey($checkoutVo, $checkoutId);
    			break;
    		default:
    			break;
    	}
    		
    	return $this->setRender('success');
    }
    
    //later
    public function add(){
    	
    	//view
    	return $this->setRender('success');
    }
    
	/**
     * checkout edit parameters
     */ 
    public function edit(){
    	//get data
    	$checkoutId = $_REQUEST['checkoutId'];
    	
    	//get $checkoutInfo
    	$checkoutInfo = $this->checkoutDao->selectByPrimaryKey($checkoutId);
		if(!$checkoutInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Checkout is invalid");
			return $this->setRender('home');
		}
		$checkoutType = $checkoutInfo->checkoutType;
		$checkoutCode = $checkoutInfo->checkoutCode;
    	
    	//send data
    	$this->setAttributes(array(
    		'pluginCode' => $this->pluginCode,
    		'checkoutInfo' => $checkoutInfo,
    	));
    	
    	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    		//update checkout
    		$checkoutVo = new CheckoutVo ();
    		CTTHelper::copyProperties ($this->checkoutModel, $checkoutVo);
    		$this->checkoutDao->updateByPrimaryKey($checkoutVo, $checkoutId);
    		
    		//update setting
			CheckoutExt::updateSetting($checkoutInfo);
    	
    		//message
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e("Checkout update success"));
    		
    		//set session
    		Session::setSession('checkout_tab', "tab_$checkoutType");
    		
    		//view
    		return $this->setRender('manage');
    	}
    	
    	//view
    	return $this->setRender('success');
   }
    
	/**
     * checkout delete(later)
     */ 
    public function delete(){
    	//
    	
    	//call view
    	return $this->setRender('success');
   }  
}