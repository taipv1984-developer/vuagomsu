<?php
class AttributeDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `attribute`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('AttributeVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($attributeId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `attribute` where `attribute_id` = :attributeId");
$stmt->bindParam(':attributeId',$attributeId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('AttributeVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($attributeVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `attribute`( `name`, `description`, `image`, `type`)
VALUES( :name, :description, :image, :type)");
$stmt->bindParam(':name', $attributeVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $attributeVo->description, PDO::PARAM_STR);
$stmt->bindParam(':image', $attributeVo->image, PDO::PARAM_STR);
$stmt->bindParam(':type', $attributeVo->type, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($attributeVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `attribute`( `name`, `description`, `image`, `type`)
VALUES( :name, :description, :image, :type)");
$stmt->bindParam(':name', $attributeVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $attributeVo->description, PDO::PARAM_STR);
$stmt->bindParam(':image', $attributeVo->image, PDO::PARAM_STR);
$stmt->bindParam(':type', $attributeVo->type, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table attribute by $attributeVo object filter use paging
 * 
 * @param object $attributeVo is attribute object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($attributeVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($attributeVo)) $attributeVo = new AttributeVo();
$sql = "select * from `attribute` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($attributeVo->attributeId)){ //If isset Vo->element
$fieldValue=$attributeVo->attributeId;
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

if (!is_null($attributeVo->name)){ //If isset Vo->element
$fieldValue=$attributeVo->name;
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

if (!is_null($attributeVo->description)){ //If isset Vo->element
$fieldValue=$attributeVo->description;
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

if (!is_null($attributeVo->image)){ //If isset Vo->element
$fieldValue=$attributeVo->image;
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

if (!is_null($attributeVo->type)){ //If isset Vo->element
$fieldValue=$attributeVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('AttributeVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($attributeVo){
try {
if (empty($attributeVo)) $attributeVo = new AttributeVo();
$sql = "select count(*) as total from  attribute ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($attributeVo->attributeId)){ //If isset Vo->element
$fieldValue=$attributeVo->attributeId;
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

if (!is_null($attributeVo->name)){ //If isset Vo->element
$fieldValue=$attributeVo->name;
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

if (!is_null($attributeVo->description)){ //If isset Vo->element
$fieldValue=$attributeVo->description;
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

if (!is_null($attributeVo->image)){ //If isset Vo->element
$fieldValue=$attributeVo->image;
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

if (!is_null($attributeVo->type)){ //If isset Vo->element
$fieldValue=$attributeVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($attributeVo,$attributeId){
try {
$sql="UPDATE `attribute` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($attributeVo->attributeId)){
if ($isFirst){
$updateFields.=' `attribute_id`= :attributeId';
$isFirst=false;}else{
$updateFields.=', `attribute_id`= :attributeId';
}
$params[]=array(':attributeId', $attributeVo->attributeId, PDO::PARAM_INT);
}

if (isset($attributeVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $attributeVo->name, PDO::PARAM_STR);
}

if (isset($attributeVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $attributeVo->description, PDO::PARAM_STR);
}

if (isset($attributeVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $attributeVo->image, PDO::PARAM_STR);
}

if (isset($attributeVo->type)){
if ($isFirst){
$updateFields.=' `type`= :type';
$isFirst=false;}else{
$updateFields.=', `type`= :type';
}
$params[]=array(':type', $attributeVo->type, PDO::PARAM_STR);
}

$conditions.=' where `attribute_id`= :attributeId';
$params[]=array(':attributeId', $attributeId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (attributeId)
	 * Example
	 * getValueByPrimaryKey('attributeName', 1)
	 * Get value of filed attributeName in table attribute where attributeId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$attributeVo = $this->selectByPrimaryKey($primaryValue);
		if($attributeVo){
			return $attributeVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('attributeName', array('attributeId' => 1))
	 * Get value of filed attributeName in table attribute where attributeId = 1
	 */
	public function getValueByField($fieldName, $where){
		$attributeVo = new AttributeVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$attributeVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$attributeVos = $this->selectByFilter($attributeVo);
       
		if($attributeVos){
			$attributeVo = $attributeVos[0];
			return $attributeVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table attribute
	 *
	 * @param int $attribute_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($attributeId){
		try {
		    $sql = "DELETE FROM `attribute` where `attribute_id` = :attributeId";
		    $params = array();
		    $params[] = array(':attributeId', $attributeId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table attribute
	 *
	 * @param object $attributeVo
	 * @return boolean
	 */
	public function deleteByFilter($attributeVo){
		try {
			$sql = 'DELETE FROM `attribute`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($attributeVo->attributeId)){
				$isDel = true;
				$condition[] = '`attribute_id` = :attributeId';
				$params[] = array(':attributeId', $attributeVo->attributeId, PDO::PARAM_INT);
			}
			if (!is_null($attributeVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $attributeVo->name, PDO::PARAM_STR);
			}
			if (!is_null($attributeVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $attributeVo->description, PDO::PARAM_STR);
			}
			if (!is_null($attributeVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $attributeVo->image, PDO::PARAM_STR);
			}
			if (!is_null($attributeVo->type)){
				$isDel = true;
				$condition[] = '`type` = :type';
				$params[] = array(':type', $attributeVo->type, PDO::PARAM_STR);
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
