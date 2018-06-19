<?php
class ManufacDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `manufac`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ManufacVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($manufacId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `manufac` where `manufac_id` = :manufacId");
$stmt->bindParam(':manufacId',$manufacId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ManufacVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($manufacVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `manufac`( `manufac_id`, `name`, `image`)
VALUES( :manufacId, :name, :image)");
$stmt->bindParam(':manufacId', $manufacVo->manufacId, PDO::PARAM_INT);
$stmt->bindParam(':name', $manufacVo->name, PDO::PARAM_STR);
$stmt->bindParam(':image', $manufacVo->image, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($manufacVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `manufac`( `manufac_id`, `name`, `image`)
VALUES( :manufacId, :name, :image)");
$stmt->bindParam(':manufacId', $manufacVo->manufacId, PDO::PARAM_INT);
$stmt->bindParam(':name', $manufacVo->name, PDO::PARAM_STR);
$stmt->bindParam(':image', $manufacVo->image, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table manufac by $manufacVo object filter use paging
 * 
 * @param object $manufacVo is manufac object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($manufacVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($manufacVo)) $manufacVo = new ManufacVo();
$sql = "select * from `manufac` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($manufacVo->manufacId)){ //If isset Vo->element
$fieldValue=$manufacVo->manufacId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `manufac_id` $key :manufacIdKey";
    $isFirst = false;
} else {
    $condition .= " and `manufac_id` $key :manufacIdKey";
}
if($type == 'str') {
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `manufac_id` =  :manufacIdKey';
$isFirst=false;
}else{
$condition.=' and `manufac_id` =  :manufacIdKey';
}
$params[]=array(':manufacIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($manufacVo->name)){ //If isset Vo->element
$fieldValue=$manufacVo->name;
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

if (!is_null($manufacVo->image)){ //If isset Vo->element
$fieldValue=$manufacVo->image;
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
return PersistentHelper::mapResult('ManufacVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($manufacVo){
try {
if (empty($manufacVo)) $manufacVo = new ManufacVo();
$sql = "select count(*) as total from  manufac ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($manufacVo->manufacId)){ //If isset Vo->element
$fieldValue=$manufacVo->manufacId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `manufac_id` $key :manufacIdKey";
    $isFirst = false;
} else {
    $condition .= " and `manufac_id` $key :manufacIdKey";
}
if($type == 'str') {
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `manufac_id` =  :manufacIdKey';
$isFirst=false;
}else{
$condition.=' and `manufac_id` =  :manufacIdKey';
}
$params[]=array(':manufacIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($manufacVo->name)){ //If isset Vo->element
$fieldValue=$manufacVo->name;
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

if (!is_null($manufacVo->image)){ //If isset Vo->element
$fieldValue=$manufacVo->image;
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


public function updateByPrimaryKey($manufacVo,$manufacId){
try {
$sql="UPDATE `manufac` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($manufacVo->manufacId)){
if ($isFirst){
$updateFields.=' `manufac_id`= :manufacId';
$isFirst=false;}else{
$updateFields.=', `manufac_id`= :manufacId';
}
$params[]=array(':manufacId', $manufacVo->manufacId, PDO::PARAM_INT);
}

if (isset($manufacVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $manufacVo->name, PDO::PARAM_STR);
}

if (isset($manufacVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $manufacVo->image, PDO::PARAM_STR);
}

$conditions.=' where `manufac_id`= :manufacId';
$params[]=array(':manufacId', $manufacId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (manufacId)
	 * Example
	 * getValueByPrimaryKey('manufacName', 1)
	 * Get value of filed manufacName in table manufac where manufacId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$manufacVo = $this->selectByPrimaryKey($primaryValue);
		if($manufacVo){
			return $manufacVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('manufacName', array('manufacId' => 1))
	 * Get value of filed manufacName in table manufac where manufacId = 1
	 */
	public function getValueByField($fieldName, $where){
		$manufacVo = new ManufacVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$manufacVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$manufacVos = $this->selectByFilter($manufacVo);
       
		if($manufacVos){
			$manufacVo = $manufacVos[0];
			return $manufacVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table manufac
	 *
	 * @param int $manufac_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($manufacId){
		try {
		    $sql = "DELETE FROM `manufac` where `manufac_id` = :manufacId";
		    $params = array();
		    $params[] = array(':manufacId', $manufacId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table manufac
	 *
	 * @param object $manufacVo
	 * @return boolean
	 */
	public function deleteByFilter($manufacVo){
		try {
			$sql = 'DELETE FROM `manufac`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($manufacVo->manufacId)){
				$isDel = true;
				$condition[] = '`manufac_id` = :manufacId';
				$params[] = array(':manufacId', $manufacVo->manufacId, PDO::PARAM_INT);
			}
			if (!is_null($manufacVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $manufacVo->name, PDO::PARAM_STR);
			}
			if (!is_null($manufacVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $manufacVo->image, PDO::PARAM_STR);
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
