<?php
class ContactAction{
	public static $pluginCode = 'contact';
	
	public static function getInfo(){
		return array(
			'name' => 'Contact',
			'description' => 'Contact pescription',
			'version' => '1.0',
			'author' => 'TaiPV',
			'url' => 'zpham.com',
            'navLink' => array(
                array(
                    'type' => 'main',
                    'title' => 'More',
                    'order' => '999',
                ),
                array(
                    'parentTitle' => 'More',
                    'title' => 'Contact manage',
                    'link' => 'admin/contact/manage',
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