<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Log;

class UtilitiesServices {

    public function getRecentOpertaskToken(){

        try {
            $client = new Client();
            $options["headers"]["Authorization"] = env('API_PASSWORD');
            $response = $client->request(
                            "GET", 
                            env('OPERWORKSHOP_FE_URL') . '/api/utilities/token', 
                            $options
            );

            return json_decode((string) $response->getBody())->data->token;
        } catch (RequestException $exception) {
            print_r($exception->getResponse()->getBody()->getContents());
            throw $exception;
        }
        
        return false;
    }

}