<?php 
	$checkoutStep = CheckoutExt::getCheckoutStep();
?>

<form action="" method="post" class="form-processmethods checkout_form form_step4 <?php echo ($checkoutStep == 4)? 'active' : ''?>">
	<div class="methodsection checkoutblock checkoutblock_last checkout_step4_main <?php echo ($checkoutStep == 4)? '' : 'hide'?>">
		<fieldset>
			<legend>
				<span class="legend_message"><?php echo e('Confirm orders'); ?></span>
			</legend>
			<span class="my_row margin-bottom-10 margin-top-10">
				<?php echo e('Please check back again to confirm orders'); ?>
			</span>
			<?php 
				TemplateHelper::getTemplate('common/input/textarea.php', array(
					'name' => 'note',
					'value' => $_REQUEST['note'],
					'placeholder' => 'ORDERS NOTE HERE',
					'rows' => '3'
				));
			?>
			<!-- submit -->
			<button type="submit" name="submit_checkoutStep4" class="button next_process right">
				<?php echo e('Confirm'); ?>
			</button>
		</fieldset>
	</div>
</form>