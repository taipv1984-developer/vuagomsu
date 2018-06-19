<?php
class WidgetDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `widget`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('WidgetVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($widgetId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `widget` where `widget_id` = :widgetId");
$stmt->bindParam(':widgetId',$widgetId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('WidgetVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($widgetVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `widget`( `widget_cat_id`, `name`, `controller`, `description`, `icon`, `plugin_code`, `status`)
VALUES( :widgetCatId, :name, :controller, :description, :icon, :pluginCode, :status)");
$stmt->bindParam(':widgetCatId', $widgetVo->widgetCatId, PDO::PARAM_INT);
$stmt->bindParam(':name', $widgetVo->name, PDO::PARAM_STR);
$stmt->bindParam(':controller', $widgetVo->controller, PDO::PARAM_STR);
$stmt->bindParam(':description', $widgetVo->description, PDO::PARAM_STR);
$stmt->bindParam(':icon', $widgetVo->icon, PDO::PARAM_STR);
$stmt->bindParam(':pluginCode', $widgetVo->pluginCode, PDO::PARAM_STR);
$stmt->bindParam(':status', $widgetVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($widgetVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `widget`( `widget_cat_id`, `name`, `controller`, `description`, `icon`, `plugin_code`, `status`)
VALUES( :widgetCatId, :name, :controller, :description, :icon, :pluginCode, :status)");
$stmt->bindParam(':widgetCatId', $widgetVo->widgetCatId, PDO::PARAM_INT);
$stmt->bindParam(':name', $widgetVo->name, PDO::PARAM_STR);
$stmt->bindParam(':controller', $widgetVo->controller, PDO::PARAM_STR);
$stmt->bindParam(':description', $widgetVo->description, PDO::PARAM_STR);
$stmt->bindParam(':icon', $widgetVo->icon, PDO::PARAM_STR);
$stmt->bindParam(':pluginCode', $widgetVo->pluginCode, PDO::PARAM_STR);
$stmt->bindParam(':status', $widgetVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table widget by $widgetVo object filter use paging
 * 
 * @param object $widgetVo is widget object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($widgetVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($widgetVo)) $widgetVo = new WidgetVo();
$sql = "select * from `widget` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($widgetVo->widgetId)){ //If isset Vo->element
$fieldValue=$widgetVo->widgetId;
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

if (!is_null($widgetVo->widgetCatId)){ //If isset Vo->element
$fieldValue=$widgetVo->widgetCatId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `widget_cat_id` $key :widgetCatIdKey";
    $isFirst = false;
} else {
    $condition .= " and `widget_cat_id` $key :widgetCatIdKey";
}
if($type == 'str') {
    $params[] = array(':widgetCatIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':widgetCatIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `widget_cat_id` =  :widgetCatIdKey';
$isFirst=false;
}else{
$condition.=' and `widget_cat_id` =  :widgetCatIdKey';
}
$params[]=array(':widgetCatIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($widgetVo->name)){ //If isset Vo->element
$fieldValue=$widgetVo->name;
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

if (!is_null($widgetVo->controller)){ //If isset Vo->element
$fieldValue=$widgetVo->controller;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `controller` $key :controllerKey";
    $isFirst = false;
} else {
    $condition .= " and `controller` $key :controllerKey";
}
if($type == 'str') {
    $params[] = array(':controllerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':controllerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `controller` =  :controllerKey';
$isFirst=false;
}else{
$condition.=' and `controller` =  :controllerKey';
}
$params[]=array(':controllerKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($widgetVo->description)){ //If isset Vo->element
$fieldValue=$widgetVo->description;
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

if (!is_null($widgetVo->icon)){ //If isset Vo->element
$fieldValue=$widgetVo->icon;
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

if (!is_null($widgetVo->pluginCode)){ //If isset Vo->element
$fieldValue=$widgetVo->pluginCode;
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

if (!is_null($widgetVo->status)){ //If isset Vo->element
$fieldValue=$widgetVo->status;
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
return PersistentHelper::mapResult('WidgetVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($widgetVo){
try {
if (empty($widgetVo)) $widgetVo = new WidgetVo();
$sql = "select count(*) as total from  widget ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($widgetVo->widgetId)){ //If isset Vo->element
$fieldValue=$widgetVo->widgetId;
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

if (!is_null($widgetVo->widgetCatId)){ //If isset Vo->element
$fieldValue=$widgetVo->widgetCatId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `widget_cat_id` $key :widgetCatIdKey";
    $isFirst = false;
} else {
    $condition .= " and `widget_cat_id` $key :widgetCatIdKey";
}
if($type == 'str') {
    $params[] = array(':widgetCatIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':widgetCatIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `widget_cat_id` =  :widgetCatIdKey';
$isFirst=false;
}else{
$condition.=' and `widget_cat_id` =  :widgetCatIdKey';
}
$params[]=array(':widgetCatIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($widgetVo->name)){ //If isset Vo->element
$fieldValue=$widgetVo->name;
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

if (!is_null($widgetVo->controller)){ //If isset Vo->element
$fieldValue=$widgetVo->controller;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `controller` $key :controllerKey";
    $isFirst = false;
} else {
    $condition .= " and `controller` $key :controllerKey";
}
if($type == 'str') {
    $params[] = array(':controllerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':controllerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `controller` =  :controllerKey';
$isFirst=false;
}else{
$condition.=' and `controller` =  :controllerKey';
}
$params[]=array(':controllerKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($widgetVo->description)){ //If isset Vo->element
$fieldValue=$widgetVo->description;
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

if (!is_null($widgetVo->icon)){ //If isset Vo->element
$fieldValue=$widgetVo->icon;
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

if (!is_null($widgetVo->pluginCode)){ //If isset Vo->element
$fieldValue=$widgetVo->pluginCode;
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

if (!is_null($widgetVo->status)){ //If isset Vo->element
$fieldValue=$widgetVo->status;
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


public function updateByPrimaryKey($widgetVo,$widgetId){
try {
$sql="UPDATE `widget` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($widgetVo->widgetId)){
if ($isFirst){
$updateFields.=' `widget_id`= :widgetId';
$isFirst=false;}else{
$updateFields.=', `widget_id`= :widgetId';
}
$params[]=array(':widgetId', $widgetVo->widgetId, PDO::PARAM_INT);
}

if (isset($widgetVo->widgetCatId)){
if ($isFirst){
$updateFields.=' `widget_cat_id`= :widgetCatId';
$isFirst=false;}else{
$updateFields.=', `widget_cat_id`= :widgetCatId';
}
$params[]=array(':widgetCatId', $widgetVo->widgetCatId, PDO::PARAM_INT);
}

if (isset($widgetVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $widgetVo->name, PDO::PARAM_STR);
}

if (isset($widgetVo->controller)){
if ($isFirst){
$updateFields.=' `controller`= :controller';
$isFirst=false;}else{
$updateFields.=', `controller`= :controller';
}
$params[]=array(':controller', $widgetVo->controller, PDO::PARAM_STR);
}

if (isset($widgetVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $widgetVo->description, PDO::PARAM_STR);
}

if (isset($widgetVo->icon)){
if ($isFirst){
$updateFields.=' `icon`= :icon';
$isFirst=false;}else{
$updateFields.=', `icon`= :icon';
}
$params[]=array(':icon', $widgetVo->icon, PDO::PARAM_STR);
}

if (isset($widgetVo->pluginCode)){
if ($isFirst){
$updateFields.=' `plugin_code`= :pluginCode';
$isFirst=false;}else{
$updateFields.=', `plugin_code`= :pluginCode';
}
$params[]=array(':pluginCode', $widgetVo->pluginCode, PDO::PARAM_STR);
}

if (isset($widgetVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $widgetVo->status, PDO::PARAM_STR);
}

$conditions.=' where `widget_id`= :widgetId';
$params[]=array(':widgetId', $widgetId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (widgetId)
	 * Example
	 * getValueByPrimaryKey('widgetName', 1)
	 * Get value of filed widgetName in table widget where widgetId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$widgetVo = $this->selectByPrimaryKey($primaryValue);
		if($widgetVo){
			return $widgetVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('widgetName', array('widgetId' => 1))
	 * Get value of filed widgetName in table widget where widgetId = 1
	 */
	public function getValueByField($fieldName, $where){
		$widgetVo = new WidgetVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$widgetVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$widgetVos = $this->selectByFilter($widgetVo);
       
		if($widgetVos){
			$widgetVo = $widgetVos[0];
			return $widgetVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table widget
	 *
	 * @param int $widget_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($widgetId){
		try {
		    $sql = "DELETE FROM `widget` where `widget_id` = :widgetId";
		    $params = array();
		    $params[] = array(':widgetId', $widgetId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table widget
	 *
	 * @param object $widgetVo
	 * @return boolean
	 */
	public function deleteByFilter($widgetVo){
		try {
			$sql = 'DELETE FROM `widget`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($widgetVo->widgetId)){
				$isDel = true;
				$condition[] = '`widget_id` = :widgetId';
				$params[] = array(':widgetId', $widgetVo->widgetId, PDO::PARAM_INT);
			}
			if (!is_null($widgetVo->widgetCatId)){
				$isDel = true;
				$condition[] = '`widget_cat_id` = :widgetCatId';
				$params[] = array(':widgetCatId', $widgetVo->widgetCatId, PDO::PARAM_INT);
			}
			if (!is_null($widgetVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $widgetVo->name, PDO::PARAM_STR);
			}
			if (!is_null($widgetVo->controller)){
				$isDel = true;
				$condition[] = '`controller` = :controller';
				$params[] = array(':controller', $widgetVo->controller, PDO::PARAM_STR);
			}
			if (!is_null($widgetVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $widgetVo->description, PDO::PARAM_STR);
			}
			if (!is_null($widgetVo->icon)){
				$isDel = true;
				$condition[] = '`icon` = :icon';
				$params[] = array(':icon', $widgetVo->icon, PDO::PARAM_STR);
			}
			if (!is_null($widgetVo->pluginCode)){
				$isDel = true;
				$condition[] = '`plugin_code` = :pluginCode';
				$params[] = array(':pluginCode', $widgetVo->pluginCode, PDO::PARAM_STR);
			}
			if (!is_null($widgetVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $widgetVo->status, PDO::PARAM_STR);
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
