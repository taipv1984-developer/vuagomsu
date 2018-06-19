<?php
class SettingGroupDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `setting_group`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('SettingGroupVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($settingGroupId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `setting_group` where `setting_group_id` = :settingGroupId");
$stmt->bindParam(':settingGroupId',$settingGroupId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('SettingGroupVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($settingGroupVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `setting_group`( `setting_type`, `name`, `order`, `status`)
VALUES( :settingType, :name, :order, :status)");
$stmt->bindParam(':settingType', $settingGroupVo->settingType, PDO::PARAM_STR);
$stmt->bindParam(':name', $settingGroupVo->name, PDO::PARAM_STR);
$stmt->bindParam(':order', $settingGroupVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $settingGroupVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($settingGroupVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `setting_group`( `setting_type`, `name`, `order`, `status`)
VALUES( :settingType, :name, :order, :status)");
$stmt->bindParam(':settingType', $settingGroupVo->settingType, PDO::PARAM_STR);
$stmt->bindParam(':name', $settingGroupVo->name, PDO::PARAM_STR);
$stmt->bindParam(':order', $settingGroupVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $settingGroupVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table setting_group by $settingGroupVo object filter use paging
 * 
 * @param object $settingGroupVo is setting_group object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($settingGroupVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($settingGroupVo)) $settingGroupVo = new SettingGroupVo();
$sql = "select * from `setting_group` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($settingGroupVo->settingGroupId)){ //If isset Vo->element
$fieldValue=$settingGroupVo->settingGroupId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_group_id` $key :settingGroupIdKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_group_id` $key :settingGroupIdKey";
}
if($type == 'str') {
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_group_id` =  :settingGroupIdKey';
$isFirst=false;
}else{
$condition.=' and `setting_group_id` =  :settingGroupIdKey';
}
$params[]=array(':settingGroupIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($settingGroupVo->settingType)){ //If isset Vo->element
$fieldValue=$settingGroupVo->settingType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_type` $key :settingTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_type` $key :settingTypeKey";
}
if($type == 'str') {
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_type` =  :settingTypeKey';
$isFirst=false;
}else{
$condition.=' and `setting_type` =  :settingTypeKey';
}
$params[]=array(':settingTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingGroupVo->name)){ //If isset Vo->element
$fieldValue=$settingGroupVo->name;
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

if (!is_null($settingGroupVo->order)){ //If isset Vo->element
$fieldValue=$settingGroupVo->order;
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

if (!is_null($settingGroupVo->status)){ //If isset Vo->element
$fieldValue=$settingGroupVo->status;
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
return PersistentHelper::mapResult('SettingGroupVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($settingGroupVo){
try {
if (empty($settingGroupVo)) $settingGroupVo = new SettingGroupVo();
$sql = "select count(*) as total from  setting_group ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($settingGroupVo->settingGroupId)){ //If isset Vo->element
$fieldValue=$settingGroupVo->settingGroupId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_group_id` $key :settingGroupIdKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_group_id` $key :settingGroupIdKey";
}
if($type == 'str') {
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_group_id` =  :settingGroupIdKey';
$isFirst=false;
}else{
$condition.=' and `setting_group_id` =  :settingGroupIdKey';
}
$params[]=array(':settingGroupIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($settingGroupVo->settingType)){ //If isset Vo->element
$fieldValue=$settingGroupVo->settingType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_type` $key :settingTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_type` $key :settingTypeKey";
}
if($type == 'str') {
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_type` =  :settingTypeKey';
$isFirst=false;
}else{
$condition.=' and `setting_type` =  :settingTypeKey';
}
$params[]=array(':settingTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingGroupVo->name)){ //If isset Vo->element
$fieldValue=$settingGroupVo->name;
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

if (!is_null($settingGroupVo->order)){ //If isset Vo->element
$fieldValue=$settingGroupVo->order;
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

if (!is_null($settingGroupVo->status)){ //If isset Vo->element
$fieldValue=$settingGroupVo->status;
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


public function updateByPrimaryKey($settingGroupVo,$settingGroupId){
try {
$sql="UPDATE `setting_group` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($settingGroupVo->settingGroupId)){
if ($isFirst){
$updateFields.=' `setting_group_id`= :settingGroupId';
$isFirst=false;}else{
$updateFields.=', `setting_group_id`= :settingGroupId';
}
$params[]=array(':settingGroupId', $settingGroupVo->settingGroupId, PDO::PARAM_INT);
}

if (isset($settingGroupVo->settingType)){
if ($isFirst){
$updateFields.=' `setting_type`= :settingType';
$isFirst=false;}else{
$updateFields.=', `setting_type`= :settingType';
}
$params[]=array(':settingType', $settingGroupVo->settingType, PDO::PARAM_STR);
}

if (isset($settingGroupVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $settingGroupVo->name, PDO::PARAM_STR);
}

if (isset($settingGroupVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $settingGroupVo->order, PDO::PARAM_INT);
}

if (isset($settingGroupVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $settingGroupVo->status, PDO::PARAM_STR);
}

$conditions.=' where `setting_group_id`= :settingGroupId';
$params[]=array(':settingGroupId', $settingGroupId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (settingGroupId)
	 * Example
	 * getValueByPrimaryKey('settingGroupName', 1)
	 * Get value of filed settingGroupName in table settingGroup where settingGroupId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$settingGroupVo = $this->selectByPrimaryKey($primaryValue);
		if($settingGroupVo){
			return $settingGroupVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('settingGroupName', array('settingGroupId' => 1))
	 * Get value of filed settingGroupName in table settingGroup where settingGroupId = 1
	 */
	public function getValueByField($fieldName, $where){
		$settingGroupVo = new SettingGroupVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$settingGroupVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$settingGroupVos = $this->selectByFilter($settingGroupVo);
       
		if($settingGroupVos){
			$settingGroupVo = $settingGroupVos[0];
			return $settingGroupVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table setting_group
	 *
	 * @param int $setting_group_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($settingGroupId){
		try {
		    $sql = "DELETE FROM `setting_group` where `setting_group_id` = :settingGroupId";
		    $params = array();
		    $params[] = array(':settingGroupId', $settingGroupId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table setting_group
	 *
	 * @param object $settingGroupVo
	 * @return boolean
	 */
	public function deleteByFilter($settingGroupVo){
		try {
			$sql = 'DELETE FROM `setting_group`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($settingGroupVo->settingGroupId)){
				$isDel = true;
				$condition[] = '`setting_group_id` = :settingGroupId';
				$params[] = array(':settingGroupId', $settingGroupVo->settingGroupId, PDO::PARAM_INT);
			}
			if (!is_null($settingGroupVo->settingType)){
				$isDel = true;
				$condition[] = '`setting_type` = :settingType';
				$params[] = array(':settingType', $settingGroupVo->settingType, PDO::PARAM_STR);
			}
			if (!is_null($settingGroupVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $settingGroupVo->name, PDO::PARAM_STR);
			}
			if (!is_null($settingGroupVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $settingGroupVo->order, PDO::PARAM_INT);
			}
			if (!is_null($settingGroupVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $settingGroupVo->status, PDO::PARAM_STR);
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
