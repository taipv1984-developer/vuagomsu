<?php
Class Controller extends ActionSupport{
	function __construct(){
	}

	protected function setAttribute($attrName,$attrValue){
		$_REQUEST[$attrName] = $attrValue;
	}

	protected function setAttributes($arrAttributes){
		if(isset($arrAttributes)){
			foreach($arrAttributes as $key =>$value){
				$_REQUEST[$key] = $value;
			}
		}
	}

	protected function setRender($attrValue){
		$_REQUEST[TT_CTX][RENDER_KEY] = $attrValue;
	}
	
	protected function setRenderParam($attrName,$attrValue){
		$_REQUEST[TT_CTX][RENDER_KEY_URL_PARAM][$attrName] = $attrValue;
        $_REQUEST[TT_CTX][RENDER_KEY_URL_PARAM][$attrName] = $attrValue;
	}
	
	public function execute($method){
		$this->beforeExecute();
		$reflectionMethod = new ReflectionMethod($this, $method);
		$reflectionMethod->invoke($this);
		$this->afterExecute();
	}

	public function beforeExecute(){
		parent::beforeExecute();
	}
	
	public function afterExecute(){
		parent::afterExecute();
	}

	function __destruct(){
	}
	
	//zpham+
	protected function setJson($data){
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}