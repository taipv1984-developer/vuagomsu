<?php
class OrdersExt{
    /**
     * Delete order temp in database(because ordersId created before paymentId...)
     */
    public static function deleteOrders($orderId){
    	//order_product
    	$sql = "delete from order_product where order_id=$orderId";
    	DataBaseHelper::query($sql, null, null);
    	
    	//order_history
    	$sql = "delete from order_history where order_id=$orderId";
    	DataBaseHelper::query($sql, null, null);
    	
    	//order_shipping
    	$sql = "delete from order_shipping where order_id=$orderId";
    	DataBaseHelper::query($sql, null, null);
    	
    	//order_payment
    	$sql = "delete from order_payment where order_id=$orderId";
    	DataBaseHelper::query($sql, null, null);
    	
    	//order_surcharge
    	$sql = "delete from order_surcharge where order_id=$orderId";
    	DataBaseHelper::query($sql, null, null);

        //order_data
        $sql = "delete from order_data where order_id=$orderId";
        DataBaseHelper::query($sql, null, null);

    	//orders
    	$sql = "delete from orders where order_id=$orderId";
    	DataBaseHelper::query($sql, null, null);
   }
   
    public static function getOrderStatusName($orderStatusId){
    	$sql = "select * from order_status where order_status_id=$orderStatusId";
    	$query = DataBaseHelper::query($sql);
    	return ($query) ? $query[0]->name : false;
    }
    
    /**
     *  getOrderStatusList
     *
     * @return array
     */
    public static function getOrderStatusList(){
    	$sql = "select * from order_status order by `order` ASC";
    	return DataBaseHelper::query($sql);
    }
    
    public static function getOrderStatusArray(){
    	$sql = "select * from order_status order by `order` ASC";
    	$output = array(
    		'type' => 'array',
    		'key' => 'order_status_id',
    		'value' => 'name'
    	);
    	return DataBaseHelper::query($sql, array(), $output);
    }
    
    /**
     * getOrderShippingId apply for update order_shipping table
     *
     * @param int $orderId
     * @return int
     */
    public static function getOrderShippingId($orderId){
    	$sql = "select * from order_shipping where order_id=$orderId";
    	$query = DataBaseHelper::query($sql);
    	return ($query) ? $query[0]->orderShippingId : false;
    }
    
    /**
     * getShippingInfo of $orderId
     * 
     * @param int $orderId
     * @return object
     */
    public static function getShippingInfo($orderId){
    	$sql = "select * from order_shipping where order_id=$orderId";
   		$query = DataBaseHelper::query($sql);
   		return ($query) ? $query[0] : false;
   	}


    public static function updateOrderShipping($orderId){
        $sql = "select * from order_shipping where order_id=$orderId";
        $query = DataBaseHelper::query($sql);
        return ($query) ? $query[0] : false;
    }

   	
   	/**
   	 * getOrderPaymentId apply for update order_payment table
   	 * 
   	 * @param int $orderId
   	 * @return int
   	 */
   	public static function getOrderPaymentId($orderId){
   		$sql = "select * from order_payment where order_id=$orderId";
   		$query = DataBaseHelper::query($sql);
   		return ($query) ? $query[0]->orderPaymentId : false;
   	}
   	
   	/**
   	 * getPaymentInfo of $orderId
   	 *
   	 * @param int $orderId
   	 * @return object
   	 */
   	public static function getPaymentInfo($orderId){
   		$sql = "select * from order_payment where order_id=$orderId";
   		$query = DataBaseHelper::query($sql);
   		return ($query) ? $query[0] : false;
   	}
   	
   	/**
   	 * getSurcharge of $orderId
   	 *
   	 * @param string $orderId
   	 * @return array(array('code'=>, 'name'=>, 'order'=>, 'value'=>))
   	 */
   	public static function getSurchargeList($orderId){
   		$sql = "select * from order_surcharge where order_id=$orderId";
   		return DataBaseHelper::query($sql);
   	}
   	
   	
   	public static function getOrdersList($filter, $orderBy=array(), $start=0, $recSize=0){
   		$whereCondition = DataBaseHelper::getWhereCondition($filter);
   		$orderCondition = DataBaseHelper::getOrderCondition($orderBy);
   		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
   	
   		$sql = "select o.*, 
	os.order_shipping_id, os.`code` as shipping_code, os.`name` as shipping_name, 
	op.order_payment_id, op.`code` as payment_code, op.`name` as payment_name, 
	ostatus.`name` as order_status_name,
	c.username, c.email,
	cd.first_name, cd.last_name, cd.phone
from orders as o
LEFT JOIN order_shipping as os ON os.order_id=o.order_id
LEFT JOIN order_payment as op ON op.order_id=o.order_id
LEFT JOIN order_status as ostatus on ostatus.order_status_id=o.order_status_id
LEFT JOIN customer as c on (IF(o.customer_id != 0, c.customer_id=o.customer_id, c.customer_id=o.guest_id)) 
LEFT JOIN customer_detail as cd on cd.customer_id=c.customer_id
   		$whereCondition $orderCondition $limitCondition";

   		return DataBaseHelper::query($sql);
   	}
   	
   	public static function getOrdersInfo($orderId){
   		$filter = array(
   			'o.is_del' => 0,
   			'o.order_id' => $orderId
   		);
   		$ordersList = self::getOrdersList($filter);
   		if(!$ordersList) return false;
   		$ordersInfo = $ordersList[0];
   		
   		//add info
   		if($ordersInfo->customerId){
   			$customerInfo = CustomerExt::getCustomerInfo($ordersInfo->customerId);
   		}
   		else{
   			$customerInfo = CustomerExt::getCustomerInfo($ordersInfo->guestId);
   		}
   		if(!$customerInfo){
   		    //get $customerInfo from orderData table
            $orderData = self::getOrderData($orderId);
            $customerInfo = $orderData->customerInfo;
            $customerInfo->isDel = true;
        }
        else{
            $customerInfo->isDel = false;
        }
        $ordersInfo->customerInfo = $customerInfo;

   		$ordersInfo->shippingAddressInfo = CustomerExt::getCustomerAddressInfo($ordersInfo->shippingAddressId);
   		$ordersInfo->billingAddressInfo = CustomerExt::getCustomerAddressInfo($ordersInfo->billingAddressId);
   		
   		return $ordersInfo;
   	}
   	
   	public static function getCartInfo($orderId){
   		$orderProductDao = new OrderProductDao();
   		$attributeValueDao = new AttributeValueDao();
   		 
   		$productDao = new ProductDao();
   		
   		$productCart = array();
   		$totalItem = 0;
   		$totalQuantity = 0;
   		$subTotal = 0;
   		
   		//get $orderProductList
   		$orderProductVo = new OrderProductVo();
   		$orderProductVo->orderId = $orderId;
   		$orderProductVos = $orderProductDao->selectByFilter($orderProductVo);
   		$orderProductList = array();
   		$productCart = array();
   		foreach($orderProductVos as $v){
   			$orderProductList[$v->productId][$v->attributeValueId] = $v;
   		}
   		
   		//get $productCart
   		foreach($orderProductList as $productId => $productCartAttributeValue){
   			$productInfo = $productDao->selectByPrimaryKey($productId);
   			foreach ($productCartAttributeValue as $v){
   				$attributeValueId = $v->attributeValueId;
   				$quantity = $v->quantity;
   				$attributeValueInfo = $attributeValueDao->selectByPrimaryKey($attributeValueId);

   				$totalItem++;
   				$totalQuantity += $quantity;
   		
   				$price = $v->price;
   				$priceTotal = doubleval($price)* intval($quantity);
   				$subTotal += $priceTotal;
   		
   				$productLink = URLHelper::getProductDetailPage($productInfo->productId);
   				$productCart[$productId][$attributeValueId] = array(
   					'productId' => $productId,
   					'productName' => $productInfo->name,
   					'productLink' => "<a href='$productLink' title='{$productInfo->name}' target='bank'>{$productInfo->name}</a>",
   					'productCode' => $productInfo->code,
   					'status' => $productInfo->status,
   					'quantity' => $quantity,
   					'image' => $productInfo->image,
   					'price' => $price,
   					'priceTotal' => $priceTotal,
                    'unit' => $productInfo->unit,
   						
   					'attributeValueId' => $attributeValueId,
   					'attributeValue' => ($attributeValueInfo->value) ? trim(explode('-', $attributeValueInfo->value)[0]) : '',
   					'attributeValueImage' => $attributeValueInfo->image,
   				);
   			}
   		}
   		
   		$cartInfo = array(
   			'productCart' => $productCart,
   			'subTotal' => $subTotal,
   			'totalQuantity' => $totalQuantity,
   			'totalItem' => $totalItem
   		);
   		return $cartInfo;
   	}
   	
   	public static function getTotalOrders(){
   		$sql = "select count(*) as `count` from orders where is_del=0";
   		$query = DataBaseHelper::query($sql);
   		return $query[0]->count;
   	}
   	public static function checkOrders($ordersNumber, $ordersEmail){
   		//find by guest
   		$sql = "select o.*
from orders as o
LEFT JOIN customer as c on c.customer_id=o.guest_id
where c.email='$ordersEmail' and o.order_id=$ordersNumber and o.is_del=0 and o.order_status_id!=5";
   		$query = DataBaseHelper::query($sql);
   		if($query){
   			return $query[0];
   		}
   		else{
   			//find by customer
	   		$sql = "select o.*
from orders as o
LEFT JOIN customer as c on c.customer_id=o.customer_id
where c.email='$ordersEmail' and o.order_id=$ordersNumber and o.is_del=0 and o.order_status_id!=5";
	   		$query = DataBaseHelper::query($sql);
	   		if($query){
	   			return $query[0];
	   		}
   			else{
   				return false;
   			}
   		}
   	}

    /*********************************************
     * ORDER DATA
     ********************************************/
    public static function getOrderData($orderId){
        $sql = "select * from order_data where order_id=$orderId";
        $query = DataBaseHelper::query($sql);
        if($query){
            return json_decode($query[0]->data);
        }
        else{
            return false;
        }
    }

   	/*********************************************
   	 * EMAIL
   	 ********************************************/
   	public static function getEmailAttachment($cartInfo){
   		$attachment = array();
   		foreach ($cartInfo['productCart'] as $productCartAttribute){
   			foreach ($productCartAttribute as $v){
   				$attachment[] = $v['image'];
   				if($v['attributeValueId']){
   					$attachment[] = $v['attributeValueImage'];
   				}
   			}
   		}
   		
   		return $attachment;
   	}
   	
   	/**
   	 * getEmailContent of $ordersInfo
   	 * use add to email content when checkout done (frontend) and change status (admin)
   	 *
   	 * @param object $ordersInfo
   	 * @param object $cartInfo
   	 */
   	public static function getEmailContent($ordersInfo, $cartInfo){
   		$orderId = $ordersInfo->orderId;
   		
	   	//list product
	   	$productListStr = '';
	   	$productCartList = array();
	   	foreach ($cartInfo['productCart'] as $productCartAttribute){
	   		foreach ($productCartAttribute as $v){
	   			$productCartList[] = $v;
	   		}
	   	}
	   	
	   	$priceText = "";
	   	if($ordersInfo->total > 0){
	   		$priceText = "<p>Thành tiền (Bằng số): <span style=\"color:#0C4169\"><b style=\"color: red\">" .ProductExt::getPriceText($ordersInfo->total). "</b></span></p>
<p>Thành tiền (Bằng chữ): <span style=\"color:#0C4169\"><b>" .StringHelper::convert_number_to_words($ordersInfo->total)." đồng.</b></span></p>";
	   	}
	   	else{
	   		$priceText = "<p>Thành tiền: <span style=\"color:#0C4169\"><b style=\"color: red\">" .ProductExt::getPriceText($ordersInfo->total). "</b></span></p>";
	   	}
	   	
	   	$emailContent = "
<table style=\"border:1px solid #0C4169;border-collapse:collapse\">
	<thead>
		<tr style=\"border:1px solid #0C4169;height:40px\">
			<th style=\"border:1px solid #0C4169\">Hình ảnh</th>
			<th style=\"border:1px solid #0C4169\">Mã sản phẩm</th>
			<th style=\"border:1px solid #0C4169\">Tên sản phẩm</th>
			<th style=\"border:1px solid #0C4169\">Số lượng</th>
			<th style=\"width:120px;border:1px solid #0C4169\">Giá sản phẩm</th>
			<th style=\"width:120px;border:1px solid #0C4169\">Tổng cộng</th>
		</tr>
	</thead>
	<tbody>";
	   	foreach ($productCartList as $v){
	   		$url = URLHelper::getProductDetailPage($v['productId']);
	   		$imgProduct = URLHelper::getImagePath($v['image'], 'small');
$emailContent .= "<tr style=\"border:1px solid #0C4169;height:40px\">
			<td style=\"border:1px solid #0C4169\"><img src='$imgProduct' class='product_image'></td>
			<td style=\"text-align:center;border:1px solid #0C4169\">{$v['code']}</td>
			<td style=\"text - align:center;border:1px solid #0C4169\"><a href='$url'>{$v['productName']}</a></td>
			<td style=\"text-align:center\">{$v['quantity']}</td>
			<td style=\"border:1px solid #0C4169\">" . ProductExt::getPriceText($v['price']). "</td>
			<td style=\"border:1px solid #0C4169\"><strong>". ProductExt::getPriceText($v['priceTotal'])."</strong></td>
		</tr>";
	   	}
$emailContent .= "
	</tbody>
</table>
$priceText
";
	   	return $emailContent;
   	}
   	
   	 /*********************************************
   	 * ANALITIC PROCESS (later)
   	 * tam thoi moi xoa cac tham so vandorId=0 o sau ten ham con luc goi ham chua test
   	 ********************************************/
   	public static function getOrdersStatistic(){
   		$sql = "SELECT order_id as 'orderId', subtotal, total, 
   				YEAR(crt_date) as 'year', MONTH(crt_date) as 'month', DAY(crt_date) as `day`, crt_date
FROM orders
WHERE is_del=0";
   		$query = DataBaseHelper::query($sql);
   		
   		//get totalOrdersByYear
   		$totalOrdersByYear = array();
   		foreach ($query as $v){
   			$year = $v->year;
   			$totalOrdersByYear[$year] += $v->total;
   		}
   		//get totalOrdersByMonth
   		$totalOrdersByMonth = array();
   		foreach ($query as $v){
   			$month = $v->month;
   			$year = $v->year;
   			$totalOrdersByMonth[$year][$month] += $v->total;
   		}
   		//get totalOrdersByDay
   		$totalOrdersByDay = array();
   		foreach ($query as $v){
   			$day = $v->day;
   			$month = $v->month;
   			$year = $v->year;
   			$totalOrdersByDay[$year][$month][$day] += $v->total;
   		}
   		
   		$minYear = DateHelper::getCurentYear();
   		$maxYear = DateHelper::getCurentYear();
   		foreach ($totalOrdersByYear as $k => $v){
   			if($maxYear < $k) $maxYear = $k;
   			if($minYear > $k) $minYear = $k;
   		}
   		
   		$ordersStatistic = array(
   			'totalOrdersByYear' => $totalOrdersByYear,
   			'totalOrdersByMonth' => $totalOrdersByMonth,
   			'totalOrdersByDay' => $totalOrdersByDay,
   			'minYear' => $minYear,
   			'maxYear' => $maxYear,
   		);
   			
   		return $ordersStatistic;
   	}
   	
   	/**
   	 * OK
   	 * get total, subtotal, count, statusName of orders group by order_status
   	 *
   	 * @return array
   	 */
   	public static function getOrderTotalByStatus(){
	   	$sql = "SELECT o.order_id, o.subtotal, o.total, o.order_status_id, 
	   			os.`name` as statusName
FROM orders as o
LEFT JOIN order_status as os on os.order_status_id = o.order_status_id
WHERE o.is_del=0";
   		$query = DataBaseHelper::query($sql);
   		
   		$orderTotalBySatus = array();
   		foreach ($query as $v){
   			$orderTotalBySatus[$v->orderStatusId]['total'] += $v->total;
   			$orderTotalBySatus[$v->orderStatusId]['subtotal'] += $v->subtotal;
   			$orderTotalBySatus[$v->orderStatusId]['count'] += 1;
   			$orderTotalBySatus[$v->orderStatusId]['statusName'] = $v->statusName;
   		}
   		
   		//format price
   		foreach ($orderTotalBySatus as $orderStatusId => $orderStatusValue){
   			$orderTotalBySatus[$orderStatusId]['total'] = CurrencyExt::format_price($orderTotalBySatus[$orderStatusId]['total']);
   			$orderTotalBySatus[$orderStatusId]['subtotal'] = CurrencyExt::format_price($orderTotalBySatus[$orderStatusId]['subtotal']);
   		}
   		
   		return $orderTotalBySatus;
   	} 
   	
   	/**
   	 * OK
   	 * getLatestOrders
   	 * 
   	 * @param number $limit
   	 * @return array
   	 */
   	public static function getLatestOrders($limit = 6){
   		$filter = array(
   			'o.is_del' => 0,
   		);
   		$orderBy = array('order_id' => 'DESC');
   		return self::getOrdersList($filter, $orderBy, 0, $limit);
   	}
   	
   	public static function selectOrderByProductId($productId){
   		$sql = "select 
					o.*
				from orders o
				left join order_product op on o.order_id = op.order_id
				where op.product_id = $productId
					and o.is_del = 0
				group by op.order_id";
   		return DataBaseHelper::query($sql);
   	}

   	public static function getOrdersDiscountValue($ordersInfo){
        if($ordersInfo->discountType == 'percent'){
            return $ordersInfo->subtotal*($ordersInfo->discountValue/100);
        }
        else{
            return $ordersInfo->discountValue;
        }
    }
}