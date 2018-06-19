<?php
class ProductGroupWidget{
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
            'title' => 'Nhóm sản phẩm theo mới, nổi bật, bán chạy...',
			'style' => array(
                'style1' => 'style1 (Giao diện hiển thị ở trang chủ)',
			),
			'items_limit' => '10',
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
//    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	=> array(),
            'bg_color'	=> array('label' => 'Màu nền', 'class' => 'ColorPickerSliders',
                'addElement' => '<a href="index.php?r=admin/help/view&helpId=4" target="_blank">Xem thêm</a>'),
    		'style'	=> array('type' => 'select', 'options' => $this->settingDefault['style']),
    	);
    	
    	$settingAll = array(
    		'cols' => '3-9'
    	);
    	 
    	//render setting from
    	TemplateHelper::renderForm($settingForm, $setting, $settingAll);
        TemplateHelper::getTemplate('layout/_extra/add_setting.php', $setting);
        TemplateHelper::getTemplate('layout/_extra/color_picker.php');
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
   		
   		//add info
   		$productDao = new ProductDao();
   		$productVo = new ProductVo();
   		$orderBy = array('product_id' => 'DESC');
   		$setting['productNewList'] = $productDao->selectByFilter(null, $orderBy, 0, $this->settingDefault['items_limit']);
        $setting['productFeatureList'] = ProductExt::getProductFeatureList(array('pf.status' => 'A'), array('pf.order' => 'ASC'), 0, $this->settingDefault['items_limit']);
        $setting['productBestSellerList'] = ProductExt::getProductBestSellersListManual(array('pbs.status' => 'A'), array('pbs.order' => 'ASC'), 0, $this->settingDefault['items_limit']);

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
