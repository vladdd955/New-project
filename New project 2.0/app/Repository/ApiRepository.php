<?php


namespace App\Repository;


class ApiRepository

{
    public function execute()
    {
        $url = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest';
        $parameters = [
            'id'=>'1,2,3,4,5,6,7,8,9,10'
//            'start' => '1',
//            'limit' => '5000',
//            'convert' => 'USD'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: 7baca6f5-a8e4-4568-afe3-8fa2bb2971b8'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
// Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        $a= json_decode($response); // print json decoded response

//        echo "<pre>";
//        var_dump($a);

        curl_close($curl); // Close request

        return $a;

    }
}