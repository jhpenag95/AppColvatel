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
  
  $sql = $con->prepare("SELECT id, nombre_art, precio FROM productos WHERE activo=1");
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <?php
  require "../views/nav.php";
?>


  <main>
    <div class="container pt-5">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
        <?php foreach($resultado as $row) { ?>
        <div class="col">
          <div class="card shadow-sm">
            <?php 
              $id = $row['id'];
              $imagen = "../assets/images/producto/" . $id . "/imagenproducto.jpg";

              if(!file_exists($imagen)){
                $imagen = "../assets/images/producto/predefinida.png";
              }
            ?><!--permite saber donde esta la imagen de producto-->

            <img src="<?php echo $imagen; ?>" alt="" class="d-block w-100" height="280px">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nombre_art'] ?></h5>
              <p class="card-text">
                $ <?php echo number_format($row['precio'], 2, '.', ','); ?>
              </p>
              <div class="d-flex justify-content-center align-items-center">
                <div class="btn-group">
                  <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN)?>" class="btn btn-primary">Detalle</a>
                </div>
                <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN)?>')">Agregar al Carrito</button>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
  </main>







  <!--Btn Cerrar sesión-->
  <div>
    <a href="../class/cerrar_sesion.php" type="button"
      class="btn btn-outline-success z-1 position-absolute p-2 rounded-3 mx-2 mb">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd"
          d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
        <path fill-rule="evenodd"
          d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
      </svg>
    </a>
  </div>

  <!--Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!--My Script-->  
  <script src="../public/js/addProducto.js"></script>
</body>

</html>