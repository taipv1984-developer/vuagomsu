<?php
class CountryDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `country`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CountryVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($countryId, $order){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `country` where `country_id` = :countryId and `order` = :order");
$stmt->bindParam(':countryId',$countryId, PDO::PARAM_INT);
$stmt->bindParam(':order',$order, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CountryVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($countryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `country`( `name`, `country_code`, `order`)
VALUES( :name, :countryCode, :order)");
$stmt->bindParam(':name', $countryVo->name, PDO::PARAM_STR);
$stmt->bindParam(':countryCode', $countryVo->countryCode, PDO::PARAM_STR);
$stmt->bindParam(':order', $countryVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($countryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `country`( `name`, `country_code`, `order`)
VALUES( :name, :countryCode, :order)");
$stmt->bindParam(':name', $countryVo->name, PDO::PARAM_STR);
$stmt->bindParam(':countryCode', $countryVo->countryCode, PDO::PARAM_STR);
$stmt->bindParam(':order', $countryVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table country by $countryVo object filter use paging
 * 
 * @param object $countryVo is country object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($countryVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($countryVo)) $countryVo = new CountryVo();
$sql = "select * from `country` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($countryVo->countryId)){ //If isset Vo->element
$fieldValue=$countryVo->countryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `country_id` $key :countryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `country_id` $key :countryIdKey";
}
if($type == 'str') {
    $params[] = array(':countryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `country_id` =  :countryIdKey';
$isFirst=false;
}else{
$condition.=' and `country_id` =  :countryIdKey';
}
$params[]=array(':countryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($countryVo->name)){ //If isset Vo->element
$fieldValue=$countryVo->name;
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

if (!is_null($countryVo->countryCode)){ //If isset Vo->element
$fieldValue=$countryVo->countryCode;
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

if (!is_null($countryVo->order)){ //If isset Vo->element
$fieldValue=$countryVo->order;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order` $key :orderKey";
    $isFirst = false;
} else {
    $condition .= " and `order` $key :orderKey";
}
if($type == 'str') {
    $params[] = array(':orderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order` =  :orderKey';
$isFirst=false;
}else{
$condition.=' and `order` =  :orderKey';
}
$params[]=array(':orderKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('CountryVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($countryVo){
try {
if (empty($countryVo)) $countryVo = new CountryVo();
$sql = "select count(*) as total from  country ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($countryVo->countryId)){ //If isset Vo->element
$fieldValue=$countryVo->countryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `country_id` $key :countryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `country_id` $key :countryIdKey";
}
if($type == 'str') {
    $params[] = array(':countryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `country_id` =  :countryIdKey';
$isFirst=false;
}else{
$condition.=' and `country_id` =  :countryIdKey';
}
$params[]=array(':countryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($countryVo->name)){ //If isset Vo->element
$fieldValue=$countryVo->name;
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

if (!is_null($countryVo->countryCode)){ //If isset Vo->element
$fieldValue=$countryVo->countryCode;
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

if (!is_null($countryVo->order)){ //If isset Vo->element
$fieldValue=$countryVo->order;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order` $key :orderKey";
    $isFirst = false;
} else {
    $condition .= " and `order` $key :orderKey";
}
if($type == 'str') {
    $params[] = array(':orderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order` =  :orderKey';
$isFirst=false;
}else{
$condition.=' and `order` =  :orderKey';
}
$params[]=array(':orderKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($countryVo,$countryId, $order){
try {
$sql="UPDATE `country` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($countryVo->countryId)){
if ($isFirst){
$updateFields.=' `country_id`= :countryId';
$isFirst=false;}else{
$updateFields.=', `country_id`= :countryId';
}
$params[]=array(':countryId', $countryVo->countryId, PDO::PARAM_INT);
}

if (isset($countryVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $countryVo->name, PDO::PARAM_STR);
}

if (isset($countryVo->countryCode)){
if ($isFirst){
$updateFields.=' `country_code`= :countryCode';
$isFirst=false;}else{
$updateFields.=', `country_code`= :countryCode';
}
$params[]=array(':countryCode', $countryVo->countryCode, PDO::PARAM_STR);
}

if (isset($countryVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $countryVo->order, PDO::PARAM_INT);
}

$conditions.=' where `country_id`= :countryId';
$params[]=array(':countryId', $countryId, PDO::PARAM_INT);
$conditions.=' and `order`= :order';
$params[]=array(':order', $order, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (countryId)
	 * Example
	 * getValueByPrimaryKey('countryName', 1)
	 * Get value of filed countryName in table country where countryId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$countryVo = $this->selectByPrimaryKey($primaryValue);
		if($countryVo){
			return $countryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('countryName', array('countryId' => 1))
	 * Get value of filed countryName in table country where countryId = 1
	 */
	public function getValueByField($fieldName, $where){
		$countryVo = new CountryVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$countryVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$countryVos = $this->selectByFilter($countryVo);
       
		if($countryVos){
			$countryVo = $countryVos[0];
			return $countryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table country
	 *
	 * @param int $country_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($countryId){
		try {
		    $sql = "DELETE FROM `country` where `country_id` = :countryId";
		    $params = array();
		    $params[] = array(':countryId', $countryId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table country
	 *
	 * @param object $countryVo
	 * @return boolean
	 */
	public function deleteByFilter($countryVo){
		try {
			$sql = 'DELETE FROM `country`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($countryVo->countryId)){
				$isDel = true;
				$condition[] = '`country_id` = :countryId';
				$params[] = array(':countryId', $countryVo->countryId, PDO::PARAM_INT);
			}
			if (!is_null($countryVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $countryVo->name, PDO::PARAM_STR);
			}
			if (!is_null($countryVo->countryCode)){
				$isDel = true;
				$condition[] = '`country_code` = :countryCode';
				$params[] = array(':countryCode', $countryVo->countryCode, PDO::PARAM_STR);
			}
			if (!is_null($countryVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $countryVo->order, PDO::PARAM_INT);
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
