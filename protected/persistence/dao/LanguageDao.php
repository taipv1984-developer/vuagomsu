<?php
class LanguageDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `language`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('LanguageVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($languageId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `language` where `language_id` = :languageId");
$stmt->bindParam(':languageId',$languageId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('LanguageVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($languageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `language`( `language_code`, `name`, `status`, `country_code`, `default`)
VALUES( :languageCode, :name, :status, :countryCode, :default)");
$stmt->bindParam(':languageCode', $languageVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':name', $languageVo->name, PDO::PARAM_STR);
$stmt->bindParam(':status', $languageVo->status, PDO::PARAM_STR);
$stmt->bindParam(':countryCode', $languageVo->countryCode, PDO::PARAM_STR);
$stmt->bindParam(':default', $languageVo->default, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($languageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `language`( `language_code`, `name`, `status`, `country_code`, `default`)
VALUES( :languageCode, :name, :status, :countryCode, :default)");
$stmt->bindParam(':languageCode', $languageVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':name', $languageVo->name, PDO::PARAM_STR);
$stmt->bindParam(':status', $languageVo->status, PDO::PARAM_STR);
$stmt->bindParam(':countryCode', $languageVo->countryCode, PDO::PARAM_STR);
$stmt->bindParam(':default', $languageVo->default, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table language by $languageVo object filter use paging
 * 
 * @param object $languageVo is language object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($languageVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($languageVo)) $languageVo = new LanguageVo();
$sql = "select * from `language` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($languageVo->languageId)){ //If isset Vo->element
$fieldValue=$languageVo->languageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_id` $key :languageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `language_id` $key :languageIdKey";
}
if($type == 'str') {
    $params[] = array(':languageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_id` =  :languageIdKey';
$isFirst=false;
}else{
$condition.=' and `language_id` =  :languageIdKey';
}
$params[]=array(':languageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($languageVo->languageCode)){ //If isset Vo->element
$fieldValue=$languageVo->languageCode;
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

if (!is_null($languageVo->name)){ //If isset Vo->element
$fieldValue=$languageVo->name;
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

if (!is_null($languageVo->status)){ //If isset Vo->element
$fieldValue=$languageVo->status;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `status` $key :statusKey";
    $isFirst = false;
} else {
    $condition .= " and `status` $key :statusKey";
}
if($type == 'str') {
    $params[] = array(':statusKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':statusKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `status` =  :statusKey';
$isFirst=false;
}else{
$condition.=' and `status` =  :statusKey';
}
$params[]=array(':statusKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($languageVo->countryCode)){ //If isset Vo->element
$fieldValue=$languageVo->countryCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `country_code` $key :countryCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `country_code` $key :countryCodeKey";
}
if($type == 'str') {
    $params[] = array(':countryCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countryCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `country_code` =  :countryCodeKey';
$isFirst=false;
}else{
$condition.=' and `country_code` =  :countryCodeKey';
}
$params[]=array(':countryCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($languageVo->default)){ //If isset Vo->element
$fieldValue=$languageVo->default;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default` $key :defaultKey";
    $isFirst = false;
} else {
    $condition .= " and `default` $key :defaultKey";
}
if($type == 'str') {
    $params[] = array(':defaultKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default` =  :defaultKey';
$isFirst=false;
}else{
$condition.=' and `default` =  :defaultKey';
}
$params[]=array(':defaultKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('LanguageVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($languageVo){
try {
if (empty($languageVo)) $languageVo = new LanguageVo();
$sql = "select count(*) as total from  language ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($languageVo->languageId)){ //If isset Vo->element
$fieldValue=$languageVo->languageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_id` $key :languageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `language_id` $key :languageIdKey";
}
if($type == 'str') {
    $params[] = array(':languageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_id` =  :languageIdKey';
$isFirst=false;
}else{
$condition.=' and `language_id` =  :languageIdKey';
}
$params[]=array(':languageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($languageVo->languageCode)){ //If isset Vo->element
$fieldValue=$languageVo->languageCode;
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

if (!is_null($languageVo->name)){ //If isset Vo->element
$fieldValue=$languageVo->name;
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

if (!is_null($languageVo->status)){ //If isset Vo->element
$fieldValue=$languageVo->status;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `status` $key :statusKey";
    $isFirst = false;
} else {
    $condition .= " and `status` $key :statusKey";
}
if($type == 'str') {
    $params[] = array(':statusKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':statusKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `status` =  :statusKey';
$isFirst=false;
}else{
$condition.=' and `status` =  :statusKey';
}
$params[]=array(':statusKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($languageVo->countryCode)){ //If isset Vo->element
$fieldValue=$languageVo->countryCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `country_code` $key :countryCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `country_code` $key :countryCodeKey";
}
if($type == 'str') {
    $params[] = array(':countryCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countryCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `country_code` =  :countryCodeKey';
$isFirst=false;
}else{
$condition.=' and `country_code` =  :countryCodeKey';
}
$params[]=array(':countryCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($languageVo->default)){ //If isset Vo->element
$fieldValue=$languageVo->default;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default` $key :defaultKey";
    $isFirst = false;
} else {
    $condition .= " and `default` $key :defaultKey";
}
if($type == 'str') {
    $params[] = array(':defaultKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default` =  :defaultKey';
$isFirst=false;
}else{
$condition.=' and `default` =  :defaultKey';
}
$params[]=array(':defaultKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($languageVo,$languageId){
try {
$sql="UPDATE `language` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($languageVo->languageId)){
if ($isFirst){
$updateFields.=' `language_id`= :languageId';
$isFirst=false;}else{
$updateFields.=', `language_id`= :languageId';
}
$params[]=array(':languageId', $languageVo->languageId, PDO::PARAM_INT);
}

if (isset($languageVo->languageCode)){
if ($isFirst){
$updateFields.=' `language_code`= :languageCode';
$isFirst=false;}else{
$updateFields.=', `language_code`= :languageCode';
}
$params[]=array(':languageCode', $languageVo->languageCode, PDO::PARAM_STR);
}

if (isset($languageVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $languageVo->name, PDO::PARAM_STR);
}

if (isset($languageVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $languageVo->status, PDO::PARAM_STR);
}

if (isset($languageVo->countryCode)){
if ($isFirst){
$updateFields.=' `country_code`= :countryCode';
$isFirst=false;}else{
$updateFields.=', `country_code`= :countryCode';
}
$params[]=array(':countryCode', $languageVo->countryCode, PDO::PARAM_STR);
}

if (isset($languageVo->default)){
if ($isFirst){
$updateFields.=' `default`= :default';
$isFirst=false;}else{
$updateFields.=', `default`= :default';
}
$params[]=array(':default', $languageVo->default, PDO::PARAM_INT);
}

$conditions.=' where `language_id`= :languageId';
$params[]=array(':languageId', $languageId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (languageId)
	 * Example
	 * getValueByPrimaryKey('languageName', 1)
	 * Get value of filed languageName in table language where languageId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$languageVo = $this->selectByPrimaryKey($primaryValue);
		if($languageVo){
			return $languageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('languageName', array('languageId' => 1))
	 * Get value of filed languageName in table language where languageId = 1
	 */
	public function getValueByField($fieldName, $where){
		$languageVo = new LanguageVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$languageVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$languageVos = $this->selectByFilter($languageVo);
       
		if($languageVos){
			$languageVo = $languageVos[0];
			return $languageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table language
	 *
	 * @param int $language_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($languageId){
		try {
		    $sql = "DELETE FROM `language` where `language_id` = :languageId";
		    $params = array();
		    $params[] = array(':languageId', $languageId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table language
	 *
	 * @param object $languageVo
	 * @return boolean
	 */
	public function deleteByFilter($languageVo){
		try {
			$sql = 'DELETE FROM `language`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($languageVo->languageId)){
				$isDel = true;
				$condition[] = '`language_id` = :languageId';
				$params[] = array(':languageId', $languageVo->languageId, PDO::PARAM_INT);
			}
			if (!is_null($languageVo->languageCode)){
				$isDel = true;
				$condition[] = '`language_code` = :languageCode';
				$params[] = array(':languageCode', $languageVo->languageCode, PDO::PARAM_STR);
			}
			if (!is_null($languageVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $languageVo->name, PDO::PARAM_STR);
			}
			if (!is_null($languageVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $languageVo->status, PDO::PARAM_STR);
			}
			if (!is_null($languageVo->countryCode)){
				$isDel = true;
				$condition[] = '`country_code` = :countryCode';
				$params[] = array(':countryCode', $languageVo->countryCode, PDO::PARAM_STR);
			}
			if (!is_null($languageVo->default)){
				$isDel = true;
				$condition[] = '`default` = :default';
				$params[] = array(':default', $languageVo->default, PDO::PARAM_INT);
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
