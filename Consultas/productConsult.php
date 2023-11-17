<?php
include_once './connectionPDO.php';
//include_once '../connectionPDO.php';
//include_once 'connectionPDO.php';

    class Product extends DB {

        function productManagement($vOption,$vProductID, $vStock, $vName, $vDescription, $vPricingType, $vPrice, $vReview, $vApprovedBy, $vUploadedBy, $vCategory) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $vText = null;

                    $sql = "CALL productManagement(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                    $stmt->bindValue(11, $vCategory, PDO::PARAM_INT);
                    $stmt->bindValue(12, $vText, PDO::PARAM_STR);

                    $stmt->execute();

                    if ($stmt->errorInfo()[0] != '00000') {
                        // Error en la consulta preparada
                        echo json_encode(array('error' => $stmt->errorInfo()));
                        // Otra lógica de manejo de errores si es necesario
                        return 0;
                    } else {
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $lastInsertID = isset($result[0]['last_insert_id']) ? $result[0]['last_insert_id'] : null;
                        echo json_encode(array('message' => 'Data inserted successfully', 'lastInsertID' => $lastInsertID));
                        return $lastInsertID;
                    }
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    return 0;
                }
            } else {
              return 0;
            }
        }

        function productFilesManagement($uploadedFiles) {
            $conn = $this->connect(); 
            if ($conn) {
                try {

                    $vOption = 2;

                    $sql = "CALL productFilesManagement(?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    foreach($uploadedFiles as $file){

                        $vFileName = $file['fileName'];
                        $vFileContent = $file['file'];
                        $vProductID = filter_var($file['product'], FILTER_VALIDATE_INT);

                        $stmt->bindValue(1, $vOption, PDO::PARAM_INT);
                        $stmt->bindValue(2, $vFileName, PDO::PARAM_STR);
                        $stmt->bindValue(3, $vFileContent, PDO::PARAM_LOB);
                        $stmt->bindValue(4, $vProductID, PDO::PARAM_INT);

                        echo ' fileName:' . ($vFileName);
                        echo ' product:' . ($vProductID);

                        $stmt->execute();
                        if ($stmt->errorInfo()[0] != '00000') {
                            echo ($stmt->errorInfo());
                        return false;
                        }
                    }
                    
                    echo json_encode(array('message' => 'Data inserted successfully'));
                    return true;

                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage();
                    return false;
                }
            } else {
              return false;
            }
        }

        function showProducts($vOption,$vProductID, $vUploadedBy, $vCategory, $vText){
            
            $conn = $this->connect();

            try{

                $sql = "CALL productManagement(:vOption, :vProductID, null, null, null, null, null, null, null, :vUploadedBy, :vCategory, :vText)";
                $stmt = $conn->prepare($sql);

                // Bind the parameters
                $stmt->bindValue(':vOption', $vOption, PDO::PARAM_INT);
                $stmt->bindValue(':vProductID', $vProductID, PDO::PARAM_INT);
                $stmt->bindValue(':vUploadedBy', $vUploadedBy, PDO::PARAM_INT);
                $stmt->bindValue(':vCategory', $vCategory, PDO::PARAM_INT);
                $stmt->bindValue(':vText', $vText, PDO::PARAM_STR);

                echo json_encode($stmt);

                echo ' vOption:' . ($vOption);
                echo ' vProductID:' . ($vProductID);
                echo ' vUploadedBy:' . ($vUploadedBy);
                echo ' vCategory:' . ($vCategory);
                echo ' vText:' . ($vText);

                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if ($result) {
                    /*foreach ($result as $row) {
                        print_r($row); // or var_dump($row);
                    }*/
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

        function showProductFiles($vOption,$vProductID){
            
            $conn = $this->connect();

            try{

                $sql = "CALL productFilesManagement(:vOption, null, null, :vProductID)";
                $stmt = $conn->prepare($sql);

                // Bind the parameters
                $stmt->bindValue(':vOption', $vOption, PDO::PARAM_INT);
                $stmt->bindValue(':vProductID', $vProductID, PDO::PARAM_INT);

                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if ($result) {
                    /*foreach ($result as $row) {
                        print_r($row); // or var_dump($row);
                    }*/
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