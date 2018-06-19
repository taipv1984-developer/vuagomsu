<?php
class FacebookCommentWidget{
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
		    'error' => 'Facebook comment chưa được cấu hình',
			'note' => e("<i>Facebook comment chỉ có hiển thị trong trang sản phẩm và tin tức</i>. 
					Xem thêm tại <a href='https://developers.facebook.com/tools/comments' target='_blank'>https://developers.facebook.com/tools/comments</a> do setting comment."),
			'orderBy' => array(
				'social' => 'Top',
				'reverse_time' => 'Newest',
				'time' => 'Oldest',
			),
			'num_posts' => 10,
			'width' => '100%',
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
    		'num_posts' 	=> array('placeholder' => $this->settingDefault['num_posts']),
    		'order_by' => array('type' => 'select', 'options' => $this->settingDefault['orderBy']),
    		'width' 	=> array('placeholder' => $this->settingDefault['width']),
    		'note' 	=> array('type' => 'label', 'title' => $this->settingDefault['note']),
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
   		
   		//get $router
        $isShow = true;
        $router = $_REQUEST['r'];
   		switch ($router){
            case 'home/product/detail':
                $productId = $_REQUEST['productId'];
                $setting['url'] = URLHelper::getProductDetailPage($productId);
                break;
            case 'home/news/detail':
                $newsId = $_REQUEST['newsId'];
                $setting['url'] = URLHelper::getNewsDetailPage($newsId);
                break;
            default:
                $isShow = false;
                break;
        }

        if($isShow) {
            $setting['width'] = ($setting['width'] != '') ? $setting['width'] : $this->settingDefault['width'];
            $setting['num_posts'] = ($setting['num_posts'] != '') ? $setting['num_posts'] : $this->settingDefault['num_posts'];
            include "view.php";
        }
        else{
   		    echo "Facebook comment chưa được cấu hình";
   		    echo $this->settingDefault['error'];
        }
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