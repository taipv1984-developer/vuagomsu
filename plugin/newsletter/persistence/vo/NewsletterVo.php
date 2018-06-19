<?php
class NewsletterVo extends BaseVo{
	public $table_map = array(
		'newsletter_id' => 'newsletterId',
		'email' => 'email',
		'subscribe' => 'subscribe',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
	);

	public $newsletterId;
	public $email;
	public $subscribe;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
}