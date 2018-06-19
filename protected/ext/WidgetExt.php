<?php
class WidgetExt{
	/**
	 * get info of widget by $widgetId or $controller
	 * 
	 * @param int|string $id_controller
	 * @return widget object
	 */
	public static function getWidgetInfo_byId($widgetId){
		$sql = "select * from `widget` where `widget_id`=$widgetId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getWidgetInfo_byController($controller){
		$sql = "select * from `widget` where `controller`='$controller'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getPluginCodeArray(){
		$sql = "select * from `widget` group by plugin_code";
		$output = array(
			'type' => 'array',
			'key' => 'widget_id',
			'value' => 'plugin_code'
		);
		$query = DataBaseHelper::query($sql, null, $output);
		$pluginCodeArray = array(
			'system' => 'System'
		);
		foreach ($query as $v){
			if($v != ''){
				$pluginCodeArray[$v] = $v;
			}
		}
		return $pluginCodeArray;
	}
	
	/***********************************
	 * WIDGET CAT function
	 /***********************************/
	public static function getWidgetCatArray(){
		$sql = "select * from `widget_cat`";
		$output = array(
			'type' => 'array',
			'key' => 'widget_cat_id',
			'value' => 'name'
		);
		return DataBaseHelper::query($sql, null, $output);
	}
}