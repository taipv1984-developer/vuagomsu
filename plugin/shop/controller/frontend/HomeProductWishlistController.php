<?php
class HomeProductWishlistController extends Controller{
	private $productWishlistDao;
		
	function __construct(){
		$this->productWishlistDao = new ProductWishlistDao();
	}
	
	public function manage(){
		//check customer is login
		if(!Session::isCustomerLogin()){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "You must be logged on to use this functions");
			return $this->setRender('home');
		}
		
		//get $customerId
		$customerId = Session::getCustomerId();
		
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
		$count = count(CustomerExt::getProductWishlist($customerId));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1)* $recSize;
		
		//get $productWishlist of customer logined
		$productWishlist = CustomerExt::getProductWishlist($customerId, $start, $recSize);
		
		$this->setAttributes(array(
			'pageView' => $paging,
			'productWishlist' => $productWishlist
		));
		
		return $this->setRender('success');
	}
	
	public function add(){
		//check customer is login
		if(Session::isCustomerLogin()){
			$customerId = Session::getCustomerId();
			$productId = $_REQUEST['productId'];
			//check product_wishlist exist
			$productWishlistVo = new ProductWishlistVo();
			$productWishlistVo->productId = $productId;
			$productWishlistVo->customerId = $customerId;
			$productWishlistVos = $this->productWishlistDao->selectByFilter($productWishlistVo);
			if($productWishlistVos){
				//update crtDate
				$productWishlistId = $productWishlistVos[0]->productWishlistId;
				$productWishlistVo = new ProductWishlistVo();
				$productWishlistVo->crtDate = DateHelper::getDateTime();
				$this->productWishlistDao->updateByPrimaryKey($productWishlistVo, $productWishlistId);
			}
			else{
				//new $productWishlist
				$productWishlistVo = new ProductWishlistVo();
				$productWishlistVo->productId = $productId;
				$productWishlistVo->customerId = $customerId;
				$productWishlistVo->crtDate = DateHelper::getDateTime();
				$this->productWishlistDao->insert($productWishlistVo);
			}
			$message = array(
				'status' => true,
				'message' => e('Add product wishlist is success')
			);
		}
		else{
			//error
			$message = array(
				'status' => false,
				'message' => e('You must be logged on to use this functions')
			);
		}
		
		//show
		echo json_encode($message);
		return $this->setRender('success');
	}
	
	public function delete(){
		//check customer is login
		if(Session::isCustomerLogin()){
			$customerId = Session::getCustomerId();
			$productId = $_REQUEST['productId'];
			//check product_wishlist exist
			$productWishlistVo = new ProductWishlistVo();
			$productWishlistVo->productId = $productId;
			$productWishlistVo->customerId = $customerId;
			$productWishlistVos = $this->productWishlistDao->selectByFilter($productWishlistVo);
			if($productWishlistVos){
				$productWishlistId = $productWishlistVos[0]->productWishlistId;
				$this->productWishlistDao->deleteByPrimaryKey($productWishlistId);
				
				$message = array(
					'status' => true,
					'message' => e('Delete product wishlist is success')
				);
			}
			else{
				//error
				$message = array(
					'status' => false,
					'message' => e('Delete product wishlist is error')
				);
			}
		}
		else{
			//error
			$message = array(
				'status' => false,
				'message' => e('You must be logged on to use this functions')
			);
		}
		
		//show
		echo json_encode($message);
		return $this->setRender('success');
	}
	 
	public function delete_all(){
		//check customer is login
		if(Session::isCustomerLogin()){
			$customerId = Session::getCustomerId();
			CustomerExt::deleteProductWishlist($customerId);
			
			$message = array(
				'status' => true,
				'message' => e('Delete all product wishlist is success')
			);
		}
		else{
			//error
			$message = array(
				'status' => false,
				'message' => e('You must be logged on to use this functions')
			);
		}
		
		//show
		echo json_encode($message);
		return $this->setRender('success');
	}
}