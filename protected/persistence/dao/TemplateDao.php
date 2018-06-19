<?php
class TemplateDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `template`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('TemplateVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($templateId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `template` where `template_id` = :templateId");
$stmt->bindParam(':templateId',$templateId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('TemplateVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($templateVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `template`( `name`, `status`)
VALUES( :name, :status)");
$stmt->bindParam(':name', $templateVo->name, PDO::PARAM_STR);
$stmt->bindParam(':status', $templateVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($templateVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `template`( `name`, `status`)
VALUES( :name, :status)");
$stmt->bindParam(':name', $templateVo->name, PDO::PARAM_STR);
$stmt->bindParam(':status', $templateVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table template by $templateVo object filter use paging
 * 
 * @param object $templateVo is template object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($templateVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($templateVo)) $templateVo = new TemplateVo();
$sql = "select * from `template` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($templateVo->templateId)){ //If isset Vo->element
$fieldValue=$templateVo->templateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `template_id` $key :templateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `template_id` $key :templateIdKey";
}
if($type == 'str') {
    $params[] = array(':templateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':templateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `template_id` =  :templateIdKey';
$isFirst=false;
}else{
$condition.=' and `template_id` =  :templateIdKey';
}
$params[]=array(':templateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($templateVo->name)){ //If isset Vo->element
$fieldValue=$templateVo->name;
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

if (!is_null($templateVo->status)){ //If isset Vo->element
$fieldValue=$templateVo->status;
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
return PersistentHelper::mapResult('TemplateVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($templateVo){
try {
if (empty($templateVo)) $templateVo = new TemplateVo();
$sql = "select count(*) as total from  template ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($templateVo->templateId)){ //If isset Vo->element
$fieldValue=$templateVo->templateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `template_id` $key :templateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `template_id` $key :templateIdKey";
}
if($type == 'str') {
    $params[] = array(':templateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':templateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `template_id` =  :templateIdKey';
$isFirst=false;
}else{
$condition.=' and `template_id` =  :templateIdKey';
}
$params[]=array(':templateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($templateVo->name)){ //If isset Vo->element
$fieldValue=$templateVo->name;
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

if (!is_null($templateVo->status)){ //If isset Vo->element
$fieldValue=$templateVo->status;
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


public function updateByPrimaryKey($templateVo,$templateId){
try {
$sql="UPDATE `template` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($templateVo->templateId)){
if ($isFirst){
$updateFields.=' `template_id`= :templateId';
$isFirst=false;}else{
$updateFields.=', `template_id`= :templateId';
}
$params[]=array(':templateId', $templateVo->templateId, PDO::PARAM_INT);
}

if (isset($templateVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $templateVo->name, PDO::PARAM_STR);
}

if (isset($templateVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $templateVo->status, PDO::PARAM_STR);
}

$conditions.=' where `template_id`= :templateId';
$params[]=array(':templateId', $templateId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (templateId)
	 * Example
	 * getValueByPrimaryKey('templateName', 1)
	 * Get value of filed templateName in table template where templateId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$templateVo = $this->selectByPrimaryKey($primaryValue);
		if($templateVo){
			return $templateVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('templateName', array('templateId' => 1))
	 * Get value of filed templateName in table template where templateId = 1
	 */
	public function getValueByField($fieldName, $where){
		$templateVo = new TemplateVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$templateVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$templateVos = $this->selectByFilter($templateVo);
       
		if($templateVos){
			$templateVo = $templateVos[0];
			return $templateVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table template
	 *
	 * @param int $template_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($templateId){
		try {
		    $sql = "DELETE FROM `template` where `template_id` = :templateId";
		    $params = array();
		    $params[] = array(':templateId', $templateId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table template
	 *
	 * @param object $templateVo
	 * @return boolean
	 */
	public function deleteByFilter($templateVo){
		try {
			$sql = 'DELETE FROM `template`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($templateVo->templateId)){
				$isDel = true;
				$condition[] = '`template_id` = :templateId';
				$params[] = array(':templateId', $templateVo->templateId, PDO::PARAM_INT);
			}
			if (!is_null($templateVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $templateVo->name, PDO::PARAM_STR);
			}
			if (!is_null($templateVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $templateVo->status, PDO::PARAM_STR);
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
