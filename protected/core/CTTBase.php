<?php
class CTTBase{
	/**
	 * read all file of $dir(dequi)	OK
	 * 
	 * @param string $dir
	 * @param array $importClasses(ref)
	 * @param null*|array $filter array(in=>array(), out=>array())
	 * 		in=array(str1, str2...)			select name if file name include str1, str2...
	 * 		out=array(str1, str2...)   not select name if file name include str1, str2...
	 */
	private function listFiles($dir, &$importClasses, $filter=null){
		if(!isset($importClasses))$importClasses = array();
		$ffs = scandir($dir);
		foreach($ffs as $ff){
			$current_path = $dir.'/'.$ff;
			if($ff != '.' && $ff != '..'){
				if(is_dir($current_path)){
					$this->listFiles($current_path, $importClasses, $filter);
				}
				else{
					if(substr($current_path, -4, 4)== '.php'){
						$importPath = str_replace(PROTECTED_PATH, '', $current_path);	//core/config/CTTConfig.php
						$importPath = str_replace('//', '/', $importPath);
						
						//check filter
						if($filter === null){		//default
							$importClasses[]= $importPath;
						}
						else if(is_array($filter)){	//array(in=>array(), out=>array())
							$filterAll = array();
							foreach($filter['in'] as $v){
								$filterAll[$v] = 'in';
							}
							foreach($filter['out'] as $v){
								$filterAll[$v] = 'out';
							}
							foreach($filterAll as $k => $v){
								$pos = strpos($importPath, $k);
								if($v == 'in'){		//in if pos => take
									if($pos !== false){
										$importClasses[]= $importPath;
									}
								}
								else{				//out if not pos => take
									if($pos === false){
										$importClasses[]= $importPath;
									}
								}
							}//end foreach $filterAll
						}
						else{
							//log
							LogUtil::devInfo("[CTTBase::listFiles] filter = $filter incorrect");
						}
					}//end if filter case
				}
			}
		}
	}

	/**
	 * Load core files define by $GLOBALS['APP_CONFIGS']['framework_core'] 
	 * Load 1st
	 */
	private function importFileCore(){
		//get list framework load controler 
		foreach($GLOBALS['APP_CONFIGS']['framework_core'] as $var){
			$this->listFiles($var, $importClasses);
		}
		
		foreach($importClasses as $file){
			require_once PROTECTED_PATH.$file;
		}
	}
	
	public function start(){
		ob_start();
		try{
			spl_autoload_register();
			
			//1.	load core file
			$this->importFileCore();

			//set ApplicationConfigHelper
            ApplicationConfigHelper::set();

            //get system file
            $settingVo = new SettingVo();
            $settingDao = new SettingDao();
            $settingVo = $settingDao->selectAll();
            foreach($settingVo as $v){
                Registry::setSetting($v->settingName, $v->settingValue);
            }
			
			//get all controller in plugin info after load to session then use loadAuto file
			PluginHelper::setupPluginCodeMap();

            //pluginLoaded init
            Session::setSession('pluginLoaded', null);

			//get plugin is active
			$pluginCodes = PluginHelper::getPluginCodes('A');
			$pluginActionConfig = array();
			foreach ($pluginCodes as $pluginCode){
                FileHelper::loadDir($pluginCode, 'config');
                $actionFile = PLUGIN_PATH."$pluginCode/config/action_config.php";
                $pluginActionConfig += include $actionFile;
				
				//run init function of plugin (load common file)
				include_once (PLUGIN_PATH."$pluginCode/action.php");
				$actionClass = StringHelper::toCamelCase($pluginCode).'Action';
				$methodClass = get_class_methods($actionClass);
				if(in_array('init', $methodClass)){
					$actionClass::init();
				}
			}
            LogUtil::info($pluginCodes, null, 'Plugin List');

			$systemActionConfig = include $GLOBALS['APP_CONFIGS']['action_config_loader'];
			$actionConfig = $systemActionConfig + $pluginActionConfig;
			CTTConfig::Instance()->setActionMap($actionConfig);
				
			//get $actionMap
			$actionMap = CTTConfig::Instance()->getActionMap();
			$baseUrl = Registry::getSetting('base_url');
			
			//5.	load controller
			$actionParam = $_REQUEST[ACTION_PARAM];
            LogUtil::info("action = $actionParam");
			/**********************
			 * Router action
			 *********************/
			if($actionParam == '') {
				$actionParam = 'home';
				$_REQUEST[ACTION_PARAM] = $actionParam;
			}
			//get $routerUrlList
			$routerUrlList = RouterExt::getRouterUrlListByAlias();

			//edit $actionParam
			if($routerUrlList[$actionParam]){
				$routerUrlData = $routerUrlList[$actionParam];
				//check redirectTo
				if($routerUrlData->redirectTo != ''){
					//SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Page is changed");
					header("location: ".$baseUrl.'/'.$routerUrlData->redirectTo);
					return;
				}
				//set $actionParam
				$actionParam = $routerUrlData->dispatch;
				//set $_REQUEST
				$_REQUEST[ACTION_PARAM] = $actionParam;
				$_REQUEST[$routerUrlData->pkName] =  $routerUrlData->pkValue;
				//set $_REQUEST from QUERY_STRING
				$urlRequest = ArrayHelper::getUrlRequest();
				foreach ($urlRequest as $k => $v){
					$_REQUEST[$k] = $v;
				}
			}
			
			//set session for $routerUrlList then get link from session (URLHelper)
			RouterExt::clearSession();
			foreach ($routerUrlList as $v){
				$alias = $v->alias;
				$key = "/index.php?r={$v->dispatch}";
				if($v->pkName != '' & $v->pkValue != ''){
					$key .= "&{$v->pkName}={$v->pkValue}";
				}
				if($v->redirectTo != ''){
					RouterExt::setSession($key, $v->redirectTo);
				}
				else{
					RouterExt::setSession($key, $v->alias);
				}
			}
			/**********************
			 * Router action end
			 *********************/
			if($actionParam == ''){		//homepage
				$_REQUEST[ACTION_PARAM] = $actionParam;
				$actionType = $actionMap[DEFAULT_ACTION]['type'];
				$actionControler = $actionMap[DEFAULT_ACTION]['controller'];	//HomeController
                $method = $actionMap[DEFAULT_ACTION]['method'];
			}
			else{
           	 	$actionType = $actionMap[$actionParam]['type'];					//string frontend | admin 
           	 	$actionControler = $actionMap[$actionParam]['controller'];		//AdminExtensionController
                $method = $actionMap[$actionParam]['method'];
			}
            //if namespace case
            $pos = strpos($actionControler, '\\');
            if($pos !== -1){
                $exp = explode('\\', $actionControler);
                $actionControler = $exp[count($exp)-1];
            }

			if(!$actionType){
				header("location: ".URLHelper::get404Page($actionParam));
				return;
			}
			
			//6.	get $pluginCode
			$pluginCodeMap = Session::getSession('pluginCodeMap');
			$pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
            FileHelper::loadPlugin($pluginCode);

			//7.	load common file
			if($actionType == 'frontend'){
				//get template active
				$templateName = TemplateExt::getTemplateActive();
				Registry::setTemplate('templateName', $templateName);
			}
			
			//8.	load controller file
        	FileHelper::loadController($actionControler, $actionType, $pluginCode);

            LogUtil::info("controller = $actionControler ... method = $method ... pluginCode = $pluginCode");
        	LogUtil::info($_REQUEST, null, 'Request Data');

			//9. 	filter
			CTTConfig::Instance()->setFilters(include $GLOBALS['APP_CONFIGS']['filter_config']);
			CTTConfig::Instance()->addFilter('CTTMvcFilter');

			if(!isset($_REQUEST)|| !array_key_exists(ACTION_PARAM, $_REQUEST)){
				$_REQUEST[ACTION_PARAM] = DEFAULT_ACTION;
			}
				
			//run filter config	(PrepareParamFilter -> AuthorizationCheckFilter)***
			$cfilterChain = new CFilterChainImp(CTTConfig::Instance()->getFilters());
			$cfilterChain->doFilter();
		
			//10.	render
            if(isset($_REQUEST[TT_CTX][RENDER_KEY])){
            	$resultKey = $_REQUEST[TT_CTX][RENDER_KEY];
				if($actionMap[$_REQUEST[ACTION_PARAM]]['results'][$resultKey]){
					$resultInfo = $actionMap[$_REQUEST[ACTION_PARAM]]['results'][$resultKey];
				}

				//get result of actionMap(array(success=>array(), manage=>array()...)
				if(!isset($resultInfo)){
					$resultInfo = $actionMap[GLOBAL_RESULT]['results'][$resultKey];
				}
				
				if(isset($resultInfo)){
					$rType = $resultInfo['type'];
					$rPath = $resultInfo['path'];
					$rLayout = $resultInfo['layout'];
					
					//case resultInfoType(string include | redirect)
					if($rType == 'include'){
						if($actionType == 'frontend'){
							//plugin home
                        	$templateView = ($templateName != '') ?  $templateName.'/' : DEFAULT_TEMPLATE.'/';
                        	if($pluginCode == ''){
	                        	$contentPath = ($rPath != '') ? PROTECTED_PATH."view/frontend/".$templateView.$rPath : '';
                        	}
                        	else{
                        		$contentPath = ($rPath != '') ? PLUGIN_PATH."$pluginCode/view/".$rPath : '';
                        	}
                        	$layout = ($rLayout != '') ? PROTECTED_PATH."view/frontend/".$templateView.$rLayout : '';
						}
						else{
							$templateView = '';
							if($pluginCode == ''){
								$contentPath = ($rPath != '') ? PROTECTED_PATH."view/".$templateView.$rPath : '';
							}
							else{
								$contentPath = ($rPath != '') ? PLUGIN_PATH."$pluginCode/view/".$templateView.$rPath : '';
							}
                        	$layout = ($rLayout != '') ? PROTECTED_PATH."view/".$templateView.$rLayout : '';
						}
						
                        //include layout
                        if (isset ( $_REQUEST ["rtype"] ) && "json" === $_REQUEST ["rtype"]) {
                            // Render view.
                            ob_start ();
                            include $layout;
                            $viewContent = ob_get_clean ();
                            ob_end_clean ();

                            $jsonData = SessionMessage::getJsonData();

                            header ( "Content-Type: application/json" );
                            echo json_encode ( array (
                                'errorCode' => $jsonData['errorCode'],
                                'message' => $jsonData['message'],
                                'content' => $viewContent,
                                'extra' => $jsonData['extra']
                            ) );
                        }
                        else {
                            //LogUtil::info("layout = $layout");
                            LogUtil::info("contentPath = $contentPath");
                            include $layout;
                        }
						
						if($rPath != '' & $rLayout != ''){
							//clearSessionMessages
							SessionMessage::clearSessionMessages();
						}
					}//end $rType = include
					else if($rType == 'redirect'){	//$rPath = index.php?r=admin/extension/payment
						$tt_query_param='';
						if(!empty($_REQUEST[TT_CTX][RENDER_KEY_URL_PARAM])){
							foreach($_REQUEST[TT_CTX][RENDER_KEY_URL_PARAM] as $key=>$value){
								if(empty($tt_query_param)){
									$tt_query_param=$key.'='.$value;
								}
								else {
									$tt_query_param='&'.$key.'='.$value;
								}
							}
						}
						if(empty($tt_query_param)){
							$alias = URLHelper::getAlias($rPath);
							if($alias){
								header("location: $alias");
							}
							else{
								header("location: $rPath");
							}
						}
						else{
							if(strpos($rPath, '?') !== false){
								header('location:'.$rPath.'&'.$tt_query_param);
							}
							else {
								header('location:'.$rPath.'?'.$tt_query_param);
							}
						}
						exit;
					}//end $rType = redirect
				}
				else{
					echo "No $resultKey found in system.";
				}// end $rType
			}
			else{//access false
				Session::setNotLogin();
				//get $permission
				$permission = Session::getPermission();
                if(!in_array($_REQUEST[ACTION_PARAM], $permission)){
                	SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Sorry! Page not found'));
                }
                elseif(isset($_REQUEST['AuthorizationCheckFilter']['hasPermission'])&& !$_REQUEST['AuthorizationCheckFilter']['hasPermission']){
                    SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Access denied'));
                }
                include PROTECTED_PATH.'view/layout/error_layout.php';
			}
		}
		catch(Exception $e){
			if($e instanceof ClassNotFoundException)
				echo 'ClassNotFoundException';
			else
				echo 'error...';
                //var_dump($e);
			throw $e;
		}
	}
}