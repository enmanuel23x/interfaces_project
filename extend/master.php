<?php
session_start();
include('./auth/connection.php');
?>
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google" content="notranslate">
    <title>ElectroPerú</title>
    <!-- Custom styles  -->
    <link rel="stylesheet" href="./src/assets/css/main.css">
    <link rel="stylesheet" href="./src/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="./src/assets/css/slideshow.css">
    <link rel="stylesheet" href="./src/assets/css/styles.css">
    <link rel="stylesheet" href="./src/assets/css/modal.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
   <!-- Navbar start -->
    <div class="nav" id="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header" style="padding-right: 50px;">
        <a href="/"><div class="nav-title">ElectroPerú</div></a>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        <div class="nav-links" id='nav-links'>
            <a href="/">Productos</a>
            <a href="#">Departamentos</a>
            <?php
                if ($has_session = session_status() == PHP_SESSION_ACTIVE) {
                    if (isset($_SESSION['error'])) {
                        if($_SESSION['rol']== 1){
                            ?> <a href="/panel.php">Panel de adiministrador</a> <?php
                        }
                    }
                }
                ?>
            <div style="display:inline-flex">
<?php
if ($has_session = session_status() == PHP_SESSION_ACTIVE) {
    if (isset($_SESSION['error'])) {
        if($_SESSION['error']== 0){
            echo '<ul class="dropdown">
          <li class="menu-item">
          <a style="color:white;" href="/perfil.php" class="menu-link">'.$_SESSION['names'] ." ". '<i class="fas fa-user"></i></a>
            <ul class="dropdown submenu">
              <li class="menu-item">
                <a class="menu-link"><i class="fas fa-clipboard-list"></i> Pedidos</a>
              </li>
              <li class="menu-item">
                <a href="/deseos.php" class="menu-link"><i class="fas fa-heart"></i> Lista de deseos</a>
              </li>
              <li class="menu-item">
              <a class="menu-link" href="./auth/out.php">Salir <i class="fas fa-sign-out-alt"></i>
              </a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="dropdown">
          <li class="menu-item">
          <a href="#" class="menu-link"><i class="fas fa-shopping-cart"></i></a>
          </li>
        </ul>';
        }

    }else{
        echo '<a href="./ingreso.php">Registro o inicio de sesion</a>';
    }
}
?>

            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <input onclick="window.history.back();" class="back" type="button" value="<-Atras">
