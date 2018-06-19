<?php
class OrderProductVo extends BaseVo{
	public $table_map = array(
		'order_product_id' => 'orderProductId',
		'order_id' => 'orderId',
		'product_id' => 'productId',
		'attribute_value_id' => 'attributeValueId',
		'price' => 'price',
		'quantity' => 'quantity',
	);

	public $orderProductId;
	public $orderId;
	public $productId;
	public $attributeValueId;
	public $price;
	public $quantity;
}