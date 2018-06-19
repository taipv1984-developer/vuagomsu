<?php
class SliderVo extends BaseVo{
	public $table_map = array(
		'slider_id' => 'sliderId',
		'name' => 'name',
		'description' => 'description',
	);

	public $sliderId;
	public $name;
	public $description;
}