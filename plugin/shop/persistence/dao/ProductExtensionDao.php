<?php
class ProductExtensionDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_extension`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductExtensionVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productExtensionId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_extension` where `product_extension_id` = :productExtensionId");
$stmt->bindParam(':productExtensionId',$productExtensionId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductExtensionVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productExtensionVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_extension`( `product_id`, `key`, `value`)
VALUES( :productId, :key, :value)");
$stmt->bindParam(':productId', $productExtensionVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':key', $productExtensionVo->key, PDO::PARAM_STR);
$stmt->bindParam(':value', $productExtensionVo->value, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productExtensionVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_extension`( `product_id`, `key`, `value`)
VALUES( :productId, :key, :value)");
$stmt->bindParam(':productId', $productExtensionVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':key', $productExtensionVo->key, PDO::PARAM_STR);
$stmt->bindParam(':value', $productExtensionVo->value, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_extension by $productExtensionVo object filter use paging
 * 
 * @param object $productExtensionVo is product_extension object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productExtensionVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productExtensionVo)) $productExtensionVo = new ProductExtensionVo();
$sql = "select * from `product_extension` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productExtensionVo->productExtensionId)){ //If isset Vo->element
$fieldValue=$productExtensionVo->productExtensionId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_extension_id` $key :productExtensionIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_extension_id` $key :productExtensionIdKey";
}
if($type == 'str') {
    $params[] = array(':productExtensionIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productExtensionIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_extension_id` =  :productExtensionIdKey';
$isFirst=false;
}else{
$condition.=' and `product_extension_id` =  :productExtensionIdKey';
}
$params[]=array(':productExtensionIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productExtensionVo->productId)){ //If isset Vo->element
$fieldValue=$productExtensionVo->productId;
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

if (!is_null($productExtensionVo->key)){ //If isset Vo->element
$fieldValue=$productExtensionVo->key;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `key` $key :keyKey";
    $isFirst = false;
} else {
    $condition .= " and `key` $key :keyKey";
}
if($type == 'str') {
    $params[] = array(':keyKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':keyKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `key` =  :keyKey';
$isFirst=false;
}else{
$condition.=' and `key` =  :keyKey';
}
$params[]=array(':keyKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productExtensionVo->value)){ //If isset Vo->element
$fieldValue=$productExtensionVo->value;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `value` $key :valueKey";
    $isFirst = false;
} else {
    $condition .= " and `value` $key :valueKey";
}
if($type == 'str') {
    $params[] = array(':valueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':valueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `value` =  :valueKey';
$isFirst=false;
}else{
$condition.=' and `value` =  :valueKey';
}
$params[]=array(':valueKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('ProductExtensionVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productExtensionVo){
try {
if (empty($productExtensionVo)) $productExtensionVo = new ProductExtensionVo();
$sql = "select count(*) as total from  product_extension ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productExtensionVo->productExtensionId)){ //If isset Vo->element
$fieldValue=$productExtensionVo->productExtensionId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_extension_id` $key :productExtensionIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_extension_id` $key :productExtensionIdKey";
}
if($type == 'str') {
    $params[] = array(':productExtensionIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productExtensionIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_extension_id` =  :productExtensionIdKey';
$isFirst=false;
}else{
$condition.=' and `product_extension_id` =  :productExtensionIdKey';
}
$params[]=array(':productExtensionIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productExtensionVo->productId)){ //If isset Vo->element
$fieldValue=$productExtensionVo->productId;
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

if (!is_null($productExtensionVo->key)){ //If isset Vo->element
$fieldValue=$productExtensionVo->key;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `key` $key :keyKey";
    $isFirst = false;
} else {
    $condition .= " and `key` $key :keyKey";
}
if($type == 'str') {
    $params[] = array(':keyKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':keyKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `key` =  :keyKey';
$isFirst=false;
}else{
$condition.=' and `key` =  :keyKey';
}
$params[]=array(':keyKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productExtensionVo->value)){ //If isset Vo->element
$fieldValue=$productExtensionVo->value;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `value` $key :valueKey";
    $isFirst = false;
} else {
    $condition .= " and `value` $key :valueKey";
}
if($type == 'str') {
    $params[] = array(':valueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':valueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `value` =  :valueKey';
$isFirst=false;
}else{
$condition.=' and `value` =  :valueKey';
}
$params[]=array(':valueKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($productExtensionVo,$productExtensionId){
try {
$sql="UPDATE `product_extension` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productExtensionVo->productExtensionId)){
if ($isFirst){
$updateFields.=' `product_extension_id`= :productExtensionId';
$isFirst=false;}else{
$updateFields.=', `product_extension_id`= :productExtensionId';
}
$params[]=array(':productExtensionId', $productExtensionVo->productExtensionId, PDO::PARAM_INT);
}

if (isset($productExtensionVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productExtensionVo->productId, PDO::PARAM_INT);
}

if (isset($productExtensionVo->key)){
if ($isFirst){
$updateFields.=' `key`= :key';
$isFirst=false;}else{
$updateFields.=', `key`= :key';
}
$params[]=array(':key', $productExtensionVo->key, PDO::PARAM_STR);
}

if (isset($productExtensionVo->value)){
if ($isFirst){
$updateFields.=' `value`= :value';
$isFirst=false;}else{
$updateFields.=', `value`= :value';
}
$params[]=array(':value', $productExtensionVo->value, PDO::PARAM_STR);
}

$conditions.=' where `product_extension_id`= :productExtensionId';
$params[]=array(':productExtensionId', $productExtensionId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productExtensionId)
	 * Example
	 * getValueByPrimaryKey('productExtensionName', 1)
	 * Get value of filed productExtensionName in table productExtension where productExtensionId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productExtensionVo = $this->selectByPrimaryKey($primaryValue);
		if($productExtensionVo){
			return $productExtensionVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productExtensionName', array('productExtensionId' => 1))
	 * Get value of filed productExtensionName in table productExtension where productExtensionId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productExtensionVo = new ProductExtensionVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productExtensionVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productExtensionVos = $this->selectByFilter($productExtensionVo);
       
		if($productExtensionVos){
			$productExtensionVo = $productExtensionVos[0];
			return $productExtensionVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_extension
	 *
	 * @param int $product_extension_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productExtensionId){
		try {
		    $sql = "DELETE FROM `product_extension` where `product_extension_id` = :productExtensionId";
		    $params = array();
		    $params[] = array(':productExtensionId', $productExtensionId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_extension
	 *
	 * @param object $productExtensionVo
	 * @return boolean
	 */
	public function deleteByFilter($productExtensionVo){
		try {
			$sql = 'DELETE FROM `product_extension`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productExtensionVo->productExtensionId)){
				$isDel = true;
				$condition[] = '`product_extension_id` = :productExtensionId';
				$params[] = array(':productExtensionId', $productExtensionVo->productExtensionId, PDO::PARAM_INT);
			}
			if (!is_null($productExtensionVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productExtensionVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productExtensionVo->key)){
				$isDel = true;
				$condition[] = '`key` = :key';
				$params[] = array(':key', $productExtensionVo->key, PDO::PARAM_STR);
			}
			if (!is_null($productExtensionVo->value)){
				$isDel = true;
				$condition[] = '`value` = :value';
				$params[] = array(':value', $productExtensionVo->value, PDO::PARAM_STR);
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
