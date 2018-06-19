<?php
class MenuDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `menu`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('MenuVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($menuId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `menu` where `menu_id` = :menuId");
$stmt->bindParam(':menuId',$menuId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('MenuVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($menuVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `menu`( `name`)
VALUES( :name)");
$stmt->bindParam(':name', $menuVo->name, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($menuVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `menu`( `name`)
VALUES( :name)");
$stmt->bindParam(':name', $menuVo->name, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table menu by $menuVo object filter use paging
 * 
 * @param object $menuVo is menu object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($menuVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($menuVo)) $menuVo = new MenuVo();
$sql = "select * from `menu` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($menuVo->menuId)){ //If isset Vo->element
$fieldValue=$menuVo->menuId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `menu_id` $key :menuIdKey";
    $isFirst = false;
} else {
    $condition .= " and `menu_id` $key :menuIdKey";
}
if($type == 'str') {
    $params[] = array(':menuIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':menuIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `menu_id` =  :menuIdKey';
$isFirst=false;
}else{
$condition.=' and `menu_id` =  :menuIdKey';
}
$params[]=array(':menuIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuVo->name)){ //If isset Vo->element
$fieldValue=$menuVo->name;
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
return PersistentHelper::mapResult('MenuVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($menuVo){
try {
if (empty($menuVo)) $menuVo = new MenuVo();
$sql = "select count(*) as total from  menu ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($menuVo->menuId)){ //If isset Vo->element
$fieldValue=$menuVo->menuId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `menu_id` $key :menuIdKey";
    $isFirst = false;
} else {
    $condition .= " and `menu_id` $key :menuIdKey";
}
if($type == 'str') {
    $params[] = array(':menuIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':menuIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `menu_id` =  :menuIdKey';
$isFirst=false;
}else{
$condition.=' and `menu_id` =  :menuIdKey';
}
$params[]=array(':menuIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($menuVo->name)){ //If isset Vo->element
$fieldValue=$menuVo->name;
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


public function updateByPrimaryKey($menuVo,$menuId){
try {
$sql="UPDATE `menu` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($menuVo->menuId)){
if ($isFirst){
$updateFields.=' `menu_id`= :menuId';
$isFirst=false;}else{
$updateFields.=', `menu_id`= :menuId';
}
$params[]=array(':menuId', $menuVo->menuId, PDO::PARAM_INT);
}

if (isset($menuVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $menuVo->name, PDO::PARAM_STR);
}

$conditions.=' where `menu_id`= :menuId';
$params[]=array(':menuId', $menuId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (menuId)
	 * Example
	 * getValueByPrimaryKey('menuName', 1)
	 * Get value of filed menuName in table menu where menuId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$menuVo = $this->selectByPrimaryKey($primaryValue);
		if($menuVo){
			return $menuVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('menuName', array('menuId' => 1))
	 * Get value of filed menuName in table menu where menuId = 1
	 */
	public function getValueByField($fieldName, $where){
		$menuVo = new MenuVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$menuVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$menuVos = $this->selectByFilter($menuVo);
       
		if($menuVos){
			$menuVo = $menuVos[0];
			return $menuVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table menu
	 *
	 * @param int $menu_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($menuId){
		try {
		    $sql = "DELETE FROM `menu` where `menu_id` = :menuId";
		    $params = array();
		    $params[] = array(':menuId', $menuId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table menu
	 *
	 * @param object $menuVo
	 * @return boolean
	 */
	public function deleteByFilter($menuVo){
		try {
			$sql = 'DELETE FROM `menu`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($menuVo->menuId)){
				$isDel = true;
				$condition[] = '`menu_id` = :menuId';
				$params[] = array(':menuId', $menuVo->menuId, PDO::PARAM_INT);
			}
			if (!is_null($menuVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $menuVo->name, PDO::PARAM_STR);
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
