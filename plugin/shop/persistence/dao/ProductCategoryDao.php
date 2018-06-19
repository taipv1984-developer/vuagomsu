<?php
class ProductCategoryDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_category`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductCategoryVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productId, $categoryId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_category` where `product_id` = :productId and `category_id` = :categoryId");
$stmt->bindParam(':productId',$productId, PDO::PARAM_INT);
$stmt->bindParam(':categoryId',$categoryId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductCategoryVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productCategoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_category`( `product_id`, `category_id`, `is_primary`)
VALUES( :productId, :categoryId, :isPrimary)");
$stmt->bindParam(':productId', $productCategoryVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':categoryId', $productCategoryVo->categoryId, PDO::PARAM_INT);
$stmt->bindParam(':isPrimary', $productCategoryVo->isPrimary, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productCategoryVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_category`( `product_id`, `category_id`, `is_primary`)
VALUES( :productId, :categoryId, :isPrimary)");
$stmt->bindParam(':productId', $productCategoryVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':categoryId', $productCategoryVo->categoryId, PDO::PARAM_INT);
$stmt->bindParam(':isPrimary', $productCategoryVo->isPrimary, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_category by $productCategoryVo object filter use paging
 * 
 * @param object $productCategoryVo is product_category object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productCategoryVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productCategoryVo)) $productCategoryVo = new ProductCategoryVo();
$sql = "select * from `product_category` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productCategoryVo->productId)){ //If isset Vo->element
$fieldValue=$productCategoryVo->productId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_id` $key :productIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_id` $key :productIdKey";
}
if($type == 'str') {
    $params[] = array(':productIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_id` =  :productIdKey';
$isFirst=false;
}else{
$condition.=' and `product_id` =  :productIdKey';
}
$params[]=array(':productIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productCategoryVo->categoryId)){ //If isset Vo->element
$fieldValue=$productCategoryVo->categoryId;
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

if (!is_null($productCategoryVo->isPrimary)){ //If isset Vo->element
$fieldValue=$productCategoryVo->isPrimary;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_primary` $key :isPrimaryKey";
    $isFirst = false;
} else {
    $condition .= " and `is_primary` $key :isPrimaryKey";
}
if($type == 'str') {
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_primary` =  :isPrimaryKey';
$isFirst=false;
}else{
$condition.=' and `is_primary` =  :isPrimaryKey';
}
$params[]=array(':isPrimaryKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('ProductCategoryVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productCategoryVo){
try {
if (empty($productCategoryVo)) $productCategoryVo = new ProductCategoryVo();
$sql = "select count(*) as total from  product_category ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productCategoryVo->productId)){ //If isset Vo->element
$fieldValue=$productCategoryVo->productId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_id` $key :productIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_id` $key :productIdKey";
}
if($type == 'str') {
    $params[] = array(':productIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_id` =  :productIdKey';
$isFirst=false;
}else{
$condition.=' and `product_id` =  :productIdKey';
}
$params[]=array(':productIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productCategoryVo->categoryId)){ //If isset Vo->element
$fieldValue=$productCategoryVo->categoryId;
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

if (!is_null($productCategoryVo->isPrimary)){ //If isset Vo->element
$fieldValue=$productCategoryVo->isPrimary;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_primary` $key :isPrimaryKey";
    $isFirst = false;
} else {
    $condition .= " and `is_primary` $key :isPrimaryKey";
}
if($type == 'str') {
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_primary` =  :isPrimaryKey';
$isFirst=false;
}else{
$condition.=' and `is_primary` =  :isPrimaryKey';
}
$params[]=array(':isPrimaryKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($productCategoryVo,$productId, $categoryId){
try {
$sql="UPDATE `product_category` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productCategoryVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productCategoryVo->productId, PDO::PARAM_INT);
}

if (isset($productCategoryVo->categoryId)){
if ($isFirst){
$updateFields.=' `category_id`= :categoryId';
$isFirst=false;}else{
$updateFields.=', `category_id`= :categoryId';
}
$params[]=array(':categoryId', $productCategoryVo->categoryId, PDO::PARAM_INT);
}

if (isset($productCategoryVo->isPrimary)){
if ($isFirst){
$updateFields.=' `is_primary`= :isPrimary';
$isFirst=false;}else{
$updateFields.=', `is_primary`= :isPrimary';
}
$params[]=array(':isPrimary', $productCategoryVo->isPrimary, PDO::PARAM_INT);
}

$conditions.=' where `product_id`= :productId';
$params[]=array(':productId', $productId, PDO::PARAM_INT);
$conditions.=' and `category_id`= :categoryId';
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
	 * Get value a field by PrimaryKey (productCategoryId)
	 * Example
	 * getValueByPrimaryKey('productCategoryName', 1)
	 * Get value of filed productCategoryName in table productCategory where productCategoryId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productCategoryVo = $this->selectByPrimaryKey($primaryValue);
		if($productCategoryVo){
			return $productCategoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productCategoryName', array('productCategoryId' => 1))
	 * Get value of filed productCategoryName in table productCategory where productCategoryId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productCategoryVo = new ProductCategoryVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productCategoryVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productCategoryVos = $this->selectByFilter($productCategoryVo);
       
		if($productCategoryVos){
			$productCategoryVo = $productCategoryVos[0];
			return $productCategoryVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_category
	 *
	 * @param int $product_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productId){
		try {
		    $sql = "DELETE FROM `product_category` where `product_id` = :productId";
		    $params = array();
		    $params[] = array(':productId', $productId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_category
	 *
	 * @param object $productCategoryVo
	 * @return boolean
	 */
	public function deleteByFilter($productCategoryVo){
		try {
			$sql = 'DELETE FROM `product_category`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productCategoryVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productCategoryVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productCategoryVo->categoryId)){
				$isDel = true;
				$condition[] = '`category_id` = :categoryId';
				$params[] = array(':categoryId', $productCategoryVo->categoryId, PDO::PARAM_INT);
			}
			if (!is_null($productCategoryVo->isPrimary)){
				$isDel = true;
				$condition[] = '`is_primary` = :isPrimary';
				$params[] = array(':isPrimary', $productCategoryVo->isPrimary, PDO::PARAM_INT);
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
