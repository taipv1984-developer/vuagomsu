<?php 
	$ordersList = $_REQUEST['ordersList'];
?>
<header class="margin-bottom-15 text-center">
    <h1>
		Danh sách đơn hàng
	</h1>
</header>
<div class="portlet light">
	<div class="portlet-body orders_history">
        <?php
            $options = array(
                'model' => 'ordersModel',
                'value' => $ordersList,
                'id' => 'orderId',
                'show_tool' => false,
                'show_filter' => false
            );

            $table = array(
                array('heading' => array('key' => 'orderCode', 'label' => 'Mã', 'style' => 'width: 8%'),
                    'filter' => array(),
                    'tbody' => array('class' => 'bold')
                ),
                array('heading' => array('key' => 'orderStatusName', 'label' => 'Trạng thái'),
                    'filter' => array(),
                    'tbody' => array(),
                ),
                array('heading' => array('key' => 'ordersDateTime', 'label' => 'Ngày tạo'),
                    'filter' => array(),
                    'tbody' => array(),
                ),
                array('heading' => array('key' => 'totalFormat', 'label' => 'Tổng tiền'),
                    'filter' => array(),
                    'tbody' => array('class' => 'bold price'),
                ),
            );

            $tool = array(
                'action' => array()
            );

            TemplateHelper::renderTable($options, $table, $tool);
        ?>
		<?php TemplateHelper::getTemplate('common/paging.php') ?>
	</div>
</div>