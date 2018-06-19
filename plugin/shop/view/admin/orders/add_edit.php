<?php 
	$orderId = $_REQUEST['orderId'];
	$ordersInfo = $_REQUEST['ordersInfo'];
		$customerInfo = $ordersInfo->customerInfo;
        $customerName = CustomerExt::getFullName($customerInfo);
		$shippingAddressInfo = $ordersInfo->shippingAddressInfo;
		$billingAddressInfo = $ordersInfo->billingAddressInfo;
	$orderHistory = $_REQUEST['orderHistory'];
	$orderStatusArray = OrdersExt::getOrderStatusArray();

	$shippingInfo = $_REQUEST['shippingInfo'];
?>
<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addButtonBack(array('btn_back.php'));
			if($orderId){
				$toolbar->addTitle('edit', e("Edit orders"));
			}else{
				$toolbar->addTitle('add', e('Add orders'));
			}
			$toolbar->addButtonRight(array('btn_save_and_close.php'));
			$toolbar->showToolBar();
		?>
		
		<!-- #Orders_information -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#orders_information">
						<?php echo e('Orders information')?> 
					</a>
				</h4>
			</div>
			<div id="orders_information" class="panel-collapse in">
				<div class="panel-body">
                    <?php
                    TemplateHelper::getTemplate('common/input/select_row.php',
                        array('options' => $orderStatusArray,
                            'name' => 'ordersModel.orderStatusId',
                            'label' => e('Status'),
                            'value' => $ordersInfo->orderStatusId,
                            'rule_orders' => true
                        ));
                    TemplateHelper::getTemplate('common/input/text_row.php',
                        array('label' => 'Tổng tiền hàng',
                            'name' => 'ordersModel.subtotal',
                            'value' => $ordersInfo->subtotal,
                            'class' => 'red bold left price',
                        ));

                    //add shippingCost
                    TemplateHelper::getTemplate('common/input/text_row.php',
                        array('label' => e('Shipping cost'),
                            'name' => 'shippingCost',
                            'value' => $shippingInfo->value,
                            'class' => 'red bold left price',
                        ));
                    ?>

                    <!-- Discount -->
                    <div class="my_row discount_row">
                        <label class="col-md-2 discount_row_title">
                            <?php echo e('Discount')?>
                        </label>
                        <div class="row_value col-md-10 discount_row_content">
                            <div class="col-md-6 col-left">
                                <select name="ordersModel.discountType" class="input">
                                    <option value="percent" <?php if($ordersInfo->discountType == 'percent') echo 'selected="selected"'?>>
                                        Theo phần trăm %
                                    </option>
                                    <option value="price" <?php if($ordersInfo->discountType == 'price') echo 'selected="selected"'?>>
                                        Theo giá tiền
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 col-right">
                                <input type="text" name="ordersModel.discountValue" value="<?=$ordersInfo->discountValue?>"
                                       class="input red bold left price">
                            </div>
                        </div>
                    </div>

                    <?php
                    TemplateHelper::getTemplate('common/input/label_row.php',
                        array('label' => '<b>Tổng thanh toán</b>',
                            'title' => "<span style='font-size: 18px'>".CurrencyExt::format_price($ordersInfo->total)."</span>",
                            'class' => 'red bold left price',
                        ));
                    TemplateHelper::getTemplate('common/input/label_row.php',
                        array('label' => e('Note (customer)'),
                            'title' => $ordersInfo->note,
                            'class' => 'italic'
                        ));
                    TemplateHelper::getTemplate('common/input/text_row.php',
                        array('name' => 'comment',
                            'label' => 'Ghi chú',
                        ));
                    ?>
					
					<!-- description history -->
					<div class="my-row description_history">
					    <label class="col-md-2 description_history_title">
					    	<?php echo e('History')?>   	            
					    </label>
					    <div class="col-md-10 description_history_content">
					    	<?php if(count($orderHistory)> 0){?>
						    <ul>
						    	<?php foreach($orderHistory as $v){?>
						    		<li>
				    					<div class="my_row">
				    						<label>[Thời gian]</label>
				    						<span><i><?php echo date('d/m/Y H:m:s', strtotime($v->crtDate))?> (by <?php echo $v->crtByName?>)</i></span>
				    					</div>
				    					<div class="my_row">
						    			<?php if($v->content != ''){?>
					    					<label>[Nội dung]</label>
					    					<span><b><?php echo $v->content?></b></span>
						    			<?php }?>
						    			</div>
						    			<div class="my_row">
						    			<?php if($v->comment != ''){?>
					    					<label>[Ghi chú]</label>
					    					<span><i><?php echo $v->comment?></i></span>
					    				<?php }?>
					    				</div> 
						    		</li>
						    	<?php }?>
						    </ul>
							<?php } else {?>
							<div class='description_history_empty'>
								<?php echo e('Empty')?>
							</div>
						    <?php }?>
						</div>
					</div>
					
					<!-- date time -->
					<?php 
						TemplateHelper::getTemplate('common/input/label_row.php',
							array('label' => e('Created on'),
								'title' => $ordersInfo->crtDateInfo,
							));
						TemplateHelper::getTemplate('common/input/label_row.php',
							array('label' => 'Người sửa cuối',  	//e('Modified last on'),
								'title' => $ordersInfo->modInfo,
							));
					?>
				</div>
			</div>
		</div>  
		
		<!-- customer_info -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#contact_detail">
						<?php echo e('Customer info')?>
					</a>
				</h4>
			</div>
			<div id="contact_detail" class="panel-collapse in contact_detail">
				<div class="panel-body">
					<?php 
						TemplateHelper::getTemplate('common/input/label_row.php',
							array('label' => e('Name'),
								'title' => ($customerInfo->isDel) ? "<span class='line-through'>$customerName</span>" : $customerName,
							));
						TemplateHelper::getTemplate('common/input/label_row.php',
							array('label' => e('Email'),
                                'title' => ($customerInfo->isDel) ? "<span class='line-through'>$customerInfo->email</span>" : $customerInfo->email,
							));
						TemplateHelper::getTemplate('common/input/label_row.php',
							array('label' => e('Phone'),
                                'title' => ($customerInfo->isDel) ? "<span class='line-through'>$customerInfo->phone</span>" : $customerInfo->phone,
							));
						TemplateHelper::getTemplate('common/input/label_row.php',
							array('label' => e('Address'),
								'title' => $ordersInfo->shippingAddress,
							));
					?>
				</div>
			</div>
		</div>
		
		<!-- product_cart -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#product_cart">
						<?php echo e('Product list')?> 
					</a>
				</h4>
			</div>
			<div id="product_cart" class="panel-collapse in orders_product_cart">
				<?php include 'product_cart.php';?>
			</div>
		</div>                      
	</div>
</form>       
