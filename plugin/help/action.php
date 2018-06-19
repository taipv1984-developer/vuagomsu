<?php
class HelpAction{
	public static $pluginCode = 'help';
	
	public static function getInfo(){
		return array(
			'name' => 'Help plugin',
			'description' => 'Help plugin Description',
			'version' => '1.0',
			'author' => 'TaiPV',
			'url' => 'zpham.com',
			'navLink' => array(
				array(
					'type' => 'main',
					'title' => 'Help',
					'order' => '999',
				),
				array(
					'parentTitle' => 'Help',
					'title' => 'Help list',
					'link' => 'admin/help/list',
					'icon' => 'fa fa-bars',
				),
				array(
					'parentTitle' => 'Help',
					'title' => 'Help category',
					'link' => 'admin/help_cat/manage',
					'icon' => 'fa fa-folder-open',
				),
				array(
					'parentTitle' => 'Help',
					'title' => 'Help manage',
					'link' => 'admin/help/manage',
					'icon' => 'fa fa-question-circle',
				),
			),
		);
	}
	
	public static function install(){
		//create table
		$sqlFile = PLUGIN_PATH.self::$pluginCode."/data/db/help_cat.sql";
		if(file_exists($sqlFile)){
			$sql = file_get_contents($sqlFile);
			DataBaseHelper::query($sql, null, null);
		}
		
		//create table
		$sqlFile = PLUGIN_PATH.self::$pluginCode."/data/db/help.sql";
		if(file_exists($sqlFile)){
			$sql = file_get_contents($sqlFile);
			DataBaseHelper::query($sql, null, null);
		}
	}
	
	public static function upgrade(){
		//upgrade function
	}
	
	public static function uninstall(){
		//drop table
		$sql = "drop table if exists help_cat";
		DataBaseHelper::query($sql, null, null);
	
		//drop table
		$sql = "drop table if exists help";
		DataBaseHelper::query($sql, null, null);
		
		//delete NavLink
		$params = array('pluginCode' => self::$pluginCode);
		NavLinkExt::deleteNavLink($params);
	}
}