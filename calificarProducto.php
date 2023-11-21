<?php session_start(); 
$rol = $_SESSION['usersAPI']['rol'];

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
    <script defer src="review.js"></script>
</head>
<body>
  <div class="d-flex"> 
    <div id="overlay"></div>

    <!-- CONTENT -->
    <div id="content" style="padding-top: 2rem;">
      <!-- FEED -->
      <section>
        <div class="row" style="margin-left: 20px; margin-right: 20px;">
          

          <h4>Califica los productos :)</h4>
        <hr>
          
          <div class="col-12" style="padding-left: 40px; padding-right: 40px;">

            
            <table class="table table-hover">
              <tbody>
              <?php
                    if(isset($_SESSION['cartProducts'])){
                        foreach ($_SESSION['cartProducts'] as $product) {
                            $cartID = $product['cartID'];
                            $name = $product['name'];
                            $category = $product['category'];
                            $product = $product['product'];
                    
                            echo '<tr>';
                            echo '  <td>';
                            echo '    <img src="Img/libreta.jpeg" class="object-fit-contain td-img" alt="...">';
                            echo '  </td>';
                            echo '  <td>';
                            echo '    <div class="row">';
                            echo '      <h5 class="td-title">'. $name . '</h5>';
                            echo '    </div>';
                            echo '    <div class="row">';
                            echo '      <h6>'. $category. '</h6>';
                            echo '    </div>';
                            echo '  </td>';
                            echo '  <td>';
                            echo '    <div class="row">';
                            echo '      <h5>Calificacion:</h5>';
                            echo '    </div>';
                            echo '    <div id="califInput" class="row">';
                            echo '      <div class="calif col-1">';
                            echo '        <i class="icon ion-md-brush no"></i>';
                            echo '      </div>';
                            echo '      <div class="calif col-1">';
                            echo '        <i class="icon ion-md-brush no"></i>';
                            echo '      </div>';
                            echo '      <div class="calif col-1">';
                            echo '        <i class="icon ion-md-brush no"></i>';
                            echo '      </div>';
                            echo '      <div class="calif col-1">';
                            echo '        <i class="icon ion-md-brush no"></i>';
                            echo '      </div>';
                            echo '      <div class="calif col-1">';
                            echo '        <i class="icon ion-md-brush no"></i>';
                            echo '      </div>';
                            echo '    </div>';
                            echo '  </td>';
                            echo '  <td>';
                            echo '    <div class="form-group">';
                            echo '        <h5>Comentario:</h5>';
                            echo '        <textarea class="comment form-control" id="exampleFormControlTextarea1" rows="3"></textarea>';
                            echo '    </div>';
                            echo '<div style="display:flex; justify-content: center;">';
                            echo     '<input type=text class="productId" value="'. $product .'" style="height:0px; visibility: hidden;">';
                            echo '  <button id="" type="button" class="submitBtn btn btn-primary col-md-6 signUpBtn" style="width: 40%;">Enviar</button>';
                            echo '</div>';
                            echo '  </td>';
                            echo '</tr>';

                        }
                    }else{
                      echo '<h5 class="td-title">No productos</h5>';
                    }
    ?>
              </tbody>
            </table>

          </div>
        </div>
        <div style="display:flex; justify-content: center;">
          <button id="btnBuy" type="button" class="btn btn-primary col-md-6 signUpBtn" style="width: 40%;">Salir de calificar productos</button>
        </div>
        <div class="row" style="margin-left: 20px; margin-right: 20px; margin-top: 20px;">

          

      </section>
    
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

  <script src="Middleware.js"></script>
</body>
</html>