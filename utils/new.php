<?php
session_start();
include('../auth/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['categ']) && isset($_SESSION['id']) && isset( $_POST['nombre']) && isset( $_POST['precio']) && isset( $_POST['qty']) && isset( $_POST['message']) ){
    extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    $band=0;
    $idprod=0;
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
        if(in_array($ext,$extension)) {
            if($band==0){
                $sql = "INSERT INTO producto (nombre, precio, imagen, inventario, click,descripcion, id_categoria)
                    VALUES ('$_POST[nombre]','$_POST[precio]','1','$_POST[qty]',0,'$_POST[message]','$_POST['categ']')";
                    $band=1;
                if ($conn->query($sql) === TRUE) {
                    $idprod=$conn->insert_id;
                    $file_name=$idprod . "-" .$_FILES["files"]["name"][$key];
                    $pdir="./src/assets/img/".$file_name;
                    $sql = "UPDATE producto SET imagen= '$pdir' WHERE id= '$idprod'";
                    if ($conn->query($sql) === TRUE) {
                    if(!file_exists("../src/assets/img/".$file_name)) {
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../src/assets/img/".$file_name);
                        }else {
                            $filename=basename($file_name,$ext);
                            $newFileName=$filename.time().".".$ext;
                            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../src/assets/img/".$newFileName);
                        }
                    }
                    }
                }else{
                    $file_name=$idprod . "-" .$_FILES["files"]["name"][$key];
                    $pdir="./src/assets/img/".$file_name;
                    $sql = "INSERT INTO other_images (id_producto, imagen)
                    VALUES ('$idprod ','$pdir')";
                    $band=1;
                if ($conn->query($sql) === TRUE) {
                    if(!file_exists("../src/assets/img/".$file_name)) {
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../src/assets/img/".$file_name);
                        }else {
                            $filename=basename($file_name,$ext);
                            $newFileName=$filename.time().".".$ext;
                            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../src/assets/img/".$newFileName);
                        }
                    }
                }
            } else {
                echo $file_name;
                array_push($error,"$file_name, ");
            }
        }
        header('Location: '.'/panel.php');
}else{
    header('Location: '.'/nuevo.php');
}
}else{
    header('Location: '.'/ingreso.php');
}
?>