<?php

namespace app\Controller;
include "../app/Traits/ApiResponseFormatter.php";
include "E:\PERKULIAHAN UMM\SEMESTER 5\PEMROGRAMAN WEB\MODUL4\codelabcopyorang\T2-BE\app\Models\Rent.php";

use app\Models\Rent;
use app\Traits\ApiResponseFormatter;

class RentController
{
    use ApiResponseFormatter;

    public function index()
    {
        $RentModel = new Rent();
        $response = $RentModel->findAll();
    
        if (empty($response)) {  
            return $this->apiResponse(404, "No data found", []);
        }else{
            return $this->apiResponse(200, "success", $response);
        }
        
    }
    

    public function insert()
    {

        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        if (!isset($inputData['name'])) {
            return $this->apiResponse(400, "Error: Invalid input", null);
        }

        $RentModel = new Rent();
        $response = $RentModel->create($inputData);
        
        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);

        if (!isset($inputData['name'])) {
            return $this->apiResponse(400, "Error: Invalid input", null);
        }

        $RentModel = new Rent();
        $response = $RentModel->update($inputData, $id);
        
        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $RentModel = new Rent();
        $response = $RentModel->delete($id);
        
        return $this->apiResponse(200, "success", $response);
    }
}