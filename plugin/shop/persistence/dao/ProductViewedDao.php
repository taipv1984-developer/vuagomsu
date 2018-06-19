<?php
class ProductViewedDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_viewed`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductViewedVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productViewedId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_viewed` where `product_viewed_id` = :productViewedId");
$stmt->bindParam(':productViewedId',$productViewedId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductViewedVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productViewedVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_viewed`( `product_id`, `customer_id`, `crt_date`)
VALUES( :productId, :customerId, :crtDate)");
$stmt->bindParam(':productId', $productViewedVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':customerId', $productViewedVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $productViewedVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productViewedVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_viewed`( `product_id`, `customer_id`, `crt_date`)
VALUES( :productId, :customerId, :crtDate)");
$stmt->bindParam(':productId', $productViewedVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':customerId', $productViewedVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $productViewedVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_viewed by $productViewedVo object filter use paging
 * 
 * @param object $productViewedVo is product_viewed object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productViewedVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productViewedVo)) $productViewedVo = new ProductViewedVo();
$sql = "select * from `product_viewed` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productViewedVo->productViewedId)){ //If isset Vo->element
$fieldValue=$productViewedVo->productViewedId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_viewed_id` $key :productViewedIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_viewed_id` $key :productViewedIdKey";
}
if($type == 'str') {
    $params[] = array(':productViewedIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productViewedIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_viewed_id` =  :productViewedIdKey';
$isFirst=false;
}else{
$condition.=' and `product_viewed_id` =  :productViewedIdKey';
}
$params[]=array(':productViewedIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productViewedVo->productId)){ //If isset Vo->element
$fieldValue=$productViewedVo->productId;
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

if (!is_null($productViewedVo->customerId)){ //If isset Vo->element
$fieldValue=$productViewedVo->customerId;
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

if (!is_null($productViewedVo->crtDate)){ //If isset Vo->element
$fieldValue=$productViewedVo->crtDate;
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
return PersistentHelper::mapResult('ProductViewedVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productViewedVo){
try {
if (empty($productViewedVo)) $productViewedVo = new ProductViewedVo();
$sql = "select count(*) as total from  product_viewed ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productViewedVo->productViewedId)){ //If isset Vo->element
$fieldValue=$productViewedVo->productViewedId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_viewed_id` $key :productViewedIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_viewed_id` $key :productViewedIdKey";
}
if($type == 'str') {
    $params[] = array(':productViewedIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productViewedIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_viewed_id` =  :productViewedIdKey';
$isFirst=false;
}else{
$condition.=' and `product_viewed_id` =  :productViewedIdKey';
}
$params[]=array(':productViewedIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productViewedVo->productId)){ //If isset Vo->element
$fieldValue=$productViewedVo->productId;
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

if (!is_null($productViewedVo->customerId)){ //If isset Vo->element
$fieldValue=$productViewedVo->customerId;
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

if (!is_null($productViewedVo->crtDate)){ //If isset Vo->element
$fieldValue=$productViewedVo->crtDate;
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


public function updateByPrimaryKey($productViewedVo,$productViewedId){
try {
$sql="UPDATE `product_viewed` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productViewedVo->productViewedId)){
if ($isFirst){
$updateFields.=' `product_viewed_id`= :productViewedId';
$isFirst=false;}else{
$updateFields.=', `product_viewed_id`= :productViewedId';
}
$params[]=array(':productViewedId', $productViewedVo->productViewedId, PDO::PARAM_INT);
}

if (isset($productViewedVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productViewedVo->productId, PDO::PARAM_INT);
}

if (isset($productViewedVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $productViewedVo->customerId, PDO::PARAM_INT);
}

if (isset($productViewedVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $productViewedVo->crtDate, PDO::PARAM_STR);
}

$conditions.=' where `product_viewed_id`= :productViewedId';
$params[]=array(':productViewedId', $productViewedId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productViewedId)
	 * Example
	 * getValueByPrimaryKey('productViewedName', 1)
	 * Get value of filed productViewedName in table productViewed where productViewedId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productViewedVo = $this->selectByPrimaryKey($primaryValue);
		if($productViewedVo){
			return $productViewedVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productViewedName', array('productViewedId' => 1))
	 * Get value of filed productViewedName in table productViewed where productViewedId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productViewedVo = new ProductViewedVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productViewedVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productViewedVos = $this->selectByFilter($productViewedVo);
       
		if($productViewedVos){
			$productViewedVo = $productViewedVos[0];
			return $productViewedVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_viewed
	 *
	 * @param int $product_viewed_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productViewedId){
		try {
		    $sql = "DELETE FROM `product_viewed` where `product_viewed_id` = :productViewedId";
		    $params = array();
		    $params[] = array(':productViewedId', $productViewedId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_viewed
	 *
	 * @param object $productViewedVo
	 * @return boolean
	 */
	public function deleteByFilter($productViewedVo){
		try {
			$sql = 'DELETE FROM `product_viewed`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productViewedVo->productViewedId)){
				$isDel = true;
				$condition[] = '`product_viewed_id` = :productViewedId';
				$params[] = array(':productViewedId', $productViewedVo->productViewedId, PDO::PARAM_INT);
			}
			if (!is_null($productViewedVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productViewedVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productViewedVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $productViewedVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($productViewedVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $productViewedVo->crtDate, PDO::PARAM_STR);
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
