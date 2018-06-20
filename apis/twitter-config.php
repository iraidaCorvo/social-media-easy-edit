<?php
class Twitter{
    private $access_token;
    private $access_token_secret;
    
    function __construct($access_token, $access_token_secret, $callback_url=NULL) {
        $this->access_token = $access_token;
        $this->access_token_secret = $access_token_secret;
        $this->callback_url = $callback_url;
      }
}