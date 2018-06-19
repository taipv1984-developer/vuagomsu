<?php

class AdminCategoryController extends Controller{
	public $categoryDao;
	public $categoryModel;
	private $seoInfoDao;
	private $seoModel;

	function __construct(){
		$this->categoryDao = new CategoryDao ();
		$this->categoryModel = new CategoryModel ();
		$this->seoModel = new SeoInfoModel();
		$this->seoInfoDao = new SeoInfoDao();
	}

	//OK
	private function _validate_add($addVo){
		$validate = array();

		// the name should not duplicate in the table
		$categoryVo = new CategoryVo ();
		$categoryVo->name = $addVo->name;
		$categoryVo->parentId = $_REQUEST ['parentId'];
		$categoryVos = $this->categoryDao->selectByFilter($categoryVo);
		if ($categoryVos) {
			$validate ["categoryModel.name"] = e("Category name is exist");
		}

		return $validate;
	}

	//OK
	private function _validate_edit($editVo){
		$validate = array();

		// the name should not duplicate in the table
		$categoryVo = new CategoryVo ();
		$categoryVo->name = $editVo->name;
		$categoryVo->parentId = $_REQUEST ['parentId'];
		$categoryVos = $this->categoryDao->selectByFilter($categoryVo);
		if ($categoryVos) {
			$category = $categoryVos [0];
			if ($category->categoryId != $editVo->categoryId) {
				$validate ["categoryModel.name"] = e("Category name is exist");
			}
		}

		//check parrentId cannot choose itself as its parent
		$categoryId = $_REQUEST ['categoryId'];
		$parentId = $_REQUEST ['parentId'];
		$child = array($categoryId);
		CategoryExt::getChild($child, $categoryId);
		if (in_array($parentId, $child)) {
			$validate ["categoryModel.parentId"] = e("Cannot choose itself as its parent");
		}

		return $validate;
	}

	//OK
	public function validate_ajax(){
		$action = $_REQUEST ['action'];
		switch ($action) {
			case 'add' :
				$categoryVo = new CategoryVo ();
				$categoryVo->name = trim($_REQUEST ['value']);
				$validate = $this->_validate_add($categoryVo);
				if (!empty ($validate)) {
					echo json_encode($validate);
				}
				break;
			case 'edit' :
				$categoryVo = new CategoryVo ();
				$categoryVo->name = trim($_REQUEST ['value']);
				$categoryVo->categoryId = $_REQUEST ['categoryId'];
				$validate = $this->_validate_edit($categoryVo);
				if (!empty ($validate)) {
					echo json_encode($validate);
				}
				break;
		}

		return $this->setRender('success');
	}

	//OK
	public function manage(){
		$categoryList = CategoryExt::getCategoryList();

		//add info
		foreach ($categoryList as $k => $v) {
			$space = '';
			for ($i = 0; $i < $v['level']; $i++) {
				$space .= '|----';
			}
			$url = URLHelper::getProductListPage($v['categoryId']);
			$title = $v['description'];
			$categoryList[$k]['name'] = "<a href='$url'>" . $space . $v['name'] . "</a>";
			if (!$v['parentId']) {
				$categoryList[$k]['name'] = '<b>' . $categoryList[$k]['name'] . '</b>';
			}
		}

		//add info
		foreach ($categoryList as $k => $v) {
			$categoryList[$k]['icon'] = "<i class='{$v['icon']}'></i>";
			//productCount
			$categoryList[$k]['productCount'] = CategoryExt::getProductCount($v['categoryId']);
		}

		$this->setAttributes(array(
			'categoryList' => $categoryList
		));
		return $this->setRender('success');
	}

	private function _check_exist($categoryInfo){
		if (!$categoryInfo) {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Category not exist');
			return false;
		}
		return true;
	}

	private function _check_permission($categoryInfo){
		return true;
	}

	//OK
	public function add(){
		$categoryList = CategoryExt::getCategoryList();
		$this->setAttributes(array(
			'categoryList' => $categoryList
		));

		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$categoryVo = new CategoryVo ();
			CTTHelper::copyProperties($this->categoryModel, $categoryVo);
			//image
			$categoryVo->image = str_replace(Registry::getSetting('base_url') . '/', '', $_REQUEST['image']);

			$parentId = $categoryVo->parentId;
			$categoryId = $this->categoryDao->getLastInsertId($categoryVo);

			//seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $categoryId;
			$seoVo->type = 'product_category';
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->seoInfoDao->insert($seoVo);
			//end seo

			//update router
			$categoryInfo = $this->categoryDao->selectByPrimaryKey($categoryId);
			RouterExt::updateRouterUrlCategoryPage($categoryInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Add category success!');
			return $this->setRender('manage');
		}
		return $this->setRender('success');
	}

	//OK
	public function edit(){
		$categoryId = $_REQUEST['categoryId'];
		$categoryInfo = $this->categoryDao->selectByPrimaryKey($categoryId);

		if (!($this->_check_exist($categoryInfo) & $this->_check_permission($categoryInfo))) {
			return $this->setRender('manage');
		}

		$categoryList = CategoryExt::getCategoryList();
		//seo
		$seoVo = new SeoInfoVo();
		$seoVo->itemId = $categoryId;
		$seoVo->type = 'product_category';
		$seoInfoVos = $this->seoInfoDao->selectByFilter($seoVo);
		if (count($seoInfoVos) > 0) {
			$seoInfo = $seoInfoVos[0];
		} else {
			$seoInfo = $seoVo;
		}
		$this->setAttributes(array(
			'categoryInfo' => $categoryInfo,
			'categoryList' => $categoryList,
			'seoInfo' => $seoInfo,
		));

		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$categoryVo = new CategoryVo ();
			CTTHelper::copyProperties($this->categoryModel, $categoryVo);
			//image
			$categoryVo->image = str_replace(Registry::getSetting('base_url') . '/', '', $_REQUEST['image']);
			$categoryVo->modDate = DateHelper::getDateTime();
			$categoryVo->modBy = Session::getAdminId();
			$this->categoryDao->updateByPrimaryKey($categoryVo, $categoryId);

			//update seoInfo
			$seoVo = new SeoInfoVo();
			$seoVo->title = $_POST['seoModel_title'];
			$seoVo->keyword = $_POST['seoModel_keyword'];
			$seoVo->description = $_POST['seoModel_description'];
			$this->seoInfoDao->updateByPrimaryKey($seoVo, $categoryId, 'product_category');

			//update router
			$categoryInfo = $this->categoryDao->selectByPrimaryKey($categoryId);

			RouterExt::updateRouterUrlCategoryPage($categoryInfo);
			RouterExt::deleteRouterSame();

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Edit category success!');
			return $this->setRender('manage');
		}
		return $this->setRender('success');
	}

	//OK
	public function delete(){
		if (isset($_REQUEST['categoryId'])) {
			$categoryId = $_REQUEST['categoryId'];

			//get child of $category
			$child = array($categoryId);
			CategoryExt::getChild($child, $categoryId);
			foreach ($child as $childCategoryId) {
				CategoryExt::deleteCategory($childCategoryId);
			}

			//delete seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $categoryId;
			$seoVo->type = 'product_category';
			$this->seoInfoDao->deleteByFilter($seoVo);

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e("Delete is success!"));
			return $this->setRender('success');
		} else {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Access deny"));
			return $this->setRender('success');
		}
	}
}