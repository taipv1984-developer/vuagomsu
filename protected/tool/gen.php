<form method="post" action="">
    <input type="text" name="tableName" placeholder="tableName" required="required"
           value="<?= (isset($_REQUEST['tableName'])) ? $_REQUEST['tableName'] : 'my_tool' ?>"/>
    <input type="text" name="dbName" placeholder="dbName"
           value="<?= (isset($_REQUEST['dbName'])) ? $_REQUEST['dbName'] : 'my_tool' ?>"/>
    <input type="text" name="pluginCode" placeholder="plugin code"
           value="<?= (isset($_REQUEST['pluginCode'])) ? $_REQUEST['pluginCode'] : '' ?>"/>
    <input type="submit" name="submit"/>
    <br><br><br>
    <button type="submit" name="autoGenCore">
        autoGenCore
    </button>
</form>
<?php
$conn = null;
$tableName = $_POST ['tableName'];
$dbName = $_POST ['dbName'];
$pluginCode = $_POST ['pluginCode'];
try {
    $conn = new PDO ('mysql:host=localhost;dbname=' . $dbName, 'root', '', array(
        PDO::ATTR_PERSISTENT => true
    ));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
}

define('BASE_PATH', dirname(dirname(dirname(__FILE__))));
defined('PROTECTED_PATH') || define('PROTECTED_PATH', BASE_PATH.'/protected/');
defined('PLUGIN_PATH') || define('PLUGIN_PATH', BASE_PATH.'/plugin/');
$str = '';
$br = PHP_EOL;

$dbInfo = array(
    'type' => array(
        'numeric' => array(
            'TINYINT',
            'SMALLINT',
            'MEDIUMINT',
            'INT',
            'BIGINT'
        ),
        'text' => array(
            'CHAR',
            'VARCHAR',
            'TINYTEXT',
            'TEXT',
            'MEDIUMTEXT',
            'LONGTEXT',
            'DATE',
            'DATETIME',
            'TIME',
            'TIMESTAMP',
            'YEAR',
            'FLOAT',
            'DOUBLE',
            'DECIMAL',
            'BIT'
        ),
    ),
);

//include grn_core
include 'gen_core.php';

if (isset ($_POST ['submit'])) {
    genVo($tableName, $dbInfo, $conn, $pluginCode);
    genMo($tableName, $dbInfo, $conn, $pluginCode);
    genDao($tableName, $dbInfo, $conn, $pluginCode);
}

if (isset ($_POST ['autoGenCore'])) {
    $tableList = array(
        'core' => array('admin', 'admin_detail', 'city', 'country', 'customer', 'customer_detail', 'customer_address',
            'district', 'email_template', 'file', 'language', 'language_value', 'layout', 'layout_row', 'layout_widget',
            'menu', 'menu_item', 'nav_link', 'plugin', 'role', 'role_permission', 'router', 'router_url',
            'setting', 'setting_group', 'template', 'widget_cat', 'widget',
            'seo_info', 'system_log'),
        'album' => array('album', 'album_image'),
        'contact' => array('contact'),
        'customer_review' => array('customer_review'),
        'scraper_data' => array('scraper_data', 'scraper_client', 'scraper_client_data', 'scraper_setting'),
        'help' => array('help', 'help_cat'),
        'news' => array('news', 'news_category', 'news_tag', 'news_tag_map', 'news_comment'),
        'newsletter' => array('newsletter', 'newsletter_email_template'),
        'quiz' => array('answer', 'question', 'notice_board'),
        'shop' => array('attribute', 'attribute_value', 'attribute_map',
            'category', 'currency', 'manufac',
            'checkout', 'checkout_setting',
            'orders', 'order_product', 'order_data', 'order_payment', 'order_history',
            'order_shipping', 'order_status', 'order_surcharge',
            'product', 'product_category', 'product_image','product_tag', 'product_tag_map',
            'product_search', 'product_viewed', 'product_wishlist', 'product_best_seller', 'product_feature', 'product_extension'),
        'slider' => array('slider', 'slider_image'),
        'static_page' => array('static_page', 'static_page_detail'),
        'trainer' => array('trainer'),
        'video' => array('video'),
    );
    foreach ($tableList as $pluginName => $pluginTableList){
        echo "<b>[$pluginName]</b><br>";
        if($pluginName == 'core') $pluginName = '';
        foreach ($pluginTableList as $tableName) {
            $columnInfo = columnInfo($conn, $tableName);
            if (is_array($columnInfo)) {
                genVo($tableName, $dbInfo, $conn, $pluginName);
                genMo($tableName, $dbInfo, $conn, $pluginName);
                genDao($tableName, $dbInfo, $conn, $pluginName);
            } else {
                echo "$tableName is error<br>";
            }
            echo "<br>";
        }
        echo "----------------------------------------<br>";
    }
}