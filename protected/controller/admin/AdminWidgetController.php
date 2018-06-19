<?php
class AdminWidgetController extends Controller {
	private $widgetDao;
    public $widgetModel;
    
    function __construct(){
    	$this->widgetDao = new WidgetDao();
    	$this->widgetModel = new WidgetModel();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	 
    	$controller = trim($_REQUEST['controller']);
    	$pluginCode = trim($_REQUEST['pluginCode']);
    	
    	
    	//check $controllerFile is exist
    	if($pluginCode == ''){	//system
    		$controllerFile = WIDGET_PATH."$controller/$controller.php";
    	}
    	else{
    		$controllerFile = PLUGIN_PATH."$pluginCode/widget/$controller/$controller.php";
    	}
    	if(!file_exists($controllerFile)){
    		$validate["widgetModel.controller"] = e("Not found file %s", $controllerFile);
    	}
    	
    	//the controller should not duplicate in the table 
    	$widgetVo = new WidgetVo();
    	$widgetVo->controller = $addVo->controller;
    	$widgetVos = $this->widgetDao->selectByFilter($widgetVo);
    	if($widgetVos){
			$validate["widgetModel.controller"] = e("Widget controller is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	 
    	$controller = trim($_REQUEST['controller']);
    	$pluginCode = trim($_REQUEST['pluginCode']);
    	
    	
    	//check $controllerFile is exist
    	if($pluginCode == ''){	//system
    		$controllerFile = WIDGET_PATH."$controller/$controller.php";
    	}
    	else{
    		$controllerFile = PLUGIN_PATH."$pluginCode/widget/$controller/$controller.php";
    	}
    	if(!file_exists($controllerFile)){
    		$validate["widgetModel.controller"] = e("Not found file %s", $controllerFile);
    	}
    	
    	//the controller should not duplicate in the table 
    	$widgetVo = new WidgetVo();
    	$widgetVo->controller = $editVo->controller;
    	$widgetVos = $this->widgetDao->selectByFilter($widgetVo);
    	if($widgetVos){
    		$widget = $widgetVos[0];
    		if($widget->widgetId != $editVo->widgetId) {
    			$validate["widgetModel.controller"] = e("Widget controller is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($widgetVo, $widgetCatArray){
    	//pluginCode
//     	$widgetVo->pluginCode = ($widgetVo->pluginCode != '') ? $widgetVo->pluginCode : 'system';
    	//widgetCatName
    	$widgetVo->widgetCatName = $widgetCatArray[$widgetVo->widgetCatId];
    }
    
    private function _filter($widgetVo){
    	if(!CTTHelper::isEmptyString($this->widgetModel->widgetId)) {
    		$widgetVo->widgetId = $this->widgetModel->widgetId;
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['widgetModel_widgetCatName'])) {
    		$widgetVo->widgetCatId = $_REQUEST['widgetModel_widgetCatName'];
    	}
    	if(!CTTHelper::isEmptyString($this->widgetModel->controller)) {
    		$widgetVo->controller = array('like', "%{$this->widgetModel->controller}%");
    	}
    	if(!CTTHelper::isEmptyString($this->widgetModel->name)) {
    		$widgetVo->name = array('like', "%{$this->widgetModel->name}%");
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['widgetModel_pluginCode'])) {
    		$pluginCode = $_REQUEST['widgetModel_pluginCode'];
    		if($pluginCode == 'system') $pluginCode = '';
    		$widgetVo->pluginCode = $pluginCode;
    	}
    }
    
	public function manage(){
        $widgetVo = new WidgetVo();
        
        //filter
        $this->_filter($widgetVo);
        
        //orderBy
        $orderBy = array('widget_id' => 'ASC');
        
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
        $count = count($this->widgetDao->selectByFilter($widgetVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $widgetVos = $this->widgetDao->selectByFilter($widgetVo, $orderBy, $start, $recSize);
        
        $widgetCatArray = WidgetExt::getWidgetCatArray();
        $pluginCodeArray = WidgetExt::getPluginCodeArray();
        
        //add info
        foreach($widgetVos as $widgetVo){
        	$this->_add_info($widgetVo, $widgetCatArray);
        }
        
        //set data
        $paging->items = $widgetVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging,
        	'widgetCatArray' => $widgetCatArray,
        	'pluginCodeArray' => $pluginCodeArray
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$widgetVo = new WidgetVo();
    			$widgetVo->controller = trim($_REQUEST['controller']);
    			$validate = $this->_validate_add($widgetVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$widgetVo = new WidgetVo();
    			$widgetVo->controller = trim($_REQUEST['controller']);
    			$widgetVo->widgetId = $_REQUEST['widgetId'];
    			$validate = $this->_validate_edit($widgetVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($widgetInfo){
    	if(!$widgetInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Widget not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($widgetInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$widgetVo = new WidgetVo();
        	CTTHelper::copyProperties($this->widgetModel, $widgetVo);
        	
        	//add
        	$this->widgetDao->insert($widgetVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Widget add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        	'widgetCatArray' => WidgetExt::getWidgetCatArray(),
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $widgetId = $_REQUEST['widgetId'];
        $widgetInfo = $this->widgetDao->selectByPrimaryKey($widgetId);
        
        if(!($this->_check_exist($widgetInfo) & $this->_check_permission($widgetInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'widgetInfo' => $widgetInfo,
        	'widgetCatArray' => WidgetExt::getWidgetCatArray(),
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$widgetVo = new WidgetVo();
        	CTTHelper::copyProperties($this->widgetModel, $widgetVo);
        	
        	//update
        	$this->widgetDao->updateByPrimaryKey($widgetVo, $widgetId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Widget update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    public function delete() {
    	if(isset($_REQUEST['widgetId'])){
			$widgetId = $_REQUEST['widgetId'];
			$widgetInfo = $this->widgetDao->selectByPrimaryKey($widgetId);
			$controller = $widgetInfo->controller;
			$pluginCode = $widgetInfo->pluginCode;
			
			//check $controllerFile is not exist
			if($pluginCode == ''){	//system
				$controllerFile = WIDGET_PATH."$controller/$controller.php";
			}
			else{
				$controllerFile = PLUGIN_PATH."$pluginCode/widget/$controller/$controller.php";
			}
			if(file_exists($controllerFile)){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Delete file $controller.php before delete widget");
			}
			else{
				//delete layout_widget
				//later...
				
				//delete widget
				$this->widgetDao->deleteByPrimaryKey($widgetId);
				SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
			}
    	}
    	return $this->setRender('success');
    }
}