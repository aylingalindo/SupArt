<?php
 include_once '../Consultas/productConsult.php';
 include_once 'Consultas/productConsult.php';

 session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $product = new productsAPI();
    echo($action);

    switch ($action) {
        case 'insert':
            $product->createProduct();
            break;
        case 'show':
            /*$product->showProducts();*/
            break;
    }
}

class productsAPI {
    public function __construct() {
        
    }

    //INSERT USER
    function createProduct() {
        $newProduct = new Product();

        if (isset($_POST['name']) && isset($_POST['pricingType']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_POST['prodDesc']) && isset($_POST['productID']) && isset($_POST['cat'])) 
        {
            
            echo ' dentro del if';

                $name = $_POST['name'];   
                $pricingType = $_POST['pricingType'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $prodDesc = $_POST['prodDesc'];
                $productID = $_POST['productID'];
                $cat = $_POST['cat'];

                if (isset($_SESSION['usersAPI']['userID'])){
                    $uploadedBy = $_SESSION['usersAPI']['userID']; 
                }else {
                    $uploadedBy = 0;
                }

                $option = 2;
                if ($productID != 0) {
                    $option = 3;
                }else {
                    $option = 2;
                    $productID = 0;
                }

                if($_POST['pricingType'] == "0"){
                    $pricingType = "Negotiable";
                }else {
                    $pricingType = "Sell";
                }


                $resultado = $newProduct->productManagement($option, $productID, $stock, $name, $prodDesc, $pricingType, $price, null, null, $uploadedBy, $cat);

                if ($option == 3) {
                    echo " <script language='JavaScript'>
                    alert('Se actualizó el producto con exito');
                    location.assign('../misProductos.php')
                    </script>";
                }

                echo '--- antes de archivos ---->' . json_encode($resultado) . '<----- es este x2';

                $ID = json_encode($resultado);
                echo 'encode:'.$ID;
                $iID = json_decode($ID, true);
                echo 'decode:'.$iID;

                $files = array();

                if (isset($_FILES['file'])) {
                    foreach ($_FILES['file']['tmp_name'] as $key => $tempFilePath) {
                        $fileName = $_FILES['file']['name'][$key];

                        // Read the binary content of the file into a variable
                        $fileContent = file_get_contents($tempFilePath);

                        // Store the file content in the array
                        $uploadedFiles[] = array(
                            'fileName' => $fileName,
                            'file' => $fileContent,
                            'product' => $iID
                        );

                    }
                }

                if (($iID != 0) && (count($uploadedFiles) > 0)){

                    echo 'insert product files'; 
                    $resultado = $newProduct->productFilesManagement($uploadedFiles);

                }
                echo '--- despues de archivos ---->' . json_encode($resultado) . '<----- es este x2';

                echo " <script language='JavaScript'>
                    alert('Se creó el producto con exito');
                    location.assign('../misProductos.php')
                    </script>";
                //echo '<script>window.location.href = "../index.php";</script>';
        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }

    }

    function showProducts($prodID,$myProducts) {
        $Product = new Product();

        if ($prodID != null){
            $productID = $prodID;
            $uploadedBy = null;

        } 

        if($myProducts){
            $uploadedBy = $_SESSION['usersAPI']['userID']; 
            $productID = null; 
        }

        $resultado = $Product->showProducts($productID, $uploadedBy);

        return $resultado; 

        /*if ($resultado != null) { 
                // output data of each row
            return $resultado;
            $rowCount = $resultado->rowCount();
            if($rowCount == 1){
                $row = $resultado->fetch(PDO::FETCH_ASSOC);
                $arrdatos = array(
                        "productID" => $row['productID'],
                        "name" => $row['name'],
                        "pricingType" => $row['pricingType'],
                        "price" => $row['price'],
                        "stock" => $row['stock'],
                        "prodDesc" => $row['prodDesc'];
                );
                $_SESSION['productAPI'] = $arrdatos;
                    //echo "<script language='JavaScript'>
                    //alert('Exito: " . $_SESSION['usersAPI']['username'] . $_SESSION['usersAPI']['userID'] . $_SESSION['usersAPI']['password'] ."');
                    //location.assign('../dashboard.php')
                    //</script>";
                echo '<script>window.location.href = "../dashboard.php";</script>';
            }
            else {
                    echo " <script language='JavaScript'>
                    alert('No se encontró ningun producto');
                    </script>";echo "No se encontró ningun producto";
            }
                
        }
        else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }*/

    }

}
?>



