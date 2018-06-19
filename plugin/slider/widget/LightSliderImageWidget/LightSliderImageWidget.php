<?php
class LightSliderImageWidget{
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
            'items_limit' => '6',
            'items_desktop' => '1',
            'items_mobile' => '1',
            'height' => 0
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

            'height'	=> array('placeholder' => $this->settingDefault['height']),
            'items_limit'	=> array('type' => 'number', 'placeholder' => $this->settingDefault['items_limit']),
            'items_desktop'	=> array('type' => 'number', 'placeholder' => $this->settingDefault['items_desktop']),
            'items_mobile'	=> array('type' => 'number', 'placeholder' => $this->settingDefault['items_mobile']),
            'auto_play'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
            'pagination'	=> array('type' => 'select', 'options' => ArrayHelper::get10()),
        );
        $settingAll = array(
            'cols' => '3-9'
        );

        //render setting from
        TemplateHelper::renderForm($settingForm, $setting, $settingAll);
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
        $sliderId = $setting['sliderId'];
        $setting['imageList'] = SliderExt::getImageList($sliderId);
        $setting['auto_play'] = ($setting['auto_play']) ? 'true' : 'false';
        $setting['pagination'] = ($setting['pagination']) ? 'true' : 'false';
        $setting['items_limit'] = ($setting['items_limit'] != '') ? $setting['items_limit'] : $this->settingDefault['items_limit'];
        $setting['items_desktop'] = ($setting['items_desktop'] != '') ? $setting['items_desktop'] : $this->settingDefault['items_desktop'];
        $setting['items_mobile'] = ($setting['items_mobile'] != '') ? $setting['items_mobile'] : $this->settingDefault['items_mobile'];

        $setting['layoutWidgetInfo'] = $this->layoutWidgetInfo;

        //view
        include "view.php";
    }

    /**
     * Load .css file to head or footer position of file. Called when the website render
     */
    public function loadStyle(){
        return null;
        return 'js/lightslider/css/lightslider.css';
        return "css/{$this->widgetController}.css";
    }

    /**
     * Load .js file to head or footer position of file. Called when website render
     */
    public function loadScript(){
        return null;
        return 'js/lightslider/js/lightslider.js';
        return null;
    }
}
