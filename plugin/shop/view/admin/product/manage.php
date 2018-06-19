<?php 
	$productList = $_REQUEST['productList'];
	$categorylist = $_REQUEST['categoryList'];
	
	function format_price($price){
		return CurrencyExt::format_price($price);
	}
?>

<div class="portlet light">
	<?php
		$toolbar = new ToolBarHelper();
		$toolbar->addTitle('manage', e('Products Manage'), 'index.php?r=admin/product/manage');
		$toolbar->showToolBar();
	?>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-12">
					<div class="btn-group left">
						<?php 
							TemplateHelper::getTemplate('common/buttons/btn_add.php', 
								array('link' => 'index.php?r=admin/product/add/view',
									'text' => e('Add product'),
									'class' => 'left margin-right-20'
							));
						?>
					</div>
					<?php if(Session::havePermission('admin/product/import') || Session::havePermission('admin/product/export')){?>
	                    <a href="#" class="advance_action hide" style="line-height: 30px;"><?php echo e('Advance action')?></a>
	                    <br>
	                    <div class="product_action margin-top-10" style="display: none">
			            	<?php if(Session::havePermission('admin/product/import')){?>
				            	<div class="col-md-6 nopadding left">
				                    <form enctype="multipart/form-data" action="index.php?r=admin/product/import" method="post" class=" left">
										<input type="file" name="file" class="left" required="required" accept=".xls, .xlsx" style="width: auto"/>
										<button type="submit" value="Upload" class="btn btn-danger margin-right-20 product_import left ">
											<i class="fa fa-upload"></i>
											<?php echo e('Import')?>
										</button>
										<a href="<?php echo Registry::getSetting('product_import_report_file')?>" style="margin-left: 10px; line-height: 28px">
											<?php echo e('Report file')?>
										</a>
										<div class="clear"></div>
										<?php 
											TemplateHelper::getTemplate('common/input/text_row.php', array(
												'label' => e('Image dir'), 
												'help' => e('Copy folder path at File Manage'),
												'name' => 'image_dir',
												'cols' => '4-8',
												'no_padding' => true,
												'row_class' => 'margin-top-5 hide',
												'required' => true,
												'value' => Registry::getSetting('product_import_image_dir')
											));
										?>
									</form>
								</div>
							<?php }?>
							<?php if(Session::havePermission('admin/product/export')){?>
								<div class="col-md-6 nopadding right">
									<a href="index.php?r=admin/product/export" class="btn btn-danger product_export right">
										<i class="fa fa-download"></i>
										<?php echo e('Export')?>
									</a>
								</div>
							<?php }?>
			            </div>
                    <?php }?>
				</div> 
			</div>
		</div>
		<?php
			$options = array(
				'model' => 'productModel',
				'value' => $productList,
				'id' => 'productId'
			);
			$table = array(
				array('heading' => array('key' => 'productId', 'label' => 'ID', 'style' => 'width: 80px', 'class' => 'sorting'),
					'filter' => array('type' => 'number'),
					'tbody' => array('before_code' => '# ', 'class' => 'bold')
				),
				array('heading' => array('key' => 'image', 'label' => 'Image', 'style' => 'width: 80px'),
					'filter' => array('show' => false),
					'tbody' => array('type' => 'file', 'class' => 'image_center image_center_small'),
				),
				array('heading' => array('key' => 'linkView', 'label' => 'Name'),
//					'filter' => array(
//						'type' => 'mutil_input',
//						'controls' => array(
//							array('name' => 'name', 'value' => $_REQUEST['name'], 'placeholder' => 'Name'),
//							array('name' => 'code', 'value' => $_REQUEST['code'], 'placeholder' => 'Code')
//						)),
                    'filter' => array('name' => 'name', 'value' => $_REQUEST['name'], 'placeholder' => 'Name'),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'categoryListText', 'label' => 'Category name'),
					'filter' => array('type' => 'select_category', 'options' => $categorylist),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'price', 'style' => 'width: 120px'),
					'filter' => array('type' => 'mutil_input', 'controls' => array(
								array('name' => 'priceFrom', 'value' => $_REQUEST['priceFrom'], 'placeholder' => 'Price from'),
								array('name' => 'priceTo', 'value' => $_REQUEST['priceTo'], 'placeholder' => 'Price to')
							)),
					'tbody' => array('class' => 'price', 'callback' => 'format_price'),
				),
// 				array('heading' => array('key' => 'amount', 'style' => 'width: 120px'),
// 					'filter' => array('type' => 'mutil_input', 'controls' => array(
// 								array('name' => 'amountFrom', 'value' => $_REQUEST['amountFrom'], 'placeholder' => 'Amount from'),
// 								array('name' => 'amountTo', 'value' => $_REQUEST['amountTo'], 'placeholder' => 'Amount to')
// 							)),
// 					'tbody' => array(),
// 				),
				array('heading' => array('key' => 'status'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'style' => 'width: 120px'),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getAD(), 'class' => 'select_status')
				),
                array('heading' => array('key' => 'crtDateView', 'label' => 'Ngày tạo'),
                    'filter' => array('show' => false),
                    'tbody' => array(),
                ),
                array('heading' => array('key' => 'modDateView', 'label' => 'Ngày sửa'),
                    'filter' => array('show' => false),
                    'tbody' => array(),
                ),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/product/edit/view&productId=%s',
					'linkDelete' 	=> 'index.php?r=admin/product/delete&productId=%s',
				)
			);
			TemplateHelper::renderTable($options, $table, $tool);
		?>

	    <!-- paging -->
	    <div class="row">
			<?php TemplateHelper::getTemplate('common/paging.php')?>
		</div>
	</div>
</div>

<script type="text/javascript">
	//select_is_new
	$(document).on('change','.select_is_new', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'select_is_new';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/product/manage_ajax",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change product is new success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});

	//select_is_feature
	$(document).on('change','.select_is_feature', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'select_is_feature';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/product/manage_ajax",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change product is feature success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});

	//select_status
	$(document).on('change','.select_status', function() {
		var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'select_status';
		$.ajax({
			type : 'post',
			url : "index.php?r=admin/product/manage_ajax",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change status success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
</script>

<script type="text/javascript">
	$('.advance_action').click(function (){
		$('.product_action').toggle("fast");
	});
</script>