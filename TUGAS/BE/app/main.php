<?php

    header("Content-type: application/json;");

    include "Routes/RentRoutes.php";

    use app\Routes\RentRoutes;

    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $productRoutes = new RentRoutes;
    $productRoutes->handle($method, $path);
?>

