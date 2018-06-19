<?php

class AdminStaticPageController extends Controller{
	private $staticPageDao;
	public $staticPageModel;
	private $pluginCode;
	private $SeoInfoDao;
	private $seoModel;

	function __construct(){
		$this->staticPageDao = new StaticPageDao();
		$this->staticPageModel = new StaticPageModel();

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
		$staticPageVo = new StaticPageVo();
		$staticPageVo->title = $addVo->title;
		$staticPageVos = $this->staticPageDao->selectByFilter($staticPageVo);
		if ($staticPageVos) {
			$validate["staticPageModel.title"] = e("Static Page title is exist");
		}

		return $validate;
	}

	private function _validate_edit($editVo){
		$validate = array();

		//the title should not duplicate in the table
		$staticPageVo = new StaticPageVo();
		$staticPageVo->title = $editVo->title;
		$staticPageVos = $this->staticPageDao->selectByFilter($staticPageVo);
		if ($staticPageVos) {
			$staticPage = $staticPageVos[0];
			if ($staticPage->staticPageId != $editVo->staticPageId) {
				$validate["staticPageModel.title"] = e("Static Page title is exist");
			}
		}

		return $validate;
	}

	private function _add_info($staticPageVo){
		$staticPageVo->summary = StringHelper::subString($staticPageVo->summary, 25);

		//titleLink
		$staticPageLink = URLHelper::getStaticPageUrl($staticPageVo->staticPageId);
		$staticPageVo->titleLink = "<a href='$staticPageLink' target='_blank'>{$staticPageVo->title}</a>";
	}

	private function _filter($staticPageVo){
		if (!CTTHelper::isEmptyString($this->staticPageModel->staticPageId)) {
			$staticPageVo->staticPageId = $this->staticPageModel->staticPageId;
		}
		if (!CTTHelper::isEmptyString($this->staticPageModel->title)) {
			$staticPageVo->title = array('like', "%{$this->staticPageModel->title}%");
		}
		if (!CTTHelper::isEmptyString($this->staticPageModel->status)) {
			$staticPageVo->status = $this->staticPageModel->status;
		}
	}

	public function manage(){
		$staticPageVo = new StaticPageVo();

		//filter
		$this->_filter($staticPageVo);

		//orderBy
		$orderBy = array('static_page_id' => 'DESC');

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
		$count = count($this->staticPageDao->selectByFilter($staticPageVo));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1) * $recSize;

		//get data
		$staticPageList = $this->staticPageDao->selectByFilter($staticPageVo, $orderBy, $start, $recSize);

		//add info
		foreach ($staticPageList as $v) {
			$this->_add_info($v);
		}

		//set data
		$paging->items = $staticPageList;

		//send data
		$this->setAttributes(array(
			'pageView' => $paging
		));

		//call view
		return $this->setRender('success');
	}

	public function manage_ajax(){
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'change_status_ajax':
				$staticPageVo = new StaticPageVo();
				$staticPageVo->status = $_REQUEST['value'];
				$this->staticPageDao->updateByPrimaryKey($staticPageVo, $_REQUEST['id']);
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
				$staticPageVo = new StaticPageVo();
				$staticPageVo->title = trim($_REQUEST['title']);
				$validate = $this->_validate_add($staticPageVo);
				if (!empty($validate)) {
					echo json_encode($validate);
				}
				break;
			case 'edit':
				$staticPageVo = new StaticPageVo();
				$staticPageVo->title = trim($_REQUEST['title']);
				$staticPageVo->staticPageId = $_REQUEST['staticPageId'];
				$validate = $this->_validate_edit($staticPageVo);
				if (!empty($validate)) {
					echo json_encode($validate);
				}
				break;
		}

		return $this->setRender('success');
	}

	private function _check_exist($staticPageInfo){
		if (!$staticPageInfo) {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Static Page not exist');
			return false;
		}
		return true;
	}

	private function _check_permission($staticPageInfo){
		return true;
	}

	public function add(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$staticPageVo = new StaticPageVo();
			CTTHelper::copyProperties($this->staticPageModel, $staticPageVo);
			//image
			$staticPageVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $_REQUEST['image']);
			$staticPageVo->crtBy = Session::getAdminId();
			$staticPageVo->crtDate = DateHelper::getDateTime();

			//add
			$staticPageId = $this->staticPageDao->insert($staticPageVo);
			//seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $staticPageId;
			$seoVo->type = 'page';
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->SeoInfoDao->insert($seoVo);
			//end seo
			//update router
			$staticPageInfo = $this->staticPageDao->selectByPrimaryKey($staticPageId);
			RouterExt::updateRouterUrlStaticPage($staticPageInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Static Page add success");
			return $this->setRender('manage');
		}

		//send data
		$this->setAttributes(array());

		return $this->setRender('success');
	}

	public function edit(){
		$staticPageId = $_REQUEST['staticPageId'];
		$staticPageInfo = $this->staticPageDao->selectByPrimaryKey($staticPageId);

		if (!($this->_check_exist($staticPageInfo) & $this->_check_permission($staticPageInfo))) {
			return $this->setRender('manage');
		}

		//seo
		$seoVo = new SeoInfoVo();
		$seoVo->itemId = $staticPageId;
		$seoVo->type = 'page';
		$seoInfoVos = $this->SeoInfoDao->selectByFilter($seoVo);
		if (count($seoInfoVos) > 0) {
			$seoInfo = $seoInfoVos[0];
		} else {
			$seoInfo = $seoVo;
		}


		//send data
		$this->setAttributes(array(
			'staticPageInfo' => $staticPageInfo,
			'seoInfo' => $seoInfo,
		));

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$staticPageVo = new StaticPageVo();
			CTTHelper::copyProperties($this->staticPageModel, $staticPageVo);
			//image
			$staticPageVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $_REQUEST['image']);
			$staticPageVo->modBy = Session::getAdminId();
			$staticPageVo->modDate = DateHelper::getDateTime();

			//update
			$this->staticPageDao->updateByPrimaryKey($staticPageVo, $staticPageId);
			//update seo

			$seoVo = new SeoInfoVo();
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->SeoInfoDao->updateByPrimaryKey($seoVo, $staticPageId, 'page');

			//update SEO
			//update router
			$staticPageInfo = $this->staticPageDao->selectByPrimaryKey($staticPageId);
			RouterExt::updateRouterUrlStaticPage($staticPageInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Static Page update success");
			return $this->setRender('manage');
		}

		return $this->setRender('success');
	}

	public function delete(){
		if (isset($_REQUEST['staticPageId'])) {
			$staticPageId = $_REQUEST['staticPageId'];
			//delete seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $staticPageId;
			$seoVo->type = 'product_category';
			$this->SeoInfoDao->deleteByFilter($seoVo);
			//delete
			$this->staticPageDao->deleteByPrimaryKey($staticPageId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
		}
		return $this->setRender('success');
	}
}