<?php 
  session_start();

  $username = $_SESSION['usersAPI']['username'];
  $userID =  $_SESSION['usersAPI']['userID']; 
  $rol = $_SESSION['usersAPI']['rol'];

  include_once 'API/productsAPI.php';
  $productAPI = new productsAPI();

  $review = 0;

  if(isset($_GET['productID'])){
    $productID = $_GET['productID']; 
    $producto = $productAPI->showProducts(1,$productID,null, null, null);

    $name = $producto[0]['name'];
    $cat = $producto[0]['categoryName'];
    $stock = $producto[0]['stock'];
    $desc = $producto[0]['description'];
    $pricingType = $producto[0]['pricingType'];
    echo ($pricingType);
    $price = $producto[0]['price'];
    $review = intval($producto[0]['review']);
    $user = $producto[0]['uploadedByName'];
    $sellerID = $producto[0]['uploadedBy'];

    $files = $productAPI->showProductFiles($productID);

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

    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Themes/style.css">
    <script defer src="default.js"></script>
    <script defer src="cart.js"></script>
    <!--<script defer src="ventasProductos.js"></script>-->
    <script defer src="chats.js"></script>
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
            <input id="search-bar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" oninput="dashboardSearch()">
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
                Más
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
            <li class="nav-item">
              <a class="nav-link" onclick="logout()">
                Log out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- POP UP AGREGAR A WISHLIST -->

    <div id="popupAddToWishlist" class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-10 ms-5 me-auto mt-3">
            <h4>Añadir a wishlist</h4>
          </div>
          <div class="col pt-3">
            <button data-close-button type="button" class="closeBtn"><i class="icon ion-md-close"></i></button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row filter-menu">
          <select class="form-select" aria-label="Default select example">
            <option selected>Seleccione una lista</option>
            <option value="1">Lista 1</option>
            <option value="2">Lista 2</option>
            <option value="3">Lista 3</option>
          </select>
        </div>
        <div class="row">
          <button class="btn btn-primary">Añadir</button>
        </div>
      </div>

    </div>

    <!-- CONTENT -->
    <div id="content">

      <h2></h2>
      <h2></h2>

      <!-- FEED -->
      <section>

        <div class="row" style="margin-left: 20px; margin-right: 20px;">

          <?php 
        

          ?>
          
          <!-- PRODUCTO -->
          <div class="col-12 d-flex" style="padding-right: 5rem; padding-left: 5rem; padding-bottom: 1rem; padding-top: 1rem;">
            <div class="col d-flex">
              <div class="col-2 imgThmb d-flex flex-column">

                <?php
                $defaultImage = 'Img/prodImg.jpeg';
                $maxItems = 4;

                for ($i = 0; $i < $maxItems; $i++) {

                  if($i == 0){
                    $class = "object-fit-contain product-imgThmb activo";
                  }else {
                    $class = "object-fit-contain product-imgThmb";
                  }

                  if (isset($files[$i])) {
                    $file = $files[$i];

                    if ($file['fileName'] == 'mp4') {
                      // Video
                      $video = $file['file'];
                      $videoExt = $file['fileName'];
                      echo '
                      <video controls class="'.$class.'" alt="Video">
                        <source src="data:video/' . $videoExt . ';base64,' . base64_encode($video) . '" type="video/' . $videoExt . '">
                          Your browser does not support the video tag.
                      </video>';
                    }else {
                    // Image
                    $image = $file['file'];
                    $imageExt = $file['fileName'];
                    echo '<img src="data:image/' . $imageExt . ';base64,' . base64_encode($image) . '" class="'.$class.'" alt="Image">';
                    }
                  } else {
                    echo '<img src="' . $defaultImage . '" class="'.$class.'" alt="Default Image">';
                  }
                }
                ?>
              </div>
              <div class="col-8 imgMain">
                <img src="<?php echo (isset($files[0]['fileName']) ? 'Img/prodImg.jpeg' : 'data:image/' . $files[0]['fileName'] . ';base64,' . $files[0]['file']); ?>" class="object-fit-contain product-imgMain" style="height: 15rem; width: 15rem;" alt="...">
              </div>

            </div>
            <div class="col" style="min-width: 221px;">
              <div class="row product-div">
                <h3 style="color: var(--text)"><b><?php echo $name; ?></b></h3>
                <h6 style="color: var(--primary)"><b><?php echo $cat; ?></b></h6>
                <p>Publicado por: <?php echo $user; ?></p>
              </div>
              <div class="row product-div">
                <h6><?php echo $desc; ?></h6>
              </div>
              <div class="row product-div">
                    <h4 class="text-end">$<?php echo $price; ?> MXN</h4>
                    <div id="calif" class="row d-flex justify-content-end">
                          <div class="col-1">
                            <i class="icon ion-md-brush <?php echo $review >= 1 ? '' : 'no' ?>"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush <?php echo $review >= 2 ? '' : 'no'?>"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush <?php echo $review >= 3 ? '' : 'no'?>"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush <?php echo $review >= 4 ? '' : 'no'?>"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush <?php echo $review >= 5 ? '' : 'no'?>"></i>
                          </div>
                    </div>
              </div>
              <div id="product-btns" class="row" <?php echo $rol == 2 ? 'hidden' : '' ?> >
                <div class="row d-flex justify-content-center" >
                  <a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" class="btn btn-primary productBtn">Agregar al carrito</a>
                </div>
                <div class="row d-flex justify-content-center" style="<?php echo $pricingType == 'Negotiable' ? 'display: none!important;' : ''; ?>">
                  <a href="..." class="btn btn-primary signUpBtn">Comprar</a>
                </div>
                <!-- TO-DO: QUITAR SI YA FUNCIONA EL CODIGO --> <input type="text" class="idProducto" product-name="" value="<?php echo isset($productID) ? $productID : 5; ?>" style="height: 0px; visibility: hidden;">
                <div id="product-message" class="row d-flex justify-content-center" style="<?php echo $pricingType == 'Sell' ? 'display: none!important;' : ''; ?>">
                  <l style="width: 40%; margin: 0.3rem;" class="btn btn-primary signUpBtn">Cotizar</p>
                </div>
                <!-- TO-DO: QUITAR SI YA FUNCIONA EL CODIGO --> <input type="text" class="idVendedor" product-name="" value="<?php echo isset($sellerID) ? $sellerID : 8; ?>" style="height: 0px; visibility: hidden;">
                <div class="row d-flex justify-content-center">
                  <button data-modal-target="#popupAddToWishlist" type="button" class="btn btn-primary productBtn">Agregar a Wishlist</button>
                </div>
              </div>
            </div>
          </div>

          <!-- COMENTARIOS -->
          <div class="col-12"  style="padding-top: 1rem; padding-bottom: 1rem;">
            <div class="dashboard-cat-title">
            <h4>Comentarios</h4>
            </div>
            <div id="comentarios">

              <div class="card" style="margin-left: 1rem;">
                <div class="card-header">
                  <div class="row d-flex" style="padding: 0.3rem;">
                    <img class="msjImg" src="Img/pfpImg.png">
                    <div class="col-10" style="padding-top: 0.5rem;">
                      <h5>Aylin Galindo</h5>
                    </div>
                  </div>
                  <div id="calif" class="row">
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush no"></i>
                      </div>
                  </div>
                </div>
                <div class="card-body" style="padding-left: 1.5rem;">
                  Muy buen producto 
                </div>
              </div>

              <div class="card" style="margin-left: 1rem;">
                <div class="card-header">
                  <div class="row d-flex" style="padding: 0.3rem;">
                    <img class="msjImg" src="Img/pfpImg.png">
                    <div class="col-10" style="padding-top: 0.5rem;">
                      <h5>Michelle Saenz</h5>
                    </div>
                  </div>
                  <div id="calif" class="row">
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush no"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush no"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush no"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush no"></i>
                      </div>
                  </div>
                </div>
                <div class="card-body" style="padding-left: 1.5rem;">
                  No me gustó 
                </div>
              </div>

              <div class="card" style="margin-left: 1rem;">
                <div class="card-header">
                  <div class="row d-flex" style="padding: 0.3rem;">
                    <img class="msjImg" src="Img/pfpImg.png">
                    <div class="col-10" style="padding-top: 0.5rem;">
                      <h5>Edson Arguello</h5>
                    </div>
                  </div>
                  <div id="calif" class="row">
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                      <div class="col-1">
                        <i class="icon ion-md-brush"></i>
                      </div>
                  </div>
                </div>
                <div class="card-body" style="padding-left: 1.5rem;">
                  Me sirivió mucho para la escuela, las hojas eran muy resistentes y de buen tamaño y el paquete es suficientemente grande como para que te dure todo el semestre, gracias a dios por esta oportunidad, estoy muy feliz. Recomiendo ampliamente. 
                </div>
              </div>

            </div>

          </div>

          <!--- MAS ARTICULOS -->
          <div class="col-12" style="padding-top: 1rem; padding-bottom: 1rem;">

            <div class="dashboard-cat-title">
            <h4>Más Artículos del Vendedor</h4>
            </div>
            <div class="dashboard-row col-12 justify-content-start">

               <div class="card" >
                  <img src="Img/hojas.jpg" class="object-fit-contain card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Hojas Xerox Tamaño Carta" class="card-link-product">
                      <h5 class="card-title card-title-product">Hojas Xerox Tamaño Carta</h5>
                      <h6 class="card-title card-price-product">$150.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card" >
                  <img src="Img/plumas.jpeg" class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Pluma PinPoint Azor Colores Varios" class="card-link-product">
                      <h5 class="card-title card-title-product">Pluma PinPoint Azor Colores Varios</h5>
                      <h6 class="card-title card-price-product">$21.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card" >
                  <img src="Img/plumones.jpeg" class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Plumones Touch de Doble Punta Pincel" class="card-link-product">
                      <h5 class="card-title card-title-product">Plumones Touch de Doble Punta Pincel</h5>
                      <h6 class="card-title card-price-product">$1,500.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card" >
                  <img src="Img/gises.jpeg" class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Gises Pastel 36 Piezas" class="card-link-product">
                      <h5 class="card-title card-title-product">Gises Pastel 36 Piezas</h5>
                      <h6 class="card-title card-price-product">$250.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card" >
                  <img src="..." class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Titulo de dos lineas larguito para que se oculte" class="card-link-product">
                      <h5 class="card-title card-title-product">Card title</h5>
                      <h6 class="card-title card-price-product">$00.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card" >
                  <img src="..." class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Titulo de dos lineas larguito para que se oculte" class="card-link-product">
                      <h5 class="card-title card-title-product">Card title</h5>
                      <h6 class="card-title card-price-product">$00.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card">
                  <img src="..." class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Titulo de dos lineas larguito para que se oculte" class="card-link-product">
                      <h5 class="card-title card-title-product">Card title</h5>
                      <h6 class="card-title card-price-product">$00.00 MXN</h6>
                    </a>
                  </div>
                </div>

                <div class="card" >
                  <img src="..." class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Titulo de dos lineas larguito para que se oculte" class="card-link-product">
                      <h5 class="card-title card-title-product">Card title</h5>
                      <h6 class="card-title card-price-product">$00.00 MXN</h6>
                    </a>
                  </div>
                </div>
            </div>
          </div>

        </div>
    
        <!-- Modal Carrito -->
        <div class="modal fade" id="cartModal" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addToCartModalLabel">¡Agregando producto al carrito!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="numItems">Cantidad:</label>
                                <input type="number" class="form-control" id="numItems" placeholder="1" min="1" value=1>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary productBtn" data-bs-dismiss="modal">Cancelar</button>
                        <button id="addCart" type="button" onclick="addToCart()" class="btn btn-primary signUpBtn">Confirmar</button>
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

  <script src="Middleware.js"></script>
</body>
</html>