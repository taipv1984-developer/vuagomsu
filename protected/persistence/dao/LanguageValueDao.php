<?php
class LanguageValueDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `language_value`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('LanguageValueVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($languageValueId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `language_value` where `language_value_id` = :languageValueId");
$stmt->bindParam(':languageValueId',$languageValueId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('LanguageValueVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($languageValueVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `language_value`( `language_code`, `key`, `value`)
VALUES( :languageCode, :key, :value)");
$stmt->bindParam(':languageCode', $languageValueVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':key', $languageValueVo->key, PDO::PARAM_STR);
$stmt->bindParam(':value', $languageValueVo->value, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($languageValueVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `language_value`( `language_code`, `key`, `value`)
VALUES( :languageCode, :key, :value)");
$stmt->bindParam(':languageCode', $languageValueVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':key', $languageValueVo->key, PDO::PARAM_STR);
$stmt->bindParam(':value', $languageValueVo->value, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table language_value by $languageValueVo object filter use paging
 * 
 * @param object $languageValueVo is language_value object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($languageValueVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($languageValueVo)) $languageValueVo = new LanguageValueVo();
$sql = "select * from `language_value` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($languageValueVo->languageValueId)){ //If isset Vo->element
$fieldValue=$languageValueVo->languageValueId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_value_id` $key :languageValueIdKey";
    $isFirst = false;
} else {
    $condition .= " and `language_value_id` $key :languageValueIdKey";
}
if($type == 'str') {
    $params[] = array(':languageValueIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageValueIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_value_id` =  :languageValueIdKey';
$isFirst=false;
}else{
$condition.=' and `language_value_id` =  :languageValueIdKey';
}
$params[]=array(':languageValueIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($languageValueVo->languageCode)){ //If isset Vo->element
$fieldValue=$languageValueVo->languageCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_code` $key :languageCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `language_code` $key :languageCodeKey";
}
if($type == 'str') {
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_code` =  :languageCodeKey';
$isFirst=false;
}else{
$condition.=' and `language_code` =  :languageCodeKey';
}
$params[]=array(':languageCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($languageValueVo->key)){ //If isset Vo->element
$fieldValue=$languageValueVo->key;
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

if (!is_null($languageValueVo->value)){ //If isset Vo->element
$fieldValue=$languageValueVo->value;
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
return PersistentHelper::mapResult('LanguageValueVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($languageValueVo){
try {
if (empty($languageValueVo)) $languageValueVo = new LanguageValueVo();
$sql = "select count(*) as total from  language_value ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($languageValueVo->languageValueId)){ //If isset Vo->element
$fieldValue=$languageValueVo->languageValueId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_value_id` $key :languageValueIdKey";
    $isFirst = false;
} else {
    $condition .= " and `language_value_id` $key :languageValueIdKey";
}
if($type == 'str') {
    $params[] = array(':languageValueIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageValueIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_value_id` =  :languageValueIdKey';
$isFirst=false;
}else{
$condition.=' and `language_value_id` =  :languageValueIdKey';
}
$params[]=array(':languageValueIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($languageValueVo->languageCode)){ //If isset Vo->element
$fieldValue=$languageValueVo->languageCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_code` $key :languageCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `language_code` $key :languageCodeKey";
}
if($type == 'str') {
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_code` =  :languageCodeKey';
$isFirst=false;
}else{
$condition.=' and `language_code` =  :languageCodeKey';
}
$params[]=array(':languageCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($languageValueVo->key)){ //If isset Vo->element
$fieldValue=$languageValueVo->key;
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

if (!is_null($languageValueVo->value)){ //If isset Vo->element
$fieldValue=$languageValueVo->value;
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


public function updateByPrimaryKey($languageValueVo,$languageValueId){
try {
$sql="UPDATE `language_value` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($languageValueVo->languageValueId)){
if ($isFirst){
$updateFields.=' `language_value_id`= :languageValueId';
$isFirst=false;}else{
$updateFields.=', `language_value_id`= :languageValueId';
}
$params[]=array(':languageValueId', $languageValueVo->languageValueId, PDO::PARAM_INT);
}

if (isset($languageValueVo->languageCode)){
if ($isFirst){
$updateFields.=' `language_code`= :languageCode';
$isFirst=false;}else{
$updateFields.=', `language_code`= :languageCode';
}
$params[]=array(':languageCode', $languageValueVo->languageCode, PDO::PARAM_STR);
}

if (isset($languageValueVo->key)){
if ($isFirst){
$updateFields.=' `key`= :key';
$isFirst=false;}else{
$updateFields.=', `key`= :key';
}
$params[]=array(':key', $languageValueVo->key, PDO::PARAM_STR);
}

if (isset($languageValueVo->value)){
if ($isFirst){
$updateFields.=' `value`= :value';
$isFirst=false;}else{
$updateFields.=', `value`= :value';
}
$params[]=array(':value', $languageValueVo->value, PDO::PARAM_STR);
}

$conditions.=' where `language_value_id`= :languageValueId';
$params[]=array(':languageValueId', $languageValueId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (languageValueId)
	 * Example
	 * getValueByPrimaryKey('languageValueName', 1)
	 * Get value of filed languageValueName in table languageValue where languageValueId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$languageValueVo = $this->selectByPrimaryKey($primaryValue);
		if($languageValueVo){
			return $languageValueVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('languageValueName', array('languageValueId' => 1))
	 * Get value of filed languageValueName in table languageValue where languageValueId = 1
	 */
	public function getValueByField($fieldName, $where){
		$languageValueVo = new LanguageValueVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$languageValueVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$languageValueVos = $this->selectByFilter($languageValueVo);
       
		if($languageValueVos){
			$languageValueVo = $languageValueVos[0];
			return $languageValueVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table language_value
	 *
	 * @param int $language_value_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($languageValueId){
		try {
		    $sql = "DELETE FROM `language_value` where `language_value_id` = :languageValueId";
		    $params = array();
		    $params[] = array(':languageValueId', $languageValueId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table language_value
	 *
	 * @param object $languageValueVo
	 * @return boolean
	 */
	public function deleteByFilter($languageValueVo){
		try {
			$sql = 'DELETE FROM `language_value`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($languageValueVo->languageValueId)){
				$isDel = true;
				$condition[] = '`language_value_id` = :languageValueId';
				$params[] = array(':languageValueId', $languageValueVo->languageValueId, PDO::PARAM_INT);
			}
			if (!is_null($languageValueVo->languageCode)){
				$isDel = true;
				$condition[] = '`language_code` = :languageCode';
				$params[] = array(':languageCode', $languageValueVo->languageCode, PDO::PARAM_STR);
			}
			if (!is_null($languageValueVo->key)){
				$isDel = true;
				$condition[] = '`key` = :key';
				$params[] = array(':key', $languageValueVo->key, PDO::PARAM_STR);
			}
			if (!is_null($languageValueVo->value)){
				$isDel = true;
				$condition[] = '`value` = :value';
				$params[] = array(':value', $languageValueVo->value, PDO::PARAM_STR);
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
