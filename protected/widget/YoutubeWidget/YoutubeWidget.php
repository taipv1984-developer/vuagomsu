<?php
class YoutubeWidget{
	private $widgetController;
	private $layoutWidgetInfo;
	private $settingDefault;
	
	/**
	 * __construct of widget
	 */
	function __construct($layoutWidgetInfo){
		$this->widgetController = get_class($this);
		$this->layoutWidgetInfo = $layoutWidgetInfo;
		
		$this->settingDefault = array(
			'errorMessage' => e(""),
			'width' => '262',
			'height' => '170',
		);
	}
	
	/**
	 * Display input from in admin side
	 */ 
    public function form(){
       	if($this->layoutWidgetInfo){
    		$setting = json_decode($this->layoutWidgetInfo->setting, true);
    	}

    	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
    	//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
    	$settingForm = array(
    		'layout_widget_id' 	=> array('type' => 'hidden', 'value' => $this->layoutWidgetInfo->layoutWidgetId),
    		'widget_controller' => array('type' => 'hidden', 'value' => $this->widgetController),
    		
    		'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''), 'title' => array(),
    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	=> array(),
    			 
    		'url' 		=> array('label' => 'Video', 'required' => true),
    		'auto_play'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'allowfullscreen'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'width'		=> array('placeholder' => $this->settingDefault['width']),
    		'height'	=> array('placeholder' => $this->settingDefault['height']),
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
   		
   		//add info
   		$videoPath = str_replace("watch?v=", 'embed/', $setting['url']);
   		$params = array();
   		if($setting['auto_play']){
   			$params[] = 'autoplay=1';
   		}
   		if(count($params) > 0){
   			$videoPath .= '?'.join('&', $params);
   		}
   		$setting['width'] = ($setting['width'] != '') ? $setting['width'] : $this->settingDefault['width'];
   		$setting['height'] = ($setting['height'] != '') ? $setting['height'] : $this->settingDefault['height'];
   		$allowfullscreen = ($setting['allowfullscreen']) ? "allowfullscreen='allowfullscreen'" : '';
   		$setting['video'] = "<iframe src='$videoPath' style='width:{$setting['width']}px; height:{$setting['height']}px; border: 0' $allowfullscreen></iframe>";
   		
		//view
        include "view.php";
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