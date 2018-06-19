<?php
return array(
    /**
     * admin action start
     */
    'admin/404' => array(
        'name' => 'Admin',
        'pageName' => 'Admin',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'page_404',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/error.layout.php'
            )
        )
    ),
    'admin/index' => array(
        'name' => 'Admin Index',
        'pageName' => 'Admin index',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'index',
        'results' => array(
            'index' => array(
                'type' => 'include',
                'path' => 'admin/index/index.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'login' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/login',
                'layout' => ''
            )
        )
    ),
    'admin/index/statistic_ajax' => array(
        'name' => 'Admin statistic ajax',
        'pageName' => 'Admin index',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'statistic_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/account' => array(
        'name' => 'Admin account information',
        'pageName' => 'Admin',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'account',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/account/account.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/account',
                'layout' => ''
            ),
            'false' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/index',
                'layout' => ''
            )
        )
    ),
    'admin/login' => array(
        'name' => 'Admin Login',
        'pageName' => 'Admin',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'login',
        'results' => array(
            'login' => array(
                'type' => 'include',
                'path' => 'admin/login.php',
                'layout' => 'layout/login.layout.php'
            ),
            'index' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/index',
                'layout' => ''
            )
        )
    ),
    'admin/logout' => array(
        'name' => 'Admin Logout',
        'pageName' => 'Admin',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'logout',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/login',
                'layout' => ''
            )
        )
    ),
    'admin/active/account' => array(
        'name' => 'Admin active account',
        'pageName' => 'Admin',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'activeAccount',
        'results' => array(
            'login' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/login',
                'layout' => ''
            )
        )
    ),
    'admin/file/add_image_ajax' => array(
        'name' => 'Add image by ajax',
        'pageName' => 'Admin file',
        'type' => 'admin',
        'controller' => 'AdminController',
        'method' => 'addImageAjax',
        'results' => array(
            'json' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // admin/setting start
    'admin/setting/manage' => array(
        'name' => 'Admin manage settings',
        'pageName' => 'Admin settings',
        'type' => 'admin',
        'controller' => 'AdminSettingController',
        'method' => 'manage',
        'results' => array(
            'manage' => array(
                'type' => 'include',
                'path' => 'admin/setting/manage.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/setting/manage',
                'layout' => ''
            ),
            'false' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/index',
                'layout' => ''
            )
        )
    ),
    // admin/setting end

    // nav_link start
    'admin/nav_link/manage' => array(
        'name' => 'Manage Nav Link',
        'pageName' => 'Admin Nav Link',
        'type' => 'admin',
        'controller' => 'AdminNavLinkController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/nav_link/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/nav_link/action' => array(
        'name' => 'Action Nav Link',
        'pageName' => 'Admin Nav Link',
        'type' => 'admin',
        'controller' => 'AdminNavLinkController',
        'method' => 'action',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // nav_link end

    // menu start
    'admin/menu/manage' => array(
        'name' => 'Manage Menu',
        'pageName' => 'Admin Menu',
        'type' => 'admin',
        'controller' => 'AdminMenuController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/menu/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/menu/action' => array(
        'name' => 'Action Menu',
        'pageName' => 'Admin Menu',
        'type' => 'admin',
        'controller' => 'AdminMenuController',
        'method' => 'action',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/menu/validate_ajax' => array(
        'name' => 'Validate ajax',
        'pageName' => 'Admin Menu',
        'type' => 'admin',
        'controller' => 'AdminMenuController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/menu/add' => array(
        'name' => 'Add Menu',
        'pageName' => 'Admin Menu',
        'type' => 'admin',
        'controller' => 'AdminMenuController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/menu/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/menu/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/menu/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            ),
            'popup.close' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/popup.close.layout.php'
            )
        )
    ),
    'admin/menu/edit' => array(
        'name' => 'Edit Menu',
        'pageName' => 'Admin Menu',
        'type' => 'admin',
        'controller' => 'AdminMenuController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/menu/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/menu/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/menu/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            ),
            'popup.close' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/popup.close.layout.php'
            )
        )
    ),
    'admin/menu/delete' => array(
        'name' => 'Delete Menu',
        'pageName' => 'Admin Menu',
        'type' => 'admin',
        'controller' => 'AdminMenuController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/menu/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/menu/manage',
                'layout' => ''
            )
        )
    ),
    // menu

    // router start
    'admin/router/manage' => array(
        'name' => 'Manage Router',
        'pageName' => 'Admin Router',
        'type' => 'admin',
        'controller' => 'AdminRouterController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/router/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/router/validate_ajax' => array(
        'name' => 'Validate ajax Router',
        'pageName' => 'Admin Router',
        'type' => 'admin',
        'controller' => 'AdminRouterController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/router/add' => array(
        'name' => 'Add Router',
        'pageName' => 'Admin Router',
        'type' => 'admin',
        'controller' => 'AdminRouterController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/router/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/router/manage',
                'layout' => ''
            )
        )
    ),
    'admin/router/edit' => array(
        'name' => 'Edit Router',
        'pageName' => 'Admin Router',
        'type' => 'admin',
        'controller' => 'AdminRouterController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/router/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/router/manage',
                'layout' => ''
            )
        )
    ),
    // router end

    // language start
    'admin/language/manage' => array(
        'name' => 'Manage language',
        'pageName' => 'Admin language',
        'type' => 'admin',
        'controller' => 'AdminLanguageController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/language/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/language/validate_ajax' => array(
        'name' => 'Validate ajax language',
        'pageName' => 'Admin language',
        'type' => 'admin',
        'controller' => 'AdminLanguageController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/language/add' => array(
        'name' => 'Add language',
        'pageName' => 'Admin language',
        'type' => 'admin',
        'controller' => 'AdminLanguageController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/language/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language/manage',
                'layout' => ''
            )
        )
    ),
    'admin/language/edit' => array(
        'name' => 'Edit language',
        'pageName' => 'Admin language',
        'type' => 'admin',
        'controller' => 'AdminLanguageController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/language/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language/manage',
                'layout' => ''
            )
        )
    ),
    'admin/language/delete' => array(
        'name' => 'Delete language',
        'pageName' => 'Admin language',
        'type' => 'admin',
        'controller' => 'AdminLanguageController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language/manage',
                'layout' => ''
            )
        )
    ),
    // language end
    // language_value start
    'admin/language_value/manage' => array(
        'name' => 'Manage language value',
        'pageName' => 'Admin language value',
        'type' => 'admin',
        'controller' => 'AdminLanguageValueController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/language_value/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/language_value/add' => array(
        'name' => 'Add language value',
        'pageName' => 'Admin language value',
        'type' => 'admin',
        'controller' => 'AdminLanguageValueController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/language_value/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language_value/manage',
                'layout' => ''
            )
        )
    ),
    'admin/language_value/add/validate' => array(
        'name' => 'Add language value validate',
        'pageName' => 'Admin language value',
        'type' => 'admin',
        'controller' => 'AdminLanguageValueController',
        'method' => 'add_validate',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/language_value/import_auto' => array(
        'name' => 'Import auto language value from code',
        'pageName' => 'Admin language value',
        'type' => 'admin',
        'controller' => 'AdminLanguageValueController',
        'method' => 'import_auto',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/language_value/save' => array(
        'name' => 'Save language value',
        'pageName' => 'Admin language value',
        'type' => 'admin',
        'controller' => 'AdminLanguageValueController',
        'method' => 'save',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/language_value/delete' => array(
        'name' => 'Delete language value',
        'pageName' => 'Admin language value',
        'type' => 'admin',
        'controller' => 'AdminLanguageValueController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language_value/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/language_value/manage',
                'layout' => ''
            )
        )
    ),
    // language_value end
    // admin layout manage start
    'admin/layout/manage' => array(
        'name' => 'Manage admin layout',
        'pageName' => 'Admin layout',
        'type' => 'admin',
        'controller' => 'AdminLayoutController',
        'method' => 'manage',
        'results' => array(
            'manage' => array(
                'type' => 'include',
                'path' => 'admin/layout/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/layout/layout_widget_action_ajax' => array(
        'name' => 'Admin layout widget action ajax',
        'pageName' => 'Admin layout',
        'type' => 'admin',
        'controller' => 'AdminLayoutController',
        'method' => 'layout_widget_action_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/layout/layout_row_action_ajax' => array(
        'name' => 'Admin layout row action ajax',
        'pageName' => 'Admin layout',
        'type' => 'admin',
        'controller' => 'AdminLayoutController',
        'method' => 'layout_row_action_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // admin layout manage end
    'admin/file/manage' => array(
        'name' => 'Manage admin files',
        'pageName' => 'Admin files',
        'type' => 'admin',
        'controller' => 'AdminFileController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/file/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/file/setting' => array(
        'name' => 'Setting admin files',
        'pageName' => 'Admin files',
        'type' => 'admin',
        'controller' => 'AdminFileController',
        'method' => 'setting',
        'results' => array(
            'manage' => array(
                'type' => 'include',
                'path' => 'admin/file/setting.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/file/setting',
                'layout' => ''
            )
        )
    ),
    // role start
    'admin/role/manage' => array(
        'name' => 'Manage admin role',
        'pageName' => 'Admin role',
        'type' => 'admin',
        'controller' => 'AdminRoleController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/role/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/role/add' => array(
        'name' => 'add admin role',
        'pageName' => 'Admin role',
        'type' => 'admin',
        'controller' => 'AdminRoleController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/role/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/role/manage',
                'layout' => ''
            )
        )
    ),
    'admin/role/edit' => array(
        'name' => 'Edit admin role',
        'pageName' => 'Admin role',
        'type' => 'admin',
        'controller' => 'AdminRoleController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/role/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/role/manage',
                'layout' => ''
            )
        )
    ),
    'admin/role/validate_ajax' => array(
        'name' => 'Validate ajax role',
        'pageName' => 'Admin role',
        'type' => 'admin',
        'controller' => 'AdminRoleController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/role/delete' => array(
        'name' => 'delete ajax role',
        'pageName' => 'Admin role',
        'type' => 'admin',
        'controller' => 'AdminRoleController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/role/manage',
                'layout' => ''
            )
        )
    ),
    // role end
    // admin start
    'admin/admin/manage' => array(
        'name' => 'Manage Admin',
        'pageName' => 'Admin Admin',
        'type' => 'admin',
        'controller' => 'AdminAdminController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/admin/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/admin/manage_ajax' => array(
        'name' => 'Manage ajax Admin',
        'pageName' => 'Admin Admin',
        'type' => 'admin',
        'controller' => 'AdminAdminController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/admin/validate_ajax' => array(
        'name' => 'Validate ajax Admin',
        'pageName' => 'Admin Admin',
        'type' => 'admin',
        'controller' => 'AdminAdminController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/admin/add' => array(
        'name' => 'Add Admin',
        'pageName' => 'Admin Admin',
        'type' => 'admin',
        'controller' => 'AdminAdminController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/admin/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/admin/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/admin/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/admin/edit' => array(
        'name' => 'Edit Admin',
        'pageName' => 'Admin Admin',
        'type' => 'admin',
        'controller' => 'AdminAdminController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/admin/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/admin/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/admin/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/admin/delete' => array(
        'name' => 'Delete Admin',
        'pageName' => 'Admin Admin',
        'type' => 'admin',
        'controller' => 'AdminAdminController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/admin/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/admin/manage',
                'layout' => ''
            )
        )
    ),
    // admin end

    // email_template start
    'admin/email_template/manage' => array(
        'name' => 'Manage email template',
        'pageName' => 'Admin email template',
        'type' => 'admin',
        'controller' => 'AdminEmailTemplateController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/email_template/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/email_template/validate_ajax' => array(
        'name' => 'Validate ajax email template',
        'pageName' => 'Admin email template',
        'type' => 'admin',
        'controller' => 'AdminEmailTemplateController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/email_template/add' => array(
        'name' => 'Add email template',
        'pageName' => 'Admin email template',
        'type' => 'admin',
        'controller' => 'AdminEmailTemplateController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/email_template/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/email_template/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/email_template/add_popup.php',
                'layout' => 'layout/json.layout.php'
            )
        )
    ),
    'admin/email_template/edit' => array(
        'name' => 'Edit email template',
        'pageName' => 'Admin email template',
        'type' => 'admin',
        'controller' => 'AdminEmailTemplateController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/email_template/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/email_template/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/email_template/edit_popup.php',
                'layout' => 'layout/json.layout.php'
            )
        )
    ),
    'admin/email_template/delete' => array(
        'name' => 'Delete email template',
        'pageName' => 'Admin email template',
        'type' => 'admin',
        'controller' => 'AdminEmailTemplateController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/email_template/manage',
                'layout' => ''
            )
        )
    ),
    'admin/email_template/manage_ajax' => array(
        'name' => 'Manage ajax email template',
        'pageName' => 'Admin email template',
        'type' => 'admin',
        'controller' => 'AdminEmailTemplateController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/email_template/manage_ajax.php',
                'layout' => 'layout/blank.layout.php'
            )
        )
    ),
    // email_template end

    // plugin start
    'admin/plugin/manage' => array(
        'name' => 'Manage Plugin',
        'pageName' => 'Admin Plugin',
        'type' => 'admin',
        'controller' => 'AdminPluginController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/plugin/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/plugin/manage_ajax' => array(
        'name' => 'Manage ajax Plugin',
        'pageName' => 'Admin Plugin',
        'type' => 'admin',
        'controller' => 'AdminPluginController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/plugin/validate_ajax' => array(
        'name' => 'Validate ajax Plugin',
        'pageName' => 'Admin Plugin',
        'type' => 'admin',
        'controller' => 'AdminPluginController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/plugin/add' => array(
        'name' => 'Add Plugin',
        'pageName' => 'Admin Plugin',
        'type' => 'admin',
        'controller' => 'AdminPluginController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/plugin/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/plugin/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/plugin/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/plugin/edit' => array(
        'name' => 'Edit Plugin',
        'pageName' => 'Admin Plugin',
        'type' => 'admin',
        'controller' => 'AdminPluginController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/plugin/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/plugin/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/plugin/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/plugin/delete' => array(
        'name' => 'Delete Plugin',
        'pageName' => 'Admin Plugin',
        'type' => 'admin',
        'controller' => 'AdminPluginController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/plugin/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/plugin/manage',
                'layout' => ''
            )
        )
    ),
    // plugin end

    // widget start
    'admin/widget/manage' => array(
        'name' => 'Manage Widget',
        'pageName' => 'Admin Widget',
        'type' => 'admin',
        'controller' => 'AdminWidgetController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/widget/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/widget/validate_ajax' => array(
        'name' => 'Validate ajax Widget',
        'pageName' => 'Admin Widget',
        'type' => 'admin',
        'controller' => 'AdminWidgetController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/widget/add' => array(
        'name' => 'Add Widget',
        'pageName' => 'Admin Widget',
        'type' => 'admin',
        'controller' => 'AdminWidgetController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/widget/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/widget/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/widget/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            ),
            'popup.close' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/popup.close.layout.php'
            )
        )
    ),
    'admin/widget/edit' => array(
        'name' => 'Edit Widget',
        'pageName' => 'Admin Widget',
        'type' => 'admin',
        'controller' => 'AdminWidgetController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/widget/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/widget/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/widget/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            ),
            'popup.close' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/popup.close.layout.php'
            )
        )
    ),
    'admin/widget/delete' => array(
        'name' => 'Delete Widget',
        'pageName' => 'Admin Widget',
        'type' => 'admin',
        'controller' => 'AdminWidgetController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/widget/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/widget/manage',
                'layout' => ''
            )
        )
    ),
    // widget end
    // customer start
    'admin/customer/manage' => array(
        'name' => 'Manage Customer',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/customer/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/customer/manage_ajax' => array(
        'name' => 'Manage ajax Customer',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/customer/validate_ajax' => array(
        'name' => 'Validate ajax Customer',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/customer/add' => array(
        'name' => 'Add Customer',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/customer/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/customer/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/customer/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/customer/edit' => array(
        'name' => 'Edit Customer',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/customer/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/customer/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/customer/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/customer/delete' => array(
        'name' => 'Delete Customer',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/customer/manage',
                'layout' => ''
            )
        )
    ),
    'admin/customer/export' => array(
        'name' => 'Customer export',
        'pageName' => 'Admin Customer',
        'type' => 'admin',
        'controller' => 'AdminCustomerController',
        'method' => 'export',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // customer end

    // gen_code end
    'admin/gen_code' => array(
        'name' => 'Generate code',
        'pageName' => 'Admin generate code',
        'type' => 'admin',
        'controller' => 'AdminGenCodeController',
        'method' => 'index',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/gen_code/index.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/gen_code_action_ajax' => array(
        'name' => 'Generate code action',
        'pageName' => 'Admin generate code',
        'type' => 'admin',
        'controller' => 'AdminGenCodeController',
        'method' => 'gen_code_action_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // end gen_code
    /**
     * admin action end
     */

    /**
     * home action start
     */
    'home/404' => array(
        'name' => 'Home',
        'pageName' => 'Home',
        'type' => 'frontend',
        'controller' => 'HomeController',
        'method' => 'page_404',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '404.php',
                'layout' => 'layout/error.layout.php'
            )
        )
    ),
    'home' => array(
        'name' => 'Home',
        'pageName' => 'Home',
        'type' => 'frontend',
        'controller' => 'HomeController',
        'method' => 'index',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'home/home.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/set/session' => array(
        'name' => 'Home',
        'pageName' => 'Home',
        'type' => 'frontend',
        'controller' => 'HomeController',
        'method' => 'setSession',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
        )
    ),
    'home/account' => array(
        'name' => 'Customer account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'account',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'login' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/login',
                'layout' => ''
            )
        )
    ),
    'home/account/address' => array(
        'name' => 'Customer account address',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'account_address',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/address/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/account/address/action' => array(
        'name' => 'Customer account address action (ajax)',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'account_address_action',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/account/orders' => array(
        'name' => 'Customer account orders',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'account_orders',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/orders/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'false' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account/orders',
                'layout' => ''
            )
        )
    ),
    'home/logout' => array(
        'name' => 'Customer logout',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'logout',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/login' => array(
        'name' => 'Customer login',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'login',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'login/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/register' => array(
        'name' => 'Customer register',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'register',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'register/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            ),
            'false' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/register',
                'layout' => ''
            )
        )
    ),
    'home/register/validate' => array(
        'name' => 'Customer register validate',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'registerValidate',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/account/verify' => array(
        'name' => 'Customer verify account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'verify',
        'results' => array(
            'active' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            )
        )
    ),
    'home/forget_password' => array(
        'name' => 'Customer forget password',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'forget_password',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'forget_password/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            )
        )
    ),
    'home/reset_password' => array(
        'name' => 'Customer change password',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'reset_password',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'reset_password/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            )
        )
    ),
    'home/address_ajax' => array(
        'name' => 'Home address ajax',
        'pageName' => 'Home address',
        'type' => 'frontend',
        'controller' => 'HomeController',
        'method' => 'address_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/customer/address/add/view' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressAddView',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/address/add_popup.php',
                'layout' => 'layout/blank.layout.php'
            ),
        )
    ),
    'home/customer/address/add' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressAdd',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
        )
    ),
    'home/customer/address/edit/view' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressEditView',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/address/edit_popup.php',
                'layout' => 'layout/blank.layout.php'
            ),
        )
    ),
    'home/customer/address/edit' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressEdit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/customer/address/delete/view' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressDeleteView',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/address/delete_popup.php',
                'layout' => 'layout/blank.layout.php'
            ),
        )
    ),
    'home/customer/address/delete' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressDelete',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/customer/address/refresh' => array(
        'name' => 'Home customer address add',
        'pageName' => 'Home customer',
        'type' => 'frontend',
        'controller' => 'HomeCustomerController',
        'method' => 'customerAddressRefresh',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'account/account_info.php',
                'layout' => 'layout/blank.layout.php'
            ),
        )
    ),
    'home/google/login' => array(
        'name' => 'Google account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'SocialLoginController',
        'method' => 'googleLogin',
        'results' => array(
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            )
        )
    ),
    'home/facebook/login' => array(
        'name' => 'Facebook account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'SocialLoginController',
        'method' => 'facebookLogin',
        'results' => array(
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/facebook/login/callback' => array(
        'name' => 'Facebook account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'SocialLoginController',
        'method' => 'facebookLoginCallback',
        'results' => array(
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/twitter/login' => array(
        'name' => 'Twitter account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'SocialLoginController',
        'method' => 'twitterLogin',
        'results' => array(
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/twitter/login/callback' => array(
        'name' => 'Twitter account',
        'pageName' => 'Home account',
        'type' => 'frontend',
        'controller' => 'SocialLoginController',
        'method' => 'twitterLoginCallback',
        'results' => array(
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/lop_ca_nhan' => array(
        'name' => 'Trang lop ca nhan',
        'pageName' => 'Home',
        'type' => 'frontend',
        'controller' => 'HomeController',
        'method' => 'lopCaNhan',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'lop_ca_nhan//lop_ca_nhan.php',
                'layout' => 'layout/widget.layout.php'
            )
        )
    ),
    'home/lop_nhom' => array(
        'name' => 'Trang lop nhom',
        'pageName' => 'Home',
        'type' => 'frontend',
        'controller' => 'HomeController',
        'method' => 'lopNhom',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'lop_nhom/lop_nhom.php',
                'layout' => 'layout/widget.layout.php'
            )
        )
    ),
    /**
     * home action end
     */

    /**
     * service action start
     */
    'api/seo_tool/get_link' => array(
        'name' => 'Seo tool get link',
        'pageName' => 'Seo tool',
        'type' => 'api',
        'controller' => 'ApiSeoToolController',
        'method' => 'get_link',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'api/seo_tool/add_link' => array(
        'name' => 'Seo tool add link',
        'pageName' => 'Seo tool',
        'type' => 'api',
        'controller' => 'ApiSeoToolController',
        'method' => 'add_link',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'api/system/log/add' => array(
        'name' => 'api/system/log/add',
        'pageName' => 'system/log',
        'type' => 'api',
        'controller' => 'ApiSystemLogController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    )
    /**
     * service action end
     */
);
