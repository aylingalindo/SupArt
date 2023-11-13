<?php
 include_once '../Consultas/categoryConsult.php';
 include_once 'Consultas/categoryConsult.php';

 session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $catAPI = new categoryAPI();
    echo($action);

    switch ($action) {
        case 'insert':
            $catAPI->new();
            break;
    }
}

class categoryAPI {
    public function __construct() {
        
    }

    //INSERT USER
    function new() {
        $cat = new Category();

        if (isset($_POST['name']) && isset($_POST['pricingType']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_POST['prodDesc']) && isset($_POST['productID'])) 
        {
            

                $name = $_POST['name'];   
                $pricingType = $_POST['pricingType'];
                

                if (isset($_SESSION['usersAPI']['userID'])){
                    $uploadedBy = $_SESSION['usersAPI']['userID']; 
                }else {
                    $uploadedBy = 0;
                }

                $option = 2;
                if ($productID != 0) {
                    $option = 3;
                }else {
                    $option = 2;
                    $productID = 0;
                }

                if($_POST['pricingType'] == "0"){
                    $pricingType = "Negotiable";
                }else {
                    $pricingType = "Sell";
                }


                $resultado = $cat->newCategory($option, $productID, $stock);

                echo json_encode($resultado) . '<----- es este';
                echo ($resultado) . '<----- es este x2';

                if ($option == 3) {
                    echo " <script language='JavaScript'>
                    alert('Se actualizó el producto con exito');
                    location.assign('../misProductos.php')
                    </script>";
                }else {
                    echo " <script language='JavaScript'>
                    alert('Se creó el producto con exito');
                    location.assign('../misProductos.php')
                    </script>";
                }
                //echo '<script>window.location.href = "../index.php";</script>';
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



