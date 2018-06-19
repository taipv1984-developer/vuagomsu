<?php 
class DeviceHelper{
	
	/**
	 * check device isMobile
	 * 
	 * @return boolean
	 */
	public static function isMobile(){
    	$detect = new Mobile_Detect;
    	if($detect->isMobile()){
    		if($detect->isTablet()){
				return false;
    		}
    		else{
    			return true;
    		}
    	}
    	else{
    		return false;
    	}
	}
	
	/**
	 * check device isTable
	 *
	 * @return boolean
	 */
	public static function isTable(){
		$detect = new Mobile_Detect;
		if($detect->isMobile()){
			if($detect->isTablet()){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	/**
	 * check device isPC
	 *
	 * @return boolean
	 */
	public static function isPC(){
		$detect = new Mobile_Detect;
		if($detect->isMobile()){
			return false;
		}
		else{
			return true;
		}
	}
	
	/**
	 * echo name of device
	 */
	public static function view(){
		$detect = new Mobile_Detect;
		if($detect->isMobile()){
			if($detect->isTablet()){
				echo "TABLET: ";
				if($detect->version("Windows Phone")){
					echo "Windows Phone 8";
				}
				else if($detect->isiOS()){
					echo "iOS";
				}
				else if($detect->isAndroidOS()){
					echo "Android";
				}
			}
			else{
				echo "PHONE: ";
				if($detect->version("Windows Phone")){
					echo "Windows Phone 8";
				}
				else if($detect->isiOS()){
					echo "iOS";
				}
				else if($detect->isAndroidOS()){
					echo "Android";
				}
			}
		}
		else{
			echo "PC";
		}
	}
}
?>