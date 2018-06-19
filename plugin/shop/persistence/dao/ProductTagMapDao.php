<?php
class ProductTagMapDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_tag_map`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductTagMapVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productTagMapId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_tag_map` where `product_tag_map_id` = :productTagMapId");
$stmt->bindParam(':productTagMapId',$productTagMapId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductTagMapVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productTagMapVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_tag_map`( `product_tag_id`, `product_id`)
VALUES( :productTagId, :productId)");
$stmt->bindParam(':productTagId', $productTagMapVo->productTagId, PDO::PARAM_INT);
$stmt->bindParam(':productId', $productTagMapVo->productId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productTagMapVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_tag_map`( `product_tag_id`, `product_id`)
VALUES( :productTagId, :productId)");
$stmt->bindParam(':productTagId', $productTagMapVo->productTagId, PDO::PARAM_INT);
$stmt->bindParam(':productId', $productTagMapVo->productId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_tag_map by $productTagMapVo object filter use paging
 * 
 * @param object $productTagMapVo is product_tag_map object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productTagMapVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productTagMapVo)) $productTagMapVo = new ProductTagMapVo();
$sql = "select * from `product_tag_map` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productTagMapVo->productTagMapId)){ //If isset Vo->element
$fieldValue=$productTagMapVo->productTagMapId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_tag_map_id` $key :productTagMapIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_tag_map_id` $key :productTagMapIdKey";
}
if($type == 'str') {
    $params[] = array(':productTagMapIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productTagMapIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_tag_map_id` =  :productTagMapIdKey';
$isFirst=false;
}else{
$condition.=' and `product_tag_map_id` =  :productTagMapIdKey';
}
$params[]=array(':productTagMapIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productTagMapVo->productTagId)){ //If isset Vo->element
$fieldValue=$productTagMapVo->productTagId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_tag_id` $key :productTagIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_tag_id` $key :productTagIdKey";
}
if($type == 'str') {
    $params[] = array(':productTagIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productTagIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_tag_id` =  :productTagIdKey';
$isFirst=false;
}else{
$condition.=' and `product_tag_id` =  :productTagIdKey';
}
$params[]=array(':productTagIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productTagMapVo->productId)){ //If isset Vo->element
$fieldValue=$productTagMapVo->productId;
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
return PersistentHelper::mapResult('ProductTagMapVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productTagMapVo){
try {
if (empty($productTagMapVo)) $productTagMapVo = new ProductTagMapVo();
$sql = "select count(*) as total from  product_tag_map ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productTagMapVo->productTagMapId)){ //If isset Vo->element
$fieldValue=$productTagMapVo->productTagMapId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_tag_map_id` $key :productTagMapIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_tag_map_id` $key :productTagMapIdKey";
}
if($type == 'str') {
    $params[] = array(':productTagMapIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productTagMapIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_tag_map_id` =  :productTagMapIdKey';
$isFirst=false;
}else{
$condition.=' and `product_tag_map_id` =  :productTagMapIdKey';
}
$params[]=array(':productTagMapIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productTagMapVo->productTagId)){ //If isset Vo->element
$fieldValue=$productTagMapVo->productTagId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_tag_id` $key :productTagIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_tag_id` $key :productTagIdKey";
}
if($type == 'str') {
    $params[] = array(':productTagIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productTagIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_tag_id` =  :productTagIdKey';
$isFirst=false;
}else{
$condition.=' and `product_tag_id` =  :productTagIdKey';
}
$params[]=array(':productTagIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productTagMapVo->productId)){ //If isset Vo->element
$fieldValue=$productTagMapVo->productId;
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


public function updateByPrimaryKey($productTagMapVo,$productTagMapId){
try {
$sql="UPDATE `product_tag_map` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productTagMapVo->productTagMapId)){
if ($isFirst){
$updateFields.=' `product_tag_map_id`= :productTagMapId';
$isFirst=false;}else{
$updateFields.=', `product_tag_map_id`= :productTagMapId';
}
$params[]=array(':productTagMapId', $productTagMapVo->productTagMapId, PDO::PARAM_INT);
}

if (isset($productTagMapVo->productTagId)){
if ($isFirst){
$updateFields.=' `product_tag_id`= :productTagId';
$isFirst=false;}else{
$updateFields.=', `product_tag_id`= :productTagId';
}
$params[]=array(':productTagId', $productTagMapVo->productTagId, PDO::PARAM_INT);
}

if (isset($productTagMapVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productTagMapVo->productId, PDO::PARAM_INT);
}

$conditions.=' where `product_tag_map_id`= :productTagMapId';
$params[]=array(':productTagMapId', $productTagMapId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productTagMapId)
	 * Example
	 * getValueByPrimaryKey('productTagMapName', 1)
	 * Get value of filed productTagMapName in table productTagMap where productTagMapId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productTagMapVo = $this->selectByPrimaryKey($primaryValue);
		if($productTagMapVo){
			return $productTagMapVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productTagMapName', array('productTagMapId' => 1))
	 * Get value of filed productTagMapName in table productTagMap where productTagMapId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productTagMapVo = new ProductTagMapVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productTagMapVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productTagMapVos = $this->selectByFilter($productTagMapVo);
       
		if($productTagMapVos){
			$productTagMapVo = $productTagMapVos[0];
			return $productTagMapVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_tag_map
	 *
	 * @param int $product_tag_map_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productTagMapId){
		try {
		    $sql = "DELETE FROM `product_tag_map` where `product_tag_map_id` = :productTagMapId";
		    $params = array();
		    $params[] = array(':productTagMapId', $productTagMapId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_tag_map
	 *
	 * @param object $productTagMapVo
	 * @return boolean
	 */
	public function deleteByFilter($productTagMapVo){
		try {
			$sql = 'DELETE FROM `product_tag_map`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productTagMapVo->productTagMapId)){
				$isDel = true;
				$condition[] = '`product_tag_map_id` = :productTagMapId';
				$params[] = array(':productTagMapId', $productTagMapVo->productTagMapId, PDO::PARAM_INT);
			}
			if (!is_null($productTagMapVo->productTagId)){
				$isDel = true;
				$condition[] = '`product_tag_id` = :productTagId';
				$params[] = array(':productTagId', $productTagMapVo->productTagId, PDO::PARAM_INT);
			}
			if (!is_null($productTagMapVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productTagMapVo->productId, PDO::PARAM_INT);
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
