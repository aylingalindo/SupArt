<?php
session_start();
 include_once '../Consultas/reviewConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $review = new reviewAPI();
    echo($action);

    switch ($action) {
        case 'insert':
            $review->insertReview();
            break;
    }
}

class reviewAPI {
    public function __construct() {
        
    }

    //INSERT PRODUCT TO CART
    function insertReview() {
        $myReview = new Review();
        
        $option = 1;
        $vProductID = isset($_POST['productId']) ? $_POST['productId'] : 'null';
        $vScore = isset($_POST['score']) ? $_POST['score'] : 'null';
        $vUserID = isset($_SESSION['usersAPI']['userID']) ? $_SESSION['usersAPI']['userID'] : 'null';
        $vCommentText = isset($_POST['comment']) ? "'" . $_POST['comment'] . "'": 'null';
        $vPurchaseID = isset($_SESSION['purchase']['id']) ? $_SESSION['purchase']['id'] : 'null';


        echo $vUserID;
        echo $vCommentText;
        echo $vPurchaseID;

        $resultado = $myReview->reviewManagement(1, $vProductID, $vScore, $vUserID, $vCommentText, $vPurchaseID);
        echo json_encode($resultado);
    }

    //SELECT ALL PRODUCTS
    function getAll() {
        echo 'get all to cart';
        $option = 2;
        $myCart = new Cart();
        $userID = $_SESSION['usersAPI']['userID'];

        $arrProducts = array();
        $arrProducts["cart"] = array();
        $_SESSION['cartProducts'] = array();    
        echo "antes";
        echo json_encode($_SESSION['cartProducts']);
        echo json_encode($arrProducts["cart"]);
        echo ".....";

        $resultado = $myCart->cartManagement($option, 'null', 'null', $userID);
                echo json_encode($resultado);
        if(isset($resultado))
        {
            
            while($row = $resultado->fetch(PDO::FETCH_ASSOC))   
            {
                $product = array(
                    "totalPrice" => $row['TotalToPay'],
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
}
?>