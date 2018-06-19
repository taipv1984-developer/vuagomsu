<?php
class ProductWishlistDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_wishlist`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductWishlistVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productWishlistId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_wishlist` where `product_wishlist_id` = :productWishlistId");
$stmt->bindParam(':productWishlistId',$productWishlistId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductWishlistVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productWishlistVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_wishlist`( `product_id`, `customer_id`, `crt_date`)
VALUES( :productId, :customerId, :crtDate)");
$stmt->bindParam(':productId', $productWishlistVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':customerId', $productWishlistVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $productWishlistVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productWishlistVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_wishlist`( `product_id`, `customer_id`, `crt_date`)
VALUES( :productId, :customerId, :crtDate)");
$stmt->bindParam(':productId', $productWishlistVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':customerId', $productWishlistVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $productWishlistVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_wishlist by $productWishlistVo object filter use paging
 * 
 * @param object $productWishlistVo is product_wishlist object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productWishlistVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productWishlistVo)) $productWishlistVo = new ProductWishlistVo();
$sql = "select * from `product_wishlist` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productWishlistVo->productWishlistId)){ //If isset Vo->element
$fieldValue=$productWishlistVo->productWishlistId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_wishlist_id` $key :productWishlistIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_wishlist_id` $key :productWishlistIdKey";
}
if($type == 'str') {
    $params[] = array(':productWishlistIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productWishlistIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_wishlist_id` =  :productWishlistIdKey';
$isFirst=false;
}else{
$condition.=' and `product_wishlist_id` =  :productWishlistIdKey';
}
$params[]=array(':productWishlistIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productWishlistVo->productId)){ //If isset Vo->element
$fieldValue=$productWishlistVo->productId;
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

if (!is_null($productWishlistVo->customerId)){ //If isset Vo->element
$fieldValue=$productWishlistVo->customerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_id` $key :customerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_id` $key :customerIdKey";
}
if($type == 'str') {
    $params[] = array(':customerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_id` =  :customerIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_id` =  :customerIdKey';
}
$params[]=array(':customerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productWishlistVo->crtDate)){ //If isset Vo->element
$fieldValue=$productWishlistVo->crtDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_date` $key :crtDateKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_date` $key :crtDateKey";
}
if($type == 'str') {
    $params[] = array(':crtDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_date` =  :crtDateKey';
$isFirst=false;
}else{
$condition.=' and `crt_date` =  :crtDateKey';
}
$params[]=array(':crtDateKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('ProductWishlistVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productWishlistVo){
try {
if (empty($productWishlistVo)) $productWishlistVo = new ProductWishlistVo();
$sql = "select count(*) as total from  product_wishlist ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productWishlistVo->productWishlistId)){ //If isset Vo->element
$fieldValue=$productWishlistVo->productWishlistId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_wishlist_id` $key :productWishlistIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_wishlist_id` $key :productWishlistIdKey";
}
if($type == 'str') {
    $params[] = array(':productWishlistIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productWishlistIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_wishlist_id` =  :productWishlistIdKey';
$isFirst=false;
}else{
$condition.=' and `product_wishlist_id` =  :productWishlistIdKey';
}
$params[]=array(':productWishlistIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productWishlistVo->productId)){ //If isset Vo->element
$fieldValue=$productWishlistVo->productId;
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

if (!is_null($productWishlistVo->customerId)){ //If isset Vo->element
$fieldValue=$productWishlistVo->customerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_id` $key :customerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_id` $key :customerIdKey";
}
if($type == 'str') {
    $params[] = array(':customerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_id` =  :customerIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_id` =  :customerIdKey';
}
$params[]=array(':customerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productWishlistVo->crtDate)){ //If isset Vo->element
$fieldValue=$productWishlistVo->crtDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_date` $key :crtDateKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_date` $key :crtDateKey";
}
if($type == 'str') {
    $params[] = array(':crtDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_date` =  :crtDateKey';
$isFirst=false;
}else{
$condition.=' and `crt_date` =  :crtDateKey';
}
$params[]=array(':crtDateKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($productWishlistVo,$productWishlistId){
try {
$sql="UPDATE `product_wishlist` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productWishlistVo->productWishlistId)){
if ($isFirst){
$updateFields.=' `product_wishlist_id`= :productWishlistId';
$isFirst=false;}else{
$updateFields.=', `product_wishlist_id`= :productWishlistId';
}
$params[]=array(':productWishlistId', $productWishlistVo->productWishlistId, PDO::PARAM_INT);
}

if (isset($productWishlistVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productWishlistVo->productId, PDO::PARAM_INT);
}

if (isset($productWishlistVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $productWishlistVo->customerId, PDO::PARAM_INT);
}

if (isset($productWishlistVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $productWishlistVo->crtDate, PDO::PARAM_STR);
}

$conditions.=' where `product_wishlist_id`= :productWishlistId';
$params[]=array(':productWishlistId', $productWishlistId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productWishlistId)
	 * Example
	 * getValueByPrimaryKey('productWishlistName', 1)
	 * Get value of filed productWishlistName in table productWishlist where productWishlistId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productWishlistVo = $this->selectByPrimaryKey($primaryValue);
		if($productWishlistVo){
			return $productWishlistVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productWishlistName', array('productWishlistId' => 1))
	 * Get value of filed productWishlistName in table productWishlist where productWishlistId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productWishlistVo = new ProductWishlistVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productWishlistVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productWishlistVos = $this->selectByFilter($productWishlistVo);
       
		if($productWishlistVos){
			$productWishlistVo = $productWishlistVos[0];
			return $productWishlistVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_wishlist
	 *
	 * @param int $product_wishlist_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productWishlistId){
		try {
		    $sql = "DELETE FROM `product_wishlist` where `product_wishlist_id` = :productWishlistId";
		    $params = array();
		    $params[] = array(':productWishlistId', $productWishlistId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_wishlist
	 *
	 * @param object $productWishlistVo
	 * @return boolean
	 */
	public function deleteByFilter($productWishlistVo){
		try {
			$sql = 'DELETE FROM `product_wishlist`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productWishlistVo->productWishlistId)){
				$isDel = true;
				$condition[] = '`product_wishlist_id` = :productWishlistId';
				$params[] = array(':productWishlistId', $productWishlistVo->productWishlistId, PDO::PARAM_INT);
			}
			if (!is_null($productWishlistVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productWishlistVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productWishlistVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $productWishlistVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($productWishlistVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $productWishlistVo->crtDate, PDO::PARAM_STR);
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
