<?php

class CTTHelper{

    public static function isEmptyString($question){
        return(!isset($question)|| trim($question)=== '');
   }

    public static function IsNullOrEmptyArray($question){
        return(empty($question));
   }

    public static function addDate($mysqlDateStr, $unit, $value){
        if(CTTHelper::isEmptyString($mysqlDateStr))
            return null;
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $mysqlDateStr);
        $d->add(new DateInterval('P' . $value . $unit));
        return $d->format('Y-m-d H:i:s');
   }

    public static function subDate($mysqlDateStr, $unit, $value){
        if(CTTHelper::isEmptyString($mysqlDateStr))
            return null;
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $mysqlDateStr);
        $d->sub(new DateInterval('P' . $value . $unit));
        return $d->format('Y-m-d H:i:s');
   }

    public static function mySqlStringDate2String($mysqlDateStr, $format){
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $mysqlDateStr);
        $str = $d->format($format);
        if(str != false)
            return $d->format($format);
        else
            return null;
   }

    public static function mySqlStringDate2Date($mysqlDateStr){
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $mysqlDateStr);
        return $d;
   }

    public static function arrayToObject($arr, &$object, $prefix = null, $onlyVar = true){

        if(!CTTHelper::isEmptyString($prefix)){
            $prefix .='_';
       }else{
            $prefix = '';
       }

        if(!isset($arr))
            return $object;

        $reflect = new ReflectionClass($object);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $propMap = array();
        foreach($props as $prop){
            $propMap[strtolower($prefix . $prop->getName())] = $prop;
       }

        foreach($arr as $key => $value){
            if(isset($propMap[strtolower($key)])){
                if($onlyVar){
                    if(!is_object($propMap[strtolower($key)]->getValue($object)))
                        $propMap[strtolower($key)]->setValue($object, $value);
               }
                else
                    $propMap[strtolower($key)]->setValue($object, $value);
           }
       }

        return $object;
   }

    public static function objectToArray(&$arrReference, $class, $prefix = null, $onlyVar = true){

        $reflect = new ReflectionClass($class);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $prefixPropName = '';

        if(!CTTHelper::isEmptyString($prefix))
            $prefixPropName = $prefix . '_';
        foreach($props as $prop){
            $value = $prop->getValue($class);
            if($onlyVar){
                if(!is_object($value)){
                    $arrReference[$prefixPropName . $prop->getName()] = $value;
               }
           }else{
                $arrReference[$prefixPropName . $prop->getName()] = $value;
           }
       }
   }

    public static function copyProperties($source, $destination){

        if(!isset($source)|| !isset($destination))
            return;

        $reflect = new ReflectionClass($source);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $propMap = array();
        foreach($props as $prop){
            $propMap[strtolower($prop->getName())] = $prop;
       }

        $reflect = new ReflectionClass($destination);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach($props as $prop){
            if(isset($propMap[strtolower($prop->getName())])){
                $prop->setValue($destination, $propMap[strtolower($prop->getName())]->getValue($source));
           }
       }
   }

    public static function getRequestProperty($propertyName, $default = ''){
        $propName = str_replace(".", "_", $propertyName);
        if(isset($_REQUEST[$propName])){
            return $_REQUEST[$propName];
       }
        else
            return $default;
   }

    public static function printValue($value, $default = ''){
        if(isset($value)){
            echo $value;
       }
        else
            echo $default;
   }

    public static function printRequestProperty($propertyName, $default = ''){
        $propName = str_replace(".", "_", $propertyName);
        if(isset($_REQUEST[$propName])){
            echo $_REQUEST[$propName];
       }
        else
            echo $default;
   }

    public static function stretchImageInfo($maxWidth, $maxHeight, $imagePath){
        list($width, $height)= getimagesize($imagePath);
        if($width > $maxWidth || $height > $maxHeight){
            $nW = $width / $maxWidth;
            $nH = $height / $maxHeight;
            $nS = ($nW > $nH)? $nW : $nH;
            $width = $width / $nS;
            $height = $height / $nS;
       }

        return array($width,
            $height);
   }

    /**
     * Copy value from $_REQUEST to vo object(apply add, edit method)
     *  
     * @param tring $voObject
     * @return $voObject with value from $_REQUEST
     */
  	public static function copyRequest($voObject){
  		$reflect = new ReflectionClass($voObject);
    	$props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
    	foreach($props as $prop){
    		$name = $prop->name;
    		$class = $prop->class;
    		$key = lcfirst(substr($class, 1, strlen($class)-3))."Model_$name"; //CObjectVo -> ObjectModel
    		if(isset($_REQUEST[$key])){
    			$voObject->$name = $_REQUEST[$key];
    		}
    	}
  	}
}