<?php

namespace app\Routes;
include "E:\PERKULIAHAN UMM\SEMESTER 5\PEMROGRAMAN WEB\MODUL4\codelabcopyorang\T2-BE\app\Controller\RentController.php";

use app\Controller\RentController;

class RentRoutes
{
    public function handle($method, $path)
    {
        if ($method == "GET" && $path == '/api/sewa') {
            $controller = new RentController();
            echo $controller->index();
        }

        if ($method == "POST" && $path == "/api/sewa") {
            $controller = new RentController();
            echo $controller->insert();
        }

        if ($method == "PUT" && strpos($path, "/api/sewa/") == 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            
            $controller = new RentController();
            echo $controller->update($id);
        }

        if ($method == "DELETE" && strpos($path, "/api/sewa/") == 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            
            $controller = new RentController();
            echo $controller->delete($id);
        }
    }
}

?>