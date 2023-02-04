<?php
    include '../controller/conexion_bd.php';

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fecha_registro = date("Y-m-d H:i:s");
    $rol = "vendedor";
 
    $query = "SELECT id FROM roles WHERE nombre = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $rol);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
 
    if ($row = mysqli_fetch_assoc($result)) {
      $rol_id = $row['id'];
    } else {
      $query = "INSERT INTO roles(nombre) VALUES(?)";
      $stmt = mysqli_prepare($conexion, $query);
      mysqli_stmt_bind_param($stmt, "s", $rol);
      mysqli_stmt_execute($stmt);
      $rol_id = mysqli_insert_id($conexion);
    }


    // Definir la longitud máxima permitida para cada entrada
  $usuario_max_length = 20;
  $email_max_length = 50;
  $password_max_length = 20;
 
  // Validar la longitud de cada entrada
  if (strlen($usuario) > $usuario_max_length) {
    echo '
    <script>
    alert("El nombre de usuario es demasiado largo, intenta con un nombre más corto");
    window.location = "../index.php";
    </script>
    ';
    exit();
  }
 
  if (strlen($email) > $email_max_length) {
    echo '
    <script>
    alert("El correo es demasiado largo, intenta con un correo más corto");
    window.location = "../index.php";
    </script>
    ';
    exit();
  }
 
//   $password_max_length = 6;
//   if (strlen($contrasena) > $password_max_length) {
//     echo '
//     <script>
//     alert("La contraseña es demasiado corta, intenta con una contraseña más corta");
//     window.location = "../index.php";
//     </script>
//     ';
//     exit();
//   }

 
    $query = "INSERT INTO usuarios(usuario, correo, contrasena, fecha_registro, rol_id) 
     VALUES(?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $usuario, $email, $contrasena, $fecha_registro, $rol_id);

    // Validar que el correo no se repita en la base de datos
 
    $validaCorreo = mysqli_prepare($conexion, "SELECT * FROM usuarios WHERE correo = ?");
    mysqli_stmt_bind_param($validaCorreo, "s", $email);
    mysqli_stmt_execute($validaCorreo);
    $result = mysqli_stmt_get_result($validaCorreo);
    if (mysqli_num_rows($result) > 0) {
        echo'
            <script>
            alert("Este correo ya está registrado, intenta con otro");
            window.location = "../index.php";
            </script>
        ';
        exit();
    }


    // Validar que el usuario no se repita en la base de datos
 
    $validausuario = mysqli_prepare($conexion, "SELECT * FROM usuarios WHERE usuario = ?");
    mysqli_stmt_bind_param($validausuario , "s", $usuario);
    mysqli_stmt_execute($validausuario );
    $result = mysqli_stmt_get_result($validausuario);
    if (mysqli_num_rows($result) > 0) {
        echo'
            <script>
            alert("Este usuario ya está registrado, intenta con otro");
            window.location = "../index.php";
            </script>
        ';
        exit();
    }

   
   // Ejecutar la consulta preparada
   $ejecutar = mysqli_stmt_execute($stmt);
   
   if ($ejecutar) {
       echo '
       <script>
       alert("Usuario registrado");
       window.location = "../index.php";
       </script>
       ';
   } else {
       echo '
       <script>
       alert("Usuario no registrado, por favor revise");
       window.location = "resgistro.php";
       </script>
       ';
   }
   
    mysqli_close($conexion);
?>