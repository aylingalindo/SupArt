<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
 include_once '../Consultas/listConsult.php';
 include_once 'Consultas/listConsult.php';

 session_start();


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $listAPI = new listAPI();

    switch($action){
        case 'insert': 
            $listAPI->new();
            break;
        case 'insertItem':
            $listAPI->newItem();
            break;
    } 
}

class listAPI {
    public function __construct() {
        
    }

    function new() {
        echo 'en new';
        $list = new Wishlist();

        if (isset($_POST['wishlistName']) && isset($_POST['wishlistDesc']) ) 
        {
            $name = $_POST['wishlistName'];   
            $desc = $_POST['wishlistDesc']; 
            $userID =  $_SESSION['usersAPI']['userID'];    

            echo 'name:' . $name;
            echo 'desc:' . $desc;

            $resultado = $list->listManagement(2, null, $name, $desc, $userID);

            echo " <script language='JavaScript'>
                    alert('Se creó la wishlist con exito');
                    location.assign('../wishlist.php')
                    </script>";

        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }

    }

    function newItem() {
        echo 'en new item';
        $list = new Wishlist();

        if (isset($_POST['wishlist']) && isset($_POST['product']) ) 
        {
            $wishlist = $_POST['wishlist'];   
            $product = $_POST['product'];   

            $resultado = $list->listItemsManagement($wishlist, $product, 0);

            echo " <script language='JavaScript'>
                    alert('Se agregó el producto a la wishlist');
                    location.assign('../producto.php?productID=".$product."')
                    </script>";

        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }

    }

    /*function delete($listID) {
        $list = new List();

        $resultado = $list->listManagement(3, $listID, null, null, null);

        return $resultado; 

    }*/

    function show() {
        $list = new Wishlist();
        $userID =  $_SESSION['usersAPI']['userID']; 
        echo 'userID EN API: ' . $userID;

        $resultado = $list->showList($userID);

        return $resultado; 

    }

}
?>



