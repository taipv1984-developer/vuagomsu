<?php
class SliderExt{
	/**
	 * getSliderInfo
	 * 
	 * @return slider object
	 */
	public static function getSliderInfo($sliderId){
		$sql = "select * from slider where slider_id=:sliderId";
		$params = array(
			array(':sliderId', $sliderId)
		);
		$query = DataBaseHelper::query($sql, $params);
		return ($query) ? $query[0] : false;
	}
	
	/**
	 * getSliderArray
	 * 
	 * @return array(slider_id -> name) of all slider active
	 */
	public static function getSliderArray(){
		$sql = "select * from slider";
		$output = array(
			'type' => 'array',  	//object* || array	(required)
			'key' => 'slider_id',	//not required
			'value' => 'name'		//required if type=array
		);
		return DataBaseHelper::query($sql, null, $output);
	}
	
	/**
	 * getImageList of $sliderId order by order
	 * 
	 * @param int $sliderId
	 * @return array
	 */
	public static function getImageList($sliderId){
		$sql = "select * from slider_image where slider_id=:sliderId order by `order` ASC";
		$params = array(
			array(':sliderId', $sliderId)
		);
		return DataBaseHelper::query($sql, $params);
	}
	
	/**
	 * delete slider and slider_image table
	 * 
	 * @param int $sliderId
	 */
	public static function delete($sliderId){
		//delete slider_image
		$sql = "delete from slider_image where slider_id=:sliderId";
		$params = array(
			array(':sliderId', $sliderId)
		);
		DataBaseHelper::query($sql, $params, null);
		
		//delete slider
		$sql = "delete from slider where slider_id=:sliderId";
		$params = array(
			array(':sliderId', $sliderId)
		);
		DataBaseHelper::query($sql, $params, null);
	}
}