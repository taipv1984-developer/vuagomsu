<?php
class AdminAdminController extends Controller {
	private $adminDao;
    public $adminModel;
    private $adminDetailDao;
    public $adminDetailModel;
    
    function __construct(){
    	$this->adminDao = new AdminDao();
    	$this->adminModel = new AdminModel();
    	$this->adminDetailDao = new AdminDetailDao();
    	$this->adminDetailModel = new AdminDetailModel();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the username should not duplicate in the table 
    	$adminVo = new AdminVo();
    	$adminVo->username = $addVo->username;
    	$adminVos = $this->adminDao->selectByFilter($adminVo);
    	if($adminVos){
			$validate["adminModel.username"] = e("Admin username is exist");
    	}
    	
    	//the email should not duplicate in the table
    	$adminVo = new AdminVo();
    	$adminVo->email = $addVo->email;
    	$adminVos = $this->adminDao->selectByFilter($adminVo);
    	if($adminVos){
    		$validate["adminModel.email"] = e("Admin email is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the username should not duplicate in the table 
    	$adminVo = new AdminVo();
    	$adminVo->username = $editVo->username;
    	$adminVos = $this->adminDao->selectByFilter($adminVo);
    	if($adminVos){
    		$admin = $adminVos[0];
    		if($admin->adminId != $editVo->adminId) {
    			$validate["adminModel.username"] = e("Admin username is exist");
			}
    	}
    	
    	//the email should not duplicate in the table
    	$adminVo = new AdminVo();
    	$adminVo->email = $editVo->email;
    	$adminVos = $this->adminDao->selectByFilter($adminVo);
    	if($adminVos){
    		$admin = $adminVos[0];
    		if($admin->adminId != $editVo->adminId) {
    			$validate["adminModel.email"] = e("Admin email is exist");
    		}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($adminVo, $roleArray){
    	//roleName
    	$adminVo->roleName = $roleArray[$adminVo->roleId];
    }
    
    private function getFilter(){	
    	$filter = array();
    	//adminId
    	if(!CTTHelper::isEmptyString($this->adminModel->adminId)){
    		$filter['a.admin_id'] = $this->adminModel->adminId;
    	}
    	//roleId
    	if(!CTTHelper::isEmptyString($_REQUEST['adminModel_roleName'])){
    		$filter['a.role_id'] = $_REQUEST['adminModel_roleName'];
    	}
    	//username			like
    	if(!CTTHelper::isEmptyString($this->adminModel->username)){
    		$filter['a.username'] = array('like', '%'.$this->adminModel->username.'%');
    	}
    	//email			like
    	if(!CTTHelper::isEmptyString($this->adminModel->email)){
    		$filter['a.email'] = array('like', '%'.$this->adminModel->email.'%');
    	}
    	//phone		like
    	if(!CTTHelper::isEmptyString($_REQUEST['adminModel_phone'])){
    		$filter['ad.phone'] = array('like', '%'.$_REQUEST['adminModel_phone'].'%');
    	}
    	//status
    	if(!CTTHelper::isEmptyString($this->adminModel->status)){
    		$filter['a.status'] = $this->adminModel->status;
    	}
    	return $filter;
    }
    
	public function manage(){
        $adminVo = new AdminVo();
        
        //filter
        $filter = $this->getFilter();
        //orderBy
        $orderBy = array('a.admin_id' => 'DESC');
        
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
        $count = count(AdminExt::getAdminList($filter));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $adminVos = AdminExt::getAdminList($filter, $orderBy, $start, $recSize);
        
        //add info
        $roleArray = RoleExt::getRoleArray('backend');
        foreach($adminVos as $adminVo){
        	$this->_add_info($adminVo, $roleArray);
        }
        
        //set data
        $paging->items = $adminVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging,
        	'roleArray' => $roleArray
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function manage_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'change_status_ajax':
    			$adminId = $_REQUEST['id'];
    			$status = $_REQUEST['value'];
    			$adminVo = new AdminVo();
    			$adminVo->status = $status;
    			$this->adminDao->updateByPrimaryKey($adminVo, $adminId);
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
    			$adminVo = new AdminVo();
    			$adminVo->username = trim($_REQUEST['username']);
    			$adminVo->email = trim($_REQUEST['email']);
    			$validate = $this->_validate_add($adminVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$adminVo = new AdminVo();
    			$adminVo->username = trim($_REQUEST['username']);
    			$adminVo->email = trim($_REQUEST['email']);
    			$adminVo->adminId = $_REQUEST['adminId'];
    			$validate = $this->_validate_edit($adminVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($adminInfo){
    	if(!$adminInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Admin not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($adminInfo){
    	return true;
    }
    
    /**
     * validatePasswordChange of adminId	OK
     * call in account funtion
     *
     * @return boolean
     */
    private function validatePasswordChange($adminId, $currentPassword, $newPassword, $confirmNewPassword){
    	$error = 0;
    	//check $currentPassword exist
    	$adminInfo = $this->adminDao->selectByPrimaryKey($adminId);
    	if($adminInfo->password != md5($currentPassword)){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Current password incorect'));
    		$error = 1;
    		return false;
    	}
    	//check compare $newPassword and $confirmNewPassword
    	if($newPassword != $confirmNewPassword){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Passwords do not match!!'));
    		$error = 1;
    		return false;
    	}
    	//return
    	if($this->hasErrors()|| $error){
    		return false;
    	}
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$adminVo = new AdminVo();
        	CTTHelper::copyProperties($this->adminModel, $adminVo);
        	//languageCode
        	$adminVo->languageCode = $_REQUEST['language_code'];
        	//password
        	$adminVo->password = md5($adminVo->password);
        	//more
        	$adminVo->status = 'A';
        	$adminVo->loginFalse = 0;
        	$adminVo->activeCode= '';
        	$adminVo->crtBy = Session::getAdminId();
        	$adminVo->crtDate = DateHelper::getDateTime();
        	
        	//add admin
        	$adminId = $this->adminDao->insert($adminVo);
        	//add admin_detail
        	$adminDetailVo = new AdminDetailVo();
        	$adminDetailVo->adminId = $adminId;
        	$this->adminDetailDao->insert($adminDetailVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Admin add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        	'roleArray' => RoleExt::getRoleArray('backend'),
        	'languageList' => LanguageExt::getLanguageList(),
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $adminId = $_GET['adminId'];
        $adminInfo = $this->adminDao->selectByPrimaryKey($adminId);
        
        if(!($this->_check_exist($adminInfo) & $this->_check_permission($adminInfo))){
			return $this->setRender('manage');
		}
		
		//get adminDetailInfo
		$adminDetailInfo = new AdminDetailVo();
		$adminDetailVo = new AdminDetailVo();
		$adminDetailVo->adminId = $adminId;
		$adminDetailVos = $this->adminDetailDao->selectByFilter($adminDetailVo);
		if($adminDetailVos){
			$adminDetailInfo = $adminDetailVos[0];
		}
		else{
			//create new adminDetail
			$adminDetailInfo->adminDetailId = $this->adminDetailDao->insert($adminDetailVo);
		}
		
		//send data
		$this->setAttributes(array(
			'adminInfo' => $adminInfo,
			'adminDetailInfo' => $adminDetailInfo,
			'roleArray' => RoleExt::getRoleArray('backend'),
			'languageList' => LanguageExt::getLanguageList(),
		));
     
    	if($_SERVER['REQUEST_METHOD'] === 'POST'){
    		//1 	update admin		
    		$adminVo = new AdminVo();
    			
			//get request password value
			$currentPassword 		= trim($_REQUEST['current_password']);
			$newPassword 			= trim($_REQUEST['new_password']);
			$confirmNewPassword 	= trim($_REQUEST['confirm_new_password']);

			//update password
			if($currentPassword != '' & $newPassword != '' & $confirmNewPassword != ''){
				if(!$this->validatePasswordChange($adminId, $currentPassword, $newPassword, $confirmNewPassword)){
					SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Current password incorect'));
					return $this->setRender('manage');
				}
				$adminVo->password = md5($newPassword);
			}
			//languageCode
			$adminVo->languageCode = $_REQUEST['language_code'];
			//update role_id
			$adminVo->roleId = $_REQUEST['role_id'];
			$this->adminDao->updateByPrimaryKey($adminVo, $adminId);

    		//2 	update admin information
			//get data from $_REQUEST
			$adminDetailVo = new AdminDetailVo();
			CTTHelper::copyProperties($this->adminDetailModel, $adminDetailVo);
			//image
			$adminDetailVo->image = str_replace(URLHelper::getBaseUrl()."/", '', $_REQUEST['image']);
			
			//update
			$this->adminDetailDao->updateByPrimaryKey($adminDetailVo, $adminDetailInfo->adminDetailId);
			
			//message
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Update successful'));
			return $this->setRender('manage');
    	}
        
        return $this->setRender('success');
    }
    
    public function delete() {
    	if(isset($_REQUEST['adminId'])){
			$adminId = $_REQUEST['adminId'];
			
			$error = false;
	   		$adminId_system = array(1);
	   		if(in_array($adminId, $adminId_system)){
	   			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Not delete admin account system');
	   			$error = true;
	   		}
	   		
	   		if(!$error){
	   			//delete admin and admin_detail
	   			AdminExt::deleteAdmin($adminId);
		   		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
	   		}
    	}
    	return $this->setRender('success');
    }
}
