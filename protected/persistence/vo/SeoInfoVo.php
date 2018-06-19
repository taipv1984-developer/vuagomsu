<?php
class SeoInfoVo extends BaseVo{
	public $table_map = array(
		'item_id' => 'itemId',
		'type' => 'type',
		'url' => 'url',
		'title' => 'title',
		'keyword' => 'keyword',
		'description' => 'description',
	);

	public $itemId;
	public $type;
	public $url;
	public $title;
	public $keyword;
	public $description;
}