<?php
class ProductExt{
	public function __construct(){
	}
	
	public static function getProductInfo($productId){
		$sql = "select * from product where product_id=$productId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query[0] : false;
	}
	
	public static function getProductList($filter, $orderBy, $start, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($orderBy);
		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);

		$sql = "select distinct p.*
from product as p
left join product_category as pc on pc.product_id = p.product_id
left join category as c on c.category_id = pc.category_id
		$whereCondition $orderCondition $limitCondition";

		return DataBaseHelper::query($sql);
	}
	
	/**
	 * product add information
	 * 		linkView
	 * 		linkEdit
	 * 		categoryList
     *      categoryListText
	 *
	 * @param array $productVos
	 * @return array $productVos
	 */
	public static function addInfo($productVo){
		//get setting
		$product_required_code = Registry::getSetting('product_required_code');
	
		$linkView = URLHelper::getProductDetailPage($productVo->productId);
		$linkEdit = "index.php?r=admin/product/edit&productId={$productVo->productId}";
		$codeStr = ($product_required_code) ? "<br>{$productVo->code}" : '';
		$productVo->linkView = "<a href='$linkView' title='{$productVo->name}' target='blank'>{$productVo->name}</a>$codeStr";
		$productVo->linkEdit = "<a href='$linkEdit' title='{$productVo->name}' target='blank'>{$productVo->name}</a>$codeStr";

		//categoryList
		$productVo->categoryList = self::getCategoryList($productVo->productId);
        //categoryListText
        $categoryListText = array();
        foreach ($productVo->categoryList as $categoryInfo){
            $url = URLHelper::getProductListPage($categoryInfo->categoryId);
            $categoryListText[] = "<a href='$url'>{$categoryInfo->name}</a>";
        }
        $productVo->categoryListText = join($categoryListText, ', ');
	
		$productVo->priceFomat = CurrencyExt::format_price($productVo->price);
	}

	public static function getLatestProduct($limit=6){
		$productDao = new ProductDao();
		$productVo = new ProductVo();
		$orderBy = array('product_id' => 'DESC');
		$latestProduct = $productDao->selectByFilter($productVo, $orderBy, 0, $limit);
		 
		//add info
		foreach($latestProduct as $v){
			ProductExt::addInfo($v);
		}
		
		return $latestProduct;
	}

	/**
	 * get random product relate in category (root)
	 * 
	 * @param int $productId
	 * @param int $limit
	 * @return array
	 */
	public static function getProductRelateList($productId, $limit=0)
    {
        //get $productInfo
        $productDao = new ProductDao();
        $productInfo = $productDao->selectByPrimaryKey($productId);

        //get $categoryId (root)
        $categoryList = self::getCategoryList($productId);
        //get $categoryIdRootList
        $categoryIdRootList = array();
        foreach ($categoryList as $categoryInfo){
        	$categoryRootId = CategoryExt::getParentIdRoot($categoryInfo->categoryId);
        	if(!in_array($categoryRootId, $categoryIdRootList)){
        		$categoryIdRootList[] = $categoryRootId;
        	}
        }
        
        $productList = array();
        foreach ($categoryIdRootList as $categoryIdRoot) {
        	$productList = array_merge($productList, CategoryExt::getAllProduct($categoryIdRoot));
        }

        if(!empty($productList)){
            return ArrayHelper::getRandomArray($productList, null, $limit);
        }
        
        return array();
	}

    /**
     * getProductBestSellersList from orders
     * @param int $limit
     * @return bool
     */
	public static function getProductBestSellersList($limit=12){
		$sql = "select 
				p.*, 
			    sum(quantity) as total_order 
			from product p
			right join order_product op on p.product_id = op.product_id
			where !isnull(p.product_id)
			group by op.product_id
			order by total_order desc
			limit $limit";
		return DataBaseHelper::query($sql);
	}

    /**
     * getProductBestSellersList from product_best_seller table for website no cart
     * @param $filter
     * @param $orderBy
     * @param $startRecord
     * @param $recSize
     * @return bool
     */
    public static function getProductBestSellersListManual($filter, $orderBy, $startRecord, $recSize){
        $whereCondition = DataBaseHelper::getWhereCondition($filter);
        $orderCondition = DataBaseHelper::getOrderCondition($orderBy);
        $limitCondition = DataBaseHelper::getLimitCondition($startRecord, $recSize);
        $sql = "select p.*, 
    	pbs.product_best_seller_id, pbs.order as pbsOrder, pbs.status as pbsStatus
    	from product as p
    	left join product_best_seller as pbs on pbs.product_id=p.product_id
    	$whereCondition $orderCondition $limitCondition";
        $productFeaturedList = DataBaseHelper::query($sql);
        return $productFeaturedList;
    }
	
	public static function getTotalProduct(){
		$sql = "select count(*) as `count` from product";
		$query = DataBaseHelper::query($sql);
		return $query[0]->count;
	}

	public static function getPriceText($price){
		if($price > 0){
			return CurrencyExt::format_price($price);
		}
		else{
			return "Liên hệ";
		}
	}

    /***************************************
     * MANUFAC
     **************************************/
    public static function getManufacName($productId){
        $sql = "SELECT m.`name`
from manufac as m
LEFT JOIN product as p on p.manufac_id = m.manufac_id
where p.product_id=:productId";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params);
        return ($query) ? $query[0]->name : '';
    }

	/***************************************
	 * IMAGE
	 **************************************/
	/**
	 * get all images attach of $productId
	 *
	 * @param int $productId
	 * @return array(product_image_id => image)
	 */
	public static function getImageAttach($productId){
		$sql = "select *
from product_image
where product_id = :productId";
		$params = array(
			array(':productId', $productId),
		);
		$output = array(
			'type' => 'array',  		//object* || array	(required)
			'key' => 'productImageId',	//not required
			'value' => 'image'			//required if type=array
		);
		return DataBaseHelper::query($sql, $params, $output);
	}

	/***************************************
	 * EXTENSION
	 **************************************/
	/**
	 * getProductExtension of $productId
	 * 
	 * @param int $productId
	 * @return array(key => value)
	 */
	public static function getProductExtension($productId){
		$sql = "select *
from product_extension
where product_id = :productId";
		$params = array(
			array(':productId', $productId),
		);
		$output = array(
			'type' => 'array',
			'key' => 'key',
			'value' => 'value'
		);
		return DataBaseHelper::query($sql, $params, $output);
	}
	
	/**
	 * updateProductExtension
	 * b1	delete all $productExtension old
	 * b2	insert new value
	 * 
	 * @param int $productId
	 * @param array $productExtension (get from form)
	 */
	public static function updateProductExtension($productId, $productExtension){
		$productExtensionDao = new ProductExtensionDao();
		
		//b1	delete all $productExtension old
		$productExtensionVo = new ProductExtensionVo();
		$productExtensionVo->productId = $productId;
		$productExtensionDao->deleteByFilter($productExtensionVo);
		
		//b2	insert new value
		foreach ($productExtension as $k => $v){
			$productExtensionVo = new ProductExtensionVo();
			$productExtensionVo->productId = $productId;
			$productExtensionVo->key = $k;
			$productExtensionVo->value = $v;
			$productExtensionDao->insert($productExtensionVo);//update sau
		}
	}

	/***************************************
	 * PRODUCT CATEGORY
	 **************************************/
    public static function getCategoryPrimary($productId){
        $sql = "SELECT c.*
from category as c
LEFT JOIN product_category as pc on pc.category_id = c.category_id
where pc.product_id=:productId and pc.is_primary=1";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params);
        return ($query) ? $query[0] : false;
    }

    public static function getCategoryList($productId){
        $sql = "SELECT c.*
from category as c
LEFT JOIN product_category as pc on pc.category_id = c.category_id
LEFT JOIN product as p on p.product_id = pc.product_id
where p.product_id=:productId";
        $params = array(
            array(':productId', $productId),
        );
        return DataBaseHelper::query($sql, $params);
    }

	/**
	 * updateProductCategory
	 * b1	delete all $productCategory old
	 * b2	insert new value
	 *
	 * @param int $productId
	 * @param array $productCategory (get from form)
	 */
	public static function updateProductCategory($productId, $categoryIdList, $categoryPrimaryId){
		$productCategoryDao = new ProductCategoryDao();
	
		//b1	delete all $productCategory old
		$productCategoryVo = new ProductCategoryVo();
		$productCategoryVo->productId = $productId;
		$productCategoryDao->deleteByFilter($productCategoryVo);

		//b2	insert new value
		foreach ($categoryIdList as $categoryId){
			$productCategoryVo = new ProductCategoryVo();
			$productCategoryVo->productId = $productId;
			$productCategoryVo->categoryId = $categoryId;
			if($categoryId == $categoryPrimaryId) {
                $productCategoryVo->isPrimary = 1;
            }
            else{
                $productCategoryVo->isPrimary = 0;
            }
			$productCategoryDao->insert($productCategoryVo);
		}
	}

	/***************************************
	 * FILTER
	 **************************************/
	public static function getFilter($filter, $order, $start, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($order);
		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
		$sql = "SELECT p.*, op.total_quantity
		FROM product as p
		LEFT JOIN manufac as m on m.manufac_id=p.manufac_id
		left join product_category as pc on pc.product_id = p.product_id
		LEFT JOIN category as c on c.category_id=pc.category_id
        LEFT JOIN
			(select product_id, sum(quantity) as total_quantity
            from order_product
            group by product_id
            ) as op on op.product_id = p.product_id
		$whereCondition $orderCondition $limitCondition";
		$params = array();
		$query = DataBaseHelper::query($sql, $params);
        //LogUtil::info($sql);
		return $query;
	}

    public static function getFilterByTag($filter, $order, $start, $recSize){
        $whereCondition = DataBaseHelper::getWhereCondition($filter);
        $orderCondition = DataBaseHelper::getOrderCondition($order);
        $limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
        $sql = "SELECT p.*
		FROM product as p
		LEFT JOIN product_tag_map as ptmap on ptmap.product_id=p.product_id
		left join product_tag as ptag on ptag.product_tag_id = ptmap.product_tag_id
		$whereCondition $orderCondition $limitCondition";
        $params = array();
        $query = DataBaseHelper::query($sql, $params);

        return $query;
    }

    public static function getProductSearchFilter($filter, $order=array(), $start=0, $recSize=0, $key, $categoryIdList){
        //$whereCondition = DataBaseHelper::getWhereCondition($filter);
        $whereCondition1 = DataBaseHelper::getWhereCondition($filter);
        //build $whereCondition by $filter['p.`name`'] and $categoryIdList
        //(p.`name` like '%lọ hoa%' or c.`category_id` in (23,24,25,34))
        if(count($categoryIdList) > 0) {
            $whereCondition2 = "(p.`name` like '%$key%' or c.`category_id` in (" . join(',', $categoryIdList) . "))";
        }
        else{
            $whereCondition2 = "(p.`name` like '%$key%')";
        }
        $whereCondition = "$whereCondition1 and $whereCondition2";
        $orderCondition = DataBaseHelper::getOrderCondition($order);
        $limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
        $sql = "SELECT p.*, op.total_quantity
		FROM product as p
		LEFT JOIN manufac as m on m.manufac_id=p.manufac_id
		left join product_category as pc on pc.product_id = p.product_id
		LEFT JOIN category as c on c.category_id=pc.category_id
        LEFT JOIN
			(select product_id, sum(quantity) as total_quantity
            from order_product
            group by product_id
            ) as op on op.product_id = p.product_id
		$whereCondition $orderCondition $limitCondition";

        $params = array();
        $query = DataBaseHelper::query($sql, $params);

        return $query;
    }
	
	/**
	 * *** (hard)
	 * getAllProductId by PropertiesFilter
	 * apply for filer by mutil attribute condition (or, and)
	 * solution: get all productId per condition or, after remove productId incorrect per condition and...
	 *
	 * @param array $attribute
	 * @return array
	 */
	public static function getProductIdsByFilter($attribute){
		if(!is_array($attribute)) return array();
		if(count($attribute) == 0) return array();
		 
		$sql = "select av.attribute_value_id as attributeValueId, a.attribute_id as attributeId
from attribute_value as av
left join attribute as a on av.attribute_id = a.attribute_id";
		$query = DataBaseHelper::query($sql);
		$groupId = array();
		foreach ($query as $v){
			$groupId["$v->attributeValueId"] = $v->attributeId;
		}
		 
		//get $filterGroup
		$filterGroup = array();
		foreach ($attribute as $v){
			$group = $groupId[$v];
			$filterGroup[$group][] = $v;
		}
		 
		//get $productId
		$productIds = array();
		$i = 0;
		foreach ($filterGroup as $attributeValueId){
			$i++;
			$where_in = 'in ('.join(', ', $attributeValueId).')';
			$sql = "select am.product_id as productId
			from attribute_value as av
			left join attribute_map as am on av.attribute_value_id = am.attribute_value_id
			left join attribute as a on av.attribute_id = a.attribute_id
			where av.attribute_value_id $where_in
			group by am.product_id";
			$query = DataBaseHelper::query($sql);
			 
			//get productId from $query
			if($i == 1){	//first add all data
				foreach ($query as $v){
					$productIds[$v->productId] = $v->productId;
				}
			}
			else{	//remove productId if in_array $productIds
				$productIdsWrap = array();
				foreach ($query as $v){
					if(in_array($v->productId, $productIds)) $productIdsWrap[$v->productId] = $v->productId;
				}
				//set $productIds (again)
				$productIds = $productIdsWrap;
			}
		}
		 
		//return
		return $productIds;
	}
	
   /***************************************
    * ATTRIBUTE
    **************************************/
	public static function getProductAttribute($productId){
		$sql = "select am.*, a.`name`, a.type, a.image as attributeImage, 
				av.`value`, av.description, av.image as attributeValueImage, av.image_list
from attribute_map as am
left join attribute as a on a.attribute_id=am.attribute_id
left join product as p on p.product_id=am.product_id
left join attribute_value as av on av.attribute_value_id=am.attribute_value_id
where p.product_id=:productId";
		$params = array(
			array(':productId', $productId),
		);
		$query = DataBaseHelper::query($sql, $params);
	
		//group data by attributeId
		$attributeList = array();
		foreach ($query as $v){
			$attributeList[$v->attributeId]['attributeId'] = $v->attributeId;
			$attributeList[$v->attributeId]['name'] = $v->name;
			$attributeList[$v->attributeId]['type'] = $v->type;
			$attributeList[$v->attributeId]['attributeImage'] = $v->attributeImage;
			$attributeList[$v->attributeId]['attributeValue'][] = $v;
		}
	
		return $attributeList;
	}
	
   /**
    * get all product attribute	OK
    *
    * @return array
    */
    public static function getAttributeList(){
   		$sql = "select a.attribute_id, a.`name`, a.type, a.image as attribute_image, 
	av.attribute_value_id, av.`value`, av.image as attribute_value_image
from `attribute` as a
LEFT JOIN attribute_value as av on av.attribute_id=a.attribute_id";
	   	$query = DataBaseHelper::query($sql);
	   	
	   	$attributeList = array();
	   	foreach($query as $k => $v){
	   		$attributeList[$v->attributeId]['attributeId'] = $v->attributeId;
	   		$attributeList[$v->attributeId]['name'] = $v->name;
	   		$attributeList[$v->attributeId]['type'] = $v->type;
	   		$attributeList[$v->attributeId]['attributeImage'] = $v->attributeImage;
	   		$attributeList[$v->attributeId]['attributeValue'][] = $v;
	   	}
	   	return $attributeList;
    }
    
    public static function getAttributeArray(){
    	$sql = "select a.attribute_id, a.`name`, a.type, a.image as attribute_image, 
	av.attribute_value_id, av.`value`, av.image as attribute_value_image
from `attribute` as a
LEFT JOIN attribute_value as av on av.attribute_id=a.attribute_id";
	   	$query = DataBaseHelper::query($sql);
	   	
	   	$attributeArray = array();
	   	foreach($query as $k => $v){
	   		$attributeArray[$v->attributeId][$v->attributeValueId] = $v->value;
	   	}
	   	return $attributeArray;
    }
   
   /**
    * get all filter by attributeId	OK
    *
    * @param int $attributeId
    * @return array
    */
   public static function getAttributeValue($attributeId){
	   	$attributeValueDao = new AttributeValueDao();
	   	$attributeValueVo = new AttributeValueVo();
	   	$attributeValueVo->attributeId=$attributeId;
	   	$attributeValueVos = $attributeValueDao->selectByFilter($attributeValueVo);
	   	$attributeDetail = array();
	   	foreach($attributeValueVos as $k => $v){
	   		$attributeDetail[$v->attributeId] = $v->value;
	   	}
	   	if(count($attributeDetail) == 0){
	   		$first = array('' => e('Emty---'));
	   		return($first + $attributeDetail);
	   	}
	   	else{
	   		return $attributeDetail;
	   	}
   }
   
   /***************************************
    * CART
    **************************************/
   /**
    * setSessionCart 	OK
    *
    * @param int $productId
    * @param int $quantity
    * @param int $attributeValueId
    */
    public static function setSessionCart($productId, $quantity, $attributeValueId=0, $autoIncrement=true){
    	if($autoIncrement){
   			$_SESSION[SESSION_GROUP]['productCart'][$productId][$attributeValueId] += intval($quantity);
    	}
    	else{
    		$_SESSION[SESSION_GROUP]['productCart'][$productId][$attributeValueId] = intval($quantity);
    	}
    }
    
    /**
     * getSessionCart	OK
     *
     * @param int $productId
     * @param int $attributeValueId
     * @return number
     */
    public static function getSessionCart($productId, $attributeValueId=0){
    	if($attributeValueId){
    		if(isset($_SESSION[SESSION_GROUP]['productCart'][$productId][$attributeValueId]))
    			return $_SESSION[SESSION_GROUP]['productCart'][$productId][$attributeValueId];
    		else
    			return false;
    	}
    	else{
	    	if(isset($_SESSION[SESSION_GROUP]['productCart'][$productId]))
	    		return $_SESSION[SESSION_GROUP]['productCart'][$productId];
	    	else
	    		return false;
    	}
    }
    
    /**
     * deleteSessionCart of productId or deleteSessionCart all
     * 
     * @param int $productId
     */
    public static function deleteSessionCart($productId=0, $attributeValueId=0){
    	if($productId){
    		if($attributeValueId){
    			unset($_SESSION[SESSION_GROUP]['productCart'][$productId][$attributeValueId]);
    		}
    		else{
    			unset($_SESSION[SESSION_GROUP]['productCart'][$productId]);
    		}
    	}
    	else{
    		unset($_SESSION[SESSION_GROUP]['productCart']);
   		}
    }
   
   /**
    * getCartInfo
    * if $orderId=0(*) then get data from session (apply frontend)
    * else get data from ordersId (apply for admin)
    *
    * @param int $orderId
    * @return array('productCart'=>array(...), 'subTotal'=>, 'totalItems'=>)
    */
    public static function getCartInfo(){
    	$attributeValueDao = new AttributeValueDao();
    	
    	//default (get data from session)
    	$productDao = new ProductDao();
    	
    	$productCart = array();
    	$totalItem = 0;
    	$totalQuantity = 0;
    	$totalWeight = 0;
    	$subTotal = 0;
    	//check price (if a product have price=0 -> return subTotal = 0
    	$resetSubTotal = false;
    	
    	//get $productCart
    	foreach($_SESSION[SESSION_GROUP]['productCart'] as $productId => $productCartAttributeValue){
    		$productInfo = $productDao->selectByPrimaryKey($productId);
    		foreach ($productCartAttributeValue as $attributeValueId => $quantity){
    			$attributeValueInfo = $attributeValueDao->selectByPrimaryKey($attributeValueId);
    	
    			$totalItem++;
    			$totalQuantity += $quantity;
    	
    			$price = $productInfo->price;
    			if($price == 0){
    				$resetSubTotal = true;
    			}
    			$priceTotal = doubleval($price)* intval($quantity);
    			$subTotal += $priceTotal;
    			$weight = ($productInfo->weight) ? $productInfo->weight : 0;
    			$weightTotal = doubleval($weight)* intval($quantity);
    			$totalWeight += $weightTotal;
    	
    			$productLink = URLHelper::getProductDetailPage($productInfo->productId);
    			$productCart[$productId][$attributeValueId] = array(
    				'productId' => $productId,
    				'code' => $productInfo->code,
    				'productName' => $productInfo->name,
    				'productLink' => "<a href='$productLink' title='{$productInfo->name}' target='bank'>{$productInfo->name}</a>",
    				'productCode' => $productInfo->code,
    				'status' => $productInfo->status,
    				'quantity' => $quantity,
    				'image' => $productInfo->image,
    				'price' => $price,
                    'saleOf' => $productInfo->saleOf,
                    'discount' => $productInfo->discount,
    				'priceTotal' => $priceTotal,
    				'weight'		=> 	$weight,
    				'weightTotal'	=>	 $weightTotal,
    						
    				'attributeValueId' => $attributeValueId,
    				'attributeValue' => ($attributeValueInfo->value) ? trim(explode('-', $attributeValueInfo->value)[0]) : '',
    				'attributeValueImage' => $attributeValueInfo->image,
    			);
    		}
    	}
    	
    	$cartInfo = array(
    		'productCart' => $productCart,
    		'subTotal' => ($resetSubTotal) ? 0 : $subTotal,
    		'totalQuantity' => $totalQuantity,
    		'totalItem' => $totalItem,
    		'totalWeight' => $totalWeight
    	);
    	
    	return $cartInfo;
    }
    
    public static function getProductCartList(){
    	$cartInfo = self::getCartInfo();
    	$productCart = $cartInfo['productCart'];
    	
    	$productCartList = array();
    	foreach ($productCart as $productCartAttributeValue){
    		foreach ($productCartAttributeValue as $v){
    			$productCartList[] = $v;
    		}
    	}
    	
    	return $productCartList;
    }

    /**********************
    Product tag
     ********************/
    public static function getProductTagInfo($filter){
        $whereCondition = DataBaseHelper::getWhereCondition($filter);
        $sql = "select product_tag.*
		from product_tag_map
		left join product on product_tag_map.product_id=product.product_id
		left join product_tag on product_tag_map.product_tag_id=product_tag.product_tag_id
		$whereCondition";

        $query = DataBaseHelper::query($sql);
        return ($query) ? $query[0] : false;
    }

    /**
     * if $productId then return productTagList of $productId
     * else return allproductTagList
     *
     * @param int $productId
     * @return array productTag object
     */
    public static function getProductTagList($productId){
        if($productId){
            $filter = array('p.product_id' => $productId);
            $whereCondition = DataBaseHelper::getWhereCondition($filter);
        }
        $sql = "select ptag.*
from product_tag as ptag
left join product_tag_map as ptmap on ptmap.product_tag_id=ptag.product_tag_id
left join product as p on p.product_id=ptmap.product_id
$whereCondition 
group by ptag.product_tag_id";
        return DataBaseHelper::query($sql);
    }

    public static function getProductTagCount($productTagId){
        $sql = "select count(*) as count from product_tag_map where product_tag_id=$productTagId";
        $query = DataBaseHelper::query($sql);
        if($query){
            return $query[0]->count;
        }
        else{
            return 0;
        }
    }

    //***
    public static function getProductTagListFromCategory($categoryId, $limit=20){
        $chid = array($categoryId);
        CategoryExt::getChild($chid, $categoryId);
        $categoryList = join(', ', $chid);
        if($categoryId) {
            $sql = "select ptag.*
from product_tag as ptag
left join product_tag_map as ptmap on ptmap.product_tag_id=ptag.product_tag_id
left join product as p on p.product_id=ptmap.product_id
left join product_category as pcat on pcat.product_id=p.product_id
left join category as c on c.category_id=pcat.category_id
where c.category_id in ($categoryList)
group by ptag.product_tag_id
limit $limit";
        }
        else{
            $sql = "select ptag.*
from product_tag as ptag
left join product_tag_map as ptmap on ptmap.product_tag_id=ptag.product_tag_id
left join product as p on p.product_id=ptmap.product_id
left join product_category as pcat on pcat.product_id=p.product_id
left join category as c on c.category_id=pcat.category_id
group by ptag.product_tag_id
order by rand()
limit $limit";
        }
        return DataBaseHelper::query($sql);
    }

    //***
    public static function getProductTagListFromProductTag($productTagId, $limit=20){
        $sql = "select ptag.*
from product_tag as ptag
left join product_tag_map as ptmap on ptmap.product_tag_id=ptag.product_tag_id
where ptmap.product_id in (
		select ptmap.product_id
		from product_tag_map as ptmap
		left join product_tag as ptag on ptag.product_tag_id=ptmap.product_tag_id
		where ptag.product_tag_id=$productTagId
)
group by ptmap.product_tag_id
limit $limit";
        return DataBaseHelper::query($sql);
    }

    /**
     * update product_id in product_tag_map table (0 -> $productId)
     * apply for save product only
     *
     * @param int $productId
     */
    public static function updateProductTagMap($productId){
        $sql = "update product_tag_map set product_id=$productId where product_id=0";
        return DataBaseHelper::query($sql, null, null);
    }

    /**
     * delete all record  in product_tag_map and product_tag table
     *
     * @param int $productTagId
     */
    public static function deleteProductTag($productTagId){
        //product_tag_map
        $sql = "delete from product_tag_map where product_tag_id=$productTagId";
        DataBaseHelper::query($sql, null, null);

        //product_tag
        $sql = "delete from product_tag where product_tag_id=$productTagId";
        DataBaseHelper::query($sql, null, null);
    }

    public static function deleteProductTagMap($productTagMapId){
        $sql = "delete from product_tag_map where product_tag_map_id=$productTagMapId";
        DataBaseHelper::query($sql, null, null);
    }

    /**
     * delete all record in product_tag_map table where product_id=0
     * it created when add product but not save
     * run it page product/manage
     */
    public static function deleteProductTagMapTemp(){
        $sql = "delete from product_tag_map where product_id=0";
        DataBaseHelper::query($sql, null, null);
    }

    //frontend
    public static function getProductTagFilter($filter, $order, $start, $recSize){
        $whereCondition = DataBaseHelper::getWhereCondition($filter);
        $orderCondition = DataBaseHelper::getOrderCondition($order);
        $limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
        $sql = "select product.*
		from product_tag_map
		left join product on product_tag_map.product_id=product.product_id
		left join product_tag on product_tag_map.product_tag_id=product_tag.product_tag_id
		$whereCondition 
		group by product.product_id
		$orderCondition $limitCondition";

        $params = array();
        $query = DataBaseHelper::query($sql, $params);

        return $query;
    }

    /**********************
     ROUTER
     ********************/
    /**
     * getAlias of $productInfo
     *
     * @param object $productInfo
     * @param string $aliasBy
     * @return
     		if $aliasBy='%name%'* => 			productName
     		if $aliasBy='%sub_path%' => 		parentName/productName
    		if $aliasBy='%full_path%' => 		parentName[/parentSubName/]/productName
     */
    public static function getAlias($productInfo, $aliasBy='%name%'){
        //get categoryPrimary
        $categoryPrimary = self::getCategoryPrimary($productInfo->productId);

    	$alias = '';
    	if($aliasBy == '%name%'){
    		$alias = trim($productInfo->name);
    	}
    	else if($aliasBy == '%sub_path%'){
    	    if($categoryPrimary) {
                $aliasCategory = CategoryExt::getAlias($categoryPrimary->categoryId, '%name%');
                $alias = $aliasCategory . '/' . trim($productInfo->name);
            }
            else{
                $alias = trim($productInfo->name);
            }
    	}
    	else if($aliasBy == '%full_path%'){
            if($categoryPrimary) {
    		$aliasCategory = CategoryExt::getAlias($categoryPrimary->categoryId, '%full_path%');
    		$alias = $aliasCategory .'/'. trim($productInfo->name);
            }
            else{
                $alias = trim($productInfo->name);
            }
    	}
    	else{
    		LogUtil::info("[ProductExt::getAlias] not found case aliasBy = $aliasBy");
    	}
    
    	$alias = StringHelper::getAlias($alias);
    	return $alias;
    }

    /**
     * getAlias of $productTagInfo
     *
     * @param object $productTagInfo
     * @param string $aliasBy
     * @return
    if $aliasBy='%name%'* => $productTagName
     */
    public static function getProductTagAlias($productTagInfo, $aliasBy='%name%'){
        $alias = '';
        if($aliasBy == '%name%'){
            $alias = trim($productTagInfo->name);
        }
        else{
            LogUtil::info("[ProductExt::getProductTagAlias] not found case aliasBy = $aliasBy");
        }
        $alias = StringHelper::getAlias($alias);
        return $alias;
    }

    /**********************
     Wishlist action
     ********************/
    /**
     * check product isWishlisted for customer is logined
     * 
     * @param int $productId
     * @return boolean
     */
    public static function isWishlisted($productId){
    	if(Session::isCustomerLogin()){
    		$customerId = Session::getCustomerId();
    		$sql = "select * 
    		from product_wishlist 
    		where product_id=$productId and customer_id=$customerId";
    		$query = DataBaseHelper::query($sql);
    		return ($query) ? true : false;
    	}
    	else{
    		return false;
    	}
    }
    
    /***************************************
     * Product viewed
    **************************************/
    public static function updateProductViewed($productId){
    	$productViewedDao = new ProductViewedDao();
    	
    	//check customer is login
		if(Session::isCustomerLogin()){
			$customerId = Session::getCustomerId();
			//check product_viewed exist
			$productViewedVo = new ProductViewedVo();
			$productViewedVo->productId = $productId;
			$productViewedVo->customerId = $customerId;
			$productViewedVos = $productViewedDao->selectByFilter($productViewedVo);
			if($productViewedVos){
				//update crtDate
				$productViewedId = $productViewedVos[0]->productViewedId;
				$productViewedVo = new ProductViewedVo();
				$productViewedVo->crtDate = DateHelper::getDateTime();
				$productViewedDao->updateByPrimaryKey($productViewedVo, $productViewedId);
			}
			else{
				//new $productViewed
				$productViewedVo = new ProductViewedVo();
				$productViewedVo->productId = $productId;
				$productViewedVo->customerId = $customerId;
				$productViewedVo->crtDate = DateHelper::getDateTime();
				$productViewedDao->insert($productViewedVo);
			}
		}
		else{
			//update to session
			$productViewed = Session::getSession('productViewed', array());
			$productViewed[$productId] = DateHelper::getDateTime();
			Session::setSession('productViewed', $productViewed);
		}
    }
    
    public static function getProductViewedList($productId, $limit=0){
    	//check customer is login
    	if(Session::isCustomerLogin()){
    		$customerId = Session::getCustomerId();
    		if($productId){
	    		$sql = "select p.* 
    				from product as p
    				left join product_viewed as pv on pv.product_id=p.product_id
    				where pv.customer_id = $customerId and pv.product_id!=$productId
    				order by pv.crt_date desc";
    		}
    		else{
    			$sql = "select p.*
	    			from product as p
	    			left join product_viewed as pv on pv.product_id=p.product_id
	    			where pv.customer_id = $customerId
	    			order by pv.crt_date desc";
    		}
    		if($limit){
    			$sql .= " limit 0,$limit";
    		}
    		return DataBaseHelper::query($sql);
    	}
    	else{
    		//get data from session
    		$productViewed = Session::getSession('productViewed', array());
    		
    		//get $productViewedList
    		$productViewedList = array();
    		$productIds = array_keys($productViewed);
    		for($i = count($productIds)-1; $i >= 0; $i--){
    			if($productIds[$i] == $productId) continue;
    			$productInfo = self::getProductInfo($productIds[$i]);
    			if($productInfo) {
                    $productViewedList[] = $productInfo;
                }
    		}
    		
    		return $productViewedList;
    	}
    }

    /***************************************
     * Product feature
     **************************************/
    public static function isProductFeature($productId){
        $sql = "select * from product_feature where product_id=$productId";
        $query = DataBaseHelper::query($sql);
        return ($query) ? true : false;
    }

    public static function getProductFeatureList($filter, $orderBy, $startRecord, $recSize){
        $whereCondition = DataBaseHelper::getWhereCondition($filter);
        $orderCondition = DataBaseHelper::getOrderCondition($orderBy);
        $limitCondition = DataBaseHelper::getLimitCondition($startRecord, $recSize);
        $sql = "select p.*, 
    	pf.product_feature_id, pf.order as pfOrder, pf.status as pfStatus
    	from product as p
    	left join product_feature as pf on pf.product_id=p.product_id
    	$whereCondition $orderCondition $limitCondition";
        $productFeaturedList = DataBaseHelper::query($sql);
        return $productFeaturedList;
    }
    
    /***************************************
     * PRODUCT SEARCH
     **************************************/
    public static function getProductSearchList(){
        $show_search_product_key_by = Registry::getSetting('show_search_product_key_by');
        $show_search_product_key_count = Registry::getSetting('show_search_product_key_count');
        if($show_search_product_key_by == 'manual'){
   	 	$sql = "select *
from product_search
where `status`='A'
order by `order` asc, `count` desc
limit $show_search_product_key_count";
        }
        else {  //auto
            $sql = "select *
from product_search
order by `count` desc
limit $show_search_product_key_count";
        }
    	return DataBaseHelper::query($sql);
    }
    
    /***************************************
     * MIX
     **************************************/
    public static function getProductWeightFormat($weight){
    	$weightUnit = 'g';
    	return number_format($weight, 0, ',', '.')." $weightUnit";
    }
    public static function focusSearchKey($searchKey, $productName){
        $searchKey = trim($searchKey);
        $productName = trim($productName);
        $searchKeyCompare = strtolower($searchKey);
        $productNameCompare = strtolower($productName);
        $flag = array();
        //case normal
        $searchKeyCompareExt = explode(' ', $searchKeyCompare);
        $productNameCompareExt = explode(' ', $productNameCompare);
        foreach ($productNameCompareExt as $k => $v) {
            $flag[$k] = false;
        }
        foreach ($productNameCompareExt as $k => $v){
            if(in_array($v, $searchKeyCompareExt)){
                $flag[$k] = true;
            }
        }
        //case vietnamese unsigner
        $searchKeyCompareExt = explode(' ', StringHelper::getAlias($searchKeyCompare, false));
        $productNameCompareExt = explode(' ', StringHelper::getAlias($productNameCompare, false));
        foreach ($productNameCompareExt as $k => $v){
            if(in_array($v, $searchKeyCompareExt)){
                $flag[$k] = true;
            }
        }
        $result = array();
        $productNameExt = explode(' ', $productName);
        foreach ($productNameCompareExt as $k => $v){
            if($flag[$k]){
                $result[$k] = "<span class='search-key-focus'>{$productNameExt[$k]}</span>";
            }
            else {
                $result[$k] = $productNameExt[$k];
            }
        }
        return join(' ', $result);
    }

    /***************************************
     * IMPORT - EXPORT
     **************************************/
    /**
     * getProductMap (get all)
     * apply check code of product is exist then import product
     *
     * @return array(code => product_id)
     */
    public static function getProductMap(){
        $sql = "select * from product";
        $output = array(
            'type' => 'array',
            'key' => 'code',
            'value' => 'product_id'
        );
        return DataBaseHelper::query($sql, null, $output);
    }


    /***************************************
     * DELETE
     **************************************/
    public static function deleteProductImage($productId){
        $sql = "DELETE FROM product_image
				WHERE product_id=:productId;";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params, 'delete');
        return $query;
    }

    public static function deleteProductCategory($productId){
        $sql = "DELETE FROM product_category
			WHERE product_id=:productId;";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params, 'delete');
        return $query;
    }

    public static function deleteProductExtension($productId){
        $sql = "DELETE FROM product_extension
			WHERE product_id=:productId;";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params, 'delete');
        return $query;
    }

    public static function deleteProductWishlist($productId){
        $sql = "DELETE FROM product_wishlist
			WHERE product_id=:productId;";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params, 'delete');
        return $query;
    }

    public static function deleteProductViewed($productId){
        $sql = "DELETE FROM product_viewed
			WHERE product_id=:productId;";
        $params = array(
            array(':productId', $productId),
        );
        $query = DataBaseHelper::query($sql, $params, 'delete');
        return $query;
    }

    public static function deleteProduct($productId){
        //miss delete attribute_map table (order_product table not del [skip])
        self::deleteProductImage($productId);
        self::deleteProductCategory($productId);
        self::deleteProductExtension($productId);
        self::deleteProductWishlist($productId);
        self::deleteProductViewed($productId);
        //delete product
        $productDao = new ProductDao();
        $productDao->deleteByPrimaryKey($productId);
    }

    public static function deleteProductInUncategory(){
        $sql = "select * FROM product_category WHERE category_id=-1";
        $productCategoryList = DataBaseHelper::query($sql);
        foreach ($productCategoryList as $v) {
            self::deleteProduct($v->productId);
        }
    }
}