<?php
 session_start();

 if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor debes iniciar sesion !!");
            window.location="index.php";
        </script>
    ';
    session_destroy();
    die();
 }
 
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hogar Digital-inicio</title>
  <!--My Styles-->
  <link rel="stylesheet" href="/public/css/inicio/inicio.css">
  <!--Google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;600&display=swap" rel="stylesheet">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <head>
    <?php
      require 'views/nav_inicio.php'
    ?>
  </head>
  <!-- Page Content -->
  <div class="container">
    <h1 class="mt-5 mb-5 text-center">Hogar Digital Colvatel</h1>
    <h3 class="text-center">Tipo de Plan</h3>
  </div>
  <div class="container d-flex justify-content-center mt-4">
    <img src="assets/icons/icono-tipo-plan.gif" alt="" width="300px" height="300px">
  </div>
  <div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="container">
      <div class="row">
        <div class="col d-flex justify-content-center align-items-center">
          <div class="card border-success  text-center card-plan w-75 mb-4">
            <div class="card-body">
              <h5 class="card-title">Plan Básico</h5>
              <a href="class/basico.php" class="btn btn-success mt-4">Ingresar</a>
            </div>
          </div>
        </div>
        <div class="col d-flex justify-content-center align-items-center">
          <div class="card border-primary text-center card-plan w-75 mb-4">
            <div class="card-body">
              <h5>Plan Personalizado</h5>
              <a href="class/personalizado.php" class="btn btn-primary mt-4">Ingresar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Btn Cerrar sesión-->
  <div class="mb-0">
    <a href="class/cerrar_sesion.php" type="button"
      class="btn btn-outline-success z-1 position-absolute p-2 rounded-3 mx-2 mb">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd"
          d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
        <path fill-rule="evenodd"
          d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
      </svg>
      Cerar Sesión
    </a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>