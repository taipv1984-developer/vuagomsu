<?php
class ApplicationConfigHelper{
    private static $applicationConfigData = array();

    public static function set(){
        self::$applicationConfigData = array(
            'product.unit.list' => array(
                'chiếc' => 'Chiếc',
                'bộ' => 'Bộ',
                'cái' => 'Cái',
            ),
            'account.type.list' => array(
                'facebook' => 'Facebook',
                'google' => 'Google plus',
            ),
            'menu.style' => array(
                'main' => 'Menu chính',
                'horizontal' => 'Menu ngang',
                'vertical' => 'Menu dọc',
            ),
            'menu.item.type' => array(
                'custom_link' => 'Mặc định',
                'cart_link' => 'Liên kết tới trang giở hàng',
                'account_link' => 'Liên kết tới trang tài khoản',
                'search_item' => 'Ô tìm kiếm sản phẩm',
                'category_all_link' => 'Tất cả danh mục sản phẩm',
            ),
            'layout.row.bg.size.list' => array(
                "auto" => "auto",
                "cover" => "cover",
            ),
            'layout.row.bg.repeat.list' => array(
                "no-repeat" => "no-repeat",
                "repeat" => "repeat",
                "repeat-x" => "repeat-x",
                "repeat-y" => "repeat-y"
            ),
            '' => array(
                '' => '',
                '' => '',
                '' => '',
            ),
        );
    }

    public static function get($key, $default=null){
        if (isset(self::$applicationConfigData[$key]))
            return self::$applicationConfigData[$key];
        else
            return $default;
    }
}