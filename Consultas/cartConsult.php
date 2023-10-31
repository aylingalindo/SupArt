<?php
include_once '../connectionPDO.php';

    class Cart extends DB {
        //CART MANAGEMENT - CALL PROCEDURE
        function cartManagement($vOption, $vProductID, $vNumItems, $vUserID) {
            $conn = $this->connect(); 
            echo 'hola cart consult';
            if ($conn) {
                try {
                    $sql = "CALL cartManagement($vOption, $vProductID, $vNumItems, $vUserID)";
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
                }
            } else {
            echo 'hola no conn';

                return false;
            }
        }
    }
?>