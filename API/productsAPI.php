<?php
 include_once '../Consultas/productConsult.php';
 include_once 'Consultas/productConsult.php';

 session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $product = new productsAPI();

    switch ($action) {
        case 'insert':
            $product->createProduct();
            break;

        // para la barra de busqueda
        case 'search':
            $text = null; 
            $filter = 0;

            if(isset($_POST['text']) ){
                $text = $_POST['text'];
            }
            if(isset($_POST['filter'])){
                $filter = $_POST['filter'];
            }

            echo "texto:" . $text;
            echo "filtro:" . $filter;

            if($filter == 1){
                $result = $product->showProducts(9,null,null,null, $text);
            }else if ($filter == 2){
                $result = $product->showProducts(11,null,null,null, $text);
            }else if ($filter == 3){
                $result = $product->showProducts(10,null,null,null, $text);
            }else{
                $result = $product->showProducts(4,null,null,null, $text);
            }

            //echo json_encode($result);

            foreach($result as $row){
                $imageBlob = $row['file'];
                $image = base64_encode($imageBlob);
                $imageExt = $row['fileName'];
                echo "<tr>
                  <td>
                    <img src='". ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . "' class='object-fit-contain td-img' alt='...''>
                  </td>
                  <td>
                    <a href='producto.php' title='". $row['name'] ."' class='card-link-product'>
                        <div class='row'>
                        <h5 class='td-title'>".$row['name']."</h5>
                        </div>
                        <div class='row'>
                        <h6>".$row['description']."</h6>
                        </div>
                    </a>
                  </td>
                  <td>
                    <h4 class='td-price'>$".$row['price']." MXN</h4>
                  </td>
                </tr>";
            }

            break;

        // para que se muestren los productos filtrados por categoria
        case 'show':
            if(isset($_POST['selectedOption'])){
                $cat = $_POST['selectedOption'];
                $result = $product->showProducts(4, null, true, $cat, null);

                    // Output the HTML directly
                foreach ($result as $row) {
                    $imageBlob = $row['file'];
                    $image = base64_encode($imageBlob);
                    $imageExt = $row['fileName'];

                    echo "<tr>
                        <td>
                          <img src='" . ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . "' class='object-fit-contain td-img' alt='...''>
                        </td>
                        <td>
                          <div class='row'>
                            <h5 class='td-title'>" . $row['name'] . "</h5>
                          </div>
                          <div class='row'>
                            <h6>" . $row['description'] . "</h6>
                          </div>
                        </td>
                        <td>
                          <h5>En Stock:</h5>
                          <h4 class='td-price'>" . $row['stock'] . "</h4>
                        </td>
                        <td>
                          <a class='btn btn-primary closeBtn' href='nuevoProducto.php?editID=".$row['productID']."'>
                            <i class='icon ion-md-create'></i>
                          </a>
                        </td>
                        <td>
                          <button class='btn btn-primary closeBtn'>
                            <i class='icon ion-md-close'></i>
                          </button>
                        </td>
                      </tr>";
                }
            }
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
                $iID = json_decode($ID, true);

                $files = array();

                if (isset($_FILES['file'])) {
                    foreach ($_FILES['file']['tmp_name'] as $key => $tempFilePath) {
                        $fileName = $_FILES['file']['name'][$key];
                        $fileContent = file_get_contents($tempFilePath);

                        $fileInfo = pathinfo($fileName);
                        $fileExtension = $fileInfo['extension'];

                        $uploadedFiles[] = array(
                            'fileName' => $fileExtension,
                            'file' => $fileContent,
                            'product' => $iID
                        );

                    }
                }

                if (($iID != 0) && (count($uploadedFiles) > 0)){

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

    function showProducts($option,$prodID,$myProducts, $category, $text) {
        $Product = new Product();

        if ($prodID != null){
            $productID = $prodID;
            $uploadedBy = null;

        } 

        if($myProducts){
            $uploadedBy = $_SESSION['usersAPI']['userID']; 
            $productID = null; 
        }

        $resultado = $Product->showProducts($option,$productID, $uploadedBy, $category, $text);

        /*if($category != null){
            echo '<script>window.location.href = "../index.php";</script>';
        }*/

        return $resultado; 

    }

    function showProductFiles($prodID) {
        $Product = new Product();


        $resultado = $Product->showProductFiles(1,$prodID);

        /*if($category != null){
            echo '<script>window.location.href = "../index.php";</script>';
        }*/

        return $resultado; 

    }

}
?>



