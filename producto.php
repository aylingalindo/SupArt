<?php 
  session_start();

  $username = $_SESSION['usersAPI']['username'];
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
          
          <!-- PRODUCTO -->
          <div class="col-12 d-flex" style="padding-right: 5rem; padding-left: 5rem; padding-bottom: 1rem; padding-top: 1rem;">
            <div class="col d-flex">
              <div class="col-2 imgThmb d-flex flex-column">
                <img src="Img/hojas.jpg" class="object-fit-contain product-imgThmb activo" alt="...">
                <img src="Img/hojas2.jpeg" class="object-fit-contain product-imgThmb" alt="...">
                <img src="Img/hojas3.jpeg" class="object-fit-contain product-imgThmb" alt="...">
                <img src="Img/hojas.jpg" class="object-fit-contain product-imgThmb" alt="...">
              </div>
              <div class="col-8 imgMain">
                <img src="Img/hojas.jpg" class="object-fit-contain product-imgMain" alt="...">
              </div>
            </div>
            <div class="col" style="min-width: 221px;">
              <div class="row product-div">
                <h3 style="color: var(--text)"><b>Hojas de maquina</b></h3>
                <p>Papeles</p>
              </div>
              <div class="row product-div">
                <h6>Descripción</h6>
              </div>
              <div class="row product-div">
                  <div style="flex:1">
                    <h6 class="text-end">Precio negociable</h6>
                    <div id="calif" class="row d-flex justify-content-end">
                        <h6 class="underlineAction">Guardar</h6>
                    </div>
                  </div>
                  <div style="flex:1">
                    <h4 class="text-end">$20.00 MXN</h4>
                    <div id="calif" class="row d-flex justify-content-end">
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
              </div>
              <div id="product-btns" class="row">
                <div class="row d-flex justify-content-center" >
                  <a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" class="btn btn-primary productBtn">Agregar al carrito</a>
                </div>
                <div class="row d-flex justify-content-center">
                  <a href="..." class="btn btn-primary signUpBtn">Comprar</a>
                </div>
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
                        <button id="addCart" type="button" class="btn btn-primary signUpBtn">Confirmar</button>
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