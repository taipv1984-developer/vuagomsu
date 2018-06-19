<?php
class HelpVo extends BaseVo{
	public $table_map = array(
		'help_id' => 'helpId',
		'help_cat_id' => 'helpCatId',
		'title' => 'title',
		'content' => 'content',
		'router' => 'router',
	);

	public $helpId;
	public $helpCatId;
	public $title;
	public $content;
	public $router;
}