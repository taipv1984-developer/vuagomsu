<?php
/**
 * Common process datetime data type
 */
class DateHelper{
	public static function getCurentDay(){
		return date('d', time());
	}
	public static function getCurentMonth(){
		return date('m', time());
	}
	public static function getCurentYear(){
		return date('Y', time());
	}
	/**
	 * getDateFormat
	 * 	
	 * @return string Registry::getSetting('date_format')
	 */
	public static function getDateFormat(){
		return Registry::getSetting('date_format');	
	}
	
	/**
	 * getDate(format date by system_setting date_format)
	 * 
	 * @return string
	 */
	public static function getDate(){
		return date(Registry::getSetting('date_format'));	
	}

    public static function getSqlDate(){
        return date('Y-m-d h:m:s');
    }

	public static function getDateTime(){
		return date(Registry::getSetting('date_time_format'));
	}
	
	public static function getDateFromDatePicker($date){
		$date_picker_format = Registry::getSetting('date_picker_format');
		switch ($date_picker_format){
			case 'dd/mm/yyyy':
				$exp = explode('/', $date);
				$day = trim($exp[0]);
				$month = trim($exp[1]);
				$year = trim($exp[2]);
				return date('Y/m/d', strtotime("$year/$month/$day"));
				break;
			case 'dd-mm-yyyy':
				$exp = explode('-', $date);
				$day = trim($exp[0]);
				$month = trim($exp[1]);
				$year = trim($exp[2]);
				return date('Y/m/d', strtotime("$year/$month/$day"));
				break;
			default:
				return $date;
				break;
		}
	}
	
	/*
	 * validateDate
	 * http://php.net/manual/en/function.checkdate.php
	 */
	public static function validateDate($date, $format = ''){
		if($format == ''){
			$format = Registry::getSetting('date_format');
		}
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}