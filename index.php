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

			<h6><?php echo "This message is from server side." ?></h6>

			<div class="d-flex align-items-center">

				<div id="popupRegister" class="card">

        <!-- titulo y boton que se van a quedar siempre -->
        <div class="card-header">
          <div class="row">
            <div class="col-10 ms-3 me-auto mt-3">
              <h4>Sign Up</h4>
            </div>
            <div class="col ms-5 pt-3">
              <button data-close-button type="button" class="closeBtn"><i class="icon ion-md-close"></i></button>
            </div>
          </div>
        </div>
        <!-- contenido que va a cambiar -->
        <div class="card-body d-flex">
          <div id="carouselExample" class="carousel slide flex-fill">
            <div class="carousel-inner mx-3 mb-5">

              <form action="signupServlet" method="post" id="formRegister" class="needs-validation" novalidate>
              <!-- form de la pagina 1 :D-->
              <div class="carousel-item active">
                <div class="row g-3">
                  <div class="col-12">
                    <label for="validationName" class="form-label">First name(s)</label>
                    <input type="text" class="form-control" id="validationName" name="nameSignup" placeholder="Mark" value="" required pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                    <div class="invalid-feedback">
                      Please fill with letters. 
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="validationFirstLN" class="form-label">First last name</label>
                    <input type="text" class="form-control" id="validationFirstLN" name="pLastnameSignup" placeholder="Otto" value="" required pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                    <div class="invalid-feedback">
                      Please fill with letters. 
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="validationSecondLN" class="form-label">Second last name</label>
                    <input type="text" class="form-control" id="validationSecondLN" name="mLastnameSignup" placeholder="Otto" value="" required>
                    <div class="invalid-feedback">
                        Please fill with letters.
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="validationEmail" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <input type="email" class="form-control" id="validationEmail" name="emailSignup" placeholder="person@email.com" value="" required>
                      <div class="invalid-feedback">
                        Invalid format. 
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="fechaID" class="form-label">Date of birth</label>
                    <div class="input-group has-validation">
                      <input type="date" class="form-control" id="fechaID" name="fecha" value="" min="1800-01-01" max="" onclick="dateValidation()" required>
                      <div class="invalid-feedback">
                        Please select a valid date.
                      </div>
                    </div>
                  </div>
                
                </div>
              </div>

              <!-- form de la pagina 2 :D -->
              <div class="carousel-item">
                <div class="row g-3 justify-content-center">
                    <div class="col-12">
                      <label class="form-label">Choose a profile picture</label>
                    </div>
                    <div class="col-12 pfpRegistro ms-5">
                        <img src="assets/defaultpfp.png" class="img-fluid rounded-circle"  id="pfpRegistroSrc">
                    </div>
                    <div class="col-12 mb-3">
                        <!--<input type="file" class="form-control" name="profileImgSignup" accept="image/png, image/jpeg" required>-->
                        <input type="url" class="form-control" name="profileImgSignup" id="profileImgSignup" value="" onchange="showImageRegister()" required>
                        <div class="invalid-feedback">
                            Select an image.
                        </div>
                    </div>
                </div>
              </div>

              <!-- form de la pagina 3 :DD -->
              <div class="carousel-item">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="username" class="form-label">Choose a username</label>
                        <input type="text" class="form-control" id="username" name="userSignup" placeholder="mark123" value="" required>
                        <div class="invalid-feedback">
                            Invalid username.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="pass" class="form-label">Choose a password </label>
                        <input type="password" class="form-control" id="pass" name="passSignup" value="" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        <div class="invalid-feedback">
                            The password needs to be at least 8 characters long, have an upper and lower case, a number and a punctuation sign.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="passConfirm" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="passConfirm" name="confirmPassSignup" value="" required >
                        <div class="invalid-feedback">
                            The passwords do not match.
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check" required>
                            <label class="form-check-label" for="check">
                                By checking this box I confirm that I identify as a woman. 
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary signInBtn" >Sign Up</button>
                    </div>
                </div>
              </div>
              </form>
            </div>
            <div class="carousel-indicators mb-0">
              <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
          </div>
        </div>
      </div>

				<div class="container">
        			<h1>SupArt</h1>
        			<h5>Find everything you need</h5>
      			</div>

      			<!-- log in-->
      			<div class="container d-flex flex-column">
		        	<div class="card">
		          		<div class="card-body">
		            		<!--<form action="loginServlet" method="post" class="needs-validation" novalidate>-->
		              			<input type="text" class="form-control mb-3" id="usernameLogin" name="nameLogin" placeholder="Username" required>
		              			<input type="password" class="form-control mb-3" id="passwordLogin" name="passLogin" placeholder="Password" required>
		              			<div class="invalid-feedback">
		                  			Please fill with the correct sintaxis.
		              			</div>
		                    	<div id="invalidPersonalizado" class="bs-danger">
		                    	</div>
		                    	<a href="dashboard.php" class="btn btn-primary signInBtn">Sign In</a>
		              			<!--<input type="submit" action="dashboard.php" class="btn btn-primary signInBtn" value="Sign In">-->
		            		<!--</form>-->
		          		</div>
		        	</div>

		        	<!-- boton registro-->
		        	<button data-modal-target="#popupRegister" type="button" class="btn btn-primary my-3 signUpBtn">New? Sign up</button>
				</div>

			</div>

			
	</body>
</html>