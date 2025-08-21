<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$db_server = $_ENV['DB_SERVER'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_NAME'];

$connect = mysqli_connect($db_server, $db_username, $db_password, $db_name);

if(!$connect){
   error_log('Connessione fallita: ' . mysqli_connect_error());
   die('Connessione fallita');
}
