<?php
class AdminOrderStatusController extends Controller {
	private $orderStatusDao;
    public $orderStatusModel;
    private $pluginCode;
    
    function __construct(){
    	$this->orderStatusDao = new OrderStatusDao();
    	$this->orderStatusModel = new OrderStatusModel();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$orderStatusVo = new OrderStatusVo();
    	$orderStatusVo->name = $addVo->name;
    	$orderStatusVos = $this->orderStatusDao->selectByFilter($orderStatusVo);
    	if($orderStatusVos){
			$validate["orderStatusModel.name"] = e("Order Status name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$orderStatusVo = new OrderStatusVo();
    	$orderStatusVo->name = $editVo->name;
    	$orderStatusVos = $this->orderStatusDao->selectByFilter($orderStatusVo);
    	if($orderStatusVos){
    		$orderStatus = $orderStatusVos[0];
    		if($orderStatus->orderStatusId != $editVo->orderStatusId) {
    			$validate["orderStatusModel.name"] = e("Order Status name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($orderStatusVo){
    	//isSystem
    	$orderStatusVo->isSystem = ArrayHelper::get10()[$orderStatusVo->isSystem];
    }
    
    private function _filter($orderStatusVo){
    	if(!CTTHelper::isEmptyString($this->orderStatusModel->orderStatusId)) {
    		$orderStatusVo->orderStatusId = $this->orderStatusModel->orderStatusId;
    	}
    	if(!CTTHelper::isEmptyString($this->orderStatusModel->name)) {
    		$orderStatusVo->name = array('like', "%{$this->orderStatusModel->name}%");
    	}
    	if(!CTTHelper::isEmptyString($this->orderStatusModel->order)) {
    		$orderStatusVo->order = $this->orderStatusModel->order;
    	}
    	if(!CTTHelper::isEmptyString($this->orderStatusModel->isSystem)) {
    		$orderStatusVo->isSystem = $this->orderStatusModel->isSystem;
    	}
    }
    
	public function manage(){
        $orderStatusVo = new OrderStatusVo();
        
        //filter
        $this->_filter($orderStatusVo);
        //orderBy
        $orderBy = array('order' => 'ASC');
        
        //paging
        if(empty($_REQUEST['item_per_page'])) {
            $recSize = Registry::getSetting('item_per_page');
        } 
        else {
            $recSize = $_REQUEST['item_per_page'];
        }
        $start = 0;
        if(CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } 
        elseif(is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } 
        else {
            $page = 0;
        }
        $count = count($this->orderStatusDao->selectByFilter($orderStatusVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $orderStatusVos = $this->orderStatusDao->selectByFilter($orderStatusVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($orderStatusVos as $orderStatusVo){
        	$this->_add_info($orderStatusVo);
        }
        
        //set data
        $paging->items = $orderStatusVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$orderStatusVo = new OrderStatusVo();
    			$orderStatusVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($orderStatusVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$orderStatusVo = new OrderStatusVo();
    			$orderStatusVo->name = trim($_REQUEST['name']);
    			$orderStatusVo->orderStatusId = $_REQUEST['orderStatusId'];
    			$validate = $this->_validate_edit($orderStatusVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($orderStatusInfo){
    	if(!$orderStatusInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Order Status not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($orderStatusInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$orderStatusVo = new OrderStatusVo();
        	CTTHelper::copyProperties($this->orderStatusModel, $orderStatusVo);
        	$orderStatusVo->isSystem = 0;
        	
        	//add
        	$this->orderStatusDao->insert($orderStatusVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Order Status add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $orderStatusId = $_REQUEST['orderStatusId'];
        $orderStatusInfo = $this->orderStatusDao->selectByPrimaryKey($orderStatusId);
        
        if(!($this->_check_exist($orderStatusInfo) & $this->_check_permission($orderStatusInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'orderStatusInfo' => $orderStatusInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$orderStatusVo = new OrderStatusVo();
        	//update desctiption and order only for status !system
        	if(!$orderStatusInfo->isSystem){
        		$orderStatusVo->name = $_REQUEST['orderStatusModel_name'];
        	}
        	$orderStatusVo->description = $_REQUEST['orderStatusModel_description'];
        	$orderStatusVo->order = $_REQUEST['orderStatusModel_order'];
        	//update
        	$this->orderStatusDao->updateByPrimaryKey($orderStatusVo, $orderStatusId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Order Status update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function delete() {
    	if(isset($_REQUEST['orderStatusId'])){
			$orderStatusId = $_REQUEST['orderStatusId'];
			
			//check isSystem
			$orderStatusInfo = $this->orderStatusDao->selectByPrimaryKey($orderStatusId);
			if($orderStatusInfo->isSystem){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Not delete status of system');
				return $this->setRender('false');
			}
			
			$this->orderStatusDao->deleteByPrimaryKey($orderStatusId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
}