<?php

class HomeController extends Controller {
    function __construct() {
    }

    public function page_404() {
        return $this->setRender('success');
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            ContactExt::addContact();
            SessionMessage::addSessionMessage(SessionMessage::$SUCCESS, "Đăng ký thành công. Chúng tôi sẽ liên lạc với bạn sớm nhất");
            return $this->setRender('home');
        }

        return $this->setRender('success');
    }

    public function lopCaNhan() {
        return $this->setRender('success');
    }

    public function lopNhom() {
        return $this->setRender('success');
    }

    public function setSession() {
        $sessionName = $_REQUEST['sessionName'];
        $sessionValue = $_REQUEST['sessionValue'];
        Session::setSession($sessionName, $sessionValue);
        return $this->setRender('success');
    }

    /**
     * action ajax on(change country, state, city)
     */
    public function address_ajax() {
        $input = array(
            'url' => $_POST ['url'],
            'country' => array(
                'id' => $_POST ['countryId'],
                'name' => $_POST ['countryName'],
                'value' => $_POST ['countryValue']
            ),
            'state' => array(
                'id' => $_POST ['stateId'],
                'name' => $_POST ['stateName'],
                'value' => $_POST ['stateValue']
            ),
            'city' => array(
                'id' => $_POST ['cityId'],
                'name' => $_POST ['cityName'],
                'value' => $_POST ['cityValue']
            ),
            'district' => array(
                'id' => $_POST ['districtId'],
                'name' => $_POST ['districtName'],
                'value' => $_POST ['districtValue']
            )
        );
        switch ($_POST ['object']) {
            case $_POST ['countryId'] : // country
                TemplateHelper::getTemplate('common/address_ajax/country_ajax.php', $input);
                break;
            case $_POST ['stateId'] : // state
                TemplateHelper::getTemplate('common/address_ajax/state_ajax.php', $input);
                break;
            case $_POST ['cityId'] : // city
                TemplateHelper::getTemplate('common/address_ajax/city_ajax.php', $input);
                break;
        }

        return $this->setRender('success');
    }
}