<?php
class ProductSearchDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `product_search`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('ProductSearchVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($productSearchId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `product_search` where `product_search_id` = :productSearchId");
$stmt->bindParam(':productSearchId',$productSearchId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('ProductSearchVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($productSearchVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_search`( `key`, `count`, `status`, `order`, `crt_date`, `mod_date`)
VALUES( :key, :count, :status, :order, :crtDate, :modDate)");
$stmt->bindParam(':key', $productSearchVo->key, PDO::PARAM_STR);
$stmt->bindParam(':count', $productSearchVo->count, PDO::PARAM_INT);
$stmt->bindParam(':status', $productSearchVo->status, PDO::PARAM_STR);
$stmt->bindParam(':order', $productSearchVo->order, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $productSearchVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':modDate', $productSearchVo->modDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($productSearchVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `product_search`( `key`, `count`, `status`, `order`, `crt_date`, `mod_date`)
VALUES( :key, :count, :status, :order, :crtDate, :modDate)");
$stmt->bindParam(':key', $productSearchVo->key, PDO::PARAM_STR);
$stmt->bindParam(':count', $productSearchVo->count, PDO::PARAM_INT);
$stmt->bindParam(':status', $productSearchVo->status, PDO::PARAM_STR);
$stmt->bindParam(':order', $productSearchVo->order, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $productSearchVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':modDate', $productSearchVo->modDate, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table product_search by $productSearchVo object filter use paging
 * 
 * @param object $productSearchVo is product_search object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($productSearchVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($productSearchVo)) $productSearchVo = new ProductSearchVo();
$sql = "select * from `product_search` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productSearchVo->productSearchId)){ //If isset Vo->element
$fieldValue=$productSearchVo->productSearchId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_search_id` $key :productSearchIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_search_id` $key :productSearchIdKey";
}
if($type == 'str') {
    $params[] = array(':productSearchIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productSearchIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_search_id` =  :productSearchIdKey';
$isFirst=false;
}else{
$condition.=' and `product_search_id` =  :productSearchIdKey';
}
$params[]=array(':productSearchIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productSearchVo->key)){ //If isset Vo->element
$fieldValue=$productSearchVo->key;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `key` $key :keyKey";
    $isFirst = false;
} else {
    $condition .= " and `key` $key :keyKey";
}
if($type == 'str') {
    $params[] = array(':keyKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':keyKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `key` =  :keyKey';
$isFirst=false;
}else{
$condition.=' and `key` =  :keyKey';
}
$params[]=array(':keyKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productSearchVo->count)){ //If isset Vo->element
$fieldValue=$productSearchVo->count;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `count` $key :countKey";
    $isFirst = false;
} else {
    $condition .= " and `count` $key :countKey";
}
if($type == 'str') {
    $params[] = array(':countKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `count` =  :countKey';
$isFirst=false;
}else{
$condition.=' and `count` =  :countKey';
}
$params[]=array(':countKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productSearchVo->status)){ //If isset Vo->element
$fieldValue=$productSearchVo->status;
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

if (!is_null($productSearchVo->order)){ //If isset Vo->element
$fieldValue=$productSearchVo->order;
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

if (!is_null($productSearchVo->crtDate)){ //If isset Vo->element
$fieldValue=$productSearchVo->crtDate;
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

if (!is_null($productSearchVo->modDate)){ //If isset Vo->element
$fieldValue=$productSearchVo->modDate;
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
return PersistentHelper::mapResult('ProductSearchVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($productSearchVo){
try {
if (empty($productSearchVo)) $productSearchVo = new ProductSearchVo();
$sql = "select count(*) as total from  product_search ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($productSearchVo->productSearchId)){ //If isset Vo->element
$fieldValue=$productSearchVo->productSearchId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `product_search_id` $key :productSearchIdKey";
    $isFirst = false;
} else {
    $condition .= " and `product_search_id` $key :productSearchIdKey";
}
if($type == 'str') {
    $params[] = array(':productSearchIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':productSearchIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `product_search_id` =  :productSearchIdKey';
$isFirst=false;
}else{
$condition.=' and `product_search_id` =  :productSearchIdKey';
}
$params[]=array(':productSearchIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productSearchVo->key)){ //If isset Vo->element
$fieldValue=$productSearchVo->key;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `key` $key :keyKey";
    $isFirst = false;
} else {
    $condition .= " and `key` $key :keyKey";
}
if($type == 'str') {
    $params[] = array(':keyKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':keyKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `key` =  :keyKey';
$isFirst=false;
}else{
$condition.=' and `key` =  :keyKey';
}
$params[]=array(':keyKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($productSearchVo->count)){ //If isset Vo->element
$fieldValue=$productSearchVo->count;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `count` $key :countKey";
    $isFirst = false;
} else {
    $condition .= " and `count` $key :countKey";
}
if($type == 'str') {
    $params[] = array(':countKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':countKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `count` =  :countKey';
$isFirst=false;
}else{
$condition.=' and `count` =  :countKey';
}
$params[]=array(':countKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($productSearchVo->status)){ //If isset Vo->element
$fieldValue=$productSearchVo->status;
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

if (!is_null($productSearchVo->order)){ //If isset Vo->element
$fieldValue=$productSearchVo->order;
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

if (!is_null($productSearchVo->crtDate)){ //If isset Vo->element
$fieldValue=$productSearchVo->crtDate;
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

if (!is_null($productSearchVo->modDate)){ //If isset Vo->element
$fieldValue=$productSearchVo->modDate;
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


public function updateByPrimaryKey($productSearchVo,$productSearchId){
try {
$sql="UPDATE `product_search` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($productSearchVo->productSearchId)){
if ($isFirst){
$updateFields.=' `product_search_id`= :productSearchId';
$isFirst=false;}else{
$updateFields.=', `product_search_id`= :productSearchId';
}
$params[]=array(':productSearchId', $productSearchVo->productSearchId, PDO::PARAM_INT);
}

if (isset($productSearchVo->key)){
if ($isFirst){
$updateFields.=' `key`= :key';
$isFirst=false;}else{
$updateFields.=', `key`= :key';
}
$params[]=array(':key', $productSearchVo->key, PDO::PARAM_STR);
}

if (isset($productSearchVo->count)){
if ($isFirst){
$updateFields.=' `count`= :count';
$isFirst=false;}else{
$updateFields.=', `count`= :count';
}
$params[]=array(':count', $productSearchVo->count, PDO::PARAM_INT);
}

if (isset($productSearchVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $productSearchVo->status, PDO::PARAM_STR);
}

if (isset($productSearchVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $productSearchVo->order, PDO::PARAM_INT);
}

if (isset($productSearchVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $productSearchVo->crtDate, PDO::PARAM_STR);
}

if (isset($productSearchVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $productSearchVo->modDate, PDO::PARAM_STR);
}

$conditions.=' where `product_search_id`= :productSearchId';
$params[]=array(':productSearchId', $productSearchId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (productSearchId)
	 * Example
	 * getValueByPrimaryKey('productSearchName', 1)
	 * Get value of filed productSearchName in table productSearch where productSearchId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$productSearchVo = $this->selectByPrimaryKey($primaryValue);
		if($productSearchVo){
			return $productSearchVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('productSearchName', array('productSearchId' => 1))
	 * Get value of filed productSearchName in table productSearch where productSearchId = 1
	 */
	public function getValueByField($fieldName, $where){
		$productSearchVo = new ProductSearchVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$productSearchVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$productSearchVos = $this->selectByFilter($productSearchVo);
       
		if($productSearchVos){
			$productSearchVo = $productSearchVos[0];
			return $productSearchVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table product_search
	 *
	 * @param int $product_search_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($productSearchId){
		try {
		    $sql = "DELETE FROM `product_search` where `product_search_id` = :productSearchId";
		    $params = array();
		    $params[] = array(':productSearchId', $productSearchId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table product_search
	 *
	 * @param object $productSearchVo
	 * @return boolean
	 */
	public function deleteByFilter($productSearchVo){
		try {
			$sql = 'DELETE FROM `product_search`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($productSearchVo->productSearchId)){
				$isDel = true;
				$condition[] = '`product_search_id` = :productSearchId';
				$params[] = array(':productSearchId', $productSearchVo->productSearchId, PDO::PARAM_INT);
			}
			if (!is_null($productSearchVo->key)){
				$isDel = true;
				$condition[] = '`key` = :key';
				$params[] = array(':key', $productSearchVo->key, PDO::PARAM_STR);
			}
			if (!is_null($productSearchVo->count)){
				$isDel = true;
				$condition[] = '`count` = :count';
				$params[] = array(':count', $productSearchVo->count, PDO::PARAM_INT);
			}
			if (!is_null($productSearchVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $productSearchVo->status, PDO::PARAM_STR);
			}
			if (!is_null($productSearchVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $productSearchVo->order, PDO::PARAM_INT);
			}
			if (!is_null($productSearchVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $productSearchVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($productSearchVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $productSearchVo->modDate, PDO::PARAM_STR);
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
