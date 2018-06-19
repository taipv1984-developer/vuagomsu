<?php
class NewsCategoryVo extends BaseVo{
	public $table_map = array(
		'news_category_id' => 'newsCategoryId',
		'name' => 'name',
		'parent_id' => 'parentId',
		'image' => 'image',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
	);

	public $newsCategoryId;
	public $name;
	public $parentId;
	public $image;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
}