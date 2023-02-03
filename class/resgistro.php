<?php
   include '../controller/conexion_bd.php';

   $usuario = $_POST['usuario'];
   $email = $_POST['email'];
   $contrasena = $_POST['password'];
   $contrasena = password_hash($contrasena, PASSWORD_DEFAULT); // Usar la función password_hash para encriptar la contraseña
   
   $query = "INSERT INTO usuarios(usuario, correo, contrasena) 
             VALUES(?, ?, ?)";
   
   // Preparar la consulta
   $stmt = mysqli_prepare($conexion, $query);
   
   // Vincular los parámetros a la consulta
   mysqli_stmt_bind_param($stmt, "sss", $usuario, $email, $contrasena);
   
   // Validar que el correo no se repita en la base de datos
   $validaCorreo = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$email'");
   
   if (mysqli_num_rows($validaCorreo) > 0) {
       echo'
           <script>
           alert("Este correo ya está registrado, intenta con otro");
           window.location = "../index.php";
           </script>
       ';
       exit();
       mysqli_close($conexion);
   }
   
   // Validar que el usuario no se repita en la base de datos
   $validaUser = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario='$usuario'");
   if (mysqli_num_rows($validaUser) > 0) {
       echo'
           <script>
           alert("Este usuario ya está registrado, intenta con otro");
           window.location = "../index.php";
           </script>
       ';
       exit();
       mysqli_close($conexion);
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