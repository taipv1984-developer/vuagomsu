<?php
class YoutubeRandomWidget{
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
			'width' => '285',
			'height' => '180',
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
    	);
    	$settingAll = array(
    		'cols' => '3-9'
    	);
    	//render setting from
    	TemplateHelper::renderForm($settingForm, $setting, $settingAll);
        TemplateHelper::getTemplate('layout/_extra/add_setting.php', $setting);

    	//get videoList
        $videoDao = new CVideoDao($GLOBALS['conn']);
        $videoVo = new CVideoVo();
        $videoVo->source = 'youtube';
        $orderBy = array('order' => 'ASC');
        $videoList = $videoDao->selectByFilter($videoVo, $orderBy);
    	?>
        <div class="my_row ">
            <label class="col-md-3 my_tooltip">Danh sách video</label>
            <div class="row_value col-md-9">
                <ul class="simple-list">
                <?php foreach ($videoList as $v){?>
                    <li>
                        <a href="<?=$v->url?>" title="<?=$v->name?>" target="_blank">
                            <?php
                                if($v->status == 'A'){
                                    echo $v->name;
                                }
                                else{
                                    echo "<span style='color: #999'>$v->name</span>";
                                }
                            ?>
                        </a>
                    </li>
                <?php }?>
                </ul>
            </div>
        </div>
<?php
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
        $videoRandom = VideoExt::getVideoRandom('A');
        $setting['video'] = $videoRandom->url;

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