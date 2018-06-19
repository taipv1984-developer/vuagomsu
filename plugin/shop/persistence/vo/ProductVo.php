<?php
class ProductVo extends BaseVo{
	public $table_map = array(
		'product_id' => 'productId',
		'manufac_id' => 'manufacId',
		'name' => 'name',
		'code' => 'code',
		'image' => 'image',
		'type' => 'type',
		'amount' => 'amount',
		'price' => 'price',
		'sale_of' => 'saleOf',
		'unit' => 'unit',
		'discount' => 'discount',
		'weight' => 'weight',
		'height' => 'height',
		'length' => 'length',
		'description' => 'description',
		'view_count' => 'viewCount',
		'status' => 'status',
		'youtube' => 'youtube',
		'facebook' => 'facebook',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
	);

	public $productId;
	public $manufacId;
	public $name;
	public $code;
	public $image;
	public $type;
	public $amount;
	public $price;
	public $saleOf;
	public $unit;
	public $discount;
	public $weight;
	public $height;
	public $length;
	public $description;
	public $viewCount;
	public $status;
	public $youtube;
	public $facebook;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
}