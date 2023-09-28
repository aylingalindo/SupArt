<?php
$servername = ""; 
$username = ""; 
$password = ""; 
$dbname = ""; 

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Conexión exitosa";


  // === TEST CONNECTION: query example ===
  /*$sql = "SELECT * FROM test";// Replace with your table name
  $result = $conn->query($sql);
  
  if ($result->rowCount() > 0) {
    // Muestra los datos de cada fila
    foreach ($result as $row) {
      echo "ID: " . $row["identificador"] . " - Name: " . $row["texto"] . "<br>";
    }
  } else {
    echo "No se encontraron resultados";
  }*/

  // Cierra la conexión
  $conn = null;
} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
}
?>
