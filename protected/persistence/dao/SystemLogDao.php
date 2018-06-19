<?php
class SystemLogDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `system_log`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('SystemLogVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($id){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `system_log` where `id` = :id");
$stmt->bindParam(':id',$id, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('SystemLogVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($systemLogVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `system_log`( `action`, `params`, `note`, `date`)
VALUES( :action, :params, :note, :date)");
$stmt->bindParam(':action', $systemLogVo->action, PDO::PARAM_STR);
$stmt->bindParam(':params', $systemLogVo->params, PDO::PARAM_STR);
$stmt->bindParam(':note', $systemLogVo->note, PDO::PARAM_STR);
$stmt->bindParam(':date', $systemLogVo->date, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($systemLogVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `system_log`( `action`, `params`, `note`, `date`)
VALUES( :action, :params, :note, :date)");
$stmt->bindParam(':action', $systemLogVo->action, PDO::PARAM_STR);
$stmt->bindParam(':params', $systemLogVo->params, PDO::PARAM_STR);
$stmt->bindParam(':note', $systemLogVo->note, PDO::PARAM_STR);
$stmt->bindParam(':date', $systemLogVo->date, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table system_log by $systemLogVo object filter use paging
 * 
 * @param object $systemLogVo is system_log object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($systemLogVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($systemLogVo)) $systemLogVo = new SystemLogVo();
$sql = "select * from `system_log` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($systemLogVo->id)){ //If isset Vo->element
$fieldValue=$systemLogVo->id;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `id` $key :idKey";
    $isFirst = false;
} else {
    $condition .= " and `id` $key :idKey";
}
if($type == 'str') {
    $params[] = array(':idKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':idKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `id` =  :idKey';
$isFirst=false;
}else{
$condition.=' and `id` =  :idKey';
}
$params[]=array(':idKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($systemLogVo->action)){ //If isset Vo->element
$fieldValue=$systemLogVo->action;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `action` $key :actionKey";
    $isFirst = false;
} else {
    $condition .= " and `action` $key :actionKey";
}
if($type == 'str') {
    $params[] = array(':actionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':actionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `action` =  :actionKey';
$isFirst=false;
}else{
$condition.=' and `action` =  :actionKey';
}
$params[]=array(':actionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($systemLogVo->params)){ //If isset Vo->element
$fieldValue=$systemLogVo->params;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `params` $key :paramsKey";
    $isFirst = false;
} else {
    $condition .= " and `params` $key :paramsKey";
}
if($type == 'str') {
    $params[] = array(':paramsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':paramsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `params` =  :paramsKey';
$isFirst=false;
}else{
$condition.=' and `params` =  :paramsKey';
}
$params[]=array(':paramsKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($systemLogVo->note)){ //If isset Vo->element
$fieldValue=$systemLogVo->note;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `note` $key :noteKey";
    $isFirst = false;
} else {
    $condition .= " and `note` $key :noteKey";
}
if($type == 'str') {
    $params[] = array(':noteKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noteKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `note` =  :noteKey';
$isFirst=false;
}else{
$condition.=' and `note` =  :noteKey';
}
$params[]=array(':noteKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($systemLogVo->date)){ //If isset Vo->element
$fieldValue=$systemLogVo->date;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `date` $key :dateKey";
    $isFirst = false;
} else {
    $condition .= " and `date` $key :dateKey";
}
if($type == 'str') {
    $params[] = array(':dateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `date` =  :dateKey';
$isFirst=false;
}else{
$condition.=' and `date` =  :dateKey';
}
$params[]=array(':dateKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('SystemLogVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($systemLogVo){
try {
if (empty($systemLogVo)) $systemLogVo = new SystemLogVo();
$sql = "select count(*) as total from  system_log ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($systemLogVo->id)){ //If isset Vo->element
$fieldValue=$systemLogVo->id;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `id` $key :idKey";
    $isFirst = false;
} else {
    $condition .= " and `id` $key :idKey";
}
if($type == 'str') {
    $params[] = array(':idKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':idKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `id` =  :idKey';
$isFirst=false;
}else{
$condition.=' and `id` =  :idKey';
}
$params[]=array(':idKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($systemLogVo->action)){ //If isset Vo->element
$fieldValue=$systemLogVo->action;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `action` $key :actionKey";
    $isFirst = false;
} else {
    $condition .= " and `action` $key :actionKey";
}
if($type == 'str') {
    $params[] = array(':actionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':actionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `action` =  :actionKey';
$isFirst=false;
}else{
$condition.=' and `action` =  :actionKey';
}
$params[]=array(':actionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($systemLogVo->params)){ //If isset Vo->element
$fieldValue=$systemLogVo->params;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `params` $key :paramsKey";
    $isFirst = false;
} else {
    $condition .= " and `params` $key :paramsKey";
}
if($type == 'str') {
    $params[] = array(':paramsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':paramsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `params` =  :paramsKey';
$isFirst=false;
}else{
$condition.=' and `params` =  :paramsKey';
}
$params[]=array(':paramsKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($systemLogVo->note)){ //If isset Vo->element
$fieldValue=$systemLogVo->note;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `note` $key :noteKey";
    $isFirst = false;
} else {
    $condition .= " and `note` $key :noteKey";
}
if($type == 'str') {
    $params[] = array(':noteKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noteKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `note` =  :noteKey';
$isFirst=false;
}else{
$condition.=' and `note` =  :noteKey';
}
$params[]=array(':noteKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($systemLogVo->date)){ //If isset Vo->element
$fieldValue=$systemLogVo->date;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `date` $key :dateKey";
    $isFirst = false;
} else {
    $condition .= " and `date` $key :dateKey";
}
if($type == 'str') {
    $params[] = array(':dateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `date` =  :dateKey';
$isFirst=false;
}else{
$condition.=' and `date` =  :dateKey';
}
$params[]=array(':dateKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($systemLogVo,$id){
try {
$sql="UPDATE `system_log` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($systemLogVo->id)){
if ($isFirst){
$updateFields.=' `id`= :id';
$isFirst=false;}else{
$updateFields.=', `id`= :id';
}
$params[]=array(':id', $systemLogVo->id, PDO::PARAM_INT);
}

if (isset($systemLogVo->action)){
if ($isFirst){
$updateFields.=' `action`= :action';
$isFirst=false;}else{
$updateFields.=', `action`= :action';
}
$params[]=array(':action', $systemLogVo->action, PDO::PARAM_STR);
}

if (isset($systemLogVo->params)){
if ($isFirst){
$updateFields.=' `params`= :params';
$isFirst=false;}else{
$updateFields.=', `params`= :params';
}
$params[]=array(':params', $systemLogVo->params, PDO::PARAM_STR);
}

if (isset($systemLogVo->note)){
if ($isFirst){
$updateFields.=' `note`= :note';
$isFirst=false;}else{
$updateFields.=', `note`= :note';
}
$params[]=array(':note', $systemLogVo->note, PDO::PARAM_STR);
}

if (isset($systemLogVo->date)){
if ($isFirst){
$updateFields.=' `date`= :date';
$isFirst=false;}else{
$updateFields.=', `date`= :date';
}
$params[]=array(':date', $systemLogVo->date, PDO::PARAM_STR);
}

$conditions.=' where `id`= :id';
$params[]=array(':id', $id, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (systemLogId)
	 * Example
	 * getValueByPrimaryKey('systemLogName', 1)
	 * Get value of filed systemLogName in table systemLog where systemLogId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$systemLogVo = $this->selectByPrimaryKey($primaryValue);
		if($systemLogVo){
			return $systemLogVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('systemLogName', array('systemLogId' => 1))
	 * Get value of filed systemLogName in table systemLog where systemLogId = 1
	 */
	public function getValueByField($fieldName, $where){
		$systemLogVo = new SystemLogVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$systemLogVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$systemLogVos = $this->selectByFilter($systemLogVo);
       
		if($systemLogVos){
			$systemLogVo = $systemLogVos[0];
			return $systemLogVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table system_log
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($id){
		try {
		    $sql = "DELETE FROM `system_log` where `id` = :id";
		    $params = array();
		    $params[] = array(':id', $id, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table system_log
	 *
	 * @param object $systemLogVo
	 * @return boolean
	 */
	public function deleteByFilter($systemLogVo){
		try {
			$sql = 'DELETE FROM `system_log`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($systemLogVo->id)){
				$isDel = true;
				$condition[] = '`id` = :id';
				$params[] = array(':id', $systemLogVo->id, PDO::PARAM_INT);
			}
			if (!is_null($systemLogVo->action)){
				$isDel = true;
				$condition[] = '`action` = :action';
				$params[] = array(':action', $systemLogVo->action, PDO::PARAM_STR);
			}
			if (!is_null($systemLogVo->params)){
				$isDel = true;
				$condition[] = '`params` = :params';
				$params[] = array(':params', $systemLogVo->params, PDO::PARAM_STR);
			}
			if (!is_null($systemLogVo->note)){
				$isDel = true;
				$condition[] = '`note` = :note';
				$params[] = array(':note', $systemLogVo->note, PDO::PARAM_STR);
			}
			if (!is_null($systemLogVo->date)){
				$isDel = true;
				$condition[] = '`date` = :date';
				$params[] = array(':date', $systemLogVo->date, PDO::PARAM_STR);
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
