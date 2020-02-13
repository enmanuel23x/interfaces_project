<?php
session_start();
include('../auth/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['id'])){
        $id = $_GET['id'];
        if (isset( $id ) ){
            $sql = "UPDATE categoria SET nombre= '$_POST[nombre]',descripcion='$_POST[descipcion]' WHERE id= '$id'";
                    if ($conn->multi_query($sql) === TRUE) {
                        header('Location: '.'/panel.php');
                        }else{
                            header('Location: '.'/');
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