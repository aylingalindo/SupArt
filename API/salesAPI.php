<?php
session_start();
 include_once '../Consultas/cartConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $sales = new salesAPI();
    echo($action);

    switch ($action) {
        case 'getAll':
            $sales->getAll();
            break;
    }
}

class salesAPI {
    public function __construct() {
        
    }

    //SELECT ALL PRODUCTS
    function getAll() {
        $option = 1;
        $mySales = new Cart();
        
        $arrSales = array();
		$arrSales["sales"] = array();
        $_SESSION['salesAPI'] = array();	

        $resultado = $sales->salesManagement($option, $seller);

        if(isset($resultado))
		{
			while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
			{
				$sale = array(
                    "productName" => $row['productName'],
                    "productDescription" => $row['productDescription'],
                    "purchaseDate" => $row['purchaseDate'],
                    "sellerUserID" => $row['sellerUserID'],
                    "buyerUserID" => $row['buyerUserID'],
                    "total" => $row['total'],
                    "numItems" => $row['numItems']
				);

				array_push($arrSales["sales"], $sale);
			}
            $_SESSION['salesAPI'] = $arrSales["sales"];
		} else {
            echo 'this is the result--->' . $resultado . '<---';
			echo json_encode(array('mensaje' => 'No hay elementos'));
		}
    }

}
?>