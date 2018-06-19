<?php
class NewsletterEmailTemplateVo extends BaseVo{
	public $table_map = array(
		'newsletter_email_template_id' => 'newsletterEmailTemplateId',
		'key' => 'key',
		'subject' => 'subject',
		'content' => 'content',
	);

	public $newsletterEmailTemplateId;
	public $key;
	public $subject;
	public $content;
}