<?php
class AdminPluginController extends Controller {
	private $pluginDao;
    public $pluginModel;
    
    function __construct(){
    	$this->pluginDao = new PluginDao();
    	$this->pluginModel = new PluginModel();
    	
    	//test
    	$pluginInfo = $this->pluginDao->selectByPrimaryKey(3);
//     	$this->plugin_action($pluginInfo);

    	//updating...
//     	PluginHelper::deleteFile($pluginInfo);
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the pluginCode should not duplicate in the table 
    	$pluginVo = new PluginVo();
    	$pluginVo->pluginCode = $addVo->pluginCode;
    	$pluginVos = $this->pluginDao->selectByFilter($pluginVo);
    	if($pluginVos){
			$validate["pluginModel.pluginCode"] = e("Plugin pluginCode is exist");
    	}
    	
    	$pluginCode = $addVo->pluginCode;
    	$actionFile = PLUGIN_PATH."$pluginCode/action.php";
    	if(!file_exists($actionFile)){
    		$validate["pluginModel.pluginCode"] = e("Not found file: plugin/$pluginCode/action.php");
    	}
    	$action_configFile = PLUGIN_PATH."$pluginCode/config/action_config.php";
    	if(!file_exists($action_configFile)){
    		$validate["pluginModel.pluginCode"] = e("Not found file: plugin/$pluginCode/config/action_config.php");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the pluginCode should not duplicate in the table 
    	$pluginVo = new PluginVo();
    	$pluginVo->pluginCode = $editVo->pluginCode;
    	$pluginVos = $this->pluginDao->selectByFilter($pluginVo);
    	if($pluginVos){
    		$plugin = $pluginVos[0];
    		if($plugin->pluginId != $editVo->pluginId) {
    			$validate["pluginModel.pluginCode"] = e("Plugin pluginCode is exist");
			}
    	}
    	
    	$pluginCode = $editVo->pluginCode;
    	$actionFile = PLUGIN_PATH."$pluginCode/action.php";
    	if(!file_exists($actionFile)){
    		$validate["pluginModel.pluginCode"] = e("Not found file: plugin/$pluginCode/action.php");
    	}
    	$action_configFile = PLUGIN_PATH."$pluginCode/config/action_config.php";
    	if(!file_exists($action_configFile)){
    		$validate["pluginModel.pluginCode"] = e("Not found file: plugin/$pluginCode/config/action_config.php");
    	}
    	
    	return $validate;
    }
    
    private function _add_info($pluginVo){
    	$info = json_decode($pluginVo->info);
    	//name
    	$pluginVo->name = $info->name;
    	//description
    	$pluginVo->description = $info->description;
    }
    
    private function _filter($pluginVo){
    	if(!CTTHelper::isEmptyString($this->pluginModel->pluginId)) {
    		$pluginVo->pluginId = $this->pluginModel->pluginId;
    	}
    	if(!CTTHelper::isEmptyString($this->pluginModel->pluginCode)) {
    		$pluginVo->pluginCode = array('like', "%{$this->pluginModel->pluginCode}%");
    	}
        if(!CTTHelper::isEmptyString($this->pluginModel->status)) {
            $pluginVo->status = $this->pluginModel->status;
        }
    }
    
	public function manage(){
        $pluginVo = new PluginVo();
        
        //filter
        $this->_filter($pluginVo);
        
        //orderBy
        $orderBy = array('priority' => 'ASC', 'plugin_id' => 'DESC');
        
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
        $count = count($this->pluginDao->selectByFilter($pluginVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $pluginVos = $this->pluginDao->selectByFilter($pluginVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($pluginVos as $pluginVo){
        	$this->_add_info($pluginVo);
        }
        
        //set data
        $paging->items = $pluginVos;	
        
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
    			$pluginId = $_REQUEST['id'];
    			$status = $_REQUEST['value'];
    			$pluginVo = new PluginVo();
    			$pluginVo->status = $status;
    			$this->pluginDao->updateByPrimaryKey($pluginVo, $pluginId);
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
    			$pluginVo = new PluginVo();
    			$pluginVo->pluginCode = trim($_REQUEST['pluginCode']);
    			$validate = $this->_validate_add($pluginVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$pluginVo = new PluginVo();
    			$pluginVo->pluginCode = trim($_REQUEST['pluginCode']);
    			$pluginVo->pluginId = $_REQUEST['pluginId'];
    			$validate = $this->_validate_edit($pluginVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($pluginInfo){
    	if(!$pluginInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Plugin not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($pluginInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$pluginVo = new PluginVo();
        	CTTHelper::copyProperties($this->pluginModel, $pluginVo);
        	//info
        	$info = PluginHelper::getPluginInfo($pluginVo->pluginCode);
        	$pluginVo->info = json_encode($info);
        	$pluginVo->fileList = '[]';
        	
        	//add
        	$pluginId = $this->pluginDao->insert($pluginVo);
        	
        	//run install file
        	PluginHelper::callbackInstall($pluginVo->pluginCode);
        	
        	//plugin_action
        	$pluginInfo = $this->pluginDao->selectByPrimaryKey($pluginId);
        	$this->plugin_action($pluginInfo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Plugin add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $pluginId = $_REQUEST['pluginId'];
        $pluginInfo = $this->pluginDao->selectByPrimaryKey($pluginId);
        
        if(!($this->_check_exist($pluginInfo) & $this->_check_permission($pluginInfo))){
			return $this->setRender('manage');
		}
        
		//add info
		$pluginCode = $pluginInfo->pluginCode;
		$info = PluginHelper::getPluginInfo($pluginCode);
		$infoView = "";
		foreach ($info as $k => $v){
			if(!is_array($v)){
				$infoView .= "<span style='width: 100px; float: left; color: brown;'>$k</span><span style=''>$v</span><br>";
			}
			else{
				$infoView .= "<span style='width: 100px; float: left; color: brown;'>$k</span>";
				foreach ($v as $_k => $_v){
					if(!is_array($_v)){
						$infoView .= "<br><span class='left'>$_k <i class='fa fa-long-arrow-right'></i> $_v</span>";
					}
					else{
						$infoView .= "<br><span class='left'>$_k <i class='fa fa-long-arrow-right'></i> [array]</span>";
					}
				}
			}
			$infoView .= '<div class="clear"></div>';
		}
		$pluginInfo->infoView = $infoView;
		
        //send data
        $this->setAttributes(array(
        	'pluginInfo' => $pluginInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$pluginVo = new PluginVo();
        	CTTHelper::copyProperties($this->pluginModel, $pluginVo);
        	//info
        	$pluginVo->info = json_encode($info);
        	
        	//update
        	$this->pluginDao->updateByPrimaryKey($pluginVo, $pluginId);
        	
        	//run upgrade file
        	PluginHelper::callbackUpgrade($pluginVo->pluginCode);
        	
        	//plugin_action
        	$this->plugin_action($pluginInfo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Plugin update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }

    public function delete() {
    	if(isset($_REQUEST['pluginId'])){
			$pluginId = $_REQUEST['pluginId'];
			$pluginInfo = $this->pluginDao->selectByPrimaryKey($pluginId);
			
			//check later
			//...
			
			//run uninstall file
			PluginHelper::callbackUninstall($pluginInfo->pluginCode);
			
			//delete plugin
			PluginHelper::delete($pluginInfo->pluginCode);
			
			//message
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
    
    /************************
     * PLUGIN ACTION
     ***********************/
    /**
     * include function use add and edit function
     */
    private function plugin_action($pluginInfo){
    	$pluginCode = $pluginInfo->pluginCode;
    	
    	//setup navLink (add or skip)
    	PluginHelper::setupNavLink($pluginCode);
    	
    	//setup widget (add or edit)
    	PluginHelper::setupWidget($pluginCode);
    	
    	//setup navLink (add or skip)
    	PluginHelper::setupPage($pluginCode);
    	 
    	//copyFile
    	PluginHelper::copyFile($pluginInfo);
    }
}