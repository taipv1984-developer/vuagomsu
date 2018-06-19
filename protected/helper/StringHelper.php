<?php
/**
 * Common action in string type
 */
class StringHelper{
	
	/**
	 * replace _c to C [example: news_id -> newsId(default)or news_id -> NewsId($capitalizeFirstCharacter = true)]
	 * 
	 * @param string $string input
	 * @param boolean $capitalizeFirstCharacter(default = false)
	 * @return string
	 */
	public static function toCamelCase($string, $capitalizeFirstCharacter = false){
		$str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
		$str = str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
		if(!$capitalizeFirstCharacter){
			$str[0] = strtolower($str[0]);
		}
		return $str;
	}

	/**
	 * Replace '_' to ' ' and ucfirst string(hello_world to Hello world)
	 * apply for convert name of var to lable text
	 * 
	 * @param string $str
	 * @return string
	 */
	public static function toUcfirst($str){
		return ucfirst(strtolower(str_replace('_', ' ', $str)));
	}

    public static function toCapitalize($str){
	    $exp = explode(' ', strtolower($str));
	    foreach ($exp as $k => $v){
            $exp[$k] = ucfirst($exp[$k]);
        }
        return join($exp, ' ');
    }

	/**
	 * remove the special characters from the $str
	 *
	 * @param string $str
	 * @return string
	 */
	public static function getAlias($str, $convertAll=true){
		$str = trim(mb_strtolower($str));
		$chars = array(
			'/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/' => 'a',
			'/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ.+/' => 'e',
			'/ì|í|ị|ỉ|ĩ/' => 'i',
			'/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ.+/' => 'o',
			'/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/' => 'u',
			'/ỳ|ý|ỵ|ỷ|ỹ/' => 'y',
			'/đ/' => 'd',
			'/\(|\)|\~|\!|\@|\#|\$|\%|\^|\&|\*|\+|,/' => '',
		);
		$str = preg_replace(array_keys($chars), array_values($chars), $str);
		if($convertAll){
		$str = preg_replace('/\s+/', '-', $str);
		$str = preg_replace('/-+/', '-', $str);
        }
		 
		return trim($str);
	}
	
	/**
	 * getRandomCode apply for active customer register
	 * 
	 * @return string
	 */
	public static function getRandomCode($codeLength = 32){
		$charArray = array_merge(range(a, z), range(0, 9));
		$ramdomCode = "";
		for($i = 0; $i < $codeLength; $i++){
			$ramdomCode .= $charArray[rand(0,(count($charArray)- 1))];
		}
		
		return $ramdomCode;
	}
	
	/**
	 * escape string before insert database
	 * 
	 * @param string $str
	 * @return string
	 */
	public static function escape($str){
		$str = htmlspecialchars($str);
		//addslashes...
		return $str;
	}

	/**
	 * get full a word($text)in a string($str)
	 * 
	 * @param string $text word not full
	 * @param string $str string find
	 * @param null*|int $pos strpos of $text in $str
	 * @return string
	 */
	public static function getFullText($text, $str, $pos=null){
		$charEnd = array(' ', '(', ')', '[', ']', '{', '}', '=', '\'', '/', '*', '"', '$', '<', '>', '-', '+', ';');
		if($pos === null)$pos = strpos($str, $text);
		
		if($pos !== false){
			$result = '';
			//for +
			$ok = true;
			$i = $pos;
			while($i < strlen($str)& $ok){
				$ch = $str[$i];
				if(!in_array($ch, $charEnd)){
					$result = $result.$ch;
				}
				else{
					$ok = false;
				}
				$i++;
			}
			//for -
			$ok = true;
			$i = $pos;
			if($i != 0){
				$i--;
				while($i >= 0 & $ok){
					$ch = $str[$i];
					if(!in_array($ch, $charEnd)){
						$result = $ch.$result;
					}
					else{
						$ok = false;
					}
					$i--;
				}
			}
			return trim($result);
		}
		else{
			return $text;
		}
	}
	
	public static function subString($str, $wordCount=30, $charLast='...') {
		$str = strip_tags($str);
		$exp = explode(' ', $str);
		if(count($exp) < $wordCount){
			return $str;
		}
		else{
			$slice = array_slice($exp, 0, $wordCount);
			return join(' ', $slice).$charLast;
		}
	}
	
	
	public static function convert_number_to_words($number){
		$hyphen = ' ';
		$conjunction = '  ';
		$separator = ' ';
		$negative = 'âm ';
		$decimal = ' phẩy ';
		$dictionary = array(
			0 => 'không',
			1 => 'một',
			2 => 'hai',
			3 => 'ba',
			4 => 'bốn',
			5 => 'năm',
			6 => 'sáu',
			7 => 'bảy',
			8 => 'tám',
			9 => 'chín',
			10 => 'mười',
			11 => 'mười một',
			12 => 'mười hai',
			13 => 'mười ba',
			14 => 'mười bốn',
			15 => 'mười năm',
			16 => 'mười sáu',
			17 => 'mười bảy',
			18 => 'mười tám',
			19 => 'mười chín',
			20 => 'hai mươi',
			30 => 'ba mươi',
			40 => 'bốn mươi',
			50 => 'năm mươi',
			60 => 'sáu mươi',
			70 => 'bảy mươi',
			80 => 'tám mươi',
			90 => 'chín mươi',
			100 => 'trăm',
			1000 => 'ngàn',
			1000000 => 'triệu',
			1000000000 => 'tỷ',
			1000000000000 => 'nghìn tỷ',
			1000000000000000 => 'ngàn triệu triệu',
			1000000000000000000 => 'tỷ tỷ'
		);
		if (!is_numeric($number)) {
			return false;
		}
	
		if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
	
			// overflow
	
			trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);
			return false;
		}
	
		if ($number < 0) {
			return $negative . self::convert_number_to_words(abs($number));
		}
	
		$string = $fraction = null;
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
	
			case $number < 100:
				$tens = ((int)($number / 10)) * 10;
				$units = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string.= $hyphen . $dictionary[$units];
				}
	
				break;
	
			case $number < 1000:
				$hundreds = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string.= $conjunction . self::convert_number_to_words($remainder);
				}
	
				break;
	
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int)($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string.= $remainder < 100 ? $conjunction : $separator;
					$string.= self::convert_number_to_words($remainder);
				}
	
				break;
		}
	
		if (null !== $fraction && is_numeric($fraction)) {
			$string.= $decimal;
			$words = array();
			foreach(str_split((string)$fraction) as $number) {
				$words[] = $dictionary[$number];
			}
	
			$string.= implode(' ', $words);
		}
	
		$string = preg_replace('/\s+/', ' ', $string);
		return ucfirst(strtolower($string));
	}
	
	/**
	 * Convert from html code to bbcode
	 *
	 * @param string $text
	 * @return string
	 */
	public static function html_to_bbcode($text) {
		// Do a simple text replace for our PHP Tags
		$text = str_ireplace("::BACKSLASH::", "\\", $text);
		$text = str_ireplace("::PHP_OPEN::", "<?", $text);
		$text = str_ireplace("::PHP_CLOSE::", "?>", $text);
	
		//problem with existing bbcode, just strip [url] tags and we will add them back on later
		$text = str_ireplace("[url]", "", $text);
		$text = str_ireplace("[/url]", "", $text);
	
		// Tags to Find
		$htmltags = array(
				'/\<b\>(.*?)\<\/b\>/is',
				'/\<i\>(.*?)\<\/i\>/is',
				'/\<u\>(.*?)\<\/u\>/is',
				'/\<ul\>(.*?)\<\/ul\>/is',
				'/\<li\>(.*?)\<\/li\>/is',
				'/\<img(.*?) src=\"(.*?)\" (.*?)\>/is',
				'/\<div\>(.*?)\<\/div\>/is',
				'/\<br(.*?)\>/is',
				'/\<strong\>(.*?)\<\/strong\>/is',
				'/\<a href=\"(.*?)\"(.*?)\>(.*?)\<\/a\>/is',
				'/\<a href=\'(.*?)\'(.*?)\>(.*?)\<\/a\>/is',
		);
	
		// Replace with
		$bbtags = array(
				'[b]$1[/b]',
				'[i]$1[/i]',
				'[u]$1[/u]',
				'[list]$1[/list]',
				'[*]$1[/*]',
				'[img]$2[/img]',
				'$1',
				"\n",			//~ ~
				'[b]$1[/b]',
				'[url=$1]$3[/url]',
				'[url=$1]$3[/url]',
		);
	
		// Replace $htmltags in $text with $bbtags
		$text = preg_replace ($htmltags, $bbtags, $text);
	
		// Strip all other HTML tags
		$text = strip_tags($text);
	
		return $text;
	}
}