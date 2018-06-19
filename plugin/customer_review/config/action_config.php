<?php
return array (
		// customer_review start
		'admin/customer_review/manage' => array (
				'name' => 'Manage Customer Review',
				'pageName' => 'Admin Customer Review',
				'type' => 'admin',
				'controller' => 'AdminCustomerReviewController',
				'method' => 'manage',
				'results' => array (
						'success' => array (
								'type' => 'include',
								'path' => 'admin/customer_review/manage.php',
								'layout' => 'layout/admin.layout.php' 
						) 
				) 
		),
		'admin/customer_review/manage_ajax' => array (
				'name' => 'Manage ajax Customer Review',
				'pageName' => 'Admin Customer Review',
				'type' => 'admin',
				'controller' => 'AdminCustomerReviewController',
				'method' => 'manage_ajax',
				'results' => array (
						'success' => array (
								'type' => 'include',
								'path' => '',
								'layout' => '' 
						) 
				) 
		),
		'admin/customer_review/validate_ajax' => array (
				'name' => 'Validate ajax Customer Review',
				'pageName' => 'Admin Customer Review',
				'type' => 'admin',
				'controller' => 'AdminCustomerReviewController',
				'method' => 'validate_ajax',
				'results' => array (
						'success' => array (
								'type' => 'include',
								'path' => '',
								'layout' => '' 
						) 
				) 
		),
		'admin/customer_review/add' => array (
				'name' => 'Add Customer Review',
				'pageName' => 'Admin Customer Review',
				'type' => 'admin',
				'controller' => 'AdminCustomerReviewController',
				'method' => 'add',
				'results' => array (
						'success' => array (
								'type' => 'include',
								'path' => 'admin/customer_review/add_edit.php',
								'layout' => 'layout/admin.layout.php' 
						),
						'manage' => array (
								'type' => 'redirect',
								'path' => 'index.php?r=admin/customer_review/manage',
								'layout' => '' 
						) 
				)
		),
		'admin/customer_review/edit' => array (
				'name' => 'Edit Customer Review',
				'pageName' => 'Admin Customer Review',
				'type' => 'admin',
				'controller' => 'AdminCustomerReviewController',
				'method' => 'edit',
				'results' => array (
						'success' => array (
								'type' => 'include',
								'path' => 'admin/customer_review/add_edit.php',
								'layout' => 'layout/admin.layout.php' 
						),
						'manage' => array (
								'type' => 'redirect',
								'path' => 'index.php?r=admin/customer_review/manage',
								'layout' => '' 
						) 
				)
				 
		),
		'admin/customer_review/delete' => array (
				'name' => 'Delete Customer Review',
				'pageName' => 'Admin Customer Review',
				'type' => 'admin',
				'controller' => 'AdminCustomerReviewController',
				'method' => 'delete',
				'results' => array (
						'success' => array (
								'type' => 'redirect',
								'path' => 'index.php?r=admin/customer_review/manage',
								'layout' => '' 
						),
						'manage' => array (
								'type' => 'redirect',
								'path' => 'index.php?r=admin/customer_review/manage',
								'layout' => '' 
						) 
				) 
		),
		'home/customer_review' => array (
				'name' => 'Home customer review',
				'pageName' => 'Home customer review',
				'type' => 'frontend',
				'controller' => 'HomeCustomerReviewController',
				'method' => 'index',
				'results' => array (
						'success' => array (
								'type' => 'include',
								'path' => 'customer_review/index.php',
								'layout' => 'layout/widget.layout.php'
						),
						'home' => array(
								'type' => 'redirect',
								'path' => 'index.php?r=home',
								'layout' => '',
						),
				)
		),
)
// customer_review end
?>