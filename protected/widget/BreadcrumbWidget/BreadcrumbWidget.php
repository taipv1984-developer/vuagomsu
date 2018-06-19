<?php
/**
 * Apply for product_detail page only
 */
class BreadcrumbWidget{
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
			'note' => e(""),
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
    		'title' => array(),
    		'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	=> array(),
    			 
    		'note' 		=> array('type' => 'label', 'title' => $this->settingDefault['note']),
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
   		$r = $_REQUEST[ACTION_PARAM];
   		switch ($r){
   			case 'home/product/list':
   				$categoryId = $_REQUEST['categoryId'];
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbCategory($categoryId);
   				break;
   			case 'home/product/detail':
   				$productId = $_REQUEST['productId'];
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbProduct($productId);
   				break;
   			case 'home/news/list':
   				$newsCategoryId = $_REQUEST['newsCategoryId'];
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbNewsCategory($newsCategoryId);
   				break;
   			case 'home/news/detail':
   				$newsId = $_REQUEST['newsId'];
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbNews($newsId);
   				break;
   			case 'home/news/tag':
   				$newsTagId = $_REQUEST['newsTagId'];
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbNewsTag($newsTagId);
   				break;
   			case 'home/static_page/view':
   				$staticPageId = $_REQUEST['staticPageId'];
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbStaticPage($staticPageId);
   				break;
   			default:
   				$setting['breadcrumb'] = BreadcrumbHelper::getBreadcrumbAuto($r);
   				break;
   		}
   		
		//view
        include "view.php";
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
   	}
}