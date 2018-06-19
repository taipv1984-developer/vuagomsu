<?php
class AdminEmailTemplateController extends Controller {
	private $emailTemplateDao;
    public $emailTemplateModel;
    
    function __construct(){
    	$this->emailTemplateDao = new EmailTemplateDao();
    	$this->emailTemplateModel = new EmailTemplateModel();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the key should not duplicate in the table 
    	$emailTemplateVo = new EmailTemplateVo();
    	$emailTemplateVo->key = $addVo->key;
    	$emailTemplateVos = $this->emailTemplateDao->selectByFilter($emailTemplateVo);
    	if($emailTemplateVos){
			$validate["emailTemplateModel.key"] = e("Email Template key is exist");
    	}
    		
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the key should not duplicate in the table 
    	$emailTemplateVo = new EmailTemplateVo();
    	$emailTemplateVo->key = $editVo->key;
    	$emailTemplateVos = $this->emailTemplateDao->selectByFilter($emailTemplateVo);
    	if($emailTemplateVos){
    		$emailTemplate = $emailTemplateVos[0];
    		if($emailTemplate->emailTemplateId != $editVo->emailTemplateId) {
    			$validate["emailTemplateModel.key"] = e("Email Template key is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($emailTemplateVo){
    	//note
    	$emailTemplateVo->note = StringHelper::subString($emailTemplateVo->note);
    }
    
    private function _filter($emailTemplateVo){
    	$emailTemplateVo->status = 'A';
    	
    	if(!CTTHelper::isEmptyString($this->emailTemplateModel->emailTemplateId)) {
    		$emailTemplateVo->emailTemplateId = $this->emailTemplateModel->emailTemplateId;
    	}
    	if(!CTTHelper::isEmptyString($this->emailTemplateModel->key)) {
    		$emailTemplateVo->key = array('like', "%{$this->emailTemplateModel->key}%");
    	}
    	if(!CTTHelper::isEmptyString($this->emailTemplateModel->subject)) {
    		$emailTemplateVo->subject = array('like', "%{$this->emailTemplateModel->subject}%");
    	}
    }
    
	public function manage(){
        $emailTemplateVo = new EmailTemplateVo();
        
        //filter
        $this->_filter($emailTemplateVo);
        
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
        //$count = $this->emailTemplateDao->selectCountByFilter($emailTemplateVo);
        $count = count($this->emailTemplateDao->selectByFilter($emailTemplateVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $emailTemplateVos = $this->emailTemplateDao->selectByFilter($emailTemplateVo, array(), $start, $recSize);
        
        //add info
        foreach($emailTemplateVos as $emailTemplateVo){
        	$this->_add_info($emailTemplateVo);
        }
        
        //set data
        $paging->items = $emailTemplateVos;
        
        //send data
        $this->setAttributes(array('pageView' => $paging));
        
        //call view
        return $this->setRender('success');
    }
    
    public function manage_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'change_status':
    			//...
    			break;
    	}
    	
    	return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$emailTemplateVo = new EmailTemplateVo();
    			$emailTemplateVo->key = $_REQUEST['key'];
    			$validate = $this->_validate_add($emailTemplateVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$emailTemplateVo = new EmailTemplateVo();
    			$emailTemplateVo->key = $_REQUEST['key'];
    			$emailTemplateVo->emailTemplateId = $_REQUEST['emailTemplateId'];
    			$validate = $this->_validate_edit($emailTemplateVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$emailTemplateVo = new EmailTemplateVo();
        	CTTHelper::copyProperties($this->emailTemplateModel, $emailTemplateVo);
        	
        	//add
        	$this->emailTemplateDao->insert($emailTemplateVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Email Template add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        ));
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function edit(){
        $emailTemplateId = $_REQUEST['emailTemplateId'];
        $emailTemplateInfo = $this->emailTemplateDao->selectByPrimaryKey($emailTemplateId);
        
        //validate emailTemplateId
        if(!$emailTemplateInfo){
        	SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Email Template not exist");
        	return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        	'emailTemplateInfo' => $emailTemplateInfo
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$emailTemplateVo = new EmailTemplateVo();
        	CTTHelper::copyProperties($this->emailTemplateModel, $emailTemplateVo);
        	$emailTemplateVo->modDate = DateHelper::getDateTime();
        	
        	//update
        	$this->emailTemplateDao->updateByPrimaryKey($emailTemplateVo, $emailTemplateId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Email Template update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function delete() {
    	$emailTemplateId = $_REQUEST['emailTemplateId'];
    	$this->emailTemplateDao->deleteByPrimaryKey($emailTemplateId);

    	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	return $this->setRender('success');
    }
}