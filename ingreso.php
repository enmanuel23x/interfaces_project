<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./src/assets/css/main.css">
    <link rel="stylesheet" href="./src/assets/css/login-register.css">
</head>
<?php
session_start();
if ($has_session = session_status() == PHP_SESSION_ACTIVE) {
  if (isset($_SESSION['error'])) {
if( $_SESSION['error'] == 1){
    echo "<script type='text/javascript'>alert('Contraseña erronea');</script>";
    session_destroy();
} else if( $_SESSION['error'] == 2){
    echo "<script type='text/javascript'>alert('Correo no registrado');</script>";
    session_destroy();
  } else if( $_SESSION['error'] == 3){
    echo "<script type='text/javascript'>alert('El correo seleccionado ya esta registrado\nPor favor intente otra vez');</script>";
    session_destroy();
  } else if( $_SESSION['error'] == 0){
    header('Location: '.'/');
  }
  }
}
?>
<body>
    <input onclick="window.history.back();" class="back" type="button" value="<-Atras"> 
    <h5>Logo</h5>
        <div class="form">
      
                <ul class="tab-group">
                    <li class="tab active" id="log"><a onclick="changeopc(0)">Iniciar Sesion</a></li>
                    <li class="tab" id="sign"><a onclick="changeopc(1)">Nuevo Cliente</a></li>
                </ul>
                
                <div class="tab-content">
                <div id="login">   
                    <h1>¡Bienvenido!</h1>
                    <form action="./auth/login.php" method="POST">
                    
                      <div class="field-wrap">
                      <input placeholder="Correo..." name="username" type="email"required autocomplete="off"/>
                    </div>
                    
                    <div class="field-wrap">
                      <input placeholder="Contraseña..." name="password" type="password"required autocomplete="off"/>
                    </div>
                    
                    <p class="forgot"><a href="#">¿Olvido de contraseña?</a></p>
                    
                    <button class="button button-block" type="submit" />Enviar</button>
                    
                    </form>
                  </div>
                  <div id="signup" >   
                    <h1>Registrarse Gratis</h1>
                    
                    <form action="./auth/register.php" method="POST">
                    
                    <div class="top-row">
                      <div class="field-wrap">
                        <input placeholder="Nombre..." name="name" type="text" required autocomplete="off" />
                      </div>
                  
                      <div class="field-wrap">
                        <input placeholder="Apellido..." name="name2" type="text"required autocomplete="off"/>
                      </div>
                    </div>
          
                    <div class="field-wrap">
                      <input placeholder="Correo..." name="email" type="email"required autocomplete="off"/>
                    </div>
                    <div class="field-wrap">
                      <input placeholder="Documento..." name="document" type="text"required autocomplete="off"/>
                    </div>
                    <div class="field-wrap">
                      <input placeholder="Contraseña..." name="password" type="password"required autocomplete="off"/>
                    </div>
                    <div class="field-wrap">
                            <input placeholder="Repetir contraseña..." name="password2" type="password"required autocomplete="off"/>
                          </div>
                    <button type="submit" class="button button-block"/>Registrarse</button>
                    
                    </form>
          
                  </div>
                  
                </div><!-- tab-content -->
                
          </div> <!-- /form -->
</body>
<script src="./src/assets/js/login.js"></script>
</html>