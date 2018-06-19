<?php
class OrderProductDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_product`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderProductVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderProductId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_product` where `order_product_id` = :orderProductId");
$stmt->bindParam(':orderProductId',$orderProductId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderProductVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderProductVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_product`( `order_id`, `product_id`, `attribute_value_id`, `price`, `quantity`)
VALUES( :orderId, :productId, :attributeValueId, :price, :quantity)");
$stmt->bindParam(':orderId', $orderProductVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':productId', $orderProductVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':attributeValueId', $orderProductVo->attributeValueId, PDO::PARAM_INT);
$stmt->bindParam(':price', $orderProductVo->price, PDO::PARAM_STR);
$stmt->bindParam(':quantity', $orderProductVo->quantity, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderProductVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_product`( `order_id`, `product_id`, `attribute_value_id`, `price`, `quantity`)
VALUES( :orderId, :productId, :attributeValueId, :price, :quantity)");
$stmt->bindParam(':orderId', $orderProductVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':productId', $orderProductVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':attributeValueId', $orderProductVo->attributeValueId, PDO::PARAM_INT);
$stmt->bindParam(':price', $orderProductVo->price, PDO::PARAM_STR);
$stmt->bindParam(':quantity', $orderProductVo->quantity, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_product by $orderProductVo object filter use paging
 * 
 * @param object $orderProductVo is order_product object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderProductVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderProductVo)) $orderProductVo = new OrderProductVo();
$sql = "select * from `order_product` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderProductVo->orderProductId)){ //If isset Vo->element
$fieldValue=$orderProductVo->orderProductId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_product_id` $key :orderProductIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_product_id` $key :orderProductIdKey";
}
if($type == 'str') {
    $params[] = array(':orderProductIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderProductIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_product_id` =  :orderProductIdKey';
$isFirst=false;
}else{
$condition.=' and `order_product_id` =  :orderProductIdKey';
}
$params[]=array(':orderProductIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->orderId)){ //If isset Vo->element
$fieldValue=$orderProductVo->orderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_id` $key :orderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_id` $key :orderIdKey";
}
if($type == 'str') {
    $params[] = array(':orderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_id` =  :orderIdKey';
$isFirst=false;
}else{
$condition.=' and `order_id` =  :orderIdKey';
}
$params[]=array(':orderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->productId)){ //If isset Vo->element
$fieldValue=$orderProductVo->productId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_id` $key :productIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_id` $key :productIdKey";
}
if($type == 'str') {
    $params[] = array(':productIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_id` =  :productIdKey';
$isFirst=false;
}else{
$condition.=' and `product_id` =  :productIdKey';
}
$params[]=array(':productIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->attributeValueId)){ //If isset Vo->element
$fieldValue=$orderProductVo->attributeValueId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `attribute_value_id` $key :attributeValueIdKey";
    $isFirst = false;
} else {
    $condition .= " and `attribute_value_id` $key :attributeValueIdKey";
}
if($type == 'str') {
    $params[] = array(':attributeValueIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':attributeValueIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `attribute_value_id` =  :attributeValueIdKey';
$isFirst=false;
}else{
$condition.=' and `attribute_value_id` =  :attributeValueIdKey';
}
$params[]=array(':attributeValueIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->price)){ //If isset Vo->element
$fieldValue=$orderProductVo->price;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `price` $key :priceKey";
    $isFirst = false;
} else {
    $condition .= " and `price` $key :priceKey";
}
if($type == 'str') {
    $params[] = array(':priceKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':priceKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `price` =  :priceKey';
$isFirst=false;
}else{
$condition.=' and `price` =  :priceKey';
}
$params[]=array(':priceKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderProductVo->quantity)){ //If isset Vo->element
$fieldValue=$orderProductVo->quantity;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `quantity` $key :quantityKey";
    $isFirst = false;
} else {
    $condition .= " and `quantity` $key :quantityKey";
}
if($type == 'str') {
    $params[] = array(':quantityKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':quantityKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `quantity` =  :quantityKey';
$isFirst=false;
}else{
$condition.=' and `quantity` =  :quantityKey';
}
$params[]=array(':quantityKey', $fieldValue, PDO::PARAM_INT);
}}

if (!empty($condition)){
$sql.=' where '. $condition;
}

//order by <field> asc/desc
if(count($orderBy) != 0){
    $orderBySql = 'ORDER BY ';
    foreach ($orderBy as $k => $v){
        $orderBySql .= "`$k` $v, ";
    }
    $orderBySql = substr($orderBySql, 0 , strlen($orderBySql)-2);
    $sql.= " ".trim($orderBySql)." ";
}
if($recordSize != 0) {
$sql = $sql.' limit '.$startRecord.','.$recordSize;
}

//debug
LogUtil::sql('(selectByFilter) '. DataBaseHelper::renderQuery($sql, $params));

$stmt = $this->conn->prepare($sql);
foreach ($params as $param){
$stmt->bindParam($param[0], $param[1], $param[2]);
}
if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
return PersistentHelper::mapResult('OrderProductVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderProductVo){
try {
if (empty($orderProductVo)) $orderProductVo = new OrderProductVo();
$sql = "select count(*) as total from  order_product ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderProductVo->orderProductId)){ //If isset Vo->element
$fieldValue=$orderProductVo->orderProductId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_product_id` $key :orderProductIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_product_id` $key :orderProductIdKey";
}
if($type == 'str') {
    $params[] = array(':orderProductIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderProductIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_product_id` =  :orderProductIdKey';
$isFirst=false;
}else{
$condition.=' and `order_product_id` =  :orderProductIdKey';
}
$params[]=array(':orderProductIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->orderId)){ //If isset Vo->element
$fieldValue=$orderProductVo->orderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_id` $key :orderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_id` $key :orderIdKey";
}
if($type == 'str') {
    $params[] = array(':orderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_id` =  :orderIdKey';
$isFirst=false;
}else{
$condition.=' and `order_id` =  :orderIdKey';
}
$params[]=array(':orderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->productId)){ //If isset Vo->element
$fieldValue=$orderProductVo->productId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_id` $key :productIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_id` $key :productIdKey";
}
if($type == 'str') {
    $params[] = array(':productIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_id` =  :productIdKey';
$isFirst=false;
}else{
$condition.=' and `product_id` =  :productIdKey';
}
$params[]=array(':productIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->attributeValueId)){ //If isset Vo->element
$fieldValue=$orderProductVo->attributeValueId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `attribute_value_id` $key :attributeValueIdKey";
    $isFirst = false;
} else {
    $condition .= " and `attribute_value_id` $key :attributeValueIdKey";
}
if($type == 'str') {
    $params[] = array(':attributeValueIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':attributeValueIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `attribute_value_id` =  :attributeValueIdKey';
$isFirst=false;
}else{
$condition.=' and `attribute_value_id` =  :attributeValueIdKey';
}
$params[]=array(':attributeValueIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderProductVo->price)){ //If isset Vo->element
$fieldValue=$orderProductVo->price;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `price` $key :priceKey";
    $isFirst = false;
} else {
    $condition .= " and `price` $key :priceKey";
}
if($type == 'str') {
    $params[] = array(':priceKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':priceKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `price` =  :priceKey';
$isFirst=false;
}else{
$condition.=' and `price` =  :priceKey';
}
$params[]=array(':priceKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderProductVo->quantity)){ //If isset Vo->element
$fieldValue=$orderProductVo->quantity;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `quantity` $key :quantityKey";
    $isFirst = false;
} else {
    $condition .= " and `quantity` $key :quantityKey";
}
if($type == 'str') {
    $params[] = array(':quantityKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':quantityKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `quantity` =  :quantityKey';
$isFirst=false;
}else{
$condition.=' and `quantity` =  :quantityKey';
}
$params[]=array(':quantityKey', $fieldValue, PDO::PARAM_INT);
}}

if (!empty($condition)){
$sql.=' where '. $condition;
}

//debug
LogUtil::sql('(selectCountByFilter) '. DataBaseHelper::renderQuery($sql, $params));

$stmt = $this->conn->prepare($sql);
foreach ($params as $param){
$stmt->bindParam($param[0], $param[1], $param[2]);
}
if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
if (isset($row)){
return $row[0]['total'];
}
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function updateByPrimaryKey($orderProductVo,$orderProductId){
try {
$sql="UPDATE `order_product` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderProductVo->orderProductId)){
if ($isFirst){
$updateFields.=' `order_product_id`= :orderProductId';
$isFirst=false;}else{
$updateFields.=', `order_product_id`= :orderProductId';
}
$params[]=array(':orderProductId', $orderProductVo->orderProductId, PDO::PARAM_INT);
}

if (isset($orderProductVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $orderProductVo->orderId, PDO::PARAM_INT);
}

if (isset($orderProductVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $orderProductVo->productId, PDO::PARAM_INT);
}

if (isset($orderProductVo->attributeValueId)){
if ($isFirst){
$updateFields.=' `attribute_value_id`= :attributeValueId';
$isFirst=false;}else{
$updateFields.=', `attribute_value_id`= :attributeValueId';
}
$params[]=array(':attributeValueId', $orderProductVo->attributeValueId, PDO::PARAM_INT);
}

if (isset($orderProductVo->price)){
if ($isFirst){
$updateFields.=' `price`= :price';
$isFirst=false;}else{
$updateFields.=', `price`= :price';
}
$params[]=array(':price', $orderProductVo->price, PDO::PARAM_STR);
}

if (isset($orderProductVo->quantity)){
if ($isFirst){
$updateFields.=' `quantity`= :quantity';
$isFirst=false;}else{
$updateFields.=', `quantity`= :quantity';
}
$params[]=array(':quantity', $orderProductVo->quantity, PDO::PARAM_INT);
}

$conditions.=' where `order_product_id`= :orderProductId';
$params[]=array(':orderProductId', $orderProductId, PDO::PARAM_INT);
$sql.= $updateFields.$conditions;
//debug
LogUtil::sql('(updateByPrimaryKey) '. DataBaseHelper::renderQuery($sql, $params));
$stmt = $this->conn->prepare($sql);
foreach ($params as $param){
$stmt->bindParam($param[0], $param[1], $param[2]);
}
return $stmt->execute();
} catch (PDOException $e) {
throw $e;
}
return null;
}



	/**
	 * Get value a field by PrimaryKey (orderProductId)
	 * Example
	 * getValueByPrimaryKey('orderProductName', 1)
	 * Get value of filed orderProductName in table orderProduct where orderProductId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderProductVo = $this->selectByPrimaryKey($primaryValue);
		if($orderProductVo){
			return $orderProductVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderProductName', array('orderProductId' => 1))
	 * Get value of filed orderProductName in table orderProduct where orderProductId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderProductVo = new OrderProductVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderProductVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderProductVos = $this->selectByFilter($orderProductVo);
       
		if($orderProductVos){
			$orderProductVo = $orderProductVos[0];
			return $orderProductVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_product
	 *
	 * @param int $order_product_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderProductId){
		try {
		    $sql = "DELETE FROM `order_product` where `order_product_id` = :orderProductId";
		    $params = array();
		    $params[] = array(':orderProductId', $orderProductId, PDO::PARAM_INT);
		    
		    //debug
		    LogUtil::sql('(deleteByPrimaryKey) '. DataBaseHelper::renderQuery($sql, $params));
		    
			$stmt = $this->conn->prepare($sql);
			foreach ($params as $param){
				$stmt->bindParam($param[0], $param[1], $param[2]);
			}
			$stmt->execute();
			return true;
		} 
		catch (PDOException $e) {
			throw $e;
		}
		return null;
	}



	/**
	 * deleteByFilter from table order_product
	 *
	 * @param object $orderProductVo
	 * @return boolean
	 */
	public function deleteByFilter($orderProductVo){
		try {
			$sql = 'DELETE FROM `order_product`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderProductVo->orderProductId)){
				$isDel = true;
				$condition[] = '`order_product_id` = :orderProductId';
				$params[] = array(':orderProductId', $orderProductVo->orderProductId, PDO::PARAM_INT);
			}
			if (!is_null($orderProductVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $orderProductVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($orderProductVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $orderProductVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($orderProductVo->attributeValueId)){
				$isDel = true;
				$condition[] = '`attribute_value_id` = :attributeValueId';
				$params[] = array(':attributeValueId', $orderProductVo->attributeValueId, PDO::PARAM_INT);
			}
			if (!is_null($orderProductVo->price)){
				$isDel = true;
				$condition[] = '`price` = :price';
				$params[] = array(':price', $orderProductVo->price, PDO::PARAM_STR);
			}
			if (!is_null($orderProductVo->quantity)){
				$isDel = true;
				$condition[] = '`quantity` = :quantity';
				$params[] = array(':quantity', $orderProductVo->quantity, PDO::PARAM_INT);
			}
			if(!$isDel){
				return null;
			}
			else{
				$sql .= ' WHERE ' . join(' and ', $condition);
			}
		
			//debug
			LogUtil::sql('(deleteByFilter) '. DataBaseHelper::renderQuery($sql, $params));
		
			$stmt = $this->conn->prepare($sql);
			foreach ($params as $param){
				$stmt->bindParam($param[0], $param[1], $param[2]);
			}
			$stmt->execute();
			return true;
		}
		catch (PDOException $e) {
			throw $e;
		}
		return null;
	}


}
