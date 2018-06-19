<?php
class SettingExt{
	public static function getSettingType($notShow=array()){
		$sql = "select * 
from setting_group
group by setting_type
order by `order`";
		$query = DataBaseHelper::query($sql);
		$settingType = array();
		foreach ($query as $v){
			$settingType[$v->settingType] = StringHelper::toUcfirst($v->settingType);
		}
		
		return $settingType;
	}
    
	/**
	 * get all setting group of settingType sorted by `order`
	 * 
	 * @param string $settingType
	 * @return Array
	 */
	public static function getSettingGroup($settingType){
		$sql = "select *
from setting_group
where setting_type=:settingType
order by `order`";
		$params = array(
			array(':settingType', $settingType, 'str')
		);
		$output = array(
			'type' => 'object',
			'key' => 'setting_group_id'
		);
		$query = DataBaseHelper::query($sql, $params,  $output);
		return $query;
	}
}