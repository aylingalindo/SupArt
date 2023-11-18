<?php
 include_once './Consultas/categoryConsult.php';
 include_once 'Consultas/categoryConsult.php';

 session_start();

 $catAPI = new categoryAPI();
 $catAPI->new();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $catAPI = new categoryAPI();
    echo($action);

    $catAPI->new();
}

class categoryAPI {
    public function __construct() {
        
    }

    //INSERT USER
    function new() {
        $cat = new Category();

        if (isset($_POST['catName']) && isset($_POST['catDesc']) ) 
        {

            $name = $_POST['catName'];   
            $desc = $_POST['catDesc'];
            $userID =  $_SESSION['usersAPI']['userID'];     

            $resultado = $cat->newCategory(2, $name, $userID, $desc);


            if (isset($_POST['editID'])) {
                $edit = $_POST['editID'];
                if(($edit == 0) || ($edit == null) || ($edit == '')){
                    $edit = '0';
                }
                echo 'dentro de edit: '.$edit;
                echo '<script>window.location.href = "../nuevoProducto.php?editID=' . $edit . '";</script>';

            }else {
                echo 'fuera de edit: '.$edit;
                echo '<script>window.location.href = "../nuevoProducto.php";</script>';
            }
        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }

    }

    function show() {
        $cat = new Category();

        $resultado = $cat->showCategories();

        return $resultado; 

    }

}
?>



