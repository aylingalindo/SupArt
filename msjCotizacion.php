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
    <script defer src="chats.js"></script>
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
                <li><a class="dropdown-item" href="ventas.php"><?php echo $rol == '2' ? 'Mis Ventas' : 'Mis Pedidos'; ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Categorías</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- CONTENT -->
    <div id="content" style="padding-top: 6rem;">
      <!-- FEED -->
      <section>

        <h4 id="msjTitle" style="margin-bottom: 20px; margin-left: 30px;">Mis Mensajes</h4>
        <div id="msjCotizacion" class="row row-box d-flex justify-content-center">

          <div class="row row-wborder">

            <div id="wishlistList" class="col-4">
              <ul class="list-box list-group justify-content-center">
<?php

            foreach ($_SESSION['allchatsAPI'] as $chat) {
                $currentProduct = $_SESSION['chatAPI']['current']['productID'] ? $_SESSION['chatAPI']['current']['productID'] : $_SESSION['allchatsAPI'][0]['productID'];
                $productName = $chat['productName'];
                $dinamicID = $chat['productID'];
                $recieverUser = $chat['recieverUser'];
                $sellerID = $chat['sellerID'];

                echo '<li class="list-group-item ' . (($dinamicID == $currentProduct) ? 'active' : '') . '" onclick="currentChat(' . $dinamicID . ', this)">';
                echo '  <div class="row">';
                echo '    <img class="msjImg" src="Img/pfpImg.png">';
                echo '    <h5>'. $productName .'</h5>';
                echo '    <h6>'. $recieverUser .'</h6>';
                echo '  </div>';
                echo '  <input type="hidden" class="productID" value="' . $dinamicID . '">';
                echo '  <input type="hidden" class="sellerID" value="' . $sellerID . '">';

                echo '</li>';
            }
?>
              </ul>
            </div>

            <div id="wishlistDetail" class="col-8 border" style="padding: 0; position: relative; min-width: 500px;">

              <div id="msjChat" class="row">
                <!--<div class="col-12 d-flex" style="padding: 0;">-->

                  <table class="table table-borderless">
                    <tbody>

                      <!--MI MENSAJE-->
<?php
                      function makeProductLink($message, $productID, $productName) {
                            return preg_replace('/'. $productName .'/', '<a href="product.php?id=' . $productID . '">'. $productName .'</a>', $message);
                      }

                      function sender($content, $product, $productName){
                          echo'<tr>';
                          echo  '<td>';
                          echo    '<!-- celda vacia para el espacio del mensaje de la otra persona-->';
                          echo  '</td>';

                          echo  '<td class="d-flex justify-content-end">';
                          echo    '<div class="card miMsj">';
                          echo      '<div class="card-body miMsj">' . makeProductLink($content, $product, $productName).'';
                          echo      '</div>';
                          echo    '</div>';
                          echo  '</td>';

                          echo'</tr>';
                      }

                      function reciever($content, $product, $productName){
                          echo'<tr>';
                          echo  '<td>';
                          echo    '<div class="card suMsj">';
                          echo      '<div class="card-body suMsj">' . makeProductLink($content, $product, $productName) .'';
                          echo     '</div>';
                          echo   '</div>';
                          echo '</td>';
                          echo'<td>';
                          echo   '<!-- celda vacia para el espacio del mensaje mio-->';
                          echo'</td>';
                          echo'</tr>';
                      }
                      if(isset($_SESSION['chatAPI']['current']['messages'])){
                        $currentUser = $_SESSION['usersAPI']['userID'];
		                $reciever = $_SESSION['chatAPI']['current']['receiverID'];
		                $sender = $_SESSION['chatAPI']['current']['senderID'];
		                $product = $_SESSION['chatAPI']['current']['productID'];
		                $productName = $_SESSION['chatAPI']['current']['productName'];

                        foreach ($_SESSION['chatAPI']['current']['messages'] as $message) {
                            $content = $message['message'];
                            $sender = $message['senderID'];

                            $msg = $sender == $currentUser ? sender($content, $product, $productName) : reciever($content, $product, $productName);
                        }
                      }
?>
                    </tbody>
                  </table>

                <!--</div>-->
              </div>

              <div id="inputChat" class="row">
                <div class="col-10" style="padding: 0">
                  <input id="inputMsg" type="text" class="form-control" placeholder="Texto...">
                </div>
                <div class="col-2" style="padding: 0">
                  <button id="sendBtn" type="button" class="btn btn-primary">Enviar</button>
                </div>
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