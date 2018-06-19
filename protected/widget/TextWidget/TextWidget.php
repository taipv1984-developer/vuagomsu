<?php
class TextWidget{
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
		
    	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
    	//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
    	$settingForm = array(
    		'layout_widget_id' 	=> array('type' => 'hidden', 'value' => $this->layoutWidgetInfo->layoutWidgetId),
    		'widget_controller' => array('type' => 'hidden', 'value' => $this->widgetController),
    		
    		'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''),
    		'title'		=> array(),
    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	    => array('label' => 'Class'),
    			
    		'text'		=> array('type' => 'textarea', 'class' => 'ckeditor_mini', 'label' => '',  'rows' => 2,
    			'value' => $setting['text']),
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
   		if (strtolower($setting['title']) == 'contact'){
   			$replace = array(
   				'{contact_phone_number}'	=> Registry::getSetting("contact_phone_number"),
   			);
   			$setting['text'] = strtr($setting['text'], $replace);
   		}
   		if (strtolower($setting['title']) == 'navigation'){
   			$replace = array(
   				'{base_url}'	=> URLHelper::getBaseUrl(),
   			);
   			$setting['text'] = strtr($setting['text'], $replace);
   		}
   		if (strtolower($setting['title']) == 'logo'){
   			$replace = array(
   				'{base_url}'	=> URLHelper::getBaseUrl(),
   				'{logo_footer}'	=> URLHelper::getImagePath(Registry::getSetting("shop_logo_footer"))
   			);
   			$setting['text'] = strtr($setting['text'], $replace);
   		}
   		//add info
   		
   		//view
        include "view.php";
   	}

   	/**
   	 * Load .css file to head or footer position of file. Called when the website render
   	 */
   	public function loadStyle(){
   		return null;
   		return "css/{$this->widgetController}.css";
   		return array(
   			'head' => 'head.css',
   			'footer' => array(
   				'footer1.css',
   				'footer2.css'
   			),
   		);
   	}
   	
   	/**
   	 * Load .js file to head or footer position of file. Called when website render
   	 */
   	public function loadScript(){
   		return null;
   		return "css/{$this->widgetController}.js";
   		return array(
   			'head' => 'head.js',
   			'footer' => array(
   				'footer1.js',
   				'footer2.js'
   			),
   		);
   	}
}