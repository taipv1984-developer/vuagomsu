<?php 
class NewsCategoryExt{
	public static function getNewsCategoryInfo($newCategoryId){
		$sql = "select * from news_category where news_category_id=$newCategoryId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	
	}
	/**
	 * OK
	 * getNewsCategoryList
	 */
	public static function getNewsCategoryList(){
		$newsCategoryDao = new NewsCategoryDao();
		$newsCategoryList = $newsCategoryDao->selectAll();
		
		$newsCategoryList = ArrayHelper::objectToArray($newsCategoryList);
		
		//check have children
		foreach($newsCategoryList as $key => $value){
			//add common field
			$newsCategoryList[$key]['id'] = $newsCategoryList[$key]['newsCategoryId'];
			//$newsCategoryList[$key]['name'] = $newsCategoryList[$key]['name'];
				
			//add haveChild
			$newsCategoryList[$key]['haveChild'] = false;
			foreach($newsCategoryList as  $v){
				if($v['parentId'] == $value['newsCategoryId']){
					$newsCategoryList[$key]['haveChild'] = true;
					break;
				}
			}
		}
		
		return ArrayHelper::recursive( $newsCategoryList);
	}
	
	/**
	 * OK
	 * getChild of $newsCategoryId
	 * 
	 * @param array $child
	 * @param int $newsCategoryId
	 */
	public static function getChild(&$child, $newsCategoryId){
		if(!isset($child)) $child = array();
		$newsCategoryDao = new NewsCategoryDao();
		$newsCategoryList = $newsCategoryDao->selectAll();
	
		//find child
		foreach($newsCategoryList as $v){
			if($v->parentId == $newsCategoryId){
				$child[] = $v->newsCategoryId;
				self::getChild($child, $v->newsCategoryId);
			}
		}
	}

	/**
	 *	OK
	 * delete newsCategory and all news in category
	 * 
	 * @param int $newsCategoryId
	 */
	public static function delete($newsCategoryId){
		//delete news
		$sql = "delete from `news` where news_category_id=$newsCategoryId";
		DataBaseHelper::query($sql, null, null);
		
		//delete news_category
		$sql = "delete from `news_category` where news_category_id=$newsCategoryId";
		DataBaseHelper::query($sql, null, null);
	}
	
	/**********************
	 ROUTER
	 ********************/
	/**
	 * getAlias of $newsCategoryInfo
	 *
	 * @param int|object $newsCategoryData
	 * @param string $aliasBy
	 * @return
	 * 		if $aliasBy='%name%'* 		=> 		newsCategoryName
	 if $aliasBy='%full_path%' 	=> 		[parentName/]newsCategoryName
	 */
	public static function getAlias($newsCategoryData, $aliasBy='%name%'){
		if(is_numeric($newsCategoryData)){
			$newsCategoryId = $newsCategoryData;
			$newsCategoryInfo = self::getNewsCategoryInfo($newsCategoryId);
		}
		else{
			$newsCategoryInfo = $newsCategoryData;
			$newsCategoryId = $newsCategoryInfo->newsCategoryId;
		}
		$alias = '';
		if($aliasBy == '%name%'){
			$sql = "select * from `news_category` where `news_category_id`=$newsCategoryId";
			$query = DataBaseHelper::query($sql);
			if($query){
				$alias = trim($query[0]->name);
			}
			else{
				return false;
			}
		}
		else if($aliasBy == '%full_path%'){
			$loop = true;
			$parentId = $newsCategoryId;	//init loop
			while($loop){
				$sql = "select * from `news_category` where `news_category_id`=$parentId";
				$query = DataBaseHelper::query($sql);
				if($query){
					//get data
					if($alias == ''){
						$alias = trim($query[0]->name);
					}
					else{
						$alias = trim($query[0]->name) .'/'. $alias;
					}
	
					//loop check
					$parentId = $query[0]->parentId;
					if(!$parentId){
						$loop = false;
					}
				}
				else{
					return false;
				}
			}
		}
		else{
			LogUtil::devInfo("[NewsCategoryExt::getAlias] not found case aliasBy = $aliasBy");
		}
	
		$alias = StringHelper::getAlias($alias);
		return $alias;
	}
}
?>