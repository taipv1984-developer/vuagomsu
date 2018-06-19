<?php
class CustomViewWidget{
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
       	if($this->layoutWidgetInfo){
    		$setting = json_decode($this->layoutWidgetInfo->setting, true);
    	}

    	//get $customerViewList
    	$dir = __DIR__.'/view';
        $fileList = scandir($dir, SCANDIR_SORT_ASCENDING);
        $customerViewList = array();
        foreach ($fileList as $k => $v){
            if($v != '..' & $v != '.'){
                $customerViewList[$v] = $v;
            }
        }

    	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
    	//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
    	$settingForm = array(
    		'layout_widget_id' 	=> array('type' => 'hidden', 'value' => $this->layoutWidgetInfo->layoutWidgetId),'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''),
    		'widget_controller' => array('type' => 'hidden', 'value' => $this->widgetController),
    		
    		'title'		=> array(),
            'fileName'	=> array('type' => 'select', 'options' => $customerViewList),
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
   		$setting = array();
   		if($this->layoutWidgetInfo){
   			$setting = json_decode($this->layoutWidgetInfo->setting, true);
   		}
   		
        //view
        include 'view/'.$setting['fileName'];
        TemplateHelper::getTemplate('layout/_extra/add_setting.php', $setting);
   	}

   	/**
   	 * Load .css file to head or footer position of file. Called when the website render
   	 */
   	public function loadStyle(){
   		return null;
   		return "css/{$this->widgetController}.css";
   	}
   	
   	/**
   	 * Load .js file to head or footer position of file. Called when website render
   	 */
   	public function loadScript(){
   		return null;
   		return "js/{$this->widgetController}.js";
   	}
}