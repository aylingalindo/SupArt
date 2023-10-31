<?php
session_start();
 include_once '../Consultas/cartConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $cart = new cartsAPI();
    echo($action);

    switch ($action) {
        case 'insert':
            $cart->addProduct();
            break;
    }
}

class cartsAPI {
    public function __construct() {
        
    }

    //INSERT PRODUCT TO CART
    function addProduct() {
        $myCart = new Cart();
        //$userID = $_SESSION['usersAPI']['userID'];
        //$numItems = $_POST['numItems'];

        


        echo 'Adding to cart';
        if (isset($_SESSION['usersAPI']['userID']) && isset($_POST['numItems'])/* && isset($_SESSION['productsAPI']['productID'])*/) 
        {
                echo '  inside if cart';
                $myCart = new Cart();
                $option = 1;
                $userID = $_SESSION['usersAPI']['userID'];
                /* USAR ESTE CUANDO API PRODUCTO FUNCIONE */ //$productID = $_SESSION['productsAPI']['productID']);
                /* QUITAR CUANDO API DE PRODUCTO FUNCIONE */$productID = (isset($_SESSION['productsAPI']['productID'])) ? $_SESSION['productsAPI']['productID'] : 1;
                $numItems = $_POST['numItems'];

                echo $userID . '<-- this user id.....';
                echo $productID . '<-- this $productID id.....';
                echo $numItems . '<-- this $numItems id.....';


                $resultado = $myCart->cartManagement($option, $productID, $numItems, $userID);
                echo json_encode($resultado) . '<----- es este';
                echo ($resultado) . '<----- es este x2';

                
                /*echo " <script language='JavaScript'>
                alert('Se agrego el producto al carrito con exito');
                </script>";*/
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }
}
?>