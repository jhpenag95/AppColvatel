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
  <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Hogar Digital</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fs-5 text-secondary" href="#">Ingresar Cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 text-secondary" href="#">Cotización</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 text-secondary" href="#">Ingersar Pago</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 text-secondary" href="#">resumen de Datos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>