<?php

class AdminNewsCategoryController extends Controller{
	private $newsCategoryDao;
	public $newsCategoryModel;
	private $pluginCode;
	private $SeoInfoDao;
	private $seoModel;

	function __construct(){
		$this->newsCategoryDao = new NewsCategoryDao();
		$this->newsCategoryModel = new NewsCategoryModel();

		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
		$this->seoModel = new SeoInfoModel();
		$this->SeoInfoDao = new SeoInfoDao();
	}

	private function _validate_add($addVo){
		$validate = array();

		//the name should not duplicate in the table
		$newsCategoryVo = new NewsCategoryVo();
		$newsCategoryVo->name = $addVo->name;
		$newsCategoryVos = $this->newsCategoryDao->selectByFilter($newsCategoryVo);
		if ($newsCategoryVos) {
			$validate["newsCategoryModel.name"] = e("News Category name is exist");
		}

		return $validate;
	}

	private function _validate_edit($editVo){
		$validate = array();

		//the name should not duplicate in the table
		$newsCategoryVo = new NewsCategoryVo();
		$newsCategoryVo->name = $editVo->name;
		$newsCategoryVos = $this->newsCategoryDao->selectByFilter($newsCategoryVo);
		if ($newsCategoryVos) {
			$newsCategory = $newsCategoryVos[0];
			if ($newsCategory->newsCategoryId != $editVo->newsCategoryId) {
				$validate["newsCategoryModel.name"] = e("News Category name is exist");
			}
		}

		//check parrentId cannot choose itself as its parent
		$newsCategoryId = $_REQUEST ['newsCategoryId'];
		$parentId = $_REQUEST ['parentId'];
		$child = array($newsCategoryId);
		NewsCategoryExt::getChild($child, $newsCategoryId);
		if (in_array($parentId, $child)) {
			$validate ["newsCategoryModel.parentId"] = e("Cannot choose itself as its parent");
		}

		return $validate;
	}

	public function manage(){
		$newsCategoryList = NewsCategoryExt::getNewsCategoryList();

		//add info
		foreach ($newsCategoryList as $k => $v) {
			$space = '';
			for ($i = 0; $i < $v['level']; $i++) {
				$space .= '|----';
			}
			$url = URLHelper::getNewsListPage($v['id']);
			$title = $v['description'];
			$newsCategoryList[$k]['name'] = "<a href='$url'>" . $space . $v['name'] . "</a>";
			if (!$v['parentId']) {
				$newsCategoryList[$k]['name'] = '<b>' . $newsCategoryList[$k]['name'] . '</b>';
			}
		}

		$this->setAttributes(array(
			'newsCategoryList' => $newsCategoryList
		));
		return $this->setRender('success');
	}

	public function validate_ajax(){
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'add':
				$newsCategoryVo = new NewsCategoryVo();
				$newsCategoryVo->name = trim($_REQUEST['name']);
				$validate = $this->_validate_add($newsCategoryVo);
				if (!empty($validate)) {
					echo json_encode($validate);
				}
				break;
			case 'edit':
				$newsCategoryVo = new NewsCategoryVo();
				$newsCategoryVo->name = trim($_REQUEST['name']);
				$newsCategoryVo->newsCategoryId = $_REQUEST['newsCategoryId'];
				$validate = $this->_validate_edit($newsCategoryVo);
				if (!empty($validate)) {
					echo json_encode($validate);
				}
				break;
		}

		return $this->setRender('success');
	}

	private function _check_exist($newsCategoryInfo){
		if (!$newsCategoryInfo) {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'News Category not exist');
			return false;
		}
		return true;
	}

	private function _check_permission($newsCategoryInfo){
		return true;
	}

	public function add(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$newsCategoryVo = new NewsCategoryVo();
			CTTHelper::copyProperties($this->newsCategoryModel, $newsCategoryVo);
			//image
			$newsCategoryVo->image = str_replace(Registry::getSetting('base_url') . '/', '', $_REQUEST['image']);
			$newsCategoryVo->crtBy = Session::getAdminId();
			$newsCategoryVo->crtDate = DateHelper::getDateTime();

			//get $level
			$parentId = $newsCategoryVo->parentId;
			if ($parentId) {
				$levelParent = $this->newsCategoryDao->getValueByPrimaryKey('level', $parentId);
				$level = $levelParent + 1;
			} else {    //root
				$level = 0;
			}
			$newsCategoryVo->level = $level;
			$newsCategoryVo->crtBy = Session::getAdminId();
			$newsCategoryVo->crtDate = DateHelper::getDate();

			//add
			$newsCategoryId = $this->newsCategoryDao->insert($newsCategoryVo);
			//seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $newsCategoryId;
			$seoVo->type = 'new_category';
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->SeoInfoDao->insert($seoVo);
			//end seo
			//update router
			$newsCategoryInfo = $this->newsCategoryDao->selectByPrimaryKey($newsCategoryId);
			RouterExt::updateRouterUrlNewsCategoryPage($newsCategoryInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "News Category add success");
			return $this->setRender('manage');
		}

		//get $newsCategory
		$newsCategoryList = NewsCategoryExt::getNewsCategoryList();

		//send data
		$this->setAttributes(array(
			'newsCategoryList' => $newsCategoryList,
		));

		return $this->setRender('success');
	}

	public function edit(){
		$newsCategoryId = $_REQUEST['newsCategoryId'];
		$newsCategoryInfo = $this->newsCategoryDao->selectByPrimaryKey($newsCategoryId);

		if (!($this->_check_exist($newsCategoryInfo) & $this->_check_permission($newsCategoryInfo))) {
			return $this->setRender('manage');
		}

		//get $newsCategory
		$newsCategoryList = NewsCategoryExt::getNewsCategoryList();
		//seo       
		$seoVo = new SeoInfoVo();
		$seoVo->itemId = $newsCategoryId;
		$seoVo->type = 'new_category';
		$seoInfoVos = $this->SeoInfoDao->selectByFilter($seoVo);
		if (count($seoInfoVos) > 0) {
			$seoInfo = $seoInfoVos[0];
		} else {
			$seoInfo = $seoVo;
		}
		//send data
		$this->setAttributes(array(
			'newsCategoryInfo' => $newsCategoryInfo,
			'newsCategoryList' => $newsCategoryList,
			'seoInfo' => $seoInfo,
		));

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//set data
			$newsCategoryVo = new NewsCategoryVo();
			CTTHelper::copyProperties($this->newsCategoryModel, $newsCategoryVo);
			//image
			$newsCategoryVo->image = str_replace(Registry::getSetting('base_url') . '/', '', $_REQUEST['image']);
			$newsCategoryVo->modBy = Session::getAdminId();
			$newsCategoryVo->modDate = DateHelper::getDateTime();

			//update
			$this->newsCategoryDao->updateByPrimaryKey($newsCategoryVo, $newsCategoryId);

			//update seo
			$seoVo = new SeoInfoVo();
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->SeoInfoDao->updateByPrimaryKey($seoVo, $newsCategoryId, 'new_category');

			//update SEO
			//update router
			$newsCategoryInfo = $this->newsCategoryDao->selectByPrimaryKey($newsCategoryId);
			RouterExt::updateRouterUrlNewsCategoryPage($newsCategoryInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "News Category update success");
			return $this->setRender('manage');
		}

		return $this->setRender('success');
	}

	public function delete(){
		if (isset($_REQUEST['newsCategoryId'])) {
			$newsCategoryId = $_REQUEST['newsCategoryId'];
			$newsCategoryInfo = $this->newsCategoryDao->selectByPrimaryKey($newsCategoryId);

			if (!($this->_check_exist($newsCategoryInfo) & $this->_check_permission($newsCategoryInfo))) {
				return $this->setRender('manage');
			}

			//check child of $newsCategoryInfo
			NewsCategoryExt::getChild($child, $newsCategoryId);
			if (count($child) > 0) {
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Delete error! <br>Because category have child');
				return $this->setRender('manage');
			}
			//delete seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $newsCategoryId;
			$seoVo->type = 'new_category';
			$this->SeoInfoDao->deleteByFilter($seoVo);

			//delete
			//delete news and news_category
			NewsCategoryExt::delete($newsCategoryId);

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
		}
		return $this->setRender('success');
	}
}