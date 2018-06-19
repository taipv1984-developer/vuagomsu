<?php
class RolePermissionDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `role_permission`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('RolePermissionVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($rolePermissionId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `role_permission` where `role_permission_id` = :rolePermissionId");
$stmt->bindParam(':rolePermissionId',$rolePermissionId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('RolePermissionVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($rolePermissionVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `role_permission`( `role_id`, `permission`, `status`)
VALUES( :roleId, :permission, :status)");
$stmt->bindParam(':roleId', $rolePermissionVo->roleId, PDO::PARAM_INT);
$stmt->bindParam(':permission', $rolePermissionVo->permission, PDO::PARAM_STR);
$stmt->bindParam(':status', $rolePermissionVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($rolePermissionVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `role_permission`( `role_id`, `permission`, `status`)
VALUES( :roleId, :permission, :status)");
$stmt->bindParam(':roleId', $rolePermissionVo->roleId, PDO::PARAM_INT);
$stmt->bindParam(':permission', $rolePermissionVo->permission, PDO::PARAM_STR);
$stmt->bindParam(':status', $rolePermissionVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table role_permission by $rolePermissionVo object filter use paging
 * 
 * @param object $rolePermissionVo is role_permission object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($rolePermissionVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($rolePermissionVo)) $rolePermissionVo = new RolePermissionVo();
$sql = "select * from `role_permission` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($rolePermissionVo->rolePermissionId)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->rolePermissionId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_permission_id` $key :rolePermissionIdKey";
    $isFirst = false;
} else {
    $condition .= " and `role_permission_id` $key :rolePermissionIdKey";
}
if($type == 'str') {
    $params[] = array(':rolePermissionIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':rolePermissionIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_permission_id` =  :rolePermissionIdKey';
$isFirst=false;
}else{
$condition.=' and `role_permission_id` =  :rolePermissionIdKey';
}
$params[]=array(':rolePermissionIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($rolePermissionVo->roleId)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->roleId;
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

if (!is_null($rolePermissionVo->permission)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->permission;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `permission` $key :permissionKey";
    $isFirst = false;
} else {
    $condition .= " and `permission` $key :permissionKey";
}
if($type == 'str') {
    $params[] = array(':permissionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':permissionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `permission` =  :permissionKey';
$isFirst=false;
}else{
$condition.=' and `permission` =  :permissionKey';
}
$params[]=array(':permissionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($rolePermissionVo->status)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->status;
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
return PersistentHelper::mapResult('RolePermissionVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($rolePermissionVo){
try {
if (empty($rolePermissionVo)) $rolePermissionVo = new RolePermissionVo();
$sql = "select count(*) as total from  role_permission ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($rolePermissionVo->rolePermissionId)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->rolePermissionId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `role_permission_id` $key :rolePermissionIdKey";
    $isFirst = false;
} else {
    $condition .= " and `role_permission_id` $key :rolePermissionIdKey";
}
if($type == 'str') {
    $params[] = array(':rolePermissionIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':rolePermissionIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `role_permission_id` =  :rolePermissionIdKey';
$isFirst=false;
}else{
$condition.=' and `role_permission_id` =  :rolePermissionIdKey';
}
$params[]=array(':rolePermissionIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($rolePermissionVo->roleId)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->roleId;
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

if (!is_null($rolePermissionVo->permission)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->permission;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `permission` $key :permissionKey";
    $isFirst = false;
} else {
    $condition .= " and `permission` $key :permissionKey";
}
if($type == 'str') {
    $params[] = array(':permissionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':permissionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `permission` =  :permissionKey';
$isFirst=false;
}else{
$condition.=' and `permission` =  :permissionKey';
}
$params[]=array(':permissionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($rolePermissionVo->status)){ //If isset Vo->element
$fieldValue=$rolePermissionVo->status;
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


public function updateByPrimaryKey($rolePermissionVo,$rolePermissionId){
try {
$sql="UPDATE `role_permission` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($rolePermissionVo->rolePermissionId)){
if ($isFirst){
$updateFields.=' `role_permission_id`= :rolePermissionId';
$isFirst=false;}else{
$updateFields.=', `role_permission_id`= :rolePermissionId';
}
$params[]=array(':rolePermissionId', $rolePermissionVo->rolePermissionId, PDO::PARAM_INT);
}

if (isset($rolePermissionVo->roleId)){
if ($isFirst){
$updateFields.=' `role_id`= :roleId';
$isFirst=false;}else{
$updateFields.=', `role_id`= :roleId';
}
$params[]=array(':roleId', $rolePermissionVo->roleId, PDO::PARAM_INT);
}

if (isset($rolePermissionVo->permission)){
if ($isFirst){
$updateFields.=' `permission`= :permission';
$isFirst=false;}else{
$updateFields.=', `permission`= :permission';
}
$params[]=array(':permission', $rolePermissionVo->permission, PDO::PARAM_STR);
}

if (isset($rolePermissionVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $rolePermissionVo->status, PDO::PARAM_STR);
}

$conditions.=' where `role_permission_id`= :rolePermissionId';
$params[]=array(':rolePermissionId', $rolePermissionId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (rolePermissionId)
	 * Example
	 * getValueByPrimaryKey('rolePermissionName', 1)
	 * Get value of filed rolePermissionName in table rolePermission where rolePermissionId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$rolePermissionVo = $this->selectByPrimaryKey($primaryValue);
		if($rolePermissionVo){
			return $rolePermissionVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('rolePermissionName', array('rolePermissionId' => 1))
	 * Get value of filed rolePermissionName in table rolePermission where rolePermissionId = 1
	 */
	public function getValueByField($fieldName, $where){
		$rolePermissionVo = new RolePermissionVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$rolePermissionVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$rolePermissionVos = $this->selectByFilter($rolePermissionVo);
       
		if($rolePermissionVos){
			$rolePermissionVo = $rolePermissionVos[0];
			return $rolePermissionVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table role_permission
	 *
	 * @param int $role_permission_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($rolePermissionId){
		try {
		    $sql = "DELETE FROM `role_permission` where `role_permission_id` = :rolePermissionId";
		    $params = array();
		    $params[] = array(':rolePermissionId', $rolePermissionId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table role_permission
	 *
	 * @param object $rolePermissionVo
	 * @return boolean
	 */
	public function deleteByFilter($rolePermissionVo){
		try {
			$sql = 'DELETE FROM `role_permission`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($rolePermissionVo->rolePermissionId)){
				$isDel = true;
				$condition[] = '`role_permission_id` = :rolePermissionId';
				$params[] = array(':rolePermissionId', $rolePermissionVo->rolePermissionId, PDO::PARAM_INT);
			}
			if (!is_null($rolePermissionVo->roleId)){
				$isDel = true;
				$condition[] = '`role_id` = :roleId';
				$params[] = array(':roleId', $rolePermissionVo->roleId, PDO::PARAM_INT);
			}
			if (!is_null($rolePermissionVo->permission)){
				$isDel = true;
				$condition[] = '`permission` = :permission';
				$params[] = array(':permission', $rolePermissionVo->permission, PDO::PARAM_STR);
			}
			if (!is_null($rolePermissionVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $rolePermissionVo->status, PDO::PARAM_STR);
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
