<?php
class HomeNewsController extends Controller{
	private $newsDao;
	private $newsCategoryDao;
	private $newsTagDao;
	private $pluginCode;
	
	function __construct() {
		$this->newsDao = new NewsDao();
		$this->newsCategoryDao = new NewsCategoryDao();
		$this->newsTagDao = new NewsTagDao();
		
		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
	}
	
	private function getFilter(){
		$filter = array();
		$filter['n.status'] = 'A';
		
		//*** newsCategoryId
		if($_REQUEST['newsCategoryId']){
			$newsCategoryId = $_REQUEST['newsCategoryId'];
			$filter['n.news_category_id'] = array('in', '('.$newsCategoryId.')', 'int');
		}
		return $filter;
	}
	
	public function newsList() {
		//get $newsCategoryInfo
		if(isset($_REQUEST['newsCategoryId'])){
			$newsCategoryId = $_REQUEST['newsCategoryId'];
			$newsCategoryInfo = $this->newsCategoryDao->selectByPrimaryKey($newsCategoryId);
			if(!$newsCategoryInfo){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Category not exist");
				return $this->setRender('home');
			}
		}
		
		$newsVo = new NewsVo();
		$filter = $this->getFilter();
		
		//limit
		if(empty($_REQUEST['limit'])){
			$recSize = Registry::getSetting('item_per_page');
		}
		else{
			$recSize = $_REQUEST['limit'];
		}
		$start = 0;
		$page = 1;
		if(CTTHelper::isEmptyString($_REQUEST ['page'])){
			$page = 0;
		}
		elseif(is_numeric($_REQUEST ['page'])){
			$page = $_REQUEST ['page'];
		}
		else{
			$page = 0;
		}
		$count = count(NewsExt::getFilter($filter));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1)* $recSize;

		//set orderBy
		$orderBy = array('n.news_id' => 'DESC');
		$newsList = NewsExt::getFilter($filter, $orderBy, $start, $recSize);

		//send data
		$this->setAttributes(array(
			'pageView' => $paging,
			'newsList' => $newsList,
			'newsCategoryInfo' => $newsCategoryInfo,
			'seoInfo'=>SeoHelper::getSeoInfo($newsCategoryId,'new_category'),

		));
		
		return $this->setRender('success');
	}
	
	public function newsDetail() {
		$newsId = $_REQUEST['newsId'];
		
		//get newsInfo
		$newsInfo = $this->newsDao->selectByPrimaryKey($newsId);
		if(!$newsInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("News not exist"));
			return $this->setRender('home');
		}
		
		//send data
		$this->setAttributes(array(
			'newsInfo' => $newsInfo,
			'newsCategoryInfo' => NewsCategoryExt::getNewsCategoryInfo($newsInfo->newsCategoryId),
			'newsTagSelected' => NewsExt::getNewsTagList($newsId),
			'crtByName' => NewsExt::crtByName($newsInfo->crtBy),
			'newsRelateList' => NewsExt::getNewsRelateList($newsInfo, 6),
			'seoInfo'=>SeoHelper::getSeoInfo($newsId,'new'),			
		));
		
		//update viewCount
		$viewCount = $newsInfo->viewCount;
		$viewCount++;
		$newsVo = new NewsVo();
		$newsVo->viewCount = $viewCount;
		$this->newsDao->updateByPrimaryKey($newsVo, $newsId);
	
		return $this->setRender('success');
	}
	
	public function newsTag() {
		//get $newsTagInfo
		if(isset($_REQUEST['newsTagId'])){
			$newsTagId = $_REQUEST['newsTagId'];
			$newsTagInfo = $this->newsTagDao->selectByPrimaryKey($newsTagId);
			if(!$newsTagInfo){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Category not exist");
				return $this->setRender('home');
			}
		}
	
		$newsVo = new NewsVo();
		//get fillter
		$filter = array();
		if($_REQUEST['newsTagId']){
			$newsTagId = $_REQUEST['newsTagId'];
			$filter['news_tag.news_tag_id'] = $newsTagId;
		}
	
		//limit
		if(empty($_REQUEST['limit'])){
			$recSize = Registry::getSetting('item_per_page');
		}
		else{
			$recSize = $_REQUEST['limit'];
		}
		$start = 0;
		$page = 1;
		if(CTTHelper::isEmptyString($_REQUEST ['page'])){
			$page = 0;
		}
		elseif(is_numeric($_REQUEST ['page'])){
			$page = $_REQUEST ['page'];
		}
		else{
			$page = 0;
		}
		$count = count(NewsExt::getNewsTagFilter($filter));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1)* $recSize;
	
		//set orderBy
		$orderBy = array('news.news_id' => 'DESC');
		$newsList = NewsExt::getNewsTagFilter($filter, $orderBy, $start, $recSize);
		
		//send data
		$this->setAttributes(array(
			'pageView' => $paging,
			'newsList' => $newsList,
			'newsTagInfo' => $newsTagInfo,
		));
	
		return $this->setRender('success');
	}
}