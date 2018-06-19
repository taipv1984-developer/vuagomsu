2018-06-18 14:40:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:40:07[INFO][] [CTTBase.php:130] action = admin
2018-06-18 14:40:07[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 14:40:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 14:40:07[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 14:40:07[ERROR][] [common_loader.php:31] Error Message Id: 5b2761d7debfb
2018-06-18 14:40:07[ERROR][] [common_loader.php:32] Error Message Id: 5b2761d7debfb 1 - Call to undefined method Registry::getSetting() in D:\xampp\htdocs\vuagomsu2\protected\view\layout\backend.head.php at line 2
2018-06-18 14:40:07[ERROR][] [common_loader.php:33] {"type":1,"message":"Call to undefined method Registry::getSetting()","file":"D:\\xampp\\htdocs\\vuagomsu2\\protected\\view\\layout\\backend.head.php","line":2}
2018-06-18 14:42:08[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:42:08[INFO][] [CTTBase.php:130] action = admin
2018-06-18 14:42:08[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 14:42:08[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 14:42:08[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 14:42:08[ERROR][] [common_loader.php:31] Error Message Id: 5b27625041c0e
2018-06-18 14:42:08[ERROR][] [common_loader.php:32] Error Message Id: 5b27625041c0e 1 - Class 'SettingExt' not found in D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\component\settings.php at line 2
2018-06-18 14:42:08[ERROR][] [common_loader.php:33] {"type":1,"message":"Class 'SettingExt' not found","file":"D:\\xampp\\htdocs\\vuagomsu2\\protected\\view\\admin\\common\\header\\component\\settings.php","line":2}
2018-06-18 14:42:26[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:42:26[INFO][] [CTTBase.php:130] action = admin
2018-06-18 14:42:27[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 14:42:27[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 14:42:27[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 14:42:27[ERROR][] [DataBaseHelper.php:159] [DB/query] sql = select * 
from setting_group
where `status`='A'
group by setting_type
order by `order`
2018-06-18 14:42:27[ERROR][] [DataBaseHelper.php:160] [DB/query] PDOException = SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause'
2018-06-18 14:42:27[ERROR][] [common_loader.php:12] Error Message Id: 5b27626318474
2018-06-18 14:42:27[ERROR][] [common_loader.php:13] SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103
2018-06-18 14:42:27[ERROR][] [common_loader.php:14] {"errorInfo":["42S22",1054,"Unknown column 'status' in 'where clause'"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' in D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\util\\DataBaseHelper.php on line <i>103<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>132008<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0020<\/td><td bgcolor='#eeeeec' align='right'>154616<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0210<\/td><td bgcolor='#eeeeec' align='right'>512432<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-18 14:42:27[ERROR][] [common_loader.php:21] <h1>Error:42S22</h1><p>Error Message Id: 5b27626318474</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause''</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php(103): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu2\protected\ext\SettingExt.php(9): DataBaseHelper::query('select * \r\nfrom...')
#2 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\component\settings.php(2): SettingExt::getSettingType()
#3 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#4 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header_top.php(16): TemplateHelper::getTemplate('common/header/c...')
#5 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#6 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header.php(3): TemplateHelper::getTemplate('common/header/h...', Array)
#7 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#8 D:\xampp\htdocs\vuagomsu2\protected\view\layout\admin.layout.php(13): TemplateHelper::getTemplate('common/header/h...', Array)
#9 D:\xampp\htdocs\vuagomsu2\protected\core\CTTBase.php(295): include('D:\\xampp\\htdocs...')
#10 D:\xampp\htdocs\vuagomsu2\protected\core\TT.php(69): CTTBase->start()
#11 D:\xampp\htdocs\vuagomsu2\index.php(3): require_once('D:\\xampp\\htdocs...')
#12 {main}</pre></p>
2018-06-18 14:43:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:43:15[INFO][] [CTTBase.php:130] action = admin
2018-06-18 14:43:15[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 14:43:15[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 14:43:15[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 14:43:15[ERROR][] [DataBaseHelper.php:159] [DB/query] sql = select * 
from setting_group
where `status`='A'
group by setting_type
order by `order`
2018-06-18 14:43:15[ERROR][] [DataBaseHelper.php:160] [DB/query] PDOException = SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause'
2018-06-18 14:43:15[ERROR][] [common_loader.php:12] Error Message Id: 5b276293c39cd
2018-06-18 14:43:15[ERROR][] [common_loader.php:13] SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103
2018-06-18 14:43:15[ERROR][] [common_loader.php:14] {"errorInfo":["42S22",1054,"Unknown column 'status' in 'where clause'"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' in D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\util\\DataBaseHelper.php on line <i>103<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>132008<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>154616<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0100<\/td><td bgcolor='#eeeeec' align='right'>503096<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-18 14:43:15[ERROR][] [common_loader.php:21] <h1>Error:42S22</h1><p>Error Message Id: 5b276293c39cd</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause''</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php(103): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu2\protected\ext\SettingExt.php(9): DataBaseHelper::query('select * \r\nfrom...')
#2 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\component\settings.php(2): SettingExt::getSettingType()
#3 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#4 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header_top.php(16): TemplateHelper::getTemplate('common/header/c...')
#5 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#6 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header.php(3): TemplateHelper::getTemplate('common/header/h...', Array)
#7 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#8 D:\xampp\htdocs\vuagomsu2\protected\view\layout\admin.layout.php(13): TemplateHelper::getTemplate('common/header/h...', Array)
#9 D:\xampp\htdocs\vuagomsu2\protected\core\CTTBase.php(295): include('D:\\xampp\\htdocs...')
#10 D:\xampp\htdocs\vuagomsu2\protected\core\TT.php(69): CTTBase->start()
#11 D:\xampp\htdocs\vuagomsu2\index.php(3): require_once('D:\\xampp\\htdocs...')
#12 {main}</pre></p>
2018-06-18 14:43:24[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:43:24[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:43:24[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:43:24[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:43:24[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:43:26[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:43:26[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:43:26[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:43:26[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:43:26[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:43:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:43:32[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:43:32[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:43:32[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:43:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:43:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:43:33[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:43:33[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:43:33[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:43:33[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:45:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:45:14[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:45:14[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:45:14[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:45:15[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:46:11[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:46:11[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:46:11[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:46:11[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:46:11[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:46:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:46:15[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:46:15[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:46:15[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:46:15[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/theme.basic/home/home.php
2018-06-18 14:48:45[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:48:45[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:48:45[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:48:45[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:48:46[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:48:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:48:50[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:48:50[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:48:50[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:48:50[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:48:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:48:57[INFO][] [CTTBase.php:130] action = admin
2018-06-18 14:48:57[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 14:48:57[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 14:48:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 14:48:57[ERROR][] [DataBaseHelper.php:159] [DB/query] sql = select * 
from setting_group
where `status`='A'
group by setting_type
order by `order`
2018-06-18 14:48:57[ERROR][] [DataBaseHelper.php:160] [DB/query] PDOException = SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause'
2018-06-18 14:48:57[ERROR][] [common_loader.php:12] Error Message Id: 5b2763e996a54
2018-06-18 14:48:57[ERROR][] [common_loader.php:13] SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103
2018-06-18 14:48:57[ERROR][] [common_loader.php:14] {"errorInfo":["42S22",1054,"Unknown column 'status' in 'where clause'"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' in D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\util\\DataBaseHelper.php on line <i>103<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0000<\/td><td bgcolor='#eeeeec' align='right'>131768<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>154376<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>1.2931<\/td><td bgcolor='#eeeeec' align='right'>511824<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-18 14:48:57[ERROR][] [common_loader.php:21] <h1>Error:42S22</h1><p>Error Message Id: 5b2763e996a54</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause''</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php(103): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu2\protected\ext\SettingExt.php(9): DataBaseHelper::query('select * \r\nfrom...')
#2 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\component\settings.php(2): SettingExt::getSettingType()
#3 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#4 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header_top.php(16): TemplateHelper::getTemplate('common/header/c...')
#5 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#6 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header.php(3): TemplateHelper::getTemplate('common/header/h...', Array)
#7 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#8 D:\xampp\htdocs\vuagomsu2\protected\view\layout\admin.layout.php(13): TemplateHelper::getTemplate('common/header/h...', Array)
#9 D:\xampp\htdocs\vuagomsu2\protected\core\CTTBase.php(295): include('D:\\xampp\\htdocs...')
#10 D:\xampp\htdocs\vuagomsu2\protected\core\TT.php(69): CTTBase->start()
#11 D:\xampp\htdocs\vuagomsu2\index.php(3): require_once('D:\\xampp\\htdocs...')
#12 {main}</pre></p>
2018-06-18 14:48:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:48:59[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:48:59[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:48:59[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:48:59[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:49:03[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:49:03[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:49:03[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:49:03[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:49:03[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:49:09[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:49:09[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:49:09[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:49:09[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:49:09[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:50:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:50:35[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:50:35[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:50:35[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:50:35[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:50:40[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:50:40[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:50:40[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:50:40[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:50:40[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:50:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:50:43[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:50:43[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:50:43[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:50:43[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:50:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:50:48[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:50:48[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:50:48[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:50:48[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:50:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:50:55[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:50:55[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:50:55[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:50:55[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:50:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:50:59[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:50:59[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:50:59[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:50:59[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:51:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:51:48[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:51:49[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:51:49[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:51:49[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:51:52[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:51:52[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:51:52[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:51:52[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:51:52[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 14:51:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 14:51:53[INFO][] [CTTBase.php:130] action = 
2018-06-18 14:51:53[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 14:51:53[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 14:51:53[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:07:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:54[INFO][] [CTTBase.php:130] action = 
2018-06-18 15:07:54[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 15:07:54[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 15:07:54[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:07:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:56[INFO][] [CTTBase.php:130] action = 
2018-06-18 15:07:56[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 15:07:56[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 15:07:56[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:07:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:57[INFO][] [CTTBase.php:130] action = admin
2018-06-18 15:07:57[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 15:07:57[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 15:07:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 15:07:57[ERROR][] [DataBaseHelper.php:159] [DB/query] sql = select * 
from setting_group
where `status`='A'
group by setting_type
order by `order`
2018-06-18 15:07:57[ERROR][] [DataBaseHelper.php:160] [DB/query] PDOException = SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause'
2018-06-18 15:07:57[ERROR][] [common_loader.php:12] Error Message Id: 5b27685d4d9e9
2018-06-18 15:07:57[ERROR][] [common_loader.php:13] SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103
2018-06-18 15:07:57[ERROR][] [common_loader.php:14] {"errorInfo":["42S22",1054,"Unknown column 'status' in 'where clause'"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' in D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\util\\DataBaseHelper.php on line <i>103<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>132008<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0020<\/td><td bgcolor='#eeeeec' align='right'>154616<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.2400<\/td><td bgcolor='#eeeeec' align='right'>512096<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu2\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-18 15:07:57[ERROR][] [common_loader.php:21] <h1>Error:42S22</h1><p>Error Message Id: 5b27685d4d9e9</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause''</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php' on line 103</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu2\protected\core\util\DataBaseHelper.php(103): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu2\protected\ext\SettingExt.php(9): DataBaseHelper::query('select * \r\nfrom...')
#2 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\component\settings.php(2): SettingExt::getSettingType()
#3 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#4 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header_top.php(16): TemplateHelper::getTemplate('common/header/c...')
#5 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#6 D:\xampp\htdocs\vuagomsu2\protected\view\admin\common\header\header.php(3): TemplateHelper::getTemplate('common/header/h...', Array)
#7 D:\xampp\htdocs\vuagomsu2\protected\helper\TemplateHelper.php(34): include('D:\\xampp\\htdocs...')
#8 D:\xampp\htdocs\vuagomsu2\protected\view\layout\admin.layout.php(13): TemplateHelper::getTemplate('common/header/h...', Array)
#9 D:\xampp\htdocs\vuagomsu2\protected\core\CTTBase.php(295): include('D:\\xampp\\htdocs...')
#10 D:\xampp\htdocs\vuagomsu2\protected\core\TT.php(69): CTTBase->start()
#11 D:\xampp\htdocs\vuagomsu2\index.php(3): require_once('D:\\xampp\\htdocs...')
#12 {main}</pre></p>
2018-06-18 15:07:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:57[INFO][] [CTTBase.php:130] action = resource/backend/css/font-awesome-all/css/fontawesome-all.min.css
2018-06-18 15:07:58[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:58[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:07:58[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:58[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2018-06-18 15:07:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:59[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:07:59[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:07:59[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:07:59[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:07:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:59[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:07:59[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:07:59[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:07:59[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:07:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:07:59[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:08:00[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:08:00[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:08:00[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:09:27[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:27[INFO][] [CTTBase.php:130] action = admin
2018-06-18 15:09:27[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 15:09:27[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-18 15:09:27[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 15:09:28[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:28[INFO][] [CTTBase.php:130] action = resource/backend/css/font-awesome-all/css/fontawesome-all.min.css
2018-06-18 15:09:28[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:28[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2018-06-18 15:09:29[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:29[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:09:29[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:29[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:09:29[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:09:29[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:09:29[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:09:29[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:29[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:09:30[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:09:30[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:09:30[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:09:30[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:09:30[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:09:30[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:09:30[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:09:30[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:10:30[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:30[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2018-06-18 15:10:30[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2018-06-18 15:10:30[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2018-06-18 15:10:30[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/email_template/manage.php
2018-06-18 15:10:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:31[INFO][] [CTTBase.php:130] action = resource/backend/css/font-awesome-all/css/fontawesome-all.min.css
2018-06-18 15:10:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:31[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:10:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:31[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2018-06-18 15:10:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:32[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:10:32[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:10:32[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:10:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:10:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:33[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:10:33[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:10:33[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:10:33[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:10:34[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:34[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:10:34[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:10:34[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:10:34[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:10:34[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:34[INFO][] [CTTBase.php:130] action = resource/backend/css/font-awesome-all/css/fontawesome-all.min.css
2018-06-18 15:10:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:10:35[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:10:35[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:10:35[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:10:35[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:11:27[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:11:27[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2018-06-18 15:11:27[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2018-06-18 15:11:27[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2018-06-18 15:11:27[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/email_template/manage.php
2018-06-18 15:12:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:37[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2018-06-18 15:12:37[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2018-06-18 15:12:37[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2018-06-18 15:12:37[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/email_template/manage.php
2018-06-18 15:12:38[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:38[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:12:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:39[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2018-06-18 15:12:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:39[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:12:39[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:12:39[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:12:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:12:40[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:40[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:12:40[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:12:40[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:12:40[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:12:52[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:52[INFO][] [CTTBase.php:130] action = admin/index
2018-06-18 15:12:52[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 15:12:52[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index"}
2018-06-18 15:12:53[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 15:12:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:53[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:12:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:54[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2018-06-18 15:12:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:54[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:12:54[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:12:54[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:12:54[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:12:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:12:55[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:12:55[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:12:55[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:12:55[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:14:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:14:54[INFO][] [CTTBase.php:130] action = 
2018-06-18 15:14:54[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 15:14:54[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 15:14:54[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:14:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:14:57[INFO][] [CTTBase.php:130] action = 
2018-06-18 15:14:57[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 15:14:57[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 15:14:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:19:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:19:35[INFO][] [CTTBase.php:130] action = admin/index
2018-06-18 15:19:35[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 15:19:35[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index"}
2018-06-18 15:19:35[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 15:19:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:19:35[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:19:36[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:19:36[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2018-06-18 15:19:36[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:19:36[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:19:36[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:19:36[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:19:36[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:19:36[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:19:36[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:19:37[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:19:37[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:19:37[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2018-06-18 15:33:28[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:33:28[INFO][] [CTTBase.php:130] action = 
2018-06-18 15:33:28[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 15:33:28[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 15:33:28[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:33:29[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:33:29[INFO][] [CTTBase.php:130] action = 
2018-06-18 15:33:29[INFO][] [CTTBase.php:218] controller = HomeController ... method = index ... pluginCode = 
2018-06-18 15:33:29[INFO][Request Data] [CTTBase.php:219] {"r":"home","":null}
2018-06-18 15:33:29[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/home/home.php
2018-06-18 15:33:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:33:32[INFO][] [CTTBase.php:130] action = admin/index
2018-06-18 15:33:32[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-18 15:33:32[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index"}
2018-06-18 15:33:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/admin/index/index.php
2018-06-18 15:33:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:33:32[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2018-06-18 15:33:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2018-06-18 15:33:33[INFO][] [CTTBase.php:130] action = 404
2018-06-18 15:33:33[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-18 15:33:33[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-18 15:33:33[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu2/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:33:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:20[INFO][] [CTTBase.php:130] action = admin
2013-01-01 00:33:21[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2013-01-01 00:33:21[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2013-01-01 00:33:22[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:22[INFO][] [CTTBase.php:130] action = admin/login
2013-01-01 00:33:22[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2013-01-01 00:33:22[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login"}
2013-01-01 00:33:22[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/login.php
2013-01-01 00:33:34[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:34[INFO][] [CTTBase.php:130] action = admin/login
2013-01-01 00:33:34[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2013-01-01 00:33:34[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login","adminModel_username":"admin","adminModel_password":"123456","remember":"1"}
2013-01-01 00:33:36[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:36[INFO][] [CTTBase.php:130] action = admin
2013-01-01 00:33:37[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2013-01-01 00:33:37[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2013-01-01 00:33:37[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/index/index.php
2013-01-01 00:33:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:37[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:33:38[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:38[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:33:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:39[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:33:40[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:33:40[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:33:40[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:33:41[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:33:41[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:33:41[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:33:41[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:33:41[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:34:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:34:13[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:34:13[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:34:13[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:34:13[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:34:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:34:13[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:34:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:34:14[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:34:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:34:14[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:34:14[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:34:14[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:34:14[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:34:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:34:15[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:34:15[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:34:15[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:34:15[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:34:25[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:34:25[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:34:26[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:34:26[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:34:26[ERROR][] [common_loader.php:12] Error Message Id: 50e1cca29dfd6
2013-01-01 00:34:26[ERROR][] [common_loader.php:13] Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399
2013-01-01 00:34:26[ERROR][] [common_loader.php:14] {"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PHPExcel_Writer_Exception: Could not close zip file upload\/report\/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. in D:\\xampp\\htdocs\\vuagomsu\\library\\PHPExcel\\Classes\\PHPExcel\\Writer\\Excel2007.php on line <i>399<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0000<\/td><td bgcolor='#eeeeec' align='right'>129928<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>152536<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0060<\/td><td bgcolor='#eeeeec' align='right'>557576<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2013-01-01 00:34:26[ERROR][] [common_loader.php:21] <h1>Error:0</h1><p>Error Message Id: 50e1cca29dfd6</p><p>Uncaught exception: 'PHPExcel_Writer_Exception'</p><p>Message: 'Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx.'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\protected\controller\admin\AdminCustomerController.php(540): PHPExcel_Writer_Excel2007->save('upload/report/D...')
#1 [internal function]: AdminCustomerController->export()
#2 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminCustomerController))
#3 [internal function]: Controller->execute('export')
#4 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminCustomerController), 'export')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#6 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#11 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#12 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#13 {main}</pre></p>
2013-01-01 00:38:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:38:32[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:38:32[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:38:32[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:38:32[ERROR][] [common_loader.php:12] Error Message Id: 50e1cd98e31a4
2013-01-01 00:38:32[ERROR][] [common_loader.php:13] Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399
2013-01-01 00:38:32[ERROR][] [common_loader.php:14] {"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PHPExcel_Writer_Exception: Could not close zip file upload\/report\/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. in D:\\xampp\\htdocs\\vuagomsu\\library\\PHPExcel\\Classes\\PHPExcel\\Writer\\Excel2007.php on line <i>399<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>130168<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0020<\/td><td bgcolor='#eeeeec' align='right'>152776<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0080<\/td><td bgcolor='#eeeeec' align='right'>509336<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2013-01-01 00:38:32[ERROR][] [common_loader.php:21] <h1>Error:0</h1><p>Error Message Id: 50e1cd98e31a4</p><p>Uncaught exception: 'PHPExcel_Writer_Exception'</p><p>Message: 'Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx.'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\protected\controller\admin\AdminCustomerController.php(540): PHPExcel_Writer_Excel2007->save('upload/report/D...')
#1 [internal function]: AdminCustomerController->export()
#2 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminCustomerController))
#3 [internal function]: Controller->execute('export')
#4 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminCustomerController), 'export')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#6 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#11 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#12 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#13 {main}</pre></p>
2013-01-01 00:38:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:38:56[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:38:57[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:38:57[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:38:57[ERROR][] [common_loader.php:12] Error Message Id: 50e1cdb1647dd
2013-01-01 00:38:57[ERROR][] [common_loader.php:13] Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399
2013-01-01 00:38:57[ERROR][] [common_loader.php:14] {"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PHPExcel_Writer_Exception: Could not close zip file upload\/report\/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. in D:\\xampp\\htdocs\\vuagomsu\\library\\PHPExcel\\Classes\\PHPExcel\\Writer\\Excel2007.php on line <i>399<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>130168<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0020<\/td><td bgcolor='#eeeeec' align='right'>152776<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0180<\/td><td bgcolor='#eeeeec' align='right'>509224<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2013-01-01 00:38:57[ERROR][] [common_loader.php:21] <h1>Error:0</h1><p>Error Message Id: 50e1cdb1647dd</p><p>Uncaught exception: 'PHPExcel_Writer_Exception'</p><p>Message: 'Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx.'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\protected\controller\admin\AdminCustomerController.php(540): PHPExcel_Writer_Excel2007->save('upload/report/D...')
#1 [internal function]: AdminCustomerController->export()
#2 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminCustomerController))
#3 [internal function]: Controller->execute('export')
#4 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminCustomerController), 'export')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#6 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#11 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#12 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#13 {main}</pre></p>
2013-01-01 00:40:03[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:40:03[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:40:04[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:40:04[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:40:04[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:40:28[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:40:28[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:40:28[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:40:28[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:40:28[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:40:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:40:37[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:40:37[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:40:37[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:40:37[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:40:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:40:48[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:40:49[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:40:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:40:49[ERROR][] [common_loader.php:12] Error Message Id: 50e1ce215d441
2013-01-01 00:40:49[ERROR][] [common_loader.php:13] Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399
2013-01-01 00:40:49[ERROR][] [common_loader.php:14] {"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PHPExcel_Writer_Exception: Could not close zip file upload\/report\/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx. in D:\\xampp\\htdocs\\vuagomsu\\library\\PHPExcel\\Classes\\PHPExcel\\Writer\\Excel2007.php on line <i>399<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.1370<\/td><td bgcolor='#eeeeec' align='right'>130168<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.1370<\/td><td bgcolor='#eeeeec' align='right'>152776<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.1650<\/td><td bgcolor='#eeeeec' align='right'>482952<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2013-01-01 00:40:49[ERROR][] [common_loader.php:21] <h1>Error:0</h1><p>Error Message Id: 50e1ce215d441</p><p>Uncaught exception: 'PHPExcel_Writer_Exception'</p><p>Message: 'Could not close zip file upload/report/DANH-SACH-KHACH-HANG-[01-01-2013].xlsx.'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\library\PHPExcel\Classes\PHPExcel\Writer\Excel2007.php' on line 399</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\protected\controller\admin\AdminCustomerController.php(540): PHPExcel_Writer_Excel2007->save('upload/report/D...')
#1 [internal function]: AdminCustomerController->export()
#2 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminCustomerController))
#3 [internal function]: Controller->execute('export')
#4 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminCustomerController), 'export')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#6 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#11 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#12 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#13 {main}</pre></p>
2013-01-01 00:41:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:33[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:41:33[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:41:33[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:41:34[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:41:41[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:41[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:41:41[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:41:41[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:41:41[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:41:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:42[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:41:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:42[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:41:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:43[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:41:43[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:41:43[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:41:43[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:41:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:43[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:41:43[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:41:43[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:41:44[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:41:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:53[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:41:53[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:41:53[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:41:53[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:41:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:53[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:41:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:54[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:41:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:54[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:41:54[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:41:54[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:41:54[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:41:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:41:55[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:41:55[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:41:55[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:41:55[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:03[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:03[INFO][] [CTTBase.php:130] action = admin/logout
2013-01-01 00:42:04[INFO][] [CTTBase.php:218] controller = AdminController ... method = logout ... pluginCode = 
2013-01-01 00:42:04[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/logout"}
2013-01-01 00:42:04[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:04[INFO][] [CTTBase.php:130] action = admin/login
2013-01-01 00:42:04[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2013-01-01 00:42:04[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login"}
2013-01-01 00:42:04[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/login.php
2013-01-01 00:42:06[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:06[INFO][] [CTTBase.php:130] action = admin/login
2013-01-01 00:42:06[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2013-01-01 00:42:06[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login","adminModel_username":"admin","adminModel_password":"123456","remember":"1"}
2013-01-01 00:42:06[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:06[INFO][] [CTTBase.php:130] action = admin
2013-01-01 00:42:07[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2013-01-01 00:42:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2013-01-01 00:42:07[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/index/index.php
2013-01-01 00:42:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:07[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:42:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:07[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:42:08[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:08[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:08[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:08[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:08[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:08[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:08[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:08[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:08[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:08[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:10[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:10[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:42:11[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:42:11[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:42:11[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:42:11[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:11[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:42:11[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:11[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:42:12[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:12[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:12[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:12[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:12[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:12[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:12[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:12[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:12[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:12[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:15[INFO][] [CTTBase.php:130] action = admin/customer/export
2013-01-01 00:42:15[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = export ... pluginCode = 
2013-01-01 00:42:15[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/export"}
2013-01-01 00:42:15[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:42:30[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:30[INFO][] [CTTBase.php:130] action = admin/customer/add
2013-01-01 00:42:31[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = add ... pluginCode = 
2013-01-01 00:42:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/add"}
2013-01-01 00:42:31[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/add_edit.php
2013-01-01 00:42:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:31[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:42:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:31[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:42:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:32[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:32[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:32[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:32[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:32[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:32[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:48[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:42:48[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:42:48[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:42:48[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:42:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:49[INFO][] [CTTBase.php:130] action = admin
2013-01-01 00:42:49[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2013-01-01 00:42:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2013-01-01 00:42:49[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/index/index.php
2013-01-01 00:42:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:49[INFO][] [CTTBase.php:130] action = admin/login
2013-01-01 00:42:50[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2013-01-01 00:42:50[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login"}
2013-01-01 00:42:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:50[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:42:50[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:42:50[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:42:50[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:42:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:50[INFO][] [CTTBase.php:130] action = admin
2013-01-01 00:42:51[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2013-01-01 00:42:51[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2013-01-01 00:42:51[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/index/index.php
2013-01-01 00:42:51[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:51[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:42:51[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:51[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:52[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:52[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:52[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:55[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:42:56[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:42:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:42:56[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:42:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:56[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:42:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:56[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:42:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:57[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:57[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:57[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:57[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:42:57[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:42:57[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:42:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:42:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:42:59[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:43:00[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:43:00[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:43:00[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:43:00[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:43:00[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:43:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:43:13[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:43:13[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:43:13[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:43:13[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:43:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:43:14[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/css/swiper.min.css
2013-01-01 00:43:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:43:14[INFO][] [CTTBase.php:130] action = resource/backend/js/swiper/js/swiper.min.js
2013-01-01 00:43:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:43:15[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:43:15[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:43:15[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:43:15[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:43:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:43:15[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:43:16[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:43:16[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:43:16[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:46:28[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:46:28[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:46:28[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:46:28[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:46:28[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:46:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:46:49[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:46:49[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:46:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:46:49[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:46:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:46:53[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:46:53[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:46:53[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:46:53[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:46:58[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","22":"video","23":"ui"}
2013-01-01 00:46:58[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:46:58[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:46:58[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:46:58[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:53:18[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:53:18[INFO][] [CTTBase.php:130] action = admin/customer/manage
2013-01-01 00:53:19[INFO][] [CTTBase.php:218] controller = AdminCustomerController ... method = manage ... pluginCode = 
2013-01-01 00:53:19[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/customer\/manage"}
2013-01-01 00:53:19[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/customer/manage.php
2013-01-01 00:58:21[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:21[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2013-01-01 00:58:22[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2013-01-01 00:58:22[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2013-01-01 00:58:22[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/manage.php
2013-01-01 00:58:24[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:24[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2013-01-01 00:58:25[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2013-01-01 00:58:25[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2013-01-01 00:58:25[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2013-01-01 00:58:41[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:41[INFO][] [CTTBase.php:130] action = admin/layout/manage
2013-01-01 00:58:42[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2013-01-01 00:58:42[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage"}
2013-01-01 00:58:42[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2013-01-01 00:58:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:42[INFO][] [CTTBase.php:130] action = admin/layout/manage
2013-01-01 00:58:42[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2013-01-01 00:58:42[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit"}
2013-01-01 00:58:42[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2013-01-01 00:58:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:43[INFO][] [CTTBase.php:130] action = admin/layout/manage
2013-01-01 00:58:43[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2013-01-01 00:58:43[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2013-01-01 00:58:43[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2013-01-01 00:58:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:44[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-icons_222222_256x240.png
2013-01-01 00:58:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:44[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:58:45[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:58:45[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:58:45[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:58:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:49[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:58:49[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:58:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2013-01-01 00:58:49[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:58:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:49[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-bg_diagonals-thick_20_666666_40x40.png
2013-01-01 00:58:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:50[INFO][] [CTTBase.php:130] action = 404
2013-01-01 00:58:50[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2013-01-01 00:58:50[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2013-01-01 00:58:50[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2013-01-01 00:58:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:56[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:58:56[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:58:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"edit_widget","layout_widget_id":"334","widget_controller":"TextWidget","json_setting":{"layout_widget_id":"334","widget_controller":"TextWidget","title":"header_extra","show_title":"0","class":"","text":"<div class=\"privateStore\">\r\n<div class=\"col-provate-4\">\r\n<div class=\"privateStoreItem1\">\r\n<div class=\"privateIcon\"><i class=\"fa fa-usd\" aria-hidden=\"true\"><\/i><\/div>\r\n<div class=\"privateContent\">\r\n<div class=\"privateTitle\">Tr\u1ea3 h\u00e0ng & ho\u00e0n ti\u1ec1n<\/div>\r\n<p>Kh\u00e1ch h\u00e0ng ho\u00e0n tr\u1ea3 h\u00e0ng \u0111\u01b0\u1ee3c ho\u00e0n tr\u1ea3 100% s\u1ed1 ti\u1ec1n \u0111\u00e3 chi tr\u1ea3 tr\u01b0\u1edbc \u0111\u00f3<\/p>\r\n<\/div>\r\n<\/div>\r\n<\/div>\r\n<div class=\"col-provate-4 col-provate-42\">\r\n<div class=\"privateStoreItem2\">\r\n<div class=\"privateIcon\"><i class=\"fa fa-car\" aria-hidden=\"true\"><\/i><\/div>\r\n<div class=\"privateContent\">\r\n<div class=\"privateTitle\">Mi\u1ec5n ph\u00ed v\u1eadn chuy\u1ec3n<\/div>\r\n<p>Ch\u00fang t\u00f4i mi\u1ec5n ph\u00ed v\u1eabn chuy\u1ec3n cho to\u00e0n b\u1ed9 kh\u00e1ch h\u00e0ng trong n\u1ed9i th\u00e0nh<\/p>\r\n<\/div>\r\n<\/div>\r\n<\/div>\r\n<div class=\"col-provate-4\">\r\n<div class=\"privateStoreItem3\">\r\n<div class=\"privateIcon\"><i class=\"fa fa-paper-plane\" aria-hidden=\"true\"><\/i><\/div>\r\n<div class=\"privateContent\">\r\n<div class=\"privateTitle\">B\u1ea3o m\u1eadt th\u00f4ng tin<\/div>\r\n<p>C\u00f4ng ty cam k\u1ebft b\u1ea3o m\u1eadt tuy\u1ec7t \u0111\u1ed1i th\u00f4ng tin c\u00e1 nh\u00e2n c\u1ee7a kh\u00e1ch h\u00e0ng<\/p>\r\n<\/div>\r\n<\/div>\r\n<\/div>\r\n<\/div>","mobile_show":"1"}}
2013-01-01 00:58:56[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:58:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:58:59[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:58:59[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:58:59[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2013-01-01 00:58:59[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:59:12[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:59:12[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:59:12[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:59:12[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"edit_widget","layout_widget_id":"334","widget_controller":"TextWidget","json_setting":{"layout_widget_id":"334","widget_controller":"TextWidget","title":"header_extra","show_title":"0","class":"","text":"<div class=\"privateStore\">\r\n<div class=\"col-provate-4\">\r\n<div class=\"privateStoreItem1\">\r\n<div class=\"privateIcon\"><i class=\"fa fa-usd\" aria-hidden=\"true\"><\/i><\/div>\r\n<div class=\"privateContent\">\r\n<div class=\"privateTitle\">Tr\u1ea3 h\u00e0ng & ho\u00e0n ti\u1ec1n<\/div>\r\n<p>Kh\u00e1ch h\u00e0ng ho\u00e0n tr\u1ea3 h\u00e0ng \u0111\u01b0\u1ee3c ho\u00e0n tr\u1ea3 100% s\u1ed1 ti\u1ec1n \u0111\u00e3 chi tr\u1ea3 tr\u01b0\u1edbc \u0111\u00f3<\/p>\r\n<\/div>\r\n<\/div>\r\n<\/div>\r\n<div class=\"col-provate-4 col-provate-42\">\r\n<div class=\"privateStoreItem2\">\r\n<div class=\"privateIcon\"><i class=\"fa fa-car\" aria-hidden=\"true\"><\/i><\/div>\r\n<div class=\"privateContent\">\r\n<div class=\"privateTitle\">Mi\u1ec5n ph\u00ed v\u1eadn chuy\u1ec3n<\/div>\r\n<p>Ch\u00fang t\u00f4i mi\u1ec5n ph\u00ed v\u1eabn chuy\u1ec3n cho to\u00e0n b\u1ed9 kh\u00e1ch h\u00e0ng trong n\u1ed9i th\u00e0nh<\/p>\r\n<\/div>\r\n<\/div>\r\n<\/div>\r\n<div class=\"col-provate-4\">\r\n<div class=\"privateStoreItem3\">\r\n<div class=\"privateIcon\"><i class=\"fa fa-paper-plane\" aria-hidden=\"true\"><\/i><\/div>\r\n<div class=\"privateContent\">\r\n<div class=\"privateTitle\">B\u1ea3o m\u1eadt th\u00f4ng tin<\/div>\r\n<p>C\u00f4ng ty cam k\u1ebft b\u1ea3o m\u1eadt tuy\u1ec7t \u0111\u1ed1i th\u00f4ng tin c\u00e1 nh\u00e2n c\u1ee7a kh\u00e1ch h\u00e0ng<\/p>\r\n<\/div>\r\n<\/div>\r\n<\/div>\r\n<\/div>","mobile_show":"1"}}
2013-01-01 00:59:13[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:59:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:59:14[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:59:14[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:59:14[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"338"}
2013-01-01 00:59:14[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:59:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:59:20[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:59:20[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:59:20[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2013-01-01 00:59:20[INFO][] [CTTBase.php:294] contentPath = 
2013-01-01 00:59:29[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2013-01-01 00:59:29[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2013-01-01 00:59:30[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2013-01-01 00:59:30[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2013-01-01 00:59:30[INFO][] [CTTBase.php:294] contentPath = 
2018-06-01 01:03:27[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:03:27[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:03:27[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:03:27[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:03:27[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:06:34[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:06:34[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:06:34[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:06:34[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:06:34[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:07:28[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:07:28[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:07:28[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:07:28[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:07:28[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:07:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:07:39[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:07:40[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:07:40[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:07:40[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:09:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:09:56[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:09:56[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:09:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:09:56[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:09:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:09:59[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:10:00[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:10:00[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:10:00[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:10:05[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:10:05[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:10:05[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:10:05[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:10:05[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:11:21[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:11:21[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:11:21[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:11:21[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:11:21[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:14:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:14:31[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:14:31[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:14:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:14:31[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:15:01[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:15:01[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:15:01[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:15:01[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:15:01[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:15:23[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:15:23[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:15:23[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:15:23[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:15:23[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:16:23[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:16:23[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:16:24[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:16:24[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:16:24[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:16:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:16:31[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:16:31[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:16:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:16:31[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:16:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:16:39[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:16:39[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:16:39[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:16:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-01 01:16:52[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-01 01:16:52[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-01 01:16:52[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-01 01:16:52[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-01 01:16:52[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-18 23:16:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-18 23:16:44[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-18 23:16:44[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-18 23:16:44[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-18 23:16:44[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-18 23:17:10[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-18 23:17:10[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-18 23:17:11[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-18 23:17:11[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-18 23:17:11[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-18 23:17:45[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-18 23:17:45[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-18 23:17:46[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-18 23:17:46[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-18 23:17:46[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-18 23:20:11[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-18 23:20:11[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-18 23:20:11[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-18 23:20:11[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-18 23:20:11[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 08:50:09[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 08:50:09[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 08:50:10[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 08:50:10[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 08:50:10[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:12:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:12:54[INFO][] [CTTBase.php:130] action = admom
2018-06-19 09:12:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:12:54[INFO][] [CTTBase.php:130] action = 404
2018-06-19 09:12:54[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 09:12:54[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 09:12:54[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 09:12:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:12:54[INFO][] [CTTBase.php:130] action = resource/backend/css/style_404.css
2018-06-19 09:12:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:12:55[INFO][] [CTTBase.php:130] action = 404
2018-06-19 09:12:55[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 09:12:55[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 09:12:55[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 09:12:58[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:12:58[INFO][] [CTTBase.php:130] action = admin
2018-06-19 09:12:58[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-19 09:12:58[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-19 09:12:58[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:12:58[INFO][] [CTTBase.php:130] action = admin/login
2018-06-19 09:12:58[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2018-06-19 09:12:58[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login"}
2018-06-19 09:12:58[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/login.php
2018-06-19 09:13:00[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:13:00[INFO][] [CTTBase.php:130] action = admin/login
2018-06-19 09:13:00[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2018-06-19 09:13:00[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login","adminModel_username":"admin","adminModel_password":"123456","remember":"1"}
2018-06-19 09:13:01[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:13:01[INFO][] [CTTBase.php:130] action = admin
2018-06-19 09:13:01[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-19 09:13:01[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-19 09:13:01[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/index/index.php
2018-06-19 09:13:04[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:13:04[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2018-06-19 09:13:04[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2018-06-19 09:13:04[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2018-06-19 09:13:05[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/manage.php
2018-06-19 09:13:11[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:13:11[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:13:11[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:13:11[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:13:11[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:21:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:21:47[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:21:47[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:21:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:21:47[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:23:30[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:23:30[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:23:30[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:23:30[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:23:30[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:23:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:23:46[INFO][] [CTTBase.php:130] action = admin/email_template/validate_ajax
2018-06-19 09:23:46[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = validate_ajax ... pluginCode = 
2018-06-19 09:23:46[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/validate_ajax","action":"edit","key":"contact_for_admin","emailTemplateId":"1"}
2018-06-19 09:23:46[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 09:23:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:23:46[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:23:46[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:23:46[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1","emailTemplateModel_subject":" Contact admin","emailTemplateModel_note":"M\u1eabu email g\u1eedi cho admin khi c\u00f3 1 kh\u00e1ch h\u00e0ng g\u1eedi contact\r\nDanh s\u00e1ch tham s\u1ed1\r\n{name}... t\u00ean c\u1ee7a kh\u00e1ch h\u00e0ng trong form contact\r\n{email}\r\n{phone\r\n{address}\r\n{subject}... ti\u00eau \u0111\u1ec1 trong form contact\r\n{message}... n\u1ed9i dung c\u1ee7a form contact\r\n{crtDate}... ng\u00e0y t\u1ea1o form contact","emailTemplateModel_content":"<p><img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/support.jpg\" style=\"height:239px; width:300px\" \/><img alt=\"logo\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" \/><\/p>\r\n\r\n<p><strong>T\u1eadp \u0111o&agrave;n Vua G\u1ed1m S\u1ee9<\/strong><\/p>\r\n\r\n<p>Contact from<\/p>\r\n\r\n<table>\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td>Name<\/td>\r\n\t\t\t<td>{name}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Phone<\/td>\r\n\t\t\t<td>{email}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Email<\/td>\r\n\t\t\t<td>{phone}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Address<\/td>\r\n\t\t\t<td>{address}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Subject<\/td>\r\n\t\t\t<td>&nbsp;{subject}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Message<\/td>\r\n\t\t\t<td>{message}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Create date<\/td>\r\n\t\t\t<td>{crtDate}<\/td>\r\n\t\t<\/tr>\r\n\t<\/tbody>\r\n<\/table>\r\n"}
2018-06-19 09:23:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:23:47[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2018-06-19 09:23:47[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2018-06-19 09:23:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2018-06-19 09:23:47[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/manage.php
2018-06-19 09:23:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:23:49[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:23:49[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:23:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:23:49[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:25:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:25:13[INFO][] [CTTBase.php:130] action = sss
2018-06-19 09:25:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:25:14[INFO][] [CTTBase.php:130] action = sss
2018-06-19 09:25:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:25:14[INFO][] [CTTBase.php:130] action = 404
2018-06-19 09:25:14[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 09:25:14[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 09:25:14[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 09:25:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:25:14[INFO][] [CTTBase.php:130] action = 404
2018-06-19 09:25:15[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 09:25:15[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 09:25:15[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 09:25:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:25:46[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:25:46[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:25:46[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:25:46[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:27:41[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:27:41[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:27:41[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:27:41[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:27:41[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:27:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:27:46[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:27:47[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:27:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:27:47[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:27:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:27:48[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:27:49[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:27:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:27:49[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:31:06[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:31:06[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:31:06[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:31:06[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:31:06[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:32:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:32:42[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:32:42[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:32:42[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:32:42[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:34:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:34:47[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:34:47[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:34:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:34:47[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:39:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:39:39[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:39:39[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:39:39[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:39:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:40:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:40:48[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:40:48[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:40:48[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:40:48[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:40:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:40:55[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:40:55[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:40:55[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:40:55[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:42:22[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:42:22[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:42:23[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:42:23[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:42:23[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:43:16[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:43:16[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:43:16[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:43:16[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:43:16[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:45:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:45:14[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:45:14[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:45:14[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:45:14[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:46:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:46:54[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:46:54[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:46:54[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:46:54[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:47:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:47:20[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:47:21[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:47:21[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:47:21[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:48:24[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:48:24[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:48:24[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:48:24[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:48:24[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:49:08[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:49:08[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:49:09[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:49:09[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:49:09[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:49:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:49:48[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:49:48[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:49:48[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:49:48[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:55:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:55:39[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:55:39[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:55:39[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:55:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:57:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:57:31[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:57:31[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:57:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:57:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:57:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:57:53[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:57:53[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:57:53[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:57:53[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 09:58:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 09:58:50[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 09:58:50[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 09:58:50[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 09:58:50[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:02:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:02:20[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:02:20[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:02:20[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:02:20[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:02:55[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:02:55[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:02:55[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:02:55[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:02:55[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:04:12[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:04:12[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:04:12[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:04:12[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:04:12[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:05:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:05:43[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:05:43[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:05:43[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:05:43[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:06:01[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:06:01[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:06:02[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:06:02[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:06:02[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:21:09[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:21:09[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:21:09[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:21:09[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage"}
2018-06-19 10:21:10[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:21:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:21:13[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:21:13[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:21:13[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:21:13[ERROR][] [common_loader.php:12] Error Message Id: 5b2876a9df286
2018-06-19 10:21:13[ERROR][] [common_loader.php:13] SQLSTATE[42S02]: Base table or view not found: 1146 Table 'vuagomsu.seo_info' doesn't exist Thrown in 'D:\xampp\htdocs\vuagomsu\protected\persistence\dao\SeoInfoDao.php' on line 293
2018-06-19 10:21:13[ERROR][] [common_loader.php:14] {"errorInfo":["42S02",1146,"Table 'vuagomsu.seo_info' doesn't exist"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'vuagomsu.seo_info' doesn't exist in D:\\xampp\\htdocs\\vuagomsu\\protected\\persistence\\dao\\SeoInfoDao.php on line <i>293<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>131456<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>154064<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0110<\/td><td bgcolor='#eeeeec' align='right'>1339448<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-19 10:21:13[ERROR][] [common_loader.php:21] <h1>Error:42S02</h1><p>Error Message Id: 5b2876a9df286</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42S02]: Base table or view not found: 1146 Table 'vuagomsu.seo_info' doesn't exist'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\protected\persistence\dao\SeoInfoDao.php' on line 293</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\protected\persistence\dao\SeoInfoDao.php(293): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu\plugin\shop\controller\admin\AdminProductController.php(287): SeoInfoDao->selectByFilter(Object(SeoInfoVo))
#2 [internal function]: AdminProductController->editView()
#3 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminProductController))
#4 [internal function]: Controller->execute('editView')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminProductController), 'editView')
#6 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#11 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#12 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#13 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#14 {main}</pre></p>
2018-06-19 10:25:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:25:53[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:25:53[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:25:53[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:25:53[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:26:00[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:26:00[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:26:00[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:26:00[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:26:00[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:30:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:30:44[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:30:44[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:30:44[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:30:44[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:31:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:31:59[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:31:59[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:31:59[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:31:59[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:32:23[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:23[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:32:23[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:32:23[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:32:23[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:32:36[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:36[INFO][] [CTTBase.php:130] action = admin/email_template/validate_ajax
2018-06-19 10:32:36[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = validate_ajax ... pluginCode = 
2018-06-19 10:32:36[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/validate_ajax","action":"edit","key":"contact_for_admin","emailTemplateId":"1"}
2018-06-19 10:32:36[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:32:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:37[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:32:37[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:32:37[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1","emailTemplateModel_subject":" Contact admin","emailTemplateModel_note":"M\u1eabu email g\u1eedi cho admin khi c\u00f3 1 kh\u00e1ch h\u00e0ng g\u1eedi contact\r\nDanh s\u00e1ch tham s\u1ed1\r\n{name}... t\u00ean c\u1ee7a kh\u00e1ch h\u00e0ng trong form contact\r\n{email}\r\n{phone\r\n{address}\r\n{subject}... ti\u00eau \u0111\u1ec1 trong form contact\r\n{message}... n\u1ed9i dung c\u1ee7a form contact\r\n{crtDate}... ng\u00e0y t\u1ea1o form contact","emailTemplateModel_content":"<p><strong>T\u1eadp \u0111o&agrave;n Vua G\u1ed1m S\u1ee9<\/strong><\/p>\r\n\r\n<p>Contact from<\/p>\r\n\r\n<table>\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td>Name<\/td>\r\n\t\t\t<td>{name}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Phone<\/td>\r\n\t\t\t<td>{email}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Email<\/td>\r\n\t\t\t<td>{phone}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Address<\/td>\r\n\t\t\t<td>{address}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Subject<\/td>\r\n\t\t\t<td>&nbsp;{subject}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Message<\/td>\r\n\t\t\t<td>{message}<\/td>\r\n\t\t<\/tr>\r\n\t\t<tr>\r\n\t\t\t<td>Create date<\/td>\r\n\t\t\t<td>{crtDate}<\/td>\r\n\t\t<\/tr>\r\n\t<\/tbody>\r\n<\/table>\r\n"}
2018-06-19 10:32:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:37[INFO][] [CTTBase.php:130] action = admin/email_template/manage
2018-06-19 10:32:37[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = manage ... pluginCode = 
2018-06-19 10:32:37[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/manage"}
2018-06-19 10:32:37[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/manage.php
2018-06-19 10:32:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:39[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:32:39[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:32:39[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:32:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:32:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:44[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:32:44[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:32:44[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:32:44[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:32:49[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:32:49[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:32:49[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:32:49[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:32:49[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:33:04[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:33:04[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:33:05[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:33:05[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:33:05[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:33:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:33:47[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:33:47[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:33:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:33:47[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:35:22[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:22[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:35:22[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:35:22[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:35:22[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:35:24[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:24[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:35:24[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:35:24[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:35:24[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:35:26[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:26[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:35:26[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:35:26[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:35:26[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:35:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:33[INFO][] [CTTBase.php:130] action = admin/logout
2018-06-19 10:35:33[INFO][] [CTTBase.php:218] controller = AdminController ... method = logout ... pluginCode = 
2018-06-19 10:35:33[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/logout"}
2018-06-19 10:35:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:33[INFO][] [CTTBase.php:130] action = admin/login
2018-06-19 10:35:33[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2018-06-19 10:35:33[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login"}
2018-06-19 10:35:33[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/login.php
2018-06-19 10:35:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:35[INFO][] [CTTBase.php:130] action = admin/login
2018-06-19 10:35:35[INFO][] [CTTBase.php:218] controller = AdminController ... method = login ... pluginCode = 
2018-06-19 10:35:35[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/login","adminModel_username":"admin","adminModel_password":"123456","remember":"1"}
2018-06-19 10:35:36[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:36[INFO][] [CTTBase.php:130] action = admin
2018-06-19 10:35:36[INFO][] [CTTBase.php:218] controller = AdminController ... method = index ... pluginCode = 
2018-06-19 10:35:36[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/index","":""}
2018-06-19 10:35:36[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/index/index.php
2018-06-19 10:35:38[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:38[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:35:39[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:35:39[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:35:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:35:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:47[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:35:47[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:35:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage"}
2018-06-19 10:35:48[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:35:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:35:50[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:35:50[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:35:50[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:35:50[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:38:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:38:15[INFO][] [CTTBase.php:130] action = admin/file/add_image_ajax
2018-06-19 10:38:15[INFO][] [CTTBase.php:218] controller = AdminController ... method = addImageAjax ... pluginCode = 
2018-06-19 10:38:15[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/file\/add_image_ajax","image":"http:\/\/localhost\/vuagomsu\/upload\/images\/6_636177349181754863_hasthumb_thumb.jpg","index":"1"}
2018-06-19 10:38:15[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:43:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:43:35[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:43:35[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:43:35[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:43:36[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:43:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:43:42[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:43:42[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:43:42[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"","productModel_status":"A","productExtension":{"attribute":"","help":""},"seoModel_title":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","seoModel_description":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","seoModel_keywords":""}
2018-06-19 10:43:43[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:43:43[INFO][] 113
2018-06-19 10:43:43[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:44:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:44:20[INFO][] [CTTBase.php:130] action = admin/file/add_image_ajax
2018-06-19 10:44:20[INFO][] [CTTBase.php:218] controller = AdminController ... method = addImageAjax ... pluginCode = 
2018-06-19 10:44:20[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/file\/add_image_ajax","image":"http:\/\/localhost\/vuagomsu\/upload\/images\/qua-tang.jpg","index":"1"}
2018-06-19 10:44:20[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:44:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:44:42[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:44:42[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:44:42[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["http:\/\/localhost\/vuagomsu\/upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"Meta Title","seoModel_description":"Meta Description","seoModel_keywords":"Meta Keyword"}
2018-06-19 10:44:43[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:44:43[INFO][] 113
2018-06-19 10:44:43[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:50:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:50:47[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:50:47[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:50:47[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["http:\/\/localhost\/vuagomsu\/upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"Meta Title","seoModel_description":"Meta Description","seoModel_keywords":"Meta Keyword"}
2018-06-19 10:50:47[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:50:47[INFO][] 113
2018-06-19 10:50:47[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:50:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:50:56[INFO][] [CTTBase.php:130] action = admin/product/edit/view
2018-06-19 10:50:56[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = editView ... pluginCode = shop
2018-06-19 10:50:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit\/view","productId":"570"}
2018-06-19 10:50:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/add_edit.php
2018-06-19 10:51:03[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:51:03[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:51:03[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:51:03[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"Meta Title","seoModel_keyword":"Meta Keyword","seoModel_description":"Meta Description"}
2018-06-19 10:51:04[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:51:04[INFO][] 113
2018-06-19 10:51:04[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:51:31[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:51:31[INFO][] [CTTBase.php:130] action = admin/category/manage
2018-06-19 10:51:31[INFO][] [CTTBase.php:218] controller = AdminCategoryController ... method = manage ... pluginCode = shop
2018-06-19 10:51:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/category\/manage"}
2018-06-19 10:51:32[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/category/manage.php
2018-06-19 10:51:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:51:44[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:51:44[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:51:44[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage"}
2018-06-19 10:51:45[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:51:48[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:51:48[INFO][] [CTTBase.php:130] action = do-trang-tri-gia-dung-khac/tranh-dong-que-mau-3.html
2018-06-19 10:51:48[INFO][] [CTTBase.php:218] controller = HomeProductController ... method = productDetail ... pluginCode = shop
2018-06-19 10:51:48[INFO][Request Data] [CTTBase.php:219] {"r":"home\/product\/detail","productId":"570"}
2018-06-19 10:51:48[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/product/index.php
2018-06-19 10:52:04[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:52:04[INFO][] [CTTBase.php:130] action = do-trang-tri-gia-dung-khac/tranh-dong-que-mau-3.html
2018-06-19 10:52:04[INFO][] [CTTBase.php:218] controller = HomeProductController ... method = productDetail ... pluginCode = shop
2018-06-19 10:52:04[INFO][Request Data] [CTTBase.php:219] {"r":"home\/product\/detail","productId":"570"}
2018-06-19 10:52:04[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/product/index.php
2018-06-19 10:52:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:52:20[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:52:20[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:52:20[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"","seoModel_keyword":"","seoModel_description":""}
2018-06-19 10:52:20[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:52:20[INFO][] 113
2018-06-19 10:52:20[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:52:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:52:20[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:52:20[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:52:20[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"","seoModel_keyword":"","seoModel_description":""}
2018-06-19 10:52:21[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:52:21[INFO][] 113
2018-06-19 10:52:21[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:52:21[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:52:21[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:52:21[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:52:21[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"","seoModel_keyword":"","seoModel_description":""}
2018-06-19 10:52:21[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:52:21[INFO][] 113
2018-06-19 10:52:21[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:52:23[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:52:23[INFO][] [CTTBase.php:130] action = do-trang-tri-gia-dung-khac/tranh-dong-que-mau-3.html
2018-06-19 10:52:24[INFO][] [CTTBase.php:218] controller = HomeProductController ... method = productDetail ... pluginCode = shop
2018-06-19 10:52:24[INFO][Request Data] [CTTBase.php:219] {"r":"home\/product\/detail","productId":"570"}
2018-06-19 10:52:24[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/product/index.php
2018-06-19 10:53:22[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:53:22[INFO][] [CTTBase.php:130] action = do-trang-tri-gia-dung-khac/tranh-dong-que-mau-3.html
2018-06-19 10:53:22[INFO][] [CTTBase.php:218] controller = HomeProductController ... method = productDetail ... pluginCode = shop
2018-06-19 10:53:22[INFO][Request Data] [CTTBase.php:219] {"r":"home\/product\/detail","productId":"570"}
2018-06-19 10:53:22[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/product/index.php
2018-06-19 10:54:19[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:54:19[INFO][] [CTTBase.php:130] action = do-trang-tri-gia-dung-khac/tranh-dong-que-mau-3.html
2018-06-19 10:54:19[INFO][] [CTTBase.php:218] controller = HomeProductController ... method = productDetail ... pluginCode = shop
2018-06-19 10:54:19[INFO][Request Data] [CTTBase.php:219] {"r":"home\/product\/detail","productId":"570"}
2018-06-19 10:54:19[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/product/index.php
2018-06-19 10:54:51[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:54:51[INFO][] [CTTBase.php:130] action = do-trang-tri-gia-dung-khac/tranh-dong-que-mau-3.html
2018-06-19 10:54:51[INFO][] [CTTBase.php:218] controller = HomeProductController ... method = productDetail ... pluginCode = shop
2018-06-19 10:54:51[INFO][Request Data] [CTTBase.php:219] {"r":"home\/product\/detail","productId":"570"}
2018-06-19 10:54:51[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/product/index.php
2018-06-19 10:55:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:55:13[INFO][] [CTTBase.php:130] action = admin/product/edit
2018-06-19 10:55:13[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = edit ... pluginCode = shop
2018-06-19 10:55:13[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/edit","productId":"570","productModel_name":"Tranh \u0110\u1ed3ng Qu\u00ea M\u1eabu 3","productModel_categoryId":["113"],"categoryPrimaryId":"113","productModel_price":"0","productModel_saleOf":"0","tagName":"","image_primary":"http:\/\/localhost\/vuagomsu\/upload\/images\/no-image.png","productModel_description":"<p>qqq<img alt=\"\" src=\"http:\/\/localhost\/vuagomsu\/upload\/images\/logo.png\" style=\"height:185px; width:260px\" \/><\/p>\r\n","productModel_status":"A","image_list":["upload\/images\/qua-tang.jpg"],"productExtension":{"attribute":"<p>&nbsp;<\/p>\r\n\r\n<p>Thu\u1ed9c t&iacute;nh<\/p>\r\n","help":"<p>H\u01b0\u1edbng d\u1eabn s\u1eed dung<\/p>\r\n"},"seoModel_title":"","seoModel_keyword":"","seoModel_description":""}
2018-06-19 10:55:13[INFO][] [CategoryExt.php:380] log content ----------------------------------- 
2018-06-19 10:55:13[INFO][] 113
2018-06-19 10:55:13[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:55:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:55:14[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:55:14[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:55:14[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage"}
2018-06-19 10:55:14[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:56:08[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:08[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:56:08[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:56:08[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage","productModel_productId":"","name":"","productModel_categoryListText":"","priceFrom":"","priceTo":"","productModel_status":"","page":"0"}
2018-06-19 10:56:09[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:56:12[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:12[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:56:12[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:56:12[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage","productModel_productId":"","name":"aaa","productModel_categoryListText":"","priceFrom":"","priceTo":"","productModel_status":"","page":"0"}
2018-06-19 10:56:12[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:56:18[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:18[INFO][] [CTTBase.php:130] action = admin/product/manage
2018-06-19 10:56:18[INFO][] [CTTBase.php:218] controller = AdminProductController ... method = manage ... pluginCode = shop
2018-06-19 10:56:18[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/product\/manage","productModel_productId":"","name":"a","productModel_categoryListText":"","priceFrom":"","priceTo":"","productModel_status":"","page":"0"}
2018-06-19 10:56:18[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/shop/view/admin/product/manage.php
2018-06-19 10:56:34[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:34[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 10:56:34[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 10:56:34[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage"}
2018-06-19 10:56:35[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 10:56:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:35[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 10:56:35[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 10:56:35[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit"}
2018-06-19 10:56:35[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 10:56:35[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:35[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 10:56:36[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 10:56:36[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 10:56:36[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 10:56:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:37[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-icons_222222_256x240.png
2018-06-19 10:56:37[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:37[INFO][] [CTTBase.php:130] action = 404
2018-06-19 10:56:37[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 10:56:37[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 10:56:37[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 10:56:42[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:42[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 10:56:42[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 10:56:42[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 10:56:42[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 10:56:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:43[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-bg_diagonals-thick_20_666666_40x40.png
2018-06-19 10:56:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:43[INFO][] [CTTBase.php:130] action = 404
2018-06-19 10:56:43[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 10:56:43[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 10:56:43[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 10:56:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:56:56[INFO][] [CTTBase.php:130] action = admin/email_template/edit
2018-06-19 10:56:56[INFO][] [CTTBase.php:218] controller = AdminEmailTemplateController ... method = edit ... pluginCode = 
2018-06-19 10:56:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/email_template\/edit","emailTemplateId":"1"}
2018-06-19 10:56:56[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/email_template/add_edit.php
2018-06-19 10:59:41[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 10:59:41[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 10:59:41[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 10:59:41[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 10:59:41[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 11:00:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:00:07[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:00:07[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:00:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 11:00:07[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:01[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:01[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:01[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:01[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 11:02:01[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:29[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:29[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:29[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:29[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_add_widget","layoutId":"1"}
2018-06-19 11:02:29[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:30[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:30[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:31[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"TextWidget","layoutId":"1"}
2018-06-19 11:02:31[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:32[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:32[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:32[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"TextWidget","layoutId":"1"}
2018-06-19 11:02:32[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:33[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:33[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:33[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"TextWidget","layoutId":"1"}
2018-06-19 11:02:33[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:43[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:43[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:43[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"ImageWidget","layoutId":"1"}
2018-06-19 11:02:43[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:44[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:45[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:45[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"MenuWidget","layoutId":"1"}
2018-06-19 11:02:45[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:46[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:46[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:46[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"MenuWidget","layoutId":"1"}
2018-06-19 11:02:46[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:47[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:47[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:48[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:48[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"TextWidget","layoutId":"1"}
2018-06-19 11:02:48[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:51[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:51[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:51[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:51[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"change_widget","widget_controller":"CustomViewWidget","layoutId":"1"}
2018-06-19 11:02:51[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:02:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:02:56[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:02:56[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:02:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 11:02:56[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:00[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:00[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:00[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:00[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"edit_widget","layout_widget_id":"334","widget_controller":"TextWidget","json_setting":{"layout_widget_id":"334","widget_controller":"TextWidget","title":"header_extra","show_title":"0","class":"","text":"<p>Tr\u1ea3 h&agrave;ng &amp; ho&agrave;n ti\u1ec1n<\/p>\r\n\r\n<p>Kh&aacute;ch h&agrave;ng ho&agrave;n tr\u1ea3 h&agrave;ng \u0111\u01b0\u1ee3c ho&agrave;n tr\u1ea3 100% s\u1ed1 ti\u1ec1n \u0111&atilde; chi tr\u1ea3 tr\u01b0\u1edbc \u0111&oacute;<\/p>\r\n\r\n<p>Mi\u1ec5n ph&iacute; v\u1eadn chuy\u1ec3n<\/p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i mi\u1ec5n ph&iacute; v\u1eabn chuy\u1ec3n cho to&agrave;n b\u1ed9 kh&aacute;ch h&agrave;ng trong n\u1ed9i th&agrave;nh<\/p>\r\n\r\n<p>B\u1ea3o m\u1eadt th&ocirc;ng tin<\/p>\r\n\r\n<p>C&ocirc;ng ty cam k\u1ebft b\u1ea3o m\u1eadt tuy\u1ec7t \u0111\u1ed1i th&ocirc;ng tin c&aacute; nh&acirc;n c\u1ee7a kh&aacute;ch h&agrave;ng<\/p>\r\n","mobile_show":"1"}}
2018-06-19 11:03:00[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:02[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:02[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:02[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:02[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 11:03:02[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:05[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:05[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:06[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:06[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"edit_widget","layout_widget_id":"334","widget_controller":"TextWidget","json_setting":{"layout_widget_id":"334","widget_controller":"TextWidget","title":"header_extra","show_title":"0","class":"","text":"<p>Tr\u1ea3 h&agrave;ng &amp; ho&agrave;n ti\u1ec1n<\/p>\r\naaa\r\n<p>Kh&aacute;ch h&agrave;ng ho&agrave;n tr\u1ea3 h&agrave;ng \u0111\u01b0\u1ee3c ho&agrave;n tr\u1ea3 100% s\u1ed1 ti\u1ec1n \u0111&atilde; chi tr\u1ea3 tr\u01b0\u1edbc \u0111&oacute;<\/p>\r\n\r\n<p>Mi\u1ec5n ph&iacute; v\u1eadn chuy\u1ec3n<\/p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i mi\u1ec5n ph&iacute; v\u1eabn chuy\u1ec3n cho to&agrave;n b\u1ed9 kh&aacute;ch h&agrave;ng trong n\u1ed9i th&agrave;nh<\/p>\r\n\r\n<p>B\u1ea3o m\u1eadt th&ocirc;ng tin<\/p>\r\n\r\n<p>C&ocirc;ng ty cam k\u1ebft b\u1ea3o m\u1eadt tuy\u1ec7t \u0111\u1ed1i th&ocirc;ng tin c&aacute; nh&acirc;n c\u1ee7a kh&aacute;ch h&agrave;ng<\/p>\r\n","mobile_show":"1"}}
2018-06-19 11:03:06[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:07[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:07[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 11:03:07[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:13[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:13[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:13[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:13[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"edit_widget","layout_widget_id":"334","widget_controller":"TextWidget","json_setting":{"layout_widget_id":"334","widget_controller":"TextWidget","title":"header_extra","show_title":"0","class":"","text":"<p>Tr\u1ea3 h&agrave;ng &amp; ho&agrave;n ti\u1ec1n<\/p>\r\n\r\n<p>Kh&aacute;ch h&agrave;ng ho&agrave;n tr\u1ea3 h&agrave;ng \u0111\u01b0\u1ee3c ho&agrave;n tr\u1ea3 100% s\u1ed1 ti\u1ec1n \u0111&atilde; chi tr\u1ea3 tr\u01b0\u1edbc \u0111&oacute;<\/p>\r\n\r\n<p>Mi\u1ec5n ph&iacute; v\u1eadn chuy\u1ec3n<\/p>w\r\n\r\n<p>Ch&uacute;ng t&ocirc;i mi\u1ec5n ph&iacute; v\u1eabn chuy\u1ec3n cho to&agrave;n b\u1ed9 kh&aacute;ch h&agrave;ng trong n\u1ed9i th&agrave;nh<\/p>\r\n\r\n<p>B\u1ea3o m\u1eadt th&ocirc;ng tin<\/p>\r\n\r\n<p>C&ocirc;ng ty cam k\u1ebft b\u1ea3o m\u1eadt tuy\u1ec7t \u0111\u1ed1i th&ocirc;ng tin c&aacute; nh&acirc;n c\u1ee7a kh&aacute;ch h&agrave;ng<\/p>\r\n","mobile_show":"1"}}
2018-06-19 11:03:13[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:14[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:15[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:15[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"show_edit_widget","layout_widget_id":"334"}
2018-06-19 11:03:15[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:03:18[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:03:18[INFO][] [CTTBase.php:130] action = admin/layout/layout_widget_action_ajax
2018-06-19 11:03:18[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = layout_widget_action_ajax ... pluginCode = 
2018-06-19 11:03:18[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/layout_widget_action_ajax","action":"edit_widget","layout_widget_id":"334","widget_controller":"TextWidget","json_setting":{"layout_widget_id":"334","widget_controller":"TextWidget","title":"header_extra","show_title":"0","class":"","text":"<p>Tr\u1ea3 h&agrave;ng &amp; ho&agrave;n ti\u1ec1n<\/p>\r\n\r\n<p>Kh&aacute;ch h&agrave;ng ho&agrave;n tr\u1ea3 h&agrave;ng \u0111\u01b0\u1ee3c ho&agrave;n tr\u1ea3 100% s\u1ed1 ti\u1ec1n \u0111&atilde; chi tr\u1ea3 tr\u01b0\u1edbc \u0111&oacute;<\/p>\r\n\r\n<p>Mi\u1ec5n ph&iacute; v\u1eadn chuy\u1ec3n<\/p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i mi\u1ec5n ph&iacute; v\u1eabn chuy\u1ec3n cho to&agrave;n b\u1ed9 kh&aacute;ch h&agrave;ng trong n\u1ed9i th&agrave;nh<\/p>\r\n\r\n<p>B\u1ea3o m\u1eadt th&ocirc;ng tin<\/p>\r\n\r\n<p>C&ocirc;ng ty cam k\u1ebft b\u1ea3o m\u1eadt tuy\u1ec7t \u0111\u1ed1i th&ocirc;ng tin c&aacute; nh&acirc;n c\u1ee7a kh&aacute;ch h&agrave;ng<\/p>\r\n","mobile_show":"1"}}
2018-06-19 11:03:18[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:04:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:04:56[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 11:04:56[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:04:56[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1","active_layout_widget_list":"312-187-381-334-338-351-121-350-336-337-353-365-366-367-117","layoutRow":{"139":{"position":"0","cols":["312","187-381"]},"124":{"position":"1","cols":["334"]},"129":{"position":"2","cols":["338"]},"153":{"position":"3","cols":["351"]},"144":{"position":"4","cols":["121-350"]},"147":{"position":"5","cols":["336","337"]},"154":{"position":"6","cols":["353"]},"156":{"position":"7","cols":["365"]},"157":{"position":"8","cols":["366"]},"158":{"position":"9","cols":["367"]},"127":{"position":"10","cols":["117"]},"146":{"position":"0","cols":["333"]},"66":{"position":"1","cols":["299"]},"142":{"position":"2","cols":["328"]},"148":{"position":"0","cols":["340","314","364"]},"108":{"position":"1","cols":["207"]}},"widgetList":["ProductCategoryWidget","LightSliderImageWidget","ImageWidget","TextWidget","ProductGroupWidget","ProductListWidget","ProductListWidget","ProductListWidget","ImageWidget","ImageWidget","ProductListWidget","ProductListWidget","ProductListWidget","ProductListWidget","LightSliderImageWidget","TextWidget","NewsLatestWidget","ImageWidget","ImageWidget","CustomViewWidget","CustomViewWidget","MenuWidget","TextWidget","MenuWidget","FacebookLikeBoxWidget","CustomViewWidget"],"name":"Trang ch\u1ee7","system_header":"1","system_footer":"1","custom_css":".header_top{\r\n    background: transparent;\r\n}","disable_layout_widget_list":"335-276-354-355"}
2018-06-19 11:04:56[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:04:56[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 11:04:57[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:04:57[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1","active_layout_widget_list":"312-187-381-334-338-351-121-350-336-337-353-365-366-367-117","layoutRow":{"139":{"position":"0","cols":["312","187-381"]},"124":{"position":"1","cols":["334"]},"129":{"position":"2","cols":["338"]},"153":{"position":"3","cols":["351"]},"144":{"position":"4","cols":["121-350"]},"147":{"position":"5","cols":["336","337"]},"154":{"position":"6","cols":["353"]},"156":{"position":"7","cols":["365"]},"157":{"position":"8","cols":["366"]},"158":{"position":"9","cols":["367"]},"127":{"position":"10","cols":["117"]},"146":{"position":"0","cols":["333"]},"66":{"position":"1","cols":["299"]},"142":{"position":"2","cols":["328"]},"148":{"position":"0","cols":["340","314","364"]},"108":{"position":"1","cols":["207"]}},"widgetList":["ProductCategoryWidget","LightSliderImageWidget","ImageWidget","TextWidget","ProductGroupWidget","ProductListWidget","ProductListWidget","ProductListWidget","ImageWidget","ImageWidget","ProductListWidget","ProductListWidget","ProductListWidget","ProductListWidget","LightSliderImageWidget","TextWidget","NewsLatestWidget","ImageWidget","ImageWidget","CustomViewWidget","CustomViewWidget","MenuWidget","TextWidget","MenuWidget","FacebookLikeBoxWidget","CustomViewWidget"],"name":"Trang ch\u1ee7","system_header":"1","system_footer":"1","custom_css":".header_top{\r\n    background: transparent;\r\n}","disable_layout_widget_list":"335-276-354-355"}
2018-06-19 11:04:57[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:04:57[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 11:04:57[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:04:57[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 11:04:57[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 11:04:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:04:59[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-icons_222222_256x240.png
2018-06-19 11:04:59[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:04:59[INFO][] [CTTBase.php:130] action = 404
2018-06-19 11:04:59[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 11:04:59[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 11:04:59[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 11:05:02[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:05:02[INFO][] [CTTBase.php:130] action = admin/help/list
2018-06-19 11:05:02[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:05:02[INFO][] [CTTBase.php:130] action = admin/404
2018-06-19 11:05:02[INFO][] [CTTBase.php:218] controller = AdminController ... method = page_404 ... pluginCode = 
2018-06-19 11:05:02[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/404"}
2018-06-19 11:05:02[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:05:05[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:05:05[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 11:05:05[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:05:05[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 11:05:05[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 11:05:06[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:05:06[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-icons_222222_256x240.png
2018-06-19 11:05:06[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:05:06[INFO][] [CTTBase.php:130] action = 404
2018-06-19 11:05:06[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 11:05:06[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 11:05:06[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 11:09:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:09:07[INFO][] [CTTBase.php:130] action = admin/plugin/manage
2018-06-19 11:09:07[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = manage ... pluginCode = 
2018-06-19 11:09:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/manage"}
2018-06-19 11:09:07[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/manage.php
2018-06-19 11:09:09[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:09:09[INFO][] [CTTBase.php:130] action = admin/plugin/add
2018-06-19 11:09:09[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = add ... pluginCode = 
2018-06-19 11:09:09[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/add"}
2018-06-19 11:09:09[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/add_edit.php
2018-06-19 11:09:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:09:14[INFO][] [CTTBase.php:130] action = admin/plugin/validate_ajax
2018-06-19 11:09:14[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = validate_ajax ... pluginCode = 
2018-06-19 11:09:14[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/validate_ajax","action":"add","pluginCode":"help","pluginId":""}
2018-06-19 11:09:14[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:09:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:09:14[INFO][] [CTTBase.php:130] action = admin/plugin/add
2018-06-19 11:09:14[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = add ... pluginCode = 
2018-06-19 11:09:14[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/add","pluginModel_pluginCode":"help","pluginModel_priority":"","pluginModel_status":"A"}
2018-06-19 11:09:14[ERROR][] [common_loader.php:31] Error Message Id: 5b2881ea9b796
2018-06-19 11:09:14[ERROR][] [common_loader.php:32] Error Message Id: 5b2881ea9b796 1 - Class 'CBaseDao' not found in D:\xampp\htdocs\vuagomsu\plugin\help\action.php at line 45
2018-06-19 11:09:14[ERROR][] [common_loader.php:33] {"type":1,"message":"Class 'CBaseDao' not found","file":"D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\action.php","line":45}
2018-06-19 11:09:53[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help"}
2018-06-19 11:09:53[INFO][] [CTTBase.php:130] action = admin/plugin/add
2018-06-19 11:09:53[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = add ... pluginCode = 
2018-06-19 11:09:53[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/add","pluginModel_pluginCode":"help","pluginModel_priority":"","pluginModel_status":"A"}
2018-06-19 11:15:07[INFO][Plugin List] [CTTBase.php:119] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:07[INFO][] [CTTBase.php:131] action = admin/layout/manage
2018-06-19 11:15:07[INFO][] [CTTBase.php:219] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:15:07[INFO][Request Data] [CTTBase.php:220] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 11:15:07[INFO][] [CTTBase.php:295] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 11:15:08[INFO][Plugin List] [CTTBase.php:119] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:08[INFO][] [CTTBase.php:131] action = resource/backend/js/images/ui-icons_222222_256x240.png
2018-06-19 11:15:08[INFO][Plugin List] [CTTBase.php:119] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:08[INFO][] [CTTBase.php:131] action = 404
2018-06-19 11:15:08[INFO][] [CTTBase.php:219] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 11:15:08[INFO][Request Data] [CTTBase.php:220] {"r":"home\/404","":null}
2018-06-19 11:15:09[INFO][] [CTTBase.php:295] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 11:15:16[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:16[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 11:15:17[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:15:17[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 11:15:17[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 11:15:17[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:17[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-icons_222222_256x240.png
2018-06-19 11:15:18[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:18[INFO][] [CTTBase.php:130] action = 404
2018-06-19 11:15:18[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 11:15:18[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 11:15:18[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 11:15:20[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:20[INFO][] [CTTBase.php:130] action = admin/plugin/manage
2018-06-19 11:15:20[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = manage ... pluginCode = 
2018-06-19 11:15:20[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/manage"}
2018-06-19 11:15:20[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/manage.php
2018-06-19 11:15:26[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","20":"help","21":"help"}
2018-06-19 11:15:26[INFO][] [CTTBase.php:130] action = admin/plugin/delete
2018-06-19 11:15:26[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = delete ... pluginCode = 
2018-06-19 11:15:26[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/delete","pluginId":"20"}
2018-06-19 11:15:26[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:15:26[INFO][] [CTTBase.php:130] action = admin/plugin/manage
2018-06-19 11:15:26[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = manage ... pluginCode = 
2018-06-19 11:15:26[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/manage"}
2018-06-19 11:15:26[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/manage.php
2018-06-19 11:15:30[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:15:30[INFO][] [CTTBase.php:130] action = admin/plugin/manage
2018-06-19 11:15:31[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = manage ... pluginCode = 
2018-06-19 11:15:31[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/manage"}
2018-06-19 11:15:31[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/manage.php
2018-06-19 11:15:33[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:15:33[INFO][] [CTTBase.php:130] action = admin/plugin/add
2018-06-19 11:15:33[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = add ... pluginCode = 
2018-06-19 11:15:33[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/add"}
2018-06-19 11:15:33[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/add_edit.php
2018-06-19 11:15:38[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:15:38[INFO][] [CTTBase.php:130] action = admin/plugin/validate_ajax
2018-06-19 11:15:38[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = validate_ajax ... pluginCode = 
2018-06-19 11:15:38[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/validate_ajax","action":"add","pluginCode":"help","pluginId":""}
2018-06-19 11:15:38[INFO][] [CTTBase.php:294] contentPath = 
2018-06-19 11:15:38[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo"}
2018-06-19 11:15:38[INFO][] [CTTBase.php:130] action = admin/plugin/add
2018-06-19 11:15:38[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = add ... pluginCode = 
2018-06-19 11:15:38[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/add","pluginModel_pluginCode":"help","pluginModel_priority":"","pluginModel_status":"A"}
2018-06-19 11:15:39[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:15:39[INFO][] [CTTBase.php:130] action = admin/plugin/manage
2018-06-19 11:15:39[INFO][] [CTTBase.php:218] controller = AdminPluginController ... method = manage ... pluginCode = 
2018-06-19 11:15:39[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/plugin\/manage"}
2018-06-19 11:15:39[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/plugin/manage.php
2018-06-19 11:15:43[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:15:43[INFO][] [CTTBase.php:130] action = admin/layout/manage
2018-06-19 11:15:43[INFO][] [CTTBase.php:218] controller = AdminLayoutController ... method = manage ... pluginCode = 
2018-06-19 11:15:43[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/layout\/manage","action":"edit","layoutId":"1"}
2018-06-19 11:15:43[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/admin/layout/manage.php
2018-06-19 11:15:44[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:15:44[INFO][] [CTTBase.php:130] action = resource/backend/js/images/ui-icons_222222_256x240.png
2018-06-19 11:15:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:15:46[INFO][] [CTTBase.php:130] action = 404
2018-06-19 11:15:46[INFO][] [CTTBase.php:218] controller = HomeController ... method = page_404 ... pluginCode = 
2018-06-19 11:15:46[INFO][Request Data] [CTTBase.php:219] {"r":"home\/404","":null}
2018-06-19 11:15:46[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/protected/view/frontend/vuagomsu/404.php
2018-06-19 11:15:46[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:15:46[INFO][] [CTTBase.php:130] action = admin/help/list
2018-06-19 11:15:46[ERROR][] [common_loader.php:31] Error Message Id: 5b288372ce9af
2018-06-19 11:15:46[ERROR][] [common_loader.php:32] Error Message Id: 5b288372ce9af 1 - Class 'CController' not found in D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php at line 2
2018-06-19 11:15:46[ERROR][] [common_loader.php:33] {"type":1,"message":"Class 'CController' not found","file":"D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\controller\\admin\\AdminHelpController.php","line":2}
2018-06-19 11:17:14[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:17:14[INFO][] [CTTBase.php:130] action = admin/help/list
2018-06-19 11:17:14[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = help_list ... pluginCode = help
2018-06-19 11:17:14[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/list"}
2018-06-19 11:17:14[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/list.php
2018-06-19 11:17:21[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:17:21[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:17:21[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:17:21[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:17:21[ERROR][] [common_loader.php:31] Error Message Id: 5b2883d18d859
2018-06-19 11:17:21[ERROR][] [common_loader.php:32] Error Message Id: 5b2883d18d859 1 - Class 'CHelpVo' not found in D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php at line 65
2018-06-19 11:17:21[ERROR][] [common_loader.php:33] {"type":1,"message":"Class 'CHelpVo' not found","file":"D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\controller\\admin\\AdminHelpController.php","line":65}
2018-06-19 11:18:54[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:18:54[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:18:54[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:18:54[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:18:54[ERROR][] [common_loader.php:31] Error Message Id: 5b28842ed1f69
2018-06-19 11:18:54[ERROR][] [common_loader.php:32] Error Message Id: 5b28842ed1f69 1 - Call to undefined method Registry::get_setting() in D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php at line 73
2018-06-19 11:18:54[ERROR][] [common_loader.php:33] {"type":1,"message":"Call to undefined method Registry::get_setting()","file":"D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\controller\\admin\\AdminHelpController.php","line":73}
2018-06-19 11:19:32[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:19:32[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:19:32[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:19:32[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:19:32[ERROR][] [common_loader.php:31] Error Message Id: 5b28845454058
2018-06-19 11:19:32[ERROR][] [common_loader.php:32] Error Message Id: 5b28845454058 1 - Class 'Paging' not found in D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php at line 89
2018-06-19 11:19:32[ERROR][] [common_loader.php:33] {"type":1,"message":"Class 'Paging' not found","file":"D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\controller\\admin\\AdminHelpController.php","line":89}
2018-06-19 11:19:50[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:19:50[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:19:50[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:19:50[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:19:50[ERROR][] [common_loader.php:31] Error Message Id: 5b288466bb0fe
2018-06-19 11:19:50[ERROR][] [common_loader.php:32] Error Message Id: 5b288466bb0fe 1 - Call to undefined method HelpDao::selectByFilterRange() in D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php at line 93
2018-06-19 11:19:50[ERROR][] [common_loader.php:33] {"type":1,"message":"Call to undefined method HelpDao::selectByFilterRange()","file":"D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\controller\\admin\\AdminHelpController.php","line":93}
2018-06-19 11:20:27[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:20:27[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:20:27[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:20:27[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:20:27[ERROR][] [common_loader.php:12] Error Message Id: 5b28848bda962
2018-06-19 11:20:27[ERROR][] [common_loader.php:13] SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1 Thrown in 'D:\xampp\htdocs\vuagomsu\plugin\help\persistence\dao\HelpDao.php' on line 271
2018-06-19 11:20:27[ERROR][] [common_loader.php:14] {"errorInfo":["42000",1064,"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1 in D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\persistence\\dao\\HelpDao.php on line <i>271<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>130136<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>152744<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0060<\/td><td bgcolor='#eeeeec' align='right'>510432<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-19 11:20:27[ERROR][] [common_loader.php:21] <h1>Error:42000</h1><p>Error Message Id: 5b28848bda962</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\plugin\help\persistence\dao\HelpDao.php' on line 271</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\plugin\help\persistence\dao\HelpDao.php(271): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php(93): HelpDao->selectByFilter(Object(HelpVo), 0, '20', Array)
#2 [internal function]: AdminHelpController->manage()
#3 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminHelpController))
#4 [internal function]: Controller->execute('manage')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminHelpController), 'manage')
#6 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#11 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#12 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#13 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#14 {main}</pre></p>
2018-06-19 11:21:24[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:21:24[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:21:24[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:21:24[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:21:24[ERROR][] [common_loader.php:12] Error Message Id: 5b2884c437110
2018-06-19 11:21:24[ERROR][] [common_loader.php:13] SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1 Thrown in 'D:\xampp\htdocs\vuagomsu\plugin\help\persistence\dao\HelpDao.php' on line 271
2018-06-19 11:21:24[ERROR][] [common_loader.php:14] {"errorInfo":["42000",1064,"You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1"],"xdebug_message":"<tr><th align='left' bgcolor='#f57900' colspan=\"5\"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )<\/span> PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1 in D:\\xampp\\htdocs\\vuagomsu\\plugin\\help\\persistence\\dao\\HelpDao.php on line <i>271<\/i><\/th><\/tr>\n<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack<\/th><\/tr>\n<tr><th align='center' bgcolor='#eeeeec'>#<\/th><th align='left' bgcolor='#eeeeec'>Time<\/th><th align='left' bgcolor='#eeeeec'>Memory<\/th><th align='left' bgcolor='#eeeeec'>Function<\/th><th align='left' bgcolor='#eeeeec'>Location<\/th><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>1<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>130136<\/td><td bgcolor='#eeeeec'>{main}(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>0<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>2<\/td><td bgcolor='#eeeeec' align='center'>0.0010<\/td><td bgcolor='#eeeeec' align='right'>152744<\/td><td bgcolor='#eeeeec'>require_once( <font color='#00bb00'>'D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php'<\/font> )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\index.php' bgcolor='#eeeeec'>..\\index.php<b>:<\/b>3<\/td><\/tr>\n<tr><td bgcolor='#eeeeec' align='center'>3<\/td><td bgcolor='#eeeeec' align='center'>0.0060<\/td><td bgcolor='#eeeeec' align='right'>510432<\/td><td bgcolor='#eeeeec'>CTTBase->start(  )<\/td><td title='D:\\xampp\\htdocs\\vuagomsu\\protected\\core\\TT.php' bgcolor='#eeeeec'>..\\TT.php<b>:<\/b>69<\/td><\/tr>\n"}
2018-06-19 11:21:24[ERROR][] [common_loader.php:21] <h1>Error:42000</h1><p>Error Message Id: 5b2884c437110</p><p>Uncaught exception: 'PDOException'</p><p>Message: 'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'B  limit 20,Array' at line 1'</p><p>Thrown in 'D:\xampp\htdocs\vuagomsu\plugin\help\persistence\dao\HelpDao.php' on line 271</p><p>Stack trace:<pre>#0 D:\xampp\htdocs\vuagomsu\plugin\help\persistence\dao\HelpDao.php(271): PDOStatement->execute()
#1 D:\xampp\htdocs\vuagomsu\plugin\help\controller\admin\AdminHelpController.php(93): HelpDao->selectByFilter(Object(HelpVo), 0, '20', Array)
#2 [internal function]: AdminHelpController->manage()
#3 D:\xampp\htdocs\vuagomsu\protected\core\controller\Controller.php(30): ReflectionMethod->invoke(Object(AdminHelpController))
#4 [internal function]: Controller->execute('manage')
#5 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CTTMvcFilter.php(34): ReflectionMethod->invoke(Object(AdminHelpController), 'manage')
#6 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): CTTMvcFilter->doFilter(Object(CFilterChainImp))
#7 D:\xampp\htdocs\vuagomsu\protected\filter\AuthorizationCheckFilter.php(15): CFilterChainImp->doFilter(Object(CFilterChainImp))
#8 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): AuthorizationCheckFilter->doFilter(Object(CFilterChainImp))
#9 D:\xampp\htdocs\vuagomsu\protected\filter\PrepareParamFilter.php(72): CFilterChainImp->doFilter(Object(CFilterChainImp))
#10 D:\xampp\htdocs\vuagomsu\protected\core\filter\filerClass\CFilterChainImp.php(28): PrepareParamFilter->doFilter(Object(CFilterChainImp))
#11 D:\xampp\htdocs\vuagomsu\protected\core\CTTBase.php(231): CFilterChainImp->doFilter()
#12 D:\xampp\htdocs\vuagomsu\protected\core\TT.php(69): CTTBase->start()
#13 D:\xampp\htdocs\vuagomsu\index.php(3): require_once('D:\\xampp\\htdocs...')
#14 {main}</pre></p>
2018-06-19 11:28:03[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:03[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:28:03[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:28:03[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:28:03[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/manage.php
2018-06-19 11:28:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:07[INFO][] [CTTBase.php:130] action = admin/help/edit
2018-06-19 11:28:07[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = edit ... pluginCode = help
2018-06-19 11:28:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/edit","helpId":"1"}
2018-06-19 11:28:07[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/add_edit.php
2018-06-19 11:28:10[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:10[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:28:10[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:28:10[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:28:10[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/manage.php
2018-06-19 11:28:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:15[INFO][] [CTTBase.php:130] action = admin/help/list
2018-06-19 11:28:16[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = help_list ... pluginCode = help
2018-06-19 11:28:16[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/list"}
2018-06-19 11:28:16[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/list.php
