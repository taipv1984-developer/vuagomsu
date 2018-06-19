<?php

class AdminSettingController extends Controller{
	private $settingDao;
	private $settingGroupDao;
	
    function __construct(){
		$this->settingDao = new SettingDao();
		$this->settingGroupDao = new SettingGroupDao();
   }
   
   public function manage(){
   	//check setting
   	if(!$_REQUEST['setting']){
   		$session_setting_manage = Session::getSession('session_setting_manage');
   		if(!$session_setting_manage) $session_setting_manage = "general";
   		header("location: index.php?r=admin/setting/manage&setting=$session_setting_manage");
   	}
   	
   	$setting = $_REQUEST['setting'];
   	$settingVo = new SettingVo();
   	$settingVo->settingType = $setting;
   	$settingVo->status = "A";
   	$settingVos = $this->settingDao->selectByFilter($settingVo);
   	
   	if(!$settingVos){
   		SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Setting not found");
   		return $this->setRender('false');
   	}
   	
   	//get $settingGroup
    $settingGroup = SettingExt::getSettingGroup($setting);
    $settingNameCheck = array();		//apply for check when update setting value (from $_REQUEST value)
    if(!empty($settingGroup)){
    	$settingList = array();
    	foreach ($settingVos as $v){
    		$settingList[$v->settingGroupId][] = $v;
    		$settingNameCheck[] = $v->settingName;
    	}
    	
    	//resort $settingList by position
	    foreach ($settingGroup as $k => $v){
	    	$settingSort = $settingList[$k];
	    	
	    	$sort_order = array();
	    	foreach($settingSort as $_k => $_v){
	    		$sort_order[$_k] = $_v->order;
	    	}
	    	array_multisort($sort_order, SORT_ASC, $settingSort);
	    	
	    	$settingList[$k] = $settingSort;
	    }
    }
    else{
    	//get $settingList
    	$settingList = array();
    	foreach ($settingVos as $v){
    		$settingList[] = $v;
    		$settingNameCheck[] = $v->settingName;
    	}
    }
    
   	$this->setAttributes(array(
   		'setting' => $setting,
   		'settingList' => $settingList,
   		'settingType' => SettingExt::getSettingType(),
   		'settingGroup' => $settingGroup
   	));
   	
   	if($_SERVER['REQUEST_METHOD'] == "POST"){
   		$settingVo = new SettingVo();
   		foreach($_REQUEST as $k => $v){
   			if(in_array($k, $settingNameCheck)){
	   			$settingVo->settingValue = $v;
	   			$this->settingDao->updateByPrimaryKey($settingVo, $k);
   			}
   		}
   		
   		//message
   		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Updated successfully!'));
   		
   		//set session
   		Session::setSession('session_setting_manage', $setting);
   		//view
   		return $this->setRender('success');
   	}
   	
   	return $this->setRender('manage');
	}
}