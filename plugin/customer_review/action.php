<?php
class CustomerReviewAction{
	public static $pluginCode = 'customer_review';
	
	public static function getInfo(){
		return array(
			'name' => 'Customer review plugin',
			'description' => 'Customer review plugin description',
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