<?php session_start(); 
$rol = $_SESSION['usersAPI']['rol'];

include_once 'API/categoryAPI.php';
  $cat = new categoryAPI();
  $categorias = $cat->show();
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
    <script defer src="ventasProductos.js"></script>
    <script defer src="misventas.js"></script>
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
                Mas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="wishlist.php">Mis Wishlist</a></li>
                <li><a class="dropdown-item" href="msjCotizacion.php">Mis Mensajes</a></li>
                <li><a class="dropdown-item" href="ventas.php"><?php echo $rol == '2' ? 'Mis Ventas' : 'Mis Pedidos'; ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Categorías</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="container-fluid d-flex justify-content-end filter-container">
  <div class="row filter-menu">
    <div class="row">
      <div class="col-md-3">
        <div class="mb-3">
          <label for="startDate" class="form-label">Start Date:</label>
          <input type="date" class="form-control" id="startDate">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="endDate" class="form-label">End Date:</label>
          <input type="date" class="form-control" id="endDate">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="Cat" class="form-label">Category:</label>
          <select id="Cat" name="cat" class="form-select" aria-label="Category select" onchange="selectCategory()">
            <option value="-1" selected>Todas las Categorias</option>
            <?php
              foreach ($categorias as $cat) {
                echo "<option " . ($cat['categoryID'] == $category ? 'selected' : '') . " value=" . $cat['categoryID'] . " name='cat'>" . $cat['name'] . "</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
      <button id="filtrar" type="button" class="btn btn-primary">
          Filtrar
        </button>
        </div>
    </div>
  </div>
</div>

    </nav>


    <!-- CONTENT -->
    <div id="content" style="padding-top: 8rem;">
      <!-- FEED -->
      <section>

        <div class="row" style="margin-left: 20px; margin-right: 20px;">

        <h4><?php echo $rol == '2' ? 'Mis Ventas' : 'Mis Pedidos'; ?></h4>
          
          <div class="col-12" style="padding-left: 40px; padding-right: 40px;">

            
            <table class="table table-hover">
              <tbody id="contenido">

<?php
                if(isset($_SESSION['salesAPI'])){
                    foreach ($_SESSION['salesAPI'] as $sale) {
                        $productName = $sale['productName'];
                        $category = $sale['category'];
                        $purchaseDate = $sale['purchaseDate'];
                        $sellerUserID = $sale['sellerUserID'];
                        $buyerUserID = $sale['buyerUserID'];
                        $total = $sale['total'];
                        $numItems = $sale['numItems'];
                        $folio = $sale['folio'];
                        $review = $sale['review'];
                        $stock = $sale['stock'];
                        $imageBlob = $sale['image'];
                        $imageBlob = null; //quitar cuando funcione productos

                        echo '<tr>';
                        echo '  <td>';
                        echo '    <img src="' . ($imageBlob == null ? "Img/prodImg.jpeg" : "data:image/".$imageExt.";base64," . $image) . '" class="object-fit-contain td-img" alt="...">';
                        echo '  </td>';
                        echo '  <td>';
                        echo '    <div class="row">';
                        echo '      <h5 class="td-title">'.$productName.'</h5>';
                        echo '    </div>';
                        echo '    <div class="row">';
                        echo '      <h6>'.$category.'</h6>';
                        echo '    </div>';
                        echo '  </td>';
                        echo '  <td>';
                        echo '    <div class="row">';
                        echo '      <h6>Folio: '.$folio.'</h6>';
                        echo '      <p>' . htmlspecialchars($purchaseDate) . '</p>';
                        echo '      <div id="stock_sales"class="row">';
                        echo '          <h6 style="display: ' . ($rol == '2' ? 'block' : 'none') . '">Existencia actual: ' . $stock . '</h6>';
                        echo '      </div>';
                        echo '    </div>';
                        echo '    <div id="calif" class="row">';
                        echo '      <div class="col-1">';
                        echo '        <i class="icon ion-md-brush"></i>';
                        echo '      </div>';
                        echo '      <div class="col-1">';
                        echo '        <i class="icon ion-md-brush"></i>';
                        echo '      </div>';
                        echo '      <div class="col-1">';
                        echo '        <i class="icon ion-md-brush"></i>';
                        echo '      </div>';
                        echo '      <div class="col-1">';
                        echo '        <i class="icon ion-md-brush"></i>';
                        echo '      </div>';
                        echo '      <div class="col-1">';
                        echo '        <i class="icon ion-md-brush no"></i>';
                        echo '      </div>';
                        echo '    </div>';
                        echo '  </td>';
                        echo '  <td>';
                        echo '    <h5>Cantidad: '.$numItems.'</h5>';
                        echo '    <h4 class="td-price">$'.$total.' MXN</h4>';
                        echo '  </td>';
                        echo '</tr>';
                    }
                }
?>
              </tbody>
            </table>
           

          </div>

        </div>

        <div id="grouped_sales" class="row" style="margin-left: 20px; margin-right: 20px; margin-top: 20px; display: <?php echo $rol == '2' ? 'block' : 'none'; ?>">
          <h4>Resumen</h4>
          
          <div class="col-12" style="padding-left: 40px; padding-right: 40px;">

            
            <table class="table table-hover">
              <tbody>
                <?php
                    if(isset($_SESSION['gr_salesAPI'])){
                    foreach ($_SESSION['gr_salesAPI'] as $sale) {
                        $gr_category = $sale['Category'];
                        $gr_date = $sale['Date'];
                        $gr_sales = $sale['Sales'];

                        echo '<tr>';
                        echo '  <td>';
                        echo '    <h4 class="td-price">'. $gr_category.'</h4>';
                        echo '  </td>';
                        echo '  <td>';
                        echo '    <h5>'. $gr_date.'</h5>';
                        echo '  </td>';
                        echo '  <td>';
                        echo '    <h5>Ventas:'. $gr_sales.'</h5>';
                        echo '  </td>';
                        echo '</tr>';
                        }
                    }
                ?>

                <tr>
                  <td>
                    <h4 class="td-price">Plumas</h4>
                  </td>
                  <td>
                    <h5>Agosto 2023</h5>
                  </td>
                  <td>
                   <h5>Ventas: 2</h5>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

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
  <script>
  
  /*$(document).ready(function () {
      function loadSalesFilter(data) {
        $.ajax({
            url: './API/salesAPI.php?action=getAllFilter',
            method: 'POST',
            data: data,
            success: function (result) {
                console.log(result);
                alert("success")
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.log('Error:', error);
            }
        });
     }

     function loadSales() {
        $.ajax({
            url: './API/salesAPI.php?action=getAll',
            method: 'POST',
            success: function (result) {
                console.log(result);
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.log('Error:', error);
            }
        });
      }
*/
      
      $("#filtrar").on("click", function(){
            var _category = $("#Cat").val()==-1?null:$("#Cat").val();
            var _endDate = $("#endDate").val()==""?null:$("#endDate").val();
            var _startDate = $("#startDate").val()==""?null:$("#startDate").val();

            alert(_category + " " + _endDate + " " + _startDate);
            var data = {
                "category": _category,
                "endDate": _endDate,
                "startDate": _startDate,
                "action": 0
            }
            
            $.ajax({
            url: './API/ventasAPI.php',
            method: 'POST',
            data: data,
            success: function (result) {
              var roluser=<?php if($_SESSION['usersAPI']['rol'] == 2){ echo "'block'";}else{ echo "'none'";}?>;
              resultados=JSON.parse(result);
              $('#contenido').empty();
              resultados.forEach(element => {
                $('#contenido').append(`
               <tr>
                        <td>
                        <img src="Img/prodImg.jpeg" class="object-fit-contain td-img" alt="...">
                        </td>
                      <td>
                       <div class="row">
                       <h5 class="td-title">${element.productName}</h5>
                        </div>
                        <div class="row">
                          <h6>${element.category}</h6>
                        </div>
                       </td>
                       <td>
                        <div class="row">
                          <p>${element.purchaseDate}</p>
                          <div id="stock_sales"class="row">
                              <h6 style="display: ${roluser}">Existencia actual: ${element.stock}</h6>
                          </div>
                        </div>
                        <div id="calif" class="row">
                          <div class="col-1">
                            <i class="icon ion-md-brush"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush"></i>
                          </div>
                          <div class="col-1">
                            <i class="icon ion-md-brush no"></i>
                          </div>
                        </div>
                       </td>
                        <td>
                        <h5>Cantidad: ${element.numItems}</h5>
                        <h4 class="td-price">$${element.total} MXN</h4>
                        </td>
                        </tr>`);
              });
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.log('Error:', error);
            }
        });
        })
  </script>

  <script src="Middleware.js"></script>
</body>
</html>