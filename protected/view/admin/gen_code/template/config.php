	//{table} start
	'admin/{table}/manage' => array(
		'name' => 'Manage {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'manage',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/{table}/manage.php',
				'layout' => 'layout/admin.layout.php',
			)
		)
	),
	'admin/{table}/manage_ajax' => array(
		'name' => 'Manage ajax {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'manage_ajax',
		'results' => array(
			'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
		)
	),
	'admin/{table}/validate_ajax' => array(
		'name' => 'Validate ajax {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'validate_ajax',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => '',
				'layout' => '',
			)
		)
	),
	'admin/{table}/add' => array(
		'name' => 'Add {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'add',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/{table}/add_edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/{table}/manage',
				'layout' => '',
			),
// 						'popup' => array (
// 								'type' => 'include',
// 								'path' => 'admin/{table}/add_edit_popup.php',
// 								'layout' => 'layout/popup.layout.php'
// 						),
// 						'popup.close' => array (
// 								'type' => 'include',
// 								'path' => '',
// 								'layout' => 'layout/popup.close.layout.php'
// 						)
		)
	),
	'admin/{table}/edit' => array(
		'name' => 'Edit {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'edit',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/{table}/add_edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/{table}/manage',
				'layout' => '',
			),
// 						'popup' => array (
// 								'type' => 'include',
// 								'path' => 'admin/{table}/add_edit_popup.php',
// 								'layout' => 'layout/popup.layout.php'
// 						),
// 						'popup.close' => array (
// 								'type' => 'include',
// 								'path' => '',
// 								'layout' => 'layout/popup.close.layout.php'
// 						)
	)
	),
	'admin/{table}/view' => array(
		'name' => 'View {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'view',
		'results' => array(
			'success' => array(
				'type' => 'include',
				'path' => 'admin/{table}/edit.php',
				'layout' => 'layout/admin.layout.php',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/{table}/manage',
				'layout' => '',
			),
// 						'popup' => array (
// 								'type' => 'include',
// 								'path' => 'admin/{table}/add_edit_popup.php',
// 								'layout' => 'layout/popup.layout.php'
// 						),
// 						'popup.close' => array (
// 								'type' => 'include',
// 								'path' => '',
// 								'layout' => 'layout/popup.close.layout.php'
// 						)
		)
	),
	'admin/{table}/delete' => array(
		'name' => 'Delete {tableText}',
		'pageName' => 'Admin {tableText}',
		'type' => 'admin',
		'controller' => 'Admin{Table}Controller',
		'method' => 'delete',
		'results' => array(
			'success' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/{table}/manage',
				'layout' => '',
			),
			'manage' => array(
				'type' => 'redirect',
				'path' => 'index.php?r=admin/{table}/manage',
				'layout' => '',
			),
		)
	),
	//{table} end