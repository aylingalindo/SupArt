<?php
session_start();
 include_once '../Consultas/userConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $user = new usersAPI();
    echo($action);

    switch ($action) {
        case 'insert':
            $user->createUser();
            break;
        case 'login':
            $user->loginUser();
            break;
        case 'fillProfile':
            $user->fillProfile();
            break;
        case 'edit':
            $user->editUser();
            break;
    }
}

class usersAPI {
    public function __construct() {
        
    }

    //INSERT USER
    function createUser() {
        $userito = new User();

        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['pLastname']) && isset($_POST['mLastname']) && isset($_POST['fecha']) && isset($_POST['gender'])) 
        {

                $image = null;
                
                if (isset($_FILES['file'])) {
                    if ($_FILES['file']['error'] === UPLOAD_ERR_OK){
                        $image = file_get_contents($_FILES['file']['tmp_name']);
                    }else {
                        echo json_encode(array('mensaje' => 'Error al cargar la imagen'));
                    }
                }else {
                    $image = null;
                }

                $email = $_POST['email'];   
                $username = $_POST['username'];
                $password = $_POST['password'];
                $rol = $_POST['rbtnRol'];
                //$image = $_POST['image'];
                $name = $_POST['name'];
                $lastnameP = $_POST['pLastname'];
                $lastnameM = $_POST['mLastname'];
                $birthday = $_POST['fecha'];
                $gender = $_POST['gender'];
                $visibility = $_POST['rbtnPrivacidad'];
                $userID = $_POST['userID'];
                if ($userID != null) {
                    $option = 3;
                }else {
                    $option = 1;
                    $userID = 0;
                }

                $resultado = $userito->userManagement($option, $userID, $email, $username, $password, $rol, $image, $name, $lastnameP, $lastnameM, $birthday, $gender, $visibility);
                //$resultado = $userito->userManagement("'$option'", "'$userID'", "'$email'", "'$username'", "'$password'", "'$rol'", "'$image'", "'$name'", "'$lastnameP'", "'$lastnameM'", "'$birthday'", "'$gender'", "'$visibility'");
                echo json_encode($resultado) . '<----- es este';
                echo ($resultado) . '<----- es este x2';

                if($resultado != null){
                    echo "Error al insertar";
                    return false;
                }

                if ($option == 3) {
                    $arrdatos = array(
                        "userID" => $row['userID'],
                        "email" => $email,
                        "username" => $username,
                        "password" => $password,
                        "rol" => $rol,
                        "image" => $image,
                        "name" => $name,
                        "lastnameP" => $lastnameP,
                        "lastnameM" => $lastnameM,
                        "birthday" => $birthday,
                        "gender" => $gender,
                        "visibility" => $visibility
                    );
                    echo ' si array ';
                    $_SESSION['usersAPI'] = $arrdatos;
                    echo " <script language='JavaScript'>
                    alert('Se actualizó el usuario con exito');
                    location.assign('../user-profile.php')
                    </script>";
                }else {
                    echo " <script language='JavaScript'>
                    alert('Se creó el usuario con exito');
                    location.assign('../index.php')
                    </script>";
                }
                //echo '<script>window.location.href = "../index.php";</script>';
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }

    function loginUser() {
        $userito = new User();
        echo "username: " . (isset($_POST['nameLogin']) ? ' true ' : ' false ');
        echo "password: " . (isset($_POST['passLogin']) ? ' true ' : ' false ');

        echo 'login user api';
        if (isset($_POST['nameLogin']) && isset($_POST['passLogin'])) {
            echo 'inside if user';
            $username = $_POST['nameLogin'];
            $password = $_POST['passLogin'];
            $resultado = $userito->login("'$username'", "'$password'");

            if ($resultado != null) { 
                // output data of each row
                $rowCount = $resultado->rowCount();
                if($rowCount == 1){
                    $row = $resultado->fetch(PDO::FETCH_ASSOC);
                    $arrdatos = array(
                        "userID" => $row['userID'],
                        "email" => $row['email'],
                        "username" => $row['username'],
                        "password" => $row['pass'],
                        "rol" => $row['rol'],
                        "image" => $row['image'],
                        "name" => $row['name'],
                        "lastnameP" => $row['lastnameP'],
                        "lastnameM" => $row['lastnameM'],
                        "birthday" => $row['birthday'],
                        "gender" => $row['gender'],
                        "joinedDate" => $row['joinedDate'],
                        "visibility" => $row['visibility']
                    );
                    $_SESSION['usersAPI'] = $arrdatos;
                    //echo "<script language='JavaScript'>
                    //alert('Exito: " . $_SESSION['usersAPI']['username'] . $_SESSION['usersAPI']['userID'] . $_SESSION['usersAPI']['password'] ."');
                    //location.assign('../dashboard.php')
                    //</script>";
                    echo '<script>window.location.href = "../dashboard.php";</script>';
                }
                else {
                    echo " <script language='JavaScript'>
                    alert('Usuario o contraseña incorrecto');
                    location.assign('../index.php')
                    </script>";echo "Usuario o contraseña incorrecta";
                }
                
            } 
            else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
        }
    }

    function fillUser(){
        $current = $_SESSION['usersAPI'];
        return $current;
    }

    function editUser() {
        $current = $_SESSION['usersAPI'];
        echo 'msj de edit user ' . $current['userID'];
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['pLastname']) && isset($_POST['mLastname']) && isset($_POST['fecha']) && isset($_POST['gender']) && isset($_POST['visibility']) && isset($_POST['rol'])) // && isset($_POST['image']) 
        {
                echo 'inside if user';
                $email = $_POST['email'];   
                $username = $_POST['username'];
                $password = $_POST['password'];
                $rol = $_POST['rbtnRol'];
                //$image = $_POST['image'];
                $name = $_POST['name'];
                $lastnameP = $_POST['pLastname'];
                $lastnameM = $_POST['mLastname'];
                $birthday = $_POST['fecha'];
                $gender = $_POST['gender'];
                $visibility = $_POST['rbtnPrivacidad'];
                $resultado = $userito->userManagement(1, $current['userID'], "'$email'", "'$username'", "'$password'", "'$rol'", 'null', "'$name'", "'$lastnameP'", "'$lastnameM'", "'$birthday'", "'$gender'", "'$visibility'");
                echo json_encode($resultado);
                echo ($resultado);

                $arrdatos = array(
                        "userID" => $row['userID'],
                        "email" => $email,
                        "username" => $username,
                        "password" => $password,
                        "rol" => $rol,
                        "image" => $row['image'],
                        "name" => $name,
                        "lastnameP" => $lastnameP,
                        "lastnameM" => $lastnameM,
                        "birthday" => $birthday,
                        "gender" => $gender,
                        "visibility" => $visibility
                    );
                    echo ' si array ';
                    $_SESSION['usersAPI'] = $arrdatos;

                echo " <script language='JavaScript'>
                    alert('Se creó el usuario con exito');
                    <!--location.assign('../index.php')-->
                    </script>";
                //echo '<script>window.location.href = "../index.php";</script>';
            } else {
                echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            }
    }  



}
?>



