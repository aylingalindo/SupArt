<?php session_start(); 

  $username = $_SESSION['usersAPI']['username'];
  $name = $_SESSION['usersAPI']['name'];
  $lastnameP = $_SESSION['usersAPI']['lastnameP'];
  $lastnameM = $_SESSION['usersAPI']['lastnameM'];

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

    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Themes/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script defer src="profile.js"></script>
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
    </nav>


    <!-- CONTENT -->
    <div id="content" style="padding-top: 6rem;">
      <section>
        <h4 style="margin-bottom: 20px; margin-left: 30px;">Perfil</h4>
        <div style="display: inline-block">
       
            <button id="edit" class="btn btn-primary signInBtn;" > <a href="signup.php?edit=true"> Editar </a></button>
        </div>

        <!-- PROFILE PERSONAL CARD -->
        <div class="container my-5 profile-card" class="profile-card">
            <div class="row justify-content-center">
                    <div class="profile-hero">
                        <div class="container-profilePic">
                            <img src="https://i.pinimg.com/originals/66/44/b3/6644b34c91f57f8d40a4eaa94e3cb797.png" alt="Circular Image" class="img img-fluid" width="200">
                        </div>
                        <div>
                            <h2> <?php echo $name . ' '. $lastnameP . ' '. $lastnameM; ?> </h2>
                            <h2>Perfil publico</h2>
                        </div>
                    </div>
            </div>
        </div>

         <!-- PROFILE LIST CARD -->
        <div class="row">

          <h4 style="margin-left: 30px;">Listas / Productos</h4>
          
          <div class="col-12" style="padding-left: 40px; padding-right: 40px;">

            
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>
                    <img src="Img/libreta.jpeg" class="object-fit-contain td-img" alt="...">
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Block Strathmore 400 Sketch</h5>
                    </div>
                    <div class="row">
                      <h6>Este block excelente para bocetos, estudios y prácticas. Utilízalo con cualquier técnica seca: lápices de grafito, colores, carboncillo, lápices para boceto, pasteles secos o pasteles de aceite.</h6>
                    </div>
                  </td>
                  <td>
                    <h4 class="td-price">$350.00 MXN</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img src="Img/libreta2.jpg" class="object-fit-contain td-img" alt="...">
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Canson® Art Book One</h5>
                    </div>
                    <div class="row">
                      <h6>Libreta de Dibujo de Pasta Dura - 10.2 x 15.2cm, Color Negro</h6>
                    </div>
                  </td>
                  <td>
                    <h4 class="td-price">$240.00 MXN</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Lista 1</h5>
                    </div>
                    <div class="row">
                      <h6>Mi primera lista de compras</h6>
                    </div>
                  </td>
                  <td>
                  </td>
                  <tr>
                  <td>
                  </td>
                  <td>
                    <div class="row">
                      <h5 class="td-title">Lista 2</h5>
                    </div>
                    <div class="row">
                      <h6>Lista de reglos de navidad para mis hijas que amo mucho</h6>
                    </div>
                  </td>
                  <td>
                  </td>
                </tr>
              </tbody>
            </table>

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