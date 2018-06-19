<?php
class AdminRouterController extends Controller {
	private $routerDao;
    public $routerModel;
    private $routerUrlDao;
    
    function __construct(){
    	$this->routerDao = new RouterDao();
    	$this->routerModel = new RouterModel();
    	
    	$this->routerUrlDao = new RouterUrlDao();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the layoutId should not duplicate in the table 
    	$routerVo = new RouterVo();
    	$routerVo->layoutId = $addVo->layoutId;
    	$routerVos = $this->routerDao->selectByFilter($routerVo);
    	if($routerVos){
			$validate["routerModel.layoutId"] = e("Router is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the layoutId should not duplicate in the table 
    	$routerVo = new RouterVo();
    	$routerVo->layoutId = $editVo->layoutId;
    	$routerVos = $this->routerDao->selectByFilter($routerVo);
    	if($routerVos){
    		$router = $routerVos[0];
    		if($router->routerId != $editVo->routerId) {
    			$validate["routerModel.layoutId"] = e("Router is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($routerVo){
    	$routerId = $routerVo->routerId;
    	$routerInfo = RouterExt::getRouteInfo(array('r.router_id' => $routerId));
    	$routerVo->layoutName = $routerInfo->layoutName;
    	$linkDemo = RouterExt::getDemoLink($routerId);
    	if($linkDemo){
    		$linkDemo = Registry::getSetting('base_url').'/'.$linkDemo;
    		$routerVo->layoutLink = "<a href='$linkDemo' title='View detail' target='blank'>{$routerInfo->layoutName}</a>";
    	}
    	else{
    		$routerVo->layoutLink = $routerInfo->layoutName;
    	}
    	
    	$routerVo->count = RouterExt::getRouterUrlCount($routerId);
    	$routerVo->count = ($routerVo->count) ? $routerVo->count : '';
    }
    
    private function getFilter(){
    	$filter = array();
    	//layout status
    	$filter['l.status'] = 'A';
    	
    	if(!CTTHelper::isEmptyString($this->routerModel->routerId)) {
    		$filter['r.router_id'] = $this->routerModel->routerId;
    	}
    	if(!CTTHelper::isEmptyString($_REQUEST['routerModel_layoutLink'])) {
    		$filter['r.layout_id'] = $_REQUEST['routerModel_layoutLink'];
    	}
    	if(!CTTHelper::isEmptyString($this->routerModel->aliasBy)) {
    		$filter['r.alias_by'] = array('like', "%{$this->routerModel->aliasBy}%");
    	}
    	if(!CTTHelper::isEmptyString($this->routerModel->alias)) {
    		$filter['r.alias'] = array('like', "%{$this->routerModel->alias}%");
    	}
    	if(!CTTHelper::isEmptyString($this->routerModel->prefix)) {
    		$filter['r.prefix'] = array('like', "%{$this->routerModel->prefix}%");
    	}
    	if(!CTTHelper::isEmptyString($this->routerModel->suffix)) {
    		$filter['r.suffix'] = array('like', "%{$this->routerModel->suffix}%");
    	}
    	
    	return $filter;
    }
    
	public function manage(){
        $routerVo = new RouterVo();
        
        //filter
        $filter = $this->getFilter();
        $orderBy = array('router_id' => 'ASC');
        
        //paging
        if(empty($_REQUEST['item_per_page'])) {
            $recSize = Registry::getSetting('item_per_page');
        } 
        else {
            $recSize = $_REQUEST['item_per_page'];
        }
        $recSize = 999; //show all
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
        $count = count(RouterExt::getRouterList($filter));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $routerVos = RouterExt::getRouterList($filter, $orderBy, $start, $recSize);
        
        //add info
        foreach($routerVos as $k => $routerVo){
        	$this->_add_info($routerVo);
        }
        
        //set data
        $paging->items = $routerVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging,
        	'layoutList' => LayoutExt::getLayoutList(),
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$routerVo = new RouterVo();
    			$routerVo->layoutId = trim($_REQUEST['layoutId']);
    			$validate = $this->_validate_add($routerVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$routerVo = new RouterVo();
    			$routerVo->layoutId = trim($_REQUEST['layoutId']);
    			$routerVo->routerId = $_REQUEST['routerId'];
    			$validate = $this->_validate_edit($routerVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($routerInfo){
    	if(!$routerInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Router not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($routerInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$routerVo = new RouterVo();
        	CTTHelper::copyProperties($this->routerModel, $routerVo);
        	
        	//add
        	$this->routerDao->insert($routerVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Router add success");
            return $this->setRender('manage');
        }
        
        //add info
        $routerInfo = new RouterVo();
        $routerInfo->aliasList = array('alias' => 'Alias');
        
        //send data
        $this->setAttributes(array(
        	'routerInfo' => $routerInfo,
        	'layoutList' => LayoutExt::getLayoutList(),
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $routerId = $_REQUEST['routerId'];
        $routerInfo = RouterExt::getRouteInfo(array('r.router_id' => $routerId));
        
        if(!($this->_check_exist($routerInfo) & $this->_check_permission($routerInfo))){
			return $this->setRender('manage');
		}
        
		//add info
		$routerInfo->aliasList = json_decode($routerInfo->aliasList, true);

        //send data
        $this->setAttributes(array(
        	'routerInfo' => $routerInfo,
        	'layoutList' => LayoutExt::getLayoutList(),
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$routerVo = new RouterVo();
        	CTTHelper::copyProperties($this->routerModel, $routerVo);
        	
        	//update routerAction function
        	$this->routerDao->updateByPrimaryKey($routerVo, $routerId);
        	
        	//run routerAction function
        	$routerInfo = RouterExt::getRouteInfo(array('r.router_id' => $routerId));
        	$this->updateRouterUrl($routerInfo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Router update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    /**
     * add routerUrl or edit redirectTo field in routerUrl table by $aliasBy
     * run $callback function of $routerInfo
     * 
     * @param object $routerInfo
     */
    private function updateRouterUrl($routerInfo){
    	$aliasBy = $routerInfo->aliasBy;
    	if($aliasBy == 'alias' || $aliasBy == ''){
    		$alias = $routerInfo->prefix .$routerInfo->alias. $routerInfo->suffix;
    		$routerUrlVo = new RouterUrlVo();
    		$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
    		//check $routerUrlVo before insert
    		$routerUrlList = $this->routerUrlDao->selectByFilter($routerUrlVo);
    		if($routerUrlList){
    			//update redirectTo
    			foreach ($routerUrlList as $v){
    				$routerUrlVo = new RouterUrlVo();
    				$routerUrlVo->redirectTo = $alias;
    				$this->routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
    			}
    		}
    		
    		//insert routerUrl
    		$routerUrlVo = new RouterUrlVo();
    		$routerUrlVo->routerId = $routerInfo->routerId;
    		$routerUrlVo->alias = $alias;
    		$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
    		$routerUrlVo->redirectTo = '';
    		$this->routerUrlDao->insert($routerUrlVo);
    		
    		//delete all routerUrl have $alias=redirectTo
    		RouterExt::deleteRouterSame();
    	}
    	else{
    		//run $callback function
    		$callback = $routerInfo->callback;
    		if($callback != ''){
    			RouterExt::$callback($routerInfo);
    		}
    	}
    }
}