<?php
class CurrencyExt{
    /**
     *
     * @param string $template Set the template will be called such as: button,input,breadcums
     * @param string $area Set the area is admin or main, ... etc
     * @param array $params params will be used by the template */
    private static $_currency_cache = array();
    private static $format_value;
    private static $rate_value;

    public static function getSymbol(){
    	return self::get_currency('symbol');
    }
    public static function set_currency($key, $value){
        self::$_currency_cache[$key]=$value;
   }

    public static function get_currency($key, $default = ''){
        if(isset(self::$_currency_cache[$key]))
            return self::$_currency_cache[$key];
        else
            return $default;
   }
    
    public static function format_price($value, $space = ' ', $decimals='', $decimalsSeparator='', $thousandsSeparator=''){
    	if($decimals == ''){
    		$decimals = self::get_currency('decimals');
    	}
    	if($decimalsSeparator == ''){
    		$decimalsSeparator = self::get_currency('decimalsSeparator');
    	}
    	if($thousandsSeparator == ''){
    		$thousandsSeparator = self::get_currency('thousandsSeparator');
    	}
        self::$rate_value = doubleval(self::get_currency('coefficient'))*doubleval($value);
        if(self::get_currency('after_sum') == 'Y'){
            self::$format_value = number_format(
            	self::$rate_value,
            	$decimals,
            	$decimalsSeparator,
            	$thousandsSeparator).$space.self::get_currency('symbol');
        }
        else{
            self::$format_value = self::get_currency('symbol').$space.number_format(
            	self::$rate_value,
            	$decimals,
            	$decimalsSeparator,
            	$thousandsSeparator);
        }
        return self::$format_value;
   }
    
    public static function get_price($value){
        self::$rate_value = doubleval(self::get_currency('coefficient'))*doubleval($value);
        return self::$rate_value;
   }
    
    public static function get_price2($value){
   		self::$rate_value = doubleval($value)/doubleval(self::get_currency('coefficient'));
   		return self::$rate_value;
    }
   
    public static function getCurrency($currency, $params){
        $currencyVo = new CurrencyVo();
        $currencyDao = new CurrencyDao();
        $currencyVos = $currencyDao->selectByFilter($currencyVo);

        include VIEW_PATH.Registry::getTemplate('templateName').'/'.$currency;
   }
    
    /**
     * set_currency_all
     * 
     * @param object|string $currencyInfo(edit)
     */
    public static function set_currency_all($currencyInfo){
    	self::set_currency('currencyCode', $currencyInfo->currencyCode);
    	self::set_currency('description', $currencyInfo->description);
    	self::set_currency('after_sum', $currencyInfo->after);
    	self::set_currency('symbol', $currencyInfo->symbol);
    	self::set_currency('coefficient', $currencyInfo->coefficient);
    	self::set_currency('decimalsSeparator', $currencyInfo->decimalsSeparator);
    	self::set_currency('decimals', $currencyInfo->decimals);
    	self::set_currency('thousandsSeparator', $currencyInfo->thousandsSeparator);
   }

    /**
     * get list all currency in database
     *
     * @param string $option
     * 		(default = object -> array object else return array(currency_code => description)
     * @return array
     */
    public static function getCurrencyList($option='object'){
    	$currencyDao = new CurrencyDao();
    	$currencyVos = $currencyDao->selectAll();
    	if($option == 'object'){
    		return $currencyVos;
    	}
    	else{
    		$curencyList = array();
    		foreach($currencyVos as $v){
    			$curencyList[$v->currencyCode] = $v->description;
    		}
    		return $curencyList;
    	}
   }
    
    /**
     * getDefaultCurrency
     *
     * @return object|NULL
     */
    public static function getDefaultCurrency(){
    	$currencyVo = new CurrencyVo();
        $currencyVo->isPrimary = 'Y';
    	$currencyDao = new CurrencyDao();
    	$currencyVos = $currencyDao->selectByFilter($currencyVo);
    	if($currencyVos){
    		return $currencyVos[0];
    	}
    	else{
    		LogUtil::error("(CurrencyExt/getDefaultCurrency)not search default currency");
    		return null;
    	}
   }
   
   /**
    * update currency set is_primary='N'
    */
   public static function resetDefaultCurrency(){
	   	$sql = "update currency set is_primary='N'";
	   	DataBaseHelper::query($sql, array(), 'update');
   }
}