<?php
class ProductFeatureDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_feature`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductFeatureVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productFeatureId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_feature` where `product_feature_id` = :productFeatureId");
$stmt->bindParam(':productFeatureId',$productFeatureId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductFeatureVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productFeatureVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_feature`( `product_id`, `order`, `status`)
VALUES( :productId, :order, :status)");
$stmt->bindParam(':productId', $productFeatureVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':order', $productFeatureVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $productFeatureVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productFeatureVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_feature`( `product_id`, `order`, `status`)
VALUES( :productId, :order, :status)");
$stmt->bindParam(':productId', $productFeatureVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':order', $productFeatureVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $productFeatureVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_feature by $productFeatureVo object filter use paging
 * 
 * @param object $productFeatureVo is product_feature object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productFeatureVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productFeatureVo)) $productFeatureVo = new ProductFeatureVo();
$sql = "select * from `product_feature` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productFeatureVo->productFeatureId)){ //If isset Vo->element
$fieldValue=$productFeatureVo->productFeatureId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_feature_id` $key :productFeatureIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_feature_id` $key :productFeatureIdKey";
}
if($type == 'str') {
    $params[] = array(':productFeatureIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productFeatureIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_feature_id` =  :productFeatureIdKey';
$isFirst=false;
}else{
$condition.=' and `product_feature_id` =  :productFeatureIdKey';
}
$params[]=array(':productFeatureIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productFeatureVo->productId)){ //If isset Vo->element
$fieldValue=$productFeatureVo->productId;
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

if (!is_null($productFeatureVo->order)){ //If isset Vo->element
$fieldValue=$productFeatureVo->order;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order` $key :orderKey";
    $isFirst = false;
} else {
    $condition .= " and `order` $key :orderKey";
}
if($type == 'str') {
    $params[] = array(':orderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order` =  :orderKey';
$isFirst=false;
}else{
$condition.=' and `order` =  :orderKey';
}
$params[]=array(':orderKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productFeatureVo->status)){ //If isset Vo->element
$fieldValue=$productFeatureVo->status;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `status` $key :statusKey";
    $isFirst = false;
} else {
    $condition .= " and `status` $key :statusKey";
}
if($type == 'str') {
    $params[] = array(':statusKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':statusKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `status` =  :statusKey';
$isFirst=false;
}else{
$condition.=' and `status` =  :statusKey';
}
$params[]=array(':statusKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('ProductFeatureVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productFeatureVo){
try {
if (empty($productFeatureVo)) $productFeatureVo = new ProductFeatureVo();
$sql = "select count(*) as total from  product_feature ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productFeatureVo->productFeatureId)){ //If isset Vo->element
$fieldValue=$productFeatureVo->productFeatureId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_feature_id` $key :productFeatureIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_feature_id` $key :productFeatureIdKey";
}
if($type == 'str') {
    $params[] = array(':productFeatureIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productFeatureIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_feature_id` =  :productFeatureIdKey';
$isFirst=false;
}else{
$condition.=' and `product_feature_id` =  :productFeatureIdKey';
}
$params[]=array(':productFeatureIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productFeatureVo->productId)){ //If isset Vo->element
$fieldValue=$productFeatureVo->productId;
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

if (!is_null($productFeatureVo->order)){ //If isset Vo->element
$fieldValue=$productFeatureVo->order;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `order` $key :orderKey";
    $isFirst = false;
} else {
    $condition .= " and `order` $key :orderKey";
}
if($type == 'str') {
    $params[] = array(':orderKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':orderKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `order` =  :orderKey';
$isFirst=false;
}else{
$condition.=' and `order` =  :orderKey';
}
$params[]=array(':orderKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productFeatureVo->status)){ //If isset Vo->element
$fieldValue=$productFeatureVo->status;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `status` $key :statusKey";
    $isFirst = false;
} else {
    $condition .= " and `status` $key :statusKey";
}
if($type == 'str') {
    $params[] = array(':statusKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':statusKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `status` =  :statusKey';
$isFirst=false;
}else{
$condition.=' and `status` =  :statusKey';
}
$params[]=array(':statusKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($productFeatureVo,$productFeatureId){
try {
$sql="UPDATE `product_feature` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productFeatureVo->productFeatureId)){
if ($isFirst){
$updateFields.=' `product_feature_id`= :productFeatureId';
$isFirst=false;}else{
$updateFields.=', `product_feature_id`= :productFeatureId';
}
$params[]=array(':productFeatureId', $productFeatureVo->productFeatureId, PDO::PARAM_INT);
}

if (isset($productFeatureVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productFeatureVo->productId, PDO::PARAM_INT);
}

if (isset($productFeatureVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $productFeatureVo->order, PDO::PARAM_INT);
}

if (isset($productFeatureVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $productFeatureVo->status, PDO::PARAM_STR);
}

$conditions.=' where `product_feature_id`= :productFeatureId';
$params[]=array(':productFeatureId', $productFeatureId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productFeatureId)
	 * Example
	 * getValueByPrimaryKey('productFeatureName', 1)
	 * Get value of filed productFeatureName in table productFeature where productFeatureId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productFeatureVo = $this->selectByPrimaryKey($primaryValue);
		if($productFeatureVo){
			return $productFeatureVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productFeatureName', array('productFeatureId' => 1))
	 * Get value of filed productFeatureName in table productFeature where productFeatureId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productFeatureVo = new ProductFeatureVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productFeatureVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productFeatureVos = $this->selectByFilter($productFeatureVo);
       
		if($productFeatureVos){
			$productFeatureVo = $productFeatureVos[0];
			return $productFeatureVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_feature
	 *
	 * @param int $product_feature_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productFeatureId){
		try {
		    $sql = "DELETE FROM `product_feature` where `product_feature_id` = :productFeatureId";
		    $params = array();
		    $params[] = array(':productFeatureId', $productFeatureId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_feature
	 *
	 * @param object $productFeatureVo
	 * @return boolean
	 */
	public function deleteByFilter($productFeatureVo){
		try {
			$sql = 'DELETE FROM `product_feature`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productFeatureVo->productFeatureId)){
				$isDel = true;
				$condition[] = '`product_feature_id` = :productFeatureId';
				$params[] = array(':productFeatureId', $productFeatureVo->productFeatureId, PDO::PARAM_INT);
			}
			if (!is_null($productFeatureVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productFeatureVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productFeatureVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $productFeatureVo->order, PDO::PARAM_INT);
			}
			if (!is_null($productFeatureVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $productFeatureVo->status, PDO::PARAM_STR);
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
