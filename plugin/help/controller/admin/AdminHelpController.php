<?php

class AdminHelpController extends Controller {
	private $helpDao;
    public $helpModel;
    public $helpCatDao;
    
    function __construct(){
    	$this->helpDao = new HelpDao();
	    $this->helpCatDao = new HelpCatDao();
    	$this->helpModel = new HelpModel();

    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	 
    	//the title should not duplicate in the table
    	$helpVo = new HelpVo();
    	$helpVo->title = $addVo->title;
    	$helpVo->helpCatId = $addVo->helpCatId;
    	$helpVos = $this->helpDao->selectByFilter($helpVo);
    	if($helpVos){
    		$validate["helpModel.title"] = e("Help title is exist");
    	}
    	 
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	 
    	//the title should not duplicate in the table
    	$helpVo = new HelpVo();
    	$helpVo->title = $editVo->title;
    	$helpVo->helpCatId = $editVo->helpCatId;
    	$helpVos = $this->helpDao->selectByFilter($helpVo);
    	if($helpVos){
    		$help = $helpVos[0];
    		if($help->helpId != $editVo->helpId) {
    			$validate["helpModel.title"] = e("Help title is exist");
    		}
    	}
    	 
    	return $validate;
    }
    
    private function _add_info($helpVo){
    	//helpCatName
    	$helpVo->helpCatName = $this->helpCatDao->getValueByPrimaryKey('name', $helpVo->helpCatId);
    }
    
    private function _filter($helpVo){
    	if(!CTTHelper::isEmptyString($this->helpModel->helpId)) {
    		$helpVo->helpId = $this->helpModel->helpId;
    	}
    	if(!CTTHelper::isEmptyString($this->helpModel->title)) {
    		$helpVo->title = array(array('dk' => 'like', $this->helpModel->title));
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['helpModel_helpCatName'])) {
    		$helpVo->helpCatId = $_REQUEST['helpModel_helpCatName'];
    	}
    }
    
	public function manage(){
        $helpVo = new HelpVo();
        
        //filter
        $this->_filter($helpVo);
        $order = array('help_id' => 'ASC');	//DESC
        
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
        $count = count($this->helpDao->selectByFilter($helpVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $helpVos = $this->helpDao->selectByFilter($helpVo, $order, $start, $recSize);
        
        //add info
        foreach($helpVos as $helpVo){
        	$this->_add_info($helpVo);
        }
        
        //set data
        $paging->items = $helpVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging,
        	'helpCat' => HelpExt::getHelpCategoryArray(),
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$helpVo = new HelpVo();
    			$helpVo->title = trim($_REQUEST['title']);
    			$helpVo->helpCatId = trim($_REQUEST['helpCatId']);
    			$validate = $this->_validate_add($helpVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$helpVo = new HelpVo();
    			$helpVo->title = trim($_REQUEST['title']);
    			$helpVo->helpId = trim($_REQUEST['helpId']);
    			$helpVo->helpCatId = trim($_REQUEST['helpCatId']);
    			$validate = $this->_validate_edit($helpVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    
    	return $this->setRender('success');
    }
    
    public function help_list(){
    	
    	//send data
    	$this->setAttributes(array(
    		'helpCat' => HelpExt::getHelpCategoryArray(),
    		'helpArray' => HelpExt::getHelpArray()
    	));
    	
    	//call view
    	return $this->setRender('success');
    }
    
    private function _check_exist($helpInfo){
    	if(!$helpInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Help not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($helpInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$helpVo = new HelpVo();
        	CTTHelper::copyProperties($this->helpModel, $helpVo);
        	
        	//add
        	$this->helpDao->insert($helpVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Help add success");
            return $this->setRender('manage');
        }
        
        //set default data
        $helpInfo = new HelpVo;
        
        //send data
        $this->setAttributes(array(
        	'isAction' => true,
        	'helpInfo' => $helpInfo,
        	'helpCat' => HelpExt::getHelpCategoryArray(),
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $helpId = $_REQUEST['helpId'];
        $helpInfo = $this->helpDao->selectByPrimaryKey($helpId);
        
        if(!($this->_check_exist($helpInfo) & $this->_check_permission($helpInfo))){
			return $this->setRender('manage');
		}
        
        //add info
        $this->_add_info($helpInfo);
        
        //send data
        $this->setAttributes(array(
        	'helpInfo' => $helpInfo,
        	'isAction' => true,
        	'helpCat' => HelpExt::getHelpCategoryArray(),
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$helpVo = new HelpVo();
        	CTTHelper::copyProperties($this->helpModel, $helpVo);
        	
        	//update
        	$this->helpDao->updateByPrimaryKey($helpVo, $helpId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Help update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function view(){
    	$helpId = $_REQUEST['helpId'];
    	$helpInfo = $this->helpDao->selectByPrimaryKey($helpId);
    
    	if(!($this->_check_exist($helpInfo) & $this->_check_permission($helpInfo))){
    		return $this->setRender('manage');
    	}
    
    	//add info
    	$this->_add_info($helpInfo);
    
    	//send data
    	$this->setAttributes(array(
    		'helpInfo' => $helpInfo,
    		'isAction' => true,
    		'relatedList' => HelpExt::getRelatedList($helpInfo->helpCatId),
    	));
    
    	return $this->setRender('success');
    }
    
    public function delete() {
    	if(isset($_REQUEST['helpId'])){
			$helpId = $_REQUEST['helpId'];
			$helpInfo = $this->helpDao->selectByPrimaryKey($helpId);
			
			if(!($this->_check_exist($helpInfo) & $this->_check_permission($helpInfo))){
				return $this->setRender('manage');
			}
    		
			$this->helpDao->deleteByPrimaryKey($helpId);
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