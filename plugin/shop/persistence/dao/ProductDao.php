<?php
class ProductDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product` where `product_id` = :productId");
$stmt->bindParam(':productId',$productId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product`( `manufac_id`, `name`, `code`, `image`, `type`, `amount`, `price`, `sale_of`, `unit`, `discount`, `weight`, `height`, `length`, `description`, `view_count`, `status`, `youtube`, `facebook`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :manufacId, :name, :code, :image, :type, :amount, :price, :saleOf, :unit, :discount, :weight, :height, :length, :description, :viewCount, :status, :youtube, :facebook, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':manufacId', $productVo->manufacId, PDO::PARAM_INT);
$stmt->bindParam(':name', $productVo->name, PDO::PARAM_STR);
$stmt->bindParam(':code', $productVo->code, PDO::PARAM_STR);
$stmt->bindParam(':image', $productVo->image, PDO::PARAM_STR);
$stmt->bindParam(':type', $productVo->type, PDO::PARAM_STR);
$stmt->bindParam(':amount', $productVo->amount, PDO::PARAM_INT);
$stmt->bindParam(':price', $productVo->price, PDO::PARAM_STR);
$stmt->bindParam(':saleOf', $productVo->saleOf, PDO::PARAM_STR);
$stmt->bindParam(':unit', $productVo->unit, PDO::PARAM_STR);
$stmt->bindParam(':discount', $productVo->discount, PDO::PARAM_INT);
$stmt->bindParam(':weight', $productVo->weight, PDO::PARAM_STR);
$stmt->bindParam(':height', $productVo->height, PDO::PARAM_STR);
$stmt->bindParam(':length', $productVo->length, PDO::PARAM_STR);
$stmt->bindParam(':description', $productVo->description, PDO::PARAM_STR);
$stmt->bindParam(':viewCount', $productVo->viewCount, PDO::PARAM_INT);
$stmt->bindParam(':status', $productVo->status, PDO::PARAM_STR);
$stmt->bindParam(':youtube', $productVo->youtube, PDO::PARAM_STR);
$stmt->bindParam(':facebook', $productVo->facebook, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $productVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $productVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $productVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $productVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product`( `manufac_id`, `name`, `code`, `image`, `type`, `amount`, `price`, `sale_of`, `unit`, `discount`, `weight`, `height`, `length`, `description`, `view_count`, `status`, `youtube`, `facebook`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :manufacId, :name, :code, :image, :type, :amount, :price, :saleOf, :unit, :discount, :weight, :height, :length, :description, :viewCount, :status, :youtube, :facebook, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':manufacId', $productVo->manufacId, PDO::PARAM_INT);
$stmt->bindParam(':name', $productVo->name, PDO::PARAM_STR);
$stmt->bindParam(':code', $productVo->code, PDO::PARAM_STR);
$stmt->bindParam(':image', $productVo->image, PDO::PARAM_STR);
$stmt->bindParam(':type', $productVo->type, PDO::PARAM_STR);
$stmt->bindParam(':amount', $productVo->amount, PDO::PARAM_INT);
$stmt->bindParam(':price', $productVo->price, PDO::PARAM_STR);
$stmt->bindParam(':saleOf', $productVo->saleOf, PDO::PARAM_STR);
$stmt->bindParam(':unit', $productVo->unit, PDO::PARAM_STR);
$stmt->bindParam(':discount', $productVo->discount, PDO::PARAM_INT);
$stmt->bindParam(':weight', $productVo->weight, PDO::PARAM_STR);
$stmt->bindParam(':height', $productVo->height, PDO::PARAM_STR);
$stmt->bindParam(':length', $productVo->length, PDO::PARAM_STR);
$stmt->bindParam(':description', $productVo->description, PDO::PARAM_STR);
$stmt->bindParam(':viewCount', $productVo->viewCount, PDO::PARAM_INT);
$stmt->bindParam(':status', $productVo->status, PDO::PARAM_STR);
$stmt->bindParam(':youtube', $productVo->youtube, PDO::PARAM_STR);
$stmt->bindParam(':facebook', $productVo->facebook, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $productVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $productVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $productVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $productVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product by $productVo object filter use paging
 * 
 * @param object $productVo is product object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productVo)) $productVo = new ProductVo();
$sql = "select * from `product` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productVo->productId)){ //If isset Vo->element
$fieldValue=$productVo->productId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_id` $key :productIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_id` $key :productIdKey";
}
if($type == 'str') {
    $params[] = array(':productIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_id` =  :productIdKey';
$isFirst=false;
}else{
$condition.=' and `product_id` =  :productIdKey';
}
$params[]=array(':productIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->manufacId)){ //If isset Vo->element
$fieldValue=$productVo->manufacId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `manufac_id` $key :manufacIdKey";
    $isFirst = false;
} else {
    $condition .= " and `manufac_id` $key :manufacIdKey";
}
if($type == 'str') {
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `manufac_id` =  :manufacIdKey';
$isFirst=false;
}else{
$condition.=' and `manufac_id` =  :manufacIdKey';
}
$params[]=array(':manufacIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->name)){ //If isset Vo->element
$fieldValue=$productVo->name;
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

if (!is_null($productVo->code)){ //If isset Vo->element
$fieldValue=$productVo->code;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `code` $key :codeKey";
    $isFirst = false;
} else {
    $condition .= " and `code` $key :codeKey";
}
if($type == 'str') {
    $params[] = array(':codeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':codeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `code` =  :codeKey';
$isFirst=false;
}else{
$condition.=' and `code` =  :codeKey';
}
$params[]=array(':codeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->image)){ //If isset Vo->element
$fieldValue=$productVo->image;
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

if (!is_null($productVo->type)){ //If isset Vo->element
$fieldValue=$productVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->amount)){ //If isset Vo->element
$fieldValue=$productVo->amount;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `amount` $key :amountKey";
    $isFirst = false;
} else {
    $condition .= " and `amount` $key :amountKey";
}
if($type == 'str') {
    $params[] = array(':amountKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':amountKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `amount` =  :amountKey';
$isFirst=false;
}else{
$condition.=' and `amount` =  :amountKey';
}
$params[]=array(':amountKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->price)){ //If isset Vo->element
$fieldValue=$productVo->price;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `price` $key :priceKey";
    $isFirst = false;
} else {
    $condition .= " and `price` $key :priceKey";
}
if($type == 'str') {
    $params[] = array(':priceKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':priceKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `price` =  :priceKey';
$isFirst=false;
}else{
$condition.=' and `price` =  :priceKey';
}
$params[]=array(':priceKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->saleOf)){ //If isset Vo->element
$fieldValue=$productVo->saleOf;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `sale_of` $key :saleOfKey";
    $isFirst = false;
} else {
    $condition .= " and `sale_of` $key :saleOfKey";
}
if($type == 'str') {
    $params[] = array(':saleOfKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':saleOfKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `sale_of` =  :saleOfKey';
$isFirst=false;
}else{
$condition.=' and `sale_of` =  :saleOfKey';
}
$params[]=array(':saleOfKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->unit)){ //If isset Vo->element
$fieldValue=$productVo->unit;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `unit` $key :unitKey";
    $isFirst = false;
} else {
    $condition .= " and `unit` $key :unitKey";
}
if($type == 'str') {
    $params[] = array(':unitKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':unitKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `unit` =  :unitKey';
$isFirst=false;
}else{
$condition.=' and `unit` =  :unitKey';
}
$params[]=array(':unitKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->discount)){ //If isset Vo->element
$fieldValue=$productVo->discount;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `discount` $key :discountKey";
    $isFirst = false;
} else {
    $condition .= " and `discount` $key :discountKey";
}
if($type == 'str') {
    $params[] = array(':discountKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':discountKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `discount` =  :discountKey';
$isFirst=false;
}else{
$condition.=' and `discount` =  :discountKey';
}
$params[]=array(':discountKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->weight)){ //If isset Vo->element
$fieldValue=$productVo->weight;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `weight` $key :weightKey";
    $isFirst = false;
} else {
    $condition .= " and `weight` $key :weightKey";
}
if($type == 'str') {
    $params[] = array(':weightKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':weightKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `weight` =  :weightKey';
$isFirst=false;
}else{
$condition.=' and `weight` =  :weightKey';
}
$params[]=array(':weightKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->height)){ //If isset Vo->element
$fieldValue=$productVo->height;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `height` $key :heightKey";
    $isFirst = false;
} else {
    $condition .= " and `height` $key :heightKey";
}
if($type == 'str') {
    $params[] = array(':heightKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':heightKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `height` =  :heightKey';
$isFirst=false;
}else{
$condition.=' and `height` =  :heightKey';
}
$params[]=array(':heightKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->length)){ //If isset Vo->element
$fieldValue=$productVo->length;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `length` $key :lengthKey";
    $isFirst = false;
} else {
    $condition .= " and `length` $key :lengthKey";
}
if($type == 'str') {
    $params[] = array(':lengthKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':lengthKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `length` =  :lengthKey';
$isFirst=false;
}else{
$condition.=' and `length` =  :lengthKey';
}
$params[]=array(':lengthKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->description)){ //If isset Vo->element
$fieldValue=$productVo->description;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `description` $key :descriptionKey";
    $isFirst = false;
} else {
    $condition .= " and `description` $key :descriptionKey";
}
if($type == 'str') {
    $params[] = array(':descriptionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':descriptionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `description` =  :descriptionKey';
$isFirst=false;
}else{
$condition.=' and `description` =  :descriptionKey';
}
$params[]=array(':descriptionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->viewCount)){ //If isset Vo->element
$fieldValue=$productVo->viewCount;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `view_count` $key :viewCountKey";
    $isFirst = false;
} else {
    $condition .= " and `view_count` $key :viewCountKey";
}
if($type == 'str') {
    $params[] = array(':viewCountKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':viewCountKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `view_count` =  :viewCountKey';
$isFirst=false;
}else{
$condition.=' and `view_count` =  :viewCountKey';
}
$params[]=array(':viewCountKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->status)){ //If isset Vo->element
$fieldValue=$productVo->status;
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

if (!is_null($productVo->youtube)){ //If isset Vo->element
$fieldValue=$productVo->youtube;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `youtube` $key :youtubeKey";
    $isFirst = false;
} else {
    $condition .= " and `youtube` $key :youtubeKey";
}
if($type == 'str') {
    $params[] = array(':youtubeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':youtubeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `youtube` =  :youtubeKey';
$isFirst=false;
}else{
$condition.=' and `youtube` =  :youtubeKey';
}
$params[]=array(':youtubeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->facebook)){ //If isset Vo->element
$fieldValue=$productVo->facebook;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `facebook` $key :facebookKey";
    $isFirst = false;
} else {
    $condition .= " and `facebook` $key :facebookKey";
}
if($type == 'str') {
    $params[] = array(':facebookKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':facebookKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `facebook` =  :facebookKey';
$isFirst=false;
}else{
$condition.=' and `facebook` =  :facebookKey';
}
$params[]=array(':facebookKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->crtDate)){ //If isset Vo->element
$fieldValue=$productVo->crtDate;
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

if (!is_null($productVo->crtBy)){ //If isset Vo->element
$fieldValue=$productVo->crtBy;
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

if (!is_null($productVo->modDate)){ //If isset Vo->element
$fieldValue=$productVo->modDate;
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

if (!is_null($productVo->modBy)){ //If isset Vo->element
$fieldValue=$productVo->modBy;
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
return PersistentHelper::mapResult('ProductVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productVo){
try {
if (empty($productVo)) $productVo = new ProductVo();
$sql = "select count(*) as total from  product ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productVo->productId)){ //If isset Vo->element
$fieldValue=$productVo->productId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_id` $key :productIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_id` $key :productIdKey";
}
if($type == 'str') {
    $params[] = array(':productIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_id` =  :productIdKey';
$isFirst=false;
}else{
$condition.=' and `product_id` =  :productIdKey';
}
$params[]=array(':productIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->manufacId)){ //If isset Vo->element
$fieldValue=$productVo->manufacId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `manufac_id` $key :manufacIdKey";
    $isFirst = false;
} else {
    $condition .= " and `manufac_id` $key :manufacIdKey";
}
if($type == 'str') {
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':manufacIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `manufac_id` =  :manufacIdKey';
$isFirst=false;
}else{
$condition.=' and `manufac_id` =  :manufacIdKey';
}
$params[]=array(':manufacIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->name)){ //If isset Vo->element
$fieldValue=$productVo->name;
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

if (!is_null($productVo->code)){ //If isset Vo->element
$fieldValue=$productVo->code;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `code` $key :codeKey";
    $isFirst = false;
} else {
    $condition .= " and `code` $key :codeKey";
}
if($type == 'str') {
    $params[] = array(':codeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':codeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `code` =  :codeKey';
$isFirst=false;
}else{
$condition.=' and `code` =  :codeKey';
}
$params[]=array(':codeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->image)){ //If isset Vo->element
$fieldValue=$productVo->image;
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

if (!is_null($productVo->type)){ //If isset Vo->element
$fieldValue=$productVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->amount)){ //If isset Vo->element
$fieldValue=$productVo->amount;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `amount` $key :amountKey";
    $isFirst = false;
} else {
    $condition .= " and `amount` $key :amountKey";
}
if($type == 'str') {
    $params[] = array(':amountKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':amountKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `amount` =  :amountKey';
$isFirst=false;
}else{
$condition.=' and `amount` =  :amountKey';
}
$params[]=array(':amountKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->price)){ //If isset Vo->element
$fieldValue=$productVo->price;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `price` $key :priceKey";
    $isFirst = false;
} else {
    $condition .= " and `price` $key :priceKey";
}
if($type == 'str') {
    $params[] = array(':priceKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':priceKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `price` =  :priceKey';
$isFirst=false;
}else{
$condition.=' and `price` =  :priceKey';
}
$params[]=array(':priceKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->saleOf)){ //If isset Vo->element
$fieldValue=$productVo->saleOf;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `sale_of` $key :saleOfKey";
    $isFirst = false;
} else {
    $condition .= " and `sale_of` $key :saleOfKey";
}
if($type == 'str') {
    $params[] = array(':saleOfKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':saleOfKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `sale_of` =  :saleOfKey';
$isFirst=false;
}else{
$condition.=' and `sale_of` =  :saleOfKey';
}
$params[]=array(':saleOfKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->unit)){ //If isset Vo->element
$fieldValue=$productVo->unit;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `unit` $key :unitKey";
    $isFirst = false;
} else {
    $condition .= " and `unit` $key :unitKey";
}
if($type == 'str') {
    $params[] = array(':unitKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':unitKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `unit` =  :unitKey';
$isFirst=false;
}else{
$condition.=' and `unit` =  :unitKey';
}
$params[]=array(':unitKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->discount)){ //If isset Vo->element
$fieldValue=$productVo->discount;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `discount` $key :discountKey";
    $isFirst = false;
} else {
    $condition .= " and `discount` $key :discountKey";
}
if($type == 'str') {
    $params[] = array(':discountKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':discountKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `discount` =  :discountKey';
$isFirst=false;
}else{
$condition.=' and `discount` =  :discountKey';
}
$params[]=array(':discountKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->weight)){ //If isset Vo->element
$fieldValue=$productVo->weight;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `weight` $key :weightKey";
    $isFirst = false;
} else {
    $condition .= " and `weight` $key :weightKey";
}
if($type == 'str') {
    $params[] = array(':weightKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':weightKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `weight` =  :weightKey';
$isFirst=false;
}else{
$condition.=' and `weight` =  :weightKey';
}
$params[]=array(':weightKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->height)){ //If isset Vo->element
$fieldValue=$productVo->height;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `height` $key :heightKey";
    $isFirst = false;
} else {
    $condition .= " and `height` $key :heightKey";
}
if($type == 'str') {
    $params[] = array(':heightKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':heightKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `height` =  :heightKey';
$isFirst=false;
}else{
$condition.=' and `height` =  :heightKey';
}
$params[]=array(':heightKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->length)){ //If isset Vo->element
$fieldValue=$productVo->length;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `length` $key :lengthKey";
    $isFirst = false;
} else {
    $condition .= " and `length` $key :lengthKey";
}
if($type == 'str') {
    $params[] = array(':lengthKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':lengthKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `length` =  :lengthKey';
$isFirst=false;
}else{
$condition.=' and `length` =  :lengthKey';
}
$params[]=array(':lengthKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->description)){ //If isset Vo->element
$fieldValue=$productVo->description;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `description` $key :descriptionKey";
    $isFirst = false;
} else {
    $condition .= " and `description` $key :descriptionKey";
}
if($type == 'str') {
    $params[] = array(':descriptionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':descriptionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `description` =  :descriptionKey';
$isFirst=false;
}else{
$condition.=' and `description` =  :descriptionKey';
}
$params[]=array(':descriptionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->viewCount)){ //If isset Vo->element
$fieldValue=$productVo->viewCount;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `view_count` $key :viewCountKey";
    $isFirst = false;
} else {
    $condition .= " and `view_count` $key :viewCountKey";
}
if($type == 'str') {
    $params[] = array(':viewCountKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':viewCountKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `view_count` =  :viewCountKey';
$isFirst=false;
}else{
$condition.=' and `view_count` =  :viewCountKey';
}
$params[]=array(':viewCountKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productVo->status)){ //If isset Vo->element
$fieldValue=$productVo->status;
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

if (!is_null($productVo->youtube)){ //If isset Vo->element
$fieldValue=$productVo->youtube;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `youtube` $key :youtubeKey";
    $isFirst = false;
} else {
    $condition .= " and `youtube` $key :youtubeKey";
}
if($type == 'str') {
    $params[] = array(':youtubeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':youtubeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `youtube` =  :youtubeKey';
$isFirst=false;
}else{
$condition.=' and `youtube` =  :youtubeKey';
}
$params[]=array(':youtubeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->facebook)){ //If isset Vo->element
$fieldValue=$productVo->facebook;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `facebook` $key :facebookKey";
    $isFirst = false;
} else {
    $condition .= " and `facebook` $key :facebookKey";
}
if($type == 'str') {
    $params[] = array(':facebookKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':facebookKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `facebook` =  :facebookKey';
$isFirst=false;
}else{
$condition.=' and `facebook` =  :facebookKey';
}
$params[]=array(':facebookKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productVo->crtDate)){ //If isset Vo->element
$fieldValue=$productVo->crtDate;
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

if (!is_null($productVo->crtBy)){ //If isset Vo->element
$fieldValue=$productVo->crtBy;
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

if (!is_null($productVo->modDate)){ //If isset Vo->element
$fieldValue=$productVo->modDate;
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

if (!is_null($productVo->modBy)){ //If isset Vo->element
$fieldValue=$productVo->modBy;
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


public function updateByPrimaryKey($productVo,$productId){
try {
$sql="UPDATE `product` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productVo->productId, PDO::PARAM_INT);
}

if (isset($productVo->manufacId)){
if ($isFirst){
$updateFields.=' `manufac_id`= :manufacId';
$isFirst=false;}else{
$updateFields.=', `manufac_id`= :manufacId';
}
$params[]=array(':manufacId', $productVo->manufacId, PDO::PARAM_INT);
}

if (isset($productVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $productVo->name, PDO::PARAM_STR);
}

if (isset($productVo->code)){
if ($isFirst){
$updateFields.=' `code`= :code';
$isFirst=false;}else{
$updateFields.=', `code`= :code';
}
$params[]=array(':code', $productVo->code, PDO::PARAM_STR);
}

if (isset($productVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $productVo->image, PDO::PARAM_STR);
}

if (isset($productVo->type)){
if ($isFirst){
$updateFields.=' `type`= :type';
$isFirst=false;}else{
$updateFields.=', `type`= :type';
}
$params[]=array(':type', $productVo->type, PDO::PARAM_STR);
}

if (isset($productVo->amount)){
if ($isFirst){
$updateFields.=' `amount`= :amount';
$isFirst=false;}else{
$updateFields.=', `amount`= :amount';
}
$params[]=array(':amount', $productVo->amount, PDO::PARAM_INT);
}

if (isset($productVo->price)){
if ($isFirst){
$updateFields.=' `price`= :price';
$isFirst=false;}else{
$updateFields.=', `price`= :price';
}
$params[]=array(':price', $productVo->price, PDO::PARAM_STR);
}

if (isset($productVo->saleOf)){
if ($isFirst){
$updateFields.=' `sale_of`= :saleOf';
$isFirst=false;}else{
$updateFields.=', `sale_of`= :saleOf';
}
$params[]=array(':saleOf', $productVo->saleOf, PDO::PARAM_STR);
}

if (isset($productVo->unit)){
if ($isFirst){
$updateFields.=' `unit`= :unit';
$isFirst=false;}else{
$updateFields.=', `unit`= :unit';
}
$params[]=array(':unit', $productVo->unit, PDO::PARAM_STR);
}

if (isset($productVo->discount)){
if ($isFirst){
$updateFields.=' `discount`= :discount';
$isFirst=false;}else{
$updateFields.=', `discount`= :discount';
}
$params[]=array(':discount', $productVo->discount, PDO::PARAM_INT);
}

if (isset($productVo->weight)){
if ($isFirst){
$updateFields.=' `weight`= :weight';
$isFirst=false;}else{
$updateFields.=', `weight`= :weight';
}
$params[]=array(':weight', $productVo->weight, PDO::PARAM_STR);
}

if (isset($productVo->height)){
if ($isFirst){
$updateFields.=' `height`= :height';
$isFirst=false;}else{
$updateFields.=', `height`= :height';
}
$params[]=array(':height', $productVo->height, PDO::PARAM_STR);
}

if (isset($productVo->length)){
if ($isFirst){
$updateFields.=' `length`= :length';
$isFirst=false;}else{
$updateFields.=', `length`= :length';
}
$params[]=array(':length', $productVo->length, PDO::PARAM_STR);
}

if (isset($productVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $productVo->description, PDO::PARAM_STR);
}

if (isset($productVo->viewCount)){
if ($isFirst){
$updateFields.=' `view_count`= :viewCount';
$isFirst=false;}else{
$updateFields.=', `view_count`= :viewCount';
}
$params[]=array(':viewCount', $productVo->viewCount, PDO::PARAM_INT);
}

if (isset($productVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $productVo->status, PDO::PARAM_STR);
}

if (isset($productVo->youtube)){
if ($isFirst){
$updateFields.=' `youtube`= :youtube';
$isFirst=false;}else{
$updateFields.=', `youtube`= :youtube';
}
$params[]=array(':youtube', $productVo->youtube, PDO::PARAM_STR);
}

if (isset($productVo->facebook)){
if ($isFirst){
$updateFields.=' `facebook`= :facebook';
$isFirst=false;}else{
$updateFields.=', `facebook`= :facebook';
}
$params[]=array(':facebook', $productVo->facebook, PDO::PARAM_STR);
}

if (isset($productVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $productVo->crtDate, PDO::PARAM_STR);
}

if (isset($productVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $productVo->crtBy, PDO::PARAM_INT);
}

if (isset($productVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $productVo->modDate, PDO::PARAM_STR);
}

if (isset($productVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $productVo->modBy, PDO::PARAM_INT);
}

$conditions.=' where `product_id`= :productId';
$params[]=array(':productId', $productId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productId)
	 * Example
	 * getValueByPrimaryKey('productName', 1)
	 * Get value of filed productName in table product where productId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productVo = $this->selectByPrimaryKey($primaryValue);
		if($productVo){
			return $productVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productName', array('productId' => 1))
	 * Get value of filed productName in table product where productId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productVo = new ProductVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productVos = $this->selectByFilter($productVo);
       
		if($productVos){
			$productVo = $productVos[0];
			return $productVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product
	 *
	 * @param int $product_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productId){
		try {
		    $sql = "DELETE FROM `product` where `product_id` = :productId";
		    $params = array();
		    $params[] = array(':productId', $productId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product
	 *
	 * @param object $productVo
	 * @return boolean
	 */
	public function deleteByFilter($productVo){
		try {
			$sql = 'DELETE FROM `product`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productVo->manufacId)){
				$isDel = true;
				$condition[] = '`manufac_id` = :manufacId';
				$params[] = array(':manufacId', $productVo->manufacId, PDO::PARAM_INT);
			}
			if (!is_null($productVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $productVo->name, PDO::PARAM_STR);
			}
			if (!is_null($productVo->code)){
				$isDel = true;
				$condition[] = '`code` = :code';
				$params[] = array(':code', $productVo->code, PDO::PARAM_STR);
			}
			if (!is_null($productVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $productVo->image, PDO::PARAM_STR);
			}
			if (!is_null($productVo->type)){
				$isDel = true;
				$condition[] = '`type` = :type';
				$params[] = array(':type', $productVo->type, PDO::PARAM_STR);
			}
			if (!is_null($productVo->amount)){
				$isDel = true;
				$condition[] = '`amount` = :amount';
				$params[] = array(':amount', $productVo->amount, PDO::PARAM_INT);
			}
			if (!is_null($productVo->price)){
				$isDel = true;
				$condition[] = '`price` = :price';
				$params[] = array(':price', $productVo->price, PDO::PARAM_STR);
			}
			if (!is_null($productVo->saleOf)){
				$isDel = true;
				$condition[] = '`sale_of` = :saleOf';
				$params[] = array(':saleOf', $productVo->saleOf, PDO::PARAM_STR);
			}
			if (!is_null($productVo->unit)){
				$isDel = true;
				$condition[] = '`unit` = :unit';
				$params[] = array(':unit', $productVo->unit, PDO::PARAM_STR);
			}
			if (!is_null($productVo->discount)){
				$isDel = true;
				$condition[] = '`discount` = :discount';
				$params[] = array(':discount', $productVo->discount, PDO::PARAM_INT);
			}
			if (!is_null($productVo->weight)){
				$isDel = true;
				$condition[] = '`weight` = :weight';
				$params[] = array(':weight', $productVo->weight, PDO::PARAM_STR);
			}
			if (!is_null($productVo->height)){
				$isDel = true;
				$condition[] = '`height` = :height';
				$params[] = array(':height', $productVo->height, PDO::PARAM_STR);
			}
			if (!is_null($productVo->length)){
				$isDel = true;
				$condition[] = '`length` = :length';
				$params[] = array(':length', $productVo->length, PDO::PARAM_STR);
			}
			if (!is_null($productVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $productVo->description, PDO::PARAM_STR);
			}
			if (!is_null($productVo->viewCount)){
				$isDel = true;
				$condition[] = '`view_count` = :viewCount';
				$params[] = array(':viewCount', $productVo->viewCount, PDO::PARAM_INT);
			}
			if (!is_null($productVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $productVo->status, PDO::PARAM_STR);
			}
			if (!is_null($productVo->youtube)){
				$isDel = true;
				$condition[] = '`youtube` = :youtube';
				$params[] = array(':youtube', $productVo->youtube, PDO::PARAM_STR);
			}
			if (!is_null($productVo->facebook)){
				$isDel = true;
				$condition[] = '`facebook` = :facebook';
				$params[] = array(':facebook', $productVo->facebook, PDO::PARAM_STR);
			}
			if (!is_null($productVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $productVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($productVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $productVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($productVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $productVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($productVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $productVo->modBy, PDO::PARAM_INT);
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
