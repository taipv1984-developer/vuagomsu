<?php

class TimeHelper {
	
	public static function convertTimeFormat($time, $toFormat) {
		$convertTime = strtoupper($time);
		switch ($toFormat){
			case "12":
				if (strpos($convertTime, 'AM') !== false || strpos($convertTime, 'PM') !== false) {
					return $convertTime;
				}else{
					$timeArr = explode(":", $convertTime);
					if ($timeArr[0] < 12){
						return $convertTime." AM";
					}else{
						$hour = $timeArr[0] - 12;
						$min = $timeArr[1];
						return $hour.":".$min." PM";
					}
				}
				break;
			case "24":
				if (strpos($convertTime, 'PM') !== false) {
					$timeArr = explode(":", self::removePeriod($convertTime));
					$hour = $timeArr[0] + 12;
					$min = $timeArr[1];
					return $hour.":".$min;
				}else if (strpos($convertTime, 'AM') !== false) {
					return self::removePeriod($convertTime);
				}else{
					return $convertTime;
				}
				break;
		}
		return $convertTime;
	}
	
	private static function removePeriod($time) {
		$patterns = array();
		$patterns[0] = '/am/';
		$patterns[1] = '/AM/';
		$patterns[2] = '/pm/';
		$patterns[3] = '/PM/';
		$patterns[4] = '/ /';
		$replacements = array();
		$replacements[0] = '';
		$replacements[1] = '';
		$replacements[2] = '';
		$replacements[3] = '';
		$replacements[4] = '';
		return trim(preg_replace($patterns, $replacements, $time));
	}
	
}