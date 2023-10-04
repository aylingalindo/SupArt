<?php 

	include 'API/usersAPI.php';
	
	$obj = new usersAPI();
	$test = $obj->getAll();
	
?>
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
		<div id="indexPage">
			<div id="overlay"></div>

			<h6>
			<?php 
				echo "This message is from server side.";
				echo $test;
			?>
			</h6>
				
			<div class="d-flex align-items-center">

				<div class="container">
        			<h1>SupArt</h1>
        			<h5>Find everything you need</h5>
      			</div>

      			<!-- log in-->
      			<div class="container d-flex flex-column">
		        	<div class="card">
		          		<div class="card-body">
		            		<form class="needs-validation" novalidate method="POST" action="dashboard.php">
		              			<input type="text" class="form-control mb-3" id="usernameLogin" name="nameLogin" placeholder="Username" required>
		              			<input type="password" class="form-control mb-3" id="passwordLogin" name="passLogin" placeholder="Password"required>
		              			<div class="invalid-feedback">
		                  			Favor de llenar con campos válidos.
		              			</div>
		                    	<button type="submit" class="btn btn-primary signInBtn">Iniciar Sesion</button>
		              			<!--<input type="submit" action="dashboard.php" class="btn btn-primary signInBtn" value="Sign In">-->
		            		</form>
		          		</div>
		        	</div>

		        	<!-- boton registro-->
		        	<!--<button data-modal-target="#popupRegister" type="button" class="btn btn-primary my-3 signUpBtn">New? Sign up</button>-->
		        	<a href="signupOptions.php" type="button" class="btn btn-primary my-3 signUpBtn">Registrarse</a>
				</div>

			 </div>

		</div>
			
	</body>
</html>