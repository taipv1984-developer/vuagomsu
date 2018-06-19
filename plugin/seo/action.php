<?php
class SeoAction{
	public static $pluginCode = 'seo';
	
	public static function getInfo(){
		return array(
			'name' => 'Seo plugin',
			'description' => 'Seo plugin description',
			'version' => '1.0',
			'author' => 'TaiPV',
			'url' => 'zpham.com',
		);
	}
	
	public static function install(){
		//create table
	}
	
	public static function upgrade(){
		//upgrade function
	}
	
	public static function uninstall(){
		//drop db
		//drop menu
	}
}