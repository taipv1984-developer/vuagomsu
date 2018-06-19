<?php
class NewsletterEmailTemplateDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `newsletter_email_template`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsletterEmailTemplateVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($newsletterEmailTemplateId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `newsletter_email_template` where `newsletter_email_template_id` = :newsletterEmailTemplateId");
$stmt->bindParam(':newsletterEmailTemplateId',$newsletterEmailTemplateId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsletterEmailTemplateVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsletterEmailTemplateVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `newsletter_email_template`( `key`, `subject`, `content`)
VALUES( :key, :subject, :content)");
$stmt->bindParam(':key', $newsletterEmailTemplateVo->key, PDO::PARAM_STR);
$stmt->bindParam(':subject', $newsletterEmailTemplateVo->subject, PDO::PARAM_STR);
$stmt->bindParam(':content', $newsletterEmailTemplateVo->content, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsletterEmailTemplateVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `newsletter_email_template`( `key`, `subject`, `content`)
VALUES( :key, :subject, :content)");
$stmt->bindParam(':key', $newsletterEmailTemplateVo->key, PDO::PARAM_STR);
$stmt->bindParam(':subject', $newsletterEmailTemplateVo->subject, PDO::PARAM_STR);
$stmt->bindParam(':content', $newsletterEmailTemplateVo->content, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table newsletter_email_template by $newsletterEmailTemplateVo object filter use paging
 * 
 * @param object $newsletterEmailTemplateVo is newsletter_email_template object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsletterEmailTemplateVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsletterEmailTemplateVo)) $newsletterEmailTemplateVo = new NewsletterEmailTemplateVo();
$sql = "select * from `newsletter_email_template` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsletterEmailTemplateVo->newsletterEmailTemplateId)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->newsletterEmailTemplateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `newsletter_email_template_id` $key :newsletterEmailTemplateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `newsletter_email_template_id` $key :newsletterEmailTemplateIdKey";
}
if($type == 'str') {
    $params[] = array(':newsletterEmailTemplateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsletterEmailTemplateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `newsletter_email_template_id` =  :newsletterEmailTemplateIdKey';
$isFirst=false;
}else{
$condition.=' and `newsletter_email_template_id` =  :newsletterEmailTemplateIdKey';
}
$params[]=array(':newsletterEmailTemplateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterEmailTemplateVo->key)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->key;
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

if (!is_null($newsletterEmailTemplateVo->subject)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->subject;
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

if (!is_null($newsletterEmailTemplateVo->content)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->content;
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
return PersistentHelper::mapResult('NewsletterEmailTemplateVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsletterEmailTemplateVo){
try {
if (empty($newsletterEmailTemplateVo)) $newsletterEmailTemplateVo = new NewsletterEmailTemplateVo();
$sql = "select count(*) as total from  newsletter_email_template ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsletterEmailTemplateVo->newsletterEmailTemplateId)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->newsletterEmailTemplateId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `newsletter_email_template_id` $key :newsletterEmailTemplateIdKey";
    $isFirst = false;
} else {
    $condition .= " and `newsletter_email_template_id` $key :newsletterEmailTemplateIdKey";
}
if($type == 'str') {
    $params[] = array(':newsletterEmailTemplateIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsletterEmailTemplateIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `newsletter_email_template_id` =  :newsletterEmailTemplateIdKey';
$isFirst=false;
}else{
$condition.=' and `newsletter_email_template_id` =  :newsletterEmailTemplateIdKey';
}
$params[]=array(':newsletterEmailTemplateIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterEmailTemplateVo->key)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->key;
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

if (!is_null($newsletterEmailTemplateVo->subject)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->subject;
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

if (!is_null($newsletterEmailTemplateVo->content)){ //If isset Vo->element
$fieldValue=$newsletterEmailTemplateVo->content;
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


public function updateByPrimaryKey($newsletterEmailTemplateVo,$newsletterEmailTemplateId){
try {
$sql="UPDATE `newsletter_email_template` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsletterEmailTemplateVo->newsletterEmailTemplateId)){
if ($isFirst){
$updateFields.=' `newsletter_email_template_id`= :newsletterEmailTemplateId';
$isFirst=false;}else{
$updateFields.=', `newsletter_email_template_id`= :newsletterEmailTemplateId';
}
$params[]=array(':newsletterEmailTemplateId', $newsletterEmailTemplateVo->newsletterEmailTemplateId, PDO::PARAM_INT);
}

if (isset($newsletterEmailTemplateVo->key)){
if ($isFirst){
$updateFields.=' `key`= :key';
$isFirst=false;}else{
$updateFields.=', `key`= :key';
}
$params[]=array(':key', $newsletterEmailTemplateVo->key, PDO::PARAM_STR);
}

if (isset($newsletterEmailTemplateVo->subject)){
if ($isFirst){
$updateFields.=' `subject`= :subject';
$isFirst=false;}else{
$updateFields.=', `subject`= :subject';
}
$params[]=array(':subject', $newsletterEmailTemplateVo->subject, PDO::PARAM_STR);
}

if (isset($newsletterEmailTemplateVo->content)){
if ($isFirst){
$updateFields.=' `content`= :content';
$isFirst=false;}else{
$updateFields.=', `content`= :content';
}
$params[]=array(':content', $newsletterEmailTemplateVo->content, PDO::PARAM_STR);
}

$conditions.=' where `newsletter_email_template_id`= :newsletterEmailTemplateId';
$params[]=array(':newsletterEmailTemplateId', $newsletterEmailTemplateId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsletterEmailTemplateId)
	 * Example
	 * getValueByPrimaryKey('newsletterEmailTemplateName', 1)
	 * Get value of filed newsletterEmailTemplateName in table newsletterEmailTemplate where newsletterEmailTemplateId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsletterEmailTemplateVo = $this->selectByPrimaryKey($primaryValue);
		if($newsletterEmailTemplateVo){
			return $newsletterEmailTemplateVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsletterEmailTemplateName', array('newsletterEmailTemplateId' => 1))
	 * Get value of filed newsletterEmailTemplateName in table newsletterEmailTemplate where newsletterEmailTemplateId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsletterEmailTemplateVo = new NewsletterEmailTemplateVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsletterEmailTemplateVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsletterEmailTemplateVos = $this->selectByFilter($newsletterEmailTemplateVo);
       
		if($newsletterEmailTemplateVos){
			$newsletterEmailTemplateVo = $newsletterEmailTemplateVos[0];
			return $newsletterEmailTemplateVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table newsletter_email_template
	 *
	 * @param int $newsletter_email_template_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($newsletterEmailTemplateId){
		try {
		    $sql = "DELETE FROM `newsletter_email_template` where `newsletter_email_template_id` = :newsletterEmailTemplateId";
		    $params = array();
		    $params[] = array(':newsletterEmailTemplateId', $newsletterEmailTemplateId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table newsletter_email_template
	 *
	 * @param object $newsletterEmailTemplateVo
	 * @return boolean
	 */
	public function deleteByFilter($newsletterEmailTemplateVo){
		try {
			$sql = 'DELETE FROM `newsletter_email_template`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsletterEmailTemplateVo->newsletterEmailTemplateId)){
				$isDel = true;
				$condition[] = '`newsletter_email_template_id` = :newsletterEmailTemplateId';
				$params[] = array(':newsletterEmailTemplateId', $newsletterEmailTemplateVo->newsletterEmailTemplateId, PDO::PARAM_INT);
			}
			if (!is_null($newsletterEmailTemplateVo->key)){
				$isDel = true;
				$condition[] = '`key` = :key';
				$params[] = array(':key', $newsletterEmailTemplateVo->key, PDO::PARAM_STR);
			}
			if (!is_null($newsletterEmailTemplateVo->subject)){
				$isDel = true;
				$condition[] = '`subject` = :subject';
				$params[] = array(':subject', $newsletterEmailTemplateVo->subject, PDO::PARAM_STR);
			}
			if (!is_null($newsletterEmailTemplateVo->content)){
				$isDel = true;
				$condition[] = '`content` = :content';
				$params[] = array(':content', $newsletterEmailTemplateVo->content, PDO::PARAM_STR);
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
