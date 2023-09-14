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

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand ps-3" href="#">SupArt</a>
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
      <!-- FEED -->
      <section>

        <h4 style="margin-bottom: 20px; margin-left: 30px;">Mis Mensajes</h4>
        <div id="msjCotizacion" class="row row-box d-flex justify-content-center">

          <div class="row row-wborder">

            <div id="wishlistList" class="col-4 right-border">
              <ul class="list-box list-group justify-content-center">
                <li class="list-group-item">
                  <div class="row">
                    <img class="msjImg" src="Img/pfpImg.png">
                    <h5>Aylin Galindo</h5>
                  </div>
                </li>
                <li class="list-group-item active">
                  <div class="row">
                    <img class="msjImg" src="Img/pfpImg.png">
                    <h5>Edson Arguello</h5>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <img class="msjImg" src="Img/pfpImg.png">
                    <h5>Michelle Saenz</h5>
                  </div>
                </li>
              </ul>
            </div>

            <div id="wishlistDetail" class="col-8" style="padding: 0; position: relative;">

              <div id="msjChat" class="row">
                <!--<div class="col-12 d-flex" style="padding: 0;">-->

                  <table class="table table-borderless">
                    <tbody>

                      <!--MI MENSAJE-->
                      <tr>
                        <td>
                          <!-- celda vacia para el espacio del mensaje de la otra persona-->
                        </td>

                        <td class="d-flex justify-content-end">
                          <div class="card miMsj">
                            <div class="card-body miMsj">
                              Me gustaria cotizar el precio del producto: 
                              <a href="...">Pluma Pentel 2023</a>
                            </div>
                          </div>
                        </td>

                      </tr>

                      <!--SU MENSAJE-->
                      <tr>
                        <td>
                          <div class="card suMsj">
                            <div class="card-body suMsj">
                              Hola! Mucho gusto, si claro.
                            </div>
                          </div>
                        </td>

                        <td>
                          <!-- celda vacia para el espacio del mensaje mio-->
                        </td>

                      </tr>

                      <!--SU MENSAJE-->
                      <tr>
                        <td>
                          <div class="card suMsj">
                            <div class="card-body suMsj">
                              El precio de ese producto es de 200.
                            </div>
                          </div>
                        </td>

                        <td>
                          <!-- celda vacia para el espacio del mensaje mio-->
                        </td>

                      </tr>

                    </tbody>
                  </table>

                <!--</div>-->
              </div>

              <div id="inputChat" class="row">
                <div class="col-10" style="padding: 0">
                  <input type="text" class="form-control" placeholder="Texto...">
                </div>
                <div class="col-2" style="padding: 0">
                  <button type="button" class="btn btn-primary">Enviar</button>
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