<?php

class AdminController extends Controller {
    public $adminModel;
    public $adminDetailModel;
    private $adminDao;
    private $adminDetailDao;

    public function __construct() {
        $this->adminModel = new AdminModel();
        $this->adminDetailModel = new AdminDetailModel();
        $this->adminDao = new AdminDao();
        $this->adminDetailDao = new AdminDetailDao();
    }

    public function page_404() {
        return $this->setRender("success");
    }

    private function getTotalContact(){
        $sql = "select count(*) as `count` from `contact`";
        $query = DataBaseHelper::query($sql);
        return $query[0]->count;
    }
    private function getTotalTrainer(){
        $sql = "select count(*) as `count` from `trainer`";
        $query = DataBaseHelper::query($sql);
        return $query[0]->count;
    }
    private function getTotalAlbum(){
        $sql = "select count(*) as `count` from `album`";
        $query = DataBaseHelper::query($sql);
        return $query[0]->count;
    }
    private function getTotalVideo(){
        $sql = "select count(*) as `count` from `video`";
        $query = DataBaseHelper::query($sql);
        return $query[0]->count;
    }

    public function index(){
        if(!Session::isAdminLogin()){
            return $this->setRender('login');
        }

        $this->setAttributes(array(
//            'totalContact' => $this->getTotalContact(),
//            'totalTrainer' => $this->getTotalTrainer(),
//            'totalAlbum' => $this->getTotalAlbum(),
//            'totalVideo' => $this->getTotalVideo(),
        ));
        return $this->setRender('index');
    }

    public function statistic_ajax() {
        //get allOrders
        $ordersStatistics = OrdersExt::getOrdersStatistic();

        $action = $_REQUEST['action'];
        switch ($action) {
            case 'statistic_year':
                $statisticMode = 'year';
                break;
            case 'statistic_month':
                $statisticMode = 'month';
                break;
        }

        TemplateHelper::getTemplate('index/statistic_orders.php', array(
            'ordersStatistics' => $ordersStatistics,
            'year' => $_REQUEST['year'],
            'month' => $_REQUEST['month'],
            'statisticMode' => $statisticMode
        ));

        return $this->setRender('success');
    }

    /**
     * admin login    OK
     */
    public function login() {
        //recaptcha
        $api_url = 'https://www.google.com/recaptcha/api/siteverify';
        $site_key = '6LcNlT8UAAAAAC6QTvKr8M2aSERESKO45hA2IQkr';
        $secret_key = '6LcNlT8UAAAAAPU7rlnC3wN1oxyRZkZqMx0X0ZLd';

        if (Session::isAdminLogin()) {
            return $this->setRender('index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginStatus = true;
            $loginMessage = '';
            //lấy dữ liệu được post lên
            $site_key_post = $_POST['g-recaptcha-response'];
            //lấy IP của khach
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $remoteip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $remoteip = $_SERVER['REMOTE_ADDR'];
            }
            //tạo link kết nối
            $api_url = $api_url . '?secret=' . $secret_key . '&response=' . $site_key_post . '&remoteip=' . $remoteip;
            //lấy kết quả trả về từ google
            $response = file_get_contents($api_url);
            //dữ liệu trả về dạng json
            $response = json_decode($response);
            if (!isset($response->success)) {
                $checkRecaptcha = false;
            }
            if ($response->success == true) {
                $checkRecaptcha = true;
            } else {
                $checkRecaptcha = false;
            }
            $checkRecaptcha = true; //deverloper

            if (!$checkRecaptcha) {
                $loginStatus = false;
                $loginMessage = e('Bạn chưa chọn captcha');
                SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Bạn chưa chọn captcha'));
                $this->setRender('login');
            } else {
                $adminVo = new AdminVo();
                $adminVo->username = $this->adminModel->username;
                $adminVo->password = md5($this->adminModel->password);
                $adminVos = $this->adminDao->selectByFilter($adminVo);
                if ($adminVos) {
                    $data = $adminVos[0];
                    if ($data->status == 'A') {
                        //update loginFalse and activeCode
                        $data->loginFalse = 0;
                        $data->activeCode = '';
                        $this->adminDao->updateByPrimaryKey($data, $data->adminId);

                        //setLogin
                        $sessionType = 'admin';
                        Session::setLogin($data, $sessionType);
                        SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Login Successfully'));
                        return $this->setRender('index');
                    } else {
                        $loginStatus = false;
                        $loginMessage = e('Tài khoản bị khóa');
                    }
                } else {
                    $loginStatus = false;
                    $loginMessage = e('Wrong username or password');
                }
            }

            if (!$loginStatus) {
                //update loginFalse and activeCode
                $activeCode = StringHelper::getRandomCode();
                $adminVo = new AdminVo();
                $adminVo->username = $this->adminModel->username;
                $adminVos = $this->adminDao->selectByFilter($adminVo);
                if ($adminVos) {
                    $adminVo = $adminVos[0];
                    $loginFalse = $adminVo->loginFalse;
                    $loginFalse++;
                    $adminVo->loginFalse = $loginFalse;
                    if ($loginFalse == 5) {
                        $adminVo->status = 'D';
                        $adminVo->activeCode = $activeCode;
                    }
                    $this->adminDao->updateByPrimaryKey($adminVo, $adminVo->adminId);

                    //send email
                    if ($loginFalse == 5) {
                        $tos = array($adminVo->email);
                        $emailData = array(
                            'link' => Registry::getSetting('base_url') . "/index.php?r=admin/active/account&email={$adminVo->email}&activeCode=$activeCode",
                        );
                        EmailHelper::sendMail($tos, 'admin_active', $emailData, true);
                    }
                }
                SessionMessage::addSessionMessage(SessionMessage::$ERROR, $loginMessage);
                return $this->setRender('login');
            }
        }
        return $this->setRender('login');
    }

    /**
     * admin logout    OK
     */
    public function logout() {
        Session::setLogout();
        return $this->setRender('success');
    }

    /**
     * validatePasswordChange of adminId    OK
     * call in account funtion
     *
     * @return boolean
     */
    private function validatePasswordChange($adminId, $currentPassword, $newPassword, $confirmNewPassword) {
        $error = 0;
        //check $currentPassword exist
        $adminInfo = $this->adminDao->selectByPrimaryKey($adminId);
        if ($adminInfo->password != md5($currentPassword)) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Current password incorect'));
            $error = 1;
            return false;
        }
        //check compare $newPassword and $confirmNewPassword
        if ($newPassword != $confirmNewPassword) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Passwords do not match!!'));
            $error = 1;
            return false;
        }
        //return
        if ($this->hasErrors() || $error) {
            return false;
        }
        return true;
    }

    /**
     * View and edit account infomation and admin information        OK
     */
    public function account() {
        //get adminId
        $adminId = Session::getAdminId();

        //check adminId
        $adminInfo = $this->adminDao->selectByPrimaryKey($adminId);
        if (!$adminInfo) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Account not found'));
            return $this->setRender('false');
        }
        //add info
        $roleArray = RoleExt::getRoleArray('backend');
        $adminInfo->roleName = $roleArray[$adminInfo->roleId];

        //get adminDetailInfo
        $adminDetailInfo = new AdminDetailVo();
        $adminDetailVo = new AdminDetailVo();
        $adminDetailVo->adminId = $adminId;
        $adminDetailVos = $this->adminDetailDao->selectByFilter($adminDetailVo);
        if ($adminDetailVos) {
            $adminDetailInfo = $adminDetailVos[0];
        } else {
            //create new adminDetail
            $adminDetailInfo->adminDetailId = $this->adminDetailDao->insert($adminDetailVo);
        }

        //send data
        $this->setAttributes(array(
            'adminInfo' => $adminInfo,
            'adminDetailInfo' => $adminDetailInfo,
            'languageList' => LanguageExt::getLanguageList(),
        ));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //case1: save account information	(password, language_code)
            if (isset($_POST['submit_account_information'])) {
                $adminVo = new AdminVo();

                //get request password value
                $currentPassword = trim($_REQUEST['current_password']);
                $newPassword = trim($_REQUEST['new_password']);
                $confirmNewPassword = trim($_REQUEST['confirm_new_password']);

                //update password
                if ($currentPassword != '' & $newPassword != '' & $confirmNewPassword != '') {
                    if (!$this->validatePasswordChange($adminId, $currentPassword, $newPassword, $confirmNewPassword)) {
                        return $this->setRender('manage');
                    }
                    $adminVo->password = md5($newPassword);
                }
                //languageCode
                $adminVo->languageCode = $_REQUEST['language_code'];
                $this->adminDao->updateByPrimaryKey($adminVo, $adminId);

                //set active tab
                Session::setSession('admin_account_tab', 'account_information');

                //message
                SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Update successful.'));
                return $this->setRender('manage');
            }

            //case2: save admin information
            if (isset($_POST['submit_admin_information'])) {
                //get data from $_REQUEST
                $adminDetailVo = new AdminDetailVo();
                CTTHelper::copyProperties($this->adminDetailModel, $adminDetailVo);

                //image
                $adminDetailVo->image = str_replace(URLHelper::getBaseUrl() . "/", '', $_REQUEST['image']);

                //update
                $this->adminDetailDao->updateByPrimaryKey($adminDetailVo, $adminDetailInfo->adminDetailId);


                //set active tab
                Session::setSession('admin_account_tab', 'admin_information');

                //message
                SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Update successful.'));
                return $this->setRender('manage');
            }
        }
        return $this->setRender('success');
    }

    public function addImageAjax() {
        //get data
        $image = $_REQUEST['image'];
        $index = $_REQUEST['index'];
        $action = true;

        //return data
        TemplateHelper::renderInputMultiFile($image, $index, $action);

        return $this->setRender('json');
    }

    public function activeAccount() {
        $email = $_REQUEST['email'];
        $activeCode = $_REQUEST['activeCode'];

        //check url
        if ($email == '' || $activeCode == '') {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Url incorrect. Please check again');
        }

        //check email and $activeCode
        $adminVo = new AdminVo();
        $adminVo->email = $email;
        $adminVo->activeCode = $activeCode;
        $adminVos = $this->adminDao->selectByFilter($adminVo);
        if (!$adminVos) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Email address or activeCode incorrect');
        } else {
            //update
            $adminVo = $adminVos[0];
            $adminVo->loginFalse = 0;
            $adminVo->activeCode = '';
            $adminVo->status = 'A';
            $this->adminDao->updateByPrimaryKey($adminVo, $adminVo->adminId);
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Active account is success');
        }

        return $this->setRender('login');
    }
}