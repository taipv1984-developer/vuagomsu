<?php
class AdminProductSearchController extends Controller {
	private $productSearchDao;
    public $productSearchModel;
    private $pluginCode;
    
    function __construct(){
    	$this->productSearchDao = new ProductSearchDao();
    	$this->productSearchModel = new ProductSearchModel();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the key should not duplicate in the table
    	$productSearchVo = new ProductSearchVo();
    	$productSearchVo->key = $addVo->key;
    	$productSearchVos = $this->productSearchDao->selectByFilter($productSearchVo);
    	if($productSearchVos){
			$validate["productSearchModel.key"] = e("Từ khóa đã tồn tại");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the key should not duplicate in the table
    	$productSearchVo = new ProductSearchVo();
    	$productSearchVo->key = $editVo->key;
    	$productSearchVos = $this->productSearchDao->selectByFilter($productSearchVo);
    	if($productSearchVos){
    		$productSearch = $productSearchVos[0];
    		if($productSearch->productSearchId != $editVo->productSearchId) {
    			$validate["productSearchModel.key"] = e("Từ khóa đã tồn tại");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($productSearchVo){
        $productSearchVo->modDate = date('d/m/Y h:i:m', strtotime($productSearchVo->modDate));
    }
    
    private function _filter($productSearchVo){
    	if(!CTTHelper::isEmptyString($this->productSearchModel->productSearchId)) {
    		$productSearchVo->productSearchId = $this->productSearchModel->productSearchId;
    	}
    	if(!CTTHelper::isEmptyString($this->productSearchModel->key)) {
    		$productSearchVo->key = array('like', "%{$this->productSearchModel->key}%");
    	}
        if(!CTTHelper::isEmptyString($this->productSearchModel->count)) {
            $productSearchVo->count = $this->productSearchModel->count;
        }
    	if(!CTTHelper::isEmptyString($this->productSearchModel->status)) {
    		$productSearchVo->status = $this->productSearchModel->status;
    	}
    }

	public function manage(){
        $productSearchVo = new ProductSearchVo();
        
        //filter
        $this->_filter($productSearchVo);

        //orderBy
        $orderBy = array('status' => 'ASC', 'order' => 'ASC', 'count' => 'DESC', 'product_search_id' => 'DESC');
        
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
        $count = count($this->productSearchDao->selectByFilter($productSearchVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $productSearchList = $this->productSearchDao->selectByFilter($productSearchVo, $orderBy, $start, $recSize);

        //add info
        foreach($productSearchList as $v){
        	$this->_add_info($v);
        }
        
        //set data
        $paging->items = $productSearchList;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function manage_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'change_status_ajax':
    			$productSearchVo = new ProductSearchVo();
    			$productSearchVo->status = $_REQUEST['value'];
    			$this->productSearchDao->updateByPrimaryKey($productSearchVo, $_REQUEST['id']);
    			break;
    		default:
    			break;
    	}
    	
    	return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$productSearchVo = new ProductSearchVo();
    			$productSearchVo->key = trim($_REQUEST['key']);
    			$validate = $this->_validate_add($productSearchVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$productSearchVo = new ProductSearchVo();
    			$productSearchVo->key = trim($_REQUEST['key']);
    			$productSearchVo->productSearchId = $_REQUEST['productSearchId'];
    			$validate = $this->_validate_edit($productSearchVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($productSearchInfo){
    	if(!$productSearchInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Từ khóa không tồn tại');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($productSearchInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$productSearchVo = new ProductSearchVo();
        	CTTHelper::copyProperties($this->productSearchModel, $productSearchVo);
        	$productSearchVo->crtDate = DateHelper::getDateTime();
            $productSearchVo->modDate = $productSearchVo->crtDate;
        	
        	//add
        	$this->productSearchDao->insert($productSearchVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Thêm từ khóa thành công");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $productSearchId = $_REQUEST['productSearchId'];
        $productSearchInfo = $this->productSearchDao->selectByPrimaryKey($productSearchId);
        
        if(!($this->_check_exist($productSearchInfo) & $this->_check_permission($productSearchInfo))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'productSearchInfo' => $productSearchInfo,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$productSearchVo = new ProductSearchVo();
        	CTTHelper::copyProperties($this->productSearchModel, $productSearchVo);
        	$productSearchVo->modDate = DateHelper::getDateTime();
        	
        	//update
        	$this->productSearchDao->updateByPrimaryKey($productSearchVo, $productSearchId);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Cập nhật từ khóa thành công");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    public function delete() {
    	if(isset($_REQUEST['productSearchId'])){
			$productSearchId = $_REQUEST['productSearchId'];
			
			$this->productSearchDao->deleteByPrimaryKey($productSearchId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Xóa từ khóa thành công');
    	}
    	return $this->setRender('success');
    }
}