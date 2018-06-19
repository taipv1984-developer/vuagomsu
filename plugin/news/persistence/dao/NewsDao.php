<?php
class NewsDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `news`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($newsId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `news` where `news_id` = :newsId");
$stmt->bindParam(':newsId',$newsId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news`( `news_category_id`, `image`, `title`, `summary`, `content`, `view_count`, `status`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :newsCategoryId, :image, :title, :summary, :content, :viewCount, :status, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':newsCategoryId', $newsVo->newsCategoryId, PDO::PARAM_INT);
$stmt->bindParam(':image', $newsVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $newsVo->title, PDO::PARAM_STR);
$stmt->bindParam(':summary', $newsVo->summary, PDO::PARAM_STR);
$stmt->bindParam(':content', $newsVo->content, PDO::PARAM_STR);
$stmt->bindParam(':viewCount', $newsVo->viewCount, PDO::PARAM_INT);
$stmt->bindParam(':status', $newsVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $newsVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $newsVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $newsVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news`( `news_category_id`, `image`, `title`, `summary`, `content`, `view_count`, `status`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :newsCategoryId, :image, :title, :summary, :content, :viewCount, :status, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':newsCategoryId', $newsVo->newsCategoryId, PDO::PARAM_INT);
$stmt->bindParam(':image', $newsVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $newsVo->title, PDO::PARAM_STR);
$stmt->bindParam(':summary', $newsVo->summary, PDO::PARAM_STR);
$stmt->bindParam(':content', $newsVo->content, PDO::PARAM_STR);
$stmt->bindParam(':viewCount', $newsVo->viewCount, PDO::PARAM_INT);
$stmt->bindParam(':status', $newsVo->status, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $newsVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $newsVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $newsVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table news by $newsVo object filter use paging
 * 
 * @param object $newsVo is news object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsVo)) $newsVo = new NewsVo();
$sql = "select * from `news` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsVo->newsId)){ //If isset Vo->element
$fieldValue=$newsVo->newsId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_id` $key :newsIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_id` $key :newsIdKey";
}
if($type == 'str') {
    $params[] = array(':newsIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_id` =  :newsIdKey';
$isFirst=false;
}else{
$condition.=' and `news_id` =  :newsIdKey';
}
$params[]=array(':newsIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsVo->newsCategoryId)){ //If isset Vo->element
$fieldValue=$newsVo->newsCategoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_category_id` $key :newsCategoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_category_id` $key :newsCategoryIdKey";
}
if($type == 'str') {
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_category_id` =  :newsCategoryIdKey';
$isFirst=false;
}else{
$condition.=' and `news_category_id` =  :newsCategoryIdKey';
}
$params[]=array(':newsCategoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsVo->image)){ //If isset Vo->element
$fieldValue=$newsVo->image;
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

if (!is_null($newsVo->title)){ //If isset Vo->element
$fieldValue=$newsVo->title;
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

if (!is_null($newsVo->summary)){ //If isset Vo->element
$fieldValue=$newsVo->summary;
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

if (!is_null($newsVo->content)){ //If isset Vo->element
$fieldValue=$newsVo->content;
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

if (!is_null($newsVo->viewCount)){ //If isset Vo->element
$fieldValue=$newsVo->viewCount;
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

if (!is_null($newsVo->status)){ //If isset Vo->element
$fieldValue=$newsVo->status;
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

if (!is_null($newsVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsVo->crtDate;
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

if (!is_null($newsVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsVo->crtBy;
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

if (!is_null($newsVo->modDate)){ //If isset Vo->element
$fieldValue=$newsVo->modDate;
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

if (!is_null($newsVo->modBy)){ //If isset Vo->element
$fieldValue=$newsVo->modBy;
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
return PersistentHelper::mapResult('NewsVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsVo){
try {
if (empty($newsVo)) $newsVo = new NewsVo();
$sql = "select count(*) as total from  news ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsVo->newsId)){ //If isset Vo->element
$fieldValue=$newsVo->newsId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_id` $key :newsIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_id` $key :newsIdKey";
}
if($type == 'str') {
    $params[] = array(':newsIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_id` =  :newsIdKey';
$isFirst=false;
}else{
$condition.=' and `news_id` =  :newsIdKey';
}
$params[]=array(':newsIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsVo->newsCategoryId)){ //If isset Vo->element
$fieldValue=$newsVo->newsCategoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_category_id` $key :newsCategoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_category_id` $key :newsCategoryIdKey";
}
if($type == 'str') {
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_category_id` =  :newsCategoryIdKey';
$isFirst=false;
}else{
$condition.=' and `news_category_id` =  :newsCategoryIdKey';
}
$params[]=array(':newsCategoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsVo->image)){ //If isset Vo->element
$fieldValue=$newsVo->image;
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

if (!is_null($newsVo->title)){ //If isset Vo->element
$fieldValue=$newsVo->title;
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

if (!is_null($newsVo->summary)){ //If isset Vo->element
$fieldValue=$newsVo->summary;
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

if (!is_null($newsVo->content)){ //If isset Vo->element
$fieldValue=$newsVo->content;
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

if (!is_null($newsVo->viewCount)){ //If isset Vo->element
$fieldValue=$newsVo->viewCount;
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

if (!is_null($newsVo->status)){ //If isset Vo->element
$fieldValue=$newsVo->status;
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

if (!is_null($newsVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsVo->crtDate;
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

if (!is_null($newsVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsVo->crtBy;
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

if (!is_null($newsVo->modDate)){ //If isset Vo->element
$fieldValue=$newsVo->modDate;
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

if (!is_null($newsVo->modBy)){ //If isset Vo->element
$fieldValue=$newsVo->modBy;
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


public function updateByPrimaryKey($newsVo,$newsId){
try {
$sql="UPDATE `news` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsVo->newsId)){
if ($isFirst){
$updateFields.=' `news_id`= :newsId';
$isFirst=false;}else{
$updateFields.=', `news_id`= :newsId';
}
$params[]=array(':newsId', $newsVo->newsId, PDO::PARAM_INT);
}

if (isset($newsVo->newsCategoryId)){
if ($isFirst){
$updateFields.=' `news_category_id`= :newsCategoryId';
$isFirst=false;}else{
$updateFields.=', `news_category_id`= :newsCategoryId';
}
$params[]=array(':newsCategoryId', $newsVo->newsCategoryId, PDO::PARAM_INT);
}

if (isset($newsVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $newsVo->image, PDO::PARAM_STR);
}

if (isset($newsVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $newsVo->title, PDO::PARAM_STR);
}

if (isset($newsVo->summary)){
if ($isFirst){
$updateFields.=' `summary`= :summary';
$isFirst=false;}else{
$updateFields.=', `summary`= :summary';
}
$params[]=array(':summary', $newsVo->summary, PDO::PARAM_STR);
}

if (isset($newsVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $newsVo->content, PDO::PARAM_STR);
}

if (isset($newsVo->viewCount)){
if ($isFirst){
$updateFields.=' `view_count`= :viewCount';
$isFirst=false;}else{
$updateFields.=', `view_count`= :viewCount';
}
$params[]=array(':viewCount', $newsVo->viewCount, PDO::PARAM_INT);
}

if (isset($newsVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $newsVo->status, PDO::PARAM_STR);
}

if (isset($newsVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $newsVo->crtDate, PDO::PARAM_STR);
}

if (isset($newsVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $newsVo->crtBy, PDO::PARAM_INT);
}

if (isset($newsVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $newsVo->modDate, PDO::PARAM_STR);
}

if (isset($newsVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $newsVo->modBy, PDO::PARAM_INT);
}

$conditions.=' where `news_id`= :newsId';
$params[]=array(':newsId', $newsId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsId)
	 * Example
	 * getValueByPrimaryKey('newsName', 1)
	 * Get value of filed newsName in table news where newsId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsVo = $this->selectByPrimaryKey($primaryValue);
		if($newsVo){
			return $newsVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsName', array('newsId' => 1))
	 * Get value of filed newsName in table news where newsId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsVo = new NewsVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsVos = $this->selectByFilter($newsVo);
       
		if($newsVos){
			$newsVo = $newsVos[0];
			return $newsVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table news
	 *
	 * @param int $news_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($newsId){
		try {
		    $sql = "DELETE FROM `news` where `news_id` = :newsId";
		    $params = array();
		    $params[] = array(':newsId', $newsId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table news
	 *
	 * @param object $newsVo
	 * @return boolean
	 */
	public function deleteByFilter($newsVo){
		try {
			$sql = 'DELETE FROM `news`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsVo->newsId)){
				$isDel = true;
				$condition[] = '`news_id` = :newsId';
				$params[] = array(':newsId', $newsVo->newsId, PDO::PARAM_INT);
			}
			if (!is_null($newsVo->newsCategoryId)){
				$isDel = true;
				$condition[] = '`news_category_id` = :newsCategoryId';
				$params[] = array(':newsCategoryId', $newsVo->newsCategoryId, PDO::PARAM_INT);
			}
			if (!is_null($newsVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $newsVo->image, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $newsVo->title, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->summary)){
				$isDel = true;
				$condition[] = '`summary` = :summary';
				$params[] = array(':summary', $newsVo->summary, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $newsVo->content, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->viewCount)){
				$isDel = true;
				$condition[] = '`view_count` = :viewCount';
				$params[] = array(':viewCount', $newsVo->viewCount, PDO::PARAM_INT);
			}
			if (!is_null($newsVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $newsVo->status, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $newsVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $newsVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($newsVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $newsVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($newsVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $newsVo->modBy, PDO::PARAM_INT);
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
