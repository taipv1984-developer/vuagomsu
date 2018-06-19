<?php
class AdminSiteMapController extends Controller {
    private $pluginCode;
    
    function __construct(){
    	//get $pluginCode
    	$actionControler = get_class($this);
    	$pluginCodeMap = Session::getSession('pluginCodeMap');
    	$this->pluginCode = (isset($pluginCodeMap[$actionControler])) ? $pluginCodeMap[$actionControler] : '';
    }
    
	public function index(){
		$xmlData = array('' => array(
    				'title' => e('Home'),
    				'priority' => 1
    			));
		
		$productCategoryXmlData = $this->getProductCategoryXmlData();
		$productXmlData = $this->getProductXmlData();
		$newsCategoryXmlData = $this->getNewsCategoryXmlData();
		$newsXmlData = $this->getNewsXmlData();
		//newsTag skip
		$staticPageXmlData = $this->getStaticPageXmlData();
		$commonPageXmlData = $this->getCommonPageXmlData();
		
		$xmlData = array_merge($xmlData, $productCategoryXmlData);
		$xmlData = array_merge($xmlData, $productXmlData);
		$xmlData = array_merge($xmlData, $newsCategoryXmlData);
		$xmlData = array_merge($xmlData, $newsXmlData);
		$xmlData = array_merge($xmlData, $staticPageXmlData);
		$xmlData = array_merge($xmlData, $commonPageXmlData);
		
		//get $xmlContent
		$xmlContent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xmlContent .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
		foreach ($xmlData as $k => $v){
			$xmlContent .= "<url><loc>" .Registry::getSetting('base_url'). "/$k</loc><changefreq>{$v['title']}</changefreq><priority>{$v['priority']}</priority></url>\n";
		}
		$xmlContent .= "</urlset>";
		
		//save file
		$fileName = 'sitemap.xml';
		file_put_contents($fileName, $xmlContent);
		
		//send data
		$this->setAttributes(array(
			'xmlDataCount' => count($xmlData),
			'productCategoryXmlDataCount' => count($productCategoryXmlData),
			'productXmlDataCount' => count($productXmlData),
			'newsCategoryXmlDataCount' => count($newsCategoryXmlData),
			'newsXmlDataCount' => count($newsXmlData),
			'staticPageXmlDataCount' => count($staticPageXmlData),
			'commonPageXmlDataCount' => count($commonPageXmlData),
		));
		
		//message
		SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Site map is update success");
		
        //call view
        return $this->setRender('success');
    }
    
    private function getProductCategoryXmlData(){
    	$filter = array(
    		'dispatch' => 'home/product/list',
    		'redirect_to' => '',
    	);
    	$routerUrl = RouterExt::getRouterUrlListByAlias($filter);
    	$xmlData = array();
    	foreach ($routerUrl as $k => $v){
    		if($v->pkValue != ''){
    			$categoryInfo = CategoryExt::getCategoryInfo($v->pkValue);
    			if($categoryInfo){
    				$title = $categoryInfo->name;
    				$url = $v->alias;
    				if(!isset($xmlData[$url]) & $title != ''){
    					$xmlData[$url] = array(
		    				'title' => $title,
		    				'priority' => 1
		    			);
    				}
    			}
    		}
    		else{
    			$title = $v->alias;
    			$url = $v->alias;
    			if(!isset($xmlData[$url]) & $title != ''){
    				$xmlData[$url] = array(
	    				'title' => $title,
	    				'priority' => 1
	    			);
    			}
    		}
    	}
    	return $xmlData;
    }
    
    private function getProductXmlData(){
    	$filter = array(
    		'dispatch' => 'home/product/detail',
    		'redirect_to' => '',
    	);
    	$routerUrl = RouterExt::getRouterUrlListByAlias($filter);
    	$xmlData = array();
    	foreach ($routerUrl as $k => $v){
    		if($v->pkValue != ''){
	    		$productInfo = ProductExt::getProductInfo($v->pkValue);
	    		if($productInfo){
	    			$title = $productInfo->name;
	    			$url = $v->alias;
	    			if(!isset($xmlData[$url]) & $title != ''){
	    				$xmlData[$url] = array(
		    				'title' => $title,
		    				'priority' => 1
		    			);
	    			}
	    		}
	    	}
	    	else{
	    		$title = $k;
	    		$url = $v->alias;
	    		if(!isset($xmlData[$url]) & $title != ''){
	    			$xmlData[$url] = array(
	    				'title' => $title,
	    				'priority' => 1
	    			);
	    		}
	    	}
    	}
    	return $xmlData;
    }
    
    private function getNewsCategoryXmlData(){
    	$filter = array(
    		'dispatch' => 'home/news/list',
    		'redirect_to' => '',
    	);
    	$routerUrl = RouterExt::getRouterUrlListByAlias($filter);
    	$xmlData = array();
    	foreach ($routerUrl as $k => $v){
    		if($v->pkValue != ''){
    			$categoryInfo = CategoryExt::getCategoryInfo($v->pkValue);
    			if($categoryInfo){
    				$title = $categoryInfo->name;
    				$url = $v->alias;
    				if(!isset($xmlData[$url]) & $title != ''){
    					$xmlData[$url] = array(
		    				'title' => $title,
		    				'priority' => 0.8
		    			);
    				}
    			}
    		}
    		else{
    			$title = $k;
    			$url = $v->alias;
    			if(!isset($xmlData[$url]) & $title != ''){
    				$xmlData[$url] = array(
	    				'title' => $title,
	    				'priority' => 0.8
	    			);
    			}
    		}
    	}
    	return $xmlData;
    }
    
    private function getNewsXmlData(){
    	$filter = array(
    		'dispatch' => 'home/news/detail',
    		'redirect_to' => '',
    	);
    	$routerUrl = RouterExt::getRouterUrlListByAlias($filter);
    	$xmlData = array();
    	foreach ($routerUrl as $k => $v){
    		if($v->pkValue != ''){
    			$newsInfo = NewsExt::getNewsInfo($v->pkValue);
    			if($newsInfo){
    				$title = $newsInfo->title;
    				$url = $v->alias;
    				if(!isset($xmlData[$url]) & $title != ''){
    					$xmlData[$url] = array(
		    				'title' => $title,
		    				'priority' => 0.8
		    			);
    				}
    			}
    		}
    		else{
    			$title = $k;
    			$url = $v->alias;
    			if(!isset($xmlData[$url]) & $title != ''){
    				$xmlData[$url] = array(
	    				'title' => $title,
	    				'priority' => 0.8
	    			);
    			}
    		}
    	}
    	return $xmlData;
    }
    
    private function getStaticPageXmlData(){
    	$filter = array(
    		'dispatch' => 'home/static_page/view',
    		'redirect_to' => '',
    	);
    	$routerUrl = RouterExt::getRouterUrlListByAlias($filter);
    	$xmlData = array();
    	foreach ($routerUrl as $k => $v){
    		if($v->pkValue != ''){
    			$staticPageInfo = StaticPageExt::getStaticPageInfo($v->pkValue);
    			if($staticPageInfo){
    				$title = $staticPageInfo->title;
    				$url = $v->alias;
    				if(!isset($xmlData[$url]) & $title != ''){
    					$xmlData[$url] = array(
		    				'title' => $title,
		    				'priority' => 0.6
		    			);
    				}
    			}
    		}
    		else{
    			$title = $k;
    			$url = $v->alias;
    			if(!isset($xmlData[$url]) & $title != ''){
    				$xmlData[$url] = array(
	    				'title' => $title,
	    				'priority' => 0.6
	    			);
    			}
    		}
    	}
    	return $xmlData;
    }
    
    private function getCommonPageXmlData(){
    	$sql = "select ru.alias, l.name as title, l.dispatch as layout_dispatch
from `router_url` as ru
left join router as r on r.router_id=ru.router_id
left join layout as l on l.layout_id=r.layout_id
where ru.redirect_to=''
	and (ru.pk_name is null or ru.pk_name='') and (ru.pk_value is null or ru.pk_value='')
	and ru.alias not in ('admin', '404')";
    	$routerUrl = DataBaseHelper::query($sql);
    	$xmlData = array();
    	foreach ($routerUrl as $v){
    		$title = $v->title;
    		$url = $v->alias;
    		if(!isset($xmlData[$url]) & $title != ''){
    			$xmlData[$url] = array(
    					'title' => $title,
    					'priority' => 0.5
    			);
    		}
    	}
    	return $xmlData;
    }
}