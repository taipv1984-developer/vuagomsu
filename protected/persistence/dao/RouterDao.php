<?php
class RouterDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `router`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('RouterVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($routerId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `router` where `router_id` = :routerId");
$stmt->bindParam(':routerId',$routerId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('RouterVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($routerVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `router`( `layout_id`, `pk_name`, `prefix`, `suffix`, `alias`, `alias_by`, `alias_list`, `callback`)
VALUES( :layoutId, :pkName, :prefix, :suffix, :alias, :aliasBy, :aliasList, :callback)");
$stmt->bindParam(':layoutId', $routerVo->layoutId, PDO::PARAM_INT);
$stmt->bindParam(':pkName', $routerVo->pkName, PDO::PARAM_STR);
$stmt->bindParam(':prefix', $routerVo->prefix, PDO::PARAM_STR);
$stmt->bindParam(':suffix', $routerVo->suffix, PDO::PARAM_STR);
$stmt->bindParam(':alias', $routerVo->alias, PDO::PARAM_STR);
$stmt->bindParam(':aliasBy', $routerVo->aliasBy, PDO::PARAM_STR);
$stmt->bindParam(':aliasList', $routerVo->aliasList, PDO::PARAM_STR);
$stmt->bindParam(':callback', $routerVo->callback, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($routerVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `router`( `layout_id`, `pk_name`, `prefix`, `suffix`, `alias`, `alias_by`, `alias_list`, `callback`)
VALUES( :layoutId, :pkName, :prefix, :suffix, :alias, :aliasBy, :aliasList, :callback)");
$stmt->bindParam(':layoutId', $routerVo->layoutId, PDO::PARAM_INT);
$stmt->bindParam(':pkName', $routerVo->pkName, PDO::PARAM_STR);
$stmt->bindParam(':prefix', $routerVo->prefix, PDO::PARAM_STR);
$stmt->bindParam(':suffix', $routerVo->suffix, PDO::PARAM_STR);
$stmt->bindParam(':alias', $routerVo->alias, PDO::PARAM_STR);
$stmt->bindParam(':aliasBy', $routerVo->aliasBy, PDO::PARAM_STR);
$stmt->bindParam(':aliasList', $routerVo->aliasList, PDO::PARAM_STR);
$stmt->bindParam(':callback', $routerVo->callback, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table router by $routerVo object filter use paging
 * 
 * @param object $routerVo is router object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($routerVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($routerVo)) $routerVo = new RouterVo();
$sql = "select * from `router` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($routerVo->routerId)){ //If isset Vo->element
$fieldValue=$routerVo->routerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router_id` $key :routerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `router_id` $key :routerIdKey";
}
if($type == 'str') {
    $params[] = array(':routerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router_id` =  :routerIdKey';
$isFirst=false;
}else{
$condition.=' and `router_id` =  :routerIdKey';
}
$params[]=array(':routerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerVo->layoutId)){ //If isset Vo->element
$fieldValue=$routerVo->layoutId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_id` $key :layoutIdKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_id` $key :layoutIdKey";
}
if($type == 'str') {
    $params[] = array(':layoutIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_id` =  :layoutIdKey';
$isFirst=false;
}else{
$condition.=' and `layout_id` =  :layoutIdKey';
}
$params[]=array(':layoutIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerVo->pkName)){ //If isset Vo->element
$fieldValue=$routerVo->pkName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `pk_name` $key :pkNameKey";
    $isFirst = false;
} else {
    $condition .= " and `pk_name` $key :pkNameKey";
}
if($type == 'str') {
    $params[] = array(':pkNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pkNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `pk_name` =  :pkNameKey';
$isFirst=false;
}else{
$condition.=' and `pk_name` =  :pkNameKey';
}
$params[]=array(':pkNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->prefix)){ //If isset Vo->element
$fieldValue=$routerVo->prefix;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `prefix` $key :prefixKey";
    $isFirst = false;
} else {
    $condition .= " and `prefix` $key :prefixKey";
}
if($type == 'str') {
    $params[] = array(':prefixKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':prefixKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `prefix` =  :prefixKey';
$isFirst=false;
}else{
$condition.=' and `prefix` =  :prefixKey';
}
$params[]=array(':prefixKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->suffix)){ //If isset Vo->element
$fieldValue=$routerVo->suffix;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `suffix` $key :suffixKey";
    $isFirst = false;
} else {
    $condition .= " and `suffix` $key :suffixKey";
}
if($type == 'str') {
    $params[] = array(':suffixKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':suffixKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `suffix` =  :suffixKey';
$isFirst=false;
}else{
$condition.=' and `suffix` =  :suffixKey';
}
$params[]=array(':suffixKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->alias)){ //If isset Vo->element
$fieldValue=$routerVo->alias;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias` $key :aliasKey";
    $isFirst = false;
} else {
    $condition .= " and `alias` $key :aliasKey";
}
if($type == 'str') {
    $params[] = array(':aliasKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias` =  :aliasKey';
$isFirst=false;
}else{
$condition.=' and `alias` =  :aliasKey';
}
$params[]=array(':aliasKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->aliasBy)){ //If isset Vo->element
$fieldValue=$routerVo->aliasBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias_by` $key :aliasByKey";
    $isFirst = false;
} else {
    $condition .= " and `alias_by` $key :aliasByKey";
}
if($type == 'str') {
    $params[] = array(':aliasByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias_by` =  :aliasByKey';
$isFirst=false;
}else{
$condition.=' and `alias_by` =  :aliasByKey';
}
$params[]=array(':aliasByKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->aliasList)){ //If isset Vo->element
$fieldValue=$routerVo->aliasList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias_list` $key :aliasListKey";
    $isFirst = false;
} else {
    $condition .= " and `alias_list` $key :aliasListKey";
}
if($type == 'str') {
    $params[] = array(':aliasListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias_list` =  :aliasListKey';
$isFirst=false;
}else{
$condition.=' and `alias_list` =  :aliasListKey';
}
$params[]=array(':aliasListKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->callback)){ //If isset Vo->element
$fieldValue=$routerVo->callback;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `callback` $key :callbackKey";
    $isFirst = false;
} else {
    $condition .= " and `callback` $key :callbackKey";
}
if($type == 'str') {
    $params[] = array(':callbackKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':callbackKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `callback` =  :callbackKey';
$isFirst=false;
}else{
$condition.=' and `callback` =  :callbackKey';
}
$params[]=array(':callbackKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('RouterVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($routerVo){
try {
if (empty($routerVo)) $routerVo = new RouterVo();
$sql = "select count(*) as total from  router ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($routerVo->routerId)){ //If isset Vo->element
$fieldValue=$routerVo->routerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router_id` $key :routerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `router_id` $key :routerIdKey";
}
if($type == 'str') {
    $params[] = array(':routerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router_id` =  :routerIdKey';
$isFirst=false;
}else{
$condition.=' and `router_id` =  :routerIdKey';
}
$params[]=array(':routerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerVo->layoutId)){ //If isset Vo->element
$fieldValue=$routerVo->layoutId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_id` $key :layoutIdKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_id` $key :layoutIdKey";
}
if($type == 'str') {
    $params[] = array(':layoutIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_id` =  :layoutIdKey';
$isFirst=false;
}else{
$condition.=' and `layout_id` =  :layoutIdKey';
}
$params[]=array(':layoutIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($routerVo->pkName)){ //If isset Vo->element
$fieldValue=$routerVo->pkName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `pk_name` $key :pkNameKey";
    $isFirst = false;
} else {
    $condition .= " and `pk_name` $key :pkNameKey";
}
if($type == 'str') {
    $params[] = array(':pkNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pkNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `pk_name` =  :pkNameKey';
$isFirst=false;
}else{
$condition.=' and `pk_name` =  :pkNameKey';
}
$params[]=array(':pkNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->prefix)){ //If isset Vo->element
$fieldValue=$routerVo->prefix;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `prefix` $key :prefixKey";
    $isFirst = false;
} else {
    $condition .= " and `prefix` $key :prefixKey";
}
if($type == 'str') {
    $params[] = array(':prefixKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':prefixKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `prefix` =  :prefixKey';
$isFirst=false;
}else{
$condition.=' and `prefix` =  :prefixKey';
}
$params[]=array(':prefixKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->suffix)){ //If isset Vo->element
$fieldValue=$routerVo->suffix;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `suffix` $key :suffixKey";
    $isFirst = false;
} else {
    $condition .= " and `suffix` $key :suffixKey";
}
if($type == 'str') {
    $params[] = array(':suffixKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':suffixKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `suffix` =  :suffixKey';
$isFirst=false;
}else{
$condition.=' and `suffix` =  :suffixKey';
}
$params[]=array(':suffixKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->alias)){ //If isset Vo->element
$fieldValue=$routerVo->alias;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias` $key :aliasKey";
    $isFirst = false;
} else {
    $condition .= " and `alias` $key :aliasKey";
}
if($type == 'str') {
    $params[] = array(':aliasKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias` =  :aliasKey';
$isFirst=false;
}else{
$condition.=' and `alias` =  :aliasKey';
}
$params[]=array(':aliasKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->aliasBy)){ //If isset Vo->element
$fieldValue=$routerVo->aliasBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias_by` $key :aliasByKey";
    $isFirst = false;
} else {
    $condition .= " and `alias_by` $key :aliasByKey";
}
if($type == 'str') {
    $params[] = array(':aliasByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias_by` =  :aliasByKey';
$isFirst=false;
}else{
$condition.=' and `alias_by` =  :aliasByKey';
}
$params[]=array(':aliasByKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->aliasList)){ //If isset Vo->element
$fieldValue=$routerVo->aliasList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `alias_list` $key :aliasListKey";
    $isFirst = false;
} else {
    $condition .= " and `alias_list` $key :aliasListKey";
}
if($type == 'str') {
    $params[] = array(':aliasListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':aliasListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `alias_list` =  :aliasListKey';
$isFirst=false;
}else{
$condition.=' and `alias_list` =  :aliasListKey';
}
$params[]=array(':aliasListKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($routerVo->callback)){ //If isset Vo->element
$fieldValue=$routerVo->callback;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `callback` $key :callbackKey";
    $isFirst = false;
} else {
    $condition .= " and `callback` $key :callbackKey";
}
if($type == 'str') {
    $params[] = array(':callbackKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':callbackKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `callback` =  :callbackKey';
$isFirst=false;
}else{
$condition.=' and `callback` =  :callbackKey';
}
$params[]=array(':callbackKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($routerVo,$routerId){
try {
$sql="UPDATE `router` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($routerVo->routerId)){
if ($isFirst){
$updateFields.=' `router_id`= :routerId';
$isFirst=false;}else{
$updateFields.=', `router_id`= :routerId';
}
$params[]=array(':routerId', $routerVo->routerId, PDO::PARAM_INT);
}

if (isset($routerVo->layoutId)){
if ($isFirst){
$updateFields.=' `layout_id`= :layoutId';
$isFirst=false;}else{
$updateFields.=', `layout_id`= :layoutId';
}
$params[]=array(':layoutId', $routerVo->layoutId, PDO::PARAM_INT);
}

if (isset($routerVo->pkName)){
if ($isFirst){
$updateFields.=' `pk_name`= :pkName';
$isFirst=false;}else{
$updateFields.=', `pk_name`= :pkName';
}
$params[]=array(':pkName', $routerVo->pkName, PDO::PARAM_STR);
}

if (isset($routerVo->prefix)){
if ($isFirst){
$updateFields.=' `prefix`= :prefix';
$isFirst=false;}else{
$updateFields.=', `prefix`= :prefix';
}
$params[]=array(':prefix', $routerVo->prefix, PDO::PARAM_STR);
}

if (isset($routerVo->suffix)){
if ($isFirst){
$updateFields.=' `suffix`= :suffix';
$isFirst=false;}else{
$updateFields.=', `suffix`= :suffix';
}
$params[]=array(':suffix', $routerVo->suffix, PDO::PARAM_STR);
}

if (isset($routerVo->alias)){
if ($isFirst){
$updateFields.=' `alias`= :alias';
$isFirst=false;}else{
$updateFields.=', `alias`= :alias';
}
$params[]=array(':alias', $routerVo->alias, PDO::PARAM_STR);
}

if (isset($routerVo->aliasBy)){
if ($isFirst){
$updateFields.=' `alias_by`= :aliasBy';
$isFirst=false;}else{
$updateFields.=', `alias_by`= :aliasBy';
}
$params[]=array(':aliasBy', $routerVo->aliasBy, PDO::PARAM_STR);
}

if (isset($routerVo->aliasList)){
if ($isFirst){
$updateFields.=' `alias_list`= :aliasList';
$isFirst=false;}else{
$updateFields.=', `alias_list`= :aliasList';
}
$params[]=array(':aliasList', $routerVo->aliasList, PDO::PARAM_STR);
}

if (isset($routerVo->callback)){
if ($isFirst){
$updateFields.=' `callback`= :callback';
$isFirst=false;}else{
$updateFields.=', `callback`= :callback';
}
$params[]=array(':callback', $routerVo->callback, PDO::PARAM_STR);
}

$conditions.=' where `router_id`= :routerId';
$params[]=array(':routerId', $routerId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (routerId)
	 * Example
	 * getValueByPrimaryKey('routerName', 1)
	 * Get value of filed routerName in table router where routerId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$routerVo = $this->selectByPrimaryKey($primaryValue);
		if($routerVo){
			return $routerVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('routerName', array('routerId' => 1))
	 * Get value of filed routerName in table router where routerId = 1
	 */
	public function getValueByField($fieldName, $where){
		$routerVo = new RouterVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$routerVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$routerVos = $this->selectByFilter($routerVo);
       
		if($routerVos){
			$routerVo = $routerVos[0];
			return $routerVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table router
	 *
	 * @param int $router_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($routerId){
		try {
		    $sql = "DELETE FROM `router` where `router_id` = :routerId";
		    $params = array();
		    $params[] = array(':routerId', $routerId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table router
	 *
	 * @param object $routerVo
	 * @return boolean
	 */
	public function deleteByFilter($routerVo){
		try {
			$sql = 'DELETE FROM `router`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($routerVo->routerId)){
				$isDel = true;
				$condition[] = '`router_id` = :routerId';
				$params[] = array(':routerId', $routerVo->routerId, PDO::PARAM_INT);
			}
			if (!is_null($routerVo->layoutId)){
				$isDel = true;
				$condition[] = '`layout_id` = :layoutId';
				$params[] = array(':layoutId', $routerVo->layoutId, PDO::PARAM_INT);
			}
			if (!is_null($routerVo->pkName)){
				$isDel = true;
				$condition[] = '`pk_name` = :pkName';
				$params[] = array(':pkName', $routerVo->pkName, PDO::PARAM_STR);
			}
			if (!is_null($routerVo->prefix)){
				$isDel = true;
				$condition[] = '`prefix` = :prefix';
				$params[] = array(':prefix', $routerVo->prefix, PDO::PARAM_STR);
			}
			if (!is_null($routerVo->suffix)){
				$isDel = true;
				$condition[] = '`suffix` = :suffix';
				$params[] = array(':suffix', $routerVo->suffix, PDO::PARAM_STR);
			}
			if (!is_null($routerVo->alias)){
				$isDel = true;
				$condition[] = '`alias` = :alias';
				$params[] = array(':alias', $routerVo->alias, PDO::PARAM_STR);
			}
			if (!is_null($routerVo->aliasBy)){
				$isDel = true;
				$condition[] = '`alias_by` = :aliasBy';
				$params[] = array(':aliasBy', $routerVo->aliasBy, PDO::PARAM_STR);
			}
			if (!is_null($routerVo->aliasList)){
				$isDel = true;
				$condition[] = '`alias_list` = :aliasList';
				$params[] = array(':aliasList', $routerVo->aliasList, PDO::PARAM_STR);
			}
			if (!is_null($routerVo->callback)){
				$isDel = true;
				$condition[] = '`callback` = :callback';
				$params[] = array(':callback', $routerVo->callback, PDO::PARAM_STR);
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
