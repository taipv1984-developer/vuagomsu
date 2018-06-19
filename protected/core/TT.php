<?php
session_start();
define ( 'DS', DIRECTORY_SEPARATOR );
define('SESSION_GROUP','SW_SESSION_GROUP');
define('BASE_PATH', dirname(dirname(dirname(__FILE__))));
defined('PROTECTED_PATH') || define('PROTECTED_PATH', BASE_PATH.'/protected/');
defined('PLUGIN_PATH') || define('PLUGIN_PATH', BASE_PATH.'/plugin/');
defined('LIBRARY_PATH') || define('LIBRARY_PATH', BASE_PATH.'/library/');
defined('CONTROLLER_PATH') || define('CONTROLLER_PATH', BASE_PATH.'/protected/controller/');
define('ACTION_PARAM','r');
define('DEFAULT_ACTION','home');
defined('FRONTEND_VIEW_PATH') || define('FRONTEND_VIEW_PATH', BASE_PATH.'/protected/view/frontend/');
defined('ADMIN_VIEW_PATH') || define('ADMIN_VIEW_PATH', BASE_PATH.'/protected/view/admin/');
defined('WIDGET_PATH') || define('WIDGET_PATH', BASE_PATH.'/protected/widget/');
defined('RESOURCE_PATH') || define('RESOURCE_PATH', BASE_PATH.'/resource/');
define('MYSQL_DATE_FORMART','Y-m-d H:i:s');
define('TT_CTX', 'tt_framework_context');
define('TT_LANG', 'tt_framework_language');
define('DEFAULT_LANGUAGE', 'vi');
define('RENDER_KEY', 'render');
define('RENDER_KEY_URL_PARAM', 'render_url_param');
define('GLOBAL_RESULT', 'global');
define('FIELD_ERRORS', 'field_errors');
define('ACTION_MESSAGES', 'action_messages');
define('ACTION_ERRORS', 'action_errors');
defined('DEFAULT_TEMPLATE') || define('DEFAULT_TEMPLATE', 'view');

define('EXTENSION_FILE_INFO', 'extension.info');
define('EXTENSION_TYPE_DEFAULT', 'plugin');

// error_reporting(0);
// date_default_timezone_set('Asia/Kuala_Lumpur');
error_reporting(E_ALL^E_NOTICE);
date_default_timezone_set('Asia/Ho_Chi_Minh');

set_time_limit(5 * 60);
$APP_CONFIGS = array(
	'framework_core' => array(
		BASE_PATH.'/protected/core/config',
		BASE_PATH.'/protected/core/filter/filerInterface',
		BASE_PATH.'/protected/core/filter/filerClass',
		BASE_PATH.'/protected/core/controller',
		BASE_PATH.'/protected/core/util',
		BASE_PATH.'/protected/core/exception',
        BASE_PATH.'/protected/persistence',
        BASE_PATH.'/protected/model',
        BASE_PATH.'/protected/ext',
        BASE_PATH.'/protected/filter',
        BASE_PATH.'/protected/helper',
	),
	'action_config_loader' => BASE_PATH.'/protected/config/action_config.php',
	'db_config' => BASE_PATH.'/protected/config/db_config.php',
	'const' => BASE_PATH.'/protected/config/const.php',
	'filter_config' => BASE_PATH.'/protected/config/filter_config.php'
);

include $GLOBALS['APP_CONFIGS']['db_config'];
include $GLOBALS['APP_CONFIGS']['const'];

require_once PROTECTED_PATH .'config/common_loader.php';    //???
set_exception_handler("exceptionHandler");  //???
register_shutdown_function('fatalErrorShutdownHandler');    //???

include 'CTTBase.php';

//mobile detect
include LIBRARY_PATH.'mobile_detect/Mobile_Detect.php';
$class = new CTTBase();
$class->start();