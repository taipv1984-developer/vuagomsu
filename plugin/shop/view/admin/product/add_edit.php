<?php  
	$productInfo = $_REQUEST['productInfo'];
	$categoryList = $_REQUEST['categoryList'];
	$categoryProduct = $_REQUEST['categoryProduct'];
    $categoryPrimaryId = $_REQUEST['categoryPrimaryId'];
    $productTagSelected = $_REQUEST['productTagSelected'];
    $productTagList = $_REQUEST['productTagList'];
    $seoInfo = $_REQUEST['seoInfo'];
?>

<div class="row">
	<form class="form-horizontal form-row-seperated" action="" method="post" enctype="multipart/form-data">
		<div class="portlet light">
			<?php
			$toolbar = new ToolBarHelper();

			$toolbar->addButtonBack(array('btn_back.php'));
			if(!isset($_REQUEST['productId'])){
                $toolbar->addTitle('edit', e('Add Product'));
                $toolbar->addButtonExtra(array(
                        array('title' => e('Add'), 'js' => 'addProduct()'),
                        array('title' => e('Add and close'), 'js' => 'addProduct(`admin/product/manage`)'),
                    )
                );
			}
			else{
                $toolbar->addTitle('edit', e('Edit Product'));
                $toolbar->addButtonExtra(array(
                        array('title' => e('Edit'), 'js' => 'editProduct()'),
                        array('title' => e('Edit and close'), 'js' => 'editProduct(`admin/product/manage`)'),
                    )
                );
			}
			$toolbar->showToolBar();
			?>
			<div class="portlet-body">
				<div class="tabbable">
				<?php 
					TemplateHelper::getTemplate('common/tabs.php', array(
						array('id' => 'general', 'name' => e('General'), 'active' => true),
						array('id' => 'images', 'name' => e('Images')),
						array('id' => 'extension', 'name' => e('Extension')),
                        array('id' => 'seo', 'name' => e('SEO')),
					))
				?>
                        
				<!-- start wrap content -->                        
				<div class="tab-content">
					<div class="tab-pane active" id="tab_general">
						<div class="portlet-body">
							<?php
								//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
								//add option (class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
								$settingForm = array(
                                    'productId' => array('type' => 'hidden'),
									'name'			=> array('required' => true),
//									'code'			=> array(),
									'category_id'	=> array('type' => 'ultraselect_category', 'label' => 'Category', 'name' => 'category_id[]', 'mode' => 'edit',
											'value' => $categoryProduct, 'options' => $categoryList, 'categoryPrimaryId' => $categoryPrimaryId),
									'price'			=> array('class' => 'price bold red', 'label'=> 'Price ('.CurrencyExt::get_currency('symbol').')'),
									'sale_of'			=> array('class' => 'price', 'label'=> 'Sale of ('.CurrencyExt::get_currency('symbol').')'),
// 									'amount'		=> array('type' => 'number', 'required' => true),
//                                    'unit'		=> array('type' => 'select', 'value' => $productInfo->unit,
//                                        'options' => ApplicationConfigHelper::get('product.unit.list')),
                                    'product_tag'	=> array('type' => 'product_tag', 'label' => 'Product tags',
                                        'product_tag_list' => $productTagList, 'product_tag_selected' => $productTagSelected,
                                        'option' => isset($_REQUEST['productId']) ? 'edit' : 'add'),
                                    'image_primary'	=> array('type' => 'file', 'value' => $productInfo->image, 'action' => true),
									'description'	=> array('type' => 'textarea',  'class' => 'ckeditor_content'),
                                    'status'		=> array('type' => 'select', 'value' => $productInfo->status, 'options' => ArrayHelper::getAD()),
								);
								$settingValue = $productInfo;
								$settingAll = array(
									'model' => 'productModel'
								);
								
								//render setting from
								TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
							?>
						</div>
					</div>
					<!-- end tab_general-->

					<div class="tab-pane" id="tab_images">
						<div class="portlet-body" id="multiImages">
							<?php
								TemplateHelper::getTemplate('common/input/file.php', array(
									'imageList'=> $productInfo->imageAttach,
									'option' => 'list',
									'action' => true
								));
							?>
						</div>
					</div>
					<!-- end tab_images-->
					
					<div class="tab-pane _active" id="tab_extension">
						<?php include 'extension/extension.php';?>
					</div>
					<!-- end tab_extension-->

                    <!-- start tab_seo-->
                    <div class="tab-pane" id="tab_seo">
                        <div class="portlet-body" id="seo">
                            <?php
                            $settingForm = array(
	                            'title' => array('label' => 'Meta Title',
		                            'name' => "title",
	                            ),
	                            'keyword' => array('label' => 'Meta Keyword',
		                            'name' => "keyword",
	                            ),
	                            'description' => array('label' => 'Meta Description',
		                            'name' => "description",
	                            ),
                            );
                            $settingValue =$seoInfo;
                            $settingAll = array('model' => 'seoModel');

                            //render setting from
                            TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
                            ?>
                        </div>
                    </div>
                    <!-- end tab_seo-->
				</div>       
				<!-- end wrap content -->                 
            </div>
		</div>
    </form>
</div>

<!-- validate ajax form -->
<script type="text/javascript">
// 	//update attributeValue input
// 	function pre_submit(){
// 		$('.attributeValue').each(function(){
// 			//set attributeValue by chosen-choices
// 			var attributeId = $(this).parents('.panel_content').find('.attributeId').val();
// 			var attributeTextSelected = [];
// 			$('#accordion_group_' +attributeId+ ' .chosen-choices .search-choice').each(function(){
// 				var text = $(this).text().trim();
// 				attributeTextSelected.push(text);
// 			});
// 			$('#accordion_group_' +attributeId).find('.value_group input.attributeValue').val(attributeTextSelected.join('|'));
// 		});

// 		//set image_list of attribute (type=image) by attribute_item_image_list
// 		$('.attribute_item_image').each(function(){
// 			var id = $(this).attr('id');
// 			var attributeId = id.replace('attribute_item_image_', '');
// 			var imageList = [];
// 			$('#attribute_item_image_' +attributeId+ ' .image_list_data .input_file_preview .image_source').each(function(){
// 				var val = $(this).val();
//				val = val.replace('<?php //echo Registry::getSetting('base_url')?>/', '');
//				val = val.replace('<?php //echo Registry::getSetting('no_image')?>', '').trim();
// 				if(val !== ''){
// 					imageList.push(val);
// 				}
// 			});
// 			$('#attribute_item_image_' +attributeId).find('.image_list_value').val(imageList.join("\n"));
// 		});
// 	}

function editProduct(redirectTo='') {
    $.ajax({
        type: 'post',
        url: "<?=URLHelper::getUrl('admin/product/edit')?>",
        data: $('form').serialize(),
        async: false,
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            if (data['status'] == 'ERROR') {
                validateForm(data['message']);
                show_notice_error('Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
            }
            else {
                if(redirectTo != ''){
                    location.href = `<?=Registry::getSetting('base_url')?>/index.php?r=${redirectTo}`;
                }
                else{
                    resetValidateForm();
                    show_notice(data['message']);
                }
            }
        }
    });
}

function addProduct(redirectTo='') {
    $.ajax({
        type: 'post',
        url: "<?=URLHelper::getUrl('admin/product/add')?>",
        data: $('form').serialize(),
        async: false,
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            if (data['status'] == 'ERROR') {
                validateForm(data['message']);
                show_notice_error('Nhập dữ liệu không đúng, vui lòng kiểm tra lại');
            }
            else {
                if(redirectTo != ''){
                    location.href = `<?=Registry::getSetting('base_url')?>/index.php?r=${redirectTo}`;
                }
                else{
                    var productId = data['extra']['productId'];
                    location.href = `<?=Registry::getSetting('base_url')?>/index.php?r=admin/product/edit/view&productId=${productId}`;
                }
            }
        }
    });
}
</script>