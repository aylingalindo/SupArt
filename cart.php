<?php session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
    /*$cartID = $_SESSION['cartProducts'][i]['cartID'];
	$product = $_SESSION['cartProducts'][i]['product'];
	$numItems = $_SESSION['cartProducts'][i]['numItems'];
	$user = $_SESSION['cartProducts'][i]['user'];
	$name = $_SESSION['cartProducts'][i]['name'];
	$description = $_SESSION['cartProducts'][i]['description'];
	$pricingType = $_SESSION['cartProducts'][i]['pricingType'];
	$price = $_SESSION['cartProducts'][i]['price'];
	$review = $_SESSION['cartProducts'][i]['review'];*/
  $rol = $_SESSION['usersAPI']['rol'];

  function displayCartProducts($cartProducts) {
    foreach ($cartProducts as $product) {
        if(isset($_SESSION['cartProducts'])){
                        foreach ($_SESSION['cartProducts'] as $product) {
                            $cartID = $product['cartID'];
                            $name = $product['name'];
                            $description = $product['description'];
                            $numItems = $product['numItems'];
                            $price = $product['price'];
                            $category = $product['category'];
                            $totalStock = $product['totalStock'];
                    
                            echo'<tr>';
                            echo  '<td>';
                            echo   '<img src="Img/libreta.jpeg" class="object-fit-contain td-img" alt="...">';
                            echo  '</td>';
                            echo  '<td>';
                            echo   '<div class="row">';
                            echo     '<h5 class="td-title">'. $name . '</h5>';
                            echo    '</div>';
                            echo   '<div class="row">';
                            echo      '<h6>'. $category. '</h6>';
                            echo    '</div>';
                            echo  '</td>';
                            echo  '<td>';
                            echo    '<h5>Cantidad:</h5>';
                            echo    '<input type="number" id="cantidad" class="cantidad form-control" name="cantidad" value="'.$numItems .'" max="' . $totalStock . '" min="1">';
                            echo      '<h6 class="cart-saveItems underlineAction">Guardar</h6>';
                            echo    '<h6 class="td-price"> Precio: $' . $price . '</h6>';
                            echo    '<h6 class="td-price cartPricePr" data-amount="' . $price * $numItems . '"> Total: $' . $price * $numItems . '</h6>';
                            echo     '<input type=text class="cartProduct" value="'. $cartID .'" style="height:0px; visibility: hidden;">';
                            echo     '<input type=text class="cartPrice" value="'. $price .'" style="height:0px; visibility: hidden;">';
                            echo  '</td>';
                            echo  '<td>';
                            echo    '<button class="btn btn-primary closeBtn">';
                            echo      '<i class="icon ion-md-close"></i>';
                            echo   '</button>';
                            echo  '</td>';
                            echo'</tr>';
                        }
                    }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>SupArt</title>

    <link rel="stylesheet" type="text/css" href="Themes/bootstrap-5.3.1-dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script type="text/javascript" src="Themes/bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AQWBoozbj7tl8mZ-LPKo3-xMzUP--aQHzqOgts6apDpNsBXpyO3hS50fjqVomELSafZkU4_hia55kXzf&currency=MXN"></script>

    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Themes/style.css">
    <script defer src="default.js"></script>
    <script defer src="cart.js"></script>
</head>
<body>
  <div class="d-flex"> 
    <div id="overlay"></div>

    <!-- NAV BAR-->

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand ps-3" href="dashboard.php">SupArt</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form id="search-group" class="d-flex me-auto ms-auto mb-2 mb-lg-0" role="search">
            <span class="input-group-text pt-0 pb-0" id="search-icon" >
              <i class="icon ion-md-search"></i>
            </span>
            <input id="search-bar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
          </form>
          <ul class="navbar-nav d-flex">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user-profile.php">
                <i class="icon ion-md-person lead align-self-center"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">
                <i class="icon ion-md-cart lead align-self-center"></i>
              </a>
            </li>
            <li class="nav-item dropdown me-5 pe-5">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="wishlist.php">Mis Wishlist</a></li>
                <li><a class="dropdown-item" href="msjCotizacion.php">Mis Mensajes</a></li>
                <li><a class="dropdown-item" href="misProductos.php">Mis Productos</a></li>
                <li><a class="dropdown-item" href="ventas.php"><?php echo $rol == '2' ? 'Mis Ventas' : 'Mis Pedidos'; ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Categorías</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- CONTENT -->
    <div id="content" style="padding-top: 6rem;">
      <!-- FEED -->
      <section>
      
        <div class="row d-flex" style="margin-left: 20px; margin-right: 20px;">

          <h4>Carrito de compras</h4>
          
          <!--CART PRODUCTS-->
          <div class="col-8" style="padding-left: 40px; padding-right: 40px; border-width: 2rem !important; min-width: 455px;">

            <table class="table table-hover">
              <tbody>

    <?php
                    if(isset($_SESSION['cartProducts'])){
                        foreach ($_SESSION['cartProducts'] as $product) {
                            $cartID = $product['cartID'];
                            $name = $product['name'];
                            $description = $product['description'];
                            $numItems = $product['numItems'];
                            $price = $product['price'];
                            $category = $product['category'];
                            $totalStock = $product['totalStock'];
                    
                            echo'<tr>';
                            echo  '<td>';
                            echo   '<img src="Img/libreta.jpeg" class="object-fit-contain td-img" alt="...">';
                            echo  '</td>';
                            echo  '<td>';
                            echo   '<div class="row">';
                            echo     '<h5 class="td-title">'. $name . '</h5>';
                            echo    '</div>';
                            echo   '<div class="row">';
                            echo      '<h6>'. $category. '</h6>';
                            echo    '</div>';
                            echo  '</td>';
                            echo  '<td>';
                            echo    '<h5>Cantidad:</h5>';
                            echo    '<input type="number" id="cantidad" class="cantidad form-control" name="cantidad" value="'.$numItems .'" max="' . $totalStock . '" min="1">';
                            echo      '<h6 class="cart-saveItems underlineAction">Guardar</h6>';
                            echo    '<h6 class="td-price"> Precio: $' . $price . '</h6>';
                            echo    '<h6 class="td-price cartPricePr" data-amount="' . $price * $numItems . '"> Total: $' . $price * $numItems . '</h6>';
                            echo     '<input type=text class="cartProduct" value="'. $cartID .'" style="height:0px; visibility: hidden;">';
                            echo     '<input type=text class="cartPrice" value="'. $price .'" style="height:0px; visibility: hidden;">';
                            echo  '</td>';
                            echo  '<td>';
                            echo    '<button class="btn btn-primary closeBtn">';
                            echo      '<i class="icon ion-md-close"></i>';
                            echo   '</button>';
                            echo  '</td>';
                            echo'</tr>';
                        }
                    }else{
                      echo "hola";
                    }
    ?>

                <tr>
                  <td>
                    <img src="Img/libreta.jpeg" class="object-fit-contain td-img" alt="...">
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Block Strathmore 400 Sketch</h5>
                    </div>
                    <div class="row">
                      <h6>Libretas</h6>
                    </div>
                  </td>
                  <td>
                    <h5>Cantidad: 1</h5>
                    <h4 class="td-price">$200.00 MXN</h4>
                  </td>
                  <td>
                    <button class="btn btn-primary closeBtn">
                      <i class="icon ion-md-close"></i>
                    </button>
                    <button class="btn btn-primary closeBtn">
                        <i class="icon ion-md-create"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img src="Img/libreta2.jpg" class="object-fit-contain td-img" alt="...">
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Canson Art Book One</h5>
                    </div>
                    <div class="row">
                      <h6>Libretas</h6>
                    </div>
                  </td>
                  <td>
                    <h5>Cantidad: 1</h5>
                    <h4 class="td-price">$232.00 MXN</h4>
                  </td>
                  <td>
                    <button class="btn btn-primary closeBtn">
                      <i class="icon ion-md-close"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img src="Img/libreta3.jpg" class="object-fit-contain td-img" alt="...">
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Strathmore - Cuaderno de bocetos de la serie 200</h5>
                    </div>
                    <div class="row">
                      <h6>Libretas</h6>
                    </div>
                  </td>
                  <td>
                    <h5>Cantidad: 2</h5>
                    <h4 class="td-price">$134.00 MXN</h4>
                  </td>
                  <td>
                    <button class="btn btn-primary closeBtn">
                      <i class="icon ion-md-close"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!--TOTAL SECTION-->
          <div class="col-md-2 col-sm-12 cart-total d-flex align-items-center">
    <div class="border p-3">
        <div class="text-center mb-3">
            <h3>TOTAL</h3>
        </div>
        <div class="text-center mb-3">
            <h2>
                <b>
                    <?php 
                        $totalPrice = null;

                        if (!empty($_SESSION['cartProducts']) && isset($_SESSION['cartProducts'][0]['totalPrice'])) {
                            $totalPrice = $_SESSION['cartProducts'][0]['totalPrice'];
                        }

                        // Format the total price as currency in PHP
                        if ($totalPrice !== null) {
                            echo '$' . number_format($totalPrice, 2) . ' MXN'; // Currency format with 2 decimal places
                        } else {
                            echo 'N/A'; // Or any default value you want to show if $totalPrice is null
                        }
                    ?>
                </b>
            </h2>
        </div>
        <div class="text-center"> 
            <button id="btnBuy" type="button" class="btn btn-primary signUpBtn" value='<?php echo $totalPrice; ?>'>Proceder a pago</button>
        </div>
    </div>
</div>



    <!-- MODAL PAGO -->
      <div class="modal fade" id="payModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="payModalLabel">Metodo de pago</h5>
                <button type="button" class="close btnClose" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Tipo de tarjeta:</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Todas las Categorias </option>
                        <option value="1">Debito</option>
                        <option value="2">Credito</option>
                        <option value="2">Paypal</option>
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Numero:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Nombre en la tarjeta:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Fecha de expiracion</label>
                    <div style="display: flex;">
                            <label for="message-text" class=".col-md-4">Mes:</label>
                            <input type="text" class="form-control" id="recipient-name" style="margin:0px 10px;">
                            <label for="message-text" class=".col-md-4">Año:</label>
                            <input type="text" class="form-control" id="recipient-name" style="margin:0px 10px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Numero de seguridad:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnClose productBtn" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary signUpBtn">Comprar</button>
              </div>
            </div>
          </div>
        </div>


<!-- MODAL DETALLES DE PAGO -->
        <div class="modal fade" id="payModalito" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="payModalLabel">Detalles de pago</h5>
                <button type="button" class="close btnClose" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                    <table class="table-detail">
                        <tbody>
                        <?php
                            if(isset($_SESSION['cartProducts'])){
                                foreach ($_SESSION['cartProducts'] as $product) {
                                    $cartID = $product['cartID'];
                                    $name = $product['name'];
                                    $description = $product['description'];
                                    $numItems = $product['numItems'];
                                    $price = $product['price'];
                                    $category = $product['category'];
                                    $totalStock = $product['totalStock'];
                                    
                    
                                    echo'<tr>';
                                    echo  '<td class="col-9" style="vertical-align: top;>';
                                    echo   '<div class="row">';
                                    echo     '<h5 class="td-title">'. $name . ' x' . $numItems . '</h5>';
                                    echo    '</div>';
                                    echo  '</td>';
                                    echo  '<td class="col-3" style="vertical-align: top;>';
                                    echo    '<h5>Cantidad: '.$numItems .'</h5>';
                                    echo    '<h6 class="td-price cartDetPr" data-amount="<?php echo $price * $numItems; ?>">
                                              Total: $' . number_format($price * $numItems, 2) . 
                                            '</h6>';
                                    echo     '<input type=text class="cartProduct" value="'. $cartID .'" style="height:0px; visibility: hidden;">';
                                    echo     '<input type=text class="cartPrice" value="'. $price .'" style="height:0px; visibility: hidden;">';
                                    echo  '</td>';

                                    echo'</tr>';
                                    
                                }
                                    echo'</hr>';
                            }
                        ?>
                        </tbody>
                    </table>
                <h5 class="modal-title" style="TEXT-ALIGN: RIGHT; MARGIN-RIGHT: 3.2rem;" id="payModalLabel"><?php 
                        $totalPrice = null;

                        if (!empty($_SESSION['cartProducts']) && isset($_SESSION['cartProducts'][0]['totalPrice'])) {
                            $totalPrice = $_SESSION['cartProducts'][0]['totalPrice'];
                        }

                        if ($totalPrice !== null) {
                            echo 'TOTAL: $' . number_format($totalPrice, 2) . ' MXN';
                        } else {
                            echo 'N/A';
                        }
                    ?>
                </h5>
                    
                <div id="paypal-btn-container"> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnClose productBtn" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary signUpBtn">Comprar</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      

      <footer>
      <div class="row text-center">
        <div class="col-4">
          <p>Copyright © 2023 wm.In</p>
        </div>
      </div>
    </footer>
    </div>
  </div>

</body>
</html>