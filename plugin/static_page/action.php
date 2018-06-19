<?php
class StaticPageAction{
	public static $pluginCode = 'static_page';
	
	public static function getInfo(){
		return array(
			'name' => 'Static page plugin',
			'description' => 'Static page plugin description',
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