<?php
	//get data
	$newsletterEmail = $_REQUEST['newsletterEmail'];
	$customerEmail = $_REQUEST['customerEmail'];
	$newsletterEmailInfo = $_REQUEST['newsletterEmailInfo'];
?>
<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
	<div class="portlet light">
		<?php
			$toolbar = new ToolBarHelper();
			$toolbar->addTitle('fa fa-send', e('Send email newsletter'));
			$toolbar->showToolBar();
		?>
		
		<div class="panel-group accordion"> 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#group_1">
							<?php echo e('Email list')?> 
						</a>
					</h4>
				</div>
				<div id="group_1" class="panel-collapse in">
					<div class="col-md-6">
						<h5 class="bold">
							<?php echo e('Select newsletter email to send')?>
							<div class="select-action right" style="font-weight: normal;">
								<a href="#" title="<?php echo e('Select all')?>" class="newsletter_email_select_all margin-right-5">
									<?php echo e('Select All')?>
								</a>
								<a href="#" title="<?php echo e('Select none')?>" class="newsletter_email_select_none">
									<?php echo e('Select none')?>
								</a>
							</div>
						</h5>
						<select multiple="multiple" class="newsletter_email" name="newsletter_email" style="height: 200px">
							<?php foreach ($newsletterEmail as $v){?>
								<option value="<?php echo $v?>">
									<?php echo $v?>
								</option>
							<?php }?>
						</select>
					</div>
					<div class="col-md-6">
						<h5 class="bold">
							<?php echo e('Select customer email to send')?>
							<div class="select-action right" style="font-weight: normal;">
								<a href="#" title="<?php echo e('Select all')?>" class="customer_email_select_all margin-right-5">
									<?php echo e('Select All')?>
								</a>
								<a href="#" title="<?php echo e('Select none')?>" class="customer_email_select_none">
									<?php echo e('Select none')?>
								</a>
							</div>
						</h5>
						<select multiple="multiple" class="customer_email" name="customer_email" style="height: 200px">
							<?php foreach ($customerEmail as $v){?>
								<option value="<?php echo $v?>">
									<?php echo $v?>
								</option>
							<?php }?>
						</select>
					</div>
					
					<div class="col-md-12 margin-top-10">
						<input type="hidden" name="emails" value="">
						<button type="submit" class="btn btn-danger email_send">
							<i class="fa fa-send"></i>
							<?php echo e('Send email')?>
						</button>
					</div>
					
					<div class="col-md-12 send_email_log">
						<?php 
							$emailSended = Session::getSession('emailSended');
							if($emailSended){
								//delete session
								Session::deleteSession('emailSended');
						?>
						<h5 class="bold"><?php echo e('Email sended list')?></h5>
						<ul>
							<?php foreach ($emailSended as $v){?>
							<li>
								<?php echo $v?>
							</li>
							<?php }?>
						</ul>
						<?php }?>
					</div>
				</div>
			</div>
		</div><!-- end  group_1 -->
		
		<div class="panel-group accordion"> 
			<div class="panel panel-default">		
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" href="#group_2">
							<?php echo e('Email info')?> 
						</a>
					</h4>
				</div>
				<div id="group_2" class="panel-collapse in">
					<?php
						//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
						//add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
						$settingForm = array(
							'subject'	=> array('type' => 'label'),
							'content'	=> array('type' => 'label'),
						);
						$settingValue = $newsletterEmailInfo;
						$settingAll = array(
							'model' => 'newsletterEmailModel'
						);
						
						//render setting from
						TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
					?>
				</div>
			</div>
		</div><!-- end  group_2 -->
	</div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.newsletter_email_select_all').click(function() {
		    $('.newsletter_email option').prop('selected', true);
		    return false;
		});
		$('.newsletter_email_select_none').click(function() {
		    $('.newsletter_email option').prop('selected', false);
		    return false;
		});
		$('.customer_email_select_all').click(function() {
		    $('.customer_email option').prop('selected', true);
		    return false;
		});
		$('.customer_email_select_none').click(function() {
		    $('.customer_email option').prop('selected', false);
		    return false;
		});

		//form submit
		$("form").submit(function(event){
			//get emails
			var newsletter_email = $('select[name="newsletter_email"]').val();
			var customer_email = $('select[name="customer_email"]').val();
			var emails = [];
			if(newsletter_email != null){
				emails = emails.concat(newsletter_email);
			}
			if(customer_email != null){
				emails = emails.concat(customer_email);
			}

			//update emails value to emails element
			$('input[name="emails"]').val(emails);

			if(emails.length == 0){
				show_notice_error('<?php echo e('No email selected')?>');
				event.preventDefault();	//required
			}
		});
	});
</script>