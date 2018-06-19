<?php
class PluginHelper{
	/**
	 * getPluginId from $pluginCode
	 * 
	 * @param string $pluginCode
	 * @return boolean | int
	 */
	public static function getPluginId($pluginCode){
		$sql = "select * from `plugin` where `plugin_code`='$pluginCode'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->pluginId : false;
	}
	
	/**
	 * get array data in function fetInfo in file action.php
	 * 
	 * @param string $pluginCode
	 * @return boolean | array
	 */
	public static function getPluginInfo($pluginCode){
		//load action file
		$actionFile = PLUGIN_PATH."$pluginCode/action.php";
		include_once $actionFile;
		//run getInfo function
		$controllerName = StringHelper::toCamelCase($pluginCode, true)."Action";
		$controller = new $controllerName();
		$methods = get_class_methods($controller);
		if(in_array('getInfo', $methods)){
			return $controller->getInfo();
		}
		else{
			LogUtil::devInfo("[PluginHelper::getPluginInfo] Plugin not exist function getInfo in action.php file");
			return false;
		}
	}
	
	/**
	 * insert info of plugin from action.php file
	 * 
	 * @param string $pluginCode
	 * @return boolean
	 */
	public static function setInfo($pluginCode){
		//get pluginId
		$pluginId = self::getPluginId($pluginCode);
		
		//load action file
		$actionFile = PLUGIN_PATH."$pluginCode/action.php";
		include_once $actionFile;
		//run getInfo function
		$controllerName = StringHelper::toCamelCase($pluginCode, true)."Action";
		$controller = new $controllerName();
		$methods = get_class_methods($controller);
		if(in_array('getInfo', $methods)){
			$info = $controller->getInfo();
			if($pluginId){
				$pluginDao = new PluginDao();
				$pluginVo = new PluginVo();
				$pluginVo->info = json_encode($info);
				$pluginDao->updateByPrimaryKey($pluginVo, $pluginId);
				return true;
			}
			else{
				LogUtil::devInfo("[PluginHelper::setInfo] not exist pluginCode = $pluginCode");
				return false;
			}
		}
		else{
			LogUtil::devInfo("[PluginHelper::setInfo] Plugin not exist function getInfo in action.php file");
			return false;
		}
	}
	
	/**
	 * getPluginCodes
	 * 
	 * @param string $status
	 * @return array(plugin_id => plugin_code)
	 */
	public static function getPluginCodes($status=''){
		$sql = ($status == '') ? "select * from `plugin` order by priority ASC" : "select * from `plugin` where `status`='$status' order by priority ASC";
		$output = array(
			'type' => 'array',  			//object* || array	(required)
			'key' => 'plugin_id',			//not required
			'value' => 'plugin_code'		//required if type=array
		);
		return DataBaseHelper::query($sql, null, $output);
	}
	
	/*******************************************)
	 * PLUGIN CALLBACK
	 *******************************************/
	/**
	 * run function install in file action.php (run at add plugin)
	 */
	public static function callbackInstall($pluginCode){
		//load action file
		$actionFile = PLUGIN_PATH."$pluginCode/action.php";
		include_once $actionFile;
		//run install function
		$controllerName = StringHelper::toCamelCase($pluginCode, true)."Action";
		$controller = new $controllerName();
		$methods = get_class_methods($controller);
		if(in_array('install', $methods)){
			$controller->install();
		}
		else{
			LogUtil::devInfo("[PluginHelper::callbackInstall] Plugin not exist function install in action.php file");
		}
	}
	
	/**
	 * run function upgrade in file action.php (run at edit plugin)
	 */
	public static function callbackUpgrade($pluginCode){
		//load action file
		$actionFile = PLUGIN_PATH."$pluginCode/action.php";
		include_once $actionFile;
		//run upgrade function
		$controllerName = StringHelper::toCamelCase($pluginCode, true)."Action";
		$controller = new $controllerName();
		$methods = get_class_methods($controller);
		if(in_array('upgrade', $methods)){
			$controller->upgrade();
		}
		else{
			LogUtil::devInfo("[PluginHelper::callbackUpgrade] Plugin not exist function install in action.php file");
		}
	}
	
	/**
	 * run function uninstall in file action.php (add at delete plugin)
	 */
	public static function callbackUninstall($pluginCode){
		//load action file
		$actionFile = PLUGIN_PATH."$pluginCode/action.php";
		include_once $actionFile;
		//run uninstall function
		$controllerName = StringHelper::toCamelCase($pluginCode, true)."Action";
		$controller = new $controllerName();
		$methods = get_class_methods($controller);
		if(in_array('uninstall', $methods)){
			$controller->uninstall();
		}
		else{
			LogUtil::devInfo("[PluginHelper::callbackUninstall] Plugin not exist function install in action.php file");
		}
	}
	
	/*******************************************)
	 * PLUGIN SETUP
	 *******************************************/
	/**
	 * read all plugin active then set pluginCodeMap data to session
	 * use loadAuto file
	 * example
	 * 		plugin help: 	controller = array('Help', 'HelpCat')
	 * 		plugin slider: 	controller = array('Slider', 'SliderImage')
	 * ->
	 * 		session[pluginCodeMap] = array('Help' => 'help', 'HelpCat' => 'help', 'Slider' => 'slider', 'SliderImage' => 'slider')
	 */
	public static function setupPluginCodeMap(){
        $pluginCodeMap = Session::getSession('pluginCodeMap');
//        if(!$pluginCodeMap) {
            $pluginCodes = self::getPluginCodes();
            $pluginCodeMap = array();
            foreach ($pluginCodes as $pluginCode) {
                $controllerPath = PLUGIN_PATH . "$pluginCode/controller";
                $fileList = array();
                FileHelper::dirToFiles($controllerPath, $fileList, 2);

                foreach ($fileList as $filePath) {
                    $key = str_replace('.php', '', basename($filePath));
                    $pluginCodeMap[$key] = $pluginCode;
                }
            }
            //var_dump($pluginCodeMap);

            //set session
            Session::setSession('pluginCodeMap', $pluginCodeMap);
//        }
	}
	
	/**
	 * add navLink for plugin
	 *
	 * @param string $pluginCode
	 */
	public static function setupNavLink($pluginCode){
		//get plugin info
		$pluginInfo = self::getPluginInfo($pluginCode);
	
		//check widget data
		if(isset($pluginInfo['navLink'])){
			$navLinkDao = new NavLinkDao();
			$navLink = $pluginInfo['navLink'];
			foreach ($navLink as $v){
				if(!isset($v['title'])) continue;
				//set default
				$type = (isset($v['type'])) ? $v['type'] : 'sub';
				$v['pluginCode'] = $pluginCode;
				if($type == 'main'){
					//add navLink main
					$v['parentId'] = 0;
					NavLinkExt::addNavLink($v);
				}
				else{
					//get parentId by parentTitle
					if(!isset($v['parentTitle'])) continue;
					$navLinkParent = NavLinkExt::getNavLinkByTitle($v['parentTitle']);
					$parentId = $navLinkParent->navLinkId;
						
					//add navLink sub
					$v['parentId'] = $parentId;
					NavLinkExt::addNavLink($v);
				}
			}
		}
	}
	
	/**
	 * get widget info from action.php then add or edit widget to widget table
	 * run at add plugin action and edit plugin action
	 * check widget file by controller params save to log file
	 * 
	 * @param string $pluginCode
	 */
	public static function setupWidget($pluginCode){
		//get plugin info
		$pluginInfo = self::getPluginInfo($pluginCode);
		
		//check widget data
		if(isset($pluginInfo['widget'])){
			$widgetDao = new WidgetDao();
			
			$widget = $pluginInfo['widget'];
			foreach ($widget as $v){
				//get data
				$widgetCatId = $v['widget_cat_id'];
				$name = $v['name'];
				$controller = $v['controller'];
				$description = $v['description'];
				$icon = $v['icon'];
				
				//check widgetFile
				$widgetFile = PLUGIN_PATH."$pluginCode/widget/$controller/$controller.php";
				if(file_exists($widgetFile)){
					//get widgetInfo from controller
					$widgetVo = new WidgetVo();
					$widgetVo->controller = $controller;
					$widgetVos = $widgetDao->selectByFilter($widgetVo);
					
					//if exist then edit widget else add widget
					if($widgetVos){	//edit widget	(skip update controller and pluginCode)
						$widgetInfo = $widgetVos[0];
						$widgetVo = new WidgetVo();
						$widgetVo->widgetCatId = $widgetCatId;
						$widgetVo->name = $name;
						$widgetVo->description = $description;
						$widgetVo->icon = $icon;
						$widgetDao->updateByPrimaryKey($widgetVo, $widgetInfo->widgetId);
					}
					else{	//add widget
						$widgetVo = new WidgetVo();
						$widgetVo->widgetCatId = $widgetCatId;
						$widgetVo->name = $name;
						$widgetVo->controller = $controller;
						$widgetVo->description = $description;
						$widgetVo->icon = $icon;
						$widgetVo->pluginCode = $pluginCode;
						$widgetDao->insert($widgetVo);
					}
				}
				else{
					LogUtil::devInfo("[PluginHelper::setupWidget] not found widget controller width controller = %s", "/widget/$controller/$controller.php");
				}
			}
		}
	}
	
	/**
	 * add page for plugin (show plugin content out home)
	 * 
	 * @param string $pluginCode
	 */
	public static function setupPage($pluginCode){
		//get plugin info
		$pluginInfo = self::getPluginInfo($pluginCode);
	
		//check widget data
		if(isset($pluginInfo['page'])){
			$layoutDao = new LayoutDao();
			$page = $pluginInfo['page'];
			foreach ($page as $v){
				if(!isset($v['name'])) continue;
				if(!isset($v['dispatch'])) continue;
				//add layout
				$layoutVo = new LayoutVo();
				$layoutVo->name = $v['name'];
				$layoutVo->dispatch = $v['dispatch'];
				$layoutVo->systemHeader = (isset($v['systemHeader'])) ? $v['systemHeader'] : 1;
				$layoutVo->systemFooter = (isset($v['systemFooter'])) ? $v['systemFooter'] : 1;
				$layoutVo->layoutStyle = '{"head":"","footer":""}';
				$layoutVo->layoutScript = '{"head":"","footer":""}';
				$layoutVo->pluginCode = $pluginCode;
				//check exist
				$layoutVos = $layoutDao->selectByFilter($layoutVo);
				if(!$layoutVos){
					$layoutDao->insert($layoutVo);
				}
			}
		}
	}
	/*******************************************)
	 * FILE MANAGE PLUGIN
	 *******************************************/
    /**
     * ham nay kiem tra lai FileHelper::dirToFiles
     */
	 public static function copyFile($pluginInfo){
		$pluginCode = $pluginInfo->pluginCode;
		
		//copy all file in folder resource, upload  to farmwork
		$templateName = TemplateExt::getTemplateActive();
		$dirs = array(
			'resource/backend',
			'resource/frontend',
			'upload',
		);
		 
		$fileListPlugin = array();
		foreach ($dirs as $dir){
			//get list file and dir from $dirSource
			$dirSource = PLUGIN_PATH."$pluginCode/data/$dir";
			$fileList = array();
			FileHelper::dirToFiles($dirSource, $fileList);
		
			//copy to framwork ($v)
			foreach ($fileList as $k => $v){
				$type = $v['type'];
				$file = $v['file'];
				$fileName = str_replace($dirSource, '', $file);
				if($dir == 'resource/frontend'){
					$fileTarget = BASE_PATH."/$dir/$templateName".$fileName;
				}
				else{
					$fileTarget = BASE_PATH."/$dir".$fileName;
				}
				if($type == 'dir'){
					//NOT CHECK DIR EXIST ~_~ (SKIP)
					mkdir($fileTarget);
					$fileList[$k]['status'] = 'skip';
				}
				else{
					if(file_exists($fileTarget)){
						$fileList[$k]['status'] = 'skip';
					}
					else{
						copy($file, $fileTarget);	//copy file
						$fileList[$k]['status'] = 'new';
					}
				}
				//short file name
				$fileList[$k]['file'] = str_replace(BASE_PATH.'/', '', $fileList[$k]['file']);
			}
			$fileListPlugin = array_merge($fileListPlugin, $fileList);
		}
		
		//get listFileDB
		$fileListDB = json_decode($pluginInfo->fileList, true);
		foreach ($fileListPlugin as $k => $v){
			$file = $v['file'];
			//check file in $fileListDB
			foreach ($fileListDB as $kDB => $vDB){
				$fileDB = $vDB['file'];
				if($file == $fileDB){
					//set status for $fileListPlugin again
					$fileListPlugin[$k]['status'] = $vDB['status'];
					//delete $fileListDB[$kDB]
					unset($fileListDB[$kDB]);
					//stop foreach
					break;
				}
			}
		}
		$fileListPlugin = array_merge($fileListPlugin, $fileListDB);
		
		//update listFile
		$pluginDao = new PluginDao();
		$pluginVo = new PluginVo();
		$pluginVo->fileList = json_encode($fileListPlugin);
		$pluginDao->updateByPrimaryKey($pluginVo, $pluginInfo->pluginId);
	}
	
	//updating...
	 public static function deleteFile($pluginInfo){
	 	$fileListDB = json_decode($pluginInfo->fileList, true);
	 	foreach ($fileListDB as $v){
	 		$file = $v['file'];
	 		$status = $v['status'];
	 		if($status == 'new'){
	 			$file = BASE_PATH.'/'.$file;
	 			echo "delete file = $file<br>";
// 	 			unlink($file);
	 		}
	 	}
	 }
	 
	/*******************************************)
	 * DELETE PLUGIN
	 *******************************************/
	/**
	 * delete plugin and tables relate (run at delete plugin action)
	 * 
	 * @param int $pluginCode
	 */
	public static function delete($pluginCode){
		//widget table
		$sql = "delete from `widget` where plugin_code=:pluginCode";
		$params = array(
			array(':pluginCode', $pluginCode, 'str')
		);
		DataBaseHelper::query($sql, $params, null);
		//delete widget in layout_row, layout_widget
		
		//nav_link table
		$sql = "delete from `nav_link` where plugin_code=:pluginCode";
		$params = array(
			array(':pluginCode', $pluginCode, 'str')
		);
		DataBaseHelper::query($sql, $params, null);
		
		//plugin table
		$sql = "delete from `plugin` where plugin_code=:pluginCode";
		$params = array(
			array(':pluginCode', $pluginCode, 'str')
		);
		DataBaseHelper::query($sql, $params, null);
		
		//delete layout, layout_row, layout_widget
	}
}