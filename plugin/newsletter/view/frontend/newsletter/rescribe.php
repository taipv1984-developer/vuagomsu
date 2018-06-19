<form name="_objForm" method="post" action="" id="_objForm">
	<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value=""> <input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value=""> <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="Ewor2CWz5NLTRcoibL12bewbdlaGbQWvpJAbHUz3xXXDEKw3XJ5sk/4nOG2RhQT8LJ7rS2yq+vQtwt0eyfQTS44jwO4=">
	<table cellpadding="5" cellspacing="0" border="0" width="100%" class="tableHeader">
		<tbody>
			<tr>
				<td class="tdHeader"><img src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/Logo.aspx" style="border-width: 0px;"></td>
			</tr>
		</tbody>
	</table>
	<table cellpadding="2" cellspacing="0" border="0" width="100%">
		<tbody>
			<tr>
				<td class="tdContentBody" style="padding-bottom: 50px">
					<h1 style="margin-top: 20px"><?php echo e("Thank You")?>!</h1> <?php echo e("You have been resubscribed to emails from")?> <span style="color: #555555;"><b><?php echo Registry::getSetting("site_name")?></b></span>.
					<ul>
						<li><?php echo e("To view and edit the information you have given us and manage how")?> <span style="color: #555555;"><b><?php echo Registry::getSetting("site_name")?></b></span> <?php echo e("communicates with you")?>, <?php echo e("visit the")?> <a href="<?php echo URLHelper::getUrl("home/newsletter/profile_center",array('random_profile'=>$_REQUEST['random_profile']))?>"><?php echo ("Profile Center")?></a></li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
	<table cellpadding="5" cellspacing="0" border="0" width="100%">
		<tbody>
			<tr>
				<td class="tdFooter">&nbsp;</td>
			</tr>
		</tbody>
	</table>
</form>
<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="EBEECCE8">
<div class="igtranslator-main-div" style="display: none; width: 0px; height: 0px;">
	<iframe src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/saved_resource.html" class="igtranslator-iframe" scrolling="no" frameborder="0"></iframe>
</div>