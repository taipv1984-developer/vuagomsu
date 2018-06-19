<?php
class NewsRelateWidget{
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
                'style1' => '(style1)',
            ),
            'limit' => '4',
            'note' => 'Widget này chỉ dùng được trong trang tin tức',
            'error' => 'Widget đã bị cấu hình sai trang'
		);
	}

	/**
	 * Display input from in admin side
	 */
    public function form(){
   	 	if($this->layoutWidgetInfo){
    		$setting = json_decode($this->layoutWidgetInfo->setting, true);
    	}
        $setting['note'] = $this->settingDefault['note'];

    	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
    	//add option(class, id, stype, styleRow, required, placeholder, attr, [options, code])
    	$settingForm = array(
    		'layout_widget_id' 	=> array('type' => 'hidden', 'value' => $this->layoutWidgetInfo->layoutWidgetId),
    		'widget_controller' => array('type' => 'hidden', 'value' => $this->widgetController),
    		'header' 	=> array('type' => 'custom', 'value' => "<h4 class='widget_header col-md-12'>{$this->widgetController}</h4>", 'label' => ''),

    		'title' => array(),
            'show_title'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
    		'class'	=> array(),
            'limit'	=> array('type' => 'number', 'placeholder' => $this->settingDefault['limit'], 'label' => 'Số lượng'),
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
        $setting['layoutWidgetInfo'] = $this->layoutWidgetInfo;

   		//set default
        $setting['limit'] = ($setting['limit'] != '') ? $setting['limit'] : $this->settingDefault['limit'];

        //add info
        $isShow = true;
        $router = $_REQUEST['r'];
        switch ($router){
            case 'home/news/detail':
                $newsId = $_REQUEST['newsId'];
                $setting['newsList'] = NewsExt::getNewsRelateList($newsId, $setting['limit']);
                break;
            default:
                $isShow = false;
                break;
        }

        if($isShow) {
            include "view.php";
        }
        else{
            echo $this->settingDefault['error'];
        }
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
