<?php
class StaticPageDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `static_page`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('StaticPageVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($staticPageId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `static_page` where `static_page_id` = :staticPageId");
$stmt->bindParam(':staticPageId',$staticPageId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('StaticPageVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($staticPageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `static_page`( `image`, `title`, `summary`, `content`, `status`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :image, :title, :summary, :content, :status, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':image', $staticPageVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $staticPageVo->title, PDO::PARAM_STR);
$stmt->bindParam(':summary', $staticPageVo->summary, PDO::PARAM_STR);
$stmt->bindParam(':content', $staticPageVo->content, PDO::PARAM_STR);
$stmt->bindParam(':status', $staticPageVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $staticPageVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $staticPageVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $staticPageVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $staticPageVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($staticPageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `static_page`( `image`, `title`, `summary`, `content`, `status`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :image, :title, :summary, :content, :status, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':image', $staticPageVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $staticPageVo->title, PDO::PARAM_STR);
$stmt->bindParam(':summary', $staticPageVo->summary, PDO::PARAM_STR);
$stmt->bindParam(':content', $staticPageVo->content, PDO::PARAM_STR);
$stmt->bindParam(':status', $staticPageVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $staticPageVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $staticPageVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $staticPageVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $staticPageVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table static_page by $staticPageVo object filter use paging
 * 
 * @param object $staticPageVo is static_page object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($staticPageVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($staticPageVo)) $staticPageVo = new StaticPageVo();
$sql = "select * from `static_page` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($staticPageVo->staticPageId)){ //If isset Vo->element
$fieldValue=$staticPageVo->staticPageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `static_page_id` $key :staticPageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `static_page_id` $key :staticPageIdKey";
}
if($type == 'str') {
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `static_page_id` =  :staticPageIdKey';
$isFirst=false;
}else{
$condition.=' and `static_page_id` =  :staticPageIdKey';
}
$params[]=array(':staticPageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($staticPageVo->image)){ //If isset Vo->element
$fieldValue=$staticPageVo->image;
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

if (!is_null($staticPageVo->title)){ //If isset Vo->element
$fieldValue=$staticPageVo->title;
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

if (!is_null($staticPageVo->summary)){ //If isset Vo->element
$fieldValue=$staticPageVo->summary;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `summary` $key :summaryKey";
    $isFirst = false;
} else {
    $condition .= " and `summary` $key :summaryKey";
}
if($type == 'str') {
    $params[] = array(':summaryKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':summaryKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `summary` =  :summaryKey';
$isFirst=false;
}else{
$condition.=' and `summary` =  :summaryKey';
}
$params[]=array(':summaryKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageVo->content)){ //If isset Vo->element
$fieldValue=$staticPageVo->content;
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

if (!is_null($staticPageVo->status)){ //If isset Vo->element
$fieldValue=$staticPageVo->status;
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

if (!is_null($staticPageVo->crtDate)){ //If isset Vo->element
$fieldValue=$staticPageVo->crtDate;
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

if (!is_null($staticPageVo->crtBy)){ //If isset Vo->element
$fieldValue=$staticPageVo->crtBy;
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

if (!is_null($staticPageVo->modDate)){ //If isset Vo->element
$fieldValue=$staticPageVo->modDate;
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

if (!is_null($staticPageVo->modBy)){ //If isset Vo->element
$fieldValue=$staticPageVo->modBy;
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
return PersistentHelper::mapResult('StaticPageVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($staticPageVo){
try {
if (empty($staticPageVo)) $staticPageVo = new StaticPageVo();
$sql = "select count(*) as total from  static_page ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($staticPageVo->staticPageId)){ //If isset Vo->element
$fieldValue=$staticPageVo->staticPageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `static_page_id` $key :staticPageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `static_page_id` $key :staticPageIdKey";
}
if($type == 'str') {
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `static_page_id` =  :staticPageIdKey';
$isFirst=false;
}else{
$condition.=' and `static_page_id` =  :staticPageIdKey';
}
$params[]=array(':staticPageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($staticPageVo->image)){ //If isset Vo->element
$fieldValue=$staticPageVo->image;
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

if (!is_null($staticPageVo->title)){ //If isset Vo->element
$fieldValue=$staticPageVo->title;
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

if (!is_null($staticPageVo->summary)){ //If isset Vo->element
$fieldValue=$staticPageVo->summary;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `summary` $key :summaryKey";
    $isFirst = false;
} else {
    $condition .= " and `summary` $key :summaryKey";
}
if($type == 'str') {
    $params[] = array(':summaryKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':summaryKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `summary` =  :summaryKey';
$isFirst=false;
}else{
$condition.=' and `summary` =  :summaryKey';
}
$params[]=array(':summaryKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageVo->content)){ //If isset Vo->element
$fieldValue=$staticPageVo->content;
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

if (!is_null($staticPageVo->status)){ //If isset Vo->element
$fieldValue=$staticPageVo->status;
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

if (!is_null($staticPageVo->crtDate)){ //If isset Vo->element
$fieldValue=$staticPageVo->crtDate;
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

if (!is_null($staticPageVo->crtBy)){ //If isset Vo->element
$fieldValue=$staticPageVo->crtBy;
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

if (!is_null($staticPageVo->modDate)){ //If isset Vo->element
$fieldValue=$staticPageVo->modDate;
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

if (!is_null($staticPageVo->modBy)){ //If isset Vo->element
$fieldValue=$staticPageVo->modBy;
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


public function updateByPrimaryKey($staticPageVo,$staticPageId){
try {
$sql="UPDATE `static_page` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($staticPageVo->staticPageId)){
if ($isFirst){
$updateFields.=' `static_page_id`= :staticPageId';
$isFirst=false;}else{
$updateFields.=', `static_page_id`= :staticPageId';
}
$params[]=array(':staticPageId', $staticPageVo->staticPageId, PDO::PARAM_INT);
}

if (isset($staticPageVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $staticPageVo->image, PDO::PARAM_STR);
}

if (isset($staticPageVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $staticPageVo->title, PDO::PARAM_STR);
}

if (isset($staticPageVo->summary)){
if ($isFirst){
$updateFields.=' `summary`= :summary';
$isFirst=false;}else{
$updateFields.=', `summary`= :summary';
}
$params[]=array(':summary', $staticPageVo->summary, PDO::PARAM_STR);
}

if (isset($staticPageVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $staticPageVo->content, PDO::PARAM_STR);
}

if (isset($staticPageVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $staticPageVo->status, PDO::PARAM_STR);
}

if (isset($staticPageVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $staticPageVo->crtDate, PDO::PARAM_STR);
}

if (isset($staticPageVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $staticPageVo->crtBy, PDO::PARAM_INT);
}

if (isset($staticPageVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $staticPageVo->modDate, PDO::PARAM_STR);
}

if (isset($staticPageVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $staticPageVo->modBy, PDO::PARAM_INT);
}

$conditions.=' where `static_page_id`= :staticPageId';
$params[]=array(':staticPageId', $staticPageId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (staticPageId)
	 * Example
	 * getValueByPrimaryKey('staticPageName', 1)
	 * Get value of filed staticPageName in table staticPage where staticPageId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$staticPageVo = $this->selectByPrimaryKey($primaryValue);
		if($staticPageVo){
			return $staticPageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('staticPageName', array('staticPageId' => 1))
	 * Get value of filed staticPageName in table staticPage where staticPageId = 1
	 */
	public function getValueByField($fieldName, $where){
		$staticPageVo = new StaticPageVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$staticPageVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$staticPageVos = $this->selectByFilter($staticPageVo);
       
		if($staticPageVos){
			$staticPageVo = $staticPageVos[0];
			return $staticPageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table static_page
	 *
	 * @param int $static_page_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($staticPageId){
		try {
		    $sql = "DELETE FROM `static_page` where `static_page_id` = :staticPageId";
		    $params = array();
		    $params[] = array(':staticPageId', $staticPageId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table static_page
	 *
	 * @param object $staticPageVo
	 * @return boolean
	 */
	public function deleteByFilter($staticPageVo){
		try {
			$sql = 'DELETE FROM `static_page`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($staticPageVo->staticPageId)){
				$isDel = true;
				$condition[] = '`static_page_id` = :staticPageId';
				$params[] = array(':staticPageId', $staticPageVo->staticPageId, PDO::PARAM_INT);
			}
			if (!is_null($staticPageVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $staticPageVo->image, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $staticPageVo->title, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->summary)){
				$isDel = true;
				$condition[] = '`summary` = :summary';
				$params[] = array(':summary', $staticPageVo->summary, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $staticPageVo->content, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $staticPageVo->status, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $staticPageVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $staticPageVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($staticPageVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $staticPageVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($staticPageVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $staticPageVo->modBy, PDO::PARAM_INT);
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
