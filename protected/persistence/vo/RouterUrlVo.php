<?php
class RouterUrlVo extends BaseVo{
	public $table_map = array(
		'router_url_id' => 'routerUrlId',
		'router_id' => 'routerId',
		'alias' => 'alias',
		'dispatch' => 'dispatch',
		'pk_name' => 'pkName',
		'pk_value' => 'pkValue',
		'redirect_to' => 'redirectTo',
		'is_del' => 'isDel',
	);

	public $routerUrlId;
	public $routerId;
	public $alias;
	public $dispatch;
	public $pkName;
	public $pkValue;
	public $redirectTo;
	public $isDel;
}