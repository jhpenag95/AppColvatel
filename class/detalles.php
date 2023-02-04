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
                $sql = $con->prepare("SELECT nombre_art, descripcion, precio FROM productos WHERE id=? AND activo=1 LIMIT 1");
                $sql->execute([$id]);  
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                $nombre = $row['nombre_art'];
                $descripcion = $row['descripcion'];
                $precio = $row['precio'];
            }


        }else{
            echo 'Error el aprocesar petición';
            exit; 
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
                <img src="../assets/images/producto/1/imagenproducto.jpg" alt="">
            </div>
            <div class="col-md-6 order-md-2">
                <h2><?php echo $nombre;?></h2>
                <h2><?php echo MONEDA . number_format($precio, 2, '.', ',') ;?></h2>
                <p class="lead"><?php echo $descripcion?></p>
            </div>
        </div>
    </div>
</main>


</body>

</html>