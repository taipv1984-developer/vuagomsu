<?php
class FileVo extends BaseVo{
	public $table_map = array(
		'file_id' => 'fileId',
		'name' => 'name',
		'orig_name' => 'origName',
		'vitual_path' => 'vitualPath',
		'table_map' => 'tableMap',
		'type' => 'type',
		'size' => 'size',
		'status' => 'status',
	);

	public $fileId;
	public $name;
	public $origName;
	public $vitualPath;
	public $tableMap;
	public $type;
	public $size;
	public $status;
}