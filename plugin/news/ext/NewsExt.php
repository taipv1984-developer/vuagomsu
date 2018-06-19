<?php 
class NewsExt{
	public static function getNewsInfo($newsId){
		$sql = "select * from news where news_id=$newsId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getFilter($filter, $order, $start, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($order);
		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
		$sql = "SELECT n.*
		FROM news as n
		LEFT JOIN news_category as nc on nc.news_category_id=n.news_category_id
		$whereCondition $orderCondition $limitCondition";
		 
		$params = array();
		$query = DataBaseHelper::query($sql, $params);
		 
		return $query;
	}
	
	public static function getNewsRelateList($newsVo, $size=0)
	{
		//get $newsInfo
		$newsDao = new NewsDao();
		$filter = new NewsVo();
		$filter->newsCategoryId = $newsVo->newsCategoryId;
		$newsList = $newsDao->selectByFilter($filter);
		foreach ($newsList as $k => $v){
			if($v->newsId == $newsVo->newsId) unset($newsList[$k]);
		}
		return ArrayHelper::getRandomArray($newsList, null, $size);
	}

	/**********************
	 News tag
	 ********************/
	public static function getNewsTagInfo($filter){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$sql = "select news_tag.*
		from news_tag_map
		left join news on news_tag_map.news_id=news.news_id
		left join news_tag on news_tag_map.news_tag_id=news_tag.news_tag_id
		$whereCondition";
	
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	/**
	 * if $newsId then return newsTagList of $newsId
	 * else return allnewsTagList
	 * 
	 * @param int $newsId
	 * @return array newsTag object
	 */
	public static function getNewsTagList($newsId){
		if($newsId){
			$filter = array(
				'news.news_id' => $newsId,
			);
			$whereCondition = DataBaseHelper::getWhereCondition($filter);
			$sql = "select news_tag.*, news_tag_map.news_tag_map_id
			from news_tag_map
			left join news on news_tag_map.news_id=news.news_id
			left join news_tag on news_tag_map.news_tag_id=news_tag.news_tag_id
			$whereCondition";
		}
		else{
			$sql = "select * from news_tag";
		}
	
		return DataBaseHelper::query($sql);
	}
	
	public static function getNewsTagCount($newsTagId){
		$sql = "select count(*) as count from news_tag_map where news_tag_id=$newsTagId";
	
		$query = DataBaseHelper::query($sql);
		if($query){
			return $query[0]->count;
		}
		else{
			return 0;
		}
	}
	
	/**
	 * get username of admin created news
	 * 
	 * @param int $crtBy
	 * @return string
	 */
	public static function crtByName($crtBy){
		$sql = "select username from `admin` where admin_id=$crtBy";
	
		$query = DataBaseHelper::query($sql);
		if($query){
			return $query[0]->username;
		}
		else{
			return '';
		}
	}
	
	/**
	 * update news_id in news_tag_map table (0 -> $newsId)
	 * apply for save news only
	 * 
	 * @param int $newsId
	 */
	public static function updateNewsTagMap($newsId){
		$sql = "update news_tag_map set news_id=$newsId where news_id=0";
		return DataBaseHelper::query($sql, null, null);
	}
	
	/**
	 * delete all record  in news_tag_map and news_tag table
	 * 
	 * @param int $newsTagId
	 */
	public static function deleteNewsTag($newsTagId){
		//news_tag_map
		$sql = "delete from news_tag_map where news_tag_id=$newsTagId";
		DataBaseHelper::query($sql, null, null);
		
		//news_tag
		$sql = "delete from news_tag where news_tag_id=$newsTagId";
		DataBaseHelper::query($sql, null, null);
	}
	
	public static function deleteNewsTagMap($newsTagMapId){
		$sql = "delete from news_tag_map where news_tag_map_id=$newsTagMapId";
		DataBaseHelper::query($sql, null, null);
	}
	
	/**
	 * delete all record in news_tag_map table where news_id=0
	 * it created when add news but not save
	 * run it page news/manage
	 */
	public static function deleteNewsTagMapTemp(){
		$sql = "delete from news_tag_map where news_id=0";
		DataBaseHelper::query($sql, null, null);
	}
	
	//frontend
	public static function getNewsTagFilter($filter, $order, $start, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($order);
		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
		$sql = "select news.*
		from news_tag_map
		left join news on news_tag_map.news_id=news.news_id
		left join news_tag on news_tag_map.news_tag_id=news_tag.news_tag_id
		$whereCondition 
		group by news.news_id
		$orderCondition $limitCondition";
			
		$params = array();
		$query = DataBaseHelper::query($sql, $params);
			
		return $query;
	}
	
	
	/**********************
	 ROUTER
	 ********************/
	/**
	 * getAlias of $newsInfo
	 *
	 * @param object $newsInfo
	 * @param string $aliasBy
	 * @return
	 if $aliasBy='%name%'* => 			newsName
	 if $aliasBy='%sub_path%' => 		parentName/newsName
	 if $aliasBy='%full_path%' => 		parentName[/parentSubName/]/newsName
	 */
	public static function getAlias($newsInfo, $aliasBy='%name%'){
		$alias = '';
		if($aliasBy == '%name%'){
			$alias = trim($newsInfo->title);
		}
		else if($aliasBy == '%sub_path%'){
			$aliasCategory = NewsCategoryExt::getAlias($newsInfo->newsCategoryId, '%name%');
			$alias = $aliasCategory .'/'. trim($newsInfo->title);
		}
		else if($aliasBy == '%full_path%'){
			$aliasCategory = NewsCategoryExt::getAlias($newsInfo->newsCategoryId, '%full_path%');
			$alias = $aliasCategory .'/'. trim($newsInfo->title);
		}
		else{
			LogUtil::devInfo("[NewsExt::getAlias] not found case aliasBy = $aliasBy");
		}
	
		$alias = StringHelper::getAlias($alias);
		return $alias;
	}
	
	/**
	 * getAlias of $newsTagInfo
	 *
	 * @param object $newsTagInfo
	 * @param string $aliasBy
	 * @return
	 if $aliasBy='%name%'* => $newsTagName
	 */
	public static function getNewsTagAlias($newsTagInfo, $aliasBy='%name%'){
		$alias = '';
		if($aliasBy == '%name%'){
			$alias = trim($newsTagInfo->name);
		}
		else{
			LogUtil::devInfo("[NewsExt::getNewsTagAlias] not found case aliasBy = $aliasBy");
		}
		$alias = StringHelper::getAlias($alias);
		return $alias;
	}
}
?>