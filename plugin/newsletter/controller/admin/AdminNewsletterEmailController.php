<?php

class AdminNewsletterEmailController extends Controller
{
    private $newsletterDao;
    private $newsletterEmailDao;
    public $newsletterEmailModel;
    private $pluginCode;

    function __construct()
    {
        $this->newsletterDao = new NewsletterDao();
        $this->newsletterEmailDao = new NewsletterEmailTemplateDao();
        $this->newsletterEmailModel = new NewsletterEmailTemplateModel();

        // get $pluginCode
        $actionControler = get_class($this);
        $pluginCodeMap = Session::getSession('pluginCodeMap');
        $this->pluginCode = (isset ($pluginCodeMap [$actionControler])) ? $pluginCodeMap [$actionControler] : '';
    }

    private function _validate_add($addVo)
    {
        $validate = array();

        // the name should not duplicate in the table
        $newsletterEmailVo = new NewsletterEmailTemplateVo();
        $newsletterEmailVo->key = $addVo->key;
        $newsletterEmailVos = $this->newsletterEmailDao->selectByFilter($newsletterEmailVo);
        if ($newsletterEmailVos) {
            $validate ["newsletterEmailModel.key"] = e("Newsletter key is exist");
        }

        return $validate;
    }

    private function _validate_edit($editVo)
    {
        $validate = array();

        // the name should not duplicate in the table
        $newsletterEmailVo = new NewsletterEmailTemplateVo();
        $newsletterEmailVo->key = $editVo->key;
        $newsletterEmailVos = $this->newsletterEmailDao->selectByFilter($newsletterEmailVo);
        if ($newsletterEmailVos) {
            $newsletter = $newsletterEmailVos [0];
            if ($newsletter->Array != $editVo->Array) {
                $validate ["newsletterEmailModel.key"] = e("Newsletter key is exist");
            }
        }

        return $validate;
    }

    private function _add_info($newsletterEmailVo)
    {
        // ...
    }

    private function _filter($newsletterEmailVo)
    {
        if (!CTTHelper::isEmptyString($this->newsletterEmailModel->newsletterEmailTemplateId)) {
            $newsletterEmailVo->newsletterEmailTemplateId = $this->newsletterEmailModel->newsletterEmailTemplateId;
        }
        if (!CTTHelper::isEmptyString($this->newsletterEmailModel->key)) {
            $newsletterEmailVo->key = array('like', "%{$this->newsletterEmailModel->key}%");
        }
        if (!CTTHelper::isEmptyString($this->newsletterEmailModel->subject)) {
            $newsletterEmailVo->key = array('like', "%{$this->newsletterEmailModel->subject}%");
        }
    }

    public function manage()
    {
        $newsletterEmailVo = new NewsletterEmailTemplateVo();

        // filter
        $this->_filter($newsletterEmailVo);

        // orderBy
        $orderBy = array(
            'newsletter_email_template_id' => 'DESC'
        );

        // paging
        if (empty ($_REQUEST ['item_per_page'])) {
            $recSize = Registry::getSetting('item_per_page');
        } else {
            $recSize = $_REQUEST ['item_per_page'];
        }
        $start = 0;
        if (CTTHelper::isEmptyString($_REQUEST ['page'])) {
            $page = 0;
        } elseif (is_numeric($_REQUEST ['page'])) {
            $page = $_REQUEST ['page'];
        } else {
            $page = 0;
        }
        $count = count($this->newsletterEmailDao->selectByFilter($newsletterEmailVo));
        $paging = new Paging ($page, 5, $recSize, $count);
        $start = ($paging->currentPage - 1) * $recSize;

        // get data
        $newsletterEmailVos = $this->newsletterEmailDao->selectByFilter($newsletterEmailVo, $orderBy, $start, $recSize);

        // add info
        foreach ($newsletterEmailVos as $newsletterEmailVo) {
            $this->_add_info($newsletterEmailVo);
        }

        // set data
        $paging->items = $newsletterEmailVos;

        // send data
        $this->setAttributes(array(
            'pageView' => $paging
        ));

        // call view
        return $this->setRender('success');
    }

    public function validate_ajax()
    {
        $action = $_REQUEST ['action'];
        switch ($action) {
            case 'add' :
                $newsletterEmailVo = new NewsletterEmailTemplateVo();
                $newsletterEmailVo->key = trim($_REQUEST ['name']);
                $validate = $this->_validate_add($newsletterEmailVo);
                if (!empty ($validate)) {
                    echo json_encode($validate);
                }
                break;
            case 'edit' :
                $newsletterEmailVo = new NewsletterEmailTemplateVo();
                $newsletterEmailVo->key = trim($_REQUEST ['name']);
                $newsletterEmailVo->newsletterEmailTemplateId = $_REQUEST ['newsletterEmailTemplateId'];
                $validate = $this->_validate_edit($newsletterEmailVo);
                if (!empty ($validate)) {
                    echo json_encode($validate);
                }
                break;
        }

        return $this->setRender('success');
    }

    private function _check_exist($newsletterInfo)
    {
        if (!$newsletterInfo) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Newsletter Email not exist');
            return false;
        }
        return true;
    }

    private function _check_permission($newsletterInfo)
    {
        return true;
    }

    public function add()
    {
        $newsletterEmailTemplate = EmailTemplateExt::getEmailTemplate("newsletter_email");
        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            // set data
            $newsletterEmailVo = new NewsletterEmailTemplateVo();
            CTTHelper::copyProperties($this->newsletterEmailModel, $newsletterEmailVo);

            // add
            $this->newsletterEmailDao->insert($newsletterEmailVo);

            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Newsletter email add success");
            return $this->setRender('manage');
        }

        // send data
        $this->setAttributes(array(
            'newsletterEmailTemplate' => $newsletterEmailTemplate->content
        ));

        return $this->setRender('success');
    }

    public function edit()
    {
        $newsletterEmailTemplateId = $_REQUEST ['newsletterEmailTemplateId'];
        $newsletterEmailInfo = $this->newsletterEmailDao->selectByPrimaryKey($newsletterEmailTemplateId);

        if (!($this->_check_exist($newsletterEmailInfo) & $this->_check_permission($newsletterEmailInfo))) {
            return $this->setRender('manage');
        }

        // send data
        $this->setAttributes(array(
            'newsletterEmailInfo' => $newsletterEmailInfo
        ));

        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            // set data
            $newsletterEmailVo = new NewsletterEmailTemplateVo();
            CTTHelper::copyProperties($this->newsletterEmailModel, $newsletterEmailVo);

            // update
            $this->newsletterEmailDao->updateByPrimaryKey($newsletterEmailVo, $newsletterEmailTemplateId);

            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Newsletter email update success");
            return $this->setRender('manage');
        }

        return $this->setRender('success');
    }

    public function delete()
    {
        if (isset ($_REQUEST ['newsletterEmailTemplateId'])) {
            $newsletterEmailTemplateId = $_REQUEST ['newsletterEmailTemplateId'];
            $this->newsletterEmailDao->deleteByPrimaryKey($newsletterEmailTemplateId);
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Delete is success!');
        }
        return $this->setRender('success');
    }

    public function send()
    {
        $newsletterEmailTemplateId = $_REQUEST ['newsletterEmailTemplateId'];
        $newsletterEmailInfo = $this->newsletterEmailDao->selectByPrimaryKey($newsletterEmailTemplateId);

        if (!($this->_check_exist($newsletterEmailInfo) & $this->_check_permission($newsletterEmailInfo))) {
            return $this->setRender('manage');
        }

        //get email (subscribe) of customer in newsletter table
        $newsletterVo = new NewsletterVo();
        $newsletterVo->subscribe = 1;
        $newsletterList = $this->newsletterDao->selectByFilter($newsletterVo);
        $newsletterEmail = array();
        foreach ($newsletterList as $v) {
            $newsletterEmail[] = $v->email;
        }

        //get customer email
        $filter = array(
            'c.status' => 'A',
        );
        $customerList = CustomerExt::getCustomerList($filter);
        $customerEmail = array();
        foreach ($customerList as $v) {
            $customerEmail[] = $v->email;
        }

        // send data
        $this->setAttributes(array(
            'newsletterEmailInfo' => $newsletterEmailInfo,
            'newsletterEmail' => $newsletterEmail,
            'customerEmail' => $customerEmail,
        ));

        if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
            $emails = ($_REQUEST['emails'] != '') ? explode(',', $_REQUEST['emails']) : array();

            //filter emmail is duple
            $emailTos = array();
            foreach ($emails as $v) {
                if ($v != '' & !in_array($v, $emailTos)) {
                    $emailTos[] = $v;
                }
            }

            //send email
            $emailData = array();
            EmailHelper::sendNewsletterMail($emailTos, $newsletterEmailInfo->key, $emailData);

            //set seesion log email sended
            Session::setSession('emailSended', $emailTos);

            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Send email newsletter success");
        }

        return $this->setRender('success');
    }
}