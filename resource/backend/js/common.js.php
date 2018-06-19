<?php
/**
 * Common js for admin (run on head tag)
 * List
 * 		datepicker
 * 		sortable
 * 		fancybox dialog
 * 		pre load ajax
 * 		show_notice
 * 		search (filter & paging)
 *		filter.click (userSearch.click)
 *		getFormData (user ajax, popup form)
 * 		ckeditor
 */
?>
<!-- checkRequired -->
<script type="text/javascript">
	function checkRequired(collection, message_overview) {
		var check = true;
		$(collection).find('.input').each(function() {
			var required = $(this).attr('required');
			if (required == 'required') {
				var val = $(this).val();
				if (val == '') {
					$(this).addClass('input_error');
					$(this).parent('div').find('.validate_message').html('<span>Filter is required</span>');
					check = false;
				}
			}
		});
		if(check){
			$(message_overview).html('');
			$(collection).each(function() {
				$(this).removeClass('input_error');
				$(this).parent('div').find('.validate_message').html('');
			});
		}
		else{
			$(message_overview).html('<span>Please check data input</span>');
		}
		return check;
	}
	//new-15-01-2016
	function checkRequired_popup(form){
        var check = true;
        $(form).find('input').each(function(){
            //reset error
        	$(this).removeClass("border_red");
        	$(this).parent().find('.validate_message').html('');
            var required = $(this).attr('required');
            if(required == 'required'){
                var val = $(this).val();
                if(val == ''){
                    $(this).addClass("border_red");
                    $(this).parent().find('.validate_message').html('field is required');
                    check = false;
               }
           }
       });
       $(form).find('select').each(function(){
        	//reset error
        	$(this).removeClass("border_red");
        	$(this).parent().find('.validate_message').html('');
            var required = $(this).attr('required');
            if(required == 'required'){
                var val = $(this).val();
                if(val == ''){
                    $(this).addClass("border_red");
                    $(this).parent().find('.validate_message').html('field is required');
                    check = false;
               }
           }
       });
       return check;
   }
	//new-15-01-2016 (demo product/attribute/attribute_action.php
	function validateForm_popup(form){
		//return checkEmail_popup(form);//later
		return checkRequired_popup(form);
    }
</script>

<!-- date picker -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: '<?php echo Registry::getSetting('date_picker_format')?>',
            autoclose: true,
            calendarWeeks: true
        })
    });
</script>

<!-- sortable -->
<script type="text/javascript">
	$().ready(function(){
		$("#sortable").sortable();
		$("#sortable").disableSelection();
	})
</script>

<!-- fancybox dialog start -->
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox();
	//ap dung cho view (khong reload lai trang)
	$('.popup').fancybox({
		type		: 'iframe',
		fitToView	: true,
		width		: '80%',
		height		: '80%',
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
	});
	//ap dung cho add/edit/delete form ma load lai trang (dung o cac trang gian tiep)
	$('.popup_action').fancybox({
		type		: 'iframe',
		fitToView	: true,
		width		: '80%',
		height		: '80%',
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		'afterClose':function (e) {
	        window.location.reload();
	    },
	});
	$('.popup50').fancybox({
		type		: 'iframe',
		fitToView	: true,
		width		: '50%',
		height		: '50%',
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
	});
	$('.popup50_action').fancybox({
		type		: 'iframe',
		fitToView	: true,
		width		: '50%',
		height		: '50%',
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		'afterClose':function () {
	        window.location.reload();
	    },
	});
	$('.popup_max').fancybox({
		type		: 'iframe',
		fitToView	: true,
		width		: '90%',
		height		: '90%',
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		title: '',
	});
	$('.popup_auto').fancybox({
		type		: 'iframe',
		fitToView	: true,
		width		: '80%',
		height		: 'auto',
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
	});
	$('.popup_image').fancybox({
		fitToView	: true,
		autoSize	: false,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		title: '',
	});
});
</script>
<!-- fancybox dialog end -->

<!-- pre load ajax -->
<script type="text/javascript">
  	$(document).ajaxStart(function(){
	    $("#wait").css("display", "block");
	});

	$(document).ajaxComplete(function(){
	    $("#wait").css("display", "none");
	});
</script>

<!-- show_notice -->
<script type="text/javascript">
    function show_notice(message){
    toastr.options ={
        closeButton: true,
        debug: false,
        positionClass: 'toast-top-right',
        onclick: null
    };
    toastr.options.showDuration = '1000';
    toastr.options.hideDuration = '1000';
    toastr.options.timeOut = '5000';
    toastr.options.extendedTimeOut = '1000';
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.showMethod = 'fadeIn';
    toastr.options.hideMethod = 'fadeOut';
    toastr['success'](message, 'SUCCESS');
}

    function show_notice_error(message){
    toastr.options ={
        closeButton: true,
        debug: false,
        positionClass: 'toast-top-right',
        onclick: null
    };
    toastr.options.showDuration = '1000';
    toastr.options.hideDuration = '1000';
    toastr.options.timeOut = '5000';
    toastr.options.extendedTimeOut = '1000';
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.showMethod = 'fadeIn';
    toastr.options.hideMethod = 'fadeOut';
    toastr['error'](message, 'ERROR');
}
</script><script type="text/javascript">
    function show_notice(message){
    toastr.options ={
        closeButton: true,
        debug: false,
        positionClass: 'toast-top-right',
        onclick: null
    };
    toastr.options.showDuration = '1000';
    toastr.options.hideDuration = '1000';
    toastr.options.timeOut = '5000';
    toastr.options.extendedTimeOut = '1000';
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.showMethod = 'fadeIn';
    toastr.options.hideMethod = 'fadeOut';
    toastr['success'](message, 'SUCCESS');
}

    function show_notice_error(message){
    toastr.options ={
        closeButton: true,
        debug: false,
        positionClass: 'toast-top-right',
        onclick: null
    };
    toastr.options.showDuration = '1000';
    toastr.options.hideDuration = '1000';
    toastr.options.timeOut = '5000';
    toastr.options.extendedTimeOut = '1000';
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.showMethod = 'fadeIn';
    toastr.options.hideMethod = 'fadeOut';
    toastr['error'](message, 'ERROR');
}
</script>

<!-- responsive_filemanager_callback -->
<script type="text/javascript">
	//split field_id to 2 case
	//case1: single select image 	(field_id == 'image_select')		(insert 1 image on 1 page)
	//case2: add image	 	 	 	(field_id == 'image_add')
	//case3: select (changle) image (field_id == 'image_list')
	//default:						(field_id == 'image_select_%id%')    (insert n image on 1 page set by id)
	function responsive_filemanager_callback(field_id){
		//console.log('field_id = ' + field_id);
		switch(field_id) {
		    case 'image_add':		//case	image_add
		    	var url = $('#'+field_id).val();
				var index = $('ul.input_multi_file li').size()+1;
			    var data = {'image': url, 'index': index};
			    $.ajax({
			    	type : "POST",
					url : 'index.php?r=admin/file/add_image_ajax',
					data: data,
					async : false,
					complete : function(data) {
						//console.log(data);
						show_notice('<?=e('Add image success')?>');
						$('ul.input_multi_file').append(data.responseText);
					},
					error: function (xhr, desc, err) {
		                console.log(xhr + "\n" + err);
		            }
				});
		        break;
			default:		//(insert n image on 1 page)
		    	var url = $('#'+field_id).val();
	    		//console.log(`url = ${url} ... field_id = ${field_id}`);
				$('#'+field_id).parents('.input_file').find('.image_source').attr('value', url);
				$('#'+field_id).parents('.input_file').find('.image_preview').attr('src', url);
				$('#'+field_id).parents('.input_file').find('.image_preview_link').attr('href', url);
		        break;
		}
		parent.$.fancybox.close();
	}
</script>
<!-- search (filter & paging) -->
<script type="text/javascript">
	function search(frmId, pageid, pageVal) {
		var filters = $("#" + frmId).serialize();

		//current url
	    var url = '<?=Registry::getSetting('base_url') ?>/index.php?r=<?=$_REQUEST[ACTION_PARAM] ?>';

	    //ad filter
	    url += '&' + filters;

	    //add page
	    url = url.replace(/&page=\d/, '');
	    url += '&' + pageid + '=' + pageVal;
	    url = url.replace('&&', '&');

	    window.location = url;
	    return false;
	}
	//filter
	$().ready(function (){
	    $('#userSearch').click(function() {
	        search("userSearchForm", "page", 0);
	        return false;
	    });
	});
</script>

<!-- getFormData -->
<script type="text/javascript">
	function getFormData($form){
		var unindexed_array = $form.serializeArray();
		var indexed_array ={};

		$.map(unindexed_array, function(n, i){
			indexed_array[n['name']] = n['value'];
	    });

		return indexed_array;
	}
</script>


<!-- validateForm -->
<script type="text/javascript">
    function resetValidateForm(){
        $('.input').removeClass('validate_error');
        $('.input').parent().find('.validate_message').html('');
    }
    function validateForm(data){
        resetValidateForm();
        for (name in data) {
            var message = data[name];
            $('.input[name="' + name + '"]').addClass('validate_error');
            $('.input[name="' + name + '"]').parent().find('.validate_message').html(message);
        }
    }
</script>

<!-- priceFormat -->
<script type="text/javascript">
	$().ready(function (){
		$('input.price').autoNumeric('init',{mDec: 0 })
	})
</script>

<!-- shop plugin -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.chosen-select').chosen({});
		$(".chosen-select").chosen().change(function(){
			//var id = $(this).val();
			//console.log('work id = '+id);
		});
	})
</script>

<!-- ckeditor -->
<script type="text/javascript">
    var handleCKEditor = function () {
    $(".ckeditor").ckeditor({
        filebrowserBrowseUrl : '<?=URLHelper::getResource("resource/backend/js") ?>/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=<?=Session::getSession("filemanager_access_key")?>',
        filebrowserUploadUrl : '<?=URLHelper::getResource("resource/backend/js") ?>/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=<?=Session::getSession("filemanager_access_key")?>',
        filebrowserImageBrowseUrl : '<?=URLHelper::getResource("resource/backend/js") ?>/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=<?=Session::getSession("filemanager_access_key")?>',
        height: '400px',
    });

    $(".ckeditor_content").ckeditor({
    filebrowserBrowseUrl : '<?=URLHelper::getResource("resource/backend/js") ?>/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=<?=Session::getSession("filemanager_access_key")?>',
    filebrowserUploadUrl : '<?=URLHelper::getResource("resource/backend/js") ?>/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=<?=Session::getSession("filemanager_access_key")?>',
    filebrowserImageBrowseUrl : '<?=URLHelper::getResource("resource/backend/js") ?>/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=<?=Session::getSession("filemanager_access_key")?>',
    height: '600px',
});

    var miniToolbar = [
{"name":"basicstyles","groups":["basicstyles"]},
{"name":"links","groups":["links"]},
{"name":"paragraph","groups":["list","blocks"]},
{"name":"styles","groups":["styles"]},
{"name":"document","groups":["mode"]},
    //{"name":"insert","groups":["insert"]},
    ];
    $('.ckeditor_mini').ckeditor({
    toolbarGroups: miniToolbar,
    height: '200px',
});
}
    $().ready(function(){
    handleCKEditor();
});
</script>

<script type="text/javascript">
    function pluginInit(){
        handleCKEditor();
    }
</script>