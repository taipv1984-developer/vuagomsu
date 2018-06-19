<div class="ui-widget-overlay ui-front"></div>
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui_email_signup ui-draggable" tabindex="-1" role="dialog" aria-describedby="dialog-container" aria-labelledby="ui-id-1">
	<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
		<span id="ui-id-1" class="ui-dialog-title"><?php echo e("sign up for email")?></span>
		<button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close" onclick="closeSubmitNewsletter()">
			<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text"><?php echo e("close")?></span>
		</button>
	</div>
	<div id="dialog-container" class="dialog_content ui-dialog-content ui-widget-content">
		<div class="newsletter_subscribe_confirm emailSignupPopup">
			<h1><?php echo e("Thank you for signing up for our mailing list")?></h1>
			<a class="button " id="newsletter_signup_cancelbtn" onclick="closeSubmitNewsletter()"><?php echo e("close")?></a>
		</div>
	</div>
</div>