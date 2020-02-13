function agregar(id){
    let cant =document.getElementById('qty').options[document.getElementById('qty').selectedIndex].value;
    window.location.href = "/utils/cart.php?id="+id+"&cant="+cant+"&case=1&opc=1";
};
function comprar(id){
    let cant =document.getElementById('qty').options[document.getElementById('qty').selectedIndex].value;
    window.location.href = "/utils/cart.php?id="+id+"&cant="+cant+"&case=1&opc=2";
};