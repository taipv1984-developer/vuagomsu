<?php
return array (
	'admin/site_map' => array (
			'name' => 'Admin Index',
			'pageName' => 'Admin index',
			'type' => 'admin',
			'controller' => 'AdminSiteMapController',
			'method' => 'index',
			'results' => array (
					'success' => array (
							'type' => 'include',
							'path' => 'admin/site_map/index.php',
							'layout' => 'layout/admin.layout.php'
					),
			)
	),
)?>