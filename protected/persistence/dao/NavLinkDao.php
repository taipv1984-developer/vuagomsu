<?php
class NavLinkDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `nav_link`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NavLinkVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($navLinkId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `nav_link` where `nav_link_id` = :navLinkId");
$stmt->bindParam(':navLinkId',$navLinkId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NavLinkVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($navLinkVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `nav_link`( `parent_id`, `title`, `link`, `icon`, `order`, `plugin_code`)
VALUES( :parentId, :title, :link, :icon, :order, :pluginCode)");
$stmt->bindParam(':parentId', $navLinkVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':title', $navLinkVo->title, PDO::PARAM_STR);
$stmt->bindParam(':link', $navLinkVo->link, PDO::PARAM_STR);
$stmt->bindParam(':icon', $navLinkVo->icon, PDO::PARAM_STR);
$stmt->bindParam(':order', $navLinkVo->order, PDO::PARAM_INT);
$stmt->bindParam(':pluginCode', $navLinkVo->pluginCode, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($navLinkVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `nav_link`( `parent_id`, `title`, `link`, `icon`, `order`, `plugin_code`)
VALUES( :parentId, :title, :link, :icon, :order, :pluginCode)");
$stmt->bindParam(':parentId', $navLinkVo->parentId, PDO::PARAM_INT);
$stmt->bindParam(':title', $navLinkVo->title, PDO::PARAM_STR);
$stmt->bindParam(':link', $navLinkVo->link, PDO::PARAM_STR);
$stmt->bindParam(':icon', $navLinkVo->icon, PDO::PARAM_STR);
$stmt->bindParam(':order', $navLinkVo->order, PDO::PARAM_INT);
$stmt->bindParam(':pluginCode', $navLinkVo->pluginCode, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table nav_link by $navLinkVo object filter use paging
 * 
 * @param object $navLinkVo is nav_link object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($navLinkVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($navLinkVo)) $navLinkVo = new NavLinkVo();
$sql = "select * from `nav_link` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($navLinkVo->navLinkId)){ //If isset Vo->element
$fieldValue=$navLinkVo->navLinkId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `nav_link_id` $key :navLinkIdKey";
    $isFirst = false;
} else {
    $condition .= " and `nav_link_id` $key :navLinkIdKey";
}
if($type == 'str') {
    $params[] = array(':navLinkIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':navLinkIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `nav_link_id` =  :navLinkIdKey';
$isFirst=false;
}else{
$condition.=' and `nav_link_id` =  :navLinkIdKey';
}
$params[]=array(':navLinkIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($navLinkVo->parentId)){ //If isset Vo->element
$fieldValue=$navLinkVo->parentId;
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

if (!is_null($navLinkVo->title)){ //If isset Vo->element
$fieldValue=$navLinkVo->title;
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

if (!is_null($navLinkVo->link)){ //If isset Vo->element
$fieldValue=$navLinkVo->link;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `link` $key :linkKey";
    $isFirst = false;
} else {
    $condition .= " and `link` $key :linkKey";
}
if($type == 'str') {
    $params[] = array(':linkKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':linkKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `link` =  :linkKey';
$isFirst=false;
}else{
$condition.=' and `link` =  :linkKey';
}
$params[]=array(':linkKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($navLinkVo->icon)){ //If isset Vo->element
$fieldValue=$navLinkVo->icon;
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

if (!is_null($navLinkVo->order)){ //If isset Vo->element
$fieldValue=$navLinkVo->order;
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

if (!is_null($navLinkVo->pluginCode)){ //If isset Vo->element
$fieldValue=$navLinkVo->pluginCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_code` $key :pluginCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_code` $key :pluginCodeKey";
}
if($type == 'str') {
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_code` =  :pluginCodeKey';
$isFirst=false;
}else{
$condition.=' and `plugin_code` =  :pluginCodeKey';
}
$params[]=array(':pluginCodeKey', $fieldValue, PDO::PARAM_STR);
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
return PersistentHelper::mapResult('NavLinkVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($navLinkVo){
try {
if (empty($navLinkVo)) $navLinkVo = new NavLinkVo();
$sql = "select count(*) as total from  nav_link ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($navLinkVo->navLinkId)){ //If isset Vo->element
$fieldValue=$navLinkVo->navLinkId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `nav_link_id` $key :navLinkIdKey";
    $isFirst = false;
} else {
    $condition .= " and `nav_link_id` $key :navLinkIdKey";
}
if($type == 'str') {
    $params[] = array(':navLinkIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':navLinkIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `nav_link_id` =  :navLinkIdKey';
$isFirst=false;
}else{
$condition.=' and `nav_link_id` =  :navLinkIdKey';
}
$params[]=array(':navLinkIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($navLinkVo->parentId)){ //If isset Vo->element
$fieldValue=$navLinkVo->parentId;
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

if (!is_null($navLinkVo->title)){ //If isset Vo->element
$fieldValue=$navLinkVo->title;
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

if (!is_null($navLinkVo->link)){ //If isset Vo->element
$fieldValue=$navLinkVo->link;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `link` $key :linkKey";
    $isFirst = false;
} else {
    $condition .= " and `link` $key :linkKey";
}
if($type == 'str') {
    $params[] = array(':linkKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':linkKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `link` =  :linkKey';
$isFirst=false;
}else{
$condition.=' and `link` =  :linkKey';
}
$params[]=array(':linkKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($navLinkVo->icon)){ //If isset Vo->element
$fieldValue=$navLinkVo->icon;
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

if (!is_null($navLinkVo->order)){ //If isset Vo->element
$fieldValue=$navLinkVo->order;
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

if (!is_null($navLinkVo->pluginCode)){ //If isset Vo->element
$fieldValue=$navLinkVo->pluginCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `plugin_code` $key :pluginCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `plugin_code` $key :pluginCodeKey";
}
if($type == 'str') {
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':pluginCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `plugin_code` =  :pluginCodeKey';
$isFirst=false;
}else{
$condition.=' and `plugin_code` =  :pluginCodeKey';
}
$params[]=array(':pluginCodeKey', $fieldValue, PDO::PARAM_STR);
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


public function updateByPrimaryKey($navLinkVo,$navLinkId){
try {
$sql="UPDATE `nav_link` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($navLinkVo->navLinkId)){
if ($isFirst){
$updateFields.=' `nav_link_id`= :navLinkId';
$isFirst=false;}else{
$updateFields.=', `nav_link_id`= :navLinkId';
}
$params[]=array(':navLinkId', $navLinkVo->navLinkId, PDO::PARAM_INT);
}

if (isset($navLinkVo->parentId)){
if ($isFirst){
$updateFields.=' `parent_id`= :parentId';
$isFirst=false;}else{
$updateFields.=', `parent_id`= :parentId';
}
$params[]=array(':parentId', $navLinkVo->parentId, PDO::PARAM_INT);
}

if (isset($navLinkVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $navLinkVo->title, PDO::PARAM_STR);
}

if (isset($navLinkVo->link)){
if ($isFirst){
$updateFields.=' `link`= :link';
$isFirst=false;}else{
$updateFields.=', `link`= :link';
}
$params[]=array(':link', $navLinkVo->link, PDO::PARAM_STR);
}

if (isset($navLinkVo->icon)){
if ($isFirst){
$updateFields.=' `icon`= :icon';
$isFirst=false;}else{
$updateFields.=', `icon`= :icon';
}
$params[]=array(':icon', $navLinkVo->icon, PDO::PARAM_STR);
}

if (isset($navLinkVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $navLinkVo->order, PDO::PARAM_INT);
}

if (isset($navLinkVo->pluginCode)){
if ($isFirst){
$updateFields.=' `plugin_code`= :pluginCode';
$isFirst=false;}else{
$updateFields.=', `plugin_code`= :pluginCode';
}
$params[]=array(':pluginCode', $navLinkVo->pluginCode, PDO::PARAM_STR);
}

$conditions.=' where `nav_link_id`= :navLinkId';
$params[]=array(':navLinkId', $navLinkId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (navLinkId)
	 * Example
	 * getValueByPrimaryKey('navLinkName', 1)
	 * Get value of filed navLinkName in table navLink where navLinkId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$navLinkVo = $this->selectByPrimaryKey($primaryValue);
		if($navLinkVo){
			return $navLinkVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('navLinkName', array('navLinkId' => 1))
	 * Get value of filed navLinkName in table navLink where navLinkId = 1
	 */
	public function getValueByField($fieldName, $where){
		$navLinkVo = new NavLinkVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$navLinkVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$navLinkVos = $this->selectByFilter($navLinkVo);
       
		if($navLinkVos){
			$navLinkVo = $navLinkVos[0];
			return $navLinkVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table nav_link
	 *
	 * @param int $nav_link_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($navLinkId){
		try {
		    $sql = "DELETE FROM `nav_link` where `nav_link_id` = :navLinkId";
		    $params = array();
		    $params[] = array(':navLinkId', $navLinkId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table nav_link
	 *
	 * @param object $navLinkVo
	 * @return boolean
	 */
	public function deleteByFilter($navLinkVo){
		try {
			$sql = 'DELETE FROM `nav_link`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($navLinkVo->navLinkId)){
				$isDel = true;
				$condition[] = '`nav_link_id` = :navLinkId';
				$params[] = array(':navLinkId', $navLinkVo->navLinkId, PDO::PARAM_INT);
			}
			if (!is_null($navLinkVo->parentId)){
				$isDel = true;
				$condition[] = '`parent_id` = :parentId';
				$params[] = array(':parentId', $navLinkVo->parentId, PDO::PARAM_INT);
			}
			if (!is_null($navLinkVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $navLinkVo->title, PDO::PARAM_STR);
			}
			if (!is_null($navLinkVo->link)){
				$isDel = true;
				$condition[] = '`link` = :link';
				$params[] = array(':link', $navLinkVo->link, PDO::PARAM_STR);
			}
			if (!is_null($navLinkVo->icon)){
				$isDel = true;
				$condition[] = '`icon` = :icon';
				$params[] = array(':icon', $navLinkVo->icon, PDO::PARAM_STR);
			}
			if (!is_null($navLinkVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $navLinkVo->order, PDO::PARAM_INT);
			}
			if (!is_null($navLinkVo->pluginCode)){
				$isDel = true;
				$condition[] = '`plugin_code` = :pluginCode';
				$params[] = array(':pluginCode', $navLinkVo->pluginCode, PDO::PARAM_STR);
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
