<?php
class LayoutDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `layout`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('LayoutVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($layoutId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `layout` where `layout_id` = :layoutId");
$stmt->bindParam(':layoutId',$layoutId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('LayoutVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($layoutVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `layout`( `name`, `dispatch`, `system_header`, `system_footer`, `layout_style`, `layout_script`, `plugin_code`, `order`, `status`)
VALUES( :name, :dispatch, :systemHeader, :systemFooter, :layoutStyle, :layoutScript, :pluginCode, :order, :status)");
$stmt->bindParam(':name', $layoutVo->name, PDO::PARAM_STR);
$stmt->bindParam(':dispatch', $layoutVo->dispatch, PDO::PARAM_STR);
$stmt->bindParam(':systemHeader', $layoutVo->systemHeader, PDO::PARAM_INT);
$stmt->bindParam(':systemFooter', $layoutVo->systemFooter, PDO::PARAM_INT);
$stmt->bindParam(':layoutStyle', $layoutVo->layoutStyle, PDO::PARAM_STR);
$stmt->bindParam(':layoutScript', $layoutVo->layoutScript, PDO::PARAM_STR);
$stmt->bindParam(':pluginCode', $layoutVo->pluginCode, PDO::PARAM_STR);
$stmt->bindParam(':order', $layoutVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $layoutVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($layoutVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `layout`( `name`, `dispatch`, `system_header`, `system_footer`, `layout_style`, `layout_script`, `plugin_code`, `order`, `status`)
VALUES( :name, :dispatch, :systemHeader, :systemFooter, :layoutStyle, :layoutScript, :pluginCode, :order, :status)");
$stmt->bindParam(':name', $layoutVo->name, PDO::PARAM_STR);
$stmt->bindParam(':dispatch', $layoutVo->dispatch, PDO::PARAM_STR);
$stmt->bindParam(':systemHeader', $layoutVo->systemHeader, PDO::PARAM_INT);
$stmt->bindParam(':systemFooter', $layoutVo->systemFooter, PDO::PARAM_INT);
$stmt->bindParam(':layoutStyle', $layoutVo->layoutStyle, PDO::PARAM_STR);
$stmt->bindParam(':layoutScript', $layoutVo->layoutScript, PDO::PARAM_STR);
$stmt->bindParam(':pluginCode', $layoutVo->pluginCode, PDO::PARAM_STR);
$stmt->bindParam(':order', $layoutVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $layoutVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table layout by $layoutVo object filter use paging
 * 
 * @param object $layoutVo is layout object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($layoutVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($layoutVo)) $layoutVo = new LayoutVo();
$sql = "select * from `layout` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($layoutVo->layoutId)){ //If isset Vo->element
$fieldValue=$layoutVo->layoutId;
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

if (!is_null($layoutVo->name)){ //If isset Vo->element
$fieldValue=$layoutVo->name;
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

if (!is_null($layoutVo->dispatch)){ //If isset Vo->element
$fieldValue=$layoutVo->dispatch;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `dispatch` $key :dispatchKey";
    $isFirst = false;
} else {
    $condition .= " and `dispatch` $key :dispatchKey";
}
if($type == 'str') {
    $params[] = array(':dispatchKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dispatchKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `dispatch` =  :dispatchKey';
$isFirst=false;
}else{
$condition.=' and `dispatch` =  :dispatchKey';
}
$params[]=array(':dispatchKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->systemHeader)){ //If isset Vo->element
$fieldValue=$layoutVo->systemHeader;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `system_header` $key :systemHeaderKey";
    $isFirst = false;
} else {
    $condition .= " and `system_header` $key :systemHeaderKey";
}
if($type == 'str') {
    $params[] = array(':systemHeaderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':systemHeaderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `system_header` =  :systemHeaderKey';
$isFirst=false;
}else{
$condition.=' and `system_header` =  :systemHeaderKey';
}
$params[]=array(':systemHeaderKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutVo->systemFooter)){ //If isset Vo->element
$fieldValue=$layoutVo->systemFooter;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `system_footer` $key :systemFooterKey";
    $isFirst = false;
} else {
    $condition .= " and `system_footer` $key :systemFooterKey";
}
if($type == 'str') {
    $params[] = array(':systemFooterKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':systemFooterKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `system_footer` =  :systemFooterKey';
$isFirst=false;
}else{
$condition.=' and `system_footer` =  :systemFooterKey';
}
$params[]=array(':systemFooterKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutVo->layoutStyle)){ //If isset Vo->element
$fieldValue=$layoutVo->layoutStyle;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_style` $key :layoutStyleKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_style` $key :layoutStyleKey";
}
if($type == 'str') {
    $params[] = array(':layoutStyleKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutStyleKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_style` =  :layoutStyleKey';
$isFirst=false;
}else{
$condition.=' and `layout_style` =  :layoutStyleKey';
}
$params[]=array(':layoutStyleKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->layoutScript)){ //If isset Vo->element
$fieldValue=$layoutVo->layoutScript;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_script` $key :layoutScriptKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_script` $key :layoutScriptKey";
}
if($type == 'str') {
    $params[] = array(':layoutScriptKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutScriptKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_script` =  :layoutScriptKey';
$isFirst=false;
}else{
$condition.=' and `layout_script` =  :layoutScriptKey';
}
$params[]=array(':layoutScriptKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->pluginCode)){ //If isset Vo->element
$fieldValue=$layoutVo->pluginCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_code` $key :pluginCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_code` $key :pluginCodeKey";
}
if($type == 'str') {
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_code` =  :pluginCodeKey';
$isFirst=false;
}else{
$condition.=' and `plugin_code` =  :pluginCodeKey';
}
$params[]=array(':pluginCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->order)){ //If isset Vo->element
$fieldValue=$layoutVo->order;
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

if (!is_null($layoutVo->status)){ //If isset Vo->element
$fieldValue=$layoutVo->status;
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
return PersistentHelper::mapResult('LayoutVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($layoutVo){
try {
if (empty($layoutVo)) $layoutVo = new LayoutVo();
$sql = "select count(*) as total from  layout ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($layoutVo->layoutId)){ //If isset Vo->element
$fieldValue=$layoutVo->layoutId;
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

if (!is_null($layoutVo->name)){ //If isset Vo->element
$fieldValue=$layoutVo->name;
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

if (!is_null($layoutVo->dispatch)){ //If isset Vo->element
$fieldValue=$layoutVo->dispatch;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `dispatch` $key :dispatchKey";
    $isFirst = false;
} else {
    $condition .= " and `dispatch` $key :dispatchKey";
}
if($type == 'str') {
    $params[] = array(':dispatchKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':dispatchKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `dispatch` =  :dispatchKey';
$isFirst=false;
}else{
$condition.=' and `dispatch` =  :dispatchKey';
}
$params[]=array(':dispatchKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->systemHeader)){ //If isset Vo->element
$fieldValue=$layoutVo->systemHeader;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `system_header` $key :systemHeaderKey";
    $isFirst = false;
} else {
    $condition .= " and `system_header` $key :systemHeaderKey";
}
if($type == 'str') {
    $params[] = array(':systemHeaderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':systemHeaderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `system_header` =  :systemHeaderKey';
$isFirst=false;
}else{
$condition.=' and `system_header` =  :systemHeaderKey';
}
$params[]=array(':systemHeaderKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutVo->systemFooter)){ //If isset Vo->element
$fieldValue=$layoutVo->systemFooter;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `system_footer` $key :systemFooterKey";
    $isFirst = false;
} else {
    $condition .= " and `system_footer` $key :systemFooterKey";
}
if($type == 'str') {
    $params[] = array(':systemFooterKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':systemFooterKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `system_footer` =  :systemFooterKey';
$isFirst=false;
}else{
$condition.=' and `system_footer` =  :systemFooterKey';
}
$params[]=array(':systemFooterKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutVo->layoutStyle)){ //If isset Vo->element
$fieldValue=$layoutVo->layoutStyle;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_style` $key :layoutStyleKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_style` $key :layoutStyleKey";
}
if($type == 'str') {
    $params[] = array(':layoutStyleKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutStyleKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_style` =  :layoutStyleKey';
$isFirst=false;
}else{
$condition.=' and `layout_style` =  :layoutStyleKey';
}
$params[]=array(':layoutStyleKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->layoutScript)){ //If isset Vo->element
$fieldValue=$layoutVo->layoutScript;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_script` $key :layoutScriptKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_script` $key :layoutScriptKey";
}
if($type == 'str') {
    $params[] = array(':layoutScriptKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutScriptKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_script` =  :layoutScriptKey';
$isFirst=false;
}else{
$condition.=' and `layout_script` =  :layoutScriptKey';
}
$params[]=array(':layoutScriptKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->pluginCode)){ //If isset Vo->element
$fieldValue=$layoutVo->pluginCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_code` $key :pluginCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_code` $key :pluginCodeKey";
}
if($type == 'str') {
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_code` =  :pluginCodeKey';
$isFirst=false;
}else{
$condition.=' and `plugin_code` =  :pluginCodeKey';
}
$params[]=array(':pluginCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutVo->order)){ //If isset Vo->element
$fieldValue=$layoutVo->order;
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

if (!is_null($layoutVo->status)){ //If isset Vo->element
$fieldValue=$layoutVo->status;
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


public function updateByPrimaryKey($layoutVo,$layoutId){
try {
$sql="UPDATE `layout` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($layoutVo->layoutId)){
if ($isFirst){
$updateFields.=' `layout_id`= :layoutId';
$isFirst=false;}else{
$updateFields.=', `layout_id`= :layoutId';
}
$params[]=array(':layoutId', $layoutVo->layoutId, PDO::PARAM_INT);
}

if (isset($layoutVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $layoutVo->name, PDO::PARAM_STR);
}

if (isset($layoutVo->dispatch)){
if ($isFirst){
$updateFields.=' `dispatch`= :dispatch';
$isFirst=false;}else{
$updateFields.=', `dispatch`= :dispatch';
}
$params[]=array(':dispatch', $layoutVo->dispatch, PDO::PARAM_STR);
}

if (isset($layoutVo->systemHeader)){
if ($isFirst){
$updateFields.=' `system_header`= :systemHeader';
$isFirst=false;}else{
$updateFields.=', `system_header`= :systemHeader';
}
$params[]=array(':systemHeader', $layoutVo->systemHeader, PDO::PARAM_INT);
}

if (isset($layoutVo->systemFooter)){
if ($isFirst){
$updateFields.=' `system_footer`= :systemFooter';
$isFirst=false;}else{
$updateFields.=', `system_footer`= :systemFooter';
}
$params[]=array(':systemFooter', $layoutVo->systemFooter, PDO::PARAM_INT);
}

if (isset($layoutVo->layoutStyle)){
if ($isFirst){
$updateFields.=' `layout_style`= :layoutStyle';
$isFirst=false;}else{
$updateFields.=', `layout_style`= :layoutStyle';
}
$params[]=array(':layoutStyle', $layoutVo->layoutStyle, PDO::PARAM_STR);
}

if (isset($layoutVo->layoutScript)){
if ($isFirst){
$updateFields.=' `layout_script`= :layoutScript';
$isFirst=false;}else{
$updateFields.=', `layout_script`= :layoutScript';
}
$params[]=array(':layoutScript', $layoutVo->layoutScript, PDO::PARAM_STR);
}

if (isset($layoutVo->pluginCode)){
if ($isFirst){
$updateFields.=' `plugin_code`= :pluginCode';
$isFirst=false;}else{
$updateFields.=', `plugin_code`= :pluginCode';
}
$params[]=array(':pluginCode', $layoutVo->pluginCode, PDO::PARAM_STR);
}

if (isset($layoutVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $layoutVo->order, PDO::PARAM_INT);
}

if (isset($layoutVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $layoutVo->status, PDO::PARAM_STR);
}

$conditions.=' where `layout_id`= :layoutId';
$params[]=array(':layoutId', $layoutId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (layoutId)
	 * Example
	 * getValueByPrimaryKey('layoutName', 1)
	 * Get value of filed layoutName in table layout where layoutId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$layoutVo = $this->selectByPrimaryKey($primaryValue);
		if($layoutVo){
			return $layoutVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('layoutName', array('layoutId' => 1))
	 * Get value of filed layoutName in table layout where layoutId = 1
	 */
	public function getValueByField($fieldName, $where){
		$layoutVo = new LayoutVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$layoutVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$layoutVos = $this->selectByFilter($layoutVo);
       
		if($layoutVos){
			$layoutVo = $layoutVos[0];
			return $layoutVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table layout
	 *
	 * @param int $layout_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($layoutId){
		try {
		    $sql = "DELETE FROM `layout` where `layout_id` = :layoutId";
		    $params = array();
		    $params[] = array(':layoutId', $layoutId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table layout
	 *
	 * @param object $layoutVo
	 * @return boolean
	 */
	public function deleteByFilter($layoutVo){
		try {
			$sql = 'DELETE FROM `layout`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($layoutVo->layoutId)){
				$isDel = true;
				$condition[] = '`layout_id` = :layoutId';
				$params[] = array(':layoutId', $layoutVo->layoutId, PDO::PARAM_INT);
			}
			if (!is_null($layoutVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $layoutVo->name, PDO::PARAM_STR);
			}
			if (!is_null($layoutVo->dispatch)){
				$isDel = true;
				$condition[] = '`dispatch` = :dispatch';
				$params[] = array(':dispatch', $layoutVo->dispatch, PDO::PARAM_STR);
			}
			if (!is_null($layoutVo->systemHeader)){
				$isDel = true;
				$condition[] = '`system_header` = :systemHeader';
				$params[] = array(':systemHeader', $layoutVo->systemHeader, PDO::PARAM_INT);
			}
			if (!is_null($layoutVo->systemFooter)){
				$isDel = true;
				$condition[] = '`system_footer` = :systemFooter';
				$params[] = array(':systemFooter', $layoutVo->systemFooter, PDO::PARAM_INT);
			}
			if (!is_null($layoutVo->layoutStyle)){
				$isDel = true;
				$condition[] = '`layout_style` = :layoutStyle';
				$params[] = array(':layoutStyle', $layoutVo->layoutStyle, PDO::PARAM_STR);
			}
			if (!is_null($layoutVo->layoutScript)){
				$isDel = true;
				$condition[] = '`layout_script` = :layoutScript';
				$params[] = array(':layoutScript', $layoutVo->layoutScript, PDO::PARAM_STR);
			}
			if (!is_null($layoutVo->pluginCode)){
				$isDel = true;
				$condition[] = '`plugin_code` = :pluginCode';
				$params[] = array(':pluginCode', $layoutVo->pluginCode, PDO::PARAM_STR);
			}
			if (!is_null($layoutVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $layoutVo->order, PDO::PARAM_INT);
			}
			if (!is_null($layoutVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $layoutVo->status, PDO::PARAM_STR);
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
