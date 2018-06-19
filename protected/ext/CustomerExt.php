<?php
class CustomerExt {
	public static function getCustomerInfo($customerId){
		$sql = "select c.*, cd.*, c.customer_id as customerId
from customer as c
left join customer_detail as cd on c.customer_id = cd.customer_id
where c.customer_id=$customerId";
		$query = DataBaseHelper::query($sql);
		
		return ($query) ? $query [0] : false;
	}
	
	/**
	 * getCustomerInfo apply for login by username (email) and password
	 * 
	 * @param tring|null $username
	 * @param tring|null $email
	 * @param string $password
	 * @return object
	 * 		if $username===null get data by $email and $password
	 * 		else get data by $username and $password
	 */
	public static function getCustomerInfoLogin($username, $email, $password){
		if($username === null){
			$sql = "select c.*, cd.*, c.customer_id as customerId
			from customer as c
			left join customer_detail as cd on c.customer_id = cd.customer_id
			where c.email='$email' and c.password=md5('$password')";
		}
		else{
			$sql = "select c.*, cd.*, c.customer_id as customerId
			from customer as c
			left join customer_detail as cd on c.customer_id = cd.customer_id
			where c.username='$username' and c.password=md5('$password')";
		}
		$query = DataBaseHelper::query($sql);
	
		return ($query) ? $query [0] : false;
	}
	
	// $filter = array('customer_id' => $customerId, 'email' => arrray('like', $mail))
	public static function getCustomerList($filter, $orderBy, $startRecord, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($orderBy);
		$limitCondition = DataBaseHelper::getLimitCondition($startRecord, $recSize);
		
		$sql = "select c.*, cd.*, c.customer_id as customerId
   		from customer as c
   		left join customer_detail as cd on cd.customer_id=c.customer_id
   		$whereCondition $orderCondition $limitCondition";
		
		return DataBaseHelper::query($sql);
	}
	
	/**
	 * getCustomDetailId of $customerId
	 * if customer not found when auto create customer_detail
	 *
	 * @param int $customerId        	
	 * @return int
	 */
	public static function getCustomDetailId($customerId){
		$sql = "select * from customer_detail where customer_id=$customerId";
		$query = DataBaseHelper::query($sql);
		
		if (! $query){
			$sql = "insert into customer_detail(customer_id) values($customerId)";
			$query = DataBaseHelper::query($sql, null, 'insert');
			return $query->customerDetailId;
		} else {
			return $query [0]->customerDetailId;
		}
	}
	
	public static function getFullName($customerInfo){
		return trim("{$customerInfo->firstName} {$customerInfo->lastName}");
	}
	
	public static function getFullAddress($addressInfo){
		$fullAddress = array();
		if($addressInfo->countryName) $fullAddress[] = $addressInfo->countryName;
		if($addressInfo->stateName) $fullAddress[] = $addressInfo->stateName;
		if($addressInfo->cityName) $fullAddress[] = $addressInfo->cityName;
		if($addressInfo->districtName) $fullAddress[] = $addressInfo->districtName;
		return join(', ', $fullAddress);
	}
	
	public static function getTotalCustomer(){
		$sql = "select count(*) as `count` from customer";
		$query = DataBaseHelper::query($sql);
		return $query[0]->count;
	}

    public static function deleteCustomer($customerId){
        //customer_detail
        $sql = "delete from customer_detail where customer_id=$customerId";
        DataBaseHelper::query($sql, null, null);

        //customer_address
        $sql = "delete from customer_address where customer_id=$customerId";
        DataBaseHelper::query($sql, null, null);

        //customer
        $sql = "delete from customer where customer_id=$customerId";;
        DataBaseHelper::query($sql, null, null);
    }

	/**
	 * ************************
	 * ORDERS ACTION
	 * ***********************
	 */
	/**
	 * getOrderCount of customer
	 *
	 * @param int $customerId
	 * @return int
	 */
	public static function getOrderCount($customerId){
		$sql = "select count(*) as `count` from orders where customer_id=$customerId and is_del=0";
		$query = DataBaseHelper::query($sql);
	
		return ($query) ? $query[0]->count : 0;
	}
	
	/**
	 * ************************
	 * CUSTOMER ADDRESS ACTION
	 * ***********************
	 */
	/**
	 * getCustomerAddressList of customer include countryName, stateName, cityName, districtName
	 *
	 * @param int $customerId        	
	 * @return list
	 */
	public static function getCustomerAddressList($customerId){
		$sql = "select ca.*, country.`name` as country_name, state.`name` as state_name, 
	city.`name` as city_name, district.`name` as district_name
from customer_address as ca
left join country on country.country_id=ca.country_id
left join state on state.state_id=ca.state_id
left join city on city.city_id=ca.city_id
left join district on district.district_id=ca.district_id
where ca.customer_id=$customerId
order by ca.default_shipping DESC, ca.default_billing DESC";
		$output = array (
			'type' => 'object',
			'key' => 'customerAddressId' 
		);
		return DataBaseHelper::query($sql, array(), $output);
	}
	
	/**
	 * getCustomerAddressInfo of $customerAddressId include countryName, stateName, cityName, districtName
	 *
	 * @param int $customerAddressId        	
	 * @return object
	 */
	public static function getCustomerAddressInfo($customerAddressId){
		$sql = "select ca.*, country.`name` as country_name, state.`name` as state_name,
    	city.`name` as city_name, district.`name` as district_name
    	from customer_address as ca
    	left join country on country.country_id=ca.country_id
    	left join state on state.state_id=ca.state_id
    	left join city on city.city_id=ca.city_id
    	left join district on district.district_id=ca.district_id
    	where ca.customer_address_id=$customerAddressId";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query [0] : false;
	}
	
	public static function getAddressShippingDefault($customerId){
		$sql = "select * from customer_address where customer_id=$customerId and default_shipping=1";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query [0] : false;
	}
	
	public static function getAddressBillingDefault($customerId){
		$sql = "select * from customer_address where customer_id=$customerId and default_billing=1";
		$query = DataBaseHelper::query($sql);
		return ($query) ? $query [0] : false;
	}
	
	public static function updateDefaultShipping($customerId, $customerAddressId){
		// reset all
		$sql = "update customer_address 
set default_shipping=0
where customer_id=$customerId";
		DataBaseHelper::query($sql, null, null);
		
		// set default
		$sql = "update customer_address 
set default_shipping=1
where customer_address_id=$customerAddressId";
		DataBaseHelper::query($sql, null, null);
	}
	
	public static function updateDefaultBilling($customerId, $customerAddressId){
		// reset all
		$sql = "update customer_address
    	set default_billing=0
    	where customer_id=$customerId";
		DataBaseHelper::query($sql, null, null);
		
		// set default
		$sql = "update customer_address
    	set default_billing=1
    	where customer_address_id=$customerAddressId";
		DataBaseHelper::query($sql, null, null);
	}
	
	public static function deleteAddress($customerId, $customerAddressId){
		$sql = "delete from customer_address
		where customer_id=$customerId and customer_address_id=$customerAddressId 
			and default_shipping=0 and default_billing=0";
		DataBaseHelper::query($sql, null, null);
	}

	/**
	 * ************************
	 * Wishlist ACTION
	 * ***********************
	 */
	public static function getProductWishlist($customerId, $start=0, $recSize=0){
		$limit = DataBaseHelper::getLimitCondition($start, $recSize);
		$sql = "select p.*
		from product_wishlist as pw
		left join product as p on p.product_id = pw.product_id
		where pw.customer_id = :customerId
		order by pw.crt_date desc
		$limit";
		$params = array(
				array(':customerId', $customerId)
		);
		return DataBaseHelper::query($sql, $params);
	}
	
	public static function deleteProductWishlist($customerId){
		$sql = "delete from product_wishlist where customer_id = :customerId";
		$params = array(
				array(':customerId', $customerId)
		);
		DataBaseHelper::query($sql, $params, 'delete');
	}
	
	public static function getFilter($filter, $order, $start, $recSize){
		$whereCondition = DataBaseHelper::getWhereCondition($filter);
		$orderCondition = DataBaseHelper::getOrderCondition($order);
		$limitCondition = DataBaseHelper::getLimitCondition($start, $recSize);
		$sql = "select 
					distinct c.*
				from customer as c
				left join customer_detail as cd on c.customer_id = cd.customer_id
				left join customer_address as ca on c.customer_id = ca.customer_id
				$whereCondition 
				$orderCondition
				$limitCondition";
		
		$params = array();
		$query = DataBaseHelper::query($sql, $params);
		 
		return $query;
	}

	/**
	 * ************************
	 * Social action
	 * ***********************
	 */
	public static function checkSocialAccountExit($customerVo){
		$sql = "select * from `customer` 
				where oauth_id = '{$customerVo->oauthId}'
						and oauth_provider='{$customerVo->oauthProvider}'";
		$result = DataBaseHelper::query($sql);
		return ($result) ?$result[0]:null;
	}
}