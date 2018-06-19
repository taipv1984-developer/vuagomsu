<?php
class JssorSliderImageWidget{
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
			'params' => '{$Duration:800,$Delay:200,$Rows:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2}',
			'width' => 1920,
			'height' => 650,
			'note' => 'Go to <a href="http://jssor.com/demos" target="_blank">http://jssor.com/demos</a> to do more params.',
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
    		
    		'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''),
    		'title'		=> array(),
    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	=> array('label' => 'Class'),
    			
    		'sliderId'	=> array('type' => 'select', 'label' => 'Slider', 'options' => SliderExt::getSliderArray()),
    		'width'	=> array('type' => 'number', 'placeholder' => $this->settingDefault['width']),
    		'height'	=> array('type' => 'number', 'placeholder' => $this->settingDefault['height']),
    		'params'	=> array('type' => 'textarea', 'placeholder' => $this->settingDefault['params'], 'class' => 'height_100'),
    		'pagination'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'note'	=> array('type' => 'label', 'title' => $this->settingDefault['note'])
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
   		$sliderId = $setting['sliderId'];
   		$setting['imageList'] = SliderExt::getImageList($sliderId);
   		$setting['width'] = ($setting['width'] != '') ? $setting['width'] : $this->settingDefault['width'];
   		$setting['height'] = ($setting['height'] != '') ? $setting['height'] : $this->settingDefault['height'];
   		$setting['params'] = ($setting['params'] != '') ? $setting['params'] : $this->settingDefault['params'];
   		$setting['layoutWidgetInfo'] = $this->layoutWidgetInfo;
   		
   		//view
        include "view.php";
   	}

   	/**
   	 * Load .css file to head or footer position of file. Called when the website render
   	 */
   	public function loadStyle(){
   		return 'js/jssor_slider/css/style.css';
   		return "css/{$this->widgetController}.css";
   	}
   	
   	/**
   	 * Load .js file to head or footer position of file. Called when website render
   	 */
   	public function loadScript(){
   		return 'js/jssor_slider/js/jssor.slider.min.js';
   		return null;
   	}
}
