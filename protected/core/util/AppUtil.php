<?php
class AppUtil{
	public static function isEmptyString($string){
		if (!isset($string) || trim($string) === '') {
			return true;
		}
		return false;
	}

    public static function defaultIfEmpty($var, $default = ''){
        return (!isset($var) || is_null($var) || empty($var)) ? $default : $var;
    }

	public static function copyProperties($array, &$object){
        $objectVars = get_object_vars($object);
		foreach ($objectVars as $key => $value) {
			if (isset($array[$key])) {
				$object->$key = $array[$key];
			}
		}
	}

	public static function getMicroTime(){
		$microtime = microtime();
		$parts = explode(" ", $microtime);
		return $parts[1];
	}

	public static function camelCase($str){
		$arr = explode("_", $str);
		$first = strtolower($arr[0]);
		$result = $first;
		for ($i = 1; $i < count($arr); $i++) {
			$result .= ucfirst($arr[$i]);
		}
		return $result;
	}

	public static function pascalCase($str){
		return ucfirst(self::camelCase($str));
	}

	public static function getUniqueString(){
		return uniqid(date("YmdHis_"));
	}

	public static function getMilliseconds(){
		$mt = explode(' ', microtime());
		return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}

	public static function generateToken($unique, $manageClass = null, $method = null){
		$str = self::defaultIfEmpty($unique, "") . self::defaultIfEmpty($manageClass, "") . self::defaultIfEmpty($method, "");
		return password_hash($str, PASSWORD_DEFAULT, [
				'cost' => 12
		]);
	}
	
	public static function createFolder($folderPath){
		if (!file_exists($folderPath)) {
			mkdir($folderPath, 0777, true);
		}
	}

	public static function isXml($string) {
		$xmlVersion = '<?xml version="1.0" encoding="UTF-8"?>';
		if (false === strpos($string, $xmlVersion)) {
			return false;
		}
		return true;
	}
}