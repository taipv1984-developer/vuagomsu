<?php
class AdminNewsletterController extends Controller {
	private $newsletterDao;
    public $newsletterModel;
    private $pluginCode;
    
    function __construct(){
    	$this->newsletterDao = new NewsletterDao();
    	$this->newsletterModel = new NewsletterModel();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$newsletterVo = new NewsletterVo();
    	$newsletterVo->name = $addVo->name;
    	$newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo);
    	if($newsletterVos){
			$validate["newsletterModel.name"] = e("Newsletter name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$newsletterVo = new NewsletterVo();
    	$newsletterVo->name = $editVo->name;
    	$newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo);
    	if($newsletterVos){
    		$newsletter = $newsletterVos[0];
    		if($newsletter->Array != $editVo->Array) {
    			$validate["newsletterModel.name"] = e("Newsletter name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($newsletterVo){
    	//...
    }
    
    private function _filter($newsletterVo){
    	if(!CTTHelper::isEmptyString($this->newsletterModel->newsletterId)) {
    		$newsletterVo->newsletterId = $this->newsletterModel->newsletterId;
    	}
    	if(!CTTHelper::isEmptyString($this->newsletterModel->email)) {
    		$newsletterVo->email = array('like', "%{$this->newsletterModel->email}%");
    	}
    	if(!CTTHelper::isEmptyString($this->newsletterModel->subscribe)) {
    		$newsletterVo->subscribe = $this->newsletterModel->subscribe;
    	}
    }

	public function manage(){
        $newsletterVo = new NewsletterVo();
        
        //filter
        $this->_filter($newsletterVo);
        
        //orderBy
        $orderBy = array('newsletter_id' => 'DESC');
        
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
        $count = count($this->newsletterDao->selectByFilter($newsletterVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($newsletterVos as $newsletterVo){
        	$this->_add_info($newsletterVo);
        }
        
        //set data
        $paging->items = $newsletterVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function manage_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'change_subscribe_ajax':
    			$newsletterVo = new NewsletterVo();
    			$newsletterVo->subscribe = $_REQUEST['value'];
    			$this->newsletterDao->updateByPrimaryKey($newsletterVo, $_REQUEST['id']);
    			break;
    		default:
    			break;
    	}
    	
    	return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$newsletterVo = new NewsletterVo();
    			$newsletterVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($newsletterVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$newsletterVo = new NewsletterVo();
    			$newsletterVo->name = trim($_REQUEST['name']);
    			$newsletterVo->newsletterId = $_REQUEST['newsletterId'];
    			$validate = $this->_validate_edit($newsletterVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($newsletterInfo){
    	if(!$newsletterInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Newsletter not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($newsletterInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$newsletterVo = new NewsletterVo();
        	CTTHelper::copyProperties($this->newsletterModel, $newsletterVo);
        	$newsletterVo->crtBy = Session::getAdminId();
        	$newsletterVo->crtDate = DateHelper::getDateTime();
        	
        	//add
        	$this->newsletterDao->insert($newsletterVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Newsletter add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function edit(){
        $newsletterId = $_REQUEST['newsletterId'];
        $newsletterInfo = $this->newsletterDao->selectByPrimaryKey($newsletterId);
        
        if(!($this->_check_exist($newsletterInfo) & $this->_check_permission($newsletterInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'newsletterInfo' => $newsletterInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$newsletterVo = new NewsletterVo();
        	CTTHelper::copyProperties($this->newsletterModel, $newsletterVo);
        	$newsletterVo->modBy = Session::getAdminId();
        	$newsletterVo->modDate = DateHelper::getDateTime();
        	
        	//update
        	$this->newsletterDao->updateByPrimaryKey($newsletterVo, $newsletterId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Newsletter update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function view(){
    	$newsletterId = $_REQUEST['newsletterId'];
    	$newsletterVo = $this->newsletterDao->selectByPrimaryKey($newsletterId);
    
    	//validate newsletterId
    	if(!$newsletterVo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Newsletter not exist");
    		return $this->setRender('manage');
    	}
    
    	//add info
    	$this->_add_info($newsletterVo);
    	
    	//send data
    	$this->setAttributes(array(
    		'newsletter' => $newsletterVo,
    	));
    
    	//return $this->setRender('success');
    	return $this->setRender('popup');
    }
    
    public function delete() {
    	if(isset($_REQUEST['newsletterId'])){
			$newsletterId = $_REQUEST['newsletterId'];
			
			$this->newsletterDao->deleteByPrimaryKey($newsletterId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
}