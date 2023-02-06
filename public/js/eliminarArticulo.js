let eliminaModal = document.getElementById('eliminaModal');

eliminaModal.addEventListener('show.bs.modal', function (event) {
  let button = event.relatedTarget;
  let id = button.dataset.bsId;
  document.getElementById('btn-eliminar').value = id;
});

async function eliminar() {
  let id = document.getElementById('btn-eliminar').value;
  let formData = new FormData();
  formData.append('action', 'eliminar');
  formData.append('id', id);

  let response = await fetch('../clases/actualizar_carrito.php', {
    method: 'POST',
    body: formData,
    mode: 'cors'
  });
  let data = await response.json();
  if (data.ok) location.reload();
}






// let eliminaModal = document.getElementById('eliminaModal');

// eliminaModal.addEventListener('show.bs.modal', function (event) {
//     let button = event.relatedTarget;
//     let id = button.getAttribute('data-bs-id');
//     let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-eliminar');
//     buttonElimina.value = id;
// })

// function eliminar() {

//     let buttonElimina = document.getElementById('btn-eliminar');
//     let id = buttonElimina.value;

//     let url = '../clases/actualizar_carrito.php';
//     let formData = new FormData();
//     formData.append('action', 'eliminar');
//     formData.append('id', id);

//     fetch(url, {
//         method: 'POST',
//         body: formData,
//         mode: 'cors'
//     }).then(response => response.json())
//     .then(data =>{
//         if (data.ok) {
//             location.reload();
//         }
//     })
// }
