<?php
class AdminManufacController extends Controller {
	private $manufacDao;
    public $manufacModel;
    
    function __construct(){
    	$this->manufacDao = new ManufacDao();
    	$this->manufacModel = new ManufacModel();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$manufacVo = new ManufacVo();
    	$manufacVo->name = $addVo->name;
    	$manufacVos = $this->manufacDao->selectByFilter($manufacVo);
    	if($manufacVos){
			$validate["manufacModel.name"] = e("Manufac name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$manufacVo = new ManufacVo();
    	$manufacVo->name = $editVo->name;
    	$manufacVos = $this->manufacDao->selectByFilter($manufacVo);
    	if($manufacVos){
    		$manufac = $manufacVos[0];
    		if($manufac->manufacId != $editVo->manufacId) {
    			$validate["manufacModel.name"] = e("Manufac name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($manufacVo){
    }
    
    private function _filter($manufacVo){
    	if(!CTTHelper::isEmptyString($this->manufacModel->manufacId)) {
    		$manufacVo->manufacId = $this->manufacModel->manufacId;
    	}
    	if(!CTTHelper::isEmptyString($this->manufacModel->name)) {
    		$manufacVo->name = array('like', "%{$this->manufacModel->name}%");
    	}
    }
    
	public function manage(){
        $manufacVo = new ManufacVo();
        
        //filter
        $this->_filter($manufacVo);
        
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
        $count = count($this->manufacDao->selectByFilter($manufacVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $manufacVos = $this->manufacDao->selectByFilter($manufacVo, array(), $start, $recSize);
        
        //add info
        foreach($manufacVos as $manufacVo){
        	$this->_add_info($manufacVo);
        }
        
        //set data
        $paging->items = $manufacVos;	
        
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
    			$manufacVo = new ManufacVo();
    			$manufacVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($manufacVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$manufacVo = new ManufacVo();
    			$manufacVo->name = trim($_REQUEST['name']);
    			$manufacVo->manufacId = trim($_REQUEST['manufacId']);
    			$validate = $this->_validate_edit($manufacVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($manufacInfo){
    	if(!$manufacInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Manufac not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($manufacInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$manufacVo = new ManufacVo();
        	CTTHelper::copyProperties($this->manufacModel, $manufacVo);
        	//image
        	$manufacVo->image = str_replace(URLHelper::getBaseUrl().'/', '', $_REQUEST['image']);
        	
        	//add
        	$this->manufacDao->insert($manufacVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Manufac add success");
            return $this->setRender('manage');
        }
        
        //set default data
        $manufacInfo = new manufacVo;

        //send data
        $this->setAttributes(array(
        	'manufacInfo' => $manufacInfo,
        ));
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function edit(){
        $manufacId = $_REQUEST['manufacId'];
        $manufacInfo = $this->manufacDao->selectByPrimaryKey($manufacId);
        
        if(!($this->_check_exist($manufacInfo) & $this->_check_permission($manufacInfo))){
			return $this->setRender('manage');
		}
        
        //add info
        $this->_add_info($manufacInfo);
        
        //send data
        $this->setAttributes(array(
        	'manufacInfo' => $manufacInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$manufacVo = new ManufacVo();
        	CTTHelper::copyProperties($this->manufacModel, $manufacVo);
        	//image
        	$manufacVo->image = str_replace(URLHelper::getBaseUrl().'/', '', $_REQUEST['image']);
        	
        	//update
        	$this->manufacDao->updateByPrimaryKey($manufacVo, $manufacId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Manufac update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function delete() {
    	if(isset($_REQUEST['manufacId'])){
			$manufacId = $_REQUEST['manufacId'];
			$manufacInfo = $this->manufacDao->selectByPrimaryKey($manufacId);
			
			if(!($this->_check_exist($manufacInfo) & $this->_check_permission($manufacInfo))){
				return $this->setRender('manage');
			}
    		
			//check later
			//...
			
			$this->manufacDao->deleteByPrimaryKey($manufacId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	if(isset($_REQUEST['redirect'])){
    		$redirect = urldecode($_REQUEST['redirect']);
    		header("location: $redirect");
    		return;
    	}
    	else{
    		return $this->setRender('success');
    	}
    }
}