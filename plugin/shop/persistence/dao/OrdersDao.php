<?php
class OrdersDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `orders`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('OrdersVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($orderId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `orders` where `order_id` = :orderId");
$stmt->bindParam(':orderId',$orderId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('OrdersVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($ordersVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `orders`( `customer_id`, `guest_id`, `subtotal`, `total`, `total_weight`, `shipping_address_id`, `billing_address_id`, `same_address`, `note`, `order_status_id`, `is_del`, `crt_date`, `crt_by`, `mod_date`, `mod_by`, `no`, `discountType`, `discountValue`)
VALUES( :customerId, :guestId, :subtotal, :total, :totalWeight, :shippingAddressId, :billingAddressId, :sameAddress, :note, :orderStatusId, :isDel, :crtDate, :crtBy, :modDate, :modBy, :no, :discountType, :discountValue)");
$stmt->bindParam(':customerId', $ordersVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':guestId', $ordersVo->guestId, PDO::PARAM_INT);
$stmt->bindParam(':subtotal', $ordersVo->subtotal, PDO::PARAM_STR);
$stmt->bindParam(':total', $ordersVo->total, PDO::PARAM_STR);
$stmt->bindParam(':totalWeight', $ordersVo->totalWeight, PDO::PARAM_STR);
$stmt->bindParam(':shippingAddressId', $ordersVo->shippingAddressId, PDO::PARAM_INT);
$stmt->bindParam(':billingAddressId', $ordersVo->billingAddressId, PDO::PARAM_INT);
$stmt->bindParam(':sameAddress', $ordersVo->sameAddress, PDO::PARAM_INT);
$stmt->bindParam(':note', $ordersVo->note, PDO::PARAM_STR);
$stmt->bindParam(':orderStatusId', $ordersVo->orderStatusId, PDO::PARAM_INT);
$stmt->bindParam(':isDel', $ordersVo->isDel, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $ordersVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $ordersVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $ordersVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $ordersVo->modBy, PDO::PARAM_INT);
$stmt->bindParam(':no', $ordersVo->no, PDO::PARAM_INT);
$stmt->bindParam(':discountType', $ordersVo->discountType, PDO::PARAM_STR);
$stmt->bindParam(':discountValue', $ordersVo->discountValue, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($ordersVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `orders`( `customer_id`, `guest_id`, `subtotal`, `total`, `total_weight`, `shipping_address_id`, `billing_address_id`, `same_address`, `note`, `order_status_id`, `is_del`, `crt_date`, `crt_by`, `mod_date`, `mod_by`, `no`, `discountType`, `discountValue`)
VALUES( :customerId, :guestId, :subtotal, :total, :totalWeight, :shippingAddressId, :billingAddressId, :sameAddress, :note, :orderStatusId, :isDel, :crtDate, :crtBy, :modDate, :modBy, :no, :discountType, :discountValue)");
$stmt->bindParam(':customerId', $ordersVo->customerId, PDO::PARAM_INT);
$stmt->bindParam(':guestId', $ordersVo->guestId, PDO::PARAM_INT);
$stmt->bindParam(':subtotal', $ordersVo->subtotal, PDO::PARAM_STR);
$stmt->bindParam(':total', $ordersVo->total, PDO::PARAM_STR);
$stmt->bindParam(':totalWeight', $ordersVo->totalWeight, PDO::PARAM_STR);
$stmt->bindParam(':shippingAddressId', $ordersVo->shippingAddressId, PDO::PARAM_INT);
$stmt->bindParam(':billingAddressId', $ordersVo->billingAddressId, PDO::PARAM_INT);
$stmt->bindParam(':sameAddress', $ordersVo->sameAddress, PDO::PARAM_INT);
$stmt->bindParam(':note', $ordersVo->note, PDO::PARAM_STR);
$stmt->bindParam(':orderStatusId', $ordersVo->orderStatusId, PDO::PARAM_INT);
$stmt->bindParam(':isDel', $ordersVo->isDel, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $ordersVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $ordersVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $ordersVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $ordersVo->modBy, PDO::PARAM_INT);
$stmt->bindParam(':no', $ordersVo->no, PDO::PARAM_INT);
$stmt->bindParam(':discountType', $ordersVo->discountType, PDO::PARAM_STR);
$stmt->bindParam(':discountValue', $ordersVo->discountValue, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table orders by $ordersVo object filter use paging
 * 
 * @param object $ordersVo is orders object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($ordersVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($ordersVo)) $ordersVo = new OrdersVo();
$sql = "select * from `orders` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($ordersVo->orderId)){ //If isset Vo->element
$fieldValue=$ordersVo->orderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_id` $key :orderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_id` $key :orderIdKey";
}
if($type == 'str') {
    $params[] = array(':orderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_id` =  :orderIdKey';
$isFirst=false;
}else{
$condition.=' and `order_id` =  :orderIdKey';
}
$params[]=array(':orderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->customerId)){ //If isset Vo->element
$fieldValue=$ordersVo->customerId;
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

if (!is_null($ordersVo->guestId)){ //If isset Vo->element
$fieldValue=$ordersVo->guestId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `guest_id` $key :guestIdKey";
    $isFirst = false;
} else {
    $condition .= " and `guest_id` $key :guestIdKey";
}
if($type == 'str') {
    $params[] = array(':guestIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':guestIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `guest_id` =  :guestIdKey';
$isFirst=false;
}else{
$condition.=' and `guest_id` =  :guestIdKey';
}
$params[]=array(':guestIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->subtotal)){ //If isset Vo->element
$fieldValue=$ordersVo->subtotal;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subtotal` $key :subtotalKey";
    $isFirst = false;
} else {
    $condition .= " and `subtotal` $key :subtotalKey";
}
if($type == 'str') {
    $params[] = array(':subtotalKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subtotalKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subtotal` =  :subtotalKey';
$isFirst=false;
}else{
$condition.=' and `subtotal` =  :subtotalKey';
}
$params[]=array(':subtotalKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->total)){ //If isset Vo->element
$fieldValue=$ordersVo->total;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `total` $key :totalKey";
    $isFirst = false;
} else {
    $condition .= " and `total` $key :totalKey";
}
if($type == 'str') {
    $params[] = array(':totalKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':totalKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `total` =  :totalKey';
$isFirst=false;
}else{
$condition.=' and `total` =  :totalKey';
}
$params[]=array(':totalKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->totalWeight)){ //If isset Vo->element
$fieldValue=$ordersVo->totalWeight;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `total_weight` $key :totalWeightKey";
    $isFirst = false;
} else {
    $condition .= " and `total_weight` $key :totalWeightKey";
}
if($type == 'str') {
    $params[] = array(':totalWeightKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':totalWeightKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `total_weight` =  :totalWeightKey';
$isFirst=false;
}else{
$condition.=' and `total_weight` =  :totalWeightKey';
}
$params[]=array(':totalWeightKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->shippingAddressId)){ //If isset Vo->element
$fieldValue=$ordersVo->shippingAddressId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `shipping_address_id` $key :shippingAddressIdKey";
    $isFirst = false;
} else {
    $condition .= " and `shipping_address_id` $key :shippingAddressIdKey";
}
if($type == 'str') {
    $params[] = array(':shippingAddressIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':shippingAddressIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `shipping_address_id` =  :shippingAddressIdKey';
$isFirst=false;
}else{
$condition.=' and `shipping_address_id` =  :shippingAddressIdKey';
}
$params[]=array(':shippingAddressIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->billingAddressId)){ //If isset Vo->element
$fieldValue=$ordersVo->billingAddressId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `billing_address_id` $key :billingAddressIdKey";
    $isFirst = false;
} else {
    $condition .= " and `billing_address_id` $key :billingAddressIdKey";
}
if($type == 'str') {
    $params[] = array(':billingAddressIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':billingAddressIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `billing_address_id` =  :billingAddressIdKey';
$isFirst=false;
}else{
$condition.=' and `billing_address_id` =  :billingAddressIdKey';
}
$params[]=array(':billingAddressIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->sameAddress)){ //If isset Vo->element
$fieldValue=$ordersVo->sameAddress;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `same_address` $key :sameAddressKey";
    $isFirst = false;
} else {
    $condition .= " and `same_address` $key :sameAddressKey";
}
if($type == 'str') {
    $params[] = array(':sameAddressKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sameAddressKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `same_address` =  :sameAddressKey';
$isFirst=false;
}else{
$condition.=' and `same_address` =  :sameAddressKey';
}
$params[]=array(':sameAddressKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->note)){ //If isset Vo->element
$fieldValue=$ordersVo->note;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `note` $key :noteKey";
    $isFirst = false;
} else {
    $condition .= " and `note` $key :noteKey";
}
if($type == 'str') {
    $params[] = array(':noteKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noteKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `note` =  :noteKey';
$isFirst=false;
}else{
$condition.=' and `note` =  :noteKey';
}
$params[]=array(':noteKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->orderStatusId)){ //If isset Vo->element
$fieldValue=$ordersVo->orderStatusId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_status_id` $key :orderStatusIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_status_id` $key :orderStatusIdKey";
}
if($type == 'str') {
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_status_id` =  :orderStatusIdKey';
$isFirst=false;
}else{
$condition.=' and `order_status_id` =  :orderStatusIdKey';
}
$params[]=array(':orderStatusIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->isDel)){ //If isset Vo->element
$fieldValue=$ordersVo->isDel;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_del` $key :isDelKey";
    $isFirst = false;
} else {
    $condition .= " and `is_del` $key :isDelKey";
}
if($type == 'str') {
    $params[] = array(':isDelKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isDelKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_del` =  :isDelKey';
$isFirst=false;
}else{
$condition.=' and `is_del` =  :isDelKey';
}
$params[]=array(':isDelKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->crtDate)){ //If isset Vo->element
$fieldValue=$ordersVo->crtDate;
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

if (!is_null($ordersVo->crtBy)){ //If isset Vo->element
$fieldValue=$ordersVo->crtBy;
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

if (!is_null($ordersVo->modDate)){ //If isset Vo->element
$fieldValue=$ordersVo->modDate;
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

if (!is_null($ordersVo->modBy)){ //If isset Vo->element
$fieldValue=$ordersVo->modBy;
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

if (!is_null($ordersVo->no)){ //If isset Vo->element
$fieldValue=$ordersVo->no;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `no` $key :noKey";
    $isFirst = false;
} else {
    $condition .= " and `no` $key :noKey";
}
if($type == 'str') {
    $params[] = array(':noKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `no` =  :noKey';
$isFirst=false;
}else{
$condition.=' and `no` =  :noKey';
}
$params[]=array(':noKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->discountType)){ //If isset Vo->element
$fieldValue=$ordersVo->discountType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `discountType` $key :discountTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `discountType` $key :discountTypeKey";
}
if($type == 'str') {
    $params[] = array(':discountTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':discountTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `discountType` =  :discountTypeKey';
$isFirst=false;
}else{
$condition.=' and `discountType` =  :discountTypeKey';
}
$params[]=array(':discountTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->discountValue)){ //If isset Vo->element
$fieldValue=$ordersVo->discountValue;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `discountValue` $key :discountValueKey";
    $isFirst = false;
} else {
    $condition .= " and `discountValue` $key :discountValueKey";
}
if($type == 'str') {
    $params[] = array(':discountValueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':discountValueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `discountValue` =  :discountValueKey';
$isFirst=false;
}else{
$condition.=' and `discountValue` =  :discountValueKey';
}
$params[]=array(':discountValueKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('OrdersVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($ordersVo){
try {
if (empty($ordersVo)) $ordersVo = new OrdersVo();
$sql = "select count(*) as total from  orders ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($ordersVo->orderId)){ //If isset Vo->element
$fieldValue=$ordersVo->orderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_id` $key :orderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_id` $key :orderIdKey";
}
if($type == 'str') {
    $params[] = array(':orderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_id` =  :orderIdKey';
$isFirst=false;
}else{
$condition.=' and `order_id` =  :orderIdKey';
}
$params[]=array(':orderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->customerId)){ //If isset Vo->element
$fieldValue=$ordersVo->customerId;
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

if (!is_null($ordersVo->guestId)){ //If isset Vo->element
$fieldValue=$ordersVo->guestId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `guest_id` $key :guestIdKey";
    $isFirst = false;
} else {
    $condition .= " and `guest_id` $key :guestIdKey";
}
if($type == 'str') {
    $params[] = array(':guestIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':guestIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `guest_id` =  :guestIdKey';
$isFirst=false;
}else{
$condition.=' and `guest_id` =  :guestIdKey';
}
$params[]=array(':guestIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->subtotal)){ //If isset Vo->element
$fieldValue=$ordersVo->subtotal;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subtotal` $key :subtotalKey";
    $isFirst = false;
} else {
    $condition .= " and `subtotal` $key :subtotalKey";
}
if($type == 'str') {
    $params[] = array(':subtotalKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subtotalKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subtotal` =  :subtotalKey';
$isFirst=false;
}else{
$condition.=' and `subtotal` =  :subtotalKey';
}
$params[]=array(':subtotalKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->total)){ //If isset Vo->element
$fieldValue=$ordersVo->total;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `total` $key :totalKey";
    $isFirst = false;
} else {
    $condition .= " and `total` $key :totalKey";
}
if($type == 'str') {
    $params[] = array(':totalKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':totalKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `total` =  :totalKey';
$isFirst=false;
}else{
$condition.=' and `total` =  :totalKey';
}
$params[]=array(':totalKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->totalWeight)){ //If isset Vo->element
$fieldValue=$ordersVo->totalWeight;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `total_weight` $key :totalWeightKey";
    $isFirst = false;
} else {
    $condition .= " and `total_weight` $key :totalWeightKey";
}
if($type == 'str') {
    $params[] = array(':totalWeightKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':totalWeightKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `total_weight` =  :totalWeightKey';
$isFirst=false;
}else{
$condition.=' and `total_weight` =  :totalWeightKey';
}
$params[]=array(':totalWeightKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->shippingAddressId)){ //If isset Vo->element
$fieldValue=$ordersVo->shippingAddressId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `shipping_address_id` $key :shippingAddressIdKey";
    $isFirst = false;
} else {
    $condition .= " and `shipping_address_id` $key :shippingAddressIdKey";
}
if($type == 'str') {
    $params[] = array(':shippingAddressIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':shippingAddressIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `shipping_address_id` =  :shippingAddressIdKey';
$isFirst=false;
}else{
$condition.=' and `shipping_address_id` =  :shippingAddressIdKey';
}
$params[]=array(':shippingAddressIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->billingAddressId)){ //If isset Vo->element
$fieldValue=$ordersVo->billingAddressId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `billing_address_id` $key :billingAddressIdKey";
    $isFirst = false;
} else {
    $condition .= " and `billing_address_id` $key :billingAddressIdKey";
}
if($type == 'str') {
    $params[] = array(':billingAddressIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':billingAddressIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `billing_address_id` =  :billingAddressIdKey';
$isFirst=false;
}else{
$condition.=' and `billing_address_id` =  :billingAddressIdKey';
}
$params[]=array(':billingAddressIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->sameAddress)){ //If isset Vo->element
$fieldValue=$ordersVo->sameAddress;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `same_address` $key :sameAddressKey";
    $isFirst = false;
} else {
    $condition .= " and `same_address` $key :sameAddressKey";
}
if($type == 'str') {
    $params[] = array(':sameAddressKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sameAddressKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `same_address` =  :sameAddressKey';
$isFirst=false;
}else{
$condition.=' and `same_address` =  :sameAddressKey';
}
$params[]=array(':sameAddressKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->note)){ //If isset Vo->element
$fieldValue=$ordersVo->note;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `note` $key :noteKey";
    $isFirst = false;
} else {
    $condition .= " and `note` $key :noteKey";
}
if($type == 'str') {
    $params[] = array(':noteKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noteKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `note` =  :noteKey';
$isFirst=false;
}else{
$condition.=' and `note` =  :noteKey';
}
$params[]=array(':noteKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->orderStatusId)){ //If isset Vo->element
$fieldValue=$ordersVo->orderStatusId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order_status_id` $key :orderStatusIdKey";
    $isFirst = false;
} else {
    $condition .= " and `order_status_id` $key :orderStatusIdKey";
}
if($type == 'str') {
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderStatusIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order_status_id` =  :orderStatusIdKey';
$isFirst=false;
}else{
$condition.=' and `order_status_id` =  :orderStatusIdKey';
}
$params[]=array(':orderStatusIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->isDel)){ //If isset Vo->element
$fieldValue=$ordersVo->isDel;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_del` $key :isDelKey";
    $isFirst = false;
} else {
    $condition .= " and `is_del` $key :isDelKey";
}
if($type == 'str') {
    $params[] = array(':isDelKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isDelKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_del` =  :isDelKey';
$isFirst=false;
}else{
$condition.=' and `is_del` =  :isDelKey';
}
$params[]=array(':isDelKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->crtDate)){ //If isset Vo->element
$fieldValue=$ordersVo->crtDate;
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

if (!is_null($ordersVo->crtBy)){ //If isset Vo->element
$fieldValue=$ordersVo->crtBy;
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

if (!is_null($ordersVo->modDate)){ //If isset Vo->element
$fieldValue=$ordersVo->modDate;
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

if (!is_null($ordersVo->modBy)){ //If isset Vo->element
$fieldValue=$ordersVo->modBy;
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

if (!is_null($ordersVo->no)){ //If isset Vo->element
$fieldValue=$ordersVo->no;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `no` $key :noKey";
    $isFirst = false;
} else {
    $condition .= " and `no` $key :noKey";
}
if($type == 'str') {
    $params[] = array(':noKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `no` =  :noKey';
$isFirst=false;
}else{
$condition.=' and `no` =  :noKey';
}
$params[]=array(':noKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($ordersVo->discountType)){ //If isset Vo->element
$fieldValue=$ordersVo->discountType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `discountType` $key :discountTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `discountType` $key :discountTypeKey";
}
if($type == 'str') {
    $params[] = array(':discountTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':discountTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `discountType` =  :discountTypeKey';
$isFirst=false;
}else{
$condition.=' and `discountType` =  :discountTypeKey';
}
$params[]=array(':discountTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($ordersVo->discountValue)){ //If isset Vo->element
$fieldValue=$ordersVo->discountValue;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `discountValue` $key :discountValueKey";
    $isFirst = false;
} else {
    $condition .= " and `discountValue` $key :discountValueKey";
}
if($type == 'str') {
    $params[] = array(':discountValueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':discountValueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `discountValue` =  :discountValueKey';
$isFirst=false;
}else{
$condition.=' and `discountValue` =  :discountValueKey';
}
$params[]=array(':discountValueKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($ordersVo,$orderId){
try {
$sql="UPDATE `orders` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($ordersVo->orderId)){
if ($isFirst){
$updateFields.=' `order_id`= :orderId';
$isFirst=false;}else{
$updateFields.=', `order_id`= :orderId';
}
$params[]=array(':orderId', $ordersVo->orderId, PDO::PARAM_INT);
}

if (isset($ordersVo->customerId)){
if ($isFirst){
$updateFields.=' `customer_id`= :customerId';
$isFirst=false;}else{
$updateFields.=', `customer_id`= :customerId';
}
$params[]=array(':customerId', $ordersVo->customerId, PDO::PARAM_INT);
}

if (isset($ordersVo->guestId)){
if ($isFirst){
$updateFields.=' `guest_id`= :guestId';
$isFirst=false;}else{
$updateFields.=', `guest_id`= :guestId';
}
$params[]=array(':guestId', $ordersVo->guestId, PDO::PARAM_INT);
}

if (isset($ordersVo->subtotal)){
if ($isFirst){
$updateFields.=' `subtotal`= :subtotal';
$isFirst=false;}else{
$updateFields.=', `subtotal`= :subtotal';
}
$params[]=array(':subtotal', $ordersVo->subtotal, PDO::PARAM_STR);
}

if (isset($ordersVo->total)){
if ($isFirst){
$updateFields.=' `total`= :total';
$isFirst=false;}else{
$updateFields.=', `total`= :total';
}
$params[]=array(':total', $ordersVo->total, PDO::PARAM_STR);
}

if (isset($ordersVo->totalWeight)){
if ($isFirst){
$updateFields.=' `total_weight`= :totalWeight';
$isFirst=false;}else{
$updateFields.=', `total_weight`= :totalWeight';
}
$params[]=array(':totalWeight', $ordersVo->totalWeight, PDO::PARAM_STR);
}

if (isset($ordersVo->shippingAddressId)){
if ($isFirst){
$updateFields.=' `shipping_address_id`= :shippingAddressId';
$isFirst=false;}else{
$updateFields.=', `shipping_address_id`= :shippingAddressId';
}
$params[]=array(':shippingAddressId', $ordersVo->shippingAddressId, PDO::PARAM_INT);
}

if (isset($ordersVo->billingAddressId)){
if ($isFirst){
$updateFields.=' `billing_address_id`= :billingAddressId';
$isFirst=false;}else{
$updateFields.=', `billing_address_id`= :billingAddressId';
}
$params[]=array(':billingAddressId', $ordersVo->billingAddressId, PDO::PARAM_INT);
}

if (isset($ordersVo->sameAddress)){
if ($isFirst){
$updateFields.=' `same_address`= :sameAddress';
$isFirst=false;}else{
$updateFields.=', `same_address`= :sameAddress';
}
$params[]=array(':sameAddress', $ordersVo->sameAddress, PDO::PARAM_INT);
}

if (isset($ordersVo->note)){
if ($isFirst){
$updateFields.=' `note`= :note';
$isFirst=false;}else{
$updateFields.=', `note`= :note';
}
$params[]=array(':note', $ordersVo->note, PDO::PARAM_STR);
}

if (isset($ordersVo->orderStatusId)){
if ($isFirst){
$updateFields.=' `order_status_id`= :orderStatusId';
$isFirst=false;}else{
$updateFields.=', `order_status_id`= :orderStatusId';
}
$params[]=array(':orderStatusId', $ordersVo->orderStatusId, PDO::PARAM_INT);
}

if (isset($ordersVo->isDel)){
if ($isFirst){
$updateFields.=' `is_del`= :isDel';
$isFirst=false;}else{
$updateFields.=', `is_del`= :isDel';
}
$params[]=array(':isDel', $ordersVo->isDel, PDO::PARAM_INT);
}

if (isset($ordersVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $ordersVo->crtDate, PDO::PARAM_STR);
}

if (isset($ordersVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $ordersVo->crtBy, PDO::PARAM_INT);
}

if (isset($ordersVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $ordersVo->modDate, PDO::PARAM_STR);
}

if (isset($ordersVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $ordersVo->modBy, PDO::PARAM_INT);
}

if (isset($ordersVo->no)){
if ($isFirst){
$updateFields.=' `no`= :no';
$isFirst=false;}else{
$updateFields.=', `no`= :no';
}
$params[]=array(':no', $ordersVo->no, PDO::PARAM_INT);
}

if (isset($ordersVo->discountType)){
if ($isFirst){
$updateFields.=' `discountType`= :discountType';
$isFirst=false;}else{
$updateFields.=', `discountType`= :discountType';
}
$params[]=array(':discountType', $ordersVo->discountType, PDO::PARAM_STR);
}

if (isset($ordersVo->discountValue)){
if ($isFirst){
$updateFields.=' `discountValue`= :discountValue';
$isFirst=false;}else{
$updateFields.=', `discountValue`= :discountValue';
}
$params[]=array(':discountValue', $ordersVo->discountValue, PDO::PARAM_STR);
}

$conditions.=' where `order_id`= :orderId';
$params[]=array(':orderId', $orderId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (ordersId)
	 * Example
	 * getValueByPrimaryKey('ordersName', 1)
	 * Get value of filed ordersName in table orders where ordersId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$ordersVo = $this->selectByPrimaryKey($primaryValue);
		if($ordersVo){
			return $ordersVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('ordersName', array('ordersId' => 1))
	 * Get value of filed ordersName in table orders where ordersId = 1
	 */
	public function getValueByField($fieldName, $where){
		$ordersVo = new OrdersVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$ordersVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$ordersVos = $this->selectByFilter($ordersVo);
       
		if($ordersVos){
			$ordersVo = $ordersVos[0];
			return $ordersVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table orders
	 *
	 * @param int $order_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($orderId){
		try {
		    $sql = "DELETE FROM `orders` where `order_id` = :orderId";
		    $params = array();
		    $params[] = array(':orderId', $orderId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table orders
	 *
	 * @param object $ordersVo
	 * @return boolean
	 */
	public function deleteByFilter($ordersVo){
		try {
			$sql = 'DELETE FROM `orders`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($ordersVo->orderId)){
				$isDel = true;
				$condition[] = '`order_id` = :orderId';
				$params[] = array(':orderId', $ordersVo->orderId, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->customerId)){
				$isDel = true;
				$condition[] = '`customer_id` = :customerId';
				$params[] = array(':customerId', $ordersVo->customerId, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->guestId)){
				$isDel = true;
				$condition[] = '`guest_id` = :guestId';
				$params[] = array(':guestId', $ordersVo->guestId, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->subtotal)){
				$isDel = true;
				$condition[] = '`subtotal` = :subtotal';
				$params[] = array(':subtotal', $ordersVo->subtotal, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->total)){
				$isDel = true;
				$condition[] = '`total` = :total';
				$params[] = array(':total', $ordersVo->total, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->totalWeight)){
				$isDel = true;
				$condition[] = '`total_weight` = :totalWeight';
				$params[] = array(':totalWeight', $ordersVo->totalWeight, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->shippingAddressId)){
				$isDel = true;
				$condition[] = '`shipping_address_id` = :shippingAddressId';
				$params[] = array(':shippingAddressId', $ordersVo->shippingAddressId, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->billingAddressId)){
				$isDel = true;
				$condition[] = '`billing_address_id` = :billingAddressId';
				$params[] = array(':billingAddressId', $ordersVo->billingAddressId, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->sameAddress)){
				$isDel = true;
				$condition[] = '`same_address` = :sameAddress';
				$params[] = array(':sameAddress', $ordersVo->sameAddress, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->note)){
				$isDel = true;
				$condition[] = '`note` = :note';
				$params[] = array(':note', $ordersVo->note, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->orderStatusId)){
				$isDel = true;
				$condition[] = '`order_status_id` = :orderStatusId';
				$params[] = array(':orderStatusId', $ordersVo->orderStatusId, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->isDel)){
				$isDel = true;
				$condition[] = '`is_del` = :isDel';
				$params[] = array(':isDel', $ordersVo->isDel, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $ordersVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $ordersVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $ordersVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $ordersVo->modBy, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->no)){
				$isDel = true;
				$condition[] = '`no` = :no';
				$params[] = array(':no', $ordersVo->no, PDO::PARAM_INT);
			}
			if (!is_null($ordersVo->discountType)){
				$isDel = true;
				$condition[] = '`discountType` = :discountType';
				$params[] = array(':discountType', $ordersVo->discountType, PDO::PARAM_STR);
			}
			if (!is_null($ordersVo->discountValue)){
				$isDel = true;
				$condition[] = '`discountValue` = :discountValue';
				$params[] = array(':discountValue', $ordersVo->discountValue, PDO::PARAM_STR);
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
