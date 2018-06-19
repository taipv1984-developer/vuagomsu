<?php
return array (
    //slider start
    'admin/slider/manage' => array(
        'name' => 'Manage Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/slider/manage.php',
                'layout' => 'layout/admin.layout.php',
            )
        )
    ),
    'admin/slider/manage_ajax' => array(
        'name' => 'Manage ajax Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/slider/validate_ajax' => array(
        'name' => 'Validate ajax Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/slider/add' => array(
        'name' => 'Add Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/slider/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/slider/manage',
                'layout' => '',
            ),
            'popup' => array (
                'type' => 'include',
                'path' => 'admin/slider/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/slider/edit' => array(
        'name' => 'Edit Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/slider/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/slider/manage',
                'layout' => '',
            ),
            'popup' => array (
                'type' => 'include',
                'path' => 'admin/slider/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/slider/delete' => array(
        'name' => 'Delete Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/slider/manage',
                'layout' => '',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/slider/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/slider/add_image' => array(
        'name' => 'add_image Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'add_image',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/slider/delete_image' => array(
        'name' => 'delete_image Slider',
        'pageName' => 'Admin Slider',
        'type' => 'admin',
        'controller' => 'AdminSliderController',
        'method' => 'delete_image',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    //slider end
)
?>