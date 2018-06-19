<?php
class AdminNewsTagController extends Controller {
	private $newsTagDao;
    public $newsTagModel;
    private $newsTagMapDao;
    private $pluginCode;
    
    function __construct(){
    	$this->newsTagDao = new NewsTagDao();
    	$this->newsTagModel = new NewsTagModel();
    	$this->newsTagMapDao = new NewsTagMapDao();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$newsTagVo = new NewsTagVo();
    	$newsTagVo->name = $addVo->name;
    	$newsTagVos = $this->newsTagDao->selectByFilter($newsTagVo);
    	if($newsTagVos){
			$validate["newsTagModel.name"] = e("News Tag name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$newsTagVo = new NewsTagVo();
    	$newsTagVo->name = $editVo->name;
    	$newsTagVos = $this->newsTagDao->selectByFilter($newsTagVo);
    	if($newsTagVos){
    		$newsTag = $newsTagVos[0];
    		if($newsTag->newsTagId != $editVo->newsTagId) {
    			$validate["newsTagModel.name"] = e("News Tag name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($newsTagVo){
    	$newsTagId = $newsTagVo->newsTagId;
    	
    	//tagLink
    	$tagLink = URLHelper::getNewsTagPage($newsTagId);
    	$newsTagVo->tagLink = "<a href='$tagLink' target='_blank'>{$newsTagVo->name}</a>";
    	
    	//newsCount
    	$newsTagVo->newsCount = NewsExt::getNewsTagCount($newsTagId);
    }
    
    private function _filter($newsTagVo){
    	if(!CTTHelper::isEmptyString($this->newsTagModel->newsTagId)) {
    		$newsTagVo->newsTagId = $this->newsTagModel->newsTagId;
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['newsTagModel_tagLink'])) {
    		$newsTagVo->name = array('like', "%{$_REQUEST['newsTagModel_tagLink']}%");
    	}
    }
    
	public function manage(){
        $newsTagVo = new NewsTagVo();
        
        //filter
        $this->_filter($newsTagVo);
        
        //orderBy
        $orderBy = array('news_tag_id' => 'DESC');
        
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
        $count = count($this->newsTagDao->selectByFilter($newsTagVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $newsTagList = $this->newsTagDao->selectByFilter($newsTagVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($newsTagList as $v){
        	$this->_add_info($v);
        }
        
        //set data
        $paging->items = $newsTagList;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$newsTagVo = new NewsTagVo();
    			$newsTagVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($newsTagVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$newsTagVo = new NewsTagVo();
    			$newsTagVo->name = trim($_REQUEST['name']);
    			$newsTagVo->newsTagId = $_REQUEST['newsTagId'];
    			$validate = $this->_validate_edit($newsTagVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($newsTagInfo){
    	if(!$newsTagInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'News Tag not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($newsTagInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$newsTagVo = new NewsTagVo();
        	CTTHelper::copyProperties($this->newsTagModel, $newsTagVo);
        	
        	//add
        	$newsTagId = $this->newsTagDao->insert($newsTagVo);
        	
        	//update router
        	$newsTagInfo = $this->newsTagDao->selectByPrimaryKey($newsTagId);
        	RouterExt::updateRouterUrlNewsTagPage($newsTagInfo);
        	RouterExt::deleteRouterSame();
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "News Tag add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $newsTagId = $_REQUEST['newsTagId'];
        $newsTagInfo = $this->newsTagDao->selectByPrimaryKey($newsTagId);
        
        if(!($this->_check_exist($newsTagInfo) & $this->_check_permission($newsTagInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'newsTagInfo' => $newsTagInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$newsTagVo = new NewsTagVo();
        	CTTHelper::copyProperties($this->newsTagModel, $newsTagVo);
        	
        	//update
        	$this->newsTagDao->updateByPrimaryKey($newsTagVo, $newsTagId);
        	
        	//update router
        	$newsTagInfo = $this->newsTagDao->selectByPrimaryKey($newsTagId);
        	RouterExt::updateRouterUrlNewsTagPage($newsTagInfo);
        	RouterExt::deleteRouterSame();
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "News Tag update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    //chu y delete het o bang map
    public function delete() {
    	if(isset($_REQUEST['newsTagId'])){
			$newsTagId = $_REQUEST['newsTagId'];
			NewsExt::deleteNewsTag($newsTagId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
    
    /*******************
     * Action AJAX
     ******************/
    public function action(){
    	//get data
    	$action = $_REQUEST['action'];
    	
    	switch ($action){
    		case 'tag_add':
    			$this->action_tag_add();
    			break;
    		case 'tag_select':
    			$this->action_tag_select();
    			break;
    		case 'tag_remove':
    			$this->action_tag_remove();
    			break;
    	}
    	
    	return $this->setRender('success');
    }
    
    //http://localhost/hamza.com.my/index.php?r=admin/news_tag/action&action=add_tag&newsId=1&tagName=Audi
    private function action_tag_add(){
    	//$log
    	$log = array(
			'error' => false,
			'message' => '',
		);
    	
    	//get data
    	$newsId = trim($_REQUEST['newsId']);
    	$tagName = trim($_REQUEST['tagName']);
    	
    	//check tagName is exist in news_tag_map
    	$filter = array(
    		'news.news_id' => $newsId,
    		'news_tag.name' => $tagName,
    		'news_tag_map.news_id' => array('!=', 0),
    	);
    	$newsTagInfoCheck = NewsExt::getNewsTagInfo($filter);
    	
		if(!$newsTagInfoCheck){
			//check tagName is exist in news_tag
			$filter = array(
				'news_tag.name' => $tagName
			);
			$newsTagInfoExist = NewsExt::getNewsTagInfo($filter);
			if($newsTagInfoExist){
				$newsTagId = $newsTagInfoExist->newsTagId;
			}
			else{
				//add news_tag
				$newsTagVo = new NewsTagVo();
				$newsTagVo->name = $tagName;
				$newsTagVo->description = '';
				$newsTagId = $this->newsTagDao->insert($newsTagVo);
			}
			//add news_tag_map
			$newsTagMapVo = new NewsTagMapVo();
			$newsTagMapVo->newsId = $newsId;
			$newsTagMapVo->newsTagId = $newsTagId;
			$newsTagMapId = $this->newsTagMapDao->insert($newsTagMapVo);
			
			//get dom html
			$htmlTagSelected = "<li class=\"tag-remove\" title=\"Remove tag\" id=\"tag-remove-$newsTagMapId\" data-newsTagMapId=\"$newsTagMapId\">
	<i class=\"fa fa-tag\"></i>
	$tagName
	<i class=\"fa fa-times-circle remove-icon\"></i>
</li>";		
			$htmlTagList = "<li class=\"tag-select\" title=\"Select tag\" data-newstagid=\"$newsTagId\">
	$tagName
</li>";
			
			$log = array(
				'error' => false,
				'message' => e('Add tag is success'),
				'htmlTagSelected' => $htmlTagSelected,
				'htmlTagList' => $htmlTagList
			);
		}
		else{
			$log = array(
				'error' => true,
				'message' => e('Tag is exist'),
			);
		}
		
		echo json_encode($log);
    }
    
    private function action_tag_select(){
    	//$log
    	$log = array(
    		'error' => false,
    		'message' => '',
    	);
    	 
    	//get data
    	$newsId = trim($_REQUEST['newsId']);
    	$newsTagId = trim($_REQUEST['newsTagId']);
    	
    	//check newsTagMap is exist
    	$newsTagMapVo = new NewsTagMapVo();
    	$newsTagMapVo->newsId = $newsId;
    	$newsTagMapVo->newsTagId = $newsTagId;
    	$newsTagMapInfo = $this->newsTagMapDao->selectByFilter($newsTagMapVo);
    	
    	if($newsTagMapInfo){
    		$log = array(
    			'error' => true,
    			'message' => 'Tag is exist',
    		);
    	}
    	else{
    		$newsTagMapVo = new NewsTagMapVo();
    		$newsTagMapVo->newsId = $newsId;
    		$newsTagMapVo->newsTagId = $newsTagId;
    		$newsTagMapId = $this->newsTagMapDao->insert($newsTagMapVo);
    		
    		//get dom html
    		$tagName = $this->newsTagDao->getValueByPrimaryKey('name', $newsTagId);
    		$htmlTagSelected = "<li class=\"tag-remove\" title=\"Remove tag\" id=\"tag-remove-$newsTagMapId\" data-newsTagMapId=\"$newsTagMapId\">
	<i class=\"fa fa-tag\"></i>
	$tagName					
	<i class=\"fa fa-times-circle remove-icon\"></i>
</li>";
    		
    		$log = array(
    			'error' => false,
    			'message' => 'Tag is selected',
    			'htmlTagSelected' => $htmlTagSelected
    		);
    	}
    
    	echo json_encode($log);
    }
    
    private function action_tag_remove(){
    	//$log
    	$log = array(
    		'error' => false,
    		'message' => '',
    	);
    	 
    	//get data
    	$newsTagMapId = trim($_REQUEST['newsTagMapId']);
    	 
    	//deleteNewsTagMap
    	NewsExt::deleteNewsTagMap($newsTagMapId);
    	
    	//message
    	$log['message'] = e('Remove tag is success');
    
    	//view
    	echo json_encode($log);
    }
}