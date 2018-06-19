<?php include '_params.php'?>
<?php
$mode = (isset($params['mode']))? $params['mode'] : 'filter';   ///filter or edit
?>
<select class="input table-group-action-input form-control <?=$params['class']?>" name="<?=$params['name']?>"
    <?=$id; ?>
    <?php if($params['required']) echo 'required="required"'; ?>>
    <?php if($mode == 'filter'){
        if(isset($params['placeholder'])){?>
            <option value="" selected><?=$params['placeholder'];?></option>
        <?php }
    } else {?>
        <option value="0" selected></option>
    <?php } ?>
    <?php foreach($params['options'] as $k => $v){
        $space = '';
        for($i = 0; $i < $v['level']; $i++){
            $space .= '¦----';
        }?>
        <option value="<?=$v['id']?>" <?php if($params['value'] == $v['id']){echo 'selected';}?> style='color: #333'>
            <?=$space.$v['name'];?>
        </option>
    <?php }?>
</select>