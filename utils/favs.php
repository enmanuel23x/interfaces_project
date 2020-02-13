<?php
session_start();
include('../auth/connection.php');
if(isset($_SESSION['id'])){
    $prod = $_GET['id'];
    $case = $_GET['case'];
    if ( isset( $case ) && isset( $prod ) ){
        $iduser = $_SESSION['id'];
        if( $case==1){
            $buscarLista = "SELECT * FROM lista_de_deseos
                WHERE id_cliente = '$iduser' ";
            $result = $conn->query($buscarLista);
            $lista = $result->fetch_object();
            $query = "INSERT INTO detalle_lista_de_deseos (id_lista_de_deseos, id_producto)
                      VALUES ('$lista->id','$prod')";
                if ($conn->query($query) === TRUE) {
                    header('Location: '.'/details.php?id=' . $prod);
                }
            }else if ( $case==2){
                $buscarLista = "SELECT * FROM lista_de_deseos
                    WHERE id_cliente = '$iduser' ";
                $result = $conn->query($buscarLista);
                $lista = $result->fetch_object();
                $borrar = "DELETE FROM detalle_lista_de_deseos
                    WHERE (id_lista_de_deseos = '$lista->id' AND id_producto = '$prod')";
                    if ($conn->query($borrar) === TRUE) {
                        header('Location: '.'/details.php?id=' . $prod);
                    }
            }else{
                header('Location: '.'/');
            }
    }else{
        header('Location: '.'/');
    }
}else{
    header('Location: '.'/ingreso.php');
}
?>