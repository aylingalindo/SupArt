<?php 
  session_start();
  $userID =  $_SESSION['usersAPI']['userID']; 
  $username = $_SESSION['usersAPI']['username'];

  include_once 'API/productsAPI.php';
  $product = new productsAPI();

  include_once 'API/categoryAPI.php';
  $cat = new categoryAPI();

  $categorias = $cat->show();

  if (isset($_GET['editID']) && $_GET['editID'] != '0') {
    session_start();
    $edit = $_GET['editID']; 

    $resultado = $product->showProducts($edit, false);

        //if(count($result) === 1){
    $name =  $resultado[0]['name']; 
    $price = $resultado[0]['price'];
    $stock = $resultado[0]['stock']; 
    $description = $resultado[0]['description'];
    $category = $resultado[0]['category'];
    $type = $resultado[0]['pricingType'];

    echo " <script language='JavaScript'>
          alert('name:".$name.", price:".$price." stock:".$stock." desc:".$description." ');
          </script>";

  }else {
    clearFields();
  }

  function clearFields(){
    $edit = '0'; 

    $name = '';
    $price = '';
    $stock = '';
    $description = '';
    $category = '0';
    $type = 'Sell';
  }
?>

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

		<div id="signupPage">

      <!-- POP UP NUEVOA CATEGORIA -->

    <div id="popupNewCat" class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-10 ms-5 me-auto mt-3">
            <h4>Nueva categoría</h4>
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

            <h4><?php echo $edit == '0' ? 'Nuevo Producto' : 'Editar Producto' ?></h4>
        		
      			<form class="container d-flex flex-column needs-validation" novalidate method="POST" enctype="multipart/form-data"      action="./API/productsAPI.php?action=insert">
              <input id="productID" name="productID" value="<?php echo $edit;?>" hidden>
		        	<div class="row p-5 d-flex justify-content-center">
                  <div class="col-3 form-group">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required>
                    <div class="invalid-feedback">
                      Completar con letras. 
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="Cat" class="form-label">Categoria</label>
                    <select name="cat" class="form-select" aria-label="Default select example" id="Cat" required>
                      <option value="0" selected>Seleccione la Categoria </option>
                      <?php
                      foreach($categorias as $cat){
                        echo "<option " . ($cat['categoryID'] == $category ? 'selected' : '') . " value=". $cat['categoryID'] . " name='cat'>" . $cat['name'] . "</option>";
                      }
                      ?> 
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
                      <input class="form-check-input" type="radio" name="pricingType" id="pricingType" value="1" <?php echo $type == 'Sell' ? 'checked' : '' ?>>
                      <label class="form-check-label" for="pricingType1">
                        Venta
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="pricingType" id="pricingType" value="0" <?php echo $type == 'Negotiable' ? 'checked' : '' ?> >
                      <label class="form-check-label" for="pricingType2">
                        Cotización
                      </label>
                    </div>
                  </div>
                  <div class="col-2 form-group">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $price ?>" required>
                    <div class="invalid-feedback">
                        Favor de ingresar un número 
                    </div>
                  </div>
                  <div class="col-2 form-group">
                    <label for="stock" class="form-label">Cantidad Disponible</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock ?>" required>
                    <div class="invalid-feedback">
                        Favor de ingresar un número 
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="prodDesc" class="form-label">Descripción</label>
                    <textarea rows="3" type="text" class="form-control mb-3" id="prodDesc" name="prodDesc" required> <?php echo $description ?> </textarea>
                  </div>
                  <div class="col-4 form-group flex-column">
                    <div class="row">
                      <div class="col-8">
                        <div class="col-8">
                          <img src="Img/addImg.png" class="object-fit-contain new-imgMain">
                        </div>
                        <div class="col-4 d-flex">
                          <img src="Img/addImg.png" class="object-fit-contain new-imgThmb activo" alt="...">
                          <img src="Img/addImg.png" class="object-fit-contain new-imgThmb" alt="...">
                          <img src="Img/addImg.png" class="object-fit-contain new-imgThmb" alt="...">
                          <img src="Img/addImg.png" class="object-fit-contain new-imgThmb" alt="...">
                        </div>
                      </div>
                      <div class="col-2 d-flex">
                        <button type="button" class="btn btn-primary align-self-center">+</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <button type="submit" class="btn btn-primary signInBtn"><?php echo $edit == '0' ? 'Crear' : 'Editar' ?></button>
                  </div>
                </div>
				    </form>

			</div>

			
	</body>
</html>