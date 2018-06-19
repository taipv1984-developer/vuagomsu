<?php
class NewsCategoryDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `news_category`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsCategoryVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($newsCategoryId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `news_category` where `news_category_id` = :newsCategoryId");
$stmt->bindParam(':newsCategoryId',$newsCategoryId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsCategoryVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsCategoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_category`( `name`, `parent_id`, `image`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :name, :parentId, :image, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':name', $newsCategoryVo->name, PDO::PARAM_STR);
$stmt->bindParam(':parentId', $newsCategoryVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':image', $newsCategoryVo->image, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $newsCategoryVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsCategoryVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $newsCategoryVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $newsCategoryVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsCategoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `news_category`( `name`, `parent_id`, `image`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :name, :parentId, :image, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':name', $newsCategoryVo->name, PDO::PARAM_STR);
$stmt->bindParam(':parentId', $newsCategoryVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':image', $newsCategoryVo->image, PDO::PARAM_STR);
$stmt->bindParam(':crtDate', $newsCategoryVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsCategoryVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $newsCategoryVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $newsCategoryVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table news_category by $newsCategoryVo object filter use paging
 * 
 * @param object $newsCategoryVo is news_category object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsCategoryVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsCategoryVo)) $newsCategoryVo = new NewsCategoryVo();
$sql = "select * from `news_category` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsCategoryVo->newsCategoryId)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->newsCategoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_category_id` $key :newsCategoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_category_id` $key :newsCategoryIdKey";
}
if($type == 'str') {
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_category_id` =  :newsCategoryIdKey';
$isFirst=false;
}else{
$condition.=' and `news_category_id` =  :newsCategoryIdKey';
}
$params[]=array(':newsCategoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsCategoryVo->name)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->name;
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

if (!is_null($newsCategoryVo->parentId)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->parentId;
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

if (!is_null($newsCategoryVo->image)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCategoryVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->crtDate;
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

if (!is_null($newsCategoryVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->crtBy;
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

if (!is_null($newsCategoryVo->modDate)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->modDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_date` $key :modDateKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_date` $key :modDateKey";
}
if($type == 'str') {
    $params[] = array(':modDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_date` =  :modDateKey';
$isFirst=false;
}else{
$condition.=' and `mod_date` =  :modDateKey';
}
$params[]=array(':modDateKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCategoryVo->modBy)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->modBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_by` $key :modByKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_by` $key :modByKey";
}
if($type == 'str') {
    $params[] = array(':modByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_by` =  :modByKey';
$isFirst=false;
}else{
$condition.=' and `mod_by` =  :modByKey';
}
$params[]=array(':modByKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('NewsCategoryVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsCategoryVo){
try {
if (empty($newsCategoryVo)) $newsCategoryVo = new NewsCategoryVo();
$sql = "select count(*) as total from  news_category ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsCategoryVo->newsCategoryId)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->newsCategoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `news_category_id` $key :newsCategoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `news_category_id` $key :newsCategoryIdKey";
}
if($type == 'str') {
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsCategoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `news_category_id` =  :newsCategoryIdKey';
$isFirst=false;
}else{
$condition.=' and `news_category_id` =  :newsCategoryIdKey';
}
$params[]=array(':newsCategoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsCategoryVo->name)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->name;
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

if (!is_null($newsCategoryVo->parentId)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->parentId;
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

if (!is_null($newsCategoryVo->image)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCategoryVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->crtDate;
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

if (!is_null($newsCategoryVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->crtBy;
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

if (!is_null($newsCategoryVo->modDate)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->modDate;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_date` $key :modDateKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_date` $key :modDateKey";
}
if($type == 'str') {
    $params[] = array(':modDateKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modDateKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_date` =  :modDateKey';
$isFirst=false;
}else{
$condition.=' and `mod_date` =  :modDateKey';
}
$params[]=array(':modDateKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsCategoryVo->modBy)){ //If isset Vo->element
$fieldValue=$newsCategoryVo->modBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_by` $key :modByKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_by` $key :modByKey";
}
if($type == 'str') {
    $params[] = array(':modByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_by` =  :modByKey';
$isFirst=false;
}else{
$condition.=' and `mod_by` =  :modByKey';
}
$params[]=array(':modByKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($newsCategoryVo,$newsCategoryId){
try {
$sql="UPDATE `news_category` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsCategoryVo->newsCategoryId)){
if ($isFirst){
$updateFields.=' `news_category_id`= :newsCategoryId';
$isFirst=false;}else{
$updateFields.=', `news_category_id`= :newsCategoryId';
}
$params[]=array(':newsCategoryId', $newsCategoryVo->newsCategoryId, PDO::PARAM_INT);
}

if (isset($newsCategoryVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $newsCategoryVo->name, PDO::PARAM_STR);
}

if (isset($newsCategoryVo->parentId)){
if ($isFirst){
$updateFields.=' `parent_id`= :parentId';
$isFirst=false;}else{
$updateFields.=', `parent_id`= :parentId';
}
$params[]=array(':parentId', $newsCategoryVo->parentId, PDO::PARAM_INT);
}

if (isset($newsCategoryVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $newsCategoryVo->image, PDO::PARAM_STR);
}

if (isset($newsCategoryVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $newsCategoryVo->crtDate, PDO::PARAM_STR);
}

if (isset($newsCategoryVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $newsCategoryVo->crtBy, PDO::PARAM_INT);
}

if (isset($newsCategoryVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $newsCategoryVo->modDate, PDO::PARAM_STR);
}

if (isset($newsCategoryVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $newsCategoryVo->modBy, PDO::PARAM_INT);
}

$conditions.=' where `news_category_id`= :newsCategoryId';
$params[]=array(':newsCategoryId', $newsCategoryId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsCategoryId)
	 * Example
	 * getValueByPrimaryKey('newsCategoryName', 1)
	 * Get value of filed newsCategoryName in table newsCategory where newsCategoryId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsCategoryVo = $this->selectByPrimaryKey($primaryValue);
		if($newsCategoryVo){
			return $newsCategoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsCategoryName', array('newsCategoryId' => 1))
	 * Get value of filed newsCategoryName in table newsCategory where newsCategoryId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsCategoryVo = new NewsCategoryVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsCategoryVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsCategoryVos = $this->selectByFilter($newsCategoryVo);
       
		if($newsCategoryVos){
			$newsCategoryVo = $newsCategoryVos[0];
			return $newsCategoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table news_category
	 *
	 * @param int $news_category_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($newsCategoryId){
		try {
		    $sql = "DELETE FROM `news_category` where `news_category_id` = :newsCategoryId";
		    $params = array();
		    $params[] = array(':newsCategoryId', $newsCategoryId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table news_category
	 *
	 * @param object $newsCategoryVo
	 * @return boolean
	 */
	public function deleteByFilter($newsCategoryVo){
		try {
			$sql = 'DELETE FROM `news_category`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsCategoryVo->newsCategoryId)){
				$isDel = true;
				$condition[] = '`news_category_id` = :newsCategoryId';
				$params[] = array(':newsCategoryId', $newsCategoryVo->newsCategoryId, PDO::PARAM_INT);
			}
			if (!is_null($newsCategoryVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $newsCategoryVo->name, PDO::PARAM_STR);
			}
			if (!is_null($newsCategoryVo->parentId)){
				$isDel = true;
				$condition[] = '`parent_id` = :parentId';
				$params[] = array(':parentId', $newsCategoryVo->parentId, PDO::PARAM_INT);
			}
			if (!is_null($newsCategoryVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $newsCategoryVo->image, PDO::PARAM_STR);
			}
			if (!is_null($newsCategoryVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $newsCategoryVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($newsCategoryVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $newsCategoryVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($newsCategoryVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $newsCategoryVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($newsCategoryVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $newsCategoryVo->modBy, PDO::PARAM_INT);
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
