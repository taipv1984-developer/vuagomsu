<?php
class ContactExt{
	public static function addContact(){
        $contactDao = new ContactDao();

        //get data
        $name = trim($_REQUEST['name']);
        $phone = trim($_REQUEST['phone']);
        $email = trim($_REQUEST['email']);
        $region = trim($_REQUEST['region']);
        $moreInfo = trim($_REQUEST['more_info']);
        $crtDate = DateHelper::getDateTime();

        //insert
        $contactVo = new ContactVo();
        $contactVo->name = $name;
        $contactVo->phone = $phone;
        $contactVo->email = $email;
        $contactVo->moreInfo = $moreInfo;
        $contactVo->crtBy = 0;
        $contactVo->crtDate = $crtDate;
        $contactVo->status = 'P';
        $contactVo->source = 'O';
        $contactVo->region = $region;
        $contactId = $contactDao->insert($contactVo);

        //send email
        $to = array($email);
        $emailTemplateKey = "contact";
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'moreInfo' => $moreInfo,
            'region' => ArrayHelper::getRegionList()[$region],
            'crtDate' => $crtDate,
        );
        EmailHelper::sendMail($to, $emailTemplateKey, $data);
	}
}