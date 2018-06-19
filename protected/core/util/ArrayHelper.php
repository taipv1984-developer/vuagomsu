<?php

/**
 * Common action in array type
 */
class ArrayHelper {

    /**
     * Get array include Yes, No
     *
     * @return array
     */
    public static function getYN() {
        return array('Y' => 'Yes', 'N' => 'No');
    }

    /**
     * Get array include 1, 0
     *
     * @return array
     */
    public static function get10() {
        return array(1 => 'Yes', 0 => 'No');
    }

    /**
     * Get array include Active, Disable
     *
     * @return array
     */
    public static function getAD() {
        return array('A' => 'Active', 'D' => 'Disable');
    }

    /**
     * Get array include Active, Pending
     *
     * @return array
     */
    public static function getAP() {
        return array('A' => 'Active', 'P' => 'Pending');
    }

    /**
     * Get array include Active, Pending, Disable
     *
     * @return array
     */
    public static function getAPD() {
        return array('A' => 'Active', 'P' => 'Pending', 'D' => 'Disable');
    }

    public static function getTF() {
        return array(
            1 => 'true',
            0 => 'false'
        );
    }

    public static function getAllAny() {
        return array(
            'all' => 'all',
            'any' => 'any',
        );
    }

    public static function getApproved() {
        return array(
            'approved' => 'approved',
            'pending' => 'pending',
        );
    }

    public static function getWatched() {
        return array(
            'watched' => 'watched',
            'pending' => 'pending',
        );
    }

    /**
     * Get array include Active, Pending, Disable, Cancel, Finish
     *
     * @return array
     */
    public static function getAll() {
        return array('A' => 'Active', 'P' => 'Pending', 'D' => 'Disable', 'C' => 'Cancel', 'F' => 'Finish');
    }

    public static function getBootrapClassCols() {
        return array(
            1 => 'col-md-12',
            2 => 'col-md-6',
            3 => 'col-md-4',
            4 => 'col-md-3',
            5 => 'col-md-2',
            6 => 'col-md-2',
        );
    }

    /**
     * getRoleType
     * @return array('backend' => 'backend', 'frontend' => 'frontend')
     */
    public static function getRoleType() {
        return array('backend' => 'backend', 'frontend' => 'frontend');
    }

    /**
     * Get array gender('1' => 'Male', '0' => 'Female')
     *
     * @return array
     */
    public static function getGender() {
        return array('1' => 'Male', '0' => 'Female');
    }

    /**
     * Get array (Pending, Complete, Canceled...)
     *
     * @return array
     */
    public static function getShippingStatus() {
        return array('Pending' => 'Pending', 'Complete' => 'Complete', 'Canceled' => 'Canceled');
    }

    /**
     * Get array (Pending, Complete, Canceled...)
     *
     * @return array
     */
    public static function getPaymentStatus() {
        return array('Pending' => 'Pending', 'Complete' => 'Complete', 'Canceled' => 'Canceled');
    }

    /**
     * Get array display name('1' => 'First name -> Last name', '0' => 'Last name -> First name')
     *
     * @return array
     */
    public static function getDisplayName() {
        return array('1' => 'First name - Last name', '0' => 'Last name - First name');

    }

    /**
     * Get array ::getOptionCreateThumbnail('exact', 'portrait', 'landscape', 'auto*', 'crop')
     * Apply for config thumbnail(admin)
     *
     * @return array
     */
    public static function getOptionCreateThumbnail() {
        return array(
            '0' => e('exact(defined size)'),
            '1' => e('portrait(keep aspect set height)'),
            '2' => e('landscape(keep aspect set width)'),
            '3' => e('auto'),
            '4' => e('crop(resize and crop)'),
        );
    }

    /**
     * Get array ::getLimit(10, 20, 30, 40, 50)
     * apply catagories page
     *
     * @return array
     */
    public static function getLimit() {
        return array(
            '6' => 6,
            '12' => 12,
            '24' => 24,
            '50' => 50,
        );
    }

    /**
     * getEmailMethod array
     *
     * @return array(smtp, mail)
     */
    public static function getEmailMethod() {
        return array(
            'smtp' => e('SMTP server'),
            'mail' => e('php mail function')
        );
    }

    /**
     * getEmailSmtpAuth array
     *
     * @return array(0 => 'No', 1 => 'Yes')
     */
    public static function getEmailSmtpAuth() {
        return array(0 => 'No', 1 => 'Yes');
    }

    /**
     * getEmailSmtpSecure array
     *
     * @return array(smtp, mail)
     */
    public static function getEmailSmtpSecure() {
        return array(
            'none' => e('None'),
            'ssl' => e('SSL'),
            'tls' => e('TLS'),
        );
    }

    /**
     * getRandomArray
     *
     * @param array $input (5, 10, 15, 20, ...)
     * @param array $keys (1=>10, ...)
     * @param int $size of array output
     * @return array random value in $input array and $keys array (static)
     *            example: array(0=>20, 1=>10, 2=>15, 3=>5, 4=>0, 5=>0, ...])
     */
    public static function getRandomArray($input, $keys, $size = 0) {
        $ouput = array();
        if ($size) {
            $size = min($size, count($input));
        } else {
            $size = count($input);
        }
        //step1: remove value of $keys out input array
        foreach ($keys as $key) {
            foreach ($input as $k => $v) {
                if ($key == $v) {
                    unset($input[$key]);
                }
            }
        }
        self::resetKey($input);

        //step2: get output array
        for ($i = 0; $i < $size; $i++) {
            if (array_key_exists($i, $keys)) {
                $ouput[$i] = $keys[$i];
            } else {
                $iRand = rand(0, count($input) - 1);
                //add output
                $ouput[$i] = isset($input[$iRand]) ? $input[$iRand] : 0;
                //remove iRan out input
                unset($input[$iRand]);
                //reset key
                self::resetKey($input);
            }
        }

        return $ouput;
    }

    public static function getKeyValue($min, $max, $step = 1) {
        $res = array();
        for ($i = $min; $i <= $max; ($i += $step)) {
            $res[$i] = $i;
        }
        return $res;
    }

    /**
     * replace to array $array to value = $value at position = $position
     *
     * @param array $array
     * @param int $position >= 0
     * @param array $value
     * @return array
     */
    public static function replace($array, $position, $value) {
        $res = array_slice($array, 0, $position, true) + $value + array_slice($array, $position + 1, count($array) - 1, true);
        return $res;
    }

    /**
     * insert to array $array to value = $value at position = $position
     *
     * @param array $array
     * @param int $position >= 0
     * @param array $value
     * @return array
     */
    public static function insert($array, $position, $value) {
        $res = array_slice($array, 0, $position, true) + $value + array_slice($array, $position, count($array) - 1, true);
        return $res;
    }

    public static function getUrlRequest() {
        $urlRequest = array();
        $REQUEST_URI = $_SERVER['REQUEST_URI'];    //vdato_empty/lips?page=1&orderBy=price_low_to_high
        $exp = explode('?', $REQUEST_URI);
        if (count($exp) > 1) {
            $REQUEST_STRING = trim($exp[1]);    //page=1&orderBy=price_low_to_high
            $exp = explode('&', $REQUEST_STRING);
            foreach ($exp as $v) {
                $data = explode('=', $v);
                $urlRequest[$data[0]] = $data[1];
            }
        }
        return $urlRequest;
    }

    /**
     * reset key of array (ref array)
     */
    public static function resetKey(&$array) {
        $resetKey = array();
        foreach ($array as $v) {
            $resetKey[] = $v;
        }
        $array = $resetKey;
    }

    public static function sortById($objList, $pkName = 'id') {
        $ret = array();
        foreach ($objList as $v) {
            if (isset($v->$pkName)) {
                $ret[$v->$pkName] = $v;
            }
        }
        return $ret;
    }

    /**
     * convert array (of object) to array (of array)
     *
     * @param array $arr
     */
    public static function objectToArray($arr) {
        if (is_array($arr) || is_object($arr)) {
            $result = array();
            foreach ($arr as $k => $v) {
                $result[$k] = self::objectToArray($v);
            }
            return $result;
        }
        return $arr;
    }

    /**
     * recursive array $arr
     *
     * @param array $arr (require field parentId and id)
     * @param int $parentId
     * @param array rel $ret
     * @return data after recursived
     */
    public static function recursive($arr, $pkName = 'id', $parentId = 0, $ret = array(), $level = -1) {
        foreach ($arr as $k => $v) {
            if ($v['parentId'] == $parentId) {
                $level++;
                $v['level'] = $level;
                $ret[] = $v;
                $ret = self::recursive($arr, $pkName, $v[$pkName], $ret, $level);
                $level--;
            }
        }
        return $ret;
    }

    public static function dequi($new_arr, $arr, $parent_id) {
        foreach ($arr as $k => $v) {
            if ($v['parentId'] == $parent_id) {
                $new_arr[$k] = $v;
                $new_arr = self::dequi($new_arr, $arr, $v['id']);
            }
        }
        return $new_arr;
    }

    /***********************************
     * DATE TIME
     **********************************/
    public static function getDayOfMonth() {
        $dayOfMonth = array();
        for ($i = 1; $i <= 31; $i++) {
            $dayOfMonth[$i] = $i;
        }
        return $dayOfMonth;
    }

    public static function getMonthOfYear() {
        $monthOfYear = array();
        for ($i = 1; $i <= 12; $i++) {
            $monthOfYear[$i] = $i;
        }
        return $monthOfYear;
    }

    public static function getYear($range = 50) {
        $curentYear = DateHelper::getCurentYear();
        $year = array();
        for ($i = $curentYear - $range; $i <= $curentYear; $i++) {
            $year[$i] = $i;
        }
        return $year;
    }

    /***********************************
     * SHOP PLUGIN FUNCTION
     **********************************/
    public static function getOrderDirection($direction = 'ASC') {
        if ($direction == 'ASC') {
            return array(
                'ASC' => e("Ascending"),
                'DESC' => e("Descending"),
            );
        } else {
            return array(
                'DESC' => e("Descending"),
                'ASC' => e("Ascending"),
            );
        }
    }

    public static function getOrderByCategory() {
        return array(
            'category_id' => e("Category ID"),
            'name' => e("Category name"),
        );
    }

    public static function getProductAttributeType() {
        return array(
            'select' => 'Select value',
            'text' => 'Custom value',
            'image' => 'Image list',
        );
    }

    public static function getCreditCardType() {
        return array(
            'visa' => 'Visa',
            'master' => 'Master',
        );
    }
//++Chưa liên hệ, Đã liên hệ, Từ chối

    /**
     * getContactStatus
     *
     * @return array('P' => 'Chưa liên hệ', 'A' => 'Đã liên hệ', 'C' => 'Từ chối')
     */
    public static function getContactStatus() {
        return array('P' => 'Chưa liên hệ', 'A' => 'Đã liên hệ', 'C' => 'Từ chối');
    }

    /**
     * getContactStatusR
     *
     * @return array('Chưa liên hệ' => 'P', 'Đã liên hệ' => 'A', 'Từ chối' => 'C')
     */
    public static function getContactStatusR() {
        return array('Chưa liên hệ' => 'P', 'Đã liên hệ' => 'A', 'Từ chối' => 'C');
    }

    /**
     * getContactSource
     *
     * @return array('F' => 'Facebook', 'G' => 'Google', 'E' => 'Email', 'P' => 'Người Quen', 'O' => 'Khác')
     */
    public static function getContactSource() {
        return array('F' => 'Facebook', 'G' => 'Google', 'E' => 'Email', 'P' => 'Người Quen', 'O' => 'Khác');
    }

    /**
     * getContactSourceR
     *
     * @return array('Facebook' => 'F', 'Google' => 'G', 'Email' => 'E', 'Người Quen' => 'P', 'Khác' => 'O');
     */
    public static function getContactSourceR() {
        return array('Facebook' => 'F', 'Google' => 'G', 'Email' => 'E', 'Người Quen' => 'P', 'Khác' => 'O');
    }

    public static function getRegionList() {
        return array(
            1 => 'Cơ sở 1: Số 10 Tạ Quang Bửu - Hai Bà Trưng - Hà Nội',
            2 => 'Cơ sở 2: Số 316 Âu Cơ - Tây Hồ - Hà Nội',
            3 => 'Cơ sở 3: Số 67 Nguyễn Đình Thi - Thụy Khuê - Tây Hồ',
        );
    }

    public static function getRegionShortNameList() {
        return array(
            1 => 'Cơ sở 1',
            2 => 'Cơ sở 2',
            3 => 'Cơ sở 3',
        );
    }
}