<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once '../connectionPDO.php';
include_once 'connectionPDO.php';

    class Wishlist extends DB {

        function listManagement($vOption, $vListID, $vName, $vDescription, $vUserID) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $sql = "CALL listManagement(?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindValue(1, $vOption, PDO::PARAM_INT);
                    $stmt->bindValue(2, $vListID, PDO::PARAM_INT);
                    $stmt->bindValue(3, $vName, PDO::PARAM_STR);
                    $stmt->bindValue(4, $vDescription, PDO::PARAM_STR);
                    $stmt->bindValue(5, $vUserID, PDO::PARAM_STR);
                    $stmt->execute();

                    if ($stmt->errorInfo()[0] != '00000') {
                        echo ($stmt->errorInfo());
                    }

                    echo json_encode(array('message' => 'Data inserted successfully'));
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    return false;
                }
            } else {
              return false;
            }
        }

        function listItemsManagement($vList, $vProduct, $vListItem) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $vOption = 2;

                    $sql = "CALL listItemsManagement(?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindValue(1, $vOption, PDO::PARAM_INT);
                    $stmt->bindValue(2, $vList, PDO::PARAM_INT);
                    $stmt->bindValue(3, $vProduct, PDO::PARAM_INT);
                    $stmt->bindValue(4, $vListItem, PDO::PARAM_INT);
                    $stmt->execute();

                    if ($stmt->errorInfo()[0] != '00000') {
                        echo ($stmt->errorInfo());
                    }

                    echo json_encode(array('message' => 'Data inserted successfully'));
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    return false;
                }
            } else {
              return false;
            }
        }


        function showList($vUserID){
            
            $conn = $this->connect();

            try{

                // Prepare the SQL statement
                $sql = "CALL listManagement(1, null, null, null, :vUserID)";
                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':vUserID', $vUserID, PDO::PARAM_INT);

                echo 'userID: ' . $vUserID;

                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if ($result) {
                    echo json_encode(array('message' => 'data retrived successfully'));
                    return $result;
                } else {
                    echo json_encode(array('error' => 'Failed to retrieve data'));
                }
            } catch (PDOException $e) {
                echo "Error en la base de datos: " . $e->getMessage();
                return false;
            }

        }

    }
?>