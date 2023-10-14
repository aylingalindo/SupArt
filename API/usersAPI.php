<?php
 include_once '../Consultas/userConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $user = new usersAPI();

    switch ($action) {
        case 'insert':
            echo 'hola';
            $user->createUser();
            break;
        case 'login':
            $user->loginUser();
            break;
    }
}

class usersAPI {
    public function __construct() {
        
    }

    //INSERT USER
    function createUser() {
        $userito = new User();
        echo "validate email: " . (isset($_POST['email']) ? ' true ' : ' false ');
        echo "username: " . (isset($_POST['username']) ? ' true ' : ' false ');
        echo "password: " . (isset($_POST['password']) ? ' true ' : ' false ');
        echo "name: " . (isset($_POST['name']) ? ' true ' : ' false ');
        echo "lastnameP: " . (isset($_POST['pLastname']) ? ' true ' : ' false ');
        echo "lastnamem: " . (isset($_POST['mLastname']) ? ' true ' : ' false ');
        echo "birthday: " . (isset($_POST['fechs']) ? ' true ' : ' false ');
        echo "gender: " . (isset($_POST['gender']) ? ' true ' : ' false ');

        echo 'Create user';
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['pLastname']) && isset($_POST['mLastname']) && isset($_POST['fecha']) && isset($_POST['gender'])) // && isset($_POST['joinedDate'])&& isset($_POST['visibility'])) && isset($_POST['rol']) && isset($_POST['image']) 
        {
                echo 'inside if user';
                $email = $_POST['email'];   
                $username = $_POST['username'];
                $password = $_POST['password'];
                //$rol = $_POST['rol'];
                //$image = $_POST['image'];
                $name = $_POST['name'];
                $lastnameP = $_POST['pLastname'];
                $lastnameM = $_POST['mLastname'];
                $birthday = $_POST['fecha'];
                $gender = $_POST['gender'];
                //$joinedDate = $_POST['joinedDate'];
                //$visibility = $_POST['visibility'];
                $resultado = $userito->userManagement(1, 'null', "'$email'", "'$username'", "'$password'", 'null', 'null', "'$name'", "'$lastnameP'", "'$lastnameM'", "'$birthday'", "'$gender'", 'null');
                echo json_encode($resultado);
                echo '<script>window.location.href = "../index.php";</script>';
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }

    function login() {
        $userito = new User();
        echo "username: " . (isset($_POST['nameLogin']) ? ' true ' : ' false ');
        echo "password: " . (isset($_POST['passLogin']) ? ' true ' : ' false ');

        echo 'login user api';
        if isset($_POST['username']) && isset($_POST['password'])) 
        {
                echo 'inside if user';
                $username = $_POST['nameLogin'];
                $password = $_POST['passLogin'];
                $resultado = $userito->userManagement(2, 'null', "'null'", "'$username'", "'$password'", 'null', 'null', "'null'", "'null'", "'null'", "'null'", "'null'", 'null');
                echo json_encode($resultado);

                //echo '<script>window.location.href = "../dashboard.php";</script>';
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }

}
?>



