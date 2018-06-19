<?php
class NewsCommentDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `news_comment`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsCommentVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($commentId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `news_comment` where `comment_id` = :commentId");
$stmt->bindParam(':commentId',$commentId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsCommentVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsCommentVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_comment`( `news_id`, `parent_id`, `comment`, `crt_date`, `crt_by`)
VALUES( :newsId, :parentId, :comment, :crtDate, :crtBy)");
$stmt->bindParam(':newsId', $newsCommentVo->newsId, PDO::PARAM_INT);
$stmt->bindParam(':parentId', $newsCommentVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':comment', $newsCommentVo->comment, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $newsCommentVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsCommentVo->crtBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsCommentVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_comment`( `news_id`, `parent_id`, `comment`, `crt_date`, `crt_by`)
VALUES( :newsId, :parentId, :comment, :crtDate, :crtBy)");
$stmt->bindParam(':newsId', $newsCommentVo->newsId, PDO::PARAM_INT);
$stmt->bindParam(':parentId', $newsCommentVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':comment', $newsCommentVo->comment, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $newsCommentVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsCommentVo->crtBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table news_comment by $newsCommentVo object filter use paging
 * 
 * @param object $newsCommentVo is news_comment object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsCommentVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsCommentVo)) $newsCommentVo = new NewsCommentVo();
$sql = "select * from `news_comment` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsCommentVo->commentId)){ //If isset Vo->element
$fieldValue=$newsCommentVo->commentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `comment_id` $key :commentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `comment_id` $key :commentIdKey";
}
if($type == 'str') {
    $params[] = array(':commentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':commentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `comment_id` =  :commentIdKey';
$isFirst=false;
}else{
$condition.=' and `comment_id` =  :commentIdKey';
}
$params[]=array(':commentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsCommentVo->newsId)){ //If isset Vo->element
$fieldValue=$newsCommentVo->newsId;
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

if (!is_null($newsCommentVo->parentId)){ //If isset Vo->element
$fieldValue=$newsCommentVo->parentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `parent_id` $key :parentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `parent_id` $key :parentIdKey";
}
if($type == 'str') {
    $params[] = array(':parentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':parentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `parent_id` =  :parentIdKey';
$isFirst=false;
}else{
$condition.=' and `parent_id` =  :parentIdKey';
}
$params[]=array(':parentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsCommentVo->comment)){ //If isset Vo->element
$fieldValue=$newsCommentVo->comment;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `comment` $key :commentKey";
    $isFirst = false;
} else {
    $condition .= " and `comment` $key :commentKey";
}
if($type == 'str') {
    $params[] = array(':commentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':commentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `comment` =  :commentKey';
$isFirst=false;
}else{
$condition.=' and `comment` =  :commentKey';
}
$params[]=array(':commentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCommentVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsCommentVo->crtDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_date` $key :crtDateKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_date` $key :crtDateKey";
}
if($type == 'str') {
    $params[] = array(':crtDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_date` =  :crtDateKey';
$isFirst=false;
}else{
$condition.=' and `crt_date` =  :crtDateKey';
}
$params[]=array(':crtDateKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCommentVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsCommentVo->crtBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_by` $key :crtByKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_by` $key :crtByKey";
}
if($type == 'str') {
    $params[] = array(':crtByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_by` =  :crtByKey';
$isFirst=false;
}else{
$condition.=' and `crt_by` =  :crtByKey';
}
$params[]=array(':crtByKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('NewsCommentVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsCommentVo){
try {
if (empty($newsCommentVo)) $newsCommentVo = new NewsCommentVo();
$sql = "select count(*) as total from  news_comment ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsCommentVo->commentId)){ //If isset Vo->element
$fieldValue=$newsCommentVo->commentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `comment_id` $key :commentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `comment_id` $key :commentIdKey";
}
if($type == 'str') {
    $params[] = array(':commentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':commentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `comment_id` =  :commentIdKey';
$isFirst=false;
}else{
$condition.=' and `comment_id` =  :commentIdKey';
}
$params[]=array(':commentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsCommentVo->newsId)){ //If isset Vo->element
$fieldValue=$newsCommentVo->newsId;
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

if (!is_null($newsCommentVo->parentId)){ //If isset Vo->element
$fieldValue=$newsCommentVo->parentId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `parent_id` $key :parentIdKey";
    $isFirst = false;
} else {
    $condition .= " and `parent_id` $key :parentIdKey";
}
if($type == 'str') {
    $params[] = array(':parentIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':parentIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `parent_id` =  :parentIdKey';
$isFirst=false;
}else{
$condition.=' and `parent_id` =  :parentIdKey';
}
$params[]=array(':parentIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsCommentVo->comment)){ //If isset Vo->element
$fieldValue=$newsCommentVo->comment;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `comment` $key :commentKey";
    $isFirst = false;
} else {
    $condition .= " and `comment` $key :commentKey";
}
if($type == 'str') {
    $params[] = array(':commentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':commentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `comment` =  :commentKey';
$isFirst=false;
}else{
$condition.=' and `comment` =  :commentKey';
}
$params[]=array(':commentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCommentVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsCommentVo->crtDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_date` $key :crtDateKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_date` $key :crtDateKey";
}
if($type == 'str') {
    $params[] = array(':crtDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_date` =  :crtDateKey';
$isFirst=false;
}else{
$condition.=' and `crt_date` =  :crtDateKey';
}
$params[]=array(':crtDateKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCommentVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsCommentVo->crtBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_by` $key :crtByKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_by` $key :crtByKey";
}
if($type == 'str') {
    $params[] = array(':crtByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_by` =  :crtByKey';
$isFirst=false;
}else{
$condition.=' and `crt_by` =  :crtByKey';
}
$params[]=array(':crtByKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($newsCommentVo,$commentId){
try {
$sql="UPDATE `news_comment` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsCommentVo->commentId)){
if ($isFirst){
$updateFields.=' `comment_id`= :commentId';
$isFirst=false;}else{
$updateFields.=', `comment_id`= :commentId';
}
$params[]=array(':commentId', $newsCommentVo->commentId, PDO::PARAM_INT);
}

if (isset($newsCommentVo->newsId)){
if ($isFirst){
$updateFields.=' `news_id`= :newsId';
$isFirst=false;}else{
$updateFields.=', `news_id`= :newsId';
}
$params[]=array(':newsId', $newsCommentVo->newsId, PDO::PARAM_INT);
}

if (isset($newsCommentVo->parentId)){
if ($isFirst){
$updateFields.=' `parent_id`= :parentId';
$isFirst=false;}else{
$updateFields.=', `parent_id`= :parentId';
}
$params[]=array(':parentId', $newsCommentVo->parentId, PDO::PARAM_INT);
}

if (isset($newsCommentVo->comment)){
if ($isFirst){
$updateFields.=' `comment`= :comment';
$isFirst=false;}else{
$updateFields.=', `comment`= :comment';
}
$params[]=array(':comment', $newsCommentVo->comment, PDO::PARAM_STR);
}

if (isset($newsCommentVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $newsCommentVo->crtDate, PDO::PARAM_STR);
}

if (isset($newsCommentVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $newsCommentVo->crtBy, PDO::PARAM_INT);
}

$conditions.=' where `comment_id`= :commentId';
$params[]=array(':commentId', $commentId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsCommentId)
	 * Example
	 * getValueByPrimaryKey('newsCommentName', 1)
	 * Get value of filed newsCommentName in table newsComment where newsCommentId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsCommentVo = $this->selectByPrimaryKey($primaryValue);
		if($newsCommentVo){
			return $newsCommentVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsCommentName', array('newsCommentId' => 1))
	 * Get value of filed newsCommentName in table newsComment where newsCommentId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsCommentVo = new NewsCommentVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsCommentVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsCommentVos = $this->selectByFilter($newsCommentVo);
       
		if($newsCommentVos){
			$newsCommentVo = $newsCommentVos[0];
			return $newsCommentVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table news_comment
	 *
	 * @param int $comment_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($commentId){
		try {
		    $sql = "DELETE FROM `news_comment` where `comment_id` = :commentId";
		    $params = array();
		    $params[] = array(':commentId', $commentId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table news_comment
	 *
	 * @param object $newsCommentVo
	 * @return boolean
	 */
	public function deleteByFilter($newsCommentVo){
		try {
			$sql = 'DELETE FROM `news_comment`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsCommentVo->commentId)){
				$isDel = true;
				$condition[] = '`comment_id` = :commentId';
				$params[] = array(':commentId', $newsCommentVo->commentId, PDO::PARAM_INT);
			}
			if (!is_null($newsCommentVo->newsId)){
				$isDel = true;
				$condition[] = '`news_id` = :newsId';
				$params[] = array(':newsId', $newsCommentVo->newsId, PDO::PARAM_INT);
			}
			if (!is_null($newsCommentVo->parentId)){
				$isDel = true;
				$condition[] = '`parent_id` = :parentId';
				$params[] = array(':parentId', $newsCommentVo->parentId, PDO::PARAM_INT);
			}
			if (!is_null($newsCommentVo->comment)){
				$isDel = true;
				$condition[] = '`comment` = :comment';
				$params[] = array(':comment', $newsCommentVo->comment, PDO::PARAM_STR);
			}
			if (!is_null($newsCommentVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $newsCommentVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($newsCommentVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $newsCommentVo->crtBy, PDO::PARAM_INT);
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
