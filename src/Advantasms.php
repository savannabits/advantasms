<?php

namespace Savannabits\Advantasms;

class Advantasms
{
    private $apikey, $partnerId, $shortcode;
    private $message, $to;
    private $baseUrl = "https://quicksms.advantasms.com/api/services";
    private $sendsms = "/sendsms";
    /**
     * Advantasms constructor.
     * @param string $apiKey |The advanta sms API Key. See documentation for more details
     * @param string $partnerId | The Partner ID. See advantaSMS documentation for more details
     * @param string $shortCode | The Shortcode of used to send sms. See documentation for more details
     * @return Advantasms
     */
    public function __construct($apiKey, $partnerId, $shortCode)
    {
        $this->apikey = $apiKey;
        $this->partnerId = $partnerId;
        $this->shortCode = $shortCode;
        return $this;
    }

    /**
     * Instantiate the Advantasms class.
     * @param string $apiKey |The advanta sms API Key. See documentation for more details
     * @param string $partnerId | The Partner ID. See advantaSMS documentation for more details
     * @param string $shortCode | The Shortcode of used to send sms. See documentation for more details
     * @return Advantasms
     */
    public static function init($apiKey,$partnerId, $shortCode) {
        $instance = new self($apiKey,$partnerId,$shortCode);
        return $instance;
    }

    /**
     * @param $mobileNumber
     * @return Advantasms
     */
    public function to($mobileNumber) {
        $this->to = $mobileNumber;
        return $this;
    }

    /**
     * @param string $message
     * @return Advantasms
     */
    public function message(string $message="") {
        $this->message = $message;
        return $this;
    }

    /**
     * Execute sms sending action
     * @return array|mixed
     */
    public function send() {
        $data = [
            "apikey"=>$this->apikey,
            "partnerID"=>trim($this->partnerId),
            "message"=>trim($this->message),
            "shortcode"=>$this->shortcode,
            "mobile"=>trim($this->to)
        ];
        $response = $this->curlPost($this->sendsms,$data);
        return $response;
    }

    /**
     * Execute sms sending action
     * @param string $time | Time when the sms will be sent in the format Y-m-d H:i
     * @return array|mixed
     */
    public function schedule(string $time) {
        $data = [
            "apikey"=>$this->apikey,
            "partnerID"=>trim($this->partnerId),
            "message"=>trim($this->message),
            "shortcode"=>$this->shortcode,
            "mobile"=>trim($this->to),
            "timeToSend" => trim($time),
        ];
        $response = $this->curlPost($this->sendsms,$data);
        return $response;
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @param array $headers
     * @return array|mixed
     */
    private function curlPost(string $endpoint, array $data, array $headers=[]) {
        $url = $this->baseUrl.$endpoint;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge(array('Content-Type:application/json'),$headers));

        $data_string = json_encode($data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_response = curl_exec($curl);
        return json_decode($curl_response);
    }

}
