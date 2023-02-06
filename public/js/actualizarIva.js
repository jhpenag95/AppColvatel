let subtotal = 0.00;
let list = document.getElementsByName('subtotal[]');
for(let i=0; i < list.length; i++){
    subtotal += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
}

//calculate VAT
let VAT = subtotal * 0.19; 

//add VAT to subtotal to get total
let total = subtotal + VAT;

VAT = new Intl.NumberFormat('es-CO', {
    minimumFractionDigits: 2
}).format(VAT);


let moneda = '<?php echo MONEDA; ?>';
document.getElementById('VAT').innerHTML = moneda + ' ' + VAT;

