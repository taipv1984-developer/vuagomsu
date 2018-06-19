<?php
class HelpExt{
	public static function getHelpCategoryArray(){
		//get $helpCount
		$sql = "select hc.help_cat_id, hc.`name`, COUNT(*) as count
from `help` as h
LEFT JOIN `help_cat` as hc on hc.help_cat_id = h.help_cat_id
where hc.`status`='A'				
GROUP BY hc.help_cat_id";
		$query = DataBaseHelper::query($sql);
		$helpCount = array();
		foreach ($query as $v){
			$helpCount[$v->helpCatId] = $v;
		}
		 
		//get helpCat
		$sql = "select * from help_cat where `status`='A'";
		$query = DataBaseHelper::query($sql);
		$helpCat = array();
		foreach ($query as $v){
			if(isset($helpCount[$v->helpCatId])){
				$helpCat[$v->helpCatId] = $v->name .' ('. $helpCount[$v->helpCatId]->count. ')';
			}
			else{
				$helpCat[$v->helpCatId] = $v->name;
			}
		}
	
		return $helpCat;
	}
	
	/**
	 * get help list and group by helpCatId
	 */
	public static function getHelpList(){
		$helpList = array();
		
		$sql = "select * from help";
		$query = DataBaseHelper::query($sql);
		foreach ($query as $v){
			$helpList[$v->helpCatId][] = $v;
		}
		
		return $helpList;
	}
	
	/**
	 * get help array (helpId -> title) and group by helpCatId
	 */
	public static function getHelpArray(){
		$helpArray = array();
	
		$sql = "select * from help";
		$query = DataBaseHelper::query($sql);
		foreach ($query as $v){
			$helpArray[$v->helpCatId][$v->helpId] = $v->title;
		}
	
		return $helpArray;
	}
	
	public static function getRelatedList($helpCatId){
		$sql = "select * from help
where help_cat_id=:helpCatId";
		$params = array(
			array(':helpCatId', $helpCatId),
		);
		return DataBaseHelper::query($sql, $params);
	}
	
	public static function getRouterArray(){
		$routerHelp = array();
		
		$sql = "select * from help";
		$params = array();
		$query = DataBaseHelper::query($sql, $params);
		foreach ($query as $v){
			if(!trim($v->router)) continue;
			
			$router = explode("\n", trim($v->router));
			foreach ($router as $r){
				$routerHelp[trim($r)][$v->helpId] = $v->title;
			}
		}
		
		return $routerHelp;
	}
}