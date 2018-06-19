<?php include '_params.php'?>

<?php
	$id = (isset($params['id'])) ? $params['id'] : 'ultraselect';
	//get $categoryIdSelected
	$categoryIdSelected = array();
	foreach ($params['value'] as $value){
		$categoryIdSelected[$value->categoryId] = $value->name;
	}

    $categoryPrimaryId = $params['categoryPrimaryId'];
?>

<!-- fileinput -->
<script src="<?=URLHelper::getResource('resource/backend/js/ultraselect/dist/jquery.ultraselect.min.js')?>" type="text/javascript"></script>
<link href="<?=URLHelper::getResource('resource/backend/js/ultraselect/dist/jquery.ultraselect.css')?>" rel="stylesheet" type="text/css"/>
	
<select class="input table-group-action-input form-control <?=$params['class']?>" id="<?=$id?>"
	name="<?=$params['name']?>"
	multiple="multiple"
	<?php if($params['required']) echo 'required="required"'; ?>>
	<option value=""><?=$params['placeholder'];?></option>
	<?php foreach($params['options'] as $k => $v){
		$categoryId = $v['categoryId'];
		$space = '';
		for($i = 0; $i < $v['level']; $i++){
			$space .= '¦----';
	    }
	?>
		<option value="<?=$categoryId?>"
			<?php if(isset($categoryIdSelected[$categoryId])) echo 'selected="selected"'?>>
		<?=$space.$v['name']?>
		</option>
	<?php }?>
</select>
<div class="clear"></div>

<div class="product-category-list">
</div>
<input type="hidden" name="categoryPrimaryId" value="<?=$categoryPrimaryId?>" class="input">

<script type="text/javascript">
	$(document).ready(function(){
		function renderProductCategoryList(categorySelectedList, categoryPrimaryId){
			var html = '';
			for(i in categorySelectedList){
				var categoryId = categorySelectedList[i].categoryId;
				var label = categorySelectedList[i].label;
                var primaryClass = (categoryId == categoryPrimaryId) ? 'primary' : '';
                var isPrimary = (categoryId == categoryPrimaryId) ? '1' : '0';
				html += `<span class='product-category-item ${primaryClass}'
data-product-category='${categoryId}'
data-is-pramary=${isPrimary}>
${label} <i class='fa fa-key product-category-primary' title='Set category primary'>
</i></span>`;
			}
			$('.product-category-list').html(html);
		}
		
		var categorySelectedList = [];
		<?php 
		foreach ($categoryIdSelected as $k => $v){
			echo "categorySelectedList.push({'categoryId': '$k', 'label': '$v'});\n";
		}
		?>
		renderProductCategoryList(categorySelectedList, '<?=$categoryPrimaryId?>');

		function refreshUltraselect(){
            var categorySelectedList = [];
            var i = 0;
            var categoryFirstId = 0;
            var categoryPrimaryId = $('input[name="categoryPrimaryId"]').val();
            var isResetCategoryPrimaryId = true;
            $('.ultraselect').find('.option.checked').each(function(){
                var categoryId = $(this).find('input').val();
                var label = $(this).find('label').text().trim().replace(/¦----/g, '');
                categorySelectedList.push({'categoryId': categoryId, 'label': label});
                if(categoryId == categoryPrimaryId){
                    isResetCategoryPrimaryId = false;
                }
                i++;
                if(i == 1){
                    categoryFirstId = categoryId;
                }
            });
            if(isResetCategoryPrimaryId){
                categoryPrimaryId = categoryFirstId;
                $('input[name="categoryPrimaryId"]').val(categoryPrimaryId);
            }
            renderProductCategoryList(categorySelectedList, categoryPrimaryId);
        }

		$("#<?=$id?>").ultraselect(null, function (el) {
            refreshUltraselect();
		});

		$(document).on('click', '.product-category-primary', function(){
		    //get categoryPrimaryId
		    var categoryPrimaryId = $(this).parents('.product-category-item').data('product-category');
		    //update categoryPrimaryId
            $('input[name="categoryPrimaryId"]').val(categoryPrimaryId);
            //refreshUltraselect
            refreshUltraselect();
        });
	});
</script>