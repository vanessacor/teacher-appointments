<?php


use App\Repositories\ApiRepository;
use App\Controllers\ConsultaApiController;
use App\Controllers\ConsultaMvcController;
use App\Database;
use App\Repositories\ConsultaRepository;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode( '/', $path);


$userId = null;
if (isset($pathParts[1])) {
    $userId = (string) $pathParts[1];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$database = new Database();
$repository = new ConsultaRepository($database);
// $controller = new ConsultaApiController($database);
$controller = new ConsultaMvcController($repository);
    // $controller->processRequest($requestMethod, $userId);


