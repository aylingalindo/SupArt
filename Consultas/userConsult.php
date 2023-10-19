<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once '../connectionPDO.php';

    class User extends DB {

    /*
        function getTest() {
            $conn = $this->connect(); 

            if ($conn) {
                try {
                    $sql = "SELECT * FROM test";
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        return $result->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return array();
                    }
                } catch (PDOException $e) {
                    return false; 
                }
            } else {
                return false;
            }
        }

    */
        //USER MANAGEMENT - CALL PROCEDURE
        // vOption = 1 --> CREATE USER
        // vOption = 2 --> LOGIN
        function userManagement($vOption, $vUserID, $vEmail, $vUsername, $vPassword, $vRol, $vImage, $vName, $vLastnameP, $vLastnameM, $vBirthday, $vGender, $vVisibility) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $sql = "CALL userManagement(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $vBirthday = date('Y-m-d H:i:s');
                    $stmt = $conn->prepare($sql);

                    echo "opcion: " . $vOption;
                    echo " email: " . $vEmail;
                    echo " username: " . $vUsername;
                    echo " password: " . $vPassword;
                    echo " rol: " . $vRol;
                    echo " image: " . $vImage;
                    echo " name: " . $vName;
                    echo " lastnameP: " . $vLastnameP;
                    echo " lastnameM: " . $vLastnameM;
                    echo " birthday: " . $vBirthday;
                    echo " gender: " . $vGender;
                    echo " visibility: " . $vVisibility;

                    $stmt->bindValue(1, $vOption, PDO::PARAM_INT);
                    $stmt->bindValue(2, $vUserID, PDO::PARAM_INT);
                    $stmt->bindValue(3, $vEmail, PDO::PARAM_STR);
                    $stmt->bindValue(4, $vUsername, PDO::PARAM_STR);
                    $stmt->bindValue(5, $vPassword, PDO::PARAM_STR);
                    $stmt->bindValue(6, $vRol, PDO::PARAM_INT);
                    $stmt->bindValue(7, $vImage, PDO::PARAM_LOB); // Para valores BLOB
                    $stmt->bindValue(8, $vName, PDO::PARAM_STR);
                    $stmt->bindValue(9, $vLastnameP, PDO::PARAM_STR);
                    $stmt->bindValue(10, $vLastnameM, PDO::PARAM_STR);
                    $stmt->bindValue(11, $vBirthday, PDO::PARAM_STR);
                    $stmt->bindValue(12, $vGender, PDO::PARAM_STR);
                    $stmt->bindValue(13, $vVisibility, PDO::PARAM_INT);

                    $stmt->execute();

                    if ($stmt->errorInfo()[0] != '00000') {
                        // Error en la consulta preparada
                        echo ($stmt->errorInfo());
                        // Otra lógica de manejo de errores si es necesario
                    }

                    echo json_encode(array('message' => 'Data inserted successfully'));
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    return false;
                }
                /*try {
                    $sql = "CALL userManagement($vOption, $vUserID, $vEmail, $vUsername, $vPassword, $vRol, $vImage, $vName, $vLastnameP, $vLastnameM, $vBirthday, $vGender, $vVisibility)";
                    echo ' despues query --> ' . $sql;
                    $result = $conn->query($sql);

                    if ($result) {
                        echo '--> ' . json_encode($result) . ' <--';
                        echo json_encode(array('message' => 'Data inserted successfully'));
                    } else {
                        echo json_encode(array('error' => 'Failed to insert data'));
                    }
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    echo "SQL ejecutado: " . $sql;
                    return false;
                }*/
            } else {
            echo 'hola no conn';

                return false;
            }
        }

        function login($vUsername,$password){
            
            $conn = $this->connect();
            $sql = "CALL userManagement(2, null, null, $vUsername, $password, null, null, null, null, null, null, null, null)";
            echo '  query --> ' . $sql;
            $result = $conn->query($sql);
            if ($result) {
                echo '--> ' . json_encode($result) . ' <--';
                echo json_encode(array('message' => 'login successfully'));
                return $result;
                } else {
                    echo json_encode(array('error' => 'Failed to login'));
                }
        }

    }
?>