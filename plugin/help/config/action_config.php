<?php
return array(
	//help start
	'admin/help/manage' => array(
		'name' => 'Manage Help',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'manage',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help/manage.php',
				'layout' => 'layout/admin.layout.php',
			)
		)
	),
	'admin/help/validate_ajax' => array(
		'name' => 'Validate ajax Help',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'validate_ajax',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => '',
				'layout' => '',
			)
		)
	),
	'admin/help/add' => array(
		'name' => 'Add Help',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'add',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help/add_edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help/manage',
				'layout' => '',
			),
			'popup' => array(
				'type' => 'include',
				'path' => 'admin/help/add_edit.php',
				'layout' => 'layout/popup.layout.php',
			),
		)
	),
	'admin/help/edit' => array(
		'name' => 'Edit Help',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'edit',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help/add_edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help/manage',
				'layout' => '',
			),
			'popup' => array(
				'type' => 'include',
				'path' => 'admin/help/add_edit.php',
				'layout' => 'layout/popup.layout.php',
			),
		)
	),
	'admin/help/view' => array(
		'name' => 'View Help',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'view',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help/view.php',
				'layout' => 'layout/popup.layout.php',
			),
		)
	),
	'admin/help/delete' => array(
		'name' => 'Delete Help',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'delete',
		'results' => array(
			'success' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help/manage',
				'layout' => '',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help/manage',
				'layout' => '',
			),
		)
	),
	'admin/help/list' => array(
		'name' => 'Manage Help List',
		'pageName' => 'Admin Help',
		'type' => 'admin',
		'controller' => 'AdminHelpController',
		'method' => 'help_list',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help/list.php',
				'layout' => 'layout/admin.layout.php',
			)
		)
	),
	//help end
	//help_cat start
	'admin/help_cat/manage' => array(
		'name' => 'Manage Help Cat',
		'pageName' => 'Admin Help Cat',
		'type' => 'admin',
		'controller' => 'AdminHelpCatController',
		'method' => 'manage',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help_cat/manage.php',
				'layout' => 'layout/admin.layout.php',
			)
		)
	),
	'admin/help_cat/validate_ajax' => array(
		'name' => 'Validate ajax Help Cat',
		'pageName' => 'Admin Help Cat',
		'type' => 'admin',
		'controller' => 'AdminHelpCatController',
		'method' => 'validate_ajax',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => '',
				'layout' => '',
			)
		)
	),
	'admin/help_cat/add' => array(
		'name' => 'Add Help Cat',
		'pageName' => 'Admin Help Cat',
		'type' => 'admin',
		'controller' => 'AdminHelpCatController',
		'method' => 'add',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help_cat/add_edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help_cat/manage',
				'layout' => '',
			),
			'popup' => array(
				'type' => 'include',
				'path' => 'admin/help_cat/add_edit.php',
				'layout' => 'layout/popup.layout.php',
			),
		)
	),
	'admin/help_cat/edit' => array(
		'name' => 'Edit Help Cat',
		'pageName' => 'Admin Help Cat',
		'type' => 'admin',
		'controller' => 'AdminHelpCatController',
		'method' => 'edit',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/help_cat/add_edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help_cat/manage',
				'layout' => '',
			),
			'popup' => array(
				'type' => 'include',
				'path' => 'admin/help_cat/add_edit.php',
				'layout' => 'layout/popup.layout.php',
			),
		)
	),
	'admin/help_cat/delete' => array(
		'name' => 'Delete Help Cat',
		'pageName' => 'Admin Help Cat',
		'type' => 'admin',
		'controller' => 'AdminHelpCatController',
		'method' => 'delete',
		'results' => array(
			'success' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help_cat/manage',
				'layout' => '',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/help_cat/manage',
				'layout' => '',
			),
		)
	),
	//help_cat end
) ?>