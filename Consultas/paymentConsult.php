<?php
session_start(); 

include_once '../connectionPDO.php';
$db = new DB();
$conn = $db->connect();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);


if(is_array($datos)){
    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fechaFormato = date('Y-m-d H:i:s', strtotime($fecha));
    $userID = $_SESSION['usersAPI']['userID'];

    $sql = $conn->prepare("INSERT INTO purchase(id_transaction, purchaseDate, status, id_cliente, total) VALUES (?, ?, ?, ?, ?)");
    $sql->execute([$id_transaccion, $fechaFormato, $status, $userID, $monto]);

    $id = $conn->lastInsertId();

    if($id > 0){
        $productos = isset($_SESSION['cartProducts']) ? $_SESSION['cartProducts'] : null;
            
        if(isset($productos) && !empty($productos)){
                foreach($productos as $clave){
                    echo json_encode($clave);
                    $productID = $clave['product'];
                    $price = $clave['price'];

                    $numItems = $clave['numItems'];
                    $price = $clave['price'];

                        $sql_insert = $conn->prepare("INSERT INTO purchaseinfo(product, purchaseDate, user, total, numItems, purchID) VALUES (?, ?, ?, ?, ?, ?)");
                        $sql_insert->execute([$productID, $fechaFormato, $userID, $price, $numItems, $id]);
                }
        }
        /*
        $sql_upd = $conn->prepare("UPDATE products SET stock = stock - ? WHERE productID = ?;");
        $sql_upd->execute([$numItems, $productID]);

        $sql_del = $conn->prepare("DELETE FROM cart WHERE user = ?;");
        $sql_del->execute([$userID]);*/
        unset($_SESSION['cartProducts']);
    }
}
?>