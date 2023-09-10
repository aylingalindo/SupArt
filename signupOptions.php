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
		<div id="signupOptionsPage">

			<h6><?php echo "This message is from server side." ?></h6>

			<!--<div class="d-flex align-items-center">-->

				<div class="container d-flex justify-content-center flex-column" style="padding-right: 20%; padding-left: 20%; padding-top: 10%">
		      <div class="row justify-content-center signupOptions">
            <h2>Registrarse con:</h2>
          </div>
          <div class="row signupOptions">
            <a href="signup.php" type="button" class="btn btn-primary">
              <i class="icon ion-logo-google"></i>  Google
            </a>
          </div>
          <div class="row signupOptions">
            <a href="signup.php" type="button" class="btn btn-primary">
              <i class="icon ion-logo-facebook"></i>  Facebook
            </a>
          </div>
          <div class="row signupOptions">
            <a href="signup.php" type="button" class="btn btn-primary">
              <i class="icon ion-md-mail"></i>  Correo
            </a>
          </div>

        </div>

		</div>
			
	</body>
</html>