<?php

use App\Infrastructure\Database\PostgresConnection;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Max-Age: 86400');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    exit;
}

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes.php';


$connection = PostgresConnection::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);