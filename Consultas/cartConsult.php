<?php
include_once '../connectionPDO.php';

    class Cart extends DB {
        //CART MANAGEMENT - CALL PROCEDURE
        function cartManagement($vOption, $vProductID, $vNumItems, $vUserID) {
            $conn = $this->connect(); 
            if ($conn) {
                try {
                    $sql = "CALL cartManagement($vOption, $vProductID, $vNumItems, $vUserID)";
                    $result = $conn->query($sql);

                    if ($result) {
                        echo json_encode(array('message' => 'Data inserted successfully'));
                    } else {
                        echo json_encode(array('error' => 'Failed to insert data'));
                    }
                    return $result;
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    echo "SQL ejecutado: " . $sql;
                    return false;
                }
            } else {
                return false;
            }
        }
    }
?>