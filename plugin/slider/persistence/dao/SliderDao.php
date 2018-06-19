<?php
class SliderDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `slider`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('SliderVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($sliderId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `slider` where `slider_id` = :sliderId");
$stmt->bindParam(':sliderId',$sliderId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('SliderVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($sliderVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `slider`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $sliderVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $sliderVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($sliderVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `slider`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $sliderVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $sliderVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table slider by $sliderVo object filter use paging
 * 
 * @param object $sliderVo is slider object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($sliderVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($sliderVo)) $sliderVo = new SliderVo();
$sql = "select * from `slider` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($sliderVo->sliderId)){ //If isset Vo->element
$fieldValue=$sliderVo->sliderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `slider_id` $key :sliderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `slider_id` $key :sliderIdKey";
}
if($type == 'str') {
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `slider_id` =  :sliderIdKey';
$isFirst=false;
}else{
$condition.=' and `slider_id` =  :sliderIdKey';
}
$params[]=array(':sliderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($sliderVo->name)){ //If isset Vo->element
$fieldValue=$sliderVo->name;
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

if (!is_null($sliderVo->description)){ //If isset Vo->element
$fieldValue=$sliderVo->description;
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
return PersistentHelper::mapResult('SliderVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($sliderVo){
try {
if (empty($sliderVo)) $sliderVo = new SliderVo();
$sql = "select count(*) as total from  slider ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($sliderVo->sliderId)){ //If isset Vo->element
$fieldValue=$sliderVo->sliderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `slider_id` $key :sliderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `slider_id` $key :sliderIdKey";
}
if($type == 'str') {
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `slider_id` =  :sliderIdKey';
$isFirst=false;
}else{
$condition.=' and `slider_id` =  :sliderIdKey';
}
$params[]=array(':sliderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($sliderVo->name)){ //If isset Vo->element
$fieldValue=$sliderVo->name;
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

if (!is_null($sliderVo->description)){ //If isset Vo->element
$fieldValue=$sliderVo->description;
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


public function updateByPrimaryKey($sliderVo,$sliderId){
try {
$sql="UPDATE `slider` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($sliderVo->sliderId)){
if ($isFirst){
$updateFields.=' `slider_id`= :sliderId';
$isFirst=false;}else{
$updateFields.=', `slider_id`= :sliderId';
}
$params[]=array(':sliderId', $sliderVo->sliderId, PDO::PARAM_INT);
}

if (isset($sliderVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $sliderVo->name, PDO::PARAM_STR);
}

if (isset($sliderVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $sliderVo->description, PDO::PARAM_STR);
}

$conditions.=' where `slider_id`= :sliderId';
$params[]=array(':sliderId', $sliderId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (sliderId)
	 * Example
	 * getValueByPrimaryKey('sliderName', 1)
	 * Get value of filed sliderName in table slider where sliderId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$sliderVo = $this->selectByPrimaryKey($primaryValue);
		if($sliderVo){
			return $sliderVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('sliderName', array('sliderId' => 1))
	 * Get value of filed sliderName in table slider where sliderId = 1
	 */
	public function getValueByField($fieldName, $where){
		$sliderVo = new SliderVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$sliderVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$sliderVos = $this->selectByFilter($sliderVo);
       
		if($sliderVos){
			$sliderVo = $sliderVos[0];
			return $sliderVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table slider
	 *
	 * @param int $slider_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($sliderId){
		try {
		    $sql = "DELETE FROM `slider` where `slider_id` = :sliderId";
		    $params = array();
		    $params[] = array(':sliderId', $sliderId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table slider
	 *
	 * @param object $sliderVo
	 * @return boolean
	 */
	public function deleteByFilter($sliderVo){
		try {
			$sql = 'DELETE FROM `slider`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($sliderVo->sliderId)){
				$isDel = true;
				$condition[] = '`slider_id` = :sliderId';
				$params[] = array(':sliderId', $sliderVo->sliderId, PDO::PARAM_INT);
			}
			if (!is_null($sliderVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $sliderVo->name, PDO::PARAM_STR);
			}
			if (!is_null($sliderVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $sliderVo->description, PDO::PARAM_STR);
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
