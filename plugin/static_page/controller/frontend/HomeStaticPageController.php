<?php
class HomeStaticPageController extends Controller {
	private $staticPageDao;
	
	function __construct() {
		$this->staticPageDao = new StaticPageDao();
	}
	
	public function view(){

		$staticPageId = $_REQUEST['staticPageId'];
		$staticPageInfo = $this->staticPageDao->selectByPrimaryKey($staticPageId);
		
		if(!$staticPageInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Page not exist");
			return $this->setRender('home');
		}
		$this->setAttributes(array(
			'staticPageInfo' => $staticPageInfo,
			'seoInfo'=>SeoHelper::getSeoInfo($staticPageId,'page'),
		));
		
		return $this->setRender('success');
	}
}