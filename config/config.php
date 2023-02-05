<?php
    define("KEY_TOKEN", "3X9ui-T9@");
    define("MONEDA", "$");

    if (!isset($_SESSION)) {
        session_start();
    }

    $num_card = 0;
    if(isset($_SESSION['carrito']['productos'])){
        $num_card = count($_SESSION['carrito']['productos']);
    }

    /*
        Este código define dos constantes KEY_TOKEN y MONEDA y luego verifica si existe una sesión activa. Si no existe una sesión, se inicia una nueva con session_start().

        Luego, se define una variable $num_card y se le asigna un valor de 0. Si existe una sesión de carrito de compras con la clave 'productos', se cuentan los productos en el carrito y se asigna el resultado a $num_card.
    */
?>

