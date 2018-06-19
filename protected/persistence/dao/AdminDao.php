<?php
class AdminDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `admin`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('AdminVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($adminId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `admin` where `admin_id` = :adminId");
$stmt->bindParam(':adminId',$adminId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('AdminVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($adminVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `admin`( `role_id`, `username`, `password`, `email`, `language_code`, `crt_date`, `crt_by`, `mod_date`, `mod_by`, `status`, `login_false`, `active_code`)
VALUES( :roleId, :username, :password, :email, :languageCode, :crtDate, :crtBy, :modDate, :modBy, :status, :loginFalse, :activeCode)");
$stmt->bindParam(':roleId', $adminVo->roleId, PDO::PARAM_INT);
$stmt->bindParam(':username', $adminVo->username, PDO::PARAM_STR);
$stmt->bindParam(':password', $adminVo->password, PDO::PARAM_STR);
$stmt->bindParam(':email', $adminVo->email, PDO::PARAM_STR);
$stmt->bindParam(':languageCode', $adminVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $adminVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $adminVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $adminVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $adminVo->modBy, PDO::PARAM_INT);
$stmt->bindParam(':status', $adminVo->status, PDO::PARAM_STR);
$stmt->bindParam(':loginFalse', $adminVo->loginFalse, PDO::PARAM_INT);
$stmt->bindParam(':activeCode', $adminVo->activeCode, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($adminVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `admin`( `role_id`, `username`, `password`, `email`, `language_code`, `crt_date`, `crt_by`, `mod_date`, `mod_by`, `status`, `login_false`, `active_code`)
VALUES( :roleId, :username, :password, :email, :languageCode, :crtDate, :crtBy, :modDate, :modBy, :status, :loginFalse, :activeCode)");
$stmt->bindParam(':roleId', $adminVo->roleId, PDO::PARAM_INT);
$stmt->bindParam(':username', $adminVo->username, PDO::PARAM_STR);
$stmt->bindParam(':password', $adminVo->password, PDO::PARAM_STR);
$stmt->bindParam(':email', $adminVo->email, PDO::PARAM_STR);
$stmt->bindParam(':languageCode', $adminVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $adminVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $adminVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $adminVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $adminVo->modBy, PDO::PARAM_INT);
$stmt->bindParam(':status', $adminVo->status, PDO::PARAM_STR);
$stmt->bindParam(':loginFalse', $adminVo->loginFalse, PDO::PARAM_INT);
$stmt->bindParam(':activeCode', $adminVo->activeCode, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table admin by $adminVo object filter use paging
 * 
 * @param object $adminVo is admin object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($adminVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($adminVo)) $adminVo = new AdminVo();
$sql = "select * from `admin` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($adminVo->adminId)){ //If isset Vo->element
$fieldValue=$adminVo->adminId;
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

if (!is_null($adminVo->roleId)){ //If isset Vo->element
$fieldValue=$adminVo->roleId;
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

if (!is_null($adminVo->username)){ //If isset Vo->element
$fieldValue=$adminVo->username;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `username` $key :usernameKey";
    $isFirst = false;
} else {
    $condition .= " and `username` $key :usernameKey";
}
if($type == 'str') {
    $params[] = array(':usernameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':usernameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `username` =  :usernameKey';
$isFirst=false;
}else{
$condition.=' and `username` =  :usernameKey';
}
$params[]=array(':usernameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->password)){ //If isset Vo->element
$fieldValue=$adminVo->password;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `password` $key :passwordKey";
    $isFirst = false;
} else {
    $condition .= " and `password` $key :passwordKey";
}
if($type == 'str') {
    $params[] = array(':passwordKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':passwordKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `password` =  :passwordKey';
$isFirst=false;
}else{
$condition.=' and `password` =  :passwordKey';
}
$params[]=array(':passwordKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->email)){ //If isset Vo->element
$fieldValue=$adminVo->email;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `email` $key :emailKey";
    $isFirst = false;
} else {
    $condition .= " and `email` $key :emailKey";
}
if($type == 'str') {
    $params[] = array(':emailKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':emailKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `email` =  :emailKey';
$isFirst=false;
}else{
$condition.=' and `email` =  :emailKey';
}
$params[]=array(':emailKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->languageCode)){ //If isset Vo->element
$fieldValue=$adminVo->languageCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_code` $key :languageCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `language_code` $key :languageCodeKey";
}
if($type == 'str') {
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_code` =  :languageCodeKey';
$isFirst=false;
}else{
$condition.=' and `language_code` =  :languageCodeKey';
}
$params[]=array(':languageCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->crtDate)){ //If isset Vo->element
$fieldValue=$adminVo->crtDate;
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

if (!is_null($adminVo->crtBy)){ //If isset Vo->element
$fieldValue=$adminVo->crtBy;
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

if (!is_null($adminVo->modDate)){ //If isset Vo->element
$fieldValue=$adminVo->modDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_date` $key :modDateKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_date` $key :modDateKey";
}
if($type == 'str') {
    $params[] = array(':modDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_date` =  :modDateKey';
$isFirst=false;
}else{
$condition.=' and `mod_date` =  :modDateKey';
}
$params[]=array(':modDateKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->modBy)){ //If isset Vo->element
$fieldValue=$adminVo->modBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_by` $key :modByKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_by` $key :modByKey";
}
if($type == 'str') {
    $params[] = array(':modByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_by` =  :modByKey';
$isFirst=false;
}else{
$condition.=' and `mod_by` =  :modByKey';
}
$params[]=array(':modByKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminVo->status)){ //If isset Vo->element
$fieldValue=$adminVo->status;
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

if (!is_null($adminVo->loginFalse)){ //If isset Vo->element
$fieldValue=$adminVo->loginFalse;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `login_false` $key :loginFalseKey";
    $isFirst = false;
} else {
    $condition .= " and `login_false` $key :loginFalseKey";
}
if($type == 'str') {
    $params[] = array(':loginFalseKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':loginFalseKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `login_false` =  :loginFalseKey';
$isFirst=false;
}else{
$condition.=' and `login_false` =  :loginFalseKey';
}
$params[]=array(':loginFalseKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminVo->activeCode)){ //If isset Vo->element
$fieldValue=$adminVo->activeCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `active_code` $key :activeCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `active_code` $key :activeCodeKey";
}
if($type == 'str') {
    $params[] = array(':activeCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':activeCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `active_code` =  :activeCodeKey';
$isFirst=false;
}else{
$condition.=' and `active_code` =  :activeCodeKey';
}
$params[]=array(':activeCodeKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('AdminVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($adminVo){
try {
if (empty($adminVo)) $adminVo = new AdminVo();
$sql = "select count(*) as total from  admin ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($adminVo->adminId)){ //If isset Vo->element
$fieldValue=$adminVo->adminId;
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

if (!is_null($adminVo->roleId)){ //If isset Vo->element
$fieldValue=$adminVo->roleId;
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

if (!is_null($adminVo->username)){ //If isset Vo->element
$fieldValue=$adminVo->username;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `username` $key :usernameKey";
    $isFirst = false;
} else {
    $condition .= " and `username` $key :usernameKey";
}
if($type == 'str') {
    $params[] = array(':usernameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':usernameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `username` =  :usernameKey';
$isFirst=false;
}else{
$condition.=' and `username` =  :usernameKey';
}
$params[]=array(':usernameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->password)){ //If isset Vo->element
$fieldValue=$adminVo->password;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `password` $key :passwordKey";
    $isFirst = false;
} else {
    $condition .= " and `password` $key :passwordKey";
}
if($type == 'str') {
    $params[] = array(':passwordKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':passwordKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `password` =  :passwordKey';
$isFirst=false;
}else{
$condition.=' and `password` =  :passwordKey';
}
$params[]=array(':passwordKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->email)){ //If isset Vo->element
$fieldValue=$adminVo->email;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `email` $key :emailKey";
    $isFirst = false;
} else {
    $condition .= " and `email` $key :emailKey";
}
if($type == 'str') {
    $params[] = array(':emailKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':emailKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `email` =  :emailKey';
$isFirst=false;
}else{
$condition.=' and `email` =  :emailKey';
}
$params[]=array(':emailKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->languageCode)){ //If isset Vo->element
$fieldValue=$adminVo->languageCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `language_code` $key :languageCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `language_code` $key :languageCodeKey";
}
if($type == 'str') {
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':languageCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `language_code` =  :languageCodeKey';
$isFirst=false;
}else{
$condition.=' and `language_code` =  :languageCodeKey';
}
$params[]=array(':languageCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->crtDate)){ //If isset Vo->element
$fieldValue=$adminVo->crtDate;
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

if (!is_null($adminVo->crtBy)){ //If isset Vo->element
$fieldValue=$adminVo->crtBy;
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

if (!is_null($adminVo->modDate)){ //If isset Vo->element
$fieldValue=$adminVo->modDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_date` $key :modDateKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_date` $key :modDateKey";
}
if($type == 'str') {
    $params[] = array(':modDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_date` =  :modDateKey';
$isFirst=false;
}else{
$condition.=' and `mod_date` =  :modDateKey';
}
$params[]=array(':modDateKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($adminVo->modBy)){ //If isset Vo->element
$fieldValue=$adminVo->modBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_by` $key :modByKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_by` $key :modByKey";
}
if($type == 'str') {
    $params[] = array(':modByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_by` =  :modByKey';
$isFirst=false;
}else{
$condition.=' and `mod_by` =  :modByKey';
}
$params[]=array(':modByKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminVo->status)){ //If isset Vo->element
$fieldValue=$adminVo->status;
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

if (!is_null($adminVo->loginFalse)){ //If isset Vo->element
$fieldValue=$adminVo->loginFalse;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `login_false` $key :loginFalseKey";
    $isFirst = false;
} else {
    $condition .= " and `login_false` $key :loginFalseKey";
}
if($type == 'str') {
    $params[] = array(':loginFalseKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':loginFalseKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `login_false` =  :loginFalseKey';
$isFirst=false;
}else{
$condition.=' and `login_false` =  :loginFalseKey';
}
$params[]=array(':loginFalseKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($adminVo->activeCode)){ //If isset Vo->element
$fieldValue=$adminVo->activeCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `active_code` $key :activeCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `active_code` $key :activeCodeKey";
}
if($type == 'str') {
    $params[] = array(':activeCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':activeCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `active_code` =  :activeCodeKey';
$isFirst=false;
}else{
$condition.=' and `active_code` =  :activeCodeKey';
}
$params[]=array(':activeCodeKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($adminVo,$adminId){
try {
$sql="UPDATE `admin` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($adminVo->adminId)){
if ($isFirst){
$updateFields.=' `admin_id`= :adminId';
$isFirst=false;}else{
$updateFields.=', `admin_id`= :adminId';
}
$params[]=array(':adminId', $adminVo->adminId, PDO::PARAM_INT);
}

if (isset($adminVo->roleId)){
if ($isFirst){
$updateFields.=' `role_id`= :roleId';
$isFirst=false;}else{
$updateFields.=', `role_id`= :roleId';
}
$params[]=array(':roleId', $adminVo->roleId, PDO::PARAM_INT);
}

if (isset($adminVo->username)){
if ($isFirst){
$updateFields.=' `username`= :username';
$isFirst=false;}else{
$updateFields.=', `username`= :username';
}
$params[]=array(':username', $adminVo->username, PDO::PARAM_STR);
}

if (isset($adminVo->password)){
if ($isFirst){
$updateFields.=' `password`= :password';
$isFirst=false;}else{
$updateFields.=', `password`= :password';
}
$params[]=array(':password', $adminVo->password, PDO::PARAM_STR);
}

if (isset($adminVo->email)){
if ($isFirst){
$updateFields.=' `email`= :email';
$isFirst=false;}else{
$updateFields.=', `email`= :email';
}
$params[]=array(':email', $adminVo->email, PDO::PARAM_STR);
}

if (isset($adminVo->languageCode)){
if ($isFirst){
$updateFields.=' `language_code`= :languageCode';
$isFirst=false;}else{
$updateFields.=', `language_code`= :languageCode';
}
$params[]=array(':languageCode', $adminVo->languageCode, PDO::PARAM_STR);
}

if (isset($adminVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $adminVo->crtDate, PDO::PARAM_STR);
}

if (isset($adminVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $adminVo->crtBy, PDO::PARAM_INT);
}

if (isset($adminVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $adminVo->modDate, PDO::PARAM_STR);
}

if (isset($adminVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $adminVo->modBy, PDO::PARAM_INT);
}

if (isset($adminVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $adminVo->status, PDO::PARAM_STR);
}

if (isset($adminVo->loginFalse)){
if ($isFirst){
$updateFields.=' `login_false`= :loginFalse';
$isFirst=false;}else{
$updateFields.=', `login_false`= :loginFalse';
}
$params[]=array(':loginFalse', $adminVo->loginFalse, PDO::PARAM_INT);
}

if (isset($adminVo->activeCode)){
if ($isFirst){
$updateFields.=' `active_code`= :activeCode';
$isFirst=false;}else{
$updateFields.=', `active_code`= :activeCode';
}
$params[]=array(':activeCode', $adminVo->activeCode, PDO::PARAM_STR);
}

$conditions.=' where `admin_id`= :adminId';
$params[]=array(':adminId', $adminId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (adminId)
	 * Example
	 * getValueByPrimaryKey('adminName', 1)
	 * Get value of filed adminName in table admin where adminId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$adminVo = $this->selectByPrimaryKey($primaryValue);
		if($adminVo){
			return $adminVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('adminName', array('adminId' => 1))
	 * Get value of filed adminName in table admin where adminId = 1
	 */
	public function getValueByField($fieldName, $where){
		$adminVo = new AdminVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$adminVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$adminVos = $this->selectByFilter($adminVo);
       
		if($adminVos){
			$adminVo = $adminVos[0];
			return $adminVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table admin
	 *
	 * @param int $admin_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($adminId){
		try {
		    $sql = "DELETE FROM `admin` where `admin_id` = :adminId";
		    $params = array();
		    $params[] = array(':adminId', $adminId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table admin
	 *
	 * @param object $adminVo
	 * @return boolean
	 */
	public function deleteByFilter($adminVo){
		try {
			$sql = 'DELETE FROM `admin`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($adminVo->adminId)){
				$isDel = true;
				$condition[] = '`admin_id` = :adminId';
				$params[] = array(':adminId', $adminVo->adminId, PDO::PARAM_INT);
			}
			if (!is_null($adminVo->roleId)){
				$isDel = true;
				$condition[] = '`role_id` = :roleId';
				$params[] = array(':roleId', $adminVo->roleId, PDO::PARAM_INT);
			}
			if (!is_null($adminVo->username)){
				$isDel = true;
				$condition[] = '`username` = :username';
				$params[] = array(':username', $adminVo->username, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->password)){
				$isDel = true;
				$condition[] = '`password` = :password';
				$params[] = array(':password', $adminVo->password, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->email)){
				$isDel = true;
				$condition[] = '`email` = :email';
				$params[] = array(':email', $adminVo->email, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->languageCode)){
				$isDel = true;
				$condition[] = '`language_code` = :languageCode';
				$params[] = array(':languageCode', $adminVo->languageCode, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $adminVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $adminVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($adminVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $adminVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $adminVo->modBy, PDO::PARAM_INT);
			}
			if (!is_null($adminVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $adminVo->status, PDO::PARAM_STR);
			}
			if (!is_null($adminVo->loginFalse)){
				$isDel = true;
				$condition[] = '`login_false` = :loginFalse';
				$params[] = array(':loginFalse', $adminVo->loginFalse, PDO::PARAM_INT);
			}
			if (!is_null($adminVo->activeCode)){
				$isDel = true;
				$condition[] = '`active_code` = :activeCode';
				$params[] = array(':activeCode', $adminVo->activeCode, PDO::PARAM_STR);
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
