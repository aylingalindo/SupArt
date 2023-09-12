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

    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <div id="navbar-content" class="row">
          <div class="col-4 d-flex align-items-center">
            <a class="navbar-brand" href="#">SupArt</a>
          </div>

          <div class="col-4">
            <div class="d-flex input-group" role="search">
                <span class="input-group-text pt-0 pb-0" id="search-icon" >
                  <i class="icon ion-md-search"></i>
                </span>
                <input id="search-bar" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
            </div>

          </div>


          <div class="col-4">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex justify-content-evenly" id="navbarSupportedContent">

              <ul class="navbar-nav mb-3 mb-lg-0 ">

                <li class="nav-item mx-4">
                  <a class="nav-link" href="user-profile.php">
                      <i class="icon ion-md-person lead align-self-center"></i>
                  </a>
                </li>
                <li class="nav-item mx-4">
                  <a class="nav-link" href="cart.php">
                      <i class="icon ion-md-cart lead align-self-center"></i>
                  </a>
                </li>

                <li class="nav-item dropdown mx-4">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Más
                  </a>
                  <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Papelería</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Arte</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Oficina</a></li>
                      </ul>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Listas</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Mensajes</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Mis Productos</a></li>
                    <li><a class="dropdown-item" href="#">Mis Ventas</a></li>
                    <li><a class="dropdown-item" href="#">Mis Pedidos</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>


    <!-- CONTENT -->
    <div id="content">
      <section>
        <!-- PROFILE PERSONAL CARD -->
        <div class="container my-5 profile-card" class="profile-card">
            <div class="row justify-content-center">
                    <div class="profile-hero">
                        <div class="container-profilePic">
                            <img src="https://i.pinimg.com/originals/66/44/b3/6644b34c91f57f8d40a4eaa94e3cb797.png" alt="Circular Image" class="img img-fluid" width="200">
                        </div>
                        <div>
                            <h2>Jose Juan Perez Lopez</h2>
                            <h2>Perfil publico</h2>
                        </div>
                    </div>
            </div>
        </div>

         <!-- PROFILE LIST CARD -->
        <div class="container my-5 profile-card profile-display">
            <!-- LIST BUTTON -->
            <div class="profile-btnList">
                <button type="button" class="p-btnList">
                    <div class="profile-btnInfo">
                        <div class="img-container">
                            <img class="img" src="https://wallpaperaccess.com/full/5034369.jpg" width="10px" height="10px">
                        </div>
                        <div>
                             <h5>Lista para pintar</h5>
                             <h6>Descripcion de la lista Descripcion de la lista</h6>
                        </div>
                    </div>
                </button>
                <button type="button" class="p-btnList">
                    <div class="profile-btnInfo">
                        <div class="img-container">
                            <img class="img" src="https://wallpaperaccess.com/full/5034369.jpg" width="10px" height="10px">
                        </div>
                        <div>
                             <h5>Dibujo</h5>
                             <h6>Lista de materiales de dibujo</h6>
                        </div>
                    </div>
                </button>
                <button type="button" class="p-btnList">
                    <div class="profile-btnInfo">
                        <div class="img-container">
                            <img class="img" src="https://wallpaperaccess.com/full/5034369.jpg" width="10px" height="10px">
                        </div>
                        <div>
                             <h5>Para navidad</h5>
                             <h6>Cositas para regalar en navidad</h6>
                        </div>
                    </div>
                </button>
                <button type="button" class="p-btnList">
                    <div class="profile-btnInfo">
                        <div class="img-container">
                            <img class="img" src="https://wallpaperaccess.com/full/5034369.jpg" width="10px" height="10px">
                        </div>
                        <div>
                             <h5>Lista de materiales</h5>
                             <h6>Lista de materiales que ocupo para el semestre</h6>
                        </div>
                    </div>
                </button>
            </div>
            <!-- LIST INFO -->
            <div class="profile-listInfo">
                <h3>Lista de materiales</h3>
                <div class="profile-listObject">
                    <h5>Lapicero</h5>
                    <h6>DescripcionDescripcionDescripcionDescripcionDescripcion</h6>
                    <h6>Precio: $500.00</h6>
                </div>
                <div class="profile-listObject">
                    <h5>Bastidor de tela</h5>
                    <h6>DescripcionDescripcionDescripcionDescripcionDescripcion</h6>
                    <h6>Precio: $500.00</h6>
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