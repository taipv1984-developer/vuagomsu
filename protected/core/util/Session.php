<?php
class Session{
	/**
	 * set login for(admin/customer)	OK
	 * 
	 * @param object $data(admin object/customer object)
	 * @param string $sessionType identify admin or customer
	 */
	public static function setLogin($data, $sessionType){
		switch($sessionType){
			case 'admin':
				$id = $data->adminId;
				break;
			case 'customer':
				$id = $data->customerId;
				break;
			default:
				LogUtil::devInfo("[Session/setLogin] error sessionType = $sessionType incorrect");
				return null;
				break;
		}
		
		//get role info
		$roleDao = new RoleDao($GLOBALS['conn']);
		$roleInfo = $roleDao->selectByPrimaryKey($data->roleId);
		
		//set $_SESSION[SESSION_GROUP]
		$_SESSION[SESSION_GROUP][$sessionType.'Id'] = $id;
		$_SESSION[SESSION_GROUP][$sessionType.'_roleId'] = $data->roleId;
		$_SESSION[SESSION_GROUP][$sessionType.'_roleName'] = $roleInfo->roleName;	//Admin/Customer/Guest
		$_SESSION[SESSION_GROUP][$sessionType.'_email'] = $data->email;
		$_SESSION[SESSION_GROUP][$sessionType.'_username'] = $data->username;
		$_SESSION[SESSION_GROUP][$sessionType.'_name'] = trim($data->firstName." ".$data->lastName);	//for customer
		$_SESSION[SESSION_GROUP][$sessionType.'_status'] = $data->status;
		$_SESSION[SESSION_GROUP][$sessionType.'_isLogin'] = 1;
		$_SESSION[SESSION_GROUP]['is_'.$sessionType] = $sessionType;
		//permission
		$permission = self::getPermission($data->roleId);
		$_SESSION[SESSION_GROUP][$sessionType.'_permission'] = $permission;
		//languageCode
		$_SESSION[SESSION_GROUP][$sessionType.'_languageCode'] = $data->languageCode;
        //countryCode
        $_SESSION[SESSION_GROUP][$sessionType.'_countryCode'] = LanguageExt::getCountryCodeFromLanguageCode($data->languageCode);
		//filemanager_access_key
		if($sessionType == 'admin'){
            Session::setSession('filemanager_access_key', StringHelper::getRandomCode());
        }
		//newsletterPopup
        Session::setSession('newsletterPopup', flase);
	}
	
	/**
	 * set not login 	OK
	 * set session roleId=1, roleName=Guest
	 */
	public static function setNotLogin(){
		$roleId = 1;				//hardcode
		$sessionType = 'guest';		//hardcode
		$_SESSION[SESSION_GROUP][$sessionType.'_roleId'] = $roleId;
		$_SESSION[SESSION_GROUP][$sessionType.'_roleName'] = 'Guest';
		//permission
		$_SESSION[SESSION_GROUP][$sessionType.'_permission'] = self::getPermission($roleId);
		//languageCode
		if(!isset($_SESSION[SESSION_GROUP]['guest_languageCode'])){
			$languageDefault = LanguageExt::getDefaultLanguage();
			$_SESSION[SESSION_GROUP]['guest_languageCode'] = $languageDefault->languageCode;
		}
	}
	
	/**
	 * set logout 	OK
	 */
	public static function setLogout(){
		$sessionType = self::getSessionType();
		unset($_SESSION[SESSION_GROUP][$sessionType.'Id']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_roleId']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_roleName']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_email']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_username']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_name']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_status']);
		unset($_SESSION[SESSION_GROUP][$sessionType.'_isLogin']);
		//permission
		unset($_SESSION[SESSION_GROUP][$sessionType.'_permission']);
		//languageCode
		unset($_SESSION[SESSION_GROUP][$sessionType.'_languageCode']);
        //countryCode
        unset($_SESSION[SESSION_GROUP][$sessionType.'_countryCode']);
		//clear...
		unset($_SESSION[SESSION_GROUP]['languageCode']);
		unset($_SESSION[SESSION_GROUP]['countryCode']);
		unset($_SESSION[SESSION_GROUP]['guest_languageCode']);
        //filemanager_access_key
        if($sessionType == 'admin'){
            Session::deleteSession('filemanager_access_key');
        }
		//newsletterPopup
        Session::deleteSession('newsletterPopup');
        //pluginCodeMap
        Session::deleteSession('pluginCodeMap');
	}
	
	/**
	 * getSessionType of sesion 	OK
	 * 
	 * @return string(admin/customer/guest)
	 */
	public static function getSessionType(){
		$pageType = self::getPageType();
		switch($pageType){
			case 'admin':
				return (self::isAdminLogin())? 'admin' : 'guest';
				break;
			case 'frontend':
				return (self::isCustomerLogin())? 'customer' : 'guest';
				break;
		}
	}

	/**
	 * set session value of array $_SESSION[SESSION_GROUP]	OK
	 * 
	 * @param string $session key of array
	 * @param string $sessionValue value of array
	 */
	public static function setSession($session, $sessionValue){
		$_SESSION[SESSION_GROUP][$session] = $sessionValue;
	}
	
	/**
	 * get session of array $_SESSION[SESSION_GROUP]		OK
	 * 
	 * @param string $name key of array
	 * @param string $default=null value default return
	 * @return string
	 */
	public static function getSession($name, $default = null){
		if(!isset($_SESSION[SESSION_GROUP][$name]))
			return $default;
		else
			return $_SESSION[SESSION_GROUP][$name];
	}
	
	/**
	 * deleteSession have name = $sessionName
	 *
	 * @param string $sessionName
	 */
	public static function deleteSession($sessionName){
		unset($_SESSION[SESSION_GROUP][$sessionName]);
	}
	
	/**
	 * getPageType of current page 	*** 	OK
	 * apply check login in per page 
	 * 
	 * @return string(admin | frontend)
	 */
	public static function getPageType(){
	$queryString = strtolower($_SERVER['QUERY_STRING']);	//'QUERY_STRING' => string 'r=admin/layout/manage&action=edit&layoutId=20'(length=45)
		$iApi = strpos($queryString, ACTION_PARAM."=api");
		if($iApi === 0){
			return 'api';
		}
		else{
			$iAdmin = strpos($queryString, ACTION_PARAM."=admin");
			if($iAdmin === 0){
				return 'admin';
			}
			else{
				return 'frontend';
			}
		}
	}
	
	/** get isCustomerActive	OK
	 *
	 * @return boolean
	 */
	public static function isCustomerActive(){
		return($_SESSION[SESSION_GROUP]['customer_status'] == 'A')? true : false;
	}
	
	/**
	 * get is admin login 	OK
	 * @return boolean
	 */
	public static function isAdminLogin(){
		$pageType = self::getPageType();
		if($pageType == 'admin' && $_SESSION[SESSION_GROUP]['admin_isLogin'] && $_SESSION[SESSION_GROUP]['adminId']){
			return true;
		}
		return false;
	}
	
	/**
	 * get is customer login 	OK
	 * @return boolean
	 */
	public static function isCustomerLogin(){
		$pageType = self::getPageType();
		if($pageType == 'frontend' && $_SESSION[SESSION_GROUP]['customer_isLogin'] && $_SESSION[SESSION_GROUP]['customerId']){
			return true;
		}
		return false;
	}
	
	/**
	 * get is admin by check $pageType && $_SESSION[SESSION_GROUP]['adminId']		OK
	 *
	 */
	public static function isAdmin(){
		$pageType = self::getPageType();
		return($pageType == 'admin' && isset($_SESSION[SESSION_GROUP]['adminId']))? true : false;
	}
	
	/**
	 * get is customer by check $pageType && $_SESSION[SESSION_GROUP]['customerId'] 	OK
	 *
	 */
	public static function isCustomer(){
		$pageType = self::getPageType();
		if($pageType == 'frontend'){
			return isset($_SESSION[SESSION_GROUP]['customerId'])? true : false;
		}
		else{
			return false;
		}
	}
	
	/**
	 * get is guest by check $pageType &&  $_SESSION[SESSION_GROUP]['customerId'] 	OK
	 *
	 */
	public static function isGuest(){
		$pageType = self::getPageType();
		if($pageType == 'frontend'){
			return isset($_SESSION[SESSION_GROUP]['customerId'])? false : true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * getAdminId(not fount return null)		OK
	 *
	 * @return number
	 */
	public static function getAdminId(){
		return isset($_SESSION[SESSION_GROUP]['adminId'])? $_SESSION[SESSION_GROUP]['adminId'] : null;
	}
	
	/**
	 * getCustomerId(not fount return null)		OK
	 *
	 * @return number
	 */
	public static function getCustomerId(){
		return isset($_SESSION[SESSION_GROUP]['customerId'])? $_SESSION[SESSION_GROUP]['customerId'] : null;
	}
	
	/**
	 * getAdminUsername
	 * 
	 * @return string|null
	 */
	public static function getAdminUsername(){
		return isset($_SESSION[SESSION_GROUP]['admin_username'])? $_SESSION[SESSION_GROUP]['admin_username'] : null;
	}
	
	/**
	 * getCustomerUsername
	 * 
	 * @return string|null
	 */
	public static function getCustomerUsername(){
		return isset($_SESSION[SESSION_GROUP]['customer_username'])? $_SESSION[SESSION_GROUP]['customer_username'] : null;
	}
	
	public static function getCustomerName(){
		return isset($_SESSION[SESSION_GROUP]['customer_name'])? $_SESSION[SESSION_GROUP]['customer_name'] : null;
	}
	
	/**
	 * get roleId of loginer(not fount return null)	OK		
	 *
	 * @return number
	 */
	public static function getRoleId(){
		$sessionType = Session::getSessionType();
		return isset($_SESSION[SESSION_GROUP][$sessionType.'_roleId'])? $_SESSION[SESSION_GROUP][$sessionType.'_roleId'] : null;
	}
	
    /**
     * get all permission by $roleId or session OK
     * call when set login or guest
     * 
     * @return array encoded
     */
    public static function getPermission($roleId=0){
    	if($roleId === 0){
    		$pageType = self::getPageType();
    		$permission = array();
    		switch($pageType){
    			case 'admin':
    				$permission = $_SESSION[SESSION_GROUP]['admin_permission'];
    				break;
    			case 'frontend':	//customer or guest
    				//check customer or guest
    				if(isset($_SESSION[SESSION_GROUP]['customerId'])){
    					$permission = $_SESSION[SESSION_GROUP]['customer_permission'];
    				}
    				else{
    					$permission = $_SESSION[SESSION_GROUP]['guest_permission'];
    				}
    				break;
    		}
    		return $permission;
    	}
    	else{
    		$rolePermissionDao = new RolePermissionDao();
    		$permission = $rolePermissionDao->getValueByField('permission', array('roleId' => $roleId));
    		return json_decode($permission);
    	}
   }
    
    /**
     * getIpAddress
     */
    public static function getIpAddress(){
    	return $_SESSION[SESSION_GROUP]['clientIP'];
   }
    
    /**
     * getAdminEmail
     */
    public static function getAdminEmail(){
    	return $_SESSION[SESSION_GROUP]['admin_email'];
   }
    
    /**
     * getCustomerEmail
     */
    public static function getCustomerEmail(){
    	return $_SESSION[SESSION_GROUP]['customer_email'];
   }
    
    /**
     * getLanguageCode(en, vi, fr...)
     * 
     * @return string
     */
    public static function getLanguageCode(){
    	if(isset($_SESSION[SESSION_GROUP]['languageCode'])){
    		return $_SESSION[SESSION_GROUP]['languageCode'];
    	}
    	else{
    		return DEFAULT_LANGUAGE;
    	}
   }
	/**
     * check admin have permission of link
     * 
     * @param string $link
     * @return boolean 
     */
    public static function havePermission($link){
    	if($link == '#' || $link == ''){
    		return true;
    	}
    	else{
	    	$permission = self::getPermission();
	    	$exp = explode('&', $link);
	    	$link = $exp[0];
	    	$link = str_replace('index.php?r=', '', $link);
			return in_array($link, $permission);
    	}
   }
}
?>