<div class="btn-group">
    <a class="btn yellow btn-circle" href="javascript:void()" data-toggle="dropdown">
        <i class="fa fa-share"></i> 
        <?=e('More')?>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-right">
        <?php foreach($params as $param){
            if($param['divider'] == 'Y'){
        ?>
            <li class="divider"></li>
        <?php }else{?>
            <li>
                <a href="<?=$param['link']?>">
                    <?=$param['text']?>
                </a>
            </li>
        <?php }}?>
    </ul>
</div>