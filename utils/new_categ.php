<?php
session_start();
include('../auth/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['id'])){
        $sql = "INSERT INTO categoria (nombre, descripcion) VALUES ('$_POST[nombre] ','$_POST[descipcion]')";
            if ($conn->multi_query($sql) === TRUE) {
                header('Location: '.'/panel.php');
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