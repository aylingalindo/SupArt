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
      <!-- FEED -->
      <section>
      
        <div class="row d-flex" style="margin-left: 20px; margin-right: 20px;">

          <h4>Carrito de compras</h4>
          
          <!--CART PRODUCTS-->
          <div class="col-8" style="padding-left: 40px; padding-right: 40px; border-width: 2rem !important; min-width: 455px;">

            
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
          <div class="col-2 cart-total d-flex align-items-center" style="padding-left: 40px; padding-right: 40px;">
            <div class="border">
                <div class="row d-flex justify-content-center" style="padding-left: 5rem;">  
                  <h3>TOTAL</h3>
                </div>
                <div class="row">
                  <h2><b>$445.99</b></h2>
                </div>
                <div class="row" style="padding-right: 1rem; padding-left: 1rem;"> 
                  <button id="btnBuy" type="button" class="btn btn-primary my-3 signUpBtn">Proceder a pago</button>
                </div>
            </div>
          </div>
        </div>


    <!-- MODAL FOR PAYMENT METHOD -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Metodo de pago</h5>
                <button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close">
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
                <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Comprar</button>
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