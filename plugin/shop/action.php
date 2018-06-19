<?php
class ShopAction{
	public static $pluginCode = 'shop';
	
	public static function init(){
        FileHelper::loadPlugin(self::$pluginCode);

		//get default currency
        $currencyCode = Session::getSession('currencyCode');
        if($currencyCode === null) {
            $currencyDetail = CurrencyExt::getDefaultCurrency();
            $currencyCode = $currencyDetail->currencyCode;
            Session::setSession('currencyCode', $currencyCode);
        }

		//set set_currency
		CurrencyExt::set_currency_all($currencyDetail);
	}
	
	public static function getInfo(){
		return array(
			'name' => 'Shop plugin',
			'description' => 'Shop plugin description',
			'version' => '1.0',
			'author' => 'TaiPV',
			'url' => 'zpham.com',
			'navLink' => array(
				array(
					'type' => 'main',
					'title' => 'Product',
					'order' => '3',
				),
				array(
					'parentTitle' => 'Product',
					'title' => 'Category manage',
					'link' => 'admin/category/manage',
					'icon' => 'fa fa-folder-open',
				),
				array(
					'parentTitle' => 'Product',
					'title' => 'Attribute manage',
					'link' => 'admin/attribute/manage',
					'icon' => 'fa fa-check',
				),
				array(
					'parentTitle' => 'Product',
					'title' => 'Product manage',
					'link' => 'admin/product/manage',
					'icon' => 'fa fa-product-hunt',
				),
			),
			'widget' => array(
				array(
					'widget_cat_id' => 5,
					'name' => 'Product relate',
					'controller' => 'ProductRelateWidget',
					'description' => 'Display product relate in product/detail page',
					'icon' => 'fa fa-bars',
				),
				array(
					'widget_cat_id' => 5,
					'name' => 'Customer review',
					'controller' => 'CustomerReviewWidget',
					'description' => 'Display customer review in product/detail page',
					'icon' => 'fa fa-comments',
				),
			),
			'page' => array(
// 				array(
// 					'name' => 'Product list',
// 					'dispatch' => 'home/product/list'
// 				),
// 				array(
// 					'name' => 'Product detail',
// 					'dispatch' => 'home/product/detail'
// 				),
// 				array(
// 					'name' => 'Product cart',
// 					'dispatch' => 'home/cart'
// 				),
// 				array(
// 					'name' => 'Product checkout',
// 					'dispatch' => 'home/checkout'
// 				),
// 				array(
// 					'name' => 'Store',
// 					'dispatch' => 'home/store'
// 				),
// 				array(
// 					'name' => 'Search',
// 					'dispatch' => 'home/search'
// 				),
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