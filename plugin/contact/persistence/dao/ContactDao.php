<?php
class ContactDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `contact`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ContactVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($contactId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `contact` where `contact_id` = :contactId");
$stmt->bindParam(':contactId',$contactId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ContactVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($contactVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `contact`( `customer_id`, `name`, `email`, `phone`, `address`, `subject`, `message`, `status`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :customerId, :name, :email, :phone, :address, :subject, :message, :status, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':customerId', $contactVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':name', $contactVo->name, PDO::PARAM_STR);
$stmt->bindParam(':email', $contactVo->email, PDO::PARAM_STR);
$stmt->bindParam(':phone', $contactVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':address', $contactVo->address, PDO::PARAM_STR);
$stmt->bindParam(':subject', $contactVo->subject, PDO::PARAM_STR);
$stmt->bindParam(':message', $contactVo->message, PDO::PARAM_STR);
$stmt->bindParam(':status', $contactVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $contactVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $contactVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $contactVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $contactVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($contactVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `contact`( `customer_id`, `name`, `email`, `phone`, `address`, `subject`, `message`, `status`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :customerId, :name, :email, :phone, :address, :subject, :message, :status, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':customerId', $contactVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':name', $contactVo->name, PDO::PARAM_STR);
$stmt->bindParam(':email', $contactVo->email, PDO::PARAM_STR);
$stmt->bindParam(':phone', $contactVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':address', $contactVo->address, PDO::PARAM_STR);
$stmt->bindParam(':subject', $contactVo->subject, PDO::PARAM_STR);
$stmt->bindParam(':message', $contactVo->message, PDO::PARAM_STR);
$stmt->bindParam(':status', $contactVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $contactVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $contactVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $contactVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $contactVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table contact by $contactVo object filter use paging
 * 
 * @param object $contactVo is contact object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($contactVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($contactVo)) $contactVo = new ContactVo();
$sql = "select * from `contact` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($contactVo->contactId)){ //If isset Vo->element
$fieldValue=$contactVo->contactId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `contact_id` $key :contactIdKey";
    $isFirst = false;
} else {
    $condition .= " and `contact_id` $key :contactIdKey";
}
if($type == 'str') {
    $params[] = array(':contactIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contactIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `contact_id` =  :contactIdKey';
$isFirst=false;
}else{
$condition.=' and `contact_id` =  :contactIdKey';
}
$params[]=array(':contactIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($contactVo->customerId)){ //If isset Vo->element
$fieldValue=$contactVo->customerId;
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

if (!is_null($contactVo->name)){ //If isset Vo->element
$fieldValue=$contactVo->name;
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

if (!is_null($contactVo->email)){ //If isset Vo->element
$fieldValue=$contactVo->email;
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

if (!is_null($contactVo->phone)){ //If isset Vo->element
$fieldValue=$contactVo->phone;
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

if (!is_null($contactVo->address)){ //If isset Vo->element
$fieldValue=$contactVo->address;
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

if (!is_null($contactVo->subject)){ //If isset Vo->element
$fieldValue=$contactVo->subject;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subject` $key :subjectKey";
    $isFirst = false;
} else {
    $condition .= " and `subject` $key :subjectKey";
}
if($type == 'str') {
    $params[] = array(':subjectKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subjectKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subject` =  :subjectKey';
$isFirst=false;
}else{
$condition.=' and `subject` =  :subjectKey';
}
$params[]=array(':subjectKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($contactVo->message)){ //If isset Vo->element
$fieldValue=$contactVo->message;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `message` $key :messageKey";
    $isFirst = false;
} else {
    $condition .= " and `message` $key :messageKey";
}
if($type == 'str') {
    $params[] = array(':messageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':messageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `message` =  :messageKey';
$isFirst=false;
}else{
$condition.=' and `message` =  :messageKey';
}
$params[]=array(':messageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($contactVo->status)){ //If isset Vo->element
$fieldValue=$contactVo->status;
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

if (!is_null($contactVo->crtDate)){ //If isset Vo->element
$fieldValue=$contactVo->crtDate;
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

if (!is_null($contactVo->crtBy)){ //If isset Vo->element
$fieldValue=$contactVo->crtBy;
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

if (!is_null($contactVo->modDate)){ //If isset Vo->element
$fieldValue=$contactVo->modDate;
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

if (!is_null($contactVo->modBy)){ //If isset Vo->element
$fieldValue=$contactVo->modBy;
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
return PersistentHelper::mapResult('ContactVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($contactVo){
try {
if (empty($contactVo)) $contactVo = new ContactVo();
$sql = "select count(*) as total from  contact ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($contactVo->contactId)){ //If isset Vo->element
$fieldValue=$contactVo->contactId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `contact_id` $key :contactIdKey";
    $isFirst = false;
} else {
    $condition .= " and `contact_id` $key :contactIdKey";
}
if($type == 'str') {
    $params[] = array(':contactIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contactIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `contact_id` =  :contactIdKey';
$isFirst=false;
}else{
$condition.=' and `contact_id` =  :contactIdKey';
}
$params[]=array(':contactIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($contactVo->customerId)){ //If isset Vo->element
$fieldValue=$contactVo->customerId;
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

if (!is_null($contactVo->name)){ //If isset Vo->element
$fieldValue=$contactVo->name;
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

if (!is_null($contactVo->email)){ //If isset Vo->element
$fieldValue=$contactVo->email;
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

if (!is_null($contactVo->phone)){ //If isset Vo->element
$fieldValue=$contactVo->phone;
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

if (!is_null($contactVo->address)){ //If isset Vo->element
$fieldValue=$contactVo->address;
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

if (!is_null($contactVo->subject)){ //If isset Vo->element
$fieldValue=$contactVo->subject;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subject` $key :subjectKey";
    $isFirst = false;
} else {
    $condition .= " and `subject` $key :subjectKey";
}
if($type == 'str') {
    $params[] = array(':subjectKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subjectKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subject` =  :subjectKey';
$isFirst=false;
}else{
$condition.=' and `subject` =  :subjectKey';
}
$params[]=array(':subjectKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($contactVo->message)){ //If isset Vo->element
$fieldValue=$contactVo->message;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `message` $key :messageKey";
    $isFirst = false;
} else {
    $condition .= " and `message` $key :messageKey";
}
if($type == 'str') {
    $params[] = array(':messageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':messageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `message` =  :messageKey';
$isFirst=false;
}else{
$condition.=' and `message` =  :messageKey';
}
$params[]=array(':messageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($contactVo->status)){ //If isset Vo->element
$fieldValue=$contactVo->status;
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

if (!is_null($contactVo->crtDate)){ //If isset Vo->element
$fieldValue=$contactVo->crtDate;
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

if (!is_null($contactVo->crtBy)){ //If isset Vo->element
$fieldValue=$contactVo->crtBy;
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

if (!is_null($contactVo->modDate)){ //If isset Vo->element
$fieldValue=$contactVo->modDate;
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

if (!is_null($contactVo->modBy)){ //If isset Vo->element
$fieldValue=$contactVo->modBy;
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


public function updateByPrimaryKey($contactVo,$contactId){
try {
$sql="UPDATE `contact` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($contactVo->contactId)){
if ($isFirst){
$updateFields.=' `contact_id`= :contactId';
$isFirst=false;}else{
$updateFields.=', `contact_id`= :contactId';
}
$params[]=array(':contactId', $contactVo->contactId, PDO::PARAM_INT);
}

if (isset($contactVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $contactVo->customerId, PDO::PARAM_INT);
}

if (isset($contactVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $contactVo->name, PDO::PARAM_STR);
}

if (isset($contactVo->email)){
if ($isFirst){
$updateFields.=' `email`= :email';
$isFirst=false;}else{
$updateFields.=', `email`= :email';
}
$params[]=array(':email', $contactVo->email, PDO::PARAM_STR);
}

if (isset($contactVo->phone)){
if ($isFirst){
$updateFields.=' `phone`= :phone';
$isFirst=false;}else{
$updateFields.=', `phone`= :phone';
}
$params[]=array(':phone', $contactVo->phone, PDO::PARAM_STR);
}

if (isset($contactVo->address)){
if ($isFirst){
$updateFields.=' `address`= :address';
$isFirst=false;}else{
$updateFields.=', `address`= :address';
}
$params[]=array(':address', $contactVo->address, PDO::PARAM_STR);
}

if (isset($contactVo->subject)){
if ($isFirst){
$updateFields.=' `subject`= :subject';
$isFirst=false;}else{
$updateFields.=', `subject`= :subject';
}
$params[]=array(':subject', $contactVo->subject, PDO::PARAM_STR);
}

if (isset($contactVo->message)){
if ($isFirst){
$updateFields.=' `message`= :message';
$isFirst=false;}else{
$updateFields.=', `message`= :message';
}
$params[]=array(':message', $contactVo->message, PDO::PARAM_STR);
}

if (isset($contactVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $contactVo->status, PDO::PARAM_STR);
}

if (isset($contactVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $contactVo->crtDate, PDO::PARAM_STR);
}

if (isset($contactVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $contactVo->crtBy, PDO::PARAM_INT);
}

if (isset($contactVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $contactVo->modDate, PDO::PARAM_STR);
}

if (isset($contactVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $contactVo->modBy, PDO::PARAM_INT);
}

$conditions.=' where `contact_id`= :contactId';
$params[]=array(':contactId', $contactId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (contactId)
	 * Example
	 * getValueByPrimaryKey('contactName', 1)
	 * Get value of filed contactName in table contact where contactId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$contactVo = $this->selectByPrimaryKey($primaryValue);
		if($contactVo){
			return $contactVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('contactName', array('contactId' => 1))
	 * Get value of filed contactName in table contact where contactId = 1
	 */
	public function getValueByField($fieldName, $where){
		$contactVo = new ContactVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$contactVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$contactVos = $this->selectByFilter($contactVo);
       
		if($contactVos){
			$contactVo = $contactVos[0];
			return $contactVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table contact
	 *
	 * @param int $contact_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($contactId){
		try {
		    $sql = "DELETE FROM `contact` where `contact_id` = :contactId";
		    $params = array();
		    $params[] = array(':contactId', $contactId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table contact
	 *
	 * @param object $contactVo
	 * @return boolean
	 */
	public function deleteByFilter($contactVo){
		try {
			$sql = 'DELETE FROM `contact`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($contactVo->contactId)){
				$isDel = true;
				$condition[] = '`contact_id` = :contactId';
				$params[] = array(':contactId', $contactVo->contactId, PDO::PARAM_INT);
			}
			if (!is_null($contactVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $contactVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($contactVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $contactVo->name, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->email)){
				$isDel = true;
				$condition[] = '`email` = :email';
				$params[] = array(':email', $contactVo->email, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->phone)){
				$isDel = true;
				$condition[] = '`phone` = :phone';
				$params[] = array(':phone', $contactVo->phone, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->address)){
				$isDel = true;
				$condition[] = '`address` = :address';
				$params[] = array(':address', $contactVo->address, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->subject)){
				$isDel = true;
				$condition[] = '`subject` = :subject';
				$params[] = array(':subject', $contactVo->subject, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->message)){
				$isDel = true;
				$condition[] = '`message` = :message';
				$params[] = array(':message', $contactVo->message, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $contactVo->status, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $contactVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $contactVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($contactVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $contactVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($contactVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $contactVo->modBy, PDO::PARAM_INT);
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
