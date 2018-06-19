<?php
class CustomerAddressDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `customer_address`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CustomerAddressVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($customerAddressId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `customer_address` where `customer_address_id` = :customerAddressId");
$stmt->bindParam(':customerAddressId',$customerAddressId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CustomerAddressVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($customerAddressVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer_address`( `customer_id`, `title`, `address`, `default_shipping`, `default_billing`, `country_id`, `state_id`, `city_id`, `district_id`, `post_code`)
VALUES( :customerId, :title, :address, :defaultShipping, :defaultBilling, :countryId, :stateId, :cityId, :districtId, :postCode)");
$stmt->bindParam(':customerId', $customerAddressVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':title', $customerAddressVo->title, PDO::PARAM_STR);
$stmt->bindParam(':address', $customerAddressVo->address, PDO::PARAM_STR);
$stmt->bindParam(':defaultShipping', $customerAddressVo->defaultShipping, PDO::PARAM_INT);
$stmt->bindParam(':defaultBilling', $customerAddressVo->defaultBilling, PDO::PARAM_INT);
$stmt->bindParam(':countryId', $customerAddressVo->countryId, PDO::PARAM_INT);
$stmt->bindParam(':stateId', $customerAddressVo->stateId, PDO::PARAM_INT);
$stmt->bindParam(':cityId', $customerAddressVo->cityId, PDO::PARAM_INT);
$stmt->bindParam(':districtId', $customerAddressVo->districtId, PDO::PARAM_INT);
$stmt->bindParam(':postCode', $customerAddressVo->postCode, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($customerAddressVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer_address`( `customer_id`, `title`, `address`, `default_shipping`, `default_billing`, `country_id`, `state_id`, `city_id`, `district_id`, `post_code`)
VALUES( :customerId, :title, :address, :defaultShipping, :defaultBilling, :countryId, :stateId, :cityId, :districtId, :postCode)");
$stmt->bindParam(':customerId', $customerAddressVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':title', $customerAddressVo->title, PDO::PARAM_STR);
$stmt->bindParam(':address', $customerAddressVo->address, PDO::PARAM_STR);
$stmt->bindParam(':defaultShipping', $customerAddressVo->defaultShipping, PDO::PARAM_INT);
$stmt->bindParam(':defaultBilling', $customerAddressVo->defaultBilling, PDO::PARAM_INT);
$stmt->bindParam(':countryId', $customerAddressVo->countryId, PDO::PARAM_INT);
$stmt->bindParam(':stateId', $customerAddressVo->stateId, PDO::PARAM_INT);
$stmt->bindParam(':cityId', $customerAddressVo->cityId, PDO::PARAM_INT);
$stmt->bindParam(':districtId', $customerAddressVo->districtId, PDO::PARAM_INT);
$stmt->bindParam(':postCode', $customerAddressVo->postCode, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table customer_address by $customerAddressVo object filter use paging
 * 
 * @param object $customerAddressVo is customer_address object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($customerAddressVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($customerAddressVo)) $customerAddressVo = new CustomerAddressVo();
$sql = "select * from `customer_address` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerAddressVo->customerAddressId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->customerAddressId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_address_id` $key :customerAddressIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_address_id` $key :customerAddressIdKey";
}
if($type == 'str') {
    $params[] = array(':customerAddressIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerAddressIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_address_id` =  :customerAddressIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_address_id` =  :customerAddressIdKey';
}
$params[]=array(':customerAddressIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->customerId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->customerId;
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

if (!is_null($customerAddressVo->title)){ //If isset Vo->element
$fieldValue=$customerAddressVo->title;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `title` $key :titleKey";
    $isFirst = false;
} else {
    $condition .= " and `title` $key :titleKey";
}
if($type == 'str') {
    $params[] = array(':titleKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':titleKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `title` =  :titleKey';
$isFirst=false;
}else{
$condition.=' and `title` =  :titleKey';
}
$params[]=array(':titleKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerAddressVo->address)){ //If isset Vo->element
$fieldValue=$customerAddressVo->address;
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

if (!is_null($customerAddressVo->defaultShipping)){ //If isset Vo->element
$fieldValue=$customerAddressVo->defaultShipping;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default_shipping` $key :defaultShippingKey";
    $isFirst = false;
} else {
    $condition .= " and `default_shipping` $key :defaultShippingKey";
}
if($type == 'str') {
    $params[] = array(':defaultShippingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultShippingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default_shipping` =  :defaultShippingKey';
$isFirst=false;
}else{
$condition.=' and `default_shipping` =  :defaultShippingKey';
}
$params[]=array(':defaultShippingKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->defaultBilling)){ //If isset Vo->element
$fieldValue=$customerAddressVo->defaultBilling;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default_billing` $key :defaultBillingKey";
    $isFirst = false;
} else {
    $condition .= " and `default_billing` $key :defaultBillingKey";
}
if($type == 'str') {
    $params[] = array(':defaultBillingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultBillingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default_billing` =  :defaultBillingKey';
$isFirst=false;
}else{
$condition.=' and `default_billing` =  :defaultBillingKey';
}
$params[]=array(':defaultBillingKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->countryId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->countryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `country_id` $key :countryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `country_id` $key :countryIdKey";
}
if($type == 'str') {
    $params[] = array(':countryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `country_id` =  :countryIdKey';
$isFirst=false;
}else{
$condition.=' and `country_id` =  :countryIdKey';
}
$params[]=array(':countryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->stateId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->stateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `state_id` $key :stateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `state_id` $key :stateIdKey";
}
if($type == 'str') {
    $params[] = array(':stateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':stateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `state_id` =  :stateIdKey';
$isFirst=false;
}else{
$condition.=' and `state_id` =  :stateIdKey';
}
$params[]=array(':stateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->cityId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->cityId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `city_id` $key :cityIdKey";
    $isFirst = false;
} else {
    $condition .= " and `city_id` $key :cityIdKey";
}
if($type == 'str') {
    $params[] = array(':cityIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':cityIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `city_id` =  :cityIdKey';
$isFirst=false;
}else{
$condition.=' and `city_id` =  :cityIdKey';
}
$params[]=array(':cityIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->districtId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->districtId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `district_id` $key :districtIdKey";
    $isFirst = false;
} else {
    $condition .= " and `district_id` $key :districtIdKey";
}
if($type == 'str') {
    $params[] = array(':districtIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':districtIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `district_id` =  :districtIdKey';
$isFirst=false;
}else{
$condition.=' and `district_id` =  :districtIdKey';
}
$params[]=array(':districtIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->postCode)){ //If isset Vo->element
$fieldValue=$customerAddressVo->postCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `post_code` $key :postCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `post_code` $key :postCodeKey";
}
if($type == 'str') {
    $params[] = array(':postCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':postCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `post_code` =  :postCodeKey';
$isFirst=false;
}else{
$condition.=' and `post_code` =  :postCodeKey';
}
$params[]=array(':postCodeKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('CustomerAddressVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($customerAddressVo){
try {
if (empty($customerAddressVo)) $customerAddressVo = new CustomerAddressVo();
$sql = "select count(*) as total from  customer_address ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerAddressVo->customerAddressId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->customerAddressId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_address_id` $key :customerAddressIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_address_id` $key :customerAddressIdKey";
}
if($type == 'str') {
    $params[] = array(':customerAddressIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerAddressIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_address_id` =  :customerAddressIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_address_id` =  :customerAddressIdKey';
}
$params[]=array(':customerAddressIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->customerId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->customerId;
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

if (!is_null($customerAddressVo->title)){ //If isset Vo->element
$fieldValue=$customerAddressVo->title;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `title` $key :titleKey";
    $isFirst = false;
} else {
    $condition .= " and `title` $key :titleKey";
}
if($type == 'str') {
    $params[] = array(':titleKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':titleKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `title` =  :titleKey';
$isFirst=false;
}else{
$condition.=' and `title` =  :titleKey';
}
$params[]=array(':titleKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerAddressVo->address)){ //If isset Vo->element
$fieldValue=$customerAddressVo->address;
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

if (!is_null($customerAddressVo->defaultShipping)){ //If isset Vo->element
$fieldValue=$customerAddressVo->defaultShipping;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default_shipping` $key :defaultShippingKey";
    $isFirst = false;
} else {
    $condition .= " and `default_shipping` $key :defaultShippingKey";
}
if($type == 'str') {
    $params[] = array(':defaultShippingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultShippingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default_shipping` =  :defaultShippingKey';
$isFirst=false;
}else{
$condition.=' and `default_shipping` =  :defaultShippingKey';
}
$params[]=array(':defaultShippingKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->defaultBilling)){ //If isset Vo->element
$fieldValue=$customerAddressVo->defaultBilling;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `default_billing` $key :defaultBillingKey";
    $isFirst = false;
} else {
    $condition .= " and `default_billing` $key :defaultBillingKey";
}
if($type == 'str') {
    $params[] = array(':defaultBillingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':defaultBillingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `default_billing` =  :defaultBillingKey';
$isFirst=false;
}else{
$condition.=' and `default_billing` =  :defaultBillingKey';
}
$params[]=array(':defaultBillingKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->countryId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->countryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `country_id` $key :countryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `country_id` $key :countryIdKey";
}
if($type == 'str') {
    $params[] = array(':countryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `country_id` =  :countryIdKey';
$isFirst=false;
}else{
$condition.=' and `country_id` =  :countryIdKey';
}
$params[]=array(':countryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->stateId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->stateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `state_id` $key :stateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `state_id` $key :stateIdKey";
}
if($type == 'str') {
    $params[] = array(':stateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':stateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `state_id` =  :stateIdKey';
$isFirst=false;
}else{
$condition.=' and `state_id` =  :stateIdKey';
}
$params[]=array(':stateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->cityId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->cityId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `city_id` $key :cityIdKey";
    $isFirst = false;
} else {
    $condition .= " and `city_id` $key :cityIdKey";
}
if($type == 'str') {
    $params[] = array(':cityIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':cityIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `city_id` =  :cityIdKey';
$isFirst=false;
}else{
$condition.=' and `city_id` =  :cityIdKey';
}
$params[]=array(':cityIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->districtId)){ //If isset Vo->element
$fieldValue=$customerAddressVo->districtId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `district_id` $key :districtIdKey";
    $isFirst = false;
} else {
    $condition .= " and `district_id` $key :districtIdKey";
}
if($type == 'str') {
    $params[] = array(':districtIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':districtIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `district_id` =  :districtIdKey';
$isFirst=false;
}else{
$condition.=' and `district_id` =  :districtIdKey';
}
$params[]=array(':districtIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerAddressVo->postCode)){ //If isset Vo->element
$fieldValue=$customerAddressVo->postCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `post_code` $key :postCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `post_code` $key :postCodeKey";
}
if($type == 'str') {
    $params[] = array(':postCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':postCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `post_code` =  :postCodeKey';
$isFirst=false;
}else{
$condition.=' and `post_code` =  :postCodeKey';
}
$params[]=array(':postCodeKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($customerAddressVo,$customerAddressId){
try {
$sql="UPDATE `customer_address` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($customerAddressVo->customerAddressId)){
if ($isFirst){
$updateFields.=' `customer_address_id`= :customerAddressId';
$isFirst=false;}else{
$updateFields.=', `customer_address_id`= :customerAddressId';
}
$params[]=array(':customerAddressId', $customerAddressVo->customerAddressId, PDO::PARAM_INT);
}

if (isset($customerAddressVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $customerAddressVo->customerId, PDO::PARAM_INT);
}

if (isset($customerAddressVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $customerAddressVo->title, PDO::PARAM_STR);
}

if (isset($customerAddressVo->address)){
if ($isFirst){
$updateFields.=' `address`= :address';
$isFirst=false;}else{
$updateFields.=', `address`= :address';
}
$params[]=array(':address', $customerAddressVo->address, PDO::PARAM_STR);
}

if (isset($customerAddressVo->defaultShipping)){
if ($isFirst){
$updateFields.=' `default_shipping`= :defaultShipping';
$isFirst=false;}else{
$updateFields.=', `default_shipping`= :defaultShipping';
}
$params[]=array(':defaultShipping', $customerAddressVo->defaultShipping, PDO::PARAM_INT);
}

if (isset($customerAddressVo->defaultBilling)){
if ($isFirst){
$updateFields.=' `default_billing`= :defaultBilling';
$isFirst=false;}else{
$updateFields.=', `default_billing`= :defaultBilling';
}
$params[]=array(':defaultBilling', $customerAddressVo->defaultBilling, PDO::PARAM_INT);
}

if (isset($customerAddressVo->countryId)){
if ($isFirst){
$updateFields.=' `country_id`= :countryId';
$isFirst=false;}else{
$updateFields.=', `country_id`= :countryId';
}
$params[]=array(':countryId', $customerAddressVo->countryId, PDO::PARAM_INT);
}

if (isset($customerAddressVo->stateId)){
if ($isFirst){
$updateFields.=' `state_id`= :stateId';
$isFirst=false;}else{
$updateFields.=', `state_id`= :stateId';
}
$params[]=array(':stateId', $customerAddressVo->stateId, PDO::PARAM_INT);
}

if (isset($customerAddressVo->cityId)){
if ($isFirst){
$updateFields.=' `city_id`= :cityId';
$isFirst=false;}else{
$updateFields.=', `city_id`= :cityId';
}
$params[]=array(':cityId', $customerAddressVo->cityId, PDO::PARAM_INT);
}

if (isset($customerAddressVo->districtId)){
if ($isFirst){
$updateFields.=' `district_id`= :districtId';
$isFirst=false;}else{
$updateFields.=', `district_id`= :districtId';
}
$params[]=array(':districtId', $customerAddressVo->districtId, PDO::PARAM_INT);
}

if (isset($customerAddressVo->postCode)){
if ($isFirst){
$updateFields.=' `post_code`= :postCode';
$isFirst=false;}else{
$updateFields.=', `post_code`= :postCode';
}
$params[]=array(':postCode', $customerAddressVo->postCode, PDO::PARAM_STR);
}

$conditions.=' where `customer_address_id`= :customerAddressId';
$params[]=array(':customerAddressId', $customerAddressId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (customerAddressId)
	 * Example
	 * getValueByPrimaryKey('customerAddressName', 1)
	 * Get value of filed customerAddressName in table customerAddress where customerAddressId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$customerAddressVo = $this->selectByPrimaryKey($primaryValue);
		if($customerAddressVo){
			return $customerAddressVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('customerAddressName', array('customerAddressId' => 1))
	 * Get value of filed customerAddressName in table customerAddress where customerAddressId = 1
	 */
	public function getValueByField($fieldName, $where){
		$customerAddressVo = new CustomerAddressVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$customerAddressVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$customerAddressVos = $this->selectByFilter($customerAddressVo);
       
		if($customerAddressVos){
			$customerAddressVo = $customerAddressVos[0];
			return $customerAddressVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table customer_address
	 *
	 * @param int $customer_address_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($customerAddressId){
		try {
		    $sql = "DELETE FROM `customer_address` where `customer_address_id` = :customerAddressId";
		    $params = array();
		    $params[] = array(':customerAddressId', $customerAddressId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table customer_address
	 *
	 * @param object $customerAddressVo
	 * @return boolean
	 */
	public function deleteByFilter($customerAddressVo){
		try {
			$sql = 'DELETE FROM `customer_address`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($customerAddressVo->customerAddressId)){
				$isDel = true;
				$condition[] = '`customer_address_id` = :customerAddressId';
				$params[] = array(':customerAddressId', $customerAddressVo->customerAddressId, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $customerAddressVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $customerAddressVo->title, PDO::PARAM_STR);
			}
			if (!is_null($customerAddressVo->address)){
				$isDel = true;
				$condition[] = '`address` = :address';
				$params[] = array(':address', $customerAddressVo->address, PDO::PARAM_STR);
			}
			if (!is_null($customerAddressVo->defaultShipping)){
				$isDel = true;
				$condition[] = '`default_shipping` = :defaultShipping';
				$params[] = array(':defaultShipping', $customerAddressVo->defaultShipping, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->defaultBilling)){
				$isDel = true;
				$condition[] = '`default_billing` = :defaultBilling';
				$params[] = array(':defaultBilling', $customerAddressVo->defaultBilling, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->countryId)){
				$isDel = true;
				$condition[] = '`country_id` = :countryId';
				$params[] = array(':countryId', $customerAddressVo->countryId, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->stateId)){
				$isDel = true;
				$condition[] = '`state_id` = :stateId';
				$params[] = array(':stateId', $customerAddressVo->stateId, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->cityId)){
				$isDel = true;
				$condition[] = '`city_id` = :cityId';
				$params[] = array(':cityId', $customerAddressVo->cityId, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->districtId)){
				$isDel = true;
				$condition[] = '`district_id` = :districtId';
				$params[] = array(':districtId', $customerAddressVo->districtId, PDO::PARAM_INT);
			}
			if (!is_null($customerAddressVo->postCode)){
				$isDel = true;
				$condition[] = '`post_code` = :postCode';
				$params[] = array(':postCode', $customerAddressVo->postCode, PDO::PARAM_STR);
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
