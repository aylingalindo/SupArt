<?php
session_start();
 include_once '../Consultas/payConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $purchase = new purchaseAPI();
    echo($action);

    switch ($action) {
        case:
        break;
    }
}

class purchaseAPI {
    public function __construct() {
        
    }
}

?>
