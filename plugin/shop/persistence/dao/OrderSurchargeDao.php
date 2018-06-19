<?php
class OrderSurchargeDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_surcharge`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderSurchargeVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderSurchargeId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_surcharge` where `order_surcharge_id` = :orderSurchargeId");
$stmt->bindParam(':orderSurchargeId',$orderSurchargeId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderSurchargeVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderSurchargeVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_surcharge`( `order_id`, `code`, `name`, `value`)
VALUES( :orderId, :code, :name, :value)");
$stmt->bindParam(':orderId', $orderSurchargeVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':code', $orderSurchargeVo->code, PDO::PARAM_STR);
$stmt->bindParam(':name', $orderSurchargeVo->name, PDO::PARAM_STR);
$stmt->bindParam(':value', $orderSurchargeVo->value, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderSurchargeVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_surcharge`( `order_id`, `code`, `name`, `value`)
VALUES( :orderId, :code, :name, :value)");
$stmt->bindParam(':orderId', $orderSurchargeVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':code', $orderSurchargeVo->code, PDO::PARAM_STR);
$stmt->bindParam(':name', $orderSurchargeVo->name, PDO::PARAM_STR);
$stmt->bindParam(':value', $orderSurchargeVo->value, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_surcharge by $orderSurchargeVo object filter use paging
 * 
 * @param object $orderSurchargeVo is order_surcharge object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderSurchargeVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderSurchargeVo)) $orderSurchargeVo = new OrderSurchargeVo();
$sql = "select * from `order_surcharge` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderSurchargeVo->orderSurchargeId)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->orderSurchargeId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_surcharge_id` $key :orderSurchargeIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_surcharge_id` $key :orderSurchargeIdKey";
}
if($type == 'str') {
    $params[] = array(':orderSurchargeIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderSurchargeIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_surcharge_id` =  :orderSurchargeIdKey';
$isFirst=false;
}else{
$condition.=' and `order_surcharge_id` =  :orderSurchargeIdKey';
}
$params[]=array(':orderSurchargeIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderSurchargeVo->orderId)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->orderId;
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

if (!is_null($orderSurchargeVo->code)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->code;
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

if (!is_null($orderSurchargeVo->name)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->name;
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

if (!is_null($orderSurchargeVo->value)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->value;
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
return PersistentHelper::mapResult('OrderSurchargeVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderSurchargeVo){
try {
if (empty($orderSurchargeVo)) $orderSurchargeVo = new OrderSurchargeVo();
$sql = "select count(*) as total from  order_surcharge ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderSurchargeVo->orderSurchargeId)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->orderSurchargeId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_surcharge_id` $key :orderSurchargeIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_surcharge_id` $key :orderSurchargeIdKey";
}
if($type == 'str') {
    $params[] = array(':orderSurchargeIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderSurchargeIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_surcharge_id` =  :orderSurchargeIdKey';
$isFirst=false;
}else{
$condition.=' and `order_surcharge_id` =  :orderSurchargeIdKey';
}
$params[]=array(':orderSurchargeIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderSurchargeVo->orderId)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->orderId;
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

if (!is_null($orderSurchargeVo->code)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->code;
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

if (!is_null($orderSurchargeVo->name)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->name;
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

if (!is_null($orderSurchargeVo->value)){ //If isset Vo->element
$fieldValue=$orderSurchargeVo->value;
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


public function updateByPrimaryKey($orderSurchargeVo,$orderSurchargeId){
try {
$sql="UPDATE `order_surcharge` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderSurchargeVo->orderSurchargeId)){
if ($isFirst){
$updateFields.=' `order_surcharge_id`= :orderSurchargeId';
$isFirst=false;}else{
$updateFields.=', `order_surcharge_id`= :orderSurchargeId';
}
$params[]=array(':orderSurchargeId', $orderSurchargeVo->orderSurchargeId, PDO::PARAM_INT);
}

if (isset($orderSurchargeVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $orderSurchargeVo->orderId, PDO::PARAM_INT);
}

if (isset($orderSurchargeVo->code)){
if ($isFirst){
$updateFields.=' `code`= :code';
$isFirst=false;}else{
$updateFields.=', `code`= :code';
}
$params[]=array(':code', $orderSurchargeVo->code, PDO::PARAM_STR);
}

if (isset($orderSurchargeVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $orderSurchargeVo->name, PDO::PARAM_STR);
}

if (isset($orderSurchargeVo->value)){
if ($isFirst){
$updateFields.=' `value`= :value';
$isFirst=false;}else{
$updateFields.=', `value`= :value';
}
$params[]=array(':value', $orderSurchargeVo->value, PDO::PARAM_STR);
}

$conditions.=' where `order_surcharge_id`= :orderSurchargeId';
$params[]=array(':orderSurchargeId', $orderSurchargeId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (orderSurchargeId)
	 * Example
	 * getValueByPrimaryKey('orderSurchargeName', 1)
	 * Get value of filed orderSurchargeName in table orderSurcharge where orderSurchargeId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderSurchargeVo = $this->selectByPrimaryKey($primaryValue);
		if($orderSurchargeVo){
			return $orderSurchargeVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderSurchargeName', array('orderSurchargeId' => 1))
	 * Get value of filed orderSurchargeName in table orderSurcharge where orderSurchargeId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderSurchargeVo = new OrderSurchargeVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderSurchargeVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderSurchargeVos = $this->selectByFilter($orderSurchargeVo);
       
		if($orderSurchargeVos){
			$orderSurchargeVo = $orderSurchargeVos[0];
			return $orderSurchargeVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_surcharge
	 *
	 * @param int $order_surcharge_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderSurchargeId){
		try {
		    $sql = "DELETE FROM `order_surcharge` where `order_surcharge_id` = :orderSurchargeId";
		    $params = array();
		    $params[] = array(':orderSurchargeId', $orderSurchargeId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table order_surcharge
	 *
	 * @param object $orderSurchargeVo
	 * @return boolean
	 */
	public function deleteByFilter($orderSurchargeVo){
		try {
			$sql = 'DELETE FROM `order_surcharge`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderSurchargeVo->orderSurchargeId)){
				$isDel = true;
				$condition[] = '`order_surcharge_id` = :orderSurchargeId';
				$params[] = array(':orderSurchargeId', $orderSurchargeVo->orderSurchargeId, PDO::PARAM_INT);
			}
			if (!is_null($orderSurchargeVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $orderSurchargeVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($orderSurchargeVo->code)){
				$isDel = true;
				$condition[] = '`code` = :code';
				$params[] = array(':code', $orderSurchargeVo->code, PDO::PARAM_STR);
			}
			if (!is_null($orderSurchargeVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $orderSurchargeVo->name, PDO::PARAM_STR);
			}
			if (!is_null($orderSurchargeVo->value)){
				$isDel = true;
				$condition[] = '`value` = :value';
				$params[] = array(':value', $orderSurchargeVo->value, PDO::PARAM_STR);
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
