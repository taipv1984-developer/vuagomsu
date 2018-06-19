<?php
class NewsVo extends BaseVo{
	public $table_map = array(
		'news_id' => 'newsId',
		'news_category_id' => 'newsCategoryId',
		'image' => 'image',
		'title' => 'title',
		'summary' => 'summary',
		'content' => 'content',
		'view_count' => 'viewCount',
		'status' => 'status',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
	);

	public $newsId;
	public $newsCategoryId;
	public $image;
	public $title;
	public $summary;
	public $content;
	public $viewCount;
	public $status;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
}