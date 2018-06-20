<?php

define('SMEE_APP_ID', '1341030475997360');
define('SMEE_APP_SECRET', '9e1db82677362f4b6c0c056674f9f758');
define('SMEE_ACCESS_TOKEN', 'EAAP9hArvboQBALeArvPtu5HZBJtvjG3xW3MdfeEZCFGP6Gyl9iGSpwUoZA7aK0CXkZBP6ZCZCWQeqAeb9ZCH45cEJo6NiQp7IcKz6CYcKM8ubZCEWW92oX1mbUQRtZBz6RsA39UYcrLqf8V9JFaPs6VCCEZBFEHMMv7Xwx8lPATth6P29MZBUJ1PFZCl');
//define('SMEE_ACCESS_TOKEN', '1341030475997360|BtFvmkt9AKDdiq1WUVU79MIHhoo');
define('SMEE_PAGE_ID','985936204915609');
include_once 'login.php';
include_once 'fb-callback.php';
session_start();
require_once( 'facebook/src/Facebook/autoload.php');

function testing_fb_api_bk(){
    $appID = SMEE_APP_ID;
    $appSecret = SMEE_APP_SECRET;
     
    //Create an access token using the APP ID and APP Secret.
    $accessToken = $appID . '|' . $appSecret;
     
    //The ID of the Facebook page in question.
    $id = SMEE_PAGE_ID;
     
    //Tie it all together to construct the URL
    $url = "https://graph.facebook.com/$id/posts?access_token=$accessToken";
    echo $url;
    //Make the API call
    $result = file_get_contents($url);
     
    //Decode the JSON result.
    $decoded = json_decode($result, true);
     
    //Dump it out onto the page so that we can take a look at the structure of the data.
    var_dump($decoded);
}
function testing_fb_api_bd(){
    //require_once( 'facebook/src/Facebook/autoload.php' );
    $pageID = SMEE_PAGE_ID;
    $fb = new Facebook\Facebook([
        'app_id' => SMEE_APP_ID,
        'app_secret' => SMEE_APP_SECRET,
        'default_graph_version' => 'v2.2',
    ]);
    
    showArray($fb-> getRedirectLoginHelper());
    /*$accessToken = SMEE_ACCESS_TOKEN;
    $fb->setDefaultAccessToken($accessToken);
    $requestUserName = $fb->request('GET', '/me?fields=id,name');

    // Get user likes
    $requestUserLikes = $fb->request('GET', '/me/likes?fields=id,name&amp;limit=1');
    
    // Get user events
    $requestUserEvents = $fb->request('GET', '/me/events?fields=id,name&amp;limit=2');
    
    // Post a status update with reference to the user's name
    $message = 'My name is {result=user-profile:$.name}.' . "\n\n";
    $message .= 'I like this page: {result=user-likes:$.data.0.name}.' . "\n\n";
    $message .= 'My next 2 events are {result=user-events:$.data.*.name}.';
    $statusUpdate = ['message' => $message];
    $requestPostToFeed = $fb->request('POST', '/me/feed', $statusUpdate);
    
    // Get user photos
    $requestUserPhotos = $fb->request('GET', '/me/photos?fields=id,source,name&amp;limit=2');
    
    $batch = [
         'user-profile' => $requestUserName,
         'user-likes' => $requestUserLikes,
         'user-events' => $requestUserEvents,
         //'post-to-feed' => $requestPostToFeed,
        'user-photos' => $requestUserPhotos,
    ];
    
    echo '<h1>Make a batch request</h1>' . "\n\n";
    
    try {
      $responses = $fb->sendBatchRequest($batch);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get(
          '/me/feed',
          $accessToken
        );
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
      //$graphNode = $response->getGraphNode();

    foreach ($responses as $key => $response) {
      if ($response->isError()) {
        $e = $response->getThrownException();
        echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
        echo '<p>Graph Said: ' . "\n\n";
        var_dump($e->getResponse());
      } else {
        echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
        echo "Response: " . $response->getBody() . "</p>\n\n";
        echo "<hr />\n\n";
      }
    }*/

}
function testing_fb_api_r(){
  $pageID = SMEE_PAGE_ID;
  $fb = new Facebook\Facebook([
      'app_id' => SMEE_APP_ID,
      'app_secret' => SMEE_APP_SECRET,
      'default_graph_version' => 'v2.2',
  ]);
  
  $helper = $fb->getCanvasHelper();
  
  $permissions = ['user_posts']; // optionnal
  
  try {
    if (isset($_SESSION['facebook_access_token'])) {
    $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
     // When Graph returns an error
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
     // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
   }
  
  if (isset($accessToken)) {
  
    if (isset($_SESSION['facebook_access_token'])) {
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
      $_SESSION['facebook_access_token'] = (string) $accessToken;
  
        // OAuth 2.0 client handler
      $oAuth2Client = $fb->getOAuth2Client();
  
      // Exchanges a short-lived access token for a long-lived one
      $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
  
      $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
  
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
  
    // validating the access token
    try {
      $request = $fb->get('/me');
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      if ($e->getCode() == 190) {
        unset($_SESSION['facebook_access_token']);
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl('https://localhost/web-social/testing/', $permissions);
        echo "<script>window.top.location.href='".$loginUrl."'</script>";
        exit;
      }
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  
    // getting all posts published by user
    try {
      $posts_request = $fb->get('/me/posts?limit=500');
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
  
    $total_posts = array();
    $posts_response = $posts_request->getGraphEdge();
    if($fb->next($posts_response)) {
      $response_array = $posts_response->asArray();
      $total_posts = array_merge($total_posts, $response_array);
      while ($posts_response = $fb->next($posts_response)) {
        $response_array = $posts_response->asArray();
        $total_posts = array_merge($total_posts, $response_array);
      }
      print_r($total_posts);
    } else {
      $posts_response = $posts_request->getGraphEdge()->asArray();
      print_r($posts_response);
    }
  
      // Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
  } else {
    $helper = $fb->getRedirectLoginHelper();
    $loginUrl = $helper->getLoginUrl('https://apps.facebook.com/smee_testing/', $permissions);
    //echo $loginUrl;
    echo "<script>window.top.location.href='".$loginUrl."'</script>";
  }
}
function testing_fb_api(){
  $pageID = SMEE_PAGE_ID;
  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get(
      '/me/feed',
      'SMEE_ACCESS_TOKEN'
    );
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $graphNode = $response->getGraphNode();
  /* handle the result */
}