<?php
class MainContentWidget{
	private $widgetController;
	private $layoutWidgetInfo;
	
	/**
	 * __construct of widget
	 */
	function __construct($layoutWidgetInfo){
		$this->widgetController = get_class($this);
		$this->layoutWidgetInfo = $layoutWidgetInfo;
	}
	
	/**
	 * Display input from in admin side
	 */ 
    public function form(){
    	//get $layoutId
    	$layoutId = Session::getSession('layoutId');

    	//get layoutInfo
    	$filter = array(
    		'layout_id' => $layoutId,
    	);
    	$layoutInfo = LayoutExt::getLayoutInfo($filter);
    	
    	//get $actionMap
    	$actionMap = CTTConfig::Instance()->getActionMap();
    	 
    	//get $path from $actionMap
    	$actionData = $actionMap[$layoutInfo->dispatch];
    	$actionControler = $actionData['controller'];
    	$path = $actionData['results']['success']['path'];
    	
    	//get $results array
    	$results = array();
    	foreach ($actionData['results'] as $k => $v){
    		if($v['type'] == 'include'){
    			$results[$k] = $k;
    		}
    	}
    	
    	//get $setting
   	 	if($this->layoutWidgetInfo){
    		$setting = (array)json_decode($this->layoutWidgetInfo->setting);
    	}
    	
    	//get $pluginCode
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    	
    	//get $path
    	$path = $actionData['results'][$setting['results']]['path'];
    	if($pluginCode != ''){
    		$path = "plugin/$pluginCode/view/frontend/$path";
    	}
    	$layout = $actionData['results'][$setting['results']]['layout'];
    	
    	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
    	//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
    	$settingForm = array(
    		'layout_widget_id' 	=> array('type' => 'hidden', 'value' => $this->layoutWidgetInfo->layoutWidgetId),
    		'widget_controller' => array('type' => 'hidden', 'value' => $this->widgetController),
    		
    		'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''),
    		
    		'plugin'		=> array('type' => 'label', 'title' => $pluginCode),
    		'page_name'		=> array('type' => 'label', 'title' => $actionData['name']),
    		'controller'		=> array('type' => 'label', 'title' => $actionData['controller']),
    		'method'		=> array('type' => 'label', 'title' => $actionData['method']),
    		'results'		=> array('type' => 'select', 'required' => true,
    				'options' => $results, 'value' => $setting['results']),
    		'path'		=> array('type' => 'label', 'label' => false, 'title' => "<b>path: </b>$path"),
    		'layout'		=> array('type' => 'label', 'label' => false, 'title' => "<b>layout: </b>$layout"),
    	);
        $settingAll = array(
            'cols' => '3-9'
        );
    	//render setting from
    	TemplateHelper::renderForm($settingForm, $setting, $settingAll);
        TemplateHelper::getTemplate('layout/_extra/add_setting.php', $setting);
   	}
   	
   	/**
   	 * View widget in frontend
   	 */
   	public function view(){
   	//get setting
   		if($this->layoutWidgetInfo){
   			$setting = json_decode($this->layoutWidgetInfo->setting, true);
   		}
   		$results = $setting['results'];
   		
   		//get $actionMap
   		$actionMap = CTTConfig::Instance()->getActionMap();
   			
   		//get $path from $actionMap
   		$actionData = $actionMap[$_REQUEST[ACTION_PARAM]];
   		$actionControler = $actionData['controller'];
   		$path = $actionData['results'][$results]['path'];
   		
   		//get $pluginCode
   		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
   				
   		if($pluginCode == ''){
   			$templateName = TemplateExt::getTemplateActive();
   			$filePath = FRONTEND_VIEW_PATH."$templateName/$path";
   		}
   		else{
   			$filePath = PLUGIN_PATH."$pluginCode/view/frontend/$path";
   		}
		include $filePath;
   	}

   	/**
   	 * Load .css file to head or footer position of file. Called when the website render
   	 */
   	public function loadStyle(){
   		return null;
   	}
   	
   	/**
   	 * Load .js file to head or footer position of file. Called when website render
   	 */
   	public function loadScript(){
   		return null;
   	}
}