<?php
include_once './Consultas/userConsult.php';
/*
if($_POST['id'] > 0)
{
	$obj = new usersAPI();
	$obj->fillUserModel();
}
else
{
	echo "no submit";
}*/
class usersAPI {/*
    function fillUserModel(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
    }
    */
    function getAll() {
        $test = new User();
        $arrTest = array();
        $arrTest["Resultados"] = array();

       $res = $test->getTest();

        if ($res !== false) {
            $arrTest["Resultados"] = $res;
            echo json_encode($arrTest);
        } else {
            echo json_encode(array('mensaje' => 'No hay elementos registrados'));
        }

    }
}
?>