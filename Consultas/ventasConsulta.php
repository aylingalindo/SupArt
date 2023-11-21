<?php
include_once '../connectionPDO.php';

    class Ventas extends DB {
        //SALES MANAGEMENT - CALL PROCEDURE
        
        function salesFilterManagement($vOption, $vUserID, $vDateIn, $vDateFin, $vCat) {
            $conn = $this->connect(); 
            if ($conn) {
                try {
                    $sql = "CALL salesFilter(?, ?, ?, ?, ?)";
                    $query = $conn->prepare($sql);
                    $query->bindParam(1, $vOption, PDO::PARAM_INT);
			        $query->bindParam(2, $vUserID, PDO::PARAM_INT);
		         	$query->bindParam(3, $vDateIn, PDO::PARAM_STR);
        			$query->bindParam(4, $vDateFin, PDO::PARAM_STR);
	        		$query->bindParam(5, $vCat, PDO::PARAM_INT);
                    $query->execute();
                    return $query;
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