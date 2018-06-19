<?php
class CategoryDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `category`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CategoryVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($categoryId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `category` where `category_id` = :categoryId");
$stmt->bindParam(':categoryId',$categoryId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CategoryVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($categoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `category`( `name`, `description`, `parent_id`, `image`, `icon`)
VALUES( :name, :description, :parentId, :image, :icon)");
$stmt->bindParam(':name', $categoryVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $categoryVo->description, PDO::PARAM_STR);
$stmt->bindParam(':parentId', $categoryVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':image', $categoryVo->image, PDO::PARAM_STR);
$stmt->bindParam(':icon', $categoryVo->icon, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($categoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `category`( `name`, `description`, `parent_id`, `image`, `icon`)
VALUES( :name, :description, :parentId, :image, :icon)");
$stmt->bindParam(':name', $categoryVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $categoryVo->description, PDO::PARAM_STR);
$stmt->bindParam(':parentId', $categoryVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':image', $categoryVo->image, PDO::PARAM_STR);
$stmt->bindParam(':icon', $categoryVo->icon, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table category by $categoryVo object filter use paging
 * 
 * @param object $categoryVo is category object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($categoryVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($categoryVo)) $categoryVo = new CategoryVo();
$sql = "select * from `category` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($categoryVo->categoryId)){ //If isset Vo->element
$fieldValue=$categoryVo->categoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `category_id` $key :categoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `category_id` $key :categoryIdKey";
}
if($type == 'str') {
    $params[] = array(':categoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':categoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `category_id` =  :categoryIdKey';
$isFirst=false;
}else{
$condition.=' and `category_id` =  :categoryIdKey';
}
$params[]=array(':categoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($categoryVo->name)){ //If isset Vo->element
$fieldValue=$categoryVo->name;
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

if (!is_null($categoryVo->description)){ //If isset Vo->element
$fieldValue=$categoryVo->description;
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

if (!is_null($categoryVo->parentId)){ //If isset Vo->element
$fieldValue=$categoryVo->parentId;
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

if (!is_null($categoryVo->image)){ //If isset Vo->element
$fieldValue=$categoryVo->image;
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

if (!is_null($categoryVo->icon)){ //If isset Vo->element
$fieldValue=$categoryVo->icon;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `icon` $key :iconKey";
    $isFirst = false;
} else {
    $condition .= " and `icon` $key :iconKey";
}
if($type == 'str') {
    $params[] = array(':iconKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':iconKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `icon` =  :iconKey';
$isFirst=false;
}else{
$condition.=' and `icon` =  :iconKey';
}
$params[]=array(':iconKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('CategoryVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($categoryVo){
try {
if (empty($categoryVo)) $categoryVo = new CategoryVo();
$sql = "select count(*) as total from  category ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($categoryVo->categoryId)){ //If isset Vo->element
$fieldValue=$categoryVo->categoryId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `category_id` $key :categoryIdKey";
    $isFirst = false;
} else {
    $condition .= " and `category_id` $key :categoryIdKey";
}
if($type == 'str') {
    $params[] = array(':categoryIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':categoryIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `category_id` =  :categoryIdKey';
$isFirst=false;
}else{
$condition.=' and `category_id` =  :categoryIdKey';
}
$params[]=array(':categoryIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($categoryVo->name)){ //If isset Vo->element
$fieldValue=$categoryVo->name;
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

if (!is_null($categoryVo->description)){ //If isset Vo->element
$fieldValue=$categoryVo->description;
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

if (!is_null($categoryVo->parentId)){ //If isset Vo->element
$fieldValue=$categoryVo->parentId;
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

if (!is_null($categoryVo->image)){ //If isset Vo->element
$fieldValue=$categoryVo->image;
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

if (!is_null($categoryVo->icon)){ //If isset Vo->element
$fieldValue=$categoryVo->icon;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `icon` $key :iconKey";
    $isFirst = false;
} else {
    $condition .= " and `icon` $key :iconKey";
}
if($type == 'str') {
    $params[] = array(':iconKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':iconKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `icon` =  :iconKey';
$isFirst=false;
}else{
$condition.=' and `icon` =  :iconKey';
}
$params[]=array(':iconKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($categoryVo,$categoryId){
try {
$sql="UPDATE `category` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($categoryVo->categoryId)){
if ($isFirst){
$updateFields.=' `category_id`= :categoryId';
$isFirst=false;}else{
$updateFields.=', `category_id`= :categoryId';
}
$params[]=array(':categoryId', $categoryVo->categoryId, PDO::PARAM_INT);
}

if (isset($categoryVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $categoryVo->name, PDO::PARAM_STR);
}

if (isset($categoryVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $categoryVo->description, PDO::PARAM_STR);
}

if (isset($categoryVo->parentId)){
if ($isFirst){
$updateFields.=' `parent_id`= :parentId';
$isFirst=false;}else{
$updateFields.=', `parent_id`= :parentId';
}
$params[]=array(':parentId', $categoryVo->parentId, PDO::PARAM_INT);
}

if (isset($categoryVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $categoryVo->image, PDO::PARAM_STR);
}

if (isset($categoryVo->icon)){
if ($isFirst){
$updateFields.=' `icon`= :icon';
$isFirst=false;}else{
$updateFields.=', `icon`= :icon';
}
$params[]=array(':icon', $categoryVo->icon, PDO::PARAM_STR);
}

$conditions.=' where `category_id`= :categoryId';
$params[]=array(':categoryId', $categoryId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (categoryId)
	 * Example
	 * getValueByPrimaryKey('categoryName', 1)
	 * Get value of filed categoryName in table category where categoryId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$categoryVo = $this->selectByPrimaryKey($primaryValue);
		if($categoryVo){
			return $categoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('categoryName', array('categoryId' => 1))
	 * Get value of filed categoryName in table category where categoryId = 1
	 */
	public function getValueByField($fieldName, $where){
		$categoryVo = new CategoryVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$categoryVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$categoryVos = $this->selectByFilter($categoryVo);
       
		if($categoryVos){
			$categoryVo = $categoryVos[0];
			return $categoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table category
	 *
	 * @param int $category_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($categoryId){
		try {
		    $sql = "DELETE FROM `category` where `category_id` = :categoryId";
		    $params = array();
		    $params[] = array(':categoryId', $categoryId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table category
	 *
	 * @param object $categoryVo
	 * @return boolean
	 */
	public function deleteByFilter($categoryVo){
		try {
			$sql = 'DELETE FROM `category`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($categoryVo->categoryId)){
				$isDel = true;
				$condition[] = '`category_id` = :categoryId';
				$params[] = array(':categoryId', $categoryVo->categoryId, PDO::PARAM_INT);
			}
			if (!is_null($categoryVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $categoryVo->name, PDO::PARAM_STR);
			}
			if (!is_null($categoryVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $categoryVo->description, PDO::PARAM_STR);
			}
			if (!is_null($categoryVo->parentId)){
				$isDel = true;
				$condition[] = '`parent_id` = :parentId';
				$params[] = array(':parentId', $categoryVo->parentId, PDO::PARAM_INT);
			}
			if (!is_null($categoryVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $categoryVo->image, PDO::PARAM_STR);
			}
			if (!is_null($categoryVo->icon)){
				$isDel = true;
				$condition[] = '`icon` = :icon';
				$params[] = array(':icon', $categoryVo->icon, PDO::PARAM_STR);
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
