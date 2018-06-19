<?php
use common\constant\Attributes;
use common\dto\ResponseStatusDto;
use core\config\ActionConfig;
use core\config\ApplicationConfig;
use core\config\FConstants;
use core\utils\ActionUtil;
use core\utils\AppUtil;
function exceptionHandler($exception){
	$errorMessageId = uniqid();
	$errorMessage = "";
	LogUtil::error("Error Message Id: " . $errorMessageId);
	LogUtil::error($exception->getMessage() . " Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine());
	LogUtil::error($exception);
	$errorMessage .= "<h1>Error:" . $exception->getCode() . "</h1>";
	$errorMessage .= "<p>Error Message Id: " . $errorMessageId . "</p>";
	$errorMessage .= "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
	$errorMessage .= "<p>Message: '" . $exception->getMessage() . "'</p>";
	$errorMessage .= "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
	$errorMessage .= "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
	LogUtil::error($errorMessage);
//	errorHandler($errorMessage, $errorMessageId, $exception->getCode());
}

function fatalErrorShutdownHandler(){
	$last_error = error_get_last();
	if (isset($last_error) && ($last_error['type'] & (E_ERROR | E_USER_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_RECOVERABLE_ERROR | E_PARSE))) {
		$errorMessage = "";
		$errorMessageId = uniqid();
		$errorMessage = "Error Message Id: " . $errorMessageId . " " . $last_error['type'] . " - " . $last_error['message'] . " in " . $last_error['file'] . " at line " . $last_error['line'];
		LogUtil::error("Error Message Id: " . $errorMessageId);
		LogUtil::error($errorMessage);
		LogUtil::error($last_error);
//		errorHandler($errorMessage, $errorMessageId);
	}
}
//
//function errorHandler($errorMessage, $errorMessageId = null, $errorCode = null){
//	$customMessage = $errorMessage;
//	if (ApplicationConfig::get('production.mode') !== 'dev') {
//		$customMessage = AppUtil::defaultIfEmpty(ApplicationConfig::get("system.error.message"), "Server internal error, please contact the administrator.");
//		$customMessage = "Error Message Id: " . $errorMessageId . " " . $customMessage;
//	}
//	$isJsonRequest = isset($_REQUEST["rtype"]) && "json" === $_REQUEST["rtype"];
//	$isApiRequest = isset($_REQUEST["rtype"]) && "api" === $_REQUEST["rtype"];
//	if ($isJsonRequest) {
//		header("Content-Type: application/json");
//		echo json_encode(array(
//				'errorCode' => 'ACTION_ERROR',
//				'errorMessage' => $customMessage,
//				'content' => ""
//		));
//	} else if ($isApiRequest) {
//		$responseStatusDto = new ResponseStatusDto();
//		$responseStatusDto->addActionError($customMessage);
//		$context = array();
//		$context[Attributes::RESPONSE_STATUS_DTO] = $responseStatusDto;
//		header("Content-Type: application/json");
//		$jsonResult = json_encode(array(
//				'data' => serialize($context)
//		));
//		echo FConstants::API_RESPONSE_QUOTE.base64_encode($jsonResult).FConstants::API_RESPONSE_QUOTE;
//		echo FConstants::API_RESPONSE_END_QUOTE."ERROR".FConstants::API_RESPONSE_END_QUOTE;
//		echo FConstants::API_RESPONSE_END_DETAIL_QUOTE.$errorMessage.FConstants::API_RESPONSE_END_DETAIL_QUOTE;
//	} else {
//		switch ($errorCode) {
//			case 404:
//				$errorPath = "err/404";
//				// 				if ($errorPath === RouteUtil::getRoute()->getPath()){
//				// 					header ( 'location:' . ActionUtil::getFullPathAlias(""));
//				// 					return;
//				// 				}
//				if (is_null(ActionConfig::getActionMap($errorPath))) {
//					echo $customMessage;
//				} else {
//					$friendlyName = null;
//					if (!is_null(ApplicationConfig::get("action.alias.list"))) {
//						foreach (ApplicationConfig::get("action.alias.list") as $key => $value) {
//							if ($value === $errorPath) {
//								$friendlyName = $key;
//								break;
//							}
//						}
//					}
//					if (!is_null($friendlyName)) {
//						header('location:' . ActionUtil::getFullPathAlias($errorPath));
//					} else {
//						header('location:' . ActionUtil::getFullPathAlias($errorPath));
//					}
//					return;
//				}
//				break;
//			default:
//				echo $customMessage;
//				break;
//		}
//	}
//}
