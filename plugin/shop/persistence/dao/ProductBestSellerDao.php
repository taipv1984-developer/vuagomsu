<?php
class ProductBestSellerDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_best_seller`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductBestSellerVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productBestSellerId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_best_seller` where `product_best_seller_id` = :productBestSellerId");
$stmt->bindParam(':productBestSellerId',$productBestSellerId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductBestSellerVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productBestSellerVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_best_seller`( `product_id`, `order`, `status`)
VALUES( :productId, :order, :status)");
$stmt->bindParam(':productId', $productBestSellerVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':order', $productBestSellerVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $productBestSellerVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productBestSellerVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_best_seller`( `product_id`, `order`, `status`)
VALUES( :productId, :order, :status)");
$stmt->bindParam(':productId', $productBestSellerVo->productId, PDO::PARAM_INT);
$stmt->bindParam(':order', $productBestSellerVo->order, PDO::PARAM_INT);
$stmt->bindParam(':status', $productBestSellerVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_best_seller by $productBestSellerVo object filter use paging
 * 
 * @param object $productBestSellerVo is product_best_seller object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productBestSellerVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productBestSellerVo)) $productBestSellerVo = new ProductBestSellerVo();
$sql = "select * from `product_best_seller` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productBestSellerVo->productBestSellerId)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->productBestSellerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_best_seller_id` $key :productBestSellerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_best_seller_id` $key :productBestSellerIdKey";
}
if($type == 'str') {
    $params[] = array(':productBestSellerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productBestSellerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_best_seller_id` =  :productBestSellerIdKey';
$isFirst=false;
}else{
$condition.=' and `product_best_seller_id` =  :productBestSellerIdKey';
}
$params[]=array(':productBestSellerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productBestSellerVo->productId)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->productId;
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

if (!is_null($productBestSellerVo->order)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->order;
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

if (!is_null($productBestSellerVo->status)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->status;
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
return PersistentHelper::mapResult('ProductBestSellerVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productBestSellerVo){
try {
if (empty($productBestSellerVo)) $productBestSellerVo = new ProductBestSellerVo();
$sql = "select count(*) as total from  product_best_seller ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productBestSellerVo->productBestSellerId)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->productBestSellerId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_best_seller_id` $key :productBestSellerIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_best_seller_id` $key :productBestSellerIdKey";
}
if($type == 'str') {
    $params[] = array(':productBestSellerIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productBestSellerIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_best_seller_id` =  :productBestSellerIdKey';
$isFirst=false;
}else{
$condition.=' and `product_best_seller_id` =  :productBestSellerIdKey';
}
$params[]=array(':productBestSellerIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productBestSellerVo->productId)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->productId;
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

if (!is_null($productBestSellerVo->order)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->order;
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

if (!is_null($productBestSellerVo->status)){ //If isset Vo->element
$fieldValue=$productBestSellerVo->status;
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


public function updateByPrimaryKey($productBestSellerVo,$productBestSellerId){
try {
$sql="UPDATE `product_best_seller` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productBestSellerVo->productBestSellerId)){
if ($isFirst){
$updateFields.=' `product_best_seller_id`= :productBestSellerId';
$isFirst=false;}else{
$updateFields.=', `product_best_seller_id`= :productBestSellerId';
}
$params[]=array(':productBestSellerId', $productBestSellerVo->productBestSellerId, PDO::PARAM_INT);
}

if (isset($productBestSellerVo->productId)){
if ($isFirst){
$updateFields.=' `product_id`= :productId';
$isFirst=false;}else{
$updateFields.=', `product_id`= :productId';
}
$params[]=array(':productId', $productBestSellerVo->productId, PDO::PARAM_INT);
}

if (isset($productBestSellerVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $productBestSellerVo->order, PDO::PARAM_INT);
}

if (isset($productBestSellerVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $productBestSellerVo->status, PDO::PARAM_STR);
}

$conditions.=' where `product_best_seller_id`= :productBestSellerId';
$params[]=array(':productBestSellerId', $productBestSellerId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productBestSellerId)
	 * Example
	 * getValueByPrimaryKey('productBestSellerName', 1)
	 * Get value of filed productBestSellerName in table productBestSeller where productBestSellerId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productBestSellerVo = $this->selectByPrimaryKey($primaryValue);
		if($productBestSellerVo){
			return $productBestSellerVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productBestSellerName', array('productBestSellerId' => 1))
	 * Get value of filed productBestSellerName in table productBestSeller where productBestSellerId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productBestSellerVo = new ProductBestSellerVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productBestSellerVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productBestSellerVos = $this->selectByFilter($productBestSellerVo);
       
		if($productBestSellerVos){
			$productBestSellerVo = $productBestSellerVos[0];
			return $productBestSellerVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_best_seller
	 *
	 * @param int $product_best_seller_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productBestSellerId){
		try {
		    $sql = "DELETE FROM `product_best_seller` where `product_best_seller_id` = :productBestSellerId";
		    $params = array();
		    $params[] = array(':productBestSellerId', $productBestSellerId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_best_seller
	 *
	 * @param object $productBestSellerVo
	 * @return boolean
	 */
	public function deleteByFilter($productBestSellerVo){
		try {
			$sql = 'DELETE FROM `product_best_seller`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productBestSellerVo->productBestSellerId)){
				$isDel = true;
				$condition[] = '`product_best_seller_id` = :productBestSellerId';
				$params[] = array(':productBestSellerId', $productBestSellerVo->productBestSellerId, PDO::PARAM_INT);
			}
			if (!is_null($productBestSellerVo->productId)){
				$isDel = true;
				$condition[] = '`product_id` = :productId';
				$params[] = array(':productId', $productBestSellerVo->productId, PDO::PARAM_INT);
			}
			if (!is_null($productBestSellerVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $productBestSellerVo->order, PDO::PARAM_INT);
			}
			if (!is_null($productBestSellerVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $productBestSellerVo->status, PDO::PARAM_STR);
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
