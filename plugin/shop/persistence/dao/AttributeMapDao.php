<?php
class AttributeMapDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `attribute_map`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('AttributeMapVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($attributeMapId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `attribute_map` where `attribute_map_id` = :attributeMapId");
$stmt->bindParam(':attributeMapId',$attributeMapId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('AttributeMapVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($attributeMapVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `attribute_map`( `product_id`, `attribute_id`, `attribute_value_id`)
VALUES( :productId, :attributeId, :attributeValueId)");
$stmt->bindParam(':productId', $attributeMapVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':attributeId', $attributeMapVo->attributeId, PDO::PARAM_INT);
$stmt->bindParam(':attributeValueId', $attributeMapVo->attributeValueId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($attributeMapVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `attribute_map`( `product_id`, `attribute_id`, `attribute_value_id`)
VALUES( :productId, :attributeId, :attributeValueId)");
$stmt->bindParam(':productId', $attributeMapVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':attributeId', $attributeMapVo->attributeId, PDO::PARAM_INT);
$stmt->bindParam(':attributeValueId', $attributeMapVo->attributeValueId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table attribute_map by $attributeMapVo object filter use paging
 * 
 * @param object $attributeMapVo is attribute_map object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($attributeMapVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($attributeMapVo)) $attributeMapVo = new AttributeMapVo();
$sql = "select * from `attribute_map` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($attributeMapVo->attributeMapId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->attributeMapId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `attribute_map_id` $key :attributeMapIdKey";
    $isFirst = false;
} else {
    $condition .= " and `attribute_map_id` $key :attributeMapIdKey";
}
if($type == 'str') {
    $params[] = array(':attributeMapIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':attributeMapIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `attribute_map_id` =  :attributeMapIdKey';
$isFirst=false;
}else{
$condition.=' and `attribute_map_id` =  :attributeMapIdKey';
}
$params[]=array(':attributeMapIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($attributeMapVo->productId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->productId;
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

if (!is_null($attributeMapVo->attributeId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->attributeId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `attribute_id` $key :attributeIdKey";
    $isFirst = false;
} else {
    $condition .= " and `attribute_id` $key :attributeIdKey";
}
if($type == 'str') {
    $params[] = array(':attributeIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':attributeIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `attribute_id` =  :attributeIdKey';
$isFirst=false;
}else{
$condition.=' and `attribute_id` =  :attributeIdKey';
}
$params[]=array(':attributeIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($attributeMapVo->attributeValueId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->attributeValueId;
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
return PersistentHelper::mapResult('AttributeMapVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($attributeMapVo){
try {
if (empty($attributeMapVo)) $attributeMapVo = new AttributeMapVo();
$sql = "select count(*) as total from  attribute_map ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($attributeMapVo->attributeMapId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->attributeMapId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `attribute_map_id` $key :attributeMapIdKey";
    $isFirst = false;
} else {
    $condition .= " and `attribute_map_id` $key :attributeMapIdKey";
}
if($type == 'str') {
    $params[] = array(':attributeMapIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':attributeMapIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `attribute_map_id` =  :attributeMapIdKey';
$isFirst=false;
}else{
$condition.=' and `attribute_map_id` =  :attributeMapIdKey';
}
$params[]=array(':attributeMapIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($attributeMapVo->productId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->productId;
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

if (!is_null($attributeMapVo->attributeId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->attributeId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `attribute_id` $key :attributeIdKey";
    $isFirst = false;
} else {
    $condition .= " and `attribute_id` $key :attributeIdKey";
}
if($type == 'str') {
    $params[] = array(':attributeIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':attributeIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `attribute_id` =  :attributeIdKey';
$isFirst=false;
}else{
$condition.=' and `attribute_id` =  :attributeIdKey';
}
$params[]=array(':attributeIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($attributeMapVo->attributeValueId)){ //If isset Vo->element
$fieldValue=$attributeMapVo->attributeValueId;
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


public function updateByPrimaryKey($attributeMapVo,$attributeMapId){
try {
$sql="UPDATE `attribute_map` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($attributeMapVo->attributeMapId)){
if ($isFirst){
$updateFields.=' `attribute_map_id`= :attributeMapId';
$isFirst=false;}else{
$updateFields.=', `attribute_map_id`= :attributeMapId';
}
$params[]=array(':attributeMapId', $attributeMapVo->attributeMapId, PDO::PARAM_INT);
}

if (isset($attributeMapVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $attributeMapVo->productId, PDO::PARAM_INT);
}

if (isset($attributeMapVo->attributeId)){
if ($isFirst){
$updateFields.=' `attribute_id`= :attributeId';
$isFirst=false;}else{
$updateFields.=', `attribute_id`= :attributeId';
}
$params[]=array(':attributeId', $attributeMapVo->attributeId, PDO::PARAM_INT);
}

if (isset($attributeMapVo->attributeValueId)){
if ($isFirst){
$updateFields.=' `attribute_value_id`= :attributeValueId';
$isFirst=false;}else{
$updateFields.=', `attribute_value_id`= :attributeValueId';
}
$params[]=array(':attributeValueId', $attributeMapVo->attributeValueId, PDO::PARAM_INT);
}

$conditions.=' where `attribute_map_id`= :attributeMapId';
$params[]=array(':attributeMapId', $attributeMapId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (attributeMapId)
	 * Example
	 * getValueByPrimaryKey('attributeMapName', 1)
	 * Get value of filed attributeMapName in table attributeMap where attributeMapId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$attributeMapVo = $this->selectByPrimaryKey($primaryValue);
		if($attributeMapVo){
			return $attributeMapVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('attributeMapName', array('attributeMapId' => 1))
	 * Get value of filed attributeMapName in table attributeMap where attributeMapId = 1
	 */
	public function getValueByField($fieldName, $where){
		$attributeMapVo = new AttributeMapVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$attributeMapVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$attributeMapVos = $this->selectByFilter($attributeMapVo);
       
		if($attributeMapVos){
			$attributeMapVo = $attributeMapVos[0];
			return $attributeMapVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table attribute_map
	 *
	 * @param int $attribute_map_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($attributeMapId){
		try {
		    $sql = "DELETE FROM `attribute_map` where `attribute_map_id` = :attributeMapId";
		    $params = array();
		    $params[] = array(':attributeMapId', $attributeMapId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table attribute_map
	 *
	 * @param object $attributeMapVo
	 * @return boolean
	 */
	public function deleteByFilter($attributeMapVo){
		try {
			$sql = 'DELETE FROM `attribute_map`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($attributeMapVo->attributeMapId)){
				$isDel = true;
				$condition[] = '`attribute_map_id` = :attributeMapId';
				$params[] = array(':attributeMapId', $attributeMapVo->attributeMapId, PDO::PARAM_INT);
			}
			if (!is_null($attributeMapVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $attributeMapVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($attributeMapVo->attributeId)){
				$isDel = true;
				$condition[] = '`attribute_id` = :attributeId';
				$params[] = array(':attributeId', $attributeMapVo->attributeId, PDO::PARAM_INT);
			}
			if (!is_null($attributeMapVo->attributeValueId)){
				$isDel = true;
				$condition[] = '`attribute_value_id` = :attributeValueId';
				$params[] = array(':attributeValueId', $attributeMapVo->attributeValueId, PDO::PARAM_INT);
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
