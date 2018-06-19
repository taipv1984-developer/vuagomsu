<?php
class RouterVo extends BaseVo{
	public $table_map = array(
		'router_id' => 'routerId',
		'layout_id' => 'layoutId',
		'pk_name' => 'pkName',
		'prefix' => 'prefix',
		'suffix' => 'suffix',
		'alias' => 'alias',
		'alias_by' => 'aliasBy',
		'alias_list' => 'aliasList',
		'callback' => 'callback',
	);

	public $routerId;
	public $layoutId;
	public $pkName;
	public $prefix;
	public $suffix;
	public $alias;
	public $aliasBy;
	public $aliasList;
	public $callback;
}