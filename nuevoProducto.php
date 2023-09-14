<!DOCTYPE html>
	<html>
	<head>
		<title>Supart</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1">

		<link rel="stylesheet" type="text/css" href="Themes/bootstrap-5.3.1-dist/css/bootstrap.min.css">
		<script type="text/javascript" src="Themes/bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>

    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="Themes/style.css">
		<script defer src="default.js"></script>
	</head>
	<body>

    <div id="overlay"></div>

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

		<div id="signupPage">

			<h6><?php echo "This message is from server side." ?></h6>

      <!-- POP UP NUEVOA CATEGORIA -->

    <div id="popupNewCat" class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-10 ms-5 me-auto mt-3">
            <h4>Añadir a wishlist</h4>
          </div>
          <div class="col pt-3">
            <button data-close-button type="button" class="closeBtn" style="color: var(--light)"><i class="icon ion-md-close"></i></button>
          </div>
        </div>
      </div>

      <div class="card-body" style="padding-left: 3rem; padding-right: 3rem;">
        <form class="needs-validation" novalidate method="POST" action="wishlist.php">
        <div class="row">
            <input type="text" class="form-control mb-3" id="wishlistName" name="wishlistName" placeholder="Nombre" required>
            <div class="invalid-feedback">
              Favor de llenar todos los campos.
            </div>
        </div>
        <div class="row">
          <button type="submit" class="btn btn-primary">Crear</button>
        </div>
        </form>
      </div>

    </div>

			<!--<div class="d-flex align-items-center">-->

				<div class="container" style="padding-top: 6rem;">

            <h4>Nuevo Producto</h4>
        		
      			<form class="container d-flex flex-column needs-validation" novalidate method="POST" action="index.php">
		        	<div class="row p-5 d-flex justify-content-center">
                  <div class="col-3 form-group">
                    <label for="validationName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="validationName" name="nameSignup" placeholder="Mark" value="" required>
                    <div class="invalid-feedback">
                      Completar con letras. 
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="Cat" class="form-label">Categoria</label>
                    <select class="form-select" aria-label="Default select example" id="Cat" required>
                      <option selected>Seleccione la Categoria </option>
                      <option value="1">Plumones</option>
                      <option value="2">Lienzos y Bastidores</option>
                      <option value="3">Papel</option>
                      <option value="4">Pintura</option>
                    </select>
                    <div class="invalid-feedback">
                      Favor de seleccionar una categoria. 
                    </div>
                  </div>
                  <div class="col-1" style="padding-top: 2rem;">
                    <button type="button" class="btn btn-primary signUpBtn" data-modal-target="#popupNewCat">+</button>
                  </div>
                   <div class="col-4 form-group" style="padding-top: 2rem;">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                      <label class="form-check-label" for="flexRadioDefault1">
                        Venta
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Cotización
                      </label>
                    </div>
                  </div>
                  <div class="col-2 form-group">
                    <label for="validationSecondLN" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="validationSecondLN" name="mLastnameSignup" value="" required>
                    <div class="invalid-feedback">
                        Campo vacio. 
                    </div>
                  </div>
                  <div class="col-2 form-group">
                    <label for="validationSecondLN" class="form-label">Cantidad Disponible</label>
                    <input type="number" class="form-control" id="validationSecondLN" name="mLastnameSignup" value="" required>
                    <div class="invalid-feedback">
                        Campo vacio. 
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="prodDesc" class="form-label">Descripción</label>
                    <textarea rows="3" type="text" class="form-control mb-3" id="prodDesc" name="wishlistDesc" required></textarea>
                  </div>
                  <div class="col-4 form-group flex-column">
                    <div class="row">
                      <div class="col-8 d-flex">
                        <img src="Img/addImg.png">
                      </div>
                      <div class="col-2 d-flex">
                        <button type="button" class="btn btn-primary align-self-center">+</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <button type="submit" class="btn btn-primary signInBtn">Crear</button>
                  </div>
                </div>
				    </form>

			</div>

			
	</body>
</html>