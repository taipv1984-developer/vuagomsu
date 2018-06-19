<!-- step1 -->
// noinspection JSAnnotator
<script type="text/javascript">
	//checkout_by_guest click
	$('.checkout_by_guest').click(function() {
		var action = 'checkout_by_guest';
		$.ajax({
			type : "post",
			url : "<?php echo URLHelper::getUrl('home/checkout_ajax')?>",
			data:{'action': action},
			async : true,
			success : function(data){
				window.location.reload();
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});

	//edit_checkout_by_guest click
	$('.edit_step1').click(function() {
		//step1
		$('.checkout_step1').removeClass('hide');
		$('.checkout_block_checkout_by_guest').addClass('hide');

		//step2
		$('.checkout_step2_header').removeClass('hide');
		$('.checkout_step2_main').addClass('hide');
		$('.checkout_step2_sumary').addClass('hide');

		//step3
		$('.checkout_step3_header').removeClass('hide');
		$('.checkout_step3_main').addClass('hide');
		$('.checkout_step3_sumary').addClass('hide');

		//step4
		$('.checkout_step4_header').removeClass('hide');
		$('.checkout_step4_main').addClass('hide');
		$('.checkout_step4_sumary').addClass('hide');
		return false;
	});
</script>

<!-- step2 -->
<script type="text/javascript">
	//select_shipping_address
	$(document).on('change','.select_shipping_address', function(){
		var action = 'select_shipping_address';
		var customerAddressId = $(this).val();
		
		$.ajax({
			type : "post",
			url : "<?php echo URLHelper::getUrl('home/checkout_ajax')?>",
			data:{'action': action, 'customerAddressId': customerAddressId},
			async : true,
			success : function(data){
				$('.shipping_address_content').html(data);
				$('.newShippingAddress').prop('checked', false);
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});

		//update rAddress
		$('input.rAddress').val($('input.sAddress').val());
	});

	//sameAddress click
	$('.sameAddress').click(function() {
	  	$('.billing_address').toggle("slow");
	  	if($(this).is(':checked')){	//hide
			//copy data
			$('select.rCountryId').val($('select.sCountryId option:selected').val());
			$('select.rStateId').html($('select.sStateId').html());
			$('select.rStateId').val($('select.sStateId option:selected').val());
			$('select.rCityId').html($('select.sCityId').html());
			$('select.rCityId').val($('select.sCityId option:selected').val());
			$('select.rDistrictId').html($('select.sDistrictId').html());
			$('select.rDistrictId').val($('select.sDistrictId option:selected').val());
			$('input.rPostCode').val($('input.sPostCode').val());
			//update rAddress
			$('input.rAddress').val($('input.sAddress').val());
			//rAddress not required (case not address)
			$('input.rAddress').prop('required', null);
			
		}
		else{	//show
			$(this).attr('value', 0);
			//rAddress required
			$('input.rAddress').attr('required', 'required');
		}
	});

	$('.sAddress').change(function(){
    	var sameAddress = $('.sameAddress').val();
    	if(sameAddress == 1){
    		//update rAddress
    		$('input.rAddress').val($('input.sAddress').val());
    	}
   });

	//select_billing_address
	$(document).on('change','.select_billing_address', function(){
		var action = 'select_billing_address';
		var customerAddressId = $(this).val();
		
		$.ajax({
			type : "post",
			url : "<?php echo URLHelper::getUrl('home/checkout_ajax')?>",
			data:{'action': action, 'customerAddressId': customerAddressId},
			async : true,
			success : function(data){
				$('.billing_address_content').html(data);
				$('.newBillingAddress').prop('checked', false);
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});

	$('.edit_step2').click(function(){
		//step2
		$('.checkout_step2_header').addClass('hide');
		$('.checkout_step2_main').removeClass('hide');
		$('.checkout_step2_sumary').addClass('hide');

		//step3
		$('.checkout_step3_header').removeClass('hide');
		$('.checkout_step3_main').addClass('hide');
		$('.checkout_step3_sumary').addClass('hide');

		//step4
		$('.checkout_step4_header').removeClass('hide');
		$('.checkout_step4_main').addClass('hide');
		$('.checkout_step4_sumary').addClass('hide');
		return false;
	});
</script>

<!-- step3 -->
<script type="text/javascript">
	//select_shipping_method
	$(document).on('change','.select_shipping_method', function(){
		var action = 'select_shipping_method';
		var shippingMethodCode = $(this).val();
		
		$.ajax({
			type : "post",
			url : "<?php echo URLHelper::getUrl('home/checkout_ajax')?>",
			data:{'action': action, 'shippingMethodCode': shippingMethodCode},
			async : true,
			success : function(data){
				$('.shipping_method_form').html(data);
				show_notice('Change shipping method is success');
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});

	//select_payment_method
	$(document).on('change','.select_payment_method', function(){
		var action = 'select_payment_method';
		var paymentMethodCode = $(this).val();
		
		$.ajax({
			type : "post",
			url : "<?php echo URLHelper::getUrl('home/checkout_ajax')?>",
			data:{'action': action, 'paymentMethodCode': paymentMethodCode},
			async : true,
			success : function(data){
				$('.payment_method_form').html(data);
				show_notice('Change payment method is success');
			},
			error: function(xhr, desc, err){
				console.log(xhr + "\n" + err);
			}
		});
	});

	$('.edit_step3').click(function(){
		//step3
		$('.checkout_step3_header').addClass('hide');
		$('.checkout_step3_main').removeClass('hide');
		$('.checkout_step3_sumary').addClass('hide');

		//step4
		$('.checkout_step4_header').removeClass('hide');
		$('.checkout_step4_main').addClass('hide');
		$('.checkout_step4_sumary').addClass('hide');
		return false;
	});
</script>

<!-- step4 ajax -->
<script type="text/javascript">
	$(document).ready(function() {
		$("form.form_step4").submit(function(event){		//required
			var action = 'submit_check';
			
			$.ajax({
				type : 'post',
				url : "<?php echo URLHelper::getUrl('home/checkout_ajax')?>",
				data: {'action': action},
				async : false,
				complete : function(){
			    },
				success : function(data){
					if(data){	//validate message
			 			event.preventDefault();	//required
	
			 			//notice error
			 			show_notice_error(data);
					}
			   }
		   	});
		});
	});
</script>

<!-- common -->
<script type="text/javascript">
$(document).ready(function (){
	var checkoutStep = '<?php echo $_REQUEST['checkoutStep'];?>';
	$('body').animate({
		scrollTop: $(".form_step"+checkoutStep).offset().top
	}, 1000);
});
</script>