<?php
session_start();
include('../auth/connection.php');
if(isset($_SESSION['id'])){
    $prod = $_GET['id'];
    $cant = $_GET['cant'];
    $case = $_GET['case'];
    $opc = $_GET['opc'];
    if ( isset( $case ) && isset( $cant )  && isset( $prod ) ){
        $iduser = $_SESSION['id'];
        if( $case==1){
            $buscarLista = "SELECT * FROM detalle_carrito
                WHERE (id_cliente = '$iduser' & id_producto = '$prod')";
            $result = $conn->query($buscarLista);
            $count = mysqli_num_rows($result);
            if( $count==0 ){
                    $query = "INSERT INTO detalle_carrito (id_producto, cantidad, id_cliente)
                      VALUES ('$prod', '$cant', '$iduser')";
                    if ($conn->query($query) === TRUE) {
                        if( $opc==1){
                            header('Location: '.'/details.php?id=' . $prod);
                            }else{
                                header('Location: '.'/carrito.php');
                            }
                        
                        }
                }else{
                    $lista = $result->fetch_object();
                    $cant= $lista->cantidad + $cant;
                    $sql = "UPDATE detalle_carrito SET cantidad= '$cant' WHERE id= '$lista->id'";
                    if ($conn->query($sql) === TRUE) {
                        if( $opc==1){
                            header('Location: '.'/details.php?id=' . $prod);
                            }else{
                                header('Location: '.'/carrito.php');
                            }
                        }
                }
            }else if ( $case==2){
                $borrar = "DELETE FROM detalle_carrito
                    WHERE (id_cliente = '$iduser' AND id_producto = '$prod')";
                    if ($conn->query($borrar) === TRUE) {
                        if( $opc==1){
                            header('Location: '.'/details.php?id=' . $prod);
                            }else{
                                header('Location: '.'/carrito.php');
                            }
                    }
                }
            }else{
                header('Location: '.'/');
            }
}else{
    header('Location: '.'/ingreso.php');
}
?>