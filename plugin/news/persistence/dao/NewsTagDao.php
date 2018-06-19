<?php
class NewsTagDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `news_tag`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsTagVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($newsTagId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `news_tag` where `news_tag_id` = :newsTagId");
$stmt->bindParam(':newsTagId',$newsTagId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsTagVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsTagVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_tag`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $newsTagVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $newsTagVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsTagVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_tag`( `name`, `description`)
VALUES( :name, :description)");
$stmt->bindParam(':name', $newsTagVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $newsTagVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table news_tag by $newsTagVo object filter use paging
 * 
 * @param object $newsTagVo is news_tag object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsTagVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsTagVo)) $newsTagVo = new NewsTagVo();
$sql = "select * from `news_tag` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsTagVo->newsTagId)){ //If isset Vo->element
$fieldValue=$newsTagVo->newsTagId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_tag_id` $key :newsTagIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_tag_id` $key :newsTagIdKey";
}
if($type == 'str') {
    $params[] = array(':newsTagIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsTagIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_tag_id` =  :newsTagIdKey';
$isFirst=false;
}else{
$condition.=' and `news_tag_id` =  :newsTagIdKey';
}
$params[]=array(':newsTagIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsTagVo->name)){ //If isset Vo->element
$fieldValue=$newsTagVo->name;
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

if (!is_null($newsTagVo->description)){ //If isset Vo->element
$fieldValue=$newsTagVo->description;
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
return PersistentHelper::mapResult('NewsTagVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsTagVo){
try {
if (empty($newsTagVo)) $newsTagVo = new NewsTagVo();
$sql = "select count(*) as total from  news_tag ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsTagVo->newsTagId)){ //If isset Vo->element
$fieldValue=$newsTagVo->newsTagId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_tag_id` $key :newsTagIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_tag_id` $key :newsTagIdKey";
}
if($type == 'str') {
    $params[] = array(':newsTagIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsTagIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_tag_id` =  :newsTagIdKey';
$isFirst=false;
}else{
$condition.=' and `news_tag_id` =  :newsTagIdKey';
}
$params[]=array(':newsTagIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsTagVo->name)){ //If isset Vo->element
$fieldValue=$newsTagVo->name;
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

if (!is_null($newsTagVo->description)){ //If isset Vo->element
$fieldValue=$newsTagVo->description;
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


public function updateByPrimaryKey($newsTagVo,$newsTagId){
try {
$sql="UPDATE `news_tag` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsTagVo->newsTagId)){
if ($isFirst){
$updateFields.=' `news_tag_id`= :newsTagId';
$isFirst=false;}else{
$updateFields.=', `news_tag_id`= :newsTagId';
}
$params[]=array(':newsTagId', $newsTagVo->newsTagId, PDO::PARAM_INT);
}

if (isset($newsTagVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $newsTagVo->name, PDO::PARAM_STR);
}

if (isset($newsTagVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $newsTagVo->description, PDO::PARAM_STR);
}

$conditions.=' where `news_tag_id`= :newsTagId';
$params[]=array(':newsTagId', $newsTagId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsTagId)
	 * Example
	 * getValueByPrimaryKey('newsTagName', 1)
	 * Get value of filed newsTagName in table newsTag where newsTagId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsTagVo = $this->selectByPrimaryKey($primaryValue);
		if($newsTagVo){
			return $newsTagVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsTagName', array('newsTagId' => 1))
	 * Get value of filed newsTagName in table newsTag where newsTagId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsTagVo = new NewsTagVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsTagVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsTagVos = $this->selectByFilter($newsTagVo);
       
		if($newsTagVos){
			$newsTagVo = $newsTagVos[0];
			return $newsTagVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table news_tag
	 *
	 * @param int $news_tag_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($newsTagId){
		try {
		    $sql = "DELETE FROM `news_tag` where `news_tag_id` = :newsTagId";
		    $params = array();
		    $params[] = array(':newsTagId', $newsTagId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table news_tag
	 *
	 * @param object $newsTagVo
	 * @return boolean
	 */
	public function deleteByFilter($newsTagVo){
		try {
			$sql = 'DELETE FROM `news_tag`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsTagVo->newsTagId)){
				$isDel = true;
				$condition[] = '`news_tag_id` = :newsTagId';
				$params[] = array(':newsTagId', $newsTagVo->newsTagId, PDO::PARAM_INT);
			}
			if (!is_null($newsTagVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $newsTagVo->name, PDO::PARAM_STR);
			}
			if (!is_null($newsTagVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $newsTagVo->description, PDO::PARAM_STR);
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
