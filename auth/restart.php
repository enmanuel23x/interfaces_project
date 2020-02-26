<?php
session_start();
include('../auth/connection.php');
$url = $_GET['id'];
if ( isset( $url)){
$sql = "UPDATE producto SET click= '0' WHERE id= '$url'";
                    if ($conn->query($sql) === TRUE) {
                        header('Location: '.'/panel.php');
                        }else{
                            header('Location: '.'/');
                        }
}else{
header('Location: '.'/');
}
?>
