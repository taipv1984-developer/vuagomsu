<?php
class ApiSystemLogController extends Controller{
    public function add(){
        $systemLogDao = new SystemLogDao();
        $filterVo = new SystemLogVo();
        $filterVo->action = RequestUtil::get('action');
        $filterVo->params = RequestUtil::get('params');
        $filterVo->date = date('Y-m-d h:m:s');
        $systemLogId = $systemLogDao->insert($filterVo);

        //set data
        $this->setJson(array(
            'status' => 'api/system/log/add is successful',
            'systemLogId' => $systemLogId,
        ));

        //view
        return $this->setRender('success');
    }

//	public function get_link(){
//		$link = array(
//			'a' => '1',
//			'b' => '2',
//			'c' => '3',
//		);
//
//		//set data
//		$this->setJson(array(
//			'link' => $link,
//		));
//
//		//view
//		return $this->setRender('success');
//	}
}