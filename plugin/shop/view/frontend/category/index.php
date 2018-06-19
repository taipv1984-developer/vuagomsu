<?php
$productList = $_REQUEST['productList'];
$productCount = $_REQUEST['productCount'];
$categoryInfo = $_REQUEST['categoryInfo'];

//get params
$page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$orderBy = (isset($_REQUEST['orderBy'])) ? $_REQUEST['orderBy'] : '';
$limit = (isset($_REQUEST['limit'])) ? $_REQUEST['limit'] : 0;
?>
<!-- categoryId = <?=$categoryInfo->categoryId?> -->
<div class="category-products products">
    <div class="sortPagiBar">
        <div class="row">
            <div class="col-xs-6 col-sm-4 text-xs-left">
                <form class="form-inline form-viewpro">
                    <div class="form-group">
                        <span>Sắp xếp: </span>
                        <select class="form-control sort_by_action">
                            <option value="default">Mặc định</option>
                            <option value="name_asc" <?= ($_REQUEST['orderBy'] == 'name_asc') ? 'selected' : ''?>>Tên A-Z</option>
                            <option value="name_desc" <?= ($_REQUEST['orderBy'] == 'name_desc') ? 'selected' : ''?>>Tên Z-A</option>
                            <option value="id_asc" <?= ($_REQUEST['orderBy'] == 'id_asc') ? 'selected' : ''?>>Cũ đến mới</option>
                            <option value="id_desc" <?= ($_REQUEST['orderBy'] == 'id_desc') ? 'selected' : ''?>>Mới đến cũ</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-xs-6 col-md-8 text-xs-left text-sm-right">
                <!-- paging -->
                <?php TemplateHelper::getTemplate('common/paging.php')?>
            </div>
        </div>
    </div>
    <section class="products-view products-view-grid">
        <div class="row">
            <?php
            if(count($productList) > 0){
                foreach ($productList as $v){

                    ?>
                    <div class="col-xs-6 col-sm-3 col-lg-3">
                        <?php TemplateHelper::renderProductItem('product_box_item', $v)?>
                    </div>
                <?php }
            } else {
                ?>
                <div class="col-md-12 data_empty">
                    Không có dữ liệu
                </div>
            <?php }?>
        </div>
    </section>
    <div class="row">
        <div class="col-xs-6 col-md-8 text-sm-right right">
            <!-- paging -->
            <?php TemplateHelper::getTemplate('common/paging.php')?>
        </div>
    </div>
</div>

<!-- order_by action -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.sort_by_action').change(function(){
            var orderBy = $(this).val();
            var url = '<?php echo URLHelper::getPadingPage($page, '', $limit)?>';
            //orderBy
            url += '&orderBy='+orderBy;
            //redirect url
            window.location = url;
            return false;
        });
    });
</script>