<?php
class OrderStatusDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_status`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderStatusVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderStatusId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_status` where `order_status_id` = :orderStatusId");
$stmt->bindParam(':orderStatusId',$orderStatusId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderStatusVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderStatusVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_status`( `name`, `description`, `order`, `is_system`)
VALUES( :name, :description, :order, :isSystem)");
$stmt->bindParam(':name', $orderStatusVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $orderStatusVo->description, PDO::PARAM_STR);
$stmt->bindParam(':order', $orderStatusVo->order, PDO::PARAM_INT);
$stmt->bindParam(':isSystem', $orderStatusVo->isSystem, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderStatusVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_status`( `name`, `description`, `order`, `is_system`)
VALUES( :name, :description, :order, :isSystem)");
$stmt->bindParam(':name', $orderStatusVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $orderStatusVo->description, PDO::PARAM_STR);
$stmt->bindParam(':order', $orderStatusVo->order, PDO::PARAM_INT);
$stmt->bindParam(':isSystem', $orderStatusVo->isSystem, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_status by $orderStatusVo object filter use paging
 * 
 * @param object $orderStatusVo is order_status object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderStatusVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderStatusVo)) $orderStatusVo = new OrderStatusVo();
$sql = "select * from `order_status` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderStatusVo->orderStatusId)){ //If isset Vo->element
$fieldValue=$orderStatusVo->orderStatusId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_status_id` $key :orderStatusIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_status_id` $key :orderStatusIdKey";
}
if($type == 'str') {
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_status_id` =  :orderStatusIdKey';
$isFirst=false;
}else{
$condition.=' and `order_status_id` =  :orderStatusIdKey';
}
$params[]=array(':orderStatusIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderStatusVo->name)){ //If isset Vo->element
$fieldValue=$orderStatusVo->name;
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

if (!is_null($orderStatusVo->description)){ //If isset Vo->element
$fieldValue=$orderStatusVo->description;
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

if (!is_null($orderStatusVo->order)){ //If isset Vo->element
$fieldValue=$orderStatusVo->order;
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

if (!is_null($orderStatusVo->isSystem)){ //If isset Vo->element
$fieldValue=$orderStatusVo->isSystem;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_system` $key :isSystemKey";
    $isFirst = false;
} else {
    $condition .= " and `is_system` $key :isSystemKey";
}
if($type == 'str') {
    $params[] = array(':isSystemKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isSystemKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_system` =  :isSystemKey';
$isFirst=false;
}else{
$condition.=' and `is_system` =  :isSystemKey';
}
$params[]=array(':isSystemKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('OrderStatusVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderStatusVo){
try {
if (empty($orderStatusVo)) $orderStatusVo = new OrderStatusVo();
$sql = "select count(*) as total from  order_status ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderStatusVo->orderStatusId)){ //If isset Vo->element
$fieldValue=$orderStatusVo->orderStatusId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_status_id` $key :orderStatusIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_status_id` $key :orderStatusIdKey";
}
if($type == 'str') {
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_status_id` =  :orderStatusIdKey';
$isFirst=false;
}else{
$condition.=' and `order_status_id` =  :orderStatusIdKey';
}
$params[]=array(':orderStatusIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderStatusVo->name)){ //If isset Vo->element
$fieldValue=$orderStatusVo->name;
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

if (!is_null($orderStatusVo->description)){ //If isset Vo->element
$fieldValue=$orderStatusVo->description;
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

if (!is_null($orderStatusVo->order)){ //If isset Vo->element
$fieldValue=$orderStatusVo->order;
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

if (!is_null($orderStatusVo->isSystem)){ //If isset Vo->element
$fieldValue=$orderStatusVo->isSystem;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_system` $key :isSystemKey";
    $isFirst = false;
} else {
    $condition .= " and `is_system` $key :isSystemKey";
}
if($type == 'str') {
    $params[] = array(':isSystemKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isSystemKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_system` =  :isSystemKey';
$isFirst=false;
}else{
$condition.=' and `is_system` =  :isSystemKey';
}
$params[]=array(':isSystemKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($orderStatusVo,$orderStatusId){
try {
$sql="UPDATE `order_status` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderStatusVo->orderStatusId)){
if ($isFirst){
$updateFields.=' `order_status_id`= :orderStatusId';
$isFirst=false;}else{
$updateFields.=', `order_status_id`= :orderStatusId';
}
$params[]=array(':orderStatusId', $orderStatusVo->orderStatusId, PDO::PARAM_INT);
}

if (isset($orderStatusVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $orderStatusVo->name, PDO::PARAM_STR);
}

if (isset($orderStatusVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $orderStatusVo->description, PDO::PARAM_STR);
}

if (isset($orderStatusVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $orderStatusVo->order, PDO::PARAM_INT);
}

if (isset($orderStatusVo->isSystem)){
if ($isFirst){
$updateFields.=' `is_system`= :isSystem';
$isFirst=false;}else{
$updateFields.=', `is_system`= :isSystem';
}
$params[]=array(':isSystem', $orderStatusVo->isSystem, PDO::PARAM_INT);
}

$conditions.=' where `order_status_id`= :orderStatusId';
$params[]=array(':orderStatusId', $orderStatusId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (orderStatusId)
	 * Example
	 * getValueByPrimaryKey('orderStatusName', 1)
	 * Get value of filed orderStatusName in table orderStatus where orderStatusId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderStatusVo = $this->selectByPrimaryKey($primaryValue);
		if($orderStatusVo){
			return $orderStatusVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderStatusName', array('orderStatusId' => 1))
	 * Get value of filed orderStatusName in table orderStatus where orderStatusId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderStatusVo = new OrderStatusVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderStatusVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderStatusVos = $this->selectByFilter($orderStatusVo);
       
		if($orderStatusVos){
			$orderStatusVo = $orderStatusVos[0];
			return $orderStatusVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_status
	 *
	 * @param int $order_status_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderStatusId){
		try {
		    $sql = "DELETE FROM `order_status` where `order_status_id` = :orderStatusId";
		    $params = array();
		    $params[] = array(':orderStatusId', $orderStatusId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table order_status
	 *
	 * @param object $orderStatusVo
	 * @return boolean
	 */
	public function deleteByFilter($orderStatusVo){
		try {
			$sql = 'DELETE FROM `order_status`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderStatusVo->orderStatusId)){
				$isDel = true;
				$condition[] = '`order_status_id` = :orderStatusId';
				$params[] = array(':orderStatusId', $orderStatusVo->orderStatusId, PDO::PARAM_INT);
			}
			if (!is_null($orderStatusVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $orderStatusVo->name, PDO::PARAM_STR);
			}
			if (!is_null($orderStatusVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $orderStatusVo->description, PDO::PARAM_STR);
			}
			if (!is_null($orderStatusVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $orderStatusVo->order, PDO::PARAM_INT);
			}
			if (!is_null($orderStatusVo->isSystem)){
				$isDel = true;
				$condition[] = '`is_system` = :isSystem';
				$params[] = array(':isSystem', $orderStatusVo->isSystem, PDO::PARAM_INT);
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
