<?php 
class SeoHelper{
	/**
	 * getAllCountry
	 */
	public static function getSeoInfo($itemId,$type){
		$seoDao = new SeoInfoDao();
		$seoVo = new SeoInfoVo();
    $seoVo->itemId=$itemId;
    $seoVo->type=$type;
		$seoVos = $seoDao->selectByFilter($seoVo);
		$seo = $seoVos[0];
		return $seo;
	}
}
?>