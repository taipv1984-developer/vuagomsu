<?php
class AdminLayoutController extends Controller{
	private $widgetDao;
	private $widgetCatDao;
	private $layoutDao;
	private $layoutRowDao;
	private $layoutWidgetDao;
    
    function __construct(){
    	$this->widgetDao = new WidgetDao();
    	$this->widgetCatDao = new WidgetCatDao();
    	$this->layoutDao = new LayoutDao();
    	$this->layoutRowDao = new LayoutRowDao();
    	$this->layoutWidgetDao = new LayoutWidgetDao();
    }

    private function getAllLayoutRow(){
    	$layoutRowVo = new LayoutRowVo();
    	$layoutRowVo->layoutId = $_REQUEST['layoutId'];
    	$order = array('order' => 'ASC');
    	$layoutRowVos = $this->layoutRowDao->selectByFilter($layoutRowVo, $order);

    	return $layoutRowVos;
    }
    
    /**
     * getAllWidget group by widgetCatName
     * 
     * @return array 
     */
    private function getAllWidget($status=''){
    	$widgetVo = new WidgetVo();
    	if($status != ''){
            $widgetVo->status = $status;
        }
    	$widgetVos = $this->widgetDao->selectByFilter($widgetVo);
    	
    	//add info
    	$widgets = array();
    	foreach($widgetVos as $k => $v){
    		$widgetCat = $this->widgetCatDao->selectByPrimaryKey($v->widgetCatId);
    		$v->widgetCatName = $widgetCat->name;
    		$v->widgetCatDescription = $widgetCat->description;
    		$widgets[$v->widgetId] = $v;
    	}
    	return $widgets;
   }
    
    /**
     * getAllLayout of admin
     * 
     * @param string $returnType(object*, array)
     * @return list object or array
     */
    private function getAllLayout($returnType='object'){
    	$layoutVo = new LayoutVo();
    	$layoutVo->status = 'A';
    	$orderBy = array(
    		'order' => 'ASC',
    	);
    	$layoutVos = $this->layoutDao->selectByFilter($layoutVo, $orderBy);
    	if($returnType != 'object'){
    		$layoutList = array();
    		foreach($layoutVos as $k => $v){
    			$layoutList[$v->layoutId] = $v->name;
    		}
    		return $layoutList;
    	}
    	else{
    		return $layoutVos;
    	}
   }
    
    private function getAllLayoutWidget(){
    	$sql = "
select lw.*, w.icon, w.`name`, w.controller
from `layout_widget` as lw
left join widget as w on w.widget_id=lw.widget_id
where  lw.`layout_id` in (1, 0) 
order by lw.`order` asc";
        $layoutWidgetVos = DataBaseHelper::query($sql);

    	$layoutWidget = array();
    	foreach($layoutWidgetVos as $k => $v){
    		$layoutWidget[$v->layoutWidgetId] = $v;
    	}

    	return $layoutWidget;
   }
    
    /**
     * manage validate(check input, action, request, permission...)
     * 
     * @return boolean
     */
    private function manage_validate(){
    	//Check action
    	$action = $_REQUEST['action'];
    	if($action == ''){
    		header("location: index.php?r=admin/layout/manage&action=edit");
    		return false;
    	}
    	$actions = array('add', 'edit', 'delete');	
    	if(!in_array($action, $actions)){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Layout is not action = $action"));
    		header("location: index.php?r=admin/layout/manage&action=edit");
    		return false;
    	}
    	
    	if($action == 'add'){
    		return true;
    	}
    	else{
	    	//check $_REQUEST['layoutId']
	    	if(isset($_REQUEST['layoutId'])){
	    		$layoutId = $_REQUEST['layoutId'];
	    	}
	    	else{
	    		//set view layout first
	    		$layoutVos = $this->getAllLayout();
	    		$layoutList = array();
	    		if(count($layoutVos)== 0){
	    			header("location: index.php?r=admin/layout/manage&action=add");
	    			return false;
	    		}
	    		else{
		    		$i = 0;
		    		$firstLayoutId = 0;
		    		foreach($layoutVos as $k => $v){
		    			$layoutList[$v->layoutId] = $v->name;
		    			if($i == 0){$firstLayoutId = $v->layoutId;}
		    			$i++;
		    		}
		    		header("location: index.php?r=admin/layout/manage&action=edit&layoutId=$firstLayoutId");
		    		return false;
	    		}
	    	}
	    	
	    	return true;
    	}
   }
    
    /**
     * *** manage all in one ***
     */
    public function manage(){
    	//manage validate
    	$validate = $this->manage_validate();

    	//get $_REQUEST
    	$action = $_REQUEST['action'];
    	$layoutId = $_REQUEST['layoutId'];
    	
    	//set session
    	Session::setSession('layoutId', $layoutId);
    	
    	//action post
    	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    		//layout_action
    		$this->layout_action($action);
    		
    		//update_style_script
    		LayoutExt::update_style_script($layoutId);
    		
    		//update custom_css to setting table
    		$settingDao = new SettingDao();
    		$settingVo = new SettingVo();
    		$settingVo->settingValue = $_REQUEST['custom_css'];
    		$settingDao->updateByPrimaryKey($settingVo, 'custom_css');
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e("%s layout is success!", $action));
    		header("location: index.php?r=admin/layout/manage&action=$action&layoutId=$layoutId");
    		return;
    	}
    	
    	//splist $allLayoutWidget to activeLayoutWidget and disableLayoutWidget
    	$allLayoutWidget = $this->getAllLayoutWidget();
    	$activeLayoutWidget = array();
    	$disableLayoutWidget = array();
    	foreach($allLayoutWidget as $v){
    		if($v->status == 'A'){
    			$activeLayoutWidget[] = $v;
    		}
    		if($v->status == 'D'){
    			$disableLayoutWidget[] = $v;
    		}
    	}
    	
		//send data
    	$this->setAttributes(array(
    		'action' 	=> $_REQUEST['action'],
			'layoutId' 	=> $_REQUEST['layoutId'],
			'layoutList' 		=> $this->getAllLayout('array'),
			'layoutInfo' 		=> $this->layoutDao->selectByPrimaryKey($layoutId),
			'widgets' 			=> $this->getAllWidget(),
			'layoutRow' 		=> $this->getAllLayoutRow(),
			'allLayoutWidget' 	=> $allLayoutWidget,
			'activeLayoutWidget'	=> $activeLayoutWidget,
			'disableLayoutWidget' 	=> $disableLayoutWidget,
    		'layoutRowMobile' => LayoutExt::getLayoutRowMobile($layoutId),
			
			'layoutRowSystem' => LayoutExt::getLayoutRowSystem(),
    		'layoutRowMobileSystem' => LayoutExt::getLayoutRowMobileSystem()
    	));
		
		//call view
		return $this->setRender('manage');
   }
   
    /**
     * action in layout table
     * 
     * @param string $action
     * @return void
     */
    private function layout_action($action){
    	$layoutId = $_REQUEST['layoutId'];
    	$widgetList = $_REQUEST['widgetList'];
     	
    	switch($action){
    		case 'edit':
    			//step1: layout_row table(update order, layoutWidgetList)
    			$layoutRow = $_REQUEST['layoutRow'];
    			foreach($layoutRow as $k => $v){
    				$layoutRowVo = new LayoutRowVo();
    				
    				//set order
    				$order = $v['position'];
    				$layoutRowVo->order = $order;
    				
    				//set layoutWidgetList
    				$cols = $v['cols'];
    				if($cols == '')$cols = array();
    				$layoutRowVo->layoutWidgetList = json_encode($cols);
    				
    				//update
    				$this->layoutRowDao->updateByPrimaryKey($layoutRowVo, $k);
    			}
    			
    			//step2: update layoutWidgetList for layoutRow (group mobile)
    			//for layoutMobile
    			$layoutWidgetList = $_REQUEST['m_layout_widget_list'];
    			$layoutRowMobile = LayoutExt::getLayoutRowMobile($layoutId);
    			$layoutRowVo = new LayoutRowVo();
    			$layoutRowVo->layoutWidgetList = json_encode($layoutWidgetList);
    			$this->layoutRowDao->updateByPrimaryKey($layoutRowVo, $layoutRowMobile->layoutRowId);
    			
    			//for layoutMobileSystem
    			$layoutWidgetList = $_REQUEST['m_layout_system_widget_list'];	//#
    			$layoutRowMobile = LayoutExt::getLayoutRowMobileSystem();		//#
    			$layoutRowVo = new LayoutRowVo();
    			$layoutRowVo->layoutWidgetList = json_encode($layoutWidgetList);
    			$this->layoutRowDao->updateByPrimaryKey($layoutRowVo, $layoutRowMobile->layoutRowId);
    			
    			//step3: update active_layout_widget_list and disable_layout_widget_list
    			$activeLayoutWidgetList = $_REQUEST['active_layout_widget_list'];	//1-2-3 to array
    			$activeLayoutWidgetList = ($activeLayoutWidgetList != '')? explode('-', $activeLayoutWidgetList): array();
    			$i = 0;
    			foreach($activeLayoutWidgetList as $layoutWidgetId){
    				$i++;
    				$layoutWidgetVo = new LayoutWidgetVo();
    				$layoutWidgetVo->status = 'A';
    				$layoutWidgetVo->order = $i;
    				$this->layoutWidgetDao->updateByPrimaryKey($layoutWidgetVo, $layoutWidgetId);
    			}
    			$disableLayoutWidgetList = $_REQUEST['disable_layout_widget_list'];	//1-2-3 to array
    			$disableLayoutWidgetList = ($disableLayoutWidgetList != '')? explode('-', $disableLayoutWidgetList): array();
    			$i = 0;
    			foreach($disableLayoutWidgetList as $layoutWidgetId){
    				$i++;
    				$layoutWidgetVo = new LayoutWidgetVo();
    				$layoutWidgetVo->status = 'D';
    				$layoutWidgetVo->order = $i;
    				$this->layoutWidgetDao->updateByPrimaryKey($layoutWidgetVo, $layoutWidgetId);
    			}
    			
    			//save systemHeader and systemFooter
    			$layoutDao = new LayoutDao();
    			$layoutVo = new LayoutVo();
    			$layoutVo->name = $_REQUEST['name'];
    			$layoutVo->systemHeader = $_REQUEST['system_header'];
    			$layoutVo->systemFooter = $_REQUEST['system_footer'];
    			$layoutDao->updateByPrimaryKey($layoutVo, $layoutId);
    			break;
    		default:
    			SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Not action = $action in AdminLayoutController."));
    			header('location: index.php?r=admin/layout/manage');
    			return;
    			break;
    	}
   }
    
    /** ***
     * action show, add, edit, delete item on layout_widget table
     */
	public function layout_widget_action_ajax(){
		$action = $_REQUEST['action'];
		
		//show_layout_widget, change_layout_widget, edit_layout_widget, add_layout_widget
		switch($action){	
			case 'show_add_widget_mobile':
			case 'show_add_widget':
				TemplateHelper::getTemplate('layout/dialog_form_content/add_widget.php', 
					array('allWidget' => $this->getAllWidget('A'))
				);
				break;
			case 'show_edit_widget':
				$layoutWidgetId = $_REQUEST['layout_widget_id'];
				$layoutWidgetInfo = LayoutExt::layoutWidgetInfo($layoutWidgetId);
				$widgetController = $layoutWidgetInfo->widgetController;
				$widgetInfo = WidgetExt::getWidgetInfo_byController($widgetController);
				//loadWidget
				FileHelper::loadWidget($widgetInfo);
				if(class_exists($widgetController)){
					$control = new $widgetController($layoutWidgetInfo);
					$control->form();
				}
				else{
					LogUtil::devInfo("[AdminLayoutController::show_edit_widget] Controler $widgetController not exist");
				}
				break;
			case 'change_widget':
				$widgetController = $_REQUEST['widget_controller'];
				$widgetInfo = WidgetExt::getWidgetInfo_byController($widgetController);
				//loadWidget
				FileHelper::loadWidget($widgetInfo);
				if(class_exists($widgetController)){
	   				$control = new $widgetController();
	   				$control->form();
	   			}
	   			else{
	   				LogUtil::devInfo("[AdminLayoutController::change_widget] Controler $widgetController not exist");
	   			}
				break;
			case 'add_widget_mobile':
			case 'add_widget':
				//get data
				$widgetController = $_REQUEST['widget_controller'];
				$jsonSetting = $_REQUEST['json_setting'];
					$jsonSettingTitle = $jsonSetting['title'];
				$setting = json_encode($jsonSetting);
				$group = $_REQUEST['group'];
			
				//get widget info have controller = $widgetControllerName
				$widgetVo = new WidgetVo();
				$widgetVo->controller = $widgetController;
				$widgetVos = $this->widgetDao->selectByFilter($widgetVo);
				if($widgetVos){
					$widget = $widgetVos[0];
				}
				else{
					$widget = new WidgetVo();
					LogUtil::devInfo("Can't find widget in action=add_widget");
				}
				
				//add to layoutWidget
				$layoutWidgetVo = new LayoutWidgetVo();
				if($group == 'undefined'){
					$layoutWidgetVo->layoutId = $_REQUEST['layoutId'];
					$layoutWidgetVo->status = 'A';
				}
				else{	//$group = header|footer
					$layoutWidgetVo->layoutId = 0;	//is layout_widget system
					$layoutWidgetVo->status = 'S';
				}
				$layoutWidgetVo->layoutRowId = $_REQUEST['layout_row_id'];
				$layoutWidgetVo->widgetId = $widget->widgetId;
				$layoutWidgetVo->widgetController = $widgetController;
				$layoutWidgetVo->type = $_REQUEST['type'];
				$layoutWidgetVo->setting = $setting;
				$layoutWidgetVo->order = 0;
				$layoutWidgetId = $this->layoutWidgetDao->insert($layoutWidgetVo);
				
				//return data
				$title = ($jsonSettingTitle != '')? "<b class='blue'>$jsonSettingTitle</b>" : $widget->name;
				$data = array('layoutWidgetId' => $layoutWidgetId, 'widgetController' => $widget->controller, 'title' => $title, 'icon' => $widget->icon);
				echo json_encode($data);
				break;
			case 'edit_widget':
				$layoutWidgetId = $_REQUEST['layout_widget_id'];
				$widgetController = $_REQUEST['widget_controller'];
				$jsonSetting = $_REQUEST['json_setting'];
					$jsonSettingTitle = $jsonSetting['title'];
				$setting = json_encode($jsonSetting);
				
				//update to layoutWidget
				$layoutWidgetVo = new LayoutWidgetVo();
				$layoutWidgetVo->setting = $setting;
				$this->layoutWidgetDao->updateByPrimaryKey($layoutWidgetVo, $layoutWidgetId);
				
				//get widget info have controller = $widgetControllerName
				$widgetVo = new WidgetVo();
				$widgetVo->controller = $widgetController;
				$widgetVos = $this->widgetDao->selectByFilter($widgetVo);
				if($widgetVos){
					$widget = $widgetVos[0];
				}
				else{
					$widget = new WidgetVo();
					LogUtil::devInfo("Can't find widget in action=edit_widget");
				}
				
				//return data
				$title = ($jsonSettingTitle != '')? "<b class='blue'>$jsonSettingTitle</b>" : $widget->name;
				echo $title;
				break;
			case 'delete_widget':
				$layoutWidgetId = $_REQUEST['layout_widget_id'];
				$this->layoutWidgetDao->deleteByPrimaryKey($layoutWidgetId);
				break;
			default:
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Not action = $action in layout_widget_action_ajax."));
				break;
		}		
		
		return $this->setRender('success');
	}
	
	/**
	 * action add_row, delete_row on row table
	 * update layout_row system				OK
	 */
	public function layout_row_action_ajax(){
		$action = $_REQUEST['action'];
		switch($action){
			case 'add_row':
				$layoutId = $_REQUEST['layoutId'];
				$cols = $_REQUEST['cols'];
				$layoutRowId = LayoutExt::insertLayoutRow($layoutId, $cols);
				
				//return new row insert
				echo $layoutRowId;
				break;
			case 'add_row_system':
				$cols = $_REQUEST['cols'];
				$group = $_REQUEST['group'];
				$layoutRowId = LayoutExt::insertLayoutRow(0, $cols, $group);
				//return new row insert
				echo $layoutRowId;
				break;
			case 'delete_row':
				//get data
				$layoutRowId = $_REQUEST['layoutRowId'];
				$layoutWidgetList = $_REQUEST['layout_widget_list'];
				$layoutWidgetList = ($layoutWidgetList !=  '') ? explode('-', $layoutWidgetList): array();
				
				//check layout_row info 
				$layoutRowInfo = $this->layoutRowDao->selectByPrimaryKey($layoutRowId);
				if($layoutRowInfo->group != ''){	//is layout_row of system	->	delete all layout_widget
					foreach($layoutWidgetList as $v){
						$this->layoutWidgetDao->deleteByPrimaryKey($v);
					}
				}				
				else{	//layout_row normal 	->	disable all layout_widget
					foreach($layoutWidgetList as $v){
						$layoutWidgetVo = new LayoutWidgetVo();
						$layoutWidgetVo->status = 'D';
						$this->layoutWidgetDao->updateByPrimaryKey($layoutWidgetVo, $v);
					}
				}
				
				//delete layout_row
				$this->layoutRowDao->deleteByPrimaryKey($layoutRowId);
				
				break;
			case 'show_row_setting':
				$layoutRowId = $_REQUEST['layoutRowId'];
				$rowInfo = $this->layoutRowDao->selectByPrimaryKey($layoutRowId);
				
				TemplateHelper::getTemplate('layout/dialog_form_content/row_setting.php', array(
					'rowInfo' => $rowInfo)
				);	
				break;
			case 'update_row_setting':
				$layoutRowId = $_REQUEST['layoutRowId'];
				$jsonSetting = $_REQUEST['json_setting'];

				//update setting
				$layoutRowVo = new LayoutRowVo();
				$layoutRowVo->setting = json_encode($jsonSetting);
				$layoutRowVo->status = $_REQUEST['status'];
				$this->layoutRowDao->updateByPrimaryKey($layoutRowVo, $layoutRowId);
				
				//return
				$data = array('setting' => $jsonSetting);
				echo json_encode($data);
				break;
			default:
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Not action = $action in layout_row_action_ajax"));
				break;
		}
	
		return $this->setRender('success');
	}
}