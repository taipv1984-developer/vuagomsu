<?php
class AttributeValueDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `attribute_value`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('AttributeValueVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($attributeValueId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `attribute_value` where `attribute_value_id` = :attributeValueId");
$stmt->bindParam(':attributeValueId',$attributeValueId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('AttributeValueVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($attributeValueVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `attribute_value`( `attribute_id`, `value`, `description`, `image`, `image_list`)
VALUES( :attributeId, :value, :description, :image, :imageList)");
$stmt->bindParam(':attributeId', $attributeValueVo->attributeId, PDO::PARAM_INT);
$stmt->bindParam(':value', $attributeValueVo->value, PDO::PARAM_STR);
$stmt->bindParam(':description', $attributeValueVo->description, PDO::PARAM_STR);
$stmt->bindParam(':image', $attributeValueVo->image, PDO::PARAM_STR);
$stmt->bindParam(':imageList', $attributeValueVo->imageList, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($attributeValueVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `attribute_value`( `attribute_id`, `value`, `description`, `image`, `image_list`)
VALUES( :attributeId, :value, :description, :image, :imageList)");
$stmt->bindParam(':attributeId', $attributeValueVo->attributeId, PDO::PARAM_INT);
$stmt->bindParam(':value', $attributeValueVo->value, PDO::PARAM_STR);
$stmt->bindParam(':description', $attributeValueVo->description, PDO::PARAM_STR);
$stmt->bindParam(':image', $attributeValueVo->image, PDO::PARAM_STR);
$stmt->bindParam(':imageList', $attributeValueVo->imageList, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table attribute_value by $attributeValueVo object filter use paging
 * 
 * @param object $attributeValueVo is attribute_value object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($attributeValueVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($attributeValueVo)) $attributeValueVo = new AttributeValueVo();
$sql = "select * from `attribute_value` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($attributeValueVo->attributeValueId)){ //If isset Vo->element
$fieldValue=$attributeValueVo->attributeValueId;
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

if (!is_null($attributeValueVo->attributeId)){ //If isset Vo->element
$fieldValue=$attributeValueVo->attributeId;
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

if (!is_null($attributeValueVo->value)){ //If isset Vo->element
$fieldValue=$attributeValueVo->value;
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

if (!is_null($attributeValueVo->description)){ //If isset Vo->element
$fieldValue=$attributeValueVo->description;
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

if (!is_null($attributeValueVo->image)){ //If isset Vo->element
$fieldValue=$attributeValueVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($attributeValueVo->imageList)){ //If isset Vo->element
$fieldValue=$attributeValueVo->imageList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image_list` $key :imageListKey";
    $isFirst = false;
} else {
    $condition .= " and `image_list` $key :imageListKey";
}
if($type == 'str') {
    $params[] = array(':imageListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image_list` =  :imageListKey';
$isFirst=false;
}else{
$condition.=' and `image_list` =  :imageListKey';
}
$params[]=array(':imageListKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('AttributeValueVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($attributeValueVo){
try {
if (empty($attributeValueVo)) $attributeValueVo = new AttributeValueVo();
$sql = "select count(*) as total from  attribute_value ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($attributeValueVo->attributeValueId)){ //If isset Vo->element
$fieldValue=$attributeValueVo->attributeValueId;
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

if (!is_null($attributeValueVo->attributeId)){ //If isset Vo->element
$fieldValue=$attributeValueVo->attributeId;
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

if (!is_null($attributeValueVo->value)){ //If isset Vo->element
$fieldValue=$attributeValueVo->value;
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

if (!is_null($attributeValueVo->description)){ //If isset Vo->element
$fieldValue=$attributeValueVo->description;
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

if (!is_null($attributeValueVo->image)){ //If isset Vo->element
$fieldValue=$attributeValueVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($attributeValueVo->imageList)){ //If isset Vo->element
$fieldValue=$attributeValueVo->imageList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image_list` $key :imageListKey";
    $isFirst = false;
} else {
    $condition .= " and `image_list` $key :imageListKey";
}
if($type == 'str') {
    $params[] = array(':imageListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image_list` =  :imageListKey';
$isFirst=false;
}else{
$condition.=' and `image_list` =  :imageListKey';
}
$params[]=array(':imageListKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($attributeValueVo,$attributeValueId){
try {
$sql="UPDATE `attribute_value` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($attributeValueVo->attributeValueId)){
if ($isFirst){
$updateFields.=' `attribute_value_id`= :attributeValueId';
$isFirst=false;}else{
$updateFields.=', `attribute_value_id`= :attributeValueId';
}
$params[]=array(':attributeValueId', $attributeValueVo->attributeValueId, PDO::PARAM_INT);
}

if (isset($attributeValueVo->attributeId)){
if ($isFirst){
$updateFields.=' `attribute_id`= :attributeId';
$isFirst=false;}else{
$updateFields.=', `attribute_id`= :attributeId';
}
$params[]=array(':attributeId', $attributeValueVo->attributeId, PDO::PARAM_INT);
}

if (isset($attributeValueVo->value)){
if ($isFirst){
$updateFields.=' `value`= :value';
$isFirst=false;}else{
$updateFields.=', `value`= :value';
}
$params[]=array(':value', $attributeValueVo->value, PDO::PARAM_STR);
}

if (isset($attributeValueVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $attributeValueVo->description, PDO::PARAM_STR);
}

if (isset($attributeValueVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $attributeValueVo->image, PDO::PARAM_STR);
}

if (isset($attributeValueVo->imageList)){
if ($isFirst){
$updateFields.=' `image_list`= :imageList';
$isFirst=false;}else{
$updateFields.=', `image_list`= :imageList';
}
$params[]=array(':imageList', $attributeValueVo->imageList, PDO::PARAM_STR);
}

$conditions.=' where `attribute_value_id`= :attributeValueId';
$params[]=array(':attributeValueId', $attributeValueId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (attributeValueId)
	 * Example
	 * getValueByPrimaryKey('attributeValueName', 1)
	 * Get value of filed attributeValueName in table attributeValue where attributeValueId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$attributeValueVo = $this->selectByPrimaryKey($primaryValue);
		if($attributeValueVo){
			return $attributeValueVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('attributeValueName', array('attributeValueId' => 1))
	 * Get value of filed attributeValueName in table attributeValue where attributeValueId = 1
	 */
	public function getValueByField($fieldName, $where){
		$attributeValueVo = new AttributeValueVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$attributeValueVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$attributeValueVos = $this->selectByFilter($attributeValueVo);
       
		if($attributeValueVos){
			$attributeValueVo = $attributeValueVos[0];
			return $attributeValueVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table attribute_value
	 *
	 * @param int $attribute_value_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($attributeValueId){
		try {
		    $sql = "DELETE FROM `attribute_value` where `attribute_value_id` = :attributeValueId";
		    $params = array();
		    $params[] = array(':attributeValueId', $attributeValueId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table attribute_value
	 *
	 * @param object $attributeValueVo
	 * @return boolean
	 */
	public function deleteByFilter($attributeValueVo){
		try {
			$sql = 'DELETE FROM `attribute_value`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($attributeValueVo->attributeValueId)){
				$isDel = true;
				$condition[] = '`attribute_value_id` = :attributeValueId';
				$params[] = array(':attributeValueId', $attributeValueVo->attributeValueId, PDO::PARAM_INT);
			}
			if (!is_null($attributeValueVo->attributeId)){
				$isDel = true;
				$condition[] = '`attribute_id` = :attributeId';
				$params[] = array(':attributeId', $attributeValueVo->attributeId, PDO::PARAM_INT);
			}
			if (!is_null($attributeValueVo->value)){
				$isDel = true;
				$condition[] = '`value` = :value';
				$params[] = array(':value', $attributeValueVo->value, PDO::PARAM_STR);
			}
			if (!is_null($attributeValueVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $attributeValueVo->description, PDO::PARAM_STR);
			}
			if (!is_null($attributeValueVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $attributeValueVo->image, PDO::PARAM_STR);
			}
			if (!is_null($attributeValueVo->imageList)){
				$isDel = true;
				$condition[] = '`image_list` = :imageList';
				$params[] = array(':imageList', $attributeValueVo->imageList, PDO::PARAM_STR);
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
