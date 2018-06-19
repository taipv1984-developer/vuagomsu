<?php
class DistrictDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `district`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('DistrictVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($districtId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `district` where `district_id` = :districtId");
$stmt->bindParam(':districtId',$districtId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('DistrictVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($districtVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `district`( `name`, `city_id`, `order`)
VALUES( :name, :cityId, :order)");
$stmt->bindParam(':name', $districtVo->name, PDO::PARAM_STR);
$stmt->bindParam(':cityId', $districtVo->cityId, PDO::PARAM_INT);
$stmt->bindParam(':order', $districtVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($districtVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `district`( `name`, `city_id`, `order`)
VALUES( :name, :cityId, :order)");
$stmt->bindParam(':name', $districtVo->name, PDO::PARAM_STR);
$stmt->bindParam(':cityId', $districtVo->cityId, PDO::PARAM_INT);
$stmt->bindParam(':order', $districtVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table district by $districtVo object filter use paging
 * 
 * @param object $districtVo is district object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($districtVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($districtVo)) $districtVo = new DistrictVo();
$sql = "select * from `district` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($districtVo->districtId)){ //If isset Vo->element
$fieldValue=$districtVo->districtId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `district_id` $key :districtIdKey";
    $isFirst = false;
} else {
    $condition .= " and `district_id` $key :districtIdKey";
}
if($type == 'str') {
    $params[] = array(':districtIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':districtIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `district_id` =  :districtIdKey';
$isFirst=false;
}else{
$condition.=' and `district_id` =  :districtIdKey';
}
$params[]=array(':districtIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($districtVo->name)){ //If isset Vo->element
$fieldValue=$districtVo->name;
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

if (!is_null($districtVo->cityId)){ //If isset Vo->element
$fieldValue=$districtVo->cityId;
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

if (!is_null($districtVo->order)){ //If isset Vo->element
$fieldValue=$districtVo->order;
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
return PersistentHelper::mapResult('DistrictVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($districtVo){
try {
if (empty($districtVo)) $districtVo = new DistrictVo();
$sql = "select count(*) as total from  district ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($districtVo->districtId)){ //If isset Vo->element
$fieldValue=$districtVo->districtId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `district_id` $key :districtIdKey";
    $isFirst = false;
} else {
    $condition .= " and `district_id` $key :districtIdKey";
}
if($type == 'str') {
    $params[] = array(':districtIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':districtIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `district_id` =  :districtIdKey';
$isFirst=false;
}else{
$condition.=' and `district_id` =  :districtIdKey';
}
$params[]=array(':districtIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($districtVo->name)){ //If isset Vo->element
$fieldValue=$districtVo->name;
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

if (!is_null($districtVo->cityId)){ //If isset Vo->element
$fieldValue=$districtVo->cityId;
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

if (!is_null($districtVo->order)){ //If isset Vo->element
$fieldValue=$districtVo->order;
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


public function updateByPrimaryKey($districtVo,$districtId){
try {
$sql="UPDATE `district` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($districtVo->districtId)){
if ($isFirst){
$updateFields.=' `district_id`= :districtId';
$isFirst=false;}else{
$updateFields.=', `district_id`= :districtId';
}
$params[]=array(':districtId', $districtVo->districtId, PDO::PARAM_INT);
}

if (isset($districtVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $districtVo->name, PDO::PARAM_STR);
}

if (isset($districtVo->cityId)){
if ($isFirst){
$updateFields.=' `city_id`= :cityId';
$isFirst=false;}else{
$updateFields.=', `city_id`= :cityId';
}
$params[]=array(':cityId', $districtVo->cityId, PDO::PARAM_INT);
}

if (isset($districtVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $districtVo->order, PDO::PARAM_INT);
}

$conditions.=' where `district_id`= :districtId';
$params[]=array(':districtId', $districtId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (districtId)
	 * Example
	 * getValueByPrimaryKey('districtName', 1)
	 * Get value of filed districtName in table district where districtId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$districtVo = $this->selectByPrimaryKey($primaryValue);
		if($districtVo){
			return $districtVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('districtName', array('districtId' => 1))
	 * Get value of filed districtName in table district where districtId = 1
	 */
	public function getValueByField($fieldName, $where){
		$districtVo = new DistrictVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$districtVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$districtVos = $this->selectByFilter($districtVo);
       
		if($districtVos){
			$districtVo = $districtVos[0];
			return $districtVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table district
	 *
	 * @param int $district_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($districtId){
		try {
		    $sql = "DELETE FROM `district` where `district_id` = :districtId";
		    $params = array();
		    $params[] = array(':districtId', $districtId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table district
	 *
	 * @param object $districtVo
	 * @return boolean
	 */
	public function deleteByFilter($districtVo){
		try {
			$sql = 'DELETE FROM `district`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($districtVo->districtId)){
				$isDel = true;
				$condition[] = '`district_id` = :districtId';
				$params[] = array(':districtId', $districtVo->districtId, PDO::PARAM_INT);
			}
			if (!is_null($districtVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $districtVo->name, PDO::PARAM_STR);
			}
			if (!is_null($districtVo->cityId)){
				$isDel = true;
				$condition[] = '`city_id` = :cityId';
				$params[] = array(':cityId', $districtVo->cityId, PDO::PARAM_INT);
			}
			if (!is_null($districtVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $districtVo->order, PDO::PARAM_INT);
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
