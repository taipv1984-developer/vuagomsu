<?php
class CustomerReviewDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `customer_review`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CustomerReviewVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($customerReviewId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `customer_review` where `customer_review_id` = :customerReviewId");
$stmt->bindParam(':customerReviewId',$customerReviewId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CustomerReviewVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($customerReviewVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer_review`( `name`, `career`, `phone`, `email`, `image`, `title`, `content`, `status`, `crt_date`)
VALUES( :name, :career, :phone, :email, :image, :title, :content, :status, :crtDate)");
$stmt->bindParam(':name', $customerReviewVo->name, PDO::PARAM_STR);
$stmt->bindParam(':career', $customerReviewVo->career, PDO::PARAM_STR);
$stmt->bindParam(':phone', $customerReviewVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':email', $customerReviewVo->email, PDO::PARAM_STR);
$stmt->bindParam(':image', $customerReviewVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $customerReviewVo->title, PDO::PARAM_STR);
$stmt->bindParam(':content', $customerReviewVo->content, PDO::PARAM_STR);
$stmt->bindParam(':status', $customerReviewVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $customerReviewVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($customerReviewVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `customer_review`( `name`, `career`, `phone`, `email`, `image`, `title`, `content`, `status`, `crt_date`)
VALUES( :name, :career, :phone, :email, :image, :title, :content, :status, :crtDate)");
$stmt->bindParam(':name', $customerReviewVo->name, PDO::PARAM_STR);
$stmt->bindParam(':career', $customerReviewVo->career, PDO::PARAM_STR);
$stmt->bindParam(':phone', $customerReviewVo->phone, PDO::PARAM_STR);
$stmt->bindParam(':email', $customerReviewVo->email, PDO::PARAM_STR);
$stmt->bindParam(':image', $customerReviewVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $customerReviewVo->title, PDO::PARAM_STR);
$stmt->bindParam(':content', $customerReviewVo->content, PDO::PARAM_STR);
$stmt->bindParam(':status', $customerReviewVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $customerReviewVo->crtDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table customer_review by $customerReviewVo object filter use paging
 * 
 * @param object $customerReviewVo is customer_review object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($customerReviewVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($customerReviewVo)) $customerReviewVo = new CustomerReviewVo();
$sql = "select * from `customer_review` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerReviewVo->customerReviewId)){ //If isset Vo->element
$fieldValue=$customerReviewVo->customerReviewId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_review_id` $key :customerReviewIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_review_id` $key :customerReviewIdKey";
}
if($type == 'str') {
    $params[] = array(':customerReviewIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerReviewIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_review_id` =  :customerReviewIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_review_id` =  :customerReviewIdKey';
}
$params[]=array(':customerReviewIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerReviewVo->name)){ //If isset Vo->element
$fieldValue=$customerReviewVo->name;
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

if (!is_null($customerReviewVo->career)){ //If isset Vo->element
$fieldValue=$customerReviewVo->career;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `career` $key :careerKey";
    $isFirst = false;
} else {
    $condition .= " and `career` $key :careerKey";
}
if($type == 'str') {
    $params[] = array(':careerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':careerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `career` =  :careerKey';
$isFirst=false;
}else{
$condition.=' and `career` =  :careerKey';
}
$params[]=array(':careerKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerReviewVo->phone)){ //If isset Vo->element
$fieldValue=$customerReviewVo->phone;
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

if (!is_null($customerReviewVo->email)){ //If isset Vo->element
$fieldValue=$customerReviewVo->email;
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

if (!is_null($customerReviewVo->image)){ //If isset Vo->element
$fieldValue=$customerReviewVo->image;
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

if (!is_null($customerReviewVo->title)){ //If isset Vo->element
$fieldValue=$customerReviewVo->title;
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

if (!is_null($customerReviewVo->content)){ //If isset Vo->element
$fieldValue=$customerReviewVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerReviewVo->status)){ //If isset Vo->element
$fieldValue=$customerReviewVo->status;
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

if (!is_null($customerReviewVo->crtDate)){ //If isset Vo->element
$fieldValue=$customerReviewVo->crtDate;
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
return PersistentHelper::mapResult('CustomerReviewVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($customerReviewVo){
try {
if (empty($customerReviewVo)) $customerReviewVo = new CustomerReviewVo();
$sql = "select count(*) as total from  customer_review ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($customerReviewVo->customerReviewId)){ //If isset Vo->element
$fieldValue=$customerReviewVo->customerReviewId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `customer_review_id` $key :customerReviewIdKey";
    $isFirst = false;
} else {
    $condition .= " and `customer_review_id` $key :customerReviewIdKey";
}
if($type == 'str') {
    $params[] = array(':customerReviewIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':customerReviewIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `customer_review_id` =  :customerReviewIdKey';
$isFirst=false;
}else{
$condition.=' and `customer_review_id` =  :customerReviewIdKey';
}
$params[]=array(':customerReviewIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($customerReviewVo->name)){ //If isset Vo->element
$fieldValue=$customerReviewVo->name;
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

if (!is_null($customerReviewVo->career)){ //If isset Vo->element
$fieldValue=$customerReviewVo->career;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `career` $key :careerKey";
    $isFirst = false;
} else {
    $condition .= " and `career` $key :careerKey";
}
if($type == 'str') {
    $params[] = array(':careerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':careerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `career` =  :careerKey';
$isFirst=false;
}else{
$condition.=' and `career` =  :careerKey';
}
$params[]=array(':careerKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerReviewVo->phone)){ //If isset Vo->element
$fieldValue=$customerReviewVo->phone;
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

if (!is_null($customerReviewVo->email)){ //If isset Vo->element
$fieldValue=$customerReviewVo->email;
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

if (!is_null($customerReviewVo->image)){ //If isset Vo->element
$fieldValue=$customerReviewVo->image;
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

if (!is_null($customerReviewVo->title)){ //If isset Vo->element
$fieldValue=$customerReviewVo->title;
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

if (!is_null($customerReviewVo->content)){ //If isset Vo->element
$fieldValue=$customerReviewVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($customerReviewVo->status)){ //If isset Vo->element
$fieldValue=$customerReviewVo->status;
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

if (!is_null($customerReviewVo->crtDate)){ //If isset Vo->element
$fieldValue=$customerReviewVo->crtDate;
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


public function updateByPrimaryKey($customerReviewVo,$customerReviewId){
try {
$sql="UPDATE `customer_review` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($customerReviewVo->customerReviewId)){
if ($isFirst){
$updateFields.=' `customer_review_id`= :customerReviewId';
$isFirst=false;}else{
$updateFields.=', `customer_review_id`= :customerReviewId';
}
$params[]=array(':customerReviewId', $customerReviewVo->customerReviewId, PDO::PARAM_INT);
}

if (isset($customerReviewVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $customerReviewVo->name, PDO::PARAM_STR);
}

if (isset($customerReviewVo->career)){
if ($isFirst){
$updateFields.=' `career`= :career';
$isFirst=false;}else{
$updateFields.=', `career`= :career';
}
$params[]=array(':career', $customerReviewVo->career, PDO::PARAM_STR);
}

if (isset($customerReviewVo->phone)){
if ($isFirst){
$updateFields.=' `phone`= :phone';
$isFirst=false;}else{
$updateFields.=', `phone`= :phone';
}
$params[]=array(':phone', $customerReviewVo->phone, PDO::PARAM_STR);
}

if (isset($customerReviewVo->email)){
if ($isFirst){
$updateFields.=' `email`= :email';
$isFirst=false;}else{
$updateFields.=', `email`= :email';
}
$params[]=array(':email', $customerReviewVo->email, PDO::PARAM_STR);
}

if (isset($customerReviewVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $customerReviewVo->image, PDO::PARAM_STR);
}

if (isset($customerReviewVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $customerReviewVo->title, PDO::PARAM_STR);
}

if (isset($customerReviewVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $customerReviewVo->content, PDO::PARAM_STR);
}

if (isset($customerReviewVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $customerReviewVo->status, PDO::PARAM_STR);
}

if (isset($customerReviewVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $customerReviewVo->crtDate, PDO::PARAM_STR);
}

$conditions.=' where `customer_review_id`= :customerReviewId';
$params[]=array(':customerReviewId', $customerReviewId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (customerReviewId)
	 * Example
	 * getValueByPrimaryKey('customerReviewName', 1)
	 * Get value of filed customerReviewName in table customerReview where customerReviewId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$customerReviewVo = $this->selectByPrimaryKey($primaryValue);
		if($customerReviewVo){
			return $customerReviewVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('customerReviewName', array('customerReviewId' => 1))
	 * Get value of filed customerReviewName in table customerReview where customerReviewId = 1
	 */
	public function getValueByField($fieldName, $where){
		$customerReviewVo = new CustomerReviewVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$customerReviewVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$customerReviewVos = $this->selectByFilter($customerReviewVo);
       
		if($customerReviewVos){
			$customerReviewVo = $customerReviewVos[0];
			return $customerReviewVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table customer_review
	 *
	 * @param int $customer_review_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($customerReviewId){
		try {
		    $sql = "DELETE FROM `customer_review` where `customer_review_id` = :customerReviewId";
		    $params = array();
		    $params[] = array(':customerReviewId', $customerReviewId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table customer_review
	 *
	 * @param object $customerReviewVo
	 * @return boolean
	 */
	public function deleteByFilter($customerReviewVo){
		try {
			$sql = 'DELETE FROM `customer_review`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($customerReviewVo->customerReviewId)){
				$isDel = true;
				$condition[] = '`customer_review_id` = :customerReviewId';
				$params[] = array(':customerReviewId', $customerReviewVo->customerReviewId, PDO::PARAM_INT);
			}
			if (!is_null($customerReviewVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $customerReviewVo->name, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->career)){
				$isDel = true;
				$condition[] = '`career` = :career';
				$params[] = array(':career', $customerReviewVo->career, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->phone)){
				$isDel = true;
				$condition[] = '`phone` = :phone';
				$params[] = array(':phone', $customerReviewVo->phone, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->email)){
				$isDel = true;
				$condition[] = '`email` = :email';
				$params[] = array(':email', $customerReviewVo->email, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $customerReviewVo->image, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $customerReviewVo->title, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $customerReviewVo->content, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $customerReviewVo->status, PDO::PARAM_STR);
			}
			if (!is_null($customerReviewVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $customerReviewVo->crtDate, PDO::PARAM_STR);
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
