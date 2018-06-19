<?php
class AdminCustomerController extends Controller {
	private $customerDao;
    public $customerModel;
    public $customerDetailDao;
    private $customerAddressDao;
    
    function __construct(){
    	$this->customerDao = new CustomerDao();
    	$this->customerModel = new CustomerModel();
    	$this->customerDetailDao = new CustomerDetailDao();
    	$this->customerAddressDao = new CustomerAddressDao();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	$customer_support_username = Registry::getSetting('customer_support_username');
    	if($customer_support_username){
	    	//the username should not duplicate in the table 
	    	$customerVo = new CustomerVo();
	    	$customerVo->username = $addVo->username;
	    	$customerVos = $this->customerDao->selectByFilter($customerVo);
	    	if($customerVos){
				$validate["username"] = e("Customer username is exist");
	    	}
    	}
    	
    	//the email should not duplicate in the table
    	$customerVo = new CustomerVo();
    	$customerVo->email = $addVo->email;
    	$customerVos = $this->customerDao->selectByFilter($customerVo);
    	if($customerVos){
    		$validate["email"] = e("Customer email is exist");
    	}
    	
    	//check password and confirm_password
    	$password = $_REQUEST['password'];
    	$confirm_password = $_REQUEST['confirm_password'];
    	if($password != $confirm_password){
    		$validate["password"] = e("Password and confirm passwordemail is not match");
    		$validate["confirm_password"] = e("Password and confirm passwordemail is not match");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//check new_password and confirm_password
    	$new_password = $_REQUEST['new_password'];
    	$confirm_password = $_REQUEST['confirm_password'];
    	if($new_password != $confirm_password){
    		$validate["new_password"] = e("Password and confirm passwordemail is not match");
    		$validate["confirm_password"] = e("Password and confirm passwordemail is not match");
    	}
    	
    	//check $currentPassword
    	$current_password = trim($_REQUEST['current_password']);
    	if($current_password != ''){
	    	if(!$this->_checkCurrentPassword($editVo->customerId)){
	    		$validate["current_password"] = e("Current password incorect");
	    	}
	    	else{
	    		if($new_password == '' ){
	    			$validate["new_password"] = e("New password not empty");
	    		}
	    		if($confirm_password == ''){
	    			$validate["confirm_password"] = e("Confirm password not empty");
	    		}
	    	}
    	}
    	return $validate;
    }
     
    private function _checkCurrentPassword($customerId){
    	$current_password = $_REQUEST['current_password'];
    	$customerInfo = $this->customerDao->selectByPrimaryKey($customerId);
    	return ($customerInfo->password == md5($current_password)) ? true : false;
    }

    private function _add_info($customerVo){
    	$customerVo->name = CustomerExt::getFullName($customerVo);
    }
    
    private function getFilter(){	
    	$filter = array();
    	
    	//role_id (for guest role_id=1)
    	$filter['c.role_id'] = 2;
    	
    	//customerId
    	if(!CTTHelper::isEmptyString($_REQUEST['customerId'])){
    		$filter['c.customer_id'] = $_REQUEST['customerId'];
    	}
    	//username			like
    	if(!CTTHelper::isEmptyString($_REQUEST['username'])){
    		$filter['c.username'] = array('like', '%'.$_REQUEST['username'].'%');
    	}
    	//email			like
    	if(!CTTHelper::isEmptyString($_REQUEST['email'])){
    		$filter['c.email'] = array('like', '%'.$_REQUEST['email'].'%');
    	}
    	//phone		like
    	if(!CTTHelper::isEmptyString($_REQUEST['phone'])){
    		$filter['cd.phone'] = array('like', '%'.$_REQUEST['phone'].'%');
    	}
        //oauthProvider
        if(!CTTHelper::isEmptyString($_REQUEST['oauthProvider'])){
            $filter['c.oauth_provider'] = $_REQUEST['oauthProvider'];
        }
    	//status
    	if(!CTTHelper::isEmptyString($_REQUEST['status'])){
    		$filter['c.status'] = $_REQUEST['status'];
    	}
    	return $filter;
    }
    
	public function manage(){
        $customerVo = new CustomerVo();
        
        //filter
        $filter = $this->getFilter();
        
        //orderBy
        $orderBy = array('c.customer_id' => 'DESC');
        
        //paging
        if(empty($_REQUEST['item_per_page'])) {
            $recSize = Registry::getSetting('item_per_page');
        } 
        else {
            $recSize = $_REQUEST['item_per_page'];
        }
        $start = 0;
        if(CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } 
        elseif(is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } 
        else {
            $page = 0;
        }
        $count = count(CustomerExt::getCustomerList($filter));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $customerVos = CustomerExt::getCustomerList($filter, $orderBy, $start, $recSize);
        
        //add info
        foreach($customerVos as $customerVo){
        	$this->_add_info($customerVo);
        }
        
        //set data
        $paging->items = $customerVos;	
        
        //send data
        $this->setAttributes(array(
        	'pageView' => $paging
        ));
        
        //call view
        return $this->setRender('success');
    }
    
    public function manage_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'change_status_ajax':
    			$customerVo = new CustomerVo();
    			$customerVo->status = $_REQUEST['value'];
    			$this->customerDao->updateByPrimaryKey($customerVo, $_REQUEST['id']);
    			break;
    		default:
    			break;
    	}
    	
    	return $this->setRender('success');
    }
    
    public function validate_ajax(){
    	$action = $_REQUEST['action'];
    	switch($action){
    		case 'add':
    			$customerVo = new CustomerVo();
    			$customerVo->username = trim($_REQUEST['username']);
    			$customerVo->email = trim($_REQUEST['email']);
    			$validate = $this->_validate_add($customerVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$customerVo = new CustomerVo();
    			$customerVo->username = trim($_REQUEST['username']);
    			$customerVo->email = trim($_REQUEST['email']);
    			$customerVo->customerId = $_REQUEST['customerId'];
    			$validate = $this->_validate_edit($customerVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	return $this->setRender('success');
    }
    
    private function _check_exist($customerInfo){
    	if(!$customerInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Customer not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($customerInfo){
    	return true;
    }
    
    public function add(){
    	if($_SERVER['REQUEST_METHOD'] == 'POST') {
    		$customer_support_username = Registry::getSetting('customer_support_username');
    		
        	//add customer
        	$customerVo = new CustomerVo();
        	$customerVo->roleId = 2;	//hardcode
        	if($customer_support_username){
        		$customerVo->username = $_REQUEST['username'];
        	}
        	$customerVo->email = $_REQUEST['email'];
        	$customerVo->password = md5($_REQUEST['password']);
        	$customerVo->status = $_REQUEST['status'];
        	$customerVo->activeCode = '';
        	$customerVo->resetPasswordCode = '';
        	$customerVo->crtBy = Session::getAdminId();
        	$customerVo->crtDate = DateHelper::getDateTime();
        	$customerId = $this->customerDao->insert($customerVo);
        	
        	//add customer_detail
        	$customerDetailVo = new CustomerDetailVo();
        	$customerDetailVo->customerId = $customerId;
        	$customerDetailVo->addressId = 0;
        	$customerDetailVo->firstName = $_REQUEST['first_name'];
        	$customerDetailVo->lastName = $_REQUEST['last_name'];
        	$customerDetailVo->phone = $_REQUEST['phone'];
        	$customerDetailVo->birthday = $_REQUEST['birthday'];
//         	$customerDetailVo->gender = $_REQUEST['gender'];
        	$customerDetailVo->receiveEmail = $_REQUEST['receive_email'];
        	$customerDetailVo->image = str_replace(URLHelper::getBaseUrl()."/", '', $_REQUEST['image']);
        	$this->customerDetailDao->insert($customerDetailVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Customer add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array());
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $customerId = $_REQUEST['customerId'];
        $customerInfo = $this->customerDao->selectByPrimaryKey($customerId);
        
        if(!($this->_check_exist($customerInfo) & $this->_check_permission($customerInfo))){
			return $this->setRender('manage');
		}
        
		//get customerDetailInfo
		$customerDetailVo = new CustomerDetailVo();
		$customerDetailVo->customerId = $customerId;
		$customerDetailVos = $this->customerDetailDao->selectByFilter($customerDetailVo);
		if($customerDetailVos){
			$customerDetailInfo = $customerDetailVos[0];
		}
		else{
			//create new customerDetail
			$customerDetailInfo = $customerDetailVo;
			$customerDetailInfo->customerDetailId = $this->customerDetailDao->insert($customerDetailVo);
		}
		
		//add data
		$customerDetailInfo->birthday = date('d/m/Y', strtotime($customerDetailInfo->birthday));
		
		//get data
		$customerAddressList = CustomerExt::getCustomerAddressList($customerId);
		
        //send data
        $this->setAttributes(array(
        	'customerInfo' => $customerInfo,
        	'customerDetailInfo' => $customerDetailInfo,
        	'customerAddressList' => $customerAddressList,
        ));
        
    	if($_SERVER['REQUEST_METHOD'] === 'POST'){
    		$customerVo = new CustomerVo();
    		//password
    		$currentPassword 	= trim($_REQUEST['current_password']);
    		$newPassword 		= trim($_REQUEST['new_password']);
    		$confirmPassword 	= trim($_REQUEST['confirm_password']);
    		if($currentPassword != ''){
    			if(!$this->_checkCurrentPassword($customerId)){
    				SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Current password incorect'));
    				return $this->setRender('manage');
    			}
    			$customerVo->password = md5($newPassword);
    		}
    		//status
    		$customerVo->status = $_REQUEST['status'];
    		//more
    		$customerVo->modBy = Session::getAdminId();
    		$customerVo->modDate = DateHelper::getDateTime();
    		//update customer
    		$this->customerDao->updateByPrimaryKey($customerVo, $customerId);
    		
    		//update customer_detail
    		$customerDetailVo = new CustomerDetailVo();
    		$customerDetailVo->customerId = $customerId;
    		$customerDetailVo->firstName = $_REQUEST['first_name'];
        	$customerDetailVo->lastName = $_REQUEST['last_name'];
    		$customerDetailVo->phone = $_REQUEST['phone'];
    		$customerDetailVo->birthday = $_REQUEST['birthday'];
    		$customerDetailVo->gender = $_REQUEST['gender'];
    		$customerDetailVo->receiveEmail = $_REQUEST['receive_email'];
    		$customerDetailVo->image = str_replace(URLHelper::getBaseUrl()."/", '', $_REQUEST['image']);
    		$this->customerDetailDao->updateByPrimaryKey($customerDetailVo, $customerDetailInfo->customerDetailId);
    		
    		//message
    		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Update successful'));
    		return $this->setRender('manage');
    	}
        
        return $this->setRender('success');
    }
    
    public function delete() {
    	if(isset($_REQUEST['customerId'])){
			$customerId = $_REQUEST['customerId'];
			//check later
			//...
            CustomerExt::deleteCustomer($customerId);
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
    
    public function export(){
    	/** Error reporting */
    	error_reporting(E_ALL);
    	 
    	/** Include path **/
    	$include_path = LIBRARY_PATH.'PHPExcel/Classes/';
    	ini_set('include_path', $include_path);
    	 
    	/** PHPExcel */
    	include 'PHPExcel.php';
    	/** PHPExcel_Writer_Excel2007 */
    	include 'PHPExcel/Writer/Excel2007.php';
    	 
    	// Create new PHPExcel object
    	$objPHPExcel = new PHPExcel();
    	 
    	/**********
    	 * GET DATA
    	**********/
    	$orderBy = array('c.customer_id' => 'DESC');
    	$filter = array();
    	$filter['c.role_id'] = 2;
    	$customerList = CustomerExt::getCustomerList($filter, $orderBy, 0, 0);
    	foreach($customerList as $v){
    		//customerName
    		$customerId = $v->customerId;
    		$v->customerName = $v->firstName.' '.$v->lastName;

            $customerAddressList = array();
                foreach (CustomerExt::getCustomerAddressList($customerId) as $customerAddress){
                    $customerAddressList[] = $customerAddress->address;
                }
            $v->customerAddressList = JOIN(" & ", $customerAddressList);

    		//statusName
    		$v->statusName = ArrayHelper::getAll()[$v->status];

    		//crtDate
    		$v->crtDate = date(DateHelper::getDateFormat(), strtotime($v->crtDate));
    	}
//    	var_dump($customerList); die();

    	//set $column_map
		$column_map = array(
			array('title' => 'ID', 'key' => 'customerId', 'width' => 10, 'style' => array(
                'font' => array(
                    'bold'  => true
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            )),
			array('title' => 'Tên khách hàng', 'key' => 'customerName', 'width' => 20, 'style' => array()),
			array('title' => 'Email', 'key' => 'email', 'width' => 30, 'style' => array()),
			array('title' => 'Số điện thoại', 'key' => 'phone', 'width' => 15, 'style' => array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            )),
            array('title' => 'Địa chỉ', 'key' => 'customerAddressList', 'width' => 40, 'style' => array()),
			array('title' => 'Ngày sinh', 'key' => 'birthday', 'width' => 15, 'style' => array()),
            array('title' => 'Loại tài khoản', 'key' => 'oauthProvider', 'width' => 15, 'style' => array()),
			array('title' => 'Ngày tạo', 'key' => 'crtDate', 'width' => 15, 'style' => array()),
		);

    	/*****************************************
    	 * Sheet 1
    	*****************************************/
    	$iSheet=0;
    	//Active sheet
    	$objPHPExcel->setActiveSheetIndex($iSheet);
    	//sheet title
    	$objPHPExcel->getActiveSheet()->setTitle("Danh sách khách hàng");

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
        $objPHPExcel->getActiveSheet()->setCellValue($cell, 'DANH SÁCH KHÁCH HÀNG');

    	//set total
    	$irow++;	//row 2
    	$cell = "A$irow";
    	$objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
    	$objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objPHPExcel->getActiveSheet()->SetCellValue($cell, 'Tổng số');
    	$cell = "B$irow";
    	$objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
    	$objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objPHPExcel->getActiveSheet()->SetCellValue($cell, count($customerList));

    	//Set column title
    	$irow++;
        $irow++;
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
    		$objPHPExcel->getActiveSheet()->SetCellValue($cell, $v['title']);
    		$icol++;
    	}

    	//fill data
    	foreach ($customerList as $v){
    		$irow ++;	//row 4+
    		$icol = 65; //A
    		foreach ($column_map as $vMap){
    			$col = chr($icol);
    			$cell = $col.$irow;

    			//style
    			$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($vMap['style']);

    			//value
    			$objPHPExcel->getActiveSheet()->SetCellValue($cell, $v->{$vMap['key']});
    			$icol++;
    		}
    	}

    	//add sheet
    	$objPHPExcel->createSheet(NULL, $iSheet);
    	$iSheet++;

    	//return first sheet
    	$objPHPExcel->setActiveSheetIndex(0);

    	// Set properties
    	$objPHPExcel->getProperties()->setCreator("TaiPV");
    	$objPHPExcel->getProperties()->setLastModifiedBy("TaiPV");
    	$objPHPExcel->getProperties()->setTitle("Export customer for ".Registry::getSetting('site_name'));
    	$objPHPExcel->getProperties()->setSubject("Export customer for ".Registry::getSetting('site_name'));
    	$objPHPExcel->getProperties()->setDescription("TaiPV");

        //set file name
        $date = date('d-m-Y');
        $fileName = "DANH-SACH-KHACH-HANG-[$date].xlsx";
        $filePath = "upload/report/$fileName";

        //error on server
//    	// Redirect output to a client�s web browser (Excel2007)
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
}