<?php
class StaticPageDetailDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `static_page_detail`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('StaticPageDetailVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($staticPageDetailId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `static_page_detail` where `static_page_detail_id` = :staticPageDetailId");
$stmt->bindParam(':staticPageDetailId',$staticPageDetailId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('StaticPageDetailVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($staticPageDetailVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `static_page_detail`( `static_page_id`, `title`, `content`, `sub_content`, `open_link`)
VALUES( :staticPageId, :title, :content, :subContent, :openLink)");
$stmt->bindParam(':staticPageId', $staticPageDetailVo->staticPageId, PDO::PARAM_INT);
$stmt->bindParam(':title', $staticPageDetailVo->title, PDO::PARAM_STR);
$stmt->bindParam(':content', $staticPageDetailVo->content, PDO::PARAM_STR);
$stmt->bindParam(':subContent', $staticPageDetailVo->subContent, PDO::PARAM_STR);
$stmt->bindParam(':openLink', $staticPageDetailVo->openLink, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($staticPageDetailVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `static_page_detail`( `static_page_id`, `title`, `content`, `sub_content`, `open_link`)
VALUES( :staticPageId, :title, :content, :subContent, :openLink)");
$stmt->bindParam(':staticPageId', $staticPageDetailVo->staticPageId, PDO::PARAM_INT);
$stmt->bindParam(':title', $staticPageDetailVo->title, PDO::PARAM_STR);
$stmt->bindParam(':content', $staticPageDetailVo->content, PDO::PARAM_STR);
$stmt->bindParam(':subContent', $staticPageDetailVo->subContent, PDO::PARAM_STR);
$stmt->bindParam(':openLink', $staticPageDetailVo->openLink, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table static_page_detail by $staticPageDetailVo object filter use paging
 * 
 * @param object $staticPageDetailVo is static_page_detail object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($staticPageDetailVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($staticPageDetailVo)) $staticPageDetailVo = new StaticPageDetailVo();
$sql = "select * from `static_page_detail` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($staticPageDetailVo->staticPageDetailId)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->staticPageDetailId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `static_page_detail_id` $key :staticPageDetailIdKey";
    $isFirst = false;
} else {
    $condition .= " and `static_page_detail_id` $key :staticPageDetailIdKey";
}
if($type == 'str') {
    $params[] = array(':staticPageDetailIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':staticPageDetailIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `static_page_detail_id` =  :staticPageDetailIdKey';
$isFirst=false;
}else{
$condition.=' and `static_page_detail_id` =  :staticPageDetailIdKey';
}
$params[]=array(':staticPageDetailIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($staticPageDetailVo->staticPageId)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->staticPageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `static_page_id` $key :staticPageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `static_page_id` $key :staticPageIdKey";
}
if($type == 'str') {
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `static_page_id` =  :staticPageIdKey';
$isFirst=false;
}else{
$condition.=' and `static_page_id` =  :staticPageIdKey';
}
$params[]=array(':staticPageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($staticPageDetailVo->title)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->title;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `title` $key :titleKey";
    $isFirst = false;
} else {
    $condition .= " and `title` $key :titleKey";
}
if($type == 'str') {
    $params[] = array(':titleKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':titleKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `title` =  :titleKey';
$isFirst=false;
}else{
$condition.=' and `title` =  :titleKey';
}
$params[]=array(':titleKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageDetailVo->content)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageDetailVo->subContent)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->subContent;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `sub_content` $key :subContentKey";
    $isFirst = false;
} else {
    $condition .= " and `sub_content` $key :subContentKey";
}
if($type == 'str') {
    $params[] = array(':subContentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subContentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `sub_content` =  :subContentKey';
$isFirst=false;
}else{
$condition.=' and `sub_content` =  :subContentKey';
}
$params[]=array(':subContentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageDetailVo->openLink)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->openLink;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `open_link` $key :openLinkKey";
    $isFirst = false;
} else {
    $condition .= " and `open_link` $key :openLinkKey";
}
if($type == 'str') {
    $params[] = array(':openLinkKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':openLinkKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `open_link` =  :openLinkKey';
$isFirst=false;
}else{
$condition.=' and `open_link` =  :openLinkKey';
}
$params[]=array(':openLinkKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('StaticPageDetailVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($staticPageDetailVo){
try {
if (empty($staticPageDetailVo)) $staticPageDetailVo = new StaticPageDetailVo();
$sql = "select count(*) as total from  static_page_detail ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($staticPageDetailVo->staticPageDetailId)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->staticPageDetailId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `static_page_detail_id` $key :staticPageDetailIdKey";
    $isFirst = false;
} else {
    $condition .= " and `static_page_detail_id` $key :staticPageDetailIdKey";
}
if($type == 'str') {
    $params[] = array(':staticPageDetailIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':staticPageDetailIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `static_page_detail_id` =  :staticPageDetailIdKey';
$isFirst=false;
}else{
$condition.=' and `static_page_detail_id` =  :staticPageDetailIdKey';
}
$params[]=array(':staticPageDetailIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($staticPageDetailVo->staticPageId)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->staticPageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `static_page_id` $key :staticPageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `static_page_id` $key :staticPageIdKey";
}
if($type == 'str') {
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':staticPageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `static_page_id` =  :staticPageIdKey';
$isFirst=false;
}else{
$condition.=' and `static_page_id` =  :staticPageIdKey';
}
$params[]=array(':staticPageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($staticPageDetailVo->title)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->title;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `title` $key :titleKey";
    $isFirst = false;
} else {
    $condition .= " and `title` $key :titleKey";
}
if($type == 'str') {
    $params[] = array(':titleKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':titleKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `title` =  :titleKey';
$isFirst=false;
}else{
$condition.=' and `title` =  :titleKey';
}
$params[]=array(':titleKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageDetailVo->content)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageDetailVo->subContent)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->subContent;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `sub_content` $key :subContentKey";
    $isFirst = false;
} else {
    $condition .= " and `sub_content` $key :subContentKey";
}
if($type == 'str') {
    $params[] = array(':subContentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subContentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `sub_content` =  :subContentKey';
$isFirst=false;
}else{
$condition.=' and `sub_content` =  :subContentKey';
}
$params[]=array(':subContentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($staticPageDetailVo->openLink)){ //If isset Vo->element
$fieldValue=$staticPageDetailVo->openLink;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `open_link` $key :openLinkKey";
    $isFirst = false;
} else {
    $condition .= " and `open_link` $key :openLinkKey";
}
if($type == 'str') {
    $params[] = array(':openLinkKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':openLinkKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `open_link` =  :openLinkKey';
$isFirst=false;
}else{
$condition.=' and `open_link` =  :openLinkKey';
}
$params[]=array(':openLinkKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($staticPageDetailVo,$staticPageDetailId){
try {
$sql="UPDATE `static_page_detail` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($staticPageDetailVo->staticPageDetailId)){
if ($isFirst){
$updateFields.=' `static_page_detail_id`= :staticPageDetailId';
$isFirst=false;}else{
$updateFields.=', `static_page_detail_id`= :staticPageDetailId';
}
$params[]=array(':staticPageDetailId', $staticPageDetailVo->staticPageDetailId, PDO::PARAM_INT);
}

if (isset($staticPageDetailVo->staticPageId)){
if ($isFirst){
$updateFields.=' `static_page_id`= :staticPageId';
$isFirst=false;}else{
$updateFields.=', `static_page_id`= :staticPageId';
}
$params[]=array(':staticPageId', $staticPageDetailVo->staticPageId, PDO::PARAM_INT);
}

if (isset($staticPageDetailVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $staticPageDetailVo->title, PDO::PARAM_STR);
}

if (isset($staticPageDetailVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $staticPageDetailVo->content, PDO::PARAM_STR);
}

if (isset($staticPageDetailVo->subContent)){
if ($isFirst){
$updateFields.=' `sub_content`= :subContent';
$isFirst=false;}else{
$updateFields.=', `sub_content`= :subContent';
}
$params[]=array(':subContent', $staticPageDetailVo->subContent, PDO::PARAM_STR);
}

if (isset($staticPageDetailVo->openLink)){
if ($isFirst){
$updateFields.=' `open_link`= :openLink';
$isFirst=false;}else{
$updateFields.=', `open_link`= :openLink';
}
$params[]=array(':openLink', $staticPageDetailVo->openLink, PDO::PARAM_STR);
}

$conditions.=' where `static_page_detail_id`= :staticPageDetailId';
$params[]=array(':staticPageDetailId', $staticPageDetailId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (staticPageDetailId)
	 * Example
	 * getValueByPrimaryKey('staticPageDetailName', 1)
	 * Get value of filed staticPageDetailName in table staticPageDetail where staticPageDetailId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$staticPageDetailVo = $this->selectByPrimaryKey($primaryValue);
		if($staticPageDetailVo){
			return $staticPageDetailVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('staticPageDetailName', array('staticPageDetailId' => 1))
	 * Get value of filed staticPageDetailName in table staticPageDetail where staticPageDetailId = 1
	 */
	public function getValueByField($fieldName, $where){
		$staticPageDetailVo = new StaticPageDetailVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$staticPageDetailVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$staticPageDetailVos = $this->selectByFilter($staticPageDetailVo);
       
		if($staticPageDetailVos){
			$staticPageDetailVo = $staticPageDetailVos[0];
			return $staticPageDetailVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table static_page_detail
	 *
	 * @param int $static_page_detail_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($staticPageDetailId){
		try {
		    $sql = "DELETE FROM `static_page_detail` where `static_page_detail_id` = :staticPageDetailId";
		    $params = array();
		    $params[] = array(':staticPageDetailId', $staticPageDetailId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table static_page_detail
	 *
	 * @param object $staticPageDetailVo
	 * @return boolean
	 */
	public function deleteByFilter($staticPageDetailVo){
		try {
			$sql = 'DELETE FROM `static_page_detail`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($staticPageDetailVo->staticPageDetailId)){
				$isDel = true;
				$condition[] = '`static_page_detail_id` = :staticPageDetailId';
				$params[] = array(':staticPageDetailId', $staticPageDetailVo->staticPageDetailId, PDO::PARAM_INT);
			}
			if (!is_null($staticPageDetailVo->staticPageId)){
				$isDel = true;
				$condition[] = '`static_page_id` = :staticPageId';
				$params[] = array(':staticPageId', $staticPageDetailVo->staticPageId, PDO::PARAM_INT);
			}
			if (!is_null($staticPageDetailVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $staticPageDetailVo->title, PDO::PARAM_STR);
			}
			if (!is_null($staticPageDetailVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $staticPageDetailVo->content, PDO::PARAM_STR);
			}
			if (!is_null($staticPageDetailVo->subContent)){
				$isDel = true;
				$condition[] = '`sub_content` = :subContent';
				$params[] = array(':subContent', $staticPageDetailVo->subContent, PDO::PARAM_STR);
			}
			if (!is_null($staticPageDetailVo->openLink)){
				$isDel = true;
				$condition[] = '`open_link` = :openLink';
				$params[] = array(':openLink', $staticPageDetailVo->openLink, PDO::PARAM_STR);
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
