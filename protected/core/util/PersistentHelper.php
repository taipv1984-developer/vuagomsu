<?php
Class PersistentHelper{
	public static function mapResult($class,$data){
		$results = array();
		if(isset($data)){
			foreach($data as $row){
				$object = new $class();
				foreach($row as $key=>$value){
					if(array_key_exists($key,$object->table_map)){
						$property = $object->table_map[$key];
						$object->$property=$value;
					}
				}
				//remove ->table_map out $object
				unset($object->table_map);
				$results[] = $object;
			}
		}
		return $results;
	}
}