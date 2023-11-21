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
        case 'removeProduct':
            $review->removeProduct();
            break;
        case 'removeAll':
            $review->removeAll();
            break;
    }
}

class reviewAPI {
    public function __construct() {
        
    }

    //INSERT PRODUCT TO review
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

    //remove PRODUCT TO CART
    function removeProduct() {
        $myReview = new Review();
        
        $option = 2;
        $vProductID = isset($_POST['productId']) ? $_POST['productId'] : 'null';
        $vUserID = isset($_SESSION['usersAPI']['userID']) ? $_SESSION['usersAPI']['userID'] : 'null';

        echo $vUserID;
        echo $vProductID;

        $resultado = $myReview->reviewManagement(2, $vProductID, 'null', $vUserID, 'null', 'null');
        echo json_encode($resultado);

        $data = json_decode($_SESSION['cartProducts'], true);
echo json_encode($data);
    }

    function removeAll() {
        $myReview = new Review();
        
        $option = 3;
        $vUserID = isset($_SESSION['usersAPI']['userID']) ? $_SESSION['usersAPI']['userID'] : 'null';

        $resultado = $myReview->reviewManagement($option, 'null', 'null', $vUserID, 'null', 'null');
        echo json_encode($resultado);

        unset($_SESSION['cartProducts']);

    }

}
?>