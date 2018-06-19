<?php
class AdminAttributeController extends Controller{
	private $attributeDao;
	public $attributeModel;
	private $attributeValueDao;
	
	function __construct(){
		$this->attributeDao = new AttributeDao();
		$this->attributeModel = new AttributeModel();
		$this->attributeValueDao = new AttributeValueDao();
	}
	
	//OK
	private function _validate_add($addVo){
		$validate = array();
			
		//the name should not duplicate in the table
		$attributeVo = new AttributeVo();
		$attributeVo->name = $addVo->name;
		$attributeVos = $this->attributeDao->selectByFilter($attributeVo);
		if($attributeVos){
			$validate["attributeModel.name"] = e("Name is exist");
		}
	
		return $validate;
	}
	
	//OK
	private function _validate_edit($editVo){
		$validate = array();
			
		//the name should not duplicate in the table
		$attributeVo = new AttributeVo();
		$attributeVo->name = $editVo->name;
		$attributeVos = $this->attributeDao->selectByFilter($attributeVo);
		if($attributeVos){
			$attribute = $attributeVos[0];
			if($attribute->attributeId != $editVo->attributeId) {
				$validate["attributeModel.name"] = e("Name is exist");
			}
		}
			
		return $validate;
	}
	
	//OK
	public function validate_ajax(){
		$action = $_REQUEST['action'];
		switch($action){
			case 'add':
				$attributeVo = new AttributeVo();
				$attributeVo->name = $_REQUEST['value'];
				$validate = $this->_validate_add($attributeVo);
				if(!empty($validate)){
					echo json_encode($validate);
				}
				break;
			case 'edit':
				$attributeVo = new AttributeVo();
				$attributeVo->name = $_REQUEST['value'];
				$attributeVo->attributeId = $_REQUEST['id'];
				$validate = $this->_validate_edit($attributeVo);
				if(!empty($validate)){
					echo json_encode($validate);
				}
				break;
		}
	
		return $this->setRender('success');
	}
	
	//OK
	public function manage(){
		$attributeVo = new AttributeVo();
		
		//paging
		if(empty($_REQUEST['item_per_page'])){
			$recSize = Registry::getSetting('item_per_page');
		}
		else{
			$recSize = $_REQUEST['item_per_page'];
		}
		$start = 0;
		if(CTTHelper::isEmptyString($_REQUEST ['page'])){
			$page = 0;
		}
		elseif(is_numeric($_REQUEST ['page'])){
			$page = $_REQUEST ['page'];
		}
		else{
			$page = 0;
		}
		$count = count($this->attributeDao->selectByFilter($attributeVo));
		$paging = new Paging($page, 5, $recSize, $count);
		$start =($paging->currentPage - 1)* $recSize;
		
		//get data
		$attributeVos = $this->attributeDao->selectByFilter($attributeVo, array(), $start, $recSize);
		
		//add info
		$attribute = ProductExt::getAttributeList();
		$iMax = 5;
		foreach ($attributeVos as $v){
			//get attributeValue list
			$attributeValueList = array();
			$i = 0;
			foreach($attribute[$v->attributeId]['attributeValue'] as $attributeValue){
				$i++;
				if($i > $iMax) continue;								
				$attributeValueList[] = $attributeValue->value;
			}
			$v->attributeValueList = join('<br>', $attributeValueList);
		}
		
		//set data
		$paging->items = $attributeVos;
			
		//send data
		$this->setAttributes(array(
			'pageView' => $paging
		));
		
		return $this->setRender('success');
	}
	
	//OK
	public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//set data
        	$attributeVo = new AttributeVo();
        	CTTHelper::copyProperties($this->attributeModel, $attributeVo);
        	//image
        	$attributeVo->image = str_replace(URLHelper::getBaseUrl().'/', '', $_REQUEST['image']);
	        
        	//add
        	$attributeId = $this->attributeDao->insert($attributeVo);
        	
	        SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Add is success");
	        return $this->setRender('manage');
        }
        
        $this->setAttributes(array(
        	'attributeInfo' => false
        ));
       
        return $this->setRender('success');
	}
	
	//OK
	public function edit(){
		$attributeId= $_REQUEST['attributeId'];
		$attributeInfo = $this->attributeDao->selectByPrimaryKey($attributeId);
		
		//check $attributeInfo
		if(!$attributeInfo){
			SessionMessage::addSessionMessage(SessionMessage::$ERROR, "Product filter not exist");
			return $this->setRender('manage');
		}
		
		//add info
		$attributeValueVo = new AttributeValueVo();
		$attributeValueVo->attributeId = $attributeInfo->attributeId;
		$attributeValueList = $this->attributeValueDao->selectByFilter($attributeValueVo);
		
		$this->setAttributes(array(
			'attributeInfo' => $attributeInfo,
			'attributeValueList' => $attributeValueList
		));
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//set data
			$attributeVo = new AttributeVo();
			CTTHelper::copyProperties($this->attributeModel, $attributeVo);
			//image
			$attributeVo->image = str_replace(URLHelper::getBaseUrl().'/', '', $_REQUEST['image']);
			
			//update
			$this->attributeDao->updateByPrimaryKey($attributeVo, $attributeId);
			
			//update attributeValue
			$attributeValue = $_REQUEST['attributeValue'];
			foreach ($attributeValue as $k => $v){
				$attributeValueVo = new AttributeValueVo();
				$attributeValueVo->image = str_replace(Registry::getSetting('base_url').'/', '', $v['image']);
				$attributeValueVo->value = $v['value'];
				$attributeValueVo->description = $v['description'];
				$this->attributeValueDao->updateByPrimaryKey($attributeValueVo, $k);
			}
			
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Update is success");
			return $this->setRender('manage');
		}
		return $this->setRender('success');
	}
	
	//OK...
	public function delete(){
		$attributeId = $_REQUEST['attributeId'];
		$this->attributeDao->deleteByPrimaryKey($attributeId);
		
		//1 delete all attributeValue
		//later
		
		//2 delete attribute
		//later
		
		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Delete attribute is success");
		return $this->setRender('success');
	}
	
	/**************
	 * attributeValue action
	 *************/
	//OK
	public function addAttributeValue(){
		$attributeId = $_REQUEST['attributeId'];
		$attributeValueId = $_REQUEST['attributeValueId'];
		
		//add a attribute_image
		$attributeValueVo = new AttributeValueVo();
		$attributeValueVo->attributeId = $attributeId;
		$attributeValueVo->attributeValueId = $attributeValueId;
		$attributeValueVo->value = '';
		$attributeValueVo->description = '';
		$attributeValueVo->image = Registry::getSetting('no_image');
		$attributeValueId = $this->attributeValueDao->insert($attributeValueVo);

		//update $attributeValueId
		$attributeValueVo->attributeValueId = $attributeValueId;

		//get view
		TemplateHelper::getTemplate('filter/attribute_value_item.php', array(
			'attributeValue' => $attributeValueVo
		));
		 
		//insert attribute_value_item to view
		$attributeValueInfo = $attributeValueVo;
		$attributeValueFile = PLUGIN_PATH."shop/view/admin/attribute/attribute_value_item.php";
		include $attributeValueFile;
		 
		return $this->setRender('success');
	}
	
	//OK
	public function deleteAttributeValue(){
		$attributeValueId = $_REQUEST['attributeValueId'];
		
		//1 delete attributeMap
		$attributeMapDao = new AttributeMapDao();
		$attributeMapVo = new AttributeMapVo();
		$attributeMapVo->attributeValueId = $attributeValueId;
		$attributeMapDao->deleteByFilter($attributeMapVo);
	
		//2 delete attributeValue
		$this->attributeValueDao->deleteByPrimaryKey($attributeValueId);
	}
}