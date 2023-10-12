<?php
 include_once './Consultas/userConsult.php';

class usersAPI {
    public function __construct() {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $user = new User();

            switch ($action) {
                case 'insert':
                    $this->createUser();
                    break;
            }
        }
    }

    //INSERT USER
    function createUser() {
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rol']) && isset($_POST['image']) && isset($_POST['name']) && isset($_POST['lastnameP']) && isset($_POST['lastnameM']) && isset($_POST['birthday']) && isset($_POST['gender'])&& isset($_POST['joinedDate'])&& isset($_POST['visibility'])) {
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $rol = $_POST['rol'];
                $image = $_POST['image'];
                $name = $_POST['name'];
                $lastnameP = $_POST['lastnameP'];
                $lastnameM = $_POST['lastnameM'];
                $birthday = $_POST['birthday'];
                $gender = $_POST['gender'];
                $joinedDate = $_POST['joinedDate'];
                $visibility = $_POST['visibility'];
                $resultado = $user->userManagement(1, null, $email, $username, $password, $rol, $image, $name, $lastnameP, $lastnameM, $birthday, $gender, $joinedDate, $visibility);
                echo json_encode($resultado);
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }

}
?>



