<?php
class CurrencyVo extends BaseVo{
	public $table_map = array(
		'currency_id' => 'currencyId',
		'currency_code' => 'currencyCode',
		'description' => 'description',
		'after' => 'after',
		'symbol' => 'symbol',
		'coefficient' => 'coefficient',
		'is_primary' => 'isPrimary',
		'decimals_separator' => 'decimalsSeparator',
		'thousands_separator' => 'thousandsSeparator',
		'decimals' => 'decimals',
		'status' => 'status',
	);

	public $currencyId;
	public $currencyCode;
	public $description;
	public $after;
	public $symbol;
	public $coefficient;
	public $isPrimary;
	public $decimalsSeparator;
	public $thousandsSeparator;
	public $decimals;
	public $status;
}