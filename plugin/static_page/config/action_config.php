<?php
return array(
    //static_page start
    'admin/static_page/manage' => array(
        'name' => 'Manage Static Page',
        'pageName' => 'Admin Static Page',
        'type' => 'admin',
        'controller' => 'AdminStaticPageController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/static_page/manage.php',
                'layout' => 'layout/admin.layout.php',
            )
        )
    ),
    'admin/static_page/manage_ajax' => array(
        'name' => 'Manage ajax Static Page',
        'pageName' => 'Admin Static Page',
        'type' => 'admin',
        'controller' => 'AdminStaticPageController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/static_page/validate_ajax' => array(
        'name' => 'Validate ajax Static Page',
        'pageName' => 'Admin Static Page',
        'type' => 'admin',
        'controller' => 'AdminStaticPageController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/static_page/add' => array(
        'name' => 'Add Static Page',
        'pageName' => 'Admin Static Page',
        'type' => 'admin',
        'controller' => 'AdminStaticPageController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/static_page/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/static_page/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/static_page/edit' => array(
        'name' => 'Edit Static Page',
        'pageName' => 'Admin Static Page',
        'type' => 'admin',
        'controller' => 'AdminStaticPageController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/static_page/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/static_page/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/static_page/delete' => array(
        'name' => 'Delete Static Page',
        'pageName' => 'Admin Static Page',
        'type' => 'admin',
        'controller' => 'AdminStaticPageController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/static_page/manage',
                'layout' => '',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/static_page/manage',
                'layout' => '',
            ),
        )
    ),

    // home static page
    'home/static_page/view' => array(
        'name' => 'View Static Page',
        'pageName' => 'Home Static Page',
        'type' => 'frontend',
        'controller' => 'HomeStaticPageController',
        'method' => 'view',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'static_page/view.php',
                'layout' => 'layout/widget.layout.php',
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => '',
            ),
        )
    ),
    //static_page end
)
?>