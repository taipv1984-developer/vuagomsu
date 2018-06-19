<?php 
class CategoryExt{
	public static function getCategoryInfo($categoryId){
		$sql = "select * from category where category_id=$categoryId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
		
	}
	
	public static function getCategoryInfoByName($categoryName){
		$sql = "select * from category where `name`='$categoryName'";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	
	}
	
	/**
	 * getCategoryMap (get all)
	 * apply check name of category is exist then import product
	 * @return array(name => category_id)
	 */
	public static function getCategoryMap(){
		$sql = "select * from category";
		$output = array(
			'type' => 'array',
			'key' => 'name',
			'value' => 'category_id'
		);
		return DataBaseHelper::query($sql, null, $output);
	}
	
	/**
	 * get all category resoft by parentId
	 * @return array
	 */
	public static function getCategoryList(){
		$categoryDao = new CategoryDao();
		$categoryVo = new CategoryVo();
        $categoryVo->categoryId =  array('>', -1);
        $categoryList = $categoryDao->selectByFilter($categoryVo);
//		$categoryList = $categoryDao->selectAll();

		$categoryList = ArrayHelper::objectToArray($categoryList);
		
		//check have children
		foreach($categoryList as $key => $value){
			//add common field
			$categoryList[$key]['id'] = $categoryList[$key]['categoryId'];
			//$categoryList[$key]['name'] = $categoryList[$key]['name'];
			
			//add haveChild
			$categoryList[$key]['haveChild'] = false;
			foreach($categoryList as  $v){
				if($v['parentId'] == $value['categoryId']){
					$categoryList[$key]['haveChild'] = true;
					break;
				}
			}
		}

		return ArrayHelper::recursive( $categoryList);
	}

	public static function getCategoryRootList(){
		$sql = "select * from category where parent_id=0";
		return DataBaseHelper::query($sql);
	}
	
	public static function getCategoriesByProduct($productId){
		$sql = "select * from category where category_id in
				(select category_id from product_category where product_id = ".$productId.")";
		return DataBaseHelper::query($sql);
	}
	
	/**
	 * get all child of $categoryId (use dequi)
	 * 
	 * @param array $child (ref)
	 * @param int $categoryId
	 */
	public static function getChild(&$child, $categoryId){
		if(!isset($child)) $child = array();
		
		$categoryDao = new CategoryDao();
		
		//get all $category
		$category = $categoryDao->selectAll();
		
		//find child
		foreach($category as $v){
			if($v->parentId == $categoryId){
				$child[] = $v->categoryId;
				self::getChild($child, $v->categoryId);
			}
		}
	} 
	
	public static function getParentId($categoryId){
		$sql = "SELECT parent_id
from category 
where category_id=$categoryId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0]->parentId : false;
	}
	
	public static function getParentIdRoot($categoryId){
		$res = $categoryId;
		$ok = true;
		while($ok){
			$parentId = self::getParentId($categoryId);
			if($parentId){
				$categoryId = $parentId;
				$res = $parentId;
			}
			else{
				$ok = false;
			}
		}
		return $res;
	}
	
	/**
	 * get product count of a category
	 * pre get all child of category after count++ 
	 *
	 * @param int $categoryId
	 * @return int
	 */
	public static function getProductCount($categoryId){
		//get child
		self::getChild($child, $categoryId);
		array_push($child, $categoryId);
		
		$count = 0;
		foreach ($child as $v){
			$sql = "select count(*) as `count` 
from product_category as pc
left join category as c on c.category_id = pc.category_id
where c.category_id = :categoryId";
	   		$params = array(
	   			array(':categoryId', $v),
	   		);
	   		$query = DataBaseHelper::query($sql, $params);
	   		$count += (int)$query[0]->count;
		}
		
   		return $count;
	}
	
	/**
	 * getAllProduct of a category
	 * if $categoryId = 0 then getAllProduct of system
	 * 
	 * @param int $categoryId
	 * @return array
	 */
	public static function getAllProduct($categoryId){
		if($categoryId){
			//get child
			self::getChild($child, $categoryId);
			array_push($child, $categoryId);
			
			$where_in = 'in ('.join(', ', $child).')';
			$sql = "select p.* 
from product as p
left join product_category as pc on pc.product_id = p.product_id
left join category as c on c.category_id = pc.category_id
where c.category_id $where_in 
and p.`status` = 'A'";
			$query = DataBaseHelper::query($sql);
		}
		else{
			$sql = "select * 
from product
where `status` = 'A'";
			$query = DataBaseHelper::query($sql);
		}
		return $query;
	}
	public static function getProductListByRange($categoryId,$size){
		if ($size != '') $size = "limit $size";
		if($categoryId != 0){
			//get child
			self::getChild($child, $categoryId);
			array_push($child, $categoryId);
			
			$where_in = 'in ('.join(', ', $child).')';
			$sql = "select 
						* 
					from product
					where category_id $where_in 
						and `status` = 'A' 
					$size";	
			$query = DataBaseHelper::query($sql);
		}
		else{
			$sql = "select 
						* 
					from product
					where `status` = 'A'
					$size";
			$query = DataBaseHelper::query($sql);
		}
	
		return $query;
	}
	
	public static function getAllProductId($categoryId){
		//get allProduct
		$allProduct = self::getAllProduct($categoryId);
		
		$allProductId = array();
		foreach ($allProduct as $v){
			$allProductId[] = $v->productId;
		}
		
		return $allProductId;
	}
	
	public static function getAllFilter($categoryId,$productIdArr){
		//get allProductId
		$allProductId = self::getAllProductId($categoryId);
		if(count($allProductId) == 0) return array();
		if ($categoryId == null && count($productIdArr) > 0) $allProductId = $productIdArr;
		
		$where_in = 'in ('.join(', ', $allProductId).')';
		$sql = "select *, 
					av.attribute_value_id as attributeValueId, 
					am.attribute_map_id as attributeMapId, 
					a.attribute_id as attributeId,
					a.image as attributeImage, av.image as attributeValueImage
				from attribute_value as av
				left join attribute_map as am on av.attribute_value_id = am.attribute_value_id
				left join attribute as a on av.attribute_id = a.attribute_id
				where am.product_id $where_in and a.`type`='select'
				group by av.`value`
				order by a.attribute_id";
		$query = DataBaseHelper::query($sql);
		
		//group data by attributeId
		$filter = array();
		foreach ($query as $v){
			$filter[$v->attributeId]['attributeId'] = $v->attributeId;
			$filter[$v->attributeId]['name'] = $v->name;
			$filter[$v->attributeId]['type'] = $v->type;
			$filter[$v->attributeId]['attributeValue'][] = $v;
		}

		return $filter;
	}
	
	public static function getByIdList($categoryIdList){
		$sql = "select *
				from category
				where category_id in ($categoryIdList)
				union
				select *
				from category
				where category_id in (
					select parent_id
					from category
					where category_id in ($categoryIdList))
				order by category_id";
		$query = DataBaseHelper::query($sql);
		return $query;
	}
	
	public static function getTotalCategory(){
		$sql = "select count(*) as `count` from category";
		$query = DataBaseHelper::query($sql);
		return $query[0]->count;
	}
	
	/**
	 * getPriceRange of $categoryId (and child of $categoryId)
	 * 
	 * @param int $categoryId
	 * @return object(maxPrice, minPrice)
	 */
	public static function getPriceRange($categoryId, $priceRangeMin=10){
		if($categoryId){
			$child = array();
			self::getChild($child, $categoryId);
			$child[] = $categoryId;
			$sql = "select max(price) as max_price, min(price) as min_price 
					from product 
				where category_id in (" .join(', ', $child). ");";
		}
		else{
			$sql = "select max(price) as max_price, min(price) as min_price
			from product";
		}
		$query = DataBaseHelper::query($sql);
		
		//get $priceMin and $priceMax of category
		$priceMin = floor($query[0]->minPrice);
		$priceMax = ceil($query[0]->maxPrice);
		if($priceMin == $priceMax){
			$priceRange = array(
				"0,$priceMin" => "Under ".CurrencyExt::format_price($priceMin, '', -1)
			);
			return $priceRange;
		}
		else{
			//get $priceRange
			if(($priceMax - $priceMin) > $priceRangeMin){
				//split to 3 range by price
				$step = floor(($priceMax - $priceMin)/3);
				$step1 = $priceMin+$step;
				$step2 = $priceMin+$step+$step;
				$priceRange = array(
					"0,$step1" => "Under ".CurrencyExt::format_price($step1, '', -1),
					"$step1,$step2" => CurrencyExt::format_price($step1, '', -1). " - ". CurrencyExt::format_price($step2, '', -1),
					"$step2,$priceMax" => CurrencyExt::format_price($step2, '', -1). " - ". CurrencyExt::format_price($priceMax, '', -1),
				);
			}
			else{
				//split to 2 range by price
				$step = floor(($priceMax - $priceMin)/2);
				$step1 = $priceMin+$step;
				$priceRange = array(
					"0,$step1" => "Under ".CurrencyExt::format_price($step1, '', -1),
					"$step1,$priceMax" => CurrencyExt::format_price($step1, '', -1). " - ". CurrencyExt::format_price($priceMax, '', -1),
				);
			}
		}
		
		return $priceRange;
	}
	
	/***************************************
	 * PRODUCT CATEGORY
	 **************************************/
    /**
     * delete product_category (if product in mutil category) and category
     * Chek all product of category
     * if product in a category then change category=-1 (move to uncategory)
     * else delete product_category that
     * @param $categoryId
     * @return bool
     */
    public static function deleteCategory($categoryId){
        $sql = "select * FROM product_category WHERE category_id=$categoryId";
        $productCategoryList = DataBaseHelper::query($sql);

        //delete productCategory
        foreach ($productCategoryList as $v) {
            $sql = "select * FROM product_category WHERE product_id={$v->productId}";
            $query = DataBaseHelper::query($sql);
            if(count($query) == 1){
                //change category=-1
                $sql = "update product_category set category_id=-1 WHERE category_id=$categoryId and product_id={$v->productId}";
                DataBaseHelper::query($sql, null, null);
            }
            else{
                //delete productCategory
                $sql = "DELETE FROM product_category WHERE category_id=$categoryId and product_id={$v->productId}";
                DataBaseHelper::query($sql, array(), 'delete');
            }
        }

        //delete category
        $categoryDao = new CategoryDao();
        $categoryDao->deleteByPrimaryKey($categoryId);
    }
	
	/**********************
	 ROUTER
	 ********************/
	/**
	 * getAlias of $categoryInfo
	 * 
	 * @param int|object $categoryData
	 * @param string $aliasBy
	 * @return 
	 * 		if $aliasBy='%name%'* 		=> 		categoryName
			if $aliasBy='%full_path%' 	=> 		[parentName/]categoryName
	 */
	public static function getAlias($categoryData, $aliasBy='%name%'){
	    LogUtil::devInfo($categoryData);
		if(is_numeric($categoryData)){
			$categoryId = $categoryData;
			$categoryInfo = self::getCategoryInfo($categoryId);
		}
		else{
			$categoryInfo = $categoryData;
			$categoryId = $categoryInfo->categoryId;
		}
		$alias = '';
		if($aliasBy == '%name%'){
			$sql = "select * from `category` where `category_id`=$categoryId";
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
			$parentId = $categoryId;	//init loop
			while($loop){
				$sql = "select * from `category` where `category_id`=$parentId";
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
			LogUtil::error("[CategoryExt::getAlias] not found case aliasBy = $aliasBy");
		}
	
		$alias = StringHelper::getAlias($alias);
		return $alias;
	}
}
?>