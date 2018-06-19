<?php
class BreadcrumbHelper{
	public static function getBreadcrumbAuto($r){
		//get layout info
		$sql = "select * from `layout` where `dispatch`='$r'";
		$query = DataBaseHelper::query($sql);
		if($query){
			$layoutInfo = $query[0];
			
			//get $breadcrumb
			$breadcrumb = array();
			$breadcrumb[] = array(
				'title' => $layoutInfo->name,
				'link' => ''
			);
			
			TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
		}
		else{
			LogUtil::devInfo("[BreadcrumbHelper::getBreadcrumbAuto] not found layout have dispatch = $r");
			return false;
		}
	}
	
	public static function getBreadcrumbCategory($categoryId){
		$breadcrumb = array();
		if(!$categoryId){
			$breadcrumb[] = array(
				'title' => e('Product'),
				'link' => ''
			);
		}
		else{
			$ok = true;
			$i = 0;
			while($ok){
				$i++;
				//get $parentId
				$sql = "SELECT * from category where category_id=$categoryId";
				$query = DataBaseHelper::query($sql);
				if($query){
					$categoryInfo = $query[0];
					$parentId = $categoryInfo->parentId;
					if($i == 1){
						$breadcrumb[] = array(
							'title' => $categoryInfo->name,
							'link' => ''
						);
					}
					else{
						$breadcrumb[] = array(
							'title' => $categoryInfo->name,
							'link' => URLHelper::getProductListPage($categoryId)
						);
					}
		
					//loop
					if($parentId){
						$categoryId = $parentId;
					}
					else{
						$ok = false;
					}
				}
				else{
					$ok = false;
				}
			}
			
			//add linkview all
			$breadcrumb[] = array(
				'title' => e('Product'),
				'link' => URLHelper::getProductListPage()
			);
		}
	
		TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
	}
	
	public static function getBreadcrumbProduct($productId){
		$productInfo = ProductExt::getProductInfo($productId);
        $categoryPrimary = ProductExt::getCategoryPrimary($productId);
        $categoryId = ($categoryPrimary) ? $categoryPrimary->categoryId : 0;

		$breadcrumb = array();
        $breadcrumb[] = array(
            'title' => $productInfo->name,
            'link' => ''
        );
		if($categoryId) {
            $ok = true;
            while ($ok) {
                //get $parentId
                $sql = "SELECT * from category where category_id=$categoryId";
                $query = DataBaseHelper::query($sql);
                if ($query) {
                    $categoryInfo = $query[0];
                    $parentId = $categoryInfo->parentId;
                    $breadcrumb[] = array(
                        'title' => $categoryInfo->name,
                        'link' => URLHelper::getProductListPage($categoryId)
                    );

                    //loop
                    if ($parentId) {
                        $categoryId = $parentId;
                    } else {
                        $ok = false;
                    }
                } else {
                    $ok = false;
                }
            }
        }

        $breadcrumb[] = array(
            'title' => e('Product'),
            'link' => URLHelper::getProductListPage()
        );
	
		TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
	}
	
	public static function getBreadcrumbNewsCategory($newsCategoryId){
		$breadcrumb = array();
		if(!$newsCategoryId){
			$breadcrumb[] = array(
				'title' => e('News'),
				'link' => ''
			);
		}
		else{
			$ok = true;
			$i = 0;
			while($ok){
				$i++;
				//get $parentId
				$sql = "SELECT * from news_category where news_category_id=$newsCategoryId";
				$query = DataBaseHelper::query($sql);
				if($query){
					$newsCategoryInfo = $query[0];
					$parentId = $newsCategoryInfo->parentId;
					if($i == 1){
						$breadcrumb[] = array(
							'title' => $newsCategoryInfo->name,
							'link' => ''
						);
					}
					else{
						$breadcrumb[] = array(
							'title' => $newsCategoryInfo->name,
							'link' => URLHelper::getNewsListPage($newsCategoryId)
						);
					}
		
					//loop
					if($parentId){
						$newsCategoryId = $parentId;
					}
					else{
						$ok = false;
					}
				}
				else{
					$ok = false;
				}
			}
		
			//add linkview all
			$breadcrumb[] = array(
				'title' => e('News'),
				'link' => URLHelper::getNewsListPage()
			);
		}
		
		TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
	}
	
	public static function getBreadcrumbNews($newsId){
		$newsInfo = NewsExt::getNewsInfo($newsId);
		$newsCategoryId = $newsInfo->newsCategoryId;
		$breadcrumb = array();
        $breadcrumb[] = array(
            'title' => $newsInfo->title,
            'link' => ''
        );
		$ok = true;
		while($ok){
			//get $parentId
			$sql = "SELECT * from news_category where news_category_id=$newsCategoryId";
			$query = DataBaseHelper::query($sql);
			if($query){
				$newsCategoryInfo = $query[0];
				$parentId = $newsCategoryInfo->parentId;
				$breadcrumb[] = array(
					'title' => $newsCategoryInfo->name,
					'link' => URLHelper::getNewsListPage($newsCategoryId)
				);
	
				//loop
				if($parentId){
					$newsCategoryId = $parentId;
				}
				else{
					$ok = false;
				}
			}
			else{
				$ok = false;
			}
		}
		
		//add linkview all
		$breadcrumb[] = array(
			'title' => e('News'),
			'link' => URLHelper::getNewsListPage()
		);
	
		TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
	}
	
	public static function getBreadcrumbNewsTag($newsTagId){
		$breadcrumb = array();
		if(!$newsTagId){
			$breadcrumb[] = array(
				'title' => e('News tag'),
				'link' => ''
			);
		}
		else{
			//get newsTagName of $newsTagId
			$sql = "SELECT * from news_tag where news_tag_id=$newsTagId";
			$query = DataBaseHelper::query($sql);
			if($query){
				$breadcrumb[] = array(
					'title' => $query[0]->name,
					'link' => ''
				);
			}
	
			//add linkview all
			$breadcrumb[] = array(
				'title' => e('News tag'),
				'link' => URLHelper::getNewsTagPage()
			);
		}
	
		TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
	}
	
	public static function getBreadcrumbStaticPage($staticPageId){
		$breadcrumb = array();
		//get staticPageName of $staticPageId
		$sql = "SELECT * from static_page where static_page_id=$staticPageId";
		$query = DataBaseHelper::query($sql);
		if($query){
			$breadcrumb[] = array(
				'title' => $query[0]->title,
				'link' => ''
			);
		}
	
		TemplateHelper::getTemplate('common/breadcrumb.php', $breadcrumb);
	}
}
