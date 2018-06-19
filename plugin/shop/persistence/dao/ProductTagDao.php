<?php
class ProductTagDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_tag`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductTagVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productTagId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_tag` where `product_tag_id` = :productTagId");
$stmt->bindParam(':productTagId',$productTagId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductTagVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productTagVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_tag`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $productTagVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $productTagVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productTagVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_tag`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $productTagVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $productTagVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_tag by $productTagVo object filter use paging
 * 
 * @param object $productTagVo is product_tag object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productTagVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productTagVo)) $productTagVo = new ProductTagVo();
$sql = "select * from `product_tag` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productTagVo->productTagId)){ //If isset Vo->element
$fieldValue=$productTagVo->productTagId;
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

if (!is_null($productTagVo->name)){ //If isset Vo->element
$fieldValue=$productTagVo->name;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `name` $key :nameKey";
    $isFirst = false;
} else {
    $condition .= " and `name` $key :nameKey";
}
if($type == 'str') {
    $params[] = array(':nameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':nameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `name` =  :nameKey';
$isFirst=false;
}else{
$condition.=' and `name` =  :nameKey';
}
$params[]=array(':nameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productTagVo->description)){ //If isset Vo->element
$fieldValue=$productTagVo->description;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `description` $key :descriptionKey";
    $isFirst = false;
} else {
    $condition .= " and `description` $key :descriptionKey";
}
if($type == 'str') {
    $params[] = array(':descriptionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':descriptionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `description` =  :descriptionKey';
$isFirst=false;
}else{
$condition.=' and `description` =  :descriptionKey';
}
$params[]=array(':descriptionKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('ProductTagVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productTagVo){
try {
if (empty($productTagVo)) $productTagVo = new ProductTagVo();
$sql = "select count(*) as total from  product_tag ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productTagVo->productTagId)){ //If isset Vo->element
$fieldValue=$productTagVo->productTagId;
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

if (!is_null($productTagVo->name)){ //If isset Vo->element
$fieldValue=$productTagVo->name;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `name` $key :nameKey";
    $isFirst = false;
} else {
    $condition .= " and `name` $key :nameKey";
}
if($type == 'str') {
    $params[] = array(':nameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':nameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `name` =  :nameKey';
$isFirst=false;
}else{
$condition.=' and `name` =  :nameKey';
}
$params[]=array(':nameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productTagVo->description)){ //If isset Vo->element
$fieldValue=$productTagVo->description;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `description` $key :descriptionKey";
    $isFirst = false;
} else {
    $condition .= " and `description` $key :descriptionKey";
}
if($type == 'str') {
    $params[] = array(':descriptionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':descriptionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `description` =  :descriptionKey';
$isFirst=false;
}else{
$condition.=' and `description` =  :descriptionKey';
}
$params[]=array(':descriptionKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($productTagVo,$productTagId){
try {
$sql="UPDATE `product_tag` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productTagVo->productTagId)){
if ($isFirst){
$updateFields.=' `product_tag_id`= :productTagId';
$isFirst=false;}else{
$updateFields.=', `product_tag_id`= :productTagId';
}
$params[]=array(':productTagId', $productTagVo->productTagId, PDO::PARAM_INT);
}

if (isset($productTagVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $productTagVo->name, PDO::PARAM_STR);
}

if (isset($productTagVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $productTagVo->description, PDO::PARAM_STR);
}

$conditions.=' where `product_tag_id`= :productTagId';
$params[]=array(':productTagId', $productTagId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productTagId)
	 * Example
	 * getValueByPrimaryKey('productTagName', 1)
	 * Get value of filed productTagName in table productTag where productTagId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productTagVo = $this->selectByPrimaryKey($primaryValue);
		if($productTagVo){
			return $productTagVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productTagName', array('productTagId' => 1))
	 * Get value of filed productTagName in table productTag where productTagId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productTagVo = new ProductTagVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productTagVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productTagVos = $this->selectByFilter($productTagVo);
       
		if($productTagVos){
			$productTagVo = $productTagVos[0];
			return $productTagVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_tag
	 *
	 * @param int $product_tag_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productTagId){
		try {
		    $sql = "DELETE FROM `product_tag` where `product_tag_id` = :productTagId";
		    $params = array();
		    $params[] = array(':productTagId', $productTagId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_tag
	 *
	 * @param object $productTagVo
	 * @return boolean
	 */
	public function deleteByFilter($productTagVo){
		try {
			$sql = 'DELETE FROM `product_tag`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productTagVo->productTagId)){
				$isDel = true;
				$condition[] = '`product_tag_id` = :productTagId';
				$params[] = array(':productTagId', $productTagVo->productTagId, PDO::PARAM_INT);
			}
			if (!is_null($productTagVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $productTagVo->name, PDO::PARAM_STR);
			}
			if (!is_null($productTagVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $productTagVo->description, PDO::PARAM_STR);
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
