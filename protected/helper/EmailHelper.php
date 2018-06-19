<?php

class EmailHelper {
    /**
     * vdatosolutions@gmail.com, kbefitness.smtp@gmail.com
     * datodemo, kbefitness123
     */
    public static function test($email = 'vdatosolutions@gmail.com', $password = 'datodemo') {
        require_once PHP_MAILER_LIB;

        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 465;//465 | 587
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'ssl';    //ssl | tls
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $email;
        //Password to use for SMTP authentication
        $mail->Password = $password;
        //Set who the message is to be sent from
        $mail->setFrom($email, 'First Last');
        //Set an alternative reply-to address
        // 		$mail->addReplyTo('taipv1984@gmail.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress('taipv1984@gmail.com', 'John Doe');
        //Set the subject line
        $mail->Subject = 'PHPMailer GMail SMTP test';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // 		$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        //Replace the plain text body with one created manually
        $mail->Body = 'This is a plain-text message body';
        //Attach an image file
        $mail->addAttachment('upload/images/product/lips/gloss/large/buttergloss_main.jpg');
        $mail->addAttachment('upload/images/product/lip_pencils/large/ombrelipduo_main.jpg');
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            LogUtil::devInfo('Mailer Error:');
            LogUtil::devInfo($mail->ErrorInfo);
        } else {
            echo "Message sent!";
            LogUtil::devInfo('Message sent!');
        }
    }

    /**
     * send email function parameter get from setting
     *
     * @param string|array $to email address receiver
     * @param object $emailTemplateInfo (emailTemplateVo)
     * @param array $data use repalce tempalte
     */
    public static function sendMail($emailTo, $emailTemplateKey, $emailData = array(), $sendToAdmin = true) {
        //check condition
        $email_send_allow = Registry::getSetting('email_send_allow');
        if (!$email_send_allow) {
            return;
        }

        //config email
        $email_method = Registry::getSetting('email_method');
        switch ($email_method){
            case 'smtp':
                self::sendMailBySMTP($emailTo, $emailTemplateKey, $emailData);
                break;
            case 'mail':
                self::sendMailByMail($emailTo, $emailTemplateKey, $emailData);
                break;
        }

        //send email to admin
        if($sendToAdmin){
            $emailToAdmin = array();
            $sql = "select email from admin";
            $query = DataBaseHelper::query($sql);
            foreach ($query as $v) {
                $emailToAdmin[] = $v->email;
            }
            self::sendMailByMail($emailToAdmin, $emailTemplateKey, $emailData);
        }
    }

    public static function sendMailBySMTP($emailTo, $emailTemplateKey, $emailData) {
        $emailTemplate = EmailTemplateExt::getEmailTemplate($emailTemplateKey);
        if (!$emailTemplate) return;

        require_once PHP_MAILER_LIB;
        $mail = new PHPMailer();    // create a new object
        $mail->CharSet = "utf8";
        $mail->IsSMTP();            // enable SMTP
        $mail->SMTPDebug = 0;        // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = Registry::getSetting('smtp_auth');        // authentication enabled						1
        $mail->SMTPSecure = Registry::getSetting('smtp_secure');    // secure transfer enabled REQUIRED for GMail	ssl
        $mail->Host = Registry::getSetting('smtp_host');
        $mail->Port = Registry::getSetting('smtp_port');
        $mail->Username = Registry::getSetting('smtp_user');
        $mail->Password = Registry::getSetting('smtp_pwd');
        $mail->setFrom(Registry::getSetting('from_email_address'), Registry::getSetting('site_name'));
        $mail->isHTML();

        //set $subject and $template
        if (!is_array($emailTo)) $emailTo = array($emailTo);
        foreach ($emailTo as $email) {
            $mail->addAddress($email);
        }
        //set data replace from data
        $replace = array();
        foreach ($emailData as $k => $v) {
            $replace["{" . $k . "}"] = $v;
        }

        //set email content
        $mail->Subject = $emailTemplate->subject;
        $mail->Body = strtr($emailTemplate->content, $replace);
        if (isset($emailData['attachment'])) {
            foreach ($emailData['attachment'] as $v) {
                $mail->addAttachment($v, URLHelper::getImageName($v));
            }
        }

        //send email
        if (!$mail->Send()) {
            LogUtil::devInfo("---sendMail error to ---" . join(', ', $emailTo));
            LogUtil::devInfo($mail->ErrorInfo);
            return;
        } else {
            LogUtil::devInfo("---sendMail sucess to--- " . join(', ', $emailTo));
        }
    }

    public static function sendMailByMail($emailTo, $emailTemplateKey, $emailData) {
        $emailTemplate = EmailTemplateExt::getEmailTemplate($emailTemplateKey);
        if (!$emailTemplate) return;

        if (!is_array($emailTo)) $emailTo = array($emailTo);
        foreach ($emailTo as $email) {
            //set data replace from data
            $replace = array();
            foreach ($emailData as $k => $v) {
                $replace["{" . $k . "}"] = $v;
            }

            //set email content
            $subject = $emailTemplate->subject;
            $body = strtr($emailTemplate->content, $replace);

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $baseUrl = Registry::getSetting('base_url');
            $from = str_replace('http://', '', str_replace('https://', '', $baseUrl));

            //send email
            mail($email, $subject, $body, $headers, "-f " . $from);
        }
    }

    public static function sendNewsletterMail($to, $emailTemplateKey, $data = array()) {
        $emailTemplate = EmailTemplateExt::getNewsletterEmailTemplate($emailTemplateKey);
        if (!$emailTemplate) return;

        //check condition
        $email_send_allow = Registry::getSetting('email_send_allow');
        if (!$email_send_allow) {
            return;
        }

        //config email
        $email_method = Registry::getSetting('email_method');
        if ($email_method == 'smtp') {
            require_once PHP_MAILER_LIB;
            $mail = new PHPMailer();    // create a new object
            $mail->IsSMTP();            // enable SMTP
            $mail->SMTPDebug = 0;        // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = Registry::getSetting('smtp_auth');        // authentication enabled						1
            $mail->SMTPSecure = Registry::getSetting('smtp_secure');    // secure transfer enabled REQUIRED for GMail	ssl
            $mail->Host = Registry::getSetting('smtp_host');
            $mail->Port = Registry::getSetting('smtp_port');
            $mail->Username = Registry::getSetting('smtp_user');
            $mail->Password = Registry::getSetting('smtp_pwd');
            $mail->setFrom(Registry::getSetting('from_email_address'), Registry::getSetting('site_name'));
            $mail->isHTML();

            //set $subject and $template
            if (!is_array($to)) $to = array($to);
            foreach ($to as $value) {
                $mail->addAddress($value);
            }
            //set data replace from data
            $replace = array();
            foreach ($data as $k => $v) {
                $replace["{" . $k . "}"] = $v;
            }

            //set email content
            $mail->Subject = $emailTemplate->subject;
            $mail->Body = strtr($emailTemplate->content, $replace);
            if (isset($data['attachment'])) {
                foreach ($data['attachment'] as $v) {
                    $mail->addAttachment($v, URLHelper::getImageName($v));
                }
            }

            //send email
            if (!$mail->Send()) {
                LogUtil::devInfo("---sendNewsletterMail error to ---" . join(', ', $to));
                LogUtil::devInfo($mail->ErrorInfo);
                return;
            } else {
                LogUtil::devInfo("---sendNewsletterMail sucess to--- " . join(', ', $to));
            }
        } else {    //send by mail function (php)
            if (!is_array($to)) $to = array($to);
            foreach ($to as $value) {
                //set data replace from data
                $replace = array();
                foreach ($data as $k => $v) {
                    $replace["{" . $k . "}"] = $v;
                }

                //set email content
                $subject = $emailTemplate->subject;
                $body = strtr($emailTemplate->content, $replace);

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                //send email
                mail($value, $subject, $body, $headers);
            }
        }
        return;
    }
}
