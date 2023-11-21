<?php 
  session_start();
  $userID =  $_SESSION['usersAPI']['userID']; 
  $username = $_SESSION['usersAPI']['username'];
  $rol = $_SESSION['usersAPI']['rol'];

  include_once 'API/categoryAPI.php';
  $cat = new categoryAPI();
  $categorias = $cat->show();

  include_once 'API/productsAPI.php';
  $product = new productsAPI();
  $result = $product->showProducts(4,null, true, null, null);

  if($rol == '4'){
    $resultAdmin = $product->showProducts(5,null, true, null, null);
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
    <script defer src="ventasProductos.js"></script>
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
      <div class="container-fluid d-flex justify-content-end filter-container">
        <div class="row filter-menu">
          <select id="Cat" name="cat" class="form-select" aria-label="Default select example" onchange="selectCategory()">
            <option value="0" selected>Todas las Categorias </option>
            <?php
              foreach($categorias as $cat){
                echo "<option " . ($cat['categoryID'] == $category ? 'selected' : '') . " value=". $cat['categoryID'] . " name='cat'>" . $cat['name'] . "</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </nav>


    <!-- CONTENT -->
    <div id="content" style="padding-top: 8rem;">
      <!-- FEED -->
      <section>

        <div class="row" style="margin-left: 20px; margin-right: 20px;">

          <h4>Mis Productos</h4>
          
          <div class="col-12" style="padding-left: 40px; padding-right: 40px;">

            <div class="row d-flex justify-content-end">
              <div class="col-2">
              <a href="nuevoProducto.php" class="btn btn-primary signUpBtn">Nuevo Producto</a>
              </div>
            </div>
            </br>
            <table id="misProductos" class="table table-hover">
              <tbody>

                <?php 

                  foreach($result as $row){

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

                ?>

              </tbody>
            </table>
           

          </div>

        </div>

        <div class="row" style="margin-left: 20px; margin-right: 20px; margin-top: 20px;" <?php echo $rol != '4' ? 'hidden': '' ?> >

          <h4>Pendientes de Aprobación</h4>
          
          <div class="col-12" style="padding-left: 40px; padding-right: 40px;">

            
            <table class="table table-hover">
              <tbody>

                <?php 

                foreach($resultAdmin as $rowA){
                  $imageBlob = $rowA['file'];
                  $image = base64_encode($imageBlob);
                  $imageExt = $rowA['fileName'];

                  echo
                  "<tr>
                    <td>
                      <img src='" . ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . "' class='object-fit-contain td-img' alt='...''>
                    </td>
                    <td>
                      <div class='row'>
                        <h5 class='td-title'>". $rowA['name'] ."</h5>
                      </div>
                      <div class='row'>
                        <h6>". $rowA['description'] ."</h6>
                      </div>
                      <div class='row'>
                        <p>Publicado por:".$rowA['uploadedName']."</p>
                      </div>
                    </td>
                    <td>
                      <button class='btn btn-primary closeBtn'>
                        <i class='icon ion-md-checkmark'></i>
                      </button>
                    </td>
                  </tr>";
                }

                ?>

              </tbody>
            </table>
          </div>
        </div>

      </br>
      </br>

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