<?php
class SliderImageVo extends BaseVo{
	public $table_map = array(
		'slider_image_id' => 'sliderImageId',
		'slider_id' => 'sliderId',
		'image' => 'image',
		'title' => 'title',
		'description' => 'description',
		'link' => 'link',
		'order' => 'order',
	);

	public $sliderImageId;
	public $sliderId;
	public $image;
	public $title;
	public $description;
	public $link;
	public $order;
}