<?php 
session_start(); 
  $userID =  $_SESSION['usersAPI']['userID']; 
  $username = $_SESSION['usersAPI']['username'];
  $rol = $_SESSION['usersAPI']['rol'];

include_once 'API/productsAPI.php';
$product = new productsAPI();

$populares = $product->showProducts(6,null, null, null, null);
$calificados = $product->showProducts(7,null, null, null, null);
$nuevos = $product->showProducts(8,3, null, null, null);

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
</head>
<body>
  <div class="d-flex"> 
    <div id="overlay"></div>

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
              <a class="nav-link" href="index.php">
                Log out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- CONTENT -->
    <div id="content">

      <h2></h2>
      <h2></h2>

      <!-- FEED -->
      <section>

        <div class="row" style="margin-left: 20px; margin-right: 20px;">
          
          <div class="col-12">

            <div class="dashboard-cat-title">
            <h4>Populares</h4>
            </div>
            <div class="dashboard-row col-12 justify-content-start">

              <?php

                foreach($populares as $row){
                  $imageBlob = $row['file'];
                  $image = base64_encode($imageBlob);
                  $imageExt = $row['fileName'];

                  echo
                   "<div class='card' >
                      <img src='" . ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . "' class='object-fit-contain card-img' alt='...''>
                      <div class='card-body'>
                        <a href='producto.php?productID=".$row['productID']."' title='". $row['name'] ."' class='card-link-product' onclick='productDetails(".$row['productID'].")'>
                          <h5 class='card-title card-title-product'><b>". $row['name'] ."</b></h5>
                          <h6 class='card-title card-price-product'> $". $row['price'] ." MXN </h6>
                        </a>
                      </div>
                    </div>";
              }

              ?>

            </div>

           

          </div>

          <div class="col-12" style="padding-top: 10px;">
            
            <div class="dashboard-cat-title">
              <h4>Mejor Calificados</h4>
            </div>

            <div class="dashboard-row col-12 justify-content-start">

               <?php

                foreach($calificados as $row){
                  $imageBlob = $row['file'];
                  $image = base64_encode($imageBlob);
                  $imageExt = $row['fileName'];

                  echo
                   "<div class='card' >
                      <img src='" . ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . "' class='object-fit-contain card-img' alt='...''>
                      <div class='card-body'>
                        <a href='producto.php?productID=".$row['productID']."' title='". $row['name'] ."' class='card-link-product'>
                          <h5 class='card-title card-title-product'><b>". $row['name'] ."</b></h5>
                          <h6 class='card-title card-price-product'> $". $row['price'] ." MXN </h6>
                        </a>
                      </div>
                    </div>";
              }

              ?>

            </div>

          </div>

          <div class="col-12" style="padding-top: 10px;">
            
            <div class="dashboard-cat-title">
              <h4>Novedades</h4>
            </div>

            <div class="dashboard-row col-12 justify-content-start">

               <?php

                foreach($nuevos as $row){
                  $imageBlob = $row['file'];
                  $image = base64_encode($imageBlob);
                  $imageExt = $row['fileName'];

                  echo
                   "<div class='card' >
                      <img src='" . ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . "' class='object-fit-contain card-img' alt='...''>
                      <div class='card-body'>
                        <a href='producto.php?productID=".$row['productID']."' title='". $row['name'] ."' class='card-link-product'>
                          <h5 class='card-title card-title-product'><b>". $row['name'] ."</b></h5>
                          <h6 class='card-title card-price-product'> $". $row['price'] ." MXN </h6>
                        </a>
                      </div>
                    </div>";
              }

              ?>

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