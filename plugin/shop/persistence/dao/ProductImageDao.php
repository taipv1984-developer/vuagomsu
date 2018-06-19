<?php
class ProductImageDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_image`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductImageVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productImageId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_image` where `product_image_id` = :productImageId");
$stmt->bindParam(':productImageId',$productImageId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductImageVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productImageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_image`( `product_id`, `image`)
VALUES( :productId, :image)");
$stmt->bindParam(':productId', $productImageVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':image', $productImageVo->image, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productImageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_image`( `product_id`, `image`)
VALUES( :productId, :image)");
$stmt->bindParam(':productId', $productImageVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':image', $productImageVo->image, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_image by $productImageVo object filter use paging
 * 
 * @param object $productImageVo is product_image object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productImageVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productImageVo)) $productImageVo = new ProductImageVo();
$sql = "select * from `product_image` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productImageVo->productImageId)){ //If isset Vo->element
$fieldValue=$productImageVo->productImageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_image_id` $key :productImageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_image_id` $key :productImageIdKey";
}
if($type == 'str') {
    $params[] = array(':productImageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productImageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_image_id` =  :productImageIdKey';
$isFirst=false;
}else{
$condition.=' and `product_image_id` =  :productImageIdKey';
}
$params[]=array(':productImageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productImageVo->productId)){ //If isset Vo->element
$fieldValue=$productImageVo->productId;
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

if (!is_null($productImageVo->image)){ //If isset Vo->element
$fieldValue=$productImageVo->image;
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
return PersistentHelper::mapResult('ProductImageVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productImageVo){
try {
if (empty($productImageVo)) $productImageVo = new ProductImageVo();
$sql = "select count(*) as total from  product_image ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productImageVo->productImageId)){ //If isset Vo->element
$fieldValue=$productImageVo->productImageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_image_id` $key :productImageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_image_id` $key :productImageIdKey";
}
if($type == 'str') {
    $params[] = array(':productImageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productImageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_image_id` =  :productImageIdKey';
$isFirst=false;
}else{
$condition.=' and `product_image_id` =  :productImageIdKey';
}
$params[]=array(':productImageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productImageVo->productId)){ //If isset Vo->element
$fieldValue=$productImageVo->productId;
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

if (!is_null($productImageVo->image)){ //If isset Vo->element
$fieldValue=$productImageVo->image;
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


public function updateByPrimaryKey($productImageVo,$productImageId){
try {
$sql="UPDATE `product_image` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productImageVo->productImageId)){
if ($isFirst){
$updateFields.=' `product_image_id`= :productImageId';
$isFirst=false;}else{
$updateFields.=', `product_image_id`= :productImageId';
}
$params[]=array(':productImageId', $productImageVo->productImageId, PDO::PARAM_INT);
}

if (isset($productImageVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productImageVo->productId, PDO::PARAM_INT);
}

if (isset($productImageVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $productImageVo->image, PDO::PARAM_STR);
}

$conditions.=' where `product_image_id`= :productImageId';
$params[]=array(':productImageId', $productImageId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productImageId)
	 * Example
	 * getValueByPrimaryKey('productImageName', 1)
	 * Get value of filed productImageName in table productImage where productImageId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productImageVo = $this->selectByPrimaryKey($primaryValue);
		if($productImageVo){
			return $productImageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productImageName', array('productImageId' => 1))
	 * Get value of filed productImageName in table productImage where productImageId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productImageVo = new ProductImageVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productImageVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productImageVos = $this->selectByFilter($productImageVo);
       
		if($productImageVos){
			$productImageVo = $productImageVos[0];
			return $productImageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_image
	 *
	 * @param int $product_image_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productImageId){
		try {
		    $sql = "DELETE FROM `product_image` where `product_image_id` = :productImageId";
		    $params = array();
		    $params[] = array(':productImageId', $productImageId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_image
	 *
	 * @param object $productImageVo
	 * @return boolean
	 */
	public function deleteByFilter($productImageVo){
		try {
			$sql = 'DELETE FROM `product_image`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productImageVo->productImageId)){
				$isDel = true;
				$condition[] = '`product_image_id` = :productImageId';
				$params[] = array(':productImageId', $productImageVo->productImageId, PDO::PARAM_INT);
			}
			if (!is_null($productImageVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productImageVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productImageVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $productImageVo->image, PDO::PARAM_STR);
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
