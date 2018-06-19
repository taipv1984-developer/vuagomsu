<?php

class AdminNewsController extends Controller{
	private $newsDao;
	private $newsCategoryDao;
	public $newsModel;
	private $pluginCode;
	private $SeoInfoDao;
	private $seoModel;

	function __construct(){
		$this->newsDao = new NewsDao();
		$this->newsCategoryDao = new NewsCategoryDao();
		$this->newsModel = new NewsModel();

		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';

		$this->seoModel = new SeoInfoModel();
		$this->SeoInfoDao = new SeoInfoDao();
	}

	private function _validate_add($addVo){
		$validate = array();

		//the title should not duplicate in the table
		$newsVo = new NewsVo();
		$newsVo->title = $addVo->title;
		$newsVos = $this->newsDao->selectByFilter($newsVo);
		if ($newsVos) {
			$validate["newsModel.title"] = e("News title is exist");
		}

		return $validate;
	}

	private function _validate_edit($editVo){
		$validate = array();

		//the title should not duplicate in the table
		$newsVo = new NewsVo();
		$newsVo->title = $editVo->title;
		$newsVos = $this->newsDao->selectByFilter($newsVo);
		if ($newsVos) {
			$news = $newsVos[0];
			if ($news->newsId != $editVo->newsId) {
				$validate["newsModel.title"] = e("News title is exist");
			}
		}

		return $validate;
	}

	private function _add_info($newsVo){
		$newsVo->summary = StringHelper::subString($newsVo->summary, 25);

		//newsCategoryName
		$newsCategoryId = $newsVo->newsCategoryId;
		$newsCategoryInfo = $this->newsCategoryDao->selectByPrimaryKey($newsCategoryId);
		$newsCategoryLink = URLHelper::getNewsListPage($newsCategoryId);
		$newsVo->newsCategoryLink = "<a href='$newsCategoryLink' target='_blank'>{$newsCategoryInfo->name}</a>";

		//titleLink
		$newsLink = URLHelper::getNewsDetailPage($newsVo->newsId);
		$newsVo->titleLink = "<a href='$newsLink' target='_blank'>{$newsVo->title}</a>";
	}

	private function _filter($newsVo){
		if (!CTTHelper::isEmptyString($this->newsModel->newsId)) {
			$newsVo->newsId = $this->newsModel->newsId;
		}
		if (!CTTHelper::isEmptyString($_REQUEST['newsModel_titleLink'])) {
			$newsVo->title = array('like', "%{$_REQUEST['newsModel_titleLink']}%");
		}
		if (!CTTHelper::isEmptyString($this->newsModel->summary)) {
			$newsVo->summary = array('like', "%{$this->newsModel->summary}%");
		}
		if (!CTTHelper::isEmptyString($_REQUEST['newsModel_newsCategoryLink'])) {
			$newsVo->newsCategoryId = $_REQUEST['newsModel_newsCategoryLink'];
		}
		if (!CTTHelper::isEmptyString($this->newsModel->status)) {
			$newsVo->status = $this->newsModel->status;
		}
	}

	public function manage(){
		$newsVo = new NewsVo();

		//filter
		$this->_filter($newsVo);

		//orderBy
		$orderBy = array('news_id' => 'DESC');

		//paging
		if (empty($_REQUEST['item_per_page'])) {
			$recSize = Registry::getSetting('item_per_page');
		} else {
			$recSize = $_REQUEST['item_per_page'];
		}
		$start = 0;
		if (CTTHelper::isEmptyString($_REQUEST ['page'])) {
			$page = 0;
		} elseif (is_numeric($_REQUEST ['page'])) {
			$page = $_REQUEST ['page'];
		} else {
			$page = 0;
		}
		$count = count($this->newsDao->selectByFilter($newsVo));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1) * $recSize;

		//get data
		$newsVos = $this->newsDao->selectByFilter($newsVo, $orderBy, $start, $recSize);

		//get $newsCategoryList
		$newsCategoryList = NewsCategoryExt::getNewsCategoryList();

		//add info
		foreach ($newsVos as $newsVo) {
			$this->_add_info($newsVo);
		}

		//set data
		$paging->items = $newsVos;

		//send data
		$this->setAttributes(array(
			'pageView' => $paging,
			'newsCategoryList' => $newsCategoryList,
		));

		//deleteNewsTagMapTemp
		NewsExt::deleteNewsTagMapTemp();

		//call view
		return $this->setRender('success');
	}

	public function manage_ajax(){
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'change_status_ajax':
				$newsVo = new NewsVo();
				$newsVo->status = $_REQUEST['value'];
				$this->newsDao->updateByPrimaryKey($newsVo, $_REQUEST['id']);
				break;
			default:
				break;
		}

		return $this->setRender('success');
	}

	public function validate_ajax(){
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'add':
				$newsVo = new NewsVo();
				$newsVo->title = trim($_REQUEST['title']);
				$validate = $this->_validate_add($newsVo);
				if (!empty($validate)) {
					echo json_encode($validate);
				}
				break;
			case 'edit':
				$newsVo = new NewsVo();
				$newsVo->title = trim($_REQUEST['title']);
				$newsVo->newsId = $_REQUEST['newsId'];
				$validate = $this->_validate_edit($newsVo);
				if (!empty($validate)) {
					echo json_encode($validate);
				}
				break;
		}

		return $this->setRender('success');
	}

	private function _check_exist($newsInfo){
		if (!$newsInfo) {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'News not exist');
			return false;
		}
		return true;
	}

	private function _check_permission($newsInfo){
		return true;
	}

	public function add(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$newsVo = new NewsVo();
			CTTHelper::copyProperties($this->newsModel, $newsVo);
			//image
			$newsVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $_REQUEST['image']);
			$newsVo->crtBy = Session::getAdminId();
			$newsVo->crtDate = DateHelper::getDateTime();
			$newsVo->viewCount = 0;

			//add
			$newsId = $this->newsDao->insert($newsVo);

			//update newsTag
			NewsExt::updateNewsTagMap($newsId);
			//seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $newsId;
			$seoVo->type = 'new';
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->SeoInfoDao->insert($seoVo);
			//end seo

			//update router
			$newsInfo = $this->newsDao->selectByPrimaryKey($newsId);
			RouterExt::updateRouterUrlNewsPage($newsInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "News add success");
			return $this->setRender('manage');
		}

		//get $newsCategory
		$newsCategoryList = NewsCategoryExt::getNewsCategoryList();

		//send data
		$this->setAttributes(array(
			'newsCategoryList' => $newsCategoryList,
			'newsTagSelected' => array(),
			'newsTagList' => NewsExt::getNewsTagList()
		));

		return $this->setRender('success');
	}

	public function edit(){
		$newsId = $_REQUEST['newsId'];
		$newsInfo = $this->newsDao->selectByPrimaryKey($newsId);

		if (!$newsInfo) {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "News not exist");
			return $this->setRender('manage');
		}

		//get $newsCategory
		$newsCategoryList = NewsCategoryExt::getNewsCategoryList();
		//seo       
		$seoVo = new SeoInfoVo();
		$seoVo->itemId = $newsId;
		$seoVo->type = 'new';
		$seoInfoVos = $this->SeoInfoDao->selectByFilter($seoVo);
		if (count($seoInfoVos) > 0) {
			$seoInfo = $seoInfoVos[0];
		} else {
			$seoInfo = $seoVo;
		}
		//send data
		$this->setAttributes(array(
			'newsInfo' => $newsInfo,
			'newsCategoryList' => $newsCategoryList,
			'newsTagSelected' => NewsExt::getNewsTagList($newsId),
			'newsTagList' => NewsExt::getNewsTagList(),
			'seoInfo' => $seoInfo,
		));

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$newsVo = new NewsVo();
			CTTHelper::copyProperties($this->newsModel, $newsVo);
			//image
			$newsVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $_REQUEST['image']);
			$newsVo->modBy = Session::getAdminId();
			$newsVo->modDate = DateHelper::getDateTime();

			//update
			$this->newsDao->updateByPrimaryKey($newsVo, $newsId);
			//update seo
			$seoVo = new SeoInfoVo();
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->SeoInfoDao->updateByPrimaryKey($seoVo, $newsId, 'new');

			//update SEO
			//update router
			$newsInfo = $this->newsDao->selectByPrimaryKey($newsId);
			RouterExt::updateRouterUrlNewsPage($newsInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "News update success");
			return $this->setRender('manage');
		}

		return $this->setRender('success');
	}

	public function delete(){
		if (isset($_REQUEST['Array'])) {
			$Array = $_REQUEST['Array'];

			//check later
			//...

			$this->newsDao->deleteByPrimaryKey($Array);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
		}
		return $this->setRender('success');
	}
}