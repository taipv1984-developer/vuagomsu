<?php

class AuthorizationCheckFilter implements CFilter
{
    function __construct(){
   }

    function __destruct(){
   }

    public function init($filterConfig){
   }

    public function doFilter($filterChain){
		$filterChain->doFilter($filterChain); //test

//    	$pageType = Session::getPageType();
//    	$page = $_REQUEST[ACTION_PARAM];
//    	$notCheckPermissionPage = array(
//    		'admin/index',
//    		'admin/login',
//    		'admin/logout',
//    		'admin/forget_password',
//    		'admin/reset_password',
//    		'admin/active/account',
//    			'home/register',
//    			'home/forget_password',
//    			'home/reset_password',
//		);
//    	$permission = Session::getPermission();
//		if($pageType == 'api' || in_array($page, $notCheckPermissionPage) || in_array($page, $permission)){
//			$filterChain->doFilter($filterChain);
//		}
//		else{
//			LogUtil::devInfo("[AuthorizationCheckFilter][hasPermission]=false r = {$_REQUEST[ACTION_PARAM]}");
//			$_REQUEST['AuthorizationCheckFilter']['hasPermission'] = false;
//		}
   }
}