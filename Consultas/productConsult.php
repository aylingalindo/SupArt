<?php
include_once '../connectionPDO.php';
include_once 'connectionPDO.php';

    class Product extends DB {

        function productManagement($vOption,$vProductID, $vStock, $vName, $vDescription, $vPricingType, $vPrice, $vReview, $vApprovedBy, $vUploadedBy) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $sql = "CALL productManagement(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    echo ' opcion:' . ($vOption);
                    echo ' productID:' . ($vProductID);
                    echo ' name:' . ($vName);
                    echo ' descripcion:' . ($vDescription);
                    echo ' pricingType:'. ($vPricingType);
                    echo ' price:' . ($vPrice);
                    echo ' review:' . ($vReview);
                    echo ' approvedBy:' . ($vApprovedBy);
                    echo ' uploadedBy:' . ($vUploadedBy);

                    $stmt->bindValue(1, $vOption, PDO::PARAM_INT);
                    $stmt->bindValue(2, $vProductID, PDO::PARAM_INT);
                    $stmt->bindValue(3, $vStock, PDO::PARAM_INT);
                    $stmt->bindValue(4, $vName, PDO::PARAM_STR);
                    $stmt->bindValue(5, $vDescription, PDO::PARAM_STR);
                    $stmt->bindValue(6, $vPricingType, PDO::PARAM_STR);
                    $stmt->bindValue(7, $vPrice, PDO::PARAM_STR); 
                    $stmt->bindValue(8, $vReview, PDO::PARAM_STR);
                    $stmt->bindValue(9, $vApprovedBy, PDO::PARAM_INT);
                    $stmt->bindValue(10, $vUploadedBy, PDO::PARAM_INT);

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
            } else {
              return false;
            }
        }

        function showProducts($vProductID, $vUploadedBy){
            
            $conn = $this->connect();

            try{

                // Prepare the SQL statement
                $sql = "CALL productManagement(1, null, null, null, null, null, null, null, :vProductID, :vUploadedBy)";
                $stmt = $conn->prepare($sql);

                // Bind the parameters
                $stmt->bindValue(':vProductID', $vProductID, PDO::PARAM_INT);
                $stmt->bindValue(':vUploadedBy', $vUploadedBy, PDO::PARAM_INT);

                // Execute the statement
                $stmt->execute();

                // Fetch the result (if needed)
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