<?php 

require "twitter/twitteroauth/vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

function api_twitter(){
    $access_token = '1006614800485572609-TDxmvfIQ0G3IKWTrEL8yp0acx2zPgT';
    $access_token_secret = 'hHmehO67oktWKD9vEtLTTLEkDUENN3ib0tngksNgZEXob';
    $connection = new TwitterOAuth(
        'axY4nAnfGWwNyAxwcGyWyTsLg',    // CONSUMER_KEY,
        's2hNEwuUsgMQFvIrqzLFnbSL4TCvtPfXIXQiOJu2HKLkprkQWc',  // CONSUMER_SECRET,
        $access_token,
        $access_token_secret
    );
    $content = $connection->get("account/verify_credentials");
    showArray($content);
}