<?php
class PrepareParamFilter implements CFilter{
	function __construct(){
	}
	function __destruct(){
	}
	public function init($filterConfig){
	}
	
	/* If your visitor comes from proxy server you have use another function
	 to get a real IP address: */	
	private function getRealIPAddress(){
		$ip = '';
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			//check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED'])){
			$ip = $_SERVER['HTTP_X_FORWARDED'];
		}else if(!empty($_SERVER['HTTP_FORWARDED_FOR'])){
			$ip = $_SERVER['HTTP_FORWARDED_FOR'];
		}else if(!empty($_SERVER['HTTP_FORWARDED'])){
			$ip = $_SERVER['HTTP_FORWARDED'];
		}else if(!empty($_SERVER['REMOTE_ADDR'])){
			$ip = $_SERVER['REMOTE_ADDR'];
		}else{
			$ip = 'UNKNOWN';
		}
		return $ip;
	}
	
	public function doFilter($filterChain){
        //set $_SESSION[SESSION_GROUP]['languageCode']
        if(Session::isAdminLogin()){
        	 $_SESSION[SESSION_GROUP]['languageCode'] = $_SESSION[SESSION_GROUP]['admin_languageCode'];
        }
        else if(Session::isCustomerLogin()){
        	$_SESSION[SESSION_GROUP]['languageCode'] = $_SESSION[SESSION_GROUP]['customer_languageCode'];
        }
        else{	//not login
        	Session::setNotLogin();
        	$_SESSION[SESSION_GROUP]['languageCode'] = $_SESSION[SESSION_GROUP]['guest_languageCode'];
       }
        
        //GET LANGUAGE TRANSLATE OK
        $languageValueDao = new LanguageValueDao();
        $languageValueVos = $languageValueDao->selectAll();
        foreach($languageValueVos as $languageValueVo){
        	Registry::setLanguageValue($languageValueVo->languageCode, $languageValueVo->key, $languageValueVo->value);
       }

        //Get the client's a real IP address	OK
        Session::setSession('clientIP', $this->getRealIPAddress());		//setSession 1
        
        //MOBILE DETECT		OK
        Session::setSession('isMobile', DeviceHelper::isMobile());		//setSession 2
        
        //for upload file config
        Session::setSession('BASE_URL', Registry::getSetting('base_url'));
        Session::setSession('option_resize', Registry::getSetting('option_resize'));
        Session::setSession('image_small_width', Registry::getSetting('image_small_width'));
        Session::setSession('image_small_height', Registry::getSetting('image_small_height'));
      	Session::setSession('image_large_width', Registry::getSetting('image_large_width'));
        Session::setSession('image_large_height', Registry::getSetting('image_large_height'));
        Session::setSession('image_max_width', Registry::getSetting('image_max_width'));
        Session::setSession('image_max_height', Registry::getSetting('image_max_height'));
        
        Session::setSession('pageType', Session::getPageType());

        $filterChain->doFilter($filterChain);
	}
}