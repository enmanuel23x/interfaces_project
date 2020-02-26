<?php include './extend/master.php' ?>
<?php if ($has_session = session_status() == PHP_SESSION_ACTIVE) {
    if(isset($_SESSION['id'])){
        if($_SESSION['rol']==1){?>
<link rel="stylesheet" href="./src/assets/css/table.css">
<link rel="stylesheet" href="./src/assets/css/graphs.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<!-- -->
<link rel="stylesheet" href="./src/assets/css/tabs.css">
<div class="w3-container">
  <h2>Menu de Admins</h2>
  <div class="w3-row">
    <a href="javascript:void(0)" onclick="openCity(event, 'London');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Categorias</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Productos</div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Estadisticas</div>
    </a>
  </div>

  <div id="London" class="w3-container city" style="display:none">
    <h1>Categorias</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
            </tr>
            </thead>
        <tbody>
    <?php
    $categoria = "SELECT * FROM categoria";
    $categoria = $conn->query($categoria);
    $productos = "SELECT * FROM categoria";
    $productos = $conn->query($productos);
    $count = mysqli_num_rows($productos);
    if($count!=0){
      foreach($productos as $prod): ?>
        <tr>
            <td> <?=$prod['nombre']?> </td>
            <td> <?=$prod['descripcion']?> </td>
            <td><a class="btn" href=<?= "#modal-".$prod['id'] ?>><i class="fas fa-edit"></i> Editar</a></td>
                <div class="modal" id=<?= "modal-".$prod['id'] ?> aria-hidden="true">
                    <div class="modal-dialog">
                        <form action=<?= "./utils/editar_categ.php?id=".$prod['id'] ?> method="POST">
                            <div class="modal-header">
                                <h2>Editando</h2>
                                <a href="#" class="btn-close" aria-hidden="true">×</a>
                                </div>
                            <div class="modal-body">
                                <label for="nombre">Nombre: </label><input id="nombre" name="nombre" type="text" maxlength="40" value=<?=$prod['nombre']?> required>
                                <label for="descipcion">Descipcion: </label><input id="descipcion" name="descipcion" type="text" maxlength="500" value=<?=$prod['descripcion']?> required>
                                </div>
                            <div class="modal-footer">
                                <a href="#" class="btn" >Cerrar</a>
                                <button type="submit"  class="btn" style="background-color:green;width:auto;">Modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
        </tr>
      <?php endforeach;
    }
    ?>
    <tr>
            <td></td><td></td>
            <td style="text-align: end;"><a class="btn" href="#modal-new"><i class="fas fa-plus-square"></i> Nuevo</a></td>
            <div class="modal" id="modal-new" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="./utils/new_categ.php" method="POST">
                            <div class="modal-header">
                                <h2>Nuevo</h2>
                                <a href="#" class="btn-close" aria-hidden="true">×</a>
                                </div>
                            <div class="modal-body">
                                <label for="nombre">Nombre: </label><input id="nombre" name="nombre" type="text" maxlength="40" required>
                                <label for="descipcion">Descipcion: </label><input id="descipcion" name="descipcion" type="text" maxlength="500" required>
                                </div>
                            <div class="modal-footer">
                                <a href="#" class="btn" >Cerrar</a>
                                <button type="submit"  class="btn" style="background-color:green;width:auto;">Añadir</button>
                                </div>
                            </form>
                        </div>
                    </div>
        </tr>
    </tbody>
    </table>

  </div>

  <div id="Paris" class="w3-container city" style="display:none">
    <div class="center-positioning">

        <h1>Productos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Inventario</th>
                <th>Imagen</th>
                <th>Accion</th>
            </tr>
            </thead>
        <tbody>
    <?php
    $productos = "SELECT * FROM producto";
    $productos = $conn->query($productos);
    $count = mysqli_num_rows($productos);
    if($count!=0){
      foreach($productos as $prod): ?>
        <tr>
            <td> <?=$prod['nombre']?> </td>
            <td> <?=$prod['precio']?> </td>
            <td><?php foreach($categoria as $cat):
                if($cat['id']==$prod['id_categoria']){
                    echo $cat['nombre'];
                    }
                endforeach;?></td>
            <td> <?=$prod['inventario']?> </td>
            <td><img src=<?=$prod['imagen']?> alt="card picture" /> </td>
            <td><a class="btn" href=<?="/editar.php?id=".$prod['id'] ?>><i class="fas fa-edit"></i> Editar</a></td>
      </tr>
      <?php endforeach;
    }
    ?>
    <tr>
            <td></td><td></td><td></td><td></td><td></td>
            <td style="text-align: end;"><a class="btn" href="/nuevo.php"><i class="fas fa-plus-square"></i> Nuevo</a></td>
      </tr>
    </tbody>
    </table>
          </div>

        </table>

  </div>

  <div id="Tokyo" class="w3-container city" style="display:none">
    <!-- -->
    <h1 class="heading">Estadisticas</h1>
    <hr>

    <!-- -->
    <?php
    $productos = "SELECT * FROM producto";
    $productos = $conn->query($productos);
    $count = mysqli_num_rows($productos);
    $total = 0;
    if($count!=0){
      foreach ($productos as $prod):
        $total += $prod['click'];
      endforeach;
      echo "<strong><p class='heading'>Clickeos total: $total</p></strong><hr>";
      foreach($productos as $prod): ?>
      <div class="container">
          <p ><strong>Producto: </strong><?=$prod['nombre']?><br><strong>Clicks:</strong><?=$prod['click']?></p>
          <a class="btn restart" href=<?="auth/restart.php?id=".$prod['id']?> type="button">Reiniciar</a>
          <div class="graph-bar">
            <?php
            if ($total == 0) {
              $value = 0;
            }else {
              $value = ($prod['click'] * 100)/$total;
            }
             ?>
              <div class="skills" style="width: <?=$value?>%; background-color: #8A99A6;"><strong><?=$value?>%</strong></div>
          </div>
          <hr>
        </div>
      <?php endforeach;
      if (isset($_GET['submit'])) {
    $id = $_GET['did'];
    $query = mysql_query("update employee set
    employee_name='$name', employee_email='$email', employee_contact='$mobile',
    employee_address='$address' where employee_id='$id'", $connection);
    }
    }
     ?>
  </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>
<!-- -->

<br><br><br><br>
<?php include './extend/footer.php' ?>

<?php
}else{
    header('Location: '.'/');

}
}else{
    header('Location: '.'/ingreso.php');
}
}else{
    header('Location: '.'/ingreso.php');
}
?>
