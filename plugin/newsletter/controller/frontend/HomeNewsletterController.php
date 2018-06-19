<?php

class HomeNewsletterController extends Controller
{
    private $newsletterDao;

    function __construct()
    {
        $this->newsletterDao = new NewsletterDao ();
    }

    //OK
    private function submitNewsletterValidate()
    {
        $validate = array();

        //get data
        $emailNewsletter = $_REQUEST['emailNewsletter'];

        //check email exist
        $newsletterVo = new NewsletterVo ();
        $newsletterVo->email = $emailNewsletter;
        $newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo);
        if ($newsletterVos) {
            $validate["emailNewsletter"] = e("You email already subcribed!");
        }

        return $validate;
    }

    public function submitNewsletter()
    {
        $validate = $this->submitNewsletterValidate();
        if (empty($validate)) {
            $newsletterVo = new NewsletterVo ();
            $newsletterVo->email = $_REQUEST['emailNewsletter'];
            $newsletterVo->subscribe = 1;
            $newsletterVo->crtBy = (Session::isCustomerLogin()) ? Session::getCustomerId() : 0;
            $newsletterVo->crtDate = DateHelper::getDateTime();
            $this->newsletterDao->insert($newsletterVo);
        } else {
            echo json_encode($validate);
        }
        return $this->setRender('success');
    }

    public function submitNewsletterSendEmail()
    {
        // send newsletter email
        $to = $_REQUEST['emailNewsletter'];
        $emailData = array(
            'company' => Registry::getSetting('company_name'),
            'address' => Registry::getSetting('company_address'),
            'phone' => Registry::getSetting('company_phone'),
            'email' => Registry::getSetting('company_email'),
            'website' => Registry::getSetting('base_url'),
        );
        EmailHelper::sendMail($to, 'newsletter_submit', $emailData);
        return $this->setRender('success');
    }

    public function unsubscribe()
    {
        // select profile
        $newsletterVo = new NewsletterVo ();
        $newsletterVo->randomProfile = $_REQUEST ['random_profile'];
        $newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo);
        // unscribe
        $newsletterVos [0]->subscribe = "N";
        $newsletterVos [0]->modBy = CTTHelper::isEmptyString(Session::getCustomerId()) ? Session::getSession("clientIP") : Session::getCustomerId();
        $newsletterVos [0]->modDate = DateHelper::getDateTime();
        $this->newsletterDao->updateByPrimaryKey($newsletterVos [0], $newsletterVos [0]->newsletterId);
        return $this->setRender('success');
    }

    public function resubscribe()
    {
        // select profile
        $newsletterVo = new NewsletterVo ();
        $newsletterVo->randomProfile = $_REQUEST ['random_profile'];
        $newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo);
        // rescribe
        $newsletterVos [0]->subscribe = "Y";
        $newsletterVos [0]->modBy = CTTHelper::isEmptyString(Session::getCustomerId()) ? Session::getSession("clientIP") : Session::getCustomerId();
        $newsletterVos [0]->modDate = DateHelper::getDateTime();
        $this->newsletterDao->updateByPrimaryKey($newsletterVos [0], $newsletterVos [0]->newsletterId);
        return $this->setRender('success');
    }

    public function showProfile()
    {
        // select profile
        $newsletterVo = new NewsletterVo ();
        $newsletterVo->randomProfile = $_REQUEST ['random_profile'];
        $newsletterVos = $this->newsletterDao->selectByFilter($newsletterVo);
        $this->setAttributes(array(
            'profileNewsletter' => $newsletterVos [0]
        ));
        return $this->setRender('success');
    }

    /****************************************
     * POPUP
     ****************************************/
    public function popupShow()
    {
        //check $newsletterPopup
        $newsletterPopup = Session::getSession('newsletterPopup', true);
//        $newsletterPopup = true;
        $data = array(
            'newsletterPopup' => $newsletterPopup
        );
        //show one
        Session::setSession('newsletterPopup', false);
        //send data
        echo json_encode($data);
        return $this->setRender('success');
    }
}