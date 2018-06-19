<?php 
	$items = $_REQUEST['pageView'];
	$trainerArray = $_REQUEST['trainerArray'];
?>
<div class="portlet light">
	<div class="portlet-title">
	    <div class="caption">
	        <i class="fa fa-cogs font-green-sharp"></i>
           	<span class="caption-subject font-green-sharp bold uppercase">
           		<a href='index.php?r=admin/contact/manage'><?php echo e('Contact Manage') ?></a>
           	</span>
	    </div>
	</div>
	<div class="portlet-body">
	    <div class="table-toolbar">
	        <div class="row">
	            <div class="col-md-6">
                    <?php 
                    	TemplateHelper::getTemplate('common/buttons/btn_add.php', array(
                    		'link' => 'index.php?r=admin/contact/add', 
                    		'text' => e('Add Contact'),
                    		'class' => 'left margin-right-20'
                    	));
                    ?>
                    <?php if(Session::havePermission('admin/contact/import') || Session::havePermission('admin/contact/export')){?>
                    <a href="#" class="advance_action" style="line-height: 30px;">Advance action</a>
                    <?php }?>
	            </div>
	            <div class="col-md-6">
	            	<div class="contact_extra_link">
	            		<ul>
	            			<li <?php if(!isset($_REQUEST['contactModel_status']) || $_REQUEST['contactModel_status']=='') echo "class='active'" ?>>
	            				<a href="index.php?r=admin/contact/manage" title="<?php echo e('Contact all')?>">
	            					<i class="fa fa-filter"></i>
	            					<?php echo e('Contact all')?>
	            				</a>
	            			</li>
	            			<li <?php if($_REQUEST['contactModel_status']=='P') echo "class='active'" ?>>
	            				<a href="index.php?r=admin/contact/manage&contactModel.status=P" title="<?php echo e('Contact pending')?>">
	            					<i class="fa fa-filter"></i>
	            					<?php echo e('Contact pending')?>
	            				</a>
	            			</li>
	            			<li <?php if($_REQUEST['contactModel_status']=='A') echo "class='active'" ?>>
	            				<a href="index.php?r=admin/contact/manage&contactModel.status=A" title="<?php echo e('Contact active')?>">
	            					<i class="fa fa-filter"></i>
	            					<?php echo e('Contact active')?>
	            				</a>
	            			</li>
	            			<li <?php if($_REQUEST['contactModel_status']=='C') echo "class='active'" ?>>
	            				<a href="index.php?r=admin/contact/manage&contactModel.status=C" title="<?php echo e('Contact cancel')?>">
	            					<i class="fa fa-filter"></i>
	            					<?php echo e('Contact cancel')?>
	            				</a>
	            			</li>
	            		</ul>
	            	</div>
	            </div>
	            
	            <?php if(Session::havePermission('admin/contact/import') || Session::havePermission('admin/contact/export')){?>
	            <div class="contact_action margin-top-10" style="display: none; width: 100%; float: left">
                    <div class="col-md-6">
                        <?php if(Session::havePermission('admin/contact/import')){?>
                        <form enctype="multipart/form-data" action="index.php?r=admin/contact/import" method="post">
                            <input type="file" name="file" class="input left" required="required" accept=".xls, .xlsx" style="width: auto !important;"/>
                            <button type="submit" value="Upload" class="btn btn-danger contact_import left margin-left-10">
                                <i class="fa fa-upload"></i>
                                <?php echo e('Import')?>
                            </button>
                            <div class="clear"></div>
                            <span style="color: brown; margin-top: 5px; float: left;">
                                <u>Chú ý</u>: Khi import dự liệu thì những contact có trùng số điện thoại sẽ bỏ qua.
                            </span>
                        </form>
                        <?php }?>
                    </div>
                    <div class="col-md-6">
                    <?php if(Session::havePermission('admin/contact/export')){?>
                    <a href="index.php?r=admin/contact/export" class="btn btn-danger contact_export right">
                        <i class="fa fa-download"></i>
                        <?php echo e('Export')?>
                    </a>
                    <?php }?>
                    </div>
	            </div>
	            <?php }?>
	        </div>
	    </div>
	    
	    <form action="" id="userSearchForm" method="post">
		<?php 
			$trainerPermission = (Session::havePermission('admin/contact/change_trainer')) ? false : true;
			$statusPermission = (Session::havePermission('admin/contact/change_status')) ? false : true;
			$sourcePermission = (Session::havePermission('admin/contact/change_source')) ? false : true;
			
			$options = array(
				'model' => 'contactModel',
				'value' => $items->items,
				'id' => 'contactId'
			);
			
			$table = array(
                array('heading' => array('key' => 'contactId', 'label' => 'ID', 'style' => 'width: 60px'),
                    'filter' => array(),
                    'tbody' => array('before_code' => '# ', 'class' => 'bold')
                ),
				array('heading' => array('key' => 'crt_date', 'label' => 'Date'),
					'filter' => array('type' => 'date'),
					'tbody' => array()
				),
				array('heading' => array('key' => 'name', 'style' => 'width: 150px'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'phone'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'email'),
					'filter' => array(),
					'tbody' => array(),
				),
				array('heading' => array('key' => 'trainer_id', 'label' => 'Trainer', 'style' => 'width: 130px'),
					'filter' => array('type' => 'select', 'options' => $trainerArray),
					'tbody' => array('type' => 'select', 'options' => array('' => '') + $trainerArray, 'class' => 'change_trainer', 'disable' => $trainerPermission)
				),
				array('heading' => array('key' => 'status', 'style' => 'width: 120px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getContactStatus()),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getContactStatus(), 'class' => 'change_status', 'disable' => $statusPermission)
				),
				array('heading' => array('key' => 'source', 'style' => 'width: 110px'),
					'filter' => array('type' => 'select', 'options' => ArrayHelper::getContactSource()),
					'tbody' => array('type' => 'select', 'options' => ArrayHelper::getContactSource(), 'class' => 'change_source', 'disable' => $sourcePermission)
				),
                array('heading' => array('key' => 'regionShortName', 'label' => 'Cơ sở', 'style' => 'width: 110px'),
                    'filter' => array('type' => 'select', 'options' => ArrayHelper::getRegionShortNameList()),
                    'tbody' => array()
                ),
			);
			
			$tool = array(
				'action' => array(
					'linkEdit'  	=> 'index.php?r=admin/contact/edit&contactId=%s',
					'linkDelete' 	=> 'index.php?r=admin/contact/delete&contactId=%s',
				)
			);
		
			TemplateHelper::renderTable($options, $table, $tool);
		?>
	    </form>
	    
	    <!-- paging -->
	    <div class="row margin-top-10">
			<?php TemplateHelper::getTemplate('/common/paging.php')?>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php if(Session::havePermission('admin/contact/change_trainer')){?>
	//change_trainer
	$(document).on('change','.change_trainer', function() {
        var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_trainer';
		$.ajax({
			type : "post",
			url : "index.php?r=admin/contact/change_trainer",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change trainer success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
	<?php }?>

	<?php if(Session::havePermission('admin/contact/change_status')){?>
	//change_status
	$(document).on('change','.change_status', function() {
        var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_status';
		$.ajax({
			type : "post",
			url : "index.php?r=admin/contact/change_status",
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
	<?php }?>

	<?php if(Session::havePermission('admin/contact/change_source')){?>
	//change_source
	$(document).on('change','.change_source', function() {
        var id = $(this).parents('tr').attr('id').replace('row_', '');
		var value = $(this).val();
		var action = 'change_source';
		$.ajax({
			type : "post",
			url : "index.php?r=admin/contact/change_source",
			data: {'action': action, 'id': id, 'value': value},
			async : true,
			success : function(data) {
				//message
				show_notice('Change source success');
			},
			error: function (xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
	<?php }?>

	$('.advance_action').click(function (){
		$('.contact_action').toggle("fade");
	});
</script>