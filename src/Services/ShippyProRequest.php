<?php

namespace yax\ShippyProConnector\Services;
use GuzzleHttp\Client;

class ShippyProRequest{
    protected $api_key, $headers;
    private $endpoint = 'https://www.shippypro.com/api';

    public function __construct()
    {
        $this->api_key = config('shippypro.api_key');
        $this->setHeaders();
    }

    /**
     * Directly communicate with Shippypro API
     *
     * @param array $fields API body array
     * @param string $method API method
     *
     * @throws \Exception Shippypro API excepction
     * @return object Response from Shippypro API
     */
    public function call(array $fields, $method){
        $client = new Client(['headers' => $this->headers]);
        $response = $client->request('POST', $this->endpoint, ['json' => array_merge(['Params' => $fields], ['Method' => $method])]);
        try{
            return json_decode($response->getBody()->getContents());
        }catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * Set Guzzle request headers and convert API key to basic auth
     *
     * @return void
     */
    protected function setHeaders(){
        $key = base64_encode ($this->api_key.':');
        $this->headers = array(
            'Content-Type' => "application/json",
            'Authorization' => "Basic ".$key
        );
    }
}
