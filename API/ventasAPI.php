<?php
    include_once '../Consultas/ventasConsulta.php';
    function filtrarProductos(){
        session_start();
        $consulta = new Ventas();
        if($_SESSION['usersAPI']['rol']==1){
        $res=$consulta->salesFilterManagement(2, $_SESSION['usersAPI']['userID'], $_POST['startDate'], $_POST['endDate'],$_POST['category']);}
        if($_SESSION['usersAPI']['rol']==2){
            $res=$consulta->salesFilterManagement(1,$_SESSION['usersAPI']['userID'], $_POST['startDate'], $_POST['endDate'],$_POST['category']);
        }
        $datos = $res->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    
    if(isset($_POST['action'])){
		switch ($_POST['action']) { 
			case 0:
                echo json_encode(filtrarProductos());
                break;
            }
        }

?>