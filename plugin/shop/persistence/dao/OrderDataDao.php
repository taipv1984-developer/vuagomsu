<?php
class OrderDataDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_data`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderDataVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderDataId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_data` where `order_data_id` = :orderDataId");
$stmt->bindParam(':orderDataId',$orderDataId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderDataVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderDataVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_data`( `order_id`, `data`)
VALUES( :orderId, :data)");
$stmt->bindParam(':orderId', $orderDataVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':data', $orderDataVo->data, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderDataVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_data`( `order_id`, `data`)
VALUES( :orderId, :data)");
$stmt->bindParam(':orderId', $orderDataVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':data', $orderDataVo->data, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_data by $orderDataVo object filter use paging
 * 
 * @param object $orderDataVo is order_data object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderDataVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderDataVo)) $orderDataVo = new OrderDataVo();
$sql = "select * from `order_data` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderDataVo->orderDataId)){ //If isset Vo->element
$fieldValue=$orderDataVo->orderDataId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_data_id` $key :orderDataIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_data_id` $key :orderDataIdKey";
}
if($type == 'str') {
    $params[] = array(':orderDataIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderDataIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_data_id` =  :orderDataIdKey';
$isFirst=false;
}else{
$condition.=' and `order_data_id` =  :orderDataIdKey';
}
$params[]=array(':orderDataIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderDataVo->orderId)){ //If isset Vo->element
$fieldValue=$orderDataVo->orderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_id` $key :orderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_id` $key :orderIdKey";
}
if($type == 'str') {
    $params[] = array(':orderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_id` =  :orderIdKey';
$isFirst=false;
}else{
$condition.=' and `order_id` =  :orderIdKey';
}
$params[]=array(':orderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderDataVo->data)){ //If isset Vo->element
$fieldValue=$orderDataVo->data;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `data` $key :dataKey";
    $isFirst = false;
} else {
    $condition .= " and `data` $key :dataKey";
}
if($type == 'str') {
    $params[] = array(':dataKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dataKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `data` =  :dataKey';
$isFirst=false;
}else{
$condition.=' and `data` =  :dataKey';
}
$params[]=array(':dataKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('OrderDataVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderDataVo){
try {
if (empty($orderDataVo)) $orderDataVo = new OrderDataVo();
$sql = "select count(*) as total from  order_data ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderDataVo->orderDataId)){ //If isset Vo->element
$fieldValue=$orderDataVo->orderDataId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_data_id` $key :orderDataIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_data_id` $key :orderDataIdKey";
}
if($type == 'str') {
    $params[] = array(':orderDataIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderDataIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_data_id` =  :orderDataIdKey';
$isFirst=false;
}else{
$condition.=' and `order_data_id` =  :orderDataIdKey';
}
$params[]=array(':orderDataIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderDataVo->orderId)){ //If isset Vo->element
$fieldValue=$orderDataVo->orderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_id` $key :orderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_id` $key :orderIdKey";
}
if($type == 'str') {
    $params[] = array(':orderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_id` =  :orderIdKey';
$isFirst=false;
}else{
$condition.=' and `order_id` =  :orderIdKey';
}
$params[]=array(':orderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderDataVo->data)){ //If isset Vo->element
$fieldValue=$orderDataVo->data;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `data` $key :dataKey";
    $isFirst = false;
} else {
    $condition .= " and `data` $key :dataKey";
}
if($type == 'str') {
    $params[] = array(':dataKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dataKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `data` =  :dataKey';
$isFirst=false;
}else{
$condition.=' and `data` =  :dataKey';
}
$params[]=array(':dataKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($orderDataVo,$orderDataId){
try {
$sql="UPDATE `order_data` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderDataVo->orderDataId)){
if ($isFirst){
$updateFields.=' `order_data_id`= :orderDataId';
$isFirst=false;}else{
$updateFields.=', `order_data_id`= :orderDataId';
}
$params[]=array(':orderDataId', $orderDataVo->orderDataId, PDO::PARAM_INT);
}

if (isset($orderDataVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $orderDataVo->orderId, PDO::PARAM_INT);
}

if (isset($orderDataVo->data)){
if ($isFirst){
$updateFields.=' `data`= :data';
$isFirst=false;}else{
$updateFields.=', `data`= :data';
}
$params[]=array(':data', $orderDataVo->data, PDO::PARAM_STR);
}

$conditions.=' where `order_data_id`= :orderDataId';
$params[]=array(':orderDataId', $orderDataId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (orderDataId)
	 * Example
	 * getValueByPrimaryKey('orderDataName', 1)
	 * Get value of filed orderDataName in table orderData where orderDataId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderDataVo = $this->selectByPrimaryKey($primaryValue);
		if($orderDataVo){
			return $orderDataVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderDataName', array('orderDataId' => 1))
	 * Get value of filed orderDataName in table orderData where orderDataId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderDataVo = new OrderDataVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderDataVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderDataVos = $this->selectByFilter($orderDataVo);
       
		if($orderDataVos){
			$orderDataVo = $orderDataVos[0];
			return $orderDataVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_data
	 *
	 * @param int $order_data_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderDataId){
		try {
		    $sql = "DELETE FROM `order_data` where `order_data_id` = :orderDataId";
		    $params = array();
		    $params[] = array(':orderDataId', $orderDataId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table order_data
	 *
	 * @param object $orderDataVo
	 * @return boolean
	 */
	public function deleteByFilter($orderDataVo){
		try {
			$sql = 'DELETE FROM `order_data`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderDataVo->orderDataId)){
				$isDel = true;
				$condition[] = '`order_data_id` = :orderDataId';
				$params[] = array(':orderDataId', $orderDataVo->orderDataId, PDO::PARAM_INT);
			}
			if (!is_null($orderDataVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $orderDataVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($orderDataVo->data)){
				$isDel = true;
				$condition[] = '`data` = :data';
				$params[] = array(':data', $orderDataVo->data, PDO::PARAM_STR);
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
