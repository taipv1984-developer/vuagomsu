<?php
class CustomerDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `customer`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CustomerVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($customerId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `customer` where `customer_id` = :customerId");
$stmt->bindParam(':customerId',$customerId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CustomerVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($customerVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer`( `role_id`, `username`, `password`, `email`, `language_code`, `crt_date`, `crt_by`, `mod_date`, `mod_by`, `status`, `active_code`, `reset_password_code`, `oauth_provider`, `oauth_id`)
VALUES( :roleId, :username, :password, :email, :languageCode, :crtDate, :crtBy, :modDate, :modBy, :status, :activeCode, :resetPasswordCode, :oauthProvider, :oauthId)");
$stmt->bindParam(':roleId', $customerVo->roleId, PDO::PARAM_INT);
$stmt->bindParam(':username', $customerVo->username, PDO::PARAM_STR);
$stmt->bindParam(':password', $customerVo->password, PDO::PARAM_STR);
$stmt->bindParam(':email', $customerVo->email, PDO::PARAM_STR);
$stmt->bindParam(':languageCode', $customerVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $customerVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $customerVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $customerVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $customerVo->modBy, PDO::PARAM_INT);
$stmt->bindParam(':status', $customerVo->status, PDO::PARAM_STR);
$stmt->bindParam(':activeCode', $customerVo->activeCode, PDO::PARAM_STR);
$stmt->bindParam(':resetPasswordCode', $customerVo->resetPasswordCode, PDO::PARAM_STR);
$stmt->bindParam(':oauthProvider', $customerVo->oauthProvider, PDO::PARAM_STR);
$stmt->bindParam(':oauthId', $customerVo->oauthId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($customerVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer`( `role_id`, `username`, `password`, `email`, `language_code`, `crt_date`, `crt_by`, `mod_date`, `mod_by`, `status`, `active_code`, `reset_password_code`, `oauth_provider`, `oauth_id`)
VALUES( :roleId, :username, :password, :email, :languageCode, :crtDate, :crtBy, :modDate, :modBy, :status, :activeCode, :resetPasswordCode, :oauthProvider, :oauthId)");
$stmt->bindParam(':roleId', $customerVo->roleId, PDO::PARAM_INT);
$stmt->bindParam(':username', $customerVo->username, PDO::PARAM_STR);
$stmt->bindParam(':password', $customerVo->password, PDO::PARAM_STR);
$stmt->bindParam(':email', $customerVo->email, PDO::PARAM_STR);
$stmt->bindParam(':languageCode', $customerVo->languageCode, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $customerVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $customerVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $customerVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $customerVo->modBy, PDO::PARAM_INT);
$stmt->bindParam(':status', $customerVo->status, PDO::PARAM_STR);
$stmt->bindParam(':activeCode', $customerVo->activeCode, PDO::PARAM_STR);
$stmt->bindParam(':resetPasswordCode', $customerVo->resetPasswordCode, PDO::PARAM_STR);
$stmt->bindParam(':oauthProvider', $customerVo->oauthProvider, PDO::PARAM_STR);
$stmt->bindParam(':oauthId', $customerVo->oauthId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table customer by $customerVo object filter use paging
 * 
 * @param object $customerVo is customer object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($customerVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($customerVo)) $customerVo = new CustomerVo();
$sql = "select * from `customer` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerVo->customerId)){ //If isset Vo->element
$fieldValue=$customerVo->customerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_id` $key :customerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_id` $key :customerIdKey";
}
if($type == 'str') {
    $params[] = array(':customerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_id` =  :customerIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_id` =  :customerIdKey';
}
$params[]=array(':customerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerVo->roleId)){ //If isset Vo->element
$fieldValue=$customerVo->roleId;
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

if (!is_null($customerVo->username)){ //If isset Vo->element
$fieldValue=$customerVo->username;
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

if (!is_null($customerVo->password)){ //If isset Vo->element
$fieldValue=$customerVo->password;
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

if (!is_null($customerVo->email)){ //If isset Vo->element
$fieldValue=$customerVo->email;
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

if (!is_null($customerVo->languageCode)){ //If isset Vo->element
$fieldValue=$customerVo->languageCode;
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

if (!is_null($customerVo->crtDate)){ //If isset Vo->element
$fieldValue=$customerVo->crtDate;
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

if (!is_null($customerVo->crtBy)){ //If isset Vo->element
$fieldValue=$customerVo->crtBy;
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

if (!is_null($customerVo->modDate)){ //If isset Vo->element
$fieldValue=$customerVo->modDate;
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

if (!is_null($customerVo->modBy)){ //If isset Vo->element
$fieldValue=$customerVo->modBy;
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

if (!is_null($customerVo->status)){ //If isset Vo->element
$fieldValue=$customerVo->status;
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

if (!is_null($customerVo->activeCode)){ //If isset Vo->element
$fieldValue=$customerVo->activeCode;
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

if (!is_null($customerVo->resetPasswordCode)){ //If isset Vo->element
$fieldValue=$customerVo->resetPasswordCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `reset_password_code` $key :resetPasswordCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `reset_password_code` $key :resetPasswordCodeKey";
}
if($type == 'str') {
    $params[] = array(':resetPasswordCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':resetPasswordCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `reset_password_code` =  :resetPasswordCodeKey';
$isFirst=false;
}else{
$condition.=' and `reset_password_code` =  :resetPasswordCodeKey';
}
$params[]=array(':resetPasswordCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerVo->oauthProvider)){ //If isset Vo->element
$fieldValue=$customerVo->oauthProvider;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `oauth_provider` $key :oauthProviderKey";
    $isFirst = false;
} else {
    $condition .= " and `oauth_provider` $key :oauthProviderKey";
}
if($type == 'str') {
    $params[] = array(':oauthProviderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':oauthProviderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `oauth_provider` =  :oauthProviderKey';
$isFirst=false;
}else{
$condition.=' and `oauth_provider` =  :oauthProviderKey';
}
$params[]=array(':oauthProviderKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerVo->oauthId)){ //If isset Vo->element
$fieldValue=$customerVo->oauthId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `oauth_id` $key :oauthIdKey";
    $isFirst = false;
} else {
    $condition .= " and `oauth_id` $key :oauthIdKey";
}
if($type == 'str') {
    $params[] = array(':oauthIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':oauthIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `oauth_id` =  :oauthIdKey';
$isFirst=false;
}else{
$condition.=' and `oauth_id` =  :oauthIdKey';
}
$params[]=array(':oauthIdKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('CustomerVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($customerVo){
try {
if (empty($customerVo)) $customerVo = new CustomerVo();
$sql = "select count(*) as total from  customer ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerVo->customerId)){ //If isset Vo->element
$fieldValue=$customerVo->customerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_id` $key :customerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_id` $key :customerIdKey";
}
if($type == 'str') {
    $params[] = array(':customerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_id` =  :customerIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_id` =  :customerIdKey';
}
$params[]=array(':customerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerVo->roleId)){ //If isset Vo->element
$fieldValue=$customerVo->roleId;
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

if (!is_null($customerVo->username)){ //If isset Vo->element
$fieldValue=$customerVo->username;
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

if (!is_null($customerVo->password)){ //If isset Vo->element
$fieldValue=$customerVo->password;
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

if (!is_null($customerVo->email)){ //If isset Vo->element
$fieldValue=$customerVo->email;
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

if (!is_null($customerVo->languageCode)){ //If isset Vo->element
$fieldValue=$customerVo->languageCode;
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

if (!is_null($customerVo->crtDate)){ //If isset Vo->element
$fieldValue=$customerVo->crtDate;
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

if (!is_null($customerVo->crtBy)){ //If isset Vo->element
$fieldValue=$customerVo->crtBy;
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

if (!is_null($customerVo->modDate)){ //If isset Vo->element
$fieldValue=$customerVo->modDate;
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

if (!is_null($customerVo->modBy)){ //If isset Vo->element
$fieldValue=$customerVo->modBy;
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

if (!is_null($customerVo->status)){ //If isset Vo->element
$fieldValue=$customerVo->status;
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

if (!is_null($customerVo->activeCode)){ //If isset Vo->element
$fieldValue=$customerVo->activeCode;
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

if (!is_null($customerVo->resetPasswordCode)){ //If isset Vo->element
$fieldValue=$customerVo->resetPasswordCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `reset_password_code` $key :resetPasswordCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `reset_password_code` $key :resetPasswordCodeKey";
}
if($type == 'str') {
    $params[] = array(':resetPasswordCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':resetPasswordCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `reset_password_code` =  :resetPasswordCodeKey';
$isFirst=false;
}else{
$condition.=' and `reset_password_code` =  :resetPasswordCodeKey';
}
$params[]=array(':resetPasswordCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerVo->oauthProvider)){ //If isset Vo->element
$fieldValue=$customerVo->oauthProvider;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `oauth_provider` $key :oauthProviderKey";
    $isFirst = false;
} else {
    $condition .= " and `oauth_provider` $key :oauthProviderKey";
}
if($type == 'str') {
    $params[] = array(':oauthProviderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':oauthProviderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `oauth_provider` =  :oauthProviderKey';
$isFirst=false;
}else{
$condition.=' and `oauth_provider` =  :oauthProviderKey';
}
$params[]=array(':oauthProviderKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerVo->oauthId)){ //If isset Vo->element
$fieldValue=$customerVo->oauthId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `oauth_id` $key :oauthIdKey";
    $isFirst = false;
} else {
    $condition .= " and `oauth_id` $key :oauthIdKey";
}
if($type == 'str') {
    $params[] = array(':oauthIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':oauthIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `oauth_id` =  :oauthIdKey';
$isFirst=false;
}else{
$condition.=' and `oauth_id` =  :oauthIdKey';
}
$params[]=array(':oauthIdKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($customerVo,$customerId){
try {
$sql="UPDATE `customer` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($customerVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $customerVo->customerId, PDO::PARAM_INT);
}

if (isset($customerVo->roleId)){
if ($isFirst){
$updateFields.=' `role_id`= :roleId';
$isFirst=false;}else{
$updateFields.=', `role_id`= :roleId';
}
$params[]=array(':roleId', $customerVo->roleId, PDO::PARAM_INT);
}

if (isset($customerVo->username)){
if ($isFirst){
$updateFields.=' `username`= :username';
$isFirst=false;}else{
$updateFields.=', `username`= :username';
}
$params[]=array(':username', $customerVo->username, PDO::PARAM_STR);
}

if (isset($customerVo->password)){
if ($isFirst){
$updateFields.=' `password`= :password';
$isFirst=false;}else{
$updateFields.=', `password`= :password';
}
$params[]=array(':password', $customerVo->password, PDO::PARAM_STR);
}

if (isset($customerVo->email)){
if ($isFirst){
$updateFields.=' `email`= :email';
$isFirst=false;}else{
$updateFields.=', `email`= :email';
}
$params[]=array(':email', $customerVo->email, PDO::PARAM_STR);
}

if (isset($customerVo->languageCode)){
if ($isFirst){
$updateFields.=' `language_code`= :languageCode';
$isFirst=false;}else{
$updateFields.=', `language_code`= :languageCode';
}
$params[]=array(':languageCode', $customerVo->languageCode, PDO::PARAM_STR);
}

if (isset($customerVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $customerVo->crtDate, PDO::PARAM_STR);
}

if (isset($customerVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $customerVo->crtBy, PDO::PARAM_INT);
}

if (isset($customerVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $customerVo->modDate, PDO::PARAM_STR);
}

if (isset($customerVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $customerVo->modBy, PDO::PARAM_INT);
}

if (isset($customerVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $customerVo->status, PDO::PARAM_STR);
}

if (isset($customerVo->activeCode)){
if ($isFirst){
$updateFields.=' `active_code`= :activeCode';
$isFirst=false;}else{
$updateFields.=', `active_code`= :activeCode';
}
$params[]=array(':activeCode', $customerVo->activeCode, PDO::PARAM_STR);
}

if (isset($customerVo->resetPasswordCode)){
if ($isFirst){
$updateFields.=' `reset_password_code`= :resetPasswordCode';
$isFirst=false;}else{
$updateFields.=', `reset_password_code`= :resetPasswordCode';
}
$params[]=array(':resetPasswordCode', $customerVo->resetPasswordCode, PDO::PARAM_STR);
}

if (isset($customerVo->oauthProvider)){
if ($isFirst){
$updateFields.=' `oauth_provider`= :oauthProvider';
$isFirst=false;}else{
$updateFields.=', `oauth_provider`= :oauthProvider';
}
$params[]=array(':oauthProvider', $customerVo->oauthProvider, PDO::PARAM_STR);
}

if (isset($customerVo->oauthId)){
if ($isFirst){
$updateFields.=' `oauth_id`= :oauthId';
$isFirst=false;}else{
$updateFields.=', `oauth_id`= :oauthId';
}
$params[]=array(':oauthId', $customerVo->oauthId, PDO::PARAM_INT);
}

$conditions.=' where `customer_id`= :customerId';
$params[]=array(':customerId', $customerId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (customerId)
	 * Example
	 * getValueByPrimaryKey('customerName', 1)
	 * Get value of filed customerName in table customer where customerId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$customerVo = $this->selectByPrimaryKey($primaryValue);
		if($customerVo){
			return $customerVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('customerName', array('customerId' => 1))
	 * Get value of filed customerName in table customer where customerId = 1
	 */
	public function getValueByField($fieldName, $where){
		$customerVo = new CustomerVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$customerVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$customerVos = $this->selectByFilter($customerVo);
       
		if($customerVos){
			$customerVo = $customerVos[0];
			return $customerVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table customer
	 *
	 * @param int $customer_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($customerId){
		try {
		    $sql = "DELETE FROM `customer` where `customer_id` = :customerId";
		    $params = array();
		    $params[] = array(':customerId', $customerId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table customer
	 *
	 * @param object $customerVo
	 * @return boolean
	 */
	public function deleteByFilter($customerVo){
		try {
			$sql = 'DELETE FROM `customer`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($customerVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $customerVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($customerVo->roleId)){
				$isDel = true;
				$condition[] = '`role_id` = :roleId';
				$params[] = array(':roleId', $customerVo->roleId, PDO::PARAM_INT);
			}
			if (!is_null($customerVo->username)){
				$isDel = true;
				$condition[] = '`username` = :username';
				$params[] = array(':username', $customerVo->username, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->password)){
				$isDel = true;
				$condition[] = '`password` = :password';
				$params[] = array(':password', $customerVo->password, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->email)){
				$isDel = true;
				$condition[] = '`email` = :email';
				$params[] = array(':email', $customerVo->email, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->languageCode)){
				$isDel = true;
				$condition[] = '`language_code` = :languageCode';
				$params[] = array(':languageCode', $customerVo->languageCode, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $customerVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $customerVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($customerVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $customerVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $customerVo->modBy, PDO::PARAM_INT);
			}
			if (!is_null($customerVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $customerVo->status, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->activeCode)){
				$isDel = true;
				$condition[] = '`active_code` = :activeCode';
				$params[] = array(':activeCode', $customerVo->activeCode, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->resetPasswordCode)){
				$isDel = true;
				$condition[] = '`reset_password_code` = :resetPasswordCode';
				$params[] = array(':resetPasswordCode', $customerVo->resetPasswordCode, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->oauthProvider)){
				$isDel = true;
				$condition[] = '`oauth_provider` = :oauthProvider';
				$params[] = array(':oauthProvider', $customerVo->oauthProvider, PDO::PARAM_STR);
			}
			if (!is_null($customerVo->oauthId)){
				$isDel = true;
				$condition[] = '`oauth_id` = :oauthId';
				$params[] = array(':oauthId', $customerVo->oauthId, PDO::PARAM_INT);
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
