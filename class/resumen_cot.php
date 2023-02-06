<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  echo '
        <script>
            alert("Por favor debes iniciar sesion !!");
            window.location="../index.php";
        </script>
    ';
  session_destroy();
  die();
}

require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {

    $sql = $con->prepare("SELECT id, nombre_art, precio , descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
  }
}



?>


<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hogar Digital-inicio</title>
  <!--My Styles-->
  <link rel="stylesheet" href="../public/css/basico/basico.css">
  <!--Google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;600&display=swap" rel="stylesheet">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <?php
  require "../views/nav.php";
  ?>
  <main>
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($lista_carrito == null) {
              echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
            } else {
              $total = 0;
              $iva = 0.19;
              foreach ($lista_carrito as $productos) {
                $_id = $productos['id'];
                $nombre = $productos['nombre_art'];
                $precio = $productos['precio'];
                $descuento = $productos['descuento'];
                $cantidad = $productos['cantidad'];
                $precio_desc = $precio - (($precio * $descuento) / 100);
                $subtotal = $cantidad * $precio_desc;
                $total += $subtotal;
                $total_con_iva = $total + ($total * $iva);
            ?>

                <tr>
                  <td>
                    <?php echo $nombre ?>
                  </td>
                  <td>
                    <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                  </td>
                  <td>
                    <input type="number" min="1" max="2" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actulizaCantidad(this.value, <?php echo $_id; ?>)">
                  </td>
                  <td>
                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                      <?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>
                    </div>
                  </td>
                  <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Elimiar</a></td>
                </tr>
            <?php
              }
            }
            ?>

            <!--Total-->
            <tr>
              <td colspan="3"></td>
              <td colspan="2">
                <p class="h3" id="total">
                  <?php
                  if (isset($total_con_iva)) {
                    echo MONEDA . number_format($total, 2, '.', ',');
                  } else {
                    echo "Sin datos para mostrar.";
                  }
                  ?>
                </p>

              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <?php
      if ($lista_carrito != null) { ?>
        <div class="row">
          <div class="col-md-3 ms-md-auto"><a href="pago.php" class="btn btn-primary btn-lg">Realizar Cotización</a></div>
        </div>
    </div>
  <?php } ?>
  </main>

  <!--Modal-->
  <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5>¿Desea Eliminara el Producto de la lista?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" id="btn-eliminar" onclick="eliminar()">Eliminar</button>
        </div>
      </div>
    </div>
  </div>





  <!--Btn Cerrar sesión-->
  <div>
    <a href="../class/cerrar_sesion.php" type="button" class="btn btn-outline-success z-1 position-absolute p-2 rounded-3 mx-2 mb">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
      </svg>
    </a>
  </div>

  <!--Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!--My Script-->
  <script src="../public/js/addProducto.js"></script>
  <script src="../public/js/actualizarCantidad.js"></script>
  <script src="../public/js/eliminarArticulo.js"></script>
</body>

</html>