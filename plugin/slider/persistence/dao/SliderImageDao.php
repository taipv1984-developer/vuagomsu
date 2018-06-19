<?php
class SliderImageDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `slider_image`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('SliderImageVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($sliderImageId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `slider_image` where `slider_image_id` = :sliderImageId");
$stmt->bindParam(':sliderImageId',$sliderImageId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('SliderImageVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($sliderImageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `slider_image`( `slider_id`, `image`, `title`, `description`, `link`, `order`)
VALUES( :sliderId, :image, :title, :description, :link, :order)");
$stmt->bindParam(':sliderId', $sliderImageVo->sliderId, PDO::PARAM_INT);
$stmt->bindParam(':image', $sliderImageVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $sliderImageVo->title, PDO::PARAM_STR);
$stmt->bindParam(':description', $sliderImageVo->description, PDO::PARAM_STR);
$stmt->bindParam(':link', $sliderImageVo->link, PDO::PARAM_STR);
$stmt->bindParam(':order', $sliderImageVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($sliderImageVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `slider_image`( `slider_id`, `image`, `title`, `description`, `link`, `order`)
VALUES( :sliderId, :image, :title, :description, :link, :order)");
$stmt->bindParam(':sliderId', $sliderImageVo->sliderId, PDO::PARAM_INT);
$stmt->bindParam(':image', $sliderImageVo->image, PDO::PARAM_STR);
$stmt->bindParam(':title', $sliderImageVo->title, PDO::PARAM_STR);
$stmt->bindParam(':description', $sliderImageVo->description, PDO::PARAM_STR);
$stmt->bindParam(':link', $sliderImageVo->link, PDO::PARAM_STR);
$stmt->bindParam(':order', $sliderImageVo->order, PDO::PARAM_INT);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table slider_image by $sliderImageVo object filter use paging
 * 
 * @param object $sliderImageVo is slider_image object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($sliderImageVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($sliderImageVo)) $sliderImageVo = new SliderImageVo();
$sql = "select * from `slider_image` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($sliderImageVo->sliderImageId)){ //If isset Vo->element
$fieldValue=$sliderImageVo->sliderImageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `slider_image_id` $key :sliderImageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `slider_image_id` $key :sliderImageIdKey";
}
if($type == 'str') {
    $params[] = array(':sliderImageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sliderImageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `slider_image_id` =  :sliderImageIdKey';
$isFirst=false;
}else{
$condition.=' and `slider_image_id` =  :sliderImageIdKey';
}
$params[]=array(':sliderImageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($sliderImageVo->sliderId)){ //If isset Vo->element
$fieldValue=$sliderImageVo->sliderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `slider_id` $key :sliderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `slider_id` $key :sliderIdKey";
}
if($type == 'str') {
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `slider_id` =  :sliderIdKey';
$isFirst=false;
}else{
$condition.=' and `slider_id` =  :sliderIdKey';
}
$params[]=array(':sliderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($sliderImageVo->image)){ //If isset Vo->element
$fieldValue=$sliderImageVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($sliderImageVo->title)){ //If isset Vo->element
$fieldValue=$sliderImageVo->title;
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

if (!is_null($sliderImageVo->description)){ //If isset Vo->element
$fieldValue=$sliderImageVo->description;
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

if (!is_null($sliderImageVo->link)){ //If isset Vo->element
$fieldValue=$sliderImageVo->link;
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

if (!is_null($sliderImageVo->order)){ //If isset Vo->element
$fieldValue=$sliderImageVo->order;
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
return PersistentHelper::mapResult('SliderImageVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($sliderImageVo){
try {
if (empty($sliderImageVo)) $sliderImageVo = new SliderImageVo();
$sql = "select count(*) as total from  slider_image ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($sliderImageVo->sliderImageId)){ //If isset Vo->element
$fieldValue=$sliderImageVo->sliderImageId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `slider_image_id` $key :sliderImageIdKey";
    $isFirst = false;
} else {
    $condition .= " and `slider_image_id` $key :sliderImageIdKey";
}
if($type == 'str') {
    $params[] = array(':sliderImageIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sliderImageIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `slider_image_id` =  :sliderImageIdKey';
$isFirst=false;
}else{
$condition.=' and `slider_image_id` =  :sliderImageIdKey';
}
$params[]=array(':sliderImageIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($sliderImageVo->sliderId)){ //If isset Vo->element
$fieldValue=$sliderImageVo->sliderId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `slider_id` $key :sliderIdKey";
    $isFirst = false;
} else {
    $condition .= " and `slider_id` $key :sliderIdKey";
}
if($type == 'str') {
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':sliderIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `slider_id` =  :sliderIdKey';
$isFirst=false;
}else{
$condition.=' and `slider_id` =  :sliderIdKey';
}
$params[]=array(':sliderIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($sliderImageVo->image)){ //If isset Vo->element
$fieldValue=$sliderImageVo->image;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `image` $key :imageKey";
    $isFirst = false;
} else {
    $condition .= " and `image` $key :imageKey";
}
if($type == 'str') {
    $params[] = array(':imageKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':imageKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `image` =  :imageKey';
$isFirst=false;
}else{
$condition.=' and `image` =  :imageKey';
}
$params[]=array(':imageKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($sliderImageVo->title)){ //If isset Vo->element
$fieldValue=$sliderImageVo->title;
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

if (!is_null($sliderImageVo->description)){ //If isset Vo->element
$fieldValue=$sliderImageVo->description;
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

if (!is_null($sliderImageVo->link)){ //If isset Vo->element
$fieldValue=$sliderImageVo->link;
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

if (!is_null($sliderImageVo->order)){ //If isset Vo->element
$fieldValue=$sliderImageVo->order;
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


public function updateByPrimaryKey($sliderImageVo,$sliderImageId){
try {
$sql="UPDATE `slider_image` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($sliderImageVo->sliderImageId)){
if ($isFirst){
$updateFields.=' `slider_image_id`= :sliderImageId';
$isFirst=false;}else{
$updateFields.=', `slider_image_id`= :sliderImageId';
}
$params[]=array(':sliderImageId', $sliderImageVo->sliderImageId, PDO::PARAM_INT);
}

if (isset($sliderImageVo->sliderId)){
if ($isFirst){
$updateFields.=' `slider_id`= :sliderId';
$isFirst=false;}else{
$updateFields.=', `slider_id`= :sliderId';
}
$params[]=array(':sliderId', $sliderImageVo->sliderId, PDO::PARAM_INT);
}

if (isset($sliderImageVo->image)){
if ($isFirst){
$updateFields.=' `image`= :image';
$isFirst=false;}else{
$updateFields.=', `image`= :image';
}
$params[]=array(':image', $sliderImageVo->image, PDO::PARAM_STR);
}

if (isset($sliderImageVo->title)){
if ($isFirst){
$updateFields.=' `title`= :title';
$isFirst=false;}else{
$updateFields.=', `title`= :title';
}
$params[]=array(':title', $sliderImageVo->title, PDO::PARAM_STR);
}

if (isset($sliderImageVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $sliderImageVo->description, PDO::PARAM_STR);
}

if (isset($sliderImageVo->link)){
if ($isFirst){
$updateFields.=' `link`= :link';
$isFirst=false;}else{
$updateFields.=', `link`= :link';
}
$params[]=array(':link', $sliderImageVo->link, PDO::PARAM_STR);
}

if (isset($sliderImageVo->order)){
if ($isFirst){
$updateFields.=' `order`= :order';
$isFirst=false;}else{
$updateFields.=', `order`= :order';
}
$params[]=array(':order', $sliderImageVo->order, PDO::PARAM_INT);
}

$conditions.=' where `slider_image_id`= :sliderImageId';
$params[]=array(':sliderImageId', $sliderImageId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (sliderImageId)
	 * Example
	 * getValueByPrimaryKey('sliderImageName', 1)
	 * Get value of filed sliderImageName in table sliderImage where sliderImageId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$sliderImageVo = $this->selectByPrimaryKey($primaryValue);
		if($sliderImageVo){
			return $sliderImageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('sliderImageName', array('sliderImageId' => 1))
	 * Get value of filed sliderImageName in table sliderImage where sliderImageId = 1
	 */
	public function getValueByField($fieldName, $where){
		$sliderImageVo = new SliderImageVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$sliderImageVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$sliderImageVos = $this->selectByFilter($sliderImageVo);
       
		if($sliderImageVos){
			$sliderImageVo = $sliderImageVos[0];
			return $sliderImageVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table slider_image
	 *
	 * @param int $slider_image_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($sliderImageId){
		try {
		    $sql = "DELETE FROM `slider_image` where `slider_image_id` = :sliderImageId";
		    $params = array();
		    $params[] = array(':sliderImageId', $sliderImageId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table slider_image
	 *
	 * @param object $sliderImageVo
	 * @return boolean
	 */
	public function deleteByFilter($sliderImageVo){
		try {
			$sql = 'DELETE FROM `slider_image`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($sliderImageVo->sliderImageId)){
				$isDel = true;
				$condition[] = '`slider_image_id` = :sliderImageId';
				$params[] = array(':sliderImageId', $sliderImageVo->sliderImageId, PDO::PARAM_INT);
			}
			if (!is_null($sliderImageVo->sliderId)){
				$isDel = true;
				$condition[] = '`slider_id` = :sliderId';
				$params[] = array(':sliderId', $sliderImageVo->sliderId, PDO::PARAM_INT);
			}
			if (!is_null($sliderImageVo->image)){
				$isDel = true;
				$condition[] = '`image` = :image';
				$params[] = array(':image', $sliderImageVo->image, PDO::PARAM_STR);
			}
			if (!is_null($sliderImageVo->title)){
				$isDel = true;
				$condition[] = '`title` = :title';
				$params[] = array(':title', $sliderImageVo->title, PDO::PARAM_STR);
			}
			if (!is_null($sliderImageVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $sliderImageVo->description, PDO::PARAM_STR);
			}
			if (!is_null($sliderImageVo->link)){
				$isDel = true;
				$condition[] = '`link` = :link';
				$params[] = array(':link', $sliderImageVo->link, PDO::PARAM_STR);
			}
			if (!is_null($sliderImageVo->order)){
				$isDel = true;
				$condition[] = '`order` = :order';
				$params[] = array(':order', $sliderImageVo->order, PDO::PARAM_INT);
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
