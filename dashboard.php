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
    <script defer src="default.js"></script>
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

          <div class="col-12" style="padding-top: 10px;">
            
            <div class="dashboard-cat-title">
              <h4>Más Vendidos</h4>
            </div>

            <div class="dashboard-row col-12 justify-content-start">

               <div class="card" >
                  <img src="..." class="card-img" alt="...">
                  <div class="card-body">
                    <a href="..." title="Titulo de dos lineas larguito para que se oculte" class="card-link-product">
                      <h5 class="card-title card-title-product">Titulo de dos lineas larguito para que se oculte</h5>
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

            </div>

          </div>

          <div class="col-12" style="padding-top: 10px;">
            
            <div class="dashboard-cat-title">
              <h4>Categoria</h4>
            </div>

            <div class="dashboard-row col-12 justify-content-start">

               <div class="card">
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