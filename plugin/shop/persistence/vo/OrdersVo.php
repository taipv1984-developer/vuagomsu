<?php
class OrdersVo extends BaseVo{
	public $table_map = array(
		'order_id' => 'orderId',
		'customer_id' => 'customerId',
		'guest_id' => 'guestId',
		'subtotal' => 'subtotal',
		'total' => 'total',
		'total_weight' => 'totalWeight',
		'shipping_address_id' => 'shippingAddressId',
		'billing_address_id' => 'billingAddressId',
		'same_address' => 'sameAddress',
		'note' => 'note',
		'order_status_id' => 'orderStatusId',
		'is_del' => 'isDel',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
		'no' => 'no',
		'discountType' => 'discountType',
		'discountValue' => 'discountValue',
	);

	public $orderId;
	public $customerId;
	public $guestId;
	public $subtotal;
	public $total;
	public $totalWeight;
	public $shippingAddressId;
	public $billingAddressId;
	public $sameAddress;
	public $note;
	public $orderStatusId;
	public $isDel;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
	public $no;
	public $discountType;
	public $discountValue;
}