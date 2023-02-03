<?php
session_start();

if (isset($_SESSION['usuario'])) {
   header("location: index.php");
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hogar Digital - registro</title>
  <!--My Styles-->
  <link rel="stylesheet" href="public/css/registro/registro.css">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!--Google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;600&display=swap" rel="stylesheet">
  
</head>

<body>
<h1 class="my-custom-h1 mt-5 mb-5 text-center">Hogar Digital Colvatel</h1>
  <div class="container w-75 mt-5 rounded">
    <div class="row  align-items-lg-stretch">
      <!--Imagen login-->
      <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded"></div>

      <!--Logo-->
      <div class="col p-5 rounded-end">
        <div class="text-end">
          <img src="assets/icons/logo.png" width="260px" alt="logo registro">
        </div>
        <h2 class="fw-bold text-center pt-5 mb-5">Registrar</h2>

        <!--inputs registro-->
        <form action="class/resgistro.php" method="post">
          <div class="mb-4">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario"  id="usuario"  required autofocus>
          </div>

          <div class="mb-4">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" id="email"   required>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Registrar</button>
          </div>
          <div class="my-3">
            <span>Ya tienes cuenta? <a href="index.php">Iniciar sesión</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>