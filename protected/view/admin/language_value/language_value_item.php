<div class="my_row">
    <div class="col-md-12">
    	<b><?=e('Total: %s', $count)?></b>
    </div>
</div>
<div class="my_row">
    <div class="col-md-6">
    	<input type='text' value='<?=$_REQUEST['filterName']?>' class='filterName' placeholder="filter">
    	<i class="fa fa-search filterSearch" title='<?=e('Filter language name')?>'></i>
    </div>
    <div class="col-md-6">
	</div>
</div>
<?php foreach ($languageValue as $k => $v){ ?>
	<div class="my_row">
	    <label class="col-md-6 language_label">
	    	<?=$v?>
	    </label>
	    <div class="col-md-6 language_value">
	    	<input type="hidden" name='languageValue[<?=$k?>][name]' value='<?=$v?>'>
		    <input type="text" name='languageValue[<?=$k?>][value]' value=''>
		</div>
	</div>
<?php } ?>
<p>
<?php TemplateHelper::getTemplate('common/paging.php');?>