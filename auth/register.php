<?php
session_start();
include('./connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ( isset( $_POST['name'] ) && isset( $_POST['name2'] ) &&   isset( $_POST['email'] ) && isset( $_POST['password'] ) && isset( $_POST['password2'] ) ) {
        $buscarUsuario = "SELECT * FROM usuario
	    WHERE user = '$_POST[email]' ";
	    $result = $conn->query($buscarUsuario);
	    $count = mysqli_num_rows($result);
	    if ($count == 1) {
	        $_SESSION['error']= 3;
            header('Location: '.'/ingreso.php');
	    } else {
            $form_pass = $_POST['password'];
            $hash = password_hash($form_pass, PASSWORD_BCRYPT);
            $query = "INSERT INTO usuario (nombres, apellidos, documento, rol, user, password)
                      VALUES ('$_POST[name]','$_POST[name2]','$_POST[document]',2,'$_POST[email]',  '$hash')";
            if ($conn->query($query) === TRUE) {
                $buscarUsuario = "SELECT * FROM usuario
                        WHERE user = '$_POST[email]' ";
                $result = $conn->query($buscarUsuario)->fetch_object();
                $_SESSION['user_id'] = $result->id;
                $_SESSION['names'] = $result->nombres." ". $result->apellidos;
                $_SESSION['rol'] = $result->rol;
                $_SESSION['error']= 0;
                $query = "INSERT INTO lista_de_deseos (id_cliente, nombre)
                      VALUES ('$result->id','Lista de deseos')";
                if ($conn->query($query) === TRUE) {
                    header('Location: '.'/');
                    }
                }
            }
            mysqli_close($conn);
    }
}else{
    header('Location: '.'/ingreso.php');
}
?>