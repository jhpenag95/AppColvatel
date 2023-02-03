<?php
    session_start();

    include '../controller/conexion_bd.php';
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    $stmt = mysqli_prepare($conexion, "SELECT * FROM usuarios WHERE correo = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['contrasena'];
    
        if (password_verify($password, $hash)) {
            $_SESSION['usuario'] = $email;
            header("location: ../inicio.php");
            exit;
        }
    }
    
    echo '
    <script>
        window.location="../index.php";
        alert("Usuario no se encuentra creado, por favor verifique los datos !!");
    </script>
    ';
    
    exit;
    
    
    
    

?>