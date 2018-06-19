<?php
$object = array();
$object[FIELD_ERRORS]=$_REQUEST[TT_CTX][FIELD_ERRORS];
$object[ACTION_ERRORS]=$_REQUEST[TT_CTX][ACTION_ERRORS];
$object[ACTION_MESSAGES]=$_REQUEST[TT_CTX][ACTION_MESSAGES];
if(count($_REQUEST[TT_CTX][FIELD_ERRORS])==0 && count($_REQUEST[TT_CTX][ACTION_ERRORS])==0){
	$object['errorCode']='SUCCESS';
}else{
	if(count($_REQUEST[TT_CTX][FIELD_ERRORS])>0)
		$object['errorCode']='FIELD_ERROR';
	else
		$object['errorCode']='ACTION_ERROR';
}

ob_start();
try{
	if(!CTTHelper::isEmptyString($contentPath))
		include $contentPath;
	$content = ob_get_contents();
}catch(Exception $e){
}
ob_end_clean();
if($_REQUEST['encodedContentType']=='base64')
	$content = base64_encode($content);
$object['encodedContentType']=$_REQUEST['encodedContentType'];
$object['content']=$content;
echo json_encode($object, JSON_UNESCAPED_UNICODE);