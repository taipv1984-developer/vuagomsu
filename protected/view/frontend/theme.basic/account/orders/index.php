<div class="account-page">
	<div class="col-md-9 content-left">
		<article>
			<?php 
				if(isset($_REQUEST['orderId'])){
					include 'detail.php';
				}
				else{
					include 'list.php';
				}
			?>
		</article>
	</div>
	
	<div class="col-md-3 content-right">
        <?php TemplateHelper::getTemplate('account/common/account_navigation.php'); ?>
	</div>
</div>
<div class="clear"></div>

<?php 
	$popup_message = Session::getSession('popup_message');
	if($popup_message){
?>
<script type="text/javascript">
	$(document).ready(function(){
		//message
		show_notice('<?=$popup_message?>');
	});
</script>
<?php }
	session::deleteSession('popup_message');
?>