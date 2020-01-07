<?php

namespace TinderApi;

use \GuzzleHttp\Client;

class Request{
    private $apiPath = "https://api.gotinder.com";
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            "base_uri" => $this->apiPath
        ]);
    }

    public function getClient(){
        return $this->client;
    }



}