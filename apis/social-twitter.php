<?php
class smee_twitter extends smee_social_base{
    
    function __construct() {
    // $this->config['access_token'] = $access_token;
    //     $this->access_token_secret = $access_token_secret;
    //     $this->callback_url = $callback_url;
        $this->platform = 'twitter';
        parent::__construct();
    }
}