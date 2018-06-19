<?php
class AdminDetailDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `admin_detail`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('AdminDetailVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($adminDetailId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `admin_detail` where `admin_detail_id` = :adminDetailId");
$stmt->bindParam(':adminDetailId',$adminDetailId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('AdminDetailVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($adminDetailVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `admin_detail`( `admin_id`, `name`, `phone`, `address`, `image`, `gender`, `birthday`)
VALUES( :adminId, :name, :phone, :address, :image, :gender, :birthday)");
$stmt->bindParam(':adminId', $adminDetailVo->adminId, PDO::PARAM_INT);
$stmt->bindParam(':name', $adminDetailVo->name, PDO::PARAM_STR);
$stmt->bindParam(':phone', $adminDetailVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':address', $adminDetailVo->address, PDO::PARAM_STR);
$stmt->bindParam(':image', $adminDetailVo->image, PDO::PARAM_STR);
$stmt->bindParam(':gender', $adminDetailVo->gender, PDO::PARAM_INT);
$stmt->bindParam(':birthday', $adminDetailVo->birthday, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($adminDetailVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `admin_detail`( `admin_id`, `name`, `phone`, `address`, `image`, `gender`, `birthday`)
VALUES( :adminId, :name, :phone, :address, :image, :gender, :birthday)");
$stmt->bindParam(':adminId', $adminDetailVo->adminId, PDO::PARAM_INT);
$stmt->bindParam(':name', $adminDetailVo->name, PDO::PARAM_STR);
$stmt->bindParam(':phone', $adminDetailVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':address', $adminDetailVo->address, PDO::PARAM_STR);
$stmt->bindParam(':image', $adminDetailVo->image, PDO::PARAM_STR);
$stmt->bindParam(':gender', $adminDetailVo->gender, PDO::PARAM_INT);
$stmt->bindParam(':birthday', $adminDetailVo->birthday, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table admin_detail by $adminDetailVo object filter use paging
 * 
 * @param object $adminDetailVo is admin_detail object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($adminDetailVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($adminDetailVo)) $adminDetailVo = new AdminDetailVo();
$sql = "select * from `admin_detail` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($adminDetailVo->adminDetailId)){ //If isset Vo->element
$fieldValue=$adminDetailVo->adminDetailId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `admin_detail_id` $key :adminDetailIdKey";
    $isFirst = false;
} else {
    $condition .= " and `admin_detail_id` $key :adminDetailIdKey";
}
if($type == 'str') {
    $params[] = array(':adminDetailIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':adminDetailIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `admin_detail_id` =  :adminDetailIdKey';
$isFirst=false;
}else{
$condition.=' and `admin_detail_id` =  :adminDetailIdKey';
}
$params[]=array(':adminDetailIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminDetailVo->adminId)){ //If isset Vo->element
$fieldValue=$adminDetailVo->adminId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `admin_id` $key :adminIdKey";
    $isFirst = false;
} else {
    $condition .= " and `admin_id` $key :adminIdKey";
}
if($type == 'str') {
    $params[] = array(':adminIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':adminIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `admin_id` =  :adminIdKey';
$isFirst=false;
}else{
$condition.=' and `admin_id` =  :adminIdKey';
}
$params[]=array(':adminIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminDetailVo->name)){ //If isset Vo->element
$fieldValue=$adminDetailVo->name;
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

if (!is_null($adminDetailVo->phone)){ //If isset Vo->element
$fieldValue=$adminDetailVo->phone;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `phone` $key :phoneKey";
    $isFirst = false;
} else {
    $condition .= " and `phone` $key :phoneKey";
}
if($type == 'str') {
    $params[] = array(':phoneKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':phoneKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `phone` =  :phoneKey';
$isFirst=false;
}else{
$condition.=' and `phone` =  :phoneKey';
}
$params[]=array(':phoneKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminDetailVo->address)){ //If isset Vo->element
$fieldValue=$adminDetailVo->address;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `address` $key :addressKey";
    $isFirst = false;
} else {
    $condition .= " and `address` $key :addressKey";
}
if($type == 'str') {
    $params[] = array(':addressKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':addressKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `address` =  :addressKey';
$isFirst=false;
}else{
$condition.=' and `address` =  :addressKey';
}
$params[]=array(':addressKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminDetailVo->image)){ //If isset Vo->element
$fieldValue=$adminDetailVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminDetailVo->gender)){ //If isset Vo->element
$fieldValue=$adminDetailVo->gender;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `gender` $key :genderKey";
    $isFirst = false;
} else {
    $condition .= " and `gender` $key :genderKey";
}
if($type == 'str') {
    $params[] = array(':genderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':genderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `gender` =  :genderKey';
$isFirst=false;
}else{
$condition.=' and `gender` =  :genderKey';
}
$params[]=array(':genderKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminDetailVo->birthday)){ //If isset Vo->element
$fieldValue=$adminDetailVo->birthday;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `birthday` $key :birthdayKey";
    $isFirst = false;
} else {
    $condition .= " and `birthday` $key :birthdayKey";
}
if($type == 'str') {
    $params[] = array(':birthdayKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':birthdayKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `birthday` =  :birthdayKey';
$isFirst=false;
}else{
$condition.=' and `birthday` =  :birthdayKey';
}
$params[]=array(':birthdayKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('AdminDetailVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($adminDetailVo){
try {
if (empty($adminDetailVo)) $adminDetailVo = new AdminDetailVo();
$sql = "select count(*) as total from  admin_detail ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($adminDetailVo->adminDetailId)){ //If isset Vo->element
$fieldValue=$adminDetailVo->adminDetailId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `admin_detail_id` $key :adminDetailIdKey";
    $isFirst = false;
} else {
    $condition .= " and `admin_detail_id` $key :adminDetailIdKey";
}
if($type == 'str') {
    $params[] = array(':adminDetailIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':adminDetailIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `admin_detail_id` =  :adminDetailIdKey';
$isFirst=false;
}else{
$condition.=' and `admin_detail_id` =  :adminDetailIdKey';
}
$params[]=array(':adminDetailIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminDetailVo->adminId)){ //If isset Vo->element
$fieldValue=$adminDetailVo->adminId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `admin_id` $key :adminIdKey";
    $isFirst = false;
} else {
    $condition .= " and `admin_id` $key :adminIdKey";
}
if($type == 'str') {
    $params[] = array(':adminIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':adminIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `admin_id` =  :adminIdKey';
$isFirst=false;
}else{
$condition.=' and `admin_id` =  :adminIdKey';
}
$params[]=array(':adminIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminDetailVo->name)){ //If isset Vo->element
$fieldValue=$adminDetailVo->name;
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

if (!is_null($adminDetailVo->phone)){ //If isset Vo->element
$fieldValue=$adminDetailVo->phone;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `phone` $key :phoneKey";
    $isFirst = false;
} else {
    $condition .= " and `phone` $key :phoneKey";
}
if($type == 'str') {
    $params[] = array(':phoneKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':phoneKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `phone` =  :phoneKey';
$isFirst=false;
}else{
$condition.=' and `phone` =  :phoneKey';
}
$params[]=array(':phoneKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminDetailVo->address)){ //If isset Vo->element
$fieldValue=$adminDetailVo->address;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `address` $key :addressKey";
    $isFirst = false;
} else {
    $condition .= " and `address` $key :addressKey";
}
if($type == 'str') {
    $params[] = array(':addressKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':addressKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `address` =  :addressKey';
$isFirst=false;
}else{
$condition.=' and `address` =  :addressKey';
}
$params[]=array(':addressKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminDetailVo->image)){ //If isset Vo->element
$fieldValue=$adminDetailVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminDetailVo->gender)){ //If isset Vo->element
$fieldValue=$adminDetailVo->gender;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `gender` $key :genderKey";
    $isFirst = false;
} else {
    $condition .= " and `gender` $key :genderKey";
}
if($type == 'str') {
    $params[] = array(':genderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':genderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `gender` =  :genderKey';
$isFirst=false;
}else{
$condition.=' and `gender` =  :genderKey';
}
$params[]=array(':genderKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminDetailVo->birthday)){ //If isset Vo->element
$fieldValue=$adminDetailVo->birthday;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `birthday` $key :birthdayKey";
    $isFirst = false;
} else {
    $condition .= " and `birthday` $key :birthdayKey";
}
if($type == 'str') {
    $params[] = array(':birthdayKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':birthdayKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `birthday` =  :birthdayKey';
$isFirst=false;
}else{
$condition.=' and `birthday` =  :birthdayKey';
}
$params[]=array(':birthdayKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($adminDetailVo,$adminDetailId){
try {
$sql="UPDATE `admin_detail` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($adminDetailVo->adminDetailId)){
if ($isFirst){
$updateFields.=' `admin_detail_id`= :adminDetailId';
$isFirst=false;}else{
$updateFields.=', `admin_detail_id`= :adminDetailId';
}
$params[]=array(':adminDetailId', $adminDetailVo->adminDetailId, PDO::PARAM_INT);
}

if (isset($adminDetailVo->adminId)){
if ($isFirst){
$updateFields.=' `admin_id`= :adminId';
$isFirst=false;}else{
$updateFields.=', `admin_id`= :adminId';
}
$params[]=array(':adminId', $adminDetailVo->adminId, PDO::PARAM_INT);
}

if (isset($adminDetailVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $adminDetailVo->name, PDO::PARAM_STR);
}

if (isset($adminDetailVo->phone)){
if ($isFirst){
$updateFields.=' `phone`= :phone';
$isFirst=false;}else{
$updateFields.=', `phone`= :phone';
}
$params[]=array(':phone', $adminDetailVo->phone, PDO::PARAM_STR);
}

if (isset($adminDetailVo->address)){
if ($isFirst){
$updateFields.=' `address`= :address';
$isFirst=false;}else{
$updateFields.=', `address`= :address';
}
$params[]=array(':address', $adminDetailVo->address, PDO::PARAM_STR);
}

if (isset($adminDetailVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $adminDetailVo->image, PDO::PARAM_STR);
}

if (isset($adminDetailVo->gender)){
if ($isFirst){
$updateFields.=' `gender`= :gender';
$isFirst=false;}else{
$updateFields.=', `gender`= :gender';
}
$params[]=array(':gender', $adminDetailVo->gender, PDO::PARAM_INT);
}

if (isset($adminDetailVo->birthday)){
if ($isFirst){
$updateFields.=' `birthday`= :birthday';
$isFirst=false;}else{
$updateFields.=', `birthday`= :birthday';
}
$params[]=array(':birthday', $adminDetailVo->birthday, PDO::PARAM_STR);
}

$conditions.=' where `admin_detail_id`= :adminDetailId';
$params[]=array(':adminDetailId', $adminDetailId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (adminDetailId)
	 * Example
	 * getValueByPrimaryKey('adminDetailName', 1)
	 * Get value of filed adminDetailName in table adminDetail where adminDetailId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$adminDetailVo = $this->selectByPrimaryKey($primaryValue);
		if($adminDetailVo){
			return $adminDetailVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('adminDetailName', array('adminDetailId' => 1))
	 * Get value of filed adminDetailName in table adminDetail where adminDetailId = 1
	 */
	public function getValueByField($fieldName, $where){
		$adminDetailVo = new AdminDetailVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$adminDetailVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$adminDetailVos = $this->selectByFilter($adminDetailVo);
       
		if($adminDetailVos){
			$adminDetailVo = $adminDetailVos[0];
			return $adminDetailVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table admin_detail
	 *
	 * @param int $admin_detail_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($adminDetailId){
		try {
		    $sql = "DELETE FROM `admin_detail` where `admin_detail_id` = :adminDetailId";
		    $params = array();
		    $params[] = array(':adminDetailId', $adminDetailId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table admin_detail
	 *
	 * @param object $adminDetailVo
	 * @return boolean
	 */
	public function deleteByFilter($adminDetailVo){
		try {
			$sql = 'DELETE FROM `admin_detail`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($adminDetailVo->adminDetailId)){
				$isDel = true;
				$condition[] = '`admin_detail_id` = :adminDetailId';
				$params[] = array(':adminDetailId', $adminDetailVo->adminDetailId, PDO::PARAM_INT);
			}
			if (!is_null($adminDetailVo->adminId)){
				$isDel = true;
				$condition[] = '`admin_id` = :adminId';
				$params[] = array(':adminId', $adminDetailVo->adminId, PDO::PARAM_INT);
			}
			if (!is_null($adminDetailVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $adminDetailVo->name, PDO::PARAM_STR);
			}
			if (!is_null($adminDetailVo->phone)){
				$isDel = true;
				$condition[] = '`phone` = :phone';
				$params[] = array(':phone', $adminDetailVo->phone, PDO::PARAM_STR);
			}
			if (!is_null($adminDetailVo->address)){
				$isDel = true;
				$condition[] = '`address` = :address';
				$params[] = array(':address', $adminDetailVo->address, PDO::PARAM_STR);
			}
			if (!is_null($adminDetailVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $adminDetailVo->image, PDO::PARAM_STR);
			}
			if (!is_null($adminDetailVo->gender)){
				$isDel = true;
				$condition[] = '`gender` = :gender';
				$params[] = array(':gender', $adminDetailVo->gender, PDO::PARAM_INT);
			}
			if (!is_null($adminDetailVo->birthday)){
				$isDel = true;
				$condition[] = '`birthday` = :birthday';
				$params[] = array(':birthday', $adminDetailVo->birthday, PDO::PARAM_STR);
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
