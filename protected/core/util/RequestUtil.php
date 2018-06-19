<?php
class RequestUtil {
	public static function get($key) {
		return isset ( $_REQUEST [$key] ) ? $_REQUEST [$key] : null;
	}
	public static function set($key, $value) {
		$_REQUEST [$key] = $value;
	}
}