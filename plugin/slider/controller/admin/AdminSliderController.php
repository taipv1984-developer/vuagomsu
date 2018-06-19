<?php
class AdminSliderController extends Controller {
	private $sliderDao;
    public $sliderModel;
    public $sliderImageDao;
    
    function __construct(){
    	$this->sliderDao = new SliderDao();
    	$this->sliderModel = new SliderModel();
    	$this->sliderImageDao = new SliderImageDao();
    }
    
    private function _validate_add($addVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$sliderVo = new SliderVo();
    	$sliderVo->name = $addVo->name;
    	$sliderVos = $this->sliderDao->selectByFilter($sliderVo);
    	if($sliderVos){
			$validate["sliderModel.name"] = e("Slider name is exist");
    	}
    	
    	return $validate;
    }
    
    private function _validate_edit($editVo){
    	$validate = array();
    	
    	//the name should not duplicate in the table 
    	$sliderVo = new SliderVo();
    	$sliderVo->name = $editVo->name;
    	$sliderVos = $this->sliderDao->selectByFilter($sliderVo);
    	if($sliderVos){
    		$slider = $sliderVos[0];
    		if($slider->sliderId != $editVo->sliderId) {
    			$validate["sliderModel.name"] = e("Slider name is exist");
			}
    	}
    	
    	return $validate;
    }
    
    private function _add_info($sliderVo){
    }
    
    private function _filter($sliderVo){
    	if(!CTTHelper::isEmptyString($this->sliderModel->sliderId)) {
    		$sliderVo->sliderId = $this->sliderModel->sliderId;
    	}
    	if(!CTTHelper::isEmptyString($this->sliderModel->name)) {
    		$sliderVo->name = array('like', "%{$this->sliderModel->name}%");
    	}
    	if(!CTTHelper::isEmptyString($this->sliderModel->description)) {
    		$sliderVo->description = array('like', "%{$this->sliderModel->description}%");
    	}
    }
    
	public function manage(){
        $sliderVo = new SliderVo();
        
        //filter
        $this->_filter($sliderVo);
        
        //orderBy
        $orderBy = array('slider_id' => 'DESC');
        
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
        $count = count($this->sliderDao->selectByFilter($sliderVo));
        $paging = new Paging($page, 5, $recSize, $count);
        $start =($paging->currentPage - 1) * $recSize;
        
        //get data
        $sliderVos = $this->sliderDao->selectByFilter($sliderVo, $orderBy, $start, $recSize);
        
        //add info
        foreach($sliderVos as $sliderVo){
        	$this->_add_info($sliderVo);
        }
        
        //set data
        $paging->items = $sliderVos;	
        
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
    			$sliderId = $_REQUEST['id'];
    			$status = $_REQUEST['value'];
    			$sliderVo = new SliderVo();
    			$sliderVo->status = $status;
    			$this->sliderDao->updateByPrimaryKey($sliderVo, $sliderId);
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
    			$sliderVo = new SliderVo();
    			$sliderVo->name = trim($_REQUEST['name']);
    			$validate = $this->_validate_add($sliderVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    		case 'edit':
    			$sliderVo = new SliderVo();
    			$sliderVo->name = trim($_REQUEST['name']);
    			$sliderVo->sliderId = $_REQUEST['sliderId'];
    			$validate = $this->_validate_edit($sliderVo);
    			if(!empty($validate)){
    				echo json_encode($validate);
    			}
    			break;
    	}
    	 
    	return $this->setRender('success');
    }
    
    private function _check_exist($sliderInfo){
    	if(!$sliderInfo){
    		SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Slider not exist');
    		return false;
    	}
    	return true;
    }
    
    private function _check_permission($sliderInfo){
    	return true;
    }
    
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$sliderVo = new SliderVo();
        	CTTHelper::copyProperties($this->sliderModel, $sliderVo);
        	
        	//add
        	$this->sliderDao->insert($sliderVo);
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Slider add success");
            return $this->setRender('manage');
        }
        
        //send data
        $this->setAttributes(array(
        	'sliderInfo' => false,
        ));
        
        return $this->setRender('success');
    }
    
    public function edit(){
        $sliderId = $_REQUEST['sliderId'];
        $sliderInfo = $this->sliderDao->selectByPrimaryKey($sliderId);
        
        if(!($this->_check_exist($sliderInfo) & $this->_check_permission($sliderInfo))){
			return $this->setRender('manage');
		}
        
		//more data
		$imageList = SliderExt::getImageList($sliderId);
		
        //send data
        $this->setAttributes(array(
        	'sliderInfo' => $sliderInfo,
        	'imageList' => $imageList,
        ));
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        	//set data
        	$sliderVo = new SliderVo();
        	CTTHelper::copyProperties($this->sliderModel, $sliderVo);
        	
        	//update
        	$this->sliderDao->updateByPrimaryKey($sliderVo, $sliderId);
        	
        	//update slider image
        	$sliderImage = $_REQUEST['sliderImage'];
        	foreach ($sliderImage as $k => $v){
        		$sliderImageVo = new SliderImageVo();
        		$sliderImageVo->image = str_replace(Registry::getSetting('base_url').'/', '', $v['image']);
        		$sliderImageVo->title = $v['title'];
        		$sliderImageVo->description = $v['description'];
        		$sliderImageVo->link = $v['link'];
        		$sliderImageVo->order = $v['order'];
        		$this->sliderImageDao->updateByPrimaryKey($sliderImageVo, $k);
        	}
        	
        	SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Slider update success");
            return $this->setRender('manage');
        }
        
        return $this->setRender('success');
    }
    
    public function delete() {
    	if(isset($_REQUEST['sliderId'])){
			$sliderId = $_REQUEST['sliderId'];
			
			//delete slider and slider_image table
			SliderExt::delete($sliderId);
			
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
    	}
    	return $this->setRender('success');
    }
    
    /**************
     * sliderImage action
     *************/
    public function add_image(){
    	$sliderId = $_REQUEST['sliderId'];
    	
    	//add a slider_image
    	$sliderImageVo = new SliderImageVo();
    	$sliderImageVo->sliderId = $sliderId;
    	$sliderImageVo->image = Registry::getSetting('no_image');
    	$sliderImageVo->title = '';
    	$sliderImageVo->description = '';
    	$sliderImageVo->link = '';
    	$sliderImageVo->order = 999;
    	$sliderImageId = $this->sliderImageDao->insert($sliderImageVo);
    	
    	$sliderImageVo->sliderImageId = $sliderImageId;
    	
    	//insert slider_image view
    	$sliderImageInfo = $sliderImageVo;
    	$sliderImageFile = PLUGIN_PATH."slider/view/admin/slider/slider_image.php";
    	include $sliderImageFile;
    	
    	return $this->setRender('success');
    }
    
    public function delete_image(){
    	$sliderImageId = $_REQUEST['sliderImageId'];
    	 
    	//delete slider_image
    	$this->sliderImageDao->deleteByPrimaryKey($sliderImageId);
    	 
    	return $this->setRender('success');
    }
}