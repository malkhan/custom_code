<?php
require_once('TwitterAPIExchange.php'); //get it from https://github.com/J7mbo/twitter-api-php

$consumerkey = "o3g5AEvF38lTBgOJ2EX83Reza";
$consumersecret = "iKREmxKTAckMx9cfPovSOBnm4jMzcQf4zb7HPV3DH6AzUmJY2i";
$accesstoken = "3424775721-B095GmVlLRdGLXWMfKh2ttVMcJibQLVj6JQLIdW";
$accesstokensecret = "kUbhUrrJFoTWVjsrpWuagfsGz42DIE83QaJH7MeRBp8HC";
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
'oauth_access_token' => $accesstoken,
'oauth_access_token_secret' => $accesstokensecret,
'consumer_key' => $consumerkey,
'consumer_secret' => $consumersecret
);

$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=swingrs';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$follow_count=$twitter->setGetfield($getfield)
->buildOauth($ta_url, $requestMethod)
->performRequest();
$data = json_decode($follow_count, true);
//print_r($data);
$followers_count=$data[0]['user']['followers_count'];
echo $followers_count;
?>
