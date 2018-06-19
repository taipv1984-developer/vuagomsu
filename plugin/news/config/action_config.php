<?php
return array(
    // news_category start
    'admin/news_category/manage' => array(
        'name' => 'Manage News Category',
        'pageName' => 'Admin News Category',
        'type' => 'admin',
        'controller' => 'AdminNewsCategoryController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news_category/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/news_category/validate_ajax' => array(
        'name' => 'Validate ajax News Category',
        'pageName' => 'Admin News Category',
        'type' => 'admin',
        'controller' => 'AdminNewsCategoryController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/news_category/add' => array(
        'name' => 'Add News Category',
        'pageName' => 'Admin News Category',
        'type' => 'admin',
        'controller' => 'AdminNewsCategoryController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news_category/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_category/manage',
                'layout' => ''
            )
        )

    ),
    'admin/news_category/edit' => array(
        'name' => 'Edit News Category',
        'pageName' => 'Admin News Category',
        'type' => 'admin',
        'controller' => 'AdminNewsCategoryController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news_category/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_category/manage',
                'layout' => ''
            )
        )
    ),
    'admin/news_category/delete' => array(
        'name' => 'Delete News Category',
        'pageName' => 'Admin News Category',
        'type' => 'admin',
        'controller' => 'AdminNewsCategoryController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_category/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_category/manage',
                'layout' => ''
            )
        )
    ),
    // news_category end
    // news start
    'admin/news/manage' => array(
        'name' => 'Manage News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/news/manage_ajax' => array(
        'name' => 'Manage ajax News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/news/validate_ajax' => array(
        'name' => 'Validate ajax News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/news/add' => array(
        'name' => 'Add News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/news/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/news/edit' => array(
        'name' => 'Edit News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/news/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/news/view' => array(
        'name' => 'View News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'view',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news/edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/news/view_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/news/delete' => array(
        'name' => 'Delete News',
        'pageName' => 'Admin News',
        'type' => 'admin',
        'controller' => 'AdminNewsController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news/manage',
                'layout' => ''
            )
        )
    ),
    //news_tag start
    'admin/news_tag/manage' => array(
        'name' => 'Manage News Tag',
        'pageName' => 'Admin News Tag',
        'type' => 'admin',
        'controller' => 'AdminNewsTagController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news_tag/manage.php',
                'layout' => 'layout/admin.layout.php',
            )
        )
    ),
    'admin/news_tag/validate_ajax' => array(
        'name' => 'Validate ajax News Tag',
        'pageName' => 'Admin News Tag',
        'type' => 'admin',
        'controller' => 'AdminNewsTagController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/news_tag/action' => array(
        'name' => 'News Tag action ajax',
        'pageName' => 'Admin News Tag',
        'type' => 'admin',
        'controller' => 'AdminNewsTagController',
        'method' => 'action',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/news_tag/add' => array(
        'name' => 'Add News Tag',
        'pageName' => 'Admin News Tag',
        'type' => 'admin',
        'controller' => 'AdminNewsTagController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news_tag/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_tag/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/news_tag/edit' => array(
        'name' => 'Edit News Tag',
        'pageName' => 'Admin News Tag',
        'type' => 'admin',
        'controller' => 'AdminNewsTagController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/news_tag/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_tag/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/news_tag/delete' => array(
        'name' => 'Delete News Tag',
        'pageName' => 'Admin News Tag',
        'type' => 'admin',
        'controller' => 'AdminNewsTagController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_tag/manage',
                'layout' => '',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/news_tag/manage',
                'layout' => '',
            ),
        )
    ),
    //news_tag end
    'home/news/list' => array(
        'name' => 'Home news list',
        'pageName' => 'Home news',
        'type' => 'frontend',
        'controller' => 'HomeNewsController',
        'method' => 'newsList',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'news_list.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    'home/news/detail' => array(
        'name' => 'Home news detail',
        'pageName' => 'Home news',
        'type' => 'frontend',
        'controller' => 'HomeNewsController',
        'method' => 'newsDetail',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'news_detail.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    'home/news/tag' => array(
        'name' => 'Home news tag',
        'pageName' => 'Home news',
        'type' => 'frontend',
        'controller' => 'HomeNewsController',
        'method' => 'newsTag',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'news_tag.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
)
// news end
?>