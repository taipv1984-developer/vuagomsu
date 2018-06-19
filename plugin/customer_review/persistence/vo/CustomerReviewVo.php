<?php
class CustomerReviewVo extends BaseVo{
	public $table_map = array(
		'customer_review_id' => 'customerReviewId',
		'name' => 'name',
		'career' => 'career',
		'phone' => 'phone',
		'email' => 'email',
		'image' => 'image',
		'title' => 'title',
		'content' => 'content',
		'status' => 'status',
		'crt_date' => 'crtDate',
	);

	public $customerReviewId;
	public $name;
	public $career;
	public $phone;
	public $email;
	public $image;
	public $title;
	public $content;
	public $status;
	public $crtDate;
}