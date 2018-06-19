<?php
final class CTTConfig
{
	public static function Instance(){
		static $inst = null;
		if($inst === null)
			$inst = new CTTConfig();
		return $inst;
	}

	private $actionMap;
	private $filters;

	private function __construct(){
	}

	public function setActionMap($actionMap){
		$this->actionMap=$actionMap;
	}

	public function getActionMap(){
		if(!isset($this->actionMap))
			return array();
		return $this->actionMap;
	}

	public function setFilters($filters){
		$this->filters=$filters;
	}

	public function getFilters(){
		if(!isset($this->filters))
			return array();
		return $this->filters;
	}

	public function addFilter($filter){
		$this->filters[]=$filter;
	}
}