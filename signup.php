<?php

    if (isset($_GET['edit']) && $_GET['edit'] == 'true') {
        session_start();

        $edit = true; 

        $userID =  $_SESSION['usersAPI']['userID']; 
        $username = $_SESSION['usersAPI']['username'];
        $name = $_SESSION['usersAPI']['name'];
        $lastnameP = $_SESSION['usersAPI']['lastnameP'];
        $lastnameM = $_SESSION['usersAPI']['lastnameM'];
        $birthday = $_SESSION['usersAPI']['birthday'];
        $gender = $_SESSION['usersAPI']['gender'];
        $email = $_SESSION['usersAPI']['email'];
        $visibility = $_SESSION['usersAPI']['visibility'];
        $rol = $_SESSION['usersAPI']['rol'];

    }else {
        clearFields();
    }

    function clearFields(){
        $edit = false; 

        $userID =  null; 
        $username = '';
        $name = '';
        $lastnameP = '';
        $lastnameM = '';
        $birthday = '';
        $gender = '';
        $email = '';
        $visibility = '1';
        $rol = '1';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="Themes/style.css">
    <script defer src="default.js"></script>
    <!--<script defer src="signup.js"></script>-->
</head>
<body>
    <div id="signupPage">

        <div class="container">

            <form id="signup" class="container d-flex flex-column needs-validation" novalidate method="POST" action="./API/usersAPI.php?action=insert">
                <div class="row p-5 d-flex justify-content-center">
                    <input id="userID" name="userID" value="<?php echo $userID;?>" hidden>
                    <div class="col-4 form-group">
                        <label for="validationName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="validationName" name="name" placeholder="Mark" 
                        value="<?php echo $name;?>" required pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                        <div class="invalid-feedback">
                            Favor de llenar con letras.
                        </div>
                    </div>
                    <div class="col-4 form-group">
                        <label for="validationFirstLN" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="validationFirstLN" name="pLastname" placeholder="Otto" value="<?php echo $lastnameP;?>" required pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">
                        <div class="invalid-feedback">
                            Favor de llenar con letras.
                        </div>
                    </div>
                    <div class="col-4 form-group">
                        <label for="validationSecondLN" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="validationSecondLN" name="mLastname" placeholder="Otto" value="<?php echo $lastnameM;?>" required>
                        <div class="invalid-feedback">
                            Favor de llenar con letras.
                        </div>
                    </div>
                    <div class="col-4 form-group">
                        <label for="fechaID" class="form-label">Fecha de Nacimiento</label>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control" id="fechaID" name="fecha" value="<?php echo $birthday;?>" min="1800-01-01" max="" onclick="dateValidation()" required>
                            <div class="invalid-feedback">
                                Favor de seleccionar una fecha válida. 
                            </div>
                        </div>
                    </div>
                    <div class="col-4 form-group">
                        <label for="validationSecondLN" class="form-label">Sexo</label>
                        <input type="text" class="form-control" id="validationSecondLN" name="gender" value="<?php echo $gender;?>" required>
                        <div class="invalid-feedback">
                            Campo vacio. 
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label for="validationEmail" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <input type="email" class="form-control" id="validationEmail" name="email" placeholder="person@email.com" value="<?php echo $email;?>" required>
                            <div class="invalid-feedback">
                                Favor de llenar con un correo válido.
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="mark123" value="<?php echo $username;?>" required pattern="(.*[a-z]){3}">
                        <div class="invalid-feedback">
                            Nombre de usuario inválido. 
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="password" value="" pattern="(?=^.{8,}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        <div class="invalid-feedback">
                            Contraseña inválida. 
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label for="passConfirm" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="passConfirm" name="confirmPassSignup" value="" required>
                        <div class="invalid-feedback">
                            Las contraseñas no coinciden
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
                    <div class="col-2 form-group flex-column">
                        <label for="passConfirm" class="form-label">Privacidad del perfil</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="rbtnPrivacidad" id="rbtnPrivacidad" value="1" <?php echo   $visibility != '0' ? 'checked' : '' ?> >
                          <label class="form-check-label" for="chkPublico">
                            Público
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="rbtnPrivacidad" id="rbtnPrivacidad" value="0" <?php echo   $visibility == '0' ? 'checked' : '' ?> >
                          <label class="form-check-label" for="chkPrivado">
                            Privado
                          </label>
                        </div>
                        </br>
                        <label for="passConfirm" class="form-label">Tipo de perfil</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="rbtnRol" id="rbtnRol" value="1" <?php echo $rol != '2' ? 'checked' : '' ?>>
                          <label class="form-check-label" for="chkComprador">
                            Comprador
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="rbtnRol" id="rbtnRol" value="2"  <?php echo $rol == '2' ? 'checked' : '' ?>>
                          <label class="form-check-label" for="chkVendedor">
                            Vendedor
                          </label>
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <div class="row">
                            <div class="col-6">
                                <a href="<?php echo $edit == true ? 'user-profile.php' : 'index.php' ?>" class="btn btn-primary signInBtn">Cancelar</a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary signInBtn" style="background-color: var(--primary)"><?php  echo $edit == true ? 'Guardar cambios' : 'Registrarse' ?> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>


</body>
</html>