<?php include '_params.php'?>
<?php 
	//get data
	$productTagList = $params['product_tag_list'];
	$productTagSelected = $params['product_tag_selected'];
	$option = (isset($params['option'])) ? $params['option'] : 'add';   //add or edit
?>
<?php if($option == 'add'){?>
    <div class="product_tag_note" style="padding: 5px; font-style: italic; color: brown;">
        Hãy lưu sản phẩm trước rồi mới thêm được tag.
    </div>
<?php } else { ?>
<div class="tag-input-group">
	<div class="col-left col-md-6">
		<div class="tag-form">
			<input type="text" class="input tag-name" name="tagName">
			<div class="btn btn-primary tag-add">
				<i class="fa fa-plus"></i>
				<?=e('Add tag')?>
			</div>
		</div>
		<div class="clear"></div>
		
		<div class="tag-select-list">
			<div class="tag-title"><?=e('Choose from tags list')?></DIV>
			<ul>
				<?php foreach ($productTagList as $v){?>
				<li class="tag-select" title="<?=e('Select tag')?>"
					data-productTagId="<?=$v->productTagId ?>">
					<?=$v->name?>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
	
	<div class="col-right col-md-6">
		<div class="tag-added-list">
			<div class="tag-title"><?=e('Tags selected list')?></div>
			<ul>
				<?php foreach ($productTagSelected as $v){?>
				<li class="tag-remove" title="<?=e('Remove tag')?>"
					id="tag-remove-<?=$v->productTagMapId ?>"
					data-productTagMapId="<?=$v->productTagMapId ?>">
					<i class="fa fa-tag"></i>
					<?=$v->name?>
					<i class="fa fa-times-circle remove-icon"></i>
				</li>
				<?php }?>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//tag_add event
		$(".tag-add").click(function(){
			var url = "index.php?r=admin/product_tag/action";
			var action = 'tag_add';
			var tagName = $('input[name="tagName"]').val();
			var productId = '<?=$_REQUEST['productId']?>';

			//check tagName
			if(tagName == ''){
				alert('<?=e('Tag name is required')?>');
				$('input[name="tagName"]').addClass('validate_error');
				$('input[name="tagName"]').focus();
			}
			else{
				$.ajax({
					type : 'post',
					url : url,
					data:{'action': action, 'tagName': tagName, 'productId': productId},
					async : false,
					complete : function(){
				    },
					success : function(data){
						if(data){	//validate message
							data = JSON.parse(data);
							console.log(data);
	
				 			//notice
				 			if(data.error){
				 				show_notice_error(data.message);
				 			}
				 			else{
				 				//change ui
					 			$('.tag-added-list ul').append(data.htmlTagSelected);
					 			$('.tag-select-list ul').append(data.htmlTagList);
					 			//notice
				 				show_notice(data.message);
				 			}
						}
				   }
			   	});
			}
		});

		//tag_select event
		$(document).on('click', '.tag-select', function(){
			var url = "index.php?r=admin/product_tag/action";
			var action = 'tag_select';
			var productTagId = $(this).attr('data-productTagId');
			var productId = '<?=$_REQUEST['productId']?>';
			
			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'productTagId': productTagId, 'productId': productId},
				async : false,
				complete : function(){
			    },
				success : function(data){
					if(data){	//validate message
						data = JSON.parse(data);
						console.log(data);

			 			//notice
			 			if(data.error){
			 				show_notice_error(data.message);
			 			}
			 			else{
				 			//change ui
				 			$('.tag-added-list ul').append(data.htmlTagSelected);
				 			//notice
			 				show_notice(data.message);
			 			}
					}
			   }
		   	});
		});

		//tag_remove event
		$(document).on('click', '.tag-remove', function(){
			var url = "index.php?r=admin/product_tag/action";
			var action = 'tag_remove';
			var productTagMapId = $(this).attr('data-productTagMapId');

			$.ajax({
				type : 'post',
				url : url,
				data:{'action': action, 'productTagMapId': productTagMapId},
				async : false,
				complete : function(){
			    },
				success : function(data){
					if(data){	//validate message
						data = JSON.parse(data);
						console.log(data);

			 			//notice
			 			if(data.error){
			 				show_notice_error(data.message);
			 			}
			 			else{
				 			//change ui
				 			$('#tag-remove-'+productTagMapId).fadeOut(500, function(){
					 			$(this).remove();
					 		});
				 			//notice
			 				show_notice(data.message);
			 			}
					}
			   }
		   	});
		});
	});
</script>
<?php } ?>
<?php 
	if(isset($params['addElement'])){
		echo $params['addElement'];
	}
?>