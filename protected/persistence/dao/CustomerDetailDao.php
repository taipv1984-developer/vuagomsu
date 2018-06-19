<?php
class CustomerDetailDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `customer_detail`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CustomerDetailVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($customerDetailId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `customer_detail` where `customer_detail_id` = :customerDetailId");
$stmt->bindParam(':customerDetailId',$customerDetailId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CustomerDetailVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($customerDetailVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer_detail`( `customer_id`, `first_name`, `last_name`, `phone`, `image`, `gender`, `birthday`, `receive_email`)
VALUES( :customerId, :firstName, :lastName, :phone, :image, :gender, :birthday, :receiveEmail)");
$stmt->bindParam(':customerId', $customerDetailVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':firstName', $customerDetailVo->firstName, PDO::PARAM_STR);
$stmt->bindParam(':lastName', $customerDetailVo->lastName, PDO::PARAM_STR);
$stmt->bindParam(':phone', $customerDetailVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':image', $customerDetailVo->image, PDO::PARAM_STR);
$stmt->bindParam(':gender', $customerDetailVo->gender, PDO::PARAM_INT);
$stmt->bindParam(':birthday', $customerDetailVo->birthday, PDO::PARAM_STR);
$stmt->bindParam(':receiveEmail', $customerDetailVo->receiveEmail, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($customerDetailVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer_detail`( `customer_id`, `first_name`, `last_name`, `phone`, `image`, `gender`, `birthday`, `receive_email`)
VALUES( :customerId, :firstName, :lastName, :phone, :image, :gender, :birthday, :receiveEmail)");
$stmt->bindParam(':customerId', $customerDetailVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':firstName', $customerDetailVo->firstName, PDO::PARAM_STR);
$stmt->bindParam(':lastName', $customerDetailVo->lastName, PDO::PARAM_STR);
$stmt->bindParam(':phone', $customerDetailVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':image', $customerDetailVo->image, PDO::PARAM_STR);
$stmt->bindParam(':gender', $customerDetailVo->gender, PDO::PARAM_INT);
$stmt->bindParam(':birthday', $customerDetailVo->birthday, PDO::PARAM_STR);
$stmt->bindParam(':receiveEmail', $customerDetailVo->receiveEmail, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table customer_detail by $customerDetailVo object filter use paging
 * 
 * @param object $customerDetailVo is customer_detail object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($customerDetailVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($customerDetailVo)) $customerDetailVo = new CustomerDetailVo();
$sql = "select * from `customer_detail` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerDetailVo->customerDetailId)){ //If isset Vo->element
$fieldValue=$customerDetailVo->customerDetailId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_detail_id` $key :customerDetailIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_detail_id` $key :customerDetailIdKey";
}
if($type == 'str') {
    $params[] = array(':customerDetailIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerDetailIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_detail_id` =  :customerDetailIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_detail_id` =  :customerDetailIdKey';
}
$params[]=array(':customerDetailIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerDetailVo->customerId)){ //If isset Vo->element
$fieldValue=$customerDetailVo->customerId;
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

if (!is_null($customerDetailVo->firstName)){ //If isset Vo->element
$fieldValue=$customerDetailVo->firstName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `first_name` $key :firstNameKey";
    $isFirst = false;
} else {
    $condition .= " and `first_name` $key :firstNameKey";
}
if($type == 'str') {
    $params[] = array(':firstNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':firstNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `first_name` =  :firstNameKey';
$isFirst=false;
}else{
$condition.=' and `first_name` =  :firstNameKey';
}
$params[]=array(':firstNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerDetailVo->lastName)){ //If isset Vo->element
$fieldValue=$customerDetailVo->lastName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `last_name` $key :lastNameKey";
    $isFirst = false;
} else {
    $condition .= " and `last_name` $key :lastNameKey";
}
if($type == 'str') {
    $params[] = array(':lastNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':lastNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `last_name` =  :lastNameKey';
$isFirst=false;
}else{
$condition.=' and `last_name` =  :lastNameKey';
}
$params[]=array(':lastNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerDetailVo->phone)){ //If isset Vo->element
$fieldValue=$customerDetailVo->phone;
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

if (!is_null($customerDetailVo->image)){ //If isset Vo->element
$fieldValue=$customerDetailVo->image;
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

if (!is_null($customerDetailVo->gender)){ //If isset Vo->element
$fieldValue=$customerDetailVo->gender;
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

if (!is_null($customerDetailVo->birthday)){ //If isset Vo->element
$fieldValue=$customerDetailVo->birthday;
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

if (!is_null($customerDetailVo->receiveEmail)){ //If isset Vo->element
$fieldValue=$customerDetailVo->receiveEmail;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `receive_email` $key :receiveEmailKey";
    $isFirst = false;
} else {
    $condition .= " and `receive_email` $key :receiveEmailKey";
}
if($type == 'str') {
    $params[] = array(':receiveEmailKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':receiveEmailKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `receive_email` =  :receiveEmailKey';
$isFirst=false;
}else{
$condition.=' and `receive_email` =  :receiveEmailKey';
}
$params[]=array(':receiveEmailKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('CustomerDetailVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($customerDetailVo){
try {
if (empty($customerDetailVo)) $customerDetailVo = new CustomerDetailVo();
$sql = "select count(*) as total from  customer_detail ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerDetailVo->customerDetailId)){ //If isset Vo->element
$fieldValue=$customerDetailVo->customerDetailId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_detail_id` $key :customerDetailIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_detail_id` $key :customerDetailIdKey";
}
if($type == 'str') {
    $params[] = array(':customerDetailIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerDetailIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_detail_id` =  :customerDetailIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_detail_id` =  :customerDetailIdKey';
}
$params[]=array(':customerDetailIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerDetailVo->customerId)){ //If isset Vo->element
$fieldValue=$customerDetailVo->customerId;
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

if (!is_null($customerDetailVo->firstName)){ //If isset Vo->element
$fieldValue=$customerDetailVo->firstName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `first_name` $key :firstNameKey";
    $isFirst = false;
} else {
    $condition .= " and `first_name` $key :firstNameKey";
}
if($type == 'str') {
    $params[] = array(':firstNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':firstNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `first_name` =  :firstNameKey';
$isFirst=false;
}else{
$condition.=' and `first_name` =  :firstNameKey';
}
$params[]=array(':firstNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerDetailVo->lastName)){ //If isset Vo->element
$fieldValue=$customerDetailVo->lastName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `last_name` $key :lastNameKey";
    $isFirst = false;
} else {
    $condition .= " and `last_name` $key :lastNameKey";
}
if($type == 'str') {
    $params[] = array(':lastNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':lastNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `last_name` =  :lastNameKey';
$isFirst=false;
}else{
$condition.=' and `last_name` =  :lastNameKey';
}
$params[]=array(':lastNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerDetailVo->phone)){ //If isset Vo->element
$fieldValue=$customerDetailVo->phone;
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

if (!is_null($customerDetailVo->image)){ //If isset Vo->element
$fieldValue=$customerDetailVo->image;
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

if (!is_null($customerDetailVo->gender)){ //If isset Vo->element
$fieldValue=$customerDetailVo->gender;
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

if (!is_null($customerDetailVo->birthday)){ //If isset Vo->element
$fieldValue=$customerDetailVo->birthday;
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

if (!is_null($customerDetailVo->receiveEmail)){ //If isset Vo->element
$fieldValue=$customerDetailVo->receiveEmail;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `receive_email` $key :receiveEmailKey";
    $isFirst = false;
} else {
    $condition .= " and `receive_email` $key :receiveEmailKey";
}
if($type == 'str') {
    $params[] = array(':receiveEmailKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':receiveEmailKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `receive_email` =  :receiveEmailKey';
$isFirst=false;
}else{
$condition.=' and `receive_email` =  :receiveEmailKey';
}
$params[]=array(':receiveEmailKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($customerDetailVo,$customerDetailId){
try {
$sql="UPDATE `customer_detail` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($customerDetailVo->customerDetailId)){
if ($isFirst){
$updateFields.=' `customer_detail_id`= :customerDetailId';
$isFirst=false;}else{
$updateFields.=', `customer_detail_id`= :customerDetailId';
}
$params[]=array(':customerDetailId', $customerDetailVo->customerDetailId, PDO::PARAM_INT);
}

if (isset($customerDetailVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $customerDetailVo->customerId, PDO::PARAM_INT);
}

if (isset($customerDetailVo->firstName)){
if ($isFirst){
$updateFields.=' `first_name`= :firstName';
$isFirst=false;}else{
$updateFields.=', `first_name`= :firstName';
}
$params[]=array(':firstName', $customerDetailVo->firstName, PDO::PARAM_STR);
}

if (isset($customerDetailVo->lastName)){
if ($isFirst){
$updateFields.=' `last_name`= :lastName';
$isFirst=false;}else{
$updateFields.=', `last_name`= :lastName';
}
$params[]=array(':lastName', $customerDetailVo->lastName, PDO::PARAM_STR);
}

if (isset($customerDetailVo->phone)){
if ($isFirst){
$updateFields.=' `phone`= :phone';
$isFirst=false;}else{
$updateFields.=', `phone`= :phone';
}
$params[]=array(':phone', $customerDetailVo->phone, PDO::PARAM_STR);
}

if (isset($customerDetailVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $customerDetailVo->image, PDO::PARAM_STR);
}

if (isset($customerDetailVo->gender)){
if ($isFirst){
$updateFields.=' `gender`= :gender';
$isFirst=false;}else{
$updateFields.=', `gender`= :gender';
}
$params[]=array(':gender', $customerDetailVo->gender, PDO::PARAM_INT);
}

if (isset($customerDetailVo->birthday)){
if ($isFirst){
$updateFields.=' `birthday`= :birthday';
$isFirst=false;}else{
$updateFields.=', `birthday`= :birthday';
}
$params[]=array(':birthday', $customerDetailVo->birthday, PDO::PARAM_STR);
}

if (isset($customerDetailVo->receiveEmail)){
if ($isFirst){
$updateFields.=' `receive_email`= :receiveEmail';
$isFirst=false;}else{
$updateFields.=', `receive_email`= :receiveEmail';
}
$params[]=array(':receiveEmail', $customerDetailVo->receiveEmail, PDO::PARAM_INT);
}

$conditions.=' where `customer_detail_id`= :customerDetailId';
$params[]=array(':customerDetailId', $customerDetailId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (customerDetailId)
	 * Example
	 * getValueByPrimaryKey('customerDetailName', 1)
	 * Get value of filed customerDetailName in table customerDetail where customerDetailId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$customerDetailVo = $this->selectByPrimaryKey($primaryValue);
		if($customerDetailVo){
			return $customerDetailVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('customerDetailName', array('customerDetailId' => 1))
	 * Get value of filed customerDetailName in table customerDetail where customerDetailId = 1
	 */
	public function getValueByField($fieldName, $where){
		$customerDetailVo = new CustomerDetailVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$customerDetailVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$customerDetailVos = $this->selectByFilter($customerDetailVo);
       
		if($customerDetailVos){
			$customerDetailVo = $customerDetailVos[0];
			return $customerDetailVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table customer_detail
	 *
	 * @param int $customer_detail_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($customerDetailId){
		try {
		    $sql = "DELETE FROM `customer_detail` where `customer_detail_id` = :customerDetailId";
		    $params = array();
		    $params[] = array(':customerDetailId', $customerDetailId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table customer_detail
	 *
	 * @param object $customerDetailVo
	 * @return boolean
	 */
	public function deleteByFilter($customerDetailVo){
		try {
			$sql = 'DELETE FROM `customer_detail`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($customerDetailVo->customerDetailId)){
				$isDel = true;
				$condition[] = '`customer_detail_id` = :customerDetailId';
				$params[] = array(':customerDetailId', $customerDetailVo->customerDetailId, PDO::PARAM_INT);
			}
			if (!is_null($customerDetailVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $customerDetailVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($customerDetailVo->firstName)){
				$isDel = true;
				$condition[] = '`first_name` = :firstName';
				$params[] = array(':firstName', $customerDetailVo->firstName, PDO::PARAM_STR);
			}
			if (!is_null($customerDetailVo->lastName)){
				$isDel = true;
				$condition[] = '`last_name` = :lastName';
				$params[] = array(':lastName', $customerDetailVo->lastName, PDO::PARAM_STR);
			}
			if (!is_null($customerDetailVo->phone)){
				$isDel = true;
				$condition[] = '`phone` = :phone';
				$params[] = array(':phone', $customerDetailVo->phone, PDO::PARAM_STR);
			}
			if (!is_null($customerDetailVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $customerDetailVo->image, PDO::PARAM_STR);
			}
			if (!is_null($customerDetailVo->gender)){
				$isDel = true;
				$condition[] = '`gender` = :gender';
				$params[] = array(':gender', $customerDetailVo->gender, PDO::PARAM_INT);
			}
			if (!is_null($customerDetailVo->birthday)){
				$isDel = true;
				$condition[] = '`birthday` = :birthday';
				$params[] = array(':birthday', $customerDetailVo->birthday, PDO::PARAM_STR);
			}
			if (!is_null($customerDetailVo->receiveEmail)){
				$isDel = true;
				$condition[] = '`receive_email` = :receiveEmail';
				$params[] = array(':receiveEmail', $customerDetailVo->receiveEmail, PDO::PARAM_INT);
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
