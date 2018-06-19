<?php
class FileDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `file`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('FileVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($fileId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `file` where `file_id` = :fileId");
$stmt->bindParam(':fileId',$fileId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('FileVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($fileVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `file`( `name`, `orig_name`, `vitual_path`, `table_map`, `type`, `size`, `status`)
VALUES( :name, :origName, :vitualPath, :tableMap, :type, :size, :status)");
$stmt->bindParam(':name', $fileVo->name, PDO::PARAM_STR);
$stmt->bindParam(':origName', $fileVo->origName, PDO::PARAM_STR);
$stmt->bindParam(':vitualPath', $fileVo->vitualPath, PDO::PARAM_STR);
$stmt->bindParam(':tableMap', $fileVo->tableMap, PDO::PARAM_STR);
$stmt->bindParam(':type', $fileVo->type, PDO::PARAM_STR);
$stmt->bindParam(':size', $fileVo->size, PDO::PARAM_INT);
$stmt->bindParam(':status', $fileVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($fileVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `file`( `name`, `orig_name`, `vitual_path`, `table_map`, `type`, `size`, `status`)
VALUES( :name, :origName, :vitualPath, :tableMap, :type, :size, :status)");
$stmt->bindParam(':name', $fileVo->name, PDO::PARAM_STR);
$stmt->bindParam(':origName', $fileVo->origName, PDO::PARAM_STR);
$stmt->bindParam(':vitualPath', $fileVo->vitualPath, PDO::PARAM_STR);
$stmt->bindParam(':tableMap', $fileVo->tableMap, PDO::PARAM_STR);
$stmt->bindParam(':type', $fileVo->type, PDO::PARAM_STR);
$stmt->bindParam(':size', $fileVo->size, PDO::PARAM_INT);
$stmt->bindParam(':status', $fileVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table file by $fileVo object filter use paging
 * 
 * @param object $fileVo is file object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($fileVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($fileVo)) $fileVo = new FileVo();
$sql = "select * from `file` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($fileVo->fileId)){ //If isset Vo->element
$fieldValue=$fileVo->fileId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `file_id` $key :fileIdKey";
    $isFirst = false;
} else {
    $condition .= " and `file_id` $key :fileIdKey";
}
if($type == 'str') {
    $params[] = array(':fileIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':fileIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `file_id` =  :fileIdKey';
$isFirst=false;
}else{
$condition.=' and `file_id` =  :fileIdKey';
}
$params[]=array(':fileIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($fileVo->name)){ //If isset Vo->element
$fieldValue=$fileVo->name;
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

if (!is_null($fileVo->origName)){ //If isset Vo->element
$fieldValue=$fileVo->origName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `orig_name` $key :origNameKey";
    $isFirst = false;
} else {
    $condition .= " and `orig_name` $key :origNameKey";
}
if($type == 'str') {
    $params[] = array(':origNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':origNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `orig_name` =  :origNameKey';
$isFirst=false;
}else{
$condition.=' and `orig_name` =  :origNameKey';
}
$params[]=array(':origNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->vitualPath)){ //If isset Vo->element
$fieldValue=$fileVo->vitualPath;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `vitual_path` $key :vitualPathKey";
    $isFirst = false;
} else {
    $condition .= " and `vitual_path` $key :vitualPathKey";
}
if($type == 'str') {
    $params[] = array(':vitualPathKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':vitualPathKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `vitual_path` =  :vitualPathKey';
$isFirst=false;
}else{
$condition.=' and `vitual_path` =  :vitualPathKey';
}
$params[]=array(':vitualPathKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->tableMap)){ //If isset Vo->element
$fieldValue=$fileVo->tableMap;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `table_map` $key :tableMapKey";
    $isFirst = false;
} else {
    $condition .= " and `table_map` $key :tableMapKey";
}
if($type == 'str') {
    $params[] = array(':tableMapKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':tableMapKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `table_map` =  :tableMapKey';
$isFirst=false;
}else{
$condition.=' and `table_map` =  :tableMapKey';
}
$params[]=array(':tableMapKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->type)){ //If isset Vo->element
$fieldValue=$fileVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->size)){ //If isset Vo->element
$fieldValue=$fileVo->size;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `size` $key :sizeKey";
    $isFirst = false;
} else {
    $condition .= " and `size` $key :sizeKey";
}
if($type == 'str') {
    $params[] = array(':sizeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sizeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `size` =  :sizeKey';
$isFirst=false;
}else{
$condition.=' and `size` =  :sizeKey';
}
$params[]=array(':sizeKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($fileVo->status)){ //If isset Vo->element
$fieldValue=$fileVo->status;
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
return PersistentHelper::mapResult('FileVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($fileVo){
try {
if (empty($fileVo)) $fileVo = new FileVo();
$sql = "select count(*) as total from  file ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($fileVo->fileId)){ //If isset Vo->element
$fieldValue=$fileVo->fileId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `file_id` $key :fileIdKey";
    $isFirst = false;
} else {
    $condition .= " and `file_id` $key :fileIdKey";
}
if($type == 'str') {
    $params[] = array(':fileIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':fileIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `file_id` =  :fileIdKey';
$isFirst=false;
}else{
$condition.=' and `file_id` =  :fileIdKey';
}
$params[]=array(':fileIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($fileVo->name)){ //If isset Vo->element
$fieldValue=$fileVo->name;
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

if (!is_null($fileVo->origName)){ //If isset Vo->element
$fieldValue=$fileVo->origName;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `orig_name` $key :origNameKey";
    $isFirst = false;
} else {
    $condition .= " and `orig_name` $key :origNameKey";
}
if($type == 'str') {
    $params[] = array(':origNameKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':origNameKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `orig_name` =  :origNameKey';
$isFirst=false;
}else{
$condition.=' and `orig_name` =  :origNameKey';
}
$params[]=array(':origNameKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->vitualPath)){ //If isset Vo->element
$fieldValue=$fileVo->vitualPath;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `vitual_path` $key :vitualPathKey";
    $isFirst = false;
} else {
    $condition .= " and `vitual_path` $key :vitualPathKey";
}
if($type == 'str') {
    $params[] = array(':vitualPathKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':vitualPathKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `vitual_path` =  :vitualPathKey';
$isFirst=false;
}else{
$condition.=' and `vitual_path` =  :vitualPathKey';
}
$params[]=array(':vitualPathKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->tableMap)){ //If isset Vo->element
$fieldValue=$fileVo->tableMap;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `table_map` $key :tableMapKey";
    $isFirst = false;
} else {
    $condition .= " and `table_map` $key :tableMapKey";
}
if($type == 'str') {
    $params[] = array(':tableMapKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':tableMapKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `table_map` =  :tableMapKey';
$isFirst=false;
}else{
$condition.=' and `table_map` =  :tableMapKey';
}
$params[]=array(':tableMapKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->type)){ //If isset Vo->element
$fieldValue=$fileVo->type;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `type` $key :typeKey";
    $isFirst = false;
} else {
    $condition .= " and `type` $key :typeKey";
}
if($type == 'str') {
    $params[] = array(':typeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':typeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `type` =  :typeKey';
$isFirst=false;
}else{
$condition.=' and `type` =  :typeKey';
}
$params[]=array(':typeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($fileVo->size)){ //If isset Vo->element
$fieldValue=$fileVo->size;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `size` $key :sizeKey";
    $isFirst = false;
} else {
    $condition .= " and `size` $key :sizeKey";
}
if($type == 'str') {
    $params[] = array(':sizeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sizeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `size` =  :sizeKey';
$isFirst=false;
}else{
$condition.=' and `size` =  :sizeKey';
}
$params[]=array(':sizeKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($fileVo->status)){ //If isset Vo->element
$fieldValue=$fileVo->status;
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


public function updateByPrimaryKey($fileVo,$fileId){
try {
$sql="UPDATE `file` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($fileVo->fileId)){
if ($isFirst){
$updateFields.=' `file_id`= :fileId';
$isFirst=false;}else{
$updateFields.=', `file_id`= :fileId';
}
$params[]=array(':fileId', $fileVo->fileId, PDO::PARAM_INT);
}

if (isset($fileVo->name)){
if ($isFirst){
$updateFields.=' `name`= :name';
$isFirst=false;}else{
$updateFields.=', `name`= :name';
}
$params[]=array(':name', $fileVo->name, PDO::PARAM_STR);
}

if (isset($fileVo->origName)){
if ($isFirst){
$updateFields.=' `orig_name`= :origName';
$isFirst=false;}else{
$updateFields.=', `orig_name`= :origName';
}
$params[]=array(':origName', $fileVo->origName, PDO::PARAM_STR);
}

if (isset($fileVo->vitualPath)){
if ($isFirst){
$updateFields.=' `vitual_path`= :vitualPath';
$isFirst=false;}else{
$updateFields.=', `vitual_path`= :vitualPath';
}
$params[]=array(':vitualPath', $fileVo->vitualPath, PDO::PARAM_STR);
}

if (isset($fileVo->tableMap)){
if ($isFirst){
$updateFields.=' `table_map`= :tableMap';
$isFirst=false;}else{
$updateFields.=', `table_map`= :tableMap';
}
$params[]=array(':tableMap', $fileVo->tableMap, PDO::PARAM_STR);
}

if (isset($fileVo->type)){
if ($isFirst){
$updateFields.=' `type`= :type';
$isFirst=false;}else{
$updateFields.=', `type`= :type';
}
$params[]=array(':type', $fileVo->type, PDO::PARAM_STR);
}

if (isset($fileVo->size)){
if ($isFirst){
$updateFields.=' `size`= :size';
$isFirst=false;}else{
$updateFields.=', `size`= :size';
}
$params[]=array(':size', $fileVo->size, PDO::PARAM_INT);
}

if (isset($fileVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $fileVo->status, PDO::PARAM_STR);
}

$conditions.=' where `file_id`= :fileId';
$params[]=array(':fileId', $fileId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (fileId)
	 * Example
	 * getValueByPrimaryKey('fileName', 1)
	 * Get value of filed fileName in table file where fileId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$fileVo = $this->selectByPrimaryKey($primaryValue);
		if($fileVo){
			return $fileVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('fileName', array('fileId' => 1))
	 * Get value of filed fileName in table file where fileId = 1
	 */
	public function getValueByField($fieldName, $where){
		$fileVo = new FileVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$fileVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$fileVos = $this->selectByFilter($fileVo);
       
		if($fileVos){
			$fileVo = $fileVos[0];
			return $fileVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table file
	 *
	 * @param int $file_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($fileId){
		try {
		    $sql = "DELETE FROM `file` where `file_id` = :fileId";
		    $params = array();
		    $params[] = array(':fileId', $fileId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table file
	 *
	 * @param object $fileVo
	 * @return boolean
	 */
	public function deleteByFilter($fileVo){
		try {
			$sql = 'DELETE FROM `file`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($fileVo->fileId)){
				$isDel = true;
				$condition[] = '`file_id` = :fileId';
				$params[] = array(':fileId', $fileVo->fileId, PDO::PARAM_INT);
			}
			if (!is_null($fileVo->name)){
				$isDel = true;
				$condition[] = '`name` = :name';
				$params[] = array(':name', $fileVo->name, PDO::PARAM_STR);
			}
			if (!is_null($fileVo->origName)){
				$isDel = true;
				$condition[] = '`orig_name` = :origName';
				$params[] = array(':origName', $fileVo->origName, PDO::PARAM_STR);
			}
			if (!is_null($fileVo->vitualPath)){
				$isDel = true;
				$condition[] = '`vitual_path` = :vitualPath';
				$params[] = array(':vitualPath', $fileVo->vitualPath, PDO::PARAM_STR);
			}
			if (!is_null($fileVo->tableMap)){
				$isDel = true;
				$condition[] = '`table_map` = :tableMap';
				$params[] = array(':tableMap', $fileVo->tableMap, PDO::PARAM_STR);
			}
			if (!is_null($fileVo->type)){
				$isDel = true;
				$condition[] = '`type` = :type';
				$params[] = array(':type', $fileVo->type, PDO::PARAM_STR);
			}
			if (!is_null($fileVo->size)){
				$isDel = true;
				$condition[] = '`size` = :size';
				$params[] = array(':size', $fileVo->size, PDO::PARAM_INT);
			}
			if (!is_null($fileVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $fileVo->status, PDO::PARAM_STR);
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
