<?php
require('connection.php');

$database = new Database();
$params = json_decode(file_get_contents('php://input'), true);
echo $database -> searchClients($params['searchingValue']);
?>