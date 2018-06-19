<?php
class AdminCurrencyController extends Controller{
    private $currencyDao;
    public $currencyModel;
    
	function __construct(){
		$this->currencyDao = new CurrencyDao();
		$this->currencyModel = new CurrencyModel();
	}
	
	private function _validate_add($addVo){
		$validate = array();
		 
		//the currencyCode should not duplicate in the table
		$currencyVo = new CurrencyVo();
		$currencyVo->currencyCode = $addVo->currencyCode;
		$currencyVos = $this->currencyDao->selectByFilter($currencyVo);
		if($currencyVos){
			$validate["currencyModel.currencyCode"] = e("Currency currencyCode is exist");
		}
		 
		return $validate;
	}
	
	private function _validate_edit($editVo){
		$validate = array();
		 
		//the currencyCode should not duplicate in the table
		$currencyVo = new CurrencyVo();
		$currencyVo->currencyCode = $editVo->currencyCode;
		$currencyVos = $this->currencyDao->selectByFilter($currencyVo);
		if($currencyVos){
			$currency = $currencyVos[0];
			if($currency->currencyId != $editVo->currencyId) {
				$validate["currencyModel.currencyCode"] = e("Currency currencyCode is exist");
			}
		}
		
		$currencyId = $_REQUEST['currencyId'];
		$currencyInfo = $this->currencyDao->selectByPrimaryKey($currencyId);
		
		//check default (min a language have default field = 1)
	   	$isPrimary = $_REQUEST['isPrimary'];
	   	if($currencyInfo->isPrimary == 'Y' & $isPrimary == 'N'){
			$validate["currencyModel.isPrimary"] = e("Currency default must select");
	   	}
		 
	   	//check if current is default then not change status = D
	   	$status = $_REQUEST['currencyStatus'];
	   	if($currencyInfo->isPrimary == 'Y' & $status != 'A'){
	   		$validate["currencyModel.status"] = e("Status must active for default currency");
	   	}
	   	
		return $validate;
	}
	
	private function _add_info($currencyVo){
		//...
	}
	
	private function _filter($currencyVo){
		if(!CTTHelper::isEmptyString($this->currencyModel->currencyId)) {
			$currencyVo->currencyId = $this->currencyModel->currencyId;
		}
		if(!CTTHelper::isEmptyString($this->currencyModel->currencyCode)) {
			$currencyVo->currencyCode = array('like', "%{$this->currencyModel->currencyCode}%");
		}
		if(!CTTHelper::isEmptyString($this->currencyModel->description)) {
			$currencyVo->description = array('like', "%{$this->currencyModel->description}%");
		}
		if(!CTTHelper::isEmptyString($this->currencyModel->symbol)) {
			$currencyVo->symbol = $this->currencyModel->symbol;
		}
		if(!CTTHelper::isEmptyString($this->currencyModel->status)) {
			$currencyVo->status = $this->currencyModel->status;
		}
	}
	
	public function manage(){
		$currencyVo = new CurrencyVo();
	
		//filter
		$this->_filter($currencyVo);
	
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
		$count = count($this->currencyDao->selectByFilter($currencyVo));
		$paging = new Paging($page, 5, $recSize, $count);
		$start =($paging->currentPage - 1) * $recSize;
	
		//get data
		$currencyVos = $this->currencyDao->selectByFilter($currencyVo, array(), $start, $recSize);
	
		//add info
		foreach($currencyVos as $currencyVo){
			$this->_add_info($currencyVo);
		}
	
		//set data
		$paging->items = $currencyVos;
	
		//send data
		$this->setAttributes(array('pageView' => $paging));
	
		//call view
		return $this->setRender('success');
	}
	
	public function validate_ajax(){
		$action = $_REQUEST['action'];
		switch($action){
			case 'add':
				$currencyVo = new CurrencyVo();
				$currencyVo->currencyCode = $_REQUEST['currencyCode'];
				$validate = $this->_validate_add($currencyVo);
				if(!empty($validate)){
					echo json_encode($validate);
				}
				break;
			case 'edit':
				$currencyVo = new CurrencyVo();
				$currencyVo->currencyCode = $_REQUEST['currencyCode'];
				$currencyVo->currencyId = $_REQUEST['currencyId'];
				$validate = $this->_validate_edit($currencyVo);
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
			$currencyVo = new CurrencyVo();
			CTTHelper::copyProperties($this->currencyModel, $currencyVo);
			
			//check isPrimary
			$isPrimary = $this->currencyModel->isPrimary;
			if($isPrimary == 'Y'){
				CurrencyExt::resetDefaultCurrency();
				$currencyVo->status = 'A';
			}
			
			//add
			$this->currencyDao->insert($currencyVo);
			 
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Currency add success");
			return $this->setRender('manage');
		}
	
		//send data
		$this->setAttributes(array(
			'isAction' => true
		));
	
		return $this->setRender('success');
	}
	
	public function edit(){
		$currencyId = $_REQUEST['currencyId'];
		$currencyInfo = $this->currencyDao->selectByPrimaryKey($currencyId);
	
		//validate currencyId
		if(!$currencyInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Currency not exist");
			return $this->setRender('manage');
		}
	
		//add info
		$this->_add_info($currencyInfo);
	
		//send data
		$this->setAttributes(array(
			'currencyInfo' => $currencyInfo,
			'isAction' => true
		));
	
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$currencyVo = new CurrencyVo();
			CTTHelper::copyProperties($this->currencyModel, $currencyVo);
			 
			//check isPrimary
			$isPrimary = $this->currencyModel->isPrimary;
			if($isPrimary == 'Y'){
				CurrencyExt::resetDefaultCurrency();
				$currencyVo->status = 'A';
			}
			
			//update
			$this->currencyDao->updateByPrimaryKey($currencyVo, $currencyId);
			 
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Currency update success");
			return $this->setRender('manage');
		}
	
		return $this->setRender('success');
	}
    
    public function delete() {
	   	if(isset($_REQUEST['currencyId'])){
	   		$currencyId = $_REQUEST['currencyId'];
	   			
	   		//check isPrimary
	   		$currencyInfo = $this->currencyDao->selectByPrimaryKey($currencyId);
			if($currencyInfo->isPrimary == 'Y'){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Not delete with default currency");
				return $this->setRender('manage');
			}
			
			$this->currencyDao->deleteByPrimaryKey($currencyId);
	   		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
	   	}
	   	return $this->setRender('success');
    }
}