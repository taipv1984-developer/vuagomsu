<?php
return array(
    // admin/currency start
    'admin/currency/manage' => array(
        'name' => 'Manage admin currency',
        'pageName' => 'Admin currency',
        'type' => 'admin',
        'controller' => 'AdminCurrencyController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/currency/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/currency/validate_ajax' => array(
        'name' => 'Validate ajax currency',
        'pageName' => 'Admin currency',
        'type' => 'admin',
        'controller' => 'AdminCurrencyController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/currency/add' => array(
        'name' => 'Add currency',
        'pageName' => 'Admin currency',
        'type' => 'admin',
        'controller' => 'AdminCurrencyController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/currency/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/currency/manage',
                'layout' => ''
            )
        )
    ),
    'admin/currency/edit' => array(
        'name' => 'Edit currency',
        'pageName' => 'Admin currency',
        'type' => 'admin',
        'controller' => 'AdminCurrencyController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/currency/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/currency/manage',
                'layout' => ''
            )
        )
    ),
    'admin/currency/delete' => array(
        'name' => 'Delete currency',
        'pageName' => 'Admin currency',
        'type' => 'admin',
        'controller' => 'AdminCurrencyController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/currency/manage',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/currency/manage',
                'layout' => ''
            )
        )
    ),
    // admin/currency end

    // admin/category start
    'admin/category/manage' => array(
        'name' => 'Manage admin category',
        'pageName' => 'Admin category',
        'type' => 'admin',
        'controller' => 'AdminCategoryController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/category/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/category/validate_ajax' => array(
        'name' => 'Validate ajax category',
        'pageName' => 'Admin category',
        'type' => 'admin',
        'controller' => 'AdminCategoryController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/category/add' => array(
        'name' => 'Add admin category',
        'pageName' => 'Admin category',
        'type' => 'admin',
        'controller' => 'AdminCategoryController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/category/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/category/manage',
                'layout' => ''
            )
        )
    ),
    'admin/category/edit' => array(
        'name' => 'Edit admin category',
        'pageName' => 'Admin category',
        'type' => 'admin',
        'controller' => 'AdminCategoryController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/category/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/category/manage',
                'layout' => ''
            )
        )
    ),
    'admin/category/delete' => array(
        'name' => 'Delete admin category',
        'pageName' => 'Admin category',
        'type' => 'admin',
        'controller' => 'AdminCategoryController',
        'method' => 'delete',
        'results' => array(
            'json' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/json.layout.php'
            ),
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/category/manage',
                'layout' => ''
            ),
            'false' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/category/manage',
                'layout' => ''
            )
        )
    ),
    // admin/category end

    // admin/product start
    'admin/product/manage' => array(
        'name' => 'Manage admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/product/manage_ajax' => array(
        'name' => 'Manage ajax admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/product/add/view' => array(
        'name' => 'Add admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'addView',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
        )
    ),
    'admin/product/add' => array(
        'name' => 'Add admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
        )
    ),
    'admin/product/edit/view' => array(
        'name' => 'Edit admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'editView',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
        )
    ),
    'admin/product/edit' => array(
        'name' => 'Edit admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
        )
    ),
    'admin/product/delete' => array(
        'name' => 'Delete admin product',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product/manage.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product/manage',
                'layout' => ''
            )
        )
    ),
    'admin/product/import' => array(
        'name' => 'Product import',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'import',
        'results' => array(
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product/manage',
                'layout' => ''
            )
        )
    ),
    'admin/product/export' => array(
        'name' => 'Product export',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'export',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/product/attribute_action' => array(
        'name' => 'Properties action ajax',
        'pageName' => 'Admin product',
        'type' => 'admin',
        'controller' => 'AdminProductController',
        'method' => 'attribute_action',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // admin/product end
    //product_tag start
    'admin/product_tag/manage' => array(
        'name' => 'Manage Product Tag',
        'pageName' => 'Admin Product Tag',
        'type' => 'admin',
        'controller' => 'AdminProductTagController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product_tag/manage.php',
                'layout' => 'layout/admin.layout.php',
            )
        )
    ),
    'admin/product_tag/validate_ajax' => array(
        'name' => 'Validate ajax Product Tag',
        'pageName' => 'Admin Product Tag',
        'type' => 'admin',
        'controller' => 'AdminProductTagController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/product_tag/action' => array(
        'name' => 'Product Tag action ajax',
        'pageName' => 'Admin Product Tag',
        'type' => 'admin',
        'controller' => 'AdminProductTagController',
        'method' => 'action',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/product_tag/add' => array(
        'name' => 'Add Product Tag',
        'pageName' => 'Admin Product Tag',
        'type' => 'admin',
        'controller' => 'AdminProductTagController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product_tag/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_tag/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/product_tag/edit' => array(
        'name' => 'Edit Product Tag',
        'pageName' => 'Admin Product Tag',
        'type' => 'admin',
        'controller' => 'AdminProductTagController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product_tag/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_tag/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/product_tag/delete' => array(
        'name' => 'Delete Product Tag',
        'pageName' => 'Admin Product Tag',
        'type' => 'admin',
        'controller' => 'AdminProductTagController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_tag/manage',
                'layout' => '',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_tag/manage',
                'layout' => '',
            ),
        )
    ),
    //product_tag end
    // manufac start
    'admin/manufac/manage' => array(
        'name' => 'Manage Manufac',
        'pageName' => 'Admin Manufac',
        'type' => 'admin',
        'controller' => 'AdminManufacController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/manufac/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/manufac/validate_ajax' => array(
        'name' => 'Validate ajax Manufac',
        'pageName' => 'Admin Manufac',
        'type' => 'admin',
        'controller' => 'AdminManufacController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/manufac/add' => array(
        'name' => 'Add Manufac',
        'pageName' => 'Admin Manufac',
        'type' => 'admin',
        'controller' => 'AdminManufacController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/manufac/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/manufac/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/manufac/add_edit.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/manufac/edit' => array(
        'name' => 'Edit Manufac',
        'pageName' => 'Admin Manufac',
        'type' => 'admin',
        'controller' => 'AdminManufacController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/manufac/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/manufac/manage',
                'layout' => ''
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/manufac/add_edit.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/manufac/delete' => array(
        'name' => 'Delete Manufac',
        'pageName' => 'Admin Manufac',
        'type' => 'admin',
        'controller' => 'AdminManufacController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/manufac/manage',
                'layout' => ''
            ),
        )
    ),
    // manufac end

    // admin/attribute start
    'admin/attribute/manage' => array(
        'name' => 'Manage admin attribute',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/attribute/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/attribute/validate_ajax' => array(
        'name' => 'Admin validate ajax',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/attribute/edit' => array(
        'name' => 'Edit admin attribute',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/attribute/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/attribute/manage',
                'layout' => ''
            )
        )
    ),
    'admin/attribute/add' => array(
        'name' => 'Add admin attribute',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/attribute/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/attribute/manage',
                'layout' => ''
            )
        )
    ),
    'admin/attribute/delete' => array(
        'name' => 'Delete admin attribute',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/attribute/manage',
                'layout' => ''
            )
        )
    ),
    'admin/attribute/delete_attribute_value' => array(
        'name' => 'Ajax admin product attribute',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'deleteAttributeValue',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/attribute/add_attribute_value' => array(
        'name' => 'Ajax admin product attribute',
        'pageName' => 'Admin attribute',
        'type' => 'admin',
        'controller' => 'AdminAttributeController',
        'method' => 'addAttributeValue',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // admin/attribute end

    //checkout start
    'admin/checkout/manage' => array(
        'name' => 'Checkout manage',
        'pageName' => 'Admin checkout manage',
        'type' => 'admin',
        'controller' => 'AdminCheckoutController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/checkout/manage.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/index',
                'layout' => ''
            )
        )
    ),
    'admin/checkout/manage_ajax' => array(
        'name' => 'Checkout manage ajax',
        'pageName' => 'Admin checkout manage',
        'type' => 'admin',
        'controller' => 'AdminCheckoutController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
        )
    ),
    'admin/checkout/add' => array(
        'name' => 'Checkout edit',
        'pageName' => 'Admin checkout manage',
        'type' => 'admin',
        'controller' => 'AdminCheckoutController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/checkout/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/index',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/checkout/manage',
                'layout' => ''
            )
        )
    ),
    'admin/checkout/edit' => array(
        'name' => 'Checkout edit',
        'pageName' => 'Admin checkout manage',
        'type' => 'admin',
        'controller' => 'AdminCheckoutController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/checkout/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/index',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/checkout/manage',
                'layout' => ''
            )
        )
    ),
    'admin/checkout/delete' => array(
        'name' => 'Checkout delete',
        'pageName' => 'Admin checkout manage',
        'type' => 'admin',
        'controller' => 'AdminCheckoutController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'admin/checkout/manage',
                'layout' => ''
            ),
        )
    ),
    //checkout end
    // orders start
    'admin/orders/manage' => array(
        'name' => 'Manage orders',
        'pageName' => 'Admin orders',
        'type' => 'admin',
        'controller' => 'AdminOrdersController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/orders/manage.php',
                'layout' => 'layout/admin.layout.php'
            )
        )
    ),
    'admin/orders/edit' => array(
        'name' => 'Edit orders',
        'pageName' => 'Admin orders',
        'type' => 'admin',
        'controller' => 'AdminOrdersController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/orders/add_edit.php',
                'layout' => 'layout/admin.layout.php'
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/orders/manage',
                'layout' => ''
            )
        )
    ),
    'admin/orders/delete' => array(
        'name' => 'Delete orders',
        'pageName' => 'Admin orders',
        'type' => 'admin',
        'controller' => 'AdminOrdersController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/orders/manage',
                'layout' => ''
            )
        )
    ),
    'admin/orders/export' => array(
        'name' => 'Export orders',
        'pageName' => 'Admin orders',
        'type' => 'admin',
        'controller' => 'AdminOrdersController',
        'method' => 'export',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // orders end
    //order_status start
    'admin/order_status/manage' => array(
        'name' => 'Manage Order Status',
        'pageName' => 'Admin Order Status',
        'type' => 'admin',
        'controller' => 'AdminOrderStatusController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/order_status/manage.php',
                'layout' => 'layout/admin.layout.php',
            )
        )
    ),
    'admin/order_status/validate_ajax' => array(
        'name' => 'Validate ajax Order Status',
        'pageName' => 'Admin Order Status',
        'type' => 'admin',
        'controller' => 'AdminOrderStatusController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/order_status/add' => array(
        'name' => 'Add Order Status',
        'pageName' => 'Admin Order Status',
        'type' => 'admin',
        'controller' => 'AdminOrderStatusController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/order_status/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/order_status/manage',
                'layout' => '',
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/order_status/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/order_status/edit' => array(
        'name' => 'Edit Order Status',
        'pageName' => 'Admin Order Status',
        'type' => 'admin',
        'controller' => 'AdminOrderStatusController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/order_status/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/order_status/manage',
                'layout' => '',
            ),
            'popup' => array(
                'type' => 'include',
                'path' => 'admin/order_status/add_edit_popup.php',
                'layout' => 'layout/popup.layout.php'
            )
        )
    ),
    'admin/order_status/delete' => array(
        'name' => 'Delete Order Status',
        'pageName' => 'Admin Order Status',
        'type' => 'admin',
        'controller' => 'AdminOrderStatusController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/order_status/manage',
                'layout' => '',
            ),
            'false' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/order_status/manage',
                'layout' => '',
            ),
        )
    ),
    //order_status end
    //product_search start
    'admin/product_search/manage' => array(
        'name' => 'Manage Product Search',
        'pageName' => 'Admin Product Search',
        'type' => 'admin',
        'controller' => 'AdminProductSearchController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product_search/manage.php',
                'layout' => 'layout/admin.layout.php',
            )
        )
    ),
    'admin/product_search/manage_ajax' => array(
        'name' => 'Manage ajax Product Search',
        'pageName' => 'Admin Product Search',
        'type' => 'admin',
        'controller' => 'AdminProductSearchController',
        'method' => 'manage_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'admin/product_search/validate_ajax' => array(
        'name' => 'Validate ajax Product Search',
        'pageName' => 'Admin Product Search',
        'type' => 'admin',
        'controller' => 'AdminProductSearchController',
        'method' => 'validate_ajax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => '',
            )
        )
    ),
    'admin/product_search/add' => array(
        'name' => 'Add Product Search',
        'pageName' => 'Admin Product Search',
        'type' => 'admin',
        'controller' => 'AdminProductSearchController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product_search/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_search/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/product_search/edit' => array(
        'name' => 'Edit Product Search',
        'pageName' => 'Admin Product Search',
        'type' => 'admin',
        'controller' => 'AdminProductSearchController',
        'method' => 'edit',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'admin/product_search/add_edit.php',
                'layout' => 'layout/admin.layout.php',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_search/manage',
                'layout' => '',
            ),
        )
    ),
    'admin/product_search/delete' => array(
        'name' => 'Delete Product Search',
        'pageName' => 'Admin Product Search',
        'type' => 'admin',
        'controller' => 'AdminProductSearchController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_search/manage',
                'layout' => '',
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=admin/product_search/manage',
                'layout' => '',
            ),
        )
    ),
    //product_search end
    /**
     * HOME PAGE
     */
    // home/product start
    'home/product/list' => array(
        'name' => 'Home product list',
        'pageName' => 'Home product',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'productList',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'category/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    'home/product/detail' => array(
        'name' => 'Home product detail',
        'pageName' => 'Home product',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'productDetail',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'product/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    'home/product/detail/select_color' => array(
        'name' => 'Home product detail select color',
        'pageName' => 'Home product',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'selectColor',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
        )
    ),
    'home/product/popup' => array(
        'name' => 'Home product popup',
        'pageName' => 'Home product',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'productPopup',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    'home/product/tag' => array(
        'name' => 'Home product list',
        'pageName' => 'Home product',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'productTag',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'product_tag/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    // home/product end

    // home/cart start
    'home/cart' => array(
        'name' => 'Cart',
        'pageName' => 'Home cart',
        'type' => 'frontend',
        'controller' => 'HomeCartController',
        'method' => 'cart',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'cart/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'done' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/checkout/done',
                'layout' => ''
            ),
        )
    ),
    'home/cart/add_product' => array(
        'name' => 'Add cart',
        'pageName' => 'Home cart',
        'type' => 'frontend',
        'controller' => 'HomeCartController',
        'method' => 'add_product',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/cart/change_quantity' => array(
        'name' => 'Change quantity cart',
        'pageName' => 'Home cart',
        'type' => 'frontend',
        'controller' => 'HomeCartController',
        'method' => 'change_quantity',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/cart/recalculate' => array(
        'name' => 'Recalculate cart',
        'pageName' => 'Home cart',
        'type' => 'frontend',
        'controller' => 'HomeCartController',
        'method' => 'recalculate',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/cart/remove_product' => array(
        'name' => 'Remove product cart',
        'pageName' => 'Home cart',
        'type' => 'frontend',
        'controller' => 'HomeCartController',
        'method' => 'remove_product',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/cart/clear_cart' => array(
        'name' => 'Clear all cart',
        'pageName' => 'Home cart',
        'type' => 'frontend',
        'controller' => 'HomeCartController',
        'method' => 'clear_cart',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    // home/cart end

    // home/checkout
    'home/checkout' => array(
        'name' => 'Checkout',
        'pageName' => 'Home checkout',
        'type' => 'frontend',
        'controller' => 'HomeCheckoutController',
        'method' => 'checkout',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'checkout/checkout.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'checkout' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/checkout',
                'layout' => ''
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            ),
            'orders' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account/orders',
                'layout' => ''
            ),
            'done' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/checkout/done',
                'layout' => ''
            ),
        )
    ),
    'home/checkout_ajax' => array(
        'name' => 'Checkout ajax',
        'pageName' => 'Home checkout',
        'type' => 'frontend',
        'controller' => 'HomeCheckoutController',
        'method' => 'checkoutAjax',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/checkout/return_url' => array(
        'name' => 'Return url checkout',
        'pageName' => 'Home checkout',
        'type' => 'frontend',
        'controller' => 'HomeCheckoutController',
        'method' => 'return_url',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/checkout',
                'layout' => ''
            )
        )
    ),
    'home/checkout/cancel_url' => array(
        'name' => 'Cancel url checkout',
        'pageName' => 'Home checkout',
        'type' => 'frontend',
        'controller' => 'HomeCheckoutController',
        'method' => 'cancel_url',
        'results' => array(
            'success' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/checkout',
                'layout' => ''
            )
        )
    ),
    'home/checkout/done' => array(
        'name' => 'Checkout done',
        'pageName' => 'Home checkout',
        'type' => 'frontend',
        'controller' => 'HomeCheckoutController',
        'method' => 'checkoutDone',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'checkout/checkout_done.php',
                'layout' => 'layout/widget.layout.php'
            ),
        )
    ),
    // home/checkout end


    // home/orders start
    'home/orders/history' => array(
        'name' => 'Orders history',
        'pageName' => 'Home orders',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'orders_history',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            )
        )
    ),
    'home/orders/detail' => array(
        'name' => 'Orders detail',
        'pageName' => 'Home orders',
        'type' => 'frontend',
        'controller' => 'HomeProductController',
        'method' => 'orders_detail',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/orders/history',
                'layout' => ''
            )
        )
    ),

    // home/search start
    'home/search' => array(
        'name' => 'Search',
        'pageName' => 'Search',
        'type' => 'frontend',
        'controller' => 'HomeProductSearchController',
        'method' => 'search',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'category/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'home' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home',
                'layout' => ''
            ),
        )
    ),
    'home/search/getAutocompleteData' => array(
        'name' => 'Search getAutocompleteData',
        'pageName' => 'Search',
        'type' => 'frontend',
        'controller' => 'HomeProductSearchController',
        'method' => 'getAutocompleteData',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    //products wishlist
    'home/product/wishlist' => array(
        'name' => 'Home wishlist manage',
        'pageName' => 'Home wishlist',
        'type' => 'frontend',
        'controller' => 'HomeProductWishlistController',
        'method' => 'manage',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => 'wishlist/index.php',
                'layout' => 'layout/widget.layout.php'
            ),
            'account' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/account',
                'layout' => ''
            )
        )
    ),
    'home/product/wishlist/add' => array(
        'name' => 'Home wishlist add',
        'pageName' => 'Home wishlist',
        'type' => 'frontend',
        'controller' => 'HomeProductWishlistController',
        'method' => 'add',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            )
        )
    ),
    'home/product/wishlist/delete' => array(
        'name' => 'Home wishlist delete',
        'pageName' => 'Home wishlist',
        'type' => 'frontend',
        'controller' => 'HomeProductWishlistController',
        'method' => 'delete',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/product/wishlist',
                'layout' => ''
            )
        )
    ),
    'home/product/wishlist/delete_all' => array(
        'name' => 'Home wishlist clear',
        'pageName' => 'Home wishlist',
        'type' => 'frontend',
        'controller' => 'HomeProductWishlistController',
        'method' => 'delete_all',
        'results' => array(
            'success' => array(
                'type' => 'include',
                'path' => '',
                'layout' => ''
            ),
            'manage' => array(
                'type' => 'redirect',
                'path' => 'index.php?r=home/product/wishlist',
                'layout' => ''
            )
        )
    ),
)
// home/orders end
/**
 * HOME PAGE END
 */
?>