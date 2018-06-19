<?php
class RoleDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `role`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('RoleVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($roleId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `role` where `role_id` = :roleId");
$stmt->bindParam(':roleId',$roleId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('RoleVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($roleVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `role`( `role_name`, `role_type`)
VALUES( :roleName, :roleType)");
$stmt->bindParam(':roleName', $roleVo->roleName, PDO::PARAM_STR);
$stmt->bindParam(':roleType', $roleVo->roleType, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($roleVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `role`( `role_name`, `role_type`)
VALUES( :roleName, :roleType)");
$stmt->bindParam(':roleName', $roleVo->roleName, PDO::PARAM_STR);
$stmt->bindParam(':roleType', $roleVo->roleType, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table role by $roleVo object filter use paging
 * 
 * @param object $roleVo is role object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($roleVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($roleVo)) $roleVo = new RoleVo();
$sql = "select * from `role` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($roleVo->roleId)){ //If isset Vo->element
$fieldValue=$roleVo->roleId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_id` $key :roleIdKey";
    $isFirst = false;
} else {
    $condition .= " and `role_id` $key :roleIdKey";
}
if($type == 'str') {
    $params[] = array(':roleIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':roleIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_id` =  :roleIdKey';
$isFirst=false;
}else{
$condition.=' and `role_id` =  :roleIdKey';
}
$params[]=array(':roleIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($roleVo->roleName)){ //If isset Vo->element
$fieldValue=$roleVo->roleName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_name` $key :roleNameKey";
    $isFirst = false;
} else {
    $condition .= " and `role_name` $key :roleNameKey";
}
if($type == 'str') {
    $params[] = array(':roleNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':roleNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_name` =  :roleNameKey';
$isFirst=false;
}else{
$condition.=' and `role_name` =  :roleNameKey';
}
$params[]=array(':roleNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($roleVo->roleType)){ //If isset Vo->element
$fieldValue=$roleVo->roleType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_type` $key :roleTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `role_type` $key :roleTypeKey";
}
if($type == 'str') {
    $params[] = array(':roleTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':roleTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_type` =  :roleTypeKey';
$isFirst=false;
}else{
$condition.=' and `role_type` =  :roleTypeKey';
}
$params[]=array(':roleTypeKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('RoleVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($roleVo){
try {
if (empty($roleVo)) $roleVo = new RoleVo();
$sql = "select count(*) as total from  role ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($roleVo->roleId)){ //If isset Vo->element
$fieldValue=$roleVo->roleId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_id` $key :roleIdKey";
    $isFirst = false;
} else {
    $condition .= " and `role_id` $key :roleIdKey";
}
if($type == 'str') {
    $params[] = array(':roleIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':roleIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_id` =  :roleIdKey';
$isFirst=false;
}else{
$condition.=' and `role_id` =  :roleIdKey';
}
$params[]=array(':roleIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($roleVo->roleName)){ //If isset Vo->element
$fieldValue=$roleVo->roleName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_name` $key :roleNameKey";
    $isFirst = false;
} else {
    $condition .= " and `role_name` $key :roleNameKey";
}
if($type == 'str') {
    $params[] = array(':roleNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':roleNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_name` =  :roleNameKey';
$isFirst=false;
}else{
$condition.=' and `role_name` =  :roleNameKey';
}
$params[]=array(':roleNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($roleVo->roleType)){ //If isset Vo->element
$fieldValue=$roleVo->roleType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_type` $key :roleTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `role_type` $key :roleTypeKey";
}
if($type == 'str') {
    $params[] = array(':roleTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':roleTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_type` =  :roleTypeKey';
$isFirst=false;
}else{
$condition.=' and `role_type` =  :roleTypeKey';
}
$params[]=array(':roleTypeKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($roleVo,$roleId){
try {
$sql="UPDATE `role` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($roleVo->roleId)){
if ($isFirst){
$updateFields.=' `role_id`= :roleId';
$isFirst=false;}else{
$updateFields.=', `role_id`= :roleId';
}
$params[]=array(':roleId', $roleVo->roleId, PDO::PARAM_INT);
}

if (isset($roleVo->roleName)){
if ($isFirst){
$updateFields.=' `role_name`= :roleName';
$isFirst=false;}else{
$updateFields.=', `role_name`= :roleName';
}
$params[]=array(':roleName', $roleVo->roleName, PDO::PARAM_STR);
}

if (isset($roleVo->roleType)){
if ($isFirst){
$updateFields.=' `role_type`= :roleType';
$isFirst=false;}else{
$updateFields.=', `role_type`= :roleType';
}
$params[]=array(':roleType', $roleVo->roleType, PDO::PARAM_STR);
}

$conditions.=' where `role_id`= :roleId';
$params[]=array(':roleId', $roleId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (roleId)
	 * Example
	 * getValueByPrimaryKey('roleName', 1)
	 * Get value of filed roleName in table role where roleId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$roleVo = $this->selectByPrimaryKey($primaryValue);
		if($roleVo){
			return $roleVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('roleName', array('roleId' => 1))
	 * Get value of filed roleName in table role where roleId = 1
	 */
	public function getValueByField($fieldName, $where){
		$roleVo = new RoleVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$roleVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$roleVos = $this->selectByFilter($roleVo);
       
		if($roleVos){
			$roleVo = $roleVos[0];
			return $roleVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table role
	 *
	 * @param int $role_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($roleId){
		try {
		    $sql = "DELETE FROM `role` where `role_id` = :roleId";
		    $params = array();
		    $params[] = array(':roleId', $roleId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table role
	 *
	 * @param object $roleVo
	 * @return boolean
	 */
	public function deleteByFilter($roleVo){
		try {
			$sql = 'DELETE FROM `role`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($roleVo->roleId)){
				$isDel = true;
				$condition[] = '`role_id` = :roleId';
				$params[] = array(':roleId', $roleVo->roleId, PDO::PARAM_INT);
			}
			if (!is_null($roleVo->roleName)){
				$isDel = true;
				$condition[] = '`role_name` = :roleName';
				$params[] = array(':roleName', $roleVo->roleName, PDO::PARAM_STR);
			}
			if (!is_null($roleVo->roleType)){
				$isDel = true;
				$condition[] = '`role_type` = :roleType';
				$params[] = array(':roleType', $roleVo->roleType, PDO::PARAM_STR);
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
