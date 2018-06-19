<?php
class StaticPageExt{
	public static function getStaticPageInfo($staticPageId){
		$sql = "select * from static_page where static_page_id=$staticPageId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getStaticPageList(){
		$sql = "select * from static_page";
		return DataBaseHelper::query($sql);
	}
	
	/**********************
	 ROUTER
	 ********************/
	/**
	 * getAlias of $staticPageInfo
	 *
	 * @param object $staticPageInfo
	 * @param string $aliasBy
	 * @return
	 if $aliasBy='%name%'* => 			staticPageTitle
	 */
	public static function getAlias($staticPageInfo, $aliasBy='%name%'){
		$alias = '';
		if($aliasBy == '%name%'){
			$alias = trim($staticPageInfo->title);
		}
		else{
			LogUtil::devInfo("[StaticPageExt::getAlias] not found case aliasBy = $aliasBy");
		}
	
		$alias = StringHelper::getAlias($alias);
		return $alias;
	}
}