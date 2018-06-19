<?php
session_start();

//Include Google client library 
include_once 'Google_Client.php';
include_once 'contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = Registry::getSetting('google_client_id');//'1096086816658-vnfe1i7cu02fq3b48ftjonf4do064uuf.apps.googleusercontent.com'; //Google client ID
$clientSecret = Registry::getSetting('google_client_secret');//'TPM8lAbec1k5JqD4CvlEjjcl'; //Google client secret
$redirectURL = Registry::getSetting('google_redirect_url');//'http://localhost/vdato_empty2/index.php?r=home/google/login'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>