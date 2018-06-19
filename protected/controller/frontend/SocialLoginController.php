<?php
require_once LIBRARY_PATH.'fb_login/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;

class SocialLoginController extends Controller{
	public $customerModel;
	public $customerDetailModel;
	private $customerDao;
	private $customerDetailDao;
	
	public function __construct(){
		$this->customerModel = new CustomerModel();
		$this->customerDetailModel = new CustomerDetailModel();
		$this->customerDao = new CustomerDao();
		$this->customerDetailDao = new CustomerDetailDao();
	}
	
	public function googleLogin(){
		include_once LIBRARY_PATH.'googleapi/gpConfig.php';
		
		if(isset($_REQUEST['code'])){
			$gClient->authenticate($_REQUEST['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			//header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}
	
		if (isset($_SESSION['token'])) {
			$gClient->setAccessToken($_SESSION['token']);
		}
	
		if ($gClient->getAccessToken()) {
			//Get user profile data from google
			$gpUserProfile = $google_oauthV2->userinfo->get();
	
			//Initialize Customer class
			$customerVo = new CustomerVo();
			$customerVo->roleId = 2;
			$customerVo->oauthProvider = 'google';
			$customerVo->oauthId =$gpUserProfile['id'];
			$customerVo->email = $gpUserProfile['email'];
			$customerVo->languageCode = $gpUserProfile['locale'];
			$customerVo->status = 'A';
			$customerVo->activeCode = '';
			$customerVo->crtBy = 0;
			$customerVo->crtDate = DateHelper::getDateTime();
			//Check customer
	
			$customer = CustomerExt::checkSocialAccountExit($customerVo);
			if($customer==null){
				$customerId = $this->customerDao->insert($customerVo);

				$customerDetailVo = new CustomerDetailVo();
				$customerDetailVo->customerId = $customerId;
				$customerDetailVo->firstName = $gpUserProfile['name'];
				//$customerDetailVo->firstName = $gpUserProfile['given_name'];
				//$customerDetailVo->lastName = $gpUserProfile['family_name'];
				$customerDetailVo->receiveEmail = 1;
				$this->customerDetailDao->insert($customerDetailVo);

                $customerInfo = CustomerExt::getCustomerInfo($customerId);
                $sessionType = 'customer';
                Session::setLogin($customerInfo, $sessionType);
			}
			else{
                $customerInfo = CustomerExt::getCustomerInfo($customer->customerId);
                $sessionType = 'customer';
                Session::setLogin($customerInfo, $sessionType);
			}
            $redirectUrl = Session::getSession('redirectUrl');
            if($redirectUrl){
                Session::deleteSession('redirectUrl');
                header("location: $redirectUrl");
                return;
            }
            else {
                return $this->setRender('account');
            }
		}else{
			$authUrl = $gClient->createAuthUrl();
			header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
		}
	}
	
	public function facebookLogin() {
        // init app with app id and secret
        FacebookSession::setDefaultApplication(Registry::getSetting('facebook_app_id'), Registry::getSetting('facebook_app_secret'));
        // login helper with redirect_uri
        $baseUrl = Registry::getSetting('base_url');
        $helper = new FacebookRedirectLoginHelper(LIBRARY_PATH.'fb_login/fbconfig.php');
        try {
            $session = $helper->getSessionFromRedirect();
        } catch( FacebookRequestException $ex ) {
            LogUtil::devInfo("[facebookLogin] FacebookRequestException $ex");
        } catch( Exception $ex ) {
            LogUtil::devInfo("[facebookLogin] Exception $ex");
        }
        $loginUrl = $helper->getLoginUrl();
        header("Location: ".$loginUrl);
    }
	function facebookLoginCallback(){
	    //get data
        $facebookLoginData = $_SESSION['facebookLoginData'];

        //Initialize Customer class
        $customerVo = new CustomerVo();
        $customerVo->roleId = 2;
        $customerVo->oauthProvider = 'facebook';
        $customerVo->oauthId =$facebookLoginData['id'];
        $customerVo->email = $facebookLoginData['email'];
        $customerVo->languageCode = $facebookLoginData['locale'];
        $customerVo->status = 'A';
        $customerVo->activeCode = '';
        $customerVo->crtBy = 0;
        $customerVo->crtDate = DateHelper::getDateTime();
        //Check customer

        $customer = CustomerExt::checkSocialAccountExit($customerVo);
        if($customer==null){
            $customerId = $this->customerDao->insert($customerVo);

            $customerDetailVo = new CustomerDetailVo();
            $customerDetailVo->customerId = $customerId;
            $customerDetailVo->firstName = $facebookLoginData['first_name'];
            $customerDetailVo->lastName = $facebookLoginData['last_name'];
            $customerDetailVo->receiveEmail = 1;
            $this->customerDetailDao->insert($customerDetailVo);

            $customerInfo = CustomerExt::getCustomerInfo($customerId);
            $sessionType = 'customer';
            Session::setLogin($customerInfo, $sessionType);
        }
        else{
            $customerInfo = CustomerExt::getCustomerInfo($customer->customerId);
            $sessionType = 'customer';
            Session::setLogin($customerInfo, $sessionType);
        }
        $redirectUrl = Session::getSession('redirectUrl');
        if($redirectUrl){
            Session::deleteSession('redirectUrl');
            header("location: $redirectUrl");
            return;
        }
        else {
            return $this->setRender('account');
        }
    }

	public function twitterLogin(){
		include_once LIBRARY_PATH.'twitterapi/config.php';
		if($connection->http_code == '200')
		{
			//redirect user to twitter
			$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $twitter_url);
		}else{
			SessionMessage::addSessionMessage ( SessionMessage::$ERROR, e ( 'Error, Connection!' ) );
			return $this->setRender("home");
		}
	}
	public function twitterLoginCallback(){
		include_once LIBRARY_PATH.'twitterapi/twitteroauth.php';
		/*
		if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
			//If token is old, distroy session and redirect user to index.php
			session_destroy();
			header('Location: index.php');
		
		}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {*/
		
//		var_dump('session_token='.$_SESSION['token']);
		
		if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
			//Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
			$connection = new TwitterOAuth(Registry::getSetting('twitter_consumer_key'), Registry::getSetting('twitter_consumer_secret'), $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			
			if($connection->http_code == '200')
			{
				//Redirect user to twitter
				//$_SESSION['status'] = 'verified';
				//$_SESSION['request_vars'] = $access_token;
		
				//Insert user into the database
				$user_info = $connection->get('account/verify_credentials');
				$name = explode(" ",$user_info->name);
				$fname = isset($name[0])?$name[0]:'';
				$lname = isset($name[1])?$name[1]:'';
				
				//Initialize CustomerVo class
				$customerVo = new CustomerVo();
				$customerVo->roleId = 2;
				$customerVo->oauthProvider = 'twitter';
				$customerVo->oauthId = $user_info->id;
				$customerVo->username = $user_info->screen_name;
				$customerVo->email = $user_info->email;
				$customerVo->languageCode = $user_info->lang;
				$customerVo->status = 'A';
				$customerVo->activeCode = '';
				$customerVo->crtBy = 0;
				$customerVo->crtDate = DateHelper::getDateTime();
					
				//Check customer
				$customer = CustomerExt::checkSocialAccountExit($customerVo);
				if($customer==null){
					$customerId = $this->customerDao->insertAccountUnRegister($customerVo);

					$customerDetailVo = new CustomerDetailVo();
					$customerDetailVo->customerId = $customerId;
					$customerDetailVo->firstName = $fname;
					$customerDetailVo->lastName = $lname;
					//$customerDetailVo->phone = $_REQUEST['phone'];
					$customerDetailVo->receiveEmail = 0;
					$this->customerDetailDao->insert($customerDetailVo);

                    $customerInfo = CustomerExt::getCustomerInfo($customerId);
                    $sessionType = 'customer';
                    Session::setLogin($customerInfo, $sessionType);
				}else{
                    $customerInfo = CustomerExt::getCustomerInfo($customer->customerId);
                    $sessionType = 'customer';
                    Session::setLogin($customerInfo, $sessionType);
				}
			}else{
				SessionMessage::addSessionMessage ( SessionMessage::$ERROR, e ( 'Error, try again later!' ) );
			}
		}
		return $this->setRender("home");
	}
}