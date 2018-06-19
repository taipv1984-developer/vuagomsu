<?php
	//get data
	$orderDone = Session::getSession('orderDone');
	//delete session
	Session::deleteSession('orderDone');
?>
<?php
    $isMobile = Session::getSession('isMobile');
    if($isMobile){
?>
    <section id="content" ui-view="content" class="ng-scope">
        <div class="container-fluid ng-scope">
            <div class="alert alert-success">
                <?=Registry::getSetting('checkout_done_message_mobile')?>
            </div>

            <div class="col-md-6 col-left">
                <a href="<?=URLHelper::getBaseUrl()?>" class="btn btn-primary" title="Quay về trang chủ">
                    <i class="fa fa-home"></i>
                    Quay về trang chủ
                </a>
            </div>
        </div>
    </section>
<?php } else { //desktop ?>
    <div class="checkout_done margin-top-10 margin-bottom-10">
        <?=Registry::getSetting('checkout_done_message')?>
    </div>
    <div class="clear"></div>

    <div class="col-md-6 col-left">
        <a href="<?=URLHelper::getBaseUrl()?>" class="btn btn-primary" title="Quay về trang chủ">
            <i class="fa fa-home"></i>
            Quay về trang chủ
        </a>
    </div>

    <div class="clear margin-bottom-10"></div>
<?php }?>