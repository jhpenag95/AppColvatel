function addProducto(id, token) {
    let url = '../clases/carrito.php';
    let formData = new FormData();
    formData.append('id', id);
    formData.append('token', token);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
    .then(data =>{
        if (data.ok) {
            let elemento = document.getElementById("num_cart");
            elemento.innerHTML = data.numero;
        }
    })
}



/**
 * Esta es una función JavaScript llamada "addProducto". Toma dos parámetros: "id" y "token". La función usa la API Fetch para hacer una solicitud POST a un archivo PHP "carrito.php" ubicado en la carpeta "clases". La solicitud incluye dos parámetros de formulario de datos, "id" y "token", que se pasan a la función como argumentos. Se espera que la respuesta del servidor esté en formato JSON, que luego se devuelve como resultado de la promesa.
 */