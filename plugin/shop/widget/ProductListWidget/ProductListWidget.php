<?php
class ProductListWidget{
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
			'style' => array(
				'home' => 'Product in home page',
			),
			'order_by' => array(
				'p.product_id' => e('Product ID'),
				'p.name' => e('Product name'),
				'p.price' => e('Product price'),
				'p.discount' => e('Product discount')
			),
			'order_direction' => array(
				'DESC' => e("Descending"),
				'ASC' => e("Ascending"),
			),
            'items_limit' => '6',
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
    		'class'	=> array(),
            'bg_color'	=> array('label' => 'Màu nền', 'class' => 'ColorPickerSliders',
                'addElement' => '<a href="index.php?r=admin/help/view&helpId=4" target="_blank">Xem thêm</a>'),
    		'category_id'	=> array('type' => 'select_category', 'label' => 'Category', 'required' => true,
    				'options' => CategoryExt::getCategoryList()),
    		'style'	=> array('type' => 'select', 'options' => $this->settingDefault['style']),
    		'order_by' => array('type' => 'select', 'options' => $this->settingDefault['order_by']),
    		'order_direction' => array('type' => 'select', 'options' => $this->settingDefault['order_direction']),
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

   		$categoryId = $setting['category_id'];
   		$order_by = $setting['order_by'];
   		$order_direction = $setting['order_direction'];

        //get productList in $categoryId
        $filter = array();
        $filter['p.status'] = 'A';
        //get all child of categoryId
        $child = array();
        CategoryExt::getChild($child, $categoryId);
        $childIds  = $child;
        $childList = array();
        foreach ($childIds as $v){
            $childList[] = CategoryExt::getCategoryInfo($v);
        }
        $setting['childList'] = $childList;

        //get $categoryInfo
        $setting['categoryInfo'] = CategoryExt::getCategoryInfo($categoryId);

        //next
        array_push($child, $categoryId);
        if(count($child)){
            $filter['pc.category_id'] = array('in', '('.join(', ', $child).')', 'int');
        }
        $orderBy = array($order_by => $order_direction);
        $productList = ProductExt::getFilter($filter, $orderBy, 0, $this->settingDefault['items_limit']);
        $setting['productList'] = $productList;

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