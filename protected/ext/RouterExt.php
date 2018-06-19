<?php
class RouterExt{
	/**************************
	 * ROUTER function
	 **************************/
	public static function getRouteInfo($filter){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$sql = "select r.*, 
		l.name as layout_name, l.dispatch as layout_dispatch
from `router` as r
left join layout as l on l.layout_id=r.layout_id
$whereCondition";

		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getDemoLink($routerId){
		$sql = "select * from router_url where router_id=$routerId
order by router_id DESC
limit 1";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->alias : false;
	}
	
	public static function getRouterList($filter, $orderBy, $startRecord, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($orderBy);
		$limitCondition = DataBaseHelper::getLimitCondition($startRecord, $recSize);
	
		$sql = "select r.*
		from `router` as r
		left join `layout` as l on l.layout_id=r.layout_id
		$whereCondition $orderCondition $limitCondition";
	
		return DataBaseHelper::query($sql);
	}
	
	/**************************
	 * ROUTER URL function
	 **************************/
	public static function getRouterUrlCount($routerId){
		$sql = "select count(*) as count 
from router_url as ru
left join router as r on r.router_id=ru.router_id
where r.router_id=$routerId and ru.redirect_to=''";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->count : 0;
	}
	
	public static function getRouterUrlInfo($filter){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$sql = "select * from `router_url` $whereCondition";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getRouterUrlListByAlias($filter){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$sql = "select * from `router_url` $whereCondition";
		$output = array(
			'type' => 'object',
			'key' => 'alias',
		);
		return DataBaseHelper::query($sql, null, $output);
	}
	
	public static function getRouterUrlListByPkValue($filter){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$sql = "select * from `router_url` $whereCondition";
		$output = array(
			'type' => 'object',
			'key' => 'pkValue',
		);
		return DataBaseHelper::query($sql, null, $output);
	}
	
	/**
	 * delete all routerUrl have $alias=redirectTo
	 */
	public static function deleteRouterSame(){
		$sql = "delete from `router_url` where `alias`=`redirect_to`";
		DataBaseHelper::query($sql, null, null);
	}
	
	/**************************
	 * SESSION function
	 **************************/
	public static function setSession($session, $sessionValue){
		$_SESSION[SESSION_GROUP]['router_url'][$session] = $sessionValue;
	}
	
	public static function getSession($name, $default = null){
		if(!isset($_SESSION[SESSION_GROUP]['router_url'][$name]))
			return $default;
		else
			return $_SESSION[SESSION_GROUP]['router_url'][$name];
	}
	
	public static function clearSession(){
		$_SESSION[SESSION_GROUP]['router_url'] = null;
	}
	
	/**************************
	 * CALLBACK function
	 **************************/
	public static function updateRouterUrlCategoryPage($categoryInfo, $routerInfo, $routerUrlList){
        FileHelper::loadPlugin('shop');

		$routerUrlDao = new RouterUrlDao();
		$categoryId = $categoryInfo->categoryId;

		//check $routerInfo
		if($routerInfo == null){
			$filter = array(
				'l.dispatch' => 'home/product/list'
			);
			$routerInfo = self::getRouteInfo($filter);
		}
		//check $routerUrlList
		if($routerUrlList == null){
			$filter = array(
				'router_id' => $routerInfo->routerId,
			);
			$routerUrlList = self::getRouterUrlListByPkValue($filter);
		}
	
		$isNew = false;
		//get $alias
		$alias = $routerInfo->prefix .CategoryExt::getAlias($categoryInfo, $routerInfo->aliasBy). $routerInfo->suffix;
		if(isset($routerUrlList[$categoryId])){
			$routerUrlInfo = $routerUrlList[$categoryId];
			if($routerUrlInfo->alias != $alias){
				//update redirectTo
				$routerUrlVo = new RouterUrlVo();
				$routerUrlVo->dispatch = $routerUrlInfo->dispatch;
				$routerUrlVo->pkName = $routerUrlInfo->pkName;
				$routerUrlVo->pkValue = $routerUrlInfo->pkValue;
				$routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
				foreach ($routerUrlRedirectList as $v){
					$routerUrlVo = new RouterUrlVo();
					$routerUrlVo->redirectTo = $alias;
					$routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
				}
	
				//set $isNew
				$isNew = true;
			}
		}
		else{
			$isNew = true;
		}
	
		if($isNew){
			//inser to router_url table
			$routerUrlVo = new RouterUrlVo();
			$routerUrlVo->routerId = $routerInfo->routerId;
			$routerUrlVo->alias = $alias;
			$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
			$routerUrlVo->pkName = $routerInfo->pkName;
			$routerUrlVo->pkValue = $categoryId;
			$routerUrlVo->redirectTo = '';
			$routerUrlDao->insert($routerUrlVo);
		}
	}
	public static function updateRouterUrlCategoryPageList($routerInfo){
		//get data
		$routerId = $routerInfo->routerId;
		$filter = array(
			'router_id' => $routerId,
		);
		$routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
	
		//get category list
		$sql = "select * from category";
		$categoryList = DataBaseHelper::query($sql);
	
		foreach ($categoryList as $categoryInfo){
			self::updateRouterUrlCategoryPage($categoryInfo, $routerInfo, $routerUrlList);
		}
	
		//delete all routerUrl have $alias=redirectTo
		self::deleteRouterSame();
	}
	
	public static function updateRouterUrlProductPage($productInfo, $routerInfo, $routerUrlList){
        FileHelper::loadPlugin('shop');
		
		$routerUrlDao = new RouterUrlDao();
		$productId = $productInfo->productId;
		
		//check $routerInfo
		if($routerInfo == null){
			$filter = array(
				'l.dispatch' => 'home/product/detail'
			);
			$routerInfo = self::getRouteInfo($filter);
		}
		//check $routerUrlList
		if($routerUrlList == null){
			$filter = array(
				'router_id' => $routerInfo->routerId,
			);
			$routerUrlList = self::getRouterUrlListByPkValue($filter);
		}

		$isNew = false;
		//get $alias
		$alias = $routerInfo->prefix .ProductExt::getAlias($productInfo, $routerInfo->aliasBy). $routerInfo->suffix;
		if(isset($routerUrlList[$productId])){
			$routerUrlInfo = $routerUrlList[$productId];
			if($routerUrlInfo->alias != $alias){
				//update redirectTo
				$routerUrlVo = new RouterUrlVo();
				$routerUrlVo->dispatch = $routerUrlInfo->dispatch;
				$routerUrlVo->pkName = $routerUrlInfo->pkName;
				$routerUrlVo->pkValue = $routerUrlInfo->pkValue;
				$routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
				foreach ($routerUrlRedirectList as $v){
					$routerUrlVo = new RouterUrlVo();
					$routerUrlVo->redirectTo = $alias;
					$routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
				}
		
				//set $isNew
				$isNew = true;
			}
		}
		else{
			$isNew = true;
		}
		
		if($isNew){
			//inser to router_url table
			$routerUrlVo = new RouterUrlVo();
			$routerUrlVo->routerId = $routerInfo->routerId;
			$routerUrlVo->alias = $alias;
			$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
			$routerUrlVo->pkName = $routerInfo->pkName;
			$routerUrlVo->pkValue = $productId;
			$routerUrlVo->redirectTo = '';
			$routerUrlDao->insert($routerUrlVo);
		}
	}
	public static function updateRouterUrlProductPageList($routerInfo){
		//get data
		$routerId = $routerInfo->routerId;
		$filter = array(
			'router_id' => $routerId,
		);
		$routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
	
		//get product list
		$sql = "select * from product";
		$productList = DataBaseHelper::query($sql);

		foreach ($productList as $productInfo){
			self::updateRouterUrlProductPage($productInfo, $routerInfo, $routerUrlList);
		}

		//delete all routerUrl have $alias=redirectTo
		self::deleteRouterSame();
	}

    public static function updateRouterUrlProductTagPage($productTagInfo, $routerInfo, $routerUrlList){
        FileHelper::loadPlugin('shop');

        $routerUrlDao = new RouterUrlDao();
        $productTagId = $productTagInfo->productTagId;
        //check $routerInfo
        if($routerInfo == null){
            $filter = array(
                'l.dispatch' => 'home/product/tag'
            );
            $routerInfo = self::getRouteInfo($filter);
        }
        //check $routerUrlList
        if($routerUrlList == null){
            $filter = array(
                'router_id' => $routerInfo->routerId,
            );
            $routerUrlList = self::getRouterUrlListByPkValue($filter);
        }
        $isNew = false;
        //get $alias
        $alias = $routerInfo->prefix .ProductExt::getProductTagAlias($productTagInfo, $routerInfo->aliasBy). $routerInfo->suffix;
        if(isset($routerUrlList[$productTagId])){
            $routerUrlInfo = $routerUrlList[$productTagId];
            if($routerUrlInfo->alias != $alias){
                //update redirectTo
                $routerUrlVo = new RouterUrlVo();
                $routerUrlVo->dispatch = $routerUrlInfo->dispatch;
                $routerUrlVo->pkName = $routerUrlInfo->pkName;
                $routerUrlVo->pkValue = $routerUrlInfo->pkValue;
                $routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
                foreach ($routerUrlRedirectList as $v){
                    $routerUrlVo = new RouterUrlVo();
                    $routerUrlVo->redirectTo = $alias;
                    $routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
                }
                //set $isNew
                $isNew = true;
            }
        }
        else{
            $isNew = true;
        }
        if($isNew){
            //inser to router_url table
            $routerUrlVo = new RouterUrlVo();
            $routerUrlVo->routerId = $routerInfo->routerId;
            $routerUrlVo->alias = $alias;
            $routerUrlVo->dispatch = $routerInfo->layoutDispatch;
            $routerUrlVo->pkName = $routerInfo->pkName;
            $routerUrlVo->pkValue = $productTagId;
            $routerUrlVo->redirectTo = '';
            $routerUrlDao->insert($routerUrlVo);
        }
    }
    public static function updateRouterUrlProductTagPageList($routerInfo){
        //get data
        $routerId = $routerInfo->routerId;
        $filter = array(
            'router_id' => $routerId,
        );
        $routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
        //get tag list
        $sql = "select * from product_tag";
        $productTagList = DataBaseHelper::query($sql);
        foreach ($productTagList as $productTagInfo){
            self::updateRouterUrlProductTagPage($productTagInfo, $routerInfo, $routerUrlList);
        }
        //delete all routerUrl have $alias=redirectTo
        self::deleteRouterSame();
    }

	public static function updateRouterUrlNewsCategoryPage($newsCategoryInfo, $routerInfo, $routerUrlList){
		FileHelper::loadPlugin('news');

		$routerUrlDao = new RouterUrlDao();
		$newsCategoryId = $newsCategoryInfo->newsCategoryId;
		//check $routerInfo
		if($routerInfo == null){
			$filter = array(
				'l.dispatch' => 'home/news/list'
			);
			$routerInfo = self::getRouteInfo($filter);
		}
		//check $routerUrlList
		if($routerUrlList == null){
			$filter = array(
				'router_id' => $routerInfo->routerId,
			);
			$routerUrlList = self::getRouterUrlListByPkValue($filter);
		}
		$isNew = false;
		//get $alias
		$alias = $routerInfo->prefix .NewsCategoryExt::getAlias($newsCategoryInfo, $routerInfo->aliasBy). $routerInfo->suffix;
		if(isset($routerUrlList[$newsCategoryId])){
			$routerUrlInfo = $routerUrlList[$newsCategoryId];
			if($routerUrlInfo->alias != $alias){
				//update redirectTo
				$routerUrlVo = new RouterUrlVo();
				$routerUrlVo->dispatch = $routerUrlInfo->dispatch;
				$routerUrlVo->pkName = $routerUrlInfo->pkName;
				$routerUrlVo->pkValue = $routerUrlInfo->pkValue;
				$routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
				foreach ($routerUrlRedirectList as $v){
					$routerUrlVo = new RouterUrlVo();
					$routerUrlVo->redirectTo = $alias;
					$routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
				}
				//set $isNew
				$isNew = true;
			}
		}
		else{
			$isNew = true;
		}
		if($isNew){
			//inser to router_url table
			$routerUrlVo = new RouterUrlVo();
			$routerUrlVo->routerId = $routerInfo->routerId;
			$routerUrlVo->alias = $alias;
			$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
			$routerUrlVo->pkName = $routerInfo->pkName;
			$routerUrlVo->pkValue = $newsCategoryId;
			$routerUrlVo->redirectTo = '';
			$routerUrlDao->insert($routerUrlVo);
		}
	}
	public static function updateRouterUrlNewsCategoryPageList($routerInfo){
		//get data
		$routerId = $routerInfo->routerId;
		$filter = array(
			'router_id' => $routerId,
		);
		$routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
		//get category list
		$sql = "select * from news_category";
		$newsCategoryList = DataBaseHelper::query($sql);
		foreach ($newsCategoryList as $newsCategoryInfo){
			self::updateRouterUrlNewsCategoryPage($newsCategoryInfo, $routerInfo, $routerUrlList);
		}
		//delete all routerUrl have $alias=redirectTo
		self::deleteRouterSame();
	}
	
	public static function updateRouterUrlNewsPage($newsInfo, $routerInfo, $routerUrlList){
        FileHelper::loadPlugin('news');
		
		$routerUrlDao = new RouterUrlDao();
		$newsId = $newsInfo->newsId;
	
		//check $routerInfo
		if($routerInfo == null){
			$filter = array(
				'l.dispatch' => 'home/news/detail'
			);
			$routerInfo = self::getRouteInfo($filter);
		}
		//check $routerUrlList
		if($routerUrlList == null){
			$filter = array(
				'router_id' => $routerInfo->routerId,
			);
			$routerUrlList = self::getRouterUrlListByPkValue($filter);
		}
	
		$isNew = false;
		//get $alias
		$alias = $routerInfo->prefix .NewsExt::getAlias($newsInfo, $routerInfo->aliasBy). $routerInfo->suffix;
		if(isset($routerUrlList[$newsId])){
			$routerUrlInfo = $routerUrlList[$newsId];
			if($routerUrlInfo->alias != $alias){
				//update redirectTo
				$routerUrlVo = new RouterUrlVo();
				$routerUrlVo->dispatch = $routerUrlInfo->dispatch;
				$routerUrlVo->pkName = $routerUrlInfo->pkName;
				$routerUrlVo->pkValue = $routerUrlInfo->pkValue;
				$routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
				foreach ($routerUrlRedirectList as $v){
					$routerUrlVo = new RouterUrlVo();
					$routerUrlVo->redirectTo = $alias;
					$routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
				}
	
				//set $isNew
				$isNew = true;
			}
		}
		else{
			$isNew = true;
		}
	
		if($isNew){
			//inser to router_url table
			$routerUrlVo = new RouterUrlVo();
			$routerUrlVo->routerId = $routerInfo->routerId;
			$routerUrlVo->alias = $alias;
			$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
			$routerUrlVo->pkName = $routerInfo->pkName;
			$routerUrlVo->pkValue = $newsId;
			$routerUrlVo->redirectTo = '';
			$routerUrlDao->insert($routerUrlVo);
		}
	}
	public static function updateRouterUrlNewsPageList($routerInfo){
		//get data
		$routerId = $routerInfo->routerId;
		$filter = array(
			'router_id' => $routerId,
		);
		$routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
	
		//get news list
		$sql = "select * from news";
		$newsList = DataBaseHelper::query($sql);
	
		foreach ($newsList as $newsInfo){
			self::updateRouterUrlNewsPage($newsInfo, $routerInfo, $routerUrlList);
		}
	
		//delete all routerUrl have $alias=redirectTo
		self::deleteRouterSame();
	}
	
	public static function updateRouterUrlNewsTagPage($newsTagInfo, $routerInfo, $routerUrlList){
        FileHelper::loadPlugin('news');
	
		$routerUrlDao = new RouterUrlDao();
		$newsTagId = $newsTagInfo->newsTagId;
		//check $routerInfo
		if($routerInfo == null){
			$filter = array(
				'l.dispatch' => 'home/news/tag'
			);
			$routerInfo = self::getRouteInfo($filter);
		}
		//check $routerUrlList
		if($routerUrlList == null){
			$filter = array(
				'router_id' => $routerInfo->routerId,
			);
			$routerUrlList = self::getRouterUrlListByPkValue($filter);
		}
		$isNew = false;
		//get $alias
		$alias = $routerInfo->prefix .NewsExt::getNewsTagAlias($newsTagInfo, $routerInfo->aliasBy). $routerInfo->suffix;
		if(isset($routerUrlList[$newsTagId])){
			$routerUrlInfo = $routerUrlList[$newsTagId];
			if($routerUrlInfo->alias != $alias){
				//update redirectTo
				$routerUrlVo = new RouterUrlVo();
				$routerUrlVo->dispatch = $routerUrlInfo->dispatch;
				$routerUrlVo->pkName = $routerUrlInfo->pkName;
				$routerUrlVo->pkValue = $routerUrlInfo->pkValue;
				$routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
				foreach ($routerUrlRedirectList as $v){
					$routerUrlVo = new RouterUrlVo();
					$routerUrlVo->redirectTo = $alias;
					$routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
				}
				//set $isNew
				$isNew = true;
			}
		}
		else{
			$isNew = true;
		}
		if($isNew){
			//inser to router_url table
			$routerUrlVo = new RouterUrlVo();
			$routerUrlVo->routerId = $routerInfo->routerId;
			$routerUrlVo->alias = $alias;
			$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
			$routerUrlVo->pkName = $routerInfo->pkName;
			$routerUrlVo->pkValue = $newsTagId;
			$routerUrlVo->redirectTo = '';
			$routerUrlDao->insert($routerUrlVo);
		}
	}
	public static function updateRouterUrlNewsTagPageList($routerInfo){
		//get data
		$routerId = $routerInfo->routerId;
		$filter = array(
			'router_id' => $routerId,
		);
		$routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
		//get tag list
		$sql = "select * from news_tag";
		$newsTagList = DataBaseHelper::query($sql);
		foreach ($newsTagList as $newsTagInfo){
			self::updateRouterUrlNewsTagPage($newsTagInfo, $routerInfo, $routerUrlList);
		}
		//delete all routerUrl have $alias=redirectTo
		self::deleteRouterSame();
	}
	
	public static function updateRouterUrlStaticPage($staticPageInfo, $routerInfo, $routerUrlList){
	    FileHelper::loadPlugin('static_page');

		$routerUrlDao = new RouterUrlDao();
		$staticPageId = $staticPageInfo->staticPageId;
	
		//check $routerInfo
		if($routerInfo == null){
			$filter = array(
				'l.dispatch' => 'home/static_page/view'
			);
			$routerInfo = self::getRouteInfo($filter);
		}
		//check $routerUrlList
		if($routerUrlList == null){
			$filter = array(
				'router_id' => $routerInfo->routerId,
			);
			$routerUrlList = self::getRouterUrlListByPkValue($filter);
		}
	
		$isNew = false;
		//get $alias
		$alias = $routerInfo->prefix .StaticPageExt::getAlias($staticPageInfo, $routerInfo->aliasBy). $routerInfo->suffix;
		if(isset($routerUrlList[$staticPageId])){
			$routerUrlInfo = $routerUrlList[$staticPageId];
			if($routerUrlInfo->alias != $alias){
				//update redirectTo
				$routerUrlVo = new RouterUrlVo();
				$routerUrlVo->dispatch = $routerUrlInfo->dispatch;
				$routerUrlVo->pkName = $routerUrlInfo->pkName;
				$routerUrlVo->pkValue = $routerUrlInfo->pkValue;
				$routerUrlRedirectList = $routerUrlDao->selectByFilter($routerUrlVo);
				foreach ($routerUrlRedirectList as $v){
					$routerUrlVo = new RouterUrlVo();
					$routerUrlVo->redirectTo = $alias;
					$routerUrlDao->updateByPrimaryKey($routerUrlVo, $v->routerUrlId);
				}
	
				//set $isNew
				$isNew = true;
			}
		}
		else{
			$isNew = true;
		}
	
		if($isNew){
			//inser to router_url table
			$routerUrlVo = new RouterUrlVo();
			$routerUrlVo->routerId = $routerInfo->routerId;
			$routerUrlVo->alias = $alias;
			$routerUrlVo->dispatch = $routerInfo->layoutDispatch;
			$routerUrlVo->pkName = $routerInfo->pkName;
			$routerUrlVo->pkValue = $staticPageId;
			$routerUrlVo->redirectTo = '';
			$routerUrlDao->insert($routerUrlVo);
		}
	}
	public static function updateRouterUrlStaticPageList($routerInfo){
		//get data
		$routerId = $routerInfo->routerId;
		$filter = array(
			'router_id' => $routerId,
		);
		$routerUrlList = RouterExt::getRouterUrlListByPkValue($filter);
		
		//get staticPage list
		$sql = "select * from static_page";
		$staticPageList = DataBaseHelper::query($sql);
		
		foreach ($staticPageList as $staticPageInfo){
			self::updateRouterUrlStaticPage($staticPageInfo, $routerInfo, $routerUrlList);
		}
		
		//delete all routerUrl have $alias=redirectTo
		self::deleteRouterSame();
	}
}