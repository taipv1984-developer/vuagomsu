<?php
class CTTMvcFilter implements CFilter
{
	function __construct(){
	}

	function __destruct(){
	}

	public function init($filterConfig){

	}

	public function doFilter($filterChain){
		$actionMap = CTTConfig::Instance()->getActionMap();

		if(isset($actionMap[$_REQUEST[ACTION_PARAM]])){
			$class = $actionMap[$_REQUEST[ACTION_PARAM]]['controller'];
			$reflectClass = new ReflectionClass($class);
			$instance = $reflectClass->newInstanceArgs();
			$props   = $reflectClass->getProperties(ReflectionProperty::IS_PUBLIC);
				
			CTTHelper::arrayToObject($_REQUEST, $instance);
			foreach($props as $prop){
				$value = $prop->getValue($instance);
				if(is_object($value)){
					CTTHelper::arrayToObject($_REQUEST, $value, $prop->getName());
					$prop->setValue($instance,$value);
				}
			}

			$actionMethod = $actionMap[$_REQUEST[ACTION_PARAM]]['method'];
			$reflectionMethod = new ReflectionMethod($class, 'execute');
			$reflectionMethod->invoke($instance,$actionMethod);
			CTTHelper::objectToArray($_REQUEST, $instance);
			foreach($props as $prop){
				$value = $prop->getValue($instance);
				if(is_object($value)){
					CTTHelper::objectToArray($_REQUEST, $value, $prop->getName());
				}
			}
		}
		unset($actionMap);
		$filterChain->doFilter();
	}
}