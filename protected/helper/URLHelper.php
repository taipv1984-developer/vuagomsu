<?php
/**
 * create url by params input(SEO)
 */
class URLHelper{
	public static function getCurrentUrl(){
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$c = $url[strlen($url)-1];
		if($c == '/') $url = substr($url, 0, strlen($url)-1);
		return $url;
	}
	
	/**
	 * getBaseUrl	return Registry::getSetting('base_url')
	 * 
	 * @return string
	 */
	public static function getBaseUrl(){
		return Registry::getSetting('base_url');
	}
	
	/**
	 * getUrl
	 * 
	 * @param string $url
	 * @return string	(index.php?r=$url)
	 */
	public static function getUrl($url, $params=array()){
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($url == 'home') return $baseUrl;
		
		$url = "/index.php?r=$url";
		$request = array();
		foreach ($params as $k => $v){
			$request[] = "$k=$v";
		}
		$request = join('&', $request);
		if($routerUrl){
			if($request == ''){
				return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
			}
			else{
				return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url)."?$request" : $baseUrl.$url."&$request";
			}
		}
		else{
			if($request == ''){
				return $baseUrl.$url;
			}
			else{
				return $baseUrl.$url."&$request";
			}
		}
	}
	
	public static function getAlias($dispatch, $pkName='', $pkValue=''){
		$dispatch = str_replace("index.php?r=", "", $dispatch);
		$sql = "select * from router_url where `dispatch`='$dispatch'";
		if($pkName != '') $sql .= " and pk_name='$pkName'";
		if($pkValue != '') $sql .= " and pk_value='$pkValue'";
		$sql .= " and redirect_to = ''";
		$sql .= " limit 1";
		$query = DataBaseHelper::query($sql);
		if($query){
			return self::getBaseUrl() .'/'. $query[0]->alias;
		}
		else{
			return false;
		}
	}


    public static function getResource($resourceFile){
        $baseUrl = self::getBaseUrl();
        if(true){
            return "$baseUrl/$resourceFile";
        }
    }

	/**
	 * getProductListPage
	 * index.php?r=home/product/list&categoryId=34
	 *
	 * @param int $categoryId
	 * @return string
	 */
	public static function getProductListPage($categoryId){
		if($categoryId){
			$url = "/index.php?r=home/product/list&categoryId=$categoryId";
		}
		else{
			$url = "/index.php?r=home/product/list";
		}
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}

    /**
     * getProductTagPage
     * index.php?r=home/product/tag&productTagId=34
     *
     * @param int productTagId
     * @return string
     */
    public static function getProductTagPage($productTagId){
        if($productTagId){
            $url = "/index.php?r=home/product/tag&productTagId=$productTagId";
        }
        else{
            $url = "/index.php?r=home/product/tag";
        }
        $baseUrl = self::getBaseUrl();
        $routerUrl = Registry::getSetting('router_url');
        if($routerUrl){
            return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
        }
        else{
            return $baseUrl.$url;
        }
    }

	//......................
	public static function getProductListSearchPage($key){
		$url = self::getBaseUrl();
		$url .= "/search&key=".$key;
		return $url;
	}
	
	/**
	 * getProductDetailPage
	 * index.php?r=home/product/detail&productId=1
	 *
	 * @param int $productId
	 * @return string
	 */
	public static function getProductDetailPage($productId){
		$url = "/index.php?r=home/product/detail&productId=$productId";
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}
	
	/**
	 * getNewsListPage
	 * index.php?r=home/news/list&newsCategoryId=1
	 *
	 * @param int $categoryId
	 * @return string
	 */
	public static function getNewsListPage($newsCategoryId){
		if($newsCategoryId){
			$url = "/index.php?r=home/news/list&newsCategoryId=$newsCategoryId";
		}
		else{
			$url = "/index.php?r=home/news/list";
		}
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}
	
	/**
	 * getNewsDetailPage
	 * index.php?r=home/news/detail&newsId=1
	 *
	 * @param int $newsId
	 * @return string
	 */
	public static function getNewsDetailPage($newsId){
		$url = "/index.php?r=home/news/detail&newsId=$newsId";
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}
	
	/**
	 * getNewsTagPage
	 * index.php?r=home/news/tag&newsTagId=1
	 *
	 * @param int $newsTagId
	 * @return string
	 */
	public static function getNewsTagPage($newsTagId){
		if($newsTagId){
			$url = "/index.php?r=home/news/tag&newsTagId=$newsTagId";
		}
		else{
			$url = "/index.php?r=home/news/tag";
		}
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}
	
	/**
	 * getStaticPageUrl
	 * index.php?r=home/static_page/view&staticPageId=1
	 * 
	 * @param int $staticPageId
	 * @return string
	 */
	public static function getStaticPageUrl($staticPageId){
		$url = "/index.php?r=home/static_page/view&staticPageId=$staticPageId";
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}
	
	/**
	 * get404Page
	 * 
	 * @return 404 page
	 */
	public static function get404Page($actionParam){
		if (strpos($actionParam, "admin/") !== false){
			$url = "/index.php?r=admin/404";
		}else{
			$url = "/index.php?r=home/404";
		}
		$baseUrl = self::getBaseUrl();
		$routerUrl = Registry::getSetting('router_url');
		if($routerUrl){
			return (RouterExt::getSession($url)) ? $baseUrl.'/'.RouterExt::getSession($url) : $baseUrl.$url;
		}
		else{
			return $baseUrl.$url;
		}
	}
	
	/**		OK
	 * get image thumbnail path of imagePath <br>
	 * example: <br>
	 * 		input: upload/dato/img.jpg <br>
	 * 	   output: upload/dato/$folder/img.jpg <br>
	 * 
	 * @param string $imagePath
	 * @param string $folder(small*, medium, large)folder get thumb
	 * @return string
	 */
	public static function getImagePath($imagePath, $folder=''){
		$imagePath = str_replace(self::getBaseUrl().'/', '', $imagePath);
		$imageThumbnail = '';
		$exp = explode('/', $imagePath);
		$fileName = $exp[count($exp)-1];
		if($folder == ''){
			$imageThumbnail = str_replace($fileName, '', $imagePath). $fileName;
		}
		else{
			$imageThumbnail = str_replace($fileName, '', $imagePath)."$folder/". $fileName;
		}
		if(file_exists($imageThumbnail)){
			return self::getBaseUrl().'/'.$imageThumbnail;
		}
		else{
			if(file_exists($imagePath)){
				return self::getBaseUrl().'/'.$imagePath;
			}
			else{
				return Registry::getSetting('no_image');
			}
		}
	}
	
	public static function getImageName($imagePath){
		$exp = explode('/', $imagePath);
		return $exp[count($exp)-1];
	}
	
	/**
	 * get url of pading when select a page
	 * remove page, limit params out QUERY_STRING else params skip
	 * 
	 * @param int $iPage
	 * @param string $orderBy
	 * @param int|all $limit
	 * @return string
	 */
	public static function getPadingPage($iPage, $orderBy='', $limit=0, $removeQuery=array()){
		//get current url
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		//get REQUEST_URI and slplit to params array
		$query = $_SERVER['REQUEST_URI'];
		$querys = explode('&', $query);
		$params = array();
		foreach ($querys as $v){
			$exp = explode('=', $v);
			$params[$exp[0]] = '&'.$exp[0].'='.$exp[1];
		}
		
		//remove &page out $url
		if(isset($params['page'])){
			$url = str_replace($params['page'], '', $url);
		}
		//remove &orderBy out $url
		if(isset($params['orderBy'])){
			$url = str_replace($params['orderBy'], '', $url);
		}
		//remove &limit out $url
		if(isset($params['limit'])){
			$url = str_replace($params['limit'], '', $url);
		}
		//remove $removeQuery out $url
		foreach ($removeQuery as $v){
			$url = str_replace($params[$v], '', $url);
		}
		
		if($iPage) $url = $url."&page=$iPage";
		if($orderBy != '') $url = $url."&orderBy=$orderBy";
		if($limit) $url = $url."&limit=$limit";
		
		return $url;
	}
	
	/**
	 * get link demo for a layout = 
	 * 
	 * $dispatch = home/news/list
	 * return home/news/list&newsCategoryId=1
	 * @param string $dispatch
		 * 	home/product/list
		 * 	home/product/detail
		 * 	home/orders/detail
		 * 	home/news/list
		 * 	home/news/detail
		 * 	home/news/tag
		 * 	home/page
	 */
	public static function getLinkDemo($dispatch){
		$url = '';
		switch ($dispatch){
			case 'home/product/list':	//home/product/list&categoryId=34
				$sql = "select category_id from category
limit 1";
				$query = DataBaseHelper::query($sql);
				$url = ($query) ? $dispatch.'&categoryId='.$query[0]->categoryId : $dispatch.'&categoryId=?';
				break;
			case 'home/product/detail':	//home/product/detail&productId=63
				$sql = "select product_id from product
limit 1";
				$params = array();
				$query = DataBaseHelper::query($sql);
				$url = ($query) ? $dispatch.'&productId='.$query[0]->productId : $dispatch.'&productId=?';
				break;
            case 'home/product/tag':	//home/product/list&categoryId=34
                $sql = "select product_tag_id from product_tag
limit 1";
                $query = DataBaseHelper::query($sql);
                $url = ($query) ? $dispatch.'&productTagId='.$query[0]->productTagId : $dispatch.'&productTagId=?';
                break;
			case 'home/orders/detail':		//home/orders/detail&orderId=15
				$sql = "select id as orderId from orders
where is_del=0
limit 1";
				$params = array();
				$query = DataBaseHelper::query($sql, $params);
				$url = ($query) ? $dispatch.'&orderId='.$query[0]->orderId : $dispatch.'&orderId=?';
				break;
			case 'home/news/list':			//home/news/list&newsCategoryId=1
				$sql = "select news_category_id from news_category
limit 1";
				$query = DataBaseHelper::query($sql);
				$url = ($query) ? $dispatch.'&newsCategoryId='.$query[0]->newsCategoryId : $dispatch.'&newsCategoryId=?';
				break;
			case 'home/news/detail':		//home/news/detail&newsId=1
				$sql = "select news_id from news
limit 1";
				$query = DataBaseHelper::query($sql);
				$url = ($query) ? $dispatch.'&newsId='.$query[0]->newsId : $dispatch.'&newsId=?';
				break;
			case 'home/news/tag':			//home/news/tag&newsTagId=1
				$sql = "select news_tag_id from news_tag
limit 1";
				$query = DataBaseHelper::query($sql);
				$url = ($query) ? $dispatch.'&newsTagId='.$query[0]->newsTagId : $dispatch.'&newsTagId=?';
				break;
			case 'home/static_page/view':	//home/static_page/view&staticPageId=1
				$sql = "select static_page_id from static_page
limit 1";
				$query = DataBaseHelper::query($sql);
				$url = ($query) ? $dispatch.'&staticPageId='.$query[0]->staticPageId : $dispatch.'&staticPageId=?';
				break;
			default:
				$url = $dispatch;
				break;
		}
		return $url;
	}
	
	/**
	 * get json data from web api by url
	 * 
	 * @param string $url
	 * @param bool $https(is true* if $url = https protocol else false if $url = http protocol)
	 */
	public static function getCurlData($url, $https=true){
		if($https){		//example	https://www.google.com/recaptcha/api/siteverify...
			//  Initiate curl
			$curl = curl_init();
			// Disable SSL verification
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			// Will return the response, if false it print the response
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			// Set the url
			curl_setopt($curl, CURLOPT_URL, $url);
			// Execute
			$result = curl_exec($curl);
			// Closing
			curl_close($curl);
			// Will dump a beauty json :3
			return json_decode($result, true);
		} else {
			//chua test
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			$curlData = curl_exec($curl);
			curl_close($curl);
			return json_decode($curlData, true);
		}
	}
}