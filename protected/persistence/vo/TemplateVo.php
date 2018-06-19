<?php
class TemplateVo extends BaseVo{
	public $table_map = array(
		'template_id' => 'templateId',
		'name' => 'name',
		'status' => 'status',
	);

	public $templateId;
	public $name;
	public $status;
}