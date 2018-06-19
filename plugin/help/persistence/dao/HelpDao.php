<?php
class HelpDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `help`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('HelpVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($helpId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `help` where `help_id` = :helpId");
$stmt->bindParam(':helpId',$helpId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('HelpVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($helpVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `help`( `help_cat_id`, `title`, `content`, `router`)
VALUES( :helpCatId, :title, :content, :router)");
$stmt->bindParam(':helpCatId', $helpVo->helpCatId, PDO::PARAM_INT);
$stmt->bindParam(':title', $helpVo->title, PDO::PARAM_STR);
$stmt->bindParam(':content', $helpVo->content, PDO::PARAM_STR);
$stmt->bindParam(':router', $helpVo->router, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($helpVo){
try {
$params = [];
$sql = "INSERT INTO `help` ( `help_cat_id`, `title`, `content`, `router`) 
 VALUES( :helpCatId, :title, :content, :router)";

$params[]=array(':helpCatId', $helpVo->helpCatId, PDO::PARAM_INT);
$params[]=array(':title', $helpVo->title, PDO::PARAM_STR);
$params[]=array(':content', $helpVo->content, PDO::PARAM_STR);
$params[]=array(':router', $helpVo->router, PDO::PARAM_STR);

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
 * Get all item of table help by $helpVo object filter use paging
 * 
 * @param object $helpVo is help object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($helpVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($helpVo)) $helpVo = new HelpVo();
$sql = "select * from `help` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($helpVo->helpId)){ //If isset Vo->element
$fieldValue=$helpVo->helpId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `help_id` $key :helpIdKey";
    $isFirst = false;
} else {
    $condition .= " and `help_id` $key :helpIdKey";
}
if($type == 'str') {
    $params[] = array(':helpIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':helpIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `help_id` =  :helpIdKey';
$isFirst=false;
}else{
$condition.=' and `help_id` =  :helpIdKey';
}
$params[]=array(':helpIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($helpVo->helpCatId)){ //If isset Vo->element
$fieldValue=$helpVo->helpCatId;
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

if (!is_null($helpVo->title)){ //If isset Vo->element
$fieldValue=$helpVo->title;
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

if (!is_null($helpVo->content)){ //If isset Vo->element
$fieldValue=$helpVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($helpVo->router)){ //If isset Vo->element
$fieldValue=$helpVo->router;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router` $key :routerKey";
    $isFirst = false;
} else {
    $condition .= " and `router` $key :routerKey";
}
if($type == 'str') {
    $params[] = array(':routerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router` =  :routerKey';
$isFirst=false;
}else{
$condition.=' and `router` =  :routerKey';
}
$params[]=array(':routerKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('HelpVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($helpVo){
try {
if (empty($helpVo)) $helpVo = new HelpVo();
$sql = "select count(*) as total from  help ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($helpVo->helpId)){ //If isset Vo->element
$fieldValue=$helpVo->helpId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `help_id` $key :helpIdKey";
    $isFirst = false;
} else {
    $condition .= " and `help_id` $key :helpIdKey";
}
if($type == 'str') {
    $params[] = array(':helpIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':helpIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `help_id` =  :helpIdKey';
$isFirst=false;
}else{
$condition.=' and `help_id` =  :helpIdKey';
}
$params[]=array(':helpIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($helpVo->helpCatId)){ //If isset Vo->element
$fieldValue=$helpVo->helpCatId;
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

if (!is_null($helpVo->title)){ //If isset Vo->element
$fieldValue=$helpVo->title;
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

if (!is_null($helpVo->content)){ //If isset Vo->element
$fieldValue=$helpVo->content;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `content` $key :contentKey";
    $isFirst = false;
} else {
    $condition .= " and `content` $key :contentKey";
}
if($type == 'str') {
    $params[] = array(':contentKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':contentKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `content` =  :contentKey';
$isFirst=false;
}else{
$condition.=' and `content` =  :contentKey';
}
$params[]=array(':contentKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($helpVo->router)){ //If isset Vo->element
$fieldValue=$helpVo->router;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `router` $key :routerKey";
    $isFirst = false;
} else {
    $condition .= " and `router` $key :routerKey";
}
if($type == 'str') {
    $params[] = array(':routerKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':routerKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `router` =  :routerKey';
$isFirst=false;
}else{
$condition.=' and `router` =  :routerKey';
}
$params[]=array(':routerKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($helpVo,$helpId){
try {
$sql="UPDATE `help` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($helpVo->helpId)){
if ($isFirst){
$updateFields.=' `help_id`= :helpId';
$isFirst=false;}else{
$updateFields.=', `help_id`= :helpId';
}
$params[]=array(':helpId', $helpVo->helpId, PDO::PARAM_INT);
}

if (isset($helpVo->helpCatId)){
if ($isFirst){
$updateFields.=' `help_cat_id`= :helpCatId';
$isFirst=false;}else{
$updateFields.=', `help_cat_id`= :helpCatId';
}
$params[]=array(':helpCatId', $helpVo->helpCatId, PDO::PARAM_INT);
}

if (isset($helpVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $helpVo->title, PDO::PARAM_STR);
}

if (isset($helpVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $helpVo->content, PDO::PARAM_STR);
}

if (isset($helpVo->router)){
if ($isFirst){
$updateFields.=' `router`= :router';
$isFirst=false;}else{
$updateFields.=', `router`= :router';
}
$params[]=array(':router', $helpVo->router, PDO::PARAM_STR);
}

$conditions.=' where `help_id`= :helpId';
$params[]=array(':helpId', $helpId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (helpId)
	 * Example
	 * getValueByPrimaryKey('helpName', 1)
	 * Get value of filed helpName in table help where helpId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$helpVo = $this->selectByPrimaryKey($primaryValue);
		if($helpVo){
			return $helpVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('helpName', array('helpId' => 1))
	 * Get value of filed helpName in table help where helpId = 1
	 */
	public function getValueByField($fieldName, $where){
		$helpVo = new HelpVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$helpVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$helpVos = $this->selectByFilter($helpVo);
       
		if($helpVos){
			$helpVo = $helpVos[0];
			return $helpVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table help
	 *
	 * @param int $help_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($helpId){
		try {
		    $sql = "DELETE FROM `help` where `help_id` = :helpId";
		    $params = array();
		    $params[] = array(':helpId', $helpId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table help
	 *
	 * @param object $helpVo
	 * @return boolean
	 */
	public function deleteByFilter($helpVo){
		try {
			$sql = 'DELETE FROM `help`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($helpVo->helpId)){
				$isDel = true;
				$condition[] = '`help_id` = :helpId';
				$params[] = array(':helpId', $helpVo->helpId, PDO::PARAM_INT);
			}
			if (!is_null($helpVo->helpCatId)){
				$isDel = true;
				$condition[] = '`help_cat_id` = :helpCatId';
				$params[] = array(':helpCatId', $helpVo->helpCatId, PDO::PARAM_INT);
			}
			if (!is_null($helpVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $helpVo->title, PDO::PARAM_STR);
			}
			if (!is_null($helpVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $helpVo->content, PDO::PARAM_STR);
			}
			if (!is_null($helpVo->router)){
				$isDel = true;
				$condition[] = '`router` = :router';
				$params[] = array(':router', $helpVo->router, PDO::PARAM_STR);
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
