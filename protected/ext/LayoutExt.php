<?php
class LayoutExt{
	public function __construct(){
	}

	/**
	 * 
	 * insertLayoutRow apply for layout_row and layout_row system 
	 * 
	 * @param int $layoutId
	 * @param string $group (if is system row = H or F else = false)
	 * @return boolean
	 */
	public static function insertLayoutRow($layoutId, $cols, $group=''){
		$settingValue = array(
			'add_class' => '',
			'full_width' => '1',
			'col_class_0' => '',
			'col_class_1' => '',
			'col_class_2' => '',
			'col_class_3' => '',
			'col_class_4' => '',
			'col_class_5' => '',
		);
		//set col_class
		$bootrapClassCols = ArrayHelper::getBootrapClassCols();
		for($i=0; $i<$cols; $i++){
			$settingValue["col_class_$i"] = $bootrapClassCols[$cols];
		}
		
		$layoutRowVo = new LayoutRowVo();
		$layoutRowVo->layoutId = $layoutId;
		$layoutRowVo->group = $group;
		$layoutRowVo->cols = $cols;
		$layoutRowVo->order = 999;							//update later
		$layoutRowVo->layoutWidgetList = json_encode(array());	//update later
		$layoutRowVo->setting = json_encode($settingValue);
		$layoutRowVo->status = 'A';
		
		$layoutRowDao = new LayoutRowDao();
		$layoutRowId = $layoutRowDao->insert($layoutRowVo);
		
		return $layoutRowId;
	} 
	
	/**
	 * getLayoutRowSystem (have layout_id == 0)
	 * group data return for group filter
	 * 
	 * @return array(array(group))
	 */
	public static function getLayoutRowSystem(){
		$sql = "select * 
from layout_row 
where `layout_id`=0 and `group`!='mobile_system' 
order by `order` ASC";
		$query = DataBaseHelper::query($sql);
		
		$layoutRowSystem = array();
		foreach ($query as $v){
			$layoutRowSystem[$v->group][] = $v;
		}	

		return $layoutRowSystem;
	}
	
	/**
	 * getLayoutRowSystem (have layout_id == 0)
	 * group data return for group filter
	 *
	 * @return array(array(group))
	 */
	public static function getLayoutRowMobileSystem(){
		$sql = "select *
from layout_row
where `layout_id`=0 and `group`='mobile_system' 
order by `order` ASC";
		$query = DataBaseHelper::query($sql);
	
		if($query){
			return $query[0];
		}
		else{
			//create new layoutRowMobileSystem
			$layoutRowDao = new LayoutRowDao();
			$layoutRowVo = new LayoutRowVo();
			$layoutRowVo->layoutId = 0;
			$layoutRowVo->group = 'mobile_system';
			$layoutRowVo->cols = 0;
			$layoutRowVo->order = 0;
			$layoutRowVo->layoutWidgetList = json_encode(array('mobile_system_left' => '', 'mobile_system_top' => '', 'mobile_system_bottom' => '', 'mobile_system_right' => ''));
			$layoutRowVo->setting = json_encode(array());
			$layoutRowVo->status = 'A';
			$layoutRowId = $layoutRowDao->insert($layoutRowVo);
			
			//update $layoutRowVoId
			$layoutRowVo->layoutRowId = $layoutRowId;
			
			//return 
			return $layoutRowVo;
		}
		$layoutRowSystem = array();
		foreach ($query as $v){
			$layoutRowSystem[$v->group][] = $v;
		}
	
		return $layoutRowSystem;
	}
	
	public static function getLayoutList(){
		$layoutDao = new LayoutDao();
		$layoutVo = new LayoutVo();
		$layoutVo->status = 'A';
		$orderBy = array(
			'order' => 'ASC',
		);
		return $layoutDao->selectByFilter($layoutVo, $orderBy);
	}
	
	/**
	 * get layout info
	 * 
	 * @param string $dispatch($_REQUEST[ACTION_PARAM])
	 * @return object
	 */
	public static function getLayoutInfo($filter){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$sql = "select * from `layout` $whereCondition";
		$query = DataBaseHelper::query($sql);
		if($query){
			return $query[0];
		}
		else{
			LogUtil::devInfo("[LayoutExt::getLayoutInfo] have not layout...");
			LogUtil::devInfo($filter);
			return null;
		}
	}
	
	/**
	 * get layout row have group=mobile
	 *
	 * @param int $layoutId
	 * @return object
	 */
	public static function getLayoutRowMobile($layoutId){
		$layoutRowDao = new LayoutRowDao();
		$layoutRowVo = new LayoutRowVo();
		$layoutRowVo->layoutId = $layoutId;
		$layoutRowVo->group = 'mobile';
		$layoutRowVo->status = 'A';
		$layoutRowVos = $layoutRowDao->selectByFilter($layoutRowVo);
		if($layoutRowVos){
			return $layoutRowVos[0];
		}
		else{
			//auto create layoutRow have group=mobile
			$layoutRowVo->cols = 0;
			$layoutRowVo->order = 0;
			$layoutRowVo->layoutWidgetList = json_encode(array());
			$layoutRowVo->setting = json_encode(array());
			//insert
			$layoutRowId = $layoutRowDao->insert($layoutRowVo);
			
			//return
			$layoutRowVo->layoutRowId = $layoutRowId;
			return $layoutRowVo;
		}
	}
	
	/**
	 * get all layout_widget of $layoutInfo object
	 * 
	 * @param object $layoutInfo
	 * @return array
	 */
	public static function getLayoutWidgetAll($layoutInfo){
    	$sql = "select * from layout_widget
where (layout_id=0 or layout_id=:layout_id) and (`status`='A' or `status`='S')
order by `order` ASC";
    	$params = array(
    		array(':layout_id', $layoutInfo->layoutId, 'str')
    	);
    	$output = array(
    		'type' => 'object',
    		'key' => 'layout_widget_id'
    	);
    	return DataBaseHelper::query($sql, $params, $output);
   }
	
   /**
    * get all widget info (add plugin info) of layout
    * 
    * @param int $layoutId
    * @return list widget
    */
    public static function getWidgetList($layoutId){
   		$sql = "select w.*, p.`status` as plugin_status
from widget as w
left join layout_widget as lw on lw.widget_controller = w.controller
left join `plugin` as p on p.plugin_code = w.plugin_code
where (lw.layout_id = 0 or lw.layout_id = :layoutId) and (lw.`status` = 'A' or lw.`status` = 'S')
group by widget_controller
order by lw.order ASC";
	   	$params = array(
	   		array(':layoutId', $layoutId)
	   	);
	   	return DataBaseHelper::query($sql, $params);
    }
   
    public static function layoutWidgetInfo($layoutWidgetId){
   		$sql = "select lw.*, 
	p.`plugin_id` as plugin_id, p.`plugin_code` as plugin_code, p.`status` as plugin_status
from `layout_widget` as lw
left join `widget` as w on w.widget_id = lw.widget_id
left join `plugin` as p on p.plugin_code = w.plugin_code
where lw.layout_widget_id=:layoutWidgetId";
	   	$params = array(
	   		array(':layoutWidgetId', $layoutWidgetId)
	   	);
	   	$query = DataBaseHelper::query($sql, $params);
	   	return ($query) ? $query[0] : false;
    }

    public static function getStyleRow($setting){
        $ret = '';
        $style = array();
        if(isset($setting['bg_color'])){
            $bg_color = $setting['bg_color'];
            if($bg_color != 'rgb(255, 255, 255)'){
                $style[] = "background-color: $bg_color;";
            }
            $bg_image = $setting['bg_image'];
            $no_image = Registry::getSetting('no_image');
            if($bg_image != $no_image){
                $bg_image = htmlentities($bg_image);
                $style[] = "background-image: url('$bg_image');";
            }
            $bg_image_size = $setting['bg_image_size'];
            if($bg_image_size != 'auto'){
                $style[] = "background-size: $bg_image_size;";
            }
            $bg_image_repeat = $setting['bg_image_repeat'];
            if($bg_image_repeat != 'no-repeat'){
                $style[] = "background-repeat: $bg_image_repeat;";
            }
        }
        if(count($style) > 0){
            $ret = "style=\"" .join('; ', $style). "\"";
        }
        return $ret;
    }

    public static function getStyleWidget($setting){
        $ret = '';
        $style = array();
        if(isset($setting['bg_color'])){
            $bg_color = $setting['bg_color'];
            if($bg_color != ''){
                $style[] = "background-color: $bg_color;";
            }
            $bg_image = $setting['bg_image'];
            $no_image = Registry::getSetting('no_image');
            if($bg_image != $no_image){
                $bg_image = htmlentities($bg_image);
                $style[] = "background-image: url('$bg_image');";
            }
            $bg_image_size = $setting['bg_image_size'];
            if($bg_image_size != 'auto'){
                $style[] = "background-size: $bg_image_size;";
            }
            $bg_image_repeat = $setting['bg_image_repeat'];
            if($bg_image_repeat != 'no-repeat'){
                $style[] = "background-repeat: $bg_image_repeat;";
            }
        }
        if(count($style) > 0){
            $ret = "style=\"" .join('; ', $style). "\"";
        }
        return $ret;
    }

    /**
     * render tempalte of DESKTOP to html output(MAIN ***)
     * 
     * @param object $layoutInfo
     */
	public static function renderTemplate($layoutInfo){
		//init
		$layoutId = $layoutInfo->layoutId;
		
		//get $layoutRowSystem
		$layoutRowSystem = self::getLayoutRowSystem();
		
		//get systemHeader and systemFooter from request url
		$request_systemHeader = (isset($_REQUEST['systemHeader'])) ? $_REQUEST['systemHeader'] : true;
		$request_systemFooter = (isset($_REQUEST['systemFooter'])) ? $_REQUEST['systemFooter'] : true;
		
		//step1: render layout system header
		if($request_systemHeader & $layoutInfo->systemHeader){
			$group = 'header';
			self::renderLayout($layoutRowSystem[$group]);
		}
		
		//step2: render layout main
		$layoutRowVo = new LayoutRowVo();
		$layoutRowVo->layoutId = $layoutId;
		$layoutRowVo->status = 'A';
		$order = array('order' => 'ASC');
		$layoutRowDao = new LayoutRowDao();
		$layoutRows = $layoutRowDao->selectByFilter($layoutRowVo, $order);
		self::renderLayout($layoutRows);
		
		//step3: render layout system footer
		if($request_systemFooter & $layoutInfo->systemFooter){
			$group = 'footer';
			self::renderLayout($layoutRowSystem[$group]);
		}
	}
	
	/**
	 * renderLayout by $layoutRows (MAIN)
	 * 
	 * @param object $layoutRows
	 */
	private static function renderLayout($layoutRows){
        $isMobile = Session::getSession('isMobile');
		$containerClass = 'container';
		
		$iRow = 0;
		foreach($layoutRows as $row){
			if($row->status != 'A') continue;
			$iRow++;
			$setting = (array)json_decode($row->setting);
            $styleRow = self::getStyleRow($setting);

			$layoutWidgetList = (array)json_decode($row->layoutWidgetList);
			$fullWidth = $setting['full_width'];
			$addClass = $setting['add_class'];

			echo "<div class='layout_row layout_row_$iRow layout_row_id_{$row->layoutRowId}  $addClass' $styleRow>";
            //check $fullWidth
            if(!$fullWidth){echo "<div class='$containerClass'>";}
            echo "<div class='row'>";
				//step3: write by col
				for($i=0; $i<$row->cols; $i++){
					$iCol = $i+1;
					$col_class = $setting["col_class_$i"];
					echo "<div class='layout_col layout_col_$iCol $col_class'>";
						$layoutWidgetIds = ($layoutWidgetList[$i] != '')?  explode('-', $layoutWidgetList[$i]): array();
						//show widget content
						foreach($layoutWidgetIds as $layoutWidgetId){
                            self::viewLayoutWidget($layoutWidgetId, $isMobile);
						}
					echo "</div>\n";
				}
            echo "</div>";
            if(!$fullWidth){echo "</div>\n";}

			echo "<div class='clear'></div>\n";
			echo "</div><!-- end .row_$iRow -->\n";
		}
	}
	
	/**
	 * include widget file and run view function of $layoutWidgetId
	 * 
	 * @param int $layoutWidgetId
	 */
	public static function viewLayoutWidget($layoutWidgetId, $isMobile=false){
		//loadWidgetLayout
		$layoutWidgetInfo = self::layoutWidgetInfo($layoutWidgetId);
		FileHelper::loadWidgetLayout($layoutWidgetInfo);
		$widgetController = $layoutWidgetInfo->widgetController;

		//check $mobile_show
        $setting = (array)json_decode($layoutWidgetInfo->setting);
        $mobile_show = true;
        if(isset($setting['mobile_show'])){
            $mobile_show = $setting['mobile_show'];
        }
        if($isMobile & !$mobile_show) {
            //no task
        }
        else{
            //run show function
            $pluginStatus = $layoutWidgetInfo->pluginStatus;
            if ($pluginStatus != 'D') {
                if (class_exists($widgetController)) {
                    if ($mobile_show) {
                        echo "<div class='layout_widget_id_$layoutWidgetId' data-widget='$widgetController'>";
                    } else {
                        echo "<div class='layout_widget_id_$layoutWidgetId hidden-xs' data-widget='$widgetController'>";
                    }
                    $myWidget = new $widgetController($layoutWidgetInfo);
                    $myWidget->view();
                    echo "</div>";
                } else {
                    LogUtil::devInfo("[LayoutExt::viewLayoutWidget] Controler $widgetController not exist");
                }
            }
        }
	}
	
	/**
	 * update layout_style and layout_script field in layout table by all widget in layout
	 * layout_style = array(head=>..., footer=>...)
	 * use write style and script to head or footer order in home page
	 * 
	 * @param int $layoutId
	 */
	public static function update_style_script($layoutId){
		//get all widget
		$widgetList = self::getWidgetList($layoutId);
		
		$styleList = array();
		$scriptList = array();
		foreach($widgetList as $v){
			//get data
			$widgetController = $v->controller;
			$pluginStatus = $v->pluginStatus;
			
			//check $pluginCode
			if($pluginStatus !== 'D'){
				//loadWidget
				FileHelper::loadWidget($v);
				
				//get $styleList by loadStyle function
		    	$controller = new $widgetController();
		    	$methods = get_class_methods($controller);
		    	if(in_array('loadStyle', $methods)){
		    		$styleData = $controller->loadStyle();
		    		if($styleData){	//!null !false
			    		if(!is_array($styleData)){	//string 
			    			$styleList['head'][] = $styleData;
			    		}
			    		else{	//array
			    			foreach($styleData as $key => $style){
			    				if(is_array($style)){
			    					foreach($style as $k => $v){
			    						if(!in_array($v, $styleList[$key]))$styleList[$key][] = $v;
			    					}
			    				}
			    				else{
			    					if(!in_array($style, $styleList['head']))$styleList['head'][] = $style;
			    				}
			    			}
			    		}
		    		}
		    	}
		    	
				//get $scriptList by loadScript function
		    	$controller = new $widgetController();
		    	$methods = get_class_methods($controller);
		    	if(in_array('loadScript', $methods)){
		    		$scriptData = $controller->loadScript();
		    		if($scriptData){	//!null !false
			    		if(!is_array($scriptData)){	//string 
			    			$scriptList['head'][] = $scriptData;
			    		}
			    		else{	//array
			    			foreach($scriptData as $key => $script){
			    				if(is_array($script)){
			    					foreach($script as $k => $v){
			    						if(!in_array($v, $scriptList[$key]))$scriptList[$key][] = $v;
			    					}
			    				}
			    				else{
			    					if(!in_array($script, $scriptList['head']))$scriptList['head'][] = $script;
			    				}
			    			}
			    		}
		    		}
		    	}
			}//end if $pluginCode
		}
		
		//get $templateName
		$templateName = TemplateExt::getTemplateActive();
		
		$layoutStyle = array(
			'head' => self::getLayoutStyle($styleList, 'head', $templateName),
			'footer' => self::getLayoutStyle($styleList, 'footer', $templateName),
		);
		$layoutScript = array(
			'head' => self::getLayoutScript($scriptList, 'head', $templateName),
			'footer' => self::getLayoutScript($scriptList, 'footer', $templateName),
		);
		
		//update $layoutStyle and $layoutScript to layout table
		$layoutDao = new LayoutDao();
		$layoutVo = new LayoutVo();
		$layoutVo->layoutStyle = json_encode($layoutStyle);
		$layoutVo->layoutScript = json_encode($layoutScript);
		$layoutDao->updateByPrimaryKey($layoutVo, $layoutId);
  	}
  	
  	public static function getLayoutStyle($styleList, $tag = 'head', $templateName){
  		$styleContent = '';
  		$templatePath = URLHelper::getBaseUrl()."/resource/frontend/$templateName";
  		foreach($styleList[$tag] as $style){
  			$styleContent .= "<link href='$templatePath/$style' rel='stylesheet' type='text/css'>\n";
  		}
  		if($styleContent != '') $styleContent = "<!-- style of widget on $tag -->\n" . $styleContent;
  	
  		return $styleContent;
  	}
  	
  	public static function getLayoutScript($scriptList, $tag = 'head', $templateName){
  		$scriptContent = '';
  		$templatePath = URLHelper::getBaseUrl()."/resource/frontend/$templateName";
  		foreach($scriptList[$tag] as $script){
  			$scriptContent .= "<script src='$templatePath/$script' type='text/javascript'></script>\n";
  		}
  		if($scriptContent != '') $scriptContent = "<!-- script of widget on $tag -->\n" . $scriptContent;
  	
  		return $scriptContent;
  	}
}