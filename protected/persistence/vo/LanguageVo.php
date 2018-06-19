<?php
class LanguageVo extends BaseVo{
	public $table_map = array(
		'language_id' => 'languageId',
		'language_code' => 'languageCode',
		'name' => 'name',
		'status' => 'status',
		'country_code' => 'countryCode',
		'default' => 'default',
	);

	public $languageId;
	public $languageCode;
	public $name;
	public $status;
	public $countryCode;
	public $default;
}