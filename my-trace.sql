2018-06-19 11:21:23[TRACE][SQL] [SettingDao.php:12] (selectAll) select * from `setting`
2018-06-19 11:21:23[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` order by priority ASC
2018-06-19 11:21:23[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` where `status`='A' order by priority ASC
2018-06-19 11:21:24[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:21:24[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:21:24[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `router_url` 
2018-06-19 11:21:24[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:21:24[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:21:24[TRACE][SQL] [LanguageValueDao.php:12] (selectAll) select * from `language_value`
2018-06-19 11:21:24[TRACE][SQL] [HelpDao.php:265] (selectByFilter) select * from `help` 
2018-06-19 11:21:24[TRACE][SQL] [HelpDao.php:265] (selectByFilter) select * from `help`  ORDER B  limit 20,Array
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
2018-06-19 11:28:03[TRACE][SQL] [SettingDao.php:12] (selectAll) select * from `setting`
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` order by priority ASC
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` where `status`='A' order by priority ASC
2018-06-19 11:28:03[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:03[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `router_url` 
2018-06-19 11:28:03[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:28:03[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:28:03[TRACE][SQL] [LanguageValueDao.php:12] (selectAll) select * from `language_value`
2018-06-19 11:28:03[TRACE][SQL] [HelpDao.php:265] (selectByFilter) select * from `help` 
2018-06-19 11:28:03[TRACE][SQL] [HelpDao.php:265] (selectByFilter) select * from `help`  ORDER BY `help_id` ASC  limit 0,20
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 1
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 1
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 2
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 14
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 14
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 14
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 11
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 13
2018-06-19 11:28:03[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 12
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select hc.help_cat_id, hc.`name`, COUNT(*) as count
from `help` as h
LEFT JOIN `help_cat` as hc on hc.help_cat_id = h.help_cat_id
where hc.`status`='A'				
GROUP BY hc.help_cat_id
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from help_cat where `status`='A'
2018-06-19 11:28:03[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/manage.php
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select * 
from setting_group
group by setting_type
order by `order`
2018-06-19 11:28:03[TRACE][SQL] [DataBaseHelper.php:101] (query) select n.*, p.`status` as plugin_status
from nav_link as n
left join `plugin` as p on p.plugin_code=n.plugin_code
order by n.order ASC
2018-06-19 11:28:06[TRACE][SQL] [SettingDao.php:12] (selectAll) select * from `setting`
2018-06-19 11:28:06[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` order by priority ASC
2018-06-19 11:28:06[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` where `status`='A' order by priority ASC
2018-06-19 11:28:07[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:07[INFO][] [CTTBase.php:130] action = admin/help/edit
2018-06-19 11:28:07[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `router_url` 
2018-06-19 11:28:07[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = edit ... pluginCode = help
2018-06-19 11:28:07[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/edit","helpId":"1"}
2018-06-19 11:28:07[TRACE][SQL] [LanguageValueDao.php:12] (selectAll) select * from `language_value`
2018-06-19 11:28:07[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 1
2018-06-19 11:28:07[TRACE][SQL] [DataBaseHelper.php:101] (query) select hc.help_cat_id, hc.`name`, COUNT(*) as count
from `help` as h
LEFT JOIN `help_cat` as hc on hc.help_cat_id = h.help_cat_id
where hc.`status`='A'				
GROUP BY hc.help_cat_id
2018-06-19 11:28:07[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from help_cat where `status`='A'
2018-06-19 11:28:07[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/add_edit.php
2018-06-19 11:28:07[TRACE][SQL] [DataBaseHelper.php:101] (query) select * 
from setting_group
group by setting_type
order by `order`
2018-06-19 11:28:07[TRACE][SQL] [DataBaseHelper.php:101] (query) select n.*, p.`status` as plugin_status
from nav_link as n
left join `plugin` as p on p.plugin_code=n.plugin_code
order by n.order ASC
2018-06-19 11:28:10[TRACE][SQL] [SettingDao.php:12] (selectAll) select * from `setting`
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` order by priority ASC
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` where `status`='A' order by priority ASC
2018-06-19 11:28:10[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:10[INFO][] [CTTBase.php:130] action = admin/help/manage
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `router_url` 
2018-06-19 11:28:10[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = manage ... pluginCode = help
2018-06-19 11:28:10[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/manage"}
2018-06-19 11:28:10[TRACE][SQL] [LanguageValueDao.php:12] (selectAll) select * from `language_value`
2018-06-19 11:28:10[TRACE][SQL] [HelpDao.php:265] (selectByFilter) select * from `help` 
2018-06-19 11:28:10[TRACE][SQL] [HelpDao.php:265] (selectByFilter) select * from `help`  ORDER BY `help_id` ASC  limit 0,20
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 1
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 1
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 2
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 14
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 14
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 14
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 11
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 13
2018-06-19 11:28:10[TRACE][SQL] [HelpCatDao.php:464] (getValueByPrimaryKey) ... primaryValue = 12
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select hc.help_cat_id, hc.`name`, COUNT(*) as count
from `help` as h
LEFT JOIN `help_cat` as hc on hc.help_cat_id = h.help_cat_id
where hc.`status`='A'				
GROUP BY hc.help_cat_id
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from help_cat where `status`='A'
2018-06-19 11:28:10[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/manage.php
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select * 
from setting_group
group by setting_type
order by `order`
2018-06-19 11:28:10[TRACE][SQL] [DataBaseHelper.php:101] (query) select n.*, p.`status` as plugin_status
from nav_link as n
left join `plugin` as p on p.plugin_code=n.plugin_code
order by n.order ASC
2018-06-19 11:28:15[TRACE][SQL] [SettingDao.php:12] (selectAll) select * from `setting`
2018-06-19 11:28:15[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` order by priority ASC
2018-06-19 11:28:15[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `plugin` where `status`='A' order by priority ASC
2018-06-19 11:28:15[INFO][Plugin List] [CTTBase.php:118] {"2":"slider","3":"shop","7":"news","14":"contact","16":"static_page","17":"customer_review","18":"newsletter","19":"seo","22":"help"}
2018-06-19 11:28:15[INFO][] [CTTBase.php:130] action = admin/help/list
2018-06-19 11:28:15[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from `router_url` 
2018-06-19 11:28:16[INFO][] [CTTBase.php:218] controller = AdminHelpController ... method = help_list ... pluginCode = help
2018-06-19 11:28:16[INFO][Request Data] [CTTBase.php:219] {"r":"admin\/help\/list"}
2018-06-19 11:28:16[TRACE][SQL] [LanguageValueDao.php:12] (selectAll) select * from `language_value`
2018-06-19 11:28:16[TRACE][SQL] [DataBaseHelper.php:101] (query) select hc.help_cat_id, hc.`name`, COUNT(*) as count
from `help` as h
LEFT JOIN `help_cat` as hc on hc.help_cat_id = h.help_cat_id
where hc.`status`='A'				
GROUP BY hc.help_cat_id
2018-06-19 11:28:16[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from help_cat where `status`='A'
2018-06-19 11:28:16[TRACE][SQL] [DataBaseHelper.php:101] (query) select * from help
2018-06-19 11:28:16[INFO][] [CTTBase.php:294] contentPath = D:\xampp\htdocs\vuagomsu/plugin/help/view/admin/help/list.php
2018-06-19 11:28:16[TRACE][SQL] [DataBaseHelper.php:101] (query) select * 
from setting_group
group by setting_type
order by `order`
2018-06-19 11:28:16[TRACE][SQL] [DataBaseHelper.php:101] (query) select n.*, p.`status` as plugin_status
from nav_link as n
left join `plugin` as p on p.plugin_code=n.plugin_code
order by n.order ASC
