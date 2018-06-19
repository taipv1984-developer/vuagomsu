<?php
class AdminProductTagController extends Controller {
	private $productTagDao;
    public $productTagModel;
    private $productTagMapDao;
    private $pluginCode;
    
    function __construct(){
    	$this->productTagDao = new ProductTagDao();
    	$this->productTagModel = new ProductTagModel();
    	$this->productTagMapDao = new ProductTagMapDao();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$productTagVo = new ProductTagVo();
    	$productTagVo->name = $addVo->name;
    	$productTagVos = $this->productTagDao->selectByFilter($productTagVo);
    	if($productTagVos){
			$validate["productTagModel.name"] = e("Product Tag name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$productTagVo = new ProductTagVo();
    	$productTagVo->name = $editVo->name;
    	$productTagVos = $this->productTagDao->selectByFilter($productTagVo);
    	if($productTagVos){
    		$productTag = $productTagVos[0];
    		if($productTag->productTagId != $editVo->productTagId) {
    			$validate["productTagModel.name"] = e("Product Tag name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($productTagVo){
    	$productTagId = $productTagVo->productTagId;
    	
    	//tagLink
    	$tagLink = URLHelper::getProductTagPage($productTagId);
    	$productTagVo->tagLink = "<a href='$tagLink' target='_blank'>{$productTagVo->name}</a>";
    	
    	//productCount
    	$productTagVo->productCount = ProductExt::getProductTagCount($productTagId);
    }
    
    private function _filter($productTagVo){
    	if(!CTTHelper::isEmptyString($this->productTagModel->productTagId)) {
    		$productTagVo->productTagId = $this->productTagModel->productTagId;
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['productTagModel_tagLink'])) {
    		$productTagVo->name = array('like', "%{$_REQUEST['productTagModel_tagLink']}%");
    	}
    }
    
	public function manage(){
        $productTagVo = new ProductTagVo();
        
        //filter
        $this->_filter($productTagVo);
        
        //orderBy
        $orderBy = array('product_tag_id' => 'DESC');
        
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
        $count = count($this->productTagDao->selectByFilter($productTagVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $productTagList = $this->productTagDao->selectByFilter($productTagVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($productTagList as $v){
        	$this->_add_info($v);
        }
        
        //set data
        $paging->items = $productTagList;	
        
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
    			$productTagVo = new ProductTagVo();
    			$productTagVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($productTagVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$productTagVo = new ProductTagVo();
    			$productTagVo->name = trim($_REQUEST['name']);
    			$productTagVo->productTagId = $_REQUEST['productTagId'];
    			$validate = $this->_validate_edit($productTagVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($productTagInfo){
    	if(!$productTagInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Product Tag not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($productTagInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$productTagVo = new ProductTagVo();
        	CTTHelper::copyProperties($this->productTagModel, $productTagVo);
        	
        	//add
        	$productTagId = $this->productTagDao->insert($productTagVo);
        	
        	//update router
        	$productTagInfo = $this->productTagDao->selectByPrimaryKey($productTagId);
        	RouterExt::updateRouterUrlProductTagPage($productTagInfo);
        	RouterExt::deleteRouterSame();

        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Product Tag add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $productTagId = $_REQUEST['productTagId'];
        $productTagInfo = $this->productTagDao->selectByPrimaryKey($productTagId);
        
        if(!($this->_check_exist($productTagInfo) & $this->_check_permission($productTagInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'productTagInfo' => $productTagInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$productTagVo = new ProductTagVo();
        	CTTHelper::copyProperties($this->productTagModel, $productTagVo);
        	
        	//update
        	$this->productTagDao->updateByPrimaryKey($productTagVo, $productTagId);
        	
        	//update router
        	$productTagInfo = $this->productTagDao->selectByPrimaryKey($productTagId);
        	RouterExt::updateRouterUrlProductTagPage($productTagInfo);
        	RouterExt::deleteRouterSame();
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Product Tag update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    //chu y delete het o bang map
    public function delete() {
    	if(isset($_REQUEST['productTagId'])){
			$productTagId = $_REQUEST['productTagId'];
			ProductExt::deleteProductTag($productTagId);
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
    
    //http://localhost/hamza.com.my/index.php?r=admin/product_tag/action&action=add_tag&productId=1&tagName=Audi
    private function action_tag_add(){
    	//$log
    	$log = array(
			'error' => false,
			'message' => '',
		);
    	
    	//get data
    	$productId = trim($_REQUEST['productId']);
    	$tagName = trim($_REQUEST['tagName']);
    	
    	//check tagName is exist in product_tag_map
    	$filter = array(
    		'product.product_id' => $productId,
    		'product_tag.name' => $tagName,
    		'product_tag_map.product_id' => array('!=', 0),
    	);
    	$productTagInfoCheck = ProductExt::getProductTagInfo($filter);
    	
		if(!$productTagInfoCheck){
			//check tagName is exist in product_tag
			$filter = array(
				'product_tag.name' => $tagName
			);
			$productTagInfoExist = ProductExt::getProductTagInfo($filter);
			if($productTagInfoExist){
				$productTagId = $productTagInfoExist->productTagId;
			}
			else{
				//add product_tag
				$productTagVo = new ProductTagVo();
				$productTagVo->name = $tagName;
				$productTagVo->description = '';
				$productTagId = $this->productTagDao->insert($productTagVo);
			}
			//add product_tag_map
			$productTagMapVo = new ProductTagMapVo();
			$productTagMapVo->productId = $productId;
			$productTagMapVo->productTagId = $productTagId;
			$productTagMapId = $this->productTagMapDao->insert($productTagMapVo);
			
			//get dom html
			$htmlTagSelected = "<li class=\"tag-remove\" title=\"Remove tag\" id=\"tag-remove-$productTagMapId\" data-productTagMapId=\"$productTagMapId\">
	<i class=\"fa fa-tag\"></i>
	$tagName
	<i class=\"fa fa-times-circle remove-icon\"></i>
</li>";		
			$htmlTagList = "<li class=\"tag-select\" title=\"Select tag\" data-producttagid=\"$productTagId\">
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
    	$productId = trim($_REQUEST['productId']);
    	$productTagId = trim($_REQUEST['productTagId']);
    	
    	//check productTagMap is exist
    	$productTagMapVo = new ProductTagMapVo();
    	$productTagMapVo->productId = $productId;
    	$productTagMapVo->productTagId = $productTagId;
    	$productTagMapInfo = $this->productTagMapDao->selectByFilter($productTagMapVo);
    	
    	if($productTagMapInfo){
    		$log = array(
    			'error' => true,
    			'message' => 'Tag is exist',
    		);
    	}
    	else{
    		$productTagMapVo = new ProductTagMapVo();
    		$productTagMapVo->productId = $productId;
    		$productTagMapVo->productTagId = $productTagId;
    		$productTagMapId = $this->productTagMapDao->insert($productTagMapVo);
    		
    		//get dom html
    		$tagName = $this->productTagDao->getValueByPrimaryKey('name', $productTagId);
    		$htmlTagSelected = "<li class=\"tag-remove\" title=\"Remove tag\" id=\"tag-remove-$productTagMapId\" data-productTagMapId=\"$productTagMapId\">
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
    	$productTagMapId = trim($_REQUEST['productTagMapId']);
    	 
    	//deleteProductTagMap
    	ProductExt::deleteProductTagMap($productTagMapId);
    	
    	//message
    	$log['message'] = e('Remove tag is success');
    
    	//view
    	echo json_encode($log);
    }
}