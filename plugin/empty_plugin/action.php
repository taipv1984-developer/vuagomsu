<?php
class EmptyAction{
	public static $pluginCode = 'empty';
	
	public static function getInfo(){
		return array(
			'name' => 'Empty plugin',
			'description' => 'Empty plugin description',
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