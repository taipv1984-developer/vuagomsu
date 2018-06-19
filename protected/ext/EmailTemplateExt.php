<?php 
class EmailTemplateExt{
	/**
	 * getEmailTemplate by $emailTemplateKey
	 * 
	 * @param string $emailTemplateKey
	 * @return $emailTemplate object
	 */
	public static function getEmailTemplate($emailTemplateKey){
		$emailTemplateDao = new EmailTemplateDao();
		$emailTemplateVo = new EmailTemplateVo();
		$emailTemplateVo->key = $emailTemplateKey;
		$emailTemplateVos = $emailTemplateDao->selectByFilter($emailTemplateVo);
		if($emailTemplateVos){
			return $emailTemplateVos[0];
		}
		else{
			LogUtil::devInfo("(EmailTemplateExt::getEmailTemplate) not find email_template have key = $emailTemplateKey");
			return false;
		}
	}
	public static function getNewsletterEmailTemplate($emailTemplateKey){
		$newsletterEmailTemplateDao = new NewsletterEmailTemplateDao();
		$newsletterEmailTemplateVo = new NewsletterEmailTemplateVo();
		$newsletterEmailTemplateVo->key = $emailTemplateKey;
		$newsletterEmailTemplateVos = $newsletterEmailTemplateDao->selectByFilter($newsletterEmailTemplateVo);
		if($newsletterEmailTemplateVos){
			return $newsletterEmailTemplateVos[0];
		}
		else{
			LogUtil::devInfo("(EmailTemplateExt::getNewsletterEmailTemplate) not find email_template have key = $emailTemplateKey");
			return false;
		}
	}
}
?>