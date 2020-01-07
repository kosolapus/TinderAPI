<?php

namespace TinderApi;

use GuzzleHttp\Exception\ServerException;

class Client implements IClient{
    public $headers = [
        "User-Agent"=>"Tinder Android Version 11.6.0",
        "tinder-version" => "11.6.0",
        "platform" => "android",
        "Host" => "api.gotinder.com"
        ];

    public function request($uri, $api, $method, $requestBody){
        $fullUrl = (is_null($api)?"":"/".$api."/").$uri;
        $request = new Request();
        $requestClient = $request->getClient();
        $result = null;

        try{
            $result = $requestClient->request(
                $method,
                $fullUrl,
                [
                    "version" => 2.0,
                    "headers" => $this->headers,
                    "json" => $requestBody
                ]
            );
        } catch (ServerException  $exception){
            $result = new \stdClass();
            dd($exception);
        }

        return $result;
    }

    public function setApiToken($token){
        $this->headers["x-auth-token"] = $token;
    }

    public function sendSms($phoneNumber){
        $headersBackup = $this->headers;
        $this->headers = null;
        $result = json_decode($this->request(
            "auth/sms/send?auth_type=sms",
            "v2",
            "POST",
            [
                "phone_number" => $phoneNumber
            ])->getBody()->getContents());
        $this->headers = $headersBackup;
        return $result;
    }

    public function loginBySms($phone, $otpCode){
        $headersBackup = $this->headers;
        $this->headers = null;
        $result = json_decode($this->request(
            "auth/sms/validate?auth_type=sms",
            "v2",
            "POST",
            [
                "phone_number"=>$phone,
                "otp_code" => $otpCode,
                "is_update" => false
            ])->getBody()->getContents());

        if($result->meta->status == 200){
            //getting api token from refreshToken
            $client = new Client;
            $refreshToken = $result->data->refresh_token;
            $result = json_decode($client->request(
                "auth/login/sms",
                "v2",
                "POST",
                [
                    "refresh_token" => $refreshToken
                ])->getBody()->getContents());
            $this->headers = $headersBackup;

        }
        else{
            $result = new \stdClass();
        }
        return $result;
    }

    public function like($id, $sNumber){
        $result = json_decode($this->request("like/".$id."?s_number=".$sNumber, null, "POST", null)->getBody()->getContents());
        return $result;
    }

    public function superLike($id, $sNumber){
        $result = json_decode($this->request("like/".$id."/super?s_number=".$sNumber, null, "POST", null)->getBody()->getContents());
        return $result;
    }

    public function pass($id, $sNumber){
        $result = json_decode($this->request("pass/".$id."?s_number=".$sNumber, null, "POST", null)->getBody()->getContents());
        return $result;
    }

    public function getTeasers(){
        $result = json_decode($this->request("fast-match/teasers", "v2", "GET", null)->getBody()->getContents());
        return $result;
    }

    public function getProfile($includes){
        $result = json_decode($this->request("profile?include=".join(",", $includes), "v2", "GET", null)->getBody()->getContents());
        return $result;
    }

    public function matches(){
        $result = json_decode($this->request("recs/core?limit=100", "v2", "GET", null)->getBody()->getContents());
        return $result;
    }

    public function getUserInfo($id){
        $result = json_decode($this->request("user/".$id, null, "GET", null)->getBody()->getContents());
        return $result;
    }

}
