<?php
session_start();
 include_once '../Consultas/pedidosventasConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $sales = new salesAPI();
    echo($action);

    switch ($action) {
        case 'getAll':
            $sales->getAll();
            $sales->getGroupedSales();
            break;
    }
}

class salesAPI {
    public function __construct() {
        
    }

    //SELECT ALL PRODUCTS
    function getAll() {
        $mySales = new Ventas();
        $this->isSeller() ? $option = 1 : $option = 2;
        
        $arrSales = array();
		$arrSales["sales"] = array();
        $_SESSION['salesAPI'] = array();	

        $seller = $_SESSION['usersAPI']['userID']; 
        $resultado = $mySales->salesManagement($option, $seller);

        if(isset($resultado))
		{
			while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
			{
                foreach ($row as $key => $value) {
                    echo "Key: $key, Value: $value\n";
                }
				$sale = array(
                    "productName" => $row['productName'],
                    "category" => $row['category'],
                    "image" => $row['image'],
                    "purchaseDate" => $row['purchaseDate'],
                    "sellerUserID" => $row['SellerID'],
                    "buyerUserID" => $row['BuyerID'],
                    "total" => $row['total'],
                    "numItems" => $row['numItems'],
                    "folio" => $row['folio'],
                    "review" => $row['review'],
                    "stock" => $row['stock']
				);

				array_push($arrSales["sales"], $sale);
			}
            $_SESSION['salesAPI'] = $arrSales["sales"];
		} else {
            echo 'this is the result--->' . $resultado . '<---';
			echo json_encode(array('mensaje' => 'No hay elementos'));
		}
    }

    //validate the user rol
    function isSeller(){
        $seller = $_SESSION['usersAPI']['userID']; 
        $rol = $_SESSION['usersAPI']['rol'];

        $isSeller = $rol == '2' ? true: false;
        return $isSeller;
    }

    //get grouped sales by month and year, by category
    function getGroupedSales() {
        $mySales = new Ventas();
        $option = 3;
        
        $arrSales = array();
		$arrSales["sales"] = array();
        $_SESSION['gr_salesAPI'] = array();	

        $seller = $_SESSION['usersAPI']['userID']; 
        $resultado = $mySales->salesManagement($option, $seller);

            echo json_encode($resultado);
        if(isset($resultado))
		{
			while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
			{
                foreach ($row as $key => $value) {
                    echo "+++ grouped +++  ";
                    echo "Key: $key, Value: $value\n";
                }
				$sale = array(
                    "Category" => $row['Category'],
                    "Date" => $row['Date'],
                    "Sales" => $row['Sales']
				);

				array_push($arrSales["sales"], $sale);
			}
            $_SESSION['gr_salesAPI'] = $arrSales["sales"];
		} else {
            echo 'this is the result--->' . $resultado . '<---';
			echo json_encode(array('mensaje' => 'No hay elementos'));
		}
    }
}
?>