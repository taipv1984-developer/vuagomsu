<?php
class CityDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `city`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CityVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($cityId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `city` where `city_id` = :cityId");
$stmt->bindParam(':cityId',$cityId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CityVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($cityVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `city`( `city_id`, `name`, `order`, `country_id`, `state_id`)
VALUES( :cityId, :name, :order, :countryId, :stateId)");
$stmt->bindParam(':cityId', $cityVo->cityId, PDO::PARAM_INT);
$stmt->bindParam(':name', $cityVo->name, PDO::PARAM_STR);
$stmt->bindParam(':order', $cityVo->order, PDO::PARAM_INT);
$stmt->bindParam(':countryId', $cityVo->countryId, PDO::PARAM_INT);
$stmt->bindParam(':stateId', $cityVo->stateId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($cityVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `city`( `city_id`, `name`, `order`, `country_id`, `state_id`)
VALUES( :cityId, :name, :order, :countryId, :stateId)");
$stmt->bindParam(':cityId', $cityVo->cityId, PDO::PARAM_INT);
$stmt->bindParam(':name', $cityVo->name, PDO::PARAM_STR);
$stmt->bindParam(':order', $cityVo->order, PDO::PARAM_INT);
$stmt->bindParam(':countryId', $cityVo->countryId, PDO::PARAM_INT);
$stmt->bindParam(':stateId', $cityVo->stateId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table city by $cityVo object filter use paging
 * 
 * @param object $cityVo is city object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($cityVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($cityVo)) $cityVo = new CityVo();
$sql = "select * from `city` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($cityVo->cityId)){ //If isset Vo->element
$fieldValue=$cityVo->cityId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `city_id` $key :cityIdKey";
    $isFirst = false;
} else {
    $condition .= " and `city_id` $key :cityIdKey";
}
if($type == 'str') {
    $params[] = array(':cityIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':cityIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `city_id` =  :cityIdKey';
$isFirst=false;
}else{
$condition.=' and `city_id` =  :cityIdKey';
}
$params[]=array(':cityIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($cityVo->name)){ //If isset Vo->element
$fieldValue=$cityVo->name;
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

if (!is_null($cityVo->order)){ //If isset Vo->element
$fieldValue=$cityVo->order;
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

if (!is_null($cityVo->countryId)){ //If isset Vo->element
$fieldValue=$cityVo->countryId;
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

if (!is_null($cityVo->stateId)){ //If isset Vo->element
$fieldValue=$cityVo->stateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `state_id` $key :stateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `state_id` $key :stateIdKey";
}
if($type == 'str') {
    $params[] = array(':stateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':stateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `state_id` =  :stateIdKey';
$isFirst=false;
}else{
$condition.=' and `state_id` =  :stateIdKey';
}
$params[]=array(':stateIdKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('CityVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($cityVo){
try {
if (empty($cityVo)) $cityVo = new CityVo();
$sql = "select count(*) as total from  city ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($cityVo->cityId)){ //If isset Vo->element
$fieldValue=$cityVo->cityId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `city_id` $key :cityIdKey";
    $isFirst = false;
} else {
    $condition .= " and `city_id` $key :cityIdKey";
}
if($type == 'str') {
    $params[] = array(':cityIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':cityIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `city_id` =  :cityIdKey';
$isFirst=false;
}else{
$condition.=' and `city_id` =  :cityIdKey';
}
$params[]=array(':cityIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($cityVo->name)){ //If isset Vo->element
$fieldValue=$cityVo->name;
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

if (!is_null($cityVo->order)){ //If isset Vo->element
$fieldValue=$cityVo->order;
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

if (!is_null($cityVo->countryId)){ //If isset Vo->element
$fieldValue=$cityVo->countryId;
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

if (!is_null($cityVo->stateId)){ //If isset Vo->element
$fieldValue=$cityVo->stateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `state_id` $key :stateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `state_id` $key :stateIdKey";
}
if($type == 'str') {
    $params[] = array(':stateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':stateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `state_id` =  :stateIdKey';
$isFirst=false;
}else{
$condition.=' and `state_id` =  :stateIdKey';
}
$params[]=array(':stateIdKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($cityVo,$cityId){
try {
$sql="UPDATE `city` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($cityVo->cityId)){
if ($isFirst){
$updateFields.=' `city_id`= :cityId';
$isFirst=false;}else{
$updateFields.=', `city_id`= :cityId';
}
$params[]=array(':cityId', $cityVo->cityId, PDO::PARAM_INT);
}

if (isset($cityVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $cityVo->name, PDO::PARAM_STR);
}

if (isset($cityVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $cityVo->order, PDO::PARAM_INT);
}

if (isset($cityVo->countryId)){
if ($isFirst){
$updateFields.=' `country_id`= :countryId';
$isFirst=false;}else{
$updateFields.=', `country_id`= :countryId';
}
$params[]=array(':countryId', $cityVo->countryId, PDO::PARAM_INT);
}

if (isset($cityVo->stateId)){
if ($isFirst){
$updateFields.=' `state_id`= :stateId';
$isFirst=false;}else{
$updateFields.=', `state_id`= :stateId';
}
$params[]=array(':stateId', $cityVo->stateId, PDO::PARAM_INT);
}

$conditions.=' where `city_id`= :cityId';
$params[]=array(':cityId', $cityId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (cityId)
	 * Example
	 * getValueByPrimaryKey('cityName', 1)
	 * Get value of filed cityName in table city where cityId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$cityVo = $this->selectByPrimaryKey($primaryValue);
		if($cityVo){
			return $cityVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('cityName', array('cityId' => 1))
	 * Get value of filed cityName in table city where cityId = 1
	 */
	public function getValueByField($fieldName, $where){
		$cityVo = new CityVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$cityVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$cityVos = $this->selectByFilter($cityVo);
       
		if($cityVos){
			$cityVo = $cityVos[0];
			return $cityVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table city
	 *
	 * @param int $city_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($cityId){
		try {
		    $sql = "DELETE FROM `city` where `city_id` = :cityId";
		    $params = array();
		    $params[] = array(':cityId', $cityId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table city
	 *
	 * @param object $cityVo
	 * @return boolean
	 */
	public function deleteByFilter($cityVo){
		try {
			$sql = 'DELETE FROM `city`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($cityVo->cityId)){
				$isDel = true;
				$condition[] = '`city_id` = :cityId';
				$params[] = array(':cityId', $cityVo->cityId, PDO::PARAM_INT);
			}
			if (!is_null($cityVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $cityVo->name, PDO::PARAM_STR);
			}
			if (!is_null($cityVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $cityVo->order, PDO::PARAM_INT);
			}
			if (!is_null($cityVo->countryId)){
				$isDel = true;
				$condition[] = '`country_id` = :countryId';
				$params[] = array(':countryId', $cityVo->countryId, PDO::PARAM_INT);
			}
			if (!is_null($cityVo->stateId)){
				$isDel = true;
				$condition[] = '`state_id` = :stateId';
				$params[] = array(':stateId', $cityVo->stateId, PDO::PARAM_INT);
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
