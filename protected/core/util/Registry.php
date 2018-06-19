<?php
class Registry
{
	private static $_system_settings_cache = array();
	private static $_system_language_cache = array();
    private static $_template_cache = array();
	private static $_config_cache = array();

	public static function setSetting($key, $value){
		self::$_system_settings_cache[$key] = $value;
	}
	public static function getSetting($key, $default = ''){
		if (isset(self::$_system_settings_cache[$key]))
			return self::$_system_settings_cache[$key];
		else
			return $default;
	}

	public static function setTemplate($key, $value){
		self::$_template_cache[$key] = $value;
	}
	public static function getTemplate($key, $default = ''){
		if (isset(self::$_template_cache[$key]))
			return self::$_template_cache[$key];
		else
			return $default;
	}

	public static function setLanguageValue($lang_code, $key, $value){
		self::$_system_language_cache[strtolower($lang_code)][strtolower($key)] = $value;
	}
	public static function getLanguageText($key, $value = ''){
		$replaceMark = '%s';
		$langCode = strtolower(Session::getLanguageCode());
		//get $langText
		$langText = (self::$_system_language_cache[$langCode][strtolower($key)]) ? self::$_system_language_cache[$langCode][strtolower($key)] : $key;

		//check value
		if (!is_array($value)) {    //string //default
			$langText = str_replace($replaceMark, $value, $langText);
		} else {
			$exp = explode($replaceMark, $langText);    //$exp = $exp[0] + $replaceMark + $exp[1] + $replaceMark +...
			//replace %s to value(array)
			$langText = '';
			foreach ($exp as $k => $v) {
				$langText .= $v . $value[$k];
			}
		}

		return $langText;
	}

	public static function setConfig($key, $value){
		self::$_config_cache[$key] = $value;
	}
	public static function getConfig($key, $default = ''){
		if (isset(self::$_config_cache[$key]))
			return self::$_config_cache[$key];
		else
			return $default;
	}
}

function e($key, $value=''){
	return Registry::getLanguageText($key, $value);
}