<?php
class OrderHistoryDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `order_history`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrderHistoryVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderHistoryId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `order_history` where `order_history_id` = :orderHistoryId");
$stmt->bindParam(':orderHistoryId',$orderHistoryId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrderHistoryVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($orderHistoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_history`( `order_id`, `content`, `comment`, `crt_by`, `crt_date`)
VALUES( :orderId, :content, :comment, :crtBy, :crtDate)");
$stmt->bindParam(':orderId', $orderHistoryVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':content', $orderHistoryVo->content, PDO::PARAM_STR);
$stmt->bindParam(':comment', $orderHistoryVo->comment, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $orderHistoryVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $orderHistoryVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($orderHistoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `order_history`( `order_id`, `content`, `comment`, `crt_by`, `crt_date`)
VALUES( :orderId, :content, :comment, :crtBy, :crtDate)");
$stmt->bindParam(':orderId', $orderHistoryVo->orderId, PDO::PARAM_INT);
$stmt->bindParam(':content', $orderHistoryVo->content, PDO::PARAM_STR);
$stmt->bindParam(':comment', $orderHistoryVo->comment, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $orderHistoryVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $orderHistoryVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table order_history by $orderHistoryVo object filter use paging
 * 
 * @param object $orderHistoryVo is order_history object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($orderHistoryVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($orderHistoryVo)) $orderHistoryVo = new OrderHistoryVo();
$sql = "select * from `order_history` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderHistoryVo->orderHistoryId)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->orderHistoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_history_id` $key :orderHistoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_history_id` $key :orderHistoryIdKey";
}
if($type == 'str') {
    $params[] = array(':orderHistoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderHistoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_history_id` =  :orderHistoryIdKey';
$isFirst=false;
}else{
$condition.=' and `order_history_id` =  :orderHistoryIdKey';
}
$params[]=array(':orderHistoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderHistoryVo->orderId)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->orderId;
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

if (!is_null($orderHistoryVo->content)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderHistoryVo->comment)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->comment;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `comment` $key :commentKey";
    $isFirst = false;
} else {
    $condition .= " and `comment` $key :commentKey";
}
if($type == 'str') {
    $params[] = array(':commentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':commentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `comment` =  :commentKey';
$isFirst=false;
}else{
$condition.=' and `comment` =  :commentKey';
}
$params[]=array(':commentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderHistoryVo->crtBy)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->crtBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_by` $key :crtByKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_by` $key :crtByKey";
}
if($type == 'str') {
    $params[] = array(':crtByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_by` =  :crtByKey';
$isFirst=false;
}else{
$condition.=' and `crt_by` =  :crtByKey';
}
$params[]=array(':crtByKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderHistoryVo->crtDate)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->crtDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_date` $key :crtDateKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_date` $key :crtDateKey";
}
if($type == 'str') {
    $params[] = array(':crtDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_date` =  :crtDateKey';
$isFirst=false;
}else{
$condition.=' and `crt_date` =  :crtDateKey';
}
$params[]=array(':crtDateKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('OrderHistoryVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($orderHistoryVo){
try {
if (empty($orderHistoryVo)) $orderHistoryVo = new OrderHistoryVo();
$sql = "select count(*) as total from  order_history ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($orderHistoryVo->orderHistoryId)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->orderHistoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_history_id` $key :orderHistoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_history_id` $key :orderHistoryIdKey";
}
if($type == 'str') {
    $params[] = array(':orderHistoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderHistoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_history_id` =  :orderHistoryIdKey';
$isFirst=false;
}else{
$condition.=' and `order_history_id` =  :orderHistoryIdKey';
}
$params[]=array(':orderHistoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderHistoryVo->orderId)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->orderId;
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

if (!is_null($orderHistoryVo->content)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderHistoryVo->comment)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->comment;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `comment` $key :commentKey";
    $isFirst = false;
} else {
    $condition .= " and `comment` $key :commentKey";
}
if($type == 'str') {
    $params[] = array(':commentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':commentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `comment` =  :commentKey';
$isFirst=false;
}else{
$condition.=' and `comment` =  :commentKey';
}
$params[]=array(':commentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($orderHistoryVo->crtBy)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->crtBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_by` $key :crtByKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_by` $key :crtByKey";
}
if($type == 'str') {
    $params[] = array(':crtByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_by` =  :crtByKey';
$isFirst=false;
}else{
$condition.=' and `crt_by` =  :crtByKey';
}
$params[]=array(':crtByKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($orderHistoryVo->crtDate)){ //If isset Vo->element
$fieldValue=$orderHistoryVo->crtDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_date` $key :crtDateKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_date` $key :crtDateKey";
}
if($type == 'str') {
    $params[] = array(':crtDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_date` =  :crtDateKey';
$isFirst=false;
}else{
$condition.=' and `crt_date` =  :crtDateKey';
}
$params[]=array(':crtDateKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($orderHistoryVo,$orderHistoryId){
try {
$sql="UPDATE `order_history` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($orderHistoryVo->orderHistoryId)){
if ($isFirst){
$updateFields.=' `order_history_id`= :orderHistoryId';
$isFirst=false;}else{
$updateFields.=', `order_history_id`= :orderHistoryId';
}
$params[]=array(':orderHistoryId', $orderHistoryVo->orderHistoryId, PDO::PARAM_INT);
}

if (isset($orderHistoryVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $orderHistoryVo->orderId, PDO::PARAM_INT);
}

if (isset($orderHistoryVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $orderHistoryVo->content, PDO::PARAM_STR);
}

if (isset($orderHistoryVo->comment)){
if ($isFirst){
$updateFields.=' `comment`= :comment';
$isFirst=false;}else{
$updateFields.=', `comment`= :comment';
}
$params[]=array(':comment', $orderHistoryVo->comment, PDO::PARAM_STR);
}

if (isset($orderHistoryVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $orderHistoryVo->crtBy, PDO::PARAM_INT);
}

if (isset($orderHistoryVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $orderHistoryVo->crtDate, PDO::PARAM_STR);
}

$conditions.=' where `order_history_id`= :orderHistoryId';
$params[]=array(':orderHistoryId', $orderHistoryId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (orderHistoryId)
	 * Example
	 * getValueByPrimaryKey('orderHistoryName', 1)
	 * Get value of filed orderHistoryName in table orderHistory where orderHistoryId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$orderHistoryVo = $this->selectByPrimaryKey($primaryValue);
		if($orderHistoryVo){
			return $orderHistoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('orderHistoryName', array('orderHistoryId' => 1))
	 * Get value of filed orderHistoryName in table orderHistory where orderHistoryId = 1
	 */
	public function getValueByField($fieldName, $where){
		$orderHistoryVo = new OrderHistoryVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$orderHistoryVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$orderHistoryVos = $this->selectByFilter($orderHistoryVo);
       
		if($orderHistoryVos){
			$orderHistoryVo = $orderHistoryVos[0];
			return $orderHistoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table order_history
	 *
	 * @param int $order_history_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderHistoryId){
		try {
		    $sql = "DELETE FROM `order_history` where `order_history_id` = :orderHistoryId";
		    $params = array();
		    $params[] = array(':orderHistoryId', $orderHistoryId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table order_history
	 *
	 * @param object $orderHistoryVo
	 * @return boolean
	 */
	public function deleteByFilter($orderHistoryVo){
		try {
			$sql = 'DELETE FROM `order_history`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($orderHistoryVo->orderHistoryId)){
				$isDel = true;
				$condition[] = '`order_history_id` = :orderHistoryId';
				$params[] = array(':orderHistoryId', $orderHistoryVo->orderHistoryId, PDO::PARAM_INT);
			}
			if (!is_null($orderHistoryVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $orderHistoryVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($orderHistoryVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $orderHistoryVo->content, PDO::PARAM_STR);
			}
			if (!is_null($orderHistoryVo->comment)){
				$isDel = true;
				$condition[] = '`comment` = :comment';
				$params[] = array(':comment', $orderHistoryVo->comment, PDO::PARAM_STR);
			}
			if (!is_null($orderHistoryVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $orderHistoryVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($orderHistoryVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $orderHistoryVo->crtDate, PDO::PARAM_STR);
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
