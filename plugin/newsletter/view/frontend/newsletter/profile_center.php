<?php $profileNewsletter = $_REQUEST['profileNewsletter']?>
<form name="profile_center" method="post" action="" id="profile_center">
	<input type="hidden" name="random_profile" id="random_profile">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="tableHeader">
		<tbody>
			<tr>
				<td class="tdHeader"><img src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/Logo.aspx" style="border-width: 0px;"></td>
			</tr>
		</tbody>
	</table>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tbody>
			<tr>
				<td width="160" style="border-right: 1px solid #999999; background-color: #F1F1F1; padding: 2px" valign="top">
					<table cellpadding="2" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td class="tdTlbr selTlbr" onmouseover="this.style.border=&#39;1px solid #999999&#39;; this.style.backgroundColor=&#39;#CCCCCC&#39;; this.style.padding=&#39;2px 2px 2px 4px&#39;" onmouseout="this.style.border=&#39;0px&#39;; this.style.backgroundColor=&#39;#F1F1F1&#39;; this.style.padding=&#39;3px 3px 3px 5px&#39;"><?php echo e("Profile Center")?></td>
							</tr>
							<tr>
								<td class="tdTlbr unSelTlbr" onmouseover="this.style.border=&#39;1px solid #999999&#39;; this.style.backgroundColor=&#39;#CCCCCC&#39;; this.style.padding=&#39;2px 2px 2px 4px&#39;" onmouseout="this.style.border=&#39;0px&#39;; this.style.backgroundColor=&#39;#F1F1F1&#39;; this.style.padding=&#39;3px 3px 3px 5px&#39;"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class="tdTlbr unSelTlbr" onmouseover="this.style.border=&#39;1px solid #999999&#39;; this.style.backgroundColor=&#39;#CCCCCC&#39;; this.style.padding=&#39;2px 2px 2px 4px&#39;" onmouseout="this.style.border=&#39;0px&#39;; this.style.backgroundColor=&#39;#F1F1F1&#39;; this.style.padding=&#39;3px 3px 3px 5px&#39;"><a href=""><?php echo e("Help")?></a></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td valign="top">
					<div class="divSiteTitle"><?php echo e("Profile Center")?></div>
					<table cellpadding="20" cellspacing="0" border="0" width="100%" style="margin-top: 10px">
						<tbody>
							<tr>
								<td class="tdContentBody">
									<table cellspacing="0" cellpadding="0" width="100%" border="0">
										<tbody>
											<tr>
												<td><?php echo e("Welcome to your subscriber profile page")?>. <?php echo e("You may use this page at any time to change or update the information you have provided us")?>.</td>
											</tr>
											<tr>
												<td><br> <b><?php echo e("On This Page")?></b></td>
											</tr>
											<tr class="anchor_list">
												<td>&nbsp;<img src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/arrow_px_down.gif">&nbsp;&nbsp;<a href="#"><?php echo e("My Personal Information")?></a></td>
											</tr>
											<tr class="anchor_list">
												<td>&nbsp;<img src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/arrow_px_down.gif">&nbsp;&nbsp;<a href="#"><?php echo e("Unsubscribe From All")?></a></td>
											</tr>
											<tr>
												<td class="tdInfoDefaultBtwSection">&nbsp;</td>
											</tr>
											<tr>
												<td class="tdInfoDefaultBtwSection">&nbsp;</td>
											</tr>
										</tbody>
									</table>
									<table cellspacing="0" cellpadding="0" width="100%" border="0">
										<tbody>
											<tr>
												<td>
													<table cellspacing="0" cellpadding="0" width="100%" border="0">
														<tbody>
															<tr>
																<td class="trSectionHeading" align="left" width="1"><img height="20" src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/bar-end_left.gif" width="2"></td>
																<td class="SectionHeading"><a name="PerInfo"></a><b><?php echo e("My Personal Information")?></b></td>
																<td class="trSectionHeading" align="right" width="1"><img height="20" src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/bar-end_right.gif" width="2"></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td class="tdIndent1"><?php echo e("Add or edit your personal information here. Once you have made changes to your information")?>, <?php echo e("click the")?> <b><?php echo e("Update")?></b> <?php echo e("button")?>.
												</td>
											</tr>
											<tr>
												<td class="tdSpacerAFSecHeading">&nbsp;</td>
											</tr>
											<tr>
												<td class="tdIndent1"><div style="padding-bottom: 5px;">
														<span class="Asterisk">*</span> <?php echo e("Indicates a required field")?>
													</div>
													<table cellpadding="0" cellspacing="0" border="0">
														<tbody>
															<tr title="System default for subscribers email address">
																<td class="tdAttribName" nowrap="nowrap"><?php echo e("Email Address")?>:</td>
																<td class="tdAttribValue" nowrap="nowrap"><input name="email" type="text" id="email" size="40" maxlength="100" disabled="disabled" value="<?php echo $profileNewsletter->email?>"></td>
															</tr>
														</tbody>
													</table></td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
											<tr>
												<td class="tdIndent1"><input name="_ctl19" type="button" class="buttontext" value="Update"></td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
											<tr>
												<td><img height="9" src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/arrow_px_up.gif" width="7" border="0">&nbsp;<a class="TopOfPage" href="#"><?php echo e("Top of Page")?></a></td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
										</tbody>
									</table>
									<table cellspacing="0" cellpadding="0" width="100%" border="0">
										<tbody>
											<tr>
												<td>
													<table cellspacing="0" cellpadding="0" width="100%" border="0">
														<tbody>
															<tr>
																<td class="trSectionHeading" align="left" width="1"><img height="20" src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/bar-end_left.gif" width="2"></td>
																<td class="SectionHeading"><a name="UnsubAll"></a><b><?php echo e("Unsubscribe From All")?></b></td>
																<td class="trSectionHeading" align="right" width="1"><img height="20" src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/bar-end_right.gif" width="2"></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td><span><?php echo e("If you wish to unsubscribe from ALL publications from")?> <span style="color: #555555;"><b><?php echo Registry::getSetting("site_name")?></b></span>, <?php echo e("check the box and click the update button below")?>.
												</span></td>
											</tr>
											<tr>
												<td class="tdSpacerAFSecHeading">&nbsp;</td>
											</tr>
											<tr>
												<td class="tdIndent1"><table cellpadding="0" cellspacing="0" border="0">
														<tbody>
															<tr>
																<td class="tdListCheck"><input name="subscribe" type="checkbox" id="subscribe" <?php if ($profileNewsletter->subscribe=="N"){echo 'checked="checked"';}?>></td>
																<td class="tdListInfo"><?php echo e("I no longer wish to receive any future publications")?>.</td>
															</tr>
														</tbody>
													</table></td>
											</tr>
											<tr>
												<td class="tdIndent1"></td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
											<tr>
												<td class="tdIndent1"><input name="_ctl19" type="button" class="buttontext" value="Update"></td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
											<tr>
												<td><img src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/arrow_px_up.gif" border="0">&nbsp;<a class="TopOfPage" href="#"><?php echo e("Top of Page")?></a></td>
											</tr>
											<tr>
												<td class="tdSpacerBtwText_Button">&nbsp;</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
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
<div class="igtranslator-main-div" style="display: none; width: 0px; height: 0px;">
	<iframe src="<?php echo URLHelper::getBaseUrl()."/"?>resource/frontend/unscribe/saved_resource.html" class="igtranslator-iframe" scrolling="no" frameborder="0"></iframe>
</div>
<script type="text/javascript">
	$(".buttontext").click(function(){
		var formData = $("#profile_center").serializeArray();
		$.ajax({
			type : 'POST',
			url : '<?php echo URLHelper::getUrl('home/newsletter/profile_center')?>',
			data : formData,
			complete : function() {
			},
			success : function(data) {
				var data = jQuery.parseJSON(data);
				// console.log(data);
				if (data.errorCode == 'ACTION_ERROR') {
					alert(data['action_errors']);
				} else if (data.errorCode == 'SUCCESS') {
					window.location.reload();
				} else if (data.errorCode == 'FIELD_ERROR') {
					
				}
			}
		});
	})
</script>