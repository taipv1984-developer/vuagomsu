<?php
class CurrencyDao extends BaseDao{
private $conn;
public function __construct() {
$this->conn = $GLOBALS['conn'];
}
public function selectAll(){
try {
    $sql = "select * from `currency`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery($sql));
    
    $stmt = $this->conn->prepare($sql);
    if ($stmt->execute()) {
        $row = $stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('CurrencyVo', $row);
    }
} catch (PDOException $e) {
    throw $e;
}
return null;
}

public function selectByPrimaryKey($currencyId){
$result = null;
try {
$stmt = $this->conn->prepare("select * from `currency` where `currency_id` = :currencyId");
$stmt->bindParam(':currencyId',$currencyId, PDO::PARAM_INT);

if ($stmt->execute()) {
$row= $stmt->fetchAll(PDO::FETCH_NAMED);
$result = PersistentHelper::mapResult('CurrencyVo', $row);
if (count($result)==1)
return $result[0];
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function getLastInsertId($currencyVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `currency`( `currency_code`, `description`, `after`, `symbol`, `coefficient`, `is_primary`, `decimals_separator`, `thousands_separator`, `decimals`, `status`)
VALUES( :currencyCode, :description, :after, :symbol, :coefficient, :isPrimary, :decimalsSeparator, :thousandsSeparator, :decimals, :status)");
$stmt->bindParam(':currencyCode', $currencyVo->currencyCode, PDO::PARAM_STR);
$stmt->bindParam(':description', $currencyVo->description, PDO::PARAM_STR);
$stmt->bindParam(':after', $currencyVo->after, PDO::PARAM_STR);
$stmt->bindParam(':symbol', $currencyVo->symbol, PDO::PARAM_STR);
$stmt->bindParam(':coefficient', $currencyVo->coefficient, PDO::PARAM_STR);
$stmt->bindParam(':isPrimary', $currencyVo->isPrimary, PDO::PARAM_STR);
$stmt->bindParam(':decimalsSeparator', $currencyVo->decimalsSeparator, PDO::PARAM_STR);
$stmt->bindParam(':thousandsSeparator', $currencyVo->thousandsSeparator, PDO::PARAM_STR);
$stmt->bindParam(':decimals', $currencyVo->decimals, PDO::PARAM_INT);
$stmt->bindParam(':status', $currencyVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function insert($currencyVo){
try {
$stmt = $this->conn->prepare("INSERT INTO `currency`( `currency_code`, `description`, `after`, `symbol`, `coefficient`, `is_primary`, `decimals_separator`, `thousands_separator`, `decimals`, `status`)
VALUES( :currencyCode, :description, :after, :symbol, :coefficient, :isPrimary, :decimalsSeparator, :thousandsSeparator, :decimals, :status)");
$stmt->bindParam(':currencyCode', $currencyVo->currencyCode, PDO::PARAM_STR);
$stmt->bindParam(':description', $currencyVo->description, PDO::PARAM_STR);
$stmt->bindParam(':after', $currencyVo->after, PDO::PARAM_STR);
$stmt->bindParam(':symbol', $currencyVo->symbol, PDO::PARAM_STR);
$stmt->bindParam(':coefficient', $currencyVo->coefficient, PDO::PARAM_STR);
$stmt->bindParam(':isPrimary', $currencyVo->isPrimary, PDO::PARAM_STR);
$stmt->bindParam(':decimalsSeparator', $currencyVo->decimalsSeparator, PDO::PARAM_STR);
$stmt->bindParam(':thousandsSeparator', $currencyVo->thousandsSeparator, PDO::PARAM_STR);
$stmt->bindParam(':decimals', $currencyVo->decimals, PDO::PARAM_INT);
$stmt->bindParam(':status', $currencyVo->status, PDO::PARAM_STR);
$stmt->execute();
return $this->conn->lastInsertId();
} catch (PDOException $e) {
throw $e;
}
return null;
}



/**
 * Get all item of table currency by $currencyVo object filter use paging
 * 
 * @param object $currencyVo is currency object
 * @param int $startRecord  startRecord    use paging
 * @param int $recordSize  recordSize use paging
 * @param array $orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 public function selectByFilter($currencyVo, $orderBy=array(), $startRecord=0, $recordSize=0){
try {
if (empty($currencyVo)) $currencyVo = new CurrencyVo();
$sql = "select * from `currency` ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($currencyVo->currencyId)){ //If isset Vo->element
$fieldValue=$currencyVo->currencyId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `currency_id` $key :currencyIdKey";
    $isFirst = false;
} else {
    $condition .= " and `currency_id` $key :currencyIdKey";
}
if($type == 'str') {
    $params[] = array(':currencyIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':currencyIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `currency_id` =  :currencyIdKey';
$isFirst=false;
}else{
$condition.=' and `currency_id` =  :currencyIdKey';
}
$params[]=array(':currencyIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($currencyVo->currencyCode)){ //If isset Vo->element
$fieldValue=$currencyVo->currencyCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `currency_code` $key :currencyCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `currency_code` $key :currencyCodeKey";
}
if($type == 'str') {
    $params[] = array(':currencyCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':currencyCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `currency_code` =  :currencyCodeKey';
$isFirst=false;
}else{
$condition.=' and `currency_code` =  :currencyCodeKey';
}
$params[]=array(':currencyCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->description)){ //If isset Vo->element
$fieldValue=$currencyVo->description;
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

if (!is_null($currencyVo->after)){ //If isset Vo->element
$fieldValue=$currencyVo->after;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `after` $key :afterKey";
    $isFirst = false;
} else {
    $condition .= " and `after` $key :afterKey";
}
if($type == 'str') {
    $params[] = array(':afterKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':afterKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `after` =  :afterKey';
$isFirst=false;
}else{
$condition.=' and `after` =  :afterKey';
}
$params[]=array(':afterKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->symbol)){ //If isset Vo->element
$fieldValue=$currencyVo->symbol;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `symbol` $key :symbolKey";
    $isFirst = false;
} else {
    $condition .= " and `symbol` $key :symbolKey";
}
if($type == 'str') {
    $params[] = array(':symbolKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':symbolKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `symbol` =  :symbolKey';
$isFirst=false;
}else{
$condition.=' and `symbol` =  :symbolKey';
}
$params[]=array(':symbolKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->coefficient)){ //If isset Vo->element
$fieldValue=$currencyVo->coefficient;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `coefficient` $key :coefficientKey";
    $isFirst = false;
} else {
    $condition .= " and `coefficient` $key :coefficientKey";
}
if($type == 'str') {
    $params[] = array(':coefficientKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':coefficientKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `coefficient` =  :coefficientKey';
$isFirst=false;
}else{
$condition.=' and `coefficient` =  :coefficientKey';
}
$params[]=array(':coefficientKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->isPrimary)){ //If isset Vo->element
$fieldValue=$currencyVo->isPrimary;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_primary` $key :isPrimaryKey";
    $isFirst = false;
} else {
    $condition .= " and `is_primary` $key :isPrimaryKey";
}
if($type == 'str') {
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_primary` =  :isPrimaryKey';
$isFirst=false;
}else{
$condition.=' and `is_primary` =  :isPrimaryKey';
}
$params[]=array(':isPrimaryKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->decimalsSeparator)){ //If isset Vo->element
$fieldValue=$currencyVo->decimalsSeparator;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `decimals_separator` $key :decimalsSeparatorKey";
    $isFirst = false;
} else {
    $condition .= " and `decimals_separator` $key :decimalsSeparatorKey";
}
if($type == 'str') {
    $params[] = array(':decimalsSeparatorKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':decimalsSeparatorKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `decimals_separator` =  :decimalsSeparatorKey';
$isFirst=false;
}else{
$condition.=' and `decimals_separator` =  :decimalsSeparatorKey';
}
$params[]=array(':decimalsSeparatorKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->thousandsSeparator)){ //If isset Vo->element
$fieldValue=$currencyVo->thousandsSeparator;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `thousands_separator` $key :thousandsSeparatorKey";
    $isFirst = false;
} else {
    $condition .= " and `thousands_separator` $key :thousandsSeparatorKey";
}
if($type == 'str') {
    $params[] = array(':thousandsSeparatorKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':thousandsSeparatorKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `thousands_separator` =  :thousandsSeparatorKey';
$isFirst=false;
}else{
$condition.=' and `thousands_separator` =  :thousandsSeparatorKey';
}
$params[]=array(':thousandsSeparatorKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->decimals)){ //If isset Vo->element
$fieldValue=$currencyVo->decimals;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `decimals` $key :decimalsKey";
    $isFirst = false;
} else {
    $condition .= " and `decimals` $key :decimalsKey";
}
if($type == 'str') {
    $params[] = array(':decimalsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':decimalsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `decimals` =  :decimalsKey';
$isFirst=false;
}else{
$condition.=' and `decimals` =  :decimalsKey';
}
$params[]=array(':decimalsKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($currencyVo->status)){ //If isset Vo->element
$fieldValue=$currencyVo->status;
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
return PersistentHelper::mapResult('CurrencyVo', $row);
}
} catch (PDOException $e) {
throw $e;
}
return null;
}


public function selectCountByFilter($currencyVo){
try {
if (empty($currencyVo)) $currencyVo = new CurrencyVo();
$sql = "select count(*) as total from  currency ";
$condition = '';
$params = array();
$isFirst = true;
if (!is_null($currencyVo->currencyId)){ //If isset Vo->element
$fieldValue=$currencyVo->currencyId;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `currency_id` $key :currencyIdKey";
    $isFirst = false;
} else {
    $condition .= " and `currency_id` $key :currencyIdKey";
}
if($type == 'str') {
    $params[] = array(':currencyIdKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':currencyIdKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `currency_id` =  :currencyIdKey';
$isFirst=false;
}else{
$condition.=' and `currency_id` =  :currencyIdKey';
}
$params[]=array(':currencyIdKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($currencyVo->currencyCode)){ //If isset Vo->element
$fieldValue=$currencyVo->currencyCode;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `currency_code` $key :currencyCodeKey";
    $isFirst = false;
} else {
    $condition .= " and `currency_code` $key :currencyCodeKey";
}
if($type == 'str') {
    $params[] = array(':currencyCodeKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':currencyCodeKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `currency_code` =  :currencyCodeKey';
$isFirst=false;
}else{
$condition.=' and `currency_code` =  :currencyCodeKey';
}
$params[]=array(':currencyCodeKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->description)){ //If isset Vo->element
$fieldValue=$currencyVo->description;
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

if (!is_null($currencyVo->after)){ //If isset Vo->element
$fieldValue=$currencyVo->after;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `after` $key :afterKey";
    $isFirst = false;
} else {
    $condition .= " and `after` $key :afterKey";
}
if($type == 'str') {
    $params[] = array(':afterKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':afterKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `after` =  :afterKey';
$isFirst=false;
}else{
$condition.=' and `after` =  :afterKey';
}
$params[]=array(':afterKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->symbol)){ //If isset Vo->element
$fieldValue=$currencyVo->symbol;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `symbol` $key :symbolKey";
    $isFirst = false;
} else {
    $condition .= " and `symbol` $key :symbolKey";
}
if($type == 'str') {
    $params[] = array(':symbolKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':symbolKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `symbol` =  :symbolKey';
$isFirst=false;
}else{
$condition.=' and `symbol` =  :symbolKey';
}
$params[]=array(':symbolKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->coefficient)){ //If isset Vo->element
$fieldValue=$currencyVo->coefficient;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `coefficient` $key :coefficientKey";
    $isFirst = false;
} else {
    $condition .= " and `coefficient` $key :coefficientKey";
}
if($type == 'str') {
    $params[] = array(':coefficientKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':coefficientKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `coefficient` =  :coefficientKey';
$isFirst=false;
}else{
$condition.=' and `coefficient` =  :coefficientKey';
}
$params[]=array(':coefficientKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->isPrimary)){ //If isset Vo->element
$fieldValue=$currencyVo->isPrimary;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `is_primary` $key :isPrimaryKey";
    $isFirst = false;
} else {
    $condition .= " and `is_primary` $key :isPrimaryKey";
}
if($type == 'str') {
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':isPrimaryKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `is_primary` =  :isPrimaryKey';
$isFirst=false;
}else{
$condition.=' and `is_primary` =  :isPrimaryKey';
}
$params[]=array(':isPrimaryKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->decimalsSeparator)){ //If isset Vo->element
$fieldValue=$currencyVo->decimalsSeparator;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `decimals_separator` $key :decimalsSeparatorKey";
    $isFirst = false;
} else {
    $condition .= " and `decimals_separator` $key :decimalsSeparatorKey";
}
if($type == 'str') {
    $params[] = array(':decimalsSeparatorKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':decimalsSeparatorKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `decimals_separator` =  :decimalsSeparatorKey';
$isFirst=false;
}else{
$condition.=' and `decimals_separator` =  :decimalsSeparatorKey';
}
$params[]=array(':decimalsSeparatorKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->thousandsSeparator)){ //If isset Vo->element
$fieldValue=$currencyVo->thousandsSeparator;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `thousands_separator` $key :thousandsSeparatorKey";
    $isFirst = false;
} else {
    $condition .= " and `thousands_separator` $key :thousandsSeparatorKey";
}
if($type == 'str') {
    $params[] = array(':thousandsSeparatorKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':thousandsSeparatorKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `thousands_separator` =  :thousandsSeparatorKey';
$isFirst=false;
}else{
$condition.=' and `thousands_separator` =  :thousandsSeparatorKey';
}
$params[]=array(':thousandsSeparatorKey', $fieldValue, PDO::PARAM_STR);
}}

if (!is_null($currencyVo->decimals)){ //If isset Vo->element
$fieldValue=$currencyVo->decimals;
if(is_array($fieldValue)){ //if is array
$key = $fieldValue[0];
$value = $fieldValue[1];
$type = (isset($fieldValue[2])) ? $fieldValue[2] : 'str';
if ($isFirst) {
    $condition .= " `decimals` $key :decimalsKey";
    $isFirst = false;
} else {
    $condition .= " and `decimals` $key :decimalsKey";
}
if($type == 'str') {
    $params[] = array(':decimalsKey', $value, PDO::PARAM_STR);
}
else{
    $params[] = array(':decimalsKey', $value, PDO::PARAM_INT);
}}
else{ //is not array
if ($isFirst){
$condition.=' `decimals` =  :decimalsKey';
$isFirst=false;
}else{
$condition.=' and `decimals` =  :decimalsKey';
}
$params[]=array(':decimalsKey', $fieldValue, PDO::PARAM_INT);
}}

if (!is_null($currencyVo->status)){ //If isset Vo->element
$fieldValue=$currencyVo->status;
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


public function updateByPrimaryKey($currencyVo,$currencyId){
try {
$sql="UPDATE `currency` SET ";
$updateFields = "";
$conditions = "";
$params = array();
$isFirst = true;
if (isset($currencyVo->currencyId)){
if ($isFirst){
$updateFields.=' `currency_id`= :currencyId';
$isFirst=false;}else{
$updateFields.=', `currency_id`= :currencyId';
}
$params[]=array(':currencyId', $currencyVo->currencyId, PDO::PARAM_INT);
}

if (isset($currencyVo->currencyCode)){
if ($isFirst){
$updateFields.=' `currency_code`= :currencyCode';
$isFirst=false;}else{
$updateFields.=', `currency_code`= :currencyCode';
}
$params[]=array(':currencyCode', $currencyVo->currencyCode, PDO::PARAM_STR);
}

if (isset($currencyVo->description)){
if ($isFirst){
$updateFields.=' `description`= :description';
$isFirst=false;}else{
$updateFields.=', `description`= :description';
}
$params[]=array(':description', $currencyVo->description, PDO::PARAM_STR);
}

if (isset($currencyVo->after)){
if ($isFirst){
$updateFields.=' `after`= :after';
$isFirst=false;}else{
$updateFields.=', `after`= :after';
}
$params[]=array(':after', $currencyVo->after, PDO::PARAM_STR);
}

if (isset($currencyVo->symbol)){
if ($isFirst){
$updateFields.=' `symbol`= :symbol';
$isFirst=false;}else{
$updateFields.=', `symbol`= :symbol';
}
$params[]=array(':symbol', $currencyVo->symbol, PDO::PARAM_STR);
}

if (isset($currencyVo->coefficient)){
if ($isFirst){
$updateFields.=' `coefficient`= :coefficient';
$isFirst=false;}else{
$updateFields.=', `coefficient`= :coefficient';
}
$params[]=array(':coefficient', $currencyVo->coefficient, PDO::PARAM_STR);
}

if (isset($currencyVo->isPrimary)){
if ($isFirst){
$updateFields.=' `is_primary`= :isPrimary';
$isFirst=false;}else{
$updateFields.=', `is_primary`= :isPrimary';
}
$params[]=array(':isPrimary', $currencyVo->isPrimary, PDO::PARAM_STR);
}

if (isset($currencyVo->decimalsSeparator)){
if ($isFirst){
$updateFields.=' `decimals_separator`= :decimalsSeparator';
$isFirst=false;}else{
$updateFields.=', `decimals_separator`= :decimalsSeparator';
}
$params[]=array(':decimalsSeparator', $currencyVo->decimalsSeparator, PDO::PARAM_STR);
}

if (isset($currencyVo->thousandsSeparator)){
if ($isFirst){
$updateFields.=' `thousands_separator`= :thousandsSeparator';
$isFirst=false;}else{
$updateFields.=', `thousands_separator`= :thousandsSeparator';
}
$params[]=array(':thousandsSeparator', $currencyVo->thousandsSeparator, PDO::PARAM_STR);
}

if (isset($currencyVo->decimals)){
if ($isFirst){
$updateFields.=' `decimals`= :decimals';
$isFirst=false;}else{
$updateFields.=', `decimals`= :decimals';
}
$params[]=array(':decimals', $currencyVo->decimals, PDO::PARAM_INT);
}

if (isset($currencyVo->status)){
if ($isFirst){
$updateFields.=' `status`= :status';
$isFirst=false;}else{
$updateFields.=', `status`= :status';
}
$params[]=array(':status', $currencyVo->status, PDO::PARAM_STR);
}

$conditions.=' where `currency_id`= :currencyId';
$params[]=array(':currencyId', $currencyId, PDO::PARAM_INT);
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
	 * Get value a field by PrimaryKey (currencyId)
	 * Example
	 * getValueByPrimaryKey('currencyName', 1)
	 * Get value of filed currencyName in table currency where currencyId = 1
	 */
	public function getValueByPrimaryKey($fieldName, $primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . $primaryValue);
		
		$currencyVo = $this->selectByPrimaryKey($primaryValue);
		if($currencyVo){
			return $currencyVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('currencyName', array('currencyId' => 1))
	 * Get value of filed currencyName in table currency where currencyId = 1
	 */
	public function getValueByField($fieldName, $where){
		$currencyVo = new CurrencyVo();
		$whereLog = [];
		foreach ($where as $k => $v){
			$currencyVo->{$k} = $v;
			$whereLog[] = "$k -> $v"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', $whereLog). ')');
        
		$currencyVos = $this->selectByFilter($currencyVo);
       
		if($currencyVos){
			$currencyVo = $currencyVos[0];
			return $currencyVo->$fieldName;
		}
		else{
			return null;
		}
	}



	/**
	 * deleteByPrimaryKey from table currency
	 *
	 * @param int $currency_id
	 * @return boolean
	 */
	public function deleteByPrimaryKey($currencyId){
		try {
		    $sql = "DELETE FROM `currency` where `currency_id` = :currencyId";
		    $params = array();
		    $params[] = array(':currencyId', $currencyId, PDO::PARAM_INT);
		    
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
	 * deleteByFilter from table currency
	 *
	 * @param object $currencyVo
	 * @return boolean
	 */
	public function deleteByFilter($currencyVo){
		try {
			$sql = 'DELETE FROM `currency`';
			$isDel = false;
			$condition = array();
			$params = array();
			if (!is_null($currencyVo->currencyId)){
				$isDel = true;
				$condition[] = '`currency_id` = :currencyId';
				$params[] = array(':currencyId', $currencyVo->currencyId, PDO::PARAM_INT);
			}
			if (!is_null($currencyVo->currencyCode)){
				$isDel = true;
				$condition[] = '`currency_code` = :currencyCode';
				$params[] = array(':currencyCode', $currencyVo->currencyCode, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->description)){
				$isDel = true;
				$condition[] = '`description` = :description';
				$params[] = array(':description', $currencyVo->description, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->after)){
				$isDel = true;
				$condition[] = '`after` = :after';
				$params[] = array(':after', $currencyVo->after, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->symbol)){
				$isDel = true;
				$condition[] = '`symbol` = :symbol';
				$params[] = array(':symbol', $currencyVo->symbol, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->coefficient)){
				$isDel = true;
				$condition[] = '`coefficient` = :coefficient';
				$params[] = array(':coefficient', $currencyVo->coefficient, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->isPrimary)){
				$isDel = true;
				$condition[] = '`is_primary` = :isPrimary';
				$params[] = array(':isPrimary', $currencyVo->isPrimary, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->decimalsSeparator)){
				$isDel = true;
				$condition[] = '`decimals_separator` = :decimalsSeparator';
				$params[] = array(':decimalsSeparator', $currencyVo->decimalsSeparator, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->thousandsSeparator)){
				$isDel = true;
				$condition[] = '`thousands_separator` = :thousandsSeparator';
				$params[] = array(':thousandsSeparator', $currencyVo->thousandsSeparator, PDO::PARAM_STR);
			}
			if (!is_null($currencyVo->decimals)){
				$isDel = true;
				$condition[] = '`decimals` = :decimals';
				$params[] = array(':decimals', $currencyVo->decimals, PDO::PARAM_INT);
			}
			if (!is_null($currencyVo->status)){
				$isDel = true;
				$condition[] = '`status` = :status';
				$params[] = array(':status', $currencyVo->status, PDO::PARAM_STR);
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
