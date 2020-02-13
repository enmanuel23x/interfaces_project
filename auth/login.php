<?php
session_start();
include('./connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        $buscarUsuario = "SELECT * FROM usuario
	    WHERE user = '$_POST[username]' ";
	    $result = $conn->query($buscarUsuario);
	    $count = mysqli_num_rows($result);
        if ($count != 1) {
            $_SESSION['error']= 2;
            header('Location: '.'/ingreso.php');
        } else {
            $user = $result->fetch_object();
    	    if ( password_verify($_POST['password'], $user->password ))  {
                $_SESSION['id'] = $user->id;
                $_SESSION['names'] = $user->nombres." ". $user->apellidos;
                $_SESSION['rol'] = $user->rol;
                $_SESSION['error']= 0;
                header('Location: '.'/');
            } else {
                $_SESSION['error']= 1;
                header('Location: '.'/ingreso.php');
            }
            $conn->close();
        }
    }
}else{
    header('Location: '.'/ingreso.php');
}
?>