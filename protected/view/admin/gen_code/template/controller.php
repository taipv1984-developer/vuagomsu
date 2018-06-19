<?php
class Admin{Table}Controller extends Controller {
	private ${tableVo}Dao;
    public ${tableVo}Model;
    private $pluginCode;
    
    function __construct(){
    	$this->{tableVo}Dao = new {Table}Dao();
    	$this->{tableVo}Model = new {Table}Model();
    	
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	${tableVo}Vo = new {Table}Vo();
    	${tableVo}Vo->name = $addVo->name;
    	${tableVo}Vos = $this->{tableVo}Dao->selectByFilter(${tableVo}Vo);
    	if(${tableVo}Vos){
			$validate["{tableVo}Model.name"] = e("{tableText} name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	${tableVo}Vo = new {Table}Vo();
    	${tableVo}Vo->name = $editVo->name;
    	${tableVo}Vos = $this->{tableVo}Dao->selectByFilter(${tableVo}Vo);
    	if(${tableVo}Vos){
    		${tableVo} = ${tableVo}Vos[0];
    		if(${tableVo}->{tableVo}Id != $editVo->{tableVo}Id) {
    			$validate["{tableVo}Model.name"] = e("{tableText} name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info(${tableVo}Vo){
    	//...
    }
    
    private function _filter(${tableVo}Vo){
    	//${tableVo}Vo->status = 'A';				//option
    	
    	if(!CTTHelper::isEmptyString($this->{tableVo}Model->{tableVo}Id)) {
    		${tableVo}Vo->{tableVo}Id = $this->{tableVo}Model->{tableVo}Id;
    	}
    	if(!CTTHelper::isEmptyString($this->{tableVo}Model->name)) {
    		${tableVo}Vo->name = array('like', "%{$this->{tableVo}Model->name}%");
    	}
    	if(!CTTHelper::isEmptyString($this->{tableVo}Model->status)) {
    		${tableVo}Vo->status = $this->{tableVo}Model->status;
    	}
    }
    
    //example fiter for {tableVo} add {tableVo}_detail table
    private function getFilter(){	
    	$filter = array();
    	//{tableVo}Id
    	if(!CTTHelper::isEmptyString($this->{tableVo}Model->{tableVo}Id)){
    		$filter['c.{tableVo}_id'] = $this->{tableVo}Model->{tableVo}Id;
    	}
    	//email			like
    	if(!CTTHelper::isEmptyString($this->{tableVo}Model->email)){
    		$filter['c.email'] = array('like', '%'.$this->{tableVo}Model->email.'%');
    	}
    	//phone		like
    	if(!CTTHelper::isEmptyString($_REQUEST['{tableVo}Model_phone'])){
    		$filter['cd.phone'] = array('like', '%'.$_REQUEST['{tableVo}Model_phone'].'%');
    	}
    	//address	like
    	if(!CTTHelper::isEmptyString($_REQUEST['{tableVo}Model_address'])){
    		$filter['cd.address'] = array('like', '%'.$_REQUEST['{tableVo}Model_address'].'%');
    	}
    	//status
    	if(!CTTHelper::isEmptyString($this->{tableVo}Model->status)){
    		$filter['c.status'] = $this->{tableVo}Model->status;
    	}
    	return $filter;
    }
    
	public function manage(){
        ${tableVo}Vo = new {Table}Vo();
        
        //filter
        $this->_filter(${tableVo}Vo);
        //or
        //$filter = $this->getFilter();
        
        //orderBy
        $orderBy = array('{table}_id' => 'DESC');
        
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
        $count = count($this->{tableVo}Dao->selectByFilter(${tableVo}Vo));
        //$count = count({Table}Ext::get{Table}List($filter));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        ${tableVo}List = $this->{tableVo}Dao->selectByFilter(${tableVo}Vo, $orderBy, $start, $recSize);
        //${tableVo}Vos = {Table}Ext::get{Table}List($filter, $orderBy, $start, $recSize);
        
        //add info
        foreach(${tableVo}List as $v){
        	$this->_add_info($v);
        }
        
        //set data
        $paging->items = ${tableVo}List;	
        
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
    			${tableVo}Vo = new {Table}Vo();
    			${tableVo}Vo->status = $_REQUEST['value'];
    			$this->{tableVo}Dao->updateByPrimaryKey(${tableVo}Vo, $_REQUEST['id']);
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
    			${tableVo}Vo = new {Table}Vo();
    			${tableVo}Vo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add(${tableVo}Vo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			${tableVo}Vo = new {Table}Vo();
    			${tableVo}Vo->name = trim($_REQUEST['name']);
    			${tableVo}Vo->{tableVo}Id = $_REQUEST['{tableVo}Id'];
    			$validate = $this->_validate_edit(${tableVo}Vo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist(${tableVo}Info){
    	if(!${tableVo}Info){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, '{tableText} not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission(${tableVo}Info){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	${tableVo}Vo = new {Table}Vo();
        	CTTHelper::copyProperties($this->{tableVo}Model, ${tableVo}Vo);
        	${tableVo}Vo->crtBy = Session::getAdminId();
        	${tableVo}Vo->crtDate = DateHelper::getDateTime();
        	
        	//add
        	$this->{tableVo}Dao->insert(${tableVo}Vo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "{tableText} add success");
            return $this->setRender('manage');
            //return $this->setRender('popup.close');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function edit(){
        ${tableVo}Id = $_REQUEST['{tableVo}Id'];
        ${tableVo}Info = $this->{tableVo}Dao->selectByPrimaryKey(${tableVo}Id);
        
        if(!($this->_check_exist(${tableVo}Info) & $this->_check_permission(${tableVo}Info))){
			return $this->setRender('manage');
		}
        
        //send data
        $this->setAttributes(array(
        	'{tableVo}Info' => ${tableVo}Info,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	${tableVo}Vo = new {Table}Vo();
        	CTTHelper::copyProperties($this->{tableVo}Model, ${tableVo}Vo);
        	${tableVo}Vo->modBy = Session::getAdminId();
        	${tableVo}Vo->modDate = DateHelper::getDateTime();
        	
        	//update
        	$this->{tableVo}Dao->updateByPrimaryKey(${tableVo}Vo, ${tableVo}Id);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "{tableText} update success");
            return $this->setRender('manage');
            //return $this->setRender('popup.close');
        }
        
        return $this->setRender('success');
        //return $this->setRender('popup');
    }
    
    public function view(){
    	${tableVo}Id = $_REQUEST['{tableVo}Id'];
    	${tableVo}Vo = $this->{tableVo}Dao->selectByPrimaryKey(${tableVo}Id);
    
    	//validate {tableVo}Id
    	if(!${tableVo}Vo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, "{tableText} not exist");
    		return $this->setRender('manage');
    	}
    
    	//add info
    	$this->_add_info(${tableVo}Vo);
    	
    	//send data
    	$this->setAttributes(array(
    		'{tableVo}' => ${tableVo}Vo,
    	));
    
    	//return $this->setRender('success');
    	return $this->setRender('popup');
    }
    
    public function delete() {
    	if(isset($_REQUEST['{tableVo}Id'])){
			${tableVo}Id = $_REQUEST['{tableVo}Id'];
			
			//check later
			//...
			
			$this->{tableVo}Dao->deleteByPrimaryKey(${tableVo}Id);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
}