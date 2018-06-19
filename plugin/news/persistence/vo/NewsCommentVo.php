<?php
class NewsCommentVo extends BaseVo{
	public $table_map = array(
		'comment_id' => 'commentId',
		'news_id' => 'newsId',
		'parent_id' => 'parentId',
		'comment' => 'comment',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
	);

	public $commentId;
	public $newsId;
	public $parentId;
	public $comment;
	public $crtDate;
	public $crtBy;
}