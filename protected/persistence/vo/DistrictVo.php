<?php
class DistrictVo extends BaseVo{
	public $table_map = array(
		'district_id' => 'districtId',
		'name' => 'name',
		'city_id' => 'cityId',
		'order' => 'order',
	);

	public $districtId;
	public $name;
	public $cityId;
	public $order;
}