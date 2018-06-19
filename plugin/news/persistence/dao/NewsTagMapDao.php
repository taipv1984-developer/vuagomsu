<?php
class NewsTagMapDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `news_tag_map`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsTagMapVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($newsTagMapId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `news_tag_map` where `news_tag_map_id` = :newsTagMapId");
$stmt->bindParam(':newsTagMapId',$newsTagMapId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsTagMapVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsTagMapVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_tag_map`( `news_tag_id`, `news_id`)
VALUES( :newsTagId, :newsId)");
$stmt->bindParam(':newsTagId', $newsTagMapVo->newsTagId, PDO::PARAM_INT);
$stmt->bindParam(':newsId', $newsTagMapVo->newsId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsTagMapVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_tag_map`( `news_tag_id`, `news_id`)
VALUES( :newsTagId, :newsId)");
$stmt->bindParam(':newsTagId', $newsTagMapVo->newsTagId, PDO::PARAM_INT);
$stmt->bindParam(':newsId', $newsTagMapVo->newsId, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table news_tag_map by $newsTagMapVo object filter use paging
 * 
 * @param object $newsTagMapVo is news_tag_map object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsTagMapVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsTagMapVo)) $newsTagMapVo = new NewsTagMapVo();
$sql = "select * from `news_tag_map` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsTagMapVo->newsTagMapId)){ //If isset Vo->element
$fieldValue=$newsTagMapVo->newsTagMapId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_tag_map_id` $key :newsTagMapIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_tag_map_id` $key :newsTagMapIdKey";
}
if($type == 'str') {
    $params[] = array(':newsTagMapIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsTagMapIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_tag_map_id` =  :newsTagMapIdKey';
$isFirst=false;
}else{
$condition.=' and `news_tag_map_id` =  :newsTagMapIdKey';
}
$params[]=array(':newsTagMapIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsTagMapVo->newsTagId)){ //If isset Vo->element
$fieldValue=$newsTagMapVo->newsTagId;
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

if (!is_null($newsTagMapVo->newsId)){ //If isset Vo->element
$fieldValue=$newsTagMapVo->newsId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_id` $key :newsIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_id` $key :newsIdKey";
}
if($type == 'str') {
    $params[] = array(':newsIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_id` =  :newsIdKey';
$isFirst=false;
}else{
$condition.=' and `news_id` =  :newsIdKey';
}
$params[]=array(':newsIdKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('NewsTagMapVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsTagMapVo){
try {
if (empty($newsTagMapVo)) $newsTagMapVo = new NewsTagMapVo();
$sql = "select count(*) as total from  news_tag_map ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsTagMapVo->newsTagMapId)){ //If isset Vo->element
$fieldValue=$newsTagMapVo->newsTagMapId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_tag_map_id` $key :newsTagMapIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_tag_map_id` $key :newsTagMapIdKey";
}
if($type == 'str') {
    $params[] = array(':newsTagMapIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsTagMapIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_tag_map_id` =  :newsTagMapIdKey';
$isFirst=false;
}else{
$condition.=' and `news_tag_map_id` =  :newsTagMapIdKey';
}
$params[]=array(':newsTagMapIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsTagMapVo->newsTagId)){ //If isset Vo->element
$fieldValue=$newsTagMapVo->newsTagId;
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

if (!is_null($newsTagMapVo->newsId)){ //If isset Vo->element
$fieldValue=$newsTagMapVo->newsId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_id` $key :newsIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_id` $key :newsIdKey";
}
if($type == 'str') {
    $params[] = array(':newsIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_id` =  :newsIdKey';
$isFirst=false;
}else{
$condition.=' and `news_id` =  :newsIdKey';
}
$params[]=array(':newsIdKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($newsTagMapVo,$newsTagMapId){
try {
$sql="UPDATE `news_tag_map` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsTagMapVo->newsTagMapId)){
if ($isFirst){
$updateFields.=' `news_tag_map_id`= :newsTagMapId';
$isFirst=false;}else{
$updateFields.=', `news_tag_map_id`= :newsTagMapId';
}
$params[]=array(':newsTagMapId', $newsTagMapVo->newsTagMapId, PDO::PARAM_INT);
}

if (isset($newsTagMapVo->newsTagId)){
if ($isFirst){
$updateFields.=' `news_tag_id`= :newsTagId';
$isFirst=false;}else{
$updateFields.=', `news_tag_id`= :newsTagId';
}
$params[]=array(':newsTagId', $newsTagMapVo->newsTagId, PDO::PARAM_INT);
}

if (isset($newsTagMapVo->newsId)){
if ($isFirst){
$updateFields.=' `news_id`= :newsId';
$isFirst=false;}else{
$updateFields.=', `news_id`= :newsId';
}
$params[]=array(':newsId', $newsTagMapVo->newsId, PDO::PARAM_INT);
}

$conditions.=' where `news_tag_map_id`= :newsTagMapId';
$params[]=array(':newsTagMapId', $newsTagMapId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsTagMapId)
	 * Example
	 * getValueByPrimaryKey('newsTagMapName', 1)
	 * Get value of filed newsTagMapName in table newsTagMap where newsTagMapId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsTagMapVo = $this->selectByPrimaryKey($primaryValue);
		if($newsTagMapVo){
			return $newsTagMapVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsTagMapName', array('newsTagMapId' => 1))
	 * Get value of filed newsTagMapName in table newsTagMap where newsTagMapId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsTagMapVo = new NewsTagMapVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsTagMapVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsTagMapVos = $this->selectByFilter($newsTagMapVo);
       
		if($newsTagMapVos){
			$newsTagMapVo = $newsTagMapVos[0];
			return $newsTagMapVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table news_tag_map
	 *
	 * @param int $news_tag_map_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($newsTagMapId){
		try {
		    $sql = "DELETE FROM `news_tag_map` where `news_tag_map_id` = :newsTagMapId";
		    $params = array();
		    $params[] = array(':newsTagMapId', $newsTagMapId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table news_tag_map
	 *
	 * @param object $newsTagMapVo
	 * @return boolean
	 */
	public function deleteByFilter($newsTagMapVo){
		try {
			$sql = 'DELETE FROM `news_tag_map`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsTagMapVo->newsTagMapId)){
				$isDel = true;
				$condition[] = '`news_tag_map_id` = :newsTagMapId';
				$params[] = array(':newsTagMapId', $newsTagMapVo->newsTagMapId, PDO::PARAM_INT);
			}
			if (!is_null($newsTagMapVo->newsTagId)){
				$isDel = true;
				$condition[] = '`news_tag_id` = :newsTagId';
				$params[] = array(':newsTagId', $newsTagMapVo->newsTagId, PDO::PARAM_INT);
			}
			if (!is_null($newsTagMapVo->newsId)){
				$isDel = true;
				$condition[] = '`news_id` = :newsId';
				$params[] = array(':newsId', $newsTagMapVo->newsId, PDO::PARAM_INT);
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
