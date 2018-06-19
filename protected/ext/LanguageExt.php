<?php
class LanguageExt{
	public static function getLanguageList(){
		$languageDao = new LanguageDao();
		return $languageDao->selectAll();
	}
    
    /**
     * getDefaultLanguage
     * 
     * @return object|NULL
     */
    public static function getDefaultLanguage(){
    	$languageVo = new LanguageVo();
    	$languageVo->default = 1;
    	$languageDao = new LanguageDao();
    	$languageVos = $languageDao->selectByFilter($languageVo);
    	if($languageVos){
    		return $languageVos[0];
    	}
    	else{
    		LogUtil::devInfo("[LanguageExt::getDefaultLanguage] not search default language");
    		return null;
    	}
   }
   
   /**
    * resetDefaultLanguage set `default`=0
    */
   public static function resetDefaultLanguage(){
   		$sql = "update language set `default`=0";
   		DataBaseHelper::query($sql, null, null);
   }
   
   /**
    * get all language value of language have $languageCode
    * 
    * @param string $languageCode
    * @return array(object)
    */
   public static function getLanguageValue($languageCode){
   		$sql = "select * from language_value
where language_code=:languageCode";
   		$params = array(
   			array(':languageCode', $languageCode, 'str')
   		);
   		return DataBaseHelper::query($sql, $params);
   }

    public static function getCountryCodeFromLanguageCode($languageCode){
        $languageDao = new LanguageDao();
        $languageVo = new LanguageVo();
        $languageVo->languageCode = $languageCode;
        $languageVos = $languageDao->selectByFilter($languageVo);
        if($languageVos){
            return $languageVos[0]->countryCode;
        }
        else{
            return '';
        }
    }
}