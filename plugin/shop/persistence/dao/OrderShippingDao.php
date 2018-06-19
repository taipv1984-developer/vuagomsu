<?php
class OrderShippingDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_shipping`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderShippingVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderShippingId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_shipping` where `order_shipping_id` = :orderShippingId");
$stmt->bindParam(':orderShippingId',$orderShippingId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderShippingVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderShippingVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_shipping`( `order_id`, `code`, `name`, `data`, `value`, `status`)
VALUES( :orderId, :code, :name, :data, :value, :status)");
$stmt->bindParam(':orderId', $orderShippingVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':code', $orderShippingVo->code, PDO::PARAM_STR);
$stmt->bindParam(':name', $orderShippingVo->name, PDO::PARAM_STR);
$stmt->bindParam(':data', $orderShippingVo->data, PDO::PARAM_STR);
$stmt->bindParam(':value', $orderShippingVo->value, PDO::PARAM_STR);
$stmt->bindParam(':status', $orderShippingVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderShippingVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_shipping`( `order_id`, `code`, `name`, `data`, `value`, `status`)
VALUES( :orderId, :code, :name, :data, :value, :status)");
$stmt->bindParam(':orderId', $orderShippingVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':code', $orderShippingVo->code, PDO::PARAM_STR);
$stmt->bindParam(':name', $orderShippingVo->name, PDO::PARAM_STR);
$stmt->bindParam(':data', $orderShippingVo->data, PDO::PARAM_STR);
$stmt->bindParam(':value', $orderShippingVo->value, PDO::PARAM_STR);
$stmt->bindParam(':status', $orderShippingVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_shipping by $orderShippingVo object filter use paging
 * 
 * @param object $orderShippingVo is order_shipping object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderShippingVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderShippingVo)) $orderShippingVo = new OrderShippingVo();
$sql = "select * from `order_shipping` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderShippingVo->orderShippingId)){ //If isset Vo->element
$fieldValue=$orderShippingVo->orderShippingId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_shipping_id` $key :orderShippingIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_shipping_id` $key :orderShippingIdKey";
}
if($type == 'str') {
    $params[] = array(':orderShippingIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderShippingIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_shipping_id` =  :orderShippingIdKey';
$isFirst=false;
}else{
$condition.=' and `order_shipping_id` =  :orderShippingIdKey';
}
$params[]=array(':orderShippingIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderShippingVo->orderId)){ //If isset Vo->element
$fieldValue=$orderShippingVo->orderId;
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

if (!is_null($orderShippingVo->code)){ //If isset Vo->element
$fieldValue=$orderShippingVo->code;
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

if (!is_null($orderShippingVo->name)){ //If isset Vo->element
$fieldValue=$orderShippingVo->name;
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

if (!is_null($orderShippingVo->data)){ //If isset Vo->element
$fieldValue=$orderShippingVo->data;
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

if (!is_null($orderShippingVo->value)){ //If isset Vo->element
$fieldValue=$orderShippingVo->value;
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

if (!is_null($orderShippingVo->status)){ //If isset Vo->element
$fieldValue=$orderShippingVo->status;
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
return PersistentHelper::mapResult('OrderShippingVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderShippingVo){
try {
if (empty($orderShippingVo)) $orderShippingVo = new OrderShippingVo();
$sql = "select count(*) as total from  order_shipping ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderShippingVo->orderShippingId)){ //If isset Vo->element
$fieldValue=$orderShippingVo->orderShippingId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_shipping_id` $key :orderShippingIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_shipping_id` $key :orderShippingIdKey";
}
if($type == 'str') {
    $params[] = array(':orderShippingIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderShippingIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_shipping_id` =  :orderShippingIdKey';
$isFirst=false;
}else{
$condition.=' and `order_shipping_id` =  :orderShippingIdKey';
}
$params[]=array(':orderShippingIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderShippingVo->orderId)){ //If isset Vo->element
$fieldValue=$orderShippingVo->orderId;
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

if (!is_null($orderShippingVo->code)){ //If isset Vo->element
$fieldValue=$orderShippingVo->code;
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

if (!is_null($orderShippingVo->name)){ //If isset Vo->element
$fieldValue=$orderShippingVo->name;
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

if (!is_null($orderShippingVo->data)){ //If isset Vo->element
$fieldValue=$orderShippingVo->data;
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

if (!is_null($orderShippingVo->value)){ //If isset Vo->element
$fieldValue=$orderShippingVo->value;
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

if (!is_null($orderShippingVo->status)){ //If isset Vo->element
$fieldValue=$orderShippingVo->status;
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


public function updateByPrimaryKey($orderShippingVo,$orderShippingId){
try {
$sql="UPDATE `order_shipping` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderShippingVo->orderShippingId)){
if ($isFirst){
$updateFields.=' `order_shipping_id`= :orderShippingId';
$isFirst=false;}else{
$updateFields.=', `order_shipping_id`= :orderShippingId';
}
$params[]=array(':orderShippingId', $orderShippingVo->orderShippingId, PDO::PARAM_INT);
}

if (isset($orderShippingVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $orderShippingVo->orderId, PDO::PARAM_INT);
}

if (isset($orderShippingVo->code)){
if ($isFirst){
$updateFields.=' `code`= :code';
$isFirst=false;}else{
$updateFields.=', `code`= :code';
}
$params[]=array(':code', $orderShippingVo->code, PDO::PARAM_STR);
}

if (isset($orderShippingVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $orderShippingVo->name, PDO::PARAM_STR);
}

if (isset($orderShippingVo->data)){
if ($isFirst){
$updateFields.=' `data`= :data';
$isFirst=false;}else{
$updateFields.=', `data`= :data';
}
$params[]=array(':data', $orderShippingVo->data, PDO::PARAM_STR);
}

if (isset($orderShippingVo->value)){
if ($isFirst){
$updateFields.=' `value`= :value';
$isFirst=false;}else{
$updateFields.=', `value`= :value';
}
$params[]=array(':value', $orderShippingVo->value, PDO::PARAM_STR);
}

if (isset($orderShippingVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $orderShippingVo->status, PDO::PARAM_STR);
}

$conditions.=' where `order_shipping_id`= :orderShippingId';
$params[]=array(':orderShippingId', $orderShippingId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (orderShippingId)
	 * Example
	 * getValueByPrimaryKey('orderShippingName', 1)
	 * Get value of filed orderShippingName in table orderShipping where orderShippingId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderShippingVo = $this->selectByPrimaryKey($primaryValue);
		if($orderShippingVo){
			return $orderShippingVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderShippingName', array('orderShippingId' => 1))
	 * Get value of filed orderShippingName in table orderShipping where orderShippingId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderShippingVo = new OrderShippingVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderShippingVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderShippingVos = $this->selectByFilter($orderShippingVo);
       
		if($orderShippingVos){
			$orderShippingVo = $orderShippingVos[0];
			return $orderShippingVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_shipping
	 *
	 * @param int $order_shipping_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderShippingId){
		try {
		    $sql = "DELETE FROM `order_shipping` where `order_shipping_id` = :orderShippingId";
		    $params = array();
		    $params[] = array(':orderShippingId', $orderShippingId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table order_shipping
	 *
	 * @param object $orderShippingVo
	 * @return boolean
	 */
	public function deleteByFilter($orderShippingVo){
		try {
			$sql = 'DELETE FROM `order_shipping`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderShippingVo->orderShippingId)){
				$isDel = true;
				$condition[] = '`order_shipping_id` = :orderShippingId';
				$params[] = array(':orderShippingId', $orderShippingVo->orderShippingId, PDO::PARAM_INT);
			}
			if (!is_null($orderShippingVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $orderShippingVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($orderShippingVo->code)){
				$isDel = true;
				$condition[] = '`code` = :code';
				$params[] = array(':code', $orderShippingVo->code, PDO::PARAM_STR);
			}
			if (!is_null($orderShippingVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $orderShippingVo->name, PDO::PARAM_STR);
			}
			if (!is_null($orderShippingVo->data)){
				$isDel = true;
				$condition[] = '`data` = :data';
				$params[] = array(':data', $orderShippingVo->data, PDO::PARAM_STR);
			}
			if (!is_null($orderShippingVo->value)){
				$isDel = true;
				$condition[] = '`value` = :value';
				$params[] = array(':value', $orderShippingVo->value, PDO::PARAM_STR);
			}
			if (!is_null($orderShippingVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $orderShippingVo->status, PDO::PARAM_STR);
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
