<?php
class StaticPageDetailVo extends BaseVo{
	public $table_map = array(
		'static_page_detail_id' => 'staticPageDetailId',
		'static_page_id' => 'staticPageId',
		'title' => 'title',
		'content' => 'content',
		'sub_content' => 'subContent',
		'open_link' => 'openLink',
	);

	public $staticPageDetailId;
	public $staticPageId;
	public $title;
	public $content;
	public $subContent;
	public $openLink;
}