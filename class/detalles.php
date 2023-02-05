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

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if($id == '' || $token == ''){
        echo 'Error el aprocesar petición';
        exit;
    }else{
        $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

        if($token == $token_tmp){

            $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
            $sql->execute([$id]);
            if($sql->fetchColumn()>0){
                $sql = $con->prepare("SELECT nombre_art, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
                $sql->execute([$id]);  
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                $nombre = $row['nombre_art'];
                $descripcion = $row['descripcion'];
                $precio = $row['precio'];
                $descuento = $row['descuento'];
                $precio_desc = $precio - (($precio * $descuento) / 100);
                $dir_images = "../assets/images/producto/". $id . '/';

                $rutaImg = $dir_images . 'imagenproducto.jpg';

                if(!file_exists($rutaImg)){
                    $rutaImg = "../assets/images/producto/predefinida.png";
                }

                $imagenes = array();
                if(file_exists($dir_images)){
                  
                  $dir = dir($dir_images);
  
                  while(($archivo = $dir->read()) !=false){
                      if($archivo != 'imagenproducto.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))){
                          $imagenes[] = $dir_images . $archivo;
                      }
                  }
                  $dir->close();
                }            
          }else{
            echo 'Error el aprocesar petición';
            exit; 
          }
        }else{
          echo 'Error el aprocesar petición';
          exit;
        }
  }


  /*
  <?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>
            alert("Por favor, debes iniciar sesión");
            window.location="../index.php";
        </script>';
    session_destroy();
    exit;
}

require '../config/config.php';  
require '../config/database.php';

$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if (empty($id) || empty($token)) {
    echo 'Error al procesar la petición';
    exit;
}

$token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

if ($token != $token_tmp) {
    echo 'Error al procesar la petición';
    exit;
}

$sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
$sql->execute([$id]);

if ($sql->fetchColumn() == 0) {
    echo 'Error al procesar la petición';
    exit; 
}

$sql = $con->prepare("SELECT nombre_art, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
$sql->execute([$id]);  

$row = $sql->fetch(PDO::FETCH_ASSOC);

$nombre = $row['nombre_art'];
$descripcion = $row['descripcion'];
$precio = $row['precio'];
$descuento = $row['descuento'];
$precio_desc = $precio - (($precio * $descuento) / 100);
$dir_images = "../assets/images/producto/". $id . '/';

$rutaImg = $dir_images . 'imagenproducto.jpg';

if (!file_exists($rutaImg)) {
    $rutaImg = "../assets/images/producto/predefinida.png";
}

$imagenes = array();

if (file_exists($dir_images)) {
    $dir = dir($dir_images);

    while (($archivo = $dir->read()) != false) {
        if ($archivo != 'imagenproducto.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
            $imagenes[] = $dir_images . $archivo;
        }
    }

    $dir->close();
}
?>

  
  
  */
  
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
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-1">
          <div id="carouselImages" class="carousel slide carousel-fade">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?php echo $rutaImg; ?>" alt="" class="d-block w-100">
              </div>

              <div class="carousel-item">
                <?php foreach($imagenes as $img) { ?>
                <div class="carousel-tem">
                  <img src="<?php echo $img; ?>" alt="" class="d-block w-100">
                  }
                  <?php } ?>
                </div>

              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="col-md-6 order-md-2">
          <h2>
            <?php echo $nombre;?>
          </h2>
          <?php if($descuento > 0) { ?>
          <p><del>
              <?php echo MONEDA . number_format($precio, 2, '.', ',') ;?>
            </del></p>
          <h2>
            <?php echo MONEDA . number_format($precio_desc, 2, '.', ',') ;?>
            <small class="text-success">
              <?php echo $descuento; ?> % descuento
            </small>
          </h2>

          <?php } else {?>

          <h2>
            <?php echo MONEDA . number_format($precio, 2, '.', ',') ;?>
          </h2>
          <?php } ?>

          <p class="lead">
            <?php echo $descripcion;?>
          </p>
          <div class="d-grid gap-3 col-10 mx-auto">
            <button class="btn btn-primary" type="button">Comprar ahora</button>
            <button class="btn btn-outline-primary" type="button"
              onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp ?>')">Agregar al Carrito</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--Script Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!--My Script-->
  <script src="../public/js/addProducto.js"></script>
</body>

</html>