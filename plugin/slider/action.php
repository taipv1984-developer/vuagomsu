<?php
class SliderAction{
	public static $pluginCode = 'slider';
	
	public static function getInfo(){
		return array(
			'name' => 'Slider plugin',
			'description' => 'Manage mutil slider images and show out home by widget',
			'version' => '1.0',
			'author' => 'TaiPV',
			'url' => 'zpham.com',
			'navLink' => array(
				array(
					'parentTitle' => 'Plugin',
					'title' => 'Slider list',
					'link' => 'admin/slider/manage',
					'icon' => 'fa fa-sliders',
				),
			),
			'widget' => array(
				array(
					'widget_cat_id' => 4,
					'name' => 'Slider',
					'controller' => 'SliderWidget',
					'description' => 'Display slider in home page',
					'icon' => 'fa fa-sliders',
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