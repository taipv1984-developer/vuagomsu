<?php
class NewsletterDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `newsletter`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('NewsletterVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($newsletterId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `newsletter` where `newsletter_id` = :newsletterId");
$stmt->bindParam(':newsletterId',$newsletterId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('NewsletterVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($newsletterVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `newsletter`( `email`, `subscribe`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :email, :subscribe, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':email', $newsletterVo->email, PDO::PARAM_STR);
$stmt->bindParam(':subscribe', $newsletterVo->subscribe, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $newsletterVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsletterVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $newsletterVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $newsletterVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($newsletterVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `newsletter`( `email`, `subscribe`, `crt_date`, `crt_by`, `mod_date`, `mod_by`)
VALUES( :email, :subscribe, :crtDate, :crtBy, :modDate, :modBy)");
$stmt->bindParam(':email', $newsletterVo->email, PDO::PARAM_STR);
$stmt->bindParam(':subscribe', $newsletterVo->subscribe, PDO::PARAM_INT);
$stmt->bindParam(':crtDate', $newsletterVo->crtDate, PDO::PARAM_STR);
$stmt->bindParam(':crtBy', $newsletterVo->crtBy, PDO::PARAM_INT);
$stmt->bindParam(':modDate', $newsletterVo->modDate, PDO::PARAM_STR);
$stmt->bindParam(':modBy', $newsletterVo->modBy, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table newsletter by $newsletterVo object filter use paging
 * 
 * @param object $newsletterVo is newsletter object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($newsletterVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($newsletterVo)) $newsletterVo = new NewsletterVo();
$sql = "select * from `newsletter` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsletterVo->newsletterId)){ //If isset Vo->element
$fieldValue=$newsletterVo->newsletterId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `newsletter_id` $key :newsletterIdKey";
    $isFirst = false;
} else {
    $condition .= " and `newsletter_id` $key :newsletterIdKey";
}
if($type == 'str') {
    $params[] = array(':newsletterIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsletterIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `newsletter_id` =  :newsletterIdKey';
$isFirst=false;
}else{
$condition.=' and `newsletter_id` =  :newsletterIdKey';
}
$params[]=array(':newsletterIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterVo->email)){ //If isset Vo->element
$fieldValue=$newsletterVo->email;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `email` $key :emailKey";
    $isFirst = false;
} else {
    $condition .= " and `email` $key :emailKey";
}
if($type == 'str') {
    $params[] = array(':emailKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':emailKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `email` =  :emailKey';
$isFirst=false;
}else{
$condition.=' and `email` =  :emailKey';
}
$params[]=array(':emailKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsletterVo->subscribe)){ //If isset Vo->element
$fieldValue=$newsletterVo->subscribe;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subscribe` $key :subscribeKey";
    $isFirst = false;
} else {
    $condition .= " and `subscribe` $key :subscribeKey";
}
if($type == 'str') {
    $params[] = array(':subscribeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subscribeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subscribe` =  :subscribeKey';
$isFirst=false;
}else{
$condition.=' and `subscribe` =  :subscribeKey';
}
$params[]=array(':subscribeKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsletterVo->crtDate;
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

if (!is_null($newsletterVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsletterVo->crtBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_by` $key :crtByKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_by` $key :crtByKey";
}
if($type == 'str') {
    $params[] = array(':crtByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_by` =  :crtByKey';
$isFirst=false;
}else{
$condition.=' and `crt_by` =  :crtByKey';
}
$params[]=array(':crtByKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterVo->modDate)){ //If isset Vo->element
$fieldValue=$newsletterVo->modDate;
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

if (!is_null($newsletterVo->modBy)){ //If isset Vo->element
$fieldValue=$newsletterVo->modBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_by` $key :modByKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_by` $key :modByKey";
}
if($type == 'str') {
    $params[] = array(':modByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_by` =  :modByKey';
$isFirst=false;
}else{
$condition.=' and `mod_by` =  :modByKey';
}
$params[]=array(':modByKey', $fieldValue, PDO::PARAM_INT);
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
return PersistentHelper::mapResult('NewsletterVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($newsletterVo){
try {
if (empty($newsletterVo)) $newsletterVo = new NewsletterVo();
$sql = "select count(*) as total from  newsletter ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($newsletterVo->newsletterId)){ //If isset Vo->element
$fieldValue=$newsletterVo->newsletterId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `newsletter_id` $key :newsletterIdKey";
    $isFirst = false;
} else {
    $condition .= " and `newsletter_id` $key :newsletterIdKey";
}
if($type == 'str') {
    $params[] = array(':newsletterIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':newsletterIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `newsletter_id` =  :newsletterIdKey';
$isFirst=false;
}else{
$condition.=' and `newsletter_id` =  :newsletterIdKey';
}
$params[]=array(':newsletterIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterVo->email)){ //If isset Vo->element
$fieldValue=$newsletterVo->email;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `email` $key :emailKey";
    $isFirst = false;
} else {
    $condition .= " and `email` $key :emailKey";
}
if($type == 'str') {
    $params[] = array(':emailKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':emailKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `email` =  :emailKey';
$isFirst=false;
}else{
$condition.=' and `email` =  :emailKey';
}
$params[]=array(':emailKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($newsletterVo->subscribe)){ //If isset Vo->element
$fieldValue=$newsletterVo->subscribe;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `subscribe` $key :subscribeKey";
    $isFirst = false;
} else {
    $condition .= " and `subscribe` $key :subscribeKey";
}
if($type == 'str') {
    $params[] = array(':subscribeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':subscribeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `subscribe` =  :subscribeKey';
$isFirst=false;
}else{
$condition.=' and `subscribe` =  :subscribeKey';
}
$params[]=array(':subscribeKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterVo->crtDate)){ //If isset Vo->element
$fieldValue=$newsletterVo->crtDate;
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

if (!is_null($newsletterVo->crtBy)){ //If isset Vo->element
$fieldValue=$newsletterVo->crtBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `crt_by` $key :crtByKey";
    $isFirst = false;
} else {
    $condition .= " and `crt_by` $key :crtByKey";
}
if($type == 'str') {
    $params[] = array(':crtByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':crtByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `crt_by` =  :crtByKey';
$isFirst=false;
}else{
$condition.=' and `crt_by` =  :crtByKey';
}
$params[]=array(':crtByKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($newsletterVo->modDate)){ //If isset Vo->element
$fieldValue=$newsletterVo->modDate;
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

if (!is_null($newsletterVo->modBy)){ //If isset Vo->element
$fieldValue=$newsletterVo->modBy;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `mod_by` $key :modByKey";
    $isFirst = false;
} else {
    $condition .= " and `mod_by` $key :modByKey";
}
if($type == 'str') {
    $params[] = array(':modByKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':modByKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `mod_by` =  :modByKey';
$isFirst=false;
}else{
$condition.=' and `mod_by` =  :modByKey';
}
$params[]=array(':modByKey', $fieldValue, PDO::PARAM_INT);
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


public function updateByPrimaryKey($newsletterVo,$newsletterId){
try {
$sql="UPDATE `newsletter` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($newsletterVo->newsletterId)){
if ($isFirst){
$updateFields.=' `newsletter_id`= :newsletterId';
$isFirst=false;}else{
$updateFields.=', `newsletter_id`= :newsletterId';
}
$params[]=array(':newsletterId', $newsletterVo->newsletterId, PDO::PARAM_INT);
}

if (isset($newsletterVo->email)){
if ($isFirst){
$updateFields.=' `email`= :email';
$isFirst=false;}else{
$updateFields.=', `email`= :email';
}
$params[]=array(':email', $newsletterVo->email, PDO::PARAM_STR);
}

if (isset($newsletterVo->subscribe)){
if ($isFirst){
$updateFields.=' `subscribe`= :subscribe';
$isFirst=false;}else{
$updateFields.=', `subscribe`= :subscribe';
}
$params[]=array(':subscribe', $newsletterVo->subscribe, PDO::PARAM_INT);
}

if (isset($newsletterVo->crtDate)){
if ($isFirst){
$updateFields.=' `crt_date`= :crtDate';
$isFirst=false;}else{
$updateFields.=', `crt_date`= :crtDate';
}
$params[]=array(':crtDate', $newsletterVo->crtDate, PDO::PARAM_STR);
}

if (isset($newsletterVo->crtBy)){
if ($isFirst){
$updateFields.=' `crt_by`= :crtBy';
$isFirst=false;}else{
$updateFields.=', `crt_by`= :crtBy';
}
$params[]=array(':crtBy', $newsletterVo->crtBy, PDO::PARAM_INT);
}

if (isset($newsletterVo->modDate)){
if ($isFirst){
$updateFields.=' `mod_date`= :modDate';
$isFirst=false;}else{
$updateFields.=', `mod_date`= :modDate';
}
$params[]=array(':modDate', $newsletterVo->modDate, PDO::PARAM_STR);
}

if (isset($newsletterVo->modBy)){
if ($isFirst){
$updateFields.=' `mod_by`= :modBy';
$isFirst=false;}else{
$updateFields.=', `mod_by`= :modBy';
}
$params[]=array(':modBy', $newsletterVo->modBy, PDO::PARAM_INT);
}

$conditions.=' where `newsletter_id`= :newsletterId';
$params[]=array(':newsletterId', $newsletterId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (newsletterId)
	 * Example
	 * getValueByPrimaryKey('newsletterName', 1)
	 * Get value of filed newsletterName in table newsletter where newsletterId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$newsletterVo = $this->selectByPrimaryKey($primaryValue);
		if($newsletterVo){
			return $newsletterVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('newsletterName', array('newsletterId' => 1))
	 * Get value of filed newsletterName in table newsletter where newsletterId = 1
	 */
	public function getValueByField($fieldName, $where){
		$newsletterVo = new NewsletterVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$newsletterVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$newsletterVos = $this->selectByFilter($newsletterVo);
       
		if($newsletterVos){
			$newsletterVo = $newsletterVos[0];
			return $newsletterVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table newsletter
	 *
	 * @param int $newsletter_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($newsletterId){
		try {
		    $sql = "DELETE FROM `newsletter` where `newsletter_id` = :newsletterId";
		    $params = array();
		    $params[] = array(':newsletterId', $newsletterId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table newsletter
	 *
	 * @param object $newsletterVo
	 * @return boolean
	 */
	public function deleteByFilter($newsletterVo){
		try {
			$sql = 'DELETE FROM `newsletter`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($newsletterVo->newsletterId)){
				$isDel = true;
				$condition[] = '`newsletter_id` = :newsletterId';
				$params[] = array(':newsletterId', $newsletterVo->newsletterId, PDO::PARAM_INT);
			}
			if (!is_null($newsletterVo->email)){
				$isDel = true;
				$condition[] = '`email` = :email';
				$params[] = array(':email', $newsletterVo->email, PDO::PARAM_STR);
			}
			if (!is_null($newsletterVo->subscribe)){
				$isDel = true;
				$condition[] = '`subscribe` = :subscribe';
				$params[] = array(':subscribe', $newsletterVo->subscribe, PDO::PARAM_INT);
			}
			if (!is_null($newsletterVo->crtDate)){
				$isDel = true;
				$condition[] = '`crt_date` = :crtDate';
				$params[] = array(':crtDate', $newsletterVo->crtDate, PDO::PARAM_STR);
			}
			if (!is_null($newsletterVo->crtBy)){
				$isDel = true;
				$condition[] = '`crt_by` = :crtBy';
				$params[] = array(':crtBy', $newsletterVo->crtBy, PDO::PARAM_INT);
			}
			if (!is_null($newsletterVo->modDate)){
				$isDel = true;
				$condition[] = '`mod_date` = :modDate';
				$params[] = array(':modDate', $newsletterVo->modDate, PDO::PARAM_STR);
			}
			if (!is_null($newsletterVo->modBy)){
				$isDel = true;
				$condition[] = '`mod_by` = :modBy';
				$params[] = array(':modBy', $newsletterVo->modBy, PDO::PARAM_INT);
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
