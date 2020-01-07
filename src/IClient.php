<?php

namespace TinderApi;

interface IClient{
    public function request($uri, $api, $headers, $requestBody);
}