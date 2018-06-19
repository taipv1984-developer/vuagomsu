<?php
class PluginDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `plugin`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('PluginVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($pluginId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `plugin` where `plugin_id` = :pluginId");
$stmt->bindParam(':pluginId',$pluginId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('PluginVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($pluginVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `plugin`( `plugin_code`, `info`, `priority`, `file_list`, `status`)
VALUES( :pluginCode, :info, :priority, :fileList, :status)");
$stmt->bindParam(':pluginCode', $pluginVo->pluginCode, PDO::PARAM_STR);
$stmt->bindParam(':info', $pluginVo->info, PDO::PARAM_STR);
$stmt->bindParam(':priority', $pluginVo->priority, PDO::PARAM_INT);
$stmt->bindParam(':fileList', $pluginVo->fileList, PDO::PARAM_STR);
$stmt->bindParam(':status', $pluginVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($pluginVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `plugin`( `plugin_code`, `info`, `priority`, `file_list`, `status`)
VALUES( :pluginCode, :info, :priority, :fileList, :status)");
$stmt->bindParam(':pluginCode', $pluginVo->pluginCode, PDO::PARAM_STR);
$stmt->bindParam(':info', $pluginVo->info, PDO::PARAM_STR);
$stmt->bindParam(':priority', $pluginVo->priority, PDO::PARAM_INT);
$stmt->bindParam(':fileList', $pluginVo->fileList, PDO::PARAM_STR);
$stmt->bindParam(':status', $pluginVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table plugin by $pluginVo object filter use paging
 * 
 * @param object $pluginVo is plugin object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($pluginVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($pluginVo)) $pluginVo = new PluginVo();
$sql = "select * from `plugin` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($pluginVo->pluginId)){ //If isset Vo->element
$fieldValue=$pluginVo->pluginId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_id` $key :pluginIdKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_id` $key :pluginIdKey";
}
if($type == 'str') {
    $params[] = array(':pluginIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_id` =  :pluginIdKey';
$isFirst=false;
}else{
$condition.=' and `plugin_id` =  :pluginIdKey';
}
$params[]=array(':pluginIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($pluginVo->pluginCode)){ //If isset Vo->element
$fieldValue=$pluginVo->pluginCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_code` $key :pluginCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_code` $key :pluginCodeKey";
}
if($type == 'str') {
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_code` =  :pluginCodeKey';
$isFirst=false;
}else{
$condition.=' and `plugin_code` =  :pluginCodeKey';
}
$params[]=array(':pluginCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($pluginVo->info)){ //If isset Vo->element
$fieldValue=$pluginVo->info;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `info` $key :infoKey";
    $isFirst = false;
} else {
    $condition .= " and `info` $key :infoKey";
}
if($type == 'str') {
    $params[] = array(':infoKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':infoKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `info` =  :infoKey';
$isFirst=false;
}else{
$condition.=' and `info` =  :infoKey';
}
$params[]=array(':infoKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($pluginVo->priority)){ //If isset Vo->element
$fieldValue=$pluginVo->priority;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `priority` $key :priorityKey";
    $isFirst = false;
} else {
    $condition .= " and `priority` $key :priorityKey";
}
if($type == 'str') {
    $params[] = array(':priorityKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':priorityKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `priority` =  :priorityKey';
$isFirst=false;
}else{
$condition.=' and `priority` =  :priorityKey';
}
$params[]=array(':priorityKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($pluginVo->fileList)){ //If isset Vo->element
$fieldValue=$pluginVo->fileList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `file_list` $key :fileListKey";
    $isFirst = false;
} else {
    $condition .= " and `file_list` $key :fileListKey";
}
if($type == 'str') {
    $params[] = array(':fileListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':fileListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `file_list` =  :fileListKey';
$isFirst=false;
}else{
$condition.=' and `file_list` =  :fileListKey';
}
$params[]=array(':fileListKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($pluginVo->status)){ //If isset Vo->element
$fieldValue=$pluginVo->status;
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
return PersistentHelper::mapResult('PluginVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($pluginVo){
try {
if (empty($pluginVo)) $pluginVo = new PluginVo();
$sql = "select count(*) as total from  plugin ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($pluginVo->pluginId)){ //If isset Vo->element
$fieldValue=$pluginVo->pluginId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_id` $key :pluginIdKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_id` $key :pluginIdKey";
}
if($type == 'str') {
    $params[] = array(':pluginIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_id` =  :pluginIdKey';
$isFirst=false;
}else{
$condition.=' and `plugin_id` =  :pluginIdKey';
}
$params[]=array(':pluginIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($pluginVo->pluginCode)){ //If isset Vo->element
$fieldValue=$pluginVo->pluginCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_code` $key :pluginCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_code` $key :pluginCodeKey";
}
if($type == 'str') {
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_code` =  :pluginCodeKey';
$isFirst=false;
}else{
$condition.=' and `plugin_code` =  :pluginCodeKey';
}
$params[]=array(':pluginCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($pluginVo->info)){ //If isset Vo->element
$fieldValue=$pluginVo->info;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `info` $key :infoKey";
    $isFirst = false;
} else {
    $condition .= " and `info` $key :infoKey";
}
if($type == 'str') {
    $params[] = array(':infoKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':infoKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `info` =  :infoKey';
$isFirst=false;
}else{
$condition.=' and `info` =  :infoKey';
}
$params[]=array(':infoKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($pluginVo->priority)){ //If isset Vo->element
$fieldValue=$pluginVo->priority;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `priority` $key :priorityKey";
    $isFirst = false;
} else {
    $condition .= " and `priority` $key :priorityKey";
}
if($type == 'str') {
    $params[] = array(':priorityKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':priorityKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `priority` =  :priorityKey';
$isFirst=false;
}else{
$condition.=' and `priority` =  :priorityKey';
}
$params[]=array(':priorityKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($pluginVo->fileList)){ //If isset Vo->element
$fieldValue=$pluginVo->fileList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `file_list` $key :fileListKey";
    $isFirst = false;
} else {
    $condition .= " and `file_list` $key :fileListKey";
}
if($type == 'str') {
    $params[] = array(':fileListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':fileListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `file_list` =  :fileListKey';
$isFirst=false;
}else{
$condition.=' and `file_list` =  :fileListKey';
}
$params[]=array(':fileListKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($pluginVo->status)){ //If isset Vo->element
$fieldValue=$pluginVo->status;
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


public function updateByPrimaryKey($pluginVo,$pluginId){
try {
$sql="UPDATE `plugin` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($pluginVo->pluginId)){
if ($isFirst){
$updateFields.=' `plugin_id`= :pluginId';
$isFirst=false;}else{
$updateFields.=', `plugin_id`= :pluginId';
}
$params[]=array(':pluginId', $pluginVo->pluginId, PDO::PARAM_INT);
}

if (isset($pluginVo->pluginCode)){
if ($isFirst){
$updateFields.=' `plugin_code`= :pluginCode';
$isFirst=false;}else{
$updateFields.=', `plugin_code`= :pluginCode';
}
$params[]=array(':pluginCode', $pluginVo->pluginCode, PDO::PARAM_STR);
}

if (isset($pluginVo->info)){
if ($isFirst){
$updateFields.=' `info`= :info';
$isFirst=false;}else{
$updateFields.=', `info`= :info';
}
$params[]=array(':info', $pluginVo->info, PDO::PARAM_STR);
}

if (isset($pluginVo->priority)){
if ($isFirst){
$updateFields.=' `priority`= :priority';
$isFirst=false;}else{
$updateFields.=', `priority`= :priority';
}
$params[]=array(':priority', $pluginVo->priority, PDO::PARAM_INT);
}

if (isset($pluginVo->fileList)){
if ($isFirst){
$updateFields.=' `file_list`= :fileList';
$isFirst=false;}else{
$updateFields.=', `file_list`= :fileList';
}
$params[]=array(':fileList', $pluginVo->fileList, PDO::PARAM_STR);
}

if (isset($pluginVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $pluginVo->status, PDO::PARAM_STR);
}

$conditions.=' where `plugin_id`= :pluginId';
$params[]=array(':pluginId', $pluginId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (pluginId)
	 * Example
	 * getValueByPrimaryKey('pluginName', 1)
	 * Get value of filed pluginName in table plugin where pluginId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$pluginVo = $this->selectByPrimaryKey($primaryValue);
		if($pluginVo){
			return $pluginVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('pluginName', array('pluginId' => 1))
	 * Get value of filed pluginName in table plugin where pluginId = 1
	 */
	public function getValueByField($fieldName, $where){
		$pluginVo = new PluginVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$pluginVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$pluginVos = $this->selectByFilter($pluginVo);
       
		if($pluginVos){
			$pluginVo = $pluginVos[0];
			return $pluginVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table plugin
	 *
	 * @param int $plugin_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($pluginId){
		try {
		    $sql = "DELETE FROM `plugin` where `plugin_id` = :pluginId";
		    $params = array();
		    $params[] = array(':pluginId', $pluginId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table plugin
	 *
	 * @param object $pluginVo
	 * @return boolean
	 */
	public function deleteByFilter($pluginVo){
		try {
			$sql = 'DELETE FROM `plugin`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($pluginVo->pluginId)){
				$isDel = true;
				$condition[] = '`plugin_id` = :pluginId';
				$params[] = array(':pluginId', $pluginVo->pluginId, PDO::PARAM_INT);
			}
			if (!is_null($pluginVo->pluginCode)){
				$isDel = true;
				$condition[] = '`plugin_code` = :pluginCode';
				$params[] = array(':pluginCode', $pluginVo->pluginCode, PDO::PARAM_STR);
			}
			if (!is_null($pluginVo->info)){
				$isDel = true;
				$condition[] = '`info` = :info';
				$params[] = array(':info', $pluginVo->info, PDO::PARAM_STR);
			}
			if (!is_null($pluginVo->priority)){
				$isDel = true;
				$condition[] = '`priority` = :priority';
				$params[] = array(':priority', $pluginVo->priority, PDO::PARAM_INT);
			}
			if (!is_null($pluginVo->fileList)){
				$isDel = true;
				$condition[] = '`file_list` = :fileList';
				$params[] = array(':fileList', $pluginVo->fileList, PDO::PARAM_STR);
			}
			if (!is_null($pluginVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $pluginVo->status, PDO::PARAM_STR);
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
