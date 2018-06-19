<?php
class CheckoutSettingDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `checkout_setting`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CheckoutSettingVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($checkoutSettingId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `checkout_setting` where `checkout_setting_id` = :checkoutSettingId");
$stmt->bindParam(':checkoutSettingId',$checkoutSettingId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CheckoutSettingVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($checkoutSettingVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `checkout_setting`( `checkout_id`, `setting`, `value`, `serialized`)
VALUES( :checkoutId, :setting, :value, :serialized)");
$stmt->bindParam(':checkoutId', $checkoutSettingVo->checkoutId, PDO::PARAM_INT);
$stmt->bindParam(':setting', $checkoutSettingVo->setting, PDO::PARAM_STR);
$stmt->bindParam(':value', $checkoutSettingVo->value, PDO::PARAM_STR);
$stmt->bindParam(':serialized', $checkoutSettingVo->serialized, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($checkoutSettingVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `checkout_setting`( `checkout_id`, `setting`, `value`, `serialized`)
VALUES( :checkoutId, :setting, :value, :serialized)");
$stmt->bindParam(':checkoutId', $checkoutSettingVo->checkoutId, PDO::PARAM_INT);
$stmt->bindParam(':setting', $checkoutSettingVo->setting, PDO::PARAM_STR);
$stmt->bindParam(':value', $checkoutSettingVo->value, PDO::PARAM_STR);
$stmt->bindParam(':serialized', $checkoutSettingVo->serialized, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table checkout_setting by $checkoutSettingVo object filter use paging
 * 
 * @param object $checkoutSettingVo is checkout_setting object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($checkoutSettingVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($checkoutSettingVo)) $checkoutSettingVo = new CheckoutSettingVo();
$sql = "select * from `checkout_setting` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($checkoutSettingVo->checkoutSettingId)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->checkoutSettingId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_setting_id` $key :checkoutSettingIdKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_setting_id` $key :checkoutSettingIdKey";
}
if($type == 'str') {
    $params[] = array(':checkoutSettingIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutSettingIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_setting_id` =  :checkoutSettingIdKey';
$isFirst=false;
}else{
$condition.=' and `checkout_setting_id` =  :checkoutSettingIdKey';
}
$params[]=array(':checkoutSettingIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($checkoutSettingVo->checkoutId)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->checkoutId;
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

if (!is_null($checkoutSettingVo->setting)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->setting;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting` $key :settingKey";
    $isFirst = false;
} else {
    $condition .= " and `setting` $key :settingKey";
}
if($type == 'str') {
    $params[] = array(':settingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting` =  :settingKey';
$isFirst=false;
}else{
$condition.=' and `setting` =  :settingKey';
}
$params[]=array(':settingKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutSettingVo->value)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->value;
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

if (!is_null($checkoutSettingVo->serialized)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->serialized;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `serialized` $key :serializedKey";
    $isFirst = false;
} else {
    $condition .= " and `serialized` $key :serializedKey";
}
if($type == 'str') {
    $params[] = array(':serializedKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':serializedKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `serialized` =  :serializedKey';
$isFirst=false;
}else{
$condition.=' and `serialized` =  :serializedKey';
}
$params[]=array(':serializedKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('CheckoutSettingVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($checkoutSettingVo){
try {
if (empty($checkoutSettingVo)) $checkoutSettingVo = new CheckoutSettingVo();
$sql = "select count(*) as total from  checkout_setting ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($checkoutSettingVo->checkoutSettingId)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->checkoutSettingId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `checkout_setting_id` $key :checkoutSettingIdKey";
    $isFirst = false;
} else {
    $condition .= " and `checkout_setting_id` $key :checkoutSettingIdKey";
}
if($type == 'str') {
    $params[] = array(':checkoutSettingIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':checkoutSettingIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `checkout_setting_id` =  :checkoutSettingIdKey';
$isFirst=false;
}else{
$condition.=' and `checkout_setting_id` =  :checkoutSettingIdKey';
}
$params[]=array(':checkoutSettingIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($checkoutSettingVo->checkoutId)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->checkoutId;
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

if (!is_null($checkoutSettingVo->setting)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->setting;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting` $key :settingKey";
    $isFirst = false;
} else {
    $condition .= " and `setting` $key :settingKey";
}
if($type == 'str') {
    $params[] = array(':settingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting` =  :settingKey';
$isFirst=false;
}else{
$condition.=' and `setting` =  :settingKey';
}
$params[]=array(':settingKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($checkoutSettingVo->value)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->value;
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

if (!is_null($checkoutSettingVo->serialized)){ //If isset Vo->element
$fieldValue=$checkoutSettingVo->serialized;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `serialized` $key :serializedKey";
    $isFirst = false;
} else {
    $condition .= " and `serialized` $key :serializedKey";
}
if($type == 'str') {
    $params[] = array(':serializedKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':serializedKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `serialized` =  :serializedKey';
$isFirst=false;
}else{
$condition.=' and `serialized` =  :serializedKey';
}
$params[]=array(':serializedKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($checkoutSettingVo,$checkoutSettingId){
try {
$sql="UPDATE `checkout_setting` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($checkoutSettingVo->checkoutSettingId)){
if ($isFirst){
$updateFields.=' `checkout_setting_id`= :checkoutSettingId';
$isFirst=false;}else{
$updateFields.=', `checkout_setting_id`= :checkoutSettingId';
}
$params[]=array(':checkoutSettingId', $checkoutSettingVo->checkoutSettingId, PDO::PARAM_INT);
}

if (isset($checkoutSettingVo->checkoutId)){
if ($isFirst){
$updateFields.=' `checkout_id`= :checkoutId';
$isFirst=false;}else{
$updateFields.=', `checkout_id`= :checkoutId';
}
$params[]=array(':checkoutId', $checkoutSettingVo->checkoutId, PDO::PARAM_INT);
}

if (isset($checkoutSettingVo->setting)){
if ($isFirst){
$updateFields.=' `setting`= :setting';
$isFirst=false;}else{
$updateFields.=', `setting`= :setting';
}
$params[]=array(':setting', $checkoutSettingVo->setting, PDO::PARAM_STR);
}

if (isset($checkoutSettingVo->value)){
if ($isFirst){
$updateFields.=' `value`= :value';
$isFirst=false;}else{
$updateFields.=', `value`= :value';
}
$params[]=array(':value', $checkoutSettingVo->value, PDO::PARAM_STR);
}

if (isset($checkoutSettingVo->serialized)){
if ($isFirst){
$updateFields.=' `serialized`= :serialized';
$isFirst=false;}else{
$updateFields.=', `serialized`= :serialized';
}
$params[]=array(':serialized', $checkoutSettingVo->serialized, PDO::PARAM_INT);
}

$conditions.=' where `checkout_setting_id`= :checkoutSettingId';
$params[]=array(':checkoutSettingId', $checkoutSettingId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (checkoutSettingId)
	 * Example
	 * getValueByPrimaryKey('checkoutSettingName', 1)
	 * Get value of filed checkoutSettingName in table checkoutSetting where checkoutSettingId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$checkoutSettingVo = $this->selectByPrimaryKey($primaryValue);
		if($checkoutSettingVo){
			return $checkoutSettingVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('checkoutSettingName', array('checkoutSettingId' => 1))
	 * Get value of filed checkoutSettingName in table checkoutSetting where checkoutSettingId = 1
	 */
	public function getValueByField($fieldName, $where){
		$checkoutSettingVo = new CheckoutSettingVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$checkoutSettingVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$checkoutSettingVos = $this->selectByFilter($checkoutSettingVo);
       
		if($checkoutSettingVos){
			$checkoutSettingVo = $checkoutSettingVos[0];
			return $checkoutSettingVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table checkout_setting
	 *
	 * @param int $checkout_setting_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($checkoutSettingId){
		try {
		    $sql = "DELETE FROM `checkout_setting` where `checkout_setting_id` = :checkoutSettingId";
		    $params = array();
		    $params[] = array(':checkoutSettingId', $checkoutSettingId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table checkout_setting
	 *
	 * @param object $checkoutSettingVo
	 * @return boolean
	 */
	public function deleteByFilter($checkoutSettingVo){
		try {
			$sql = 'DELETE FROM `checkout_setting`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($checkoutSettingVo->checkoutSettingId)){
				$isDel = true;
				$condition[] = '`checkout_setting_id` = :checkoutSettingId';
				$params[] = array(':checkoutSettingId', $checkoutSettingVo->checkoutSettingId, PDO::PARAM_INT);
			}
			if (!is_null($checkoutSettingVo->checkoutId)){
				$isDel = true;
				$condition[] = '`checkout_id` = :checkoutId';
				$params[] = array(':checkoutId', $checkoutSettingVo->checkoutId, PDO::PARAM_INT);
			}
			if (!is_null($checkoutSettingVo->setting)){
				$isDel = true;
				$condition[] = '`setting` = :setting';
				$params[] = array(':setting', $checkoutSettingVo->setting, PDO::PARAM_STR);
			}
			if (!is_null($checkoutSettingVo->value)){
				$isDel = true;
				$condition[] = '`value` = :value';
				$params[] = array(':value', $checkoutSettingVo->value, PDO::PARAM_STR);
			}
			if (!is_null($checkoutSettingVo->serialized)){
				$isDel = true;
				$condition[] = '`serialized` = :serialized';
				$params[] = array(':serialized', $checkoutSettingVo->serialized, PDO::PARAM_INT);
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
