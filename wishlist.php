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
    <div id="content" style="padding-top: 6rem;">
      <!-- FEED -->
      <section>

        <h4 style="margin-bottom: 20px; margin-left: 30px;">Mis Wishlist</h4>
        <div class="row row-box d-flex justify-content-center">

          <div class="row row-wborder">

            <div id="wishlistList" class="col-4 right-border">
              <ul class="list-box list-group justify-content-center">
                <li class="list-group-item">
                  <i class="icon ion-md-add"></i>
                  <h5><b>Crear</b></h5>
                </li>
                <li class="list-group-item active">
                  <i class="icon ion-md-lock"></i>
                  <h5>Lista 1</h5>
                </li>
                <li class="list-group-item">
                  <i class="icon ion-md-lock"></i>
                  <h5>Lista 2</h5>
                </li>
                <li class="list-group-item">
                  <i class="icon ion-md-globe"></i>
                  <h5>Lista 3</h5>
                </li>
              </ul>
            </div>

            <div id="wishlistDetail" class="col-8">

              <div class="col-12" style="padding: 1.5rem">
                <div class="row" style="height: 4rem">
                  <div class="col-8">
                    <h3>Lista 1</h3>
                  </div>
                  <div class="col-4 d-flex justify-content-end">
                    <i class="icon ion-md-lock" style="color: var(--titles)"></i>
                    <i class="icon ion-md-close"></i>
                    <i class="icon ion-md-share"></i>
                  </div>
                </div>
                <div class="row" style="height: 3rem">
                  <p>Descripción de mi primera lista de compras</p>
                </div>
              </div>
          
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
                        <h4 class="td-price">$200.00 MXN</h4>
                      </td>
                      <td>
                        <button class="btn btn-primary closeBtn">
                          <i class="icon ion-md-close"></i>
                        </button>
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
                        <h4 class="td-price">$57.99 MXN</h4>
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
                          <h6>Almohadilla de alambre, 8.5 x 11 pulgadas, 100 hojas (50 lb/74 g) - Papel de artista para adultos y estudiantes - Grafito, carbón, lápiz, lápiz de colores</h6>
                        </div>
                      </td>
                      <td>
                        <h4 class="td-price">$250.00 MXN</h4>
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