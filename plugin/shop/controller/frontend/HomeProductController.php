<?php
class HomeProductController extends Controller{
	private $productDao;
	private $categoryDao;
	private $productTagDao;
	private $pluginCode;
	
	function __construct() {
		$this->productDao = new ProductDao();
		$this->categoryDao = new CategoryDao();
		$this->productTagDao = new ProductTagDao();
		
		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
	}
	
	private function getFilter(){
		$filter = array();
		$filter['p.status'] = 'A';
		
		//name
		if($_REQUEST['name']){
			$filter['p.name'] = array('like', '%'.$_REQUEST['name'].'%');
		}
		
		//price
		if(!CTTHelper::isEmptyString($_REQUEST['priceFrom'])&& !CTTHelper::isEmptyString($_REQUEST['priceTo'])){
			$filter['p.price'] = array('between', $_REQUEST['priceFrom'], $_REQUEST['priceTo'],);
		}
	
		//*** categoryId
		if($_REQUEST['categoryId']){
			$categoryId = $_REQUEST['categoryId'];
			//get all child of categoryId
			CategoryExt::getChild($child, $categoryId);
			array_push($child, $categoryId);
			if(count($child)){
				$filter['pc.category_id'] = array('in', '('.join(', ', $child).')', 'int');
			}
		}
	
// 		//*** attribute
// 		if($_REQUEST['attribute']){
// 			$productIds = array();
// 			$attribute = $_REQUEST['attribute'];
// 			if($attribute != ''){
// 				$attribute = explode(',', $attribute);
// 				$productIds = ProductExt::getProductIdsByFilter($attribute);
// 				if(count($productIds)){
// 					$filter['p.product_id'] = array('in', '('.join(', ', $productIds).')', 'int');
// 				}
// 			}
// 		}
	
        if(!CTTHelper::isEmptyString($_REQUEST['priceFrom']) && !CTTHelper::isEmptyString($_REQUEST['priceTo'])){
            $filter['p.price'] = array('between', $_REQUEST['priceFrom'], $_REQUEST['priceTo']);
        }
		
		return $filter;
	}
	
	public function productList() {
		//get categoryInfo
		if(isset($_REQUEST['categoryId'])){
			$categoryId = $_REQUEST['categoryId'];
			$categoryInfo = $this->categoryDao->selectByPrimaryKey($categoryId);
			if(!$categoryInfo){
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Category not exist");
				return $this->setRender('home');
			}
		}

        $filter = $this->getFilter();

        //limit
        if (empty($_REQUEST['limit'])) {
            $recSize = Registry::getSetting('item_per_page');
        } else {
            $recSize = $_REQUEST['limit'];
        }
        $start = 0;
        $page = 1;
        if (CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } elseif (is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } else {
            $page = 0;
        }
        $count = count(ProductExt::getFilter($filter));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;

        //set orderBy
        $orderBy = array('p.product_id' => 'DESC');
        if ($_REQUEST['orderBy']) {
            switch ($_REQUEST['orderBy']) {
                case 'new':
                    $orderBy = array('p.product_id' => 'DESC');
                    break;
                case 'best_selling':
                    $orderBy = array('op.total_quantity' => 'DESC');
                    break;
                case 'discount':
                    $orderBy = array('p.discount' => 'DESC');
                    break;
                case 'price_low_to_high':
                    $orderBy = array('p.price' => 'ASC');
                    break;
                case 'price_high_to_low':
                    $orderBy = array('p.price' => 'DESC');
                    break;
                case 'name_asc':
                    $orderBy = array('p.name' => 'ASC');
                    break;
                case 'name_desc':
                    $orderBy = array('p.name' => 'DESC');
                    break;
                case 'id_asc':
                    $orderBy = array('p.product_id' => 'ASC');
                    break;
                case 'id_desc':
                    $orderBy = array('p.product_id' => 'DESC');
                    break;
            }
        }
        $productList = ProductExt::getFilter($filter, $orderBy, $start, $recSize);

        //send data
        $this->setAttributes(array(
            'pageView' => $paging,
            'productList' => $productList,
            'productCount' => $count,
            'categoryInfo' => $categoryInfo,
            'seoInfo'=>SeoHelper::getSeoInfo($categoryId,'product_category'),

        ));

		return $this->setRender('success');
	}

    public function subCategoryList($categoryInfo) {
        //get subCategoryList
        $categoryVo = new CategoryVo();
        $categoryVo->parentId = $categoryInfo->categoryId;
        $subCategoryList = $this->categoryDao->selectByFilter($categoryVo);

        //add info
        foreach ($subCategoryList as $v){
            $filter = array('c.category_id' => $v->categoryId);
            $orderBy = array('p.product_id' => 'ASC');
            $v->productList = ProductExt::getFilter($filter, $orderBy, 0, 6);
        }

        //send data
        $this->setAttributes(array(
            'categoryInfo' => $categoryInfo,
            'subCategoryList' => $subCategoryList,
        ));

        return $this->setRender('success');
    }
	
	public function productDetail() {
		$productId = $_REQUEST['productId'];
		
		//get productInfo
		$productVo = new ProductVo();
		$productVo->productId = $productId;
		$productVos = $this->productDao->selectByFilter($productVo);
		if(!$productVos){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Product not exist"));
			return $this->setRender('home');
		}
		$productInfo = $productVos[0];

		//send data
		$this->setAttributes(array(
			'pluginCode' => $this->pluginCode,
			'productInfo' => $productInfo,
			'productImage' => ProductExt::getImageAttach($productId),
			'productExtension' => ProductExt::getProductExtension($productId),
			'productTagList' => ProductExt::getProductTagList($productId),
			'seoInfo'=>SeoHelper::getSeoInfo($productId,'product'),
		));

		//update productViewed
		ProductExt::updateProductViewed($productId);

		//update viewCount
		$viewCount = $productInfo->viewCount;
		$viewCount++;
		$productVo = new ProductVo();
		$productVo->viewCount = $viewCount;
		$this->productDao->updateByPrimaryKey($productVo, $productId);
	
		return $this->setRender('success');
	}
	
	public function selectColor(){
		$attributeValueDao = new AttributeValueDao();
		
		//get data
		$attributeValueId = $_REQUEST['attributeValueId'];
		$attributeValueInfo = $attributeValueDao->selectByPrimaryKey($attributeValueId);

		return $this->setRender('success');
	}
	
	public function productPopup(){
		//get data
		$action = $_REQUEST['action'];
		$productId = $_REQUEST['productId'];
		
		$productInfo = $this->productDao->selectByPrimaryKey($productId);
		if(!$productInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Product not exist");
			return $this->setRender('home');
		}
		
		switch($action){
			case 'showPopup':
				//view
				$filter = " and c.product_id = " . $productId;
				$params = array(
					'isPopup' => true,
					'productInfo' => $productInfo,
				);
				TemplateHelper::getTemplate('common/product/product.php', $params, $this->pluginCode);
				break;
		}
		
		return $this->setRender('success');
	}

    public function productTag() {
        //get productTagInfo
        if(isset($_REQUEST['productTagId'])){
            $productTagId = $_REQUEST['productTagId'];
            $productTagInfo = $this->productTagDao->selectByPrimaryKey($productTagId);
            if(!$productTagInfo){
                SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Product tag not exist");
                return $this->setRender('home');
            }
        }

        //set filter
        $filter = array();
        $filter['p.status'] = 'A';
        $filter['ptag.product_tag_id'] =  $_REQUEST['productTagId'];

        //limit
        if (empty($_REQUEST['limit'])) {
            $recSize = Registry::getSetting('item_per_page');
        } else {
            $recSize = $_REQUEST['limit'];
        }
        $start = 0;
        $page = 1;
        if (CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } elseif (is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } else {
            $page = 0;
        }
        $count = count(ProductExt::getFilterByTag($filter));
        $paging = new Paging($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;

        //set orderBy
        $orderBy = array('p.product_id' => 'DESC');
        if ($_REQUEST['orderBy']) {
            switch ($_REQUEST['orderBy']) {
                case 'new':
                    $orderBy = array('p.product_id' => 'DESC');
                    break;
                case 'best_selling':
                    $orderBy = array('op.total_quantity' => 'DESC');
                    break;
                case 'discount':
                    $orderBy = array('p.discount' => 'DESC');
                    break;
                case 'price_low_to_high':
                    $orderBy = array('p.price' => 'ASC');
                    break;
                case 'price_high_to_low':
                    $orderBy = array('p.price' => 'DESC');
                    break;
                case 'name_asc':
                    $orderBy = array('p.name' => 'ASC');
                    break;
                case 'name_desc':
                    $orderBy = array('p.name' => 'DESC');
                    break;
                case 'id_asc':
                    $orderBy = array('p.product_id' => 'ASC');
                    break;
                case 'id_desc':
                    $orderBy = array('p.product_id' => 'DESC');
                    break;
            }
        }
        $productList = ProductExt::getFilterByTag($filter, $orderBy, $start, $recSize);

        //send data
        $this->setAttributes(array(
            'pageView' => $paging,
            'productList' => $productList,
        ));

        return $this->setRender('success');
    }
}