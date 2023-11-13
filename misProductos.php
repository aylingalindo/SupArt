<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
  session_start();
  $userID =  $_SESSION['usersAPI']['userID']; 
  $username = $_SESSION['usersAPI']['username'];
  $rol = $_SESSION['usersAPI']['rol'];

  include_once 'API/productsAPI.php';
  $product = new productsAPI();
  $result = $product->showProducts(null, true);

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
                Más
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="wishlist.php">Mis Wishlist</a></li>
                <li><a class="dropdown-item" href="msjCotizacion.php">Mis Mensajes</a></li>
                <li><a class="dropdown-item" href="misProductos.php">Mis Productos</a></li>
                <li><a class="dropdown-item" href="misPedidosVentas.php">Mis Pedidos/Ventas</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Categorías</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="container-fluid d-flex justify-content-end filter-container">
        <div class="row filter-menu" style="display:flex">
          
        </select>
        <div class="dates" style="display: flex; align-items: center;">
            <h6>Filtrar fecha:</h6>
            <div class="form-group" style="display:flex; align-items:center; padding-top:1rem; margin-left: 5rem">
              <label for="date">Date:</label>
              <input type="date" class="form-control" id="startDate">
        </div>
        <div class="form-group" style="display:flex; align-items:center; padding-top:1rem">
              <label for="date">Date:</label>
              <input type="date" class="form-control" id="endDate">
        </div>
        </div>
        </div>
        <div class="row filter-menu">
          <select class="form-select" aria-label="Default select example">
            <option selected>Todas las Categorias </option>
            <option value="1">Plumones</option>
            <option value="2">Lienzos y Bastidores</option>
            <option value="3">Papel</option>
            <option value="4">Pintura</option>
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
            <table class="table table-hover">
              <tbody>

                <?php 

                  foreach($result as $row){

                  echo "<tr>
                    <td>
                      <img src='Img/libreta2.jpg' class='object-fit-contain td-img' alt='...''>
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
                <tr>
                  <td>
                    <img src="Img/plumas.jpeg" class="object-fit-contain td-img" alt="...">
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Canson® Art Book One</h5>
                    </div>
                    <div class="row">
                      <h6>Libreta de Dibujo de Pasta Dura - 10.2 x 15.2cm, Color Negro</h6>
                    </div>
                    <div class="row">
                      <p>Publicado por: Michelle Saenz</p>
                    </div>
                  </td>
                  <td>
                    <button class="btn btn-primary closeBtn">
                      <i class="icon ion-md-close"></i>
                    </button>
                  </td>
                  <td>
                    <button class="btn btn-primary closeBtn">
                      <i class="icon ion-md-checkmark"></i>
                    </button>
                  </td>
                </tr>
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

</body>
</html>