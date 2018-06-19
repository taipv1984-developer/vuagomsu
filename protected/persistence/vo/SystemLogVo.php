<?php
class SystemLogVo extends BaseVo{
	public $table_map = array(
		'id' => 'id',
		'action' => 'action',
		'params' => 'params',
		'note' => 'note',
		'date' => 'date',
	);

	public $id;
	public $action;
	public $params;
	public $note;
	public $date;
}