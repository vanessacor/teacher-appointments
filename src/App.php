<?php


use App\Repositories\ApiRepository;
use App\Controllers\AppointmentApiController;
use App\Controllers\AppointmentController;
use App\Database;
use App\Repositories\AppointmentRepository;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode( '/', $path);


$userId = null;
if (isset($pathParts[1])) {
    $userId = (string) $pathParts[1];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$database = new Database();
$repository = new AppointmentRepository($database);
// $controller = new AppointmentApiController($database);
$controller = new AppointmentController($repository);
    // $controller->processRequest($requestMethod, $userId);


