<?php
class AdminNavLinkController extends Controller {
	private $navLinkDao;
    public $navLinkModel;
    
    function __construct(){
    	$this->navLinkDao = new NavLinkDao();
    	$this->navLinkModel = new NavLinkModel();
    }
    
	public function manage(){
        $navLinks = NavLinkExt::getNavLink();

        $this->setAttributes (array (
        	'navLinks' => $navLinks
        ));

        //call view
        return $this->setRender('success');
    }
    
    public function action(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$navLinkVo = new NavLinkVo();
    			$navLinkVo->link = 'admin/index';
    			$navLinkVo->title = 'New item';
    			$navLinkVo->icon = 'fa fa-bars';
    			$navLinkVo->parentId = 0;
    			$navLinkVo->order = $_REQUEST['order'];
    			$navLinkVo->type = 'admin';
    			$navLinkId = $this->navLinkDao->insert($navLinkVo);
    			$v = array(
    				'id' => $navLinkId,
    				'title' => $navLinkVo->title,
    				'link' => $navLinkVo->link,
    				'class' => 'new_item red',	//custom
    				'isEnd' => true,			//custom
    			);
    			include PROTECTED_PATH."view/admin/nav_link/nav_link_item.php";
    			break;
    		case 'edit_form':
    			$navLinkInfo = $this->navLinkDao->selectByPrimaryKey($_REQUEST['id']);
    			//form
    			$settingForm = array(
    				'nav_link_id'	=> array('type' => 'hidden'),
    				'title'		=> array('required' => true),
    				'link'		=> array(),
    				'icon'		=> array(),
    			);
    			$settingValue = $navLinkInfo;
    			$settingAll = array();
    			TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
    			break;
    		case 'edit_save':
    			$json_data = $_REQUEST['json_data'];
    			//update
    			$navLinkVo = new NavLinkVo();
    			$navLinkVo->link = $json_data['link'];
    			$navLinkVo->title = $json_data['title'];
    			$navLinkVo->icon = $json_data['icon'];
    			$this->navLinkDao->updateByPrimaryKey($navLinkVo, $json_data['nav_link_id']);
    			
    			echo json_encode($json_data);
    			break;
    		case 'save':
    			$datas = $_REQUEST['datas'];
    			//update order, parentId
    			$navLinkVo = new NavLinkVo();
    			foreach ($datas as $v){
    				$navLinkVo->order = $v['order'];
    				$navLinkVo->parentId = $v['parentId'];
    				$this->navLinkDao->updateByPrimaryKey($navLinkVo, $v['id']);
    			}
    			break;
    		case 'delete':
    			$this->navLinkDao->deleteByPrimaryKey($_REQUEST['id']);
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
}