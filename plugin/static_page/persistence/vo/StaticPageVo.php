<?php
class StaticPageVo extends BaseVo{
	public $table_map = array(
		'static_page_id' => 'staticPageId',
		'image' => 'image',
		'title' => 'title',
		'summary' => 'summary',
		'content' => 'content',
		'status' => 'status',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
	);

	public $staticPageId;
	public $image;
	public $title;
	public $summary;
	public $content;
	public $status;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
}