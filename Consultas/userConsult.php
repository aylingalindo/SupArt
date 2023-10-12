<?php
include_once './connectionPDO.php';

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
        //
        function userManagement($vOption, $vUserID, $vEmail, $vUsername, $vPassword, $vRol, $vImage, $vName, $vLastnameP, $vLastnameM, $vBirthday, $vGender, $vJoinedDate, $vVisibility) {
            $conn = $this->connect(); 

            if ($conn) {
                try {
                    $sql = "CALL userManagement($vOption, $vUserID, $vEmail, $vUsername, $vPassword, $vRol, $vImage, $vName, $vLastnameP, $vLastnameM, $vBirthday, $vGender, $vJoinedDate, $vVisibility)";
                    $result = $conn->query($sql);

                    if ($result) {
                        echo json_encode(array('message' => 'Data inserted successfully'));
                    } else {
                        echo json_encode(array('error' => 'Failed to insert data'));
                    }
                } catch (PDOException $e) {
                    return false; 
                }
            } else {
                return false;
            }
            
        }

    }
?>