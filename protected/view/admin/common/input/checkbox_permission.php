<?php include '_params.php'?>
<?php
	$permission = $params['permission'];
	$permissionGroup = $params['permissionGroup'];
?>
<div class='select_checkbox_form'>
    <ul>
        <?php
        $countAll = array();
        foreach ($permissionGroup as $k => $v) {
            $count = count($v);
            if ($count > 0) {
                ?>
                <li>
                    <label style='font-weight: bold; margin: 5px 0;'>
                        <?=$k; ?> (<?=$count ?>)
                    </label>
                </li>
                <?php
                foreach ($v as $key => $value) {
                    $exp = explode('/', $value['action']);
                    $add_class = $exp[0];
                    $countAll["$add_class"][] = 1;
                    $id = "select_checkbox_form_".str_replace('/', '_', $value['action']);
                    ?>
                    <li class='<?=$add_class ?>'>
                        <input type="checkbox" name="<?=$params['name'] ?>"
                               value="<?=$value['action'] ?>" class='checkbox'
                            <?php if (in_array($value['action'], $permission)) {
                                echo 'checked="checked"';
                            } ?>
                            id="<?=$id?>"
                        >
                        <label class="checkbox-inline" for="<?=$id?>">
                            <?=$value['action_name'] ?>
                            <span style='margin-left: 5px; color: brown;'>[<?=$value['action'] ?>]</span>
                        </label>
                    </li>
                <?php }    //end foreach
            }//end if
        }//end foreach
        ?>
    </ul>
    <div class='clear'></div>
    <a id='select_all' class='blue'><?=e('Select All') ?></a> |
    <a id='select_all_backend'><?=e('Select All Backend') ?> (<?=count($countAll["admin"]) ?>)</a> |
    <a id='select_all_frontend'><?=e('Select All Frontend') ?> (<?=count($countAll["home"]) ?>)</a> |
    <a id='un_select_all' class='red'><?=e('UnSelect All') ?></a>
    <?php if (isset($params['help'])) { ?>
        <span class="help-block"><?=$params['help'] ?></span>
    <?php } ?>
</div>

<script type="text/javascript">
	$().ready(function(){
		$('#select_all').click(function(){
			$('li .checkbox').each(function(){
				$(this).prop('checked', true);
			});
		});
		$('#un_select_all').click(function(){
			$('li .checkbox').each(function(){
				$(this).prop('checked', false);
			});
		});

		//admin
		$('#select_all_backend').click(function(){
			$('li .checkbox').each(function(){
				$(this).prop('checked', false);
			});
			$('li.admin .checkbox').each(function(){
				$(this).prop('checked', true);
			});
		});

		//home
		$('#select_all_frontend').click(function(){
			$('li .checkbox').each(function(){
				$(this).prop('checked', false);
			});
			$('li.home .checkbox').each(function(){
				$(this).prop('checked', true);
			});
		});
	});
</script>