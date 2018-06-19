<?php
class LanguageValueVo extends BaseVo{
	public $table_map = array(
		'language_value_id' => 'languageValueId',
		'language_code' => 'languageCode',
		'key' => 'key',
		'value' => 'value',
	);

	public $languageValueId;
	public $languageCode;
	public $key;
	public $value;
}