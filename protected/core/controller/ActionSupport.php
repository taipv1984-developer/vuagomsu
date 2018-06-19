<?php
class ActionSupport{

	private $fieldErrors = array();
	private $actionErrors = array();
	private $actionMessages = array();
	protected $resourceBundle = null;

	public function getFieldErrors(){
		return $this->fieldErrors;
	}

	public function getErrorFields(){
		return array_keys($this->fieldErrors);
	}

	public function getFieldErrorMessages(){
		return array_values($this->fieldErrors);
	}

	public function addFieldError($fieldName, $errorMessage){
		if(!CTTHelper::isEmptyString($fieldName)&& !CTTHelper::isEmptyString($errorMessage))
			$this->fieldErrors[$fieldName][]=$errorMessage;
	}

	public function clearFieldErrors(){
		$this->fieldErrors = array();
	}

	public function clearErrorField($fieldName){
		if(!CTTHelper::isEmptyString($fieldName))
			unset($this->errors[$fieldName]);
	}

	public function hasFieldErrors(){
		if(count($this->fieldErrors)>0)
			return true;
		else
			return false;
	}

	//------------------------------------------------------

	public function addActionError($message){
		if(!CTTHelper::isEmptyString($message))
			$this->actionErrors[]=$message;
	}

	public function clearActionErrors(){
		$this->actionErrors = array();
	}

	public function getActionErrors(){
		return $this->actionErrors;
	}

	public function hasActionErrors(){
		if(count($this->actionErrors)>0)
			return true;
		else
			return false;
	}

	//------------------------------------------------------

	public function addActionMessage($message){
		if(!CTTHelper::isEmptyString($message))
			$this->actionMessages[]=$message;
	}

	public function clearActionMessages(){
		$this->actionMessages = array();
	}

	public function getActionMessages(){
		return $this->actionMessages;
	}

	public function hasActionMessages(){
		if(count($this->actionMessages)>0)
			return true;
		else
			return false;
	}

	public function hasErrors(){
		if($this->hasActionErrors()|| $this->hasFieldErrors())
			return true;
		else
			return false;
	}
	public function getText($key,$default=""){
		$str = $default;
		if(isset($this->resourceBundle)){
			$str = $this->resourceBundle->getText($key);
			if(CTTHelper::isEmptyString($str))
				$str = $default;
		}
		return $str;
	}

	public function beforeExecute(){

	}
	public function afterExecute(){
		$_REQUEST[TT_CTX][FIELD_ERRORS]=$this->fieldErrors;
		$_REQUEST[TT_CTX][ACTION_MESSAGES]=$this->actionMessages;
		$_REQUEST[TT_CTX][ACTION_ERRORS]=$this->actionErrors;
	}

}