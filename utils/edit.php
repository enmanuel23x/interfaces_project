<?php
session_start();
include('../auth/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION['id'])){
        $prod = $_GET['id'];
        $case = $_GET['case'];
        if ( isset($_POST['categ']) && isset( $case ) && isset( $prod ) ){
            if( $case==0){
                $sql = "UPDATE producto SET nombre= '$_POST[nombre]', precio=$_POST[precio],
                inventario=$_POST[qty], descripcion='$_POST[message]',id_categoria='$_POST[categ]' WHERE id= '$prod'";
                    if ($conn->multi_query($sql) === TRUE) {
                        header('Location: '.'/panel.php');
                        }else{
                            header('Location: '.'/');
                        }
                }else if ( $case==1){
                    $sql = "DELETE FROM other_images  WHERE id_producto= '$prod'";
                        if ($conn->query($sql) === TRUE) {
                            extract($_POST);
                            $error=array();
                            $extension=array("jpeg","jpg","png","gif");
                            $band=0;
                            foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
                                $file_name=$_FILES["files"]["name"][$key];
                                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                                if(in_array($ext,$extension)) {
                                    if($band==0){
                                        $file_name=$prod . "-" .$_FILES["files"]["name"][$key];
                                        $band=1;
                                        $pdir="./src/assets/img/".$file_name;
                                        $sql = "UPDATE producto SET nombre= '$_POST[nombre]', precio=$_POST[precio],
                                            imagen='$pdir',inventario=$_POST[qty], 
                                            descripcion='$_POST[message]' WHERE id= '$prod'";
                                        if ($conn->query($sql) === TRUE) {
                                            if(!file_exists("../src/assets/img/".$file_name)) {
                                                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../src/assets/img/".$file_name);
                                                }else {
                                                    $filename=basename($file_name,$ext);
                                                    $newFileName=$filename.time().".".$ext;
                                                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../src/assets/img/".$newFileName);
                                                }
                                            }
                                        }else{
                                            $file_name=$prod . "-" .$_FILES["files"]["name"][$key];
                                            $pdir="./src/assets/img/".$file_name;
                                            $sql = "INSERT INTO other_images (id_producto, imagen)
                                                VALUES ('$prod ','$pdir')";
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
                            }
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