<?php
class LayoutWidgetDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `layout_widget`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('LayoutWidgetVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($layoutWidgetId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `layout_widget` where `layout_widget_id` = :layoutWidgetId");
$stmt->bindParam(':layoutWidgetId',$layoutWidgetId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('LayoutWidgetVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($layoutWidgetVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `layout_widget`( `layout_id`, `layout_row_id`, `widget_id`, `widget_controller`, `type`, `setting`, `order`, `status`)
VALUES( :layoutId, :layoutRowId, :widgetId, :widgetController, :type, :setting, :order, :status)");
$stmt->bindParam(':layoutId', $layoutWidgetVo->layoutId, PDO::PARAM_INT);
$stmt->bindParam(':layoutRowId', $layoutWidgetVo->layoutRowId, PDO::PARAM_INT);
$stmt->bindParam(':widgetId', $layoutWidgetVo->widgetId, PDO::PARAM_INT);
$stmt->bindParam(':widgetController', $layoutWidgetVo->widgetController, PDO::PARAM_STR);
$stmt->bindParam(':type', $layoutWidgetVo->type, PDO::PARAM_STR);
$stmt->bindParam(':setting', $layoutWidgetVo->setting, PDO::PARAM_STR);
$stmt->bindParam(':order', $layoutWidgetVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $layoutWidgetVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($layoutWidgetVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `layout_widget`( `layout_id`, `layout_row_id`, `widget_id`, `widget_controller`, `type`, `setting`, `order`, `status`)
VALUES( :layoutId, :layoutRowId, :widgetId, :widgetController, :type, :setting, :order, :status)");
$stmt->bindParam(':layoutId', $layoutWidgetVo->layoutId, PDO::PARAM_INT);
$stmt->bindParam(':layoutRowId', $layoutWidgetVo->layoutRowId, PDO::PARAM_INT);
$stmt->bindParam(':widgetId', $layoutWidgetVo->widgetId, PDO::PARAM_INT);
$stmt->bindParam(':widgetController', $layoutWidgetVo->widgetController, PDO::PARAM_STR);
$stmt->bindParam(':type', $layoutWidgetVo->type, PDO::PARAM_STR);
$stmt->bindParam(':setting', $layoutWidgetVo->setting, PDO::PARAM_STR);
$stmt->bindParam(':order', $layoutWidgetVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $layoutWidgetVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table layout_widget by $layoutWidgetVo object filter use paging
 * 
 * @param object $layoutWidgetVo is layout_widget object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($layoutWidgetVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($layoutWidgetVo)) $layoutWidgetVo = new LayoutWidgetVo();
$sql = "select * from `layout_widget` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($layoutWidgetVo->layoutWidgetId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->layoutWidgetId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_widget_id` $key :layoutWidgetIdKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_widget_id` $key :layoutWidgetIdKey";
}
if($type == 'str') {
    $params[] = array(':layoutWidgetIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutWidgetIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_widget_id` =  :layoutWidgetIdKey';
$isFirst=false;
}else{
$condition.=' and `layout_widget_id` =  :layoutWidgetIdKey';
}
$params[]=array(':layoutWidgetIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutWidgetVo->layoutId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->layoutId;
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

if (!is_null($layoutWidgetVo->layoutRowId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->layoutRowId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_row_id` $key :layoutRowIdKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_row_id` $key :layoutRowIdKey";
}
if($type == 'str') {
    $params[] = array(':layoutRowIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutRowIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_row_id` =  :layoutRowIdKey';
$isFirst=false;
}else{
$condition.=' and `layout_row_id` =  :layoutRowIdKey';
}
$params[]=array(':layoutRowIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutWidgetVo->widgetId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->widgetId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `widget_id` $key :widgetIdKey";
    $isFirst = false;
} else {
    $condition .= " and `widget_id` $key :widgetIdKey";
}
if($type == 'str') {
    $params[] = array(':widgetIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':widgetIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `widget_id` =  :widgetIdKey';
$isFirst=false;
}else{
$condition.=' and `widget_id` =  :widgetIdKey';
}
$params[]=array(':widgetIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutWidgetVo->widgetController)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->widgetController;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `widget_controller` $key :widgetControllerKey";
    $isFirst = false;
} else {
    $condition .= " and `widget_controller` $key :widgetControllerKey";
}
if($type == 'str') {
    $params[] = array(':widgetControllerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':widgetControllerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `widget_controller` =  :widgetControllerKey';
$isFirst=false;
}else{
$condition.=' and `widget_controller` =  :widgetControllerKey';
}
$params[]=array(':widgetControllerKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutWidgetVo->type)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->type;
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

if (!is_null($layoutWidgetVo->setting)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->setting;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting` $key :settingKey";
    $isFirst = false;
} else {
    $condition .= " and `setting` $key :settingKey";
}
if($type == 'str') {
    $params[] = array(':settingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting` =  :settingKey';
$isFirst=false;
}else{
$condition.=' and `setting` =  :settingKey';
}
$params[]=array(':settingKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutWidgetVo->order)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->order;
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

if (!is_null($layoutWidgetVo->status)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->status;
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
return PersistentHelper::mapResult('LayoutWidgetVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($layoutWidgetVo){
try {
if (empty($layoutWidgetVo)) $layoutWidgetVo = new LayoutWidgetVo();
$sql = "select count(*) as total from  layout_widget ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($layoutWidgetVo->layoutWidgetId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->layoutWidgetId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_widget_id` $key :layoutWidgetIdKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_widget_id` $key :layoutWidgetIdKey";
}
if($type == 'str') {
    $params[] = array(':layoutWidgetIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutWidgetIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_widget_id` =  :layoutWidgetIdKey';
$isFirst=false;
}else{
$condition.=' and `layout_widget_id` =  :layoutWidgetIdKey';
}
$params[]=array(':layoutWidgetIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutWidgetVo->layoutId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->layoutId;
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

if (!is_null($layoutWidgetVo->layoutRowId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->layoutRowId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_row_id` $key :layoutRowIdKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_row_id` $key :layoutRowIdKey";
}
if($type == 'str') {
    $params[] = array(':layoutRowIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutRowIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_row_id` =  :layoutRowIdKey';
$isFirst=false;
}else{
$condition.=' and `layout_row_id` =  :layoutRowIdKey';
}
$params[]=array(':layoutRowIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutWidgetVo->widgetId)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->widgetId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `widget_id` $key :widgetIdKey";
    $isFirst = false;
} else {
    $condition .= " and `widget_id` $key :widgetIdKey";
}
if($type == 'str') {
    $params[] = array(':widgetIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':widgetIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `widget_id` =  :widgetIdKey';
$isFirst=false;
}else{
$condition.=' and `widget_id` =  :widgetIdKey';
}
$params[]=array(':widgetIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutWidgetVo->widgetController)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->widgetController;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `widget_controller` $key :widgetControllerKey";
    $isFirst = false;
} else {
    $condition .= " and `widget_controller` $key :widgetControllerKey";
}
if($type == 'str') {
    $params[] = array(':widgetControllerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':widgetControllerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `widget_controller` =  :widgetControllerKey';
$isFirst=false;
}else{
$condition.=' and `widget_controller` =  :widgetControllerKey';
}
$params[]=array(':widgetControllerKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutWidgetVo->type)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->type;
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

if (!is_null($layoutWidgetVo->setting)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->setting;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting` $key :settingKey";
    $isFirst = false;
} else {
    $condition .= " and `setting` $key :settingKey";
}
if($type == 'str') {
    $params[] = array(':settingKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting` =  :settingKey';
$isFirst=false;
}else{
$condition.=' and `setting` =  :settingKey';
}
$params[]=array(':settingKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutWidgetVo->order)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->order;
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

if (!is_null($layoutWidgetVo->status)){ //If isset Vo->element
$fieldValue=$layoutWidgetVo->status;
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


public function updateByPrimaryKey($layoutWidgetVo,$layoutWidgetId){
try {
$sql="UPDATE `layout_widget` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($layoutWidgetVo->layoutWidgetId)){
if ($isFirst){
$updateFields.=' `layout_widget_id`= :layoutWidgetId';
$isFirst=false;}else{
$updateFields.=', `layout_widget_id`= :layoutWidgetId';
}
$params[]=array(':layoutWidgetId', $layoutWidgetVo->layoutWidgetId, PDO::PARAM_INT);
}

if (isset($layoutWidgetVo->layoutId)){
if ($isFirst){
$updateFields.=' `layout_id`= :layoutId';
$isFirst=false;}else{
$updateFields.=', `layout_id`= :layoutId';
}
$params[]=array(':layoutId', $layoutWidgetVo->layoutId, PDO::PARAM_INT);
}

if (isset($layoutWidgetVo->layoutRowId)){
if ($isFirst){
$updateFields.=' `layout_row_id`= :layoutRowId';
$isFirst=false;}else{
$updateFields.=', `layout_row_id`= :layoutRowId';
}
$params[]=array(':layoutRowId', $layoutWidgetVo->layoutRowId, PDO::PARAM_INT);
}

if (isset($layoutWidgetVo->widgetId)){
if ($isFirst){
$updateFields.=' `widget_id`= :widgetId';
$isFirst=false;}else{
$updateFields.=', `widget_id`= :widgetId';
}
$params[]=array(':widgetId', $layoutWidgetVo->widgetId, PDO::PARAM_INT);
}

if (isset($layoutWidgetVo->widgetController)){
if ($isFirst){
$updateFields.=' `widget_controller`= :widgetController';
$isFirst=false;}else{
$updateFields.=', `widget_controller`= :widgetController';
}
$params[]=array(':widgetController', $layoutWidgetVo->widgetController, PDO::PARAM_STR);
}

if (isset($layoutWidgetVo->type)){
if ($isFirst){
$updateFields.=' `type`= :type';
$isFirst=false;}else{
$updateFields.=', `type`= :type';
}
$params[]=array(':type', $layoutWidgetVo->type, PDO::PARAM_STR);
}

if (isset($layoutWidgetVo->setting)){
if ($isFirst){
$updateFields.=' `setting`= :setting';
$isFirst=false;}else{
$updateFields.=', `setting`= :setting';
}
$params[]=array(':setting', $layoutWidgetVo->setting, PDO::PARAM_STR);
}

if (isset($layoutWidgetVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $layoutWidgetVo->order, PDO::PARAM_INT);
}

if (isset($layoutWidgetVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $layoutWidgetVo->status, PDO::PARAM_STR);
}

$conditions.=' where `layout_widget_id`= :layoutWidgetId';
$params[]=array(':layoutWidgetId', $layoutWidgetId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (layoutWidgetId)
	 * Example
	 * getValueByPrimaryKey('layoutWidgetName', 1)
	 * Get value of filed layoutWidgetName in table layoutWidget where layoutWidgetId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$layoutWidgetVo = $this->selectByPrimaryKey($primaryValue);
		if($layoutWidgetVo){
			return $layoutWidgetVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('layoutWidgetName', array('layoutWidgetId' => 1))
	 * Get value of filed layoutWidgetName in table layoutWidget where layoutWidgetId = 1
	 */
	public function getValueByField($fieldName, $where){
		$layoutWidgetVo = new LayoutWidgetVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$layoutWidgetVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$layoutWidgetVos = $this->selectByFilter($layoutWidgetVo);
       
		if($layoutWidgetVos){
			$layoutWidgetVo = $layoutWidgetVos[0];
			return $layoutWidgetVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table layout_widget
	 *
	 * @param int $layout_widget_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($layoutWidgetId){
		try {
		    $sql = "DELETE FROM `layout_widget` where `layout_widget_id` = :layoutWidgetId";
		    $params = array();
		    $params[] = array(':layoutWidgetId', $layoutWidgetId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table layout_widget
	 *
	 * @param object $layoutWidgetVo
	 * @return boolean
	 */
	public function deleteByFilter($layoutWidgetVo){
		try {
			$sql = 'DELETE FROM `layout_widget`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($layoutWidgetVo->layoutWidgetId)){
				$isDel = true;
				$condition[] = '`layout_widget_id` = :layoutWidgetId';
				$params[] = array(':layoutWidgetId', $layoutWidgetVo->layoutWidgetId, PDO::PARAM_INT);
			}
			if (!is_null($layoutWidgetVo->layoutId)){
				$isDel = true;
				$condition[] = '`layout_id` = :layoutId';
				$params[] = array(':layoutId', $layoutWidgetVo->layoutId, PDO::PARAM_INT);
			}
			if (!is_null($layoutWidgetVo->layoutRowId)){
				$isDel = true;
				$condition[] = '`layout_row_id` = :layoutRowId';
				$params[] = array(':layoutRowId', $layoutWidgetVo->layoutRowId, PDO::PARAM_INT);
			}
			if (!is_null($layoutWidgetVo->widgetId)){
				$isDel = true;
				$condition[] = '`widget_id` = :widgetId';
				$params[] = array(':widgetId', $layoutWidgetVo->widgetId, PDO::PARAM_INT);
			}
			if (!is_null($layoutWidgetVo->widgetController)){
				$isDel = true;
				$condition[] = '`widget_controller` = :widgetController';
				$params[] = array(':widgetController', $layoutWidgetVo->widgetController, PDO::PARAM_STR);
			}
			if (!is_null($layoutWidgetVo->type)){
				$isDel = true;
				$condition[] = '`type` = :type';
				$params[] = array(':type', $layoutWidgetVo->type, PDO::PARAM_STR);
			}
			if (!is_null($layoutWidgetVo->setting)){
				$isDel = true;
				$condition[] = '`setting` = :setting';
				$params[] = array(':setting', $layoutWidgetVo->setting, PDO::PARAM_STR);
			}
			if (!is_null($layoutWidgetVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $layoutWidgetVo->order, PDO::PARAM_INT);
			}
			if (!is_null($layoutWidgetVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $layoutWidgetVo->status, PDO::PARAM_STR);
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
