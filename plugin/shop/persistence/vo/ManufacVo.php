<?php
class ManufacVo extends BaseVo{
	public $table_map = array(
		'manufac_id' => 'manufacId',
		'name' => 'name',
		'image' => 'image',
	);

	public $manufacId;
	public $name;
	public $image;
}