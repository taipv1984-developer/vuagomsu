<?php
class AdminCustomerReviewController extends Controller {
	private $customerReviewDao;
    public $customerReviewModel;
    private $pluginCode;
    
    function __construct(){
    	$this->customerReviewDao = new CustomerReviewDao();
    	$this->customerReviewModel = new CustomerReviewModel();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$customerReviewVo = new CustomerReviewVo();
    	$customerReviewVo->name = $addVo->name;
    	$customerReviewVos = $this->customerReviewDao->selectByFilter($customerReviewVo);
    	if($customerReviewVos){
			$validate["customerReviewModel.name"] = e("Customer Review name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$customerReviewVo = new CustomerReviewVo();
    	$customerReviewVo->name = $editVo->name;
    	$customerReviewVos = $this->customerReviewDao->selectByFilter($customerReviewVo);
    	if($customerReviewVos){
    		$customerReview = $customerReviewVos[0];
    		if($customerReview->customerReviewId != $editVo->customerReviewId) {
    			$validate["customerReviewModel.name"] = e("Customer Review name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($customerReviewVo){
    	$customerReviewVo->career = StringHelper::subString($customerReviewVo->career);
    	$customerReviewVo->title = StringHelper::subString($customerReviewVo->title);
    	$customerReviewVo->content = StringHelper::subString($customerReviewVo->content);
    }
    
    private function _filter($customerReviewVo){
    	if(!CTTHelper::isEmptyString($this->customerReviewModel->customerReviewId)) {
    		$customerReviewVo->customerReviewId = $this->customerReviewModel->customerReviewId;
    	}
    	if(!CTTHelper::isEmptyString($this->customerReviewModel->career)) {
    		$customerReviewVo->career = array('like', "%{$this->customerReviewModel->career}%");
    	}
    	if(!CTTHelper::isEmptyString($this->customerReviewModel->title)) {
    		$customerReviewVo->title = array('like', "%{$this->customerReviewModel->title}%");
    	}
    	if(!CTTHelper::isEmptyString($this->customerReviewModel->content)) {
    		$customerReviewVo->content = array('like', "%{$this->customerReviewModel->content}%");
    	}
    	if(!CTTHelper::isEmptyString($this->customerReviewModel->status)) {
    		$customerReviewVo->status = $this->customerReviewModel->status;
    	}
    }
    
	public function manage(){
        $customerReviewVo = new CustomerReviewVo();
        
        //filter
        $this->_filter($customerReviewVo);
        
        //orderBy
        $orderBy = array('customer_review_id' => 'DESC');
        
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
        $count = count($this->customerReviewDao->selectByFilter($customerReviewVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $customerReviewList = $this->customerReviewDao->selectByFilter($customerReviewVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($customerReviewList as $v){
        	$this->_add_info($v);
        }
        
        //set data
        $paging->items = $customerReviewList;	
        
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
    		case 'change_status_ajax':
    			$customerReviewVo = new CustomerReviewVo();
    			$customerReviewVo->status = $_REQUEST['value'];
    			$this->customerReviewDao->updateByPrimaryKey($customerReviewVo, $_REQUEST['id']);
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
    			$customerReviewVo = new CustomerReviewVo();
    			$customerReviewVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($customerReviewVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$customerReviewVo = new CustomerReviewVo();
    			$customerReviewVo->name = trim($_REQUEST['name']);
    			$customerReviewVo->customerReviewId = $_REQUEST['customerReviewId'];
    			$validate = $this->_validate_edit($customerReviewVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($customerReviewInfo){
    	if(!$customerReviewInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Customer Review not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($customerReviewInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$customerReviewVo = new CustomerReviewVo();
        	CTTHelper::copyProperties($this->customerReviewModel, $customerReviewVo);
        	//image
        	$customerReviewVo->image = str_replace(URLHelper::getBaseUrl().'/', '', $_REQUEST['image']);
        	
        	//add
        	$this->customerReviewDao->insert($customerReviewVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Customer Review add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $customerReviewId = $_REQUEST['customerReviewId'];
        $customerReviewInfo = $this->customerReviewDao->selectByPrimaryKey($customerReviewId);
        
        if(!($this->_check_exist($customerReviewInfo) & $this->_check_permission($customerReviewInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'customerReviewInfo' => $customerReviewInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$customerReviewVo = new CustomerReviewVo();
        	CTTHelper::copyProperties($this->customerReviewModel, $customerReviewVo);
        	//image
        	$customerReviewVo->image = str_replace(URLHelper::getBaseUrl().'/', '', $_REQUEST['image']);
        	
        	//update
        	$this->customerReviewDao->updateByPrimaryKey($customerReviewVo, $customerReviewId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Customer Review update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }

    public function delete() {
    	if(isset($_REQUEST['customerReviewId'])){
			$customerReviewId = $_REQUEST['customerReviewId'];
			
			//check later
			//...
			
			$this->customerReviewDao->deleteByPrimaryKey($customerReviewId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
}