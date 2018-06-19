<?php
class TemplateExt{
	public static function getTemplateActive(){
		$templateVo = new TemplateVo();
		$templateDao = new TemplateDao();
		$templateVo->status = 'A';
		$templateVos = $templateDao->selectByFilter($templateVo);
		return ($templateVos) ? $templateVos[0]->name : '';
	}
}