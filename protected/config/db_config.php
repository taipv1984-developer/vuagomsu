<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$conn = null;

//ON LOCAL
$database ='vuagomsu';
$username = 'root';
$password = '';
//serverInfo
//$database ='rshxjwithosting_my_tool';
//$username = 'rshxjwithosting_my_tool';
//$password = 'myDB@123';
try{
	$conn = new PDO('mysql:host=localhost;dbname='.$database, $username, $password,array(
			PDO::ATTR_PERSISTENT => true,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	));
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	print "Error!: " . $e->getMessage(). "<br/>";
}
function getDatabaseConnection(){
	$conn1 = null;
	global $database, $username, $password;
	try{
		$conn1 = new PDO('mysql:host=localhost;dbname='.$database, $username, $password,array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		));
		$conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		print "Error!: " . $e->getMessage(). "<br/>";
	}
	return $conn1;
}