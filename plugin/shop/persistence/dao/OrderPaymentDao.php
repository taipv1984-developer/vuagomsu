<?php
class OrderPaymentDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_payment`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderPaymentVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderPaymentId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_payment` where `order_payment_id` = :orderPaymentId");
$stmt->bindParam(':orderPaymentId',$orderPaymentId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderPaymentVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderPaymentVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_payment`( `order_id`, `code`, `name`, `data`, `status`)
VALUES( :orderId, :code, :name, :data, :status)");
$stmt->bindParam(':orderId', $orderPaymentVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':code', $orderPaymentVo->code, PDO::PARAM_STR);
$stmt->bindParam(':name', $orderPaymentVo->name, PDO::PARAM_STR);
$stmt->bindParam(':data', $orderPaymentVo->data, PDO::PARAM_STR);
$stmt->bindParam(':status', $orderPaymentVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderPaymentVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_payment`( `order_id`, `code`, `name`, `data`, `status`)
VALUES( :orderId, :code, :name, :data, :status)");
$stmt->bindParam(':orderId', $orderPaymentVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':code', $orderPaymentVo->code, PDO::PARAM_STR);
$stmt->bindParam(':name', $orderPaymentVo->name, PDO::PARAM_STR);
$stmt->bindParam(':data', $orderPaymentVo->data, PDO::PARAM_STR);
$stmt->bindParam(':status', $orderPaymentVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_payment by $orderPaymentVo object filter use paging
 * 
 * @param object $orderPaymentVo is order_payment object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderPaymentVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderPaymentVo)) $orderPaymentVo = new OrderPaymentVo();
$sql = "select * from `order_payment` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderPaymentVo->orderPaymentId)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->orderPaymentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_payment_id` $key :orderPaymentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_payment_id` $key :orderPaymentIdKey";
}
if($type == 'str') {
    $params[] = array(':orderPaymentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderPaymentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_payment_id` =  :orderPaymentIdKey';
$isFirst=false;
}else{
$condition.=' and `order_payment_id` =  :orderPaymentIdKey';
}
$params[]=array(':orderPaymentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderPaymentVo->orderId)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->orderId;
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

if (!is_null($orderPaymentVo->code)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->code;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `code` $key :codeKey";
    $isFirst = false;
} else {
    $condition .= " and `code` $key :codeKey";
}
if($type == 'str') {
    $params[] = array(':codeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':codeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `code` =  :codeKey';
$isFirst=false;
}else{
$condition.=' and `code` =  :codeKey';
}
$params[]=array(':codeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderPaymentVo->name)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->name;
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

if (!is_null($orderPaymentVo->data)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->data;
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

if (!is_null($orderPaymentVo->status)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->status;
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
return PersistentHelper::mapResult('OrderPaymentVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderPaymentVo){
try {
if (empty($orderPaymentVo)) $orderPaymentVo = new OrderPaymentVo();
$sql = "select count(*) as total from  order_payment ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderPaymentVo->orderPaymentId)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->orderPaymentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_payment_id` $key :orderPaymentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_payment_id` $key :orderPaymentIdKey";
}
if($type == 'str') {
    $params[] = array(':orderPaymentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderPaymentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_payment_id` =  :orderPaymentIdKey';
$isFirst=false;
}else{
$condition.=' and `order_payment_id` =  :orderPaymentIdKey';
}
$params[]=array(':orderPaymentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderPaymentVo->orderId)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->orderId;
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

if (!is_null($orderPaymentVo->code)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->code;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `code` $key :codeKey";
    $isFirst = false;
} else {
    $condition .= " and `code` $key :codeKey";
}
if($type == 'str') {
    $params[] = array(':codeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':codeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `code` =  :codeKey';
$isFirst=false;
}else{
$condition.=' and `code` =  :codeKey';
}
$params[]=array(':codeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderPaymentVo->name)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->name;
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

if (!is_null($orderPaymentVo->data)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->data;
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

if (!is_null($orderPaymentVo->status)){ //If isset Vo->element
$fieldValue=$orderPaymentVo->status;
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


public function updateByPrimaryKey($orderPaymentVo,$orderPaymentId){
try {
$sql="UPDATE `order_payment` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderPaymentVo->orderPaymentId)){
if ($isFirst){
$updateFields.=' `order_payment_id`= :orderPaymentId';
$isFirst=false;}else{
$updateFields.=', `order_payment_id`= :orderPaymentId';
}
$params[]=array(':orderPaymentId', $orderPaymentVo->orderPaymentId, PDO::PARAM_INT);
}

if (isset($orderPaymentVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $orderPaymentVo->orderId, PDO::PARAM_INT);
}

if (isset($orderPaymentVo->code)){
if ($isFirst){
$updateFields.=' `code`= :code';
$isFirst=false;}else{
$updateFields.=', `code`= :code';
}
$params[]=array(':code', $orderPaymentVo->code, PDO::PARAM_STR);
}

if (isset($orderPaymentVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $orderPaymentVo->name, PDO::PARAM_STR);
}

if (isset($orderPaymentVo->data)){
if ($isFirst){
$updateFields.=' `data`= :data';
$isFirst=false;}else{
$updateFields.=', `data`= :data';
}
$params[]=array(':data', $orderPaymentVo->data, PDO::PARAM_STR);
}

if (isset($orderPaymentVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $orderPaymentVo->status, PDO::PARAM_STR);
}

$conditions.=' where `order_payment_id`= :orderPaymentId';
$params[]=array(':orderPaymentId', $orderPaymentId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (orderPaymentId)
	 * Example
	 * getValueByPrimaryKey('orderPaymentName', 1)
	 * Get value of filed orderPaymentName in table orderPayment where orderPaymentId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderPaymentVo = $this->selectByPrimaryKey($primaryValue);
		if($orderPaymentVo){
			return $orderPaymentVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderPaymentName', array('orderPaymentId' => 1))
	 * Get value of filed orderPaymentName in table orderPayment where orderPaymentId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderPaymentVo = new OrderPaymentVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderPaymentVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderPaymentVos = $this->selectByFilter($orderPaymentVo);
       
		if($orderPaymentVos){
			$orderPaymentVo = $orderPaymentVos[0];
			return $orderPaymentVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_payment
	 *
	 * @param int $order_payment_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderPaymentId){
		try {
		    $sql = "DELETE FROM `order_payment` where `order_payment_id` = :orderPaymentId";
		    $params = array();
		    $params[] = array(':orderPaymentId', $orderPaymentId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table order_payment
	 *
	 * @param object $orderPaymentVo
	 * @return boolean
	 */
	public function deleteByFilter($orderPaymentVo){
		try {
			$sql = 'DELETE FROM `order_payment`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderPaymentVo->orderPaymentId)){
				$isDel = true;
				$condition[] = '`order_payment_id` = :orderPaymentId';
				$params[] = array(':orderPaymentId', $orderPaymentVo->orderPaymentId, PDO::PARAM_INT);
			}
			if (!is_null($orderPaymentVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $orderPaymentVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($orderPaymentVo->code)){
				$isDel = true;
				$condition[] = '`code` = :code';
				$params[] = array(':code', $orderPaymentVo->code, PDO::PARAM_STR);
			}
			if (!is_null($orderPaymentVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $orderPaymentVo->name, PDO::PARAM_STR);
			}
			if (!is_null($orderPaymentVo->data)){
				$isDel = true;
				$condition[] = '`data` = :data';
				$params[] = array(':data', $orderPaymentVo->data, PDO::PARAM_STR);
			}
			if (!is_null($orderPaymentVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $orderPaymentVo->status, PDO::PARAM_STR);
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
