<?php

class SessionMessage{

	public static $SUCCESS 		= 'SUCCESS';
	public static $INFO 		= 'info';
	public static $WARN 		= 'warning';
	public static $ERROR 		= 'error';
    public static $WARNDEV 		= 'SYSTEM WARNING';
    public static $FIELD_ERROR 		    = 'FIELD_ERROR';
    public static $ACTION_ERROR 		= 'ACTION_ERROR';

	public static function addSessionMessage($status = "", $msg, $inputName = ''){
		if(empty($status))
			$status = self::$INFO;
        if($status != self::$WARNDEV){
            $_SESSION[SESSION_GROUP]['messages'][$status][] = e($msg);
            // add class validate_error_input to input have name = $inputName(message.php)
            // ZPham 	(08/10/2015)
            if($inputName != ''){
            	foreach((array)$inputName as $v){
            		$_SESSION[SESSION_GROUP]['messages']['inputError'][$v][] = e($msg);
            	}
           }
       }
        elseif($status == self::$WARNDEV){
            $_SESSION[SESSION_GROUP]['devMessages'][$status][] = e($msg);
       }
		
	}

	public static function getSessionMessageCount($status = ""){
		if(empty($status))
			$status = self::$INFO;

		if(empty($_SESSION[SESSION_GROUP]['messages']))
			return 0;

		if(empty($_SESSION[SESSION_GROUP]['messages'][$status]))
			return 0;

		return count($_SESSION[SESSION_GROUP]['messages'][$status]);
	}

	public static function setIsDisplay($isDisplay){
		$_SESSION[SESSION_GROUP]['message']['isDisplay'] = $isDisplay;
	}

	public static function getIsDisplay(){
		return $_SESSION[SESSION_GROUP]['message']['isDisplay'];
	}

	public static function getSessionMessages($devMessages = false){
		if($devMessages == false){
			return $_SESSION[SESSION_GROUP]['messages'];
       }
        else{
            return $_SESSION[SESSION_GROUP]['devMessages'];
       }
	}

	public static function clearSessionMessages($devMessages = false){
		if($devMessages == false){
		  unset($_SESSION[SESSION_GROUP]['messages']);
		}
		else{
		  unset($_SESSION[SESSION_GROUP]['devMessages']);
		}
        
	}

    public static function setJsonData($errorCode='SUCCESS', $errorMessage='', $extra=''){
        $_SESSION[SESSION_GROUP]['jsonData']['errorCode'] = $errorCode;
        $_SESSION[SESSION_GROUP]['jsonData']['errorMessage'] = $errorMessage;
        $_SESSION[SESSION_GROUP]['jsonData']['extra'] = $extra;
    }
    public static function getJsonData(){
        return $_SESSION[SESSION_GROUP]['jsonData'];
    }
    public static function clearJsonData(){
        unset($_SESSION[SESSION_GROUP]['jsonData']);
    }
}
?>