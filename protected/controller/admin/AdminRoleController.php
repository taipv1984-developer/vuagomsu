<?php
class AdminRoleController extends Controller{
	private $roleDao;
	private $rolePermissionDao;
    public $roleModel;
    public $rolePermissionModel;
    
    function __construct(){
    	$this->roleDao = new RoleDao();
		$this->rolePermissionDao = new RolePermissionDao();
    	$this->roleModel = new RoleModel();
    	$this->rolePermissionModel = new RolePermissionModel();
   }
    
    private function _validate_add($addVo){
	   	$validate = array();
	   	 
	   	//the roleName should not duplicate in the table
	   	$roleVo = new RoleVo();
	   	$roleVo->roleName = $addVo->roleName;
	   	$roleVos = $this->roleDao->selectByFilter($roleVo);
	   	if($roleVos){
	   		$validate["roleName"] = e("Role name is exist");
	   	}
	   	 
	   	return $validate;
    }
   
    private function _validate_edit($editVo){
	   	$validate = array();
	   	 
	   	//the roleName should not duplicate in the table
	   	$roleVo = new RoleVo();
	   	$roleVo->roleName = $editVo->roleName;
	   	$roleVos = $this->roleDao->selectByFilter($roleVo);
	   	if($roleVos){
	   		$role = $roleVos[0];
	   		if($role->roleId != $editVo->roleId) {
	   			$validate["roleName"] = e("Role name is exist");
	   		}
	   	}
	   	 
	   	return $validate;
    }
   
    public function validate_ajax(){
	   	$action = $_REQUEST['action'];
	   	switch($action){
	   		case 'add':
	   			$roleVo = new RoleVo();
	   			$roleVo->roleName = trim($_REQUEST['roleName']);
	   			$validate = $this->_validate_add($roleVo);
	   			if(!empty($validate)){
	   				echo json_encode($validate);
	   			}
	   			break;
	   		case 'edit':
	   			$roleVo = new RoleVo();
	   			$roleVo->roleName = trim($_REQUEST['roleName']);
	   			$roleVo->roleId = $_REQUEST['roleId'];
	   			$validate = $this->_validate_edit($roleVo);
	   			if(!empty($validate)){
	   				echo json_encode($validate);
	   			}
	   			break;
	   	}
	    
	   	return $this->setRender('success');
    }
   
    private function _add_info($roleVo){
    	//permissionCount
    	$roleVo->permissionCount = count(RoleExt::getPermission($roleVo->roleId));
   }
   
	public function manage(){
        $rolePermissionVo = new RolePermissionVo();
        $rolePermissionVos = $this->rolePermissionDao->selectByFilter($rolePermissionVo);
        
        $roleList = $this->roleDao->selectAll();
        //add info
        foreach ($roleList as $v){
        	$this->_add_info($v);
        }
        
        $this->setAttributes(array(
        	'rolePermission' => $rolePermissionVos,
        	'roleList' => $roleList
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
    	$roleId = $_REQUEST['roleId'];
    	
    	//get $permissionGroup
    	$permissionGroup = array();
    	$actionMap = CTTConfig::Instance()->getActionMap();
    	foreach ($actionMap as $k => $v){
    		$pageName = $v['pageName'];
    		$permissionGroup["$pageName"][] = array(
    			'action' => $k,
    			'action_name' => $v['name']
    		);
    	}
    	
    	$this->setAttributes(array(
    		'permission' => RoleExt::getPermission($roleId),
    		'role' => $this->roleDao->selectByPrimaryKey($roleId),
    		'permissionGroup' => $permissionGroup
    	));
    	
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        	//update role
        	$roleVo = new RoleVo();
        	$roleVo->roleName = $_REQUEST['roleName'];
        	$this->roleDao->updateByPrimaryKey($roleVo, $roleId);
        	
        	//get $permission
        	$permission = explode(',', $_REQUEST['permission_join']);
        	
        	//update $permission to session
        	switch ($roleId){
        		case 1:
        			$_SESSION[SESSION_GROUP]['guest_permission'] = $permission;
        			break;
        		case 2:
        			$_SESSION[SESSION_GROUP]['customer_permission'] = $permission;
        			break;
        		case 4:
	        		$_SESSION[SESSION_GROUP]['admin_permission'] = $permission;
	        		break;
        	}
        	
        	//update rolePermission
            $rolePermissionVo = new RolePermissionVo();
            $rolePermissionVo->permission = json_encode($permission);
            $rolePermissionVo->status = 'A';
            $this->rolePermissionDao->updateByPrimaryKey($rolePermissionVo, $roleId);
            
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Updated successfully!'));
            return $this->setRender('manage');
        }

        return $this->setRender('success');
    }
   
    public function add(){
	   	//get $permissionGroup
	   	$permissionGroup = array();
	   	$actionMap = CTTConfig::Instance()->getActionMap();
	   	foreach ($actionMap as $k => $v){
	   		$pageName = $v['pageName'];
	   		$permissionGroup["$pageName"][] = array(
	   			'action' => $k,
	   			'action_name' => $v['name']
	   		);
	   	}
	   	 
	   	$this->setAttributes(array(
	   		'permissionGroup' => $permissionGroup
	   	));
	   	 
	   	if($_SERVER['REQUEST_METHOD'] == "POST"){
	   		//add role
	   		$roleVo = new RoleVo();
	   		$roleVo->roleName = $_REQUEST['roleName'];
			$roleVo->roleType = 'backend';
	   		$roleId = $this->roleDao->insert($roleVo);
	   		
	   		//get $permission
	   		$permission = explode(',', $_REQUEST['permission_join']);
	   		 
	   		//update $permission to session
	   		$_SESSION[SESSION_GROUP]['admin_permission'] = $permission;
	   		
	   		//update rolePermission
	   		$rolePermissionVo = new RolePermissionVo();
	   		$rolePermissionVo->roleId = $roleId;
	   		$rolePermissionVo->permission = json_encode($permission);
	   		$rolePermissionVo->status = 'A';
	   		$this->rolePermissionDao->insert($rolePermissionVo);
	   
	   		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Add successfully!'));
	   		return $this->setRender('manage');
	   	}
	   
	   	return $this->setRender('success');
    }
   
    public function delete() {
	   	if(isset($_REQUEST['roleId'])){
	   		$roleId = $_REQUEST['roleId'];
	   		
	   		$error = false;
	   		$roleId_system = array(1, 2, 3, 4);
	   		if(in_array($roleId, $roleId_system)){
	   			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Not delete role system');
	   			$error = true;
	   		}
	   		
	   		//check admin account
	   		$adminList = RoleExt::getAdminList($roleId);
	   		if($adminList){
	   			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Not delete because exsit admin account have this role.');
	   			$error = true;
	   		}
	   		
// 	   		//check customer account
// 	   		$customerList = RoleExt::getCustomerList($roleId);
// 	   		if($customerList){
// 	   			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Not delete because exsit customer account have this role.');
// 	   			$error = true;
// 	   		}
	   		
	   		if(!$error){
	   			//delete role and role_permission
		   		RoleExt::deleteRole($roleId);
		   		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
	   		}
	   	}
	   	return $this->setRender('success');
    }
}
