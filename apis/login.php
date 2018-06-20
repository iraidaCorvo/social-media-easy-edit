<?php 
require_once('facebook/src/Facebook/autoload.php');
$fb = new Facebook\Facebook([
  'app_id' => '1341030475997360', // Replace {app-id} with your app id
  'app_secret' => '9e1db82677362f4b6c0c056674f9f758',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/web-social/testing', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';