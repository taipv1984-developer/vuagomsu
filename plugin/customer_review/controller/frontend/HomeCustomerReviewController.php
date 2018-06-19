<?php
class HomeCustomerReviewController extends Controller {
	private $customerReviewDao;
	private $pluginCode;
	
	function __construct() {
		$this->customerReviewDao = new CustomerReviewDao();
	
		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
	}
	
	public function index() {
		$customerReviewVo = new CustomerReviewVo();
		$customerReviewVo->status = 'A';
		
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
		$count = count($this->customerReviewDao->selectByFilter($customerReviewVo));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1)* $recSize;

		//set orderBy
		$orderBy = array('customer_review_id' => 'DESC');
		$customerReviewList = $this->customerReviewDao->selectByFilter($customerReviewVo, $orderBy, $start, $recSize);
		
		//send data
		$this->setAttributes(array(
			'pageView' => $paging,
			'customerReviewList' => $customerReviewList,
		));
		
		return $this->setRender('success');
	}
}