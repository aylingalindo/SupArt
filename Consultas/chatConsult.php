<?php
include_once '../connectionPDO.php';

    class Message extends DB {
        //MSG MANAGEMENT - CALL PROCEDURE
        function chatManagement($option, $product, $sender, $receiver, $message) {
            $conn = $this->connect(); 
            if ($conn) {
                try {
                    $sql = "CALL chatManagement($option, $product, $sender, $receiver, $message)";
                    $result = $conn->query($sql);

                    if ($result) {
                        echo json_encode(array('message' => 'Data successfully'));
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