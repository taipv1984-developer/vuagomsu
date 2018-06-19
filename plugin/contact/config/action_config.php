<?php
return array(
    // contact start
    'admin/contact/manage' => array (
        'name' => 'Manage Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'manage',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => 'admin/contact/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/contact/change_trainer' => array (
        'name' => 'change trainer Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'change_trainer',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/contact/change_status' => array (
        'name' => 'change status Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'change_status',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/contact/change_source' => array (
        'name' => 'change source Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'change_source',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/contact/validate_ajax' => array (
        'name' => 'Validate ajax Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'validate_ajax',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/contact/add' => array (
        'name' => 'Add Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'add',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => 'admin/contact/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array (
                'type' => 'redirect',
                'path' => 'index.php?r=admin/contact/manage',
                'layout' => ''
            ),
            'popup' => array (
                'type' => 'include',
                'path' => 'admin/contact/add_popup.php',
                'layout' => 'layout/json_status_result.php'
            )
        )
    ),
    'admin/contact/edit' => array (
        'name' => 'Edit Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'edit',
        'results' => array (
            'success' => array (
                'type' => 'include',
                'path' => 'admin/contact/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array (
                'type' => 'redirect',
                'path' => 'index.php?r=admin/contact/manage',
                'layout' => ''
            ),
            'popup' => array (
                'type' => 'include',
                'path' => 'admin/contact/edit_popup.php',
                'layout' => 'layout/json_status_result.php'
            )
        )
    ),
    'admin/contact/delete' => array (
        'name' => 'Delete Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'delete',
        'results' => array (
            'success' => array (
                'type' => 'redirect',
                'path' => 'index.php?r=admin/contact/manage',
                'layout' => ''
            ),
            'manage' => array (
                'type' => 'redirect',
                'path' => 'index.php?r=admin/contact/manage',
                'layout' => ''
            )
        )
    ),
    'admin/contact/import' => array (
        'name' => 'import Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'import',
        'results' => array (
            'manage' => array (
                'type' => 'redirect',
                'path' => 'index.php?r=admin/contact/manage',
                'layout' => ''
            )
        )
    ),
    'admin/contact/export' => array (
        'name' => 'export Contact',
        'pageName' => 'Admin Contact',
        'type' => 'admin',
        'controller' => 'AdminContactController',
        'method' => 'export',
        'results' => array (
            'manage' => array (
                'type' => 'redirect',
                'path' => 'index.php?r=admin/contact/manage',
                'layout' => ''
            )
        )
    ),

    // home/contact
    'home/contact' => array(
        'name' => 'Trang contact',
        'pageName' => 'Contact',
        'type' => 'frontend',
        'controller' => 'HomeContactController',
        'method' => 'index',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'contact/contact.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => '',
            ),
        )
    ),
    // contact end
) ?>