<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Log;

class OperTaskServices {
    private function operRestCallback($method, $uri, $params = [], $token = null){
        $client = new Client();
        $options = [];
        $uri = env('OPERTASK_API_BASE_URL').$uri;


        if(!empty($params)){

            if($method == "GET"){
                $options["headers"] = [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ];

                $options["query"] = $params; 
            }else{
                $options["headers"] = [
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*'
                ];

                $options["json"] = $params;
            }

        }

        if($token != null){
            $options["headers"]["Authorization"] = "Bearer ".$token;
        }

        try{
            $response = $client->request(
                strtoupper($method),
                $uri,
                $options
            );

            Log::alert('REQUEST_INFO: \n\n URI: '.$uri.'\n\n Body: '.json_encode($params));
            Log::alert('REQUEST_RESPONSE: '.json_encode($response));
            
            return json_decode((string) $response->getBody());
        }catch(RequestException $e){
            $response = $e->getResponse();

            // Logging error
            Log::alert('REQUEST_INFO: \n\n URI: '.$uri.'\n\n Headers: '.json_encode($options));
            Log::alert('REQUEST_BODY: '.json_encode($params));
            Log::alert('ERROR_REQUEST: '.Psr7\str($e->getRequest()));
            Log::alert('ERROR_RESPONSE: '.json_encode($e->getResponse()));
            Log::alert('ERROR: '. json_encode($e->getMessage()));

            return json_decode(
                json_encode([
                    "code" => $e->getResponse()->getStatusCode() ?? "",
                    "message" => $e->getResponse()->getReasonPhrase() ?? ""
                ])
            );
        }
    }

    /**
     * getOrderByIdOrder
     * @param string idorder
     *      Reference to table booking_order_info on
     *      `oper_task_order_id`
     */
    public function getOrderByIdOrder($idorder, $token){
        return $this->operRestCallback(
            "GET",
            "/order/{$idorder}",
            null,
            $token
        );
    }

    /**
     * sendOrder
     * @method POST
     * A service to create order in OperTask API.
     * 
     * 
     * @param object request
     *      This Object 
     *      @param string task_template_id
     *      @param string booking_time
     *          string date time with format Y-m-d H:i:s
     *      @param string origin_latitude
     *          string from double origin_latitude
     *      @param string origin_longitude
     *          string from double origin_longitude
     *      @param string destination_latitude
     *          string from double destination_latitude
     *      @param string destination_latitude
     *          string from destination_latitude
     *      @param string user_fullname
     *      @param string user_phonenumber
     *      @param string vehicle_owner
     *      @param string vehicle_brand_id
     *          Reference to Master Brand
     *      @param string vehicle_type
     *          Vehicle name e.g. "Fortuner 2014"
     *      @param string vehicle_transmission
     *          For some reason always return CVT
     *      @param string client_vehicle_license
     *          Plat
     *      @param string message
     * 
     * @param string token 
     */
    public function sendOrder($request, $token){
        return $this->operRestCallback(
            "POST",
            "/order",
            $request,
            $token
        );
    }

}