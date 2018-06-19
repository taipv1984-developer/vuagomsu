<?php

class HomeCustomerController extends Controller {
    public $customerModel;
    public $customerDetailModel;
    private $customerDao;
    private $customerDetailDao;
    private $customerAddressDao;

    public function __construct() {
        $this->customerModel = new CustomerModel();
        $this->customerDetailModel = new CustomerDetailModel();
        $this->customerDao = new CustomerDao();
        $this->customerDetailDao = new CustomerDetailDao();
        $this->customerAddressDao = new CustomerAddressDao();
    }

    /**
     * verify apply for link verify from email sended then customer register    OK
     *
     * @param string $username
     * @param string $code
     */
    public function verify() {
        //check customer info
        $customerVo = new CustomerVo();
        $customerVo->username = $_REQUEST['username'];
        $customerVo->code = $_REQUEST['code'];
        $customerVos = $this->customerDao->selectByFilter($customerVo);
        if ($customerVos) {
            $customerInfo = $customerVos[0];
            if ($customerInfo->status == 'A') {
                //set message
                SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Account is active');

                //set active view(account)
                return $this->setRender('active');
            } else {
                //update customer
                $customerVo->status = 'A';
                $customerVo->code = '';
                $this->customerDao->updateByPrimaryKey($customerVo, $customerInfo->customerId);

                //send email verify notice
                $emailData = array();
                //EmailHelper::sendMail(..., 'email_customer_verified', $emailData);

                //update $customerInfo
                $customerInfo->status = 'A';
                $customerInfo->code = '';

                //set login
                $data = $customerInfo;
                $sessionType = 'customer';
                Session::setLogin($data, $sessionType);

                //set message
                SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Verify is successful!');

                //set active view(account)
                return $this->setRender('active');
            }
        }

        return $this->setRender('active');
    }

    /**
     * if not login then allow login and check orders
     * else edit account... (mutil address)
     */
    public function account() {
        if (!Session::isCustomerLogin()) {
            return $this->setRender('login');
        } else {    //logined
            //get customerInfo
            $customerId = Session::getCustomerId();
            $customerInfo = CustomerExt::getCustomerInfo($customerId);
            $customerAddressList = CustomerExt::getCustomerAddressList($customerId);

            //send data
            $this->setAttributes(array(
                'customerInfo' => $customerInfo,
                'customerAddressList' => $customerAddressList
            ));

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $customerVo = new CustomerVo();
                //email
                if ($customerInfo->oauthId & $customerInfo->email == '') {
                    $customerVo->email = $_REQUEST['email'];
                }
                //password
                $newPassword = trim($_REQUEST['new_password']);
                $confirmPassword = trim($_REQUEST['confirm_password']);
                if ($newPassword == $confirmPassword & $newPassword != '') {
                    $customerVo->password = md5($newPassword);
                }
                //more
                $customerVo->modBy = Session::getCustomerId();
                $customerVo->modDate = DateHelper::getDateTime();
                //update customer
                $this->customerDao->updateByPrimaryKey($customerVo, $customerId);

                //update customer_detail
                $birthday = DateHelper::getDateFromDatePicker($_REQUEST['birthday']);
                $customerDetailVo = new CustomerDetailVo();
                $customerDetailVo->customerId = $customerId;
                $customerDetailVo->firstName = $_REQUEST['firstName'];
                $customerDetailVo->lastName = $_REQUEST['lastName'];
                $customerDetailVo->phone = $_REQUEST['phone'];
                $customerDetailVo->birthday = $birthday;
                $customerDetailVo->receiveEmail = ($_REQUEST['receive_email'] == 'on') ? 1 : 0;
                $this->customerDetailDao->updateByPrimaryKey($customerDetailVo, $customerInfo->customerDetailId);

                //update customer Address
                if ($customerAddress) {
                    //edit
                    $customerAddressId = $customerAddress->customerAddressId;
                    $customerAddressVo = new CustomerAddressVo();
                    $customerAddressVo->address = trim($_REQUEST['address']);
                    $this->customerAddressDao->updateByPrimaryKey($customerAddressVo, $customerAddressId);
                } else {
                    //add (shipping address default)
                    $customerAddressVo = new CustomerAddressVo();
                    $customerAddressVo->customerId = $customerId;
                    $customerAddressVo->address = trim($_REQUEST['address']);
                    $customerAddressVo->defaultShipping = 1;
                    $customerAddressVo->defaultBilling = 0;
                    $customerAddressId = $this->customerAddressDao->insert($customerAddressVo);
                }

                //message
                SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Update successful'));
                //view
                return $this->setRender('account');
            }

            //view
            return $this->setRender('success');
        }
    }

    /**
     * OK
     * account_address
     */
    public function account_address() {
        $customerAddressDao = new CustomerAddressDao();

        if (!Session::isCustomerLogin()) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Account not logined'));
            return $this->setRender('account');
        }

        //get customerInfo
        $customerId = Session::getCustomerId();

        //send data
        $action = $_REQUEST['action'];
        if ($action == 'add' || $action == 'edit') {
            //get data
            $customerAddressId = ($_REQUEST['customerAddressId']) ? $_REQUEST['customerAddressId'] : 0;
            $customerAddressInfo = CustomerExt::getCustomerAddressInfo($customerAddressId);

            //send data
            $this->setAttributes(array(
                'customerAddressInfo' => $customerAddressInfo,
            ));
        } else {
            //get data
            $customerAddressList = CustomerExt::getCustomerAddressList($customerId);

            //send data
            $this->setAttributes(array(
                'customerAddressList' => $customerAddressList,
            ));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_REQUEST['action'];
            if ($action == 'add') {
                //get data
                $customerAddressVo = new CustomerAddressVo();
                CTTHelper::copyRequest($customerAddressVo);
                $customerAddressVo->customerId = $customerId;
                $customerAddressVo->defaultShipping = ($customerAddressVo->defaultShipping) ? 1 : 0;
                $customerAddressVo->defaultBilling = ($customerAddressVo->defaultBilling) ? 1 : 0;
                $customerAddressId = $customerAddressDao->insert($customerAddressVo);

                //set default
                if ($customerAddressVo->defaultShipping) {
                    CustomerExt::updateDefaultShipping($customerId, $customerAddressId);
                } else {
                    $addressShippingDefault = CustomerExt::getAddressShippingDefault($customerId);
                    if (!$addressShippingDefault) {
                        CustomerExt::updateDefaultShipping($customerId, $customerAddressId);
                    }
                }
                if ($customerAddressVo->defaultBilling) {
                    CustomerExt::updateDefaultBilling($customerId, $customerAddressId);
                } else {
                    $addressBillingDefault = CustomerExt::getAddressBillingDefault($customerId);
                    if (!$addressBillingDefault) {
                        CustomerExt::updateDefaultBilling($customerId, $customerAddressId);
                    }
                }

                Session::setSession('popup_action', 'close');
                Session::setSession('popup_message', 'Add address is success');
            }
            if ($action == 'edit') {
                //get data
                $customerAddressId = $_REQUEST['customerAddressId'];
                $customerAddressVo = new CustomerAddressVo();
                CTTHelper::copyRequest($customerAddressVo);
                //defaultShipping and defaultBilling
                $customerAddressVo->defaultShipping = ($customerAddressVo->defaultShipping) ? 1 : 0;
                $customerAddressVo->defaultBilling = ($customerAddressVo->defaultBilling) ? 1 : 0;
                $customerAddressDao->updateByPrimaryKey($customerAddressVo, $customerAddressId);

                //set default
                if ($customerAddressVo->defaultShipping) {
                    CustomerExt::updateDefaultShipping($customerId, $customerAddressId);
                } else {
                    $addressShippingDefault = CustomerExt::getAddressShippingDefault($customerId);
                    if (!$addressShippingDefault) {
                        CustomerExt::updateDefaultShipping($customerId, $customerAddressId);
                    }
                }
                if ($customerAddressVo->defaultBilling) {
                    CustomerExt::updateDefaultBilling($customerId, $customerAddressId);
                } else {
                    $addressBillingDefault = CustomerExt::getAddressBillingDefault($customerId);
                    if (!$addressBillingDefault) {
                        CustomerExt::updateDefaultBilling($customerId, $customerAddressId);
                    }
                }

                Session::setSession('popup_action', 'close');
                Session::setSession('popup_message', 'Edit address is success');
            }
        }

        //send data
        $this->setAttributes(array(
            'customerInfo' => $customerInfo,
            'customerAddressList' => $customerAddressList,
        ));

        //view
        return $this->setRender('success');
    }

    /**
     * OK
     * account_address_action
     * case    make_default_shipping
     * case        make_default_billing
     * case    address_delete
     */
    public function account_address_action() {
        $action = $_REQUEST['action'];

        switch ($action) {
            case 'make_default_shipping':
                //get data
                $customerAddressId = $_REQUEST['customerAddressId'];
                $customerId = session::getCustomerId();
                //update
                CustomerExt::updateDefaultShipping($customerId, $customerAddressId);

                //message
                Session::setSession('popup_message', e('Make default shipping is success'));
                break;
            case 'make_default_billing':
                //get data
                $customerAddressId = $_REQUEST['customerAddressId'];
                $customerId = session::getCustomerId();

                //update
                CustomerExt::updateDefaultBilling($customerId, $customerAddressId);

                //message
                Session::setSession('popup_message', e('Make default billing is success'));
                break;
            case 'address_delete':
                //get data
                $customerId = session::getCustomerId();
                $customerAddressId = $_REQUEST['customerAddressId'];

                //update
                CustomerExt::deleteAddress($customerId, $customerAddressId);

                //message
                Session::setSession('popup_message', e('Delete addess is success'));
                break;
        }

        //view
        return $this->setRender('success');
    }

    /**
     * OK
     * account_orders
     * case        orders history
     * case        orders detail
     */
    public function account_orders() {
        if (!Session::isCustomerLogin()) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Account not logined'));
            return $this->setRender('home');
        }
        //get $customerId
        $customerId = Session::getCustomerId();

        if (isset($_REQUEST['orderId'])) {    //view
            //check ordersId
            $orderId = $_REQUEST ['orderId'];
            $filter = array(
                'o.is_del' => 0,
                'o.order_id' => $orderId,
                'o.customer_id' => $customerId
            );
            $ordersVos = OrdersExt::getOrdersList($filter);
            if (!$ordersVos) {
                SessionMessage::addSessionMessage(SessionMessage::$ERROR, e("Orders #$orderId not exist"));
                return $this->setRender('false');
            }
            $ordersInfo = $ordersVos[0];

            //add info
            if ($ordersInfo->customerId) {
                $ordersInfo->customerInfo = CustomerExt::getCustomerInfo($ordersInfo->customerId);
            } else {
                $ordersInfo->customerInfo = CustomerExt::getCustomerInfo($ordersInfo->guestId);
            }
            $ordersInfo->crtDateInfo = date('d/m/Y H:i', strtotime($ordersInfo->crtDate));
            if ($ordersInfo->modBy != '') {
                $modDate = date('d/m/Y H:i', strtotime($ordersInfo->modDate));
                $modByName = AdminExt::getAdminUserName($ordersInfo->modBy);
                $ordersInfo->modInfo = "<u>$modDate</u> by <b>$modByName</b>";
            }
            $shippingAddressInfo = CustomerExt::getCustomerAddressInfo($ordersInfo->shippingAddressId);
            $cityId = $shippingAddressInfo->cityId;
            if ($cityId) {
                $cityName = AddressHelper::getCityName($cityId);
                $ordersInfo->shippingAddress = $shippingAddressInfo->address . " ($cityName)";
            } else {
                $ordersInfo->shippingAddress = $shippingAddressInfo->address;
            }

            //get cart
            $cartInfo = OrdersExt::getCartInfo($orderId);

            //send data
            $this->setAttributes(array(
                'ordersInfo' => $ordersInfo,
                'cartInfo' => $cartInfo,
                'shippingInfo' => OrdersExt::getShippingInfo($orderId),
                'paymentInfo' => OrdersExt::getPaymentInfo($orderId),
                'surchargeList' => OrdersExt::getSurchargeList($orderId),
            ));
        } else {    //history
            //filter
            $filter = $this->account_orders_getFilter();
            //orderBy
            $orderBy = array('o.order_id' => 'DESC');

            //paging
            if (empty($_REQUEST ['item_per_page'])) {
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
            $count = count(OrdersExt::getOrdersList($filter));
            $paging = new Paging($page, 5, $recSize, $count);
            $start = ($paging->currentPage - 1) * $recSize;
            $ordersList = OrdersExt::getOrdersList($filter, $orderBy, $start, $recSize);

            //add info
            $this->account_orders_addInfo($ordersList);

            //set data
            $paging->items = $ordersList;

            //send data
            $this->setAttributes(array(
                'pageView' => $paging,
                'ordersList' => $ordersList,
                'shippingMethodArray' => CheckoutExt::getShippingMethodArray(),
                'paymentMethodArray' => CheckoutExt::getPaymentMethodArray(),
                'orderStatusArray' => OrdersExt::getOrderStatusArray(),
            ));
        }

        //view
        return $this->setRender('success');
    }

    private function account_orders_getFilter() {
        $filter = array();
        $filter['o.is_del'] = 0;
        $filter['o.customer_id'] = Session::getCustomerId();

        //orderCode (orderId)
        if (!CTTHelper::isEmptyString($_REQUEST['orderCode'])) {
            $filter['o.order_id'] = $_REQUEST['orderCode'];
        }

        //shippingName
        if (!CTTHelper::isEmptyString($_REQUEST['shippingName'])) {
            $filter['os.`code`'] = $_REQUEST['shippingName'];
        }

        //paymentName
        if (!CTTHelper::isEmptyString($_REQUEST['paymentName'])) {
            $filter['op.`code`'] = $_REQUEST['paymentName'];
        }

        //paymentName
        if (!CTTHelper::isEmptyString($_REQUEST['status'])) {
            $filter['ostatus.order_status_id'] = $_REQUEST['status'];
        }

        //crtDate
        $crtDateFrom = trim($_REQUEST ['crtDateFrom']);
        $crtDateTo = trim($_REQUEST ['crtDateTo']);
        if ($crtDateFrom == '' && $crtDateTo != '') {
            $filter['o.crt_date<'] = $crtDateTo;
        } else if ($crtDateFrom != '' && $crtDateTo == '') {
            $filter['o.crt_date>'] = $crtDateFrom;
        } else if ($crtDateFrom != '' && $crtDateTo != '') {
            $filter['o.crt_date'] = array('between', $crtDateFrom, $crtDateTo);
        }

        //total
        $totalFrom = trim($_REQUEST ['totalFrom']);
        $totalTo = trim($_REQUEST ['totalTo']);
        if ($totalFrom == '' && $totalTo != '') {
            $filter['o.total<'] = $totalTo;
        } else if ($totalFrom != '' && $totalTo == '') {
            $filter['o.total>'] = $totalFrom;
        } else if ($totalFrom != '' && $totalTo != '') {
            $filter['o.total'] = array('between', $totalFrom, $totalTo);
        }

        return $filter;
    }

    private function account_orders_addInfo($ordersList) {
        foreach ($ordersList as $v) {
            //orderId
            $href = URLHelper::getUrl('home/account/orders', array('orderId' => $v->orderId));
            $v->orderCode = "<a href='$href' title='View Detail'>#{$v->orderId}</a>";

            //ordersDate
            $date = date('d/m/Y', strtotime($v->crtDate));
            $time = date('H:i:s', strtotime($v->crtDate));
            $v->ordersDateTime = "<b>$date</b><br><span>$time</span>";

            //totalFormat
            $v->totalFormat = CurrencyExt::format_price($v->total);
        }
    }

    public function login() {
        if (Session::isCustomerLogin()) {
            return $this->setRender('account');
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //get data
                $username = trim($_REQUEST['username']);
                $password = trim($_REQUEST['password']);
                $pos = strpos($username, '@');
                if ($pos === false) {    //login by username
                    $usernameData = $username;
                    $emailData = null;
                } else {    //login by email
                    $usernameData = null;
                    $emailData = $username;
                }
                $data = CustomerExt::getCustomerInfoLogin($usernameData, $emailData, $password);

                //check data
                if ($data) {
                    //check disable status
                    if ($data->status == 'D') {
                        SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Login false. Account is disable'));
                        return $this->setRender('home');
                    }

                    //setLogin
                    $sessionType = 'customer';
                    Session::setLogin($data, $sessionType);

                    SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Login is successful!'));
                    $redirectUrl = Session::getSession('redirectUrl');
                    if ($redirectUrl) {
                        header("location: $redirectUrl");
                        Session::deleteSession('redirectUrl');
                        return;
                    } else {
                        return $this->setRender('account');
                    }
                } else {
                    SessionMessage::addSessionMessage(SessionMessage::$ERROR, e('Bạn chưa đăng ký tài khoản, vui lòng đăng ký tài khoản'));
                }
            }

            //view
            return $this->setRender('success');
        }
    }

    /**
     * logout    OK
     * clearSession customer and checkout session
     */
    public function logout() {
        //clearSession login
        Session::setLogout();
        //clearSession checkout
        unset($_SESSION[SESSION_GROUP]['checkout']);
        //clearSession token (social login)
        unset($_SESSION['token']);
        unset($_SESSION['facebookLoginData']);
        //message
        SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Logout is successful!'));
        //set view
        return $this->setRender('success');
    }

    /**
     * OK
     * validateRegisterCustomer
     * check email exist
     * check username exist
     * check compare password and confirm_password
     *
     * @return boolean
     */
    public function registerValidate() {
        $validate = array();

        //check email exist (customer table)
        $customerVo = new CustomerVo();
        $customerVo->email = $_REQUEST['email'];
        $customerVo->roleId = 2;
        $customerVo->oauthId = 0;
        $customerVos = $this->customerDao->selectByFilter($customerVo);
        if ($customerVos) {
            $validate["email"] = e("Email is exist");
        }

        //check password length
        if (strlen($_REQUEST['password']) < 6) {
            $validate["password"] = e("Passwords length must bigger 6!");
        }

        //check compare password and confirm_password
        if ($_REQUEST['password'] != $_REQUEST['confirmPassword']) {
            $validate["confirmPassword"] = e("Passwords do not match!");
        }

        //check birthday
        $birthday = DateHelper::getDateFromDatePicker($_REQUEST['birthday']);
        $checkdate = DateHelper::validateDate($birthday);
        if (!$checkdate) {
            $validate["birthday"] = e("Date incorrect");
        }

        if (!empty($validate)) {
            echo json_encode($validate);
        }

        return $this->setRender('success');
    }

    /**
     * OK
     * customerRegister
     * 1.    add customer
     * 2.    setLogin
     * 3.    send email register
     */
    public function register() {
        if (Session::isCustomerLogin()) {
            return $this->setRender('account');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //registerCustomer
            //1.	add customer
            $customerVo = new CustomerVo();
            $customerVo->roleId = 2;    //hardcode
            $customerVo->email = $_REQUEST['email'];
            $customerVo->password = md5($_REQUEST['password']);
            $customerVo->languageCode = DEFAULT_LANGUAGE;
            $customerVo->status = 'A';
            $customerVo->activeCode = '';
            $customerVo->resetPasswordCode = '';
            $customerVo->oauthProvider = '';    //social info
            $customerVo->oauthId = 0;           //social info
            $customerVo->crtBy = 0;
            $customerVo->crtDate = DateHelper::getDateTime();
            $customerId = $this->customerDao->insert($customerVo);

            //add customer_detail
            $customerDetailVo = new CustomerDetailVo();
            $customerDetailVo->customerId = $customerId;
            $customerDetailVo->addressId = 0;
            $customerDetailVo->firstName = $_REQUEST['firstName'];
            $customerDetailVo->lastName = $_REQUEST['lastName'];
            $customerDetailVo->phone = $_REQUEST['phone'];
            $customerDetailVo->birthday = DateHelper::getDateFromDatePicker($_REQUEST['birthday']);
            $customerDetailVo->receiveEmail = ($_REQUEST['receive_email']) ? $_REQUEST['receive_email'] : 0;
            $customerDetailVo->image = Registry::getSetting('no_image');
            $this->customerDetailDao->insert($customerDetailVo);

            //set newsletter for customer register
            $newsletterDao = new NewsletterDao ();
            $newsletterVo = new NewsletterVo ();
            $newsletterVo->email = $_REQUEST['email'];
            $newsletterVo->subscribe = 1;
            $newsletterVo->crtBy = 0;
            $newsletterVo->crtDate = DateHelper::getDateTime();
            $newsletterDao->insert($newsletterVo);

            //2.	setLogin
            $customerInfo = CustomerExt::getCustomerInfo($customerId);
            $sessionType = 'customer';
            Session::setLogin($customerInfo, $sessionType);

            //3.	send email register
            $emailData = array(
                'name' => CustomerExt::getFullName($customerInfo),
                'email' => $_REQUEST['email'],
                'password' => $_REQUEST['password'],
                'crtDate' => $customerInfo->crtDate,
                'url' => "index.php?r=home/account",
            );
            EmailHelper::sendMail($customerInfo->email, 'customer_register', $emailData);

            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, e('Register is successful!'));
            return $this->setRender('account');
        }

        return $this->setRender('success');
    }

    /**
     * OK
     * customer forget_password OK
     */
    public function forget_password() {
        //set session flag
        Session::setSession('forget_password_status', 1);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_REQUEST['email'];

            //check email exit
            $customerVo = new CustomerVo();
            $customerVo->email = $email;
            $customerVos = $this->customerDao->selectByFilter($customerVo);
            if (!$customerVos) {
                SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Email not exist');
                Session::setSession('forget_password_status', 2);
            } else {
                $customerInfo = $customerVos[0];

                //update $resetPasswordCode for customer
                $resetPasswordCode = StringHelper::getRandomCode();
                $customerVo = new CustomerVo();
                $customerVo->resetPasswordCode = $resetPasswordCode;
                $this->customerDao->updateByPrimaryKey($customerVo, $customerInfo->customerId);

                //sendMail
                $link = "index.php?r=home/reset_password&email=$email&resetPasswordCode=$resetPasswordCode";
                $siteName = Registry::getSetting('site_name');
                $emailData = array(
                    'username' => $customerInfo->username,
                    'link' => $link,
                    'link_title' => Registry::getSetting('base_url') . '/' . $link,
                    'site_name' => $siteName,
                );
                EmailHelper::sendMail($email, 'reset_password', $emailData);

                SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Check email to reset password');
                Session::setSession('forget_password_status', 3);
            }
        }
        return $this->setRender('success');
    }

    /**
     * OK
     * customer reset_password OK
     */
    public function reset_password() {
        $email = $_REQUEST['email'];
        $resetPasswordCode = $_REQUEST['resetPasswordCode'];

        //check url
        if ($email == '' || $resetPasswordCode == '') {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Url incorrect. Please check again');
            return $this->setRender('account');
        }

        //check email and resetPasswordCode
        $customerVo = new CustomerVo();
        $customerVo->email = $email;
        $customerVo->resetPasswordCode = $resetPasswordCode;
        $customerVos = $this->customerDao->selectByFilter($customerVo);
        if (!$customerVos) {
            SessionMessage::addSessionMessage(SessionMessage::$ERROR, 'Email address or resetPasswordCode incorrect');
            return $this->setRender('account');
        } else {
            $customerInfo = $customerVos[0];
        }

        //update new password
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_REQUEST['password'];
            $rePassword = $_REQUEST['retype_password'];

            //update
            $customerVo = new CustomerVo();
            $customerVo->password = md5($password);
            $customerVo->resetPasswordCode = '';
            $this->customerDao->updateByPrimaryKey($customerVo, $customerInfo->customerId);

            //sendMail
            $link = "index.php?r=home/account";
            $siteName = Registry::getSetting('site_name');
            $emailData = array(
                'username' => $customerInfo->username,
                'link' => $link,
                'link_title' => Registry::getSetting('base_url') . '/' . $link,
                'site_name' => $siteName,
            );
            EmailHelper::sendMail($email, 'reset_password_success', $emailData);

            //message
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, 'Reset password success');

            //login
            $data = $customerInfo;
            $sessionType = 'customer';
            Session::setLogin($data, $sessionType);

            //view
            return $this->setRender('account');
        }

        return $this->setRender('success');
    }

    function customerAddressAddValidate() {
        //get data
        $customerAddressId = trim($_REQUEST['customerAddressId']);
        $address = trim($_REQUEST['address']);
        $validateData = array();
        //the address not empty
        if ($address == '') {
            $validateData ["address"] = 'Địa chỉ không được để trống';
        }
        // the address should not duplicate in the table
        $customerAddressVo = new CustomerAddressVo();
        $customerAddressVo->address = $address;
        $customerAddressVo->customerId = Session::getCustomerId();
        $customerAddressVos = $this->customerAddressDao->selectByFilter($customerAddressVo);
        if ($customerAddressVos) {
            $validateData ["address"] = 'Địa chỉ đã tồn tại';
        }
        return $validateData;
    }

    function customerAddressAddView() {
        return $this->setRender('success');
    }

    function customerAddressAdd() {
        //get data
        $address = trim($_REQUEST['address']);

        $validateData = $this->customerAddressAddValidate();
        if (empty ($validateData)) {
            $customerAddressVo = new CustomerAddressVo();
            $customerAddressVo->customerId = Session::getCustomerId();
            $customerAddressVo->address = $address;
            $customerAddressVo->defaultShipping = 0;
            $customerAddressVo->defaultBilling = 0;
            $this->customerAddressDao->insert($customerAddressVo);
            SessionMessage::setJsonData(array(
                'message' => 'Thêm địa chỉ thành công'
            ));
        } else {
            SessionMessage::setJsonData(array(
                'errorCode' => 'ERROR',
                'extra' => array(
                    'validateData' => $validateData
                ),
            ));
        }
        return $this->setRender('success');
    }

    function customerAddressEditValidate() {
        //get data
        $customerAddressId = trim($_REQUEST['customerAddressId']);
        $address = trim($_REQUEST['address']);
        $validateData = array();
        //the address not empty
        if ($address == '') {
            $validateData ["address"] = 'Địa chỉ không được để trống';
        }
        // the address should not duplicate in the table
        $customerAddressVo = new CustomerAddressVo();
        $customerAddressVo->address = $address;
        $customerAddressVo->customerId = Session::getCustomerId();
        $customerAddressVos = $this->customerAddressDao->selectByFilter($customerAddressVo);
        if ($customerAddressVos) {
            $customerAddress = $customerAddressVos [0];
            if ($customerAddress->customerAddressId != $customerAddressId) {
                $validateData ["address"] = 'Địa chỉ đã tồn tại';
            }
        }
        return $validateData;
    }

    function customerAddressEditView() {
        //get data
        $customerAddressId = $_REQUEST['customerAddressId'];
        $customerAddressVo = new CustomerAddressVo();
        $customerAddressVo->customerAddressId = $customerAddressId;
        $customerAddressVo->customerId = Session::getCustomerId();
        $customerAddressVos = $this->customerAddressDao->selectByFilter($customerAddressVo);
        if ($customerAddressVos) {
            //send data
            $this->setAttributes(array(
                'customerAddressVo' => $customerAddressVos[0],
            ));
        }
        return $this->setRender('success');
    }

    function customerAddressEdit() {
        //get data
        $customerAddressId = trim($_REQUEST['customerAddressId']);
        $address = trim($_REQUEST['address']);
        $validateData = $this->customerAddressEditValidate();
        if (empty ($validateData)) {
            $customerAddressVo = new CustomerAddressVo();
            $customerAddressVo->address = $address;
            $this->customerAddressDao->updateByPrimaryKey($customerAddressVo, $customerAddressId);
            SessionMessage::setJsonData(array(
                'errorCode' => 'SUCCESS',
                'message' => 'Sửa địa chỉ thành công',
            ));
        } else {
            SessionMessage::setJsonData(array(
                'errorCode' => 'ERROR',
                'extra' => array(
                    'validateData' => $validateData
                ),
            ));
        }
        return $this->setRender('success');
    }

    function customerAddressDeleteView() {
        //get data
        $customerAddressId = $_REQUEST['customerAddressId'];
        $customerAddressVo = new CustomerAddressVo();
        $customerAddressVo->customerAddressId = $customerAddressId;
        $customerAddressVo->customerId = Session::getCustomerId();
        $customerAddressVos = $this->customerAddressDao->selectByFilter($customerAddressVo);
        if ($customerAddressVos) {
            //send data
            $this->setAttributes(array(
                'customerAddressVo' => $customerAddressVos[0],
            ));
        }
        return $this->setRender('success');
    }

    function customerAddressDelete() {
        //get data
        $customerAddressId = $_REQUEST['customerAddressId'];
        $this->customerAddressDao->deleteByPrimaryKey($customerAddressId);
        SessionMessage::setJsonData(array(
            'message' => 'Xóa địa chỉ thành công'
        ));
        return $this->setRender('success');
    }

    function customerAddressRefresh() {
        //get customerInfo
        $customerId = Session::getCustomerId();
        $customerInfo = CustomerExt::getCustomerInfo($customerId);
        $customerAddressList = CustomerExt::getCustomerAddressList($customerId);

        //send data
        $this->setAttributes(array(
            'customerInfo' => $customerInfo,
            'customerAddressList' => $customerAddressList
        ));

        return $this->setRender('success');
    }
}