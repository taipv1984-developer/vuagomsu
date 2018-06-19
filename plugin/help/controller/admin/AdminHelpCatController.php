<?php
class AdminHelpCatController extends Controller {
	private $helpCatDao;
    public $helpCatModel;
    
    function __construct(){
    	$this->helpCatDao = new HelpCatDao();
    	$this->helpCatModel = new HelpCatModel();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$helpCatVo = new HelpCatVo();
    	$helpCatVo->name = $addVo->name;
    	$helpCatVos = $this->helpCatDao->selectByFilter($helpCatVo);
    	if($helpCatVos){
			$validate["helpCatModel.name"] = e("Category name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$helpCatVo = new HelpCatVo();
    	$helpCatVo->name = $editVo->name;
    	$helpCatVos = $this->helpCatDao->selectByFilter($helpCatVo);
    	if($helpCatVos){
    		$helpCat = $helpCatVos[0];
    		if($helpCat->helpCatId != $editVo->helpCatId) {
    			$validate["helpCatModel.name"] = e("Category name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($helpCatVo){
    	//...
    }
    
    private function _filter($helpCatVo){
    	if(!CTTHelper::isEmptyString($this->helpCatModel->helpCatId)) {
    		$helpCatVo->helpCatId = $this->helpCatModel->helpCatId;
    	}
    	if(!CTTHelper::isEmptyString($this->helpCatModel->name)) {
    		$helpCatVo->name = array(array('dk' => 'like', $this->helpCatModel->name));
    	}
    }
    
	public function manage(){
        $helpCatVo = new HelpCatVo();
        
        //filter
        $this->_filter($helpCatVo);
        
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
        $count = count($this->helpCatDao->selectByFilter($helpCatVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $helpCatVos = $this->helpCatDao->selectByFilter($helpCatVo, array(), $start, $recSize);
        
        //add info
        foreach($helpCatVos as $helpCatVo){
        	$this->_add_info($helpCatVo);
        }
        
        //set data
        $paging->items = $helpCatVos;	
        
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
    			$helpCatVo = new HelpCatVo();
    			$helpCatVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($helpCatVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$helpCatVo = new HelpCatVo();
    			$helpCatVo->name = trim($_REQUEST['name']);
    			$helpCatVo->helpCatId = trim($_REQUEST['helpCatId']);
    			$validate = $this->_validate_edit($helpCatVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($helpCatInfo){
    	if(!$helpCatInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Help Cat not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($helpCatInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$helpCatVo = new HelpCatVo();
        	CTTHelper::copyProperties($this->helpCatModel, $helpCatVo);
        	
        	//add
        	$this->helpCatDao->insert($helpCatVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Help Cat add success");
            return $this->setRender('manage');
        }
        
        //set default data
        $helpCatInfo = new HelpCatVo;
        
        //send data
        $this->setAttributes(array(
        	'isAction' => true,
        	'helpCatInfo' => $helpCatInfo,
        ));
        
        return $this->setRender('popup');
    }
    
    public function edit(){
        $helpCatId = $_REQUEST['helpCatId'];
        $helpCatInfo = $this->helpCatDao->selectByPrimaryKey($helpCatId);
        
        if(!($this->_check_exist($helpCatInfo) & $this->_check_permission($helpCatInfo))){
			return $this->setRender('manage');
		}
        
        //add info
        $this->_add_info($helpCatInfo);
        
        //send data
        $this->setAttributes(array(
        	'helpCatInfo' => $helpCatInfo,
        	'isAction' => true
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$helpCatVo = new HelpCatVo();
        	CTTHelper::copyProperties($this->helpCatModel, $helpCatVo);
        	
        	//update
        	$this->helpCatDao->updateByPrimaryKey($helpCatVo, $helpCatId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Help Cat update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('popup');
    }
    
    public function delete() {
    	if(isset($_REQUEST['helpCatId'])){
			$helpCatId = $_REQUEST['helpCatId'];
			$helpCatInfo = $this->helpCatDao->selectByPrimaryKey($helpCatId);
			
			if(!($this->_check_exist($helpCatInfo) & $this->_check_permission($helpCatInfo))){
				return $this->setRender('manage');
			}
    		
			//check help item in help_cat
			$sql = "select * from help where help_cat_id=:helpCatId";
			$params = array(
				array(':helpCatId', $helpCatId),
			);
			$query = DataBaseHelper::query($sql, $params);
			if($query){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Category not delete because this have help item.");
				return $this->setRender('success');
			}
			else{
				$this->helpCatDao->deleteByPrimaryKey($helpCatId);
				SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
			}
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