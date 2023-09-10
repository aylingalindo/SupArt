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
		<div id="signupPage">

			<h6><?php echo "This message is from server side." ?></h6>

			<!--<div class="d-flex align-items-center">-->

				<div class="container">
        		
      			<!--<div class="container d-flex flex-column">-->
		        	<div class="row p-5 d-flex justify-content-center">
                  <div class="col-4 form-group">
                    <label for="validationName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="validationName" name="nameSignup" placeholder="Mark" value="" required pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                    <div class="invalid-feedback">
                      Please fill with letters. 
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="validationFirstLN" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="validationFirstLN" name="pLastnameSignup" placeholder="Otto" value="" required pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                    <div class="invalid-feedback">
                      Please fill with letters. 
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="validationSecondLN" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="validationSecondLN" name="mLastnameSignup" placeholder="Otto" value="" required>
                    <div class="invalid-feedback">
                        Please fill with letters.
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="fechaID" class="form-label">Date of birth</label>
                    <div class="input-group has-validation">
                      <input type="date" class="form-control" id="fechaID" name="fecha" value="" min="1800-01-01" max="" onclick="dateValidation()" required>
                      <div class="invalid-feedback">
                        Please select a valid date.
                      </div>
                    </div>
                  </div>
                  <div class="col-4 form-group">
                    <label for="validationSecondLN" class="form-label">Sexo</label>
                    <input type="text" class="form-control" id="validationSecondLN" name="mLastnameSignup" value="" required>
                    <div class="invalid-feedback">
                        Please fill with letters.
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label for="validationEmail" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <input type="email" class="form-control" id="validationEmail" name="emailSignup" placeholder="person@email.com" value="" required>
                      <div class="invalid-feedback">
                        Invalid format. 
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-6 form-group">
                    <label for="username" class="form-label">Choose a username</label>
                    <input type="text" class="form-control" id="username" name="userSignup" placeholder="mark123" value="" required>
                    <div class="invalid-feedback">
                      Invalid username.
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label for="pass" class="form-label">Choose a password </label>
                    <input type="password" class="form-control" id="pass" name="passSignup" value="" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                    <div class="invalid-feedback">
                      The password needs to be at least 8 characters long, have an upper and lower case, a number and a punctuation sign.
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label for="passConfirm" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="passConfirm" name="confirmPassSignup" value="" required >
                    <div class="invalid-feedback">
                      The passwords do not match.
                    </div>
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
                    <a href="dashboard.php" type="submit" class="btn btn-primary signInBtn" >Sign Up</a>
                  </div>
                </div>
				    <!--</div>-->

			</div>

			
	</body>
</html>