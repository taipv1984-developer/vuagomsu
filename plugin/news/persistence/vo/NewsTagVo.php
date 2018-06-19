<?php
class NewsTagVo extends BaseVo{
	public $table_map = array(
		'news_tag_id' => 'newsTagId',
		'name' => 'name',
		'description' => 'description',
	);

	public $newsTagId;
	public $name;
	public $description;
}