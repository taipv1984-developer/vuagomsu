<?php
class WidgetCatDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `widget_cat`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('WidgetCatVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($widgetCatId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `widget_cat` where `widget_cat_id` = :widgetCatId");
$stmt->bindParam(':widgetCatId',$widgetCatId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('WidgetCatVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($widgetCatVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `widget_cat`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $widgetCatVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $widgetCatVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($widgetCatVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `widget_cat`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $widgetCatVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $widgetCatVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table widget_cat by $widgetCatVo object filter use paging
 * 
 * @param object $widgetCatVo is widget_cat object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($widgetCatVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($widgetCatVo)) $widgetCatVo = new WidgetCatVo();
$sql = "select * from `widget_cat` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($widgetCatVo->widgetCatId)){ //If isset Vo->element
$fieldValue=$widgetCatVo->widgetCatId;
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

if (!is_null($widgetCatVo->name)){ //If isset Vo->element
$fieldValue=$widgetCatVo->name;
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

if (!is_null($widgetCatVo->description)){ //If isset Vo->element
$fieldValue=$widgetCatVo->description;
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
return PersistentHelper::mapResult('WidgetCatVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($widgetCatVo){
try {
if (empty($widgetCatVo)) $widgetCatVo = new WidgetCatVo();
$sql = "select count(*) as total from  widget_cat ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($widgetCatVo->widgetCatId)){ //If isset Vo->element
$fieldValue=$widgetCatVo->widgetCatId;
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

if (!is_null($widgetCatVo->name)){ //If isset Vo->element
$fieldValue=$widgetCatVo->name;
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

if (!is_null($widgetCatVo->description)){ //If isset Vo->element
$fieldValue=$widgetCatVo->description;
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


public function updateByPrimaryKey($widgetCatVo,$widgetCatId){
try {
$sql="UPDATE `widget_cat` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($widgetCatVo->widgetCatId)){
if ($isFirst){
$updateFields.=' `widget_cat_id`= :widgetCatId';
$isFirst=false;}else{
$updateFields.=', `widget_cat_id`= :widgetCatId';
}
$params[]=array(':widgetCatId', $widgetCatVo->widgetCatId, PDO::PARAM_INT);
}

if (isset($widgetCatVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $widgetCatVo->name, PDO::PARAM_STR);
}

if (isset($widgetCatVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $widgetCatVo->description, PDO::PARAM_STR);
}

$conditions.=' where `widget_cat_id`= :widgetCatId';
$params[]=array(':widgetCatId', $widgetCatId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (widgetCatId)
	 * Example
	 * getValueByPrimaryKey('widgetCatName', 1)
	 * Get value of filed widgetCatName in table widgetCat where widgetCatId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$widgetCatVo = $this->selectByPrimaryKey($primaryValue);
		if($widgetCatVo){
			return $widgetCatVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('widgetCatName', array('widgetCatId' => 1))
	 * Get value of filed widgetCatName in table widgetCat where widgetCatId = 1
	 */
	public function getValueByField($fieldName, $where){
		$widgetCatVo = new WidgetCatVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$widgetCatVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$widgetCatVos = $this->selectByFilter($widgetCatVo);
       
		if($widgetCatVos){
			$widgetCatVo = $widgetCatVos[0];
			return $widgetCatVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table widget_cat
	 *
	 * @param int $widget_cat_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($widgetCatId){
		try {
		    $sql = "DELETE FROM `widget_cat` where `widget_cat_id` = :widgetCatId";
		    $params = array();
		    $params[] = array(':widgetCatId', $widgetCatId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table widget_cat
	 *
	 * @param object $widgetCatVo
	 * @return boolean
	 */
	public function deleteByFilter($widgetCatVo){
		try {
			$sql = 'DELETE FROM `widget_cat`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($widgetCatVo->widgetCatId)){
				$isDel = true;
				$condition[] = '`widget_cat_id` = :widgetCatId';
				$params[] = array(':widgetCatId', $widgetCatVo->widgetCatId, PDO::PARAM_INT);
			}
			if (!is_null($widgetCatVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $widgetCatVo->name, PDO::PARAM_STR);
			}
			if (!is_null($widgetCatVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $widgetCatVo->description, PDO::PARAM_STR);
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
