<?php
$newsCategoryInfo = $_REQUEST['newsCategoryInfo'];
$newsCategoryList = $_REQUEST['newsCategoryList'];
$seoInfo = $_REQUEST['seoInfo'];
?>

<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
    <div class="portlet light">
        <?php
        $toolbar = new ToolBarHelper();
        $toolbar->addButtonBack(array('btn_back.php'));
        if (!$_REQUEST['newsCategoryId']) {
            $toolbar->addTitle('add', e('Add news category'));
        } else {
            $toolbar->addTitle('edit', e('Edit news category'));
        }
        $toolbar->addButtonRight(array('btn_save_and_close.php'));
        $toolbar->showToolBar();
        ?>

        <?php
        TemplateHelper::getTemplate('common/tabs.php', array(
            '1' => array('id' => '1_1', 'name' => e('Overview')),
            '2' => array('id' => '1_2', 'name' => e('Seo')),
        ))
        ?>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <?php
                //default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
                //add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
                $settingForm = array(
                    'name' => array('required' => true),
                    'parent_id' => array('type' => 'select_category', 'mode' => 'edit',
                        'value' => $newsCategoryInfo->parentId, 'options' => $newsCategoryList, 'label' => 'Parent'),
                    'image' => array('type' => 'file', 'value' => $newsCategoryInfo->image, 'action' => true),
                    'status' => array('type' => 'select', 'row_class' => 'hide',
                        'value' => $newsCategoryInfo->status, 'options' => ArrayHelper::getAD()),
                );
                $settingValue = $newsCategoryInfo;
                $settingAll = array(
                    'model' => 'newsCategoryModel'
                );

                //render setting from
                TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);

                ?>
            </div>
            <div class="tab-pane" id="tab_1_2">
                <?php
                $settingForm = array(
                    'title' => array(),
                    'meta_keyword' => array(),
                    'meta_description' => array(),
                );
                $settingValue = $seoInfo;
                $settingAll = array('model' => 'seoModel');

                //render setting from
                TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
                ?>
            </div>
        </div>
    </div>
</form>

<!-- validate ajax form -->
<script type="text/javascript">
    $(document).ready(function () {
        $("form").submit(function (event) {		//required
            var url = "index.php?r=admin/news_category/validate_ajax";
            <?php if(!$_REQUEST['newsCategoryId']){ ?>
            var action = 'add';
            <?php } else {?>
            var action = 'edit';
            <?php }?>
            var name = $('input[name="newsCategoryModel.name"]').val();
            var parentId = $('select[name="newsCategoryModel.parentId"]').val();
            var newsCategoryId = '<?=$newsCategoryInfo->newsCategoryId?>';

            $.ajax({
                type: 'post',
                url: url,
                data: {'action': action, 'name': name, 'parentId': parentId, 'newsCategoryId': newsCategoryId},
                async: false,
                complete: function () {
                },
                success: function (data) {
                    if (data) {	//validate message
                        data = JSON.parse(data);
                        console.log(data);

                        //reset validate
                        $('.input').removeClass('validate_error');
                        $('.input').parent().find('.validate_message').html('');

                        for (name in data) {
                            var message = data[name];
                            $('.input[name="' + name + '"]').addClass('validate_error');
                            $('.input[name="' + name + '"]').parent().find('.validate_message').html(message);
                        }
                        event.preventDefault();	//required

                        //notice error
                        show_notice_error('Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
                    }
                }
            });
        });
    });
</script>