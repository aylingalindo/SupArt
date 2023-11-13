<?php
include_once '../connectionPDO.php';
include_once 'connectionPDO.php';

    class Category extends DB {

        function newCategory($vName, $vUserID) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $sql = "CALL categoryManagement(2, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindValue(2, $vName, PDO::PARAM_STR);
                    $stmt->bindValue(3, $vUserID, PDO::PARAM_INT);

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

        function showCategories(){
            
            $conn = $this->connect();

            try{

                // Prepare the SQL statement
                $sql = "CALL categoryManagement(1, null, null)";
                $stmt = $conn->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if ($result) {
                    echo '--> ' . json_encode($result) . ' <--';
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