<?php
define('CONSUMER_KEY', Registry::getSetting('twitter_consumer_key'));
define('CONSUMER_SECRET', Registry::getSetting('twitter_consumer_secret'));
define('OAUTH_CALLBACK', Registry::getSetting('twitter_oauth_callback'));

session_start();
include_once("twitteroauth.php");
//Fresh authentication
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

$_SESSION['token'] 			= $request_token['oauth_token'];
$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];

$twitter_url = "#";
//Any value other than 200 is failure, so continue only if http code is 200
/*
if($connection->http_code == '200')
{
	//redirect user to twitter
	$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
}*/
?>