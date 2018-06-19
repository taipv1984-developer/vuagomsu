<?php
class ProductPromotionWidget{
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
            'title' => 'Sản phẩm khuyến mại',
			'style' => array(
 				'style1' => 'style1',
			),
			'items_limit' => '4',
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
            'title'		=> array('value' => $this->settingDefault['title']),
    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	=> array(),
    		'style'	=> array('type' => 'select', 'options' => $this->settingDefault['style']),
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

   		$productDao = new ProductDao();
   		$productVo = new ProductVo();
   		$orderBy = array('discount' => 'DESC');
   		$setting['productList'] = $productDao->selectByFilter($productVo, $orderBy, 0, $this->settingDefault['items_limit']);
   		
   		$setting['layoutWidgetInfo'] = $this->layoutWidgetInfo;
   		 
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
