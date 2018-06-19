<?php
class LayoutRowDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `layout_row`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('LayoutRowVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($layoutRowId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `layout_row` where `layout_row_id` = :layoutRowId");
$stmt->bindParam(':layoutRowId',$layoutRowId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('LayoutRowVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($layoutRowVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `layout_row`( `layout_id`, `group`, `cols`, `order`, `layout_widget_list`, `setting`, `status`)
VALUES( :layoutId, :group, :cols, :order, :layoutWidgetList, :setting, :status)");
$stmt->bindParam(':layoutId', $layoutRowVo->layoutId, PDO::PARAM_INT);
$stmt->bindParam(':group', $layoutRowVo->group, PDO::PARAM_STR);
$stmt->bindParam(':cols', $layoutRowVo->cols, PDO::PARAM_INT);
$stmt->bindParam(':order', $layoutRowVo->order, PDO::PARAM_INT);
$stmt->bindParam(':layoutWidgetList', $layoutRowVo->layoutWidgetList, PDO::PARAM_STR);
$stmt->bindParam(':setting', $layoutRowVo->setting, PDO::PARAM_STR);
$stmt->bindParam(':status', $layoutRowVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($layoutRowVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `layout_row`( `layout_id`, `group`, `cols`, `order`, `layout_widget_list`, `setting`, `status`)
VALUES( :layoutId, :group, :cols, :order, :layoutWidgetList, :setting, :status)");
$stmt->bindParam(':layoutId', $layoutRowVo->layoutId, PDO::PARAM_INT);
$stmt->bindParam(':group', $layoutRowVo->group, PDO::PARAM_STR);
$stmt->bindParam(':cols', $layoutRowVo->cols, PDO::PARAM_INT);
$stmt->bindParam(':order', $layoutRowVo->order, PDO::PARAM_INT);
$stmt->bindParam(':layoutWidgetList', $layoutRowVo->layoutWidgetList, PDO::PARAM_STR);
$stmt->bindParam(':setting', $layoutRowVo->setting, PDO::PARAM_STR);
$stmt->bindParam(':status', $layoutRowVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table layout_row by $layoutRowVo object filter use paging
 * 
 * @param object $layoutRowVo is layout_row object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($layoutRowVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($layoutRowVo)) $layoutRowVo = new LayoutRowVo();
$sql = "select * from `layout_row` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($layoutRowVo->layoutRowId)){ //If isset Vo->element
$fieldValue=$layoutRowVo->layoutRowId;
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

if (!is_null($layoutRowVo->layoutId)){ //If isset Vo->element
$fieldValue=$layoutRowVo->layoutId;
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

if (!is_null($layoutRowVo->group)){ //If isset Vo->element
$fieldValue=$layoutRowVo->group;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `group` $key :groupKey";
    $isFirst = false;
} else {
    $condition .= " and `group` $key :groupKey";
}
if($type == 'str') {
    $params[] = array(':groupKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':groupKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `group` =  :groupKey';
$isFirst=false;
}else{
$condition.=' and `group` =  :groupKey';
}
$params[]=array(':groupKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutRowVo->cols)){ //If isset Vo->element
$fieldValue=$layoutRowVo->cols;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `cols` $key :colsKey";
    $isFirst = false;
} else {
    $condition .= " and `cols` $key :colsKey";
}
if($type == 'str') {
    $params[] = array(':colsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':colsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `cols` =  :colsKey';
$isFirst=false;
}else{
$condition.=' and `cols` =  :colsKey';
}
$params[]=array(':colsKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutRowVo->order)){ //If isset Vo->element
$fieldValue=$layoutRowVo->order;
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

if (!is_null($layoutRowVo->layoutWidgetList)){ //If isset Vo->element
$fieldValue=$layoutRowVo->layoutWidgetList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_widget_list` $key :layoutWidgetListKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_widget_list` $key :layoutWidgetListKey";
}
if($type == 'str') {
    $params[] = array(':layoutWidgetListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutWidgetListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_widget_list` =  :layoutWidgetListKey';
$isFirst=false;
}else{
$condition.=' and `layout_widget_list` =  :layoutWidgetListKey';
}
$params[]=array(':layoutWidgetListKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutRowVo->setting)){ //If isset Vo->element
$fieldValue=$layoutRowVo->setting;
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

if (!is_null($layoutRowVo->status)){ //If isset Vo->element
$fieldValue=$layoutRowVo->status;
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
return PersistentHelper::mapResult('LayoutRowVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($layoutRowVo){
try {
if (empty($layoutRowVo)) $layoutRowVo = new LayoutRowVo();
$sql = "select count(*) as total from  layout_row ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($layoutRowVo->layoutRowId)){ //If isset Vo->element
$fieldValue=$layoutRowVo->layoutRowId;
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

if (!is_null($layoutRowVo->layoutId)){ //If isset Vo->element
$fieldValue=$layoutRowVo->layoutId;
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

if (!is_null($layoutRowVo->group)){ //If isset Vo->element
$fieldValue=$layoutRowVo->group;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `group` $key :groupKey";
    $isFirst = false;
} else {
    $condition .= " and `group` $key :groupKey";
}
if($type == 'str') {
    $params[] = array(':groupKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':groupKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `group` =  :groupKey';
$isFirst=false;
}else{
$condition.=' and `group` =  :groupKey';
}
$params[]=array(':groupKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutRowVo->cols)){ //If isset Vo->element
$fieldValue=$layoutRowVo->cols;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `cols` $key :colsKey";
    $isFirst = false;
} else {
    $condition .= " and `cols` $key :colsKey";
}
if($type == 'str') {
    $params[] = array(':colsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':colsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `cols` =  :colsKey';
$isFirst=false;
}else{
$condition.=' and `cols` =  :colsKey';
}
$params[]=array(':colsKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($layoutRowVo->order)){ //If isset Vo->element
$fieldValue=$layoutRowVo->order;
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

if (!is_null($layoutRowVo->layoutWidgetList)){ //If isset Vo->element
$fieldValue=$layoutRowVo->layoutWidgetList;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `layout_widget_list` $key :layoutWidgetListKey";
    $isFirst = false;
} else {
    $condition .= " and `layout_widget_list` $key :layoutWidgetListKey";
}
if($type == 'str') {
    $params[] = array(':layoutWidgetListKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':layoutWidgetListKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `layout_widget_list` =  :layoutWidgetListKey';
$isFirst=false;
}else{
$condition.=' and `layout_widget_list` =  :layoutWidgetListKey';
}
$params[]=array(':layoutWidgetListKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($layoutRowVo->setting)){ //If isset Vo->element
$fieldValue=$layoutRowVo->setting;
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

if (!is_null($layoutRowVo->status)){ //If isset Vo->element
$fieldValue=$layoutRowVo->status;
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


public function updateByPrimaryKey($layoutRowVo,$layoutRowId){
try {
$sql="UPDATE `layout_row` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($layoutRowVo->layoutRowId)){
if ($isFirst){
$updateFields.=' `layout_row_id`= :layoutRowId';
$isFirst=false;}else{
$updateFields.=', `layout_row_id`= :layoutRowId';
}
$params[]=array(':layoutRowId', $layoutRowVo->layoutRowId, PDO::PARAM_INT);
}

if (isset($layoutRowVo->layoutId)){
if ($isFirst){
$updateFields.=' `layout_id`= :layoutId';
$isFirst=false;}else{
$updateFields.=', `layout_id`= :layoutId';
}
$params[]=array(':layoutId', $layoutRowVo->layoutId, PDO::PARAM_INT);
}

if (isset($layoutRowVo->group)){
if ($isFirst){
$updateFields.=' `group`= :group';
$isFirst=false;}else{
$updateFields.=', `group`= :group';
}
$params[]=array(':group', $layoutRowVo->group, PDO::PARAM_STR);
}

if (isset($layoutRowVo->cols)){
if ($isFirst){
$updateFields.=' `cols`= :cols';
$isFirst=false;}else{
$updateFields.=', `cols`= :cols';
}
$params[]=array(':cols', $layoutRowVo->cols, PDO::PARAM_INT);
}

if (isset($layoutRowVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $layoutRowVo->order, PDO::PARAM_INT);
}

if (isset($layoutRowVo->layoutWidgetList)){
if ($isFirst){
$updateFields.=' `layout_widget_list`= :layoutWidgetList';
$isFirst=false;}else{
$updateFields.=', `layout_widget_list`= :layoutWidgetList';
}
$params[]=array(':layoutWidgetList', $layoutRowVo->layoutWidgetList, PDO::PARAM_STR);
}

if (isset($layoutRowVo->setting)){
if ($isFirst){
$updateFields.=' `setting`= :setting';
$isFirst=false;}else{
$updateFields.=', `setting`= :setting';
}
$params[]=array(':setting', $layoutRowVo->setting, PDO::PARAM_STR);
}

if (isset($layoutRowVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $layoutRowVo->status, PDO::PARAM_STR);
}

$conditions.=' where `layout_row_id`= :layoutRowId';
$params[]=array(':layoutRowId', $layoutRowId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (layoutRowId)
	 * Example
	 * getValueByPrimaryKey('layoutRowName', 1)
	 * Get value of filed layoutRowName in table layoutRow where layoutRowId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$layoutRowVo = $this->selectByPrimaryKey($primaryValue);
		if($layoutRowVo){
			return $layoutRowVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('layoutRowName', array('layoutRowId' => 1))
	 * Get value of filed layoutRowName in table layoutRow where layoutRowId = 1
	 */
	public function getValueByField($fieldName, $where){
		$layoutRowVo = new LayoutRowVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$layoutRowVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$layoutRowVos = $this->selectByFilter($layoutRowVo);
       
		if($layoutRowVos){
			$layoutRowVo = $layoutRowVos[0];
			return $layoutRowVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table layout_row
	 *
	 * @param int $layout_row_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($layoutRowId){
		try {
		    $sql = "DELETE FROM `layout_row` where `layout_row_id` = :layoutRowId";
		    $params = array();
		    $params[] = array(':layoutRowId', $layoutRowId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table layout_row
	 *
	 * @param object $layoutRowVo
	 * @return boolean
	 */
	public function deleteByFilter($layoutRowVo){
		try {
			$sql = 'DELETE FROM `layout_row`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($layoutRowVo->layoutRowId)){
				$isDel = true;
				$condition[] = '`layout_row_id` = :layoutRowId';
				$params[] = array(':layoutRowId', $layoutRowVo->layoutRowId, PDO::PARAM_INT);
			}
			if (!is_null($layoutRowVo->layoutId)){
				$isDel = true;
				$condition[] = '`layout_id` = :layoutId';
				$params[] = array(':layoutId', $layoutRowVo->layoutId, PDO::PARAM_INT);
			}
			if (!is_null($layoutRowVo->group)){
				$isDel = true;
				$condition[] = '`group` = :group';
				$params[] = array(':group', $layoutRowVo->group, PDO::PARAM_STR);
			}
			if (!is_null($layoutRowVo->cols)){
				$isDel = true;
				$condition[] = '`cols` = :cols';
				$params[] = array(':cols', $layoutRowVo->cols, PDO::PARAM_INT);
			}
			if (!is_null($layoutRowVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $layoutRowVo->order, PDO::PARAM_INT);
			}
			if (!is_null($layoutRowVo->layoutWidgetList)){
				$isDel = true;
				$condition[] = '`layout_widget_list` = :layoutWidgetList';
				$params[] = array(':layoutWidgetList', $layoutRowVo->layoutWidgetList, PDO::PARAM_STR);
			}
			if (!is_null($layoutRowVo->setting)){
				$isDel = true;
				$condition[] = '`setting` = :setting';
				$params[] = array(':setting', $layoutRowVo->setting, PDO::PARAM_STR);
			}
			if (!is_null($layoutRowVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $layoutRowVo->status, PDO::PARAM_STR);
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
