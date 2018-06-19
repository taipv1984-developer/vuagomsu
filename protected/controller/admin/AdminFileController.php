<?php
class AdminFileController extends Controller{
	public $fileModel;
	private $fileDao;
	private $adminDao;
	
	function __construct(){
		$this->fileModel = new FileModel();
		$this->fileDao = new FileDao();
		$this->adminDao = new AdminDao();
	}
	
	public function manage(){
		//send data
        $this->setAttributes(array(
       ));
        
        //call view
        return $this->setRender('success');
	}
	
	public function setting(){
		$fileSetting = array(
			'thumbs' => array(
				'option_resize' => Registry::getSetting('option_resize'),
				'image_small_width' => Registry::getSetting('image_small_width'),
				'image_small_height' => Registry::getSetting('image_small_height'),
				'image_large_width' => Registry::getSetting('image_large_width'),
				'image_large_height' => Registry::getSetting('image_large_height'),
				'image_max_width' => Registry::getSetting('image_max_width'),
				'image_max_height' => Registry::getSetting('image_max_height'),
			),
		);
		
		//send data
		$this->setAttributes(array(
			'fileSetting' => $fileSetting
		));
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$settingDao = new SettingDao();
			$settingVo = new SettingVo();
			
			//update thumbnail setting
			foreach($fileSetting['thumbs'] as $k => $v){
				$settingVo->settingValue = $_REQUEST[$k];
				$settingDao->updateByPrimaryKey($settingVo, $k);
			}
			
			//message
			SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Changed settings successfully!'));
			
			//call view
			return $this->setRender('success');
		}
	
		//call view
		return $this->setRender('manage');
	}
}