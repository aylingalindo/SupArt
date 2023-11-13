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
        case 'getAll':
            $cart->getAll();
            break;
        case 'update':
            $cart->updateCart();
            break;
    }
}

class cartsAPI {
    public function __construct() {
        
    }

    //INSERT PRODUCT TO CART
    function addProduct() {
        $myCart = new Cart();
        
        echo 'Adding to cart';
        if (isset($_SESSION['usersAPI']['userID']) && isset($_POST['numItems'])/* && isset($_SESSION['productsAPI']['productID'])*/) 
        {
                echo '  inside if cart';
                $myCart = new Cart();
                $option = 1;
                $userID = $_SESSION['usersAPI']['userID'];
                /* USAR ESTE CUANDO API PRODUCTO FUNCIONE */ //$productID = $_SESSION['productsAPI']['productID']);
                /* QUITAR CUANDO API DE PRODUCTO FUNCIONE */$productID = (isset($_SESSION['productsAPI']['productID'])) ? $_SESSION['productsAPI']['productID'] : 4;
                $numItems = $_POST['numItems'];

                echo $userID . '<-- this user id.....';
                echo $productID . '<-- this $productID id.....';
                echo $numItems . '<-- this $numItems id.....';


                $resultado = $myCart->cartManagement($option, $productID, $numItems, $userID);
                echo json_encode($resultado);
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }

    //SELECT ALL PRODUCTS
    function getAll() {
        $myCart = new Cart();
        
        echo 'get all to cart';
        $option = 2;
        $myCart = new Cart();

        $arrProducts = array();
		$arrProducts["cart"] = array();
        $_SESSION['cartProducts'] = array();	
        echo "antes";
		echo json_encode($_SESSION['cartProducts']);
        echo json_encode($arrProducts["cart"]);
        echo ".....";

        $resultado = $myCart->cartManagement($option, 'null', 'null', 'null');
                echo json_encode($resultado);
        if(isset($resultado))
		{
            
			while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
			{
				$product = array(
					"cartID" => $row['cartID'],
					"product" => $row['product'],
					"numItems" => $row['numItems'],
					"user" => $row['user'],
					"name" => $row['name'],
					"description" => $row['description'],
					"pricingType" => $row['pricingType'],
					"price" => $row['price'],
					"review" => $row['review'],
					"category" => $row['category'],
					"totalStock" => $row['totalStock']
				);

				array_push($arrProducts["cart"], $product);
			}
            $_SESSION['cartProducts'] = $arrProducts["cart"];
			echo json_encode($_SESSION['cartProducts']);
			echo json_encode($arrProducts);
		} else {
            echo 'this is the result--->' . $resultado . '<---';
			echo json_encode(array('mensaje' => 'No hay elementos'));
		}
    }

    //UPDATE NUMITEMS
    function updateCart() {
        $myCart = new Cart();
        
        if (isset($_POST['id']) && isset($_POST['numItems'])) 
        {
                $myCart = new Cart();
                $option = 3;
                $productID = $_POST['id'];
                $numItems = $_POST['numItems'];

                $resultado = $myCart->cartManagement($option, $productID, $numItems, 'null');
                echo json_encode($resultado);
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }
}
?>