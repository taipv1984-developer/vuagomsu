<?php
class SettingDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `setting`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('SettingVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($settingName){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `setting` where `setting_name` = :settingName");
$stmt->bindParam(':settingName', $settingName, PDO::PARAM_STR);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('SettingVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($settingVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `setting`( `setting_name`, `setting_value`, `setting_type`, `order`, `setting_group_id`, `value_type`, `function`, `status`, `required`)
VALUES( :settingName, :settingValue, :settingType, :order, :settingGroupId, :valueType, :function, :status, :required)");
$stmt->bindParam(':settingName', $settingVo->settingName, PDO::PARAM_STR);
$stmt->bindParam(':settingValue', $settingVo->settingValue, PDO::PARAM_STR);
$stmt->bindParam(':settingType', $settingVo->settingType, PDO::PARAM_STR);
$stmt->bindParam(':order', $settingVo->order, PDO::PARAM_INT);
$stmt->bindParam(':settingGroupId', $settingVo->settingGroupId, PDO::PARAM_INT);
$stmt->bindParam(':valueType', $settingVo->valueType, PDO::PARAM_STR);
$stmt->bindParam(':function', $settingVo->function, PDO::PARAM_STR);
$stmt->bindParam(':status', $settingVo->status, PDO::PARAM_STR);
$stmt->bindParam(':required', $settingVo->required, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($settingVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `setting`( `setting_name`, `setting_value`, `setting_type`, `order`, `setting_group_id`, `value_type`, `function`, `status`, `required`)
VALUES( :settingName, :settingValue, :settingType, :order, :settingGroupId, :valueType, :function, :status, :required)");
$stmt->bindParam(':settingName', $settingVo->settingName, PDO::PARAM_STR);
$stmt->bindParam(':settingValue', $settingVo->settingValue, PDO::PARAM_STR);
$stmt->bindParam(':settingType', $settingVo->settingType, PDO::PARAM_STR);
$stmt->bindParam(':order', $settingVo->order, PDO::PARAM_INT);
$stmt->bindParam(':settingGroupId', $settingVo->settingGroupId, PDO::PARAM_INT);
$stmt->bindParam(':valueType', $settingVo->valueType, PDO::PARAM_STR);
$stmt->bindParam(':function', $settingVo->function, PDO::PARAM_STR);
$stmt->bindParam(':status', $settingVo->status, PDO::PARAM_STR);
$stmt->bindParam(':required', $settingVo->required, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table setting by $settingVo object filter use paging
 * 
 * @param object $settingVo is setting object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($settingVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($settingVo)) $settingVo = new SettingVo();
$sql = "select * from `setting` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($settingVo->settingName)){ //If isset Vo->element
$fieldValue=$settingVo->settingName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_name` $key :settingNameKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_name` $key :settingNameKey";
}
if($type == 'str') {
    $params[] = array(':settingNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_name` =  :settingNameKey';
$isFirst=false;
}else{
$condition.=' and `setting_name` =  :settingNameKey';
}
$params[]=array(':settingNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->settingValue)){ //If isset Vo->element
$fieldValue=$settingVo->settingValue;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_value` $key :settingValueKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_value` $key :settingValueKey";
}
if($type == 'str') {
    $params[] = array(':settingValueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingValueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_value` =  :settingValueKey';
$isFirst=false;
}else{
$condition.=' and `setting_value` =  :settingValueKey';
}
$params[]=array(':settingValueKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->settingType)){ //If isset Vo->element
$fieldValue=$settingVo->settingType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_type` $key :settingTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_type` $key :settingTypeKey";
}
if($type == 'str') {
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_type` =  :settingTypeKey';
$isFirst=false;
}else{
$condition.=' and `setting_type` =  :settingTypeKey';
}
$params[]=array(':settingTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->order)){ //If isset Vo->element
$fieldValue=$settingVo->order;
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

if (!is_null($settingVo->settingGroupId)){ //If isset Vo->element
$fieldValue=$settingVo->settingGroupId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_group_id` $key :settingGroupIdKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_group_id` $key :settingGroupIdKey";
}
if($type == 'str') {
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_group_id` =  :settingGroupIdKey';
$isFirst=false;
}else{
$condition.=' and `setting_group_id` =  :settingGroupIdKey';
}
$params[]=array(':settingGroupIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($settingVo->valueType)){ //If isset Vo->element
$fieldValue=$settingVo->valueType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `value_type` $key :valueTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `value_type` $key :valueTypeKey";
}
if($type == 'str') {
    $params[] = array(':valueTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':valueTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `value_type` =  :valueTypeKey';
$isFirst=false;
}else{
$condition.=' and `value_type` =  :valueTypeKey';
}
$params[]=array(':valueTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->function)){ //If isset Vo->element
$fieldValue=$settingVo->function;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `function` $key :functionKey";
    $isFirst = false;
} else {
    $condition .= " and `function` $key :functionKey";
}
if($type == 'str') {
    $params[] = array(':functionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':functionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `function` =  :functionKey';
$isFirst=false;
}else{
$condition.=' and `function` =  :functionKey';
}
$params[]=array(':functionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->status)){ //If isset Vo->element
$fieldValue=$settingVo->status;
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

if (!is_null($settingVo->required)){ //If isset Vo->element
$fieldValue=$settingVo->required;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `required` $key :requiredKey";
    $isFirst = false;
} else {
    $condition .= " and `required` $key :requiredKey";
}
if($type == 'str') {
    $params[] = array(':requiredKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':requiredKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `required` =  :requiredKey';
$isFirst=false;
}else{
$condition.=' and `required` =  :requiredKey';
}
$params[]=array(':requiredKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('SettingVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($settingVo){
try {
if (empty($settingVo)) $settingVo = new SettingVo();
$sql = "select count(*) as total from  setting ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($settingVo->settingName)){ //If isset Vo->element
$fieldValue=$settingVo->settingName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_name` $key :settingNameKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_name` $key :settingNameKey";
}
if($type == 'str') {
    $params[] = array(':settingNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_name` =  :settingNameKey';
$isFirst=false;
}else{
$condition.=' and `setting_name` =  :settingNameKey';
}
$params[]=array(':settingNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->settingValue)){ //If isset Vo->element
$fieldValue=$settingVo->settingValue;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_value` $key :settingValueKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_value` $key :settingValueKey";
}
if($type == 'str') {
    $params[] = array(':settingValueKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingValueKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_value` =  :settingValueKey';
$isFirst=false;
}else{
$condition.=' and `setting_value` =  :settingValueKey';
}
$params[]=array(':settingValueKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->settingType)){ //If isset Vo->element
$fieldValue=$settingVo->settingType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_type` $key :settingTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_type` $key :settingTypeKey";
}
if($type == 'str') {
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_type` =  :settingTypeKey';
$isFirst=false;
}else{
$condition.=' and `setting_type` =  :settingTypeKey';
}
$params[]=array(':settingTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->order)){ //If isset Vo->element
$fieldValue=$settingVo->order;
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

if (!is_null($settingVo->settingGroupId)){ //If isset Vo->element
$fieldValue=$settingVo->settingGroupId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `setting_group_id` $key :settingGroupIdKey";
    $isFirst = false;
} else {
    $condition .= " and `setting_group_id` $key :settingGroupIdKey";
}
if($type == 'str') {
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':settingGroupIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `setting_group_id` =  :settingGroupIdKey';
$isFirst=false;
}else{
$condition.=' and `setting_group_id` =  :settingGroupIdKey';
}
$params[]=array(':settingGroupIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($settingVo->valueType)){ //If isset Vo->element
$fieldValue=$settingVo->valueType;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `value_type` $key :valueTypeKey";
    $isFirst = false;
} else {
    $condition .= " and `value_type` $key :valueTypeKey";
}
if($type == 'str') {
    $params[] = array(':valueTypeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':valueTypeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `value_type` =  :valueTypeKey';
$isFirst=false;
}else{
$condition.=' and `value_type` =  :valueTypeKey';
}
$params[]=array(':valueTypeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->function)){ //If isset Vo->element
$fieldValue=$settingVo->function;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `function` $key :functionKey";
    $isFirst = false;
} else {
    $condition .= " and `function` $key :functionKey";
}
if($type == 'str') {
    $params[] = array(':functionKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':functionKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `function` =  :functionKey';
$isFirst=false;
}else{
$condition.=' and `function` =  :functionKey';
}
$params[]=array(':functionKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($settingVo->status)){ //If isset Vo->element
$fieldValue=$settingVo->status;
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

if (!is_null($settingVo->required)){ //If isset Vo->element
$fieldValue=$settingVo->required;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `required` $key :requiredKey";
    $isFirst = false;
} else {
    $condition .= " and `required` $key :requiredKey";
}
if($type == 'str') {
    $params[] = array(':requiredKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':requiredKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `required` =  :requiredKey';
$isFirst=false;
}else{
$condition.=' and `required` =  :requiredKey';
}
$params[]=array(':requiredKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($settingVo,$settingName){
try {
$sql="UPDATE `setting` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($settingVo->settingName)){
if ($isFirst){
$updateFields.=' `setting_name`= :settingName';
$isFirst=false;}else{
$updateFields.=', `setting_name`= :settingName';
}
$params[]=array(':settingName', $settingVo->settingName, PDO::PARAM_STR);
}

if (isset($settingVo->settingValue)){
if ($isFirst){
$updateFields.=' `setting_value`= :settingValue';
$isFirst=false;}else{
$updateFields.=', `setting_value`= :settingValue';
}
$params[]=array(':settingValue', $settingVo->settingValue, PDO::PARAM_STR);
}

if (isset($settingVo->settingType)){
if ($isFirst){
$updateFields.=' `setting_type`= :settingType';
$isFirst=false;}else{
$updateFields.=', `setting_type`= :settingType';
}
$params[]=array(':settingType', $settingVo->settingType, PDO::PARAM_STR);
}

if (isset($settingVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $settingVo->order, PDO::PARAM_INT);
}

if (isset($settingVo->settingGroupId)){
if ($isFirst){
$updateFields.=' `setting_group_id`= :settingGroupId';
$isFirst=false;}else{
$updateFields.=', `setting_group_id`= :settingGroupId';
}
$params[]=array(':settingGroupId', $settingVo->settingGroupId, PDO::PARAM_INT);
}

if (isset($settingVo->valueType)){
if ($isFirst){
$updateFields.=' `value_type`= :valueType';
$isFirst=false;}else{
$updateFields.=', `value_type`= :valueType';
}
$params[]=array(':valueType', $settingVo->valueType, PDO::PARAM_STR);
}

if (isset($settingVo->function)){
if ($isFirst){
$updateFields.=' `function`= :function';
$isFirst=false;}else{
$updateFields.=', `function`= :function';
}
$params[]=array(':function', $settingVo->function, PDO::PARAM_STR);
}

if (isset($settingVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $settingVo->status, PDO::PARAM_STR);
}

if (isset($settingVo->required)){
if ($isFirst){
$updateFields.=' `required`= :required';
$isFirst=false;}else{
$updateFields.=', `required`= :required';
}
$params[]=array(':required', $settingVo->required, PDO::PARAM_INT);
}

$conditions.=' where `setting_name`= :settingName';
$params[]=array(':settingName', $settingName, PDO::PARAM_STR);
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
	 * Get value a field by PrimaryKey (settingId)
	 * Example
	 * getValueByPrimaryKey('settingName', 1)
	 * Get value of filed settingName in table setting where settingId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$settingVo = $this->selectByPrimaryKey($primaryValue);
		if($settingVo){
			return $settingVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('settingName', array('settingId' => 1))
	 * Get value of filed settingName in table setting where settingId = 1
	 */
	public function getValueByField($fieldName, $where){
		$settingVo = new SettingVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$settingVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$settingVos = $this->selectByFilter($settingVo);
       
		if($settingVos){
			$settingVo = $settingVos[0];
			return $settingVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table setting
	 *
	 * @param int $setting_name
	 * @return boolean
	 */
	public function deleteByPrimaryKey($settingName){
		try {
		    $sql = "DELETE FROM `setting` where `setting_name` = :settingName";
		    $params = array();
		    $params[] = array(':settingName', $settingName, PDO::PARAM_STR);
		    
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
	 * deleteByFilter from table setting
	 *
	 * @param object $settingVo
	 * @return boolean
	 */
	public function deleteByFilter($settingVo){
		try {
			$sql = 'DELETE FROM `setting`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($settingVo->settingName)){
				$isDel = true;
				$condition[] = '`setting_name` = :settingName';
				$params[] = array(':settingName', $settingVo->settingName, PDO::PARAM_STR);
			}
			if (!is_null($settingVo->settingValue)){
				$isDel = true;
				$condition[] = '`setting_value` = :settingValue';
				$params[] = array(':settingValue', $settingVo->settingValue, PDO::PARAM_STR);
			}
			if (!is_null($settingVo->settingType)){
				$isDel = true;
				$condition[] = '`setting_type` = :settingType';
				$params[] = array(':settingType', $settingVo->settingType, PDO::PARAM_STR);
			}
			if (!is_null($settingVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $settingVo->order, PDO::PARAM_INT);
			}
			if (!is_null($settingVo->settingGroupId)){
				$isDel = true;
				$condition[] = '`setting_group_id` = :settingGroupId';
				$params[] = array(':settingGroupId', $settingVo->settingGroupId, PDO::PARAM_INT);
			}
			if (!is_null($settingVo->valueType)){
				$isDel = true;
				$condition[] = '`value_type` = :valueType';
				$params[] = array(':valueType', $settingVo->valueType, PDO::PARAM_STR);
			}
			if (!is_null($settingVo->function)){
				$isDel = true;
				$condition[] = '`function` = :function';
				$params[] = array(':function', $settingVo->function, PDO::PARAM_STR);
			}
			if (!is_null($settingVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $settingVo->status, PDO::PARAM_STR);
			}
			if (!is_null($settingVo->required)){
				$isDel = true;
				$condition[] = '`required` = :required';
				$params[] = array(':required', $settingVo->required, PDO::PARAM_INT);
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
