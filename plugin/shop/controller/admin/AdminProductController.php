<?php

class AdminProductController extends Controller{
	public $productModel;
	private $productDao;
	private $categoryDao;
	private $seoInfoDao;
	private $pluginCode;
	private $productImageDao;
	private $seoModel;

	function __construct(){
		$this->productModel = new ProductModel();
		$this->productDao = new ProductDao();
		$this->categoryDao = new CategoryDao();
		$this->productImageDao = new ProductImageDao();
		$this->seoModel = new SeoInfoModel();
		$this->seoInfoDao = new SeoInfoDao();
		//get $pluginCode
		$actionControler = get_class($this);
		$pluginCodeMap = Session::getSession('pluginCodeMap');
		$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
		//ProductExt::deleteProductInUncategory();
	}

	//OK
	private function addValidate(){
		$message = array();
		//the name should not duplicate in the table
		$productVo = new ProductVo();
		$productVo->name = $_REQUEST['productModel_name'];
		$productVos = $this->productDao->selectByFilter($productVo);
		if ($productVos) {
			$message["productModel.name"] = e("Product name is exist");
		}
		if (!empty($message)) {
			$validate = array(
				'status' => 'ERROR',
				'message' => $message
			);
			return $validate;
		}
		return $message;
	}

	//OK
	private function editValidate(){
		$message = array();
		//the name should not duplicate in the table
		$productVo = new ProductVo();
		$productVo->name = $_REQUEST['productModel_name'];
		$productVos = $this->productDao->selectByFilter($productVo);
		if ($productVos) {
			$product = $productVos[0];
			if ($product->productId != $_REQUEST['productId']) {
				$message["productModel.name"] = e("Product name is exist");
			}
		}
		if (!empty($message)) {
			$validate = array(
				'status' => 'ERROR',
				'message' => $message
			);
			return $validate;
		}
		return $message;
	}

	//OK
	public function manage_ajax(){
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'select_is_new':
				$productVo = new ProductVo();
				$productVo->isNew = $_REQUEST['value'];
				$this->productDao->updateByPrimaryKey($productVo, $_REQUEST['id']);
				break;
			case 'select_is_feature':
				$productVo = new ProductVo();
				$productVo->isFeature = $_REQUEST['value'];
				$this->productDao->updateByPrimaryKey($productVo, $_REQUEST['id']);
				break;
			case 'select_status':
				$productVo = new ProductVo();
				$productVo->status = $_REQUEST['value'];
				$this->productDao->updateByPrimaryKey($productVo, $_REQUEST['id']);
				break;
			default:
				break;
		}
		return $this->setRender('success');
	}

	//OK
	private function getFilter(){
		$filter = array();

		if (!CTTHelper::isEmptyString($this->productModel->productId)) {
			$filter['p.product_id'] = $this->productModel->productId;
		}
		if (!CTTHelper::isEmptyString($_REQUEST['name'])) {
			$filter['p.name'] = array('like', '%' . $_REQUEST['name'] . '%');
		}
		if (!CTTHelper::isEmptyString($_REQUEST['code'])) {
			$filter['p.code'] = array('like', '%' . $_REQUEST['code'] . '%');
		}
		if (!CTTHelper::isEmptyString($_REQUEST['productModel_categoryListText'])) {
			$filter['c.category_id'] = $_REQUEST['productModel_categoryListText'];
		}
		if (!CTTHelper::isEmptyString($_REQUEST['priceFrom']) && CTTHelper::isEmptyString($_REQUEST['priceTo'])) {
			$filter['p.price'] = array('>=', $_REQUEST['priceFrom']);
		}
		if (CTTHelper::isEmptyString($_REQUEST['priceFrom']) && !CTTHelper::isEmptyString($_REQUEST['priceTo'])) {
			$filter['p.price'] = array('<=', $_REQUEST['priceTo']);
		}
		if (!CTTHelper::isEmptyString($_REQUEST['priceFrom']) && !CTTHelper::isEmptyString($_REQUEST['priceTo'])) {
			$filter['p.price'] = array('between', $_REQUEST['priceFrom'], $_REQUEST['priceTo']);
		}

		if (!CTTHelper::isEmptyString($_REQUEST['amountFrom']) && CTTHelper::isEmptyString($_REQUEST['amountTo'])) {
			$filter['p.amount'] = array('>=', $_REQUEST['amountFrom']);
		}
		if (CTTHelper::isEmptyString($_REQUEST['amountFrom']) && !CTTHelper::isEmptyString($_REQUEST['amountTo'])) {
			$filter['p.amount'] = array('<=', $_REQUEST['amountTo']);
		}
		if (!CTTHelper::isEmptyString($_REQUEST['amountFrom']) && !CTTHelper::isEmptyString($_REQUEST['amountTo'])) {
			$filter['p.amount'] = array('between', $_REQUEST['amountFrom'], $_REQUEST['amountTo']);
		}

		if (!CTTHelper::isEmptyString($this->productModel->status)) {
			$filter['p.status'] = $this->productModel->status;
		}

		return $filter;
	}

	//OK
	public function manage(){
		//filter
		$filter = $this->getFilter();
		//set order
		$orderBy = array('product_id' => 'DESC');

		//paging
		if (empty($_REQUEST['item_per_page'])) {
			$recSize = Registry::getSetting('item_per_page');
		} else {
			$recSize = $_REQUEST['item_per_page'];
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
		$count = count(ProductExt::getProductList($filter));
		$paging = new Paging($page, 5, $recSize, $count);
		$start = ($paging->currentPage - 1) * $recSize;
		$productVos = ProductExt::getProductList($filter, $orderBy, $start, $recSize);

		//add info
		foreach ($productVos as $v) {
			ProductExt::addInfo($v);
			//add crtDateView and modDateView
			$v->crtDateView = (!empty($v->crtDate)) ? date('d/m/Y H:m:s', strtotime($v->crtDate)) : '';
			$v->modDateView = (!empty($v->modDate)) ? date('d/m/Y H:m:s', strtotime($v->modDate)) : '';
		}

		//send data
		$this->setAttributes(array(
			'pageView' => $paging,
			'productList' => $productVos,
			'categoryList' => CategoryExt::getCategoryList()
		));

		//view
		return $this->setRender('success');
	}

	public function addView(){
		$this->setAttributes(array(
			'productInfo' => new ProductVo(),
			'categoryList' => CategoryExt::getCategoryList(),
			'productTagSelected' => array(),
			//'productTagList' => ProductExt::getProductTagList()
			'productTagList' => array()
		));
		return $this->setRender('success');
	}

	public function add(){
		//addValidate
		$validate = $this->addValidate();
		if (!empty($validate)) {
			echo json_encode($validate);
			return $this->setRender('success');
		}

		//set data
		$productVo = new ProductVo();
		CTTHelper::copyProperties($this->productModel, $productVo);
		//image
		$productVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $_REQUEST['image_primary']);
		//price
		if (!isset($productVo->price) || empty($productVo->price)) {
			$productVo->price = 0.00;
		}
		if (!isset($productVo->saleOf) || empty($productVo->saleOf)) {
			$productVo->saleOf = 0.00;
		}
		$productVo->price = str_replace(',', '', $productVo->price);
		$productVo->saleOf = str_replace(',', '', $productVo->saleOf);
		//discount
		if ($productVo->price < $productVo->saleOf) {
			$productVo->discount = floor((100 * ($productVo->saleOf - $productVo->price)) / $productVo->saleOf);
		} else {
			$productVo->discount = 0;
		}
		//time
		$productVo->crtDate = DateHelper::getDateTime();
		$productVo->crtBy = Session::getAdminId();
		//default
		$productVo->viewCount = 0;
		$productVo->type = 1;                       //normal product

		//insert product
		$productId = $this->productDao->insert($productVo);

		//update productCategory
		ProductExt::updateProductCategory($productId, $_REQUEST['productModel_categoryId'], $_REQUEST['categoryPrimaryId']);

		//update product_extension
		$productExtension = $_REQUEST['productExtension'];
		ProductExt::updateProductExtension($productId, $productExtension);

		//insert new image
		$this->updateImage($productId);

		//update attribute
		$this->updateAttribute($productId);

		//update router
		$productInfo = $this->productDao->selectByPrimaryKey($productId);
		RouterExt::updateRouterUrlProductPage($productInfo);
		RouterExt::deleteRouterSame();

		//seo
		$seoVo = new SeoInfoVo();
		$seoVo->itemId = $productId;
		$seoVo->type = 'product';
		$seoVo->title = $_REQUEST['seoModel_title'];
		$seoVo->keyword = $_POST['seoModel_keyword'];
		$seoVo->description = $_POST['seoModel_description'];
		$this->seoInfoDao->insert($seoVo);
		//end seo

		//view
		$data = array(
			'status' => 'SUCCESS',
			'message' => e("Add success"),
			'extra' => array('productId' => $productId)
		);
		echo json_encode($data);
		return $this->setRender('success');
	}

	public function editView(){
		$productId = $_REQUEST['productId'];
		$productInfo = $this->productDao->selectByPrimaryKey($productId);
		if (!$productInfo) {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Product not exist");
			return $this->setRender('manage');
		}

		//add info
		$productInfo->imageAttach = ProductExt::getImageAttach($productId);
		$categoryPrimary = ProductExt::getCategoryPrimary($productId);

		//seoInfo
		$seoVo = new SeoInfoVo();
		$seoVo->itemId = $productId;
		$seoVo->type = 'product';
		$seoInfoVos = $this->seoInfoDao->selectByFilter($seoVo);
		if (count($seoInfoVos) > 0) {
			$seoInfo = $seoInfoVos[0];
		} else {
			$seoInfo = $seoVo;
		}
		//send data
		$this->setAttributes(array(
			'pluginCode' => $this->pluginCode,
			'productInfo' => $productInfo,
			'productExtension' => ProductExt::getProductExtension($productId),
			'attributeList' => ProductExt::getAttributeList(),
			'attributeArray' => ProductExt::getAttributeArray(),
			'productAttribute' => ProductExt::getProductAttribute($productId),
			'categoryList' => CategoryExt::getCategoryList(),
			'categoryProduct' => CategoryExt::getCategoriesByProduct($productId),
			'categoryPrimaryId' => $categoryPrimary->categoryId,
			'productTagSelected' => ProductExt::getProductTagList($productId),
			'productTagList' => ProductExt::getProductTagList(),
			'seoInfo' => $seoInfo,
		));

		return $this->setRender('success');
	}

	public function edit(){
		//editValidate
		$validate = $this->editValidate();
		if (!empty($validate)) {
			echo json_encode($validate);
			return $this->setRender('success');
		}

		//get data
		$productId = $_REQUEST['productId'];

		//set data
		$productVo = new ProductVo();
		CTTHelper::copyProperties($this->productModel, $productVo);
		//image
		$productVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $_REQUEST['image_primary']);
		//price
		if (!isset($productVo->price) || empty($productVo->price)) {
			$productVo->price = 0.00;
		}
		if (!isset($productVo->saleOf) || empty($productVo->saleOf)) {
			$productVo->saleOf = 0.00;
		}
		$productVo->price = str_replace(',', '', $productVo->price);
		$productVo->saleOf = str_replace(',', '', $productVo->saleOf);
		//discount
		if ($productVo->price < $productVo->saleOf) {
			$productVo->discount = floor((100 * ($productVo->saleOf - $productVo->price)) / $productVo->saleOf);
		} else {
			$productVo->discount = 0;
		}
		//time
		$productVo->modDate = DateHelper::getDateTime();
		$productVo->modBy = Session::getAdminId();
		//update seo

		$seoVo = new SeoInfoVo();
		$seoVo->title = $_REQUEST['seoModel_title'];
		$seoVo->keyword = $_POST['seoModel_keyword'];
		$seoVo->description = $_POST['seoModel_description'];
		$this->seoInfoDao->updateByPrimaryKey($seoVo, $productId, 'product');
		//update product
		$this->productDao->updateByPrimaryKey($productVo, $productId);

		//update SEO
		//end

		//update productCategory
		ProductExt::updateProductCategory($productId, $_REQUEST['productModel_categoryId'], $_REQUEST['categoryPrimaryId']);

		//update product_extension
		ProductExt::updateProductExtension($productId, $_REQUEST['productExtension']);

		//insert new image
		$this->updateImage($productId);

		//update attribute
		$this->updateAttribute($productId);

		//update router
		$productInfo = $this->productDao->selectByPrimaryKey($productId);
		RouterExt::updateRouterUrlProductPage($productInfo);
		RouterExt::deleteRouterSame();

		//view
		$data = array(
			'status' => 'SUCCESS',
			'message' => e("Edit success")
		);
		echo json_encode($data);
		return $this->setRender('success');
	}

	//OK
	private function updateImage($productId){
		//delete all image of product
		ProductExt::deleteProductImage($productId);

		//image_attach
		$imageAttach = $_REQUEST['image_list']; //array
		foreach ($imageAttach as $v) {
			$productImageVo = new ProductImageVo();
			$productImageVo->productId = $productId;
			$productImageVo->image = str_replace(URLHelper::getBaseUrl() . '/', '', $v);
			$this->productImageDao->insert($productImageVo);
		}
	}

	private function updateAttribute($productId){
		$attributeValueDao = new AttributeValueDao();
		$attributeMapDao = new AttributeMapDao();

		//get data
		$attributeType = $_REQUEST['attributeType'];
		$attributeValue = $_REQUEST['attributeValue'];

		//delete all attribute_value old (with type=text, image)
		$sql = "select am.attribute_value_id
from attribute_map as am
left join attribute as a on a.attribute_id=am.attribute_id
left join product as p on p.product_id=am.product_id
where (a.`type`='image' or a.`type`='text') and p.product_id=$productId";
		$output = array(
			'type' => 'array',
			'value' => 'attribute_value_id'
		);
		$query = DataBaseHelper::query($sql, null, $output);
		if (count($query) > 0) {
			$whereIn = join(', ', $query);
			$sql = "delete 
from attribute_value
where attribute_value_id in ($whereIn)";
			DataBaseHelper::query($sql, null, null);
		}

		//delete all attribute_value not value
		$sql = "delete
from attribute_value
where `value`='' and image=''";
		DataBaseHelper::query($sql, null, null);

		//delete all attribute_map old
		$attributeMapVo = new AttributeMapVo();
		$attributeMapVo->productId = $productId;
		$attributeMapDao->deleteByFilter($attributeMapVo);

		foreach ($attributeValue as $attributeId => $text) {
			if ($attributeType[$attributeId] == 'select') {
				//convert text to array
				$values = ($text != '') ? explode('|', $text) : array();
				foreach ($values as $v) {
					//get attributeValueId $v
					$attributeValueVo = new AttributeValueVo();
					$attributeValueVo->attributeId = $attributeId;
					$attributeValueVo->value = $v;
					$attributeValueVos = $attributeValueDao->selectByFilter($attributeValueVo);
					if ($attributeValueVos) {
						$attributeValueInfo = $attributeValueVos[0];
						$attributeValueId = $attributeValueInfo->attributeValueId;

						//add attributeMap
						$attributeMapVo = new AttributeMapVo();
						$attributeMapVo->productId = $productId;
						$attributeMapVo->attributeId = $attributeId;
						$attributeMapVo->attributeValueId = $attributeValueId;
						$attributeMapDao->insert($attributeMapVo);
					}
				}
			} else if ($attributeType[$attributeId] == 'text') {
				//convert text to array
				$values = ($text != '') ? explode('|', $text) : array();
				foreach ($values as $v) {
					$value = trim($v);
					if ($value != '') {
						//add attributeValue
						$attributeValueVo = new AttributeValueVo();
						$attributeValueVo->attributeId = $attributeId;
						$attributeValueVo->value = $value;
						$attributeValueVo->description = '';
						$attributeValueVo->image = '';
						$attributeValueVo->imageList = '';
						$attributeValueId = $attributeValueDao->insert($attributeValueVo);

						//add attributeMap
						$attributeMapVo = new AttributeMapVo();
						$attributeMapVo->productId = $productId;
						$attributeMapVo->attributeId = $attributeId;
						$attributeMapVo->attributeValueId = $attributeValueId;
						$attributeMapDao->insert($attributeMapVo);
					}
				}
			} else if ($attributeType[$attributeId] == 'image') {
				foreach ($attributeValue[$attributeId] as $k => $v) {
					//add attributeValue
					$attributeValueVo = new AttributeValueVo();
					$attributeValueVo->attributeId = $attributeId;
					$attributeValueVo->value = $v['value'];
					$attributeValueVo->description = '';
					$attributeValueVo->image = str_replace(Registry::getSetting('base_url') . '/', '', $v['image']);
					$attributeValueVo->imageList = str_replace(Registry::getSetting('base_url') . '/', '', $v['imageList']);
					$attributeValueId = $attributeValueDao->insert($attributeValueVo);

					//add attributeMap
					$attributeMapVo = new AttributeMapVo();
					$attributeMapVo->productId = $productId;
					$attributeMapVo->attributeId = $attributeId;
					$attributeMapVo->attributeValueId = $attributeValueId;
					$attributeMapDao->insert($attributeMapVo);
				}
			}
		}
	}

	public function attribute_action(){
		$attributeMapDao = new AttributeMapDao();
		$attributeValueDao = new AttributeValueDao();
		$attributeDao = new AttributeDao();

		$action = $_REQUEST['action'];
		switch ($action) {
			case 'add_attribute':
				//get data
				$productId = $_REQUEST['productId'];
				$attributeId = $_REQUEST['attributeId'];

				//check product_filer_map not duplicate
				$attributeMapVo = new AttributeMapVo();
				$attributeMapVo->productId = $productId;
				$attributeMapVo->attributeId = $attributeId;
				$attributeMapVos = $attributeMapDao->selectByFilter($attributeMapVo);
				if ($attributeMapVos) {
					echo 'exist';
				} else {
					//insert product_filer_map
					$attributeMapVo->attributeValueId = 0;
					$attributeMapId = $attributeMapDao->insert($attributeMapVo);
					//send data
					$params = array(
						'attributeInfo' => $attributeDao->selectByPrimaryKey($attributeId),
						'attributeArray' => ProductExt::getAttributeArray(),
					);
					TemplateHelper::getTemplate('product/attribute/attribute_item.php', $params, $this->pluginCode);
				}
				break;
			case 'delete_attribute':
				//get data
				$productId = $_REQUEST['productId'];
				$attributeId = $_REQUEST['attributeId'];

				//delete attribute_map
				$attributeMapVo = new AttributeMapVo();
				$attributeMapVo->productId = $productId;
				$attributeMapVo->attributeId = $attributeId;
				$attributeMapDao->deleteByFilter($attributeMapVo);
				break;

			//for case image
			case 'add_attribute_value':
				//get data
				$productId = $_REQUEST['productId'];
				$attributeId = $_REQUEST['attributeId'];

				//add attributeValue
				$attributeValueVo = new AttributeValueVo();
				$attributeValueVo->attributeId = $attributeId;
				$attributeValueVo->value = '';
				$attributeValueVo->description = '';
				$attributeValueVo->image = '';
				$attributeValueVo->imageList = '';
				$attributeValueId = $attributeValueDao->insert($attributeValueVo);

				//update attributeValueId
				$attributeValueVo->attributeValueId = $attributeValueId;

				//send data
				$params = array(
					'attributeValueInfo' => $attributeValueVo,
				);
				TemplateHelper::getTemplate('product/attribute/attribute_item_image.php', $params, $this->pluginCode);
				break;
			case 'delete_attribute_value':
				//get data
				$attributeValueId = $_REQUEST['attributeValueId'];

				//1 delete attributeMap
				$attributeMapVo = new AttributeMapVo();
				$attributeMapVo->attributeValueId = $attributeValueId;
				$attributeMapDao->deleteByFilter($attributeMapVo);

				//2 delete attributeValue
				$attributeValueDao->deleteByPrimaryKey($attributeValueId);
				break;

			default:
				SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Action not support");
				break;
		}
		return $this->setRender('success');
	}

	public function delete(){
		if (isset($_REQUEST['productId'])) {
			$productId = $_REQUEST['productId'];
			ProductExt::deleteProduct($productId);

			//delete seo
			$seoVo = new SeoInfoVo();
			$seoVo->itemId = $productId;
			$seoVo->type = 'product';
			$this->seoInfoDao->deleteByFilter($seoVo);

			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e("Delete is success!"));
			return $this->setRender('manage');
		} else {
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Access deny"));
			return $this->setRender('manage');
		}
	}

	/********************************************
	 * MORE ACTION
	 *******************************************/
	//copy from AdminCustomerController::export
	//not use and edit
	public function export(){
		/** Error reporting */
		error_reporting(E_ALL);

		/** Include path **/
		$include_path = LIBRARY_PATH . 'PHPExcel/Classes/';
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
		foreach ($customerList as $v) {
			//customerName
			$customerId = $v->customerId;
			$v->customerName = $v->firstName . ' ' . $v->lastName;

			$customerAddressList = array();
			foreach (CustomerExt::getCustomerAddressList($customerId) as $customerAddress) {
				$customerAddressList[] = $customerAddress->address;
			}
			$v->customerAddressList = JOIN(" & ", $customerAddressList);

			//statusName
			$v->statusName = ArrayHelper::getAll()[$v->status];

			//crtDate
			$v->crtDate = date(DateHelper::getDateFormat(), strtotime($v->crtDate));
		}

		//set $column_map
		$column_map = array(
			array('title' => 'ID', 'key' => 'customerId', 'width' => 10, 'style' => array(
				'font' => array(
					'bold' => true
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
		$iSheet = 0;
		//Active sheet
		$objPHPExcel->setActiveSheetIndex($iSheet);
		//sheet title
		$objPHPExcel->getActiveSheet()->setTitle("Danh sách khách hàng");

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
		$objPHPExcel->getActiveSheet()->setCellValue($cell, 'DANH SÁCH KHÁCH HÀNG');

		//set total
		$irow++;    //row 2
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
		foreach ($column_map as $v) {
			$col = chr($icol);
			$cell = $col . $irow;
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
		foreach ($customerList as $v) {
			$irow++;    //row 4+
			$icol = 65; //A
			foreach ($column_map as $vMap) {
				$col = chr($icol);
				$cell = $col . $irow;

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
		$objPHPExcel->getProperties()->setTitle("Export customer for " . Registry::getSetting('site_name'));
		$objPHPExcel->getProperties()->setSubject("Export customer for " . Registry::getSetting('site_name'));
		$objPHPExcel->getProperties()->setDescription("TaiPV");

		//set file name
		$date = date('d-m-Y');
		$fileName = "DANH-SACH-KHACH-HANG-[$date].xlsx";
		$filePath = "upload/report/$fileName";

		//error on server
//    	// Redirect output to a clients web browser (Excel2007)
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