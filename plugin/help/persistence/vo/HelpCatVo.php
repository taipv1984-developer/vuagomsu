<?php
class HelpCatVo extends BaseVo{
	public $table_map = array(
		'help_cat_id' => 'helpCatId',
		'name' => 'name',
		'description' => 'description',
		'status' => 'status',
	);

	public $helpCatId;
	public $name;
	public $description;
	public $status;
}