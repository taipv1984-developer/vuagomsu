<?php
class ApiSeoToolController extends Controller{
	public function get_link(){
		$link = array(
			'a' => '1',
			'b' => '2',
			'c' => '3',
		);
		
		//set data
		$this->setJson(array(
			'link' => $link,
		));
	
		//view
		return $this->setRender('success');
	}
	
	public function add_link(){
		$title = $_GET['title'];
		$link = $_GET['link'];
		$sql = "insert into `link`(`title`, `link`) value('$title', '$link')";
		DataBaseHelper::query($sql, null, null);
		
		//view
		return $this->setRender('success');
	}
}