<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\client;

function fetch() { 
    $client = new Client();

    $response = $client->request('GET','http://127.0.0.1:8181/api/sewa');
    $body = $response->getBody();
    
    $body = json_decode($body, true);
    return $body;
    }
?>