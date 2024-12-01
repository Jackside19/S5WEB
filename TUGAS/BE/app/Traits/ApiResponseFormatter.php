<?php
    namespace app\Traits;
    trait ApiResponseFormatter
    {
        public function apiResponse($code, $message, $data = []){
            
            return json_encode([
                "code" => $code,
                "message" => $message,
                "data" => $data
            ]);
         
        }

    }
?>