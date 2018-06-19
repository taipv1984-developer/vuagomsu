<?php
class NewsAction{
	public static $pluginCode = 'news';
	
	public static function getInfo(){
		return array(
			'name' => 'News plugin',
			'description' => 'News description',
			'version' => '1.0',
			'author' => 'TaiPV',
			'url' => 'zpham.com',
			'navLink' => array(
					array(
							'type' => 'main',
							'title' => 'News',
							'order' => '999',
					),
					array(
							'parentTitle' => 'News',
							'title' => 'News manage',
							'link' => 'admin/news/manage',
							'icon' => 'fa fa-file-o',
					),
			),
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