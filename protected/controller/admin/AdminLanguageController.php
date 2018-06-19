<?php
class AdminLanguageController extends Controller{
	private $languageDao;
	public $languageModel;
	
	function __construct(){
		$this->languageDao = new LanguageDao();
		$this->languageModel = new LanguageModel();
	}
    
    private function getCountry(){
        $countryDao = new CountryDao();
        $countryVos = $countryDao->selectAll();
        $arrayCountry = array();
        foreach($countryVos as $k => $v){
            $arrayCountry["$v->countryCode"] = $v->name;
       }
        return $arrayCountry;
   }
    
    private function _validate_add($addVo){
	   	$validate = array();
	   	 
	   	//the languageCode should not duplicate in the table
	   	$languageVo = new LanguageVo();
	   	$languageVo->languageCode = $addVo->languageCode;
	   	$languageVos = $this->languageDao->selectByFilter($languageVo);
	   	if($languageVos){
	   		$validate["languageModel.languageCode"] = e("Language code is exist");
	   	}
	   	 
	   	return $validate;
    }
   
    private function _validate_edit($editVo){
	   	$validate = array();
	   	 
	   	//the languageCode should not duplicate in the table
	   	$languageVo = new LanguageVo();
	   	$languageVo->languageCode = $editVo->languageCode;
	   	$languageVos = $this->languageDao->selectByFilter($languageVo);
	   	if($languageVos){
	   		$language = $languageVos[0];
	   		if($language->languageId != $editVo->languageId) {
	   			$validate["languageModel.languageCode"] = e("Language code is exist");
	   		}
	   	}
	   	
	   	//get $languageInfo
	   	$languageId = $_REQUEST['languageId'];
	   	$languageInfo = $this->languageDao->selectByPrimaryKey($languageId);
	   	
	   	//check default (min a language have default field = 1)
	   	$default = $_REQUEST['languageDefault'];
	   	if($languageInfo->default == 1 & $default == 0){
			$validate["languageModel.default"] = e("Default must select");
	   	}
	   	 
	   	//check if current is default then not change status = D
	   	$status = $_REQUEST['languageStatus'];
	   	if($languageInfo->default == 1 & $status != 'A'){
	   		$validate["languageModel.status"] = e("Status must active for default language");
	   	} 
	   	
	   	return $validate;
    }
   
    private function _add_info($languageVo){
    	//default
    	$languageVo->default = ($languageVo->default) ? 'Yes' : ''; 
    }
    
    private function _filter($languageVo){
	   	if(!CTTHelper::isEmptyString($this->languageModel->languageId)) {
	   		$languageVo->languageId = $this->languageModel->languageId;
	   	}
	   	if(!CTTHelper::isEmptyString($this->languageModel->name)) {
	   		$languageVo->name = array('like', "%{$this->languageModel->name}%");
	   	}
	   	if(!CTTHelper::isEmptyString($this->languageModel->languageCode)) {
	   		$languageVo->languageCode = array('like', "%{$this->languageModel->languageCode}%");
	   	}
	   	if(!CTTHelper::isEmptyString($this->languageModel->status)) {
	   		$languageVo->status = $this->languageModel->status;
	   	}
    }
   
	public function manage(){
        $languageVo = new LanguageVo();
        
        //filter
        $this->_filter($languageVo);
        
        //paging
        if(empty($_REQUEST['item_per_page'])) {
            $recSize = Registry::getSetting('item_per_page');
        } 
        else {
            $recSize = $_REQUEST['item_per_page'];
        }
        $start = 0;
        if(CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } 
        elseif(is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } 
        else {
            $page = 0;
        }
        $count = count($this->languageDao->selectByFilter($languageVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;
        
        //get data
        $languageVos = $this->languageDao->selectByFilter($languageVo, array(), $start, $recSize);
        
        //add info
        foreach ($languageVos as $v){
        	$this->_add_info($v);
        }
        
        //set data
        $paging->items = $languageVos;	
        
        //send data
        $this->setAttributes(array('pageView' => $paging));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$languageVo = new LanguageVo();
    			$languageVo->languageCode = $_REQUEST['languageCode'];
    			$validate = $this->_validate_add($languageVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$languageVo = new LanguageVo();
    			$languageVo->languageCode = $_REQUEST['languageCode'];
    			$languageVo->languageId = $_REQUEST['languageId'];
    			$validate = $this->_validate_edit($languageVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
	public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$languageVo = new LanguageVo();
        	CTTHelper::copyProperties($this->languageModel, $languageVo);
        	
    		//check default
    		$default = $this->languageModel->default;
    		if($default == 1){
    			LanguageExt::resetDefaultLanguage();
    			$languageVo->status = 'A';
    		}
    		
        	//add
        	$this->languageDao->insert($languageVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Language add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        	'arrayCountry' => $this->getCountry()
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $languageId = $_REQUEST['languageId'];
        $languageInfo = $this->languageDao->selectByPrimaryKey($languageId);
        
        //validate languageId
        if(!$languageInfo){
        	SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Language not exist");
        	return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        	'languageInfo' => $languageInfo,
        	'arrayCountry' => $this->getCountry()
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$languageVo = new LanguageVo();
        	CTTHelper::copyProperties($this->languageModel, $languageVo);
        	
        	//check default
        	$default = $this->languageModel->default;
        	if($default){
        		LanguageExt::resetDefaultLanguage();
        		$languageVo->status = 'A';
        	}
        	
        	//update
        	$this->languageDao->updateByPrimaryKey($languageVo, $languageId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Language update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    public function delete(){
    	$languageId = $_REQUEST['languageId'];
    	
    	//get info
    	$languageInfo = $this->languageDao->selectByPrimaryKey($languageId);
    	
    	//check default
    	if($languageInfo->default){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Not delete default language");
    		return $this->setRender('manage');
    	}

    	//check languageCode
    	$languageValue = LanguageExt::getLanguageValue($languageInfo->languageCode);
    	if($languageValue){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Not delete this language. <br>Pre delete language value of this");
    		return $this->setRender('manage');
    	}

    	//delete
    	$this->languageDao->deleteByPrimaryKey($languageInfo->languageId);
    	
    	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Language delete success");
    	return $this->setRender('success');
   }
}