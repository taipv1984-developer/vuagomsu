<?php
class AdminGenCodeController extends Controller{
    
    function __construct(){
   }
    
	public function index(){
		//$table = $_REQUEST['table'];//language_value';
		//$override = (isset($_REQUEST['override'])) ? $_REQUEST['override'] : false;
		$table = 'static_page';
		$override = false;
		$pluginCode = '/';
		
		$Table = StringHelper::toCamelCase($table, true);	//upcase all
		$id = StringHelper::toCamelCase($this->getPrimaryKey($table));
		
		$pathTemp = BASE_PATH . "/protected/view/admin/gen_code";
		if($pluginCode == ''){//default
			$pathController = BASE_PATH . "/protected/controller/admin";
			$pathView = BASE_PATH . "/protected/view/admin";
			$pathConfig = BASE_PATH . "/protected/config";
		}
		else{
			$pathController = BASE_PATH . "/protected/plugin/$pluginCode/controller/admin";
			$pathView = BASE_PATH . "/protected/plugin/$pluginCode/view/admin";
			$pathConfig = BASE_PATH . "/protected/plugin/$pluginCode/config";
		}
		
		//make folder
		$folderView = $pathView . "/" . $table;
		if(!is_dir($folderView))mkdir($folderView);
		
		$controllerTemp = "$pathTemp/template/controller.temp";
		$manageTemp 	= "$pathTemp/template/manage.temp";
		$addEditTemp 	= "$pathTemp/template/add_edit.temp";
		$configTemp 	= "$pathTemp/template/config.temp";
		
		$controllerTempContent 	= file_get_contents($controllerTemp);
		$manageTempContent 		= file_get_contents($manageTemp);
		$addEditTempContent 	= file_get_contents($addEditTemp);
		$configTempContent 		= file_get_contents($configTemp);
		
		$controllerFile = "$pathController/Admin{$Table}Controller.temp";
		$manageFile 	= $folderView."/manage.temp";
		$addEditFile 	= $folderView."/add_edit.temp";
		$configFile 	= $pathConfig."/action_config.temp";
		
		//convert data
    	$data = array();
    	$data['id'] 		= $id;										//id				//id
    	$data['table'] 		= $table;									//order_status		//shipping
    	$data['tableVo'] 	= StringHelper::toCamelCase($table);		//orderStatus		//shipping
    	$data['tableText'] 	= ucwords(str_replace('_', ' ', $table));	//Orders Status		//Shipping
    	$data['Table'] 		= $Table;									//OrderStatus		//Shipping
    	
    	
		//array replaces
		$aReplace = array(
			'{id}' 			=> $data['id'],
			'{table}' 		=> $data['table'],
			'{tableVo}' 	=> $data['tableVo'],
			'{tableText}' 	=> $data['tableText'],
			'{Table}' 		=> $data['Table'],
		);
		
		//replace template content
		$configContent = strtr($configTempContent, $aReplace);
		$controllerContent = strtr($controllerTempContent, $aReplace);
		$manageContent = strtr($manageTempContent, $aReplace);
		$addEditContent = strtr($addEditTempContent, $aReplace);
		
		// send data
		$this->setAttributes(array(
			'configContent' 	=> $configContent,
			'controllerContent' => $controllerContent,
			'manageContent' 	=> $manageContent,
			'addContent' 		=> $addEditContent,
		));
		
		if($override){
			//save file controller
			$fp = @fopen($controllerFile, "w");
			@fwrite($fp, $controllerContent);
			@fclose($fp);
			
			//save file manage
			$fp = @fopen($manageFile, "w");
			@fwrite($fp, $manageContent);
			@fclose($fp);
	
			//save file add_edit
			$fp = @fopen($addEditFile, "w");
			@fwrite($fp, $addEditContent);
			@fclose($fp);
		}
		
        return $this->setRender('success');
   }
   
   /**
    * getAllDatabase
    *
    * @return array
    */
   private function getAllDatabase(){
   	$conn = $GLOBALS ['conn'];
   	$databases = array();
   	try{
   		$stmt = $conn->prepare("show databases");
   		if($stmt->execute()){
   			$row = $stmt->fetchAll(PDO::FETCH_NAMED);
   			foreach($row as $array){
   				foreach($array as $v){
   					$databases[$v] = $v;
   				}
   			}
   		}
   	}
   	catch(PDOException $e){
   		LogUtil::devInfo("[DB/getAllDatabase] " . $e->getMessage());
   	}
   
   	return $databases;
   }
   
   /**
    * getAllTable in $database
    *
    * @param string $database
    * @return array
    */
   private function getAllTable($database){
   	$conn = $GLOBALS ['conn'];
   	$tables = array();
   	try{
   		$stmt = $conn->prepare("show tables from `$database`");
   		if($stmt->execute()){
   			$row = $stmt->fetchAll(PDO::FETCH_NAMED);
   			foreach($row as $array){
   				foreach($array as $v){
   					$tables[$v] = $v;
   				}
   			}
   		}
   	}
   	catch(PDOException $e){
   		LogUtil::devInfo("[DB/getAllTable] " . $e->getMessage());
   	}
   
   	return $tables;
   }
   
   /**
    * getAllColumn of table in data base
    *
    * @param string $table
    * @return array
    */
   private function getAllColumn($table){
   	$conn = $GLOBALS ['conn'];
   	$columns = array();
   	try{
   		$stmt = $conn->prepare("show columns from `$table`");
   		if($stmt->execute()){
   			$row = $stmt->fetchAll(PDO::FETCH_NAMED);
   			foreach($row as $v){
   				$columns[$v['Field']] = $v['Field'];
   			}
   		}
   	}
   	catch(PDOException $e){
   		LogUtil::devInfo("[DB/getAllColumn] " . $e->getMessage());
   	}
   
   	return $columns;
   }
   
   /**
    * getTableInfo of table in data base
    *
    * @param string $table
    * @return array array(Field, Type, Null, Key, Default, Extra)
    */
    private function getTableInfo($table){
   	$conn = $GLOBALS ['conn'];
   	try{
   		$stmt = $conn->prepare("show columns from `$table`");
   		if($stmt->execute()){
   			$row = $stmt->fetchAll(PDO::FETCH_NAMED);
   			return $row;
   		}
   	}
   	catch(PDOException $e){
   		LogUtil::devInfo("[DB/getColumnInfo] " . $e->getMessage());
   	}
   
   	return null;
   }
   
   /**
    * getPrimaryKey of $table\
    *
    * @param string $table
    * @return string
    */
   private function getPrimaryKey($table){
   	$tableInfo = $this->getTableInfo($table);
   	foreach($tableInfo as $v){
   		if($v['Key'] == 'PRI')return $v['Field'];
   	}
   	return null;
   }
}
