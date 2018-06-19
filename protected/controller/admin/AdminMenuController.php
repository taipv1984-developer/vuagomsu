<?php
class AdminMenuController extends Controller {
	private $menuDao;
    public $menuModel;
    private $menuItemDao;
    
    function __construct(){
    	$this->menuDao = new MenuDao();
    	$this->menuModel = new MenuModel();
    	$this->menuItemDao = new MenuItemDao();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	 
    	//the name should not duplicate in the table
    	$menuVo = new MenuVo();
    	$menuVo->name = $addVo->name;
    	$menuVos = $this->menuDao->selectByFilter($menuVo);
    	if($menuVos){
    		$validate["menuModel.name"] = e("Menu name is exist");
    	}
    	 
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	 
    	//the name should not duplicate in the table
    	$menuVo = new MenuVo();
    	$menuVo->name = $editVo->name;
    	$menuVos = $this->menuDao->selectByFilter($menuVo);
    	if($menuVos){
    		$menu = $menuVos[0];
    		if($menu->menuId != $editVo->menuId) {
    			$validate["menuModel.name"] = e("Menu name is exist");
    		}
    	}
    	 
    	return $validate;
    }
    
	public function manage(){
		//check menuId
		if(Session::getSession('menuId')){	//affter add menu then rederect to new menu
			$menuId = Session::getSession('menuId');
			Session::deleteSession('menuId');
			header("location: index.php?r=admin/menu/manage&menuId=$menuId");
			return;
		}
		
		if(!isset($_REQUEST['menuId'])){
			//get menuId first is default
			$menuList = MenuExt::getMenuList();
			if(count($menuList) > 0){
				$menuId = $menuList[0]->menuId;
				header("location: index.php?r=admin/menu/manage&menuId=$menuId");
				return;
			}
		}
		
		//get data
		$menuId = (isset($_REQUEST['menuId'])) ? $_REQUEST['menuId'] : 0;
        
        $this->setAttributes (array (
        	'menuId' => $menuId,
        	'menuItem' => MenuExt::getMenuItem($menuId),
        	'menuArray' => MenuExt::getMenuArray(),
        	//'categoryList' => CategoryExt::getCategoryList(),
        	//'staticPageList' => StaticPageExt::getStaticPageList()
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$menuVo = new MenuVo();
    			$menuVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($menuVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$menuVo = new MenuVo();
    			$menuVo->name = trim($_REQUEST['name']);
    			$menuVo->menuId = $_REQUEST['menuId'];
    			$validate = $this->_validate_edit($menuVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    
    	return $this->setRender('success');
    }
    
    private function _check_exist($menuInfo){
    	if(!$menuInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Menu not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($menuInfo){
    	return true;
    }
    
    public function add(){
    	if($_SERVER['REQUEST_METHOD'] == 'POST') {
    		//set data
    		$menuVo = new MenuVo();
    		CTTHelper::copyProperties($this->menuModel, $menuVo);
    		 
    		//add
    		$menuId = $this->menuDao->insert($menuVo);
    		 
    		//set session then then edit this menu next time
    		Session::setSession('menuId', $menuId);
    		
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Menu add success");
    		return $this->setRender('popup.close');
    	}
    
    	//send data
    	$this->setAttributes(array());
    
    	return $this->setRender('popup');
    }
    
    public function edit(){
    	$menuId = $_REQUEST['menuId'];
    	$menuInfo = $this->menuDao->selectByPrimaryKey($menuId);
    
    	if(!($this->_check_exist($menuInfo) & $this->_check_permission($menuInfo))){
    		return $this->setRender('manage');
    	}
    
    	//send data
    	$this->setAttributes(array(
    		'menuInfo' => $menuInfo,
    	));
    
    	if($_SERVER['REQUEST_METHOD'] == 'POST') {
    		//set data
    		$menuVo = new MenuVo();
    		CTTHelper::copyProperties($this->menuModel, $menuVo);
    		 
    		//update
    		$this->menuDao->updateByPrimaryKey($menuVo, $menuId);
    		
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Menu update success");
    		return $this->setRender('popup.close');
    	}
    
    	return $this->setRender('popup');
    }
    
    public function action(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add_custom_link':		
    			$this->action_add_custom_link();
    			break;
    		case 'add_page_link':
    			$this->action_add_page_link();
    			break;
    		case 'add_category_link':		
    			$this->action_add_category_link();
    			break;
    		case 'edit_menu_item':		
    			$this->action_edit_menu_item();
    			break;
    		case 'save_menu_item':		
    			$this->action_save_menu_item();
    			break;
    		case 'delete_menu_item':	
    			$this->action_delete_menu_item();
    			break;
    		case 'save_menu':		
    			$this->action_save_menu();
    			break;
    		case 'delete_menu':		
    			$this->action_delete_menu();
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function action_add_custom_link(){
    	//get data
    	$menuId = $_REQUEST['menuId'];
    	$title = $_REQUEST['title'];
    	$link = $_REQUEST['link'];
        $cls = $_REQUEST['cls'];
        $type = $_REQUEST['type'];

    	//insert new menu_item
    	$menuItemVo = new MenuItemVo();
    	$menuItemVo->menuId = $menuId;
    	$menuItemVo->title = $title;
    	$menuItemVo->link = $link;
    	$menuItemVo->class = $cls;
    	$menuItemVo->icon = '';
    	$menuItemVo->level = 0;
    	$menuItemVo->parentId = 0;
    	$menuItemVo->order = 999;
    	$menuItemVo->type = $type;
    	$menuItemVo->tableId = 0;
    	$menuItemVo->params = json_encode(array());
    	$menuItemId = $this->menuItemDao->insert($menuItemVo);
    	$v = array(
    		'id' => $menuItemId,
    		'title' => $menuItemVo->title,
    		'link' => $menuItemVo->link,
    		'type' => $menuItemVo->type,
    		'class' => 'new_item red',	//custom
    		'isEnd' => true,			//custom
    	);
    	include PROTECTED_PATH."view/admin/menu/menu_item.php";
    }
    
    private function action_add_page_link(){
    	//get data
    	$menuId = $_REQUEST['menuId'];
    	$pageId = $_REQUEST['pageId'];
    	$title = $_REQUEST['title'];
    
    	//insert new menu
    	$menuItemVo = new MenuItemVo();
    	$menuItemVo->menuId = $menuId;
    	$menuItemVo->title = $title;
    	$menuItemVo->link = URLHelper::getStaticPageUrl($pageId);
    	$menuItemVo->icon = '';
    	$menuItemVo->level = 0;
    	$menuItemVo->parentId = 0;
    	$menuItemVo->order = 999;
    	$menuItemVo->type = 'page_link';
    	$menuItemVo->tableId = $pageId;
    	$menuItemVo->params = json_encode(array());
    	$menuItemId = $this->menuItemDao->insert($menuItemVo);
    	$v = array(
    		'id' => $menuItemId,
    		'title' => $menuItemVo->title,
    		'link' => $menuItemVo->link,
    		'type' => $menuItemVo->type,
    		'class' => 'new_item red',	//custom
    		'isEnd' => true,			//custom
    	);
    	include PROTECTED_PATH."view/admin/menu/menu_item.php";
    }
    
    private function action_add_category_link(){
    	//get data
    	$menuId = $_REQUEST['menuId'];
    	$categoryId = $_REQUEST['categoryId'];
    	$categoryTitle = $_REQUEST['categoryTitle'];
    	 
    	//insert new menu
    	$menuItemVo = new MenuItemVo();
    	$menuItemVo->menuId = $menuId;
    	$menuItemVo->title = $categoryTitle;
    	$menuItemVo->link = URLHelper::getProductListPage($categoryId);
    	$menuItemVo->icon = '';
    	$menuItemVo->level = 0;
    	$menuItemVo->parentId = 0;
    	$menuItemVo->order = 999;
    	$menuItemVo->type = 'category_link';
    	$menuItemVo->tableId = $categoryId;
    	$menuItemVo->params = json_encode(array());
    	$menuItemId = $this->menuItemDao->insert($menuItemVo);
    	$v = array(
    		'id' => $menuItemId,
    		'title' => $menuItemVo->title,
    		'link' => $menuItemVo->link,
    		'type' => $menuItemVo->type,
    		'class' => 'new_item red',	//custom
    		'isEnd' => true,			//custom
    	);
    	include PROTECTED_PATH."view/admin/menu/menu_item.php";
    }
    
    private function action_edit_menu_item(){
    	$menuItemId = $_REQUEST['menuItemId'];
    	$menuItemInfo = $this->menuItemDao->selectByPrimaryKey($menuItemId);
    	$type = $menuItemInfo->type;
    	$params = json_decode($menuItemInfo->params);
    	switch ($type){
			case 'page_link':
				//get data
    			$params = json_decode($menuItemInfo->params);
    			//form
    			$settingForm = array(
	    			'menu_item_id'	=> array('type' => 'hidden'),
	    			'type'			=> array('type' => 'hidden'),
	    			'static_page_id'	=> array('type' => 'select', 'required' => true, 'label' => 'Page',
	    				'options' => StaticPageExt::getStaticPageList(), 'value' => $menuItemInfo->tableId,
	    				'options_map' => array('staticPageId', 'title')),
    				'class'		=> array(),
    			);
    			$settingValue = $menuItemInfo;
    			$settingAll = array();
    			TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
				break;
    		case 'category_link':
    			//get data
    			$params = json_decode($menuItemInfo->params);
    			//form
    			$settingForm = array(
	    			'menu_item_id'	=> array('type' => 'hidden'),
	    			'type'			=> array('type' => 'hidden'),
	    			'category_id'	=> array('type' => 'select_category', 'required' => true, 'label' => 'Category',
	    				'options' => CategoryExt::getCategoryList(), 'value' => $menuItemInfo->tableId),
    				'class'		=> array(),

    				//params
    				'create_submenu' => array('type' => 'checkbox', 'label' => false,
    					'value' => '1', 'title' => 'Create submenu containing links to posts in this category.',
    					'checked' => ($params->create_submenu) ? true : false),
	    			'number_of_category' => array('type' => 'number', 'rows' => 2, 'row_class' => 'width_50',
	    				'value' => ($params->number_of_category) ? $params->number_of_category : 0, 'title' => ''),
	    			'skip_category' => array('rows' => 2, 'row_class' => 'width_50',
	    				'value' => ($params->skip_category) ? $params->skip_category : 0, 'title' => ''),
	    			'order_by' => array('type' => 'select', 'rows' => 2, 'row_class' => 'width_50',
	    				'value' => $params->order_by, 'title' => '', 'options' => ArrayHelper::getOrderByCategory()),
	    			'order_direction' => array('type' => 'select', 'rows' => 2, 'row_class' => 'width_50',
	    				'value' => $params->order_direction, 'title' => '', 'options' => ArrayHelper::getOrderDirection('DESC')),
    			);
    			$settingValue = $menuItemInfo;
    			$settingAll = array();
    			TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
    			break;
    		default:
    		    //custom_link,
                $settingForm = array(
                    'menu_item_id'	=> array('type' => 'hidden'),
                    'title'		=> array('required' => true),
                    'link'		=> array(),
                    'class'		=> array(),
                    'type'  => array('type' => 'select', 'options' => ApplicationConfigHelper::get('menu.item.type'),
                        'label' => 'Loại menu'),
                );
                $settingValue = $menuItemInfo;
                $settingAll = array();
                TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
    			break;
    	}
    }
    
    private function action_save_menu_item(){
    	$json_data = $_REQUEST['json_data'];
    	$menuItemId = $json_data['menu_item_id'];
    	$type = $json_data['type'];
    	switch ($type){
    		case 'page_link':
    			//get staticPageInfo
    			$staticPageId = $json_data['static_page_id'];
    			$staticPageInfo = StaticPageExt::getStaticPageInfo($staticPageId);
    			$menuItemVo = new MenuItemVo();
    			$menuItemVo->link = URLHelper::getStaticPageUrl($staticPageInfo->staticPageId);
    			$menuItemVo->title = StringHelper::toUcfirst($staticPageInfo->title);
    			$menuItemVo->class = $json_data['class'];
    			$menuItemVo->icon = $json_data['icon'];
    			$menuItemVo->tableId = $staticPageId;
    			$this->menuItemDao->updateByPrimaryKey($menuItemVo, $menuItemId);
    			
    			//update $json_data when ajax success
    			$json_data['title'] = $menuItemVo->title;
    			$json_data['link'] = $menuItemVo->link;
    			break;
    		case 'category_link':
    			//get categoryInfo
    			$categoryId = $json_data['category_id'];
    			$categoryInfo = CategoryExt::getCategoryInfo($categoryId);
    			if($categoryInfo){
    				$menuItemVo = new MenuItemVo();
    				$menuItemVo->link = URLHelper::getProductListPage($categoryInfo->categoryId);
    				$menuItemVo->title = StringHelper::toUcfirst($categoryInfo->name);
    				$menuItemVo->class = $json_data['class'];
    				$menuItemVo->icon = $json_data['icon'];
    				$menuItemVo->tableId = $categoryId;
    				//params
    				$params = array(
    					'category_id' => $json_data['category_id'],
    					'number_of_category' => $json_data['number_of_category'],
    					'skip_category' => $json_data['skip_category'],
    					'order_by' => $json_data['order_by'],
    					'order_direction' => $json_data['order_direction'],
    					'create_submenu' => $json_data['create_submenu'],
    				);
    				$menuItemVo->params = json_encode($params);
    				$this->menuItemDao->updateByPrimaryKey($menuItemVo, $menuItemId);
    	
    				//update $json_data when ajax success
    				$json_data['title'] = $menuItemVo->title;
    				$json_data['link'] = $menuItemVo->link;
    			}
    			else{
    				LogUtil::devInfo("[AdminMenuController::action::category_link] not update menuId = $menuItemId width categoryId = $categoryId");
    			}
    			break;
    		default:
                //custom_link
                $menuItemVo = new MenuItemVo();
                $menuItemVo->link = $json_data['link'];
                $menuItemVo->title = StringHelper::toUcfirst($json_data['title']);
                $menuItemVo->class = $json_data['class'];
                $menuItemVo->type = $json_data['type'];
                $menuItemVo->icon = $json_data['icon'];
                $this->menuItemDao->updateByPrimaryKey($menuItemVo, $menuItemId);
                break;
    	}
    	echo json_encode($json_data);
    }
	
    private function action_delete_menu_item(){
    	$menuItemId = $_REQUEST['menuItemId'];
    	MenuExt::deleteMenuItem($menuItemId);
    }
    
    private function action_save_menu(){
    	$datas = $_REQUEST['datas'];
    	//update order, parentId, level
    	$menuItemVo = new MenuItemVo();
    	foreach ($datas as $v){
    		$menuItemVo->order = $v['order'];
    		$menuItemVo->parentId = $v['parentId'];
    		$menuItemVo->level = $v['level'];
    		$this->menuItemDao->updateByPrimaryKey($menuItemVo, $v['id']);
    	}
    }
    
    private function action_delete_menu(){
    	$menuId = $_REQUEST['menuId'];
    	MenuExt::deleteMenu($menuId);
    }
}