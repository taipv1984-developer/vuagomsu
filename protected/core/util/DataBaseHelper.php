<?php
class DataBaseHelper{
	/**
	 * get $whereCondition with $filter
	 *
	 * @param array $filter = array('customer_id' => $customerId, 'email' => arrray('like', $mail))
	 * @return string
	 */
	public static function getWhereCondition($filter){
		$where = array();
		foreach ($filter as $k => $v){
			if(!is_array($v)){
				$where[] = "$k='$v'";
			}
			else{
				$condition = $v[0];
				$value = $v[1];
				$type = (isset($v[2])) ? $v[2] : 'str';
				if($condition == 'between'){
					$where[] = "($k $condition '$v[1]' and '$v[2]')";
				}
				else{	//like, in, ...
					if($type == 'int'){
						if($value != '' & $value != "'%%'") $where[] = "$k $condition $value";
					}
					else{
						if($value != '' & $value != "'%%'") $where[] = "$k $condition '$value'";
					}
				}
			}
		}
		$whereCondition = (count($where) > 0) ? join(' and ', $where) : '';
	
		return ($whereCondition != '') ? "where $whereCondition" : '';
	}
	
	/**
	 * getOrderCondition apply for filter sql
	 *
	 * @param $order array(field_key, ASC|DESC)
	 * 		example: $order = array(product_id, 'DESC') => ORDER BY product_id DESC
	 */
	public static function getOrderCondition($order=array()){
		if(count($order) == 0){
			return '';
		}
		else{
			$orderSQL = array();
			foreach ($order as $k => $v){
				$orderSQL[] = "$k $v";
			}
			return "ORDER BY ".join(', ', $orderSQL);
		}
	}
	
	/**
	 * getLimitCondition apply for filter sql
	 *
	 * @param $startRecord int
	 * @param $recordSize int
	 * @return => LIMIT $startRecord, $recordSize
	 */
	public static function getLimitCondition($startRecord=0, $recSize=0){
		return ($recSize) ? " LIMIT $startRecord, $recSize" : '';
	}
	
	/**
	 * return a sql query(not apply for sql include table name param)
	 *
	 * @param string $sql
	 * @param array $params = array(key, value, type('int'*))
	 * @param string $outputType(array || string || null)
	 * $output = array(
			'type' => 'array',
			'key' => 'productId',
			'value' => 'productName'
		);
		$output = 'insert' 	=> return last id insert
		else case null|update|delete => return true
	 */
	public static function query($sql, $params=array(), $output=array('type' => 'object')){
		$conn = $GLOBALS ['conn'];
		try{
			$stmt = $conn->prepare($sql);
			foreach($params as $v){
				$key = $v[0];
				$value = $v[1];
				if(!isset($v[2])) $v[2] = 'int';
				if(strtolower($v[2])== 'int'){
					$type = PDO::PARAM_INT;
					$value = (int)$value;
				}
				else{
					$type = PDO::PARAM_STR;
					$value = htmlspecialchars($value);
				}
				$stmt->bindParam($key, $value, $type);
			}

            //debug
            LogUtil::sql('(query) '. DataBaseHelper::renderQuery($sql, $params));

            if($stmt->execute()){
				if(isset($output['type'])){
					$outputType = $output['type'];
					if($outputType == 'object'){	//default
						$query = $stmt->fetchAll(PDO::FETCH_NAMED);
						$ret = array();
						foreach($query as $data){
							$object = new stdClass();
							foreach($data as $k => $v){
								$key = StringHelper::toCamelCase($k);
								$object->$key = $v;
							}
							if(isset($output['key'])){
								$fieldKey = StringHelper::toCamelCase($output['key']);
								$ret[$object->$fieldKey] = $object;
							}
							else{
								$ret[] = $object;
							}
						}
						return $ret;
					}
					else if($outputType == 'array'){
						$query = $stmt->fetchAll(PDO::FETCH_NAMED);
						$ret = array();
						$fieldValue = StringHelper::toCamelCase($output['value']);
						foreach($query as $data){
							$object = null;
							foreach($data as $k => $v){
								$key = StringHelper::toCamelCase($k);
								$object->$key = $v;
							}
							if(isset($output['key'])){
								$fieldKey = StringHelper::toCamelCase($output['key']);
								$ret[$object->$fieldKey] = $object->$fieldValue;
							}
							else{
								$ret[] = $object->$fieldValue;
							}
						}

						return $ret;
					}
				}
				else if($output == 'insert'){
					return $conn->lastInsertId();
				}
				else{	//null|update|delete
					return true;
				}
			}
			else{
				LogUtil::error("[DB/query] sql not execute ... sql = $sql");
			}
		}
		catch(PDOException $e){
			LogUtil::error("[DB/query] sql = $sql");
			LogUtil::error("[DB/query] PDOException = " . $e->getMessage());
			throw $e;
		}
	}
	
	public static function renderQuery($sql, $params){
	    foreach ($params as $v){
	        $key = $v[0];
            $value = $v[1];
            $type = isset($v[2]) ? $v[2] : 1;   //1(int) 2(string)
            if($type == 2){
                $value = "'$value'";
            }
            $sql = str_replace($key, $value, $sql);
        }
        return $sql;
    }
}