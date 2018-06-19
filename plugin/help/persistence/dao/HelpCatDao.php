<?php
class HelpCatDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `help_cat`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('HelpCatVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($helpCatId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `help_cat` where `help_cat_id` = :helpCatId");
$stmt->bindParam(':helpCatId',$helpCatId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('HelpCatVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($helpCatVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `help_cat`( `name`, `description`, `status`)
VALUES( :name, :description, :status)");
$stmt->bindParam(':name', $helpCatVo->name, PDO::PARAM_STR);
$stmt->bindParam(':description', $helpCatVo->description, PDO::PARAM_STR);
$stmt->bindParam(':status', $helpCatVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($helpCatVo){
try {
$params = [];
$sql = "INSERT INTO `help_cat` ( `name`, `description`, `status`) 
 VALUES( :name, :description, :status)";

$params[]=array(':name', $helpCatVo->name, PDO::PARAM_STR);
$params[]=array(':description', $helpCatVo->description, PDO::PARAM_STR);
$params[]=array(':status', $helpCatVo->status, PDO::PARAM_STR);

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
 * Get all item of table help_cat by $helpCatVo object filter use paging
 * 
 * @param object $helpCatVo is help_cat object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($helpCatVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($helpCatVo)) $helpCatVo = new HelpCatVo();
$sql = "select * from `help_cat` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($helpCatVo->helpCatId)){ //If isset Vo->element
$fieldValue=$helpCatVo->helpCatId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `help_cat_id` $key :helpCatIdKey";
    $isFirst = false;
} else {
    $condition .= " and `help_cat_id` $key :helpCatIdKey";
}
if($type == 'str') {
    $params[] = array(':helpCatIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':helpCatIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `help_cat_id` =  :helpCatIdKey';
$isFirst=false;
}else{
$condition.=' and `help_cat_id` =  :helpCatIdKey';
}
$params[]=array(':helpCatIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($helpCatVo->name)){ //If isset Vo->element
$fieldValue=$helpCatVo->name;
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

if (!is_null($helpCatVo->description)){ //If isset Vo->element
$fieldValue=$helpCatVo->description;
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

if (!is_null($helpCatVo->status)){ //If isset Vo->element
$fieldValue=$helpCatVo->status;
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
return PersistentHelper::mapResult('HelpCatVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($helpCatVo){
try {
if (empty($helpCatVo)) $helpCatVo = new HelpCatVo();
$sql = "select count(*) as total from  help_cat ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($helpCatVo->helpCatId)){ //If isset Vo->element
$fieldValue=$helpCatVo->helpCatId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `help_cat_id` $key :helpCatIdKey";
    $isFirst = false;
} else {
    $condition .= " and `help_cat_id` $key :helpCatIdKey";
}
if($type == 'str') {
    $params[] = array(':helpCatIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':helpCatIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `help_cat_id` =  :helpCatIdKey';
$isFirst=false;
}else{
$condition.=' and `help_cat_id` =  :helpCatIdKey';
}
$params[]=array(':helpCatIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($helpCatVo->name)){ //If isset Vo->element
$fieldValue=$helpCatVo->name;
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

if (!is_null($helpCatVo->description)){ //If isset Vo->element
$fieldValue=$helpCatVo->description;
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

if (!is_null($helpCatVo->status)){ //If isset Vo->element
$fieldValue=$helpCatVo->status;
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


public function updateByPrimaryKey($helpCatVo,$helpCatId){
try {
$sql="UPDATE `help_cat` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($helpCatVo->helpCatId)){
if ($isFirst){
$updateFields.=' `help_cat_id`= :helpCatId';
$isFirst=false;}else{
$updateFields.=', `help_cat_id`= :helpCatId';
}
$params[]=array(':helpCatId', $helpCatVo->helpCatId, PDO::PARAM_INT);
}

if (isset($helpCatVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $helpCatVo->name, PDO::PARAM_STR);
}

if (isset($helpCatVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $helpCatVo->description, PDO::PARAM_STR);
}

if (isset($helpCatVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $helpCatVo->status, PDO::PARAM_STR);
}

$conditions.=' where `help_cat_id`= :helpCatId';
$params[]=array(':helpCatId', $helpCatId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (helpCatId)
	 * Example
	 * getValueByPrimaryKey('helpCatName', 1)
	 * Get value of filed helpCatName in table helpCat where helpCatId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$helpCatVo = $this->selectByPrimaryKey($primaryValue);
		if($helpCatVo){
			return $helpCatVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('helpCatName', array('helpCatId' => 1))
	 * Get value of filed helpCatName in table helpCat where helpCatId = 1
	 */
	public function getValueByField($fieldName, $where){
		$helpCatVo = new HelpCatVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$helpCatVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$helpCatVos = $this->selectByFilter($helpCatVo);
       
		if($helpCatVos){
			$helpCatVo = $helpCatVos[0];
			return $helpCatVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table help_cat
	 *
	 * @param int $help_cat_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($helpCatId){
		try {
		    $sql = "DELETE FROM `help_cat` where `help_cat_id` = :helpCatId";
		    $params = array();
		    $params[] = array(':helpCatId', $helpCatId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table help_cat
	 *
	 * @param object $helpCatVo
	 * @return boolean
	 */
	public function deleteByFilter($helpCatVo){
		try {
			$sql = 'DELETE FROM `help_cat`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($helpCatVo->helpCatId)){
				$isDel = true;
				$condition[] = '`help_cat_id` = :helpCatId';
				$params[] = array(':helpCatId', $helpCatVo->helpCatId, PDO::PARAM_INT);
			}
			if (!is_null($helpCatVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $helpCatVo->name, PDO::PARAM_STR);
			}
			if (!is_null($helpCatVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $helpCatVo->description, PDO::PARAM_STR);
			}
			if (!is_null($helpCatVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $helpCatVo->status, PDO::PARAM_STR);
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
