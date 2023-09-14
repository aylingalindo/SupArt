<!DOCTYPE html>
	<html>
	<head>
		<title>Supart</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1">

		<link rel="stylesheet" type="text/css" href="Themes/bootstrap-5.3.1-dist/css/bootstrap.min.css">
		<script type="text/javascript" src="Themes/bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="Themes/style.css">
		<script defer src="default.js"></script>
	</head>
	<body>

    <div id="overlay"></div>
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

				<div class="container">

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