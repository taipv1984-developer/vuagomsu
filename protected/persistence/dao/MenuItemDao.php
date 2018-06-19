<?php
class MenuItemDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `menu_item`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('MenuItemVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($menuItemId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `menu_item` where `menu_item_id` = :menuItemId");
$stmt->bindParam(':menuItemId',$menuItemId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('MenuItemVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($menuItemVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `menu_item`( `menu_id`, `parent_id`, `title`, `link`, `type`, `table_id`, `params`, `class`, `icon`, `level`, `order`)
VALUES( :menuId, :parentId, :title, :link, :type, :tableId, :params, :class, :icon, :level, :order)");
$stmt->bindParam(':menuId', $menuItemVo->menuId, PDO::PARAM_INT);
$stmt->bindParam(':parentId', $menuItemVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':title', $menuItemVo->title, PDO::PARAM_STR);
$stmt->bindParam(':link', $menuItemVo->link, PDO::PARAM_STR);
$stmt->bindParam(':type', $menuItemVo->type, PDO::PARAM_STR);
$stmt->bindParam(':tableId', $menuItemVo->tableId, PDO::PARAM_INT);
$stmt->bindParam(':params', $menuItemVo->params, PDO::PARAM_STR);
$stmt->bindParam(':class', $menuItemVo->class, PDO::PARAM_STR);
$stmt->bindParam(':icon', $menuItemVo->icon, PDO::PARAM_STR);
$stmt->bindParam(':level', $menuItemVo->level, PDO::PARAM_INT);
$stmt->bindParam(':order', $menuItemVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($menuItemVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `menu_item`( `menu_id`, `parent_id`, `title`, `link`, `type`, `table_id`, `params`, `class`, `icon`, `level`, `order`)
VALUES( :menuId, :parentId, :title, :link, :type, :tableId, :params, :class, :icon, :level, :order)");
$stmt->bindParam(':menuId', $menuItemVo->menuId, PDO::PARAM_INT);
$stmt->bindParam(':parentId', $menuItemVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':title', $menuItemVo->title, PDO::PARAM_STR);
$stmt->bindParam(':link', $menuItemVo->link, PDO::PARAM_STR);
$stmt->bindParam(':type', $menuItemVo->type, PDO::PARAM_STR);
$stmt->bindParam(':tableId', $menuItemVo->tableId, PDO::PARAM_INT);
$stmt->bindParam(':params', $menuItemVo->params, PDO::PARAM_STR);
$stmt->bindParam(':class', $menuItemVo->class, PDO::PARAM_STR);
$stmt->bindParam(':icon', $menuItemVo->icon, PDO::PARAM_STR);
$stmt->bindParam(':level', $menuItemVo->level, PDO::PARAM_INT);
$stmt->bindParam(':order', $menuItemVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table menu_item by $menuItemVo object filter use paging
 * 
 * @param object $menuItemVo is menu_item object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($menuItemVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($menuItemVo)) $menuItemVo = new MenuItemVo();
$sql = "select * from `menu_item` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($menuItemVo->menuItemId)){ //If isset Vo->element
$fieldValue=$menuItemVo->menuItemId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `menu_item_id` $key :menuItemIdKey";
    $isFirst = false;
} else {
    $condition .= " and `menu_item_id` $key :menuItemIdKey";
}
if($type == 'str') {
    $params[] = array(':menuItemIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':menuItemIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `menu_item_id` =  :menuItemIdKey';
$isFirst=false;
}else{
$condition.=' and `menu_item_id` =  :menuItemIdKey';
}
$params[]=array(':menuItemIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->menuId)){ //If isset Vo->element
$fieldValue=$menuItemVo->menuId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `menu_id` $key :menuIdKey";
    $isFirst = false;
} else {
    $condition .= " and `menu_id` $key :menuIdKey";
}
if($type == 'str') {
    $params[] = array(':menuIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':menuIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `menu_id` =  :menuIdKey';
$isFirst=false;
}else{
$condition.=' and `menu_id` =  :menuIdKey';
}
$params[]=array(':menuIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->parentId)){ //If isset Vo->element
$fieldValue=$menuItemVo->parentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `parent_id` $key :parentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `parent_id` $key :parentIdKey";
}
if($type == 'str') {
    $params[] = array(':parentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':parentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `parent_id` =  :parentIdKey';
$isFirst=false;
}else{
$condition.=' and `parent_id` =  :parentIdKey';
}
$params[]=array(':parentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->title)){ //If isset Vo->element
$fieldValue=$menuItemVo->title;
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

if (!is_null($menuItemVo->link)){ //If isset Vo->element
$fieldValue=$menuItemVo->link;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `link` $key :linkKey";
    $isFirst = false;
} else {
    $condition .= " and `link` $key :linkKey";
}
if($type == 'str') {
    $params[] = array(':linkKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':linkKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `link` =  :linkKey';
$isFirst=false;
}else{
$condition.=' and `link` =  :linkKey';
}
$params[]=array(':linkKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->type)){ //If isset Vo->element
$fieldValue=$menuItemVo->type;
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

if (!is_null($menuItemVo->tableId)){ //If isset Vo->element
$fieldValue=$menuItemVo->tableId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `table_id` $key :tableIdKey";
    $isFirst = false;
} else {
    $condition .= " and `table_id` $key :tableIdKey";
}
if($type == 'str') {
    $params[] = array(':tableIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':tableIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `table_id` =  :tableIdKey';
$isFirst=false;
}else{
$condition.=' and `table_id` =  :tableIdKey';
}
$params[]=array(':tableIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->params)){ //If isset Vo->element
$fieldValue=$menuItemVo->params;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `params` $key :paramsKey";
    $isFirst = false;
} else {
    $condition .= " and `params` $key :paramsKey";
}
if($type == 'str') {
    $params[] = array(':paramsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':paramsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `params` =  :paramsKey';
$isFirst=false;
}else{
$condition.=' and `params` =  :paramsKey';
}
$params[]=array(':paramsKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->class)){ //If isset Vo->element
$fieldValue=$menuItemVo->class;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `class` $key :classKey";
    $isFirst = false;
} else {
    $condition .= " and `class` $key :classKey";
}
if($type == 'str') {
    $params[] = array(':classKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':classKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `class` =  :classKey';
$isFirst=false;
}else{
$condition.=' and `class` =  :classKey';
}
$params[]=array(':classKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->icon)){ //If isset Vo->element
$fieldValue=$menuItemVo->icon;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `icon` $key :iconKey";
    $isFirst = false;
} else {
    $condition .= " and `icon` $key :iconKey";
}
if($type == 'str') {
    $params[] = array(':iconKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':iconKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `icon` =  :iconKey';
$isFirst=false;
}else{
$condition.=' and `icon` =  :iconKey';
}
$params[]=array(':iconKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->level)){ //If isset Vo->element
$fieldValue=$menuItemVo->level;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `level` $key :levelKey";
    $isFirst = false;
} else {
    $condition .= " and `level` $key :levelKey";
}
if($type == 'str') {
    $params[] = array(':levelKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':levelKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `level` =  :levelKey';
$isFirst=false;
}else{
$condition.=' and `level` =  :levelKey';
}
$params[]=array(':levelKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->order)){ //If isset Vo->element
$fieldValue=$menuItemVo->order;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order` $key :orderKey";
    $isFirst = false;
} else {
    $condition .= " and `order` $key :orderKey";
}
if($type == 'str') {
    $params[] = array(':orderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order` =  :orderKey';
$isFirst=false;
}else{
$condition.=' and `order` =  :orderKey';
}
$params[]=array(':orderKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('MenuItemVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($menuItemVo){
try {
if (empty($menuItemVo)) $menuItemVo = new MenuItemVo();
$sql = "select count(*) as total from  menu_item ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($menuItemVo->menuItemId)){ //If isset Vo->element
$fieldValue=$menuItemVo->menuItemId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `menu_item_id` $key :menuItemIdKey";
    $isFirst = false;
} else {
    $condition .= " and `menu_item_id` $key :menuItemIdKey";
}
if($type == 'str') {
    $params[] = array(':menuItemIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':menuItemIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `menu_item_id` =  :menuItemIdKey';
$isFirst=false;
}else{
$condition.=' and `menu_item_id` =  :menuItemIdKey';
}
$params[]=array(':menuItemIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->menuId)){ //If isset Vo->element
$fieldValue=$menuItemVo->menuId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `menu_id` $key :menuIdKey";
    $isFirst = false;
} else {
    $condition .= " and `menu_id` $key :menuIdKey";
}
if($type == 'str') {
    $params[] = array(':menuIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':menuIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `menu_id` =  :menuIdKey';
$isFirst=false;
}else{
$condition.=' and `menu_id` =  :menuIdKey';
}
$params[]=array(':menuIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->parentId)){ //If isset Vo->element
$fieldValue=$menuItemVo->parentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `parent_id` $key :parentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `parent_id` $key :parentIdKey";
}
if($type == 'str') {
    $params[] = array(':parentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':parentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `parent_id` =  :parentIdKey';
$isFirst=false;
}else{
$condition.=' and `parent_id` =  :parentIdKey';
}
$params[]=array(':parentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->title)){ //If isset Vo->element
$fieldValue=$menuItemVo->title;
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

if (!is_null($menuItemVo->link)){ //If isset Vo->element
$fieldValue=$menuItemVo->link;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `link` $key :linkKey";
    $isFirst = false;
} else {
    $condition .= " and `link` $key :linkKey";
}
if($type == 'str') {
    $params[] = array(':linkKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':linkKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `link` =  :linkKey';
$isFirst=false;
}else{
$condition.=' and `link` =  :linkKey';
}
$params[]=array(':linkKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->type)){ //If isset Vo->element
$fieldValue=$menuItemVo->type;
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

if (!is_null($menuItemVo->tableId)){ //If isset Vo->element
$fieldValue=$menuItemVo->tableId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `table_id` $key :tableIdKey";
    $isFirst = false;
} else {
    $condition .= " and `table_id` $key :tableIdKey";
}
if($type == 'str') {
    $params[] = array(':tableIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':tableIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `table_id` =  :tableIdKey';
$isFirst=false;
}else{
$condition.=' and `table_id` =  :tableIdKey';
}
$params[]=array(':tableIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->params)){ //If isset Vo->element
$fieldValue=$menuItemVo->params;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `params` $key :paramsKey";
    $isFirst = false;
} else {
    $condition .= " and `params` $key :paramsKey";
}
if($type == 'str') {
    $params[] = array(':paramsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':paramsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `params` =  :paramsKey';
$isFirst=false;
}else{
$condition.=' and `params` =  :paramsKey';
}
$params[]=array(':paramsKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->class)){ //If isset Vo->element
$fieldValue=$menuItemVo->class;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `class` $key :classKey";
    $isFirst = false;
} else {
    $condition .= " and `class` $key :classKey";
}
if($type == 'str') {
    $params[] = array(':classKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':classKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `class` =  :classKey';
$isFirst=false;
}else{
$condition.=' and `class` =  :classKey';
}
$params[]=array(':classKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->icon)){ //If isset Vo->element
$fieldValue=$menuItemVo->icon;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `icon` $key :iconKey";
    $isFirst = false;
} else {
    $condition .= " and `icon` $key :iconKey";
}
if($type == 'str') {
    $params[] = array(':iconKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':iconKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `icon` =  :iconKey';
$isFirst=false;
}else{
$condition.=' and `icon` =  :iconKey';
}
$params[]=array(':iconKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($menuItemVo->level)){ //If isset Vo->element
$fieldValue=$menuItemVo->level;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `level` $key :levelKey";
    $isFirst = false;
} else {
    $condition .= " and `level` $key :levelKey";
}
if($type == 'str') {
    $params[] = array(':levelKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':levelKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `level` =  :levelKey';
$isFirst=false;
}else{
$condition.=' and `level` =  :levelKey';
}
$params[]=array(':levelKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuItemVo->order)){ //If isset Vo->element
$fieldValue=$menuItemVo->order;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order` $key :orderKey";
    $isFirst = false;
} else {
    $condition .= " and `order` $key :orderKey";
}
if($type == 'str') {
    $params[] = array(':orderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order` =  :orderKey';
$isFirst=false;
}else{
$condition.=' and `order` =  :orderKey';
}
$params[]=array(':orderKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($menuItemVo,$menuItemId){
try {
$sql="UPDATE `menu_item` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($menuItemVo->menuItemId)){
if ($isFirst){
$updateFields.=' `menu_item_id`= :menuItemId';
$isFirst=false;}else{
$updateFields.=', `menu_item_id`= :menuItemId';
}
$params[]=array(':menuItemId', $menuItemVo->menuItemId, PDO::PARAM_INT);
}

if (isset($menuItemVo->menuId)){
if ($isFirst){
$updateFields.=' `menu_id`= :menuId';
$isFirst=false;}else{
$updateFields.=', `menu_id`= :menuId';
}
$params[]=array(':menuId', $menuItemVo->menuId, PDO::PARAM_INT);
}

if (isset($menuItemVo->parentId)){
if ($isFirst){
$updateFields.=' `parent_id`= :parentId';
$isFirst=false;}else{
$updateFields.=', `parent_id`= :parentId';
}
$params[]=array(':parentId', $menuItemVo->parentId, PDO::PARAM_INT);
}

if (isset($menuItemVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $menuItemVo->title, PDO::PARAM_STR);
}

if (isset($menuItemVo->link)){
if ($isFirst){
$updateFields.=' `link`= :link';
$isFirst=false;}else{
$updateFields.=', `link`= :link';
}
$params[]=array(':link', $menuItemVo->link, PDO::PARAM_STR);
}

if (isset($menuItemVo->type)){
if ($isFirst){
$updateFields.=' `type`= :type';
$isFirst=false;}else{
$updateFields.=', `type`= :type';
}
$params[]=array(':type', $menuItemVo->type, PDO::PARAM_STR);
}

if (isset($menuItemVo->tableId)){
if ($isFirst){
$updateFields.=' `table_id`= :tableId';
$isFirst=false;}else{
$updateFields.=', `table_id`= :tableId';
}
$params[]=array(':tableId', $menuItemVo->tableId, PDO::PARAM_INT);
}

if (isset($menuItemVo->params)){
if ($isFirst){
$updateFields.=' `params`= :params';
$isFirst=false;}else{
$updateFields.=', `params`= :params';
}
$params[]=array(':params', $menuItemVo->params, PDO::PARAM_STR);
}

if (isset($menuItemVo->class)){
if ($isFirst){
$updateFields.=' `class`= :class';
$isFirst=false;}else{
$updateFields.=', `class`= :class';
}
$params[]=array(':class', $menuItemVo->class, PDO::PARAM_STR);
}

if (isset($menuItemVo->icon)){
if ($isFirst){
$updateFields.=' `icon`= :icon';
$isFirst=false;}else{
$updateFields.=', `icon`= :icon';
}
$params[]=array(':icon', $menuItemVo->icon, PDO::PARAM_STR);
}

if (isset($menuItemVo->level)){
if ($isFirst){
$updateFields.=' `level`= :level';
$isFirst=false;}else{
$updateFields.=', `level`= :level';
}
$params[]=array(':level', $menuItemVo->level, PDO::PARAM_INT);
}

if (isset($menuItemVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $menuItemVo->order, PDO::PARAM_INT);
}

$conditions.=' where `menu_item_id`= :menuItemId';
$params[]=array(':menuItemId', $menuItemId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (menuItemId)
	 * Example
	 * getValueByPrimaryKey('menuItemName', 1)
	 * Get value of filed menuItemName in table menuItem where menuItemId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$menuItemVo = $this->selectByPrimaryKey($primaryValue);
		if($menuItemVo){
			return $menuItemVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('menuItemName', array('menuItemId' => 1))
	 * Get value of filed menuItemName in table menuItem where menuItemId = 1
	 */
	public function getValueByField($fieldName, $where){
		$menuItemVo = new MenuItemVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$menuItemVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$menuItemVos = $this->selectByFilter($menuItemVo);
       
		if($menuItemVos){
			$menuItemVo = $menuItemVos[0];
			return $menuItemVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table menu_item
	 *
	 * @param int $menu_item_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($menuItemId){
		try {
		    $sql = "DELETE FROM `menu_item` where `menu_item_id` = :menuItemId";
		    $params = array();
		    $params[] = array(':menuItemId', $menuItemId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table menu_item
	 *
	 * @param object $menuItemVo
	 * @return boolean
	 */
	public function deleteByFilter($menuItemVo){
		try {
			$sql = 'DELETE FROM `menu_item`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($menuItemVo->menuItemId)){
				$isDel = true;
				$condition[] = '`menu_item_id` = :menuItemId';
				$params[] = array(':menuItemId', $menuItemVo->menuItemId, PDO::PARAM_INT);
			}
			if (!is_null($menuItemVo->menuId)){
				$isDel = true;
				$condition[] = '`menu_id` = :menuId';
				$params[] = array(':menuId', $menuItemVo->menuId, PDO::PARAM_INT);
			}
			if (!is_null($menuItemVo->parentId)){
				$isDel = true;
				$condition[] = '`parent_id` = :parentId';
				$params[] = array(':parentId', $menuItemVo->parentId, PDO::PARAM_INT);
			}
			if (!is_null($menuItemVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $menuItemVo->title, PDO::PARAM_STR);
			}
			if (!is_null($menuItemVo->link)){
				$isDel = true;
				$condition[] = '`link` = :link';
				$params[] = array(':link', $menuItemVo->link, PDO::PARAM_STR);
			}
			if (!is_null($menuItemVo->type)){
				$isDel = true;
				$condition[] = '`type` = :type';
				$params[] = array(':type', $menuItemVo->type, PDO::PARAM_STR);
			}
			if (!is_null($menuItemVo->tableId)){
				$isDel = true;
				$condition[] = '`table_id` = :tableId';
				$params[] = array(':tableId', $menuItemVo->tableId, PDO::PARAM_INT);
			}
			if (!is_null($menuItemVo->params)){
				$isDel = true;
				$condition[] = '`params` = :params';
				$params[] = array(':params', $menuItemVo->params, PDO::PARAM_STR);
			}
			if (!is_null($menuItemVo->class)){
				$isDel = true;
				$condition[] = '`class` = :class';
				$params[] = array(':class', $menuItemVo->class, PDO::PARAM_STR);
			}
			if (!is_null($menuItemVo->icon)){
				$isDel = true;
				$condition[] = '`icon` = :icon';
				$params[] = array(':icon', $menuItemVo->icon, PDO::PARAM_STR);
			}
			if (!is_null($menuItemVo->level)){
				$isDel = true;
				$condition[] = '`level` = :level';
				$params[] = array(':level', $menuItemVo->level, PDO::PARAM_INT);
			}
			if (!is_null($menuItemVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $menuItemVo->order, PDO::PARAM_INT);
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
