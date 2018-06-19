<?php
function replaceTags($startPoint, $endPoint, $newText, $source)
{
    // preg_replace('#('.preg_quote($startPoint).')(.*)('.preg_quote($endPoint).')#si', '$1'.$newText.'$3', $source);
    return preg_replace('#(' . preg_quote($startPoint) . ')(.*)(' . preg_quote($endPoint) . ')#si', $newText, $source);
}

function getDataType($str)
{
    if (strpos($str, '(')) {
        return strtoupper(substr($str, 0, strpos($str, '(')));
    } else
        return strtoupper($str);
}

function toCamelCase($string, $capitalizeFirstCharacter = false)
{
    $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    if (!$capitalizeFirstCharacter) {
        $str [0] = strtolower($str [0]);
    }
    return $str;
}

function getReplaceKeyList($tableName)
{
    return array(
        '{table}' => toCamelCase($tableName, false),
        '{Ctable}' => toCamelCase($tableName, true),
        '{Table}' => toCamelCase($tableName, true),
    );
}

function databaseInfo($conn)
{
    try {
        $stmt = $conn->prepare("show databases");
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $row = $stmt->fetchAll(PDO::FETCH_NAMED);
            var_dump($row);
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
    }
}

function tableInfo($conn, $database)
{
    try {
        $stmt = $conn->prepare("show tables from `$database`");
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $row = $stmt->fetchAll(PDO::FETCH_NAMED);
            var_dump($row);
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
    }
}

function columnInfo($conn, $tableName)
{
    try {
        $stmt = $conn->prepare("show columns from `$tableName`");
        if ($stmt->execute()) {
            $row = $stmt->fetchAll(PDO::FETCH_NAMED);
            return $row;
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
    }
}

//genVo
function genVo($tableName, $dbInfo, $conn, $pluginCode = ''){
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);

    ob_start();
    echo '<?php' . $br;
    $classVoHeader = 'class ' . toCamelCase($tableName, true) . 'Vo extends BaseVo{';
    $classVoFooter = '}';
    $str = "\t".'public $table_map = array(' .$br;
    $propertyStr = '';
    foreach ($columnInfo as $column) {
        $str .= "\t\t'" . $column ['Field'] . '\' => \'' . toCamelCase($column ['Field']) . '\',' . $br;
        $propertyStr .= $br . "\tpublic $" . toCamelCase($column ['Field']) . ';';
    }
    $str .= "\t". ');' . $br;
    echo $classVoHeader . $br;
    echo $str;
    echo $propertyStr . $br;
    echo $classVoFooter;
    $objVo = ob_get_contents();
    ob_end_clean();

    if ($pluginCode == '') {
        $nameVo = PROTECTED_PATH . 'persistence/vo/' . toCamelCase($tableName, true) . 'Vo.php';
    } else {
        $nameVo = PLUGIN_PATH . "$pluginCode/persistence/vo/" . toCamelCase($tableName, true) . 'Vo.php';
    }

    echo "[genVo] $nameVo<br>";
    $fileVo = fopen($nameVo, "w");
    fwrite($fileVo, $objVo);
    fclose($fileVo);
}

//genMo
function genMo($tableName, $dbInfo, $conn, $pluginCode = '')
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $replaceKeyList = getReplaceKeyList($tableName);

    $contentModel = "<?php
class {Table}Model extends {Table}Vo {
	
}";
    $contentModel = strtr($contentModel, $replaceKeyList);
    if ($pluginCode == '') {//default
        $nameModel = PROTECTED_PATH . 'model/' . toCamelCase($tableName, true) . 'Model.php';
    } else {
        $nameModel = PLUGIN_PATH . "$pluginCode/model/" . toCamelCase($tableName, true) . 'Model.php';
    }
    $fileModel = fopen($nameModel, "w");
    fwrite($fileModel, $contentModel);
    fclose($fileModel);

    echo "[genMo] $nameModel<br>";
}

//genDao
function selectAll($tableName, $dbInfo, $conn){
    $br = PHP_EOL;
    $replaceKeyList = array(
        '{tableName}' => $tableName,
        '{tableMapVo}' => toCamelCase($tableName, true) . 'Vo',
    );

    $str = <<<str
public function selectAll(){
try {
    \$sql = "select * from `{tableName}`";
    
    //debug
    LogUtil::sql('(selectAll) '. DataBaseHelper::renderQuery(\$sql));
    
    \$stmt = \$this->conn->prepare(\$sql);
    if (\$stmt->execute()) {
        \$row = \$stmt->fetchAll(PDO::FETCH_NAMED);
        return PersistentHelper::mapResult('{tableMapVo}', \$row);
    }
} catch (PDOException \$e) {
    throw \$e;
}
return null;
}
str;

    return strtr($str, $replaceKeyList);
}

function selectByPrimaryKey($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $isFirst = true;

    $str = '';
    $str .= 'public function selectByPrimaryKey(';
    foreach ($columnInfo as $column) {
        if (isset ($column ['Key']) && $column ['Key'] == 'PRI') {
            if ($isFirst) {
                $str .= '$' . toCamelCase($column ['Field']);
                $isFirst = false;
            } else
                $str .= ', $' . toCamelCase($column ['Field']);
        }
    }
    $str .= '){' . $br;
    $str .= '$result = null;' . $br;
    $str .= 'try {' . $br;
    $str .= '$stmt = $this->conn->prepare("select * from ' . '`' . $tableName . '`' . ' where ';
    $isFirst = true;
    $strBinParam = '';
    foreach ($columnInfo as $column) {
        if (isset ($column ['Key']) && $column ['Key'] == 'PRI') {
            if ($isFirst) {
                $str .= '`' . $column ['Field'] . '`' . ' = :' . toCamelCase($column ['Field']);
                $isFirst = false;
            } else
                $str .= ' and ' . '`' . $column ['Field'] . '`' . ' = :' . toCamelCase($column ['Field']);

            if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
                $strBinParam .= '$stmt->bindParam(\':' . toCamelCase($column ['Field']) . '\',$' . toCamelCase($column ['Field']) . ', PDO::PARAM_INT);' . $br;
            } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
                $strBinParam .= '$stmt->bindParam(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
            } else {
                $strBinParam .= '$stmt->bindParam(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($column ['Field']) . ');' . $br;
            }
        }
    }
    $str .= '");' . $br;

    $str .= $strBinParam . $br;

    $str .= 'if ($stmt->execute()) {' . $br;
    $str .= '$row= $stmt->fetchAll(PDO::FETCH_NAMED);' . $br;
    $str .= '$result = PersistentHelper::mapResult(\'' . toCamelCase($tableName, true) . 'Vo\', $row);' . $br;
    $str .= 'if (count($result)==1)' . $br;
    $str .= 'return $result[0];' . $br;
    $str .= '}' . $br;
    $str .= '} catch (PDOException $e) {' . $br;
    $str .= 'throw $e;' . $br;
    $str .= '}' . $br;
    $str .= 'return null;' . $br;
    $str .= '}' . $br;

    return $str;
}

function getLastInsertId($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $isFirst = true;

    $str = '';
    $str .= 'public function getLastInsertId($' . toCamelCase($tableName, false) . 'Vo){' . $br;
    $str .= 'try {' . $br;
    $str .= '$stmt = $this->conn->prepare("INSERT INTO ' . '`' . $tableName . '`';
    $valueStr = ' ';
    $paramStr = ' ';
    $strBinParam = '';
    foreach ($columnInfo as $column) {
        if ($column ['Extra'] != 'auto_increment') {
            if ($isFirst) {
                $valueStr .= '`' . $column ['Field'] . '`';
                $paramStr .= ':' . toCamelCase($column ['Field']);
                $isFirst = false;
            } else {
                $valueStr .= ', ' . '`' . $column ['Field'] . '`';
                $paramStr .= ', :' . toCamelCase($column ['Field']);
            }

            if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
                $strBinParam .= '$stmt->bindParam(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_INT);' . $br;
            } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
                $strBinParam .= '$stmt->bindParam(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
            } else {
                $strBinParam .= '$stmt->bindParam(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ');' . $br;
            }
        }
    }
    $str .= '(' . $valueStr . ')' . $br;
    $str .= 'VALUES(' . $paramStr . ')");' . $br;
    $str .= $strBinParam;
    $str .= '$stmt->execute();' . $br;
    $str .= 'return $this->conn->lastInsertId();' . $br;
    $str .= '} catch (PDOException $e) {' . $br;
    $str .= 'throw $e;' . $br;
    $str .= '}' . $br;
    $str .= 'return null;' . $br;
    $str .= '}' . $br;

    return $str;
}

function insert($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $isFirst = true;

    $str = '';
    $str .= 'public function insert($' . toCamelCase($tableName, false) . 'Vo){' . $br;
    $str .= 'try {' . $br;
    $valueStr = ' ';
    $paramStr = ' ';
	$paramValue = '';
	$str .= '$params = [];' .$br;
    foreach ($columnInfo as $column) {
        if ($column ['Extra'] != 'auto_increment') {
            if ($isFirst) {
                $valueStr .= '`' . $column ['Field'] . '`';
                $paramStr .= ':' . toCamelCase($column ['Field']);
                $isFirst = false;
            } else {
                $valueStr .= ', ' . '`' . $column ['Field'] . '`';
                $paramStr .= ', :' . toCamelCase($column ['Field']);
            }
            if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
	            $paramValue .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_INT);' . $br;
            } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
	            $paramValue .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
            } else {
	            $paramValue .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', $' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ');' . $br;
            }
        }
    }
    $str .= "\$sql = \"INSERT INTO `$tableName` ($valueStr) $br VALUES($paramStr)\";" .$br.$br;
	$str .= $paramValue . $br;


	$str .= "\$stmt = \$this->conn->prepare(\$sql);" . $br;
	$str .= 'foreach ($params as $param){' . $br;
	$str .= '$stmt->bindParam($param[0], $param[1], $param[2]);' . $br;
	$str .= '}' . $br;
    $str .= '$stmt->execute();' . $br;

	$debug = <<<debug
//debug
LogUtil::sql('(insert) '. DataBaseHelper::renderQuery(\$sql, \$params));
debug;
	$str .= $br .$debug .$br .$br;

    $str .= 'return $this->conn->lastInsertId();' . $br;
    $str .= '} catch (PDOException $e) {' . $br;
    $str .= 'throw $e;' . $br;
    $str .= '}' . $br;
    $str .= 'return null;' . $br;
    $str .= '}' . $br;

    return $str;
}

function selectByFilter($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $isFirst = true;

    // ----------------------------------------------------------------------------------------------------------------
    $voName = '$' . toCamelCase($tableName, false) . 'Vo';
    $str = '';
    $str .= "
/**
 * Get all item of table $tableName by $voName object filter use paging
 * 
 * @param object $voName is $tableName object
 * @param int \$startRecord  startRecord    use paging
 * @param int \$recordSize  recordSize use paging
 * @param array \$orderBy = array(key => value)
 *      
 * @return array vo object || NULL
 */
 ";
    $str .= 'public function selectByFilter(' . $voName . ', $orderBy=array(), $startRecord=0, $recordSize=0){' . $br;
    $str .= 'try {' . $br;
    $str .= 'if (empty(' . $voName . ')) ' . $voName . ' = new ' . toCamelCase($tableName, true) . 'Vo();' . $br;
    $str .= '$sql = "select * from ' . '`' . $tableName . '`' . ' ";' . $br;
    $str .= '$condition = \'\';' . $br;
    $str .= '$params = array();' . $br;
    $str .= '$isFirst = true;' . $br;

    foreach ($columnInfo as $column) {
        $str .= 'if (!is_null(' . $voName . '->' . toCamelCase($column ['Field'], false) . ')){ //If isset Vo->element' . $br;
        $str .= '$fieldValue' . '=' . $voName . '->' . toCamelCase($column ['Field']) . ';' . $br;
        $str .= 'if(is_array($fieldValue'. ')){ //if is array' . $br;

        $replaceKeyList = array(
            '{fieldId}' => $column ['Field'],
            '{fieldKey}' => toCamelCase($column ['Field']) . 'Key',
        );
        $conditionRender = <<<conditionRender
\$key = \$fieldValue[0];
\$value = \$fieldValue[1];
\$type = (isset(\$fieldValue[2])) ? \$fieldValue[2] : 'str';
if (\$isFirst) {
    \$condition .= " `{fieldId}` \$key :{fieldKey}";
    \$isFirst = false;
} else {
    \$condition .= " and `{fieldId}` \$key :{fieldKey}";
}
if(\$type == 'str') {
    \$params[] = array(':{fieldKey}', \$value, PDO::PARAM_STR);
}
else{
    \$params[] = array(':{fieldKey}', \$value, PDO::PARAM_INT);
}
conditionRender;
        $str .= strtr($conditionRender, $replaceKeyList);
        $str .= '}' . $br;

        $str .= 'else{ //is not array' . $br;
        $str .= 'if ($isFirst){' . $br;
        $str .= '$condition.=\' `' . $column ['Field'] . '` =  :' . toCamelCase($column ['Field']) . 'Key\';' . $br;
        $str .= '$isFirst=false;' . $br;
        $str .= '}else{' . $br;
        $str .= '$condition.=\' and `' . $column ['Field'] . '` =  :' . toCamelCase($column ['Field']) . 'Key\';' . $br;
        $str .= '}' . $br;
        if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . 'Key\', ' . '$fieldValue'. ', PDO::PARAM_INT);' . $br;
        } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . 'Key\', ' . '$fieldValue'. ', PDO::PARAM_STR);' . $br;
        } else {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . 'Key\', ' . '$fieldValue'. ', PDO::PARAM_STR);' . $br;
        }
        $str .= '}}' . $br . $br;
    }

    //append condition
    $str .= 'if (!empty($condition)){' . $br;
    $str .= '$sql.=\' where \'. $condition;' . $br;
    $str .= '}' . $br;

    //append orderBy
    $str .= $br. '//order by <field> asc/desc' . $br;
    $str .= "if(count(\$orderBy) != 0){
    \$orderBySql = 'ORDER BY ';
    foreach (\$orderBy as \$k => \$v){
        \$orderBySql .= \"" . "`" . "\$k" . "`" . " \$v, \";
    }
    \$orderBySql = substr(\$orderBySql, 0 , strlen(\$orderBySql)-2);
    \$sql.= \" \".trim(\$orderBySql).\" \";
}
";
    $str .= "if(\$recordSize != 0) {" . $br;
    $str .= '$sql = $sql.\' limit \'.$startRecord.\',\'.$recordSize;' . $br;
    $str .= "}" . $br;
    $str .= $br;

    $debug = <<<debug
//debug
LogUtil::sql('(selectByFilter) '. DataBaseHelper::renderQuery(\$sql, \$params));
debug;
    $str .= $debug .$br;

    $str .= $br;
    $str .= '$stmt = $this->conn->prepare($sql);' . $br;
    $str .= 'foreach ($params as $param){' . $br;
    $str .= '$stmt->bindParam($param[0], $param[1], $param[2]);' . $br;
    $str .= '}' . $br;
    $str .= 'if ($stmt->execute()) {' . $br;
    $str .= '$row= $stmt->fetchAll(PDO::FETCH_NAMED);' . $br;
    $str .= 'return PersistentHelper::mapResult(\'' . toCamelCase($tableName, true) . 'Vo\', $row);' . $br;
    $str .= '}' . $br;
    $str .= '} catch (PDOException $e) {' . $br;
    $str .= 'throw $e;' . $br;
    $str .= '}' . $br;
    $str .= 'return null;' . $br;
    $str .= '}' . $br;

    return $str;
}

function selectCountByFilter($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $isFirst = true;

    $voName = '$' . toCamelCase($tableName, false) . 'Vo';
    $str = '';
    $str .= 'public function selectCountByFilter(' . $voName . '){' . $br;
    $str .= 'try {' . $br;
    $str .= 'if (empty(' . $voName . ')) ' . $voName . ' = new ' . toCamelCase($tableName, true) . 'Vo();' . $br;
    $str .= '$sql = "select count(*) as total from  ' . $tableName . ' ";' . $br;
    $str .= '$condition = \'\';' . $br;
    $str .= '$params = array();' . $br;
    $str .= '$isFirst = true;' . $br;

    //copy from selectByFilter function start
    foreach ($columnInfo as $column) {
        $str .= 'if (!is_null(' . $voName . '->' . toCamelCase($column ['Field'], false) . ')){ //If isset Vo->element' . $br;
        $str .= '$fieldValue' . '=' . $voName . '->' . toCamelCase($column ['Field']) . ';' . $br;
        $str .= 'if(is_array($fieldValue'. ')){ //if is array' . $br;

        $replaceKeyList = array(
            '{fieldId}' => $column ['Field'],
            '{fieldKey}' => toCamelCase($column ['Field']) . 'Key',
        );
        $conditionRender = <<<conditionRender
\$key = \$fieldValue[0];
\$value = \$fieldValue[1];
\$type = (isset(\$fieldValue[2])) ? \$fieldValue[2] : 'str';
if (\$isFirst) {
    \$condition .= " `{fieldId}` \$key :{fieldKey}";
    \$isFirst = false;
} else {
    \$condition .= " and `{fieldId}` \$key :{fieldKey}";
}
if(\$type == 'str') {
    \$params[] = array(':{fieldKey}', \$value, PDO::PARAM_STR);
}
else{
    \$params[] = array(':{fieldKey}', \$value, PDO::PARAM_INT);
}
conditionRender;
        $str .= strtr($conditionRender, $replaceKeyList);
        $str .= '}' . $br;

        $str .= 'else{ //is not array' . $br;
        $str .= 'if ($isFirst){' . $br;
        $str .= '$condition.=\' `' . $column ['Field'] . '` =  :' . toCamelCase($column ['Field']) . 'Key\';' . $br;
        $str .= '$isFirst=false;' . $br;
        $str .= '}else{' . $br;
        $str .= '$condition.=\' and `' . $column ['Field'] . '` =  :' . toCamelCase($column ['Field']) . 'Key\';' . $br;
        $str .= '}' . $br;
        if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . 'Key\', ' . '$fieldValue'. ', PDO::PARAM_INT);' . $br;
        } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . 'Key\', ' . '$fieldValue'. ', PDO::PARAM_STR);' . $br;
        } else {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . 'Key\', ' . '$fieldValue'. ', PDO::PARAM_STR);' . $br;
        }
        $str .= '}}' . $br . $br;
    }
    //copy from selectByFilter function end

    //append condition
    $str .= 'if (!empty($condition)){' . $br;
    $str .= '$sql.=\' where \'. $condition;' . $br;
    $str .= '}' . $br;
    $str .= $br;

    $debug = <<<debug
//debug
LogUtil::sql('(selectCountByFilter) '. DataBaseHelper::renderQuery(\$sql, \$params));
debug;
    $str .= $debug .$br;

    $str .= $br;
    $str .= '$stmt = $this->conn->prepare($sql);' . $br;
    $str .= 'foreach ($params as $param){' . $br;
    $str .= '$stmt->bindParam($param[0], $param[1], $param[2]);' . $br;
    $str .= '}' . $br;
    $str .= 'if ($stmt->execute()) {' . $br;
    $str .= '$row= $stmt->fetchAll(PDO::FETCH_NAMED);' . $br;
    $str .= 'if (isset($row)){' . $br;
    $str .= 'return $row[0][\'total\'];' . $br;
    $str .= '}' . $br;
    $str .= '}' . $br;
    $str .= '} catch (PDOException $e) {' . $br;
    $str .= 'throw $e;' . $br;
    $str .= '}' . $br;
    $str .= 'return null;' . $br;
    $str .= '}' . $br;

    return $str;

}

function updateByPrimaryKey($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $isFirst = true;

    $str = '';
    $str .= 'public function updateByPrimaryKey($' . toCamelCase($tableName, false) . 'Vo,';
    foreach ($columnInfo as $column) {
        if (isset ($column ['Key']) && $column ['Key'] == 'PRI') {
            if ($isFirst) {
                $str .= '$' . toCamelCase($column ['Field']);
                $isFirst = false;
            } else
                $str .= ', $' . toCamelCase($column ['Field']);
        }
    }
    $str .= '){' . $br;

    $str .= 'try {' . $br;
    $str .= '$sql="UPDATE `' . $tableName . '` SET ";' . $br;
    $str .= '$updateFields = "";' . $br;
    $str .= '$conditions = "";' . $br;
    $str .= '$params = array();' . $br;
    $str .= '$isFirst = true;' . $br;
    $voName = '$' . toCamelCase($tableName, false) . 'Vo';

    foreach ($columnInfo as $column) {
        $str .= 'if (isset(' . $voName . '->' . toCamelCase($column ['Field'], false) . ')){' . $br;
        $str .= 'if ($isFirst){' . $br;
        $str .= '$updateFields.=\' ' . '`' . $column ['Field'] . '`' . '= :' . toCamelCase($column ['Field']) . '\';' . $br;
        $str .= '$isFirst=false;';
        $str .= '}else{' . $br;
        $str .= '$updateFields.=\', ' . '`' . $column ['Field'] . '`' . '= :' . toCamelCase($column ['Field']) . '\';' . $br;
        $str .= '}' . $br;

        if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', ' . '$' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_INT);' . $br;
        } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', ' . '$' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
        } else {
            $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', ' . '$' . toCamelCase($tableName, false) . 'Vo->' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
        }
        $str .= '}' . $br . $br;
    }

    $isFirst = true;
    foreach ($columnInfo as $column) {
        if (isset ($column ['Key']) && $column ['Key'] == 'PRI') {
            if ($isFirst) {
                $str .= '$conditions.=\' where ' . '`' . $column ['Field'] . '`' . '= :' . toCamelCase($column ['Field']) . '\';' . $br;
                $isFirst = false;
            } else {
                $str .= '$conditions.=\' and ' . '`' . $column ['Field'] . '`' . '= :' . toCamelCase($column ['Field']) . '\';' . $br;
            }

            if (in_array(getDataType($column ['Type']), $dbInfo['type']['numeric'])) {
                $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', ' . '$' . toCamelCase($column ['Field']) . ', PDO::PARAM_INT);' . $br;
            } else if (in_array(getDataType($column ['Type']), $dbInfo['type']['text'])) {
                $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', ' . '$' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
            } else {
                $str .= '$params[]=array(\':' . toCamelCase($column ['Field']) . '\', ' . '$' . toCamelCase($column ['Field']) . ', PDO::PARAM_STR);' . $br;
            }
        }
    }

    $str .= '$sql.= $updateFields.$conditions;' . $br;

    $debug = <<<debug
//debug
LogUtil::sql('(updateByPrimaryKey) '. DataBaseHelper::renderQuery(\$sql, \$params));
debug;
    $str .= $debug .$br;

    $str .= '$stmt = $this->conn->prepare($sql);' . $br;
    $str .= 'foreach ($params as $param){' . $br;
    $str .= '$stmt->bindParam($param[0], $param[1], $param[2]);' . $br;
    $str .= '}' . $br;

    $str .= 'return $stmt->execute();' . $br;
    $str .= '} catch (PDOException $e) {' . $br;
    $str .= 'throw $e;' . $br;
    $str .= '}' . $br;
    $str .= 'return null;' . $br;
    $str .= '}' . $br;

    return $str;
}

function getValueByPrimaryKey($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $replaceKeyList = getReplaceKeyList($tableName);

    $getValueByPrimaryKey = "
	/**
	 * Get value a field by PrimaryKey ({table}Id)
	 * Example
	 * getValueByPrimaryKey('{table}Name', 1)
	 * Get value of filed {table}Name in table {table} where {table}Id = 1
	 */
	public function getValueByPrimaryKey(\$fieldName, \$primaryValue){
	    //debug
        LogUtil::sql('(getValueByPrimaryKey) ... primaryValue = ' . \$primaryValue);
		
		\${table}Vo = \$this->selectByPrimaryKey(\$primaryValue);
		if(\${table}Vo){
			return \${table}Vo->\$fieldName;
		}
		else{
			return null;
		}
	}" . $br;
    return strtr($getValueByPrimaryKey, $replaceKeyList);
}

function getValueByField($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $replaceKeyList = getReplaceKeyList($tableName);

    $getValueByField = "
	/**
	 * Get value a field by field list input where
	 * Example
	 * getValueByField('{table}Name', array('{table}Id' => 1))
	 * Get value of filed {table}Name in table {table} where {table}Id = 1
	 */
	public function getValueByField(\$fieldName, \$where){
		\${table}Vo = new {Ctable}Vo();
		\$whereLog = [];
		foreach (\$where as \$k => \$v){
			\${table}Vo->{\$k} = \$v;
			\$whereLog[] = \"\$k -> \$v\"; 
		}
		
		//debug
        LogUtil::sql('(getValueByField) ... where = ' . '(' .join(', ', \$whereLog). ')');
        
		\${table}Vos = \$this->selectByFilter(\${table}Vo);
       
		if(\${table}Vos){
			\${table}Vo = \${table}Vos[0];
			return \${table}Vo->\$fieldName;
		}
		else{
			return null;
		}
	}" . $br;
    return strtr($getValueByField, $replaceKeyList);
}

function deleteByPrimaryKey($tableName, $dbInfo, $conn)
{
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $replaceKeyList = getReplaceKeyList($tableName);

    //find primarykey
    $primaryKey = false;
    $casePrimaryKey = false;
    $typePrimaryKey = false;
    foreach ($columnInfo as $column) {
        if (isset($column['Key']) && $column['Key'] == 'PRI') {
            $primaryKey = $column['Field'];
            $casePrimaryKey = toCamelCase($column ['Field']);
            $typePrimaryKey = (in_array(getDataType($column['Type']), $dbInfo['type']['numeric'])) ? 'PDO::PARAM_INT' : 'PDO::PARAM_STR';
            break;
        }
    }

    if ($primaryKey) {
        $deleteByPrimaryKey = "
	/**
	 * deleteByPrimaryKey from table $tableName
	 *
	 * @param int \$$primaryKey
	 * @return boolean
	 */
	public function deleteByPrimaryKey(\$$casePrimaryKey){
		try {
		    \$sql = \"DELETE FROM `$tableName` where `$primaryKey` = :$casePrimaryKey\";
		    \$params = array();
		    \$params[] = array(':$casePrimaryKey', \$$casePrimaryKey, $typePrimaryKey);
		    
		    //debug
		    LogUtil::sql('(deleteByPrimaryKey) '. DataBaseHelper::renderQuery(\$sql, \$params));
		    
			\$stmt = \$this->conn->prepare(\$sql);
			foreach (\$params as \$param){
				\$stmt->bindParam(\$param[0], \$param[1], \$param[2]);
			}
			\$stmt->execute();
			return true;
		} 
		catch (PDOException \$e) {
			throw \$e;
		}
		return null;
	}" . $br;
        return strtr($deleteByPrimaryKey, $replaceKeyList);
    }
}

function deleteByFilter($tableName, $dbInfo, $conn){
    $br = PHP_EOL;
    $columnInfo = columnInfo($conn, $tableName);
    $replaceKeyList = getReplaceKeyList($tableName);

    $deleteByFilter = "
	/**
	 * deleteByFilter from table $tableName
	 *
	 * @param object \${table}Vo
	 * @return boolean
	 */
	public function deleteByFilter(\${table}Vo){
		try {
			\$sql = 'DELETE FROM `$tableName`';
			\$isDel = false;
			\$condition = array();
			\$params = array();";

    foreach ( $columnInfo as $column ) {
        $field = $column ['Field'];
        $caseField = toCamelCase($column ['Field']);
        $typeField = (in_array(getDataType($column['Type']), $dbInfo['type']['numeric'] )) ? 'PDO::PARAM_INT' : 'PDO::PARAM_STR';
        $deleteByFilter .= "
			if (!is_null(\${table}Vo->$caseField)){
				\$isDel = true;
				\$condition[] = '`$field` = :$caseField';
				\$params[] = array(':$caseField', \${table}Vo->$caseField, $typeField);
			}";
    }

    $deleteByFilter .= "
			if(!\$isDel){
				return null;
			}
			else{
				\$sql .= ' WHERE ' . join(' and ', \$condition);
			}
		
			//debug
			LogUtil::sql('(deleteByFilter) '. DataBaseHelper::renderQuery(\$sql, \$params));
		
			\$stmt = \$this->conn->prepare(\$sql);
			foreach (\$params as \$param){
				\$stmt->bindParam(\$param[0], \$param[1], \$param[2]);
			}
			\$stmt->execute();
			return true;
		}
		catch (PDOException \$e) {
			throw \$e;
		}
		return null;
	}".$br;
    return strtr($deleteByFilter, $replaceKeyList);
}

function genDao($tableName, $dbInfo, $conn, $pluginCode = '')
{
    $br = PHP_EOL;
    ob_start();

    $header = '';
    $header .= '<?php' . $br;
    $header .= 'class ' . toCamelCase($tableName, true) . 'Dao extends BaseDao{' . $br;
    $header .= 'private $conn;' . $br;
    $header .= 'public function __construct() {' . $br;
    $header .= '$this->conn = $GLOBALS[\'conn\'];' . $br;
    $header .= '}' . $br;
    echo $header;

    $str = '';
    $str .= selectAll($tableName, $dbInfo, $conn) . $br. $br;           //log ok
    $str .= selectByPrimaryKey($tableName, $dbInfo, $conn) . $br. $br;  //
    $str .= getLastInsertId($tableName, $dbInfo, $conn) . $br. $br;     //
    $str .= insert($tableName, $dbInfo, $conn) . $br. $br;              //
    $str .= selectByFilter($tableName, $dbInfo, $conn) . $br. $br;      //log ok
    $str .= selectCountByFilter($tableName, $dbInfo, $conn) . $br. $br; //log ok
    $str .= updateByPrimaryKey($tableName, $dbInfo, $conn) . $br. $br;  //log ok

    $str .= getValueByPrimaryKey($tableName, $dbInfo, $conn) . $br. $br;//log ok
    $str .= getValueByField($tableName, $dbInfo, $conn) . $br. $br;     //log ok
    $str .= deleteByPrimaryKey($tableName, $dbInfo, $conn) . $br. $br;  //log ok
    $str .= deleteByFilter($tableName, $dbInfo, $conn) . $br. $br;      //log ok

    echo $str;

    echo '}' . $br;
    $objDao = ob_get_contents();
    ob_end_clean();
    if ($pluginCode == '') {//default
        $nameDao = PROTECTED_PATH . 'persistence/dao/' . toCamelCase($tableName, true) . 'Dao.php';
    } else {
        $nameDao = PLUGIN_PATH . "$pluginCode/persistence/dao/" . toCamelCase($tableName, true) . 'Dao.php';
    }

    echo "[genDao] $nameDao<br>";
    $fileVo = fopen($nameDao, "w");
    fwrite($fileVo, $objDao);
    fclose($fileVo);
}