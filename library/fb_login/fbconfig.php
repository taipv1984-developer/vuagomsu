<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1972176876399096','05097725a057ff6b8bd5b2641572593d' );
//FacebookSession::setDefaultApplication( '123266828178218','8a9e6e54c1bbf9507850b7a666c5356f' );
// login helper with redirect_uri
$baseUrl = $_SESSION['SW_SESSION_GROUP']['BASE_URL'];
$helper = new FacebookRedirectLoginHelper(LIBRARY_PATH.'fb_login/fbconfig.php');
try {
    $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
// When Facebook returns an error
} catch( Exception $ex ) {
// When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
    // graph api request for user data
    //   $request = new FacebookRequest( $session, 'GET', '/me' );
    $request = new FacebookRequest( $session, 'GET', '/me?fields=id,first_name,last_name,email,link,gender,locale,picture,birthday' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    /* ---- Session Variables -----*/
    $_SESSION['facebookLoginData']['id'] = $graphObject->getProperty('id');
    $_SESSION['facebookLoginData']['first_name'] = $graphObject->getProperty('first_name');
    $_SESSION['facebookLoginData']['last_name'] = $graphObject->getProperty('last_name');
    $_SESSION['facebookLoginData']['email'] =  $graphObject->getProperty('email');
    $_SESSION['facebookLoginData']['locale'] = $graphObject->getProperty('locale');
    $_SESSION['facebookLoginData']['birthday'] = $graphObject->getProperty('birthday');
    $_SESSION['facebookLoginData']['graphObject'] =  $graphObject;
    /* ---- header location after session ----*/
    header("Location: $baseUrl/index.php?r=home/facebook/login/callback");
//    header("Location: $baseUrl/dang-ky?oauthProvider=facebook&oauthId=".$graphObject->getProperty('id'));
} else {
    $loginUrl = $helper->getLoginUrl();
    header("Location: ".$loginUrl);
}
?>