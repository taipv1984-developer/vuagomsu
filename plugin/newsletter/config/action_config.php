<?php
return array (
	//newsletter start
	'admin/newsletter/manage' => array(
			'name' => 'Manage Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'manage',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter/manage.php',
							'layout' => 'layout/admin.layout.php',
					)
			)
	),
	'admin/newsletter/manage_ajax' => array(
			'name' => 'Manage ajax Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'manage_ajax',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => '',
							'layout' => ''
					)
			)
	),
	'admin/newsletter/validate_ajax' => array(
			'name' => 'Validate ajax Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'validate_ajax',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => '',
							'layout' => '',
					)
			)
	),
	'admin/newsletter/add' => array(
			'name' => 'Add Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'add',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter/add_edit.php',
							'layout' => 'layout/admin.layout.php',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/manage',
							'layout' => '',
					),
					'popup' => array (
							'type' => 'include',
							'path' => 'admin/newsletter/add_edit_popup.php',
							'layout' => 'layout/popup.layout.php'
					)
			)
	),
	'admin/newsletter/edit' => array(
			'name' => 'Edit Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'edit',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter/add_edit.php',
							'layout' => 'layout/admin.layout.php',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/manage',
							'layout' => '',
					),
					'popup' => array (
							'type' => 'include',
							'path' => 'admin/newsletter/add_edit_popup.php',
							'layout' => 'layout/popup.layout.php'
					)
			)
	),
	'admin/newsletter/view' => array(
			'name' => 'View Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'view',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter/edit.php',
							'layout' => 'layout/admin.layout.php',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/manage',
							'layout' => '',
					),
					'popup' => array (
							'type' => 'include',
							'path' => 'admin/newsletter/view_popup.php',
							'layout' => 'layout/popup.layout.php',
					)
			)
	),
	'admin/newsletter/delete' => array(
			'name' => 'Delete Newsletter',
			'pageName' => 'Admin Newsletter',
			'type' => 'admin',
			'controller' => 'AdminNewsletterController',
			'method' => 'delete',
			'results' => array(
					'success' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/manage',
							'layout' => '',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/manage',
							'layout' => '',
					),
			)
	),
	// newsletter email
	'admin/newsletter/email_manage' => array(
			'name' => 'Manage newsletter email',
			'pageName' => 'Admin Newsletter Email',
			'type' => 'admin',
			'controller' => 'AdminNewsletterEmailController',
			'method' => 'manage',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter_email/manage.php',
							'layout' => 'layout/admin.layout.php',
					)
			)
	),
	'admin/newsletter/email_validate_ajax' => array(
			'name' => 'Validate ajax Newsletter Email',
			'pageName' => 'Admin Newsletter Email',
			'type' => 'admin',
			'controller' => 'AdminNewsletterEmailController',
			'method' => 'validate_ajax',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => '',
							'layout' => '',
					)
			)
	),
	'admin/newsletter/email_add' => array(
			'name' => 'Add Newsletter Email',
			'pageName' => 'Admin Newsletter Email',
			'type' => 'admin',
			'controller' => 'AdminNewsletterEmailController',
			'method' => 'add',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter_email/add_edit.php',
							'layout' => 'layout/admin.layout.php',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/email_manage',
							'layout' => '',
					),
			)
	),
	'admin/newsletter/email_edit' => array(
			'name' => 'Edit Newsletter Email',
			'pageName' => 'Admin Newsletter Email',
			'type' => 'admin',
			'controller' => 'AdminNewsletterEmailController',
			'method' => 'edit',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter_email/add_edit.php',
							'layout' => 'layout/admin.layout.php',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/email_manage',
							'layout' => '',
					),
			)
	),
	'admin/newsletter/email_delete' => array(
			'name' => 'Delete Newsletter Email',
			'pageName' => 'Admin Newsletter Email',
			'type' => 'admin',
			'controller' => 'AdminNewsletterEmailController',
			'method' => 'delete',
			'results' => array(
					'success' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/email_manage',
							'layout' => '',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/email_manage',
							'layout' => '',
					),
			)
	),
	'admin/newsletter/email_send' => array(
			'name' => 'Send Newsletter Email',
			'pageName' => 'Admin Newsletter Email',
			'type' => 'admin',
			'controller' => 'AdminNewsletterEmailController',
			'method' => 'send',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'admin/newsletter_email/send.php',
							'layout' => 'layout/admin.layout.php',
					),
					'manage' => array(
							'type' => 'redirect',
							'path' => 'index.php?r=admin/newsletter/email_manage',
							'layout' => '',
					),
			)
	),
		
	//home/newsletter
	'home/submit_newsletter' => array(
			'name' => 'Submit Newsletter',
			'pageName' => 'Home Newsletter',
			'type' => 'frontend',
			'controller' => 'HomeNewsletterController',
			'method' => 'submitNewsletter',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => '',
							'layout' => '',
					),
			)
	),
    'home/submit_newsletter/send_email' => array(
        'name' => 'Submit Newsletter',
        'pageName' => 'Home Newsletter',
        'type' => 'frontend',
        'controller' => 'HomeNewsletterController',
        'method' => 'submitNewsletterSendEmail',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            ),
        )
    ),

	'home/unsubscribe_newsletter' => array(
			'name' => 'Unsubscribe Newsletter',
			'pageName' => 'Home Newsletter',
			'type' => 'frontend',
			'controller' => 'HomeNewsletterController',
			'method' => 'unsubscribe',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'frontend/newsletter/unscribe.php',
							'layout' => 'layout/newsletter.layout.php',
					),
			)
	),
	'home/resubscribe_newsletter' => array(
			'name' => 'Resubscribe Newsletter',
			'pageName' => 'Home Newsletter',
			'type' => 'frontend',
			'controller' => 'HomeNewsletterController',
			'method' => 'resubscribe',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'frontend/newsletter/rescribe.php',
							'layout' => 'layout/newsletter.layout.php',
					),
			)
	),
	'home/newsletter/profile_center' => array(
			'name' => 'Profile center newsletter',
			'pageName' => 'Home Newsletter',
			'type' => 'frontend',
			'controller' => 'HomeNewsletterController',
			'method' => 'showProfile',
			'results' => array(
					'success' => array(
							'type' => 'include',
							'path' => 'frontend/newsletter/profile_center.php',
							'layout' => 'layout/newsletter.layout.php',
					),
			)
	),

	//newsletter/popup
    'home/newsletter/popup/show' => array(
        'name' => 'newsletter popup show',
        'pageName' => 'Home Newsletter',
        'type' => 'frontend',
        'controller' => 'HomeNewsletterController',
        'method' => 'popupShow',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            ),
        )
    ),
	//newsletter end
)?>