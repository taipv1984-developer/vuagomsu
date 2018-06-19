<?php

class HomeContactController extends Controller {
    function __construct() {
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            ContactExt::addContact();
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Đăng ký thành công. Chúng tôi sẽ liên lạc với bạn sớm nhất");
            return $this->setRender('home');
        }

        return $this->setRender('success');
    }
}