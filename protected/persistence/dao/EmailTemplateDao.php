<?php
class EmailTemplateDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `email_template`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('EmailTemplateVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($emailTemplateId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `email_template` where `email_template_id` = :emailTemplateId");
$stmt->bindParam(':emailTemplateId',$emailTemplateId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('EmailTemplateVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($emailTemplateVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `email_template`( `key`, `subject`, `content`, `note`, `status`)
VALUES( :key, :subject, :content, :note, :status)");
$stmt->bindParam(':key', $emailTemplateVo->key, PDO::PARAM_STR);
$stmt->bindParam(':subject', $emailTemplateVo->subject, PDO::PARAM_STR);
$stmt->bindParam(':content', $emailTemplateVo->content, PDO::PARAM_STR);
$stmt->bindParam(':note', $emailTemplateVo->note, PDO::PARAM_STR);
$stmt->bindParam(':status', $emailTemplateVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($emailTemplateVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `email_template`( `key`, `subject`, `content`, `note`, `status`)
VALUES( :key, :subject, :content, :note, :status)");
$stmt->bindParam(':key', $emailTemplateVo->key, PDO::PARAM_STR);
$stmt->bindParam(':subject', $emailTemplateVo->subject, PDO::PARAM_STR);
$stmt->bindParam(':content', $emailTemplateVo->content, PDO::PARAM_STR);
$stmt->bindParam(':note', $emailTemplateVo->note, PDO::PARAM_STR);
$stmt->bindParam(':status', $emailTemplateVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table email_template by $emailTemplateVo object filter use paging
 * 
 * @param object $emailTemplateVo is email_template object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($emailTemplateVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($emailTemplateVo)) $emailTemplateVo = new EmailTemplateVo();
$sql = "select * from `email_template` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($emailTemplateVo->emailTemplateId)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->emailTemplateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `email_template_id` $key :emailTemplateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `email_template_id` $key :emailTemplateIdKey";
}
if($type == 'str') {
    $params[] = array(':emailTemplateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':emailTemplateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `email_template_id` =  :emailTemplateIdKey';
$isFirst=false;
}else{
$condition.=' and `email_template_id` =  :emailTemplateIdKey';
}
$params[]=array(':emailTemplateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($emailTemplateVo->key)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->key;
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

if (!is_null($emailTemplateVo->subject)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->subject;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subject` $key :subjectKey";
    $isFirst = false;
} else {
    $condition .= " and `subject` $key :subjectKey";
}
if($type == 'str') {
    $params[] = array(':subjectKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subjectKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subject` =  :subjectKey';
$isFirst=false;
}else{
$condition.=' and `subject` =  :subjectKey';
}
$params[]=array(':subjectKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($emailTemplateVo->content)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->content;
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

if (!is_null($emailTemplateVo->note)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->note;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `note` $key :noteKey";
    $isFirst = false;
} else {
    $condition .= " and `note` $key :noteKey";
}
if($type == 'str') {
    $params[] = array(':noteKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noteKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `note` =  :noteKey';
$isFirst=false;
}else{
$condition.=' and `note` =  :noteKey';
}
$params[]=array(':noteKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($emailTemplateVo->status)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->status;
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
return PersistentHelper::mapResult('EmailTemplateVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($emailTemplateVo){
try {
if (empty($emailTemplateVo)) $emailTemplateVo = new EmailTemplateVo();
$sql = "select count(*) as total from  email_template ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($emailTemplateVo->emailTemplateId)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->emailTemplateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `email_template_id` $key :emailTemplateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `email_template_id` $key :emailTemplateIdKey";
}
if($type == 'str') {
    $params[] = array(':emailTemplateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':emailTemplateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `email_template_id` =  :emailTemplateIdKey';
$isFirst=false;
}else{
$condition.=' and `email_template_id` =  :emailTemplateIdKey';
}
$params[]=array(':emailTemplateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($emailTemplateVo->key)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->key;
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

if (!is_null($emailTemplateVo->subject)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->subject;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subject` $key :subjectKey";
    $isFirst = false;
} else {
    $condition .= " and `subject` $key :subjectKey";
}
if($type == 'str') {
    $params[] = array(':subjectKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subjectKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subject` =  :subjectKey';
$isFirst=false;
}else{
$condition.=' and `subject` =  :subjectKey';
}
$params[]=array(':subjectKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($emailTemplateVo->content)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->content;
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

if (!is_null($emailTemplateVo->note)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->note;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `note` $key :noteKey";
    $isFirst = false;
} else {
    $condition .= " and `note` $key :noteKey";
}
if($type == 'str') {
    $params[] = array(':noteKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':noteKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `note` =  :noteKey';
$isFirst=false;
}else{
$condition.=' and `note` =  :noteKey';
}
$params[]=array(':noteKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($emailTemplateVo->status)){ //If isset Vo->element
$fieldValue=$emailTemplateVo->status;
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


public function updateByPrimaryKey($emailTemplateVo,$emailTemplateId){
try {
$sql="UPDATE `email_template` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($emailTemplateVo->emailTemplateId)){
if ($isFirst){
$updateFields.=' `email_template_id`= :emailTemplateId';
$isFirst=false;}else{
$updateFields.=', `email_template_id`= :emailTemplateId';
}
$params[]=array(':emailTemplateId', $emailTemplateVo->emailTemplateId, PDO::PARAM_INT);
}

if (isset($emailTemplateVo->key)){
if ($isFirst){
$updateFields.=' `key`= :key';
$isFirst=false;}else{
$updateFields.=', `key`= :key';
}
$params[]=array(':key', $emailTemplateVo->key, PDO::PARAM_STR);
}

if (isset($emailTemplateVo->subject)){
if ($isFirst){
$updateFields.=' `subject`= :subject';
$isFirst=false;}else{
$updateFields.=', `subject`= :subject';
}
$params[]=array(':subject', $emailTemplateVo->subject, PDO::PARAM_STR);
}

if (isset($emailTemplateVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $emailTemplateVo->content, PDO::PARAM_STR);
}

if (isset($emailTemplateVo->note)){
if ($isFirst){
$updateFields.=' `note`= :note';
$isFirst=false;}else{
$updateFields.=', `note`= :note';
}
$params[]=array(':note', $emailTemplateVo->note, PDO::PARAM_STR);
}

if (isset($emailTemplateVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $emailTemplateVo->status, PDO::PARAM_STR);
}

$conditions.=' where `email_template_id`= :emailTemplateId';
$params[]=array(':emailTemplateId', $emailTemplateId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (emailTemplateId)
	 * Example
	 * getValueByPrimaryKey('emailTemplateName', 1)
	 * Get value of filed emailTemplateName in table emailTemplate where emailTemplateId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$emailTemplateVo = $this->selectByPrimaryKey($primaryValue);
		if($emailTemplateVo){
			return $emailTemplateVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('emailTemplateName', array('emailTemplateId' => 1))
	 * Get value of filed emailTemplateName in table emailTemplate where emailTemplateId = 1
	 */
	public function getValueByField($fieldName, $where){
		$emailTemplateVo = new EmailTemplateVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$emailTemplateVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$emailTemplateVos = $this->selectByFilter($emailTemplateVo);
       
		if($emailTemplateVos){
			$emailTemplateVo = $emailTemplateVos[0];
			return $emailTemplateVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table email_template
	 *
	 * @param int $email_template_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($emailTemplateId){
		try {
		    $sql = "DELETE FROM `email_template` where `email_template_id` = :emailTemplateId";
		    $params = array();
		    $params[] = array(':emailTemplateId', $emailTemplateId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table email_template
	 *
	 * @param object $emailTemplateVo
	 * @return boolean
	 */
	public function deleteByFilter($emailTemplateVo){
		try {
			$sql = 'DELETE FROM `email_template`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($emailTemplateVo->emailTemplateId)){
				$isDel = true;
				$condition[] = '`email_template_id` = :emailTemplateId';
				$params[] = array(':emailTemplateId', $emailTemplateVo->emailTemplateId, PDO::PARAM_INT);
			}
			if (!is_null($emailTemplateVo->key)){
				$isDel = true;
				$condition[] = '`key` = :key';
				$params[] = array(':key', $emailTemplateVo->key, PDO::PARAM_STR);
			}
			if (!is_null($emailTemplateVo->subject)){
				$isDel = true;
				$condition[] = '`subject` = :subject';
				$params[] = array(':subject', $emailTemplateVo->subject, PDO::PARAM_STR);
			}
			if (!is_null($emailTemplateVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $emailTemplateVo->content, PDO::PARAM_STR);
			}
			if (!is_null($emailTemplateVo->note)){
				$isDel = true;
				$condition[] = '`note` = :note';
				$params[] = array(':note', $emailTemplateVo->note, PDO::PARAM_STR);
			}
			if (!is_null($emailTemplateVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $emailTemplateVo->status, PDO::PARAM_STR);
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
