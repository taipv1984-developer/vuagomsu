<?php
class NewsTagMapVo extends BaseVo{
	public $table_map = array(
		'news_tag_map_id' => 'newsTagMapId',
		'news_tag_id' => 'newsTagId',
		'news_id' => 'newsId',
	);

	public $newsTagMapId;
	public $newsTagId;
	public $newsId;
}