<?php
class CheckoutDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `checkout`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CheckoutVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($checkoutId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `checkout` where `checkout_id` = :checkoutId");
$stmt->bindParam(':checkoutId',$checkoutId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CheckoutVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($checkoutVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `checkout`( `checkout_type`, `checkout_code`, `checkout_name`, `order`, `default`, `status`, `is_del`)
VALUES( :checkoutType, :checkoutCode, :checkoutName, :order, :default, :status, :isDel)");
$stmt->bindParam(':checkoutType', $checkoutVo->checkoutType, PDO::PARAM_STR);
$stmt->bindParam(':checkoutCode', $checkoutVo->checkoutCode, PDO::PARAM_STR);
$stmt->bindParam(':checkoutName', $checkoutVo->checkoutName, PDO::PARAM_STR);
$stmt->bindParam(':order', $checkoutVo->order, PDO::PARAM_INT);
$stmt->bindParam(':default', $checkoutVo->default, PDO::PARAM_INT);
$stmt->bindParam(':status', $checkoutVo->status, PDO::PARAM_STR);
$stmt->bindParam(':isDel', $checkoutVo->isDel, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($checkoutVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `checkout`( `checkout_type`, `checkout_code`, `checkout_name`, `order`, `default`, `status`, `is_del`)
VALUES( :checkoutType, :checkoutCode, :checkoutName, :order, :default, :status, :isDel)");
$stmt->bindParam(':checkoutType', $checkoutVo->checkoutType, PDO::PARAM_STR);
$stmt->bindParam(':checkoutCode', $checkoutVo->checkoutCode, PDO::PARAM_STR);
$stmt->bindParam(':checkoutName', $checkoutVo->checkoutName, PDO::PARAM_STR);
$stmt->bindParam(':order', $checkoutVo->order, PDO::PARAM_INT);
$stmt->bindParam(':default', $checkoutVo->default, PDO::PARAM_INT);
$stmt->bindParam(':status', $checkoutVo->status, PDO::PARAM_STR);
$stmt->bindParam(':isDel', $checkoutVo->isDel, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table checkout by $checkoutVo object filter use paging
 * 
 * @param object $checkoutVo is checkout object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($checkoutVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($checkoutVo)) $checkoutVo = new CheckoutVo();
$sql = "select * from `checkout` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($checkoutVo->checkoutId)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_id` $key :checkoutIdKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_id` $key :checkoutIdKey";
}
if($type == 'str') {
    $params[] = array(':checkoutIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_id` =  :checkoutIdKey';
$isFirst=false;
}else{
$condition.=' and `checkout_id` =  :checkoutIdKey';
}
$params[]=array(':checkoutIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($checkoutVo->checkoutType)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_type` $key :checkoutTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_type` $key :checkoutTypeKey";
}
if($type == 'str') {
    $params[] = array(':checkoutTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_type` =  :checkoutTypeKey';
$isFirst=false;
}else{
$condition.=' and `checkout_type` =  :checkoutTypeKey';
}
$params[]=array(':checkoutTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutVo->checkoutCode)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_code` $key :checkoutCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_code` $key :checkoutCodeKey";
}
if($type == 'str') {
    $params[] = array(':checkoutCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_code` =  :checkoutCodeKey';
$isFirst=false;
}else{
$condition.=' and `checkout_code` =  :checkoutCodeKey';
}
$params[]=array(':checkoutCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutVo->checkoutName)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_name` $key :checkoutNameKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_name` $key :checkoutNameKey";
}
if($type == 'str') {
    $params[] = array(':checkoutNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_name` =  :checkoutNameKey';
$isFirst=false;
}else{
$condition.=' and `checkout_name` =  :checkoutNameKey';
}
$params[]=array(':checkoutNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutVo->order)){ //If isset Vo->element
$fieldValue=$checkoutVo->order;
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

if (!is_null($checkoutVo->default)){ //If isset Vo->element
$fieldValue=$checkoutVo->default;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default` $key :defaultKey";
    $isFirst = false;
} else {
    $condition .= " and `default` $key :defaultKey";
}
if($type == 'str') {
    $params[] = array(':defaultKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default` =  :defaultKey';
$isFirst=false;
}else{
$condition.=' and `default` =  :defaultKey';
}
$params[]=array(':defaultKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($checkoutVo->status)){ //If isset Vo->element
$fieldValue=$checkoutVo->status;
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

if (!is_null($checkoutVo->isDel)){ //If isset Vo->element
$fieldValue=$checkoutVo->isDel;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_del` $key :isDelKey";
    $isFirst = false;
} else {
    $condition .= " and `is_del` $key :isDelKey";
}
if($type == 'str') {
    $params[] = array(':isDelKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isDelKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_del` =  :isDelKey';
$isFirst=false;
}else{
$condition.=' and `is_del` =  :isDelKey';
}
$params[]=array(':isDelKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('CheckoutVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($checkoutVo){
try {
if (empty($checkoutVo)) $checkoutVo = new CheckoutVo();
$sql = "select count(*) as total from  checkout ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($checkoutVo->checkoutId)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_id` $key :checkoutIdKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_id` $key :checkoutIdKey";
}
if($type == 'str') {
    $params[] = array(':checkoutIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_id` =  :checkoutIdKey';
$isFirst=false;
}else{
$condition.=' and `checkout_id` =  :checkoutIdKey';
}
$params[]=array(':checkoutIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($checkoutVo->checkoutType)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_type` $key :checkoutTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_type` $key :checkoutTypeKey";
}
if($type == 'str') {
    $params[] = array(':checkoutTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_type` =  :checkoutTypeKey';
$isFirst=false;
}else{
$condition.=' and `checkout_type` =  :checkoutTypeKey';
}
$params[]=array(':checkoutTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutVo->checkoutCode)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_code` $key :checkoutCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_code` $key :checkoutCodeKey";
}
if($type == 'str') {
    $params[] = array(':checkoutCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_code` =  :checkoutCodeKey';
$isFirst=false;
}else{
$condition.=' and `checkout_code` =  :checkoutCodeKey';
}
$params[]=array(':checkoutCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutVo->checkoutName)){ //If isset Vo->element
$fieldValue=$checkoutVo->checkoutName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_name` $key :checkoutNameKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_name` $key :checkoutNameKey";
}
if($type == 'str') {
    $params[] = array(':checkoutNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_name` =  :checkoutNameKey';
$isFirst=false;
}else{
$condition.=' and `checkout_name` =  :checkoutNameKey';
}
$params[]=array(':checkoutNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutVo->order)){ //If isset Vo->element
$fieldValue=$checkoutVo->order;
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

if (!is_null($checkoutVo->default)){ //If isset Vo->element
$fieldValue=$checkoutVo->default;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default` $key :defaultKey";
    $isFirst = false;
} else {
    $condition .= " and `default` $key :defaultKey";
}
if($type == 'str') {
    $params[] = array(':defaultKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default` =  :defaultKey';
$isFirst=false;
}else{
$condition.=' and `default` =  :defaultKey';
}
$params[]=array(':defaultKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($checkoutVo->status)){ //If isset Vo->element
$fieldValue=$checkoutVo->status;
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

if (!is_null($checkoutVo->isDel)){ //If isset Vo->element
$fieldValue=$checkoutVo->isDel;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_del` $key :isDelKey";
    $isFirst = false;
} else {
    $condition .= " and `is_del` $key :isDelKey";
}
if($type == 'str') {
    $params[] = array(':isDelKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isDelKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_del` =  :isDelKey';
$isFirst=false;
}else{
$condition.=' and `is_del` =  :isDelKey';
}
$params[]=array(':isDelKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($checkoutVo,$checkoutId){
try {
$sql="UPDATE `checkout` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($checkoutVo->checkoutId)){
if ($isFirst){
$updateFields.=' `checkout_id`= :checkoutId';
$isFirst=false;}else{
$updateFields.=', `checkout_id`= :checkoutId';
}
$params[]=array(':checkoutId', $checkoutVo->checkoutId, PDO::PARAM_INT);
}

if (isset($checkoutVo->checkoutType)){
if ($isFirst){
$updateFields.=' `checkout_type`= :checkoutType';
$isFirst=false;}else{
$updateFields.=', `checkout_type`= :checkoutType';
}
$params[]=array(':checkoutType', $checkoutVo->checkoutType, PDO::PARAM_STR);
}

if (isset($checkoutVo->checkoutCode)){
if ($isFirst){
$updateFields.=' `checkout_code`= :checkoutCode';
$isFirst=false;}else{
$updateFields.=', `checkout_code`= :checkoutCode';
}
$params[]=array(':checkoutCode', $checkoutVo->checkoutCode, PDO::PARAM_STR);
}

if (isset($checkoutVo->checkoutName)){
if ($isFirst){
$updateFields.=' `checkout_name`= :checkoutName';
$isFirst=false;}else{
$updateFields.=', `checkout_name`= :checkoutName';
}
$params[]=array(':checkoutName', $checkoutVo->checkoutName, PDO::PARAM_STR);
}

if (isset($checkoutVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $checkoutVo->order, PDO::PARAM_INT);
}

if (isset($checkoutVo->default)){
if ($isFirst){
$updateFields.=' `default`= :default';
$isFirst=false;}else{
$updateFields.=', `default`= :default';
}
$params[]=array(':default', $checkoutVo->default, PDO::PARAM_INT);
}

if (isset($checkoutVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $checkoutVo->status, PDO::PARAM_STR);
}

if (isset($checkoutVo->isDel)){
if ($isFirst){
$updateFields.=' `is_del`= :isDel';
$isFirst=false;}else{
$updateFields.=', `is_del`= :isDel';
}
$params[]=array(':isDel', $checkoutVo->isDel, PDO::PARAM_INT);
}

$conditions.=' where `checkout_id`= :checkoutId';
$params[]=array(':checkoutId', $checkoutId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (checkoutId)
	 * Example
	 * getValueByPrimaryKey('checkoutName', 1)
	 * Get value of filed checkoutName in table checkout where checkoutId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$checkoutVo = $this->selectByPrimaryKey($primaryValue);
		if($checkoutVo){
			return $checkoutVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('checkoutName', array('checkoutId' => 1))
	 * Get value of filed checkoutName in table checkout where checkoutId = 1
	 */
	public function getValueByField($fieldName, $where){
		$checkoutVo = new CheckoutVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$checkoutVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$checkoutVos = $this->selectByFilter($checkoutVo);
       
		if($checkoutVos){
			$checkoutVo = $checkoutVos[0];
			return $checkoutVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table checkout
	 *
	 * @param int $checkout_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($checkoutId){
		try {
		    $sql = "DELETE FROM `checkout` where `checkout_id` = :checkoutId";
		    $params = array();
		    $params[] = array(':checkoutId', $checkoutId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table checkout
	 *
	 * @param object $checkoutVo
	 * @return boolean
	 */
	public function deleteByFilter($checkoutVo){
		try {
			$sql = 'DELETE FROM `checkout`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($checkoutVo->checkoutId)){
				$isDel = true;
				$condition[] = '`checkout_id` = :checkoutId';
				$params[] = array(':checkoutId', $checkoutVo->checkoutId, PDO::PARAM_INT);
			}
			if (!is_null($checkoutVo->checkoutType)){
				$isDel = true;
				$condition[] = '`checkout_type` = :checkoutType';
				$params[] = array(':checkoutType', $checkoutVo->checkoutType, PDO::PARAM_STR);
			}
			if (!is_null($checkoutVo->checkoutCode)){
				$isDel = true;
				$condition[] = '`checkout_code` = :checkoutCode';
				$params[] = array(':checkoutCode', $checkoutVo->checkoutCode, PDO::PARAM_STR);
			}
			if (!is_null($checkoutVo->checkoutName)){
				$isDel = true;
				$condition[] = '`checkout_name` = :checkoutName';
				$params[] = array(':checkoutName', $checkoutVo->checkoutName, PDO::PARAM_STR);
			}
			if (!is_null($checkoutVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $checkoutVo->order, PDO::PARAM_INT);
			}
			if (!is_null($checkoutVo->default)){
				$isDel = true;
				$condition[] = '`default` = :default';
				$params[] = array(':default', $checkoutVo->default, PDO::PARAM_INT);
			}
			if (!is_null($checkoutVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $checkoutVo->status, PDO::PARAM_STR);
			}
			if (!is_null($checkoutVo->isDel)){
				$isDel = true;
				$condition[] = '`is_del` = :isDel';
				$params[] = array(':isDel', $checkoutVo->isDel, PDO::PARAM_INT);
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
