<?php
session_start();

$response = array();

if (isset($_SESSION['usersAPI'])) {
    $response['authenticated'] = true;
    $response['rol']=$_SESSION['usersAPI']['rol'];
} else {
    $response['authenticated'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);
?>