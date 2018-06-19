<?php
class EmailTemplateVo extends BaseVo{
	public $table_map = array(
		'email_template_id' => 'emailTemplateId',
		'key' => 'key',
		'subject' => 'subject',
		'content' => 'content',
		'note' => 'note',
		'status' => 'status',
	);

	public $emailTemplateId;
	public $key;
	public $subject;
	public $content;
	public $note;
	public $status;
}