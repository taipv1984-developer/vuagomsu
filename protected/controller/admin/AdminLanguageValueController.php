<?php
class AdminLanguageValueController extends Controller {
	private $languageValueDao;
	public $languageValueModel;
	private $languageDao;
    
    function __construct(){
    	$this->languageValueDao = new LanguageValueDao();
    	$this->languageValueModel = new LanguageValueModel();
    	$this->languageDao = new LanguageDao();
    }
    
    private function _add_info($v, $languageList){
    	//languageName
    	$v->languageName = $languageList[$v->languageCode];
    }
    
    private function getLanguageList(){
    	//get $languageList
    	$languageAll = $this->languageDao->selectAll();
    	$languageList= array();
    	foreach ($languageAll as $v){
    		if($v->languageCode != DEFAULT_LANGUAGE){
    			$languageList[$v->languageCode] = $v->name;
    		}
    	}
    	
    	return $languageList;
    }
    
    //OK
    private function _filter($languageValueVo){
    	if(!CTTHelper::isEmptyString($this->languageValueModel->languageValueId)){
    		$languageValueVo->languageValueId = $this->languageValueModel->languageValueId;
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['languageValueModel_languageName'])){
    		$languageValueVo->languageCode = $_REQUEST['languageValueModel_languageName'];
    	}
    	if(!CTTHelper::isEmptyString($this->languageValueModel->key)){
    		$languageValueVo->key = array('like', "%{$this->languageValueModel->key}%");
    	}
    	if(!CTTHelper::isEmptyString($this->languageValueModel->value)){
    		$languageValueVo->value = array('like', "%{$this->languageValueModel->value}%");
    	}
    }
    
    //OK
	public function manage(){
        $languageValueVo = new LanguageValueVo();

        //filter
        $this->_filter($languageValueVo);
        
        //paging
        if(empty($_REQUEST['item_per_page'])){
            $recSize = Registry::getSetting('item_per_page');
        } 
        else {
            $recSize = $_REQUEST['item_per_page'];
        }
        $start = 0;
        if(CTTHelper::isEmptyString($_REQUEST ['page'])){
            $page = 0;
        } 
        elseif(is_numeric($_REQUEST ['page'])){
            $page = $_REQUEST ['page'];
        } 
        else {
            $page = 0;
        }
        $count = count($this->languageValueDao->selectByFilter($languageValueVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1)* $recSize;
        
        //get data
        $languageValueList = $this->languageValueDao->selectByFilter($languageValueVo, array(), $start, $recSize);
        
        //get $languageList
        $languageList = $this->getLanguageList();
        
        //add info
        foreach($languageValueList as $v){
        	$this->_add_info($v, $languageList);
        }
        
        //set data
        $paging->items = $languageValueList;
        
        //send data
        $this->setAttributes(array(
        	'languageList' => $languageList,
        	'pageView' => $paging
        ));
        
        //call view
        return $this->setRender('success');
    }

    //OK
    public function add_validate(){
    	$validate = array();
    	 
    	//get data
    	$key = $_REQUEST['key'];
    	 
    	//the key should not duplicate in the table
    	$languageValueVo = new LanguageValueVo();
    	$languageValueVo->key = $key;
    	$languageValueVos = $this->languageValueDao->selectByFilter($languageValueVo);
    	if($languageValueVos){
    		$validate["key"] = e("Language key is exist");
    	}
    	 
    	if(!empty($validate)){
    		echo json_encode($validate);
    	}
    	
    	return $this->setRender('success');
    }
    public function add(){
    	//get $languageList
    	$languageList = $this->getLanguageList();
    	
    	//send data
    	$this->setAttributes(array(
    		'languageList' => $languageList,
    	));
    	
    	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    		//get data
    		$key = $_REQUEST['key'];
    		$value = $_REQUEST['value'];
    		
    		//insert
    		foreach($value as $k => $v){
    			$languageValueVo = new LanguageValueVo();
    			$languageValueVo->languageCode = $k;
    			$languageValueVo->key = $key;
    			$languageValueVo->value = trim($v);
    			$this->languageValueDao->insert($languageValueVo);
    		}
    		 
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Language value add success");
    		return $this->setRender('manage');
    	}
    
    	return $this->setRender('success');
    }
    
    /**
     * OK
     * Auto import language key from all code file
     * use getImportFile and getLanguageKey funcion
     */
    public function import_auto(){
    	//get $importFile
    	$importFile = $this->getImportFile();
    	
    	//get $languageKey from 
    	$languageKey = array();
    	foreach($importFile as $v){
    		$myfile = fopen($v, "r")or die("Unable to open file!");
    		$content = fread($myfile,filesize($v));
    		fclose($myfile);
    		$this->getLanguageKey($content, $languageKey);
    	}
    	
    	//get all languageValue in db group by languageCode
    	$languageValueAll= $this->languageValueDao->selectAll();
    	$languageValueListBD = array();
    	foreach ($languageValueAll as $v){
    		$languageValueListBD[$v->languageCode][] = $v->key;
    	}
    	
    	//update to language_value table
    	$iCount = 0;
    	$languageList = $this->languageDao->selectAll();
    	foreach ($languageKey as $key){
    		foreach ($languageList as $language){
    			$languageCode = $language->languageCode;
    			if($languageCode == DEFAULT_LANGUAGE) continue;
	    		//check is exist
	    		if(!in_array($key, $languageValueListBD[$languageCode])){
	    			//insert new languageValue
	    			$languageValueVo = new LanguageValueVo();
	    			$languageValueVo->languageCode = $languageCode;
	    			$languageValueVo->key = $key;
	    			$languageValueVo->value = '';
	    			$languageValueId = $this->languageValueDao->insert($languageValueVo);
	    			$iCount++;
	    		}
    		}
    	}
    	
    	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Language value is updated. <br>Language value added is %s', $iCount));
    	return $this->setRender('success');
    }
    private function getImportFile(){
    	$importFile = array();
    	//system file
    	FileHelper::dirToFiles(BASE_PATH.'/protected/controller', $importFile);
    	FileHelper::dirToFiles(BASE_PATH.'/protected/ext', $importFile);
    	FileHelper::dirToFiles(BASE_PATH.'/protected/helper', $importFile);
    	FileHelper::dirToFiles(BASE_PATH.'/protected/view', $importFile);
    	FileHelper::dirToFiles(BASE_PATH.'/protected/widget', $importFile);
    	//plugin file
    	$pluginDao = new PluginDao();
    	$pluginVo = new PluginVo();
    	$pluginVo->status = 'A';
    	$pluginList = $pluginDao->selectByFilter($pluginVo);
    	foreach ($pluginList as $v){
    		$pluginCode = $v->pluginCode;
    		FileHelper::dirToFiles(PLUGIN_PATH."$pluginCode/controller", $importFile);
    		FileHelper::dirToFiles(PLUGIN_PATH."$pluginCode/ext", $importFile);
    		FileHelper::dirToFiles(PLUGIN_PATH."$pluginCode/view", $importFile);
    		FileHelper::dirToFiles(PLUGIN_PATH."$pluginCode/widget", $importFile);
    	}
    	return $importFile;
    }
    private function getLanguageKey($content, &$languageKey){
    	$content = str_replace('"', "'", $content);
    	$searchKeys = array();
    	$searchKey = ' e'; $searchKey .= '(';							// e(
    	$searchKeys[] = $searchKey;
    	$searchKey = 'SessionMessage::'; $searchKey .= '$SUCCESS,';		//SessionMessage::$SUCCESS,
    	$searchKeys[] = $searchKey;
    	$searchKey = 'SessionMessage::'; $searchKey .= '$ERROR,';		//SessionMessage::$ERROR,
    	$searchKeys[] = $searchKey;
    	
    	$removeData = array('' , 'SessionMessage::');
    	
    	foreach ($searchKeys as $searchKey){
	    	$ok = true;
	    	$i = 0;
	    	while($ok){
	    		$pos = strpos($content, $searchKey, $i);
	    		if($pos === false){
	    			$ok = false;
	    		} 
	    		else {
	    			$pos_start = strpos($content, "'", $pos + 1);
	    			$pos_end = strpos($content, "'", $pos_start + 1);
	    			$str = trim(substr($content, $pos_start + 1, $pos_end - $pos_start));
	    			$str = trim(str_replace("'", '', $str));
	    			
	    			if(!in_array($str, $languageKey) & !in_array($str, $removeData)){
	    				$languageKey [] = $str;
	    			}
	    			$i = $pos + strlen($searchKey);
	    		}
	    	}
    	}
    }
    
    //OK
    public function save(){
        //set data
		$languageValueId = $_REQUEST['id'];
		$value = $_REQUEST['value'];
        
        //update
    	$languageValueVo = new LanguageValueVo();
    	$languageValueVo->value = $value;
        $this->languageValueDao->updateByPrimaryKey($languageValueVo, $languageValueId);
        	
        return $this->setRender('success');
    }
    
    //OK
    public function delete(){
    	if(isset($_REQUEST['languageValueId'])){
    		$languageValueId = $_REQUEST['languageValueId'];
    		$languageValueInfo = $this->languageValueDao->selectByPrimaryKey($languageValueId);
    		$key = $languageValueInfo->key;
    		
    		//select all languageValue have same key
    		$languageValueVo = new LanguageValueVo();
    		$languageValueVo->key = $key;
    		$this->languageValueDao->deleteByFilter($languageValueVo);
    		
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('All language value have <br>key = %s <br>is deleted', $key));
    	}
    	return $this->setRender('success');
    }
}