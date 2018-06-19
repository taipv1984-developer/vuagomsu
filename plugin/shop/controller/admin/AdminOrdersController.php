<?php
class AdminOrdersController extends Controller{
	private $ordersDao;
	public $ordersModel;
	private $pluginCode;
	
	function __construct(){
		$this->ordersDao = new OrdersDao();
		$this->ordersModel = new OrdersModel();
		
		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
	}
	
	/**
	 * OK
	 * getFilter
	 * 
	 * @return array
	 */
	private function getFilter(){
		$filter = array();
		
		//orderId
		if(!CTTHelper::isEmptyString($this->ordersModel->orderId)){
			$filter['o.order_id'] = $this->ordersModel->orderId;
		}
		
		//customerName			like
		if(!CTTHelper::isEmptyString($_REQUEST['ordersModel_customerName'])){
			$filter['cd.first_name'] = array('like', '%'.$_REQUEST['ordersModel_customerName'].'%');
		}
		
		//email			like
		if(!CTTHelper::isEmptyString($_REQUEST['ordersModel_email'])){
			$filter['c.email'] = array('like', '%'.$_REQUEST['ordersModel_email'].'%');
		}
		
		//phone			like
		if(!CTTHelper::isEmptyString($_REQUEST['ordersModel_phone'])){
			$filter['cd.phone'] = array('like', '%'.$_REQUEST['ordersModel_phone'].'%');
		}
		
		//crtDate
		$crtDateFrom = ($_REQUEST ['crtDateFrom'] != '') ? DateHelper::getDateFromDatePicker($_REQUEST ['crtDateFrom']) : '';
		$crtDateTo = ($_REQUEST ['crtDateTo'] != '') ? DateHelper::getDateFromDatePicker($_REQUEST ['crtDateTo']) : '';
		if($crtDateFrom == '' && $crtDateTo != ''){
			$filter['o.crt_date<'] = $crtDateTo;
		}
		else if($crtDateFrom != '' && $crtDateTo == ''){
			$filter['o.crt_date>'] = $crtDateFrom;
		}
		else if($crtDateFrom != '' && $crtDateTo != ''){
			$filter['o.crt_date'] = array('between', $crtDateFrom, $crtDateTo);
		}
		
		//total
		$totalFrom = trim($_REQUEST ['totalFrom']);
		$totalTo = trim($_REQUEST ['totalTo']);
		if($totalFrom == '' && $totalTo != ''){
			$filter['o.total<'] = $totalTo;
		}
		else if($totalFrom != '' && $totalTo == ''){
			$filter['o.total>'] = $totalFrom;
		}
		else if($totalFrom != '' && $totalTo != ''){
			$filter['o.total'] = array('between', $totalFrom, $totalTo);
		}
		
		//orderId
		if(!CTTHelper::isEmptyString($_REQUEST['ordersModel_orderStatusName'])){
			$filter['ostatus.order_status_id'] = $_REQUEST['ordersModel_orderStatusName'];
		}
		
		return $filter;
	}
	
	/**
	 * OK
	 * orders manage 
	 */
	public function manage(){
		//filter
		$filter = $this->getFilter();
		//orderBy
		$orderBy = array('o.order_id' => 'DESC');

        //set $exportLink by $_REQUEST
        $exportLink = "index.php?r=admin/orders/export";
        foreach ($_REQUEST as $k => $v){
            if($k != 'r' & $k != 'page'){
            $exportLink .= "&$k=$v";
            }
        }

		//paging
		if(empty($_REQUEST ['item_per_page'])){
			$recSize = Registry::getSetting('item_per_page');
		}else{
			$recSize = $_REQUEST ['item_per_page'];
		}
		$start = 0;
		if(CTTHelper::isEmptyString($_REQUEST ['page'])){
			$page = 0;
		}elseif(is_numeric($_REQUEST ['page'])){
			$page = $_REQUEST ['page'];
		}else{
			$page = 0;
		}
		$count = count(OrdersExt::getOrdersList($filter));
		$paging = new Paging($page, 5, $recSize, $count);
		$start =($paging->currentPage - 1)* $recSize;
		$ordersVos = OrdersExt::getOrdersList($filter, $orderBy, $start, $recSize);
		
		//add info
		foreach($ordersVos as $v){
			$this->addInfo($v);
		}
		
		//set data
		$paging->items = $ordersVos;
		
		//send data
		$this->setAttributes(array(
			'pageView' => $paging,
			'ordersList' => $ordersVos,
			'shippingMethodArray' => CheckoutExt::getShippingMethodArray(),
			'paymentMethodArray' => CheckoutExt::getPaymentMethodArray(),
			'orderStatusArray' => OrdersExt::getOrderStatusArray(),
            'exportLink' => $exportLink,
		));
		
		//call view
		return $this->setRender('success');
	}
	
	/**
	 * orders edit 
	 */
	public function edit(){
		$orderHistoryDao = new OrderHistoryDao();

		//check ordersId
		$orderId = $_REQUEST ['orderId'];
		$ordersInfo = OrdersExt::getOrdersInfo($orderId);
		if(!$ordersInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Orders #$orderId not exist"));
			return $this->setRender('manage');
		}

		//add info
		$ordersInfo->crtDateInfo = date('d/m/Y H:i', strtotime($ordersInfo->crtDate));
		if($ordersInfo->modBy != ''){
			$modDate = date('d/m/Y H:i', strtotime($ordersInfo->modDate));
			$modByName = AdminExt::getAdminUserName($ordersInfo->modBy);
			$ordersInfo->modInfo = "<u>$modDate</u> by <b>$modByName</b>";
		}
		$shippingAddressInfo = CustomerExt::getCustomerAddressInfo($ordersInfo->shippingAddressId);
		$cityId = $shippingAddressInfo->cityId;
		if($cityId){
			$cityName = AddressHelper::getCityName($cityId);
			$ordersInfo->shippingAddress = $shippingAddressInfo->address ." ($cityName)";
		}
		else{
			$ordersInfo->shippingAddress = $shippingAddressInfo->address;
		}

		//get cart
		$cartInfo = OrdersExt::getCartInfo($orderId);

		//get orderHistory
		$orderHistoryVo = new OrderHistoryVo();
		$orderHistoryVo->orderId = $orderId;
		$orderHistory = $orderHistoryDao->selectByFilter($orderHistoryVo, array('order_history_id' => 'DESC'));
		//add info
		foreach ($orderHistory as $v){
			$v->crtByName = AdminExt::getAdminUserName($v->crtBy);
		}

		//add data
        $shippingInfo = OrdersExt::getShippingInfo($orderId);
		$paymentInfo = OrdersExt::getPaymentInfo($orderId);
		$surchargeList = OrdersExt::getSurchargeList($orderId);

		//send data
		$this->setAttributes(array(
			'ordersInfo' => $ordersInfo,
			'cartInfo' => $cartInfo,
			'shippingInfo' => $shippingInfo,
			'paymentInfo' => $paymentInfo,
			'surchargeList' => $surchargeList,
			'orderHistory' => $orderHistory,
		));
		
		if($_SERVER ['REQUEST_METHOD'] == 'POST'){
		    //updateOrderShipping
            $shippingCost = $_REQUEST['shippingCost'];
            $shippingCost = str_replace(',', '', $shippingCost);
            
            $orderShippingDao = new OrderShippingDao();
            $orderShippingVo = new OrderShippingVo();
            $orderShippingVo->value = $shippingCost;
            $orderShippingDao->updateByPrimaryKey($orderShippingVo, $shippingInfo->orderShippingId);

            //get orders data change
            $ordersVoOld = $this->ordersDao->selectByPrimaryKey($orderId);
            $ordersVoNew = new OrdersVo();
            CTTHelper::copyProperties($this->ordersModel, $ordersVoNew);

            //get orders total
            $subtotal = $ordersVoNew->subtotal;
            $subtotal = str_replace(',', '', $subtotal);
            $ordersVoNew->subtotal = $subtotal;
            $discountValue = $ordersVoNew->discountValue;
            $discountValue = str_replace(',', '', $discountValue);
            $ordersVoNew->discountValue = $discountValue;
            $ordersDiscountValue = OrdersExt::getOrdersDiscountValue($ordersVoNew);
            $total = $subtotal - $ordersDiscountValue + $shippingCost;
            $ordersVoNew->total = $total;

            //check field change value
            $historyContent = array();
            $ordersProperties = get_object_vars($ordersVoNew);
            $labelMap = array(
                'subtotal' => 'Tổng tiền hàng',
                'total' => 'Tổng thanh toán',
                'orderStatusId' => 'Trạng thái',
                'discountType' => 'Loại chiết khầu',
                'discountValue' => 'Giá trị chiết khấu',
            );
            foreach ($ordersProperties as $k => $v){
                if($ordersVoNew->$k){
                    switch ($k){
                        case 'subtotal':
                        case 'total':
                            $orderValueOld = CurrencyExt::format_price($ordersVoOld->$k);
                            $orderValueNew = CurrencyExt::format_price($ordersVoNew->$k);
                            break;
                        case 'orderStatusId':
                            $orderValueOld = OrdersExt::getOrderStatusName($ordersVoOld->$k);
                            $orderValueNew = OrdersExt::getOrderStatusName($ordersVoNew->$k);
                            break;
                        default:
                            $orderValueOld = $ordersVoOld->$k;
                            $orderValueNew = $ordersVoNew->$k;
                            break;
                    }
                    if($orderValueOld != $orderValueNew) {
                        $historyContent[] = "{$labelMap[$k]} ... $orderValueOld -> $orderValueNew";
                    }
                }
            }

            $ordersVoNew->modBy = Session::getAdminId();
            $ordersVoNew->modDate = DateHelper::getDateTime();
            $this->ordersDao->updateByPrimaryKey($ordersVoNew, $orderId);

            //update amount's product if order status is Canceled(4)
            if ($ordersVoNew->orderStatusId == 4) {
                $productDao = new ProductDao();
                $productCart = $cartInfo['productCart'];
                foreach ($productCart as $productCartAttribute) {
                    foreach ($productCartAttribute as $v) {
                        $productId = $v['productId'];
                        $productInfo = $productDao->selectByPrimaryKey($productId);
                        $amount = $productInfo->amount + $v['quantity'];

                        //update amount's product
                        $productVo = new ProductVo();
                        $productVo->amount = $amount;
                        $productDao->updateByPrimaryKey($productVo, $productId);
                    }
                }
            }

            //sendMail
            //thoi tam thoi de lai phai tao 1 email template khac co co them ca gia van chuyen va chiết khau nua nhu trong order edit
			if(true){
//                $customerInfo = $ordersInfo->customerInfo;
//                $tos = array($customerInfo->email);
//                $emailData = array(
//                    'ordersId' => "#$orderId",
//                    'name' => CustomerExt::getFullName($customerInfo),
//                    'address' => $ordersInfo->shippingAddress,
//                    'phone' => $customerInfo->phone,
//                    'crtDate' => date('d/m/Y H:m:s', strtotime($ordersInfo->crtDate)),
//                    'ordersInfo' => OrdersExt::getEmailContent($ordersInfo, $cartInfo),
//                );
//                EmailHelper::sendMail($tos, 'order_change', $emailData);
			}
			
			//insert order_history
			$comment = trim($_REQUEST['comment']);
			if(!empty($historyContent) || $comment != ''){
				$orderHistoryVo = new OrderHistoryVo();
				$orderHistoryVo->orderId = $orderId;
                $orderHistoryVo->content = join($historyContent, '<br>');
				$orderHistoryVo->comment = $comment;
				$orderHistoryVo->crtBy = Session::getAdminId();
				$orderHistoryVo->crtDate = DateHelper::getDateTime();
				$orderHistoryDao->insert($orderHistoryVo);
			}
			
			//message
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e("Orders update success"));
			
			//view
			return $this->setRender('manage');
		}
		return $this->setRender('success');
	}
	
	/**
	 * OK
	 * orders delete
	 */
	public function delete(){
		$orderId = $_REQUEST['orderId'];
		OrdersExt::deleteOrders($orderId);
		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e("Orders delete success"));
		return $this->setRender('success');
	}
	
	private function addInfo($v){
		//ordersDate
		$date = date('d/m/Y', strtotime($v->crtDate));
		$time = date('H:i:s', strtotime($v->crtDate));
		$v->ordersDateTime = "<b>$date</b><br><span>$time</span>";
		
		//totalFormat
		$v->totalFormat = CurrencyExt::format_price($v->total);

        //add info
        if($v->customerId){
            $customerInfo = CustomerExt::getCustomerInfo($v->customerId);
        }
        else{
            $customerInfo = CustomerExt::getCustomerInfo($v->guestId);
        }
        if(!$customerInfo){
            //get $customerInfo from orderData table
            $orderData = OrdersExt::getOrderData($v->orderId);
            $customerInfo = $orderData->customerInfo;
            $customerInfo->isDel = true;
        }
        else{
            $customerInfo->isDel = false;
        }
        $v->customerInfo = $customerInfo;

        $customerName = CustomerExt::getFullName($customerInfo);
        $v->customerName = ($customerInfo->isDel) ? "<span class='line-through'>$customerName</span>" : $customerName;
        $v->email = ($customerInfo->isDel) ? "<span class='line-through'>$customerInfo->email</span>" : $customerInfo->email;
        $v->phone = ($customerInfo->isDel) ? "<span class='line-through'>$customerInfo->phone</span>" : $customerInfo->phone;
    }

	public function export(){
    	/** Error reporting */
//    	error_reporting(E_ALL);
    	
    	/** Include path **/
    	$include_path = LIBRARY_PATH.'PHPExcel/Classes/';
    	ini_set('include_path', $include_path);
    	
    	/** PHPExcel */
    	include 'PHPExcel.php';
    	/** PHPExcel_Writer_Excel2007 */
    	include 'PHPExcel/Writer/Excel2007.php';
    	
    	// Create new PHPExcel object
    	$objPHPExcel = new PHPExcel();

        //exportOrdersList
        $this->exportOrdersList($objPHPExcel);

        //exportOrdersDetailList
        $this->exportOrdersDetailList($objPHPExcel);
    	
    	//return first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	
    	// Set properties
    	$objPHPExcel->getProperties()->setCreator("TaiPV");
    	$objPHPExcel->getProperties()->setLastModifiedBy("TaiPV");
    	$objPHPExcel->getProperties()->setTitle("Export orders for ".Registry::getSetting('site_name'));
    	$objPHPExcel->getProperties()->setSubject("Export orders for ".Registry::getSetting('site_name'));
    	$objPHPExcel->getProperties()->setDescription("TaiPV");

        //set file name
        $date = date('d-m-Y');
        $fileName = "DANH-SACH-DON-HANG-[$date].xlsx";
        $filePath = "upload/report/$fileName";

        //error on server
//    	// Redirect output to a client's web browser (Excel2007)
//    	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//    	header("Content-Disposition: attachment;filename=$fileName");
//    	header('Cache-Control: max-age=0');
//    	// If you're serving to IE 9, then the following may be needed
//    	header('Cache-Control: max-age=1');
//    	// If you're serving to IE over SSL, then the following may be needed
//    	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//    	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
//    	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//    	header ('Pragma: public'); // HTTP/1.0
//    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//    	$objWriter->save('php://output');
//    	exit;

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', $filePath));
        header("location: $filePath");
    	
    	return $this->setRender('success');
    }

    private function exportOrdersList($objPHPExcel){
        /**********
         * GET DATA
         **********/
        $orderBy = array('o.order_id' => 'DESC');
        $filter = $this->getFilter();
        $count = count(OrdersExt::getOrdersList($filter));
        $ordersList = OrdersExt::getOrdersList($filter, $orderBy, 0, $count);
        $ordersExportTotal = 0;
        foreach($ordersList as $v){
            //address
            $shippingAddressInfo = CustomerExt::getCustomerAddressInfo($v->shippingAddressId);
            $cityId = $shippingAddressInfo->cityId;
            if($cityId){
                $cityName = AddressHelper::getCityName($cityId);
                $v->shippingAddress = $shippingAddressInfo->address ." ($cityName)";
            }
            else{
                $v->shippingAddress = $shippingAddressInfo->address;
            }
            $billingAddressInfo = CustomerExt::getCustomerAddressInfo($v->billingAddressId);
            $v->billingAddress = $billingAddressInfo->address;

//            //totalFormat
//            $v->totalFormat = CurrencyExt::format_price($v->total);
//            $v->totalWeightFormat = ProductExt::getProductWeightFormat($v->totalWeight);

            if($v->customerId){
                $customerInfo = CustomerExt::getCustomerInfo($v->customerId);
            }
            else{
                $customerInfo = CustomerExt::getCustomerInfo($v->guestId);
            }
            if(!$customerInfo){
                //get $customerInfo from orderData table
                $orderData = OrdersExt::getOrderData($v->orderId);
                $customerInfo = $orderData->customerInfo;
                $customerInfo->isDel = true;
            }
            else{
                $customerInfo->isDel = false;
            }
            $v->customerName = CustomerExt::getFullName($customerInfo);
            $v->email =  $customerInfo->email;
            $v->phone = $customerInfo->phone;

            $ordersExportTotal += $v->total;
        }

        //set $column_map
        $column_map = array(
            array('title' => 'ID', 'key' => 'orderId', 'width' => 10, 'style' => array(
                'font' => array(
                    'bold'  => true
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )),
            array('title' => 'Tên khách hàng', 'key' => 'customerName', 'width' => 25, 'style' => array()),
            array('title' => 'Email', 'key' => 'email', 'width' => 30, 'style' => array()),
            array('title' => 'Số điện thoại', 'key' => 'phone', 'width' => 20, 'style' => array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            )),
            array('title' => 'Địa chỉ', 'key' => 'shippingAddress', 'width' => 35, 'style' => array()),
            array('title' => 'Trạng thái', 'key' => 'orderStatusName', 'width' => 15, 'style' => array()),
            array('title' => 'Ngày tạo', 'key' => 'crtDate', 'width' => 20, 'style' => array()),
            array('title' => 'Giá tiền', 'key' => 'total', 'width' => 15,
                'style' => array('font' => array(
                    'bold'  => true,
//                    'color' => array('rgb' => 'FF0000')
                ))),
        );

        /*****************************************
         * Sheet 1
         *****************************************/
        $iSheet = 0;
        //Active sheet
        $objPHPExcel->setActiveSheetIndex($iSheet);
        //sheet title
        $objPHPExcel->getActiveSheet()->setTitle("Danh sách đơn hàng");

        //$irow start
        $irow = 0;

        //Set width column
        $icol = 65; //A
        foreach ($column_map as $v){
            $col = chr($icol);
            $cell = $col.$irow;
            $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth($v['width']);
            $icol++;
        }

        //set header
        $irow = 1;
        $cell = "A$irow";
        $objPHPExcel->getActiveSheet()->setCellValue($cell, Registry::getSetting('sologan'));
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);

        $irow = 2;
        $cell = "A$irow";
        $colLast = chr(65 + count($column_map) - 1);
        $mergeCells = "A$irow:$colLast$irow";
        $objPHPExcel->getActiveSheet()->mergeCells($mergeCells);
        $objPHPExcel->getActiveSheet()->getRowDimension($irow)->setRowHeight(32);
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true)->setSize(20);
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($mergeCells)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->setCellValue($cell, 'DANH SÁCH ĐƠN HÀNG');

        //set export date
        $irow++;
        $cell = "A$irow";
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Ngày xuất dữ liệu');
        $cell = "c$irow";
        $objPHPExcel->getActiveSheet()->setCellValue($cell, date('d/m/Y H:m:s'));

        //set total
        $irow++;
        $cell = "A$irow";
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Tổng số đơn hàng');
        $cell = "c$irow";
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue($cell, count($ordersList));

        //write filter
        $filterExport = array();
        $filterKey = "";
        $filterValue = "";
        foreach ($filter as $k => $v){
            switch ($k){
                case 'o.order_id':
                    $filterKey = "ID";
                    $filterValue = "bằng #$v";
                    break;
                case 'cd.first_name':
                    $filterKey = 'Tên khách hàng';
                    $filterValue = "giống ".str_replace('%', '', $v[1]);
                    break;
                case 'c.email':
                    $filterKey = 'Email khách hàng';
                    $filterValue = "giống ".str_replace('%', '', $v[1]);
                    break;
                case 'cd.phone':
                    $filterKey = 'Số điện thoại';
                    $filterValue = "giống ".str_replace('%', '', $v[1]);
                    break;
                case 'o.crt_date<':
                    $filterKey = 'Ngày tạo đơn hàng';
                    $crtDateTo = date('d/m/Y', strtotime($v));
                    $filterValue = "đến $crtDateTo";
                    break;
                case 'o.crt_date>':
                    $filterKey = 'Ngày tạo đơn hàng';
                    $crtDateFrom = date('d/m/Y', strtotime($v));
                    $filterValue = "Từ $crtDateFrom";
                    break;
                case 'o.crt_date':
                    $filterKey = 'Ngày tạo đơn hàng';
                    $crtDateFrom = date('d/m/Y', strtotime($v[1]));
                    $crtDateTo = date('d/m/Y', strtotime($v[2]));
                    $filterValue = "Từ $crtDateFrom đến $crtDateTo";
                    break;
                case 'o.total<':
                    $filterKey = 'Thành tiền';
                    $totalTo = CurrencyExt::format_price($v);
                    $filterValue = "nhỏ hơn $totalTo";
                    break;
                case 'o.total>':
                    $filterKey = 'Thành tiền';
                    $totalFrom = CurrencyExt::format_price($v);
                    $filterValue = "lớn hơn $totalFrom";
                    break;
                case 'o.total':
                    $filterKey = 'Thành tiền';
                    $totalFrom = CurrencyExt::format_price($v[1]);
                    $totalTo = CurrencyExt::format_price($v[2]);
                    $filterValue = "Từ $totalFrom đến $totalTo";
                    break;
                case 'ostatus.order_status_id':
                    $filterKey = 'Trạng thái đơn hàng';
                    $filterValue = OrdersExt::getOrderStatusName($v);
                    break;
                default:
                    break;
            }
            $filterExport[] = array(
                'filterKey' => $filterKey,
                'filterValue' => $filterValue
            );
        }
//        var_dump($filterExport); die();
        $irow++;
        $cell = "A$irow";
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Tìm kiếm theo');

        //set total
        if(empty($filterExport)){
            $irow++;
            $cell = "A$irow";
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Tất cả đơn hàng');
        }
        else {
            foreach ($filterExport as $v) {
                $irow++;
                $cell = "B$irow";
                $objPHPExcel->getActiveSheet()->setCellValue($cell, $v['filterKey']);
                $cell = "C$irow";
                $objPHPExcel->getActiveSheet()->setCellValue($cell, $v['filterValue']);
            }
        }

        //Set column title
        $irow++;
        $irow++;	//row 3
        $icol = 65; //A
        foreach ($column_map as $v){
            $col = chr($icol);
            $cell = $col.$irow;
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getRowDimension($irow)->setRowHeight(25);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => 'f7f7f7'
                )
            ));
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $v['title']);
            $icol++;
        }

        //fill data
        foreach ($ordersList as $v){
            $irow ++;
            $icol = 65; //A
            foreach ($column_map as $vMap){
                $col = chr($icol);
                $cell = $col.$irow;

                //style
                $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($vMap['style']);

                //value
                $objPHPExcel->getActiveSheet()->setCellValue($cell, $v->{$vMap['key']});
                $icol++;
            }
        }

        //$ordersExportTotal
        $irow ++;
        $irow ++;
        $cell = "G$irow";
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue($cell, "Tổng tiền");
        $cell = "H$irow";
        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray(
            array('style' =>
                array('font' => array(
                    'bold'  => true,
//                    'color' => array('rgb' => 'FF0000')
                    )
                )
            )
        );
        $objPHPExcel->getActiveSheet()->setCellValue($cell, $ordersExportTotal);

        //add sheet
        $objPHPExcel->createSheet(NULL, $iSheet);
    }

    private function exportOrdersDetailList($objPHPExcel){
        /**********
         * GET DATA
         **********/
        //filter
        $filter = $this->getFilter();
        //orderBy
        $orderBy = array('o.order_id' => 'DESC');
        $count = count(OrdersExt::getOrdersList($filter));
        $ordersList = OrdersExt::getOrdersList($filter, $orderBy, 0, $count);

        $orderStatusArray = OrdersExt::getOrderStatusArray();
        $iSheet = 1;
        foreach ($ordersList as $orders) {
            $orderId = $orders->orderId;
            $ordersInfo = OrdersExt::getOrdersInfo($orderId);
//            var_dump($ordersInfo); die();
            $shippingInfo = OrdersExt::getShippingInfo($orderId);
            $customerInfo = $ordersInfo->customerInfo;
            $customerAddressList = CustomerExt::getCustomerAddressList($customerInfo->customerId);
            $customerAddress = '';
            if($customerAddressList){
//                $customerAddressView = array();
                $iAddress = 0;
                foreach ($customerAddressList as $v){
                    $iAddress++;
                    if ($iAddress == 1){
                        $customerAddress = $v->address;
                    }
//                    $customerAddressView[] = $customerAddress->address;
                }
//                $customerAddress = join(' & ',$customerAddressView);
            }

            $shippingAddressInfo = CustomerExt::getCustomerAddressInfo($ordersInfo->shippingAddressId);
            $cityId = $shippingAddressInfo->cityId;
            if($cityId){
                $cityName = AddressHelper::getCityName($cityId);
                $ordersInfo->shippingAddress = $shippingAddressInfo->address ." ($cityName)";
            }
            else{
                $ordersInfo->shippingAddress = $shippingAddressInfo->address;
            }
            $cartInfo = OrdersExt::getCartInfo($orderId);
            $productCart = $cartInfo['productCart'];
            $productCartList = array();
            foreach ($productCart as $productCartAttribute){
                foreach ($productCartAttribute as $v){
                    $productCartList[] = $v;
                }
            }

            $stt = 0;
            foreach ($productCartList as $k => $v) {
                //stt
                $stt++;
                $productCartList[$k]['stt'] = $stt;
//                //price
//                $productCartList[$k]['price'] = CurrencyExt::format_price($v['price']);
//                //priceTotal
//                $productCartList[$k]['priceTotal'] = CurrencyExt::format_price($v['priceTotal']);
            }
//            var_dump($productCartList); die();

            //set $column_map
            $column_map = array(
                array('title' => 'STT', 'key' => 'stt', 'width' => 10,
                    'style' => array(
                        'font' => array(
                            'bold' => true
                        ),
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    )
                ),
                array('title' => 'Mã SP', 'key' => 'productCode', 'width' => 20, 'style' => array()),
                array('title' => 'Tên hàng hóa', 'key' => 'productName', 'width' => 30, 'style' => array()),
                array('title' => 'Đơn vị tính', 'key' => 'unit', 'width' => 16, 'style' => array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    )
                )),
                array('title' => 'Số lượng', 'key' => 'quantity', 'width' => 10, 'style' => array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    )
                )),
                array('title' => 'Đơn giá', 'key' => 'price', 'width' => 16, 'style' => array()),
                array('title' => 'Thành tiền', 'key' => 'priceTotal', 'width' => 16, 'style' => array()),
            );

            /*****************************************
             * Sheet 1
             *****************************************/
            //Active sheet
            $objPHPExcel->setActiveSheetIndex($iSheet);
            //sheet title
            $objPHPExcel->getActiveSheet()->setTitle("Đơn hàng #$orderId");

            //$irow start
            $irow = 0;

            //Set width column
            $icol = 65; //A
            foreach ($column_map as $v) {
                $col = chr($icol);
                $cell = $col . $irow;
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth($v['width']);
                $icol++;
            }

            //set header
            $irow = 1;
            $cell = "A$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, Registry::getSetting('sologan'));
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);

            $irow = 2;
            $cell = "A$irow";
            $colLast = chr(65 + count($column_map) - 1);
            $mergeCells = "A$irow:$colLast$irow";
            $objPHPExcel->getActiveSheet()->mergeCells($mergeCells);
            $objPHPExcel->getActiveSheet()->getRowDimension($irow)->setRowHeight(32);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true)->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($mergeCells)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'HÓA ĐƠN BÁN HÀNG');

            //customer info
            $irow = 3;
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Thông tin khách hàng');
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Thông tin hóa đơn');
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);

            $irow = 4;
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Tên Khách hàng:');
            $cell = "C$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, CustomerExt::getFullName($customerInfo));
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Số hóa đơn:');
            $cell = "E$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, "#".$ordersInfo->orderId);

            $irow = 5;
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Địa chỉ:');
            $cell = "C$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $customerAddress);
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Ngày tạo:');
            $cell = "E$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, date('d/m/Y H:m:s', strtotime($ordersInfo->crtDate)));

            $irow = 6;
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Điện thoại:');
            $cell = "C$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $customerInfo->phone);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Địa chỉ giao hàng:');
            $cell = "E$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $ordersInfo->shippingAddress);

            $irow = 7;
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Email:');
            $cell = "C$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $customerInfo->email);
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Trạng thái:');
            $cell = "E$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $orderStatusArray[$ordersInfo->orderStatusId]);

            $irow = 8;
            $cell = "B$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Ghi chú (khách hàng):');
            $cell = "C$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $ordersInfo->note);

            //Set column title
            $irow = 10;
            $icol = 65; //A
            foreach ($column_map as $v) {
                $col = chr($icol);
                $cell = $col . $irow;
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getRowDimension($irow)->setRowHeight(25);
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'startcolor' => array(
                        'rgb' => 'f7f7f7'
                    )
                ));
                $objPHPExcel->getActiveSheet()->setCellValue($cell, $v['title']);
                $icol++;
            }

            //fill data
//            var_dump($productCartList); die();
            foreach ($productCartList as $v){
                $irow ++;
                $icol = 65; //A
                foreach ($column_map as $vMap){
                    $col = chr($icol);
                    $cell = $col.$irow;
                    $key = $vMap['key'];

                    //style
                    $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($vMap['style']);

                    //value
                    //$objPHPExcel->getActiveSheet()->setCellValue($cell, $v->{$vMap['key']});
                    $objPHPExcel->getActiveSheet()->setCellValue($cell, $v[$key]);
                    $icol++;
                }
            }

            //summary orders
            $irow ++;
            $irow ++;
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Tổng cộng');
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            $cell = "G$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $ordersInfo->subtotal);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);

            $irow ++;
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Chiết khấu');
            $cell = "F$irow";
            $discountType = $ordersInfo->discountType;
            $discountValue = $ordersInfo->discountValue;
            $discountValue = ($discountType == 'percent') ? "$discountValue %" : "$discountValue đ";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $discountValue);
            $cell = "G$irow";
            $ordersDiscountValue = OrdersExt::getOrdersDiscountValue($ordersInfo);
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $ordersDiscountValue);

            $irow ++;
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Phí giao hàng');
            $cell = "G$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $shippingInfo->value);

            $irow ++;
            $cell = "D$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, 'Tổng thanh toán');
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            $cell = "G$irow";
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $ordersInfo->total);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);

            //add sheet
            $objPHPExcel->createSheet(NULL, $iSheet);
            $iSheet++;
        }
    }
}