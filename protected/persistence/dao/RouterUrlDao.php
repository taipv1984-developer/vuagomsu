<?php
class RouterUrlDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `router_url`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('RouterUrlVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($routerUrlId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `router_url` where `router_url_id` = :routerUrlId");
$stmt->bindParam(':routerUrlId',$routerUrlId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('RouterUrlVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($routerUrlVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `router_url`( `router_id`, `alias`, `dispatch`, `pk_name`, `pk_value`, `redirect_to`, `is_del`)
VALUES( :routerId, :alias, :dispatch, :pkName, :pkValue, :redirectTo, :isDel)");
$stmt->bindParam(':routerId', $routerUrlVo->routerId, PDO::PARAM_INT);
$stmt->bindParam(':alias', $routerUrlVo->alias, PDO::PARAM_STR);
$stmt->bindParam(':dispatch', $routerUrlVo->dispatch, PDO::PARAM_STR);
$stmt->bindParam(':pkName', $routerUrlVo->pkName, PDO::PARAM_STR);
$stmt->bindParam(':pkValue', $routerUrlVo->pkValue, PDO::PARAM_STR);
$stmt->bindParam(':redirectTo', $routerUrlVo->redirectTo, PDO::PARAM_STR);
$stmt->bindParam(':isDel', $routerUrlVo->isDel, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($routerUrlVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `router_url`( `router_id`, `alias`, `dispatch`, `pk_name`, `pk_value`, `redirect_to`, `is_del`)
VALUES( :routerId, :alias, :dispatch, :pkName, :pkValue, :redirectTo, :isDel)");
$stmt->bindParam(':routerId', $routerUrlVo->routerId, PDO::PARAM_INT);
$stmt->bindParam(':alias', $routerUrlVo->alias, PDO::PARAM_STR);
$stmt->bindParam(':dispatch', $routerUrlVo->dispatch, PDO::PARAM_STR);
$stmt->bindParam(':pkName', $routerUrlVo->pkName, PDO::PARAM_STR);
$stmt->bindParam(':pkValue', $routerUrlVo->pkValue, PDO::PARAM_STR);
$stmt->bindParam(':redirectTo', $routerUrlVo->redirectTo, PDO::PARAM_STR);
$stmt->bindParam(':isDel', $routerUrlVo->isDel, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table router_url by $routerUrlVo object filter use paging
 * 
 * @param object $routerUrlVo is router_url object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($routerUrlVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($routerUrlVo)) $routerUrlVo = new RouterUrlVo();
$sql = "select * from `router_url` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($routerUrlVo->routerUrlId)){ //If isset Vo->element
$fieldValue=$routerUrlVo->routerUrlId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router_url_id` $key :routerUrlIdKey";
    $isFirst = false;
} else {
    $condition .= " and `router_url_id` $key :routerUrlIdKey";
}
if($type == 'str') {
    $params[] = array(':routerUrlIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerUrlIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router_url_id` =  :routerUrlIdKey';
$isFirst=false;
}else{
$condition.=' and `router_url_id` =  :routerUrlIdKey';
}
$params[]=array(':routerUrlIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerUrlVo->routerId)){ //If isset Vo->element
$fieldValue=$routerUrlVo->routerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router_id` $key :routerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `router_id` $key :routerIdKey";
}
if($type == 'str') {
    $params[] = array(':routerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router_id` =  :routerIdKey';
$isFirst=false;
}else{
$condition.=' and `router_id` =  :routerIdKey';
}
$params[]=array(':routerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerUrlVo->alias)){ //If isset Vo->element
$fieldValue=$routerUrlVo->alias;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias` $key :aliasKey";
    $isFirst = false;
} else {
    $condition .= " and `alias` $key :aliasKey";
}
if($type == 'str') {
    $params[] = array(':aliasKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias` =  :aliasKey';
$isFirst=false;
}else{
$condition.=' and `alias` =  :aliasKey';
}
$params[]=array(':aliasKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->dispatch)){ //If isset Vo->element
$fieldValue=$routerUrlVo->dispatch;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `dispatch` $key :dispatchKey";
    $isFirst = false;
} else {
    $condition .= " and `dispatch` $key :dispatchKey";
}
if($type == 'str') {
    $params[] = array(':dispatchKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dispatchKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `dispatch` =  :dispatchKey';
$isFirst=false;
}else{
$condition.=' and `dispatch` =  :dispatchKey';
}
$params[]=array(':dispatchKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->pkName)){ //If isset Vo->element
$fieldValue=$routerUrlVo->pkName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `pk_name` $key :pkNameKey";
    $isFirst = false;
} else {
    $condition .= " and `pk_name` $key :pkNameKey";
}
if($type == 'str') {
    $params[] = array(':pkNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pkNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `pk_name` =  :pkNameKey';
$isFirst=false;
}else{
$condition.=' and `pk_name` =  :pkNameKey';
}
$params[]=array(':pkNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->pkValue)){ //If isset Vo->element
$fieldValue=$routerUrlVo->pkValue;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `pk_value` $key :pkValueKey";
    $isFirst = false;
} else {
    $condition .= " and `pk_value` $key :pkValueKey";
}
if($type == 'str') {
    $params[] = array(':pkValueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pkValueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `pk_value` =  :pkValueKey';
$isFirst=false;
}else{
$condition.=' and `pk_value` =  :pkValueKey';
}
$params[]=array(':pkValueKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->redirectTo)){ //If isset Vo->element
$fieldValue=$routerUrlVo->redirectTo;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `redirect_to` $key :redirectToKey";
    $isFirst = false;
} else {
    $condition .= " and `redirect_to` $key :redirectToKey";
}
if($type == 'str') {
    $params[] = array(':redirectToKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':redirectToKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `redirect_to` =  :redirectToKey';
$isFirst=false;
}else{
$condition.=' and `redirect_to` =  :redirectToKey';
}
$params[]=array(':redirectToKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->isDel)){ //If isset Vo->element
$fieldValue=$routerUrlVo->isDel;
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
return PersistentHelper::mapResult('RouterUrlVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($routerUrlVo){
try {
if (empty($routerUrlVo)) $routerUrlVo = new RouterUrlVo();
$sql = "select count(*) as total from  router_url ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($routerUrlVo->routerUrlId)){ //If isset Vo->element
$fieldValue=$routerUrlVo->routerUrlId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router_url_id` $key :routerUrlIdKey";
    $isFirst = false;
} else {
    $condition .= " and `router_url_id` $key :routerUrlIdKey";
}
if($type == 'str') {
    $params[] = array(':routerUrlIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerUrlIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router_url_id` =  :routerUrlIdKey';
$isFirst=false;
}else{
$condition.=' and `router_url_id` =  :routerUrlIdKey';
}
$params[]=array(':routerUrlIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerUrlVo->routerId)){ //If isset Vo->element
$fieldValue=$routerUrlVo->routerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router_id` $key :routerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `router_id` $key :routerIdKey";
}
if($type == 'str') {
    $params[] = array(':routerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router_id` =  :routerIdKey';
$isFirst=false;
}else{
$condition.=' and `router_id` =  :routerIdKey';
}
$params[]=array(':routerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerUrlVo->alias)){ //If isset Vo->element
$fieldValue=$routerUrlVo->alias;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias` $key :aliasKey";
    $isFirst = false;
} else {
    $condition .= " and `alias` $key :aliasKey";
}
if($type == 'str') {
    $params[] = array(':aliasKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias` =  :aliasKey';
$isFirst=false;
}else{
$condition.=' and `alias` =  :aliasKey';
}
$params[]=array(':aliasKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->dispatch)){ //If isset Vo->element
$fieldValue=$routerUrlVo->dispatch;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `dispatch` $key :dispatchKey";
    $isFirst = false;
} else {
    $condition .= " and `dispatch` $key :dispatchKey";
}
if($type == 'str') {
    $params[] = array(':dispatchKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dispatchKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `dispatch` =  :dispatchKey';
$isFirst=false;
}else{
$condition.=' and `dispatch` =  :dispatchKey';
}
$params[]=array(':dispatchKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->pkName)){ //If isset Vo->element
$fieldValue=$routerUrlVo->pkName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `pk_name` $key :pkNameKey";
    $isFirst = false;
} else {
    $condition .= " and `pk_name` $key :pkNameKey";
}
if($type == 'str') {
    $params[] = array(':pkNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pkNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `pk_name` =  :pkNameKey';
$isFirst=false;
}else{
$condition.=' and `pk_name` =  :pkNameKey';
}
$params[]=array(':pkNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->pkValue)){ //If isset Vo->element
$fieldValue=$routerUrlVo->pkValue;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `pk_value` $key :pkValueKey";
    $isFirst = false;
} else {
    $condition .= " and `pk_value` $key :pkValueKey";
}
if($type == 'str') {
    $params[] = array(':pkValueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pkValueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `pk_value` =  :pkValueKey';
$isFirst=false;
}else{
$condition.=' and `pk_value` =  :pkValueKey';
}
$params[]=array(':pkValueKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->redirectTo)){ //If isset Vo->element
$fieldValue=$routerUrlVo->redirectTo;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `redirect_to` $key :redirectToKey";
    $isFirst = false;
} else {
    $condition .= " and `redirect_to` $key :redirectToKey";
}
if($type == 'str') {
    $params[] = array(':redirectToKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':redirectToKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `redirect_to` =  :redirectToKey';
$isFirst=false;
}else{
$condition.=' and `redirect_to` =  :redirectToKey';
}
$params[]=array(':redirectToKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerUrlVo->isDel)){ //If isset Vo->element
$fieldValue=$routerUrlVo->isDel;
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


public function updateByPrimaryKey($routerUrlVo,$routerUrlId){
try {
$sql="UPDATE `router_url` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($routerUrlVo->routerUrlId)){
if ($isFirst){
$updateFields.=' `router_url_id`= :routerUrlId';
$isFirst=false;}else{
$updateFields.=', `router_url_id`= :routerUrlId';
}
$params[]=array(':routerUrlId', $routerUrlVo->routerUrlId, PDO::PARAM_INT);
}

if (isset($routerUrlVo->routerId)){
if ($isFirst){
$updateFields.=' `router_id`= :routerId';
$isFirst=false;}else{
$updateFields.=', `router_id`= :routerId';
}
$params[]=array(':routerId', $routerUrlVo->routerId, PDO::PARAM_INT);
}

if (isset($routerUrlVo->alias)){
if ($isFirst){
$updateFields.=' `alias`= :alias';
$isFirst=false;}else{
$updateFields.=', `alias`= :alias';
}
$params[]=array(':alias', $routerUrlVo->alias, PDO::PARAM_STR);
}

if (isset($routerUrlVo->dispatch)){
if ($isFirst){
$updateFields.=' `dispatch`= :dispatch';
$isFirst=false;}else{
$updateFields.=', `dispatch`= :dispatch';
}
$params[]=array(':dispatch', $routerUrlVo->dispatch, PDO::PARAM_STR);
}

if (isset($routerUrlVo->pkName)){
if ($isFirst){
$updateFields.=' `pk_name`= :pkName';
$isFirst=false;}else{
$updateFields.=', `pk_name`= :pkName';
}
$params[]=array(':pkName', $routerUrlVo->pkName, PDO::PARAM_STR);
}

if (isset($routerUrlVo->pkValue)){
if ($isFirst){
$updateFields.=' `pk_value`= :pkValue';
$isFirst=false;}else{
$updateFields.=', `pk_value`= :pkValue';
}
$params[]=array(':pkValue', $routerUrlVo->pkValue, PDO::PARAM_STR);
}

if (isset($routerUrlVo->redirectTo)){
if ($isFirst){
$updateFields.=' `redirect_to`= :redirectTo';
$isFirst=false;}else{
$updateFields.=', `redirect_to`= :redirectTo';
}
$params[]=array(':redirectTo', $routerUrlVo->redirectTo, PDO::PARAM_STR);
}

if (isset($routerUrlVo->isDel)){
if ($isFirst){
$updateFields.=' `is_del`= :isDel';
$isFirst=false;}else{
$updateFields.=', `is_del`= :isDel';
}
$params[]=array(':isDel', $routerUrlVo->isDel, PDO::PARAM_INT);
}

$conditions.=' where `router_url_id`= :routerUrlId';
$params[]=array(':routerUrlId', $routerUrlId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (routerUrlId)
	 * Example
	 * getValueByPrimaryKey('routerUrlName', 1)
	 * Get value of filed routerUrlName in table routerUrl where routerUrlId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$routerUrlVo = $this->selectByPrimaryKey($primaryValue);
		if($routerUrlVo){
			return $routerUrlVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('routerUrlName', array('routerUrlId' => 1))
	 * Get value of filed routerUrlName in table routerUrl where routerUrlId = 1
	 */
	public function getValueByField($fieldName, $where){
		$routerUrlVo = new RouterUrlVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$routerUrlVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$routerUrlVos = $this->selectByFilter($routerUrlVo);
       
		if($routerUrlVos){
			$routerUrlVo = $routerUrlVos[0];
			return $routerUrlVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table router_url
	 *
	 * @param int $router_url_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($routerUrlId){
		try {
		    $sql = "DELETE FROM `router_url` where `router_url_id` = :routerUrlId";
		    $params = array();
		    $params[] = array(':routerUrlId', $routerUrlId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table router_url
	 *
	 * @param object $routerUrlVo
	 * @return boolean
	 */
	public function deleteByFilter($routerUrlVo){
		try {
			$sql = 'DELETE FROM `router_url`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($routerUrlVo->routerUrlId)){
				$isDel = true;
				$condition[] = '`router_url_id` = :routerUrlId';
				$params[] = array(':routerUrlId', $routerUrlVo->routerUrlId, PDO::PARAM_INT);
			}
			if (!is_null($routerUrlVo->routerId)){
				$isDel = true;
				$condition[] = '`router_id` = :routerId';
				$params[] = array(':routerId', $routerUrlVo->routerId, PDO::PARAM_INT);
			}
			if (!is_null($routerUrlVo->alias)){
				$isDel = true;
				$condition[] = '`alias` = :alias';
				$params[] = array(':alias', $routerUrlVo->alias, PDO::PARAM_STR);
			}
			if (!is_null($routerUrlVo->dispatch)){
				$isDel = true;
				$condition[] = '`dispatch` = :dispatch';
				$params[] = array(':dispatch', $routerUrlVo->dispatch, PDO::PARAM_STR);
			}
			if (!is_null($routerUrlVo->pkName)){
				$isDel = true;
				$condition[] = '`pk_name` = :pkName';
				$params[] = array(':pkName', $routerUrlVo->pkName, PDO::PARAM_STR);
			}
			if (!is_null($routerUrlVo->pkValue)){
				$isDel = true;
				$condition[] = '`pk_value` = :pkValue';
				$params[] = array(':pkValue', $routerUrlVo->pkValue, PDO::PARAM_STR);
			}
			if (!is_null($routerUrlVo->redirectTo)){
				$isDel = true;
				$condition[] = '`redirect_to` = :redirectTo';
				$params[] = array(':redirectTo', $routerUrlVo->redirectTo, PDO::PARAM_STR);
			}
			if (!is_null($routerUrlVo->isDel)){
				$isDel = true;
				$condition[] = '`is_del` = :isDel';
				$params[] = array(':isDel', $routerUrlVo->isDel, PDO::PARAM_INT);
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
