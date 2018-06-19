<?php
class HomeProductSearchController extends Controller{
    private $productDao;
    private $categoryDao;
    private $productSearchDao;
	
	function __construct() {
        $this->productDao = new ProductDao();
        $this->categoryDao = new CategoryDao();
        $this->productSearchDao = new ProductSearchDao();
	}
	
	private function getFilter(){
		$filter = array();
		$filter['p.status'] = 'A';
	
		//name bo vi tinh theo ca ten cua danh muc nua
//		if($_REQUEST['key']){
//			$key = urldecode($_REQUEST['key']);
//			$filter['p.`name`'] = array('like', '%'.$key.'%');
//		}
		
		//price
		if(!CTTHelper::isEmptyString($_REQUEST['priceFrom'])&& !CTTHelper::isEmptyString($_REQUEST['priceTo'])){
			$filter['p.price'] = array('between', $_REQUEST['priceFrom'], $_REQUEST['priceTo']);
		}
	
		//*** attribute
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
		return $filter;
	}
    public function search(){
        if($_REQUEST['key']){
            $searchKey = urldecode($_REQUEST['key']);
            $productSearchVo = new ProductSearchVo();
            $productSearchVo->key = $searchKey;
            $productSearchVos = $this->productSearchDao->selectByFilter($productSearchVo);
            if($productSearchVos){
                $productSearchInfo = $productSearchVos[0];
                $productSearchVo = new ProductSearchVo();
                $productSearchVo->count = $productSearchInfo->count + 1;
                $productSearchVo->modDate = DateHelper::getDateTime();
                $this->productSearchDao->updateByPrimaryKey($productSearchVo, $productSearchInfo->productSearchId);
            }
            else{
                $productSearchVo = new ProductSearchVo();
                $productSearchVo->key = $searchKey;
                $productSearchVo->count = 1;
                $productSearchVo->status = 'D';
                $productSearchVo->crtDate = DateHelper::getDateTime();
                $productSearchVo->modDate = DateHelper::getDateTime();
                $this->productSearchDao->insert($productSearchVo);
            }

            //get categoryInfo
            if(isset($_REQUEST['categoryId'])){
                $categoryId = $_REQUEST['categoryId'];
                $categoryInfo = $this->categoryDao->selectByPrimaryKey($categoryId);
                if(!$categoryInfo){
                    SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Category not exist");
                    return $this->setRender('home');
                }
            }

            $productVo = new ProductVo();
            $filter = $this->getFilter();

            //get categoryList by name like $searchKey
            $sql = "select * from category where `name` like '%$searchKey%'";
            $query = DataBaseHelper::query($sql);
            if($query){
                $categoryIdList = array();
                foreach ($query as $category){
                    $categoryIdList[] = $category->categoryId;
                }
            }
            else{
                $categoryIdList = array();
            }
            //tim tat cac cac thang con roi nhet vao day
            foreach ($categoryIdList as $k=> $v){
                $child = array();
                CategoryExt::getChild($child, $v);
                foreach ($child as $ck => $cv){
                    if(!in_array($cv, $categoryIdList)) $categoryIdList[] = $cv;
                }
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
            $count = count(ProductExt::getProductSearchFilter($filter, array(), 0 , 0, $searchKey, $categoryIdList));
            $paging = new Paging($page, 5, $recSize, $count);
            $start = ($paging->currentPage - 1)* $recSize;

            //set orderBy
            $orderBy = array('p.product_id' => 'DESC');
            if($_REQUEST['orderBy']){
                switch ($_REQUEST['orderBy']){
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
                }
            }
            $productList = ProductExt::getProductSearchFilter($filter, $orderBy, $start, $recSize, $searchKey, $categoryIdList);
            //add info
            foreach ($productList as $v){
                $v->focusSearchKey = ProductExt::focusSearchKey($searchKey, $v->name);
            }

            //send data
            $this->setAttributes(array(
                'pageView' => $paging,
                'productList' => $productList,
                'productCount' => $count,
                'categoryInfo' => $categoryInfo,
            ));
        }
        return $this->setRender('success');
    }
	
	public function getAutocompleteData() {
		//get alll product
		$productList = $this->productDao->selectAll();
		//get suggestions data
		$suggestions = array();
		foreach ($productList as $v){
			$suggestions[] = array(
				'value' => $v->name,
				'data' => URLHelper::getProductDetailPage($v->productId),
			);
		}
		$data = array(
			'query' => 'Unit',
			'suggestions' => $suggestions
		);

		echo json_encode($data);
		return $this->setRender('success');
	}
}