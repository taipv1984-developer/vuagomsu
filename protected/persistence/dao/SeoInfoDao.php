<?php
class SeoInfoDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `seo_info`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('SeoInfoVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($itemId, $type){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `seo_info` where `item_id` = :itemId and `type` = :type");
$stmt->bindParam(':itemId',$itemId, PDO::PARAM_INT);
$stmt->bindParam(':type', $type);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('SeoInfoVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($seoInfoVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `seo_info`( `item_id`, `type`, `url`, `title`, `keyword`, `description`)
VALUES( :itemId, :type, :url, :title, :keyword, :description)");
$stmt->bindParam(':itemId', $seoInfoVo->itemId, PDO::PARAM_INT);
$stmt->bindParam(':type', $seoInfoVo->type);
$stmt->bindParam(':url', $seoInfoVo->url, PDO::PARAM_STR);
$stmt->bindParam(':title', $seoInfoVo->title, PDO::PARAM_STR);
$stmt->bindParam(':keyword', $seoInfoVo->keyword, PDO::PARAM_STR);
$stmt->bindParam(':description', $seoInfoVo->description, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($seoInfoVo){
try {
$params = [];
$sql = "INSERT INTO `seo_info` ( `item_id`, `type`, `url`, `title`, `keyword`, `description`) 
 VALUES( :itemId, :type, :url, :title, :keyword, :description)";

$params[]=array(':itemId', $seoInfoVo->itemId, PDO::PARAM_INT);
$params[]=array(':type', $seoInfoVo->type);
$params[]=array(':url', $seoInfoVo->url, PDO::PARAM_STR);
$params[]=array(':title', $seoInfoVo->title, PDO::PARAM_STR);
$params[]=array(':keyword', $seoInfoVo->keyword, PDO::PARAM_STR);
$params[]=array(':description', $seoInfoVo->description, PDO::PARAM_STR);

$stmt = $this->conn->prepare($sql);
foreach ($params as $param){
$stmt->bindParam($param[0], $param[1], $param[2]);
}
$stmt->execute();

//debug
LogUtil::sql('(insert) '. DataBaseHelper::renderQuery($sql, $params));

return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table seo_info by $seoInfoVo object filter use paging
 * 
 * @param object $seoInfoVo is seo_info object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($seoInfoVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($seoInfoVo)) $seoInfoVo = new SeoInfoVo();
$sql = "select * from `seo_info` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($seoInfoVo->itemId)){ //If isset Vo->element
$fieldValue=$seoInfoVo->itemId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `item_id` $key :itemIdKey";
    $isFirst = false;
} else {
    $condition .= " and `item_id` $key :itemIdKey";
}
if($type == 'str') {
    $params[] = array(':itemIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':itemIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `item_id` =  :itemIdKey';
$isFirst=false;
}else{
$condition.=' and `item_id` =  :itemIdKey';
}
$params[]=array(':itemIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($seoInfoVo->type)){ //If isset Vo->element
$fieldValue=$seoInfoVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($seoInfoVo->url)){ //If isset Vo->element
$fieldValue=$seoInfoVo->url;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `url` $key :urlKey";
    $isFirst = false;
} else {
    $condition .= " and `url` $key :urlKey";
}
if($type == 'str') {
    $params[] = array(':urlKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':urlKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `url` =  :urlKey';
$isFirst=false;
}else{
$condition.=' and `url` =  :urlKey';
}
$params[]=array(':urlKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($seoInfoVo->title)){ //If isset Vo->element
$fieldValue=$seoInfoVo->title;
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

if (!is_null($seoInfoVo->keyword)){ //If isset Vo->element
$fieldValue=$seoInfoVo->keyword;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `keyword` $key :keywordKey";
    $isFirst = false;
} else {
    $condition .= " and `keyword` $key :keywordKey";
}
if($type == 'str') {
    $params[] = array(':keywordKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':keywordKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `keyword` =  :keywordKey';
$isFirst=false;
}else{
$condition.=' and `keyword` =  :keywordKey';
}
$params[]=array(':keywordKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($seoInfoVo->description)){ //If isset Vo->element
$fieldValue=$seoInfoVo->description;
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
return PersistentHelper::mapResult('SeoInfoVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($seoInfoVo){
try {
if (empty($seoInfoVo)) $seoInfoVo = new SeoInfoVo();
$sql = "select count(*) as total from  seo_info ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($seoInfoVo->itemId)){ //If isset Vo->element
$fieldValue=$seoInfoVo->itemId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `item_id` $key :itemIdKey";
    $isFirst = false;
} else {
    $condition .= " and `item_id` $key :itemIdKey";
}
if($type == 'str') {
    $params[] = array(':itemIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':itemIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `item_id` =  :itemIdKey';
$isFirst=false;
}else{
$condition.=' and `item_id` =  :itemIdKey';
}
$params[]=array(':itemIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($seoInfoVo->type)){ //If isset Vo->element
$fieldValue=$seoInfoVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($seoInfoVo->url)){ //If isset Vo->element
$fieldValue=$seoInfoVo->url;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `url` $key :urlKey";
    $isFirst = false;
} else {
    $condition .= " and `url` $key :urlKey";
}
if($type == 'str') {
    $params[] = array(':urlKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':urlKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `url` =  :urlKey';
$isFirst=false;
}else{
$condition.=' and `url` =  :urlKey';
}
$params[]=array(':urlKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($seoInfoVo->title)){ //If isset Vo->element
$fieldValue=$seoInfoVo->title;
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

if (!is_null($seoInfoVo->keyword)){ //If isset Vo->element
$fieldValue=$seoInfoVo->keyword;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `keyword` $key :keywordKey";
    $isFirst = false;
} else {
    $condition .= " and `keyword` $key :keywordKey";
}
if($type == 'str') {
    $params[] = array(':keywordKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':keywordKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `keyword` =  :keywordKey';
$isFirst=false;
}else{
$condition.=' and `keyword` =  :keywordKey';
}
$params[]=array(':keywordKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($seoInfoVo->description)){ //If isset Vo->element
$fieldValue=$seoInfoVo->description;
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


public function updateByPrimaryKey($seoInfoVo,$itemId, $type){
try {
$sql="UPDATE `seo_info` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($seoInfoVo->itemId)){
if ($isFirst){
$updateFields.=' `item_id`= :itemId';
$isFirst=false;}else{
$updateFields.=', `item_id`= :itemId';
}
$params[]=array(':itemId', $seoInfoVo->itemId, PDO::PARAM_INT);
}

if (isset($seoInfoVo->type)){
if ($isFirst){
$updateFields.=' `type`= :type';
$isFirst=false;}else{
$updateFields.=', `type`= :type';
}
$params[]=array(':type', $seoInfoVo->type, PDO::PARAM_STR);
}

if (isset($seoInfoVo->url)){
if ($isFirst){
$updateFields.=' `url`= :url';
$isFirst=false;}else{
$updateFields.=', `url`= :url';
}
$params[]=array(':url', $seoInfoVo->url, PDO::PARAM_STR);
}

if (isset($seoInfoVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $seoInfoVo->title, PDO::PARAM_STR);
}

if (isset($seoInfoVo->keyword)){
if ($isFirst){
$updateFields.=' `keyword`= :keyword';
$isFirst=false;}else{
$updateFields.=', `keyword`= :keyword';
}
$params[]=array(':keyword', $seoInfoVo->keyword, PDO::PARAM_STR);
}

if (isset($seoInfoVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $seoInfoVo->description, PDO::PARAM_STR);
}

$conditions.=' where `item_id`= :itemId';
$params[]=array(':itemId', $itemId, PDO::PARAM_INT);
$conditions.=' and `type`= :type';
$params[]=array(':type', $type, PDO::PARAM_STR);
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
	 * Get value a field by PrimaryKey (seoInfoId)
	 * Example
	 * getValueByPrimaryKey('seoInfoName', 1)
	 * Get value of filed seoInfoName in table seoInfo where seoInfoId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$seoInfoVo = $this->selectByPrimaryKey($primaryValue);
		if($seoInfoVo){
			return $seoInfoVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('seoInfoName', array('seoInfoId' => 1))
	 * Get value of filed seoInfoName in table seoInfo where seoInfoId = 1
	 */
	public function getValueByField($fieldName, $where){
		$seoInfoVo = new SeoInfoVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$seoInfoVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$seoInfoVos = $this->selectByFilter($seoInfoVo);
       
		if($seoInfoVos){
			$seoInfoVo = $seoInfoVos[0];
			return $seoInfoVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table seo_info
	 *
	 * @param int $item_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($itemId){
		try {
		    $sql = "DELETE FROM `seo_info` where `item_id` = :itemId";
		    $params = array();
		    $params[] = array(':itemId', $itemId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table seo_info
	 *
	 * @param object $seoInfoVo
	 * @return boolean
	 */
	public function deleteByFilter($seoInfoVo){
		try {
			$sql = 'DELETE FROM `seo_info`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($seoInfoVo->itemId)){
				$isDel = true;
				$condition[] = '`item_id` = :itemId';
				$params[] = array(':itemId', $seoInfoVo->itemId, PDO::PARAM_INT);
			}
			if (!is_null($seoInfoVo->type)){
				$isDel = true;
				$condition[] = '`type` = :type';
				$params[] = array(':type', $seoInfoVo->type, PDO::PARAM_STR);
			}
			if (!is_null($seoInfoVo->url)){
				$isDel = true;
				$condition[] = '`url` = :url';
				$params[] = array(':url', $seoInfoVo->url, PDO::PARAM_STR);
			}
			if (!is_null($seoInfoVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $seoInfoVo->title, PDO::PARAM_STR);
			}
			if (!is_null($seoInfoVo->keyword)){
				$isDel = true;
				$condition[] = '`keyword` = :keyword';
				$params[] = array(':keyword', $seoInfoVo->keyword, PDO::PARAM_STR);
			}
			if (!is_null($seoInfoVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $seoInfoVo->description, PDO::PARAM_STR);
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
